<?php
class Provincia
{
    public function get_lista() {
        include_once '../models/conexion.php';
        $conexion = new Conexion();
        $conexion = $conexion->conectar();
        $lista_provincias = array();
        $sql = "SELECT * FROM provincia ORDER BY nombre;";
        if(!$result = $conexion->query($sql)) {
            return die("Ha ocurrido un error al ejecutar la consulta");
        }
        while ($row = $result->fetch_assoc()) {
            $lista_provincias[$row['id']] = $row['nombre'];
        }
        return $lista_provincias;
    }
}


?>