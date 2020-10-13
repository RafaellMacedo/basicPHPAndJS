Este projeto foi focado em redução de código e reaproveitamento de métodos. Foram utilizadas as linguagens de programação PHP e Javascript, banco de dados MySQL, a biblioteca JQuery 3.0 e o framework Boostrap.

No PHP não foi utilizado framework, apenas Orientação ao Objeto e PDO para ações ao banco de dados.

Para que o sistema esteja funcionando, é necessário a instalação de alguns pacotes de serviços, de acordo com o sistema operacional utilizado. Segue abaixo:

> <b>Linux</b>
>> Apache2
>> Php-7.2
>> mysql-server
>> libapache2-mod-php 
>> php-mysql

> <b>Window</b>
>> Instalar o WAMP https://www.wampserver.com/en/]

O projeto foi estruturado visando a otimização de código, separando o back-end (PHP) do front-end (Javascript). No front-end está separado o HTML, CSS e Javascript em seus respectivos arquivos.

> <b>data/</b>
>>Contém os arquivos que realizam ações do banco de dados. O arquivo <b>base.php</b> tem a configuração de conexão ao banco de dados.

> <b>css/view</b>
>>Contém o CSS utilizado em cada tela do projeto.

> <b>js/view</b>
>> Contém os métodos em Javascript utilizados em cada tela do projeto.
>> No arquivo metodo.js estão desenvolvidos os métodos genêricos que são utilizados em mais de uma tela do projeto.

> <b>resources/layout</b>
>> Contém os arquivos dos blocos Header e Menu do projeto.

<b>CONFIGURANDO BANCO DE DADOS NO PROJETO</b>

Abra o arquivo <b>data/base.php</b>

Nas linhas 18 <b>$this->config['user']</b> e 19 <b>$this->config['user']</b> alterar os valores contidos dentro das aspas duplas, informando o usuário e a senha para acesso ao banco de dados.

<b>CRIANDO BANCO DE DADOS</b>

Para iniciar o projeto, é necessário criar um schema (banco de dados) com o nome <b>bdprojeto</b>

Com o banco de dados criado e configurado o arquivo base.php com o usuário e senha, execute o código abaixo de criação de todas as tabelas que este projeto utiliza.


CREATE TABLE `bdprojeto`.`administrador` (
  `idadministrador` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(100) NULL,
  `login` VARCHAR(100) NOT NULL,
  `senha` VARCHAR(20) NOT NULL,
  `ativo` TINYINT NOT NULL DEFAULT 1,
  `create_datetime` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idadministrador`));

CREATE TABLE `bdprojeto`.`cliente` (
  `idcliente` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(100) NULL,
  `data_nascimento` DATE NULL,
  `cpf` VARCHAR(14) NULL,
  `rg` VARCHAR(12) NULL,
  `telefone` VARCHAR(15) NULL,
  `create_datetime` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idcliente`));


CREATE TABLE IF NOT EXISTS `bdprojeto`.`endereco` (
  `idendereco` INT(11) NOT NULL AUTO_INCREMENT,
  `cep` VARCHAR(9) NULL DEFAULT NULL,
  `referencia` VARCHAR(100) NULL DEFAULT NULL,
  `endereco` VARCHAR(250) NULL DEFAULT NULL,
  `numero` VARCHAR(50) NULL DEFAULT NULL,
  `complemento` VARCHAR(100) NULL DEFAULT NULL,
  `bairro` VARCHAR(200) NULL DEFAULT NULL,
  `cidade` VARCHAR(150) NULL DEFAULT NULL,
  `estado` VARCHAR(2) NULL DEFAULT NULL,
  `create_datetime` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
  `idcliente` INT(11) NOT NULL,
  PRIMARY KEY (`idendereco`),
  INDEX `fk_endereco_cliente_idx` (`idcliente` ASC),
  CONSTRAINT `fk_endereco_cliente`
    FOREIGN KEY (`idcliente`)
    REFERENCES `bdprojeto`.`cliente` (`idcliente`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

<b>ACESSANDO O SISTEMA</b>

Para acessar o sistema, é necessário cadastrar um administrador por meio da tela de login.


