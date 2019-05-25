<?php
session_start();
include_once '../models/usuario.php';
include_once '../resources/utils.php';

$foto = getPathImage("users");

$usuario = new Usuario(
    $_POST['email'],
    $_POST['password'],
    $_POST['nombre'],
    $_POST['apellido'],
    $_POST['cuit'],
    $_POST['telefono'],
    $_POST['provincia'],
    $_POST['localidad'],
    $_POST['direccion'],
    $_POST['direccionNumero'],
    $_POST['direccionPiso'],
    $foto
);

$usuario->guardar();
$_SESSION['email'] = $_POST['email'];
header('location: ../views/home.php');
exit();
?>