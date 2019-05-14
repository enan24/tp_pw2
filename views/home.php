<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="../resources/css/estilosMenu.css">
    <link rel="stylesheet" href="../resources/css/estilosBody.css">
    <link rel="stylesheet" href="../resources/css/swiper.min.css">


    <?php
    include_once "../resources/templates/css.html";
    ?>
    <title>Home</title>
</head>

<body>
    <?php
    include_once "../resources/templates/navbar.php";
    ?>

    <div class="container">
        <?php
    if (isset($_SESSION['email'])) {
        echo "<br><h3>Bienvenido " . $_SESSION['email'] . "</h3>";
    if ($_SESSION['admin']) {
        echo "<p>Su usuario es administrador</p>";
    }
    }
    
    ?>


    </div>



    <?php
    include_once "../resources/templates/javascript.html";
    ?>

    <section class="sectionInicio">
        <div class="swiper-container swiper-container0">
            <div class="swiper-wrapper">
                <div class="swiper-slide swiper-slide0"><img src="../resources/img/inicio.png" name="imgInicio1"></div>
                <!-- <div class="swiper-slide swiper-slide0"><img src="img/inicio/2.jpg" name="imgInicio2"></div>
            <div class="swiper-slide swiper-slide0"><img src="img/inicio/3.jpg" name="imgInicio3"></div>
            <div class="swiper-slide swiper-slide0"><img src="img/inicio/4.jpg" name="imgInicio4"></div> -->
            </div>

            <div class="swiper-pagination"></div>
        </div>
    </section>

    <div class="subtitulo" id="subTituloRecientes">
        <div class="imgCinta">
            <img src="../resources/img/iconoCinta2.jpg">
            <p>MAS RECIENTES</p>
        </div>
    </div>



    <section class="contenedorMasRecientes">
        <section class="centroFlechas flechas">
            <img class="atras atras1" src="../resources/img/left-arrow.svg">
            <img class="adelante adelante1" src="../resources/img/right-arrow.svg">
        </section>
        <div class="swiper-container swiper-container1" id="swiper-container">
            <div class="swiper-wrapper" id="swiper-wrapper1">
                <div class="swiper-slide swiper-slide1">
                    <img class="cintaNuevo" src="../resources/img/nuevo.svg">
                    <div class="producto">
                        <div class="contenedorImg">
                            <img src="../resources/img/producto1.jpg">
                        </div>
                        <div class="cajaDatos">
                            <h2>$13000</h2>
                            <h3>Juego de cocina</h3>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide swiper-slide1">
                    <div class="cintaNuevo"><img src="../resources/img/nuevo.svg"></div>
                    <div class="producto">
                        <div class="contenedorImg">
                            <img src="../resources/img/producto2.jpg">
                        </div>
                        <div class="cajaDatos">
                            <h2>$13000</h2>
                            <h3>Juego de cocina</h3>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide swiper-slide1">
                    <div class="cintaNuevo"><img src="../resources/img/nuevo.svg"></div>
                    <div class="producto">
                        <div class="contenedorImg">
                            <img src="../resources/img/1.png">
                        </div>
                        <div class="cajaDatos">
                            <h2>$13000</h2>
                            <h3>Juego de cocina</h3>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide swiper-slide1">
                    <div class="cintaNuevo"><img src="../resources/img/nuevo.svg"></div>
                    <div class="producto">
                        <div class="contenedorImg">
                            <img src="../resources/img/producto3.png">
                        </div>
                        <div class="cajaDatos">
                            <h2>$13000</h2>
                            <h3>Juego de cocina</h3>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide swiper-slide1">
                    <div class="cintaNuevo"><img src="../resources/img/nuevo.svg"></div>
                    <div class="producto">
                        <div class="contenedorImg">
                            <img src="../resources/img/producto2.jpg">
                        </div>
                        <div class="cajaDatos">
                            <h2>$13000</h2>
                            <h3>Juego de cocina</h3>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide swiper-slide1">
                    <div class="cintaNuevo"><img src="../resources/img/nuevo.svg"></div>
                    <div class="producto">
                        <div class="contenedorImg">
                            <img src="../resources/img/producto1.jpg">
                        </div>
                        <div class="cajaDatos">
                            <h2>$13000</h2>
                            <h3>Juego de cocina</h3>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide swiper-slide1">
                    <div class="cintaNuevo"><img src="../resources/img/nuevo.svg"></div>
                    <div class="producto">
                        <div class="contenedorImg">
                            <img src="../resources/img/producto3.png">
                        </div>
                        <div class="cajaDatos">
                            <h2>$13000</h2>
                            <h3>Juego de cocina</h3>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide swiper-slide1">
                    <div class="cintaNuevo"><img src="../resources/img/nuevo.svg"></div>
                    <div class="producto">
                        <div class="contenedorImg">
                            <img src="../resources/img/producto2.jpg">
                        </div>
                        <div class="cajaDatos">
                            <h2>$13000</h2>
                            <h3>Juego de cocina</h3>
                        </div>
                    </div>
                </div>

            </div>

            <img class="left1 swiper-button-prev" id="swiper-button-prev1" src="../resources/img/left-arrow.svg">
            <img class="right1 swiper-button-next" id="swiper-button-next1" src="../resources/img/right-arrow.svg">

        </div>
    </section>

    <script src="../resources/js/masRecientes.js"></script>



    <div class="subtitulo" id="subTituloPromociones">
        <div class="imgCinta">
            <img src="../resources/img/iconoCinta2.jpg">
            <p>PROMOCIONES</p>
        </div>
    </div>





    <section class="contenedorPromociones">



        <section class="centroFlechas flechas">
            <img class="atras atras2" src="../resources/img/left-arrow.svg">
            <img class="adelante adelante2" src="../resources/img/right-arrow.svg">
        </section>
        <div class="swiper-container swiper-container2" id="swiper-container">
            <div class="swiper-wrapper" id="swiper-wrapper2">
                <div class="swiper-slide swiper-slide2">
                    <div class="cintaDescuento"><img src="../resources/img/descuento.svg"></div>
                    <div class="producto">
                        <div class="contenedorImg">
                            <img src="../resources/img/producto2.jpg">
                        </div>
                        <div class="cajaDatos">
                            <h2>$13000</h2>
                            <h3>Juego de cocina</h3>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide swiper-slide1">
                    <div class="cintaDescuento"><img src="../resources/img/descuento.svg"></div>
                    <div class="producto">
                        <div class="contenedorImg">
                            <img src="../resources/img/producto1.jpg">
                        </div>
                        <div class="cajaDatos">
                            <h2>$13000</h2>
                            <h3>Juego de cocina</h3>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide swiper-slide1">
                    <div class="cintaDescuento"><img src="../resources/img/descuento.svg"></div>
                    <div class="producto">
                        <div class="contenedorImg">
                            <img src="../resources/img/producto3.png">
                        </div>
                        <div class="cajaDatos">
                            <h2>$13000</h2>
                            <h3>Juego de cocina</h3>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide swiper-slide1">
                    <div class="cintaDescuento"><img src="../resources/img/descuento.svg"></div>
                    <div class="producto">
                        <div class="contenedorImg">
                            <img src="../resources/img/producto1.jpg">
                        </div>
                        <div class="cajaDatos">
                            <h2>$13000</h2>
                            <h3>Juego de cocina</h3>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide swiper-slide1">
                    <div class="cintaDescuento"><img src="../resources/img/descuento.svg"></div>
                    <div class="producto">
                        <div class="contenedorImg">
                            <img src="../resources/img/producto2.jpg">
                        </div>
                        <div class="cajaDatos">
                            <h2>$13000</h2>
                            <h3>Juego de cocina</h3>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide swiper-slide1">
                    <div class="cintaDescuento"><img src="../resources/img/descuento.svg"></div>
                    <div class="producto">
                        <div class="contenedorImg">
                            <img src="../resources/img/producto1.jpg">
                        </div>
                        <div class="cajaDatos">
                            <h2>$13000</h2>
                            <h3>Juego de cocina</h3>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide swiper-slide1">
                    <div class="cintaDescuento"><img src="../resources/img/descuento.svg"></div>
                    <div class="producto">
                        <div class="contenedorImg">
                            <img src="../resources/img/producto3.png">
                        </div>
                        <div class="cajaDatos">
                            <h2>$13000</h2>
                            <h3>Juego de cocina</h3>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide swiper-slide1">
                    <div class="cintaDescuento"><img src="../resources/img/descuento.svg"></div>
                    <div class="producto">
                        <div class="contenedorImg">
                            <img src="../resources/img/producto2.jpg">
                        </div>
                        <div class="cajaDatos">
                            <h2>$13000</h2>
                            <h3>Juego de cocina</h3>
                        </div>
                    </div>
                </div>

            </div>

            <img class="left2 swiper-button-prev" id="swiper-button-prev2" src="../resources/img/left-arrow.svg">
            <img class="right2 swiper-button-next" id="swiper-button-next2" src="../resources/img/right-arrow.svg">

        </div>
    </section>
    <script src="../resources/js/jQueryHome.js"></script>
    <script src="../resources/js/swiper.min.js"></script>
    <script src="../resources/js/promociones.js"></script>



</body>

</html>