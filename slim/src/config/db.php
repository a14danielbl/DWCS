<?php

class db{
    private $server = 'localhost';
    private $user = 'root';
    private $password = '';
    private $bd = 'db';
    public function conectar(){
        try {
            $consulta = new PDO("mysql:host=$this->server;dbname=$this->bd", $this->user, $this->password);
            $consulta->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $consulta->exec("set names utf8");
            return $consulta;
        }catch(PDOException $e){
            echo ($e->getMessage());
        }
    }

}

?>
