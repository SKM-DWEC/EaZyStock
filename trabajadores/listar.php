<?php

include '../includes/verificar.php';
include '../config/conexion.php';
include '../includes/header.php';
include '../includes/sidebar.php';

/*
Filtro buscador
*/

$busqueda = "";

if (isset($_GET['busqueda'])) {

    $busqueda = $_GET['busqueda'];

}

$sql = "SELECT * FROM trabajadores

WHERE activo = 1

AND (

nombre LIKE '%$busqueda%'

OR apellidos LIKE '%$busqueda%'

OR departamento LIKE '%$busqueda%'

OR ciudad LIKE '%$busqueda%'

OR correo LIKE '%$busqueda%'

)

ORDER BY id DESC";

$resultado = $conn->query($sql);

?>

<div class="main-content">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h2>
            Trabajadores
        </h2>

        <a
            href="crear.php"
            class="btn btn-primary"
        >
            Nuevo trabajador
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
                            placeholder="Buscar por nombre, departamento, ciudad o correo..."
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
                        <th>Nombre</th>
                        <th>Correo</th>
                        <th>Departamento</th>
                        <th>Ciudad</th>
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

                                <?php

                                echo $fila['nombre']
                                . " "
                                . $fila['apellidos'];

                                ?>

                            </td>

                            <td>
                                <?php echo $fila['correo']; ?>
                            </td>

                            <td>
                                <?php echo $fila['departamento']; ?>
                            </td>

                            <td>
                                <?php echo $fila['ciudad']; ?>
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
                                        href="../pdf/generar.php?id=<?php echo $fila['id']; ?>"
                                        class="btn btn-dark btn-sm"
                                        target="_blank"
                                    >
                                        PDF
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