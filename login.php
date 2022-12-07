<?php 
    session_start();
    $title = "Faça login";
include "partials/cabecalho.php" ?>
<span class="alert">
    <?php
        if(isset($_SESSION["notfound"])){
            echo $_SESSION["notfound"];
            unset($_SESSION["notfound"]);
        }
    ?>
</span>
<form action="logar.php" method="POST">
    <div class="form-group">
    <label class="text-white" for="usuario">Usuário</label>
    <input name="usuario" type="text" class="form-control" id="usuario" aria-describedby="emailHelp" placeholder="Digite seu usuário(sem a letra)">
</div>
<div class="form-group">
    <label class="text-white"  for="senha">Senha</label>
    <input name="senha" type="password" class="form-control" id="senha" placeholder="Digite sua senha">
</div>
  <button type="submit" class="btn btn-primary mt-2">Logar</button>
</form>

</body>
</html>