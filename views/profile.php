<?php
  require_once("../resources/utils.php");
  require_once("../models/product.php");
  require_once("../models/category.php");

  isLogged();

  $user = searchUser($_SESSION['idUser']);
  // print_r($user);
  if (!isset($user) || is_null($user)) {
    header('location: index.php');
    exit;
  }

  $resultProducts = searchProducts($user['idUser']);
  $resultCategories = searchCategories();
  // print_r($products);
  $products = [];
  foreach ($resultProducts as $product) {
    $products['' . $product['id'] . ''] = new Product($product);
  }

  $categories = [];
  foreach ($resultCategories as $category) {
    $categories['' . $category['id'] . ''] = new Category($category);
  }
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
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
    <nav>
      <div class="img-profile">
        <a href="#">
          <img class="icon" src="../resources/img/profile.png" alt="img-profile">
        </a>
      </div>
      <div class="content-navbar">
        <ul>
          <li>
            <a href="home.php">Inicio</a>
          </li>
          <li>
            <a href="#">Salir</a>
          </li>
        </ul>
      </div>
    </nav>

    <ul class="nav nav-tabs" id="profileData" role="tablist">
      <li class="nav-item">
        <a class="nav-link active" id="profile-products-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Productos</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Datos</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="new-product-tab" data-toggle="tab" href="#new-product" role="tab" aria-controls="new-product-tab" aria-selected="false">Producto</a>
      </li>
    </ul>
    <div class="tab-content" id="myTabContent">
      <!-- Datos del usuario -->
      <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="profile-data-tab">
        <br>
        <div class="container">
          <div class="row">
            <?php
              foreach($products as $product) {

                echo "<div class='col-lg-4 col-md-6 mb-4'>
                  <div class='card h-100'>
                    <a href='#'><img class='card-img-top' src='". $product->image ."' alt=''></a>
                    <div class='card-body'>
                      <h4 class='card-title'>
                        <a href='#'>". $product->title ."</a>
                      </h4>
                      <h5>$". $product->price ."</h5>
                      <p class='card-text'>". $product->description ."</p>
                    </div>
                    <div class='card-footer'>
                      <small class='text-muted'>&#9733; &#9733; &#9733; &#9733; &#9734;</small>
                    </div>
                    <div class='card-footer btns'>
                      <div class='container-btns'>
                        <a class='btn-product-footer' href=''>Modificar</a>
                        <a class='btn-product-footer' href=''>Eliminar</a>
                      </div>
                    </div>
                  </div>
                </div>";
            }
            ?>
            <div class='col-lg-4 col-md-6 mb-4'>
              <div class='card h-100'>
                <a href='#'><img class='card-img-top' src='". $product['image'] ."' alt=''></a>
                <div class='card-body'>
                  <h4 class='card-title'>
                    <a href='#'>Titulo</a>
                  </h4>
                  <h5>Precio</h5>
                  <p class='card-text'>Descripcion</p>
                </div>
                <div class='card-footer'>
                  <small class='text-muted'>&#9733; &#9733; &#9733; &#9733; &#9734;</small>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Productos del usuario -->
      <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
        perfil
      </div>
      <!-- Algo mas del usuario -->
      <div class="tab-pane fade" id="new-product" role="tabpanel" aria-labelledby="new-product-tab">
        <div class="container" style="max-width:400px;magin: auto">
          <br>
          <form method="POST" action="validate-pokemon.php" enctype="multipart/form-data">
            <div class="form-group">
              <label for="exampleInputEmail1">Nombre del Pokemon</label>
              <input type="text" class="form-control" id="username" name="name" aria-describedby="emailHelp" placeholder="Nombre del pokemon" required>
              <div class="valid-feedback">
                Looks good!
              </div>
            </div>
            <div class="form-group">
              <div class="custom-file">
                <input type="file" class="custom-file-input" id="validatedCustomFile" name="image_pokemon" required>
                <label class="custom-file-label" for="validatedCustomFile" data-browse="Buscar">Eliga una imagen</label>
              </div>
            </div>
            <div class="form-group">
              <label for="exampleFormControlTextarea1">Descripcion</label>
              <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="description"></textarea>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Habilidad</label>
              <input type="text" class="form-control" id="username" name="skill" placeholder="Ingrese la habilidad">
            </div>
            <div class="form-group">
                <?php

                  foreach ($categories as $category) {
                    echo "<div class='custom-control custom-checkbox'>
                      <input type='checkbox' class='custom-control-input' id='".$category->id."'>
                      <label class='custom-control-label' for='".$category->id."'>".$category->name."</label>
                    </div>";
                  }

                ?>
            </div>
            <div style="text-align:right">
              <button type="submit" class="btn btn-primary" style="background-color: #ff4949; border-color: #ff4949">Guardar</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <br>
  </body>
</html>
