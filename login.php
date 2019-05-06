<?php
session_start();
include_once "credencial.php";
include_once "usuarioValido.php";
include_once "usuarioInvalido.php";

class Login {
    public function loguearUsuario($credencial) {
        if ($credencial->validar()) {
            return new UsuarioValido();
        } else {
            return new UsuarioInvalido();
        }
    }
}

?>