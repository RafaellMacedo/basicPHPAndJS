<?php
if(!isset($_SESSION)){
    session_start();
}
?>
    <div class="navbar-header">
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
