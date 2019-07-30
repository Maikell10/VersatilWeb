<?php 
session_start();
if(isset($_SESSION['seudonimo'])) {

  }
    else {
        header("Location: login.php");
        exit();
      }
      
  require_once("../class/clases.php");

  if (isset($_GET["cia"])!=null) {
    $cia=$_GET["cia"]; 
  }else{$cia='';}

  if (isset($_GET["asesor"])!=null) {
    $asesor=$_GET["asesor"]; 
  }else{$asesor='';}



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
  $poliza = $obj1->get_poliza_total_by_filtro($desde,$hasta,$cia,$asesor); 

  $obj2= new Trabajo();
  $poliza1 = $obj2->get_poliza_total_by_filtro_enp($desde,$hasta,$cia,$asesor); 

  $obj3= new Trabajo();
  $poliza2 = $obj3->get_poliza_total_by_filtro_enr($desde,$hasta,$cia,$asesor); 


  $totalPrimaC=0;

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php require('header.php');?>
</head>

<body class="profile-page ">
    
    <?php require('navigation.php');?>




    <div class="page-header  header-filter " data-parallax="true" style="background-image: url('../assets/img/logo2.png');">
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
        

        <div id="carga" class="d-flex justify-content-center align-items-center">
            <div class="spinner-grow text-info" style="width: 7rem; height: 7rem;"></div>
        </div>
 
        <div class="section">
            <div class="container-fluid">
            <a href="javascript:history.back(-1);" data-tooltip="tooltip" data-placement="right" title="Ir la página anterior" class="btn btn-info btn-round"><- Regresar</a>

                <div class="col-md-auto col-md-offset-2" id="tablaLoad1" hidden="true">
                    <h1 class="title">Resultado de Búsqueda de Póliza</h1>  
                </div>

                <center><a  class="btn btn-success" onclick="tableToExcel('Exportar_a_Excel', 'Listado de Pólizas')" data-toggle="tooltip" data-placement="right" title="Exportar a Excel"><img src="../assets/img/excel.png" width="60" alt=""></a></center>
                


                <center>
                <div class="table-responsive">
                <table class="table table-hover table-striped table-bordered" id="iddatatable" >
                    <thead style="background-color: #00bcd4;color: white; font-weight: bold;">
                        <tr>
                            <th hidden>f_poliza</th>
                            <th hidden>id</th>
                            <th>N° Póliza</th>
                            <th>Nombre Asesor</th>
                            <th>Cía</th>
                            <th>F Desde Seguro</th>
                            <th>F Hasta Seguro</th>
                            <th style="background-color: #E54848;">Prima Suscrita</th>
                            <th>Prima Cobrada</th>
                            <th>Nombre Titular</th>
                        </tr>
                    </thead>
                    
                    <tbody >
                        <?php
                        $totalsuma=0;
                        $totalprima=0;
                        $currency="";
                        $cant=0;
                        for ($i=0; $i < sizeof($poliza); $i++) { 
                            if ($poliza[$i]['id_titular']==0) {

                            } else {
                            $cant=$cant+1;
                            $totalsuma=$totalsuma+$poliza[$i]['sumaasegurada'];
                            $totalprima=$totalprima+$poliza[$i]['prima'];

                            $originalDesde = $poliza[$i]['f_desdepoliza'];
                            $newDesde = date("d/m/Y", strtotime($originalDesde));
                            $originalHasta = $poliza[$i]['f_hastapoliza'];
                            $newHasta = date("d/m/Y", strtotime($originalHasta));
                            $originalFProd = $poliza[$i]['f_poliza'];
				            $newFProd = date("d/m/Y", strtotime($originalFProd));

                            if ($poliza[$i]['currency']==1) {
                                $currency="$ ";
                            }else{$currency="Bs ";}

                            $obj6= new Trabajo();
                            $primaC = $obj6->get_prima_cobrada_poliza($poliza[$i]['id_poliza']); 
                            $totalPrimaC=$totalPrimaC+$primaC[0]['SUM(prima_com)'];


                            if ($poliza[$i]['f_hastapoliza'] >= date("Y-m-d")) {
                            ?>
                            <tr style="cursor: pointer;">
                                <td hidden><?php echo $poliza[$i]['f_hastapoliza']; ?></td>
                                <td hidden><?php echo $poliza[$i]['id_poliza']; ?></td>
                                <td style="color: #2B9E34;font-weight: bold"><?php echo $poliza[$i]['cod_poliza']; ?></td>
                            <?php            
                            } else{
                            ?>
                            <tr style="cursor: pointer;">
                                <td hidden><?php echo $poliza[$i]['f_hastapoliza']; ?></td>
                                <td hidden><?php echo $poliza[$i]['id_poliza']; ?></td>
                                <td style="color: #E54848;font-weight: bold"><?php echo $poliza[$i]['cod_poliza']; ?></td>
                            <?php   
                            }

                            ?>
                            
                                
                                <td><?php echo utf8_encode($poliza[$i]['idnom']); ?></td>
                                <td><?php echo utf8_encode($poliza[$i]['nomcia']); ?></td>
                                <td><?php echo $newDesde; ?></td>
                                <td><?php echo $newHasta; ?></td>
                                <td><?php echo $currency.number_format($poliza[$i]['prima'],2); ?></td>
                                <td><?php echo $currency.number_format($primaC[0]['SUM(prima_com)'],2); ?></td>
                                <td nowrap><?php echo utf8_encode($poliza[$i]['nombre_t']." ".$poliza[$i]['apellido_t']); ?></td>
                            </tr>
                            <?php
                            }
                        }
                        ?>

                        <?php
                        //poliza enp

                        for ($i=0; $i < sizeof($poliza1); $i++) { 
                            if ($poliza1[$i]['id_titular']==0) {

                            } else {
                            $cant=$cant+1;
                            $totalsuma=$totalsuma+$poliza1[$i]['sumaasegurada'];
                            $totalprima=$totalprima+$poliza1[$i]['prima'];

                            $originalDesde = $poliza1[$i]['f_desdepoliza'];
                            $newDesde = date("d/m/Y", strtotime($originalDesde));
                            $originalHasta = $poliza1[$i]['f_hastapoliza'];
                            $newHasta = date("d/m/Y", strtotime($originalHasta));
                            $originalFProd = $poliza1[$i]['f_poliza'];
				            $newFProd = date("d/m/Y", strtotime($originalFProd));

                            if ($poliza1[$i]['currency']==1) {
                                $currency="$ ";
                            }else{$currency="Bs ";}

                            $obj6= new Trabajo();
                            $primaC = $obj6->get_prima_cobrada_poliza($poliza1[$i]['id_poliza']); 
                            $totalPrimaC=$totalPrimaC+$primaC[0]['SUM(prima_com)'];


                            if ($poliza1[$i]['f_hastapoliza'] >= date("Y-m-d")) {
                            ?>
                            <tr style="cursor: pointer;">
                                <td hidden><?php echo $poliza1[$i]['f_hastapoliza']; ?></td>
                                <td hidden><?php echo $poliza1[$i]['id_poliza']; ?></td>
                                <td style="color: #2B9E34;font-weight: bold"><?php echo $poliza1[$i]['cod_poliza']; ?></td>
                            <?php            
                            } else{
                            ?>
                            <tr style="cursor: pointer;">
                                <td hidden><?php echo $poliza1[$i]['f_hastapoliza']; ?></td>
                                <td hidden><?php echo $poliza1[$i]['id_poliza']; ?></td>
                                <td style="color: #E54848;font-weight: bold"><?php echo $poliza1[$i]['cod_poliza']; ?></td>
                            <?php   
                            }

                            ?>
                            
                                
                                <td><?php echo utf8_encode($poliza1[$i]['nombre']); ?></td>
                                <td><?php echo utf8_encode($poliza1[$i]['nomcia']); ?></td>
                                <td><?php echo $newDesde; ?></td>
                                <td><?php echo $newHasta; ?></td>
                                <td><?php echo $currency.number_format($poliza1[$i]['prima'],2); ?></td>
                                <td><?php echo $currency.number_format($primaC[0]['SUM(prima_com)'],2); ?></td>
                                <td nowrap><?php echo utf8_encode($poliza1[$i]['nombre_t']." ".$poliza1[$i]['apellido_t']); ?></td>
                            </tr>
                            <?php
                            }
                        }
                        ?>

                        <?php
                        //poliza enr

                        for ($i=0; $i < sizeof($poliza2); $i++) { 
                            if ($poliza2[$i]['id_titular']==0) {

                            } else {
                            $cant=$cant+1;
                            $totalsuma=$totalsuma+$poliza2[$i]['sumaasegurada'];
                            $totalprima=$totalprima+$poliza2[$i]['prima'];

                            $originalDesde = $poliza2[$i]['f_desdepoliza'];
                            $newDesde = date("d/m/Y", strtotime($originalDesde));
                            $originalHasta = $poliza2[$i]['f_hastapoliza'];
                            $newHasta = date("d/m/Y", strtotime($originalHasta));
                            $originalFProd = $poliza2[$i]['f_poliza'];
				            $newFProd = date("d/m/Y", strtotime($originalFProd));

                            if ($poliza2[$i]['currency']==1) {
                                $currency="$ ";
                            }else{$currency="Bs ";}

                            $obj6= new Trabajo();
                            $primaC = $obj6->get_prima_cobrada_poliza($poliza1[$i]['id_poliza']); 
                            $totalPrimaC=$totalPrimaC+$primaC[0]['SUM(prima_com)'];


                            if ($poliza2[$i]['f_hastapoliza'] >= date("Y-m-d")) {
                            ?>
                            <tr style="cursor: pointer;">
                                <td hidden><?php echo $poliza2[$i]['f_hastapoliza']; ?></td>
                                <td hidden><?php echo $poliza2[$i]['id_poliza']; ?></td>
                                <td style="color: #2B9E34;font-weight: bold"><?php echo $poliza2[$i]['cod_poliza']; ?></td>
                            <?php            
                            } else{
                            ?>
                            <tr style="cursor: pointer;">
                                <td hidden><?php echo $poliza2[$i]['f_hastapoliza']; ?></td>
                                <td hidden><?php echo $poliza2[$i]['id_poliza']; ?></td>
                                <td style="color: #E54848;font-weight: bold"><?php echo $poliza2[$i]['cod_poliza']; ?></td>
                            <?php   
                            }

                            ?>
                            
                                
                                <td><?php echo utf8_encode($poliza2[$i]['nombre']); ?></td>
                                <td><?php echo utf8_encode($poliza2[$i]['nomcia']); ?></td>
                                <td><?php echo $newDesde; ?></td>
                                <td><?php echo $newHasta; ?></td>
                                <td><?php echo $currency.number_format($poliza2[$i]['prima'],2); ?></td>
                                <td><?php echo $currency.number_format($primaC[0]['SUM(prima_com)'],2); ?></td>
                                <td nowrap><?php echo utf8_encode($poliza2[$i]['nombre_t']." ".$poliza2[$i]['apellido_t']); ?></td>
                            </tr>
                            <?php
                            }
                        }
                        ?>
                    </tbody>

                    <tfoot>
                        <tr>
                            <th hidden>f_poliza</th>
                            <th hidden>id</th>
                            <th>N° Póliza</th>
                            <th>Nombre Asesor</th>
                            <th>Cía</th>
                            <th>F Desde Seguro</th>
                            <th>F Hasta Seguro</th>
                            <th>Prima Suscrita $<?php echo number_format($totalprima,2); ?></th>
                            <th>Prima Cobrada</th>
                            <th>Nombre Titular</th>
                        </tr>
                    </tfoot>
                </table>
                </div>


                <h1 class="title">Total de Prima</h1>
                <h1 class="title text-danger">$ <?php  echo number_format($totalprima,2);?></h1>

                <h1 class="title">Total de Pólizas</h1>
                <h1 class="title text-danger"><?php  echo $cant;?></h1>
            </center>




            <table class="table table-hover table-striped table-bordered" id="Exportar_a_Excel" hidden>
                <thead style="background-color: #00bcd4;color: white; font-weight: bold;">
                        <tr>
                            <th>N° Póliza</th>
                            <th>Nombre Asesor</th>
                            <th>Cía</th>
                            <th>F Desde Seguro</th>
                            <th>F Hasta Seguro</th>
                            <th style="background-color: #E54848;">Prima Suscrita</th>
                            <th>Nombre Titular</th>
                        </tr>
                    </thead>
                    
                    <tbody >
                        <?php
                        $totalsuma=0;
                        $totalprima=0;
                        $currency="";
                        $cant=0;
                        for ($i=0; $i < sizeof($poliza); $i++) { 
                            if ($poliza[$i]['id_titular']==0) {

                            } else {
                            $cant=$cant+1;
                            $totalsuma=$totalsuma+$poliza[$i]['sumaasegurada'];
                            $totalprima=$totalprima+$poliza[$i]['prima'];

                            $originalDesde = $poliza[$i]['f_desdepoliza'];
                            $newDesde = date("d/m/Y", strtotime($originalDesde));
                            $originalHasta = $poliza[$i]['f_hastapoliza'];
                            $newHasta = date("d/m/Y", strtotime($originalHasta));
                            $originalFProd = $poliza[$i]['f_poliza'];
				            $newFProd = date("d/m/Y", strtotime($originalFProd));

                            if ($poliza[$i]['currency']==1) {
                                $currency="$ ";
                            }else{$currency="Bs ";}


                            if ($poliza[$i]['f_hastapoliza'] >= date("Y-m-d")) {
                            ?>
                            <tr style="cursor: pointer;">
                                <td style="color: #2B9E34;font-weight: bold"><?php echo $poliza[$i]['cod_poliza']; ?></td>
                            <?php            
                            } else{
                            ?>
                            <tr style="cursor: pointer;">
                                <td style="color: #E54848;font-weight: bold"><?php echo $poliza[$i]['cod_poliza']; ?></td>
                            <?php   
                            }
                            ?>
                                <td><?php echo utf8_encode($poliza[$i]['idnom']); ?></td>
                                <td><?php echo utf8_encode($poliza[$i]['nomcia']); ?></td>
                                <td><?php echo $newDesde; ?></td>
                                <td><?php echo $newHasta; ?></td>
                                <td><?php echo $currency.number_format($poliza[$i]['prima'],2); ?></td>
                                <td nowrap><?php echo utf8_encode($poliza[$i]['nombre_t']." ".$poliza[$i]['apellido_t']); ?></td>
                            </tr>
                            <?php
                            }
                        }
                        ?>

                        <?php
                        //poliza enp

                        for ($i=0; $i < sizeof($poliza1); $i++) { 
                            if ($poliza1[$i]['id_titular']==0) {

                            } else {
                            $cant=$cant+1;
                            $totalsuma=$totalsuma+$poliza1[$i]['sumaasegurada'];
                            $totalprima=$totalprima+$poliza1[$i]['prima'];

                            $originalDesde = $poliza1[$i]['f_desdepoliza'];
                            $newDesde = date("d/m/Y", strtotime($originalDesde));
                            $originalHasta = $poliza1[$i]['f_hastapoliza'];
                            $newHasta = date("d/m/Y", strtotime($originalHasta));
                            $originalFProd = $poliza1[$i]['f_poliza'];
				            $newFProd = date("d/m/Y", strtotime($originalFProd));

                            if ($poliza1[$i]['currency']==1) {
                                $currency="$ ";
                            }else{$currency="Bs ";}


                            if ($poliza1[$i]['f_hastapoliza'] >= date("Y-m-d")) {
                            ?>
                            <tr style="cursor: pointer;">
                                <td style="color: #2B9E34;font-weight: bold"><?php echo $poliza1[$i]['cod_poliza']; ?></td>
                            <?php            
                            } else{
                            ?>
                            <tr style="cursor: pointer;">
                                <td style="color: #E54848;font-weight: bold"><?php echo $poliza1[$i]['cod_poliza']; ?></td>
                            <?php   
                            }

                            ?>
                            
                                
                                <td><?php echo utf8_encode($poliza1[$i]['nombre']); ?></td>
                                <td><?php echo utf8_encode($poliza1[$i]['nomcia']); ?></td>
                                <td><?php echo $newDesde; ?></td>
                                <td><?php echo $newHasta; ?></td>
                                <td><?php echo $currency.number_format($poliza1[$i]['prima'],2); ?></td>
                                <td nowrap><?php echo utf8_encode($poliza1[$i]['nombre_t']." ".$poliza1[$i]['apellido_t']); ?></td>
                            </tr>
                            <?php
                            }
                        }
                        ?>

                        <?php
                        //poliza enr

                        for ($i=0; $i < sizeof($poliza2); $i++) { 
                            if ($poliza2[$i]['id_titular']==0) {

                            } else {
                            $cant=$cant+1;
                            $totalsuma=$totalsuma+$poliza2[$i]['sumaasegurada'];
                            $totalprima=$totalprima+$poliza2[$i]['prima'];

                            $originalDesde = $poliza2[$i]['f_desdepoliza'];
                            $newDesde = date("d/m/Y", strtotime($originalDesde));
                            $originalHasta = $poliza2[$i]['f_hastapoliza'];
                            $newHasta = date("d/m/Y", strtotime($originalHasta));
                            $originalFProd = $poliza2[$i]['f_poliza'];
				            $newFProd = date("d/m/Y", strtotime($originalFProd));

                            if ($poliza2[$i]['currency']==1) {
                                $currency="$ ";
                            }else{$currency="Bs ";}


                            if ($poliza2[$i]['f_hastapoliza'] >= date("Y-m-d")) {
                            ?>
                            <tr style="cursor: pointer;">
                                <td style="color: #2B9E34;font-weight: bold"><?php echo $poliza2[$i]['cod_poliza']; ?></td>
                            <?php            
                            } else{
                            ?>
                            <tr style="cursor: pointer;">
                                <td style="color: #E54848;font-weight: bold"><?php echo $poliza2[$i]['cod_poliza']; ?></td>
                            <?php   
                            }

                            ?>
                                <td><?php echo utf8_encode($poliza2[$i]['nombre']); ?></td>
                                <td><?php echo utf8_encode($poliza2[$i]['nomcia']); ?></td>
                                <td><?php echo $newDesde; ?></td>
                                <td><?php echo $newHasta; ?></td>
                                <td><?php echo $currency.number_format($poliza2[$i]['prima'],2); ?></td>
                                <td nowrap><?php echo utf8_encode($poliza2[$i]['nombre_t']." ".$poliza2[$i]['apellido_t']); ?></td>
                            </tr>
                            <?php
                            }
                        }
                        ?>
                    </tbody>

                    <tfoot>
                        <tr>
                            <th>N° Póliza</th>
                            <th>Nombre Asesor</th>
                            <th>Cía</th>
                            <th>F Desde Seguro</th>
                            <th>F Hasta Seguro</th>
                            <th>Prima Suscrita $<?php echo number_format($totalprima,2); ?></th>
                            <th>Nombre Titular</th>
                        </tr>
                    </tfoot>
                </table>




                
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
    


    <script src="../assets/js/core/popper.min.js"></script>
    <script src="../assets/js/bootstrap-material-design.js"></script>
    <!--  Plugin for Date Time Picker and Full Calendar Plugin  -->
    <script src="../assets/js/plugins/moment.min.js"></script>
    <!--	Plugin for the Datepicker, full documentation here: https://github.com/Eonasdan/bootstrap-datetimepicker -->
    <script src="../assets/js/plugins/bootstrap-datetimepicker.min.js"></script>
    <!--	Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
    <script src="../assets/js/plugins/nouislider.min.js"></script>
    <!-- Material Kit Core initialisations of plugins and Bootstrap Material Design Library -->
    <script src="../assets/js/material-kit.js?v=2.0.1"></script>
    <!-- Fixed Sidebar Nav - js With initialisations For Demo Purpose, Don't Include it in your project -->
    <script src="../assets/assets-for-demo/js/material-kit-demo.js"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>

    <script src="../bootstrap-datepicker/js/bootstrap-datepicker.js"></script>  
    <script src="../bootstrap-datepicker/locales/bootstrap-datepicker.es.min.js" charset="UTF-8"></script>

   




    <script type="text/javascript">

        const tablaLoad1 = document.getElementById("tablaLoad1");
        const carga = document.getElementById("carga");

        setTimeout(()=>{
            carga.className = 'd-none';
            tablaLoad1.removeAttribute("hidden");
        }, 1500);
        
      

        $(document).ready(function() {
            $('#iddatatable').DataTable({
                scrollX: 300,
                "order": [[ 0, "desc" ]]
            });
        } );

        $(function () {
        $('[data-tooltip="tooltip"]').tooltip()
        });

        $( "#iddatatable tbody tr" ).click(function() {
            var customerId = $(this).find("td").eq(1).html();   

            window.open ("v_poliza.php?id_poliza="+customerId ,'_blank');
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