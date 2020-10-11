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
        width: 80%;
        margin: auto;
    }
</style>
<body>
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Cadastro Administrador</h1>
                </div>
            </div>

            <div class="row">
                <div class="mensagem alert"></div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <form role="form">
                        <div class="form-group">
                            <label>Nome</label><span class="obrigatorio">*</span>
                            <input class="form-control" name="nome" id="nome" placeholder="Informe o primeiro Nome">
                        </div>
                    </form>
                </div>
                <div class="col-lg-6">
                    <form role="form">
                        <div class="form-group">
                            <label>Login</label><span class="obrigatorio">*</span>
                            <input type="text" class="form-control" name="login" id="login" placeholder="Informe seu login">
                        </div>
                    </form>
                </div>

            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>Senha</label><span class="obrigatorio">*</span>
                        <input type="password" class="form-control" name="senha" id="senha" minlength="6">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>Confirmar Senha</label><span class="obrigatorio">*</span>
                        <input type="password" class="form-control" name="confirmar_senha" id="confirmar_senha" minlength="6">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <form role="form">
                        <button type="button" class="btn btn-success" id="btCadastrar">Cadastrar</button>
                        <button type="button" class="btn btn-danger" id="btCancelar">Cancelar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <!-- Neste arquivo contém os métodos que podem ser utilizados em outras telas -->
    <script src="js/view/metodo.js"></script>
    <script src="js/view/jsAdministrador.js"></script>
    </body>
    <style type="text/css">
        .obrigatorio {
            color: red;
        }

        .campo_vazio {
            border-color: red;
            color: red;
        }
    </style>
</html>