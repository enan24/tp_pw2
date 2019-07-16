<?php
require_once "../resources/utils.php";

isLogged();

$user = searchUser($_SESSION['idUser']);
if (!isset($user) || is_null($user)) {
    header('location: index.php');
    exit;
}
if (isset($_GET['remove']) && !is_null($_GET['remove'])) {
    removeProduct($_GET['remove']);
}

$data = array();
$data['rated_user'] = $_POST['rated_user'];
$data['product_id'] = $_POST['product_id'];
$data['rate'] = $_POST['input-1'];
$data['comment'] = $_POST['comment'];

saveRate($data);
header('location: ../views/purchases.php');
exit;
