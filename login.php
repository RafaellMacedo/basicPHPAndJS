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
<body>
    <div id="wrapper">
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="navbar-header">
                <a class="navbar-brand" href="index.php">Teste Kabum</a>
            </div>
        </nav>
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="mensagem_erro alert alert-danger" role="alert"></div>
                <div class="row">
                    <div class="col-lg-12">
                        <form role="form">
                            <div class="form-group">
                                <label>Login</label>
                                <input name="login" id="login" class="form-control" value="">
                                <a href="recuperar_senha.php">Esqueci a senha</a>
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
            </div>
        </div>
    </div>
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery-3.0.0.min.js"></script>
    <script src="js/view/jsLogin.js"></script>
    <style type="text/css">
        #page-wrapper{
            width: 50%;
            margin-top:20%;
            margin-left:20%;
        }

        .mensagem_erro {
            display: none;
        }
    </style>
</body>
</html>