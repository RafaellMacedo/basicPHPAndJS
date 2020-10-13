$(document).ready(function(){
    $("#btCancelar").on("click",function(){
        window.location = "login.php";
    });

    $("#btConsultarLogin").on("click",function(){
        let nome = $("#nome").val();
        let login = $("#login").val();
        let erro = false;
        $("#btConsultarLogin").html("Consultando...").prop('disabled', true);
        limparMensagem();
        removerCSS();

        erro = campoVazio("nome", nome);
        erro = campoVazio("login", login);

        if(erro == true){
            mensagem("alert-danger","Preencha todos os campos");
            habilitarBotao();

        }else{
			$.ajax({
				url: "data/administradorTable.php",
				type: "POST",
				data: {
					action: "recuperarSenha",
					nome: nome,
					login: login
				}
			}).done(function(data) {
				data = JSON.parse(data);

				if(data.success == true){
                    mensagem("alert-warning","Informe uma nova senha!");

                    habilitarBotao();

                    $("#idadministrador").val(data.idadministrador);
                    $("#senha").prop("disabled", false).focus();
                    $("#confirmar_senha").prop("disabled", false);
                    $("#btSalvarSenha").prop("disabled", false);
				}else{
                    mensagem("alert-danger","Nome e Login não encontrado!");
                    habilitarBotao();
                }
			});
        }
    });

    $("#btSalvarSenha").on("click",function(){
        let idadministrador = $("#idadministrador").val();
        let nome = $("#nome").val();
        let login = $("#login").val();
        let senha = $("#senha").val();
        let confirmar_senha = $("#confirmar_senha").val();
        let erro = false;
        $("#btSalvarSenha").html("Salvando...").prop('disabled', true);
        limparMensagem();

        removerCSS();

        erro = campoVazio("nome", nome);
        erro = campoVazio("login", login);
        erro = campoVazio("senha", senha);
        erro = campoVazio("confirmar_senha", confirmar_senha);

        if(erro == true){
            mensagem("alert-danger","Preencha todos os campos");
            habilitarBotao();

        }else{
            if(senha.length < 6){
                mensagem("alert-danger","Senha não pode ser menor que 6 caracteres!");
                $("#senha").addClass("alert-danger").val("");
                $("#confirmar_senha").addClass("alert-danger").val("");
                $("#btSalvarSenha").html("Salvar Nova Senha").prop("disabled", false);

            } else if(senha == confirmar_senha){

                $.ajax({
                    url: "data/administradorTable.php",
                    type: "POST",
                    data: {
                        action: "update",
                        idadministrador: idadministrador,
                        nome: nome,
                        login: login,
                        senha: senha,
                    }
                }).done(function(data) {
                    data = JSON.parse(data);

                    if(data.success == true){
                        mensagem("alert-success","Nova senha cadastrada com Sucesso! Redirecionando para página de login!");

                        $("#btSalvarSenha").html("Salvar Nova Senha").prop("disabled", true);

                        setTimeout(function(){
                            window.location = "index.php";
                        }, 3000);
                    }else{
                        if(data.mensagem != ""){
                            mensagem("alert-danger",data.mensagem);

                        } else {
                            mensagem("alert-danger","Erro ao cadastrar!");
                        }
                        $("#btSalvarSenha").html("Salvar Nova Senha").prop("disabled", false);
                    }
                });

            } else {
                mensagem("alert-danger","Senhas diferentes!");
                $("#senha").addClass("alert-danger");
                $("#confirmar_senha").addClass("alert-danger");
                $("#btSalvarSenha").html("Salvar Nova Senha").prop("disabled", false);
            }
        }
    });

    $("#senha").on("focusout", function(){
        let senha = this.value;
        $("#senha").removeClass("alert-danger alert-success");
        limparMensagem();

        if(senha.length < 6){
            $("#senha").addClass("alert-danger");
        } else {
            $("#senha").addClass("alert-success");

            setTimeout(function(){
                $("#senha").removeClass("alert-danger alert-success");
            }, 2000);
        }
    });

    $("#confirmar_senha").on("keyup", function(){
        let confirmar_senha = this.value;
        let senha = $("#senha").val();
        $("#confirmar_senha").removeClass("alert-danger alert-success");
        limparMensagem();

        console.log('senha', senha);
        console.log('confirmar_senha', confirmar_senha);
        if(senha != confirmar_senha){
            $("#confirmar_senha").addClass("alert-danger");
        } else {
            $("#senha").addClass("alert-success");
            $("#confirmar_senha").addClass("alert-success");

            setTimeout(function(){
                $("#senha").removeClass("alert-danger alert-success");
                $("#confirmar_senha").removeClass("alert-danger alert-success");
            }, 2000);
        }
    });

    function habilitarBotao(){
        $("#btConsultarLogin").html("Consultar Login").prop('disabled', false);
    }

    function removerCSS(){
        $("#nome").removeClass("campo_vazio");
        $("#login").removeClass("campo_vazio");
        $("#senha").removeClass("campo_vazio");
        $("#confirmar_senha").removeClass("campo_vazio");
    }

    function limparMensagem(){
        $("div.mensagem").removeClass("alert-danger alert-success alert-warning").html("").hide();
    }
});