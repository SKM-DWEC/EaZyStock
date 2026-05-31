<?php

include '../includes/verificar.php';
include '../config/conexion.php';

$id = $_GET['id'];

$sql = "SELECT * FROM material WHERE id = $id";

$resultado = $conn->query($sql);

$material = $resultado->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $tipo = $_POST['tipo'];
    $marca = $_POST['marca'];
    $modelo = $_POST['modelo'];
    $estado = $_POST['estado'];
    $ubicacion = $_POST['ubicacion'];
    $fecha_compra = $_POST['fecha_compra'];
    $fecha_garantia = $_POST['fecha_garantia'];

    $update = "UPDATE material SET

        tipo='$tipo',
        marca='$marca',
        modelo='$modelo',
        estado='$estado',
        ubicacion='$ubicacion',
        fecha_compra='$fecha_compra',
        fecha_garantia='$fecha_garantia'

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
                Editar material
            </h2>

            <form method="POST">

                <div class="row">

                    <div class="col-md-6 mb-3">

                        <label>Tipo</label>

                        <select
                            name="tipo"
                            class="form-select"
                        >

                            <option <?php if($material['tipo']=='Portátil') echo 'selected'; ?>>
                                Portátil
                            </option>

                            <option <?php if($material['tipo']=='Sobremesa') echo 'selected'; ?>>
                                Sobremesa
                            </option>

                            <option <?php if($material['tipo']=='Monitor') echo 'selected'; ?>>
                                Monitor
                            </option>

                            <option <?php if($material['tipo']=='Móvil') echo 'selected'; ?>>
                                Móvil
                            </option>

                            <option <?php if($material['tipo']=='Dockstation') echo 'selected'; ?>>
                                Dockstation
                            </option>

                            <option <?php if($material['tipo']=='Tablet') echo 'selected'; ?>>
                                Tablet
                            </option>

                            <option <?php if($material['tipo']=='Surface') echo 'selected'; ?>>
                                Surface
                            </option>

                        </select>

                    </div>

                    <div class="col-md-6 mb-3">

                        <label>Marca</label>

                        <input
                            type="text"
                            name="marca"
                            class="form-control"
                            value="<?php echo $material['marca']; ?>"
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
                            value="<?php echo $material['modelo']; ?>"
                        >

                    </div>

                    <div class="col-md-6 mb-3">

                        <label>Estado</label>

                        <select
                            name="estado"
                            class="form-select"
                        >

                            <option <?php if($material['estado']=='Disponible') echo 'selected'; ?>>
                                Disponible
                            </option>

                            <option <?php if($material['estado']=='Asignado') echo 'selected'; ?>>
                                Asignado
                            </option>

                            <option <?php if($material['estado']=='Reparación') echo 'selected'; ?>>
                                Reparación
                            </option>

                            <option <?php if($material['estado']=='Baja') echo 'selected'; ?>>
                                Baja
                            </option>

                        </select>

                    </div>

                </div>

                <div class="row">

                    <div class="col-md-6 mb-3">

                        <label>Ubicación</label>

                        <input
                            type="text"
                            name="ubicacion"
                            class="form-control"
                            value="<?php echo $material['ubicacion']; ?>"
                        >

                    </div>

                    <div class="col-md-6 mb-3">

                        <label>Fecha compra</label>

                        <input
                            type="date"
                            name="fecha_compra"
                            class="form-control"
                            value="<?php echo $material['fecha_compra']; ?>"
                        >

                    </div>

                </div>

                <div class="mb-3">

                    <label>Fecha garantía</label>

                    <input
                        type="date"
                        name="fecha_garantia"
                        class="form-control"
                        value="<?php echo $material['fecha_garantia']; ?>"
                    >

                </div>

                <button
                    type="submit"
                    class="btn btn-success"
                >
                    Actualizar material
                </button>

            </form>

        </div>

    </div>

</div>

<?php include '../includes/footer.php'; ?>