<?php
include_once "../controllers/purchases.php";
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <link rel="icon" href="../resources/img/favico.jpg">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php echo $user['nombre'] ?> - Mis compras</title>
    <?php
include_once "../resources/templates/css.html";
include_once "../resources/templates/javascript.html";
?>
    <link rel="stylesheet" href="../resources/css/profile.css">
  </head>
  <body>
    <?php
include_once '../resources/templates/headProfile.php';
?>

    <ul class="nav nav-tabs" id="profileData" role="tablist">
      <li class="nav-item">
        <a class="nav-link active" id="profile-products-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Mis Compras</a>
      </li>
    </ul>
    <div class="tab-content" id="myTabContent">
      <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="profile-data-tab">
        <br>
        <div class="container">
            <br><br>
          <div class="row">
            <?php
foreach ($products as $product) {
    setlocale(LC_TIME, 'es_ES.UTF-8');
    $date = ucfirst(strftime("%A, %d de %B de %Y a las %H:%M", strtotime($product['date_sale'])));
    echo "<div class='col-lg-4 col-md-6 mb-4'>
                  <div class='card h-100'>
                    <a><img class='card-img-top' src='" . reset($product['images']) . "' alt=''></a>
                    <div class='card-body'>
                      <h4 class='card-title'>
                        <a>" . $product['title'] . "</a>
                      </h4>
                      <h5>$" . $product['price'] . "</h5>
                      <p class='card-text'>" . $product['description'] . "</p>
                      <p class='date-product'>Comprado el: " . $date . "</p>
                    </div>
                    <div class='card-footer'>
                      <p class='card-text'>" . $product['subDescription'] . "</p>
                    </div>
                    <div class='card-footer category-product'>";
    foreach ($product['categories'] as $category) {
        echo "<a>" . utf8_encode($category) . "</a>";
    }
    echo "</div>
                    <div class='card-footer btns'>
                      <div class='container-btns'>
                      <form id='rateUserForm' action='../views/rate.php' method='post' class='d-flex'>
                        <a class='btn-product-footer' href='#'>Vendedor: " . $product['email'] . "</a>
                        <input type='hidden' name='product_id' value='" . $product['id'] . "'>
                        <input type='hidden' name='rated_user_email' value='" . $product['email'] . "'>
                        <input type='hidden' name='rated_user_id' value='" . $product['rated_user'] . "'>
                        <a href='#' id='rateUser' class='btn-product-footer'>Calificar usuario</a>
                        </form>
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
            Sin datos...
      </div>
    </div>
    <br>
    <script>
      $('#rateUser').click(function(){
        $('#rateUserForm').submit();
      });
    </script>
  </body>
</html>
