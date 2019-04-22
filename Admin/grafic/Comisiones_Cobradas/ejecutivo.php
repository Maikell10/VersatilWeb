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


  $obj1= new Trabajo();
  $ejecutivo = $obj1->get_distinct_element_ejecutivo($desde,$hasta,$_GET['cia'],$_GET['ramo']); 

  $totals=0;
  $totalpc=0;
  $totalcc=0;
  $totalgcp=0;
  $totalCant=0;
  $totalcantt=0;

  $ejecutivoArray[sizeof($ejecutivo)]=null;
  $sumatotalEjecutivo[sizeof($ejecutivo)]=null;
  $sumatotalEjecutivoPC[sizeof($ejecutivo)]=null;
  $sumatotalEjecutivoCC[sizeof($ejecutivo)]=null;
  $cantArray[sizeof($ejecutivo)]=null;

  $totalPrimaSuscrita=0;
  $totalPrimaCobrada=0;
  $totalComisionCobrada=0;
  $totalGCPagada=0;
  $totalCant=0;
  for($i=0;$i<sizeof($ejecutivo);$i++)
    {  

      $obj2= new Trabajo();
      $ejecutivoPoliza = $obj2->get_poliza_graf_prima_6($ejecutivo[$i]['cod_vend'],$_GET['ramo'],$desde,$hasta,$_GET['cia']); 
      $nombre=$ejecutivoPoliza[0]['idnom'];
      

      if (sizeof($ejecutivoPoliza)==null) {
        $obj2= new Trabajo();
        $ejecutivoPoliza = $obj2->get_poliza_graf_prima_6_p($ejecutivo[$i]['cod_vend'],$_GET['ramo'],$desde,$hasta,$_GET['cia']); 
        $nombre=$ejecutivoPoliza[0]['nombre'];
      }

      if (sizeof($ejecutivoPoliza)==null) {
        $obj2= new Trabajo();
        $ejecutivoPoliza = $obj2->get_poliza_graf_prima_6_r($ejecutivo[$i]['cod_vend'],$_GET['ramo'],$desde,$hasta,$_GET['cia']); 
        $nombre=$ejecutivoPoliza[0]['nombre'];
      }


      $obj11= new Trabajo();
            $resumen = $obj11->get_resumen_por_asesor($desde,$hasta,$ejecutivo[$i]['cod_vend']);
              
            
            $prima_cobrada=0;
            $comision_cobrada=0;
            $gc_pagada=0;
            for ($a=0; $a < sizeof($resumen); $a++) { 
              $prima_cobrada=$prima_cobrada+$resumen[$a]['prima_com'];
              $comision_cobrada=$comision_cobrada+$resumen[$a]['comision'];

              
              $gc_pagada=$gc_pagada+(($resumen[$a]['per_gc']*$resumen[$a]['comision'])/100);
            }
            //$totalPrimaCobrada=$totalPrimaCobrada+$prima_cobrada;
            $totalComisionCobrada=$totalComisionCobrada+$comision_cobrada;
            $totalGCPagada=$totalGCPagada+$gc_pagada;
            $totalCant=$totalCant+sizeof($resumen);

            if ($prima_cobrada==0) {
            $per_gc=0;
            } else {
            $per_gc=(($comision_cobrada*100)/$prima_cobrada);
            }


      $cantArray[$i]=sizeof($ejecutivoPoliza);
      $sumasegurada=0;
      $obj111= new Trabajo();
      $resumen_poliza = $obj111->get_resumen_por_asesor_en_poliza($desde,$hasta,$ejecutivo[$i]['cod_vend']);
      for($a=0;$a<sizeof($resumen_poliza);$a++)
        { 
          $sumasegurada=$sumasegurada+$resumen_poliza[$a]['prima'];

        } 
        $totals=$totals+$sumasegurada;
        $totalpc=$totalpc+$prima_cobrada;
        $totalcc=$totalcc+$comision_cobrada;
        $totalgcp=$totalgcp+$gc_pagada;
        $totalcantt=$totalcantt+sizeof($resumen);
        $totalCant=$totalCant+$cantArray[$i];
        $sumatotalEjecutivo[$i]=$sumasegurada;
        $sumatotalEjecutivoPC[$i]=$prima_cobrada;
        $sumatotalEjecutivoCC[$i]=$comision_cobrada;
        $sumatotalEjecutivoGCP[$i]=$gc_pagada;
        $ejecutivoArray[$i]=$nombre;
    }


asort($sumatotalEjecutivo , SORT_NUMERIC);


$x = array();
foreach($sumatotalEjecutivo as $key=>$value) {

   $x[count($x)] = $key;

}


  //isset($_POST["ramo"]);
  //onchange = "this.form.submit()"


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
                        <a class="nav-link" href="../../../sys/cerrar_sesion.php" >
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
            <a href="javascript:history.back(-1);" data-tooltip="tooltip" data-placement="right" title="Ir la página anterior" class="btn btn-info btn-round"><- Regresar</a>

                <div class="col-md-auto col-md-offset-2">
                  <center>
                    <h1 class="title">Comisiones Cobradas por Ejecutivo</h1> 
                    <br/>
                    
                    <a href="../primas_s.php" class="btn btn-danger btn-lg btn-round">Gráficos de Primas Suscritas</a></center>
                    <center><a  class="btn btn-success" onclick="tableToExcel('Exportar_a_Excel', 'Pólizas a Renovar por Asesor')" data-toggle="tooltip" data-placement="right" title="Exportar a Excel"><img src="../../../assets/img/excel.png" width="40" alt=""></a></center>
                </div>
                <br>



    <table class="table table-hover table-striped table-bordered display table-responsive nowrap" id="Exportar_a_Excel">
       <thead style="background-color: #00bcd4;color: white; font-weight: bold;">
        <tr>
          <th scope="col">Ejecutivo Cuenta</th>
          <th scope="col">Prima Suscrita</th>
          <th scope="col">Prima Cobrada</th>
          <th scope="col">Prima Pendiente</th>
          <th scope="col">Comisión Cobrada</th>
          <th scope="col">% Com</th>
          <th scope="col">GC Pagada</th>
          <th scope="col">Utilidad</th>
          <th scope="col">Cantidad</th>
        </tr>
      </thead>
      <tbody>
        <?php
          
          
          for ($i=sizeof($ejecutivo); $i > 0; $i--) {  

            if ($sumatotalEjecutivoPC[$x[$i]]==0) {
                $per_gc=0;
            } else {
                $per_gc=(($sumatotalEjecutivoCC[$x[$i]]*100)/$sumatotalEjecutivoPC[$x[$i]]);
            }

        ?>
        <tr>
          <th scope="row"><?php echo utf8_encode($ejecutivoArray[$x[$i]]); ?>
          </th>
          <td align="right"><?php echo "$".number_format($sumatotalEjecutivo[$x[$i]],2); ?></td>
          <td align="right"><?php echo "$".number_format($sumatotalEjecutivoPC[$x[$i]],2); ?></td>
          <td align="right" style="background-color:red;color:white"><?php echo "$".number_format($sumatotalEjecutivo[$x[$i]]-$sumatotalEjecutivoPC[$x[$i]],2); ?></td>
          <td align="right"><?php echo "$".number_format($sumatotalEjecutivoCC[$x[$i]],2); ?></td>
          <td nowrap><?php echo number_format($per_gc,2)." %"; ?></td>
          <td align="right"><?php echo number_format($sumatotalEjecutivoGCP[$x[$i]],2); ?></td>
          <td align="right" style="background-color:red;color:white"><?php echo number_format($sumatotalEjecutivoCC[$x[$i]]-$sumatotalEjecutivoGCP[$x[$i]],2); ?></td>
          <td><?php echo $cantArray[$x[$i]]; ?></td>
        </tr>
        <?php
            }
        ?>
      </tbody>
      <thead class="thead-inverse">
        <tr>
          <th scope="col">TOTAL</th>
          <th align="right"><?php echo "$".number_format($totals,2); ?></th>
          <th align="right"><?php echo "$".number_format($totalpc,2); ?></th>
          <th align="right"><?php echo "$".number_format($totals-$totalpc,2); ?></th>
          <th align="right"><?php echo "$".number_format($totalcc,2); ?></th>
          <th align="right"><?php echo "$".number_format(($totalcc*100)/$totalpc,2); ?></th>

          <th align="right"><?php echo "$".number_format($totalgcp,2); ?></th>
          <th align="right"><?php echo "$".number_format($totalcc-$totalgcp,2); ?></th>

          <th scope="col"><?php echo $totalcantt; ?></th>
        </tr>
      </thead>
    </table>
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