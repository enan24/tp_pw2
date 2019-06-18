<?php
  require_once("../resources/utils.php");

  $products = searchShoppingCart();
  $total = 0;
  foreach ($products as $product) {
    $total += $product['price'] * $product['cant'];
  }
?>
