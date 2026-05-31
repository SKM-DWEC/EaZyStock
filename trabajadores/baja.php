<?php

include '../includes/verificar.php';
include '../config/conexion.php';

$id = $_GET['id'];

$sql = "UPDATE trabajadores
        SET activo = 0
        WHERE id = $id";

$conn->query($sql);

header("Location: listar.php");

exit();

?>