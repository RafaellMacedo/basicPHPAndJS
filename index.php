<?php
session_start();

if(!isset($_SESSION["login"])){
    header("Location:login.php");
}
include "resources/layout/header.php"

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
                        <h4 class="page-header">
                            Aluno
                        </h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include "resources/js/lib.php"; ?>
</body>
</html>
