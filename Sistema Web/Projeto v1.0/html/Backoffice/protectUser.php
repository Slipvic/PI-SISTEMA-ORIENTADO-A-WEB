<?php

if(!isset($_SESSION)) {
    session_start();
}

if(!isset($_SESSION['idusers'])) {
    die("Acesso Deslogado.<p><a href=\"login-client.php\">Entrar</a></p>");
}

?>