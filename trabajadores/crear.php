<?php

include '../includes/verificar.php';
include '../config/conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $correo = $_POST['correo'];
    $telefono = $_POST['telefono'];
    $departamento = $_POST['departamento'];
    $ciudad = $_POST['ciudad'];

    $sql = "INSERT INTO trabajadores
    (nombre, apellidos, correo, telefono, departamento, ciudad)

    VALUES

    (
        '$nombre',
        '$apellidos',
        '$correo',
        '$telefono',
        '$departamento',
        '$ciudad'
    )";

    $conn->query($sql);

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
                Nuevo trabajador
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

                <div class="row">

                    <div class="col-md-6 mb-3">

                        <label>Correo</label>

                        <input
                            type="email"
                            name="correo"
                            class="form-control"
                        >

                    </div>

                    <div class="col-md-6 mb-3">

                        <label>Teléfono</label>

                        <input
                            type="text"
                            name="telefono"
                            class="form-control"
                        >

                    </div>

                </div>

                <div class="row">

                    <div class="col-md-6 mb-3">

                        <label>Departamento</label>

                        <input
                            type="text"
                            name="departamento"
                            class="form-control"
                        >

                    </div>

                    <div class="col-md-6 mb-3">

                        <label>Ciudad</label>

                        <input
                            type="text"
                            name="ciudad"
                            class="form-control"
                        >

                    </div>

                </div>

                <button
                    type="submit"
                    class="btn btn-primary"
                >
                    Guardar trabajador
                </button>

            </form>

        </div>

    </div>

</div>

<?php include '../includes/footer.php'; ?>