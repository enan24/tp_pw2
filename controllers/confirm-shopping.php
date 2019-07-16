<?php
  require_once("../resources/utils.php");

  $products = searchShoppingCart();
  $total = 0;
  foreach ($products as $productId => $info) {
    $total += $info['price'] * $info['cantidad'];
  }
?>
