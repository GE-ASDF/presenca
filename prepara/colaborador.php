<?php

include "conectar.php";

function getColaborador($data){

    $conectar = conectar("servidorescola", "preparaadm", "prepcurso", "ke7@ch%","3307");
    $sql = "SELECT * FROM vwcolaboradorfranquia WHERE CodigoColaborador = :usuario AND SenhaColaborador = :senha";
    $prepare = $conectar->prepare($sql);
    $prepare->execute($data);
    $usuario = $prepare->fetch();
    
    if($usuario){
        return $usuario;
    }else{
        return false;
    }
}