<?php
  require_once("../resources/utils.php");
  require_once("../models/product.php");

  isLogged();

  $user = searchUser($_SESSION['idUser']);
  if (!isset($user) || is_null($user)) {
    header('location: index.php');
    exit;
  }

  $resultProducts = searchProducts($user['idUser']);
  $products = [];
  foreach ($resultProducts as $product) {
    $products['' . $product['id'] . ''] = new Product($product);
  }
?>
