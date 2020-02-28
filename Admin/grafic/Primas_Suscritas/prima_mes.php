<?php
session_start();
if (isset($_SESSION['seudonimo'])) {
} else {
  header("Location: login.php");
  exit();
}

require_once("../../../class/clases.php");


isset($_GET["tipo_cuenta"]) ? $tipo_cuenta = $_GET["tipo_cuenta"] : $tipo_cuenta = '';

isset($_GET["cia"]) ? $cia = $_GET["cia"] : $cia = '';

isset($_GET["ramo"]) ? $ramo = $_GET["ramo"] : $ramo = '';

//----------------------------------------------------------------------------
$obj11 = new Trabajo();
$user = $obj11->get_element_by_id('usuarios', 'seudonimo', $_SESSION['seudonimo']);

$asesor_u = $user[0]['cod_vend'];
$permiso = $user[0]['id_permiso'];
//---------------------------------------------------------------------------

$desde = $_GET['desde'] . '-01-01';
$hasta = ($_GET['desde']) . '-12-31';

$obj1 = new Trabajo();
$mes = $obj1->get_mes_prima($desde, $hasta, $cia, $ramo, $tipo_cuenta, '1');

$totals = 0;
$totalpa = 0;
$totalr = 0;
$totalCant = 0;

$mesArray = array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');

$ramoArray[sizeof($mes)] = null;
$cantArray[sizeof($mes)] = null;
$primaPorMes[sizeof($mes)] = null;

$primaPorMesPA[sizeof($mes)] = null;
$primaPorMesR[sizeof($mes)] = null;

if ($permiso != 3) {

  for ($i = 0; $i < sizeof($mes); $i++) {
    $desde = $_GET['desde'] . "-" . $mes[$i]["Month(f_desdepoliza)"] . "-01";
    $hasta = $_GET['desde'] . "-" . $mes[$i]["Month(f_desdepoliza)"] . "-31";

    $obj2 = new Trabajo();
    $primaMes = $obj2->get_poliza_grafp_2($ramo, $desde, $hasta, $cia, $tipo_cuenta);

    $cantArray[$i] = sizeof($primaMes);
    $sumasegurada = 0;
    $sumaseguradaPA = 0;
    $sumaseguradaR = 0;
    for ($a = 0; $a < sizeof($primaMes); $a++) {
      $sumasegurada = $sumasegurada + $primaMes[$a]['prima'];
      if ($primaMes[$a]['id_tpoliza'] == 1) {
        $sumaseguradaPA = $sumaseguradaPA + $primaMes[$a]['prima'];
      }
      if ($primaMes[$a]['id_tpoliza'] == 2) {
        $sumaseguradaR = $sumaseguradaR + $primaMes[$a]['prima'];
      }
    }
    $totals = $totals + $sumasegurada;
    $totalpa = $totalpa + $sumaseguradaPA;
    $totalr = $totalr + $sumaseguradaR;
    $totalCant = $totalCant + $cantArray[$i];
    $ramoArray[$i] = $primaMes[0]['cod_ramo'];
    $primaPorMes[$i] = $sumasegurada;
    $primaPorMesPA[$i] = $sumaseguradaPA;
    $primaPorMesR[$i] = $sumaseguradaR;
  }
}
if ($permiso == 3) {
  for ($i = 0; $i < sizeof($mes); $i++) {
    $desde = $_GET['desde'] . "-" . $mes[$i]["Month(f_desdepoliza)"] . "-01";
    $hasta = $_GET['desde'] . "-" . $mes[$i]["Month(f_desdepoliza)"] . "-31";

    $obj2 = new Trabajo();
    $primaMes = $obj2->get_poliza_grafp_2_by_user($ramo, $desde, $hasta, $cia, $tipo_cuenta, $asesor_u);

    $cantArray[$i] = sizeof($primaMes);
    $sumasegurada = 0;
    $sumaseguradaPA = 0;
    $sumaseguradaR = 0;
    for ($a = 0; $a < sizeof($primaMes); $a++) {
      $sumasegurada = $sumasegurada + $primaMes[$a]['prima'];
      if ($primaMes[$a]['id_tpoliza'] == 1) {
        $sumaseguradaPA = $sumaseguradaPA + $primaMes[$a]['prima'];
      }
      if ($primaMes[$a]['id_tpoliza'] == 2) {
        $sumaseguradaR = $sumaseguradaR + $primaMes[$a]['prima'];
      }
    }
    $totals = $totals + $sumasegurada;
    $totalpa = $totalpa + $sumaseguradaPA;
    $totalr = $totalr + $sumaseguradaR;
    $totalCant = $totalCant + $cantArray[$i];
    $ramoArray[$i] = $primaMes[0]['cod_ramo'];
    $primaPorMes[$i] = $sumasegurada;
    $primaPorMesPA[$i] = $sumaseguradaPA;
    $primaPorMesR[$i] = $sumaseguradaR;
  }
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
          <- Regresar</a> <div class="col-md-auto col-md-offset-2">
            <center>
              <h1 class="title">Primas Suscritas por Mes del Año <?= $_GET['desde']; ?></h1>
              </h1>
              <br />

              <a href="../primas_s.php" class="btn btn-info btn-lg btn-round">Menú de Gráficos</a>
            </center>
            <center><a class="btn btn-success" onclick="tableToExcel('Exportar_a_Excel', 'Prima Suscrita por Mes')" data-toggle="tooltip" data-placement="right" title="Exportar a Excel"><img src="../../../assets/img/excel.png" width="40" alt=""></a></center>
      </div>
      <br>



      <div class="table-responsive">
        <table class="table table-hover table-striped table-bordered" id="Exportar_a_Excel">
          <thead style="background-color: #00bcd4;color: white; font-weight: bold;">
            <tr>
              <th>Mes Desde Recibo</th>
              <th>Prima Suscrita Primer Año</th>
              <th>Prima Suscrita Renovación</th>
              <th>Prima Suscrita Total</th>
              <th>Cantidad</th>
            </tr>
          </thead>
          <tbody>
            <?php

            for ($i = 0; $i < sizeof($mes); $i++) {


            ?>
              <tr>
                <th scope="row"><?= $mesArray[$mes[$i]["Month(f_desdepoliza)"] - 1]; ?></th>
                <td align="right"><?= "$" . number_format($primaPorMesPA[$i], 2); ?></td>
                <td align="right"><?= "$" . number_format($primaPorMesR[$i], 2); ?></td>
                <td align="right"><?= "$" . number_format($primaPorMes[$i], 2); ?></td>
                <td align="right"><?= $cantArray[$i]; ?></td>
              </tr>
            <?php
            }
            ?>
          </tbody>
          <thead class="thead-dark">
            <tr>
              <th scope="col">TOTAL</th>
              <th align="right"><?= "$" . number_format($totalpa, 2); ?></th>
              <th align="right"><?= "$" . number_format($totalr, 2); ?></th>
              <th align="right"><?= "$" . number_format($totals, 2); ?></th>
              <th align="right"><?= $totalCant; ?></th>
            </tr>
          </thead>
        </table>
      </div>






    </div>



    <div class="container">
      <div class="wrapper col-12"><canvas id="chart-0" style="height:500px"></canvas></div>
    </div>

    <br><br><br><br>



    <?php require('footer_b.php'); ?>


  </div>
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
          document.write(new Date().getFullYear())
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
            data: [<?php $a = 0;
                    for ($i = 0; $i <= 11; $i++) {
                      if (($mes[$a]["Month(f_desdepoliza)"] - 1) == $i) {
                        $dataPrima = $primaPorMes[$a];
                        if ($a < (sizeof($mes) - 1)) {
                          $a++;
                        }
                      } else {
                        $dataPrima = 0;
                      }
                    ?> '<?= $dataPrima; ?>',
              <?php } ?>
            ],
            label: 'Prima Suscrita',
            fill: boundary,
            pointHoverRadius: 30,
            pointHitRadius: 20,
            pointRadius: 5,
          }]
        },
        options: Chart.helpers.merge(options, {
          title: {
            text: 'Gráfico Prima Suscrita por Mes',
            fontSize: 25,
            display: true
          }
        })
      });
    });
  </script>
  <script language="javascript">
    function Exportar(table, name) {
      var uri = 'data:application/vnd.ms-excel;base64,',
        template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><meta http-equiv="content-type" content="application/vnd.ms-excel; charset=UTF-8"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>',
        base64 = function(s) {
          return window.btoa(unescape(encodeURIComponent(s)))
        },
        format = function(s, c) {
          return s.replace(/{(\w+)}/g, function(m, p) {
            return c[p];
          })
        }
      if (!table.nodeType) table = document.getElementById(table)
      var ctx = {
        worksheet: name || 'Worksheet',
        table: table.innerHTML
      }
      window.location.href = uri + base64(format(template, ctx))
    }
  </script>




</body>

</html>