<?php
header("Content-type: text/html; charset=utf-8");
function conectar($servidor, $banco, $usuario, $senha, $porta = "3306"){

    $pdo = null;

    try{

        if(is_null($pdo)){
            $pdo = new PDO("mysql:host=".$servidor.";dbname=".$banco.";port=".$porta, $usuario, $senha, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
            ]);
            return $pdo;
        }else{
            return "Houve erro na conexão.";
        }

    }catch(PDOException $e){
        var_dump($e->getMessage());
    }

}
