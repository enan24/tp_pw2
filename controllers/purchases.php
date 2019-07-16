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

$resultPurchases = getPurchases($user['idUser']);
$products = [];
foreach ($resultPurchases as $product) {
    $products['' . $product['id'] . ''] = $product;
}
