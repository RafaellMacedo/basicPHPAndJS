<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Teste Kabum</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/sb-admin.css" rel="stylesheet">
    <link href="css/plugins/morris.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

</head>
<style type="text/css">
    #page-wrapper{
        width: 50%;
        margin-top:20%;
        margin-left:20%;
    }
</style>

<body>

    <div id="wrapper">
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="navbar-header">
                <a class="navbar-brand" href="index.php">Teste Kabum</a>
            </div>
        </nav>

        <div id="page-wrapper">
            
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <form role="form">
                            <div class="form-group">
                                <label>Login</label>
                                <input name="login" id="login" class="form-control" value="">
                                <a href="#">Esqueci a senha</a>
                            </div>
                            <div class="form-group">
                                <label>Senha</label>
                                <input type="password" min="6" name="pass" id="pass" class="form-control" placeholder="" value="">
                            </div>
                            <button type="button" class="btn btn-default btn-success" id="btn_login">Acessar Sistema</button>
                            <button type="button" class="btn btn-default btn-primary" id="btn_cadastro">Cadastrar</button>
                        </form>
                    </div>
                </div>
                <div class="row cadastro">
                    <div class="col-lg-12">
                        <form role="form">
                            <div class="form-group">
                                <div style="display:none;" class="mensagem_erro alert alert-danger" role="alert"></div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/plugins/morris/raphael.min.js"></script>
    <script src="js/plugins/morris/morris.min.js"></script>
    <script src="js/plugins/morris/morris-data.js"></script>
    <script src="js/jquery-3.0.0.min.js"></script>
    <script type="text/javascript">
        $("#btn_login").click(function(){
            var login = $("#login").val();
            var pass = $("#pass").val();
            $(".mensagem_erro").hide();
            $(".mensagem_erro").html("");

            if(login == "" || pass == ""){
                $(".mensagem_erro").show();
                $(".mensagem_erro").append("Preencha todos os campos");

            }else{
                $.ajax({
                    url: "data/administradorTable.php",
                    type: "POST",
                    data: {
                        action: "select",
                        login: login,
                        pass: pass,
                        logar: true
                    }
                }).done(function(data) {
                    data = JSON.parse(data);

                    if(data.success == true){
                        window.location = "index.php";
                    }else{
                        $(".mensagem_erro").show();
                        $(".mensagem_erro").append("Login ou senha inválido!");
                        
                    }
                });
            }
        });

        $("#btn_cadastro").on("click", function(){
            window.location = "cadastroadministrador.php";
        });
    </script>
    <style type="text/css">
        .cadastro {
            margin-top: 1%;
        }
    </style>
</body>
</html>