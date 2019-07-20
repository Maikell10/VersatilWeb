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

  $cia = $_GET['cia'];


  $obj1= new Trabajo();
  $distinct_a = $obj1->get_poliza_total_by_filtro_renov_distinct_a($desde,$hasta,$cia); 

  //Ordeno los ejecutivos de menor a mayor alfabéticamente
  $Ejecutivo[sizeof($distinct_a)]=null;
  $codEj[sizeof($distinct_a)]=null;

  for ($i=0; $i < sizeof($distinct_a); $i++) { 
        $obj111= new Trabajo();
        $asesor1 = $obj111->get_element_by_id('ena','cod',$distinct_a[$i]['codvend']);
        $nombre=$asesor1[0]['idnom'];

        if (sizeof($asesor1)==null) {
            $ob3= new Trabajo();
            $asesor1 = $ob3->get_element_by_id('enp','cod',$distinct_a[$i]['codvend']); 
            $nombre=$asesor1[0]['nombre'];
        }
    
        if (sizeof($asesor1)==null) {
            $ob3= new Trabajo();
            $asesor1 = $ob3->get_element_by_id('enr','cod',$distinct_a[$i]['codvend']); 
            $nombre=$asesor1[0]['nombre'];
        }

        $Ejecutivo[$i]=$nombre;
        $codEj[$i]=$distinct_a[$i]['codvend'];                   
  }

    asort($Ejecutivo);
    $x = array();
    foreach($Ejecutivo as $key=>$value) {
        $x[count($x)] = $key;
    }

    for ($a=1; $a <= sizeof($distinct_a); $a++) { 
        utf8_encode($Ejecutivo[$x[$a]]);
        $codEj[$x[$a]]."  --  ";
    }


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
                    <h1 class="title">Resultado de Búsqueda de Póliza a Renovar por Asesor</h1>  
                    <h2>Año: <font style="font-weight:bold"><?php echo $_GET['anio']; 
                        if ($_GET['mes']==null) {
                        }else{
                    ?></font>
                        Mes: <font style="font-weight:bold"><?php echo $mes_arr[$_GET['mes']-1]; } ?></font></h2>
                    <?php
                        if ($cia=='Seleccione Cía') {
                        } else {
                    ?>
                    <h2>Cía: <font style="font-weight:bold"><?php echo $cia; ?></font></h2>
                    <?php
                        }
                    ?>
                </div>
    
                <center><a  class="btn btn-success" onclick="tableToExcel('Exportar_a_Excel', 'Pólizas a Renovar por Asesor')" data-toggle="tooltip" data-placement="right" title="Exportar a Excel"><img src="../../assets/img/excel.png" width="60" alt=""></a></center>
                
                
                <div class="form-group">
                    <input type="text" class="form-control pull-right" style="width:20%" id="search" placeholder="Escriba para buscar">
                </div>
                <center>
                
                <div class="table-responsive">
                <table class="table table-hover table-striped display" id="mytable" style="cursor: pointer;">
                    <thead style="background-color: #00bcd4;color: white; font-weight: bold;">
                        <tr>
                            <th>Asesor</th>
                            <th>N° Póliza</th>
                            <th>Nombre Titular</th>
                            <th>Cía</th>
                            <th>Ramo</th>
                            <th>F Desde Seguro</th>
                            <th>F Hasta Seguro</th>
                            <th hidden>id</th>
                        </tr>
                    </thead>
                    
                    <tbody >
                        <?php
                        $totalsuma=0;
                        $totalprima=0;
                        $currency="";
                        $totalpoliza=0;

                        for ($a=1; $a <= sizeof($distinct_a); $a++) { 
                            
                        

                        $obj2= new Trabajo();
                        $poliza = $obj2->get_poliza_total_by_filtro_renov_a($desde,$hasta,$cia,$codEj[$x[$a]]); 

                        $ob2= new Trabajo();
                        $ejecutivoPoliza = $ob2->get_element_by_id('ena','cod',$codEj[$x[$a]]); 
                        $nombre=$ejecutivoPoliza[0]['idnom'];
                        if (sizeof($ejecutivoPoliza)==null) {
                            $ob2= new Trabajo();
                            $ejecutivoPoliza = $ob2->get_element_by_id('enp','cod',$codEj[$x[$a]]); 
                            $nombre=$ejecutivoPoliza[0]['nombre'];
                        }
                        if (sizeof($ejecutivoPoliza)==null) {
                            $ob2= new Trabajo();
                            $ejecutivoPoliza = $ob2->get_element_by_id('enr','cod',$codEj[$x[$a]]); 
                            $nombre=$ejecutivoPoliza[0]['nombre'];
                        }

                        ?>
                            <tr>
                                <td rowspan="<?php echo sizeof($poliza); ?>" style="background-color: #D9D9D9"><?php echo $nombre; ?></td>

                        <?php

                        for ($i=0; $i < sizeof($poliza); $i++) { 
                            $totalsuma=$totalsuma+$poliza[$i]['sumaasegurada'];
                            $totalprima=$totalprima+$poliza[$i]['prima'];

                            $originalDesde = $poliza[$i]['f_desdepoliza'];
                            $newDesde = date("d/m/Y", strtotime($originalDesde));
                            $originalHasta = $poliza[$i]['f_hastapoliza'];
                            $newHasta = date("d/m/Y", strtotime($originalHasta));

                            if ($poliza[$i]['currency']==1) {
                                $currency="$ ";
                            }else{$currency="Bs ";}


                            if ($poliza[$i]['f_hastapoliza'] >= date("Y-m-d")) {
                            ?>
                                <td style="color: #2B9E34;font-weight: bold"><?php echo $poliza[$i]['cod_poliza']; ?></td>
                            <?php            
                            } else{
                            ?>
                                <td style="color: #E54848;font-weight: bold"><?php echo $poliza[$i]['cod_poliza']; ?></td>
                            <?php   
                            }

                            ?>
                            
                                <td nowrap><?php echo utf8_encode($poliza[$i]['nombre_t']." ".$poliza[$i]['apellido_t']); ?></td>
                                <td nowrap><?php echo utf8_encode($poliza[$i]['nomcia']); ?></td>
                                <td nowrap><?php echo utf8_encode($poliza[$i]['nramo']); ?></td>
                                <td><?php echo $newHasta; ?></td>
                                <td><?php echo $newHasta; ?></td>
                                <td hidden><?php echo $poliza[$i]['id_poliza']; ?></td>
                            </tr>
                            <?php
                            }
                            ?>
                            <tr class="no-tocar">
                                <td colspan="7" style="background-color: #F53333;color: white;font-weight: bold">Total <?php echo $nombre; ?>: <font size=4 color="aqua"><?php echo sizeof($poliza); ?></font></td>
                            </tr>
                        <?php
                        $totalpoliza=$totalpoliza+sizeof($poliza);
                        }
                        ?>
                    </tbody>


                    <tfoot>
                        <tr>
                            <th>Asesor</th>
                            <th>N° Póliza</th>
                            <th>Nombre Titular</th>
                            <th>Cía</th>
                            <th>Ramo</th>
                            <th>F Desde Seguro</th>
                            <th>F Hasta Seguro</th>
                            <th hidden>id</th>
                        </tr>
                    </tfoot>
                </table>
                </div>


                <table hidden class="table table-hover table-striped table-bordered display table-responsive" id="Exportar_a_Excel" >
                <thead style="background-color: #00bcd4;color: white; font-weight: bold;">
                        <tr>
                            <th>Asesor</th>
                            <th>N° Póliza</th>
                            <th>Nombre Titular</th>
                            <th>Cía</th>
                            <th>Ramo</th>
                            <th>F Desde Seguro</th>
                            <th>F Hasta Seguro</th>
                        </tr>
                    </thead>
                    
                    <tbody >
                        <?php
                        $totalsuma=0;
                        $totalprima=0;
                        $currency="";
                        $totalpoliza=0;

                        for ($a=1; $a <= sizeof($distinct_a); $a++) { 
                            
                        

                        $obj2= new Trabajo();
                        $poliza = $obj2->get_poliza_total_by_filtro_renov_a($desde,$hasta,$cia,$codEj[$x[$a]]); 

                        $ob2= new Trabajo();
                        $ejecutivoPoliza = $ob2->get_element_by_id('ena','cod',$codEj[$x[$a]]); 
                        $nombre=$ejecutivoPoliza[0]['idnom'];
                        if (sizeof($ejecutivoPoliza)==null) {
                            $ob2= new Trabajo();
                            $ejecutivoPoliza = $ob2->get_element_by_id('enp','cod',$codEj[$x[$a]]); 
                            $nombre=$ejecutivoPoliza[0]['nombre'];
                        }
                        if (sizeof($ejecutivoPoliza)==null) {
                            $ob2= new Trabajo();
                            $ejecutivoPoliza = $ob2->get_element_by_id('enr','cod',$codEj[$x[$a]]); 
                            $nombre=$ejecutivoPoliza[0]['nombre'];
                        }

                        ?>
                            <tr style="cursor: pointer;">
                                <td rowspan="<?php echo sizeof($poliza); ?>" style="background-color: #D9D9D9"><?php echo $nombre; ?></td>

                        <?php

                        for ($i=0; $i < sizeof($poliza); $i++) { 
                            $totalsuma=$totalsuma+$poliza[$i]['sumaasegurada'];
                            $totalprima=$totalprima+$poliza[$i]['prima'];

                            $originalDesde = $poliza[$i]['f_desdepoliza'];
                            $newDesde = date("d/m/Y", strtotime($originalDesde));
                            $originalHasta = $poliza[$i]['f_hastapoliza'];
                            $newHasta = date("d/m/Y", strtotime($originalHasta));

                            if ($poliza[$i]['currency']==1) {
                                $currency="$ ";
                            }else{$currency="Bs ";}


                            if ($poliza[$i]['f_hastapoliza'] >= date("Y-m-d")) {
                            ?>
                                <td style="color: #2B9E34;font-weight: bold"><?php echo $poliza[$i]['cod_poliza']; ?></td>
                            <?php            
                            } else{
                            ?>
                                <td style="color: #E54848;font-weight: bold"><?php echo $poliza[$i]['cod_poliza']; ?></td>
                            <?php   
                            }

                            ?>
                            
                                <td nowrap><?php echo utf8_encode($poliza[$i]['nombre_t']." ".$poliza[$i]['apellido_t']); ?></td>
                                <td nowrap><?php echo utf8_encode($poliza[$i]['nomcia']); ?></td>
                                <td nowrap><?php echo utf8_encode($poliza[$i]['nramo']); ?></td>
                                <td><?php echo $newHasta; ?></td>
                                <td><?php echo $newHasta; ?></td>
                            </tr>
                            <?php
                            }
                            ?>
                            <tr>
                                <td colspan="7" style="background-color: #F53333;color: white;font-weight: bold">Total <?php echo $nombre; ?>: <font size=4 color="aqua"><?php echo sizeof($poliza); ?></font></td>
                            </tr>
                        <?php
                        $totalpoliza=$totalpoliza+sizeof($poliza);
                        }
                        ?>
                    </tbody>


                    <tfoot>
                        <tr>
                            <th>Asesor</th>
                            <th>N° Póliza</th>
                            <th>Nombre Titular</th>
                            <th>Cía</th>
                            <th>Ramo</th>
                            <th>F Desde Seguro</th>
                            <th>F Hasta Seguro</th>
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


   <script language="javascript">

    $( "#mytable tbody tr" ).click(function() {

    if ($(this).attr('class') != 'no-tocar') {
        var customerId = $(this).find("td").eq(7).html();  

        if (customerId == null) {
            var customerId = $(this).find("td").eq(6).html();  
        } 

        window.open ("../v_poliza.php?id_poliza="+customerId ,'_blank');
    }
    });


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