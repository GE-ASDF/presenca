<?php

function conectar($servidor, $banco, $usuario, $senha, $porta = "3306"){

    $pdo = null;

    try{

        if(is_null($pdo)){
            $pdo = new PDO("mysql:host=".$servidor.";dbname=".$banco.";port=".$porta, $usuario, $senha);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        }else{
            return "Houve erro na conexão";
        }

    }catch(PDOException $e){
        var_dump($e->getMessage());
    }

}
