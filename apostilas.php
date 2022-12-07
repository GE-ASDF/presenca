<?php 
session_start();
$title = "Cadastrar apostilas";
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

        $sql = "SELECT NomeAluno, CodigoContrato, NomeMateria, MateriaCorrente, CodigoContratoCursoMateria FROM loginagendamentoaluno WHERE MateriaCorrente = 'S' GROUP BY CodigoContrato";
        $conectar = conectar("servidorescola", "preparaadm", "prepcurso", "ke7@ch%","3307");
        $query = $conectar->prepare($sql);
        $query->execute();
        $presencas = $query->fetchAll();
    }catch(PDOException $e){
        var_dump($e->getMessage());
    }

?>
    <?php
        if(isset($_SESSION["message"])){ ?>
     
           <?php 
           echo $_SESSION["message"]; 
           unset($_SESSION["message"]);
           ?>

        <?php } ?>
    <label class="mt-4 title text-white">Pesquisar: </label> <input placeholder="Pesquise por: contrato, nome, data ou horário" autofocus type="text" id="txtBusca" class="form-control">
    <table class="table table-dark">
  <thead>
    <tr>
        <form id="All" method="POST" action="cadastrarApostila.php?criterio=all">
            <td>
                <input type="hidden" value="AAAA-BBBB" name="Codigo2">
                <button type="submit" class="btn btn-danger">Cadastrar para todos</button>
            </td>
        </form>
    </tr>
    <tr>
      <th scope="col">Código do Contrato</th>
      <th scope="col">Nome do aluno</th>
      <th scope="col">Nome da matéria</th>
      <th scope="col">Ações</th>
    </tr>
  </thead>
  <tbody id="tbody">
    <?php
    foreach($presencas as $presenca): ?>
    <tr class="linha">
      <td><?php echo $presenca["CodigoContrato"] ?></td>
      <td><?php echo $presenca["NomeAluno"] ?></td>
      <td><?php echo $presenca["NomeMateria"] ?></td>
    <form action="cadastrarApostila.php?criterio=one" method="POST">
        <td class="d-flex justify-content-center">
            <input type="hidden" value="<?php echo $presenca["CodigoContratoCursoMateria"] ?>" name="CodigoContratoCursoMateria">
            <input type="hidden" name="Codigo">
            <input type="hidden" value="<?php echo $presenca["NomeAluno"] ?>" name="NomeAluno">
            <button type="submit" class="btn btn-danger">Cadastrar apostila</button>
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
    let Codigo = Array.from(document.querySelectorAll("[name='Codigo']"));
    const btnAll = document.querySelector("#All");

    btnAll.addEventListener("submit", (ev)=>{
        let confirm = confirm("Você deseja cadastrar para todos os alunos?");

        if(!confirm){
            ev.preventDefault();
        }
    })
   
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

class gerador2 {
    constructor(passLen) {
        const alphabet = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'];
        let pass;
        this.passLen = passLen;
        let passArray = [];

        this.gen = () => {
            for (let i = 0; i < passLen; i++) {
                passArray.push(alphabet[Math.abs(Math.random().toFixed(1) * 10)]);
            }
        };

        this.brokeAndCreateCode = (init1, end1, init2, end2, separador) => {
            pass = passArray.join("").substring(init1, end1) + separador + passArray.join("").substring(init2, end2);
            return pass;
        };
    }
}
let gene = new gerador2(8);

Codigo.forEach(i=>{
    gene.gen();
    i.value = gene.brokeAndCreateCode(0,4,4,8,"-");
})

    
</script>
<?php }else{
    return header("Location:/presenca/login.php");
}?>

</body>
</html>