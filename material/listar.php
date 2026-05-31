<?php

include '../includes/verificar.php';
include '../config/conexion.php';
include '../includes/header.php';
include '../includes/sidebar.php';

/*
Filtros
*/

$busqueda = "";

if (isset($_GET['busqueda'])) {

    $busqueda = trim($_GET['busqueda']);

}

$sql = "

SELECT *

FROM material

WHERE activo = 1

AND (

tipo LIKE ?

OR marca LIKE ?

OR modelo LIKE ?

OR numero_serie LIKE ?

OR estado LIKE ?

OR ubicacion LIKE ?

)

ORDER BY id DESC

";

$stmt = $conn->prepare($sql);

$buscar = "%".$busqueda."%";

$stmt->bind_param(

"ssssss",

$buscar,
$buscar,
$buscar,
$buscar,
$buscar,
$buscar

);

$stmt->execute();

$resultado = $stmt->get_result();
?>

<div class="main-content">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h2>
            Inventario IT
        </h2>

        <a
            href="crear.php"
            class="btn btn-primary"
        >
            Nuevo material
        </a>

    </div>

    <!-- BUSCADOR -->

    <div class="card shadow mb-4">

        <div class="card-body">

            <form method="GET">

                <div class="row">

                    <div class="col-md-10">

                        <input
                            type="text"
                            name="busqueda"
                            class="form-control"
                            placeholder="Buscar por tipo, marca, modelo, serie o estado..."
                            value="<?php echo $busqueda; ?>"
                        >

                    </div>

                    <div class="col-md-2 d-grid">

                        <button
                            type="submit"
                            class="btn btn-dark"
                        >
                            Buscar
                        </button>

                    </div>

                </div>

            </form>

        </div>

    </div>

    <!-- TABLA -->

    <div class="card shadow">

        <div class="card-body">

            <table class="table table-hover align-middle">

                <thead class="table-dark">

                    <tr>

                        <th>ID</th>
                        <th>Tipo</th>
                        <th>Marca</th>
                        <th>Modelo</th>
                        <th>Nº Serie</th>
                        <th>Estado</th>
                        <th>Ubicación</th>
                        <th>Acciones</th>

                    </tr>

                </thead>

                <tbody>

                    <?php while($fila = $resultado->fetch_assoc()) { ?>

                        <tr>

                            <td>
                                <?php echo $fila['id']; ?>
                            </td>

                            <td>
                                <?php echo $fila['tipo']; ?>
                            </td>

                            <td>
                                <?php echo $fila['marca']; ?>
                            </td>

                            <td>
                                <?php echo $fila['modelo']; ?>
                            </td>

                            <td>
                                <?php echo $fila['numero_serie']; ?>
                            </td>

                            <td>

                                <?php

                                if($fila['estado'] == 'Disponible') {

                                    echo '<span class="badge bg-success">Disponible</span>';

                                }

                                elseif($fila['estado'] == 'Asignado') {

                                    echo '<span class="badge bg-primary">Asignado</span>';

                                }

                                elseif($fila['estado'] == 'Reparación') {

                                    echo '<span class="badge bg-warning text-dark">Reparación</span>';

                                }

                                else {

                                    echo '<span class="badge bg-danger">Baja</span>';

                                }

                                ?>

                            </td>

                            <td>
                                <?php echo $fila['ubicacion']; ?>
                            </td>

                            <td>

                                <div class="d-flex gap-2">

                                    <a
                                        href="editar.php?id=<?php echo $fila['id']; ?>"
                                        class="btn btn-warning btn-sm"
                                    >
                                        Editar
                                    </a>

                                    <a
                                        href="baja.php?id=<?php echo $fila['id']; ?>"
                                        class="btn btn-danger btn-sm btn-confirmar"
                                    >
                                        Baja
                                    </a>

                                </div>

                            </td>

                        </tr>

                    <?php } ?>

                </tbody>

            </table>

        </div>

    </div>

</div>

<?php include '../includes/footer.php'; ?>