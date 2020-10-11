<?php

session_start();

require_once 'base.php';

class Cliente extends Base {

    public function select() {
        $data = (object) $_POST;

        $db = $this->getDb();
        $stm = $db->prepare('SELECT cliente.*,
                DATE_FORMAT(cliente.data_nascimento, "%d/%m/%Y") AS data_nascimento_formatado,
                endereco.idendereco,
                endereco.endereco,
                endereco.numero,
                endereco.complemento,
                endereco.bairro,
                endereco.cidade,
                endereco.uf
            FROM cliente
                LEFT JOIN endereco ON endereco.idcliente = cliente.idcliente');
        $stm->execute();
        $result = $stm->fetchAll( PDO::FETCH_ASSOC);

        foreach ($result as $key => $value) {
            $result[$key]["nome"]     = utf8_encode($result[$key]["nome"]);
            $result[$key]["endereco"] = utf8_encode($result[$key]["endereco"]);
            $result[$key]["bairro"]   = utf8_encode($result[$key]["bairro"]);
            $result[$key]["cidade"]   = utf8_encode($result[$key]["cidade"]);
        }

        echo json_encode(array(
            "data" => $result,
            "success" => true
            )
        );
    }

    public function insert() {
        $data = (object) $_POST;

        $db = $this->getDb();
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
        $result = $stm;

        if($result->rowCount()){
            $success = true;
        }else{
            $success = false;
        }

        echo json_encode(array(
            "data" => $result,
            "idcliente" => $lastId,
            "success" => true
            )
        );
    }

    public function update() {
        $data = (object) $_POST;

        $db = $this->getDb();
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
        $result = $stm;

        if($result->rowCount()){
            $success = true;
        }else{
            $success = false;
        }

        echo json_encode(array(
            "success" => true
            )
        );
    }

    public function deletar() {
        $data = (object) $_POST;

        $db = $this->getDb();
        $stm = $db->prepare('DElETE FROM aluno WHERE idaluno = :idaluno');
        $stm->bindValue(':idaluno', $data->idaluno);
        $stm->execute();
        $result = $stm;

        if($result->rowCount()){
            $success = true;
        }else{
            $success = false;
        }
    }
}

$action = $_POST["action"];

$class = new Cliente();
$class->$action();
?>
