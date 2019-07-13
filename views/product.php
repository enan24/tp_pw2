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
                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne"
                  aria-expanded="true" aria-controls="collapseOne">
                  Más sobre:
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
        <h4 class="my-4">Más sobre:</h4>
        <div class="list-group">
          <?php
          $categories = array();
            foreach ($product['categories'] as $category) {
              array_push($categories, $category);
              echo "
                <a href='#' class='list-group-item'>".utf8_encode($category)."</a>
              ";
            }
          ?>
        </div>

        <h4 class="my-4">Productos relacionados:</h4>
        <div class="list-group">
        
          <?php
          $relatedProducts = getRelatedProducts($categories, $product['id']);
          foreach ($relatedProducts as $key => $value) {
            echo "
                <a href='product.php?id=" . $value['id'] . "' class='list-group-item'>". $value['title'] . " $" . $value['price'] ."</a>
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
              $rates = getRate($product['idUser']);
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
              <a class="btn btn-success" onclick="addProductShoppingCart(<?php echo $_GET['id']; ?>, true)">Comprar</a>
              <a class="btn btn-success" onclick="addProductShoppingCart(<?php echo $_GET['id']; ?>, false)">Agregar al carrito</a>
            </div>
            <hr>
            <div class="footer-product">
              <p>
                <?php
                  $ratings = array();
                  foreach ($rates as $key => $value) {
                      array_push($ratings, $value['rate']);
                  }
                  $avgRate = array_sum($ratings)/count($ratings);
                ?>
                Reputación del vendedor: <?php echo $avgRate ?>
                <span class="text-warning">
                  <?php
                    for ($i=0; $i < $avgRate; $i++) { 
                      echo "&#9733;";
                    }
                    if ($avgRate < 5) {
                      $emptyStart = 5 - $avgRate;
                      for ($i=0; $i < $emptyStart; $i++) { 
                        echo "&#9734;";
                      }
                    }
                    echo "</span>";
                  ?>
                </span>
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
            Opiniones acerca de este vendedor
          </div>
          <div class="card-body">
            <?php
              foreach ($rates as $key => $value) {
                echo "<p>" . $value['comment'] . "</p>";
                echo "<span class='text-warning'>";
                for ($i=0; $i < $value['rate']; $i++) { 
                  echo "&#9733;";
                }
                if ($value['rate'] < 5) {
                  $emptyStart = 5 - $value['rate'];
                  for ($i=0; $i < $emptyStart; $i++) { 
                    echo "&#9734;";
                  }
                }
                echo "</span>";
                $origDate = $value['date'];
                $newDate = date("d F Y G:i", strtotime($origDate));
                echo " <small class='text-muted'>Publicado por " . $value['email'] . " el " . $newDate . "</small><hr>";
              }
            ?>
          </div>
        </div>

        <div class="card card-outline-secondary my-4">
          <div class="card-header">
            Preguntas
          </div>
          <div class="card-body">
            <form class="" action="../controllers/post-comment.php" method="post">
              <div class="mb-3">
                <input type="hidden" name="idProduct" value="<?php echo $product['id'] ?>">
                <textarea class="form-control" placeholder="Escriba su pregunta aquí" name="comment" required></textarea>
              </div>
              <button type="submit" name="button" class="btn btn-success">Realizar pregunta</button>
            </form>
            <hr>
            <?php
            $comments = getComments($product['id']);
            foreach ($comments as $key => $value) {
              $origDate = $value['date'];
              $newDate = date("d F Y G:i", strtotime($origDate));
              echo "<p>" . $value['comment'] . "</p>";
              echo "<small class='text-muted'>Publicado por " . $value['email'] . " el " . $newDate . "</small>";
              echo "<hr>";
            }
            ?>
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

  <script type="text/javascript">
    function addProductShoppingCart(idProduct, redirect) {
        $.ajax({
            type: 'GET',
            url: '../controllers/shopping-cart.php',
            data: {
                'idProduct': idProduct,
                'redirect': redirect,
            },
            dataType: 'json',
            success: function (data) {
              $('#cartBadge').text(data);
              if (redirect) {
                window.location.replace("../views/shopping-cart.php");
              }
            }
        });
    };
  </script>

</body>

</html>