<?php
session_start();
if (isset($_SESSION['seudonimo'])) { } else {
  header("Location: login.php");
  exit();
}

require_once("../../../class/clases.php");

if (isset($_GET["tipo_cuenta"]) != null) {
  $tipo_cuenta = $_GET["tipo_cuenta"];
} else {
  $tipo_cuenta = '';
}

if (isset($_GET["ramo"]) != null) {
  $ramo = $_GET["ramo"];
} else {
  $ramo = '';
}

//----------------------------------------------------------------------------
$obj11 = new Trabajo();
$user = $obj11->get_element_by_id('usuarios', 'seudonimo', $_SESSION['seudonimo']);

$asesor_u = $user[0]['cod_vend'];
$permiso = $user[0]['id_permiso'];
//---------------------------------------------------------------------------

if ($permiso != 3) {

  $mes = $_GET['mes'];
  $desde = $_GET['anio'] . "-" . $_GET['mes'] . "-01";
  $hasta = $_GET['anio'] . "-" . $_GET['mes'] . "-31";

  if ($mes == null) {
    $mesD = 01;
    $mesH = 12;
    $desde = $_GET['anio'] . "-" . $mesD . "-01";
    $hasta = $_GET['anio'] . "-" . $mesH . "-31";
  }


  $anio = $_GET['anio'];
  if ($anio == null) {
    $obj11 = new Trabajo();
    $fechaMin = $obj11->get_fecha_min('f_hastapoliza', 'poliza');
    $desde = $fechaMin[0]['MIN(f_hastapoliza)'];

    $obj12 = new Trabajo();
    $fechaMax = $obj12->get_fecha_max('f_hastapoliza', 'poliza');
    $hasta = $fechaMax[0]['MAX(f_hastapoliza)'];
  }


  $obj1 = new Trabajo();
  $cia = $obj1->get_distinct_element_cia($desde, $hasta, $ramo, $tipo_cuenta);

  $totals = 0;
  $totalCant = 0;

  $ciaArray[sizeof($cia)] = null;
  $sumatotalCia[sizeof($cia)] = null;
  $cantArray[sizeof($cia)] = null;


  for ($i = 0; $i < sizeof($cia); $i++) {

    $obj2 = new Trabajo();
    $ciaPoliza = $obj2->get_poliza_graf_3($cia[$i]['nomcia'], $ramo, $desde, $hasta, $tipo_cuenta);

    $cantArray[$i] = sizeof($ciaPoliza);
    $sumasegurada = 0;
    for ($a = 0; $a < sizeof($ciaPoliza); $a++) {
      $sumasegurada = $sumasegurada + $ciaPoliza[$a]['prima'];
    }
    $totals = $totals + $sumasegurada;
    $totalCant = $totalCant + $cantArray[$i];
    $sumatotalCia[$i] = $sumasegurada;
    $ciaArray[$i] = $cia[$i]['nomcia'];
  }
}
if ($permiso == 3) {
  $mes = $_GET['mes'];
  $desde = $_GET['anio'] . "-" . $_GET['mes'] . "-01";
  $hasta = $_GET['anio'] . "-" . $_GET['mes'] . "-31";

  if ($mes == null) {
    $mesD = 01;
    $mesH = 12;
    $desde = $_GET['anio'] . "-" . $mesD . "-01";
    $hasta = $_GET['anio'] . "-" . $mesH . "-31";
  }


  $anio = $_GET['anio'];
  if ($anio == null) {
    $obj11 = new Trabajo();
    $fechaMin = $obj11->get_fecha_min('f_hastapoliza', 'poliza');
    $desde = $fechaMin[0]['MIN(f_hastapoliza)'];

    $obj12 = new Trabajo();
    $fechaMax = $obj12->get_fecha_max('f_hastapoliza', 'poliza');
    $hasta = $fechaMax[0]['MAX(f_hastapoliza)'];
  }


  $obj1 = new Trabajo();
  $cia = $obj1->get_distinct_element_cia_by_user($desde, $hasta, $ramo, $tipo_cuenta, $asesor_u);

  $totals = 0;
  $totalCant = 0;

  $ciaArray[sizeof($cia)] = null;
  $sumatotalCia[sizeof($cia)] = null;
  $cantArray[sizeof($cia)] = null;


  for ($i = 0; $i < sizeof($cia); $i++) {

    $obj2 = new Trabajo();
    $ciaPoliza = $obj2->get_poliza_graf_3_by_user($cia[$i]['nomcia'], $ramo, $desde, $hasta, $tipo_cuenta, $asesor_u);

    $cantArray[$i] = sizeof($ciaPoliza);
    $sumasegurada = 0;
    for ($a = 0; $a < sizeof($ciaPoliza); $a++) {
      $sumasegurada = $sumasegurada + $ciaPoliza[$a]['prima'];
    }
    $totals = $totals + $sumasegurada;
    $totalCant = $totalCant + $cantArray[$i];
    $sumatotalCia[$i] = $sumasegurada;
    $ciaArray[$i] = $cia[$i]['nomcia'];
  }
}

asort($sumatotalCia, SORT_NUMERIC);


$x = array();
foreach ($sumatotalCia as $key => $value) {

  $x[count($x)] = $key;
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
              <h1 class="title">Primas Suscritas por Cía</h1>
              <br />

              <a href="../primas_s.php" class="btn btn-info btn-lg btn-round">Menú de Gráficos</a>
            </center>
            <center><a class="btn btn-success" onclick="tableToExcel('Exportar_a_Excel', 'Primas Suscritas Por Cía')" data-toggle="tooltip" data-placement="right" title="Exportar a Excel"><img src="../../../assets/img/excel.png" width="40" alt=""></a></center>
      </div>
      <br>



      <div class="table-reponsive">
        <table class="table table-hover table-striped table-bordered nowrap" id="Exportar_a_Excel">
          <thead style="background-color: #00bcd4;color: white; font-weight: bold;">
            <tr>
              <th scope="col">Cía</th>
              <th scope="col">Prima Suscrita</th>
              <th scope="col">Cantidad</th>
            </tr>
          </thead>
          <tbody>
            <?php


            for ($i = sizeof($cia); $i > 0; $i--) {
              //echo $sumatotalCia[$x[$i]]." - ".$ciaArray[$x[$i]];
              ?>
              <tr>
                <th scope="row"><?= ($ciaArray[$x[$i]]); ?></th>
                <td align="right"><?= "$" . number_format($sumatotalCia[$x[$i]], 2); ?></td>
                <td><?= $cantArray[$x[$i]]; ?></td>
              </tr>
            <?php
            }
            ?>
          </tbody>
          <thead class="thead-dark">
            <tr>
              <th scope="col">TOTAL</th>
              <th align="right"><?= "$" . number_format($totals, 2); ?></th>
              <th scope="col"><?= $totalCant; ?></th>
            </tr>
          </thead>
        </table>
      </div>
    </div>

    <div class="container">
      <canvas id="myChart">

      </canvas>
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



  <script>
    let myChart = document.getElementById('myChart').getContext('2d');

    // Global Options
    Chart.defaults.global.defaultFontFamily = 'Lato';
    Chart.defaults.global.defaultFontSize = 18;
    Chart.defaults.global.defaultFontColor = '#777';

    let massPopChart = new Chart(myChart, {
      type: 'pie', // bar, horizontalBar, pie, line, doughnut, radar, polarArea
      data: {
        labels: [<?php for ($i = sizeof($cia); $i > 0; $i--) { ?> '<?= ($ciaArray[$x[$i]]); ?>',

          <?php } ?>
        ],

        datasets: [{

          data: [<?php for ($i = sizeof($cia); $i > 0; $i--) {
                    ?> '<?= $sumatotalCia[$x[$i]]; ?>',
            <?php } ?>
          ],
          //backgroundColor:'green',
          backgroundColor: [
            'rgba(255, 99, 132, 0.6)',
            'rgba(53, 57, 235, 0.6)',
            'rgba(255, 206, 86, 0.6)',
            'rgba(75, 192, 192, 0.6)',
            'rgba(153, 102, 255, 0.6)',
            'rgba(255, 159, 64, 0.6)',
            'rgba(255, 99, 132, 0.6)',
            'red',
            'blue',
            '#B44242',
            '#7BB442',
            '#42B489',
            '#4276B4',
            '#6F42B4',
            '#B442A1',
            'yellow',
            '#7198FF',
            '#FFBE71',
            '#FF6800',
            '#F5E300',
            '#BDF500',
            '#00F59C'
          ],
          borderWidth: 1,
          borderColor: '#777',
          hoverBorderWidth: 3,
          hoverBorderColor: '#000'
        }]
      },
      options: {
        title: {
          display: true,
          text: 'Grafico de Distribución de la Cartera por Cía',
          fontSize: 25
        },
        legend: {
          display: true,
          position: 'right',
          labels: {
            fontColor: '#000'
          }
        },
        layout: {
          padding: {
            left: 50,
            right: 0,
            bottom: 0,
            top: 0
          }
        },
        tooltips: {
          enabled: true
        }
      }
    });
  </script>

  <!--   Core JS Files   -->
  <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
  <script src="../../../assets/js/core/popper.min.js"></script>
  <script src="../../../assets/js/bootstrap-material-design.js"></script>
  <!-- Material Kit Core initialisations of plugins and Bootstrap Material Design Library -->
  <script src="../../../assets/js/material-kit.js?v=2.0.1"></script>
  <!-- Fixed Sidebar Nav - js With initialisations For Demo Purpose, Don't Include it in your project -->
  <script src="../../../assets/assets-for-demo/js/material-kit-demo.js"></script>

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