<?php
session_start();

require_once('../models/conexion.php');

$GLOBALS['conexion'] = new Conexion();

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
  if ($GLOBALS['conexion']->conexion->error != 0) {
    die('Ocurrio un error al cargar los datos');
  }
  $sql = "SELECT user.id AS 'idUser', user.email, user.password, user.bloqueado, user.admin,
                info.nombre, info.apellido, info.documento, info.telefono, info.provincia,
                info.localidad, info.direccion, info.direccionNumero, info.direccionPiso
          FROM usuario AS user INNER JOIN mas_info_usuario AS info ON user.id = info.usuario
          WHERE user.id = ". $id . ";";
  $result = $GLOBALS['conexion']->query($sql);
  return $result->fetch_assoc();
}

function searchProducts($idUser) {
  if (!isset($idUser) || is_null($idUser)) {
    header('location: index.php');
    exit;
  }
  if ($GLOBALS['conexion']->conexion->error != 0) {
    die('Ocurrio un error al cargar los datos');
  }
  $sql = "SELECT *
          FROM product
          WHERE idUser = ". $idUser . ";";
  $result = $GLOBALS['conexion']->query($sql);
  $products = [];
  foreach($result as $product) {
    $products["" . $product['id'] . ""] = $product;
  }
  return $products;
}

function searchProduct($idProduct) {
  $sql = "SELECT p.id AS id, p.*, su.id AS idSubCategory, su.idCategory, su.name
          FROM product AS p INNER JOIN sub_category_product AS s ON p.id = s.idProduct
              INNER JOIN subcategory AS su ON s.idSubCategory = su.id
          WHERE p.id = ".$idProduct.";";
  $result = $GLOBALS['conexion']->query($sql);
  $row = mysqli_fetch_assoc($result);
  return $row;
}

function searchCategories() {
  if ($GLOBALS['conexion']->conexion->error != 0) {
    die('Ocurrio un error al cargar los datos');
  }
  $sql = "SELECT * FROM category;";
  $result = $GLOBALS['conexion']->query($sql);
  $categories = [];
  foreach($result as $category) {
    $categories["" . $category['id'] . ""] = $category;
  }
  return $categories;
}

function searchSubCategories($categoryId) {
  if ($GLOBALS['conexion']->conexion->error != 0) {
    die('Ocurrio un error al cargar los datos');
  }
  if (isset($categoryId) && !is_null($categoryId)) {
    $sql = "SELECT * FROM subcategory WHERE idCategory = ".$categoryId.";";
    $result = $GLOBALS['conexion']->query($sql);
    $subcategories = [];
    foreach($result as $subcategory) {
      $subcategories["" . $subcategory['id'] . ""] = $subcategory;
    };
    return $subcategories;
  }
}

function getPathImage() {
  $image_name=$_FILES['image']['name'];
  $temp = explode(".", $image_name);
  $newfilename = round(microtime(true)) . '.' . end($temp);
  $imagepath="../resources/img/products/".$newfilename;
  move_uploaded_file($_FILES["image"]["tmp_name"],$imagepath);
  return $imagepath;
}

function removeProduct($idProduct) {
  if ($GLOBALS['conexion']->conexion->error != 0) {
    die('Ocurrio un error al cargar los datos');
  }
  $sql = "DELETE FROM sub_category_product WHERE idProduct = ".$idProduct.";";
  $GLOBALS['conexion']->query($sql);
  $sql = "DELETE FROM product WHERE id = ".$idProduct.";";
  $GLOBALS['conexion']->query($sql);
}

?>
