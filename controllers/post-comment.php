<?php
    require_once("../resources/utils.php");
    $user_id = $_SESSION['idUser'];
    $productId = $_POST['idProduct'];
    $comment = $_POST['comment'];
    $sql = "INSERT INTO product_comment (product_id, user_id, comment, date)
            VALUES ($productId, $user_id, '$comment', NOW());";

    if (!$result = $GLOBALS['conexion']->query($sql)) {
        return die("Ha ocurrido un error al ejecutar la consulta " . $conexion->error);
    }
    header('location: ../views/product.php?id=' . $productId);
    exit();
?>