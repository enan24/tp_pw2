<?php
session_start();

require_once '../models/conexion.php';

$GLOBALS['conexion'] = new Conexion();
$GLOBALS['conexion'] = $GLOBALS['conexion']->conectar();

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
    $sql = "SELECT user.id AS 'idUser', user.email, user.password, user.bloqueado, user.admin,
                info.nombre, info.apellido, info.cuit, info.telefono, info.provincia,
                info.localidad, info.direccion, info.direccionNumero, info.direccionPiso
          FROM usuario AS user INNER JOIN mas_info_usuario AS info ON user.id = info.usuario
          WHERE user.id = " . $id . ";";
    if (!$result = $GLOBALS['conexion']->query($sql)) {
        return die("Ha ocurrido un error al ejecutar la consulta");
    }
    return $result->fetch_assoc();
}

function searchProducts($idUser) {
    if (!isset($idUser) || is_null($idUser)) {
        header('location: index.php');
        exit;
    }
    $sql = "SELECT *
          FROM product
          WHERE idUser = " . $idUser . ";";
    if (!$result = $GLOBALS['conexion']->query($sql)) {
        return die("Ha ocurrido un error al ejecutar la consulta");
    }
    $products = [];
    foreach ($result as $product) {
        $products["" . $product['id'] . ""] = $product;
        $products["" . $product['id'] . ""]['categories'] = [];
        $products["" . $product['id'] . ""]['images'] = [];
        $sql = "SELECT p.id AS idProduct, su.id AS idSubCategory, su.idCategory, su.name
            FROM product AS p INNER JOIN sub_category_product AS s ON p.id = s.idProduct
                INNER JOIN subcategory AS su ON s.idSubCategory = su.id
            WHERE p.id = " . $product['id'] . ";";
        if (!$result = $GLOBALS['conexion']->query($sql)) {
            return die("Ha ocurrido un error al ejecutar la consulta");
        }
        foreach ($result as $category) {
            $products["" . $product['id'] . ""]['categories']["" . $category['idSubCategory'] . ""] = $category['name'];
        }
        $sql = "SELECT id, image
            FROM product_image WHERE product_id = " . $product['id'] . ";";
        if (!$result = $GLOBALS['conexion']->query($sql)) {
            return die("Ha ocurrido un error al ejecutar la consulta");
        }
        foreach ($result as $image) {
            $products["" . $product['id'] . ""]['images']["" . $image['id'] . ""] = $image['image'];
        }
    }
    return $products;
}

function searchProduct($idProduct) {
    $sql = "SELECT * FROM product WHERE id = ". $idProduct .";";
    if (!$result = $GLOBALS['conexion']->query($sql)) {
        return die("Ha ocurrido un error al ejecutar la consulta");
    }
    $product = mysqli_fetch_assoc($result);
    $sql = "SELECT p.id, su.id AS idSubCategory, su.idCategory, su.name
          FROM product AS p INNER JOIN sub_category_product AS s ON p.id = s.idProduct
              INNER JOIN subcategory AS su ON s.idSubCategory = su.id
          WHERE p.id = " . $idProduct . ";";
    if (!$result = $GLOBALS['conexion']->query($sql)) {
        return die("Ha ocurrido un error al ejecutar la consulta");
    }
    $product['categories'] = [];
    foreach ($result as $category) {
        $product['categories']["" . $category['idSubCategory'] . ""] = $category['name'];
    }
    return $product;
}

function searchImagesProduct($idProduct) {
  $sql = "SELECT * FROM product_image WHERE product_id = " . $idProduct . ";";
  if (!$result = $GLOBALS['conexion']->query($sql)) {
      return die("Ha ocurrido un error al ejecutar la consulta");
  }
  return $result;
}

function searchCategories() {
    $sql = "SELECT * FROM category;";
    if (!$result = $GLOBALS['conexion']->query($sql)) {
        return die("Ha ocurrido un error al ejecutar la consulta");
    }
    $categories = [];
    foreach ($result as $category) {
        $categories["" . $category['id'] . ""] = $category;
    }
    return $categories;
}

function searchSubCategories($categoryId) {
    if (isset($categoryId) && !is_null($categoryId)) {
        $sql = "SELECT * FROM subcategory WHERE idCategory = " . $categoryId . ";";
        if (!$result = $GLOBALS['conexion']->query($sql)) {
            return die("Ha ocurrido un error al ejecutar la consulta");
        }
        $subcategories = [];
        foreach ($result as $subcategory) {
            $subcategories["" . $subcategory['id'] . ""] = $subcategory;
        }
        ;
        return $subcategories;
    }
}

function getPathImage($type) {
    $config = parse_ini_file("../resources/config.ini", true);
    if ($type == "products") {
        $image_list = array();
        for ($i = 0; $i < sizeof($_FILES['image']['name']); $i++) {
            $image_list[$_FILES['image']['tmp_name'][$i]] = $_FILES['image']['name'][$i];
        }
        $path_list = array();
        foreach ($image_list as $tmp_name => $name) {
            $temp = explode(".", $name);
            $temp2 = hash("md5", $tmp_name);
            $newfilename = round(microtime(true)) . $temp2 . '.' . end($temp);
            $imagepath = $config['directories'][$type] . $newfilename;
            move_uploaded_file($tmp_name, $imagepath);
            array_push($path_list, $imagepath);
        }
        return $path_list;
    } else {
        $image_name = $_FILES['image']['name'];
        $temp = explode(".", $image_name);
        $newfilename = round(microtime(true)) . '.' . end($temp);
        $imagepath = $config['directories'][$type] . $newfilename;
        move_uploaded_file($_FILES["image"]["tmp_name"], $imagepath);
        return $imagepath;
    }

}

function removeProduct($idProduct) {
    $sql = "SELECT image
        FROM product_image
        WHERE product_id = " . $idProduct . ";";

    if (!$result = $GLOBALS['conexion']->query($sql)) {
        return die("Ha ocurrido un error al ejecutar la consulta");
    }

    foreach ($result as $image) {
        unlink($image['image']);
    }

    $sql = "DELETE FROM product WHERE id = " . $idProduct . ";";
    if (!$result = $GLOBALS['conexion']->query($sql)) {
        return die("Ha ocurrido un error al ejecutar la consulta");
    }
}

function addProductShoppingCart($idProduct) {
    isset($_SESSION['shopping-cart'][$idProduct]) ? $cant = ($_SESSION['shopping-cart'][$idProduct] + 1) : $cant = 1;
    $_SESSION['shopping-cart'][$idProduct] = $cant;
    return sizeof($_SESSION['shopping-cart']);
}

function searchShoppingCart() {
    $products = [];
    foreach ($_SESSION['shopping-cart'] as $productId => $cantidad) {
        $sql = "SELECT p.title, p.price, i.image
                FROM product AS p JOIN product_image AS i ON p.id = i.product_id
                WHERE p.id = ".$productId.";";
        if (!$result = $GLOBALS['conexion']->query($sql)) {
            return die("Ha ocurrido un error al ejecutar la consulta");
        }
        $result = $result->fetch_assoc();
        $result['cantidad'] = $cantidad;
        $products[$productId] = $result;
    }
    return $products;
}