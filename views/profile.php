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
include_once '../resources/templates/headProfile.php';
?>

  <ul class="nav nav-tabs" id="profileData" role="tablist">
    <li class="nav-item">
      <a class="nav-link active" id="profile-products-tab" data-toggle="tab" href="#home" role="tab"
        aria-controls="home" aria-selected="true">Mis Productos</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile"
        aria-selected="false">Estado de cuenta</a>
    </li>
  </ul>
  <div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="profile-data-tab">
      <br>
      <div class="container">
        <a class="btn btn-primary" href="new-product.php">Nuevo producto</a><br><br>
        <div class="row">
          <?php
foreach ($products as $product) {
    setlocale(LC_TIME, 'es_ES.UTF-8');
    $date = ucfirst(strftime("%A, %d de %B de %Y", strtotime($product->date)));
    echo "<div class='col-lg-4 col-md-6 mb-4'>
                  <div class='card h-100'>
                    <a><img class='card-img-top' src='" . reset($product->images) . "' alt=''></a>
                    <div class='card-body'>
                      <h4 class='card-title'>
                        <a>" . $product->title . "</a>
                      </h4>
                      <h5>$" . $product->price . "</h5>
                      <p class='card-text'>" . $product->description . "</p>
                      <p class='date-product'>Creado: " . $date . "</p>
                    </div>
                    <div class='card-footer'>
                      <p class='card-text'>" . $product->subDescription . "</p>
                      <small class='text-muted'>&#9733; &#9733; &#9733; &#9733; &#9734;</small>
                    </div>
                    <div class='card-footer category-product'>";
    foreach ($product->categories as $category) {
        echo "<a>" . utf8_encode($category) . "</a>";
    }
    echo "</div>
                    <div class='card-footer btns'>
                      <div class='container-btns'>
                        <a class='btn-product-footer' href='new-product.php?update=" . $product->id . "'>Modificar</a>
                        <a class='btn-product-footer' href='profile.php?remove=" . $product->id . "'>Eliminar</a>
                      </div>
                    </div>
                  </div>
                </div>";
}
?>
        </div>
      </div>
    </div>
    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab"><br>
      <ul class="list-group">
        <?php
          foreach ($purchasesWithoutPayment as $key => $value) {
              $origDate = $value['date_sale'];
              $newDate = date("d F Y G:i", strtotime($origDate));
              echo "<li class='list-group-item'>Fecha: " . $newDate . " - <strong>";
              foreach ($value['productsInvolved'] as $product) {
                echo $product['title'] . " x" . $product['cant'] . " - ";
              }
              echo "</strong> Total: $" . $value['amount'];
              $interestToPay = $value['amount'] * 0.04;
              echo " - <strong style='color:red;'>A pagar: $$interestToPay</strong>";
              $sale_interest_id = $value['sale_interest_id'];
              echo " <button name='$sale_interest_id' class='btn btn-success btnPagar'>Pagar</button></li>";
          }
          
          ?>
      </ul>
    </div>
  </div>
  <br>
  <script>
    $('.btnPagar').click(function () {
      $.ajax({
        type: 'POST',
        url: '../controllers/pay-interest.php',
        data: {
          'sale_interest_id': $(this).attr('name')
        },
        dataType: 'json',
        complete: function () {
          location.reload(true);
        }
      });
    });
  </script>
</body>

</html>