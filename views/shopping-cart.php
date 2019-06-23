<?php
  require_once("../resources/utils.php");
  $products = searchShoppingCart();
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Carrito</title>
  <?php
    include_once "../resources/templates/css.html";
    include_once "../resources/templates/javascript.html";
  ?>
  <link rel="stylesheet" href="../resources/css/shopping-cart.css">

</head>
<body>
    <?php
      include_once "../resources/templates/navbar.php";
    ?>
    <div class="container">
      <table class="table">
        <thead>
          <tr>
            <th scope="col" class="product">Producto</th>
            <th scope="col" class="price">Precio</th>
            <th scope="col" class="cant">Cantidad</th>
            <th scope="col" class="total">Total</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $total = 0;
            foreach ($products as $productId => $info) {
              $total += ($info['price']*$info['cantidad']);
              echo "
                <tr>
                  <td class='product'>
                    <div class='media'>
                      <div class='d-flex'>
                        <a href='product.php?id=".$productId."'><img src='".$info['image']."' alt=''></a>
                      </div>
                      <div class='product-title'>
                        <p><a href='product.php?id=".$productId."'>".$info['title']."</a></p>
                      </div>
                    </div>
                  </td>
                  <td class='cant'><h5>$".$info['price']."</h5></td>
                  <td class='price'><h5>".$info['cantidad']."</h5></td>
                  <td class='total'><h5>$".($info['price']*$info['cantidad'])."</h5></td>
                </tr>
              ";
            }
          ?>
          <tr>
            <td></td>
            <td></td>
            <td><h5>Total</h5></td>
            <td><h5>$<?php echo $total ?></h5></td>
          </tr>
          <tr class='btn-div'>
              <td></td>
              <td></td>
              <td></td>
              <td style="width:100%;">
                <div class="d-flex justify-content-center">
                  <a class='btn btn-primary' href='home.php'>Continuar comprando</a>
                  <a class='btn btn-success' href='confirm-shopping.php'>Confirmar compra</a>
                </div>
              </td>
          </tr>
        </tbody>
      </table>
    </div>
</body>
</html>
