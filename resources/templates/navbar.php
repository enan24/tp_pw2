<nav class="navbar navbar-expand-lg navbar-light" style="background-color: #82E0FF;">
    <div class="col-sm-1">
  <a class="navbar-brand" href="home.php">
    <img src="../resources/img/logo.png" width="32" height="35" class="d-inline-block align-top" alt="">
  </a>
</div>
<div class="col-sm-2">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Link</a>
      </li>
      
    </ul>
  </div>
</div>
<div class="col-sm-6">
  <form class="form-inline my-2 my-lg-0">
    <input class="form-control mr-sm-2" style="width:80%;" type="search" placeholder="Buscar" aria-label="Search">
    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Buscar</button>
  </form>
</div>
<div class="col-sm-3">
  <div class="d-flex justify-content-end" style="padding-right:50px;">
<ul class="navbar-nav">
  <?php
  session_start();
  if (isset($_SESSION['email'])) {
    echo '<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
      aria-haspopup="true" aria-expanded="false">
      Mi cuenta
    </a>
    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
      <a class="dropdown-item" href="#">Mis ventas</a>
      <a class="dropdown-item" href="#">Mis compras</a>
      <div class="dropdown-divider"></div>
      <a class="dropdown-item" href="../controllers/logout.php">Cerrar sesion</a>
    </div>
  </li>';
  } else {
    echo '<li class="nav-item active">
    <a class="nav-link" href="../views/registrar.php">Registrarse</a>
  </li>
  <li class="nav-item active">
    <a class="nav-link" href="../views/ingresar.php">Iniciar sesion</a>
  </li>';
  }
  ?>
    
</ul>
</div>
</div>
</nav>