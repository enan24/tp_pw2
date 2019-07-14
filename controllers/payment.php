<?php
    require_once("../resources/utils.php");
    $products = searchShoppingCart();
    $metodoPago = $_POST['metodoPago'];
    $total = 0;
    foreach ($products as $productId => $info) {
        $total += $info['cantidad']*$info['price'];
    }

    $sql = "INSERT INTO sale (idUser, date_sale, amount, type_pay)
            VALUES (".$_SESSION['idUser'].", NOW(), '".$total."', '".$metodoPago."');";

    if (!$result = $GLOBALS['conexion']->query($sql)) {
        return die("Ha ocurrido un error al ejecutar la consulta");
    }

    $last_id = $conexion->insert_id;

    $sql = "INSERT INTO sale_interest (user_id, sale_id)
            VALUES (".$_SESSION['idUser'].", $last_id);";

    if (!$result = $GLOBALS['conexion']->query($sql)) {
        return die("Ha ocurrido un error al ejecutar la consulta");
    }

    foreach ($products as $productId => $info) {
        $sql = "INSERT INTO products_sale (idSale, idProduct, cant)
        VALUES (".$last_id.", ".$productId.", ".$info['cantidad'].");";

        if (!$result = $GLOBALS['conexion']->query($sql)) {
            return die("Ha ocurrido un error al ejecutar la consulta");
        } 
    }
    $_SESSION['shopping-cart'] = null;
?>