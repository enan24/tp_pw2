<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php
    include_once "../resources/templates/css.html";
    ?>
    <title>Registrar</title>
</head>

<body>
    <?php
    include_once "../resources/templates/navbar.php";
    ?>
    <br>
    <span id="location"></span>
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <form action="../controllers/registrar.php" method="POST" id="formRegistrar">
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" tabindex="1" required>
                    </div>
                    <div class="form-group">
                        <label for="cuit">CUIL/CUIT</label>
                        <input type="text" maxlength="11" pattern= "[0-9]" class="form-control" id="cuit" name="cuit"  tabindex="3"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="provincia">Provincia</label>
                        <select class="form-control" id="provincia" name="provincia" tabindex="5" required>
                            <?php
                            include_once '../models/provincia.php';
                            $provincias = new Provincia;
                            $lista_provincias = $provincias->get_lista();
                            foreach ($lista_provincias as $key => $value) {
                                echo "<option value='$key'>$value</option>";
                               }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="email">Correo electronico</label>
                        <input type="email" class="form-control" id="email" name="email" tabindex="7" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Contrasena</label>
                        <input type="password" class="form-control" id="password" name="password" tabindex="11"
                            required>
                    </div>
                    <div id="alertPassword" class="alert alert-danger" role="alert" style="display:none">
                        Las contrasenas no coinciden.
                    </div>
                    <div class="form-group">
                        <label for="checkPassword">Repita la contrasena</label>
                        <input type="password" class="form-control" id="checkPassword" tabindex="12" required>
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
                    <input type="number" min="0" class="form-control" id="telefono" name="telefono" tabindex="4"
                        required>
                </div>
                <div class="form-group">
                    <label for="localidad">Localidad</label>
                    <select class="form-control" id="localidad" name="localidad" tabindex="6" required>
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
                            <input type="text" id="pisoDireccion" class="form-control" tabindex="10"
                                placeholder="Piso/Dpto" name="direccionPiso">
                        </div>
                    </div>
                </div>

            </div>

            </form>

        </div>
    </div>



    <?php
    include_once "../resources/templates/javascript.html";
    ?>
    <script src="../resources/js/geolocation.js"></script>
    <script>
        $('#cuit').tooltip({'trigger':'focus', 'title': 'Solo números sin espacios ni guiones'});
        $('#formRegistrar').submit(function (e) {
            var password = $('#password').val();
            var password2 = $('#checkPassword').val();
            if (password != password2) {
                e.preventDefault();
                $('#alertPassword').show();
            } else {
                $('#alertPassword').hide()
                e.submit();
            }
        });

        $('#checkPassword').change(function () {
            var password = $('#password').val();
            var password2 = $('#checkPassword').val();
            if (password != password2) {
                $('#alertPassword').show();
            } else {
                $('#alertPassword').hide()
            }
        });

        function ajaxGetLocalidades(provincia) {
            $.ajax({
                type: 'GET',
                url: '../controllers/get_localidades.php',
                data: {
                    'provincia': provincia
                },
                dataType: 'json',
                success: function (data) {
                    $('#localidad').empty();
                    data.forEach(function (localidad) {
                        $('#localidad').append($('<option>', {
                            value: localidad['id'],
                            text: localidad['nombre']
                        }));
                    });
                }
            });
        };

        $('#provincia').change(function () {
            ajaxGetLocalidades($(this).val());
        });

        $(document).ready(function () {
            ajaxGetLocalidades($('#provincia').val());
        });
    </script>
</body>

</html>