<?php

include_once "conectar.php";

function verificaPrepara($CodigoContrato){

    $verificarPrepara = conectar("servidorescola", "preparaadm", "prepcurso", "ke7@ch%","3307");

    $sql = "SELECT loginagendamentoaluno.CodigoContrato, pr_perfilalunos.CodigoContrato FROM
            loginagendamentoaluno, pr_perfilalunos WHERE loginagendamentoaluno.CodigoContrato = :CodigoContrato
            OR pr_perfilalunos.CodigoContrato = :CodigoContrato LIMIT 1
        ";
    $prepare = $verificarPrepara->prepare($sql);
    $prepare->execute(["CodigoContrato" => $CodigoContrato]);

    if($prepare){
        return $prepare->fetch();
    }else{
        return false;
    }
    return false;
}


function verificaOuro($CodigoContrato){

    $verificarOuro = conectar("servidorouro", "ouromoderno", "prepara2", "prepara");

    $sql = "SELECT LOGIN FROM
            usuarios WHERE LOGIN = :CodigoContrato LIMIT 1
        ";
    $prepare = $verificarOuro->prepare($sql);
    $prepare->execute(["CodigoContrato" => $CodigoContrato]);

    if($prepare){
        return $prepare->fetch();
    }

    return false;

}