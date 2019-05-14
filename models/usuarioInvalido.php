<?php
session_start();
class UsuarioInvalido
{
    public function Redirigir(){
        header('location: ../views/ingresar.php');
        exit();
    }
}
?>