$(document).ready(function(){
    $("#btCancelar").on("click",function(){
        window.location = "login.php";
    });

    $("#btCadastrar").on("click",function(){
        let nome = $("#nome").val();
        let login = $("#login").val();
        let senha = $("#senha").val();
        let confirmar_senha = $("#confirmar_senha").val();
        let erro = false;
        $("#btCadastrar").html("Cadastrando...").prop('disabled', true);
        $("#btCancel").prop('disabled', true);

        erro = campoVazio("nome", nome);
        erro = campoVazio("login", login);
        erro = campoVazio("senha", senha);
        erro = campoVazio("confirmar_senha", confirmar_senha);

        if(erro == true){
            mensagem("alert-danger","Preencha todos os campos");
            habilitarBotao();

        }else{
            if(senha == confirmar_senha){

				$.ajax({
					url: "data/administradorTable.php",
					type: "POST",
					data: {
						action: "insert",
						nome: nome,
						login: login,
						senha: senha,
					}
				}).done(function(data) {
					data = JSON.parse(data);

					if(data.success == true){
                        mensagem("alert-success","Cadastrado com sucesso! Redirecionando para página de login!");

                        $("#btCadastrar").html("Cadastrado");

						setTimeout(function(){
                            window.location = "index.php";
                        }, 3000);
					}else{
                        mensagem("alert-danger","Erro ao cadastrar!");
                        habilitarBotao();
                    }
				});

            } else {
                mensagem("alert-danger","Senhas diferentes");
                habilitarBotao();
            }
        }
    });

    function habilitarBotao(){
        $("#btCadastrar").html("Cadastrar").prop('disabled', false);
        $("#btCancel").prop('disabled', false);
    }
});