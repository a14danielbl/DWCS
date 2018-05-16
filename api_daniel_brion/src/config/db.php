<?php

class db{
    private $server = 'localhost';
    private $user = 'root';
    private $password = '';
    private $bd = 'api_db';
    public function conectar(){
        try {
            $conexion = new PDO("mysql:host=$this->server;dbname=$this->bd", $this->user, $this->password);
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $conexion->exec("set names utf8");
            return $conexion;
        }catch(PDOException $e){
            echo ($e->getMessage());
        }
    }

}

?>
