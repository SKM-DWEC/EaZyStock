<?php

include '../includes/verificar.php';
include '../config/conexion.php';

$trabajadores = $conn->query("
SELECT * FROM trabajadores
WHERE activo = 1
");

$materiales = $conn->query("
SELECT * FROM material
WHERE estado = 'Disponible'
AND activo = 1
");


    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $trabajador_id = $_POST['trabajador_id'];
        $material_id = $_POST['material_id'];
        $comentario = $_POST['comentario'];
        $usuario_id = $_SESSION['usuario_id'];
    
        /*
            Obtener ciudad
        */
    
        $sql_trabajador = "
    
        SELECT ciudad
    
        FROM trabajadores
    
        WHERE id = ?
    
        ";
    
        $stmt_trabajador = $conn->prepare($sql_trabajador);
    
        $stmt_trabajador->bind_param(
    
            "i",
    
            $trabajador_id
    
        );
    
        $stmt_trabajador->execute();
    
        $resultado_trabajador = $stmt_trabajador->get_result();
    
        $datos_trabajador = $resultado_trabajador->fetch_assoc();
    
        $ciudad = $datos_trabajador['ciudad'];
    
        /*
            Insert asignacion
        */
       
        $sql_insert = "

        INSERT INTO asignaciones

        (

            trabajador_id,
            material_id,
            usuario_id,
            ciudad,
            comentario

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
    
        $stmt_insert = $conn->prepare($sql_insert);
    
        $stmt_insert->bind_param(
    
            "iiiss",
    
            $trabajador_id,
            $material_id,
            $usuario_id,
            $ciudad,
            $comentario
    
        );
    
        $stmt_insert->execute();
    
        /*
            update material
        */
    
        $estado = 'Asignado';
    
        $sql_update = "
    
        UPDATE material
    
        SET
    
            estado = ?,
            ubicacion = ?
    
        WHERE id = ?
    
        ";
    
        $stmt_update = $conn->prepare($sql_update);
    
        $stmt_update->bind_param(
    
            "ssi",
    
            $estado,
            $ciudad,
            $material_id
    
        );
    
        $stmt_update->execute();
    
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
                Nueva asignación
            </h2>

            <form method="POST">

                <div class="mb-3">

                    <label>Trabajador</label>

                    <select
                        name="trabajador_id"
                        class="form-select"
                        required
                    >

                        <option value="">
                            Seleccionar trabajador
                        </option>

                        <?php while($t = $trabajadores->fetch_assoc()) { ?>

                            <option value="<?php echo $t['id']; ?>">

                                <?php

                                echo $t['nombre']
                                . " "
                                . $t['apellidos']
                                . " - "
                                . $t['ciudad'];

                                ?>

                            </option>

                        <?php } ?>

                    </select>

                </div>

                <div class="mb-3">

                    <label>Material disponible</label>

                    <select
                        name="material_id"
                        class="form-select"
                        required
                    >

                        <option value="">
                            Seleccionar material
                        </option>

                        <?php while($m = $materiales->fetch_assoc()) { ?>

                            <option value="<?php echo $m['id']; ?>">

                                <?php

                                echo $m['tipo']
                                . " - "
                                . $m['marca']
                                . " "
                                . $m['modelo']
                                . " - "
                                . $m['numero_serie'];

                                ?>

                            </option>

                        <?php } ?>

                    </select>

                </div>

                <div class="mb-3">

                    <label>Comentario</label>

                    <textarea
                        name="comentario"
                        class="form-control"
                        rows="4"
                    ></textarea>

                </div>

                <button
                    type="submit"
                    class="btn btn-primary"
                >
                    Asignar material
                </button>

            </form>

        </div>

    </div>

</div>

<?php include '../includes/footer.php'; ?>