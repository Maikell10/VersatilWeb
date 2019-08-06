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


  $obj1= new Trabajo();
  $mes = $obj1->get_mes_prima_BN(); 



  $totals=0;
  $totalCant=0;

  $mesArray = array('Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre');




  $tipoPArray[sizeof($mes)]=null;
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
  $tipo_poliza = $obj12->get_distinct_tipo_poliza_prima_c($_GET['anio'],$ramo,$cia,$tipo_cuenta); 

  $totalPArray[sizeof($tipo_poliza)]=null;
  $totalPC=0;

  $sumasegurada[sizeof($tipo_poliza)]=null;
  $p1[sizeof($tipo_poliza)]=null;
  $p2[sizeof($tipo_poliza)]=null;
  $p3[sizeof($tipo_poliza)]=null;
  $p4[sizeof($tipo_poliza)]=null;
  $p5[sizeof($tipo_poliza)]=null;
  $p6[sizeof($tipo_poliza)]=null;
  $p7[sizeof($tipo_poliza)]=null;
  $p8[sizeof($tipo_poliza)]=null;
  $p9[sizeof($tipo_poliza)]=null;
  $p10[sizeof($tipo_poliza)]=null;
  $p11[sizeof($tipo_poliza)]=null;
  $p12[sizeof($tipo_poliza)]=null;
  $totalP[sizeof($tipo_poliza)]=null;
  $cantidad[sizeof($tipo_poliza)]=null;

  for ($i=0; $i < sizeof($tipo_poliza); $i++) { 

                        
    $obj2= new Trabajo();
    $primaMes = $obj2->get_poliza_c_cobrada_tipo_poliza($tipo_poliza[$i]['tipo_poliza'],$cia,$ramo,$_GET['anio'],$tipo_cuenta); 


    $obj22= new Trabajo();
    $cantidadPolizaR = $obj22->get_count_poliza_c_cobrada_tpoliza($ramo,$cia,$_GET['anio'],$tipo_cuenta,$tipo_poliza[$i]['tipo_poliza']); 

    $cantidadPolizaR[0]['count(DISTINCT comision.id_poliza)'];

  

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
    
    $totalCant=$totalCant+$cantidadPolizaR[0]['count(DISTINCT comision.id_poliza)'];
    $tipoPArray[$i]=$tipo_poliza[$i]['tipo_poliza'];
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
    $cantidad[$i]=$cantidadPolizaR[0]['count(DISTINCT comision.id_poliza)'];

    $totalP[$i]=$prima_pagada1+$prima_pagada2+$prima_pagada3+$prima_pagada4+$prima_pagada5+$prima_pagada6+$prima_pagada7+$prima_pagada8+$prima_pagada9+$prima_pagada10+$prima_pagada11+$prima_pagada12;

    $totalPC=$totalPC+$totalP[$i];

    $totalPArray[$i]=$totalP[$i];

  }

  asort($totalP , SORT_NUMERIC);


  $x = array();
  foreach($totalP as $key=>$value) {
  
      $x[count($x)] = $key;
  
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
                  <h1 class="title">Primas Cobradas por Tipo de Póliza</h1> 
                  <h2>Año: <?php echo $_GET['anio'];?></h2>
                  <br>
                  
                  <a href="../primas_c.php" class="btn btn-info btn-lg btn-round">Menú de Gráficos</a>
                  <br>
                  <a  class="btn btn-success" onclick="tableToExcel('Exportar_a_Excel', 'Primas Cobradas por Tipo de Póliza')" data-toggle="tooltip" data-placement="right" title="Exportar a Excel"><img src="../../../assets/img/excel.png" width="40" alt=""></a>
              </div>
              <br>


              <center>
              <div class="table-responsive1">
              <table class="table table-hover table-striped table-bordered" id="Exportar_a_Excel" style="font-size:14px; margin:0 auto;width: auto;">
                <thead style="background-color: #00bcd4;color: white; font-weight: bold;">
                  <tr>
                    <th>Tipo de Póliza</th>
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
                    
                    for ($i=sizeof($tipo_poliza); $i > 0; $i--) { 
                    //for ($i=0; $i < sizeof($tipo_poliza); $i++) { 

                  ?>
                  <tr>
                    <th scope="row"><?php echo utf8_encode($tipoPArray[$x[$i]]); ?></th>
                    <td align="right"><?php echo "$".number_format($p1[$x[$i]],2); ?></td>
                    <td align="right"><?php echo "$".number_format($p2[$x[$i]],2); ?></td>
                    <td align="right"><?php echo "$".number_format($p3[$x[$i]],2); ?></td>
                    <td align="right"><?php echo "$".number_format($p4[$x[$i]],2); ?></td>
                    <td align="right"><?php echo "$".number_format($p5[$x[$i]],2); ?></td>
                    <td align="right"><?php echo "$".number_format($p6[$x[$i]],2); ?></td>
                    <td align="right"><?php echo "$".number_format($p7[$x[$i]],2); ?></td>
                    <td align="right"><?php echo "$".number_format($p8[$x[$i]],2); ?></td>
                    <td align="right"><?php echo "$".number_format($p9[$x[$i]],2); ?></td>
                    <td align="right"><?php echo "$".number_format($p10[$x[$i]],2); ?></td>
                    <td align="right"><?php echo "$".number_format($p11[$x[$i]],2); ?></td>
                    <td align="right"><?php echo "$".number_format($p12[$x[$i]],2); ?></td>
                    <td align="right"><?php echo "$".number_format($totalP[$x[$i]],2); ?></td>
                    <td align="right"><?php echo $cantidad[$x[$i]]; ?></td>
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
      <div class="wrapper col-12"><canvas id="myChart"></canvas></div>
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
    let myChart = document.getElementById('myChart').getContext('2d');

    // Global Options
    Chart.defaults.global.defaultFontFamily = 'Lato';
    Chart.defaults.global.defaultFontSize = 18;
    Chart.defaults.global.defaultFontColor = '#777';

    let massPopChart = new Chart(myChart, {
      type:'pie', // bar, horizontalBar, pie, line, doughnut, radar, polarArea
      data:{
        labels:[<?php for($i=sizeof($tipo_poliza); $i > 0; $i--){ ?>
            '<?php echo utf8_encode($tipoPArray[$x[$i]]); ?>',

                <?php }?>],

        datasets:[{

          data:[<?php for($i=sizeof($tipo_poliza); $i > 0; $i--){ ?>
              '<?php echo $totalP[$x[$i]]; ?>',

                <?php }?>
          ],
          //backgroundColor:'green',
          backgroundColor:[
            'rgba(255, 99, 132, 0.6)',
            'rgba(53, 57, 235, 0.6)',
            'rgba(255, 206, 86, 0.6)',
            'rgba(75, 192, 192, 0.6)',
            'rgba(153, 102, 255, 0.6)',
            'rgba(255, 159, 64, 0.6)',
            'rgba(255, 99, 132, 0.6)',
            'red',
            'blue',
            'yellow'
          ],
          borderWidth:1,
          borderColor:'#777',
          hoverBorderWidth:3,
          hoverBorderColor:'#000'
        }]
      },
      options:{
        title:{
          display:true,
          text:'Primas Cobradas por Tipo de Poliza',
          fontSize:25
        },
        legend:{
          display:true,
          position:'right',
          labels:{
            fontColor:'#000'
          }
        },
        layout:{
          padding:{
            left:50,
            right:0,
            bottom:0,
            top:0
          }
        },
        tooltips:{
          enabled:true
        }
      }
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