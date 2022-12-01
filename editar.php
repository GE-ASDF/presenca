<?php 
session_start();
$title = "Editar horários";
include "partials/cabecalho.php"; 

?>


<?php 
    if(isset($_SESSION["logado"])){
?>
<div class="container-fluid">
<header>
        <?php
            include "partials/menu.php";
        ?>
</header>
    <main>

        
<?php

include_once "conectar.php";
if($_GET){
    $pg = isset($_GET['pg']) ? $_GET["pg"]:header("Location:/presenca/atualizar.php");
    $Codigo = isset($_GET["Codigo"]) ? $_GET["Codigo"]:header("Location: /presenca/atualizar.php");

    if($Codigo){

        try{
            
            $conectar = conectar("servidorouro", "bd_presencas", "prepara2", "prepara");
            $sql = "SELECT * FROM presencas WHERE Codigo = :Codigo";
            $query = $conectar->prepare($sql);
            $query->execute([
                "Codigo" => $Codigo,
            ]);
            $presenca = $query->fetch();

        }catch(PDOException $e){
            var_dump($e->getMessage());
        }
    }else{
        return header("Location:/presenca/atualizar.php");
    }
}else{
    return header("Location:/presenca/atualizar.php");
}

?>  
    <?php include "partials/cabecalho.php" ?>
    <div class="container">

    <form accept-charset="utf-8" action="update.php?pg=<?php echo $pg ?>" method="POST">
            <h1 class="title text-white">Atualizar presença</h1>

        <label class="form-label text-white" for="NomeAluno">Nome do aluno:</label>
        <input value="<?php echo $presenca["NomeAluno"] ?>" autofocus type="text" class="form-control mb-1" name="NomeAluno">
        <input value="<?php echo $presenca["Codigo"] ?>" type="hidden" class="form-control mb-1" name="Codigo">

        <div class="contrato">
            <label class="form-label" for="CodigoContrato">
                Usuário:</label>
            <input value="<?php echo $presenca["CodigoContrato"] ?>" readonly autofocus type="text" class="form-control" name="CodigoContrato">
        </div>

        <div class="data-hora m-1">
            <input class="form-control" type="text" value="<?php echo $presenca["DataPresenca"] ?>" placeholder="Data da presença" name="DataPresenca">
            <input class="form-control" type="text" value="<?php echo $presenca["HoraPresenca"] ?>" placeholder="Hora da presença" name="HoraPresenca">
            <input class="form-control" type="text" value="<?php echo $presenca["DiaSemana"] ?>" placeholder="Dia da semana" name="DiaSemana">
            <input class="form-control" type="hidden" value="<?php echo $presenca["IpComputador"] ?>" placeholder="IP do computador" name="IpComputador">
            <input class="form-control" type="hidden" value="<?php echo $pg ?>" placeholder="IP do computador" name="pg">
        </div>

        <div class="dia-semana m-1">
        </div>
        <div class="computador m-1">
            <input value="<?php echo $presenca["Computador"] ?>" class="form-control" placeholder="Nome do computador" type="text" name="Computador">
        </div>
        <button class="btn btn-dark m-1">Registrar</button>
    </form>
    </div>
    
    </main>
</div>
<?php }else{
        return header("Location:/presenca/login.php");
    }?>
       <script>
        const form = document.querySelector("form")
        const inputHora = document.querySelector("[name='HoraPresenca']");
        const CodigoContrato = document.querySelector("[name='CodigoContrato']");
        const DataPresenca = document.querySelector("[name='DataPresenca']");
        const HoraPresenca = document.querySelector("[name='HoraPresenca']");
        const DiaSemana = document.querySelector("[name='DiaSemana']");

        form.addEventListener("submit", (ev)=>{
 
            if(CodigoContrato.value && inputHora.value){

                let resposta = confirm("Deseja salvar os dados abaixo?\nCódigo do contrato: " + CodigoContrato.value + "\nData da presença: " + DataPresenca.value+"\nDia da semana: " + DiaSemana.value + "\nHora da presença: " + inputHora.value+"\nSe não tiver certeza peça para seu educador(a) confirmar.")
                
                if(!resposta){
                    ev.preventDefault();
                }

            }else{
                ev.preventDefault();
                return alert("O campo de USUÁRIO é obrigatório.");
            }
        })
    </script>
</body>
</html>
