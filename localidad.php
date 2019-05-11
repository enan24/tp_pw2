<?php
class Localidad
{
    private $provincia;

    public function __construct($provincia) {
        $this->provincia = $provincia;
    }

    public function get_lista() {
        include_once 'conexion.php';
        $conexion = new Conexion();
        $conexion = $conexion->conectar();
        $lista_localidades = array();
        $provincia = filter_var($this->provincia, FILTER_SANITIZE_NUMBER_INT);
        $conexion->query("SET CHARACTER SET utf8");
        $sql = "SELECT id, nombre FROM localidad WHERE provincia = $provincia ORDER BY nombre;";
        if(!$result = $conexion->query($sql)) {
            return die("Ha ocurrido un error al ejecutar la consulta");
        }
        while ($row = $result->fetch_assoc()) {
            array_push($lista_localidades, array('id'=>$row['id'], 'nombre'=>$row['nombre']));
        }
        return json_encode($lista_localidades);
    }
}


?>