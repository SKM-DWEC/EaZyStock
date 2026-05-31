<?php

include '../includes/verificar.php';
include '../config/conexion.php';
include '../includes/header.php';
include '../includes/sidebar.php';

$sql = "SELECT

a.id,
a.fecha_asignacion,
a.ciudad,
a.comentario,

t.nombre,
t.apellidos,

m.tipo,
m.marca,
m.modelo,
m.numero_serie

FROM asignaciones a

INNER JOIN trabajadores t
ON a.trabajador_id = t.id

INNER JOIN material m
ON a.material_id = m.id

WHERE a.fecha_devolucion IS NULL

ORDER BY a.id DESC";

$resultado = $conn->query($sql);

?>

<div class="main-content">

    <div class="d-flex justify-content-between mb-4">

        <h2>Material asignado</h2>

        <a
            href="asignar.php"
            class="btn btn-primary"
        >
            Nueva asignación
        </a>

    </div>

    <div class="card shadow">

        <div class="card-body">

            <table class="table table-hover">

                <thead class="table-dark">

                    <tr>

                        <th>Trabajador</th>
                        <th>Material</th>
                        <th>Serie</th>
                        <th>Ciudad</th>
                        <th>Fecha</th>
                        <th>Acciones</th>

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
                                <?php echo $fila['ciudad']; ?>
                            </td>

                            <td>
                                <?php echo $fila['fecha_asignacion']; ?>
                            </td>

                            <td>

                                <a
                                    href="devolver.php?id=<?php echo $fila['id']; ?>"
                                    class="btn btn-warning btn-sm btn-confirmar"
                                >
                                    Devolver
                                </a>

                            </td>

                        </tr>

                    <?php } ?>

                </tbody>

            </table>

        </div>

    </div>

</div>

<?php include '../includes/footer.php'; ?>