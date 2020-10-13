$(document).ready(function(){
    $("#cep").mask('00000-000');

    $("#btConsultarCEP").on("click", function(){
        let cep = $("#cep").val();

        if(cep.length > 8){
            cep = cep.replace("-","");
        }

        let url = "https://viacep.com.br/ws/" + cep + "/json/";

        $.ajax({
            url: url,
            type: "GET"
        }).done(function(data) {
            $("#endereco").val(data.logradouro);
            $("#bairro").val(data.bairro);
            $('#estado option').removeAttr('selected').filter('[value='+ data.uf +']').prop('selected', true);
            $("#cidade").html("<option value='" + data.localidade + "'>" + data.localidade + "</option>");
            $("#numero").focus();
        });
    });

    $("#btAddEndereco").on("click",function(){
        let idendereco  = $("#idendereco").val();
        let idcliente   = $("#idcliente").val();
        let cep         = $("#cep").val();
        let referencia  = $("#referencia").val();
        let endereco    = $("#endereco").val();
        let numero      = $("#numero").val();
        let complemento = $("#complemento").val();
        let bairro      = $("#bairro").val();
        let estado      = $("#estado").val();
        let cidade      = $("#cidade").val();
        let erro        = false;

        removerCSSEndereco();

        erro = campoVazio("cep", cep);
        erro = campoVazio("endereco", endereco) ? true : erro;
        erro = campoVazio("numero", numero) ? true : erro;
        erro = campoVazio("bairro", bairro) ? true : erro;
        erro = campoVazio("estado", estado) ? true : erro;
        erro = campoVazio("cidade", cidade) ? true : erro;

        if(erro == true){
            mensagem("alert-danger","Preencha todos os campos");

        }else{
            let action = "insert";

            if(idendereco != ""){
                action = "update";
            }

            if(idcliente != ""){
                $.ajax({
                    url: "data/enderecoTable.php",
                    type: "POST",
                    data: {
                        action: action,
                        idendereco: idendereco,
                        idcliente: idcliente,
                        cep: cep,
                        referencia: referencia,
                        endereco: endereco,
                        numero: numero,
                        complemento: complemento,
                        bairro: bairro,
                        estado: estado,
                        cidade: cidade,
                    }
                }).done(function(data) {
                    data = JSON.parse(data);

                    if(data.success == true){
                        mensagem("alert-success", "Registro salvo com sucesso!");

                        idendereco = idendereco == "" ? data.idendereco : idendereco;
                        enderecoTable(idendereco, action);

                    }else{
                        mensagem("alert-danger","Erro ao salvar as informações do cliente!");
                    }
                });

            } else {
                /*
                    QUANDO FOR UM CLIENTE NOVO, SERÁ ADICIONADO OS ENDEREÇOS DIRETO NO HTML,
                    PARA DEPOIS SALVAR NO BANCO DE DADOS
                */
                if(action == "insert"){
                    idendereco = $(".table-endereco > tbody > tr").length + 1;
                }

                enderecoTable(idendereco, action);
            }
        }
    });

    $(document).on("click","button.btEditarEndereco",function(){
        limparEndereco();
        let idendereco = this.id.replace(/[^\d]+/g,'');
        $("div.mensagem").removeClass("alert-danger", "alert-success").html("").hide();

        getTableDado("endereco", idendereco, "cep");
        getTableDado("endereco", idendereco, "referencia");
        getTableDado("endereco", idendereco, "endereco");
        getTableDado("endereco", idendereco, "numero");
        getTableDado("endereco", idendereco, "complemento");
        getTableDado("endereco", idendereco, "bairro");
        getTableDado("endereco", idendereco, "estado");

        getTableDadoSelect("endereco", idendereco, "cidade");

        $("#idendereco").val(idendereco);
    });

    $(document).on("click","button.btDeletarEndereco",function(){
        let idendereco = this.id.replace(/[^\d]+/g,'');
        let idcliente = $("#idcliente").val();

        if(confirm("Deseja realmente remover este endereço?")){
            if(idcliente != ""){
    			$.ajax({
    				url: "data/enderecoTable.php",
    				type: "POST",
    				data: {
    					action: "delete",
    					idendereco: idendereco,
                        idcliente: idcliente
    				}
    			}).done(function(data) {
    				data = JSON.parse(data);

    				if(data.success == true){
                        removerEndereco(idendereco);
    				}else{
                        mensagem("alert-danger","Não foi possivel remover o endereço");
    				}
    			});

            } else {
                removerEndereco(idendereco);
            }

            $("#endereco_"+idendereco).remove();
        }
    });

    $("#btCancelarEndereco").on("click", function(){
        limparEndereco();
        $("div.mensagem").removeClass("alert-danger", "alert-success").html("").hide();
    });

});

function limparEndereco(){
    $("#idendereco").val("");
    $("#cep").removeClass("campo_vazio").val("");
    $("#referencia").removeClass("campo_vazio").val("");
    $("#endereco").removeClass("campo_vazio").val("");
    $("#numero").removeClass("campo_vazio").val("");
    $("#complemento").removeClass("campo_vazio").val("");
    $("#bairro").removeClass("campo_vazio").val("");
    $("#estado").removeClass("campo_vazio").val("");
    $("#cidade").removeClass("campo_vazio").val("");
}

function removerCSSEndereco(){
    $("#cep").removeClass("campo_vazio");
    $("#referencia").removeClass("campo_vazio");
    $("#endereco").removeClass("campo_vazio");
    $("#numero").removeClass("campo_vazio");
    $("#complemento").removeClass("campo_vazio");
    $("#bairro").removeClass("campo_vazio");
    $("#estado").removeClass("campo_vazio");
    $("#cidade").removeClass("campo_vazio");
}

function removerEndereco(idendereco){
    setTimeout(function(){
        $(".table-endereco > tbody > tr[id=endereco_" + idendereco + "]").remove();
        mensagem("alert-success","Removido <b>Endereço</b> com sucesso!");
    }, 2000);
}

function enderecoTable(idendereco, action){
    let cep         = $("#cep").val();
    let referencia  = $("#referencia").val();
    let endereco    = $("#endereco").val();
    let numero      = $("#numero").val();
    let complemento = $("#complemento").val();
    let bairro      = $("#bairro").val();
    let estado      = $("#estado").val();
    let cidade      = $("#cidade").val();

    let tr = '';

    tr += setTableColumn(idendereco, "cep", cep);
    tr += setTableColumn(idendereco, "referencia", referencia);
    tr += setTableColumn(idendereco, "endereco", endereco);
    tr += setTableColumn(idendereco, "numero", numero);
    tr += setTableColumn(idendereco, "complemento", complemento);
    tr += setTableColumn(idendereco, "bairro", bairro);
    tr += setTableColumn(idendereco, "estado", estado);
    tr += setTableColumn(idendereco, "cidade", cidade);

    tr += '<td style="width:16%">';

    tr += setTableButton(idendereco, "Editar", "EditarEndereco", "primary");
    tr += setTableButton(idendereco, "Deletar", "DeletarEndereco", "danger");

    tr += '</td>';

    if(action == "insert"){
        tr = '<tr id="endereco_' + idendereco + '">' + tr + '</tr>';
        $(".table-endereco > tbody").append(tr);

    } else {
        $(".table-endereco > tbody > tr[id=endereco_" + idendereco + "]").html(tr).addClass("tr-success");
    }

    limparEndereco();

    setTimeout(function(){
        $("div.mensagem").removeClass("alert-danger", "alert-success").html("").hide();
        $(".table-endereco > tbody > tr[id=endereco_" + idendereco + "]").removeClass("tr-success");
    }, 2000);
}