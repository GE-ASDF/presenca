<?php
    session_start();
    include_once "conectar.php";
    include "marcarPresenca.php";

    if(!isset($_SESSION["logado"])){
        return header("Location:/presenca/atualizar.php");
    }
if($_POST){
    $pg = isset($_GET['pg']) ? $_GET["pg"]:header("Location:/presenca/atualizar.php");
    $Codigo = isset($_POST["Codigo"]) ? $_POST["Codigo"]:"";
    $NomeAluno = isset($_POST["NomeAluno"]) ? filter_var($_POST["NomeAluno"], FILTER_SANITIZE_STRING):"";
    $DataPresenca = isset($_POST["DataPresenca"]) ? filter_var($_POST["DataPresenca"], FILTER_SANITIZE_STRING):"";
    $HoraPresenca = isset($_POST["HoraPresenca"]) ? filter_var($_POST["HoraPresenca"], FILTER_SANITIZE_STRING):"";
    $Computador = isset($_POST["Computador"]) ? filter_var($_POST["Computador"], FILTER_SANITIZE_STRING):"";
    $IpComputador = isset($_POST["IpComputador"]) ? filter_var($_POST["IpComputador"], FILTER_SANITIZE_STRING):"";
    $DiaSemana = isset($_POST["DiaSemana"]) ? filter_var($_POST["DiaSemana"], FILTER_SANITIZE_STRING):"";

    $data = [
        "Codigo" => $Codigo,
        "NomeAluno" => $NomeAluno,
        "DataPresenca" => $DataPresenca,
        "HoraPresenca" => $HoraPresenca,
        "Computador" => $Computador,
        "IpComputador" => $IpComputador,
        "DiaSemana" => $DiaSemana
    ];
    $atualizado = atualizar($data);

    if($atualizado){
        $_SESSION["message"] = "Registro atualizado com sucesso.";
        return header("Location:/presenca/".$pg.".php");
    }else{
        $_SESSION["message"] = "O registro não foi atualizado. Tente novamente.";
        return header("Location:/presenca/".$pg.".php");
    }
}else{
    $_SESSION["message"] = "Não foi possível acessar a página.";
    return header("Location:/presenca/".$pg.".php");
}
