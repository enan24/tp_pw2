<?php
class Usuario
{
    private $email;
    private $password;
    private $nombre;
    private $apellido;
    private $documento;
    private $telefono;
    private $provincia;
    private $localidad;
    private $direccion;
    private $direccionNumero;
    private $direccionPiso;

    public function __construct($email, $password, $nombre, $apellido, $documento, $telefono, $provincia, $localidad, $direccion, $direccionNumero, $direccionPiso) {
        $this->email = $email;
        $this->password = $password;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->documento = $documento;
        $this->telefono = $telefono;
        $this->provincia = $provincia;
        $this->localidad = $localidad;
        $this->direccion = $direccion;
        $this->direccionNumero = $direccionNumero;
        $this->direccionPiso = $direccionPiso;
    }

    public function guardar() {
        include_once 'conexion.php';
        $conexion = new Conexion();
        $conexion = $conexion->conectar();
        $email = $conexion->real_escape_string($this->email);
        $password = $conexion->real_escape_string(md5($this->password));
        $sql = "INSERT INTO usuario (email, password) VALUES ('$email', '$password')";
        if(!$result = $conexion->query($sql)) {
            if ($conexion->errno == 1062) {
                return die("El correo ingresado ya se encuentra registrado");
            }
            return die("Ha ocurrido un error al ejecutar la consulta");
        }
        $last_id = $conexion->insert_id;
        $nombre = $conexion->real_escape_string($this->nombre);
        $apellido = $conexion->real_escape_string($this->apellido);
        $documento = filter_var($this->documento, FILTER_SANITIZE_NUMBER_INT);
        $telefono = filter_var($this->telefono, FILTER_SANITIZE_NUMBER_INT);
        $provincia = filter_var($this->provincia, FILTER_SANITIZE_NUMBER_INT);
        $localidad = filter_var($this->localidad, FILTER_SANITIZE_NUMBER_INT);
        $direccion = $conexion->real_escape_string($this->direccion);
        $direccionNumero = filter_var($this->direccionNumero, FILTER_SANITIZE_NUMBER_INT);
        $direccionPiso = $conexion->real_escape_string($this->direccionPiso);
        $sql = "INSERT INTO mas_info_usuario (usuario, nombre, apellido, documento, telefono, provincia, localidad, direccion, direccionNumero, direccionPiso)
                VALUES ($last_id, '$nombre', '$apellido', $documento, $telefono, $provincia, '$localidad', '$direccion', $direccionNumero, '$direccionPiso');";
        if(!$result = $conexion->query($sql)) {
            return die("Ha ocurrido un error al ejecutar la consulta");
        }

    }
}


?>