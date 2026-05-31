<?php

include 'includes/verificar.php';
include 'config/conexion.php';
include 'includes/header.php';
include 'includes/sidebar.php';

/*
|--------------------------------------------------------------------------
| CONSULTAS DASHBOARD
|--------------------------------------------------------------------------
*/

$total_material = $conn->query("
SELECT COUNT(*) AS total
FROM material
WHERE activo = 1
")->fetch_assoc();

$disponibles = $conn->query("
SELECT COUNT(*) AS total
FROM material
WHERE estado = 'Disponible'
AND activo = 1
")->fetch_assoc();

$asignados = $conn->query("
SELECT COUNT(*) AS total
FROM material
WHERE estado = 'Asignado'
AND activo = 1
")->fetch_assoc();

$reparacion = $conn->query("
SELECT COUNT(*) AS total
FROM material
WHERE estado = 'Reparación'
AND activo = 1
")->fetch_assoc();

$bajas = $conn->query("
SELECT COUNT(*) AS total
FROM material
WHERE estado = 'Baja'
")->fetch_assoc();

$trabajadores = $conn->query("
SELECT COUNT(*) AS total
FROM trabajadores
WHERE activo = 1
")->fetch_assoc();

?>

<div class="main-content">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h1 class="fw-bold">
                Dashboard
            </h1>

            <p class="text-muted mb-0">
                Bienvenido a EaZyStock Solutions
            </p>

        </div>

        <div>

            <span class="badge bg-dark p-2">

                Usuario:
                <?php echo $_SESSION['nombre']; ?>

            </span>

        </div>

    </div>

    <div class="row g-4">

        <!-- TOTAL MATERIAL -->

        <div class="col-md-4">

            <div class="card card-dashboard card-total">

                <div class="card-body">

                    <h5 class="mb-3">
                        📦 Material total
                    </h5>

                    <h1>
                        <?php echo $total_material['total']; ?>
                    </h1>

                </div>

            </div>

        </div>

        <!-- DISPONIBLES -->

        <div class="col-md-4">

        <div class="card card-dashboard card-disponible">

                <div class="card-body">

                    <h5 class="mb-3">
                        ✅ Disponibles
                    </h5>

                    <h1>
                        <?php echo $disponibles['total']; ?>
                    </h1>

                </div>

            </div>

        </div>

        <!-- ASIGNADOS -->

        <div class="col-md-4">

            <div class="card card-dashboard card-asignado">

                <div class="card-body">

                    <h5 class="mb-3">
                        👨‍💻 Asignados
                    </h5>

                    <h1>
                        <?php echo $asignados['total']; ?>
                    </h1>

                </div>

            </div>

        </div>

        <!-- REPARACION -->

        <div class="col-md-4">

        <div class="card card-dashboard card-reparacion">

                <div class="card-body">

                    <h5 class="mb-3">
                        🔧 Reparación 
                    </h5>

                    <h1>
                        <?php echo $reparacion['total']; ?>
                    </h1>

                </div>

            </div>

        </div>

        <!-- BAJAS -->

        <div class="col-md-4">

            <div class="card card-dashboard card-baja">

                <div class="card-body">

                    <h5 class="mb-3">
                        ❌ Bajas
                    </h5>

                    <h1>
                        <?php echo $bajas['total']; ?>
                    </h1>

                </div>

            </div>

        </div>

        <!-- TRABAJADORES -->

        <div class="col-md-4">

        <div class="card card-dashboard card-trabajadores">

                <div class="card-body">

                    <h5 class="mb-3">
                        👥 Trabajadores
                    </h5>

                    <h1>
                        <?php echo $trabajadores['total']; ?>
                    </h1>

                </div>

            </div>

        </div>

    </div>

    <!-- ÚLTIMAS ASIGNACIONES -->

    <div class="card shadow mt-5">

        <div class="card-body">

            <h4 class="mb-4">
                Últimas asignaciones
            </h4>

            <?php

            $ultimas = $conn->query("

            SELECT

            a.fecha_asignacion,

            t.nombre,
            t.apellidos,

            m.tipo,
            m.marca,
            m.modelo

            FROM asignaciones a

            INNER JOIN trabajadores t
            ON a.trabajador_id = t.id

            INNER JOIN material m
            ON a.material_id = m.id

            ORDER BY a.id DESC

            LIMIT 5

            ");

            ?>

            <table class="table table-hover">

                <thead class="table-light">

                    <tr>

                        <th>Trabajador</th>
                        <th>Material</th>
                        <th>Fecha</th>

                    </tr>

                </thead>

                <tbody>

                    <?php while($fila = $ultimas->fetch_assoc()) { ?>

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
                                <?php echo $fila['fecha_asignacion']; ?>
                            </td>

                        </tr>

                    <?php } ?>

                </tbody>

            </table>

        </div>

    </div>

</div>

<?php include 'includes/footer.php'; ?>