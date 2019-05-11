<?php
include_once 'localidad.php';
$localidades = new Localidad($_GET['provincia']);
echo $localidades->get_lista();
?>