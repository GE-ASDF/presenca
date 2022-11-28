<?php
session_start();
session_destroy();
header("Location:/presenca/login.php");
?>