<?php

session_start();

require_once 'base.php';

class Endereco extends Base {

    public function select() {
        $data = (object) $_POST;
        $success = false;

        $db = $this->getDb();
        $stm = $db->prepare('SELECT endereco.*
            FROM endereco
            WHERE endereco.idcliente = :idcliente');
        $stm->bindValue(':idcliente', $data->idcliente);
        $stm->execute();
        $result = $stm->fetchAll( PDO::FETCH_ASSOC);

        if(count($result) > 0){
            $success = true;
        }

        echo json_encode(array(
            "data" => $result,
            "success" => $success
            )
        );
    }

    public function insert() {
        $data = (object) $_POST;
        $lista_endereco = [];

        if(isset($data->lista_endereco)){
            $lista_endereco = $data->lista_endereco;
        } else {
            $lista_endereco[] = $_POST;
        }

        foreach ($lista_endereco as $key => $endereco) {
            $db = $this->getDb();
            $stm = $db->prepare('INSERT INTO endereco (
                    cep,
                    referencia,
                    endereco,
                    numero,
                    complemento,
                    bairro,
                    cidade,
                    uf,
                    idcliente
                ) VALUES (
                    :cep,
                    :referencia,
                    :endereco,
                    :numero,
                    :complemento,
                    :bairro,
                    :cidade,
                    :uf,
                    :idcliente
                );');
            $stm->bindValue(':cep', $endereco["cep"]);
            $stm->bindValue(':referencia', $endereco["referencia"]);
            $stm->bindValue(':endereco', $endereco["endereco"]);
            $stm->bindValue(':numero', $endereco["numero"]);
            $stm->bindValue(':complemento', $endereco["complemento"]);
            $stm->bindValue(':bairro', $endereco["bairro"]);
            $stm->bindValue(':cidade', $endereco["cidade"]);
            $stm->bindValue(':uf', $endereco["estado"]);
            $stm->bindValue(':idcliente', $data->idcliente);
            $stm->execute();
            $result = $stm;

            if($result->rowCount()){
                $success = true;
            }else{
                $success = false;
            }
        }

        echo json_encode(array(
            "success" => $success
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

$class = new Endereco();
$class->$action();
?>
