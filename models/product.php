<?php
require_once 'conexion.php';

class Product
{
    public $id;
    public $idUser;
    public $title;
    public $images;
    public $description;
    public $subDescription;
    public $price;
    public $date;
    public $conexion;
    public $categories;
    public $latitud;
    public $longitud;

    public function __construct($product)
    {
        $this->id = isset($product['id']) ? $product['id'] : '';
        $this->categories = isset($product['categories']) ? $product['categories'] : [];
        $this->idUser = $product['idUser'];
        $this->title = $product['title'];
        $this->images = $product['images'];
        $this->description = $product['description'];
        $this->subDescription = $product['subDescription'];
        $this->price = $product['price'];
        $this->date = $product['create_date'];
        $this->latitud = $product['latitud'];
        $this->longitud = $product['longitud'];
        $this->conexion = new Conexion();
    }

    public function validateProduct($subcategories)
    {
        $message = '';
        if ($_SESSION['admin'] === 0 && !$this->idUser === $_SESSION['idUser']) {
            $message = 'Ocurrio un error al procesar el producto.';
        }
        if (strlen($this->title) === 0) {
            $message = 'El título es requerido.';
        } else {
            if (strlen($this->title) < 3) {
                $message = 'El titulo es demasiado corto.';
            }
        }
        if (strlen($this->description) === 0) {
            $message = 'La descripción es requerida.';
        } else {
            if (strlen($this->description) < 5) {
                $message = 'La descripcion es muy corta.';
            }
        }
        if ((int) $this->price === 0) {
            $message = 'El precio es requerido.';
        }
        if (sizeof($subcategories) === 0) {
            $message = 'La categoria es requerida.';
        }
        return $message;
    }

    public function saveProduct($subcategories)
    {
        $conexion = $this->conexion->conectar();
        $price = (int) $this->price;
        $sql = "INSERT INTO product (idUser, title, description, subDescription, price, create_date, latitud, longitud)
              VALUES ($this->idUser, '$this->title', '$this->description', '$this->subDescription', '$price', '$this->date', '$this->latitud', '$this->longitud');";

        if (!$result = $conexion->query($sql)) {
            return die("Ha ocurrido un error al ejecutar la consulta" . $conexion->error);
        }

        $last_id = $conexion->insert_id;
        foreach ($this->images as $image) {
            $sql = "INSERT INTO product_image (product_id, image) VALUES ($last_id, '$image');";
            if (!$result = $conexion->query($sql)) {
                return die("Ha ocurrido un error al ejecutar la consulta");
            }
        }

        foreach ($subcategories as $subcategory) {
            $sql = "INSERT INTO sub_category_product (idSubCategory, idProduct)
                          VALUES ('$subcategory', $last_id);";
            if (!$result = $conexion->query($sql)) {
                return die("Ha ocurrido un error al ejecutar la consulta");
            }
        }
        return;
    }

    public function updateProduct()
    {

    }

}
