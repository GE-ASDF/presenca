<?php
session_start();
$title = "Alunos presentes";
include_once "conectar.php";
    include "partials/cabecalho.php"; ?>

 <div class="container-fluid">

 <?php
 
    include "partials/menu.php";
    $DataPresenca = isset($_GET['DataPresenca']) ? filter_var($_GET["DataPresenca"], FILTER_SANITIZE_STRING):"";
    $HoraPresenca = isset($_GET['HoraPresenca']) ? filter_var($_GET["HoraPresenca"], FILTER_SANITIZE_STRING):"";
    $DiaSemana = isset($_GET['DiaSemana']) ? filter_var($_GET["DiaSemana"], FILTER_SANITIZE_STRING):"";
    
    try{
        if($DataPresenca){
            $conectar = conectar("servidorouro", "bd_presencas", "prepara2", "prepara");
            $sql = "SELECT * FROM presencas WHERE DataPresenca = :DataPresenca AND HoraPresenca = :HoraPresenca";
            $query = $conectar->prepare($sql);
            $query->execute(["DataPresenca" => $DataPresenca, "HoraPresenca" => $HoraPresenca]);
            $grade = $query->fetchAll();
        }else{
            $conectar = conectar("servidorouro", "bd_presencas", "prepara2", "prepara");
            $sql = "SELECT DISTINCT * FROM presencas WHERE DiaSemana = :DiaSemana AND HoraPresenca = :HoraPresenca GROUP BY CodigoContrato";
            $query = $conectar->prepare($sql);
            $query->execute(["DiaSemana" => $DiaSemana, "HoraPresenca" => $HoraPresenca]);
            $grade = $query->fetchAll();
        }
    }catch(PDOException $e){
        var_dump($e->getMessage());
    }

 ?>

    <main>
       
            <h1 class="title text-white mt-2 p-2" style="text-align:left;">
            <?php if(!isset($_GET["pg"]) && $_GET["pg"] != "flex" ): ?>
            Presenças de <?php echo $DataPresenca ?> às <?php echo $HoraPresenca ?>, <?php echo $DiaSemana ?></h1>
            <?php else: ?>
                Grade flex de <?php echo $DiaSemana ?> às <?php echo $HoraPresenca ?>.</h1>
            <?php endif; ?>
            <label class="title text-white">Pesquisar: </label> <input placeholder="Pesquise por: data, dia da semana, total de presenças" autofocus type="text" id="txtBusca" class="form-control">
            <div class="tabelas">
            <table class="table table-dark">
                <thead>
                    <tr>
                        <th>Total de alunos: <?php echo count($grade) ?></th>
                    </tr>
                    <tr>
                        <th>Codigo do contrato</th>
                        <th>Nome do aluno</th>
                        <th>Computador</th>
                        <th>IP do computador</th>
                        <th style="text-align:center;" colspan="2">Ações</th>
                    </tr>
                </thead>
                <tbody id="tbody">
                    <?php foreach($grade as $aluno):?>
                        <tr class="linha">
                            <td><?php echo $aluno["CodigoContrato"] ?></td>
                            <td><?php echo $aluno['NomeAluno']; ?></td>
                            <td><?php echo $aluno['Computador']; ?></td>
                            <td><?php echo $aluno['IpComputador']; ?></td>
                            <td><a class="btn btn-primary" style="background:#600080;" href="editar.php?Codigo=<?php echo $aluno["Codigo"]?>&pg=grade">Editar</a></td>
                            <td>
                                <a onclick="confirmar2(this, '<?php echo $aluno['NomeAluno'] ?>')" class="apagar btn btn-danger" class="btn btn-danger">Apagar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
    </main>

</div>
<script>
    const TXTBUSCA = document.querySelector("#txtBusca");
    let qtdRegistros = [];
    
    function confirmar2(actualLink, NomeAluno) {
    const confirm2 = confirm(`Deseja apagar a presença de ${NomeAluno}?`)
        if(confirm2){
            actualLink.setAttribute("href", "delete.php?pg=grade&Codigo=<?php echo $aluno["Codigo"]?>");
        }
    }
    
    
   
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