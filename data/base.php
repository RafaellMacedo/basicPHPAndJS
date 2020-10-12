<?php

abstract class Base {

  protected $id       = null;
  protected $database = null;
  protected $table    = null;
  protected $config   = [];

  public function __construct(array $options=null,  PDO $database=null) {
    if (count($options)){
      $this->setOptions($options);
    }

    $this->config['adapter']  = "mysql";
    $this->config['hostname'] = "localhost";
    $this->config['dbname']   = "bdprojeto";
    $this->config['user']     = "testekabum";
    $this->config['password'] = "t1st1k@Bum";

    $this->database = $this->getConnection($this->config);

  	if (isset($_GET['action'])) {
  		if(method_exists($this, $_GET['action'])){
  			call_user_func(array($this, $_GET['action']));
  		}
  	}
  }

  public function setOptions(array $options) {
    $methods = get_class_methods($this);

    foreach($option as $key => $value) {
      $method = 'set' . ucfirst($key);

      if (in_array($method, $methods)){
        $this->$method($value);
      }
    }
    return this;
  }

  public function getTable(){
    return $this->table;
  }

  public function getDb(){
    return $this->database;
  }

  public function getConnection($config) {
    $dsn = $config['adapter'] . ":host=" . $config['hostname'] . ";port=" .  ";dbname=" . $config['dbname'];
    try{
        return new   PDO($dsn, $config['user'], $config['password']);
    }
    catch (PDOException $e)
    {
        die($e->getMessage());
    }
  }
}
?>
