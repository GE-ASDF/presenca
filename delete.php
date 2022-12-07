<?php

session_start();
include "marcarPresenca.php";
if($_SESSION["logado"]){

if($_GET){

    $Codigo = isset($_GET["Codigo"]) ? filter_var($_GET["Codigo"], FILTER_SANITIZE_NUMBER_INT):"";
    $pg = isset($_GET["pg"]) ? filter_var($_GET["pg"], FILTER_SANITIZE_STRING):"";
 
    if($Codigo){
        $apagado = delete($Codigo);
        if($apagado){
            $_SESSION["message"] = "Registro apagado com sucesso.";
            return header("Location:/presenca/".$pg.".php");
        }else{
            $_SESSION["message"] = "O registro não foi apagado.";
            return header("Location:/presenca/".$pg.".php");
        }
        
    }else{
        $_SESSION["message"] = "Não foi possível apagar o registro.";
        return header("Location:/presenca/".$pg.".php");
    }

}else{
    $_SESSION["message"] = "Não foi possível apagar o registro.";
    return header("Location:/presenca/".$pg.".php");
}

}else{
    return header("Location:/presenca/login.php");
}