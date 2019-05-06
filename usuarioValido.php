<?php
session_start();
class UsuarioValido
{
    public function Redirigir(){
        header('location: home.php');
        exit();
    }
}

?>