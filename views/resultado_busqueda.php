<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <?php
    include_once "../resources/templates/css.html";
    ?>
    <title>Resultados de busqueda</title>
</head>

<body>
    <?php
    require_once("../controllers/buscar_producto.php");
    include_once "../resources/templates/navbar.php";
    ?>
    <?php
    include_once "../resources/templates/javascript.html";
    ?>
    <br>
    <div class="container">
        <div class="row">
            <?php
                foreach ($productos as $producto) {
                    $category = "";
                    $subCategories = "";
                    foreach ($producto->categories as $subCategory => $category) {
                        $category = $category;
                        $subCategories .= $subCategory . " - ";
                    }
                    $subCategories = rtrim($subCategories, " - ");

                    // INICIO carousel
                    echo '<div class="col-lg-4 col-md-6 mb-4"><div class="card h-100"><a href="#">
                            <div id="carouselProduct' . $producto->id . '" class="carousel slide" data-ride="carousel" data-interval="false"><ol class="carousel-indicators">';
                    for ($i=0; $i < sizeof($producto->images); $i++) { 
                        if ($i == 0) {
                            echo '<li data-target="#carouselProduct' . $producto->id . '" data-slide-to="' . $i . '" class="active"></li>';
                        } else {
                           echo '<li data-target="#carouselProduct' . $producto->id . '" data-slide-to="' . $i .'"></li>';
                        }
                    }
                    echo '</ol><div class="carousel-inner">';
                    for ($i=0; $i < sizeof($producto->images); $i++) { 
                        if ($i == 0) {
                            echo '<div class="carousel-item active"><img src="' . $producto->images[$i] .'" class="d-block w-100" alt="..."></div>';
                        } else {
                            echo '<div class="carousel-item"><img src="' . $producto->images[$i] .'" class="d-block w-100" alt="..."></div>';
                        }
                    }
                    echo '</div><a class="carousel-control-prev" href="#carouselProduct' . $producto->id . '" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselProduct' . $producto->id . '" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                        </div></a>';
                    // FIN carousel

                    echo '<div class="card-body">
                            <h4 class="card-title">
                                <a href="#">' . $producto->title .'</a>
                            </h4>
                            <h5>$' . $producto->price . '</h5>
                            <p class="card-text"><strong>Categoria:</strong> ' . $category . '<br><strong>Subcategorias:</strong> ' . $subCategories . '<br><small>' . $producto->description . '</small></p>
                        </div>
                        <div class="card-footer small">
                        Creado el: ' . strftime("%A, %d de %B de %Y", strtotime($producto->date)) . '
                        </div>
                    </div>
                </div>';
                }
            ?>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->

    <script src="../resources/js/geolocation.js"></script>


</body>

</html>