<?php

session_start();

include 'config/conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

$email = $_POST['email'];
$password = md5($_POST['password']);

$sql = "

SELECT *

FROM usuarios

WHERE email = ?

AND password = ?

AND activo = 1

";

$stmt = $conn->prepare($sql);

$stmt->bind_param(

"ss",

$email,
$password

);

$stmt->execute();

$resultado = $stmt->get_result();
    if ($resultado->num_rows == 1) {

        $usuario = $resultado->fetch_assoc();

        $_SESSION['usuario_id'] = $usuario['id'];
        $_SESSION['nombre'] = $usuario['nombre'];
        $_SESSION['rol_id'] = $usuario['rol_id'];

        header("Location: dashboard.php");
        exit();

    } else {

        $error = "Credenciales incorrectas";

    }

}

?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1"
    >

    <title>
        EaZyStock Login
    </title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <link
        rel="stylesheet"
        href="assets/css/estilos.css"
    >

</head>

<body class="login-body">

<div class="container">

    <div class="row justify-content-center align-items-center vh-100">

        <div class="col-md-5 col-lg-4">

            <div class="card login-card">

                <div class="card-body p-5">
                    <!--
                    <div class="text-center mb-4">

                        <h1 class="fw-bold">
                            EaZyStock
                        </h1>

                        <p class="text-muted mb-0">
                            Gestión de inventario IT
                        </p>

                    </div>
                    -->
                    <div class="text-center mb-4">

    <img
        src="assets/img/logo_eazystock.png"
        alt="EaZyStock"
        class="login-logo mb-3"
    >
<!--
    <h1 class="fw-bold mb-1">
        EaZyStock
    </h1>
-->
    <p class="text-muted mb-0">
        Gestión de inventario IT
    </p>

</div>
                    <?php if(isset($error)) { ?>

                        <div class="alert alert-danger">

                            <?php echo $error; ?>

                        </div>

                    <?php } ?>

                    <form method="POST">

                        <div class="mb-3">

                            <label class="form-label">
                                Email
                            </label>

                            <input
                                type="email"
                                name="email"
                                class="form-control"
                                required
                            >

                        </div>

                        <div class="mb-4">

                            <label class="form-label">
                                Contraseña
                            </label>

                            <input
                                type="password"
                                name="password"
                                class="form-control"
                                required
                            >

                        </div>

                        <button
                            type="submit"
                            class="btn btn-primary w-100"
                        >
                            Iniciar sesión
                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

<script
src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
</script>

</body>
</html>