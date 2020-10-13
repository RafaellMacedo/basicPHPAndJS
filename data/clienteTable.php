<?php

session_start();

require_once 'base.php';

class Cliente extends Base {

    public function select() {
        $data = (object) $_POST;

        $db = $this->getDb();
        $stm = $db->prepare('SELECT cliente.*,
                DATE_FORMAT(cliente.data_nascimento, "%d/%m/%Y") AS data_nascimento_formatado,
                IF(e.idcliente IS NOT NULL, true, false) AS contem_endereco
            FROM cliente
                LEFT JOIN (SELECT idcliente FROM endereco GROUP BY idcliente) AS e ON e.idcliente = cliente.idcliente');
        $stm->execute();
        $result = $stm->fetchAll( PDO::FETCH_ASSOC);

        foreach ($result as $key => $value) {
            $result[$key]["nome"]     = utf8_encode($result[$key]["nome"]);
        }

        echo json_encode([
            "data" => $result,
            "success" => true
        ]);
    }

    public function insert() {
        $data = (object) $_POST;

        $db = $this->getDb();
        $db->beginTransaction();

        $stm = $db->prepare('INSERT INTO cliente (
                nome,
                data_nascimento,
                cpf,
                rg,
                telefone
            ) VALUES (
                :nome,
                :data_nascimento,
                :cpf,
                :rg,
                :telefone
            );');
        $stm->bindValue(':nome', $data->nome);
        $stm->bindValue(':data_nascimento', $data->data_nascimento);
        $stm->bindValue(':cpf', $data->cpf);
        $stm->bindValue(':rg', $data->rg);
        $stm->bindValue(':telefone', $data->telefone);
        $stm->execute();
        $lastId = $db->lastInsertId();
        $insert = $stm;

        if($insert->rowCount()){
            $db->commit();
            $success = true;
        }else{
            $db->rollback();
            $success = false;
        }

        echo json_encode([
            "idcliente" => $lastId,
            "success" => true
        ]);
    }

    public function update() {
        $data = (object) $_POST;

        $db = $this->getDb();
        $db->beginTransaction();

        $stm = $db->prepare('UPDATE cliente SET
                nome = :nome,
                data_nascimento = :data_nascimento,
                cpf = :cpf,
                rg = :rg,
                telefone = :telefone
            WHERE idcliente = :idcliente');
        $stm->bindValue(':idcliente', $data->idcliente);
        $stm->bindValue(':nome',  $data->nome);
        $stm->bindValue(':data_nascimento', $data->data_nascimento);
        $stm->bindValue(':cpf', $data->cpf);
        $stm->bindValue(':rg', $data->rg);
        $stm->bindValue(':telefone', $data->telefone);
        $stm->execute();
        $update = $stm;

        if($update->rowCount()){
            $db->commit();
            $success = true;
        }else{
            $db->rollback();
            $success = false;
        }

        echo json_encode([
            "success" => true
        ]);
    }

    public function delete() {
        $data = (object) $_POST;

        $db = $this->getDb();
        $stm = $db->prepare('SELECT * FROM endereco WHERE endereco.idcliente = :idcliente');
        $stm->bindValue(':idcliente', $data->idcliente);
        $stm->execute();
        $result = $stm->fetchAll( PDO::FETCH_ASSOC);

        if(count($result) > 0){
            $db->beginTransaction();

            $stm = $db->prepare('DELETE FROM endereco WHERE idcliente = :idcliente');
            $stm->bindValue(':idcliente', $data->idcliente);
            $stm->execute();
            $delete = $stm;

            if($delete->rowCount()){
                $db->commit();
                $erro = false;
            } else {
                $db->rollback();
                $erro = true;
            }
        } else {
            $erro = false;
        }

        if(!$erro){
            $db->beginTransaction();

            $stm = $db->prepare('DELETE FROM cliente WHERE idcliente = :idcliente');
            $stm->bindValue(':idcliente', $data->idcliente);
            $stm->execute();
            $delete = $stm;

            if($delete->rowCount()){
                $db->commit();
                $success = true;
            }else{
                $db->rollback();
                $success = false;
            }
        }else{
            $db->rollback();
            $success = false;
        }

        echo json_encode(array(
            "success" => $success
        ));
    }
}

$action = $_POST["action"];

$class = new Cliente();
$class->$action();
?>
