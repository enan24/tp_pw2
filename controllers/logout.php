<?php
session_start();
session_destroy();
header('location: ../views/home.php');
exit();

?>