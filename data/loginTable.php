<?php

session_start();

require_once 'Base.php';

class Login extends Base{

    public function select() {
        $data = (object) $_POST;

        $db = $this->getDb();
        $stm = $db->prepare('SELECT * FROM administrador WHERE login = :login AND password = :password');
        $stm->bindValue(':login',    $data->login);
        $stm->bindValue(':password', $data->pass);
        $stm->execute();
        $result = $stm->fetch( PDO::FETCH_ASSOC);

        if($result["idadministrador"]){
            $success = true;

            $_SESSION["idadministrador"] = $result["idadministrador"];
            $_SESSION["nome"]      = $result["nome"];
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
