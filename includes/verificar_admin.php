<?php

include 'verificar.php';

if ($_SESSION['rol_id'] != 1) {

    header("Location: /eazystock/dashboard.php");

    exit();

}

?>