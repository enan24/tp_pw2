<?php
  require_once('conexion.php');

  class Category
  {
    public $id;
    public $name;
    public $conexion;

    function __construct($category)
    {
      $this->id = $category['id'];
      $this->name = $category['name'];
      $this->conexion = new Conexion();
    }
  }

?>
