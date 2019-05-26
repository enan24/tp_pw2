<?php
session_start();
class Credencial {
    private $email;
    private $pass;

    public function __construct($email, $pass) {
        $this->email = $email;
        $this->pass = $pass;
    }

    public function validar() {
        $host = "localhost";
        $usuario = "root";
        $password = "";
        $bd = "tp_final";

        $conexion = new mysqli($host,$usuario,$password,$bd);
        if ($conexion->connect_error) {
            die("Ha tenido un error de conexion");
        }
        $userEmail = $conexion->real_escape_string($this->email);
        $userPassword = $conexion->real_escape_string(md5($this->pass));
        $sql = "SELECT * FROM usuario WHERE email = '$userEmail' AND password = '$userPassword';";
        if(!$result = $conexion->query($sql)) {
            echo "Ha ocurrido un error al ejecutar la consulta";
        } else {
            if ($conexion->affected_rows > 0) {
               while ($row = $result->fetch_assoc()) {
                    if ($row['bloqueado']) {
                        $_SESSION['bloqueado'] = true;
                        return null;
                    } else {
                        $_SESSION['email'] = $row['email'];
                        $_SESSION['admin'] = $row['admin'];
                        $_SESSION['idUser'] = $row['id'];
                        return true;
                   }
               }
            }
            return null;
        }

    }
}

?>
