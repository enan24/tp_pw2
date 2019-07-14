<?php
require_once "../resources/utils.php";
require_once "../models/product.php";
isLogged();
isAdmin();

if(isset($_GET['action']) && isset($_GET['id'])) {
  $message = lockOrUnlockUser($_GET['action'], $_GET['id']);
}

$resultUsers = searchAllUsers();
?>
