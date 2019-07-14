<?php
require_once '../resources/utils.php';
$photo = getImageProfile();
?>
<link rel="stylesheet" href="../resources/css/estilosHead.css">
<nav style="background-color: #82E0FF;">
  <div class="img-profile">
    <a href="#">
      <img class="icon" src=<?php echo '"'.$photo.'"'; ?> alt="img-profile">
    </a>
  </div>
  <div class="content-navbar">
    <ul>
      <li>
        <a href="home.php">Inicio</a>
      </li>
      <li>
        <a href="../controllers/logout.php">Salir</a>
      </li>
    </ul>
  </div>
</nav>
