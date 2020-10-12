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

                let tr = '<tr id="cliente_' + value.idcliente + '">';
                tr += setTableColumn(value.idcliente, "nome", value.nome);
                tr += setTableColumn(value.idcliente, "data_nascimento", value.data_nascimento, value.data_nascimento_formatado);
                tr += setTableColumn(value.idcliente, "cpf", value.cpf);
                tr += setTableColumn(value.idcliente, "rg", value.rg);
                tr += setTableColumn(value.idcliente, "telefone", value.telefone);

                tr += '<td style="width:16%">';

                tr += setTableButton(value.idcliente, "Editar", "Editar", "primary");
                tr += setTableButton(value.idcliente, "Deletar", "Deletar", "danger");

                tr += '</td>';
                tr += '</tr>';

                $(".table-cliente > tbody").append(tr);
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

					count = idcliente == "" ? data.idcliente : idcliente;

					let tr = '';

					tr += setTableColumn(count, "nome", nome);
                    tr += setTableColumn(count, "data_nascimento", data_nascimento);
                    tr += setTableColumn(count, "cpf", cpf);
                    tr += setTableColumn(count, "rg", rg);
                    tr += setTableColumn(count, "telefone", telefone);

					tr += '<td style="width:16%">';

                    tr += setTableButton(count, "Editar", "Editar", "primary");
                    tr += setTableButton(count, "Deletar", "Deletar", "danger");

					tr += '</td>';

                    if(action == "insert"){
                        tr = '<tr id="cliente_' + count + '">' + tr + '</tr>';
                        $(".table-cliente > tbody").append(tr);

                    } else {
                        $(".table-cliente > tbody > tr[id=cliente_" + count + "]").html(tr).addClass("tr-success");
                    }

                    limparCampos();

                    setTimeout(function(){
                        $("div.mensagem").removeClass("alert-danger", "alert-success").html("").hide();
                        $(".table-cliente > tbody > tr[id=cliente_" + count + "]").removeClass("tr-success");
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
        var idcliente = this.id.replace(/[^\d]+/g,'');
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