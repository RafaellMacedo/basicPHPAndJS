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

                tr += setTableButton(value.idcliente, "Editar", "primary");
                tr += setTableButton(value.idcliente, "Deletar", "danger");

                tr += '</td>';
                tr += '</tr>';

                $("table > tbody").append(tr);
            });
        });
    }

    consultacliente();

    $("#btCancelar").on("click", function(){
        limparCampos();
    });

    $("#btSalvar").on("click",function(){
        let idcliente       = $("#idcliente").val();
        let nome            = $("#nome").val();
        let data_nascimento = $("#data_nascimento").val();
        let cpf             = $("#cpf").val();
        let rg              = $("#rg").val();
        let telefone        = $("#telefone").val();
		let erro            = false;

        erro = campoVazio("nome", nome);
        erro = campoVazio("data_nascimento", data_nascimento);
        erro = campoVazio("cpf", cpf);
        erro = campoVazio("rg", rg);
        erro = campoVazio("telefone", telefone);

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

                    tr += setTableButton(count, "Editar", "primary");
                    tr += setTableButton(count, "Deletar", "danger");

					tr += '</td>';

                    if(action == "insert"){
                        tr = '<tr id="cliente_' + count + '">' + tr + '</tr>';
                        $("table > tbody").append(tr);

                    } else {
                        $("table > tbody > tr[id=cliente_" + count + "]").html(tr).addClass("tr-success");
                    }

                    limparCampos();

                    setTimeout(function(){
                        $("div.mensagem").removeClass("alert-danger", "alert-success").html("").hide();
                        $("table > tbody > tr[id=cliente_" + count + "]").removeClass("tr-success");
                    }, 2000);
				}else{
                    mensagem("alert-danger","Erro ao salvar as informações do cliente!");
                }
			});

            // }else{
//                   $("tr[id=cliente_" + idcliente + "] > td[id=nome_" + idcliente + "]").removeAttr("data-nome");
//                   $("tr[id=cliente_" + idcliente + "] > td[id=idade_" + idcliente + "]").removeAttr("data-idade");
//                   $("tr[id=cliente_" + idcliente + "] > td[id=sexo_" + idcliente + "]").removeAttr("data-sexo");
//                   $("tr[id=cliente_" + idcliente + "] > td[id=email_" + idcliente + "]").removeAttr("data-email");
//                   $("tr[id=cliente_" + idcliente + "] > td[id=curso_" + idcliente + "]").removeAttr("data-curso");

//                   $("tr[id=cliente_" + idcliente + "] > td[id=nome_" + idcliente + "]").attr("data-nome",nome).html(nome);
//                   $("tr[id=cliente_" + idcliente + "] > td[id=idade_" + idcliente + "]").attr("data-idade",idade).html(idade);
//                   $("tr[id=cliente_" + idcliente + "] > td[id=sexo_" + idcliente + "]").attr("data-sexo",sexo).html(sexo);
//                   $("tr[id=cliente_" + idcliente + "] > td[id=email_" + idcliente + "]").attr("data-email",email).html(email);
//                   $("tr[id=cliente_" + idcliente + "] > td[id=curso_" + idcliente + "]").attr("data-curso",curso).html($("#curso option:selected").text());

//                   $.ajax({
				// 	url: "data/clienteTable.php",
				// 	type: "POST",
				// 	data: {
				// 		action: "alterar",
				// 		idcliente: idcliente,
				// 		nome: nome,
				// 		email: email,
				// 		idade: idade,
				// 		sexo: sexo,
				// 		idcurso: curso
				// 	}
				// }).done(function(data) {
				// 	data = JSON.parse(data);
				// 	if(data.success == true){
				// 		$("div.mensagem").addClass("alert-success").html("<h4>Alterado com sucesso!</h4>").show();
				// 	}else{
				// 		$(".mensagem_erro").show();
				// 		$(".mensagem_erro").append("Não foi possivel alterar o cliente");
				// 	}
				// 	LimpaDados();
				// });
            // }
        }
    });

    $(document).on("click","button.btEditar",function(){
        let idcliente = this.id.replace(/[^\d]+/g,'');

        getTableDado(idcliente, "nome");
        getTableDado(idcliente, "data_nascimento");
        getTableDado(idcliente, "cpf");
        getTableDado(idcliente, "rg");
        getTableDado(idcliente, "telefone");

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
});

function limparCampos(){
    $("#nome").removeClass("campo_vazio").val("");
    $("#data_nascimento").removeClass("campo_vazio").val("");
    $("#cpf").removeClass("campo_vazio").val("");
    $("#rg").removeClass("campo_vazio").val("");
    $("#telefone").removeClass("campo_vazio").val("");
    $("#idcliente").removeClass("campo_vazio").val("");
}