<?php
session_start();
include_once '../models/usuario.php';
$usuario = new Usuario($_POST['email'], $_POST['password'], $_POST['nombre'], $_POST['apellido'], $_POST['documento'], $_POST['telefono'], $_POST['provincia'], $_POST['localidad'], $_POST['direccion'], $_POST['direccionNumero'], $_POST['direccionPiso']);
$usuario->guardar();
$_SESSION['email'] = $_POST['email'];
header('location: ../views/home.php');
exit();
?>