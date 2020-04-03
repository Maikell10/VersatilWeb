<?php
session_start();
if (isset($_SESSION['seudonimo'])) {
} else {
  header("Location: login.php");
  exit();
}

require_once("../../../class/comparativo.php");

isset($_GET["tipo_cuenta"]) ? $tipo_cuenta = $_GET["tipo_cuenta"] : $tipo_cuenta = '';

isset($_GET["cia"]) ? $cia = $_GET["cia"] : $cia = '';

isset($_GET["ramo"]) ? $ramo = $_GET["ramo"] : $ramo = '';


//----------------------------------------------------------------------------
$obj = new Comparativo();
$user = $obj->get_element_by_id('usuarios', 'seudonimo', $_SESSION['seudonimo']);

$asesor_u = $user['cod_vend'];
$permiso = $user['id_permiso'];
//---------------------------------------------------------------------------

$desde = $_GET['anio'] . '-01-01';
$hasta = ($_GET['anio']) . '-12-31';


$mes = $obj->get_prima_mm($desde, $hasta, $cia, $ramo, $tipo_cuenta);

$totals = 0;
$totalc = 0;
$totalCom = 0;
$totalCant = 0;

$mesArray = array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');

$ramoArray[sizeof($mes)] = null;
$cantArray[sizeof($mes)] = null;
$primaPorMes[sizeof($mes)] = null;

$primaPorMesC[sizeof($mes)] = null;
$comisionPorMes[sizeof($mes)] = null;


for ($i = 0; $i < sizeof($mes); $i++) {

  if ($mes[$i]["Month(f_desdepoliza)"] < 10) {
    $desde = $_GET['anio'] . "-0" . $mes[$i]["Month(f_desdepoliza)"] . "-01";
    $hasta = $_GET['anio'] . "-0" . $mes[$i]["Month(f_desdepoliza)"] . "-31";
  } else {
    $desde = $_GET['anio'] . "-" . $mes[$i]["Month(f_desdepoliza)"] . "-01";
    $hasta = $_GET['anio'] . "-" . $mes[$i]["Month(f_desdepoliza)"] . "-31";
  }



  $primaMes = $obj->get_poliza_prima_mm($ramo, $desde, $hasta, $cia, $tipo_cuenta);

  $cantArray[$i] = sizeof($primaMes);
  $sumasegurada = 0;
  for ($a = 0; $a < sizeof($primaMes); $a++) {
    $sumasegurada = $sumasegurada + $primaMes[$a]['prima'];
  }
  $totals = $totals + $sumasegurada;
  $totalCant = $totalCant + $cantArray[$i];
  $ramoArray[$i] = $primaMes[0]['cod_ramo'];
  $primaPorMes[$i] = $sumasegurada;

  $primacMes = $obj->get_poliza_pc_mm($ramo, $desde, $hasta, $cia, $tipo_cuenta);
  $sumaseguradaC = 0;
  $sumaseguradaCom = 0;
  for ($a = 0; $a < sizeof($primacMes); $a++) {
    $sumaseguradaC = $sumaseguradaC + $primacMes[$a]['prima_com'];
    $sumaseguradaCom = $sumaseguradaCom + $primacMes[$a]['comision'];
  }
  $totalc = $totalc + $sumaseguradaC;
  $totalCom = $totalCom + $sumaseguradaCom;
  $primaPorMesC[$i] = $sumaseguradaC;
  $comisionPorMes[$i] = $sumaseguradaCom;
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <?php require('header.php'); ?>
</head>

<body class="profile-page ">

  <?php require('navigation.php'); ?>




  <div class="page-header  header-filter " data-parallax="true" style="background-image: url('../../../assets/img/logo2.png');">
    <div class="container">
      <div class="row">
        <div class="col-md-8 ml-auto mr-auto">
          <div class="brand">

          </div>
        </div>
      </div>
    </div>
  </div>





  <div class="main main-raised">




    <div class="section">
      <div class="container">
        <a href="javascript:history.back(-1);" data-tooltip="tooltip" data-placement="right" title="Ir la página anterior" class="btn btn-info btn-round">
          <- Regresar</a> <div class="col-md-auto col-md-offset-2" style="text-align:center">
            <h1 class="title">Gráfico Resúmen Mes a Mes</h1>
            <h2>Año: <?= $_GET['anio']; ?></h2>
            <br>

            <a href="../comparativo.php" class="btn btn-info btn-lg btn-round">Menú de Gráficos</a>
            <br>
            <a class="btn btn-success" onclick="tableToExcel('Exportar_a_Excel', 'Primas Cobradas por Mes (Bola de Nieve)')" data-toggle="tooltip" data-placement="right" title="Exportar a Excel"><img src="../../../assets/img/excel.png" width="40" alt=""></a>
      </div>
      <br>


      <center>
        <div class="table-responsive">
          <table class="table table-hover table-striped table-bordered" id="Exportar_a_Excel">
            <thead style="background-color: #00bcd4;color: white; font-weight: bold;">
              <tr>
                <th>Mes Desde Produc</th>
                <th>Prima Suscrita</th>
                <th>Prima Cobrada</th>
                <th>Comisión</th>
                <th>Pendiente</th>
                <th>Cantidad</th>
              </tr>
            </thead>
            <tbody>
              <?php

              for ($i = 0; $i < sizeof($mes); $i++) {
                $a = 0;

              ?>
                <tr>
                  <th scope="row" data-toggle="tooltip" data-placement="top" title="Mes de Suscripción"><?= $mesArray[$mes[$i]["Month(f_desdepoliza)"] - 1]; ?></th>
                  <td style="text-align: right;"><?= "$" . number_format($primaPorMes[$i], 2); ?></td>
                  <td style="text-align: right;"><?= "$" . number_format($primaPorMesC[$i], 2); ?></td>
                  <td style="text-align: right;"><?= "$" . number_format($comisionPorMes[$i], 2); ?></td>
                  <td style="text-align: right;"><?= "$" . number_format(($primaPorMes[$i] - $primaPorMesC[$i]), 2); ?></td>
                  <td style="text-align: right;" data-toggle="tooltip" data-placement="top" title="Cantidad de Pólizas Suscritas en <?= $mesArray[$mes[$i]["Month(f_desdepoliza)"] - 1]; ?>"><?= $cantArray[$i]; ?></td>
                </tr>
              <?php
              }
              ?>
            </tbody>
            <tfoot>
              <tr>
                <th>TOTAL</th>
                <th style="text-align: right;"><?= "$" . number_format($totals, 2); ?></th>
                <th style="text-align: right;"><?= "$" . number_format($totalc, 2); ?></th>
                <th style="text-align: right;"><?= "$" . number_format($totalCom, 2); ?></th>
                <th style="text-align: right;"><?= "$" . number_format(($totals - $totalc), 2); ?></th>
                <th style="text-align: right;"><?= $totalCant; ?></th>
              </tr>
            </tfoot>
          </table>
        </div>
      </center>



    </div>
  </div>



  <div class="container">
    <div class="wrapper col-12"><canvas id="chart-0" style="height:500px"></canvas></div>
  </div>

  <br><br><br><br>



  <?php require('footer_b.php'); ?>


  </div>


  <footer class="footer ">
    <div class="container">
      <nav class="pull-left">
        <ul>
          <li>
            <a href="https://www.versatilseguros.com">
              Versatil Panamá
            </a>
          </li>
        </ul>
      </nav>
      <div class="copyright pull-right">
        &copy;
        <script>
          document.write(new Date().getFullYear());
        </script>, Versatil Seguros S.A.
      </div>
    </div>
  </footer>




  <!--   Core JS Files   -->
  <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
  <script src="../../../assets/js/core/popper.min.js"></script>
  <script src="../../../assets/js/bootstrap-material-design.js"></script>
  <!-- Material Kit Core initialisations of plugins and Bootstrap Material Design Library -->
  <script src="../../../assets/js/material-kit.js?v=2.0.1"></script>
  <!-- Fixed Sidebar Nav - js With initialisations For Demo Purpose, Dont Include it in your project -->
  <script src="../../../assets/assets-for-demo/js/material-kit-demo.js"></script>

  <script src="../../../Chart/Chart.bundle.js"></script>
  <script src="../../../Chart/samples/utils.js"></script>
  <script src="../../../Chart/samples/charts/area/analyser.js"></script>



  <script>
    var presets = window.chartColors;
    var utils = Samples.utils;
    var inputs = {
      min: 0,
      count: 12,
      decimals: 2,
      continuity: 1
    };

    function generateData(config) {
      return utils.numbers(Chart.helpers.merge(inputs, config || {}));
    }

    function generateLabels(config) {
      return utils.months(Chart.helpers.merge({
        count: inputs.count,
        section: 3
      }, config || {}));
    }

    var options = {
      maintainAspectRatio: false,
      spanGaps: false,
      elements: {
        line: {
          tension: 0.000001
        }
      },
      plugins: {
        filler: {
          propagate: false
        }
      },
      scales: {
        xAxes: [{
          ticks: {
            autoSkip: false,
            maxRotation: 0
          }
        }]
      }
    };

    [false, 'origin', 'start', 'end'].forEach(function(boundary, index) {

      // reset the random seed to generate the same data for all charts
      utils.srand(12);

      new Chart('chart-' + index, {
        type: 'line',
        data: {
          labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
          datasets: [{
            backgroundColor: utils.transparentize(presets.red),
            borderColor: presets.red,
            data: [<?php for ($i = 0; $i <= 11; $i++) {
                      if (($mes[$a]["Month(f_desdepoliza)"] - 1) == $i) {
                        $dataPrima = ($primaPorMes[$a] - $primaPorMesC[$a]);
                        if ($a < (sizeof($mes) - 1)) {
                          $a++;
                        }
                      } else { 
                        $dataPrima = 0;
                      }
                    ?> '<?= $dataPrima; ?>',
              <?php } ?>
            ],
            label: 'Prima Pendiente',
            fill: boundary,
            pointHoverRadius: 30,
            pointHitRadius: 20,
            pointRadius: 5,
          }]
        },
        options: Chart.helpers.merge(options, {
          title: {
            text: 'Gráfico de Póliza Pendiente por Mes',
            fontSize: 25,
            display: true
          }
        })
      });
    });
  </script>


</body>

</html>