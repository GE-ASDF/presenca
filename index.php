<?php

try{    
    $conn = new PDO("mysql:host=servidorescola;dbname=preparaadm;port=3307", "prepcurso", "ke7@ch%");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        if($_POST){
            $CodigoContrato = isset($_POST["CodigoContrato"]) ? $_POST["CodigoContrato"]:"";
            $DataPresenca = isset($_POST["DataPresenca"]) ? $_POST["DataPresenca"]:"";
         
            if($CodigoContrato != ""){
                $sql = "SELECT * FROM pr_perfilalunos WHERE CodigoContrato = " . $CodigoContrato . " LIMIT 1";
                $query = $conn->prepare($sql);
                $query->execute();
                $aluno = $query->fetch(PDO::FETCH_OBJ);
                if(!is_null($aluno->CodigoContrato)){
                    $conn2 = new PDO("mysql:host=servidorouro;dbname=bd_presencas;", "prepara2", "prepara");
                    $conn2->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    
                    $sql2 = "SELECT * FROM presencas WHERE CodigoContrato = :CodigoContrato AND
                    DataPresenca = :DataPresenca";

                    $query2= $conn2->prepare($sql2);
                    $query2->execute([
                        "CodigoContrato" => $CodigoContrato,
                        "DataPresenca" => $DataPresenca,
                    ]);
                    $aluno2 = $query2->fetch(PDO::FETCH_OBJ);
                   
                    
                    if(!$aluno2){

                        $sql = "INSERT INTO presencas(CodigoContrato, DataPresenca, HoraPresenca, DiaSemana,
                        Computador) VALUES(:CodigoContrato, :DataPresenca, :HoraPresenca, :DiaSemana, :Computador)";
                        $data = [
                        'CodigoContrato' => isset($_POST["CodigoContrato"]) ? $_POST["CodigoContrato"]:"",
                        'DataPresenca' => isset($_POST["DataPresenca"]) ? $_POST["DataPresenca"]:"",
                        'HoraPresenca' => isset($_POST["HoraPresenca"]) ? $_POST["HoraPresenca"]:"",
                        'DiaSemana' => isset($_POST["DiaSemana"]) ? $_POST["DiaSemana"]:"",
                        'Computador' => isset($_POST["Computador"]) ? $_POST["Computador"]:"",
                    ];
                    $execute = $conn2->prepare($sql);
                    $teste = $execute->execute($data);
                    if($teste){
                        $_SESSION["sucesso"] =  "<p class='alert alert-success'> A presença foi confirmada com sucesso. </p>";
                        header("/presenca");
                    }
                    }else{
                        $_SESSION["confirmada"] = "<p class='alert alert-primary'> A sua presença já foi confirmada. </p>";
                        header("/presenca");
                    }
                }else{
                    $_SESSION["naoencontrado"] = "<p class='alert alert-danger'> Usuário não encontrado. Tente digitar novamente. </p>";
                    header("/presenca");
                }     

            }
        }
    }catch(PDOException $e){
        var_dump($e->getMessage());
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dê sua presença</title>
    <!-- CSS only -->
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
        ?>
    </div>
    <form action="index.php" method="POST">
            <h1 class="title text-white">Confirme a sua presença</h1>
        <div class="contrato">
            <label class="form-label" for="CodigoContrato">
                Usuário:</label>
            <input autofocus type="text" class="form-control" name="CodigoContrato">
        </div>
            
        <div class="data-hora m-1">
            <input class="form-control" type="text" readonly name="DataPresenca">
            <input class="form-control" type="text" readonly name="HoraPresenca">
        </div>

        <div class="dia-semana m-1">
            <input class="form-control" type="text" readonly name="DiaSemana">
        </div>
        <div class="computador m-1">
            <input value="<?php echo $_SERVER["REMOTE_ADDR"] ?>" class="form-control" type="text" readonly name="Computador">
        </div>
        <button class="btn btn-dark m-1">Registrar</button>
    </form>
    </div>

    <script>
        const $ = (selector)=>document.querySelector(selector);
        const diasSemana = ["Domingo", "Segunda-feira", "Terça-feira", "Quarta-feira", "Quinta-feira", "Sexta-feira", "Sábado"];
        const button = $("button");
        const allowedKeys = ['0',"1", "2","3","4","5","6","7","8","9"];
        const DataPresenca = $("[name='DataPresenca']")
        const CodigoContrato = $("[name='CodigoContrato']")
        const HoraPresenca = $("[name='HoraPresenca']")
        const DiaSemana = $("[name='DiaSemana']")

        const objectDate = new Date();
        CodigoContrato.addEventListener("keydown", (ev)=>{
            ev.preventDefault();
            let keyDown = ev.key.toLowerCase();
            if(allowedKeys.includes(keyDown)){
                CodigoContrato.value += keyDown;
            }
            if(keyDown ==='f5'){
                window.location.href = "/presenca";
            }
            if(keyDown === 'backspace'){
                CodigoContrato.value = CodigoContrato.value.slice(0,-1);
            }
            if(keyDown === 'enter'){
                button.click();
            }
        })
        function createDate(){
            let day = objectDate.getDate();
            let month = objectDate.getMonth() + 1;
            let fullYear = objectDate.getFullYear();
            return `${day}/${month}/${fullYear}`;
        }

        function createHour(){
            let hour = objectDate.getHours();
            return `${hour}:00`;
        }

        function getWeekDayName(){
            let dayWeekNumber = objectDate.getDay();
            return diasSemana[dayWeekNumber];
        }

        window.addEventListener("load", function(){
            DataPresenca.value = createDate();
            HoraPresenca.value = createHour();
            DiaSemana.value = getWeekDayName();
        })

    </script>
</body>
</html>