<?php

include '../includes/verificar.php';
include '../config/conexion.php';

$id = $_GET['id'];

$sql = "UPDATE material

        SET
            activo = 0,
            estado = 'Baja'

        WHERE id = $id";

$conn->query($sql);

header("Location: listar.php");

exit();

?>