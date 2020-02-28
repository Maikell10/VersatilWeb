<?php 
session_start();
if(isset($_SESSION['seudonimo'])) {

  }
    else {
        header("Location: login.php");
        exit();
      }
      
  require_once("../../class/clases.php");

  if (isset($_GET["asesor"])!=null) {
    $asesor=$_GET["asesor"]; 
  }else{$asesor='';}

  $mes_arr=['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];

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
  $distinct_c = $obj1->get_poliza_total_by_filtro_renov_distinct_c($desde,$hasta,$asesor); 

  $obj11= new Trabajo();
  $asesor_b = $obj11->get_asesor_por_cod($asesor); 

  $asesorArray='';
  for ($i=0; $i < sizeof($asesor_b) ; $i++) { 
    $asesorArray.=$asesor_b[$i]['nombre'].", ";
  }
  $asesorArray;
  $myString = substr($asesorArray, 0, -2);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php require('header.php');?>
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
                    <h1 class="title">Resultado de Búsqueda de Póliza a Renovar por Cía</h1>  
                    <h2>Año: <font style="font-weight:bold"><?= $_GET['anio']; 
                        if ($_GET['mes']==null) {
                        }else{
                    ?></font>
                        Mes: <font style="font-weight:bold"><?= $mes_arr[$_GET['mes']-1]; } ?></font></h2>

                    <?php
                        if ($asesor=='') {
                        } else {
                    ?>
                    <h2>Asesor: <font style="font-weight:bold"><?= $myString; ?></font></h2>
                    <?php
                        }
                    ?>
                </div>

                
                <center><a  class="btn btn-success" onclick="tableToExcel('Exportar_a_Excel', 'Pólizas a Renovar por Cía')" data-toggle="tooltip" data-placement="right" title="Exportar a Excel"><img src="../../assets/img/excel.png" width="60" alt=""></a></center>

                <div class="form-group">
                    <input type="text" class="form-control pull-right" style="width:20%" id="search" placeholder="Escriba para buscar">
                </div>
                <center>

                <div class="table-responsive">
                <table class="table table-hover table-striped display" id="mytable" style="cursor: pointer;">
                    <thead style="background-color: #00bcd4;color: white; font-weight: bold;">
                        <tr>
                            <th>Cía</th>
                            <th>N° Póliza</th>
                            <th>F Hasta Seguro</th>
                            <th>Nombre Titular</th>
                            <th>Ramo</th>
                            <th hidden>id</th>
                        </tr>
                    </thead>
                    
                    <tbody >
                        <?php
                        $totalsuma=0;
                        $totalprima=0;
                        $currency="";
                        $totalpoliza=0;

                        for ($a=0; $a < sizeof($distinct_c); $a++) { 
                            
                        

                        $obj2= new Trabajo();
                        $poliza = $obj2->get_poliza_total_by_filtro_renov_c($desde,$hasta,$distinct_c[$a]['nomcia'],$asesor); 

                        ?>
                            <tr>
                                <td rowspan="<?= sizeof($poliza); ?>" style="background-color: #D9D9D9"><?= $distinct_c[$a]['nomcia']; ?></td>

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
                                <td style="color: #2B9E34;font-weight: bold"><?= $poliza[$i]['cod_poliza']; ?></td>
                            <?php            
                            } else{
                            ?>
                                <td style="color: #E54848;font-weight: bold"><?= $poliza[$i]['cod_poliza']; ?></td>
                            <?php   
                            }

                            ?>
                            
                                <td><?= $newHasta; ?></td>
                                <td nowrap><?= utf8_encode($poliza[$i]['nombre_t']." ".$poliza[$i]['apellido_t']); ?></td>
                                <td nowrap><?= utf8_encode($poliza[$i]['nramo']); ?></td>
                                <td hidden><?= $poliza[$i]['id_poliza']; ?></td>
                            </tr>
                            <?php
                            }
                            ?>
                            <tr class="no-tocar">
                                <td colspan="5" style="background-color: #F53333;color: white;font-weight: bold">Total <?= $distinct_c[$a]['nomcia']; ?>: <font size=4 color="aqua"><?= sizeof($poliza); ?></font></td>
                            </tr>
                        <?php
                        $totalpoliza=$totalpoliza+sizeof($poliza);
                        }
                        ?>
                    </tbody>


                    <tfoot>
                        <tr>
                            <th>Cía</th>
                            <th>N° Póliza</th>
                            <th>F Hasta Seguro</th>
                            <th>Nombre Titular</th>
                            <th>Ramo</th>
                            <th hidden>id</th>
                        </tr>
                    </tfoot>
                </table>
                </div>


                <table hidden class="table table-hover table-striped display table-responsive" id="Exportar_a_Excel" >
                <thead style="background-color: #00bcd4;color: white; font-weight: bold;">
                        <tr>
                            <th>Cía</th>
                            <th>N° Póliza</th>
                            <th>F Hasta Seguro</th>
                            <th>Nombre Titular</th>
                            <th>Ramo</th>
                        </tr>
                    </thead>
                    
                    <tbody >
                        <?php
                        $totalsuma=0;
                        $totalprima=0;
                        $currency="";
                        $totalpoliza=0;

                        for ($a=0; $a < sizeof($distinct_c); $a++) { 
                            
                        

                        $obj2= new Trabajo();
                        $poliza = $obj2->get_poliza_total_by_filtro_renov_c($desde,$hasta,$distinct_c[$a]['nomcia'],$asesor); 

                        ?>
                            <tr style="cursor: pointer;">
                                <td rowspan="<?= sizeof($poliza); ?>" style="background-color: #D9D9D9"><?= $distinct_c[$a]['nomcia']; ?></td>

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
                                <td style="color: #2B9E34;font-weight: bold"><?= $poliza[$i]['cod_poliza']; ?></td>
                            <?php            
                            } else{
                            ?>
                                <td style="color: #E54848;font-weight: bold"><?= $poliza[$i]['cod_poliza']; ?></td>
                            <?php   
                            }

                            ?>
                            
                                <td><?= $newHasta; ?></td>
                                <td nowrap><?= utf8_encode($poliza[$i]['nombre_t']." ".$poliza[$i]['apellido_t']); ?></td>
                                <td nowrap><?= utf8_encode($poliza[$i]['nramo']); ?></td>
                            </tr>
                            <?php
                            }
                            ?>
                            <tr>
                                <td colspan="5" style="background-color: #F53333;color: white;font-weight: bold">Total <?= $distinct_c[$a]['nomcia']; ?>: <font size=4 color="aqua"><?= sizeof($poliza); ?></font></td>
                            </tr>
                        <?php
                        $totalpoliza=$totalpoliza+sizeof($poliza);
                        }
                        ?>
                    </tbody>


                    <tfoot>
                        <tr>
                            <th>Cía</th>
                            <th>N° Póliza</th>
                            <th>F Hasta Seguro</th>
                            <th>Nombre Titular</th>
                            <th>Ramo</th>
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
        var customerId = $(this).find("td").eq(5).html();  

        if (customerId == null) {
            var customerId = $(this).find("td").eq(4).html();  
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