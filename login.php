<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Projeto Framework</title>

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
        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <a class="navbar-brand" href="index.php">Projeto Framework</a>
            </div>
        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">

                <div class="row">
                    <div class="col-lg-12">
                        
                        <form role="form">
                            <span style="display:none;" class="mensagem_erro label label-danger"></span>
                            <div class="form-group">
                                <label>Login</label>
                                <input name="login" id="login" class="form-control" value="">
                            </div>

                            <div class="form-group">
                                <label>Senha</label>
                                <input type="password" min="6" name="pass" id="pass" class="form-control" placeholder="" value="">
                            </div>

                            <button type="button" class="btn btn-default" id="btn_login">Login</button>
                            <a href="#">Esqueci a senha</a>

                        </form>
                    </div>
                </div>
                <!-- row -->

            </div>
            <!-- container-fluid -->

        </div>
        <!-- page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Morris Charts JavaScript -->
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
                    url: "data/loginTable.php",
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
                        // $(".mensagem_erro").show();
                        // $(".mensagem_erro").append("Login ou senha inválido!");
                        // $(".mensagem_erro").append("Usuário não registrado, você só tem permissão de visualizar a lista de aluno!");
                        // setTimeout(function(){window.location = "lista.php";}, 3000);
                        
                    }
                });
            }
        });
    </script>
</body>
</html>