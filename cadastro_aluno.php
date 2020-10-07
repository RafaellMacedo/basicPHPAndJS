<?php
include "resources/layout/header.php"
?>
<body>
    <div id="wrapper">
        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <?php
            include "resources/layout/menu.php";
            ?>
        </nav>

        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Cadastro Cliente
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.php">Home</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-edit"></i> Cadastro de Aluno
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="mensagem alert"></div>
                    <div class="col-lg-6">

                        <form role="form">

                            <input type="hidden" name="idaluno" id="idaluno" value=""/>

                            <div class="form-group">
                                <label>Nome</label>
                                <input class="form-control" name="nome" id="nome" placeholder="Informe o primeiro Nome">
                            </div>

                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label>Idade</label>
                                    <input class="form-control" name="idade" id="idade" maxlength="2">
                                </div>
                            </div>

                            <div class="col-lg-5">
                                <div class="form-group">
                                    <label>Sexo</label>
                                    <select class="form-control" name="sexo" id="sexo">
                                        <option value="">Selecione</option>
                                        <option value="feminino">Feminino</option>
                                        <option value="masculino">Masculino</option>
                                    </select>
                                </div>
                            </div>

                        </form>
                    </div>
                    <div class="col-lg-6">

                        <form role="form">

                            <div class="form-group">
                                <label>E-mail</label>
                                <input class="form-control" name="email" id="email" placeholder="Informe seu e-mail" type="email">
                            </div>

                            <div class="form-group">
                                <label>Curso</label>
								<select class="form-control" name="curso" id="curso">
                                    <option value="">Selecione</option>
                                    <option value=1>Ciência da Computação</option>
                                    <option value=2>Administração</option>
                                </select>
                            </div>

                        </form>
                    </div>

                    <div class="col-lg-6">

                        <form role="form">
                            <button type="button" class="btn btn-success" id="btSalvar">Salvar</button>
                        </form>
                    </div>
                    
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-12">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Nome</th>
                                        <th>Idade</th>
                                        <th>Sexo</th>
                                        <th>E-mail</th>
                                        <th>Curso</th>
                                        <th>Ação</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
    <?php include "view/js/js_cadastro_aluno.php"; ?>
    </body>
</html>