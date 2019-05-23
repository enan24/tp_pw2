<?php
  require_once("../resources/utils.php");
  $parte = 'Categoria';
  isLogged();

  require_once("../models/category.php");
  require_once("../models/product.php");
  $categories = [];
  $categoryProduct = isset($_GET['category']) ? $_GET['category'] : '';
  if ($categoryProduct !== '') {
    $resultCategories = searchCategories();

    foreach ($resultCategories as $category) {
      $categories['' . $category['id'] . ''] = new Category($category);
    }
  }

  $productData = array();
  if ($_POST) {
    $productData['idUser'] = isset($_SESSION['idUser']) ? $_SESSION['idUser'] : '';
    $productData['title'] = isset($_POST['name']) ? $_POST['name'] : '';
    $productData['image'] = getPathImage();
    $productData['description'] = isset($_POST['description']) ? $_POST['description'] : '';
    $productData['subDescription'] = isset($_POST['subdescription']) ? $_POST['subdescription'] : '';
    $productData['price'] = isset($_POST['price']) ? $_POST['price'] : 0;
    $productData['create_date'] = date("Y/m/d");

    $product = new Product($productData);
    if ($product->validateProduct()) {
      $product->saveProduct();
      exit;
    } else {
      echo "ERROR";
    }
  }

?>
