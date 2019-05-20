<?php
session_start();

require_once('../models/conexion.php');

function isLogged() {
  if (!isset($_SESSION["isLogged"])) {
    header("location: index.php");
    exit;
  }
}

function searchUser($id) {
  if (!isset($id) || is_null($id)) {
    header('location: index.php');
    exit;
  }
  $conexion = new Conexion();
  if ($conexion->conexion->error != 0) {
    die('Ocurrio un error al cargar los datos');
  }
  $sql = "SELECT user.id AS 'idUser', user.email, user.password, user.bloqueado, user.admin,
                info.nombre, info.apellido, info.documento, info.telefono, info.provincia,
                info.localidad, info.direccion, info.direccionNumero, info.direccionPiso
          FROM usuario AS user INNER JOIN mas_info_usuario AS info ON user.id = info.usuario
          WHERE user.id = ". $id . ";";
  $result = $conexion->query($sql);
  return $result->fetch_assoc();
}

function searchProducts($idUser) {
  if (!isset($idUser) || is_null($idUser)) {
    header('location: index.php');
    exit;
  }
  $conexion = new Conexion();
  if ($conexion->conexion->error != 0) {
    die('Ocurrio un error al cargar los datos');
  }
  $sql = "SELECT *
          FROM product
          WHERE idUser = ". $idUser . ";";
  $result = $conexion->query($sql);
  $products = [];
  foreach($result as $product) {
    $products["" . $product['id'] . ""] = $product;
  }
  return $products;
}

function searchCategories() {
  $conexion = new Conexion();
  if ($conexion->conexion->error != 0) {
    die('Ocurrio un error al cargar los datos');
  }
  $sql = "SELECT * FROM category;";
  $result = $conexion->query($sql);
  $categories = [];
  foreach($result as $category) {
    $categories["" . $category['id'] . ""] = $category;
  }
  return $categories;
}

?>
