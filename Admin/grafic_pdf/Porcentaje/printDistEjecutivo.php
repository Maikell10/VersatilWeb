<?php

require_once("../../../class/clases.php");

if (isset($_GET["tipo_cuenta"]) != null) {
  $tipo_cuenta = $_GET["tipo_cuenta"];
} else {
  $tipo_cuenta = '';
}

if (isset($_GET["cia"]) != null) {
  $cia = $_GET["cia"];
} else {
  $cia = '';
}

if (isset($_GET["ramo"]) != null) {
  $ramo = $_GET["ramo"];
} else {
  $ramo = '';
}

$anioGet = date("Y");
$mesGet = date("m");

$mes_arr=['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];

$mes = $mesGet;
$desde = $anioGet . "-" . $mesGet . "-01";
$hasta = $anioGet . "-" . $mesGet . "-31";

if ($mes == null) {
  $mesD = 01;
  $mesH = 12;
  $desde = $anioGet . "-" . $mesD . "-01";
  $hasta = $anioGet . "-" . $mesH . "-31";
}


$anio = $anioGet;
if ($anio == null) {
  $obj11 = new Trabajo();
  $fechaMin = $obj11->get_fecha_min('f_hastapoliza', 'poliza');
  $desde = $fechaMin[0]['MIN(f_hastapoliza)'];

  $obj12 = new Trabajo();
  $fechaMax = $obj12->get_fecha_max('f_hastapoliza', 'poliza');
  $hasta = $fechaMax[0]['MAX(f_hastapoliza)'];
}


$obj1 = new Trabajo();
$ejecutivo = $obj1->get_distinct_element_ejecutivo_ps($desde, $hasta, $cia, $ramo, $tipo_cuenta);

$totals = 0;
$totalCant = 0;

$ejecutivoArray[sizeof($ejecutivo)] = null;
$sumatotalEjecutivo[sizeof($ejecutivo)] = null;
$cantArray[sizeof($ejecutivo)] = null;


for ($i = 0; $i < sizeof($ejecutivo); $i++) {

  $obj2 = new Trabajo();
  $ejecutivoPoliza = $obj2->get_poliza_graf_prima_c_6($ejecutivo[$i]['codvend'], $ramo, $desde, $hasta, $cia, $tipo_cuenta);

  $ejecutivoArray[$i] = $ejecutivoPoliza[0]['idnom'];
  //." [ ".$ejecutivoPoliza[0]['cod']." ] "

  if ($ejecutivoPoliza[0]['idnom'] == null) {
    $ejecutivoPoliza = $obj2->get_poliza_graf_prima_c_6_r($ejecutivo[$i]['codvend'], $ramo, $desde, $hasta, $cia, $tipo_cuenta);
    $ejecutivoArray[$i] = $ejecutivoPoliza[0]['nombre'];

    if ($ejecutivoPoliza[0]['nombre'] == null) {
      $ejecutivoPoliza = $obj2->get_poliza_graf_prima_c_6_p($ejecutivo[$i]['codvend'], $ramo, $desde, $hasta, $cia, $tipo_cuenta);
      $ejecutivoArray[$i] = $ejecutivoPoliza[0]['nombre'];
    }
  }



  $cantArray[$i] = sizeof($ejecutivoPoliza);
  $sumasegurada = 0;
  for ($a = 0; $a < sizeof($ejecutivoPoliza); $a++) {
    $sumasegurada = $sumasegurada + $ejecutivoPoliza[$a]['prima'];
  }
  $totals = $totals + $sumasegurada;
  $totalCant = $totalCant + $cantArray[$i];
  $sumatotalEjecutivo[$i] = $sumasegurada;
}


asort($sumatotalEjecutivo, SORT_NUMERIC);


$x = array();
foreach ($sumatotalEjecutivo as $key => $value) {

  $x[count($x)] = $key;
}


//isset($_POST["ramo"]);
//onchange = "this.form.submit()"


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <?php require('header.php'); ?>
</head>

<body class="profile-page ">



  <div class="main main-raised">




    <div class="section">
      <div class="container">
        <div class="col-md-auto col-md-offset-2" style="text-align:center">
            <h1 class="title">Distribución de la Cartera por Ejecutivo</h1>
            <h2>Año: <?php echo $anioGet; ?></h2>
            <h3>Mes: <?php echo $mes_arr[$mesGet-1]; ?></h3>
        </div>
        <br>


        <div class="table-reponsive">

          <table class="table table-hover table-striped table-bordered nowrap" id="Exportar_a_Excel">
            <thead style="background-color: #00bcd4;color: white; font-weight: bold;">
              <tr>
                <th scope="col">Ejecutivo Cuenta</th>
                <th scope="col">Prima Suscrita</th>
                <th scope="col">%</th>
                <th scope="col">Cantidad</th>
              </tr>
            </thead>
            <tbody>
              <?php


              for ($i = sizeof($ejecutivo); $i > 0; $i--) {
                //echo $sumatotalRamo[$x[$i]]." - ".$ramoArray[$x[$i]];
                ?>
                <tr>
                  <th scope="row"><?php echo utf8_encode($ejecutivoArray[$x[$i]]); ?>
                  </th>
                  <td align="right"><?php echo "$" . number_format($sumatotalEjecutivo[$x[$i]], 2); ?></td>
                  <td><?php echo number_format(($sumatotalEjecutivo[$x[$i]] * 100) / $totals, 2) . " %"; ?></td>
                  <td><?php echo $cantArray[$x[$i]]; ?></td>
                </tr>
              <?php
              }
              ?>
            </tbody>
            <thead class="thead-dark">
              <tr>
                <th scope="col">TOTAL</th>
                <th align="right"><?php echo "$" . number_format($totals, 2); ?></th>
                <th scope="col">100%</th>
                <th scope="col"><?php echo $totalCant; ?></th>
              </tr>
            </thead>
          </table>
        </div>
      </div>
      <br><br>
      <div class="container">
        <canvas id="myChart">

        </canvas>
      </div>


      <br><br>


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
    Chart.defaults.global.defaultFontSize = 12;
    Chart.defaults.global.defaultFontColor = '#777';

    let massPopChart = new Chart(myChart, {
      type: 'pie', // bar, horizontalBar, pie, line, doughnut, radar, polarArea
      data: {
        labels: [<?php for ($i = sizeof($ejecutivo); $i > 0; $i--) { ?> '<?php echo utf8_encode($ejecutivoArray[$x[$i]]); ?>',

          <?php } ?>
        ],

        datasets: [{

          data: [<?php for ($i = sizeof($ejecutivo); $i > 0; $i--) {
                    ?> '<?php echo number_format(($sumatotalEjecutivo[$x[$i]] * 100) / $totals, 2); ?>',
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
            'black',
            'rgb(204, 0, 153)',
            'rgb(204, 51, 0)',
            'rgb(255, 255, 0)',
            'rgb(0, 0, 204)',
            'rgb(0, 153, 153)',
            'rgb(102, 102, 153)',
            'brown',
            'purple',
            'rgb(0, 102, 102)',
            'rgb(51, 204, 51)',
            'rgb(255, 80, 80)',
            'rgb(255, 153, 204)',
            'rgb(102, 0, 204)',
            'rgba(53, 57, 235, 0.6)',
            'rgba(255, 206, 86, 0.6)',
            'rgba(75, 192, 192, 0.6)',
            'rgba(153, 102, 255, 0.6)',
            'rgba(255, 159, 64, 0.6)',
            'rgba(255, 99, 132, 0.6)',
            'rgb(255, 153, 204)',
            'red',
            'blue',
            'yellow',
            'white',
            'gray',
            'rgb(204, 0, 0)',
            'rgb(204, 0, 204)',
            'rgb(102, 0, 204)',
            'rgb(0, 204, 153)',
            'rgb(204, 204, 0)',
            'rgb(102, 0, 51)',
            'rgba(255, 99, 132, 0.6)',
            'rgba(53, 57, 235, 0.6)',
            'rgba(255, 206, 86, 0.6)',
            'rgba(75, 192, 192, 0.6)',
            'rgba(153, 102, 255, 0.6)',
            'rgba(255, 159, 64, 0.6)',
            'rgba(255, 99, 132, 0.6)',
            'rgb(255, 153, 204)',
            'red',
            'blue',
            'black',
            'rgb(204, 0, 153)',
            'rgb(204, 51, 0)'
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
          text: 'Prima Suscrita por Ejecutivo (%)',
          fontSize: 25
        },
        legend: {
          display: true,
          position: 'bottom',
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

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.debug.js" integrity="sha384-NaWTHo/8YCBYJ59830LTz/P4aQZK1sS0SneOgAvhsIl3zBu8r9RevNg5lHCHAuQ/" crossorigin="anonymous"></script>
  <script src="../../../js/html2canvas.js"></script>

  <!--   Core JS Files   -->
  <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
  <script src="../../../assets/js/core/popper.min.js"></script>
  <script src="../../../assets/js/bootstrap-material-design.js"></script>
  <!-- Material Kit Core initialisations of plugins and Bootstrap Material Design Library -->
  <script src="../../../assets/js/material-kit.js?v=2.0.1"></script>
  <!-- Fixed Sidebar Nav - js With initialisations For Demo Purpose, Don't Include it in your project -->
  <script src="../../../assets/assets-for-demo/js/material-kit-demo.js"></script>


<script>

setTimeout(() => {
    html2canvas(document.body, {
        scale: window.devicePixelRatio,
        logging: true,
        profile: true,
        useCORS: false
    }).then(function(canvas) {
        const img = canvas.toDataURL('data:image/jpeg', 0.9);
        var doc = new jsPDF();
        doc.addImage(img, 'JPEG', 5, 10, 195, 200);
        //doc.addPage();
        //doc.addImage(img, 'JPEG', 5, 10, 195, 200);
        doc.save('Distribucion_Ejecutivo.pdf');
    });
}, 1000);

</script>
</body>

</html>