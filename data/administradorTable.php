<?php

session_start();

require_once 'Base.php';

class Administrador extends Base{

    public function select() {
        $data = (object) $_POST;

        $db = $this->getDb();
        $stm = $db->prepare('SELECT * FROM administrador WHERE login = :login AND senha = :senha');
        $stm->bindValue(':login',    $data->login);
        $stm->bindValue(':senha', $data->pass);
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

    public function inserir(){
        $data = (object) $_POST;

        $db = $this->getDb();
        $stm = $db->prepare('INSERT INTO administrador (nome, login, senha) VALUES (:nome, :login, :senha)');
        $stm->bindValue(':nome',  $data->nome);
        $stm->bindValue(':login', $data->login);
        $stm->bindValue(':senha', $data->senha);
        $stm->execute();
        $lastId = $db->lastInsertId();
        $result = $stm;
        
        if($result->rowCount()){
            $success = true;
        }else{
            $success = false;
        }
        
        echo json_encode(array(
            "data" => $result,
            "idaluno" => $lastId, 
            "success" => true
            )
        );
    }
}

$acao = $_POST["action"];

$login = new Administrador();
$login->$acao();
?>
