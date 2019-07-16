<?php
  require_once("../resources/utils.php");
  $addProduct = isset($_GET['idProduct']) ? $_GET['idProduct'] : '';
  if ($addProduct !== '') {
    echo addProductShoppingCart($addProduct);
  }
?>
