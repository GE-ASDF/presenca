<?php if(!$_SESSION["logado"]){
  return header("Location:/presenca/login.php");
}?>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand m-2" href="/presenca/atualizar.php">AyA</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
    <div class="navbar-nav">
      <a class="nav-item nav-link active" href="/presenca/atualizar.php">Página inicial</a>
      <a class="nav-item nav-link active" href="/presenca/grade.php">Grade</a>
      <a class="nav-item nav-link" href="destroy.php">Sair</a>
    </div>
  </div>
</nav>