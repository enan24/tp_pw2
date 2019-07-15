<?php
require_once '../resources/utils.php';
require_once '../models/category.php';
require_once '../models/product.php';

isLogged();

if (isset($_GET['id']) && !is_null($_GET['id'])) {
  $message = '';
  $productData = searchProduct($_GET['id']);
  $imagesProduct = searchImagesProduct($_GET['id']);
  $categories = [];
  $categoryProduct = getCategoryProduct($productData['categories'], $productData['id']);
  $resultSubCategories = searchSubCategories($categoryProduct['id']);

  foreach ($resultSubCategories as $category) {
    $categories['' . $category['id'] . ''] = new Category($category);
  }
  $images = array();
  while ($image = $imagesProduct->fetch_assoc()) {
    array_push($images, $image);
  }
  if ($_POST) {
    print_r($_POST);
    if (isset($_POST['images']) && count($_POST['images']) > 0) {
      removeImages($_POST['images']);
    }
    // removeSubCategories($_GET['id']);
    $product = array();
    $product['id'] = $_GET['id'];
    $product['idUser'] = $_SESSION['idUser'];
    $product['create_date'] = $productData['create_date'];
    $product['title'] = isset($_POST['name']) ? $_POST['name'] : '';
    $product['description'] = isset($_POST['description']) ? $_POST['description'] : '';
    $product['subDescription'] = isset($_POST['subdescription']) ? $_POST['subdescription'] : '';
    $product['price'] = isset($_POST['price']) ? $_POST['price'] : 0;
    $product['images'] = getPathImage("products");
    $product = new Product($product);
    $message = $product->validateProduct($_POST['subcategory']);
    if ($message === '') {
      $product->updateProduct($_POST['subcategory']);
      header('location: profile.php');
      exit();
    }
  }
}
?>
