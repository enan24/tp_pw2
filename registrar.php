<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php
    include_once "css.html";
    ?>
    <title>Registrar</title>
</head>

<body>
    <?php
    include_once "navbar.php";
    ?>
    <br>

    <?php
    if (!empty($_POST)) {
        include_once 'usuario.php';
        $usuario = new Usuario($_POST['email'], $_POST['password'], $_POST['nombre'], $_POST['apellido'], $_POST['documento'], $_POST['telefono'], $_POST['provincia'], $_POST['localidad'], $_POST['direccion'], $_POST['direccionNumero'], $_POST['direccionPiso']);
        $usuario->guardar();
        $_SESSION['email'] = $_POST['email'];
        header('location: home.php');
        exit();
    }


    ?>
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <form action="registrar.php" method="POST">
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" tabindex="1" required>
                    </div>
                    <div class="form-group">
                        <label for="documento">Numero de documento</label>
                        <input type="number" min="0" class="form-control" id="documento" name="documento" tabindex="3" required>
                    </div>
                    <div class="form-group">
                        <label for="provincia">Provincia</label>
                        <select class="form-control" id="provincia" name="provincia" tabindex="5" required>
                            <option value="1">Buenos Aires</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="email">Correo electronico</label>
                        <input type="email" class="form-control" id="email" name="email" tabindex="7" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Contrasena</label>
                        <input type="password" class="form-control" id="password" name="password" tabindex="11" required>
                    </div>
                    <div id="alertPassword" class="alert alert-danger" role="alert" style="display:none">
                        Las contrasenas no coinciden.
                    </div>
                    <div class="form-group">
                        <label for="Checkpassword">Repita la contrasena</label>
                        <input type="password" class="form-control" id="Checkpassword" tabindex="12" required>
                    </div>
                    <button type="submit" class="btn btn-primary" tabindex="13">Registrar</button>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="apellido">Apellido</label>
                    <input type="text" class="form-control" id="apellido" name="apellido" tabindex="2" required>
                </div>
                <div class="form-group">
                    <label for="telefono">Telefono</label>
                    <input type="number" min="0" class="form-control" id="telefono" name="telefono" tabindex="4" required>
                </div>
                <div class="form-group">
                    <label for="localidad">Localidad</label>
                    <select class="form-control" id="localidad" name="localidad" tabindex="6" required>
                        <option value="1">San Justo</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="direccion">Direccion</label>
                    <input type="text" class="form-control" id="direccion" name="direccion" tabindex="8" required>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm">
                            <input type="number" min="0" id="numeroDireccion" class="form-control" placeholder="Numero"
                                name="direccionNumero" tabindex="9" required>
                        </div>
                        <div class="col-sm">
                            <input type="text" id="pisoDireccion" class="form-control" tabindex="10" placeholder="Piso/Dpto"
                                name="direccionPiso">
                        </div>
                    </div>
                </div>


            </div>

            </form>

        </div>
    </div>



    <?php
    include_once "javascript.html";
    ?>

    <script>
        $('#Checkpassword').change(function () {
            var password = $('#password').val();
            var password2 = $('#Checkpassword').val();
            if (password != password2) {
                $('#alertPassword').show();
            } else {
                $('#alertPassword').hide()
            }
        });
    </script>
</body>

</html>