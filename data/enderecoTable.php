<?php

session_start();

require_once 'base.php';

class Endereco extends Base {

    public function select() {
        $data = (object) $_POST;
        $success = false;

        $db = $this->getDb();
        $stm = $db->prepare('SELECT * FROM endereco WHERE endereco.idcliente = :idcliente');
        $stm->bindValue(':idcliente', $data->idcliente);
        $stm->execute();
        $result = $stm->fetchAll( PDO::FETCH_ASSOC);

        if(count($result) > 0){
            $success = true;
        }

        echo json_encode(array(
            "data" => $result,
            "success" => $success
        ));
        exit;
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
                    estado,
                    idcliente
                ) VALUES (
                    :cep,
                    :referencia,
                    :endereco,
                    :numero,
                    :complemento,
                    :bairro,
                    :cidade,
                    :estado,
                    :idcliente
                );');
            $stm->bindValue(':cep', $endereco["cep"]);
            $stm->bindValue(':referencia', $endereco["referencia"]);
            $stm->bindValue(':endereco', $endereco["endereco"]);
            $stm->bindValue(':numero', $endereco["numero"]);
            $stm->bindValue(':complemento', $endereco["complemento"]);
            $stm->bindValue(':bairro', $endereco["bairro"]);
            $stm->bindValue(':cidade', $endereco["cidade"]);
            $stm->bindValue(':estado', $endereco["estado"]);
            $stm->bindValue(':idcliente', $data->idcliente);
            $stm->execute();
            $insert = $stm;

            if($insert->rowCount()){
                $success = true;
            }else{
                $success = false;
            }
        }

        echo json_encode(array(
            "success" => $success
        ));
        exit;
    }

    public function update() {
        $data = (object) $_POST;

        $db = $this->getDb();
        $stm = $db->prepare('UPDATE endereco SET
                cep         = :cep,
                referencia  = :referencia,
                endereco    = :endereco,
                numero      = :numero,
                complemento = :complemento,
                bairro      = :bairro,
                cidade      = :cidade,
                estado      = :estado
            WHERE idcliente = :idcliente
                AND idendereco = :idendereco');
        $stm->bindValue(':cep', $data->cep);
        $stm->bindValue(':referencia', $data->referencia);
        $stm->bindValue(':endereco', $data->endereco);
        $stm->bindValue(':numero', $data->numero);
        $stm->bindValue(':complemento', $data->complemento);
        $stm->bindValue(':bairro', $data->bairro);
        $stm->bindValue(':cidade', $data->cidade);
        $stm->bindValue(':estado', $data->estado);
        $stm->bindValue(':idcliente', $data->idcliente);
        $stm->bindValue(':idendereco', $data->idendereco);
        $stm->execute();
        $update = $stm;

        if($update->rowCount()){
            $success = true;
        }else{
            $success = false;
        }

        echo json_encode(array(
            "success" => $success
        ));
        exit;
    }

    public function delete() {
        $data = (object) $_POST;

        $db = $this->getDb();

        $stm = $db->prepare('DELETE FROM endereco WHERE idendereco = :idendereco AND idcliente = :idcliente');
        $stm->bindValue(':idendereco', $data->idendereco);
        $stm->bindValue(':idcliente', $data->idcliente);
        $stm->execute();
        $delete = $stm;

        if($delete->rowCount()){
            $success = true;
        }else{
            $success = false;
        }

        echo json_encode(array(
            "success" => $success
        ));
        exit;
    }
}

$action = $_POST["action"];

$class = new Endereco();
$class->$action();
?>
