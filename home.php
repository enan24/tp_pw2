<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php
    include_once "css.html";
    ?>
    <title>Home</title>
</head>
<body>
    <?php
    include_once "navbar.php";
    ?>

    <div class="container">
    <?php
    if (isset($_SESSION['email'])) {
        echo "<br><h3>Bienvenido " . $_SESSION['email'] . "</h3>";
    if (isset($_SESSION['admin'])) {
        echo "<p>Su usuario es administrador</p>";
    }
    }
    
    ?>
    
        
    </div>
    
    
    
    <?php
    include_once "javascript.html";
    ?>
</body>
</html>