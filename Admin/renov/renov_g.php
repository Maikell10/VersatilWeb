<?php 
session_start();
if(isset($_SESSION['seudonimo'])) {

  }
    else {
        header("Location: login.php");
        exit();
      }
      
  require_once("../../class/clases.php");

  $mes_arr=['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];

  $mes = $_GET['mes'];
  $desde=$_GET['anio']."-".$_GET['mes']."-01";
  $hasta=$_GET['anio']."-".$_GET['mes']."-31";

  $cont=1;

  if ($mes==null) {
      $cont=12;
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



  $cia = $_GET['cia'];
  $asesor = $_GET['asesor'];


  $obj1= new Trabajo();
  $distinct_c = $obj1->get_poliza_total_by_filtro_renov_distinct_ac($desde,$hasta,$cia,$asesor); 


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport" />
    <meta http-equiv="content-type" content="application/vnd.ms-excel; charset=UTF-8">
    <!-- Favicons -->
    <link rel="apple-touch-icon" href="../../assets/img/apple-icon.png">
    <link rel="icon" href="../../assets/img/logo1.png">
    <title>
        Versatil Seguros
    </title>
    <script src="../../tableToExcel.js"></script>
    
    <link rel="stylesheet" type="text/css" href="../../bootstrap-4.2.1/css/bootstrap.css">
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />
    <link rel="stylesheet" href="../../assets/css/material-kit.css?v=2.0.1">
    <!-- Documentation extras -->
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="../../assets/assets-for-demo/demo.css" rel="stylesheet" />
    <link href="../../assets/assets-for-demo/vertical-nav.css" rel="stylesheet" />

    
    <!-- Alertify -->
    <link rel="stylesheet" type="text/css" href="../../assets/alertify/css/alertify.css">
    <link rel="stylesheet" type="text/css" href="../../assets/alertify/css/themes/bootstrap.css">
    <script src="../../assets/alertify/alertify.js"></script>


    <!-- DataTables -->
    <link href="../../DataTables/DataTables/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="../../DataTables/DataTables/js/jquery.dataTables.min.js"></script>
    <script src="../../DataTables/DataTables/js/dataTables.bootstrap4.min.js"></script>



    <style type="text/css">
        #carga{
            height: 80vh
        }
    </style>

</head>

<body class="profile-page ">
    
    <?php require('navigation.php');?>




    <div class="page-header  header-filter " data-parallax="true" style="background-image: url('../../assets/img/logo2.png');">
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
                
                <div class="col-md-auto col-md-offset-2" id="tablaLoad1">
                    <h1 class="title">Resultado de Búsqueda General de Póliza a Renovar</h1>  
                    <h2>Año: <font style="font-weight:bold"><?php echo $_GET['anio']; 
                        if ($_GET['mes']==null) {
                        }else{
                    ?></font>
                        Mes: <font style="font-weight:bold"><?php echo $mes_arr[$_GET['mes']-1]; } ?></font></h2>
                    <?php
                        if ($cia=='Seleccione Cía') {
                        } else {
                    ?>
                    <h2>Cía: <font style="font-weight:bold"><?php echo $cia; ?></font>
                    <?php
                        }
                        if ($asesor=='Seleccione el Asesor') {
                        } else {
                    ?>
                    Asesor: <font style="font-weight:bold"><?php echo $asesor; ?></font></h2>
                    <?php
                        }
                    ?>
                </div>
                
                <center><a  class="btn btn-success" onclick="tableToExcel('Exportar_a_Excel', 'Pólizas a Renovar')" data-toggle="tooltip" data-placement="right" title="Exportar a Excel"><img src="../../assets/img/excel.png" width="60" alt=""></a></center>

                <div class="form-group">
                    <input type="text" class="form-control pull-right" style="width:20%" id="search" placeholder="Escriba para buscar">
                </div>
                <center>
                
                <div class="table-responsive">
                <table class="table table-hover table-striped display" id="mytable" style="cursor: pointer;">
                    <thead style="background-color: #00bcd4;color: white; font-weight: bold;">
                        <tr>
                            <th>Mes</th>
                            <th>Cía</th>
                            <th>N° Póliza</th>
                            <th>F Hasta Seguro</th>
                            <th>Nombre Titular</th>
                            <th>Ramo</th>
                            <th>Asesor</th>
                            <th hidden>id</th>
                        </tr>
                    </thead>
                    
                    <tbody >
                        <?php
                        $totalsuma=0;
                        $totalprima=0;
                        $currency="";
                        $totalpoliza=0;

                        for ($a=0; $a < $cont; $a++) { 
                            
                        
                        if ($mes==null) {
                            $desde1 = [$_GET['anio']."-01-01",$_GET['anio']."-02-01",$_GET['anio']."-03-01",$_GET['anio']."-04-01",$_GET['anio']."-05-01",$_GET['anio']."-06-01",$_GET['anio']."-07-01",$_GET['anio']."-08-01",$_GET['anio']."-09-01",$_GET['anio']."-10-01",$_GET['anio']."-11-01",$_GET['anio']."-12-01"];
                            
                            $hasta1 = [$_GET['anio']."-01-31",$_GET['anio']."-02-31",$_GET['anio']."-03-31",$_GET['anio']."-04-31",$_GET['anio']."-05-31",$_GET['anio']."-06-31",$_GET['anio']."-07-31",$_GET['anio']."-08-31",$_GET['anio']."-09-31",$_GET['anio']."-10-31",$_GET['anio']."-11-31",$_GET['anio']."-12-31"];

                            $mes1 = [1,2,3,4,5,6,7,8,9,10,11,12];
                        }else {
                            $desde1 = [$desde];
                            $hasta1 = [$hasta];
                            $mes1 = [$mes];
                        }

                        

                        
                        $obj2= new Trabajo();
                        $poliza = $obj2->get_poliza_total_by_filtro_renov_ac($desde1[$a],$hasta1[$a],$cia,$asesor); 
                        

                        ?>
                            
                            <tr>
                                <td rowspan="<?php echo sizeof($poliza); ?>" style="background-color: #D9D9D9"><?php echo $mes_arr[$mes1[$a]-1]; ?></td>        

                        <?php


                        for ($i=0; $i < sizeof($poliza); $i++) { 
                            $totalsuma=$totalsuma+$poliza[$i]['sumaasegurada'];
                            $totalprima=$totalprima+$poliza[$i]['prima'];

                            $originalHasta = $poliza[$i]['f_hastapoliza'];
                            $newHasta = date("d/m/Y", strtotime($originalHasta));

                            if ($poliza[$i]['currency']==1) {
                                $currency="$ ";
                            }else{$currency="Bs ";}


                            if ($poliza[$i]['f_hastapoliza'] >= date("Y-m-d")) {
                            ?>  
                                <td><?php echo utf8_encode($poliza[$i]['nomcia']); ?></td>
                                <td style="color: #2B9E34;font-weight: bold"><?php echo $poliza[$i]['cod_poliza']; ?></td>
                            <?php            
                            } else{
                            ?>
                                <td><?php echo utf8_encode($poliza[$i]['nomcia']); ?></td>
                                <td style="color: #E54848;font-weight: bold"><?php echo $poliza[$i]['cod_poliza']; ?></td>
                            <?php   
                            }

                            $ob2= new Trabajo();
                            $ejecutivoPoliza = $ob2->get_element_by_id('ena','cod',$poliza[$i]['codvend']); 
                            $nombre=$ejecutivoPoliza[0]['idnom'];
                            if (sizeof($ejecutivoPoliza)==null) {
                                $ob2= new Trabajo();
                                $ejecutivoPoliza = $ob2->get_element_by_id('enp','cod',$poliza[$i]['codvend']); 
                                $nombre=$ejecutivoPoliza[0]['nombre'];
                            }
                            if (sizeof($ejecutivoPoliza)==null) {
                                $ob2= new Trabajo();
                                $ejecutivoPoliza = $ob2->get_element_by_id('enr','cod',$poliza[$i]['codvend']); 
                                $nombre=$ejecutivoPoliza[0]['nombre'];
                            }

                            ?>
                            
                                <td><?php echo $newHasta; ?></td>
                                <td ><?php echo utf8_encode($poliza[$i]['nombre_t']." ".$poliza[$i]['apellido_t']); ?></td>
                                <td nowrap><?php echo utf8_encode($poliza[$i]['nramo']); ?></td>
                                <td nowrap><?php echo utf8_encode($nombre); ?></td>
                                <td hidden><?php echo $poliza[$i]['id_poliza']; ?></td>
                            </tr>
                            <?php
                            }
                            ?>
                            <tr class="no-tocar">
                                <td colspan="7" style="background-color: #F53333;color: white;font-weight: bold">Total <?php echo $mes_arr[$mes1[$a]-1]; ?>: <font size=4 color="aqua"><?php echo sizeof($poliza); ?></font></td>
                            </tr>
                        <?php
                        $totalpoliza=$totalpoliza+sizeof($poliza);
                        }
                        ?>
                    </tbody>


                    <tfoot>
                        <tr>
                            <th>Mes</th>
                            <th>Cía</th>
                            <th>N° Póliza</th>
                            <th>F Hasta Seguro</th>
                            <th>Nombre Titular</th>
                            <th>Ramo</th>
                            <th>Asesor</th>
                            <th hidden>id</th>
                        </tr>
                    </tfoot>
                </table>
                </div>


                <table hidden class="table table-hover table-striped display table-responsive" id="Exportar_a_Excel" >
                    <thead style="background-color: #00bcd4;color: white; font-weight: bold;">
                        <tr>
                            <th>Mes</th>
                            <th>Cía</th>
                            <th>N° Póliza</th>
                            <th>F Hasta Seguro</th>
                            <th>Nombre Titular</th>
                            <th>Ramo</th>
                            <th>Asesor</th>
                        </tr>
                    </thead>
                    
                    <tbody >
                        <?php
                        $totalsuma=0;
                        $totalprima=0;
                        $currency="";
                        $totalpoliza=0;

                        for ($a=0; $a < $cont; $a++) { 
                            
                        
                        if ($mes==null) {
                            $desde1 = [$_GET['anio']."-01-01",$_GET['anio']."-02-01",$_GET['anio']."-03-01",$_GET['anio']."-04-01",$_GET['anio']."-05-01",$_GET['anio']."-06-01",$_GET['anio']."-07-01",$_GET['anio']."-08-01",$_GET['anio']."-09-01",$_GET['anio']."-10-01",$_GET['anio']."-11-01",$_GET['anio']."-12-01"];
                            
                            $hasta1 = [$_GET['anio']."-01-31",$_GET['anio']."-02-31",$_GET['anio']."-03-31",$_GET['anio']."-04-31",$_GET['anio']."-05-31",$_GET['anio']."-06-31",$_GET['anio']."-07-31",$_GET['anio']."-08-31",$_GET['anio']."-09-31",$_GET['anio']."-10-31",$_GET['anio']."-11-31",$_GET['anio']."-12-31"];

                            $mes1 = [1,2,3,4,5,6,7,8,9,10,11,12];
                        }else {
                            $desde1 = [$desde];
                            $hasta1 = [$hasta];
                            $mes1 = [$mes];
                        }

                        

                        
                        $obj2= new Trabajo();
                        $poliza = $obj2->get_poliza_total_by_filtro_renov_ac($desde1[$a],$hasta1[$a],$cia,$asesor); 
                        

                        ?>
                            
                            <tr>
                                <td rowspan="<?php echo sizeof($poliza); ?>" style="background-color: #D9D9D9"><?php echo $mes_arr[$mes1[$a]-1]; ?></td>        

                        <?php


                        for ($i=0; $i < sizeof($poliza); $i++) { 
                            $totalsuma=$totalsuma+$poliza[$i]['sumaasegurada'];
                            $totalprima=$totalprima+$poliza[$i]['prima'];

                            $originalHasta = $poliza[$i]['f_hastapoliza'];
                            $newHasta = date("d/m/Y", strtotime($originalHasta));

                            if ($poliza[$i]['currency']==1) {
                                $currency="$ ";
                            }else{$currency="Bs ";}


                            if ($poliza[$i]['f_hastapoliza'] >= date("Y-m-d")) {
                            ?>  
                                <td><?php echo utf8_encode($poliza[$i]['nomcia']); ?></td>
                                <td style="color: #2B9E34;font-weight: bold"><?php echo $poliza[$i]['cod_poliza']; ?></td>
                            <?php            
                            } else{
                            ?>
                                <td><?php echo utf8_encode($poliza[$i]['nomcia']); ?></td>
                                <td style="color: #E54848;font-weight: bold"><?php echo $poliza[$i]['cod_poliza']; ?></td>
                            <?php   
                            }

                            $ob2= new Trabajo();
                            $ejecutivoPoliza = $ob2->get_element_by_id('ena','cod',$poliza[$i]['codvend']); 
                            $nombre=$ejecutivoPoliza[0]['idnom'];
                            if (sizeof($ejecutivoPoliza)==null) {
                                $ob2= new Trabajo();
                                $ejecutivoPoliza = $ob2->get_element_by_id('enp','cod',$poliza[$i]['codvend']); 
                                $nombre=$ejecutivoPoliza[0]['nombre'];
                            }
                            if (sizeof($ejecutivoPoliza)==null) {
                                $ob2= new Trabajo();
                                $ejecutivoPoliza = $ob2->get_element_by_id('enr','cod',$poliza[$i]['codvend']); 
                                $nombre=$ejecutivoPoliza[0]['nombre'];
                            }

                            ?>
                            
                                <td><?php echo $newHasta; ?></td>
                                <td ><?php echo utf8_encode($poliza[$i]['nombre_t']." ".$poliza[$i]['apellido_t']); ?></td>
                                <td nowrap><?php echo utf8_encode($poliza[$i]['nramo']); ?></td>
                                <td nowrap><?php echo utf8_encode($nombre); ?></td>
                            </tr>
                            <?php
                            }
                            ?>
                            <tr class="no-tocar">
                                <td colspan="7" style="background-color: #F53333;color: white;font-weight: bold">Total <?php echo $mes_arr[$mes1[$a]-1]; ?>: <font size=4 color="aqua"><?php echo sizeof($poliza); ?></font></td>
                            </tr>
                        <?php
                        $totalpoliza=$totalpoliza+sizeof($poliza);
                        }
                        ?>
                    </tbody>


                    <tfoot>
                        <tr>
                            <th>Mes</th>
                            <th>Cía</th>
                            <th>N° Póliza</th>
                            <th>F Hasta Seguro</th>
                            <th>Nombre Titular</th>
                            <th>Ramo</th>
                            <th>Asesor</th>
                        </tr>
                    </tfoot>
                </table>


                <h1 class="title">Total de Prima Suscrita</h1>
                <h1 class="title text-danger">$ <?php  echo number_format($totalprima,2);?></h1>

                <h1 class="title">Total de Pólizas</h1>
                <h1 class="title text-danger"><?php  echo $totalpoliza;?></h1>
            </center>


                
            </div>

        </div>

        





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
    


    <script src="../../assets/js/core/popper.min.js"></script>
    <script src="../../assets/js/bootstrap-material-design.js"></script>
    <!--  Plugin for Date Time Picker and Full Calendar Plugin  -->
    <script src="../../assets/js/plugins/moment.min.js"></script>
    <!--	Plugin for the Datepicker, full documentation here: https://github.com/Eonasdan/bootstrap-datetimepicker -->
    <script src="../../assets/js/plugins/bootstrap-datetimepicker.min.js"></script>
    <!--	Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
    <script src="../../assets/js/plugins/nouislider.min.js"></script>
    <!-- Material Kit Core initialisations of plugins and Bootstrap Material Design Library -->
    <script src="../../assets/js/material-kit.js?v=2.0.1"></script>
    <!-- Fixed Sidebar Nav - js With initialisations For Demo Purpose, Don't Include it in your project -->
    <script src="../../assets/assets-for-demo/js/material-kit-demo.js"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>


    <script>
     // Write on keyup event of keyword input element
     $(document).ready(function(){
     $("#search").keyup(function(){
     _this = this;
     // Show only matching TR, hide rest of them
     $.each($("#mytable tbody tr"), function() {
     if($(this).text().toLowerCase().indexOf($(_this).val().toLowerCase()) === -1)
     $(this).hide();
     else
     $(this).show();
     });
     });
    });

        $( "#mytable tbody tr" ).click(function() {

        if ($(this).attr('class') != 'no-tocar') {
            var customerId = $(this).find("td").eq(7).html();  

            if (customerId == null) {
                var customerId = $(this).find("td").eq(6).html();  
            } 

            window.open ("../v_poliza.php?id_poliza="+customerId ,'_blank');
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