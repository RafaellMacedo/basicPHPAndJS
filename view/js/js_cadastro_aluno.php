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

                        //var count = $("table > tbody > tr").length;
                        //count++;
                        
                        var tr = '<tr id="aluno_' + value.idaluno + '">';
                        tr += '<td id="nome_' + value.idaluno + '" data-nome="' + value.nome + '">' + value.nome + '</td>';
                        tr += '<td id="idade_' + value.idaluno + '" data-idade="' + value.idade + '">' + value.idade + '</td>';
                        tr += '<td id="sexo_' + value.idaluno + '" data-sexo="' + value.sexo + '">' + value.sexo + '</td>';
                        tr += '<td id="email_' + value.idaluno + '" data-email="' + value.email + '">' + value.email + '</td>';
                        tr += '<td id="curso_' + value.idaluno + '" data-curso="' + value.idcurso + '">' + value.curso + '</td>';
                        tr += '<td style="width:16%">';
                        tr += '<button type="button" class="btn btn-primary btEditar" id="btEditar_' + value.idaluno + '">Editar</button>';
                        tr += '<button type="button" class="btn btn-danger btDeletar" id="btDeletar_' + value.idaluno + '">Deletar</button>';
                        tr += '</td>';
                        tr += '</tr>';

                        $("table > tbody").append(tr);
                    });
                });
            }
            
            consultaAluno();

            $("#btSalvar").on("click",function(){
                limparCampos();
                var idaluno = $("#idaluno").val();
                var nome    = $("#nome").val();
                var idade   = $("#idade").val();
                var sexo    = $("#sexo").val();
                var email   = $("#email").val();
                var curso   = $("#curso").val();
				var erro = false;

                if(nome.length == 0){
                    $("#nome").css("border-color","red");
                    $("#nome").css("color","red");
                    erro = true;
                }

                if(idade.length == 0){
                    $("#idade").css("border-color","red");
                    $("#idade").css("color","red");
                    erro = true;
                }

                if(sexo.length == 0){
                    $("#sexo").css("border-color","red");
                    $("#sexo").css("color","red");
                    erro = true;
                }
                
                if(email.length == 0){
                    $("#email").css("border-color","red");
                    $("#email").css("color","red");
                    erro = true;
                }

                if(curso.length == 0){
                    $("#curso").css("border-color","red");
                    $("#curso").css("color","red");
                    erro = true;
                }

                if(erro == true){
                    $("div.mensagem").addClass("alert-danger").html("<h4>Preencha todos os campos</h4>").show();
                }else{
				    if(idaluno.length == 0){
				        //var count = $("table > tbody > tr").length;
                        //count++;
						
						$.ajax({
							url: "data/alunoTable.php",
							type: "POST",
							data: {
								action: "inserir",
								nome: nome,
								email: email,
								idade: idade,
								sexo: sexo,
								idcurso: curso
							}
						}).done(function(data) {
							data = JSON.parse(data);

							if(data.success == true){
								$("div.mensagem").addClass("alert-success").html("<h4>Cadastrado com sucesso!</h4>").show();
								count = data.idaluno;
								
								var tr = '<tr id="aluno_' + count + '">';
								tr += '<td id="nome_' + count + '" data-nome="' + nome + '">' + nome + '</td>';
								tr += '<td id="idade_' + count + '" data-idade="' + idade + '">' + idade + '</td>';
								tr += '<td id="sexo_' + count + '" data-sexo="' + sexo + '">' + sexo + '</td>';
								tr += '<td id="email_' + count + '" data-email="' + email + '">' + email + '</td>';
								tr += '<td id="curso_' + count + '" data-curso="' + curso + '">' + $("#curso option:selected").text() + '</td>';
								tr += '<td style="width:16%">';
								tr += '<button type="button" class="btn btn-primary btEditar" id="btEditar_' + count + '">Editar</button>';
								tr += '<button type="button" class="btn btn-danger btDeletar" id="btDeletar_' + count + '">Deletar</button>';
								tr += '</td>';
								tr += '</tr>';

								$("table > tbody").append(tr);
						
							}else{
								$(".mensagem_erro").show();
								$(".mensagem_erro").append("Erro ao cadastrar aluno!");
								setTimeout(function(){window.location = "cadastro_aluno.php";}, 3000);
                            }
							LimpaDados();
						});
                    }else{
                        $("tr[id=aluno_" + idaluno + "] > td[id=nome_" + idaluno + "]").removeAttr("data-nome");
                        $("tr[id=aluno_" + idaluno + "] > td[id=idade_" + idaluno + "]").removeAttr("data-idade");
                        $("tr[id=aluno_" + idaluno + "] > td[id=sexo_" + idaluno + "]").removeAttr("data-sexo");
                        $("tr[id=aluno_" + idaluno + "] > td[id=email_" + idaluno + "]").removeAttr("data-email");
                        $("tr[id=aluno_" + idaluno + "] > td[id=curso_" + idaluno + "]").removeAttr("data-curso");
                        
                        $("tr[id=aluno_" + idaluno + "] > td[id=nome_" + idaluno + "]").attr("data-nome",nome).html(nome);
                        $("tr[id=aluno_" + idaluno + "] > td[id=idade_" + idaluno + "]").attr("data-idade",idade).html(idade);
                        $("tr[id=aluno_" + idaluno + "] > td[id=sexo_" + idaluno + "]").attr("data-sexo",sexo).html(sexo);
                        $("tr[id=aluno_" + idaluno + "] > td[id=email_" + idaluno + "]").attr("data-email",email).html(email);
                        $("tr[id=aluno_" + idaluno + "] > td[id=curso_" + idaluno + "]").attr("data-curso",curso).html($("#curso option:selected").text());

                        $.ajax({
							url: "data/alunoTable.php",
							type: "POST",
							data: {
								action: "alterar",
								idaluno: idaluno,
								nome: nome,
								email: email,
								idade: idade,
								sexo: sexo,
								idcurso: curso
							}
						}).done(function(data) {
							data = JSON.parse(data);
							if(data.success == true){
								$("div.mensagem").addClass("alert-success").html("<h4>Alterado com sucesso!</h4>").show();
							}else{
								$(".mensagem_erro").show();
								$(".mensagem_erro").append("Não foi possivel alterar o aluno");
							}
							LimpaDados();
						});
                    }
                }
            });

            $("#idade").on("keyup",function(){
                var idade = this.value;
                this.value = idade.replace(/[^\d]+/g,'');
            });

            $(document).on("click","button.btEditar",function(){
                var idaluno = this.id.replace(/[^\d]+/g,'');

                var nome  = $("tr[id=aluno_"+idaluno+"]").find('td[data-nome]').data('nome');
                var idade = $("tr[id=aluno_"+idaluno+"]").find('td[data-idade]').data('idade');
                var sexo  = $("tr[id=aluno_"+idaluno+"]").find('td[data-sexo]').data('sexo');
                var email = $("tr[id=aluno_"+idaluno+"]").find('td[data-email]').data('email');
                var curso = $("tr[id=aluno_"+idaluno+"]").find('td[data-curso]').data('curso');

                $("#nome").val(nome);
                $("#idade").val(idade);

                // $('#sexo option:contains("' + sexo + '")').prop('selected','selected');

                $('#sexo option').removeAttr('selected').filter('[value='+ sexo +']').prop('selected', true);

                $("#email").val(email);
                $('#curso option').removeAttr('selected').filter('[value='+ curso +']').prop('selected', true);
                $("#idaluno").val(idaluno);
            });

            $(document).on("click","button.btDeletar",function(){
                var idaluno = this.id.replace(/[^\d]+/g,'');
                if(confirm("Deseja realmente deletar este aluno?")){
					$.ajax({
						url: "data/alunoTable.php",
						type: "POST",
						data: {
							action: "deletar",
							idaluno: idaluno
						}
					}).done(function(data) {
						data = JSON.parse(data);

						if(data.success == true){
							$("div.mensagem").addClass("alert-success").html("<h4>Excluido com sucesso!</h4>").show();
						}else{
							$(".mensagem_erro").show();
							$(".mensagem_erro").append("Não foi possivel excluir o registro");
						}
					});
				
                    $("#aluno_"+idaluno).remove();
                }
            });
        });

        function limparCampos(){
            $("#nome").css("border-color","");
            $("#nome").css("color","");

            $("#idade").css("border-color","");
            $("#idade").css("color","");

            $("#sexo").css("border-color","");
            $("#sexo").css("color","");
        
            $("#email").css("border-color","");
            $("#email").css("color","");

            $("#curso").css("border-color","");
            $("#curso").css("color","");

            $("div.mensagem").removeClass("alert-danger  alert-success").html("").hide();
        }
		
		function LimpaDados(){
			$("#idaluno").val("");
			$("#nome").val("");
			$("#idade").val("");
			$('#sexo option').removeAttr('selected').filter('[value=""]').attr('selected', true);
			$("#email").val("");
			$("#curso").val("");
		}
    </script>