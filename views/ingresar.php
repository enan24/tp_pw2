<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>e-Commerce</title>
    <?php
    include_once "../resources/templates/css.html";
    ?>
    <link rel='stylesheet' href='../resources/css/login.css'>
    <style>
        body,
        html {
            height: 100%;
        }
    </style>
</head>

<body>
    <section class='login-block'>
        <div class='container'>
            <div class='row'>
                <div class='col-md-4 login-sec'>
                    <h2 class='text-center'>Iniciar Sesión</h2>
                    <form action="../controllers/ingresar.php" method="post" class="login-form">
                        <div class='form-group'>
                            <label for='formEmail' class='text-uppercase'>Correo electronico</label>
                            <input id='formEmail' type='email' name='formEmail' class='form-control'>

                        </div>
                        <div class='form-group'>
                            <label for='formPassword' class='text-uppercase'>Contraseña</label>
                            <input id='formPassword' type='password' name='formPassword' class='form-control'>
                        </div>
                        <?php
                    session_start();
                    if (isset($_SESSION['bloqueado'])) {
                        echo "<div class='alert alert-danger' role='alert'>Su usuario se encuentra bloqueado.</div>";
                        session_destroy();
                    }
                    ?>
                        <div class='form-check'>
                            <button type='submit' name='submit' value='enviar'
                                class='btn btn-login float-right'>Enviar</button>
                        </div>
                    </form>
                </div>
                <div class='col-md-8 banner-sec'>
                    <img class='d-block img-fluid' src='../resources/img/formula-de-la-ventas.png'
                        alt='ventas'>
                </div>
            </div>
        </div>
        </div>
    </section>
    <?php
    include_once "../resources/templates/javascript.html";
    ?>
</body>

</html>