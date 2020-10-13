$("#btn_login").click(function(){
    var login = $("#login").val();
    var pass = $("#pass").val();
    $(".mensagem_erro").hide();
    $(".mensagem_erro").html("");

    if(login == "" || pass == ""){
        $(".mensagem_erro").show();
        $(".mensagem_erro").append("Preencha todos os campos");

    }else{
        $.ajax({
            url: "data/administradorTable.php",
            type: "POST",
            data: {
                action: "select",
                login: login,
                pass: pass,
                logar: true
            }
        }).done(function(data) {
            data = JSON.parse(data);

            if(data.success == true){
                window.location = "index.php";
            }else{
                $(".mensagem_erro").show();
                $(".mensagem_erro").append("Login ou senha inválido!");
            }
        });
    }
});

$("#btn_cadastro").on("click", function(){
    window.location = "administrador.php";
});