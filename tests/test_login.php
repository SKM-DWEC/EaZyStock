<?php

include '../config/conexion.php';

$email = 'admin@eazystock.com';
$password = md5('1234');

$sql = "

SELECT *

FROM usuarios

WHERE email = ?

AND password = ?

AND activo = 1

";

$stmt = $conn->prepare($sql);

$stmt->bind_param(

    "ss",

    $email,
    $password

);

$stmt->execute();

$resultado = $stmt->get_result();

echo "<h2>TEST LOGIN</h2>";

if ($resultado->num_rows == 1) {

    echo "<p style='color:green;'>✔ LOGIN OK</p>";

} else {

    echo "<p style='color:red;'>✘ LOGIN ERROR</p>";

}