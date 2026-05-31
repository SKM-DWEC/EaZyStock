<?php

include '../includes/verificar_admin.php';
include '../config/conexion.php';

$id = $_GET['id'];

$sql = "SELECT * FROM usuarios WHERE id = $id";

$resultado = $conn->query($sql);

$usuario = $resultado->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $email = $_POST['email'];
    $rol_id = $_POST['rol_id'];

    $update = "UPDATE usuarios SET

    nombre='$nombre',
    apellidos='$apellidos',
    email='$email',
    rol_id=$rol_id

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
                Editar usuario
            </h2>

            <form method="POST">

                <input
                    type="text"
                    name="nombre"
                    class="form-control mb-3"
                    value="<?php echo $usuario['nombre']; ?>"
                >

                <input
                    type="text"
                    name="apellidos"
                    class="form-control mb-3"
                    value="<?php echo $usuario['apellidos']; ?>"
                >

                <input
                    type="email"
                    name="email"
                    class="form-control mb-3"
                    value="<?php echo $usuario['email']; ?>"
                >

                <select
                    name="rol_id"
                    class="form-select mb-4"
                >

                    <option
                    value="1"

                    <?php

                    if($usuario['rol_id'] == 1)
                    echo 'selected';

                    ?>

                    >
                        Administrador
                    </option>

                    <option
                    value="2"

                    <?php

                    if($usuario['rol_id'] == 2)
                    echo 'selected';

                    ?>

                    >
                        Usuario
                    </option>

                </select>

                <button
                    type="submit"
                    class="btn btn-success"
                >
                    Actualizar usuario
                </button>

            </form>

        </div>

    </div>

</div>

<?php include '../includes/footer.php'; ?>