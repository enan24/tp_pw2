<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <link rel="icon" href="../resources/img/favico.jpg">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Estadisticas</title>
    <?php
require_once "../resources/utils.php";
include_once "../resources/templates/css.html";
include_once "../resources/templates/javascript.html";

// include("../resources/dompdf-master/dompdf_config.inc.php");
// $html = htmlspecialchars(file_get_contents(__FILE__));
// $name = "estadisticas-" . date("Y-m-d H:i:s") . ".pdf";

//   if (isset($_GET['export']) && $_GET['export']) {
//     $mipdf = new DOMPDF();
//     $mipdf->set_paper("A4", "portait");
//     $mipdf->load_html($html);
//     $mipdf->render();
//     $mipdf->stream($name);
//   }
?>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.5/js/mdb.min.js"></script>
<style type="text/css">
@media print
{
body * { visibility: hidden; }
#charts * { visibility: visible; }
#charts { position: absolute; top: 40px; left: 30px; }
}
</style>
</head>

<body>
    <?php
    include_once "../resources/templates/navbar.php";
  ?><br>
    <div class="container-fluid">
        <div class="row">
        <div class="col-sm-2">
            <ul class="list-group">
                <li class='list-group-item'><a href='?'>Todos</a></li>
                <?php
                    $usuarios = searchAllUsers();
                    foreach ($usuarios as $usuario) {
                        $email = $usuario['email'];
                        $idUser = $usuario['userid'];
                        echo "<li class='list-group-item'><a href='?user=$idUser&email=$email'>$email</a></li>";
                    }
                ?>
            </ul>
        </div>
        <div class="col-sm">
            <?php
                $idUser = (isset($_GET['user'])) ? $_GET['user'] : null;
                if (isset($_GET['email'])) {
                    $email = $_GET['email'];
                    echo "<div class='row'><h2>Mostrando estadísticas para: $email</h2></div><br>";
                }
            ?>
            <div id="charts" class="row">
            <canvas id="chartBusquedaPorCategoria" style="max-width: 500px;"></canvas>
            <canvas id="chartBusquedasRealizadas" style="max-width: 500px;"></canvas>
            <canvas id="chartMontosPorDia" style="max-width: 500px;"></canvas>
            <canvas id="chartVentasPorUsuario" style="max-width: 500px;"></canvas>
        </div><br>
        <div class="row">
                <!-- <a href="<?php echo "?export=true" ?>" class="btn btn-primary">Exportar a PDF</a> -->
                <button onclick="printDocument();" class="btn btn-primary">Exportar a PDF</button>
        </div>
        </div>
        </div>
    </div>
    
    <script>

    function printDocument() {
        window.print();
    }

  var chartBusquedaPorCategoria = document.getElementById("chartBusquedaPorCategoria").getContext('2d');
  var myChart = new Chart(chartBusquedaPorCategoria, {
    type: 'bar',
    data: {
      labels: <?php echo json_encode(getBusquedasPorCategoria($idUser)['names']); ?>,
      datasets: [{
        label: 'Categorias mas visitadas',
        data: <?php echo json_encode(getBusquedasPorCategoria($idUser)['cantidad']); ?>,
        backgroundColor: [
          'rgba(255, 99, 132, 0.2)',
          'rgba(54, 162, 235, 0.2)',
          'rgba(255, 206, 86, 0.2)',
          'rgba(75, 192, 192, 0.2)',
          'rgba(153, 102, 255, 0.2)',
          'rgba(255, 159, 64, 0.2)'
        ],
        borderColor: [
          'rgba(255,99,132,1)',
          'rgba(54, 162, 235, 1)',
          'rgba(255, 206, 86, 1)',
          'rgba(75, 192, 192, 1)',
          'rgba(153, 102, 255, 1)',
          'rgba(255, 159, 64, 1)'
        ],
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        yAxes: [{
          ticks: {
            beginAtZero: true
          }
        }]
      }
    }
  });

  var chartBusquedasRealizadas = document.getElementById("chartBusquedasRealizadas").getContext('2d');
  var myChart = new Chart(chartBusquedasRealizadas, {
    type: 'bar',
    data: {
      labels: <?php echo json_encode(getBusquedasRealizadas($idUser)['keyword']); ?>,
      datasets: [{
        label: 'Palabras mas buscadas',
        data: <?php echo json_encode(getBusquedasRealizadas($idUser)['cantidad']); ?>,
        backgroundColor: [
          'rgba(255, 99, 132, 0.2)',
          'rgba(54, 162, 235, 0.2)',
          'rgba(255, 206, 86, 0.2)',
          'rgba(75, 192, 192, 0.2)',
          'rgba(153, 102, 255, 0.2)',
          'rgba(255, 159, 64, 0.2)'
        ],
        borderColor: [
          'rgba(255,99,132,1)',
          'rgba(54, 162, 235, 1)',
          'rgba(255, 206, 86, 1)',
          'rgba(75, 192, 192, 1)',
          'rgba(153, 102, 255, 1)',
          'rgba(255, 159, 64, 1)'
        ],
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        yAxes: [{
          ticks: {
            beginAtZero: true
          }
        }]
      }
    }
  });

  var chartMontosPorDia = document.getElementById("chartMontosPorDia").getContext('2d');
  var myChart = new Chart(chartMontosPorDia, {
    type: 'bar',
    data: {
      labels: <?php echo json_encode(getMontosPorDia($idUser)['fecha']); ?>,
      datasets: [{
        label: 'Montos por compras por día',
        data: <?php echo json_encode(getMontosPorDia($idUser)['monto']); ?>,
        backgroundColor: [
          'rgba(255, 99, 132, 0.2)',
          'rgba(54, 162, 235, 0.2)',
          'rgba(255, 206, 86, 0.2)',
          'rgba(75, 192, 192, 0.2)',
          'rgba(153, 102, 255, 0.2)',
          'rgba(255, 159, 64, 0.2)'
        ],
        borderColor: [
          'rgba(255,99,132,1)',
          'rgba(54, 162, 235, 1)',
          'rgba(255, 206, 86, 1)',
          'rgba(75, 192, 192, 1)',
          'rgba(153, 102, 255, 1)',
          'rgba(255, 159, 64, 1)'
        ],
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        yAxes: [{
          ticks: {
            beginAtZero: true
          }
        }]
      }
    }
  });

  var chartVentasPorUsuario = document.getElementById("chartVentasPorUsuario").getContext('2d');
  var myChart = new Chart(chartVentasPorUsuario, {
    type: 'bar',
    data: {
      labels: <?php echo json_encode(getVentasPorUsuario($idUser)['email']); ?>,
      datasets: [{
        label: 'Ventas por usuario',
        data: <?php echo json_encode(getVentasPorUsuario($idUser)['cantidad']); ?>,
        backgroundColor: [
          'rgba(255, 99, 132, 0.2)',
          'rgba(54, 162, 235, 0.2)',
          'rgba(255, 206, 86, 0.2)',
          'rgba(75, 192, 192, 0.2)',
          'rgba(153, 102, 255, 0.2)',
          'rgba(255, 159, 64, 0.2)'
        ],
        borderColor: [
          'rgba(255,99,132,1)',
          'rgba(54, 162, 235, 1)',
          'rgba(255, 206, 86, 1)',
          'rgba(75, 192, 192, 1)',
          'rgba(153, 102, 255, 1)',
          'rgba(255, 159, 64, 1)'
        ],
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        yAxes: [{
          ticks: {
            beginAtZero: true
          }
        }]
      }
    }
  });

</script>
</body>


</html>