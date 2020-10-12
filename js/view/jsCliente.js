$(document).ready(function(){
    $("#cpf").mask('000.000.000-00');
    $("#telefone").mask('(00) 00009-0000');

    function consultacliente(){
         $.ajax({
            url: "data/clienteTable.php",
            type: "POST",
            data: {
                action: "select"
            }
        }).done(function(result) {
            result = JSON.parse(result);

            $.each(result.data, function(index, value){
                let idcliente = value.idcliente;

                let tr = '<tr id="cliente_' + idcliente + '">';
                tr += setTableColumn(idcliente, "nome", value.nome);
                tr += setTableColumn(idcliente, "data_nascimento", value.data_nascimento, value.data_nascimento_formatado);
                tr += setTableColumn(idcliente, "cpf", value.cpf);
                tr += setTableColumn(idcliente, "rg", value.rg);
                tr += setTableColumn(idcliente, "telefone", value.telefone);

                tr += '<td style="width:16%">';

                tr += setTableButton(idcliente, "Editar", "Editar", "primary");
                tr += setTableButton(idcliente, "Deletar", "Deletar", "danger");

                tr += '</td>';
                tr += '</tr>';

                if(value.contem_endereco == "1"){
                    tr += '<tr><td colspan="6" class="column-center"><table class="table-cliente-endereco_' + idcliente + '">';
                    tr += '<thead>';
                    tr += '<tr>';
                    tr += '<th class="column-center column-11">cep</th>';
                    tr += '<th class="column-center">Referência</th>';
                    tr += '<th class="column-center column-30">Endereço</th>';
                    tr += '<th class="column-center">Número</th>';
                    tr += '</tr>';
                    tr += '</thead>';
                    tr += '<tbody>';
                    tr += '</tbody></table></td></tr>';
                }

                $(".table-cliente > tbody").append(tr);

                if(value.contem_endereco == "1"){
                    consultaEndereco(idcliente);
                }
            });
        });
    }

    function consultaEndereco(idcliente){
         $.ajax({
            url: "data/enderecoTable.php",
            type: "POST",
            data: {
                action: "select",
                idcliente: idcliente
            }
        }).done(function(result) {
            result = JSON.parse(result);
            let tr = '';

            $.each(result.data, function(index, value){
                let idendereco = value.idendereco;

                tr = '<tr id="endereco_' + idendereco + '">';

                tr += setTableColumn(idendereco, "cep", value.cep);
                tr += setTableColumn(idendereco, "referencia", value.referencia);
                tr += setTableColumn(idendereco, "endereco", value.endereco);
                tr += setTableColumn(idendereco, "numero", value.numero);

                tr += '</tr>';

                $(".table-cliente-endereco_" + idcliente + " > tbody").append(tr);
            });
        });
    }

    consultacliente();

    $("#btSalvar").on("click",function(){
        let idcliente       = $("#idcliente").val();
        let nome            = $("#nome").val();
        let data_nascimento = $("#data_nascimento").val();
        let cpf             = $("#cpf").val();
        let rg              = $("#rg").val();
        let telefone        = $("#telefone").val();
		let erro            = false;

        removerCSS();

        erro = campoVazio("nome", nome);
        erro = campoVazio("data_nascimento", data_nascimento) ? true : erro;
        erro = campoVazio("cpf", cpf) ? true : erro;
        erro = campoVazio("rg", rg) ? true : erro;
        erro = campoVazio("telefone", telefone) ? true : erro;

        if(erro == true){
            mensagem("alert-danger","Preencha todos os campos");

        }else{
            let action = "insert";

		    if(idcliente.length != 0){
                action = "update";
            }

			$.ajax({
				url: "data/clienteTable.php",
				type: "POST",
				data: {
					action: action,
					nome: nome,
					data_nascimento: data_nascimento,
					cpf: cpf,
					rg: rg,
                    telefone: telefone,
                    idcliente: idcliente,
				}
			}).done(function(data) {
				data = JSON.parse(data);

				if(data.success == true){
                    mensagem("alert-success", "Registro salvo com sucesso!");

					idcliente = idcliente == "" ? data.idcliente : idcliente;

					let tr = '';

					tr += setTableColumn(idcliente, "nome", nome);
                    tr += setTableColumn(idcliente, "data_nascimento", data_nascimento);
                    tr += setTableColumn(idcliente, "cpf", cpf);
                    tr += setTableColumn(idcliente, "rg", rg);
                    tr += setTableColumn(idcliente, "telefone", telefone);

					tr += '<td style="width:16%">';

                    tr += setTableButton(idcliente, "Editar", "Editar", "primary");
                    tr += setTableButton(idcliente, "Deletar", "Deletar", "danger");

					tr += '</td>';

                    if(action == "insert"){
                        tr = '<tr id="cliente_' + idcliente + '">' + tr + '</tr>';
                        $(".table-cliente > tbody").append(tr);

                        let lista_endereco = $('.table-endereco > tbody > tr').get().map(function(row) {
                            let retornoEndereco = {};

                            let endereco = $(row).find('td').get().map(function(cell) {
                                let celula   = {};
                                let name     = cell.id.replace(/[\_\0-9]+/g,'');
                                let value    = $(cell).html().search("button") != -1 ? "" : $(cell).html();
                                celula[name] = value;
                                return celula;
                            });

                            $.each(endereco, function(key, value){
                                let chave = Object.keys(endereco[key]);

                                if(chave[0] != ""){
                                    let conteudo = Object.values(endereco[key]);
                                    retornoEndereco[chave[0]] = conteudo[0];
                                }
                            });

                            return retornoEndereco;
                        });

                        $.ajax({
                            url: "data/enderecoTable.php",
                            type: "POST",
                            data: {
                                action: action,
                                idcliente: idcliente,
                                lista_endereco: lista_endereco
                            }
                        }).done(function(data) {
                            data = JSON.parse(data);

                            if(data.success == true){
                            }
                        });

                    } else {
                        $(".table-cliente > tbody > tr[id=cliente_" + idcliente + "]").html(tr).addClass("tr-success");
                    }

                    limparCampos();

                    setTimeout(function(){
                        $("div.mensagem").removeClass("alert-danger", "alert-success").html("").hide();
                        $(".table-cliente > tbody > tr[id=cliente_" + idcliente + "]").removeClass("tr-success");
                    }, 2000);
				}else{
                    mensagem("alert-danger","Erro ao salvar as informações do cliente!");
                }
			});
        }
    });

    $(document).on("click","button.btEditar",function(){
        let idcliente = this.id.replace(/[^\d]+/g,'');
        limparCampos();
        $("div.mensagem").removeClass("alert-danger", "alert-success").html("").hide();

        getTableDado("cliente", idcliente, "nome");
        getTableDado("cliente", idcliente, "data_nascimento");
        getTableDado("cliente", idcliente, "cpf");
        getTableDado("cliente", idcliente, "rg");
        getTableDado("cliente", idcliente, "telefone");

        $("#idcliente").val(idcliente);
    });

    $(document).on("click","button.btDeletar",function(){
        let idcliente = this.id.replace(/[^\d]+/g,'');
        if(confirm("Deseja realmente deletar este cliente?")){
			$.ajax({
				url: "data/clienteTable.php",
				type: "POST",
				data: {
					action: "deletar",
					idcliente: idcliente
				}
			}).done(function(data) {
				data = JSON.parse(data);

				if(data.success == true){
					$("div.mensagem").addClass("alert-success").html("<h4>Excluido com sucesso!</h4>").show();
				}else{
					$(".mensagem_erro").show();
					$(".mensagem_erro").append("Não foi possivel excluir o registro");
				}
			});

            $("#cliente_"+idcliente).remove();
        }
    });

    $("#btCancelar").on("click", function(){
        limparCampos();
        $("div.mensagem").removeClass("alert-danger", "alert-success").html("").hide();
    });
});

function limparCampos(){
    $("#idcliente").val("");
    $("#nome").removeClass("campo_vazio").val("");
    $("#data_nascimento").removeClass("campo_vazio").val("");
    $("#cpf").removeClass("campo_vazio").val("");
    $("#rg").removeClass("campo_vazio").val("");
    $("#telefone").removeClass("campo_vazio").val("");
    $("#idcliente").removeClass("campo_vazio").val("");
}

function removerCSS(){
    $("#nome").removeClass("campo_vazio");
    $("#data_nascimento").removeClass("campo_vazio");
    $("#cpf").removeClass("campo_vazio");
    $("#rg").removeClass("campo_vazio");
    $("#telefone").removeClass("campo_vazio");
    $("#idcliente").removeClass("campo_vazio");
}