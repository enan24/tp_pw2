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
    <form id="formLocation" action="../views/resultado_busqueda.php" method="get">
    <input type="hidden" name="keyword" id="keyword" value="<?php echo isset($keyword) ? $keyword : ''; ?>">
    <input type="hidden" name="latitud" id="latitud">
    <input type="hidden" name="longitud" id="longitud">
    <div class="d-flex align-items-center">Buscar por ubicación: <input id="pac-input" class="form-control" type="text" placeholder="Ingrese una ubicación"><button class="btn btn-primary" type="submit">Buscar</button></div>
    </form>
</div><br>
        <div class="row">

        
            <?php
                if ($productos) {
                    # code...
                
                foreach ($productos as $producto) {
                    $category = "";
                    $subCategories = "";
                    foreach ($producto->categories as $subCategory => $category) {
                        $category = $category;
                        $subCategories .= utf8_encode($subCategory) . " - ";
                    }
                    $subCategories = rtrim($subCategories, " - ");

                    // INICIO carousel
                    echo '<div class="col-lg-4 col-md-6 mb-4"><div class="card h-100"><a href="../views/product.php?id=' . $producto->id .'">
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
                                <a href="../views/product.php?id=' . $producto->id .'">' . $producto->title .'</a>
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
            } else {
                echo "<h2>No hay resultados</h2>";
            }
            ?>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->

    <script src="../resources/js/geolocation.js"></script>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCiIDP3P5IqtJ4LQGy2--zrhbtCsXJGpjI&libraries=places"></script>
    <script>

    $('#formLocation').on('keyup keypress', function(e) {
    var keyCode = e.keyCode || e.which;
    if (keyCode === 13) { 
        e.preventDefault();
        return false;
    }
    });

    var defaultBounds = new google.maps.LatLngBounds(
        new google.maps.LatLng(-33.8902, 151.1759),
        new google.maps.LatLng(-33.8474, 151.2631));

    var input = document.getElementById('pac-input');
    var options = {
        bounds: defaultBounds,
        types: ['address']
    };

    var autocomplete = new google.maps.places.Autocomplete(input, options);

	google.maps.event.addListener(autocomplete, 'place_changed', function () {
	    var place = autocomplete.getPlace();
	    document.getElementById('latitud').value = place.geometry.location.lat();
	    document.getElementById('longitud').value = place.geometry.location.lng();
    });
    
    </script>
</body>

</html>
