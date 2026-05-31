<?php

include '../includes/verificar.php';
include '../config/conexion.php';

$id = $_GET['id'];

$sql = "SELECT * FROM trabajadores WHERE id = $id";

$resultado = $conn->query($sql);

$trabajador = $resultado->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $correo = $_POST['correo'];
    $telefono = $_POST['telefono'];
    $departamento = $_POST['departamento'];
    $ciudad = $_POST['ciudad'];

    $update = "UPDATE trabajadores SET

        nombre='$nombre',
        apellidos='$apellidos',
        correo='$correo',
        telefono='$telefono',
        departamento='$departamento',
        ciudad='$ciudad'

        WHERE id=$id";

    $conn->query($update);

    header("Location: listar.php");

    exit();

}

include '../includes/header.php';
include '../includes/sidebar.php';

?>

<div class="main-content">

    <div class="card shadow">

        <div class="card-body">

            <h2 class="mb-4">
                Editar trabajador
            </h2>

            <form method="POST">

                <input
                    type="text"
                    name="nombre"
                    class="form-control mb-3"
                    value="<?php echo $trabajador['nombre']; ?>"
                >

                <input
                    type="text"
                    name="apellidos"
                    class="form-control mb-3"
                    value="<?php echo $trabajador['apellidos']; ?>"
                >

                <input
                    type="email"
                    name="correo"
                    class="form-control mb-3"
                    value="<?php echo $trabajador['correo']; ?>"
                >

                <input
                    type="text"
                    name="telefono"
                    class="form-control mb-3"
                    value="<?php echo $trabajador['telefono']; ?>"
                >

                <input
                    type="text"
                    name="departamento"
                    class="form-control mb-3"
                    value="<?php echo $trabajador['departamento']; ?>"
                >

                <input
                    type="text"
                    name="ciudad"
                    class="form-control mb-3"
                    value="<?php echo $trabajador['ciudad']; ?>"
                >

                <button
                    type="submit"
                    class="btn btn-success"
                >
                    Actualizar
                </button>

            </form>

        </div>

    </div>

</div>

<?php include '../includes/footer.php'; ?>