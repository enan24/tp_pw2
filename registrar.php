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
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <form>
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text" class="form-control" id="nombre">
                    </div>
                    <div class="form-group">
                        <label for="documento">Numero de documento</label>
                        <input type="number" min="0" class="form-control" id="documento">
                    </div>
                    <div class="form-group">
                    <label for="provincia">Provincia</label>
                    <select class="form-control" id="provincia">

                    </select>
                </div>

                    <div class="form-group">
                        <label for="email">Correo electronico</label>
                        <input type="email" class="form-control" id="email">
                    </div>
                    <div class="form-group">
                        <label for="password">Contrasena</label>
                        <input type="password" class="form-control" id="password">
                    </div>
                    <div class="form-group">
                        <label for="Checkpassword">Repita la contrasena</label>
                        <input type="password" class="form-control" id="Checkpassword">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="apellido">Apellido</label>
                    <input type="text" class="form-control" id="apellido">
                </div>
                <div class="form-group">
                    <label for="telefono">Telefono</label>
                    <input type="number" min="0" class="form-control" id="telefono">
                </div>
                <div class="form-group">
                    <label for="localidad">Localidad</label>
                    <select class="form-control" id="localidad">

                    </select>
                </div>
                <div class="form-group">
                        <label for="direccion">Direccion</label>
                        <input type="text" class="form-control" id="direccion">
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm">
                                <input type="number" min="0" id="numeroDireccion" class="form-control"
                                    placeholder="Numero">
                            </div>
                            <div class="col-sm">
                                <input type="text" id="pisoDireccion" class="form-control"
                                    placeholder="Piso/Dpto">
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