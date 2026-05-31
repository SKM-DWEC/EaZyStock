<?php

include '../includes/verificar.php';
include '../config/conexion.php';

$id = $_GET['id'];

$sql = "SELECT * FROM asignaciones
WHERE id = $id";

$resultado = $conn->query($sql);

$asignacion = $resultado->fetch_assoc();

$material_id = $asignacion['material_id'];

$update_asignacion = "UPDATE asignaciones

SET fecha_devolucion = NOW()

WHERE id = $id";

$conn->query($update_asignacion);

$update_material = "UPDATE material

SET

estado = 'Disponible',
ubicacion = 'Almacén IT'

WHERE id = $material_id";

$conn->query($update_material);

header("Location: listar.php");

exit();

?>