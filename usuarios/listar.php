<?php

include '../includes/verificar_admin.php';
include '../config/conexion.php';
include '../includes/header.php';
include '../includes/sidebar.php';

$sql = "

SELECT

u.*,
r.nombre AS rol

FROM usuarios u

INNER JOIN roles r
ON u.rol_id = r.id

WHERE u.activo = 1

ORDER BY u.id DESC

";

$resultado = $conn->query($sql);

?>

<div class="main-content">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h2>Usuarios del sistema</h2>

        <a
            href="crear.php"
            class="btn btn-primary"
        >
            Nuevo usuario
        </a>

    </div>

    <div class="card shadow">

        <div class="card-body">

            <table class="table table-hover align-middle">

                <thead class="table-dark">

                    <tr>

                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Rol</th>
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
                                <?php echo $fila['email']; ?>
                            </td>

                            <td>

                                <?php

                                if($fila['rol_id'] == 1) {

                                    echo '<span class="badge bg-danger">Administrador</span>';

                                } else {

                                    echo '<span class="badge bg-primary">Usuario</span>';

                                }

                                ?>

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