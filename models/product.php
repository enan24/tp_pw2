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
      $this->id = $product['id'];
      $this->idUser = $product['idUser'];
      $this->title = $product['title'];
      $this->image = $product['image'];
      $this->description = $product['description'];
      $this->subDescription = $product['subDescription'];
      $this->price = $product['price'];
      $this->date = $product['create_date'];
      $this->conexion = new Conexion();
    }

    public function removeProduct() {

    }

    public function updateProduct() {

    }
  }

?>
