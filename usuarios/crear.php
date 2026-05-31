<?php

include '../includes/verificar_admin.php';
include '../config/conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $rol_id = $_POST['rol_id'];

    /*
    $sql = "INSERT INTO usuarios

    (
        nombre,
        apellidos,
        email,
        password,
        rol_id
    )

    VALUES

    (
        '$nombre',
        '$apellidos',
        '$email',
        '$password',
        $rol_id
    )";

    $conn->query($sql);
    */
    $sql = "

            INSERT INTO usuarios

            (

                nombre,
                apellidos,
                email,
                password,
                rol_id

            )

                VALUES

                (

                    ?,
                    ?,
                    ?,
                    ?,
                    ?

                )

                ";

$stmt = $conn->prepare($sql);

$stmt->bind_param(

    "ssssi",

    $nombre,
    $apellidos,
    $email,
    $password,
    $rol_id

);

$stmt->execute();
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
                Nuevo usuario
            </h2>

            <form method="POST">

                <div class="row">

                    <div class="col-md-6 mb-3">

                        <label>Nombre</label>

                        <input
                            type="text"
                            name="nombre"
                            class="form-control"
                            required
                        >

                    </div>

                    <div class="col-md-6 mb-3">

                        <label>Apellidos</label>

                        <input
                            type="text"
                            name="apellidos"
                            class="form-control"
                            required
                        >

                    </div>

                </div>

                <div class="mb-3">

                    <label>Email</label>

                    <input
                        type="email"
                        name="email"
                        class="form-control"
                        required
                    >

                </div>

                <div class="mb-3">

                    <label>Contraseña</label>

                    <input
                        type="password"
                        name="password"
                        class="form-control"
                        required
                    >

                </div>

                <div class="mb-4">

                    <label>Rol</label>

                    <select
                        name="rol_id"
                        class="form-select"
                    >

                        <option value="1">
                            Administrador
                        </option>

                        <option value="2">
                            Usuario
                        </option>

                    </select>

                </div>

                <button
                    type="submit"
                    class="btn btn-primary"
                >
                    Crear usuario
                </button>

            </form>

        </div>

    </div>

</div>

<?php include '../includes/footer.php'; ?>