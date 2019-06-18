<?php
  require_once("../controllers/shopping-cart.php");
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
            <th scope="col" class="product">Product</th>
            <th scope="col" class="price">Price</th>
            <th scope="col" class="total">Total</th>
          </tr>
        </thead>
        <tbody>
          <?php
            foreach ($products as $product) {
              echo "
                <tr>
                  <td class='product'>
                    <div class='media'>
                      <div class='d-flex'>
                        <a href='product.php?id=".$product['id']."'><img src='".$product['image']."' alt=''></a>
                      </div>
                      <div class='product-title'>
                        <p><a href='product.php?id=".$product['id']."'>".$product['title']."</a></p>
                      </div>
                    </div>
                  </td>
                  <td class='price'><h5>".$product['price']."</h5></td>
                  <td class='total'><h5>".$product['price']."</h5></td>
                </tr>
              ";
            }
          ?>
          <tr>
            <td></td>
            <td></td>
            <td><h5>Subtotal</h5></td>
            <td><h5>$2160.00</h5></td>
          </tr>
          <tr class='btn-div'>
              <td></td>
              <td></td>
              <td></td>
              <td>
                <div class='btn-container'>
                  <a class='btn btn-continue' href='home.php'>Continuar comprando</a>
                  <a class='btn btn-confirm' href='confirm-shopping.php'>Confirmar compra</a>
                </div>
              </td>
          </tr>
        </tbody>
      </table>
    </div>
</body>
</html>
