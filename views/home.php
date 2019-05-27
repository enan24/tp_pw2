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

  

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/shop-homepage.css" rel="stylesheet">


    <?php
    include_once "../resources/templates/css.html";
    ?>
    <title>Home</title>
</head>

<body>
    <?php
    include_once "../resources/templates/navbar.php";
    ?>
    <span id="location"></span>
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
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div id="carouselExampleIndicators" class="carousel slide my-4" data-ride="carousel">
          <div class="carousel-inner" role="listbox">
            <div class="carousel-item active">
              <img class="d-block img-fluid" src="../resources/img/imgInicio.jpg">
            </div>
          </div>
        </div>

        <div class="row">

          <div class="col-lg-4 col-md-6 mb-4">
            <div class="card h-100">
              <a href="#"><img class="card-img-top" src="../resources/img/producto1.jpg" alt=""></a>
              <div class="card-body">
                <h4 class="card-title">
                  <a href="#">Caja de herramientas</a>
                </h4>
                <h5>$1300.00</h5>
                <p class="card-text">Caja con 80 piezas de 30 medidas</p>
              </div>
              <div class="card-footer">
                <small class="text-muted">&#9733; &#9733; &#9734; &#9734; &#9734;</small>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 mb-4">
            <div class="card h-100">
              <a href="#"><img class="card-img-top" src="../resources/img/producto2.jpg" alt=""></a>
              <div class="card-body">
                <h4 class="card-title">
                  <a href="#">Maletin de herramientas</a>
                </h4>
                <h5>$1800.00</h5>
                <p class="card-text">Maletin de herramientas con 100 piezas</p>
              </div>
              <div class="card-footer">
                <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 mb-4">
            <div class="card h-100">
              <a href="#"><img class="card-img-top" src="../resources/img/producto3.jpg" alt=""></a>
              <div class="card-body">
                <h4 class="card-title">
                  <a href="#">Malentín de herramientas</a>
                </h4>
                <h5>$1350.00</h5>
                <p class="card-text">Malentín con 30 piezas</p>
              </div>
              <div class="card-footer">
                <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 mb-4">
            <div class="card h-100">
              <a href="#"><img class="card-img-top" src="../resources/img/producto4.jpg" alt=""></a>
              <div class="card-body">
                <h4 class="card-title">
                  <a href="#">Impresora Epson</a>
                </h4>
                <h5>$2530.00</h5>
                <p class="card-text">Funcione de impresion en blanco y negro,a  color, escaner, fotocopiadora</p>
              </div>
              <div class="card-footer">
                <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 mb-4">
            <div class="card h-100">
              <a href="#"><img class="card-img-top" src="../resources/img/producto5.jpg" alt=""></a>
              <div class="card-body">
                <h4 class="card-title">
                  <a href="#">Auriculares Inalambricos</a>
                </h4>
                <h5>$1500.00</h5>
                <p class="card-text">Largo alcance, sonido potente</p>
              </div>
              <div class="card-footer">
                <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 mb-4">
            <div class="card h-100">
              <a href="#"><img class="card-img-top" src="../resources/img/producto6.jpg" alt=""></a>
              <div class="card-body">
                <h4 class="card-title">
                  <a href="#">Tablet 10'</a>
                </h4>
                <h5>$2000.00</h5>
                <p class="card-text">Sistema operativo Android, camara 10 megapixeles</p>
              </div>
              <div class="card-footer">
                <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
              </div>
            </div>
          </div>

        </div>
        <!-- /.row -->

      </div>
      <!-- /.col-lg-9 -->

    </div>
    <!-- /.row -->

  </div>
  <!-- /.container -->

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>



    <script src="../resources/js/jQueryHome.js"></script>
    
    <script src="../resources/js/promociones.js"></script>
    <script src="../resources/js/geolocation.js"></script>


</body>

</html>
