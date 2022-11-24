<?php

include "marcarPresenca.php";
include "verifica.php";


if($_POST){
    $numeroContrato = isset($_POST["CodigoContrato"]) ? filter_var($_POST["CodigoContrato"], FILTER_SANITIZE_STRING):"";
    $HoraPresenca = isset($_POST["HoraPresenca"]) ? $_POST["HoraPresenca"]:"";

    if($numeroContrato AND $HoraPresenca){

        $prepara = verificaPrepara($numeroContrato);

        if($prepara){
            $marcado = false;
            
            foreach($HoraPresenca as $hora){
                $marcado = marcar($numeroContrato, $hora);
            }
           
            if($marcado){
                $_SESSION["sucesso"] =  "<p class='alert alert-success'> A presença foi confirmada com sucesso. </p>";
            }else{
                $_SESSION["confirmada"] = "<p class='alert alert-primary'> A sua presença já foi confirmada. Obrigado e boa aula! </p>";
            }

        }else{

            $ouro = verificaOuro($numeroContrato);

            if($ouro){

                $marcado = false;

                foreach($HoraPresenca as $hora){
                    $marcado = marcar($numeroContrato, $hora);
                }

                if($marcado){
                    $_SESSION["sucesso"] =  "<p class='alert alert-success'> A presença foi confirmada com sucesso. </p>";
                }else{
                    $_SESSION["confirmada"] = "<p class='alert alert-primary'> A sua presença já foi confirmada. Obrigado e boa aula! </p>";
                }
            }else{
                $_SESSION["naoencontrado"] = "<p class='alert alert-danger'> Usuário não encontrado. Clique no botão de voltar e tente novamente. </p>";
            }
        }
    }else{
        $_SESSION["vazio"] = "<p class='alert alert-danger'>Clique em voltar, digite um usuário válido e marque os horários da sua aula.</p>";
    }

}else{
    $_SESSION["vazio"] = "<p class='alert alert-danger'>Clique em voltar, digite um usuário válido e marque os horários da sua aula.</p>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Marcar presença</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="container">
    <div class="alertas">
        <?php 
             if(isset($_SESSION["sucesso"])){
                echo $_SESSION["sucesso"];
                unset($_SESSION);
            }
            if(isset($_SESSION["naoencontrado"])){
                echo $_SESSION["naoencontrado"];
                unset($_SESSION);
            }
            if(isset($_SESSION["confirmada"])){
                echo $_SESSION["confirmada"];
                unset($_SESSION);
            }
            if(isset($_SESSION["vazio"])){
                echo $_SESSION["vazio"];
                unset($_SESSION);
            }
        ?>
    </div>
        <button class="btn btn-danger" onclick="backToSite()">Voltar</button>
    </div>
        <script>
            function backToSite(){
               return window.location.href = '/presenca';
            }
        </script>
</body>
</html>