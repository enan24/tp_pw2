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
                        <input type="text" class="form-control" id="nombre" name="nombre">
                    </div>
                    <div class="form-group">
                        <label for="documento">Numero de documento</label>
                        <input type="number" min="0" class="form-control" id="documento" name="documento">
                    </div>
                    <div class="form-group">
                        <label for="provincia">Provincia</label>
                        <select class="form-control" id="provincia" name="provincia">
                            <option value="1">Buenos Aires</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="email">Correo electronico</label>
                        <input type="email" class="form-control" id="email" name="email">
                    </div>
                    <div class="form-group">
                        <label for="password">Contrasena</label>
                        <input type="password" class="form-control" id="password" name="password">
                    </div>
                    <div class="form-group">
                        <label for="Checkpassword">Repita la contrasena</label>
                        <input type="password" class="form-control" id="Checkpassword">
                    </div>
                    <button type="submit" class="btn btn-primary">Registrar</button>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="apellido">Apellido</label>
                    <input type="text" class="form-control" id="apellido" name="apellido">
                </div>
                <div class="form-group">
                    <label for="telefono">Telefono</label>
                    <input type="number" min="0" class="form-control" id="telefono" name="telefono">
                </div>
                <div class="form-group">
                    <label for="localidad">Localidad</label>
                    <select class="form-control" id="localidad" name="localidad">
                        <option value="1">San Justo</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="direccion">Direccion</label>
                    <input type="text" class="form-control" id="direccion" name="direccion">
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm">
                            <input type="number" min="0" id="numeroDireccion" class="form-control" placeholder="Numero" name="direccionNumero">
                        </div>
                        <div class="col-sm">
                            <input type="text" id="pisoDireccion" class="form-control" placeholder="Piso/Dpto" name="direccionPiso">
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
</body>

</html>