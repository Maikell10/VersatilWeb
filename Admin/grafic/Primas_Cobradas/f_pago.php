<?php 
session_start();
if(isset($_SESSION['seudonimo'])) {

  }
    else {
        header("Location: login.php");
        exit();
      }

  require_once("../../../class/clases.php");


  $obj1= new Trabajo();
  $mes = $obj1->get_mes_prima_BN(); 



  $totals=0;
  $totalCant=0;

  $mesArray = array('Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre');




  $ramoArray[sizeof($mes)]=null;
  $cantArray[sizeof($mes)]=null;
  $primaPorMes[sizeof($mes)]=null;
  $primaCobradaPorMes1=0;
  $primaCobradaPorMes2=0;
  $primaCobradaPorMes3=0;
  $primaCobradaPorMes4=0;
  $primaCobradaPorMes5=0;
  $primaCobradaPorMes6=0;
  $primaCobradaPorMes7=0;
  $primaCobradaPorMes8=0;
  $primaCobradaPorMes9=0;
  $primaCobradaPorMes10=0;
  $primaCobradaPorMes11=0;
  $primaCobradaPorMes12=0;

 
  $obj12= new Trabajo();
  $f_pago = $obj12->get_distinct_f_pago_prima_c($_GET['anio'],$_GET['ramo'],$_GET['cia']); 

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    
    <!-- Favicons -->
    <link rel="icon" href="../../../assets/img/logo1.png">
    <title>
        Versatil Seguros
    </title>
    <script src="../../../tableToExcel.js"></script>

    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />

    
    <link rel="stylesheet" href="../../../assets/css/material-kit.css?v=2.0.1">
    <!-- Documentation extras -->
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="../../../assets/assets-for-demo/demo.css" rel="stylesheet" />
    <link href="../../../assets/assets-for-demo/vertical-nav.css" rel="stylesheet" />
    
    <link href="../../../bootstrap-datepicker/css/bootstrap-datepicker.css" rel="stylesheet">

    <link href="../../../Chart/samples/style.css" rel="stylesheet">

   <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>

</head>

<body class="profile-page ">
    
  <?php require('navigation.php');?>




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
        <div class="container-fluid">
          <a href="javascript:history.back(-1);" data-tooltip="tooltip" data-placement="right" title="Ir la página anterior" class="btn btn-info btn-round"><- Regresar</a>

              <div class="col-md-auto col-md-offset-2" style="text-align:center">
                  <h1 class="title">Primas Cobradas por Forma de Pago</h1> 
                  <h2>Año: <?php echo $_GET['anio'];?></h2>
                  <br>
                  
                  <a href="../primas_c.php" class="btn btn-info btn-lg btn-round">Menú de Gráficos</a>
                  <br>
                  <a  class="btn btn-success" onclick="tableToExcel('Exportar_a_Excel', 'Primas Cobradas por Tipo de Póliza')" data-toggle="tooltip" data-placement="right" title="Exportar a Excel"><img src="../../../assets/img/excel.png" width="40" alt=""></a>
              </div>
              <br>


              <center>
              <div class="table-responsive">
              <table class="table table-hover table-striped table-bordered table-responsive" id="Exportar_a_Excel" style="font-size:14px; margin:0 auto;width: auto;">
                <thead style="background-color: #00bcd4;color: white; font-weight: bold;">
                  <tr>
                    <th>Forma de Pago</th>
                    <th>Enero</th>
                    <th>Febrero</th>
                    <th>Marzo</th>
                    <th>Abril</th>
                    <th>Mayo</th>
                    <th>Junio</th>
                    <th>Julio</th>
                    <th>Agosto</th>
                    <th>Septiempre</th>
                    <th>Octubre</th>
                    <th>Noviembre</th>
                    <th>Diciembre</th>
                    <th>Total</th>
                    <th>Cantidad</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    
                    $totalPC=0;
                    for ($i=0; $i < sizeof($f_pago); $i++) { 

                        
                        $obj2= new Trabajo();
                        $primaMes = $obj2->get_poliza_c_cobrada_f_pago($f_pago[$i]['fpago'],$_GET['cia'],$_GET['ramo'],$_GET['anio']); 

                    
                        $obj4= new Trabajo();
                        //$cant_p = $obj4->get_distinct_poliza_c_cobrada_bn($ramo[$i]['nramo'],$desde,$hasta,$_GET['cia']);

                      
                    
                      //$cantArray[$i]=sizeof($cant_p);
                      $sumasegurada=0;
                      $prima_pagada1=0;
                      $prima_pagada2=0;
                      $prima_pagada3=0;
                      $prima_pagada4=0;
                      $prima_pagada5=0;
                      $prima_pagada6=0;
                      $prima_pagada7=0;
                      $prima_pagada8=0;
                      $prima_pagada9=0;
                      $prima_pagada10=0;
                      $prima_pagada11=0;
                      $prima_pagada12=0;

                      $cantP=0;
                      
                      for($a=0;$a<sizeof($primaMes);$a++)
                        { 
                          
                          $sumasegurada=$sumasegurada+$primaMes[$a]['prima'];

                        
                          if ( ($primaMes[$a]['f_pago_prima'] >= $_GET['anio'].'-01-01') && ($primaMes[$a]['f_pago_prima'] <= $_GET['anio'].'-01-31') )  {
                            $prima_pagada1=$prima_pagada1+$primaMes[$a]['prima_com'];
                            $cantP=$cantP+1;
                          }
                          if ( ($primaMes[$a]['f_pago_prima'] >= $_GET['anio'].'-02-01') && ($primaMes[$a]['f_pago_prima'] <= $_GET['anio'].'-02-29') )  {
                            $prima_pagada2=$prima_pagada2+$primaMes[$a]['prima_com'];
                            $cantP=$cantP+1;
                          }
                          if ( ($primaMes[$a]['f_pago_prima'] >= $_GET['anio'].'-03-01') && ($primaMes[$a]['f_pago_prima'] <= $_GET['anio'].'-03-31'))  {
                            $prima_pagada3=$prima_pagada3+$primaMes[$a]['prima_com'];
                            $cantP=$cantP+1;
                          }
                          if ( ($primaMes[$a]['f_pago_prima'] >= $_GET['anio'].'-04-01') && ($primaMes[$a]['f_pago_prima'] <= $_GET['anio'].'-04-31'))  {
                            $prima_pagada4=$prima_pagada4+$primaMes[$a]['prima_com'];
                            $cantP=$cantP+1;
                          }
                          if ( ($primaMes[$a]['f_pago_prima'] >= $_GET['anio'].'-05-01') && ($primaMes[$a]['f_pago_prima'] <= $_GET['anio'].'-05-31'))  {
                            $prima_pagada5=$prima_pagada5+$primaMes[$a]['prima_com'];
                            $cantP=$cantP+1;
                          }
                          if ( ($primaMes[$a]['f_pago_prima'] >= $_GET['anio'].'-06-01') && ($primaMes[$a]['f_pago_prima'] <= $_GET['anio'].'-06-31'))  {
                            $prima_pagada6=$prima_pagada6+$primaMes[$a]['prima_com'];
                            $cantP=$cantP+1;
                          }
                          if ( ($primaMes[$a]['f_pago_prima'] >= $_GET['anio'].'-07-01') && ($primaMes[$a]['f_pago_prima'] <= $_GET['anio'].'-07-31'))  {
                            $prima_pagada7=$prima_pagada7+$primaMes[$a]['prima_com'];
                            $cantP=$cantP+1;
                          }
                          if ( ($primaMes[$a]['f_pago_prima'] >= $_GET['anio'].'-08-01') && ($primaMes[$a]['f_pago_prima'] <= $_GET['anio'].'-08-31'))  {
                            $prima_pagada8=$prima_pagada8+$primaMes[$a]['prima_com'];
                            $cantP=$cantP+1;
                          }
                          if ( ($primaMes[$a]['f_pago_prima'] >= $_GET['anio'].'-09-01') && ($primaMes[$a]['f_pago_prima'] <= $_GET['anio'].'-09-31'))  {
                            $prima_pagada9=$prima_pagada9+$primaMes[$a]['prima_com'];
                            $cantP=$cantP+1;
                          }
                          if ( ($primaMes[$a]['f_pago_prima'] >= $_GET['anio'].'-10-01') && ($primaMes[$a]['f_pago_prima'] <= $_GET['anio'].'-10-31'))  {
                            $prima_pagada10=$prima_pagada10+$primaMes[$a]['prima_com'];
                            $cantP=$cantP+1;
                          }
                          if ( ($primaMes[$a]['f_pago_prima'] >= $_GET['anio'].'-11-01') && ($primaMes[$a]['f_pago_prima'] <= $_GET['anio'].'-11-31'))  {
                            $prima_pagada11=$prima_pagada11+$primaMes[$a]['prima_com'];
                            $cantP=$cantP+1;
                          }
                          if ( ($primaMes[$a]['f_pago_prima'] >= $_GET['anio'].'-12-01') && ($primaMes[$a]['f_pago_prima'] <= $_GET['anio'].'-12-31'))  {
                            $prima_pagada12=$prima_pagada12+$primaMes[$a]['prima_com'];
                            $cantP=$cantP+1;
                          }

                        } 
                        
                        $totalP=0;
                        $totals=$totals+$sumasegurada;
                        $totalCant=$totalCant+$cantP;
                        $ramoArray[$i]=$primaMes[0]['cod_ramo'];
                        $primaPorMes[$i]=$sumasegurada;
                        $primaCobradaPorMes1=$primaCobradaPorMes1+$prima_pagada1;
                        $primaCobradaPorMes2=$primaCobradaPorMes2+$prima_pagada2;
                        $primaCobradaPorMes3=$primaCobradaPorMes3+$prima_pagada3;
                        $primaCobradaPorMes4=$primaCobradaPorMes4+$prima_pagada4;
                        $primaCobradaPorMes5=$primaCobradaPorMes5+$prima_pagada5;
                        $primaCobradaPorMes6=$primaCobradaPorMes6+$prima_pagada6;
                        $primaCobradaPorMes7=$primaCobradaPorMes7+$prima_pagada7;
                        $primaCobradaPorMes8=$primaCobradaPorMes8+$prima_pagada8;
                        $primaCobradaPorMes9=$primaCobradaPorMes9+$prima_pagada9;
                        $primaCobradaPorMes10=$primaCobradaPorMes10+$prima_pagada10;
                        $primaCobradaPorMes11=$primaCobradaPorMes11+$prima_pagada11;
                        $primaCobradaPorMes12=$primaCobradaPorMes12+$prima_pagada12;

                        $totalP=$prima_pagada1+$prima_pagada2+$prima_pagada3+$prima_pagada4+$prima_pagada5+$prima_pagada6+$prima_pagada7+$prima_pagada8+$prima_pagada9+$prima_pagada10+$prima_pagada11+$prima_pagada12;

                        $totalPC=$totalPC+$totalP;
                  ?>
                  <tr>
                    <th scope="row"><?php echo utf8_encode($f_pago[$i]['fpago']); ?></th>
                    <td align="right"><?php echo "$".number_format($prima_pagada1,2); ?></td>
                    <td align="right"><?php echo "$".number_format($prima_pagada2,2); ?></td>
                    <td align="right"><?php echo "$".number_format($prima_pagada3,2); ?></td>
                    <td align="right"><?php echo "$".number_format($prima_pagada4,2); ?></td>
                    <td align="right"><?php echo "$".number_format($prima_pagada5,2); ?></td>
                    <td align="right"><?php echo "$".number_format($prima_pagada6,2); ?></td>
                    <td align="right"><?php echo "$".number_format($prima_pagada7,2); ?></td>
                    <td align="right"><?php echo "$".number_format($prima_pagada8,2); ?></td>
                    <td align="right"><?php echo "$".number_format($prima_pagada9,2); ?></td>
                    <td align="right"><?php echo "$".number_format($prima_pagada10,2); ?></td>
                    <td align="right"><?php echo "$".number_format($prima_pagada11,2); ?></td>
                    <td align="right"><?php echo "$".number_format($prima_pagada12,2); ?></td>
                    <td align="right"><?php echo "$".number_format($totalP,2); ?></td>
                    <td align="right"><?php echo $cantP; ?></td>
                  </tr>
                  <?php
                      }
                  ?>
                </tbody>
                <tfoot>
                  <tr>
                    <th>TOTAL</th>
                    <th style="text-align: right;"><?php echo "$".number_format($primaCobradaPorMes1,2); ?></th>
                    <th style="text-align: right;"><?php echo "$".number_format($primaCobradaPorMes2,2); ?></th>
                    <th style="text-align: right;"><?php echo "$".number_format($primaCobradaPorMes3,2); ?></th>
                    <th style="text-align: right;"><?php echo "$".number_format($primaCobradaPorMes4,2); ?></th>
                    <th style="text-align: right;"><?php echo "$".number_format($primaCobradaPorMes5,2); ?></th>
                    <th style="text-align: right;"><?php echo "$".number_format($primaCobradaPorMes6,2); ?></th>
                    <th style="text-align: right;"><?php echo "$".number_format($primaCobradaPorMes7,2); ?></th>
                    <th style="text-align: right;"><?php echo "$".number_format($primaCobradaPorMes8,2); ?></th>
                    <th style="text-align: right;"><?php echo "$".number_format($primaCobradaPorMes9,2); ?></th>
                    <th style="text-align: right;"><?php echo "$".number_format($primaCobradaPorMes10,2); ?></th>
                    <th style="text-align: right;"><?php echo "$".number_format($primaCobradaPorMes11,2); ?></th>
                    <th style="text-align: right;"><?php echo "$".number_format($primaCobradaPorMes12,2); ?></th>
                    <th style="text-align: right;"><?php echo "$".number_format($totalPC,2); ?></th>
                    <th style="text-align: right;"><?php echo $totalCant; ?></th>
                  </tr>
                </tfoot>
              </table></div></center>


    
      </div>
    </div>



    <div class="container">
      <div class="wrapper col-12"><canvas id="chart-0"></canvas></div>
    </div>

    <br><br><br><br>



    <?php require('footer_b.php');?>
    
    
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
    <!-- Fixed Sidebar Nav - js With initialisations For Demo Purpose, Don't Include it in your project -->
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
          labels: ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
          datasets: [{
            backgroundColor: utils.transparentize(presets.red),
            borderColor: presets.red,
            data: [
                '<?php echo $primaCobradaPorMes1; ?>',
                '<?php echo $primaCobradaPorMes2; ?>',
                '<?php echo $primaCobradaPorMes3; ?>',
                '<?php echo $primaCobradaPorMes4; ?>',
                '<?php echo $primaCobradaPorMes5; ?>',
                '<?php echo $primaCobradaPorMes6; ?>',
                '<?php echo $primaCobradaPorMes7; ?>',
                '<?php echo $primaCobradaPorMes8; ?>',
                '<?php echo $primaCobradaPorMes9; ?>',
                '<?php echo $primaCobradaPorMes10; ?>',
                '<?php echo $primaCobradaPorMes11; ?>',
                '<?php echo $primaCobradaPorMes12; ?>'
          ],
            label: 'Prima Cobrada',
            fill: boundary,
            pointHoverRadius: 30,
            pointHitRadius: 20,
            pointRadius: 5,
          }]
        },
        options: Chart.helpers.merge(options, {
          title: {
            text: 'Gráfico Prima Cobrada por Forma de Pago',
            fontSize:25,
            display: true
          }
        })
      });
    });

    
  </script>
  <script language="javascript">

    function Exportar(table, name){
        var uri = 'data:application/vnd.ms-excel;base64,'
        , template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><meta http-equiv="content-type" content="application/vnd.ms-excel; charset=UTF-8"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>'
        , base64 = function (s) { return window.btoa(unescape(encodeURIComponent(s))) }
        , format = function (s, c) { return s.replace(/{(\w+)}/g, function (m, p) { return c[p]; }) }
        if (!table.nodeType) table = document.getElementById(table)
         var ctx = { worksheet: name || 'Worksheet', table: table.innerHTML }
         window.location.href = uri + base64(format(template, ctx))
        }
    </script>


  

  </body>
</html>