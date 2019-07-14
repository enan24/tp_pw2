<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <link rel="icon" href="../resources/img/favico.jpg">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Calificar usuario</title>
    <?php
require_once "../resources/utils.php";
include_once "../resources/templates/css.html";
include_once "../resources/templates/javascript.html";
?>

</head>

<body>
<?php
    include_once "../resources/templates/navbar.php";
  ?><br>
    <div class="container">
        <div class="row d-flex justify-content-center">

            
<div class="list-group">
<?php
                $transactions = getPaidInterest();
                foreach ($transactions as $key => $value) {
                    $mes = $value['mes'];
                    $dateObj   = DateTime::createFromFormat('!m', $mes);
                    $monthName = $dateObj->format('F');
                    $anio = $value['anio'];
                    $transacciones = $value['transacciones'];
                    $interesesPagados = $value['total'] * 0.04;
                    echo "<a href='#' class='list-group-item list-group-item-action flex-column align-items-start'>
                            <div class='d-flex w-100 justify-content-between'>
                                <h5 class='mb-1'>$monthName</h5>
                                <small>Año $anio</small>
                            </div>
                                <p class='mb-1'>Cantidad de transacciones: $transacciones</p>
                                <p class='mb-1 font-weight-bold' style='color:green;'>Total de intereses pagados: $$interesesPagados</p>
                         </a>";
                }
            ?>
</div>

        </div>
    </div>
</body>

</html>