<?php
  include_once "../controllers/profile.php";
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <link rel="icon" href="../resources/img/favico.jpg">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php echo $user['nombre'] ?> - Perfil</title>
    <?php
      include_once "../resources/templates/css.html";
      include_once "../resources/templates/javascript.html";
    ?>
    <link rel="stylesheet" href="../resources/css/profile.css">
  </head>
  <body>
    <?php
      include_once('../resources/templates/headProfile.php');
    ?>

    <ul class="nav nav-tabs" id="profileData" role="tablist">
      <li class="nav-item">
        <a class="nav-link active" id="profile-products-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Mis Productos</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Mis Datos</a>
      </li>
    </ul>
    <div class="tab-content" id="myTabContent">
      <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="profile-data-tab">
        <br>
        <div class="container">
          <a class="btn btn-primary" style="background-color: skyblue; border-color: skyblue; color: black; margin-bottom: 1rem;" href="new-product.php">Nuevo producto</a>
          <div class="row">
            <?php
              foreach($products as $product) {
                setlocale(LC_TIME, 'es_ES.UTF-8');
                $date = ucfirst(strftime("%A, %d de %B de %Y", strtotime($product->date)));
                echo "<div class='col-lg-4 col-md-6 mb-4'>
                  <div class='card h-100'>
                    <a><img class='card-img-top' src='". $product->image ."' alt=''></a>
                    <div class='card-body'>
                      <h4 class='card-title'>
                        <a>". $product->title ."</a>
                      </h4>
                      <h5>$". $product->price ."</h5>
                      <p class='card-text'>". $product->description."</p>
                      <p class='date-product'>Creado: ".$date."</p>
                    </div>
                    <div class='card-footer'>
                      <p class='card-text'>". $product->subDescription ."</p>
                      <small class='text-muted'>&#9733; &#9733; &#9733; &#9733; &#9734;</small>
                    </div>
                    <div class='card-footer category-product'>";
                      foreach ($product->categories as $category) {
                        echo "<a>".$category."</a>";
                      }
                echo "</div>
                    <div class='card-footer btns'>
                      <div class='container-btns'>
                        <a class='btn-product-footer' href='new-product.php?update=".$product->id."'>Modificar</a>
                        <a class='btn-product-footer' href='profile.php?remove=".$product->id."'>Eliminar</a>
                      </div>
                    </div>
                  </div>
                </div>";
            }
            ?>
          </div>
        </div>
      </div>
      <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
        Aqui van tus datos viteh, pero aun no estan viteh
      </div>
    </div>
    <br>
  </body>
</html>
