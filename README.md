# minicurso-php
Minicurso de introdução a linguagem de PHP com foco em Orientação a Objeto e PDO.

Estrutura do banco de dados
Altera as variáveis do arquivo data/Base.php atribuíndo o usuário e senha do banco de dados.

$this->config['user'] = "user"; $this->config['password'] = "password";

CREATE DATABASE projetofw;

CREATE TABLE curso (idcurso int not null auto_increment, curso varchar(30), constraint PK_CURSO primary key (idcurso));

CREATE TABLE aluno ( idaluno int not null auto_increment, nome varchar(50) not null, email varchar(100) null, idade int null, sexo varchar(10) null, idcurso int not null, constraint PK_ALUNO primary key (idaluno), constraint FK_ALUNO_IDCURSO foreign key (idcurso) references curso (idcurso));

CREATE TABLE usuario (idusuario int not null auto_increment, nome varchar(70) not null, login varchar(30) null, senha varchar(10) not null, nivel int not null, constraint PK_USUARIO primary key (idusuario));

INSERT INTO usuario (nome, login, senha, nivel) VALUES ('Professor', 'professor', '1234', 1);

INSERT INTO curso (curso) VALUES ('Ciência da Computação'), ('Administração');

INSERT INTO aluno (nome, email, idade, sexo, idcurso) VALUES ('Aluno A', 'alunoa@gmail.com', 20, 'feminino', 1), ('Aluno B', 'alunob@gmail.com', 21, 'masculino', 1), ('Aluno C', 'alunoc@gmail.com', 20, 'masculino', 1);
