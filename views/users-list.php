<?php
  include_once "../controllers/users-list.php";
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Lista Usuarios</title>
    <?php
      include_once "../resources/templates/css.html";
      include_once "../resources/templates/javascript.html";
    ?>
    <link rel="stylesheet" href="../resources/css/profile.css">
  </head>
  </head>
  <body>
    <?php
      include_once '../resources/templates/headProfile.php';
    ?>
    <div class="container">
      <?php
        if (isset($message) && !is_null($message)) {
          echo "<div class='alert alert-success' role='alert'>
            ".$message."
          </div>";
        }
      ?>
      <table class="table table-bordered">
        <thead>
          <tr>
            <th scope="col">Nombre</th>
            <th scope="col">Apellido</th>
            <th scope="col">Acción</th>
          </tr>
        </thead>
        <tbody>
          <?php
            foreach ($resultUsers as $user) {
              $accion = $user['bloqueado'] ? "desbloquear" : "bloquear";
              $class = $accion === "desbloquear" ? "btn-primary" : "btn-danger";
              echo "
                <tr>
                  <td>".$user['nombre']."</td>
                  <td>".$user['apellido']."</td>
                  <td><a class='btn ".$class."' href='users-list.php?action=".$accion."&id=".$user['userid']."'>".ucwords($accion)."</a></td>
                </tr>
              ";
            }
          ?>
        </tbody>
      </table>
    </div>
  </body>
</html>
