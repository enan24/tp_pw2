<?php
session_start();
include_once '../models/localidad.php';
$localidades = new Localidad($_GET['provincia']);
echo $localidades->get_lista();
?>