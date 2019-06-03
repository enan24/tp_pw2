<?php
  require_once("../resources/utils.php");
  $parte = 'Categoria';
  $message = '';
  isLogged();

  require_once("../models/category.php");
  require_once("../models/product.php");

  $categories = [];
  $categoryProduct = isset($_GET['category']) ? $_GET['category'] : '';
  if ($categoryProduct === '') {
    $resultCategories = searchCategories();
  } else {
    $parte = "Datos";
    $resultSubCategories = searchSubCategories($categoryProduct);

    foreach ($resultSubCategories as $category) {
      $categories['' . $category['id'] . ''] = new Category($category);
    }
  }

  $productData = array();
  $productData['idUser'] = isset($_SESSION['idUser']) ? $_SESSION['idUser'] : '';
  $productData['title'] = isset($_POST['name']) ? $_POST['name'] : '';
  $productData['description'] = isset($_POST['description']) ? $_POST['description'] : '';
  $productData['subDescription'] = isset($_POST['subdescription']) ? $_POST['subdescription'] : '';
  $productData['price'] = isset($_POST['price']) ? $_POST['price'] : 0;
  if ($_POST) {
    $subcategoriesPost = isset($_POST['subcategory']) ? $_POST['subcategory']: [];
    $productData['image'] = getPathImage("products");
    $productData['create_date'] = date("Y-m-d H:i:s");
    $product = new Product($productData);
    $message = $product->validateProduct($subcategoriesPost);
    if ($message === '') {
      $product->saveProduct($subcategoriesPost);
      header('location: profile.php');
      exit();
    }
  }

?>
