<?php
require_once "../models/product.php";
$conexion = new Conexion();
$conexion = $conexion->conectar();
$keyword = $conexion->real_escape_string($_GET['keyword']);
$latitud = isset($_GET['latitud']) ? $_GET['latitud'] : null;
$longitud = isset($_GET['longitud']) ? $_GET['longitud'] : null;

if ($latitud && $longitud) {
    $latitudMax = $latitud + 0.0001;
    $latitudMin = $latitud - 0.0001;
    $longitudMax = $longitud + 0.0001;
    $longitudMin = $longitud - 0.0001;
    $sql = "SELECT p.id, u.email, p.title, p.description, p.subDescription, p.price, p.create_date
        FROM product AS p
        INNER JOIN usuario AS u ON p.idUser = u.id
        WHERE (p.title LIKE '%$keyword%' OR p.description LIKE '%$keyword%' OR p.subDescription LIKE '%$keyword%') AND ((p.latitud BETWEEN $latitudMin AND $latitudMax) AND (p.longitud BETWEEN $longitudMin AND $longitudMax));";
} else {
// Obtiene productos que tengan la palabra clave en el titulo, descripcion o subdescripcion
    $sql = "SELECT p.id, u.email, p.title, p.description, p.subDescription, p.price, p.create_date
            FROM product AS p
            INNER JOIN usuario AS u ON p.idUser = u.id
            WHERE p.title LIKE '%$keyword%' OR p.description LIKE '%$keyword%' OR p.subDescription LIKE '%$keyword%';";
}

if (!$result = $conexion->query($sql)) {
    return die("Ha ocurrido un error al ejecutar la consulta");
}

$productos = array();
while ($row = $result->fetch_assoc()) {
    $subCategories = array();
    $images = array();
    $productId = $row['id'];
    // Obtiene las subcategorias del producto
    $sql = "SELECT sc.name AS subCategory, c.name AS category
            FROM sub_category_product AS scp
            INNER JOIN subcategory AS sc ON scp.idSubCategory = sc.id
            INNER JOIN category AS c ON sc.idCategory = c.id
            WHERE scp.idProduct = $productId;";
    if (!$categories = $conexion->query($sql)) {
        return die("Ha ocurrido un error al ejecutar la consulta");
    }
    while ($category = $categories->fetch_assoc()) {
        $subCategories[$category['subCategory']] = $category['category'];
    }

    // Obtiene las imagenes del producto
    $sql = "SELECT image
            FROM product_image
            WHERE product_id = $productId;";
    if (!$img = $conexion->query($sql)) {
        return die("Ha ocurrido un error al ejecutar la consulta");
    }
    while ($image = $img->fetch_assoc()) {
        array_push($images, $image['image']);
    }

    $productData = array();
    $productData['id'] = $productId;
    $productData['idUser'] = $row['email'];
    $productData['title'] = $row['title'];
    $productData['description'] = $row['description'];
    $productData['subDescription'] = $row['subDescription'];
    $productData['price'] = $row['price'];
    $productData['categories'] = $subCategories;
    $productData['images'] = $images;
    $productData['create_date'] = $row['create_date'];
    $productData['latitud'] = 0;
    $productData['longitud'] = 0;
    $product = new Product($productData);
    array_push($productos, $product);
}
return $productos;
