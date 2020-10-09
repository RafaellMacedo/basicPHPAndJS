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

                }else{
                    if(senha == confirmar_senha){

    					$.ajax({
    						url: "data/administradorTable.php",
    						type: "POST",
    						data: {
    							action: "inserir",
    							nome: nome,
    							login: login,
    							senha: senha,
    						}
    					}).done(function(data) {
    						data = JSON.parse(data);

    						if(data.success == true){
    							$("div.mensagem").addClass("alert-success").html("<h4>Cadastrado com sucesso!</h4>").show();
    							setTimeout(function(){
                                    window.location = "index.php";
                                }, 3000);
    						}else{
    							$(".mensagem_erro").show();
    							$(".mensagem_erro").append("Erro ao cadastrar!");
                            }
    					});

                    } else {
                        $("div.mensagem").addClass("alert-danger").html("<h4>Senhas diferentes</h4>").show();
                    }
                }
            });

            $("#confirmar_senha").on('keyup',function(){
                // let 
            });
        });
    </script>