<?php

$host = "localhost";
$usuario = "root";
$password = "";
$bd = "eazystock";

$conn = new mysqli($host, $usuario, $password, $bd);

if ($conn->connect_error) {

    die("Error conexión: " . $conn->connect_error);

}

$conn->set_charset("utf8");

?>