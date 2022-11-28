<?php
header("Content-type: text/html; charset=utf-8");
include_once "conectar.php";


function marcar($numeroContrato, $HoraPresenca, $NomeAluno = ''){
    
    $conectar = conectar("servidorouro", "bd_presencas", "prepara2", "prepara");

    $sql = "INSERT INTO presencas(CodigoContrato, NomeAluno, DataPresenca, HoraPresenca, DiaSemana,
    Computador, IpComputador) VALUES(:CodigoContrato,:NomeAluno, :DataPresenca, :HoraPresenca, :DiaSemana, :Computador, :IpComputador)";

    $CodigoContrato = $numeroContrato;
    $DataPresenca = isset($_POST["DataPresenca"]) ? filter_var($_POST["DataPresenca"], FILTER_SANITIZE_STRING):"";
    $DiaSemana = isset($_POST["DiaSemana"]) ? filter_var($_POST["DiaSemana"], FILTER_SANITIZE_STRING):"";
    $computador = isset($_POST["Computador"]) ? filter_var($_POST["Computador"], FILTER_SANITIZE_STRING):"";
    $ipComputador = isset($_POST["IpComputador"]) ? filter_var($_POST["IpComputador"], FILTER_SANITIZE_STRING):"";

    $data = [
        'CodigoContrato' => $CodigoContrato,
        'NomeAluno' => $NomeAluno,
        'DataPresenca' => $DataPresenca,
        'HoraPresenca' => $HoraPresenca,
        'DiaSemana' => $DiaSemana,
        'Computador' => $computador,
        'IpComputador' => $ipComputador
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


function atualizar($data){
    
    $conectar = conectar("servidorouro", "bd_presencas", "prepara2", "prepara");

    $sql = "UPDATE presencas SET NomeAluno= :NomeAluno, DataPresenca = :DataPresenca,
    HoraPresenca = :HoraPresenca, DiaSemana = :DiaSemana,
    Computador = :Computador, IpComputador = :IpComputador
    WHERE Codigo = :Codigo";


    $execute = $conectar->prepare($sql);
    return $execute->execute($data);

}


function jaMarcada($data){

    $conectar = conectar("servidorouro", "bd_presencas", "prepara2", "prepara");

    $sql = "SELECT * FROM presencas WHERE CodigoContrato = :CodigoContrato AND
    DataPresenca = :DataPresenca AND HoraPresenca = :HoraPresenca";

    $query = $conectar->prepare($sql);

    $query->execute($data);
    return $query->fetch();
}

function delete($Codigo){

    $conectar = conectar("servidorouro", "bd_presencas", "prepara2", "prepara");
    $sql = "DELETE FROM presencas WHERE Codigo= :Codigo";
    $prepare = $conectar->prepare($sql);
    return $prepare->execute([
        "Codigo"=>$Codigo,
    ]);
}