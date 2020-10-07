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
                            Lista dos Alunos da Turma A
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.php">Home</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-edit"></i> Lista dos Alunos da Turma A
                            </li>
                        </ol>
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
    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>


    <script>
        $(document).ready(function(){
            $("li").removeClass("active");
            $("li.cadastro").addClass("active");

            function consultaAluno(){
                 $.ajax({
                    url: "data/alunoTable.php",
                    type: "POST",
                    data: {
                        action: "select"
                    }
                }).done(function(result) {
                    result = JSON.parse(result);
                    console.log(result.data);

                    $.each(result.data, function(index, value){

                        var count = $("table > tbody > tr").length;
                        count++;
                        
                        var tr = '<tr id="aluno_' + count + '">';
                        tr += '<td id="nome_' + count + '" data-nome="' + value.nome + '">' + value.nome + '</td>';
                        tr += '<td id="idade_' + count + '" data-idade="' + value.idade + '">' + value.idade + '</td>';
                        tr += '<td id="sexo_' + count + '" data-sexo="' + value.sexo + '">' + value.sexo + '</td>';
                        tr += '<td id="email_' + count + '" data-email="' + value.email + '">' + value.email + '</td>';
                        tr += '<td id="curso_' + count + '" data-curso="' + value.curso + '">' + value.curso + '</td>';
                        tr += '<td style="width:16%">';
                        tr += '</td>';
                        tr += '</tr>';

                        $("table > tbody").append(tr);
                    });
                });
            }
            
            consultaAluno();
        });

    </script>

    </body>
</html>