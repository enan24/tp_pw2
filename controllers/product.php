<?php
  require_once("../resources/utils.php");

  require_once("../models/category.php");
  require_once("../models/product.php");

  if (!isset($_GET['id']) || is_null($_GET['id'])) {
    header('location: home.php');
    exit;
  }

  $product = searchProduct($_GET['id']);
  if (!isset($product) || is_null($product)) {
    header('location: home.php');
    exit;
  }
  $images = searchImagesProduct($_GET['id']);

  if (isset($_SESSION['idUser'])) {
    saveUsuarioCategories($product['categories']);
  }
?>
