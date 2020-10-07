<?php

session_start();

require_once 'Base.php';

class Login extends Base{

    public function select() {
        $data = (object) $_POST;

        $db = $this->getDb();
        $stm = $db->prepare('SELECT * FROM usuario WHERE login = :login AND senha = :password');
        $stm->bindValue(':login',    $data->login);
        $stm->bindValue(':password', $data->pass);
        $stm->execute();
        $result = $stm->fetch( PDO::FETCH_ASSOC);

        if($result["idusuario"]){
            $success = true;

            $_SESSION["idusuario"] = $result["idusuario"];
            $_SESSION["nome"]      = $result["nome"];
            $_SESSION["nivel"]     = $result["nivel"];
            $_SESSION["login"]     = true;
        }else{
            $success = false;
        }

        echo json_encode(array(
          "data" => $result,
          "success" => $success
        ));
    }
}

$acao = $_POST["action"];

$login = new Login();
$login->$acao();
?>
