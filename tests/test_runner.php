<?php

include '../config/conexion.php';

?>

<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">

<title>
QA EaZyStock
</title>

<link
href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
rel="stylesheet"
>

</head>

<body class="bg-light">

<div class="container py-5">

    <h1 class="mb-4">
        QA - Pruebas automáticas EaZyStock
    </h1>

    <div class="row g-4">

        <!-- LOGIN -->

        <div class="col-md-4">

            <div class="card shadow">

                <div class="card-body">

                    <h5>
                        Test Login
                    </h5>

                    <?php

                    $email = 'admin@admin.com';
                    $password = md5('1234');

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

                        echo '

                        <div class="alert alert-success">

                        ✔ LOGIN OK

                        </div>

                        ';

                    } else {

                        echo '

                        <div class="alert alert-danger">

                        ✘ LOGIN ERROR

                        </div>

                        ';

                    }

                    ?>

                </div>

            </div>

        </div>

        <!-- MATERIAL -->

        <div class="col-md-4">

            <div class="card shadow">

                <div class="card-body">

                    <h5>
                        Test Material
                    </h5>

                    <?php

                    $sql_material = "

                    SELECT *

                    FROM material

                    WHERE activo = 1

                    ";

                    $material = $conn->query($sql_material);

                    if ($material->num_rows > 0) {

                        echo '

                        <div class="alert alert-success">

                        ✔ MATERIAL OK

                        </div>

                        ';

                    } else {

                        echo '

                        <div class="alert alert-danger">

                        ✘ MATERIAL ERROR

                        </div>

                        ';

                    }

                    ?>

                </div>

            </div>

        </div>

        <!-- ASIGNACIONES -->

        <div class="col-md-4">

            <div class="card shadow">

                <div class="card-body">

                    <h5>
                        Test Asignaciones
                    </h5>

                    <?php

                    $sql_asig = "

                    SELECT *

                    FROM asignaciones

                    ";

                    $asig = $conn->query($sql_asig);

                    if ($asig->num_rows >= 0) {

                        echo '

                        <div class="alert alert-success">

                        ✔ ASIGNACIONES OK

                        </div>

                        ';

                    } else {

                        echo '

                        <div class="alert alert-danger">

                        ✘ ASIGNACIONES ERROR

                        </div>

                        ';

                    }

                    ?>

                </div>

            </div>

        </div>

    </div>

</div>

</body>
</html>