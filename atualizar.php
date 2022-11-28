<?php 
session_start();
$title = "Atualizar horários";
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

    try{

        $sql = "SELECT * FROM presencas ORDER BY DataPresenca DESC";
        $conectar = conectar("servidorouro", "bd_presencas", "prepara2", "prepara");
        $query = $conectar->query($sql);
        $presencas = $query->fetchAll();
    }catch(PDOException $e){
        var_dump($e->getMessage());
    }

?>
    <?php
        if(isset($_SESSION["message"])){ ?>
        <p class="alert alert-primary mt-3">
           <?php 
           echo $_SESSION["message"]; 
           unset($_SESSION["message"]);
           ?>

        </p>
        <?php } ?>
    <label class="mt-4 title text-white">Pesquisar: </label> <input placeholder="Pesquise por: contrato, nome, data ou horário" autofocus type="text" id="txtBusca" class="form-control">
    <table class="table table-dark">
  <thead>
    <tr>
      <th scope="col">Código do Contrato</th>
      <th scope="col">Nome do aluno</th>
      <th scope="col">Data da presença</th>
      <th scope="col">Dia da semana</th>
      <th scope="col">Hora da presença</th>
      <th scope="col">Ações</th>
    </tr>
  </thead>
  <tbody id="tbody">
    <?php
    foreach($presencas as $presenca): ?>
    <tr class="linha">
      <td><?php echo $presenca["CodigoContrato"] ?></td>
      <td><?php echo $presenca["NomeAluno"] ?></td>
      <td><?php echo $presenca["DataPresenca"] ?></td>
      <td><?php echo $presenca["DiaSemana"] ?></td>
      <td><?php echo $presenca["HoraPresenca"] ?></td>
      <td><a class="btn btn-primary" style="background:#600080;" href="editar.php?Codigo=<?php echo $presenca["Codigo"] ?>">Editar</a></td>
    <form class="apagar" action="delete.php" method="GET">
        <td>
            <input type="hidden" value="<?php echo $presenca["Codigo"] ?>" name="Codigo">
            <button type="submit" class="btn btn-danger">Apagar</button>
        </td>
    </form>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>
    </main>
</div>
<script>
    const TXTBUSCA = document.querySelector("#txtBusca");
    let apagar = Array.from(document.querySelectorAll(".apagar"));

    function iterar(apaga){
        apaga.addEventListener("submit", (ev)=>{
            let resposta = confirm("Deseja apagar o registro?");

            if(!resposta){
                ev.preventDefault();
            }

        })
    }
    apagar.forEach(iterar);
       
   
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
<?php }else{
        return header("Location:/presenca/login.php");
    }?>

</body>
</html>