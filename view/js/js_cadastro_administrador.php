<script>
        $(document).ready(function(){
            $("#btCancelar").on("click",function(){
                window.location = "login.php";
            });
            $("#btSalvar").on("click",function(){
                let nome = $("#nome").val();
                let login = $("#login").val();
                let senha = $("#senha").val();
                let confirmar_senha = $("#confirmar_senha").val();
                let erro = false;
                $("#btSalvar").html("Salvando...").prop('disabled', true);
                $("#btCancel").prop('disabled', true);

                if(nome.length == 0){
                    $("#nome").addClass("campo_vazio");
                    erro = true;
                }

                if(login.length == 0){
                    $("#login").addClass("campo_vazio");
                    erro = true;
                }

                if(senha.length == 0){
                    $("#senha").addClass("campo_vazio");
                    erro = true;
                }

                if(confirmar_senha.length == 0){
                    $("#confirmar_senha").addClass("campo_vazio");
                    erro = true;
                }

                if(erro == true){
                    $("div.mensagem").addClass("alert-danger").html("<h4>Preencha todos os campos</h4>").show();
                    $("#btSalvar").html("Salvar").prop('disabled', false);
                    $("#btCancel").prop('disabled', false);
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
    							setTimeout(function(){
                                    window.location = "index.php";
                                }, 3000);
    						}else{
                                mensagem("alert-danger","Erro ao cadastrar!");
                            }
    					});

                    } else {
                        mensagem("alert-danger","Senhas diferentes");
                    }
                }
            });

            $("#confirmar_senha").on('keyup',function(){
                // let 
            });

            function mensagem(tipo, mensagem){
                $("div.mensagem").removeClass("alert-danger alert-success").html("").hide();
                $("div.mensagem").addClass(tipo).html("<h4>" + mensagem + "</h4>").show();
            }
        });
    </script>