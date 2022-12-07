<?php
session_start();
header("Content-type: text/html; charset=utf-8");

include "marcarPresenca.php";
include "verifica.php";

if($_POST){
    $numeroContrato = isset($_POST["CodigoContrato"]) ? filter_var($_POST["CodigoContrato"], FILTER_SANITIZE_STRING):"";
    $HoraPresenca = isset($_POST["HoraPresenca"]) ? $_POST["HoraPresenca"]:"";
    $pg = isset($_GET["pg"]) ? filter_var($_GET["pg"], FILTER_SANITIZE_STRING):"";
    
    if($pg != ''){
        $pg = $pg . ".php";
    }

    if($numeroContrato AND $HoraPresenca){

        $prepara = verificaPrepara($numeroContrato);

        if($prepara){
            $marcado = false;
            
            foreach($HoraPresenca as $hora){
                $marcado = marcar($numeroContrato, $hora, $prepara["NomeAluno"]);
            }
            if($marcado){
                echo 1;
                return;
            }else{
                echo 3;
                return;
            }

        }else{

            $ouro = verificaOuro($numeroContrato);

            if($ouro){

                $marcado = false;

                foreach($HoraPresenca as $hora){
                    $marcado = marcar($numeroContrato, $hora, $ouro["NOME"]);
                }

                if($marcado){
                    echo 1;
                    return;
                }else{
                    echo 3;
                    return;
                }
            }else{
                echo 2;
                return;
            }
        }
    }else{
        echo 2;
        return;
    }
    
}else{
    echo 2;
    return;
}
?>