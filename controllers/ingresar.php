<?php
session_start();
include_once "../models/credencial.php";
include_once "../models/login.php";

$email = $_POST["formEmail"];
$pass = $_POST["formPassword"];

$credencial = new Credencial($email, $pass);
$login = new Login();
$usuario = $login->loguearUsuario($credencial);

$usuario->Redirigir();

?>