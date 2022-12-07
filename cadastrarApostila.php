<?php
session_start();
include_once "conectar.php";

$type = isset($_GET["criterio"]) ? filter_var($_GET["criterio"], FILTER_SANITIZE_STRING):"";

if($type == 'all'){
    if($_POST){
        
        $Codigo = isset($_POST["Codigo2"]) ? filter_var($_POST["Codigo2"], FILTER_SANITIZE_NUMBER_INT):"";
    
        if($Codigo){
           
            try{

                $sql = "SELECT NomeAluno, CodigoContrato, CodigoContratoCursoMateria FROM loginagendamentoaluno WHERE MateriaCorrente = 'S'";
                $conectar = conectar("servidorescola", "preparaadm", "prepcurso", "ke7@ch%","3307");
                $query = $conectar->prepare($sql);
                $query->execute();
                $presencas = $query->fetchAll();
                
                foreach($presencas as $presenca){
                    $situacao = false;
                    $data=[
                        "Codigo" => $Codigo,
                        "Data"=> "2022-12-01 09:33:04",
                        "Exportado"=> "S",
                        "CodigoContrato" => $presenca["CodigoContratoCursoMateria"]
                    ];

                    $sql2 = "INSERT INTO pr_codigosapostila(Codigo, Data, Exportado, CodigoContrato) VALUES(:Codigo, :Data, :Exportado, :CodigoContrato)";
                    $query = $conectar->prepare($sql2);
                    $situacao = $query->execute($data);
                }

                if($situacao){
                    $_SESSION["message"] = "<p class='alert alert-success'> As apostilas foram cadastradas com sucesso! </p>";
                    header("Location:/presenca/apostilas.php");
                }
                
            }catch(PDOException $e){
                var_dump($e->getMessage());
            }
        }else{
            header("Location:/presenca/apostilas.php");
        }
    }else{
        header("Location:/presenca/apostilas.php");
    }
}elseif($type == "one"){
    
    try{
        $conectar = conectar("servidorescola", "preparaadm", "prepcurso", "ke7@ch%","3307");
        $Codigo = isset($_POST["Codigo"]) ? filter_var($_POST["Codigo"], FILTER_SANITIZE_STRING):"";
        $NomeAluno = isset($_POST["NomeAluno"]) ? filter_var($_POST["NomeAluno"], FILTER_SANITIZE_STRING):"";
        $CodigoContratoCursoMateria = isset($_POST["CodigoContratoCursoMateria"]) ? filter_var($_POST["CodigoContratoCursoMateria"], FILTER_SANITIZE_NUMBER_INT):"";
       
            $data=[
                "Codigo" => $Codigo,
                "Data"=> "2019-04-26 09:33:04",
                "Exportado"=> "S",
                "CodigoContrato" => $CodigoContratoCursoMateria
            ];

            $sql3 = "INSERT INTO pr_codigosapostila(Codigo, Data, Exportado, CodigoContrato) VALUES(:Codigo, :Data, :Exportado, :CodigoContrato)";
            $query = $conectar->prepare($sql3);
            $situacao = $query->execute($data);
           
            if($situacao){
                $_SESSION["message"] = "<p class='alert alert-success'> A apostila de {$NomeAluno} foi cadastrada com sucesso! </p>";
                header("Location:/presenca/apostilas.php");
            }
        }catch(PDOException $e){
            var_dump($e->getMessage());
        }
}else{
    header("location:/presenca/apostilas.php");
}
        
