<?php
session_start();
class UsuarioInvalido
{
    public function Redirigir(){
        header('location: ingreso.php');
        exit();
    }
}
?>