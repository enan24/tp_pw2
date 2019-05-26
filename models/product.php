<?php
  require_once('conexion.php');

  class Product
  {
    public $id;
    public $idUser;
    public $title;
    public $image;
    public $description;
    public $subDescription;
    public $price;
    public $date;
    public $conexion;
    public $categories;

    function __construct($product)
    {
      $this->id = isset($product['id']) ? $product['id'] : '';
      $this->categories = isset($product['categories']) ? $product['categories'] : [];
      $this->idUser = $product['idUser'];
      $this->title = $product['title'];
      $this->image = $product['image'];
      $this->description = $product['description'];
      $this->subDescription = $product['subDescription'];
      $this->price = $product['price'];
      $this->date = $product['create_date'];
      $this->conexion = new Conexion();
    }

    public function validateProduct($subcategories) {
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
      if (strlen($this->image) < 10) {
        $message = 'La imagen no es valida.';
      }
      if ((int)$this->price === 0) {
        $message = 'El precio es requerido.';
      }
      if (sizeof($subcategories) === 0) {
        $message = 'La categoria es requerida.';
      }
      return $message;
    }

    public function saveProduct($subcategories) {
      $price = (int)$this->price;
      $sql = "INSERT INTO product (idUser, title, image, description, subDescription, price, create_date)
              VALUES ($this->idUser, '$this->title', '$this->image', '$this->description', '$this->subDescription', '$price', '$this->date');";
      $result = $this->conexion->query($sql);
      if(!$result) {
          return die("Ha ocurrido un error al ejecutar la consulta");
      }
      $sql = 'SELECT id FROM product WHERE idUser = '.$this->idUser.' AND title = "'.$this->title.'" AND create_date = "'.$this->date.'";';
      $result = $this->conexion->query($sql);
      $idProduct = '';
      foreach ($result as $category) {
        $idProduct = $category['id'];
      }
      foreach ($subcategories as $subcategory) {
        $sqlSubCategory = "INSERT INTO sub_category_product (idSubCategory, idProduct)
                          VALUES ('$subcategory', '$idProduct');";
        $this->conexion->query($sqlSubCategory);
      }
      return;
    }

    public function updateProduct() {

    }

  }

?>
