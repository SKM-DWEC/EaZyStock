<?php

require '../vendor/autoload.php';

use Dompdf\Dompdf;
use Dompdf\Options;

include '../config/conexion.php';

$id = $_GET['id'];

//Datos trabajador securizado

$sql_trabajador = "

SELECT *

FROM trabajadores

WHERE id = ?

";

$stmt_trabajador = $conn->prepare($sql_trabajador);

$stmt_trabajador->bind_param(
    "i",
    $id
);

$stmt_trabajador->execute();

$resultado_trabajador = $stmt_trabajador->get_result();

$trabajador = $resultado_trabajador->fetch_assoc();

//MAterial asignado -- securizado

$sql_material = "

SELECT

m.tipo,
m.marca,
m.modelo,
m.numero_serie,
m.estado,
m.ubicacion,

a.fecha_asignacion

FROM asignaciones a

INNER JOIN material m
ON a.material_id = m.id

WHERE a.trabajador_id = ?

AND a.fecha_devolucion IS NULL

";

$stmt_material = $conn->prepare($sql_material);

$stmt_material->bind_param(
    "i",
    $id
);

$stmt_material->execute();

$materiales = $stmt_material->get_result();

//LOGO

//$logo = '../assets/img/logo_eazystock.png';
//$logo = realpath('../assets/img/logo_eazystock.png');

//LOGO BASE 64

$path_logo = '../assets/img/logo_eazystock.png';

$type = pathinfo($path_logo, PATHINFO_EXTENSION);

$data = file_get_contents($path_logo);

$logo = 'data:image/' . $type . ';base64,' . base64_encode($data);
//fin logo

$html = '

<style>

body {

    font-family: Arial, sans-serif;
    color: #374151;
    font-size: 13px;

}

.header {

    text-align:center;
    margin-bottom:20px;

}

.logo {
    width:180px;
    height:auto;
    display:block;
    margin:0 auto 15px auto;
}

.titulo {

    font-size:24px;
    color:#2563eb;
    font-weight:bold;

}

.subtitulo {

    color:#6b7280;
    margin-bottom:15px;

}

hr {

    border:0;
    border-top:1px solid #d1d5db;

}

.info-box {

    background:#f8fafc;
    border:1px solid #e5e7eb;
    padding:15px;
    border-radius:6px;
    margin-top:20px;

}

h3 {

    color:#1f2937;
    margin-top:25px;

}

table {

    width:100%;
    border-collapse:collapse;
    margin-top:15px;

}

table th {

    background:#2563eb;
    color:white;
    padding:10px;
    border:1px solid #d1d5db;
    font-size:12px;

}

table td {

    padding:10px;
    border:1px solid #d1d5db;

}

.firma {

    margin-top:50px;
    border:1px solid #d1d5db;
    padding:20px;
    background:#fafafa;

}

.linea {

    margin-top:60px;
    border-top:1px solid #000;
    width:250px;

}

.footer {

    margin-top:40px;
    font-size:11px;
    color:#6b7280;
    text-align:center;

}

</style>

<div class="header">

    <img src="'.$logo.'" class="logo">

    <div class="titulo">
        EaZyStock Solutions
    </div>

    <div class="subtitulo">
        Documento de entrega de material IT
    </div>

</div>

<hr>

<div class="info-box">

    <h3>Datos del trabajador</h3>

    <p>

    <strong>Nombre:</strong>
    '.$trabajador['nombre'].' '.$trabajador['apellidos'].'

    </p>

    <p>

    <strong>Correo:</strong>
    '.$trabajador['correo'].'

    </p>

    <p>

    <strong>Departamento:</strong>
    '.$trabajador['departamento'].'

    </p>

    <p>

    <strong>Ciudad:</strong>
    '.$trabajador['ciudad'].'

    </p>

</div>

<h3>Material asignado</h3>

<table>

<tr>

<th>Tipo</th>
<th>Marca</th>
<th>Modelo</th>
<th>Nº Serie</th>
<th>Ubicación</th>
<th>Fecha asignación</th>

</tr>

';

while($fila = $materiales->fetch_assoc()) {

    $html .= '

    <tr>

        <td>'.$fila['tipo'].'</td>
        <td>'.$fila['marca'].'</td>
        <td>'.$fila['modelo'].'</td>
        <td>'.$fila['numero_serie'].'</td>
        <td>'.$fila['ubicacion'].'</td>
        <td>'.$fila['fecha_asignacion'].'</td>

    </tr>

    ';
}

$html .= '

</table>

<div class="firma">

    <h3>Aceptación del material</h3>

    <p>

    Mediante la presente, el trabajador confirma la recepción del material indicado anteriormente y se compromete a realizar un uso adecuado del mismo según las políticas internas de la empresa.

    </p>

    <br><br>

    <strong>Firma trabajador:</strong>

    <div class="linea"></div>

    <br>

    <strong>Fecha:</strong>

    _______________________

</div>

<div class="footer">

    Documento generado automáticamente por EaZyStock Solutions

    <br><br>

    Fecha generación:
    '.date("d/m/Y H:i").'

</div>

';

//Generar PDF

$options = new Options();

$options->set('isRemoteEnabled', true);

$dompdf = new Dompdf($options);

$dompdf->loadHtml($html);

$dompdf->setPaper('A4', 'portrait');

$dompdf->render();

$dompdf->stream(

    "entrega_material_IT.pdf",

    array("Attachment" => false)

);

exit();

?>