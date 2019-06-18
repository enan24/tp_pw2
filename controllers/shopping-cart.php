<?php
  // $redirect = isset($_GET['redirect']) ? $_GET['redirect'] : '';
  // if ($redirect) {
  //   header('location: ../views/shopping-cart.php');
  // }
  require_once("../resources/utils.php");
  $addProduct = isset($_GET['idProduct']) ? $_GET['idProduct'] : '';
  if ($addProduct !== '') {
    addProductShoppingCart($addProduct);
    exit;
  }
  $products = searchShoppingCart();

?>
