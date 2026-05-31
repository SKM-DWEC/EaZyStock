<?php

include '../config/conexion.php';

$sql = "

SELECT *

FROM asignaciones

";

$resultado = $conn->query($sql);

echo "<h2>TEST ASIGNACIONES</h2>";

if ($resultado->num_rows >= 0) {

    echo "<p style='color:green;'>✔ ASIGNACIONES OK</p>";

} else {

    echo "<p style='color:red;'>✘ ASIGNACIONES ERROR</p>";

}