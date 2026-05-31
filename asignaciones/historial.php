<?php

include '../includes/verificar.php';
include '../config/conexion.php';
include '../includes/header.php';
include '../includes/sidebar.php';


$sql = "SELECT

a.*,

t.nombre,
t.apellidos,

m.tipo,
m.marca,
m.modelo,
m.numero_serie,

u.nombre AS usuario_nombre,
u.apellidos AS usuario_apellidos

FROM asignaciones a

INNER JOIN trabajadores t
ON a.trabajador_id = t.id

INNER JOIN material m
ON a.material_id = m.id

INNER JOIN usuarios u
ON a.usuario_id = u.id

ORDER BY a.id DESC";
$resultado = $conn->query($sql);

?>

<div class="main-content">

    <h2 class="mb-4">
        Histórico de asignaciones
    </h2>

    <div class="card shadow">

        <div class="card-body">

            <table class="table table-hover">

                <thead class="table-dark">

                    <tr>

                        <th>Trabajador</th>
                        <th>Material</th>
                        <th>N.Serie</th>
                        <th>Asignado por</th>
                        <th>Asignación</th>
                        <th>Devolución</th>
                        <th>Observaciones</th>

                    </tr>

                </thead>

                <tbody>

                    <?php while($fila = $resultado->fetch_assoc()) { ?>

                        <tr>

                            <td>

                                <?php

                                echo $fila['nombre']
                                . " "
                                . $fila['apellidos'];

                                ?>

                            </td>

                            <td>

                                <?php

                                echo $fila['tipo']
                                . " "
                                . $fila['marca']
                                . " "
                                . $fila['modelo'];

                                ?>

                            </td>

                            <td>
                                <?php echo $fila['numero_serie']; ?>
                            </td>
                            <td>

                                <?php

                                echo $fila['usuario_nombre']
                                . " "
                                . $fila['usuario_apellidos'];

                                ?>

                            </td>
                            <td>
                                <?php echo $fila['fecha_asignacion']; ?>
                            </td>

                            <td>

                                <?php

                                if($fila['fecha_devolucion']) {

                                    echo $fila['fecha_devolucion'];

                                } else {

                                    echo '<span class="badge bg-success">Activa</span>';

                                }

                                ?>

                            </td>
                            <td>
                            <?php
                            echo $fila['comentario']
                            ? $fila['comentario']
                                    : '<span class="text-muted">Sin observaciones</span>';
                                ?>
                            </td>

                        </tr>

                    <?php } ?>

                </tbody>

            </table>

        </div>

    </div>

</div>

<?php include '../includes/footer.php'; ?>