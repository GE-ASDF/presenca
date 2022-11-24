<?php

include_once "conectar.php";


function marcar($numeroContrato, $HoraPresenca){
    
    $conectar = conectar("servidorouro", "bd_presencas", "prepara2", "prepara");

    $sql = "INSERT INTO presencas(CodigoContrato, DataPresenca, HoraPresenca, DiaSemana,
    Computador) VALUES(:CodigoContrato, :DataPresenca, :HoraPresenca, :DiaSemana, :Computador)";

    $CodigoContrato = $numeroContrato;
    $DataPresenca = isset($_POST["DataPresenca"]) ? filter_var($_POST["DataPresenca"], FILTER_SANITIZE_STRING):"";
    $DiaSemana = isset($_POST["DiaSemana"]) ? filter_var($_POST["DiaSemana"], FILTER_SANITIZE_STRING):"";
    $computador = isset($_POST["Computador"]) ? filter_var($_POST["Computador"], FILTER_SANITIZE_STRING):"";

    $data = [
        'CodigoContrato' => $CodigoContrato,
        'DataPresenca' => $DataPresenca,
        'HoraPresenca' => $HoraPresenca,
        'DiaSemana' => $DiaSemana,
        'Computador' => $computador,
    ];
   
        $presencaMarcada = jaMarcada([
            "CodigoContrato" => $data["CodigoContrato"],
            "DataPresenca" => $data["DataPresenca"],
            "HoraPresenca"=>$data["HoraPresenca"]
        ]);


        if(!$presencaMarcada){
            $execute = $conectar->prepare($sql);
            $cadastrado = $execute->execute($data);

                if($cadastrado){
                    return true;
                }else{
                    return false;
                }

        }else{
            return false;
        }
}

function jaMarcada($data){

    $conectar = conectar("servidorouro", "bd_presencas", "prepara2", "prepara");

    $sql = "SELECT * FROM presencas WHERE CodigoContrato = :CodigoContrato AND
    DataPresenca = :DataPresenca AND HoraPresenca = :HoraPresenca";

    $query= $conectar->prepare($sql);

    $query->execute($data);
    return $query->fetch();
}