<?php 
session_start();
if(isset($_SESSION['seudonimo'])) {

  }
    else {
        header("Location: login.php");
        exit();
      }
      
  require_once("../../../class/clases.php");

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
  $cia = $obj->get_distinct_cia_comision($desde,$hasta); 
 

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

   <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>

</head>

<body class="profile-page ">
    <nav class="navbar navbar-color-on-scroll navbar-transparent    fixed-top  navbar-expand-lg bg-info" color-on-scroll="100" id="sectionsNav">
        <div class="container">
            <div class="navbar-translate">
                <a class="navbar-brand" href="../../sesionadmin.php"> <img src="../../../assets/img/logo1.png" width="45%" /></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                    <span class="navbar-toggler-icon"></span>
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ml-auto">
                    <li class="dropdown nav-item">
                        <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                            <i class="material-icons">plus_one</i> Cargar Datos
                        </a>
                        <div class="dropdown-menu dropdown-with-icons">
                            <a href="../../add/crear_poliza.php" class="dropdown-item">
                                <i class="material-icons">add_to_photos</i> Póliza
                            </a>
                            <a href="../../add/crear_comision.php" class="dropdown-item">
                                <i class="material-icons">add_to_photos</i> Comisión
                            </a>
                            <a href="../../add/crear_asesor.php" class="dropdown-item">
                                <i class="material-icons">person_add</i> Asesor
                            </a>
                            <a href="../../add/crear_compania.php" class="dropdown-item">
                                <i class="material-icons">markunread_mailbox</i> Compañía
                            </a>
                        </div>
                    </li>

                    <li class="dropdown nav-item">
                        <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                            <i class="material-icons">search</i> Buscar
                        </a>
                        <div class="dropdown-menu dropdown-with-icons">
                            <a href="../../b_asesor.php" class="dropdown-item">
                                <i class="material-icons">accessibility</i> Asesor
                            </a>
                            <a href="../../b_cliente.php" class="dropdown-item">
                                <i class="material-icons">accessibility</i> Cliente
                            </a>
                            <a href="../../b_poliza.php" class="dropdown-item">
                                <i class="material-icons">content_paste</i> Póliza
                            </a>
                            <a href="../../b_vehiculo.php" class="dropdown-item">
                                <i class="material-icons">commute</i> Vehículo
                            </a>
                            <a href="../../b_comp.php" class="dropdown-item">
                                <i class="material-icons">markunread_mailbox</i> Compañía
                            </a>
                            <a href="../../b_reportes.php" class="dropdown-item">
                                <i class="material-icons">library_books</i> Reportes de Cobranza
                            </a>
                        </div>
                    </li>

                    <li class="dropdown nav-item">
                        <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                            <i class="material-icons">trending_up</i> Gráficos
                        </a>
                        <div class="dropdown-menu dropdown-with-icons">
                            <a href="../porcentaje.php" class="dropdown-item">
                                <i class="material-icons">pie_chart</i> Porcentajes
                            </a>
                            <a href="../primas_s.php" class="dropdown-item">
                                <i class="material-icons">bar_chart</i> Primas Suscritas
                            </a>
                            <a href="../primas_c.php" class="dropdown-item">
                                <i class="material-icons">thumb_up</i> Primas Cobradas
                            </a>
                            <a href="../comisiones_c.php" class="dropdown-item">
                                <i class="material-icons">timeline</i> Comisiones Cobradas
                            </a>
                            <a href="" class="dropdown-item">
                                <i class="material-icons">show_chart</i> Gestión de Cobranza
                            </a>
                        </div>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="../../../sys/cerrar_sesion.php" onclick="scrollToDownload()">
                            <i class="material-icons">eject</i> Cerrar Sesión
                        </a>
                    </li>
                   
                </ul>
            </div>
        </div>
    </nav>




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

                <div class="col-md-auto col-md-offset-2">
                  <center>
                    <h1 class="title">Gráfico Resúmen</h1> 
                    <br/>
                    
                    <a href="../porcentaje.php" class="btn btn-danger btn-lg btn-round">Gráficos de Porcentaje</a></center>
                    <a href="javascript:history.back(-1);" data-tooltip="tooltip" data-placement="right" title="Ir la página anterior" class="btn btn-info btn-round"><- Regresar</a>
                </div>
                <br>




                
                <center>
                <a  class="btn btn-success" onclick="tableToExcel('iddatatable1', 'Pólizas a Renovar por Asesor')" data-toggle="tooltip" data-placement="right" title="Exportar a Excel"><img src="../../../assets/img/excel.png" width="60" alt=""></a>

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
                    $totalCantP=0;
                    $cant=0;
                    for ($i=0; $i < sizeof($cia); $i++) { 

                      $obj6= new Trabajo();
                      $resumen = $obj6->get_resumen_comision($desde,$hasta,$cia[$i]['id_cia']);

                      

                      $obj12= new Trabajo();
                      $resumen_poliza = $obj12->get_resumen_por_cia_de_poliza($desde,$hasta,$cia[$i]['id_cia']); 

                      $prima_suscrita=0;
                      $per_gc_a=0;
                      for ($b=0; $b < sizeof($resumen_poliza); $b++) { 
                        $prima_suscrita=$prima_suscrita+$resumen_poliza[$b]['prima'];
                        $per_gc_a=$per_gc_a+$resumen_poliza[$b]['per_gc'];
                        $totalCantP=$totalCantP+1;
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


                      
                      
                      ?>
                        <tr>
                          <td><?php echo utf8_encode($cia[$i]['nomcia']); ?></td>
                          <td align="right"><?php echo number_format($prima_suscrita,2); ?></td>
                          <td align="right"><?php echo number_format($prima_cobrada,2); ?></td>
                          <td align="right" style="background-color: #E54848;color:white"><?php echo number_format($prima_suscrita-$prima_cobrada,2); ?></td>
                          <td align="right"><?php echo number_format($comision_cobrada,2); ?></td>
                          <td align="center"><?php echo number_format(($comision_cobrada*100)/$prima_cobrada,2)."%"; ?></td>
                          <td align="right"><?php echo number_format($gc_pagada,2); ?></td>
                          <td align="center"><?php if (is_nan($per_gc_a/sizeof($resumen_poliza))) {
                                                        echo "0%";
                                                    } else {
                                                        echo number_format($per_gc_a/sizeof($resumen_poliza),2)."%";
                                                    }
                          ?></td>
                          <td align="right" style="background-color: #E54848;color:white"><?php echo number_format($comision_cobrada-$gc_pagada,2); ?></td>
                          <td align="center"><?php echo sizeof($resumen); ?></td>
                      </tr>
                      <?php
                    }  
                    ?>
                    <tr style="background-color: #E54848;color:white">
                        <td >Total General</td>
                        <td align="right"><?php echo number_format($totalPrimaSuscrita,2); ?></td>
                        <td align="right"><?php echo number_format($totalPrimaCobrada,2); ?></td>
                        <td align="right"><?php echo number_format($totalPrimaSuscrita-$totalPrimaCobrada,2); ?></td>
                        <td align="right"><?php echo number_format($totalComisionCobrada,2); ?></td>
                        <td align="center"><?php echo number_format((($totalComisionCobrada*100)/$totalPrimaCobrada),2)."%"; ?></td>
                        <td align="right"><?php echo number_format($totalGCPagada,2); ?></td>
                        <td align="center"><?php echo number_format($totalPerGCA/$totalCant,2)."%"; ?></td>
                        <td align="right"><?php echo number_format($totalComisionCobrada-$totalGCPagada,2); ?></td>
                        <td align="right"><?php echo number_format($totalCant,0); ?></td>
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



        <div class="section" style="background-color: #40A8CB;">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 ml-auto mr-auto">
                        <div class="card card-signup">
                            <form class="form" method="" action="">
                                <div class="card-header card-header-info text-center">
                                    <h3>¿Necesitas cotizar tu póliza de seguros?</h3>
                                </div>
                                <div class="card-body">
                                    <center><a href="" class="btn btn-lg btn-info">Cotizar</a></center>
                                </div>
                                
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
    
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