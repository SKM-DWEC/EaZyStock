<?php

include '../config/conexion.php';

$sql = "

SELECT *

FROM material

WHERE activo = 1

";

$resultado = $conn->query($sql);

echo "<h2>TEST MATERIAL</h2>";

if ($resultado->num_rows > 0) {

    echo "<p style='color:green;'>✔ MATERIAL LISTADO OK</p>";

} else {

    echo "<p style='color:red;'>✘ MATERIAL ERROR</p>";

}