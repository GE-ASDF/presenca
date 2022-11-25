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

    <form action="cadastrar.php" method="POST">
            <h1 class="title text-white">Confirme a sua presença</h1>
        <div class="contrato">
            <label class="form-label" for="CodigoContrato">
                Usuário:</label>
            <input autofocus type="text" class="form-control" name="CodigoContrato">
        </div>
        <h5 class="mt-2 title text-white">Marque seus horários:</h5>
        <span class="text-white">Ex: se você fica de 08h às 10h, marque os horários de 08:00 e 09:00.</span>
        <br>
        <span class="text-white">Ex: se você fica de 08h às 09h, marque somente o horário de 08:00.</span>
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
        </div>

        <div class="dia-semana m-1">
        </div>
        <div class="computador m-1">
            <input value="<?php echo gethostbyaddr($_SERVER['REMOTE_ADDR']) ?>" class="form-control" type="text" readonly name="Computador">
        </div>

        <button class="btn btn-dark m-1">Registrar</button>
    </form>
    </div>

    <script src="./assets/js/main.js"></script>
</body>
</html>