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
  $cia = $obj->get_distinct_cia_comision2($desde,$hasta,$tipo_cuenta); 


  

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
                    <h1 class="title">Gráfico Resúmen por Ramo</h1> 
                    <br/>
                    
                    <a href="../porcentaje.php" class="btn btn-info btn-lg btn-round">Menú de Gráficos</a></center>
                </div>
                <br>




                
                <center>
                  <a  class="btn btn-success" onclick="tableToExcel('iddatatable1', 'Gráfico Resúmen por Ramo')" data-toggle="tooltip" data-placement="right" title="Exportar a Excel"><img src="../../../assets/img/excel.png" width="60" alt=""></a>

                <table class="table table-hover table-striped table-bordered table-responsive" id="iddatatable1">
                  <thead style="background-color: #00bcd4;color: white; font-weight: bold;">
                    <tr>
                      <th>Cía</th>
                      <th>Ramo</th>
                      <th>Prima Suscrita</th>
                      <th>Prima Cobrada</th>
                      <th>Prima Pendiente</th>
                      <th>Comision Cobrada</th>
                      <th>GC Pagada</th>
                      <th>Utilidad</th>
                      <th>% Com</th>
                      <th>Cantidad</th>
                    </tr>
                  </thead>
                  
                  <tbody >
                    <?php
                    
                    $totalPrimaSuscritaT=0;
                    $totalPrimaCobradaT=0;
                    $totalComisionCobradaT=0;
                    $totalGCPagadaT=0;
                    $totalCantidadT=0;
                    for ($i=0; $i < sizeof($cia); $i++) { 

                      $obj11= new Trabajo();
                      $ramo = $obj11->get_distinct_element_ramo3($desde,$hasta,$cia[$i]['nomcia'],$tipo_cuenta); 

                        if (sizeof($ramo)==0) {
                            $cont=1;
                        } else {
                            $cont=sizeof($ramo);
                        }

                      ?>
                      <tr>
                        <td rowspan="<?php echo $cont; ?>" style="background-color: #D9D9D9"><?php echo utf8_encode($cia[$i]['nomcia']); ?></td>
                      
                      <?php

                        
                        
                      $totalPrimaSuscrita=0;
                      $totalPrimaCobrada=0;
                      $totalComisionCobrada=0;
                      $totalGCPagada=0;
                      $totalCantidad=0;
                      for ($a=0; $a < $cont; $a++) { 
                        
                        $obj11= new Trabajo();
                        $resumen = $obj11->get_resumen_por_ramo($desde,$hasta,$cia[$i]['nomcia'],$ramo[$a]['nramo']); 
                        $prima_suscrita=0;
                        $prima_cobrada=0;
                        $comision_cobrada=0;
                        $gc_pagada=0;
                        $per_gc=0;

                        $obj12= new Trabajo();
                        $resumen_cia_ramo = $obj12->get_resumen_de_cia_por_ramo($desde,$hasta,$cia[$i]['nomcia'],$ramo[$a]['nramo']); 

                        for ($c=0; $c < sizeof($resumen_cia_ramo); $c++) { 
                            $totalPrimaSuscrita=$totalPrimaSuscrita+$resumen_cia_ramo[$c]['prima'];
                            $totalPrimaSuscritaT=$totalPrimaSuscritaT+$resumen_cia_ramo[$c]['prima'];
                            $prima_suscrita=$prima_suscrita+$resumen_cia_ramo[$c]['prima'];
                        }

                          for ($b=0; $b < sizeof($resumen); $b++) { 
                  
                            $prima_cobrada=$prima_cobrada+$resumen[$b]['prima_com'];
                            $comision_cobrada=$comision_cobrada+$resumen[$b]['comision'];
                            $gc_pagada=$gc_pagada+(($resumen[$b]['per_gc']*$resumen[$b]['comision'])/100);

                            
                            $totalPrimaCobrada=$totalPrimaCobrada+$resumen[$b]['prima_com'];
                            $totalComisionCobrada=$totalComisionCobrada+$resumen[$b]['comision'];
                            $totalGCPagada=$totalGCPagada+(($resumen[$b]['per_gc']*$resumen[$b]['comision'])/100);
                            $totalCantidad=$totalCantidad+1;

                            
                            $totalPrimaCobradaT=$totalPrimaCobradaT+$resumen[$b]['prima_com'];
                            $totalComisionCobradaT=$totalComisionCobradaT+$resumen[$b]['comision'];
                            $totalGCPagadaT=$totalGCPagadaT+(($resumen[$b]['per_gc']*$resumen[$b]['comision'])/100);
                            $totalCantidadT=$totalCantidadT+1;

                            
                          }
                          
                          if ($prima_cobrada==0) {
                            $per_gc=0;
                          } else {
                            $per_gc=(($comision_cobrada*100)/$prima_cobrada);
                          }
                        
                   
                      
                      ?>
                          <td><?php echo utf8_encode($ramo[$a]['nramo']); ?></td>
                          <td align="right"><?php echo "$ ".number_format($prima_suscrita,2); ?></td>
                          <td align="right"><?php echo "$ ".number_format($prima_cobrada,2); ?></td>
                          <td align="right" style="background-color: #E54848;color:white"><?php echo "$ ".number_format($prima_suscrita-$prima_cobrada,2); ?></td>
                          <td align="right"><?php echo "$ ".number_format($comision_cobrada,2); ?></td>
                          <td align="right"><?php echo "$ ".number_format($gc_pagada,2); ?></td>
                          <td align="right" style="background-color: #E54848;color:white"><?php echo "$ ".number_format($comision_cobrada-$gc_pagada,2); ?></td>
                          <td align="center"><?php echo number_format($per_gc,2)."%"; ?></td>
                          <td align="center"><?php echo sizeof($resumen); ?></td>
                      </tr>
                      <?php
                        }
                        ?>
                      <tr style="background-color: #FF7E7E;color: white;font-weight: bold;">
                        <td colspan="2">Total <?php echo utf8_encode($cia[$i]['nomcia']); ?></td>
                        <td align="right"><?php echo "$ ".number_format($totalPrimaSuscrita,2); ?></td>
                        <td align="right"><?php echo "$ ".number_format($totalPrimaCobrada,2); ?></td>
                        <td align="right"><?php echo "$ ".number_format(($totalPrimaSuscrita-$totalPrimaCobrada),2); ?></td>
                        <td align="right"><?php echo "$ ".number_format($totalComisionCobrada,2); ?></td>
                        <td align="right"><?php echo "$ ".number_format($totalGCPagada,2); ?></td>
                        <td align="right"><?php echo "$ ".number_format($totalComisionCobrada-$totalGCPagada,2); ?></td>
                        <td align="center"><?php if ($totalPrimaCobrada==0) {
                                                      $por_gcTotal=0;
                                                    } else {
                                                      $por_gcTotal=($totalComisionCobrada*100)/$totalPrimaCobrada;
                                                    }
                        echo number_format($por_gcTotal,2)."%"; ?></td>
                        <td align="center"><?php echo $totalCantidad; ?></td>
                      </tr>
                    <?php
                      

                    }
                    ?>
                    <tr style="background-color: #E54848;color:white">
                        <td colspan="2">Total General</td>
                        <td align="right"><?php echo "$ ".number_format($totalPrimaSuscritaT,2); ?></td>
                        <td align="right"><?php echo "$ ".number_format($totalPrimaCobradaT,2); ?></td>
                        <td align="right"><?php echo "$ ".number_format(($totalPrimaSuscritaT-$totalPrimaCobradaT),2); ?></td>
                        <td align="right"><?php echo "$ ".number_format($totalComisionCobradaT,2); ?></td>
                        <td align="right"><?php echo "$ ".number_format($totalGCPagadaT,2); ?></td>
                        <td align="right"><?php echo "$ ".number_format($totalComisionCobradaT-$totalGCPagadaT,2); ?></td>
                        <td align="center"><?php echo number_format(($totalComisionCobradaT*100)/$totalPrimaCobradaT,2)."%"; ?></td>
                        <td align="right"><?php echo number_format($totalCantidadT,0); ?></td>
                    </tr>
                  </tbody>

                  <tfoot>
                    <tr>
                      <th>Cía</th>
                      <th>Ramo</th>
                      <th>Prima Suscrita</th>
                      <th>Prima Cobrada</th>
                      <th>Prima Pendiente</th>
                      <th>Comision Cobrada</th>
                      <th>GC Pagada</th>
                      <th>Utilidad</th>
                      <th>% Com</th>
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