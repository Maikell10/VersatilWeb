<?php 
session_start();
if(isset($_SESSION['seudonimo'])) {

  }
    else {
        header("Location: login.php");
        exit();
      }
      
  require_once("../class/clases.php");
  


  $mes = $_GET['mes'];
  $desde=$_GET['anio']."-".$_GET['mes']."-01";
  $hasta=$_GET['anio']."-".$_GET['mes']."-31";

  if ($mes==null) {
      $mesD=1;
      $mesH=12;
      $desde=$_GET['anio']."-".$mesD."-01";
      $hasta=$_GET['anio']."-".$mesH."-31";
  }


  $anio = $_GET['anio'];
  if ($anio==null) {
    $obj11= new Trabajo();
    $fechaMin = $obj11->get_fecha_min('f_pago_gc','rep_com'); 
    $desde=$fechaMin[0]['MIN(f_pago_gc)'];
  
    $obj12= new Trabajo();
    $fechaMax = $obj12->get_fecha_max('f_pago_gc','rep_com'); 
    $hasta=$fechaMax[0]['MAX(f_pago_gc)'];
  }
  $cia = $_GET['cia'];
  if ($cia=='Seleccione Cía') {
    $cia=0;
  }

  

  $obj1= new Trabajo();
  $cia = $obj1->get_element_by_id('dcia','nomcia',$_GET['cia']); 


  $obj2= new Trabajo();
  $rep_com_busq = $obj2->get_rep_comision_por_busqueda($desde,$hasta,$cia[0]['idcia']); 

  


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
            <div class="container">
            <a href="javascript:history.back(-1);" data-tooltip="tooltip" data-placement="right" title="Ir la página anterior" class="btn btn-info btn-round"><- Regresar</a>

                <div class="col-md-auto col-md-offset-2" id="tablaLoad1" hidden="true">
                    <h1 class="title">Resultado de Búsqueda de Reporte de Comisiones</h1>  
                </div>

                <center><a  class="btn btn-success" onclick="tableToExcel('Exportar_a_Excel', 'Pólizas a Renovar por Asesor')" data-toggle="tooltip" data-placement="right" title="Exportar a Excel"><img src="../assets/img/excel.png" width="60" alt=""></a></center>
                
                
                <center>
                <div class="table-responsive">
                <table class="table table-hover table-striped table-bordered" id="iddatatable1">
                    <thead style="background-color: #00bcd4;color: white; font-weight: bold;">
                        <tr>
                            <th hidden="">ID</th>
                            <th hidden="">ID</th>
                            <th nowrap>Fecha Hasta Reporte</th>
                            <th >Prima Cobrada</th>
                            <th >Comisión Cobrada</th>
                            <th nowrap>Compañía</th>
                            <th nowrap>Fecha Pago de la GC</th>
                        </tr>
                    </thead>
                    
                    <tbody >
                        <?php
                        $totalPrimaCom=0;
                        $totalCom=0;
                        for ($i=0; $i < sizeof($rep_com_busq); $i++) { 
                            $obj2= new Trabajo();
                            $cia = $obj2->get_element_by_id('dcia','idcia',$rep_com_busq[$i]['id_cia']); 

                        
                            $prima=0;
                            $comi=0;
                            $obj4= new Trabajo();
                            $reporte_c = $obj4->get_element_by_id('comision','id_rep_com',$rep_com_busq[$i]['id_rep_com']);
                            
                            for ($a=0; $a < sizeof($reporte_c); $a++) { 

                                $prima=$prima+$reporte_c[$a]['prima_com'];
                                $comi=$comi+$reporte_c[$a]['comision'];
                                $totalPrimaCom=$totalPrimaCom+$reporte_c[$a]['prima_com'];
                                $totalCom=$totalCom+$reporte_c[$a]['comision'];
                                
                            }

                            $f_pago_gc = date("d-m-Y", strtotime($rep_com_busq[$i]['f_pago_gc']));
                            $f_hasta_rep = date("d-m-Y", strtotime($rep_com_busq[$i]['f_hasta_rep']));
                            
                            ?>
                            <tr style="cursor: pointer">
                                <td hidden=""><?php echo $rep_com_busq[$i]['f_hasta_rep']; ?></td>
                                <td hidden=""><?php echo $rep_com_busq[$i]['id_rep_com']; ?></td>
                                <td><?php echo $f_hasta_rep; ?></td>
                                <td align="right"><?php echo "$ ".number_format($prima,2); ?></td>
                                <td align="right"><?php echo "$ ".number_format($comi,2); ?></td>
                                <td nowrap><?php echo utf8_encode($cia[0]['nomcia']); ?></td>
                                <td><?php echo $f_pago_gc; ?></td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>

                    <tfoot>
                        <tr>
                            <th hidden="">ID</th>
                            <th hidden="">ID</th>
                            <th>Fecha Hasta Reporte</th>
                            <th>Prima Cobrada <?php echo "$ ".number_format($totalPrimaCom,2); ?></th>
                            <th>Comisión Cobrada <?php echo "$ ".number_format($totalCom,2); ?></th>
                            <th>Compañía</th>
                            <th>Fecha Pago de la GC</th>
                        </tr>
                    </tfoot>
                </table>
                </div>
            </center>

            <table class="table table-hover table-striped table-bordered table-responsive" id="Exportar_a_Excel" hidden>
                    <thead style="background-color: #00bcd4;color: white; font-weight: bold;">
                        <tr>
                            <th style="width:10%">Fecha Hasta Reporte</th>
                            <th style="width:20%">Prima Cobrada</th>
                            <th style="width:20%">Comisión Cobrada</th>
                            <th style="width:30%" nowrap>Compañía</th>
                            <th nowrap>Fecha Pago de la GC</th>
                        </tr>
                    </thead>
                    
                    <tbody >
                        <?php
                        $totalPrimaCom=0;
                        $totalCom=0;
                        for ($i=0; $i < sizeof($rep_com_busq); $i++) { 
                            $obj2= new Trabajo();
                            $cia = $obj2->get_element_by_id('dcia','idcia',$rep_com_busq[$i]['id_cia']); 

                        
                            $prima=0;
                            $comi=0;
                            $obj4= new Trabajo();
                            $reporte_c = $obj4->get_element_by_id('comision','id_rep_com',$rep_com_busq[$i]['id_rep_com']);
                            
                            for ($a=0; $a < sizeof($reporte_c); $a++) { 

                                $prima=$prima+$reporte_c[$a]['prima_com'];
                                $comi=$comi+$reporte_c[$a]['comision'];
                                $totalPrimaCom=$totalPrimaCom+$reporte_c[$a]['prima_com'];
                                $totalCom=$totalCom+$reporte_c[$a]['comision'];
                                
                            }

                            $f_pago_gc = date("d-m-Y", strtotime($rep_com_busq[$i]['f_pago_gc']));
                            $f_hasta_rep = date("d-m-Y", strtotime($rep_com_busq[$i]['f_hasta_rep']));
                            
                            ?>
                            <tr style="cursor: pointer">
                                <td><?php echo $f_hasta_rep; ?></td>
                                <td align="right"><?php echo "$ ".number_format($prima,2); ?></td>
                                <td align="right"><?php echo "$ ".number_format($comi,2); ?></td>
                                <td nowrap><?php echo utf8_encode($cia[0]['nomcia']); ?></td>
                                <td><?php echo $f_pago_gc; ?></td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>

                    <tfoot>
                        <tr>
                            <th>Fecha Hasta Reporte</th>
                            <th>Prima Cobrada <?php echo "$ ".number_format($totalPrimaCom,2); ?></th>
                            <th>Comisión Cobrada <?php echo "$ ".number_format($totalCom,2); ?></th>
                            <th>Compañía</th>
                            <th>Fecha Pago de la GC</th>
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
        }, 1000);
        
      
        $(document).ready(function() {
            $('#iddatatable1').DataTable({
                scrollX: 300,
                "order": [[ 0, "desc" ]]
                //"ordering": false
            });
        } );

      $( "#iddatatable1 tbody tr" ).click(function() {
        var customerId = $(this).find("td").eq(1).html();   

        window.open ("v_reporte_com.php?id_rep_com="+customerId ,'_blank');
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