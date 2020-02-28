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


  $obj1= new Trabajo();
  $mes = $obj1->get_mes_prima_BN(); 

  $mesArray = array('Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre');


  $cantArray[sizeof($mes)]=null;
  $primaPorMes[sizeof($mes)]=null;
  $primaCobradaPorMes1=0;
  $primaCobradaPorMes2=0;

//----------------------------------------------------------------------------
$obj11= new Trabajo();
$user = $obj11->get_element_by_id('usuarios','seudonimo',$_SESSION['seudonimo']); 

$asesor_u = $user[0]['cod_vend'];
$permiso = $user[0]['id_permiso'];
//---------------------------------------------------------------------------

if ($permiso!=3) { 

  $obj12= new Trabajo();
  $ramo = $obj12->get_distinct_ramo_prima_c_comp($_GET['anio'],$_GET['mes'],$cia,$tipo_cuenta); 

  $totalPArray[sizeof($ramo)]=null;
  $ramoArray[sizeof($ramo)]=null;


  $sumasegurada[sizeof($ramo)]=null;
  $p1[sizeof($ramo)]=null;
  $p2[sizeof($ramo)]=null;
  $totalP[sizeof($ramo)]=null;
  $cantidad[sizeof($ramo)]=null;
  $cantidadOld[sizeof($ramo)]=null;

      for ($i=0; $i < sizeof($ramo); $i++) { 
          
        $obj2= new Trabajo();
        $primaMes = $obj2->get_poliza_c_cobrada_ramo_comp($ramo[$i]['nramo'],$cia,$_GET['anio'],$_GET['mes'],$tipo_cuenta); 

        $obj22= new Trabajo();
        $cantidadPolizaR = $obj22->get_count_poliza_c_cobrada_ramo_comp($ramo[$i]['nramo'],$cia,$_GET['anio'],$_GET['mes'],$tipo_cuenta); 

        $obj28= new Trabajo();
        $primaMesOld = $obj28->get_poliza_c_cobrada_ramo_comp($ramo[$i]['nramo'],$cia,intval($_GET['anio']-1),$_GET['mes'],$tipo_cuenta); 

        $obj228= new Trabajo();
        $cantidadPolizaROld = $obj228->get_count_poliza_c_cobrada_ramo_comp($ramo[$i]['nramo'],$cia,intval($_GET['anio']-1),$_GET['mes'],$tipo_cuenta); 

        //$cantidadPolizaR[0]['count(DISTINCT comision.id_poliza)'];
        

        $sumasegurada=0;
        $prima_pagada1=0;
        $prima_pagada2=0;

        $cantP=0;
        
        for($a=0;$a<sizeof($primaMes);$a++)
          { 
            $sumasegurada=$sumasegurada+$primaMes[$a]['prima'];
          
            $prima_pagada2=$prima_pagada2+$primaMes[$a]['prima_com'];
            $cantP=$cantP+1;
            
          } 

        for($a=0;$a<sizeof($primaMesOld);$a++)
          { 
            $sumasegurada=$sumasegurada+$primaMesOld[$a]['prima'];
          
            $prima_pagada1=$prima_pagada1+$primaMesOld[$a]['prima_com'];
            $cantP=$cantP+1;
            
          } 
          
          
          $totalCant=$totalCant+$cantidadPolizaR[0]['count(DISTINCT comision.id_poliza)'];
          $totalCantOld=$totalCantOld+$cantidadPolizaROld[0]['count(DISTINCT comision.id_poliza)'];
          $primaCobradaPorMes1=$primaCobradaPorMes1+$prima_pagada1;
          $primaCobradaPorMes2=$primaCobradaPorMes2+$prima_pagada2;

          $p1[$i]=$prima_pagada1;
          $p2[$i]=$prima_pagada2;
          $cantidad[$i]=$cantidadPolizaR[0]['count(DISTINCT comision.id_poliza)'];
          $cantidadOld[$i]=$cantidadPolizaROld[0]['count(DISTINCT comision.id_poliza)'];
          $ramoArray[$i]=$ramo[$i]['nramo'];

          $totalP[$i]=$prima_pagada1+$prima_pagada2;

          $totalPC=$totalPC+$totalP[$i];
    
          $totalPArray[$i]=$totalP[$i];
      }
} 
if ($permiso==3) { 
  $obj12= new Trabajo();
  $ramo = $obj12->get_distinct_ramo_prima_c_by_user_comp($_GET['anio'],$_GET['mes'],$cia,$tipo_cuenta,$asesor_u); 

  $totalPArray[sizeof($ramo)]=null;
  $ramoArray[sizeof($ramo)]=null;


  $sumasegurada[sizeof($ramo)]=null;
  $p1[sizeof($ramo)]=null;
  $p2[sizeof($ramo)]=null;
  $totalP[sizeof($ramo)]=null;
  $cantidad[sizeof($ramo)]=null;
  $cantidadOld[sizeof($ramo)]=null;

      for ($i=0; $i < sizeof($ramo); $i++) { 
          
        $obj2= new Trabajo();
        $primaMes = $obj2->get_poliza_c_cobrada_ramo_by_user_comp($ramo[$i]['nramo'],$cia,$_GET['anio'],$_GET['mes'],$tipo_cuenta,$asesor_u); 

        $obj22= new Trabajo();
        $cantidadPolizaR = $obj22->get_count_poliza_c_cobrada_ramo_by_user_comp($ramo[$i]['nramo'],$cia,$_GET['anio'],$_GET['mes'],$tipo_cuenta,$asesor_u); 

        $cantidadPolizaR[0]['count(DISTINCT comision.id_poliza)'];

        $obj28= new Trabajo();
        $primaMesOld = $obj28->get_poliza_c_cobrada_ramo_comp($ramo[$i]['nramo'],$cia,intval($_GET['anio']-1),$_GET['mes'],$tipo_cuenta); 

        $obj228= new Trabajo();
        $cantidadPolizaROld = $obj228->get_count_poliza_c_cobrada_ramo_comp($ramo[$i]['nramo'],$cia,intval($_GET['anio']-1),$_GET['mes'],$tipo_cuenta); 
        

        $sumasegurada=0;
        $prima_pagada1=0;
        $prima_pagada2=0;

        $cantP=0;
        
        for($a=0;$a<sizeof($primaMes);$a++)
          { 
            $sumasegurada=$sumasegurada+$primaMes[$a]['prima'];
          
            
            $prima_pagada1=$prima_pagada1+$primaMes[$a]['prima_com'];
            $cantP=$cantP+1;
            
            $prima_pagada2=$prima_pagada2+$primaMes[$a]['prima_com'];
            $cantP=$cantP+1;
            
          } 
          
          
          $totalCant=$totalCant+$cantidadPolizaR[0]['count(DISTINCT comision.id_poliza)'];
          $totalCantOld=$totalCantOld+$cantidadPolizaROld[0]['count(DISTINCT comision.id_poliza)'];
          $primaCobradaPorMes1=$primaCobradaPorMes1+$prima_pagada1;
          $primaCobradaPorMes2=$primaCobradaPorMes2+$prima_pagada2;

          $p1[$i]=$prima_pagada1;
          $p2[$i]=$prima_pagada2;
          $cantidad[$i]=$cantidadPolizaR[0]['count(DISTINCT comision.id_poliza)'];
          $cantidadOld[$i]=$cantidadPolizaROld[0]['count(DISTINCT comision.id_poliza)'];
          $ramoArray[$i]=$ramo[$i]['nramo'];

          $totalP[$i]=$prima_pagada1+$prima_pagada2;

          $totalPC=$totalPC+$totalP[$i];
    
          $totalPArray[$i]=$totalP[$i];
      }    
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
        <div class="container">
          <a href="javascript:history.back(-1);" data-tooltip="tooltip" data-placement="right" title="Ir la página anterior" class="btn btn-info btn-round"><- Regresar</a>

              <div class="col-md-auto col-md-offset-2" style="text-align:center">
                  <h1 class="title">Comparativo de Primas Cobradas por Ramo</h1> 
                  <h2>Año: <?= $_GET['anio'];?> Mes: <?= $mesArray[$_GET['mes']-1];?></h2>
                  <br>
                  
                  <a href="../comparativo.php" class="btn btn-info btn-lg btn-round">Menú de Gráficos</a>
                  <br>
                  <a  class="btn btn-success" onclick="tableToExcel('Exportar_a_Excel', 'Primas Cobradas por Mes (Bola de Nieve)')" data-toggle="tooltip" data-placement="right" title="Exportar a Excel"><img src="../../../assets/img/excel.png" width="40" alt=""></a>
              </div>
              <br>


              <center>
              <div class="table-responsive">
              <table class="table table-hover table-striped table-bordered" id="Exportar_a_Excel" >
                <thead style="background-color: #00bcd4;color: white; font-weight: bold;">
                  <tr>
                    <th>Ramo</th>
                    <th><?= $mesArray[$_GET['mes']-1].' - '.intval($_GET['anio']-1);?></th>
                    <th>Cantidad</th>
                    <th style="background-color: #28a745;"><?= $mesArray[$_GET['mes']-1].' - '.$_GET['anio'];?></th>
                    <th style="background-color: #28a745;">Cantidad</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    
                    for ($i=sizeof($ramo); $i > 0; $i--) { 
                    //for ($i=0; $i < sizeof($ramo); $i++) { 

                      
                  ?>
                  <tr>
                    <th scope="row"><?= utf8_encode($ramoArray[$x[$i]]); ?></th>
                    <td align="right"><?= "$".number_format($p1[$x[$i]],2); ?></td>
                    <td align="right"><?= $cantidadOld[$x[$i]]; ?></td>
                    <td align="right"><?= "$".number_format($p2[$x[$i]],2); ?></td>
                    <td align="right"><?= $cantidad[$x[$i]]; ?></td>
                  </tr>
                  <?php
                      }
                  ?>
                </tbody>
                <tfoot>
                  <tr>
                    <th>TOTAL</th>
                    <th style="text-align: right;"><?= "$".number_format($primaCobradaPorMes1,2); ?></th>
                    <th style="text-align: right;"><?= $totalCantOld; ?></th>
                    <th style="text-align: right;"><?= "$".number_format($primaCobradaPorMes2,2); ?></th>
                    <th style="text-align: right;"><?= $totalCant; ?></th>
                  </tr>
                </tfoot>
              </table>
            </div>
          </center>


    
      </div>
    </div>



    <div class="container">
      <div class="wrapper col-12"><canvas id="myChart" ></canvas></div>
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
    <!-- Fixed Sidebar Nav - js With initialisations For Demo Purpose, Dont Include it in your project -->
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
      type:'horizontalBar', // bar, horizontalBar, pie, line, doughnut, radar, polarArea
      data:{
        labels:[<?php for ($i = sizeof($ramo); $i > 0; $i--) { ?> '<?= utf8_encode($ramoArray[$x[$i]]).' ('.intval($_GET['anio']-1).')'; ?>',
            '<?= ' ('.$_GET['anio'].')'; ?>',

          <?php } ?>],

        datasets:[{

          data:[<?php for ($i = sizeof($ramo); $i > 0; $i--) {
                    ?> '<?= $p1[$x[$i]]; ?>',
                        '<?= $p2[$x[$i]]; ?>',
            <?php } ?>
          ],
          //backgroundColor:'green',
          backgroundColor:[
            '#17a2b8',
            '#28a745',
            '#17a2b8',
            '#28a745',
            '#17a2b8',
            '#28a745',
            '#17a2b8',
            '#28a745',
            '#17a2b8',
            '#28a745',
            '#17a2b8',
            '#28a745',
            '#17a2b8',
            '#28a745',
            '#17a2b8',
            '#28a745',
            '#17a2b8',
            '#28a745',
            '#17a2b8',
            '#28a745',
            '#17a2b8',
            '#28a745',
            '#17a2b8',
            '#28a745',
            '#17a2b8',
            '#28a745',
            '#17a2b8',
            '#28a745',
            '#17a2b8',
            '#28a745',
            '#17a2b8',
            '#28a745',
            '#17a2b8',
            '#28a745',
            '#17a2b8',
            '#28a745',
            '#17a2b8',
            '#28a745'
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
          text:'Grafico Comparativo de Prima Cobrada por Ramo',
          fontSize:25
        },
        legend:{
          display:false,
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