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

    function __construct($product)
    {
      $this->id = isset($product['id']) ? $product['id'] : '';
      $this->idUser = $product['idUser'];
      $this->title = $product['title'];
      $this->image = $product['image'];
      $this->description = $product['description'];
      $this->subDescription = $product['subDescription'];
      $this->price = $product['price'];
      $this->date = $product['create_date'];
      $this->conexion = new Conexion();
    }

    public function validateProduct() {
      if ($_SESSION['admin'] === 0 && !$this->idUser === $_SESSION['idUser']) {
        return false;
      }
      if (strlen($this->title) < 3) {
        return false;
      }
      if (strlen($this->description) < 5) {
        return false;
      }
      if (strlen($this->image) < 10) {
        return false;
      }
      if ($this->price === 0) {
        return false;
      }
      return true;
    }

    public function saveProduct() {
      $sql = "INSERT INTO product (idUser, title, image, description, subDescription, price, create_date)
              VALUES ($this->idUser, '$this->title', '$this->image', '$this->description', '$this->subDescription', '$this->price', '$this->date');";
      $result = $this->conexion->query($sql);
      if(!$result) {
          return die("Ha ocurrido un error al ejecutar la consulta");
      }
      header('location: home.php');
      exit;
    }

    public function removeProduct() {

    }

    public function updateProduct() {

    }

  }

?>
