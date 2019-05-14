<?php
class Conexion {
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
}

?>