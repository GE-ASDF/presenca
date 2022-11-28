<?php

session_start();
include "prepara/colaborador.php";

if($_POST){


    $usuario = isset($_POST["usuario"]) ? filter_var($_POST["usuario"], FILTER_SANITIZE_STRING):header("Location:/presenca/login.php");
    $senha = isset($_POST["senha"]) ? filter_var($_POST["senha"], FILTER_SANITIZE_STRING):header("Location:/presenca/login.php");
    
    if($usuario != '' && $senha != ''){

            $colaborador = getColaborador([
                "usuario" => $usuario,
                "senha"=>$senha
            ]);
            
            if($colaborador){
                $_SESSION["logado"] = $colaborador;
                return header("Location:/presenca/atualizar.php");
            }else{
                $_SESSION["notfound"] = "<p class='alert alert-success'> Usuário não encontrado. Tente novamente. </p>";
                return header("Location:/presenca/login.php");
            }
        }else{
            return header("Location:/presenca/login.php");
        }

}else{
    session_destroy();
    header("Location:/presenca/login.php");
}