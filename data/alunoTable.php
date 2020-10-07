<?php

session_start();

require_once 'Base.php';

class Aluno extends Base{

    public function select() {
        $data = (object) $_POST;

        $db = $this->getDb();
        $stm = $db->prepare('SELECT aluno.idaluno, aluno.nome, aluno.email, aluno.idade, aluno.sexo, curso.curso, aluno.idcurso FROM aluno 
            INNER JOIN curso ON curso.idcurso = aluno.idcurso');
        $stm->execute();
        $result = $stm->fetchAll( PDO::FETCH_ASSOC);

        foreach ($result as $key => $value) {
            $result[$key]["nome"] = utf8_encode($result[$key]["nome"]);
            $result[$key]["curso"] = utf8_encode($result[$key]["curso"]);
        }

        echo json_encode(array(
            "data" => $result,
            "success" => true
            )
        );
        
    }
	
	public function inserir() {
        $data = (object) $_POST;

        $db = $this->getDb();
        $stm = $db->prepare('INSERT INTO aluno (nome, email, idade, sexo, idcurso) values (:nome, :email, :idade, :sexo, :curso) ');
		$stm->bindValue(':nome',  $data->nome);
        $stm->bindValue(':email', $data->email);
		$stm->bindValue(':idade', $data->idade);
        $stm->bindValue(':sexo', $data->sexo);
		$stm->bindValue(':curso', $data->idcurso);
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
	
	public function alterar() {
        $data = (object) $_POST;

        $db = $this->getDb();
        $stm = $db->prepare('UPDATE aluno SET nome = :nome, email = :email, idade = :idade, sexo = :sexo, idcurso = :curso WHERE idaluno = :idaluno');
        $stm->bindValue(':idaluno', $data->idaluno);
		$stm->bindValue(':nome',  $data->nome);
        $stm->bindValue(':email', $data->email);
		$stm->bindValue(':idade', $data->idade);
        $stm->bindValue(':sexo', $data->sexo);
		$stm->bindValue(':curso', $data->idcurso);
        $stm->execute();
		$result = $stm;
		
		if($result->rowCount()){
            $success = true;
        }else{
            $success = false;
        }
		
		echo json_encode(array(
            "data" => $result,
            "success" => true
            )
        );
    }
}

$acao = $_POST["action"];

$aluno = new Aluno();
$aluno->$acao();
?>
