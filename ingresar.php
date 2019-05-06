<?php
session_start();
include_once "credencial.php";
include_once "login.php";

$email = $_POST["formEmail"];
$pass = $_POST["formPassword"];

$credencial = new Credencial($email, $pass);
$login = new Login();
$usuario = $login->loguearUsuario($credencial);

$usuario->Redirigir();

?>