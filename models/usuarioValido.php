<?php
session_start();
class UsuarioValido
{
    public function Redirigir(){
        header('location: ../views/home.php');
        exit();
    }
}

?>