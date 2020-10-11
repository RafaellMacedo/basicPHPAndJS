<?php
include "resources/layout/header.php";

$nome_tela = "Cliente";
?>
<body>
    <div id="wrapper">
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <?php include "resources/layout/menu.php"; ?>
        </nav>
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header"><?=$nome_tela;?></h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i><a href="index.php">Home</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-edit"></i><?=$nome_tela?>
                            </li>
                        </ol>
                    </div>
                </div>
                <div class="row">
                    <div class="mensagem alert"></div>
                    <div class="col-lg-6">
                        <input type="hidden" name="idcliente" id="idcliente" value=""/>
                        <div class="form-group">
                            <label>Nome</label>
                            <input type="text" class="form-control" name="nome" id="nome" placeholder="Informe o primeiro Nome">
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label>CPF</label>
                            <input type="text" class="form-control" name="cpf" id="cpf" placeholder="Informe seu CPF">
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label>Data de Nascimento</label>
                            <input type="date" class="form-control" name="data_nascimento" id="data_nascimento">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label>RG</label>
                            <input type="text" class="form-control" name="rg" id="rg" placeholder="Informe seu RG">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label>Telefone</label>
                            <input type="text" class="form-control" name="telefone" id="telefone" placeholder="Informe seu Telefone">
                        </div>
                    </div>
                    <div class="col-lg-2 btn-position">
                        <div class="form-group">
                            <button type="button" class="btn btn-danger" id="btCancelar">Cancelar</button>
                        </div>
                    </div>
                    <div class="col-lg-1 btn-position">
                        <div class="form-group">
                            <button type="button" class="btn btn-success" id="btSalvar">Salvar</button>
                        </div>
                    </div>
                </div>
                <div class="row">
                </div>
                <div class="row table-space">
                    <div class="col-lg-12">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th style="width: 30%;">Nome</th>
                                        <th>Data de Nascimento</th>
                                        <th>CPF</th>
                                        <th>RG</th>
                                        <th>Telefone</th>
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
        </div>
    </div>

    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/mask.min.js"></script>
    <!-- Neste arquivo contém os métodos que podem ser utilizados em outras telas -->
    <script src="js/view/metodo.js"></script>
    <script src="js/view/jsCliente.js"></script>
    </body>
    <style type="text/css">
        .mensagem {
            display: none;
        }

        .table-space {
            margin-top: 3%;
        }

        .btn-position {
            float: right;
            margin-top: 2.5%;
        }

        .campo_vazio {
            border-color: red;
            color: red;
        }

        .btn-Editar {
            margin-right: 2%;
        }

        .tr-success {
            color: #3c763d;
            background-color: #dff0d8;
            border-color: #d6e9c6;
        }
    </style>
</html>