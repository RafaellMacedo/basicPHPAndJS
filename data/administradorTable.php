<?php

session_start();

require_once 'base.php';

class Administrador extends Base{

    public function select() {
        $data = (object) $_POST;

        $db = $this->getDb();
        $stm = $db->prepare('SELECT * FROM administrador WHERE login = :login AND senha = :senha');
        $stm->bindValue(':login', $data->login);
        $stm->bindValue(':senha', $data->pass);
        $stm->execute();
        $result = $stm->fetch( PDO::FETCH_ASSOC);

        if($result["idadministrador"]){
            $success = true;

            $_SESSION["idadministrador"] = $result["idadministrador"];
            $_SESSION["nome"]            = $result["nome"];
            $_SESSION["login"]           = true;
        }else{
            $success = false;
        }

        echo json_encode(array(
          "data" => $result,
          "success" => $success
        ));
    }

    public function verificarLogin() {
        $data = (object) $_POST;

        $db = $this->getDb();
        $stm = $db->prepare('SELECT idadministrador FROM administrador WHERE login LIKE :login');
        $stm->bindValue(':login', $data->login);
        $stm->execute();
        $result = $stm->fetch( PDO::FETCH_ASSOC);

        if($result["idadministrador"]){
            $success = true;
        }else{
            $success = false;
        }

        echo json_encode(array(
          "success" => $success
        ));
    }

    public function recuperarSenha() {
        $data = (object) $_POST;

        $db = $this->getDb();
        $stm = $db->prepare('SELECT idadministrador FROM administrador WHERE nome LIKE :nome AND login LIKE :login');
        $stm->bindValue(':nome', $data->nome);
        $stm->bindValue(':login', $data->login);
        $stm->execute();
        $result = $stm->fetch( PDO::FETCH_ASSOC);

        if($result["idadministrador"]){
            $success = true;
        }else{
            $success = false;
        }

        echo json_encode(array(
          "success" => $success,
          "idadministrador" => $result["idadministrador"]
        ));
    }

    public function insert(){
        $data = (object) $_POST;

        $db = $this->getDb();
        $stm = $db->prepare('SELECT idadministrador FROM administrador WHERE login LIKE :login');
        $stm->bindValue(':login', $data->login);
        $stm->execute();
        $result = $stm->fetch( PDO::FETCH_ASSOC);

        if($result["idadministrador"]){
            $success = false;
            $mensagem = "Login já esta em uso no sistema, tente outro login";

        }else{
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
                $mensagem = "";
                $success = false;
            }
        }

        echo json_encode(array(
            "mensagem" => $mensagem,
            "success" => $success
            )
        );
    }

    public function update(){
        $data = (object) $_POST;

        $db = $this->getDb();
        $stm = $db->prepare('SELECT idadministrador FROM administrador WHERE login LIKE :login AND idadministrador = :idadministrador');
        $stm->bindValue(':login', $data->login);
        $stm->bindValue(':idadministrador', $data->idadministrador);
        $stm->execute();
        $result = $stm->fetch( PDO::FETCH_ASSOC);

        if($result["idadministrador"]){
            $db = $this->getDb();
            $stm = $db->prepare('UPDATE administrador SET
                nome = :nome,
                login = :login,
                senha = :senha
                WHERE idadministrador = :idadministrador');
            $stm->bindValue(':nome',  $data->nome);
            $stm->bindValue(':login', $data->login);
            $stm->bindValue(':senha', $data->senha);
            $stm->bindValue(':idadministrador', $data->idadministrador);
            $stm->execute();
            $lastId = $db->lastInsertId();
            $result = $stm;

            if($result->rowCount()){
                $success = true;
            }else{
                $mensagem = "";
                $success = false;
            }
        } else {
            $success = false;
            $mensagem = "Login incorreto! Por favor, informe seu login correto!";
        }

        echo json_encode(array(
            "mensagem" => $mensagem,
            "success" => $success
            )
        );
    }
}

$action = $_POST["action"];

$class = new Administrador();
$class->$action();
?>
