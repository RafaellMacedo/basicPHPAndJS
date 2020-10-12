<?php
if(!isset($_SESSION)){
    session_start();
}

switch ($active_menu) {
    case 'home':
        $home = "home active";
        break;
    case 'cliente':
        $cliente = "cliente active";
        break;
    default:
        $home = "home active";
        break;
}
?>
<div class="navbar-header">
    <a class="navbar-brand" href="index.php">Teste Kabum</a>
</div>
<div class="collapse navbar-collapse navbar-ex1-collapse">
    <ul class="nav navbar-nav side-nav">
        <?php if($_SESSION["login"]){
            ?>
            <li class="<?=$home?>">
                <a href="index.php"><i class="fa fa-fw fa-dashboard"></i>Home</a>
            </li>
            <li class="<?=$cliente?>">
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