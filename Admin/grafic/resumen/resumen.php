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

  $mes = $_GET['mes'];
  $desde=$_GET['anio']."-".$_GET['mes']."-01";
  $hasta=$_GET['anio']."-".$_GET['mes']."-31";

  if ($mes==null) {
      $mesD=01;
      $mesH=12;
      $desde=$_GET['anio']."-".$mesD."-01";
      $hasta=$_GET['anio']."-".$mesH."-31";
  }


  $anio = $_GET['anio'];
  if ($anio==null) {
    $obj11= new Trabajo();
    $fechaMin = $obj11->get_fecha_min('f_hastapoliza','poliza'); 
    $desde=$fechaMin[0]['MIN(f_hastapoliza)'];
  
    $obj12= new Trabajo();
    $fechaMax = $obj12->get_fecha_max('f_hastapoliza','poliza'); 
    $hasta=$fechaMax[0]['MAX(f_hastapoliza)'];
  }


  $obj= new Trabajo();
  $cia = $obj->get_distinct_cia_comision($desde,$hasta,$tipo_cuenta); 
 

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

                <div class="col-md-auto col-md-offset-2">
                  <center>
                    <h1 class="title">Gráfico Resúmen</h1> 
                    <br/>
                    
                    <a href="../resumen.php" class="btn btn-info btn-lg btn-round">Menú de Gráficos</a></center>
                </div>
                <br>




                
                <center>
                <a  class="btn btn-success" onclick="tableToExcel('iddatatable1', 'Resumen')" data-toggle="tooltip" data-placement="right" title="Exportar a Excel"><img src="../../../assets/img/excel.png" width="60" alt=""></a>

                <table class="table table-hover table-striped table-bordered table-responsive" id="iddatatable1">
                  <thead style="background-color: #00bcd4;color: white; font-weight: bold;">
                    <tr>
                      <th>Cía</th>
                      <th>Prima Suscrita</th>
                      <th>Prima Cobrada</th>
                      <th>Prima Pendiente</th>
                      <th>Comision Cobrada</th>
                      <th>% Com</th>
                      <th>GC Pagada</th>
                      <th>%GC Prom Asesor</th>
                      <th>Utilidad</th>
                      <th>Cantidad</th>
                    </tr>
                  </thead>
                  
                  <tbody >
                    <?php
                    $totalPrimaSuscrita=0;
                    $totalPrimaCobrada=0;
                    $totalComisionCobrada=0;
                    $totalGCPagada=0;
                    $totalCant=0;
                    $totalPerGCA=0;
                    $totalCantPT=0;
                    for ($i=0; $i < sizeof($cia); $i++) { 

                      $obj6= new Trabajo();
                      $resumen = $obj6->get_resumen_comision($desde,$hasta,$cia[$i]['id_cia'],$tipo_cuenta);

                      

                      $obj12= new Trabajo();
                      $resumen_poliza = $obj12->get_resumen_por_cia_de_poliza($desde,$hasta,$cia[$i]['id_cia'],$tipo_cuenta); 

                      $prima_suscrita=0;
                      $per_gc_a=0;
                      $totalCantP=0;
                      for ($b=0; $b < sizeof($resumen_poliza); $b++) { 
                        $prima_suscrita=$prima_suscrita+$resumen_poliza[$b]['prima'];
                        $per_gc_a=$per_gc_a+$resumen_poliza[$b]['per_gc'];
                        $totalCantP=$totalCantP+1;
                        $totalCantPT=$totalCantPT+1;
                      }
                      
                      $totalPrimaSuscrita=$totalPrimaSuscrita+$prima_suscrita;
                      
                      $prima_cobrada=0;
                      $comision_cobrada=0;
                      $gc_pagada=0;
                      for ($a=0; $a < sizeof($resumen); $a++) { 

                        $prima_cobrada=$prima_cobrada+$resumen[$a]['prima_com'];
                        $comision_cobrada=$comision_cobrada+$resumen[$a]['comision'];
                        $gc_pagada=$gc_pagada+(($resumen[$a]['per_gc']*$resumen[$a]['comision'])/100);
                      }
                      $totalPrimaCobrada=$totalPrimaCobrada+$prima_cobrada;
                      $totalComisionCobrada=$totalComisionCobrada+$comision_cobrada;
                      $totalGCPagada=$totalGCPagada+$gc_pagada;
                      $totalCant=$totalCant+sizeof($resumen);
                      $totalPerGCA=$totalPerGCA+$per_gc_a;

                      if (is_nan($per_gc_a/sizeof($resumen_poliza))) {
                          //echo "0%";
                          $prom_gc='0%';
                      } else {
                          //echo number_format($per_gc_a/sizeof($resumen_poliza),2)."%";
                          $prom_gc=number_format($per_gc_a/sizeof($resumen_poliza),2)."%";
                      }
                      
                      
                      ?>
                        <tr>
                          <td><?= ($cia[$i]['nomcia']); ?></td>
                          <td align="right"><?= "$ ".number_format($prima_suscrita,2); ?></td>
                          <td align="right"><?= "$ ".number_format($prima_cobrada,2); ?></td>
                          <td align="right" style="background-color: #ED7D31;color:white"><?= "$ ".number_format($prima_suscrita-$prima_cobrada,2); ?></td>
                          <td align="right"><?= "$ ".number_format($comision_cobrada,2); ?></td>
                          <td align="center"><?= number_format(($comision_cobrada*100)/$prima_cobrada,2)."%"; ?></td>
                          <td align="right"><?= "$ ".number_format($gc_pagada,2); ?></td>
                          <td align="center"><?= $prom_gc;?></td>
                          <td align="right" style="background-color: #ED7D31;color:white"><?= "$ ".number_format($comision_cobrada-$gc_pagada,2); ?></td>
                          <td align="center"><?= $totalCantP; ?></td>
                      </tr>
                      <?php
                    }  
                    ?>
                    <tr style="background-color: #E54848;color:white">
                        <td >Total General</td>
                        <td align="right"><?= "$ ".number_format($totalPrimaSuscrita,2); ?></td>
                        <td align="right"><?= "$ ".number_format($totalPrimaCobrada,2); ?></td>
                        <td align="right"><?= "$ ".number_format($totalPrimaSuscrita-$totalPrimaCobrada,2); ?></td>
                        <td align="right"><?= "$ ".number_format($totalComisionCobrada,2); ?></td>
                        <td align="center"><?= number_format((($totalComisionCobrada*100)/$totalPrimaCobrada),2)."%"; ?></td>
                        <td align="right"><?= "$ ".number_format($totalGCPagada,2); ?></td>
                        <td align="center"><?= number_format($totalPerGCA/$totalCant,2)."%"; ?></td>
                        <td align="right"><?= "$ ".number_format($totalComisionCobrada-$totalGCPagada,2); ?></td>
                        <td align="right"><?= number_format($totalCantPT,0); ?></td>
                    </tr>
                  </tbody>

                  <tfoot>
                    <tr>
                      <th>Cía</th>
                      <th>Prima Suscrita</th>
                      <th>Prima Cobrada</th>
                      <th>Prima Pendiente</th>
                      <th>Comision Cobrada</th>
                      <th>% Com</th>
                      <th>GC Pagada</th>
                      <th>%GC Asesor</th>
                      <th>Utilidad</th>
                      <th>Cantidad</th>
                    </tr>
                  </tfoot>
                </table>
              </center>



        


    
    
    </div>





    
      


        <br><br><br><br>



        <?php require('footer_b.php');?>
    
    
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
    <!-- Fixed Sidebar Nav - js With initialisations For Demo Purpose, Don't Include it in your project -->
    <script src="../../../assets/assets-for-demo/js/material-kit-demo.js"></script>

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