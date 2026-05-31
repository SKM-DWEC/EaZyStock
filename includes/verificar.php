<?php

session_start();

if (!isset($_SESSION['usuario_id'])) {

    header("Location: /eazystock/auth/login.php");

    exit();

}
?>