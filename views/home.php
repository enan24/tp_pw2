<?php
  require_once "../controllers/home.php";
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <?php
    include_once "../resources/templates/css.html";
    ?>
    <title>Home</title>
</head>

<body>
    <?php
    include_once "../resources/templates/navbar.php";
    ?>

    <div class="container">
        <?php
    if (isset($_SESSION['email'])) {
        echo "<br><h3>Bienvenido " . $_SESSION['email'] . "</h3>";
    if (isset($_SESSION['admin']) && $_SESSION['admin'] == 1) {
        echo "<p>Su usuario es administrador</p>";
    }
    }

    ?>


    </div>



    <?php
    include_once "../resources/templates/javascript.html";
    ?>

    <!-- Page Content -->
    <img class="d-block img-fluid" src="../resources/img/imgInicio.jpg"><br>


    <div class="container">

        <div class="row">

            <?php
              foreach ($products as $product) {
                echo "
                  <div class='col-lg-4 col-md-6 mb-4'>
                      <div class='card h-100'>
                          <a href='".$product['id']."'><img class='card-img-top' src='".$product['image']."' alt=''></a>
                          <div class='card-body'>
                              <h4 class='card-title'>
                                  <a href='product.php?id=".$product['id']."'>".$product['title']."</a>
                              </h4>
                              <h5>$1300.00</h5>
                              <p class='card-text'>".$product['description']."</p>
                          </div>
                          <div class='card-footer'>
                              ";
                if ($product['avgRate'] === 0) {
                  echo "El vendedor no tiene calificaciones. ";
                } else {
                  echo "Reputación del vendedor: " . $product['avgRate']. " ";
                }
                echo "<span class='text-warning'>";
                for ($i=0; $i < $product['avgRate']; $i++) {
                  echo "&#9733;";
                }
                if ($product['avgRate'] < 5) {
                  $emptyStart = 5 - $product['avgRate'];
                  for ($i=0; $i < $emptyStart; $i++) {
                    echo "&#9734;";
                  }
                }
                echo "</span>";

                echo "
                          </div>
                      </div>
                  </div>
                ";
              }
            ?>

        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->

    <script src="../resources/js/geolocation.js"></script>


</body>

</html>
