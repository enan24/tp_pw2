<?php
session_start();
include_once "../models/credencial.php";
include_once "../models/usuarioValido.php";
include_once "../models/usuarioInvalido.php";

class Login {
    public function loguearUsuario($credencial) {
        if ($credencial->validar()) {
            $_SESSION["isLogged"] = true;
            return new UsuarioValido();
        } else {
            return new UsuarioInvalido();
        }
    }
}

?>
