<?php 
session_start();
if(isset($_SESSION['seudonimo'])) {

  }
    else {
        header("Location: login.php");
        exit();
      }

  require_once("../../../class/clases.php");

  if (isset($_GET["tipo_cuenta"])!=null) {
    $tipo_cuenta=$_GET["tipo_cuenta"]; 
  }else{$tipo_cuenta='';}

  if (isset($_GET["cia"])!=null) {
    $cia=$_GET["cia"]; 
  }else{$cia='';}

  if (isset($_GET["ramo"])!=null) {
    $ramo=$_GET["ramo"]; 
  }else{$ramo='';}


 $desdeI=$_GET['desde'].'-01-01';
 $hastaI=($_GET['desde']).'-12-31';

  $obj1= new Trabajo();
  $mes = $obj1->get_mes_prima_BN(); 



  $totals=0;
  $totalCant=0;

  $mesArray = array('Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre');


  $ramoArray[sizeof($mes)]=null;
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

//----------------------------------------------------------------------------
$obj11= new Trabajo();
$user = $obj11->get_element_by_id('usuarios','seudonimo',$_SESSION['seudonimo']); 

$asesor_u = $user[0]['cod_vend'];
$permiso = $user[0]['id_permiso'];
//---------------------------------------------------------------------------

if ($permiso!=3) { 
  $obj4= new Trabajo();
  $cant_p = $obj4->get_distinct_poliza_c_cobrada_bn($ramo,$desdeI,$hastaI,$cia,$tipo_cuenta);
}
if ($permiso==3) { 
  $obj4= new Trabajo();
  $cant_p = $obj4->get_distinct_poliza_c_cobrada_bn_by_user($ramo,$desdeI,$hastaI,$cia,$tipo_cuenta,$asesor_u);
}


  $sumasegurada[sizeof(12)]=null;
  $p1[sizeof(12)]=null;
  $p2[sizeof(12)]=null;
  $p3[sizeof(12)]=null;
  $p4[sizeof(12)]=null;
  $p5[sizeof(12)]=null;
  $p6[sizeof(12)]=null;
  $p7[sizeof(12)]=null;
  $p8[sizeof(12)]=null;
  $p9[sizeof(12)]=null;
  $p10[sizeof(12)]=null;
  $p11[sizeof(12)]=null;
  $p12[sizeof(12)]=null;
  $totalP[sizeof(12)]=null;
  $totalMes[sizeof(12)]=null;

  $cantidad[sizeof(12)]=null;
        for ($i=0; $i < 12; $i++) { 
          if ($mes[$i]["Month(f_desdepoliza)"]<10) {
            $desde=$_GET['desde']."-0".$mes[$i]["Month(f_desdepoliza)"]."-01";
            $hasta=$_GET['desde']."-0".$mes[$i]["Month(f_desdepoliza)"]."-31";
          } else {
            $desde=$_GET['desde']."-".$mes[$i]["Month(f_desdepoliza)"]."-01";
            $hasta=$_GET['desde']."-".$mes[$i]["Month(f_desdepoliza)"]."-31";
          }
          
          $mesB=$i+1;
          
        if ($permiso!=3) { 
          $obj2= new Trabajo();
          $primaMes = $obj2->get_poliza_c_cobrada_bn($ramo,$desde,$hasta,$cia,$mesB,$tipo_cuenta); 
        }
        if ($permiso==3) { 
          $obj2= new Trabajo();
          $primaMes = $obj2->get_poliza_c_cobrada_bn_by_user($ramo,$desde,$hasta,$cia,$mesB,$tipo_cuenta,$asesor_u); 
        }

          
          
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

          $cantMes=0;
          for($a=0;$a<sizeof($primaMes);$a++)
            { 
              $sumasegurada=$sumasegurada+$primaMes[$a]['prima'];

            
              if ( ($primaMes[$a]['f_pago_prima'] >= $_GET['desde'].'-01-01') && ($primaMes[$a]['f_pago_prima'] <= $_GET['desde'].'-01-31') )  {
                $prima_pagada1=$prima_pagada1+$primaMes[$a]['prima_com'];
                $cantMes=$cantMes+$primaMes[$a]['prima_com'];
              }
              if ( ($primaMes[$a]['f_pago_prima'] >= $_GET['desde'].'-02-01') && ($primaMes[$a]['f_pago_prima'] <= $_GET['desde'].'-02-29') )  {
                $prima_pagada2=$prima_pagada2+$primaMes[$a]['prima_com'];
                $cantMes=$cantMes+$primaMes[$a]['prima_com'];
              }
              if ( ($primaMes[$a]['f_pago_prima'] >= $_GET['desde'].'-03-01') && ($primaMes[$a]['f_pago_prima'] <= $_GET['desde'].'-03-31'))  {
                $prima_pagada3=$prima_pagada3+$primaMes[$a]['prima_com'];
                $cantMes=$cantMes+$primaMes[$a]['prima_com'];
              }
              if ( ($primaMes[$a]['f_pago_prima'] >= $_GET['desde'].'-04-01') && ($primaMes[$a]['f_pago_prima'] <= $_GET['desde'].'-04-31'))  {
                $prima_pagada4=$prima_pagada4+$primaMes[$a]['prima_com'];
                $cantMes=$cantMes+$primaMes[$a]['prima_com'];
              }
              if ( ($primaMes[$a]['f_pago_prima'] >= $_GET['desde'].'-05-01') && ($primaMes[$a]['f_pago_prima'] <= $_GET['desde'].'-05-31'))  {
                $prima_pagada5=$prima_pagada5+$primaMes[$a]['prima_com'];
                $cantMes=$cantMes+$primaMes[$a]['prima_com'];
              }
              if ( ($primaMes[$a]['f_pago_prima'] >= $_GET['desde'].'-06-01') && ($primaMes[$a]['f_pago_prima'] <= $_GET['desde'].'-06-31'))  {
                $prima_pagada6=$prima_pagada6+$primaMes[$a]['prima_com'];
                $cantMes=$cantMes+$primaMes[$a]['prima_com'];
              }
              if ( ($primaMes[$a]['f_pago_prima'] >= $_GET['desde'].'-07-01') && ($primaMes[$a]['f_pago_prima'] <= $_GET['desde'].'-07-31'))  {
                $prima_pagada7=$prima_pagada7+$primaMes[$a]['prima_com'];
                $cantMes=$cantMes+$primaMes[$a]['prima_com'];
              }
              if ( ($primaMes[$a]['f_pago_prima'] >= $_GET['desde'].'-08-01') && ($primaMes[$a]['f_pago_prima'] <= $_GET['desde'].'-08-31'))  {
                $prima_pagada8=$prima_pagada8+$primaMes[$a]['prima_com'];
                $cantMes=$cantMes+$primaMes[$a]['prima_com'];
              }
              if ( ($primaMes[$a]['f_pago_prima'] >= $_GET['desde'].'-09-01') && ($primaMes[$a]['f_pago_prima'] <= $_GET['desde'].'-09-31'))  {
                $prima_pagada9=$prima_pagada9+$primaMes[$a]['prima_com'];
                $cantMes=$cantMes+$primaMes[$a]['prima_com'];
              }
              if ( ($primaMes[$a]['f_pago_prima'] >= $_GET['desde'].'-10-01') && ($primaMes[$a]['f_pago_prima'] <= $_GET['desde'].'-10-31'))  {
                $prima_pagada10=$prima_pagada10+$primaMes[$a]['prima_com'];
                $cantMes=$cantMes+$primaMes[$a]['prima_com'];
              }
              if ( ($primaMes[$a]['f_pago_prima'] >= $_GET['desde'].'-11-01') && ($primaMes[$a]['f_pago_prima'] <= $_GET['desde'].'-11-31'))  {
                $prima_pagada11=$prima_pagada11+$primaMes[$a]['prima_com'];
                $cantMes=$cantMes+$primaMes[$a]['prima_com'];
              }
              if ( ($primaMes[$a]['f_pago_prima'] >= $_GET['desde'].'-12-01') && ($primaMes[$a]['f_pago_prima'] <= $_GET['desde'].'-12-31'))  {
                $prima_pagada12=$prima_pagada12+$primaMes[$a]['prima_com'];
                $cantMes=$cantMes+$primaMes[$a]['prima_com'];
              }

            } 
          
            $totals=$totals+$sumasegurada;
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


            $p1[$i]=$prima_pagada1;
            $p2[$i]=$prima_pagada2;
            $p3[$i]=$prima_pagada3;
            $p4[$i]=$prima_pagada4;
            $p5[$i]=$prima_pagada5;
            $p6[$i]=$prima_pagada6;
            $p7[$i]=$prima_pagada7;
            $p8[$i]=$prima_pagada8;
            $p9[$i]=$prima_pagada9;
            $p10[$i]=$prima_pagada10;
            $p11[$i]=$prima_pagada11;
            $p12[$i]=$prima_pagada12;

            $totalMes[$i]=$cantMes;
            $totalCant=$totalCant+$cantMes;
            

            $totalP[$i]=$prima_pagada1+$prima_pagada2+$prima_pagada3+$prima_pagada4+$prima_pagada5+$prima_pagada6+$prima_pagada7+$prima_pagada8+$prima_pagada9+$prima_pagada10+$prima_pagada11+$prima_pagada12;

            $totalPC=$totalPC+$totalP[$i];

        }
  

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <?php require('header.php');?>
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
                  <h1 class="title">Primas Cobradas por Mes <strong style="color:red">(Bola de Nieve)</strong></h1> 
                  <h2>Año: <?php echo $_GET['desde'];?></h2>
                  <br>
                  
                  <a href="../primas_c.php" class="btn btn-info btn-lg btn-round">Menú de Gráficos</a>
                  <br>
                  <a  class="btn btn-success" onclick="tableToExcel('Exportar_a_Excel', 'Primas Cobradas por Mes (Bola de Nieve)')" data-toggle="tooltip" data-placement="right" title="Exportar a Excel"><img src="../../../assets/img/excel.png" width="40" alt=""></a>
              </div>
              <br>


              <center>
              <div class="table-responsive">
              <table class="table table-hover table-striped table-bordered table-responsive" id="Exportar_a_Excel" style="font-size:14px; margin:0 auto;width: auto;">
                <thead style="background-color: #00bcd4;color: white; font-weight: bold;">
                  <tr>
                    <th>Mes Desde Recibo</th>
                    <th data-toggle="tooltip" data-placement="top" title="Mes de Cobranza">Enero</th>
                    <th data-toggle="tooltip" data-placement="top" title="Mes de Cobranza">Febrero</th>
                    <th data-toggle="tooltip" data-placement="top" title="Mes de Cobranza">Marzo</th>
                    <th data-toggle="tooltip" data-placement="top" title="Mes de Cobranza">Abril</th>
                    <th data-toggle="tooltip" data-placement="top" title="Mes de Cobranza">Mayo</th>
                    <th data-toggle="tooltip" data-placement="top" title="Mes de Cobranza">Junio</th>
                    <th data-toggle="tooltip" data-placement="top" title="Mes de Cobranza">Julio</th>
                    <th data-toggle="tooltip" data-placement="top" title="Mes de Cobranza">Agosto</th>
                    <th data-toggle="tooltip" data-placement="top" title="Mes de Cobranza">Septiempre</th>
                    <th data-toggle="tooltip" data-placement="top" title="Mes de Cobranza">Octubre</th>
                    <th data-toggle="tooltip" data-placement="top" title="Mes de Cobranza">Noviembre</th>
                    <th data-toggle="tooltip" data-placement="top" title="Mes de Cobranza">Diciembre</th>
                    <th>Total</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    
                    for ($i=0; $i < 12; $i++) { 
                      

                  ?>
                  <tr>
                    <th scope="row" data-toggle="tooltip" data-placement="top" title="Mes de Suscripción"><?php echo $mesArray[$mes[$i]["Month(f_desdepoliza)"]-1]; ?></th>
                    <td align="right"><?php echo "$".number_format($p1[$i],2); ?></td>
                    <td align="right"><?php echo "$".number_format($p2[$i],2); ?></td>
                    <td align="right"><?php echo "$".number_format($p3[$i],2); ?></td>
                    <td align="right"><?php echo "$".number_format($p4[$i],2); ?></td>
                    <td align="right"><?php echo "$".number_format($p5[$i],2); ?></td>
                    <td align="right"><?php echo "$".number_format($p6[$i],2); ?></td>
                    <td align="right"><?php echo "$".number_format($p7[$i],2); ?></td>
                    <td align="right"><?php echo "$".number_format($p8[$i],2); ?></td>
                    <td align="right"><?php echo "$".number_format($p9[$i],2); ?></td>
                    <td align="right"><?php echo "$".number_format($p10[$i],2); ?></td>
                    <td align="right"><?php echo "$".number_format($p11[$i],2); ?></td>
                    <td align="right"><?php echo "$".number_format($p12[$i],2); ?></td>
                    <td align="right"><?php echo "$".number_format($totalMes[$i],2); ?></td>
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
                    <th style="text-align: right;"><?php echo "$".number_format($totalCant,2); ?></th>
                  </tr>
                </tfoot>
              </table></div></center>


    
      </div>
    </div>



    <div class="container">
      <div class="wrapper col-12"><canvas id="chart-0" style="height:500px"></canvas></div>
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
                    maxRotation: 50,
                    minRotation: 50,
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
            text: 'Gráfico Prima Cobrada por Mes',
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