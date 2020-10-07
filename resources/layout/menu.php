<?php
if(!isset($_SESSION)){
    session_start();
}
?>
    <div class="navbar-header">
        <!-- <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button> -->
        <a class="navbar-brand" href="index.php">Teste Kabum</a>
    </div>
    <div class="collapse navbar-collapse navbar-ex1-collapse">
        <ul class="nav navbar-nav side-nav">
            <?php if($_SESSION["login"]){
                ?>
                <li class="home active">
                    <a href="perfil.php"><i class="fa fa-fw fa-dashboard"></i>Perfil</a>
                </li>
                <li class="cadastro">
                    <a href="javascript:;" data-toggle="collapse" data-target="#demo"><i class="fa fa-fw fa-arrows-v"></i>Cliente<i class="fa fa-fw fa-caret-down"></i></a>
                    <ul id="demo" class="collapse">
                        <li class="cadastro_aluno">
                            <a href="cadastro_aluno.php">Aluno</a>
                        </li>
                    </ul>
                </li>
                <li class="home active">
                    <a href="cliente.php"><i class="fa fa-fw fa-dashboard"></i>cliente</a>
                </li>
                <?php
            }
            ?>
            <li>
                <a href="data/logout.php"><i class="fa fa-fw fa-dashboard"></i>Sair</a>
            </li>
        </ul>
    </div>
