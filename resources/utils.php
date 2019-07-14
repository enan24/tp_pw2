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

function isAdmin() {
    if ((!isset($_SESSION["admin"]) || $_SESSION["admin"] != 1)) {
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
    if (isset($_SESSION['shopping-cart'])) {
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
    }
    return $products;
}

function getRelatedProducts($categories, $thisProduct) {
    $ids = array();
    $subCategoryId = "";
    foreach ($categories as $key => $value) {
        $sql = "SELECT id
                FROM subcategory
                WHERE name = '$value';";
        if (!$result = $GLOBALS['conexion']->query($sql)) {
            return die("Ha ocurrido un error al ejecutar la consulta");
        }
        $subCategoryId .= $result->fetch_assoc()['id'] . ",";
    }
    $subCategoryId = rtrim($subCategoryId,",");
    $sql = "SELECT DISTINCT(idProduct)
            FROM sub_category_product
            WHERE idSubCategory IN ($subCategoryId) AND idProduct != $thisProduct LIMIT 10;";
    if (!$result = $GLOBALS['conexion']->query($sql)) {
        return die("Ha ocurrido un error al ejecutar la consulta");
    }
    while ($row = $result->fetch_assoc()) {
        array_push($ids, $row);
    }
    $products = array();
    foreach ($ids as $key => $value) {
        array_push($products, searchProduct($value['idProduct']));
    }
    return $products;
}

function getComments($idProduct) {
    $comments = array();
    $sql = "SELECT c.comment, c.date, u.email
            FROM product_comment AS c
            INNER JOIN usuario AS u ON c.user_id = u.id
            WHERE c.product_id = $idProduct
            ORDER BY c.date DESC;";

    if (!$result = $GLOBALS['conexion']->query($sql)) {
        return die("Ha ocurrido un error al ejecutar la consulta");
    }
    while ($row = $result->fetch_assoc()) {
        array_push($comments, $row);
    }
    return $comments;
}

function getPurchases($idUser) {
    if (!isset($idUser) || is_null($idUser)) {
        header('location: index.php');
        exit;
    }
    $sql = "SELECT *, (SELECT u.email FROM usuario AS u WHERE u.id = p.idUser) AS email, (SELECT u.id FROM usuario AS u WHERE u.id = p.idUser) AS rated_user
          FROM sale AS s
          INNER JOIN products_sale AS ps ON s.id = ps.idSale
          INNER JOIN product AS p ON ps.idProduct = p.id
          WHERE s.idUser = " . $idUser . ";";
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

function getRate($idUser) {
    $rates = array();
    $sql = "SELECT ur.*, (SELECT u.email FROM usuario AS u WHERE u.id = ur.who_rated_id) AS email
            FROM user_rate AS ur
            WHERE ur.user_rated_id = $idUser;";
    if (!$result = $GLOBALS['conexion']->query($sql)) {
        return die("Ha ocurrido un error al ejecutar la consulta");
    }
    while ($row = $result->fetch_assoc()) {
        array_push($rates, $row);
    }
    return $rates;
}

function saveRate($data) {
    $user_rated_id = $data['rated_user'];
    $who_rated_id = $_SESSION['idUser'];
    $rate = $data['rate'];
    $comment = $data['comment'];
    $product_id = $data['product_id'];

    $sql = "INSERT INTO user_rate (user_rated_id, who_rated_id, rate, comment, product_id, date)
            VALUES($user_rated_id, $who_rated_id, $rate, '$comment', $product_id, NOW());";

    if (!$result = $GLOBALS['conexion']->query($sql)) {
        return die("Ha ocurrido un error al ejecutar la consulta");
    }
    return true;
}

function getInterestToPaid($idUser) {
    $sql = "SELECT s.date_sale, s.amount, s.id, si.id AS 'sale_interest_id'
            FROM sale_interest AS si
            INNER JOIN sale AS s ON si.sale_id = s.id
            WHERE si.user_id = $idUser AND si.paid = 0;";

    if (!$result = $GLOBALS['conexion']->query($sql)) {
        return die("Ha ocurrido un error al ejecutar la consulta");
    }
    $purchasesWithoutPayment = array();
    while ($row = $result->fetch_assoc()) {
        array_push($purchasesWithoutPayment, $row);
    }
    foreach ($purchasesWithoutPayment as $key => $value) {
        $idSale = $value['id'];
        $sql = "SELECT p.title, ps.cant
                FROM products_sale AS ps
                INNER JOIN product AS p ON ps.idProduct = p.id
                WHERE ps.idSale  = $idSale;";
        if (!$result = $GLOBALS['conexion']->query($sql)) {
            return die("Ha ocurrido un error al ejecutar la consulta");
        }
        $purchasesWithoutPayment[$key]['productsInvolved'] = array();
        while ($row = $result->fetch_assoc()) {
            array_push($purchasesWithoutPayment[$key]['productsInvolved'], $row);
        }
    }
    return $purchasesWithoutPayment;
}

function paidInterest($sale_interest_id) {
    $sql = "UPDATE sale_interest SET paid = 1
            WHERE id = $sale_interest_id;";
    if (!$result = $GLOBALS['conexion']->query($sql)) {
        return die("Ha ocurrido un error al ejecutar la consulta");
    }
}

function getPaidInterest() {
    $sql = "SELECT SUM(s.amount) AS 'total', MONTH(s.date_sale) AS 'mes', YEAR(s.date_sale) AS 'anio', COUNT(*) AS 'transacciones'
            FROM sale_interest AS si
            INNER JOIN sale AS s ON si.sale_id = s.id
            WHERE si.paid = 1
            GROUP BY mes, anio
            ORDER BY mes, anio ASC;";
    if (!$result = $GLOBALS['conexion']->query($sql)) {
        return die("Ha ocurrido un error al ejecutar la consulta " . $GLOBALS['conexion']->error);
    }
    $transactions = array();
    while ($row = $result->fetch_assoc()) {
        array_push($transactions, $row);
    }
    return $transactions;
}

function getImageProfile() {
  $sql = "SELECT foto FROM mas_info_usuario WHERE usuario = " . $_SESSION['idUser'] . ";";
  if (!$result = $GLOBALS['conexion']->query($sql)) {
      return die("Ha ocurrido un error al ejecutar la consulta");
  }
  $result = $result->fetch_assoc();
  return $result['foto'];
}

function searchAllUsers() {
  $sql = "SELECT u.id AS userid, u.bloqueado, i.nombre, i.apellido FROM usuario AS u JOIN mas_info_usuario AS i ON u.id = i.usuario";
  if (!$result = $GLOBALS['conexion']->query($sql)) {
      return die("Ha ocurrido un error al ejecutar la consulta");
  }
  return $result;
}

function lockOrUnlockUser($action, $user) {
  $bloqueado = $action === 'bloquear' ? 1 : 0;
  $sql = "UPDATE usuario SET bloqueado = $bloqueado WHERE id = $user";
  if (!$result = $GLOBALS['conexion']->query($sql)) {
      return die("Ha ocurrido un error al ejecutar la consulta");
  }
  $message = $bloqueado === 1 ? "El usuario fue bloqueado con exito." : "El usuario fue desbloqueado con exito.";
  return $message;
}

function loadProductsHome() {
  $sql = "SELECT id, idUser, title, description, price FROM product LIMIT 15";
  if (!$result = $GLOBALS['conexion']->query($sql)) {
      return die("Ha ocurrido un error al ejecutar la consulta");
  }
  $products = array();
  while ($product = $result->fetch_assoc()) {
      $sql = "SELECT image FROM product_image WHERE product_id = ".$product['id']." LIMIT 1";
      if (!$image = $GLOBALS['conexion']->query($sql)) {
          return die("Ha ocurrido un error al ejecutar la consulta");
      }
      $image = $image->fetch_assoc();
      $product['image'] = $image['image'];
      $rates = getRate($product['idUser']);
      $ratings = array();
      foreach ($rates as $key => $value) {
          array_push($ratings, $value['rate']);
      }
      $avgRate = 0;
      if ($sum = array_sum($ratings) > 0) {
        $avgRate = array_sum($ratings)/count($ratings);
      }
      $product['avgRate'] = $avgRate;
      array_push($products, $product);
  }
  return $products;
}
