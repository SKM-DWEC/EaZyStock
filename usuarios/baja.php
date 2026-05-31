<?php

include '../includes/verificar_admin.php';
include '../config/conexion.php';

$id = $_GET['id'];

$sql = "UPDATE usuarios

SET activo = 0

WHERE id = $id";

$conn->query($sql);

header("Location: listar.php");

exit();

?>