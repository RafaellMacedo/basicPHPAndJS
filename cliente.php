<?php
include "resources/layout/header.php";

$nome_tela = "Cliente";
$active_menu = "cliente";
?>
<link href="css/view/cssCliente.css" rel="stylesheet" type="text/css">
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
                <span class="group-cliente rounded">
                    <div class="row">
                        <div class="mensagem alert"></div>
                        <div class="col-lg-6">
                            <input type="hidden" name="idcliente" id="idcliente" value=""/>
                            <div class="form-group">
                                <label>Nome</label><span class="obrigatorio">*</span>
                                <input type="text" class="form-control" name="nome" id="nome" placeholder="Informe o primeiro Nome">
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label>CPF</label><span class="obrigatorio">*</span>
                                <input type="text" class="form-control" name="cpf" id="cpf" placeholder="Informe seu CPF">
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label>Data de Nascimento</label><span class="obrigatorio">*</span>
                                <input type="date" class="form-control" name="data_nascimento" id="data_nascimento">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>RG</label><span class="obrigatorio">*</span>
                                <input type="text" class="form-control" name="rg" id="rg" placeholder="Informe seu RG">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Telefone</label><span class="obrigatorio">*</span>
                                <input type="text" class="form-control" name="telefone" id="telefone" placeholder="Informe seu Telefone">
                            </div>
                        </div>
                    </div>
                    <span class="group-endereco">
                        <div class="row">
                            <div class="col-lg-2">
                            <input type="hidden" name="idendereco" id="idendereco" value=""/>
                                <div class="form-group">
                                    <label>CEP</label><span class="obrigatorio">*</span>
                                    <input type="text" class="form-control" name="cep" id="cep" placeholder="Informe o CEP">
                                </div>
                            </div>
                            <div class="col-lg-2 btn-position-left">
                                <div class="form-group">
                                    <button type="button" class="btn btn-primary" id="btConsultarCEP">Buscar Endereço</button>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Referência </label>
                                    <input type="text" class="form-control" name="referencia" id="referencia" placeholder="Informe um nome que representa o endereço">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Endereço</label>
                                    <input type="text" class="form-control" name="endereco" id="endereco" disabled>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label>Número</label><span class="obrigatorio">*</span>
                                    <input type="text" class="form-control" name="numero" id="numero" placeholder="Informe o número">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label>Complemento</label>
                                    <input type="text" class="form-control" name="complemento" id="complemento" placeholder="Informe o seu Complemento">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Bairro</label>
                                    <input type="text" class="form-control" name="bairro" id="bairro" disabled>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label>Estado</label>
                                    <select class="form-control" id="estado" disabled>
                                        <option value=""></option>
                                        <option value="AC">AC</option>
                                        <option value="AL">AL</option>
                                        <option value="AP">AP</option>
                                        <option value="AM">AM</option>
                                        <option value="BA">BA</option>
                                        <option value="CE">CE</option>
                                        <option value="DF">DF</option>
                                        <option value="ES">ES</option>
                                        <option value="GO">GO</option>
                                        <option value="MA">MA</option>
                                        <option value="MT">MT</option>
                                        <option value="MS">MS</option>
                                        <option value="MG">MG</option>
                                        <option value="PA">PA</option>
                                        <option value="PB">PB</option>
                                        <option value="PR">PR</option>
                                        <option value="PE">PE</option>
                                        <option value="PI">PI</option>
                                        <option value="RJ">RJ</option>
                                        <option value="RN">RN</option>
                                        <option value="RS">RS</option>
                                        <option value="RO">RO</option>
                                        <option value="RR">RR</option>
                                        <option value="SC">SC</option>
                                        <option value="SP">SP</option>
                                        <option value="SE">SE</option>
                                        <option value="TO">TO</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>Cidade</label>
                                    <select class="form-control" id="cidade" disabled>
                                        <option></option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <button type="button" class="btn btn-success" id="btAddEndereco">Adicionar Endereço</button>
                                    <button type="button" class="btn btn-danger" id="btCancelarEndereco">Cancelar</button>
                                </div>
                            </div>
                        </div>
                        <div class="row table-space">
                            <div class="col-lg-12">
                                <div class="table-responsive">
                                    <table class="table table-hover table-endereco">
                                        <thead>
                                            <tr>
                                                <th class="column-11">cep</th>
                                                <th>Referência</th>
                                                <th class="column-30">Endereço</th>
                                                <th>Número</th>
                                                <th>Complemento</th>
                                                <th class="column-30">Bairro</th>
                                                <th>Estado</th>
                                                <th>Cidade</th>
                                                <th>Ação</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </span>
                    <div class="col-lg-2 btn-position-right">
                        <div class="form-group">
                            <button type="button" class="btn btn-danger" id="btCancelar">Cancelar</button>
                        </div>
                    </div>
                    <div class="col-lg-1 btn-position-right">
                        <div class="form-group">
                            <button type="button" class="btn btn-success" id="btSalvar">Salvar Cliente</button>
                        </div>
                    </div>
                </span>
                <div class="row table-space">
                    <div class="col-lg-12">
                        <div class="table-responsive">
                            <div class="mensagem-table alert"></div>
                            <table class="table table-hover table-cliente">
                                <thead>
                                    <tr>
                                        <th class="column-30">Nome</th>
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
    <script src="js/view/jsEndereco.js"></script>
    </body>
</html>