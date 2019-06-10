<?php
  require_once("../controllers/product.php");
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title><?php echo $product['title']; ?></title>
  <?php
    include_once "../resources/templates/css.html";
    include_once "../resources/templates/javascript.html";
  ?>
  <link rel="stylesheet" href="../resources/css/product.css">

</head>

<body>

  <?php
    include_once "../resources/templates/navbar.php";
  ?>

  <div class="container">

    <div class="row">

      <div class="col-lg-3" id="category-acordion">
        <div class="accordion" id="accordionExample">
          <div class="card">
            <div class="card-header" id="headingOne">
              <h2 class="mb-0">
                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                  Categorias
                </button>
              </h2>
            </div>

            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
              <div class="card-body">
                <ul class="list-group list-group-flush">
                  <?php
                    foreach ($product['categories'] as $category) {
                      echo "
                        <a href='#' class='list-group-item'>".utf8_encode($category)."</a>
                      ";
                    }
                  ?>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-3" id="categories-list">
        <h4 class="my-4">Categorias</h4>
        <div class="list-group">
          <?php
            foreach ($product['categories'] as $category) {
              echo "
                <a href='#' class='list-group-item'>".utf8_encode($category)."</a>
              ";
            }
          ?>
        </div>
      </div>

      <div class="col-lg-9" style="margin: 0 auto">

        <div class="card mt-4">
          <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
          <div class="carousel-inner">
            <?php
              $class = "carousel-item active";
              foreach ($images as $image) {
                echo "
                  <div class='". $class ."'>
                    <img src='". $image['image'] ."' class='d-block w-100' alt='...'>
                  </div>
                ";
                $class = "carousel-item";
              }

            ?>
          </div>
          <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>
          <div class="card-body">
            <h3 class="card-title"><?php echo $product['title']; ?></h3>
            <h4>$<?php echo $product['price']; ?></h4>
            <p class="card-text"><?php echo $product['description']; ?></p>
            <p class="card-text"><?php echo $product['subDescription']; ?></p>
            <hr>
            <div class="footer-product">
              <p>
                4.0
                <span class="text-warning">&#9733; &#9733; &#9733; &#9733; &#9734;</span>
              </p>
              <p>
                <?php
                  setlocale(LC_TIME, 'es_ES.UTF-8');
                  $date = Date("Y-m-d H:i:s", strtotime($product['create_date']. ' + 30 days'));
                  $date = ucfirst(strftime("%A, %d de %B de %Y", strtotime($date)));
                  echo "Finaliza el ". $date;
                ?>
              </p>
            </div>
          </div>
        </div>

        <div class="card card-outline-secondary my-4">
          <div class="card-header">
            Opiniones de los usuarios
          </div>
          <div class="card-body">
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Omnis et enim aperiam inventore, similique necessitatibus neque non! Doloribus, modi sapiente laboriosam aperiam fugiat laborum. Sequi mollitia, necessitatibus quae sint natus.</p>
            <span class="text-warning">&#9733; &#9733; &#9733; &#9733; &#9734;</span>
            <small class="text-muted">Publicado por Anonymous el 3/1/17</small>
            <hr>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Omnis et enim aperiam inventore, similique necessitatibus neque non! Doloribus, modi sapiente laboriosam aperiam fugiat laborum. Sequi mollitia, necessitatibus quae sint natus.</p>
            <span class="text-warning">&#9733; &#9733; &#9733; &#9733; &#9734;</span>
            <small class="text-muted">Publicado por Anonymous el 3/1/17</small>
            <hr>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Omnis et enim aperiam inventore, similique necessitatibus neque non! Doloribus, modi sapiente laboriosam aperiam fugiat laborum. Sequi mollitia, necessitatibus quae sint natus.</p>
            <span class="text-warning">&#9733; &#9733; &#9733; &#9733; &#9734;</span>
            <small class="text-muted">Publicado por Anonymous el 3/1/17</small>
            <hr>
            <a href="#" class="btn btn-success">Escribir una opinion</a>
          </div>
        </div>

        <div class="card card-outline-secondary my-4">
          <div class="card-header">
            Preguntas
          </div>
          <div class="card-body">
            <form class="" action="#" method="post">
              <div class="mb-3">
                <textarea class="form-control" placeholder="Escriba su pregunta aquí" required></textarea>
              </div>
              <button type="submit" name="button" class="btn btn-success">Realizar pregunta</button>
            </form>
            <hr>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Omnis et enim aperiam inventore, similique necessitatibus neque non! Doloribus, modi sapiente laboriosam aperiam fugiat laborum. Sequi mollitia, necessitatibus quae sint natus.</p>
            <span class="text-warning">&#9733; &#9733; &#9733; &#9733; &#9734;</span>
            <small class="text-muted">Publicado por Anonymous el 3/1/17</small>
            <hr>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Omnis et enim aperiam inventore, similique necessitatibus neque non! Doloribus, modi sapiente laboriosam aperiam fugiat laborum. Sequi mollitia, necessitatibus quae sint natus.</p>
            <span class="text-warning">&#9733; &#9733; &#9733; &#9733; &#9734;</span>
            <small class="text-muted">Publicado por Anonymous el 3/1/17</small>
            <hr>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Omnis et enim aperiam inventore, similique necessitatibus neque non! Doloribus, modi sapiente laboriosam aperiam fugiat laborum. Sequi mollitia, necessitatibus quae sint natus.</p>
            <span class="text-warning">&#9733; &#9733; &#9733; &#9733; &#9734;</span>
            <small class="text-muted">Publicado por Anonymous el 3/1/17</small>
          </div>
        </div>

      </div>

    </div>

  </div>
  <footer class="py-5 bg-dark">
    <div class="container">
      <p class="m-0 text-center text-white">Copyright &copy; Nuestro sitio 2019</p>
    </div>
  </footer>

  <script type="text/javascript">
      $('.carousel').carousel({
        interval: false,
        pause: true
      })
  </script>

</body>

</html>
