<?php
    session_start();
    $title = "Dê a sua presença";
 include "partials/cabecalho.php" ?>
 <div class="container-fluid">
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
       
</div>
    <div class="container">    

    <form accept-charset="utf-8" action="cadastrar.php" method="POST">
            <h1 class="title text-white">Confirme a sua presença</h1>
        <div class="contrato">
            <label class="form-label" for="CodigoContrato">
                Usuário:</label>
            <input autofocus type="text" class="form-control" name="CodigoContrato">
        </div>
        <h5 class="mt-2 title text-white">Marque seus horários:</h5>
        <span class="text-white">Ex: se você fica de 08h às 10h, marque os horários de 08h às 09h e 09h às 10h.</span>
        <br>
        <span class="text-white">Ex: se você fica de 08h às 09h, marque somente o horário de 08h.</span>
        <div style="display:grid;grid-template-columns:repeat(4, 1fr);justify-content:center;align-items:center;text-align:center;margin-bottom:10px;margin-top:10px;">
        
            <label for="oito" class="form-check-label text-white fs-5">
                <input type="checkbox" class="form-check-input mx-2" id="oito" name="HoraPresenca[]" value="08:00">
                 08h às 09h 
            </label>

            <label for="nove" class="form-check-label text-white fs-5">
                <input type="checkbox" class="form-check-input mx-2" id="nove" name="HoraPresenca[]" value="09:00">
                09h às 10h
            </label>

            <label for="dez" class="form-check-label text-white fs-5">
                <input type="checkbox" class="form-check-input mx-2" id="dez" name="HoraPresenca[]" value="10:00">
                10h às 11h
            </label>

            <label for="onze" class="form-check-label text-white fs-5">
                <input type="checkbox" class="form-check-input mx-2" id="onze" name="HoraPresenca[]" value="11:00">
                11h às 12h
            </label>

            <label for="doze" class="form-check-label text-white fs-5">
                <input type="checkbox" class="form-check-input mx-2" id="doze" name="HoraPresenca[]" value="12:00">
                12h às 13h
            </label>

            <label for="treze" class="form-check-label text-white fs-5">
                <input type="checkbox" class="form-check-input mx-2" id="treze" name="HoraPresenca[]" value="13:00">
                13h às 14h
            </label>

            <label for="catorze" class="form-check-label text-white fs-5">
                <input type="checkbox" class="form-check-input mx-2" id="catorze" name="HoraPresenca[]" value="14:00">
                14h às 15h
            </label>

            <label for="quinze" class="form-check-label text-white fs-5">
                <input type="checkbox" class="form-check-input mx-2" id="quinze" name="HoraPresenca[]" value="15:00">
                15h às 16h
            </label>

            <label for="dezesseis" class="form-check-label text-white fs-5">
                <input type="checkbox" class="form-check-input mx-2" id="dezesseis" name="HoraPresenca[]" value="16:00">
                16h às 17h
            </label>

            <label for="dezessete" class="form-check-label text-white fs-5">
                <input type="checkbox" class="form-check-input mx-2" id="dezessete" name="HoraPresenca[]" value="17:00">
                17h às 18h
            </label>

            <label for="dezoito" class="form-check-label text-white fs-5">
                <input type="checkbox" class="form-check-input mx-2" id="dezoito" name="HoraPresenca[]" value="18:00">
                18h às 19h
            </label>
            
            <label for="dezenove" class="form-check-label text-white fs-5">
                <input type="checkbox" class="form-check-input mx-2" id="dezenove" name="HoraPresenca[]" value="19:00">
                19h às 20h
            </label>
        </div>
        <div class="data-hora m-1">
            <input class="form-control" type="text" readonly name="DataPresenca">
            <input class="form-control" type="text" readonly name="DiaSemana">
            <input class="form-control" type="hidden" value="<?php echo $_SERVER["REMOTE_ADDR"] ?>" readonly name="IpComputador">
        </div>

        <div class="dia-semana m-1">
        </div>
        <div class="computador m-1">
            <input value="<?php echo gethostbyaddr($_SERVER['REMOTE_ADDR']) ?>" class="form-control" type="text" readonly name="Computador">
        </div>
        <button class="btn btn-dark m-1">Registrar</button>
    </form>
    </div>
<?php include "./partials/rodape.php" ?>