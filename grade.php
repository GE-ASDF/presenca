<?php
session_start();
include_once "conectar.php";
$limite = 15;

    include "partials/cabecalho.php"; ?>

 <div class="container-fluid">

 <?php
 
    include "partials/menu.php";
    try{
        $conectar = conectar("servidorouro", "bd_presencas", "prepara2", "prepara");
        $sql = "SELECT DataPresenca, DiaSemana,
        SUM(CASE WHEN HoraPresenca = '08:00' THEN 1 ELSE 0 END) AS '08:00',
        SUM(CASE WHEN HoraPresenca = '09:00' THEN 1 ELSE 0 END) AS '09:00',
        SUM(CASE WHEN HoraPresenca = '10:00' THEN 1 ELSE 0 END) AS '10:00',
        SUM(CASE WHEN HoraPresenca = '11:00' THEN 1 ELSE 0 END) AS '11:00',
        SUM(CASE WHEN HoraPresenca = '12:00' THEN 1 ELSE 0 END) AS '12:00',
        SUM(CASE WHEN HoraPresenca = '13:00' THEN 1 ELSE 0 END) AS '13:00',
        SUM(CASE WHEN HoraPresenca = '14:00' THEN 1 ELSE 0 END) AS '14:00',
        SUM(CASE WHEN HoraPresenca = '15:00' THEN 1 ELSE 0 END) AS '15:00',
        SUM(CASE WHEN HoraPresenca = '16:00' THEN 1 ELSE 0 END) AS '16:00',
        SUM(CASE WHEN HoraPresenca = '17:00' THEN 1 ELSE 0 END) AS '17:00',
        SUM(CASE WHEN HoraPresenca = '18:00' THEN 1 ELSE 0 END) AS '18:00',
        SUM(CASE WHEN HoraPresenca = '19:00' THEN 1 ELSE 0 END) AS '19:00'
        FROM presencas GROUP BY DataPresenca, DiaSemana
        ORDER BY DataPresenca, HoraPresenca";
        $query = $conectar->query($sql);
        $grade = $query->fetchAll();
    }catch(PDOException $e){

    }

 ?>

    <main>
       
            <h1 class="title text-white mt-2 p-2" style="text-align:left;">Grade de horários</h1>
            <label class="title text-white">Pesquisar: </label> <input placeholder="Pesquise por: data, dia da semana, total de presenças" autofocus type="text" id="txtBusca" class="form-control">
            <table class="table table-dark">
        <thead>
            <tr>   
                <th></th>
                <th></th>
                <th colspan="12" style="text-align:center;">HORÁRIO</th>
            </tr>
            <tr>
                <th>Data da grade</th>
                <th>Dia da semana</th>
                <th>08:00</th>
                <th>09:00</th>
                <th>10:00</th>
                <th>11:00</th>
                <th>12:00</th>
                <th>13:00</th>
                <th>14:00</th>
                <th>15:00</th>
                <th>16:00</th>
                <th>17:00</th>
                <th>18:00</th>
                <th>19:00</th>
                <th>Total geral</th>
            </tr>
    </thead>
    <tbody id="tbody">
        <?php $i = 0; foreach($grade as $g): ?>

            <tr class="linha">
                <td><?php echo $g["DataPresenca"] ?></td>
                <td><?php echo $g["DiaSemana"] ?></td>
                <td style="text-align:center;border:1px solid #fff;background:<?php echo $g["08:00"] >= $limite ? "red":"#556B2F" ?>"><a class="nav-link" href="horario.php?DataPresenca=<?php echo $g['DataPresenca']?>&HoraPresenca=08:00&DiaSemana=<?php echo $g['DiaSemana'] ?>" ><?php echo $g["08:00"]; ?></a></td>
                <td style="text-align:center;border:1px solid #fff;background:<?php echo $g["09:00"] >= $limite ? "red":"#556B2F" ?>"><a class="nav-link" href="horario.php?DataPresenca=<?php echo $g['DataPresenca']?>&HoraPresenca=09:00&DiaSemana=<?php echo $g['DiaSemana'] ?>" ><?php echo $g["09:00"]; ?></a></td>
                <td style="text-align:center;border:1px solid #fff;background:<?php echo $g["10:00"] >= $limite ? "red":"#556B2F" ?>"><a class="nav-link" href="horario.php?DataPresenca=<?php echo $g['DataPresenca']?>&HoraPresenca=10:00&DiaSemana=<?php echo $g['DiaSemana'] ?>" ><?php echo $g["10:00"]; ?></a></td>
                <td style="text-align:center;border:1px solid #fff;background:<?php echo $g["11:00"] >= $limite ? "red":"#556B2F" ?>"><a class="nav-link" href="horario.php?DataPresenca=<?php echo $g['DataPresenca']?>&HoraPresenca=11:00&DiaSemana=<?php echo $g['DiaSemana'] ?>" ><?php echo $g["11:00"]; ?></a></td>
                <td style="text-align:center;border:1px solid #fff;background:<?php echo $g["12:00"] >= $limite ? "red":"#556B2F" ?>"><a class="nav-link" href="horario.php?DataPresenca=<?php echo $g['DataPresenca']?>&HoraPresenca=12:00&DiaSemana=<?php echo $g['DiaSemana'] ?>" ><?php echo $g["12:00"]; ?></a></td>
                <td style="text-align:center;border:1px solid #fff;background:<?php echo $g["13:00"] >= $limite ? "red":"#556B2F" ?>"><a class="nav-link" href="horario.php?DataPresenca=<?php echo $g['DataPresenca']?>&HoraPresenca=13:00&DiaSemana=<?php echo $g['DiaSemana'] ?>" ><?php echo $g["13:00"]; ?></a></td>
                <td style="text-align:center;border:1px solid #fff;background:<?php echo $g["14:00"] >= $limite ? "red":"#556B2F" ?>"><a class="nav-link" href="horario.php?DataPresenca=<?php echo $g['DataPresenca']?>&HoraPresenca=14:00&DiaSemana=<?php echo $g['DiaSemana'] ?>" ><?php echo $g["14:00"]; ?></a></td>
                <td style="text-align:center;border:1px solid #fff;background:<?php echo $g["15:00"] >= $limite ? "red":"#556B2F" ?>"><a class="nav-link" href="horario.php?DataPresenca=<?php echo $g['DataPresenca']?>&HoraPresenca=15:00&DiaSemana=<?php echo $g['DiaSemana'] ?>" ><?php echo $g["15:00"]; ?></a></td>
                <td style="text-align:center;border:1px solid #fff;background:<?php echo $g["16:00"] >= $limite ? "red":"#556B2F" ?>"><a class="nav-link" href="horario.php?DataPresenca=<?php echo $g['DataPresenca']?>&HoraPresenca=16:00&DiaSemana=<?php echo $g['DiaSemana'] ?>" ><?php echo $g["16:00"]; ?></a></td>
                <td style="text-align:center;border:1px solid #fff;background:<?php echo $g["17:00"] >= $limite ? "red":"#556B2F" ?>"><a class="nav-link" href="horario.php?DataPresenca=<?php echo $g['DataPresenca']?>&HoraPresenca=17:00&DiaSemana=<?php echo $g['DiaSemana'] ?>" ><?php echo $g["17:00"]; ?></a></td>
                <td style="text-align:center;border:1px solid #fff;background:<?php echo $g["18:00"] >= $limite ? "red":"#556B2F" ?>"><a class="nav-link" href="horario.php?DataPresenca=<?php echo $g['DataPresenca']?>&HoraPresenca=18:00&DiaSemana=<?php echo $g['DiaSemana'] ?>" ><?php echo $g["18:00"]; ?></a></td>
                <td style="text-align:center;border:1px solid #fff;background:<?php echo $g["19:00"] >= $limite ? "red":"#556B2F" ?>"><a class="nav-link" href="horario.php?DataPresenca=<?php echo $g['DataPresenca']?>&HoraPresenca=19:00&DiaSemana=<?php echo $g['DiaSemana'] ?>" ><?php echo $g["19:00"]; ?></a></td>
                <td style="text-align:center;font-weight:bold" class="totalGeral"></td>
            </tr>
       
        <?php endforeach; ?>
    </tbody>
    </table>

    </main>

</div>
<script>
    const TXTBUSCA = document.querySelector("#txtBusca");
    let tr2 = tbody.getElementsByClassName("linha")
    
    function calcTotal(){
    
    for(let posicao in tr2){
        
        if(true === isNaN(posicao)){
            continue;
        }
        let tds = Array.from(tr2[posicao].querySelectorAll("td:nth-child(n + 3)"));
        let totalTd = tr2[posicao].querySelector(".totalGeral");
        let initialValue = 0;

        let valor = tds.map(i=>{
            let numero = Number(i.innerText.trim());
            return numero;
        })
        let totalGeralValor = valor.reduce((valorAtual, acum)=> valorAtual + acum)
        totalTd.innerText += totalGeralValor;
    }
}
calcTotal();
if(TXTBUSCA){
    
    const tbody = document.querySelector("#tbody");
    let tr = tbody.getElementsByClassName("linha")
    
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