<?php

include '../includes/verificar.php';
include '../config/conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $tipo = $_POST['tipo'];
    $marca = $_POST['marca'];
    $modelo = $_POST['modelo'];
    $numero_serie = $_POST['numero_serie'];
    $fecha_compra = $_POST['fecha_compra'];
    $fecha_garantia = $_POST['fecha_garantia'];

    $sql = "INSERT INTO material

    (
        tipo,
        marca,
        modelo,
        numero_serie,
        fecha_compra,
        fecha_garantia
    )

    VALUES

    (
        '$tipo',
        '$marca',
        '$modelo',
        '$numero_serie',
        '$fecha_compra',
        '$fecha_garantia'
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
                Nuevo material
            </h2>

            <form method="POST">

                <div class="row">

                    <div class="col-md-6 mb-3">

                        <label>Tipo</label>

                        <select
                            name="tipo"
                            class="form-select"
                            required
                        >

                            <option value="">
                                Seleccionar
                            </option>

                            <option>Portátil</option>
                            <option>Sobremesa</option>
                            <option>Monitor</option>
                            <option>Móvil</option>
                            <option>Dockstation</option>
                            <option>Tablet</option>
                            <option>Surface</option>

                        </select>

                    </div>

                    <div class="col-md-6 mb-3">

                        <label>Marca</label>

                        <input
                            type="text"
                            name="marca"
                            class="form-control"
                            required
                        >

                    </div>

                </div>

                <div class="row">

                    <div class="col-md-6 mb-3">

                        <label>Modelo</label>

                        <input
                            type="text"
                            name="modelo"
                            class="form-control"
                            required
                        >

                    </div>

                    <div class="col-md-6 mb-3">

                        <label>Número de serie</label>

                        <input
                            type="text"
                            name="numero_serie"
                            class="form-control"
                            required
                        >

                    </div>

                </div>

                <div class="row">

                    <div class="col-md-6 mb-3">

                        <label>Fecha compra</label>

                        <input
                            type="date"
                            name="fecha_compra"
                            class="form-control"
                        >

                    </div>

                    <div class="col-md-6 mb-3">

                        <label>Fecha garantía</label>

                        <input
                            type="date"
                            name="fecha_garantia"
                            class="form-control"
                        >

                    </div>

                </div>

                <button
                    type="submit"
                    class="btn btn-primary"
                >
                    Guardar material
                </button>

            </form>

        </div>

    </div>

</div>

<?php include '../includes/footer.php'; ?>