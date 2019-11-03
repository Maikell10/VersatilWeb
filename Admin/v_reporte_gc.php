<?php 
session_start();
if(isset($_SESSION['seudonimo'])) {

  }
    else {
        header("Location: login.php");
        exit();
      }
  
  require_once("../class/clases.php");

  $_GET["id_rep_gc"];
  


  $obj1= new Trabajo();
  $distinct_a = $obj1->get_a_reporte_gc_h($_GET["id_rep_gc"]); 


  //Ordeno los ejecutivos de menor a mayor alfabéticamente
  $Ejecutivo[sizeof($distinct_a)]=null;
  $codEj[sizeof($distinct_a)]=null;

  for ($i=0; $i < sizeof($distinct_a); $i++) { 
        $obj111= new Trabajo();
        $asesor1 = $obj111->get_element_by_id('ena','cod',$distinct_a[$i]['cod_vend']);
        $nombre=$asesor1[0]['idnom'];

        if (sizeof($asesor1)==null) {
            $ob3= new Trabajo();
            $asesor1 = $ob3->get_element_by_id('enp','cod',$distinct_a[$i]['cod_vend']); 
            $nombre=$asesor1[0]['nombre'];
        }
    
        if (sizeof($asesor1)==null) {
            $ob3= new Trabajo();
            $asesor1 = $ob3->get_element_by_id('enr','cod',$distinct_a[$i]['cod_vend']); 
            $nombre=$asesor1[0]['nombre'];
        }

        $Ejecutivo[$i]=$nombre;
        $codEj[$i]=$distinct_a[$i]['cod_vend'];                   
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
 
 
        <div class="section">
            <div class="container-fluid">
            <a href="javascript:history.back(-1);" data-tooltip="tooltip" data-placement="right" title="Ir la página anterior" class="btn btn-info btn-round"><- Regresar</a>
                
                <div class="col-md-auto col-md-offset-2" id="tablaLoad1">
                    <h1 class="title">Resultado de Búsqueda de GC Pagada por Asesor</h1>  
                    <h2>N° GC Generada: <font style="font-weight:bold"><?php echo $_GET['id_rep_gc']; ?></font></h2>
                </div>

    
                <center><a  class="btn btn-success" onclick="tableToExcel('Exportar_a_Excel', 'GC Pagada por Asesor')" data-toggle="tooltip" data-placement="right" title="Exportar a Excel"><img src="../assets/img/excel.png" width="60" alt=""></a></center>
                
                
                <div class="form-group">
                    <input type="text" class="form-control pull-right" style="width:20%" id="search" placeholder="Escriba para buscar">
                </div>
                <center>

                <table class="table table-hover table-striped table-bordered display table-responsive" id="mytable" style="cursor: pointer;">
                    <thead style="background-color: #00bcd4;color: white; font-weight: bold;">
                        <tr>
                            <th>Asesor</th>
                            <th>N° Póliza</th>
                            <th>Nombre Titular</th>
                            <th>Cía</th>
                            <th>Prima Cobrada</th>
                            <th>F Prima Cobrada</th>
                            <th>Comisión Cobrada</th>
                            <th>% Com</th>
                            <th>GC Pagada</th>
                            <th>%GC Asesor</th>
                            <th hidden>id</th>
                        </tr>
                    </thead>
                    
                    <tbody >
                        <?php
                        $totalsuma=0;
                        $totalprima=0;
                        $currency="";
                        $totalpoliza=0;

                        $totalprimacomT=0;
                        $totalcomisionT=0;
                        $totalgcT=0;

                        for ($a=1; $a <= sizeof($distinct_a); $a++) { 
                            
                            
                           
                            $totalprimacom=0;
                            $totalcomision=0;
                            $totalgc=0;
                            
                            $ob3= new Trabajo();
                            $asesor = $ob3->get_element_by_id('ena','cod',$codEj[$x[$a]]); 
                            $nombre=$asesor[0]['idnom'];

                            if (sizeof($asesor)==null) {
                                $ob3= new Trabajo();
                                $asesor = $ob3->get_element_by_id('enr','cod',$codEj[$x[$a]]); 
                                $nombre=$asesor[0]['nombre'];
                            }
                        
                            if (sizeof($asesor)==null) {
                                $ob3= new Trabajo();
                                $asesor = $ob3->get_element_by_id('enp','cod',$codEj[$x[$a]]); 
                                $nombre=$asesor[0]['nombre'];
                            }
                            
                            $obj2= new Trabajo();
                            $poliza = $obj2->get_reporte_gc_h($_GET['id_rep_gc'],$codEj[$x[$a]]);
                            
                            

                        ?>
                            <tr>
                                <?php 
                                if ($asesor[0]['act']==0) {
                                ?>
                                <td rowspan="<?php echo sizeof($poliza); ?>" style="background-color: #D9D9D9;font-weight: bold" class="text-danger"><?php echo $nombre; ?></td>
                                <?php
                                }if ($asesor[0]['act']==1) {
                                ?>
                                <td rowspan="<?php echo sizeof($poliza); ?>" style="background-color: #D9D9D9;font-weight: bold" class="text-success"><?php echo $nombre; ?></td>
                                <?php
                                }
                                ?>

                        <?php

                        for ($i=0; $i < sizeof($poliza); $i++) { 

                            $totalsuma=$totalsuma+$poliza[$i]['sumaasegurada'];
                            $totalprima=$totalprima+$poliza[$i]['prima'];

                            $totalprimacom=$totalprimacom+$poliza[$i]['prima_com'];
                            $totalcomision=$totalcomision+$poliza[$i]['comision'];
                            $totalgc=$totalgc+(($poliza[$i]['comision']*$poliza[$i]['per_gc'])/100);

                            $totalprimacomT=$totalprimacomT+$poliza[$i]['prima_com'];
                            $totalcomisionT=$totalcomisionT+$poliza[$i]['comision'];
                            $totalgcT=$totalgcT+(($poliza[$i]['comision']*$poliza[$i]['per_gc'])/100);

                            $originalDesde = $poliza[$i]['f_desdepoliza'];
                            $newDesde = date("d/m/Y", strtotime($originalDesde));
                            $originalHasta = $poliza[$i]['f_hastapoliza'];
                            $newHasta = date("d/m/Y", strtotime($originalHasta));

                            if ($poliza[$i]['currency']==1) {
                                $currency="$ ";
                            }else{$currency="Bs ";}

                            if ($poliza[$i]['id_titular']==0) {
                                $ob22= new Trabajo();
                                $titular_pre = $ob22->get_element_by_id('titular_pre_poliza','id_poliza',$poliza[$i]['id_poliza']);
                                $nombretitu=$titular_pre[0]['asegurado'];
                            } else {
                                $nombretitu=$poliza[$i]['nombre_t']." ".$poliza[$i]['apellido_t'];
                            }
                            


                            if ($poliza[$i]['f_hastapoliza'] >= date("Y-m-d")) {
                            ?>
                                <td style="color: #2B9E34"><?php echo $poliza[$i]['cod_poliza']; ?></td>
                            <?php            
                            } else{
                            ?>
                                <td style="color: #E54848"><?php echo $poliza[$i]['cod_poliza']; ?></td>
                            <?php   
                            }

                            $originalFPagoP = $poliza[$i]['f_pago_prima'];
                            $newFPagoP = date("d/m/Y", strtotime($originalFPagoP));

                            ?>
                            
                                <td><?php echo utf8_encode($nombretitu); ?></td>
                                <td nowrap><?php echo $poliza[$i]['nomcia']; ?></td>
                                <td align="right"><?php echo "$ ".number_format($poliza[$i]['prima_com'],2); ?></td>
                                <td nowrap><?php echo $newFPagoP; ?></td>
                                <td align="right"><?php echo "$ ".number_format($poliza[$i]['comision'],2); ?></td>
                                <td align="center"><?php echo number_format(($poliza[$i]['comision']*100)/$poliza[$i]['prima_com'],0)." %"; ?></td>
                                <td align="right" style="background-color: #ED7D31;color:white"><?php echo "$ ".number_format(($poliza[$i]['comision']*$poliza[$i]['per_gc'])/100,2); ?></td>
                                <td nowrap align="center"><?php echo number_format($poliza[$i]['per_gc'],0)." %"; ?></td>
                                <td hidden><?php echo $poliza[$i]['id_poliza']; ?></td>
                            </tr>
                            <?php

                            }
                            $total_per_com=($totalcomision*100)/$totalprimacom;
                            if (number_format($totalprimacom,2)==0.00 ) {
                                $totalprimacom=0;
                                $total_per_com=0;
                            }
                            if ($totalcomision==0) {
                                $totalcomision=1;
                            }
                            ?>
                            <tr class="no-tocar">
                                <td colspan="4" style="background-color: #F53333;color: white;font-weight: bold">Total de <?php echo $nombre; ?>: <font size=4 color="aqua"><?php echo sizeof($poliza); ?></font></td>
                                <td align="right" style="background-color: #F53333;color: white;font-weight: bold"><font size=4><?php echo "$ ".$totalprimacom; ?></font></td>
                                <td style="background-color: #F53333;color: white;font-weight: bold"></td>
                                <td align="right" style="background-color: #F53333;color: white;font-weight: bold"><font size=4><?php echo "$ ".$totalcomision; ?></font></td>

                                <td nowrap align="center" style="background-color: #F53333;color: white;font-weight: bold"><font size=4><?php echo number_format($total_per_com,0)." %"; ?></font></td>

                                <td align="right" style="background-color: #F53333;color: white;font-weight: bold"><font size=4><?php echo "$ ".number_format($totalgc,2); ?></font></td>

                                <td nowrap align="center" style="background-color: #F53333;color: white;font-weight: bold"><font size=4><?php echo number_format(($totalgc*100)/$totalcomision,0)." %"; ?></font></td>
                            </tr>
                        <?php
                        $totalpoliza=$totalpoliza+sizeof($poliza);
                        }
                        ?>
                        <tr class="no-tocar">
                            <td style="background-color:#2FA4E7;color:white;font-weight: bold" colspan="4">Total General</td>

                            <td align="right" style="background-color: #2FA4E7;color: white;font-weight: bold"><font size=4><?php echo "$ ".number_format($totalprimacomT,2); ?></font></td>
                            <td style="background-color:#2FA4E7;color:white;font-weight: bold"></td>
                            <td align="right" style="background-color: #2FA4E7;color: white;font-weight: bold"><font size=4><?php echo "$ ".number_format($totalcomisionT,2); ?></font></td>

                            <td nowrap align="center" style="background-color: #2FA4E7;color: white;font-weight: bold"><font size=4><?php echo number_format(($totalcomisionT*100)/$totalprimacomT,2)." %"; ?></font></td>

                            <td align="right" style="background-color: #2FA4E7;color: white;font-weight: bold"><font size=4><?php echo "$ ".number_format($totalgcT,2); ?></font></td>

                            <td nowrap align="center" style="background-color: #2FA4E7;color: white;font-weight: bold"><font size=4><?php echo number_format(($totalgcT*100)/$totalcomisionT,2)." %"; ?></font></td>
                        </tr>
                    </tbody>


                    <tfoot>
                        <tr>
                            <th>Asesor</th>
                            <th>N° Póliza</th>
                            <th>Nombre Titular</th>
                            <th>Cía</th>
                            <th>Prima Cobrada</th>
                            <th>F Prima Cobrada</th>
                            <th>Comisión Cobrada</th>
                            <th>% Com</th>
                            <th>GC Pagada</th>
                            <th>%GC Asesor</th>
                            <th hidden>id</th>
                        </tr>
                    </tfoot>
                </table>


                <table class="table table-hover table-striped table-bordered display table-responsive" id="Exportar_a_Excel" style="cursor: pointer;" hidden>

                    <thead style="background-color: #00bcd4;color: white; font-weight: bold;">
                        <tr>
                            <th>Asesor</th>
                            <th>Ramo</th>
                            <th>N° Póliza</th>
                            <th>F Hasta Seguro</th>
                            <th>Nombre Titular</th>
                            <th>Cía</th>
                            <th>Prima Cobrada</th>
                            <th>F Prima</th>
                            <th>Comisión Cobrada</th>
                            <th>% Com</th>
                            <th>F Rep Com</th>
                            <th>GC Pagada</th>
                            <th>%GC Asesor</th>
                            <th>Cant</th>
                        </tr>
                    </thead>
                    
                    <tbody >
                        <?php
                        $totalsuma=0;
                        $totalprima=0;
                        $currency="";
                        $totalpoliza=0;

                        $totalprimacomT=0;
                        $totalcomisionT=0;
                        $totalgcT=0;

                        for ($a=1; $a <= sizeof($distinct_a); $a++) { 
                           
                            $totalprimacom=0;
                            $totalcomision=0;
                            $totalgc=0;
                            
                            $ob3= new Trabajo();
                            $asesor = $ob3->get_element_by_id('ena','cod',$codEj[$x[$a]]); 
                            $nombre=$asesor[0]['idnom'];

                            if (sizeof($asesor)==null) {
                                $ob3= new Trabajo();
                                $asesor = $ob3->get_element_by_id('enr','cod',$codEj[$x[$a]]); 
                                $nombre=$asesor[0]['nombre'];
                            }
                        
                            if (sizeof($asesor)==null) {
                                $ob3= new Trabajo();
                                $asesor = $ob3->get_element_by_id('enp','cod',$codEj[$x[$a]]); 
                                $nombre=$asesor[0]['nombre'];
                            }
                            
                            

                            $obj2= new Trabajo();
                            $poliza = $obj2->get_reporte_gc_h($_GET['id_rep_gc'],$codEj[$x[$a]]);
                            
                            


                        ?>
                            <tr>
                                <?php 
                                if ($asesor[0]['act']==0) {
                                ?>
                                <td rowspan="<?php echo sizeof($poliza); ?>" style="background-color: #D9D9D9;font-weight: bold" class="text-danger"><?php echo $nombre; ?></td>
                                <?php
                                }if ($asesor[0]['act']==1) {
                                ?>
                                <td rowspan="<?php echo sizeof($poliza); ?>" style="background-color: #D9D9D9;font-weight: bold" class="text-success"><?php echo $nombre; ?></td>
                                <?php
                                }
                                ?>

                        <?php

                        for ($i=0; $i < sizeof($poliza); $i++) { 
                            $totalsuma=$totalsuma+$poliza[$i]['sumaasegurada'];
                            $totalprima=$totalprima+$poliza[$i]['prima'];

                            $totalprimacom=$totalprimacom+$poliza[$i]['prima_com'];
                            $totalcomision=$totalcomision+$poliza[$i]['comision'];
                            $totalgc=$totalgc+(($poliza[$i]['comision']*$poliza[$i]['per_gc'])/100);

                            $totalprimacomT=$totalprimacomT+$poliza[$i]['prima_com'];
                            $totalcomisionT=$totalcomisionT+$poliza[$i]['comision'];
                            $totalgcT=$totalgcT+(($poliza[$i]['comision']*$poliza[$i]['per_gc'])/100);

                            $originalDesde = $poliza[$i]['f_desdepoliza'];
                            $newDesde = date("d/m/Y", strtotime($originalDesde));
                            $originalHasta = $poliza[$i]['f_hastapoliza'];
                            $newHasta = date("d/m/Y", strtotime($originalHasta));

                            if ($poliza[$i]['currency']==1) {
                                $currency="$ ";
                            }else{$currency="Bs ";}

                            if ($poliza[$i]['id_titular']==0) {
                                $ob22= new Trabajo();
                                $titular_pre = $ob22->get_element_by_id('titular_pre_poliza','id_poliza',$poliza[$i]['id_poliza']);
                                $nombretitu=$titular_pre[0]['asegurado'];
                            } else {
                                $nombretitu=$poliza[$i]['nombre_t']." ".$poliza[$i]['apellido_t'];
                            }
                            


                            if ($poliza[$i]['f_hastapoliza'] >= date("Y-m-d")) {
                            ?>
                                <td><?php echo utf8_encode($poliza[$i]['nramo']); ?></td>
                                <td style="color: #2B9E34;font-weight: bold"><?php echo $poliza[$i]['cod_poliza']; ?></td>
                            <?php            
                            } else{
                            ?>
                                <td><?php echo utf8_encode($poliza[$i]['nramo']); ?></td>
                                <td style="color: #E54848;font-weight: bold"><?php echo $poliza[$i]['cod_poliza']; ?></td>
                            <?php   
                            }

                            $originalFHasta = $poliza[$i]['f_hastapoliza'];
                            $newFHasta = date("d/m/Y", strtotime($originalFHasta));

                            $originalFPagoP = $poliza[$i]['f_pago_prima'];
                            $newFPagoP = date("d/m/Y", strtotime($originalFPagoP));

                            $originalFRepC = $poliza[$i]['f_hasta_rep'];
                            $newFRepC = date("d/m/Y", strtotime($originalFRepC));

                            ?>
                                
                                <td nowrap><?php echo $newFHasta; ?></td>
                                <td><?php echo utf8_encode($nombretitu); ?></td>
                                <td nowrap><?php echo ($poliza[$i]['nomcia']); ?></td>
                                <td align="right"><?php echo "$ ".number_format($poliza[$i]['prima_com'],2); ?></td>
                                <td nowrap><?php echo $newFPagoP; ?></td>
                                <td align="right"><?php echo "$ ".number_format($poliza[$i]['comision'],2); ?></td>
                                <td align="center"><?php echo number_format(($poliza[$i]['comision']*100)/$poliza[$i]['prima_com'],0)." %"; ?></td>
                                <td nowrap><?php echo $newFRepC; ?></td>
                                <td align="right" style="background-color: #ED7D31;color:white"><?php echo "$ ".number_format(($poliza[$i]['comision']*$poliza[$i]['per_gc'])/100,2); ?></td>
                                <td nowrap align="center"><?php echo number_format($poliza[$i]['per_gc'],0)." %"; ?></td>
                                <td nowrap align="center">1</td>
                            </tr>
                            <?php
                            }
                            $total_per_com=($totalcomision*100)/$totalprimacom;
                            if (number_format($totalprimacom,2)==0.00 ) {
                                $totalprimacom=0;
                                $total_per_com=0;
                            }
                            if ($totalcomision==0) {
                                $totalcomision=1;
                            }
                            ?>
                            <tr>
                                <td colspan="6" style="background-color: #F53333;color: white;font-weight: bold">Total de <?php echo $nombre; ?>: <font size=4 color="aqua"><?php echo sizeof($poliza); ?></font></td>
                                <td align="right" style="background-color: #F53333;color: white;font-weight: bold"><font size=4><?php echo "$ ".number_format($totalprimacom,2); ?></font></td>

                                <td align="right" style="background-color: #F53333;color: white;font-weight: bold"></td>

                                <td align="right" style="background-color: #F53333;color: white;font-weight: bold"><font size=4><?php echo "$ ".number_format($totalcomision,2); ?></font></td>

                                <td nowrap align="center" style="background-color: #F53333;color: white;font-weight: bold"><font size=4><?php echo number_format($total_per_com,0)." %"; ?></font></td>

                                <td align="right" style="background-color: #F53333;color: white;font-weight: bold"></td>

                                <td align="right" style="background-color: #F53333;color: white;font-weight: bold"><font size=4><?php echo "$ ".number_format($totalgc,2); ?></font></td>

                                <td nowrap align="center" style="background-color: #F53333;color: white;font-weight: bold"><font size=4><?php echo number_format(($totalgc*100)/$totalcomision,0)." %"; ?></font></td>

                                <td align="right" style="background-color: #F53333;color: white;font-weight: bold"><?php echo sizeof($poliza); ?></td>
                            </tr>
                        <?php
                        $totalpoliza=$totalpoliza+sizeof($poliza);
                        }
                        ?>
                        <tr>
                            <td style="background-color:#2FA4E7;color:white;font-weight: bold" colspan="6">Total General</td>

                            <td align="right" style="background-color: #2FA4E7;color: white;font-weight: bold"><font size=4><?php echo "$ ".number_format($totalprimacomT,2); ?></font></td>
                            <td align="right" style="background-color: #2FA4E7;color: white;font-weight: bold"> </td>
                            <td align="right" style="background-color: #2FA4E7;color: white;font-weight: bold"><font size=4><?php echo "$ ".number_format($totalcomisionT,2); ?></font></td>

                            <td nowrap align="center" style="background-color: #2FA4E7;color: white;font-weight: bold"><font size=4><?php echo number_format(($totalcomisionT*100)/$totalprimacomT,2)." %"; ?></font></td>

                            <td align="right" style="background-color: #2FA4E7;color: white;font-weight: bold"> </td>

                            <td align="right" style="background-color: #2FA4E7;color: white;font-weight: bold"><font size=4><?php echo "$ ".number_format($totalgcT,2); ?></font></td>

                            <td nowrap align="center" style="background-color: #2FA4E7;color: white;font-weight: bold"><font size=4><?php echo number_format(($totalgcT*100)/$totalcomisionT,2)." %"; ?></font></td>

                            <td align="right" style="background-color: #2FA4E7;color: white;font-weight: bold"><?php echo $totalpoliza; ?></td>
                        </tr>
                    </tbody>


                    <tfoot>
                        <tr>
                            <th>Asesor</th>
                            <th>Ramo</th>
                            <th>N° Póliza</th>
                            <th>F Hasta Seguro</th>
                            <th>Nombre Titular</th>
                            <th>Cía</th>
                            <th>Prima Cobrada</th>
                            <th>F Prima</th>
                            <th>Comisión Cobrada</th>
                            <th>% Com</th>
                            <th>F Rep Com</th>
                            <th>GC Pagada</th>
                            <th>%GC Asesor</th>
                            <th>Cant</th>
                        </tr>
                    </tfoot>
                </table>


                


                <h1 class="title">Total de Prima</h1>
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


    <script>
        $( "#mytable tbody tr" ).click(function() {


            if ($(this).attr('class') != 'no-tocar') {
                var customerId = $(this).find("td").eq(10).html();  

                if (customerId == null) {
                    var customerId = $(this).find("td").eq(9).html();  
                } 

                window.open ("v_poliza.php?id_poliza="+customerId ,'_blank');
            }

            
        });
    </script>

 


</body>

</html>