<?php 
session_start();
$title = "Página inicial";
include "partials/cabecalho.php"; 
$limite = 15;
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


    include "./functions/selects.php";
    $dias = selectDiasSemana();
    $horarios = selectHorarios();
    $grade = selectGrade();
    include_once "conectar.php";
?>
 <div class="alertas">
        <?php 
             if(isset($_SESSION["sucesso"])){
                echo $_SESSION["sucesso"];
                unset($_SESSION["sucesso"]);
            }
            if(isset($_SESSION["naoencontrado"])){
                echo $_SESSION["naoencontrado"];
                unset($_SESSION["naoencontrado"]);
            }
            if(isset($_SESSION["confirmada"])){
                echo $_SESSION["confirmada"];
                unset($_SESSION["confirmada"]);
            }
            if(isset($_SESSION["vazio"])){
                echo $_SESSION["vazio"];
                unset($_SESSION["vazio"]);
            }
        ?>
    </div>
    <?php
$conectar = conectar("servidorouro", "bd_presencas", "prepara2", "prepara");
$sql = "INSERT INTO grade(CodigoDiaSemana, CodigoHorario, QtdAlunos) VALUES(:CodigoDiaSemana, :CodigoHorario, :QtdAlunos)";
if($_POST){

    $CodigoDiaSemana = isset($_POST["CodigoDiaSemana"]) ? $_POST["CodigoDiaSemana"]:"";
    $CodigoHorario =  isset($_POST["CodigoHorario"]) ? $_POST["CodigoHorario"]:"";
    $QtdAlunos = isset($_POST["QtdAlunos"]) ? $_POST["QtdAlunos"]:"";
    
    $data = [
        "CodigoDiaSemana" => $CodigoDiaSemana,
        "CodigoHorario" => $CodigoHorario,
        "QtdAlunos" => $QtdAlunos
    ];

    $sql2 = "SELECT * FROM grade WHERE CodigoDiaSemana = :CodigoDiaSemana AND CodigoHorario = :CodigoHorario";
    $prepare = $conectar->prepare($sql2);

    $prepare->execute([
        "CodigoDiaSemana" => $data["CodigoDiaSemana"],
        "CodigoHorario" => $data["CodigoHorario"],
    ]);        
    $jaTem = $prepare->fetch();
    
    if($jaTem === false){
        $prepare2 = $conectar->prepare($sql);
        $foi = $prepare2->execute($data); 
            if($foi){
                $_SESSION["sucesso"] = "<span class='d-flex align-items-center justify-content-between alert alert-success'>
                    A quantidade de alunos foi cadastrada com sucesso.
                <span onclick='refresh()' style='cursor:pointer' class='p-2'>X</span>";
                return header("Location:/presenca/atualizar.php");
            }else{
                $_SESSION["sucesso"] = "<span class='d-flex align-items-center justify-content-between alert alert-success'>
                A quantidade de alunos não foi cadastrada. Tente novamente!
                <span onclick='refresh()' style='cursor:pointer' class='p-2'>X</span>";
                return header("Location:/presenca/atualizar.php");
            }
        }else{
            $sql3 = "UPDATE grade SET QtdAlunos = :QtdAlunos WHERE CodigoDiaSemana = :CodigoDiaSemana AND CodigoHorario = :CodigoHorario";
            $prepare3 = $conectar->prepare($sql3);
            $prepare3->execute($data); 
            if($prepare3->rowCount() > 0){
                $_SESSION["sucesso"] = "<span class='d-flex align-items-center justify-content-between alert alert-success'>
                A quantidade de alunos foi atualizada com sucesso.
                <span onclick='refresh()' style='cursor:pointer' class='p-2'>X</span>";
                return header("Location:/presenca/atualizar.php");
            
        };
    }
    

}?>

<form id="qtdAlunos" method="POST" action="atualizar.php" class="bg-dark d-flex justify-content-end align-items-end">
  <div class="form-group text-white m-1">
    <select class="form-select" name="CodigoDiaSemana">
        <?php foreach($dias as $dia): ?>
            <option value="<?php echo $dia['Codigo'] ?>"><?php echo $dia['NomeDiaSemana'] ?></option>
        <?php endforeach; ?>
    </select>
  </div>
  <div class="form-group m-1 text-white">
    <select class="form-select" name="CodigoHorario">
        <?php foreach($horarios as $horario): ?>
            <option value="<?php echo $horario['CodigoHorario'] ?>"><?php echo $horario['Horario'] ?></option>
        <?php endforeach; ?>
    </select>
  </div>
  <div class="form-group m-1 text-white">
    <input placeholder="Quantidade de alunos" type="text" name="QtdAlunos" class="form-control">
  </div>
  <div class="form-group align-self-center">
      <button type="submit" class="btn btn-primary">Registrar</button>
  </div>
</form>

<label class="title text-white">Pesquisar: </label> 
<input placeholder="Pesquise por: contrato, nome, data ou horário" autofocus type="text" id="txtBusca" class="form-control mb-4">
<table class="table table-dark">
  <thead>
    <tr class="text-center">
      <th scope="col">Horário</th>
      <th scope="col">Segunda-feira</th>
      <th scope="col">Terça-feira</th>
      <th scope="col">Quarta-feira</th>
      <th scope="col">Quinta-feira</th>
      <th scope="col">Sexta-feira</th>
      <th scope="col">Sábado</th>
    </tr>
  </thead>
  <tbody id="tbody">
        
    <?php foreach($grade as $g): ?>
        <tr style="border:1px solid #fff;" class="linha text-center">
            <td><?php echo $g["Horario"] ?></td>
            <td class="<?php echo $g["Segunda-feira"] >= $limite ? "bg-danger":"bg-success" ?>"><a class="nav-link" href="horario.php?pg=flex&DiaSemana=Segunda-feira&HoraPresenca=<?php echo $g['Horario']?>"><?php echo $g["Segunda-feira"] ?></a></td>
            <td class="<?php echo $g["Terça-feira"] >= $limite ? "bg-danger":"bg-success" ?>"><a class="nav-link" href="horario.php?pg=flex&DiaSemana=Terça-feira&HoraPresenca=<?php echo $g['Horario']?>"><?php echo $g["Terça-feira"] ?></a></td>
            <td class="<?php echo $g["Quarta-feira"] >= $limite ? "bg-danger":"bg-success" ?>""><a class="nav-link" href="horario.php?pg=flex&DiaSemana=Quarta-feira&HoraPresenca=<?php echo $g['Horario']?>"><?php echo $g["Quarta-feira"] ?></a></td>
            <td class="<?php echo $g["Quinta-feira"] >= $limite ? "bg-danger":"bg-success" ?>"><a class="nav-link" href="horario.php?pg=flex&DiaSemana=Quinta-feira&HoraPresenca=<?php echo $g['Horario']?>"><?php echo $g["Quinta-feira"] ?></a></td>
            <td class="<?php echo $g["Sexta-feira"] >= $limite ? "bg-danger":"bg-success" ?>""><a class="nav-link" href="horario.php?pg=flex&DiaSemana=Sexta-feira&HoraPresenca=<?php echo $g['Horario']?>"><?php echo $g["Sexta-feira"] ?></a></td>
            <td class="<?php echo $g["Sábado"] >= $limite ? "bg-danger":"bg-success" ?>"><a class="nav-link" href="horario.php?pg=flex&DiaSemana=Sábado&HoraPresenca=<?php echo $g['Horario']?>"><?php echo $g["Sábado"] ?></a></td>
        </tr>
    <?php endforeach; ?>
  </tbody>
</table>
    </main>
</div>

<?php 
}else{
    return header("Location:/presenca/login.php");
}?>
<script>
    const qtdAlunos = document.querySelector("#qtdAlunos")
    qtdAlunos.addEventListener("submit", (ev)=>{
        let confirm3 = confirm("Deseja salvar o registro?")        
        if(!confirm3){
            ev.preventDefault();
        }
    })
    function refresh() {
    window.location.reload();
}
</script>
<script>
    const TXTBUSCA = document.querySelector("#txtBusca");

 
    
    
   
if(TXTBUSCA){
    
    const tbody = document.querySelector("#tbody");
    TXTBUSCA.addEventListener("keyup", function(){
        
        let filtro = TXTBUSCA.value.toLowerCase().trim();
    // let tr = tbody.getElementsByTagName("tr")
    let tr = tbody.getElementsByClassName("linha")
    
    for(let posicao in tr){
        
        if(true === isNaN(posicao)){
            continue;
        }
        let value = tr[posicao].innerHTML.toLowerCase().trim();
        if(true === value.includes(filtro)){
            tr[posicao].style.display = '';
        }else{
            tr[posicao].style.display = "none"
        }
    }

})

}   
    
</script>
</body>
</html>

