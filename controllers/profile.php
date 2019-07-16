<?php
require_once "../resources/utils.php";
require_once "../models/product.php";

isLogged();

$user = searchUser($_SESSION['idUser']);
if (!isset($user) || is_null($user)) {
    header('location: index.php');
    exit;
}
if (isset($_GET['remove']) && !is_null($_GET['remove'])) {
    removeProduct($_GET['remove']);
}
$ratings = getRate($user['idUser']);
$avgRate = 0;
if ($sum = array_sum($ratings) > 0) {
  $avgRate = array_sum($ratings)/count($ratings);
}

$resultProducts = searchProducts($user['idUser']);
$products = [];
foreach ($resultProducts as $product) {
    $products['' . $product['id'] . ''] = new Product($product);
}

$purchasesWithoutPayment = getInterestToPaid($user['idUser']);
