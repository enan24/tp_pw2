<?php
class Conexion {

    public $conexion;

    public function __construct() {
        $host = "localhost";
        $usuario = "root";
        $password = "";
        $bd = "tp_final";

        $conexion = new mysqli($host,$usuario,$password,$bd);
        if ($conexion->connect_error) {
           return die("Ha tenido un error de conexion");
        }
        $this->conexion = $conexion;
    }

    public function conectar() {
        $host = "localhost";
        $usuario = "root";
        $password = "";
        $bd = "tp_final";

        $conexion = new mysqli($host,$usuario,$password,$bd);
        if ($conexion->connect_error) {
           return die("Ha tenido un error de conexion");
        }
        return $conexion;
    }

    public function query($query) {
        return $this->conexion->query($query);
    }
}

?>
