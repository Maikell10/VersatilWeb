<?php 
session_start();
if(isset($_SESSION['seudonimo'])) {

  }
    else {
        header("Location: login.php");
        exit();
      }
  
  require_once("../../class/clases.php");

  if (isset($_GET["cia"])!=null) {
    $cia=$_GET["cia"]; 
  }else{$cia='';}

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
    $fechaMin = $obj11->get_fecha_min('f_pago_gc','rep_com'); 
    $desde=$fechaMin[0]['MIN(f_pago_gc)'];
  
    $obj12= new Trabajo();
    $fechaMax = $obj12->get_fecha_max('f_pago_gc','rep_com'); 
    $hasta=$fechaMax[0]['MAX(f_pago_gc)'];
  }

  //$cia = $_GET['cia'];


  $obj1= new Trabajo();
  $distinct_a = $obj1->get_gc_by_filtro_distinct_a($desde,$hasta,$cia,$asesor); 


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




    $asesorB=$asesor; 
    

    $asesor_para_enviar_via_url = serialize($asesor);
    $asesorEnv = urlencode($asesor_para_enviar_via_url);

    $cia_para_enviar_via_url = serialize($cia);
    $ciaEnv = urlencode($cia_para_enviar_via_url);




    //recorremos el array de asesor seleccionado
    for ($i=0;$i<count($asesorB);$i++)    
    {     
    //echo "<br>"  . $asesorB[$i];    
    }



?>
<!DOCTYPE html>
<html lang="en">

<head>
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
    <nav class="navbar navbar-color-on-scroll navbar-transparent    fixed-top  navbar-expand-lg bg-info" color-on-scroll="100" id="sectionsNav">
        <div class="container">
            <div class="navbar-translate">
                <a class="navbar-brand" href="../sesionadmin.php"> <img src="../../assets/img/logo1.png" width="40%" /></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                    <span class="navbar-toggler-icon"></span>
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ml-auto">
                    <li><b>[Administración]</b></li>
                    <li class="dropdown nav-item">
                        <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                            <i class="material-icons">plus_one</i> Cargar Datos
                        </a>
                        <div class="dropdown-menu dropdown-with-icons">
                            <a href="../add/crear_poliza.php" class="dropdown-item">
                                <i class="material-icons">add_to_photos</i> Póliza
                            </a>
                            <a href="../add/crear_comision.php" class="dropdown-item">
                                <i class="material-icons">add_to_photos</i> Comisión
                            </a>
                            <a href="../add/crear_asesor.php" class="dropdown-item">
                                <i class="material-icons">person_add</i> Asesor
                            </a>
                            <a href="../add/crear_compania.php" class="dropdown-item">
                                <i class="material-icons">markunread_mailbox</i> Compañía
                            </a>
                        </div>
                    </li>

                    <li class="dropdown nav-item">
                        <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                            <i class="material-icons">search</i> Buscar
                        </a>
                        <div class="dropdown-menu dropdown-with-icons">
                            <a href="../b_asesor.php" class="dropdown-item">
                                <i class="material-icons">accessibility</i> Asesor
                            </a>
                            <a href="../b_cliente.php" class="dropdown-item">
                                <i class="material-icons">accessibility</i> Cliente
                            </a>
                            <a href="../b_poliza.php" class="dropdown-item">
                                <i class="material-icons">content_paste</i> Póliza
                            </a>
                            <a href="../b_vehiculo.php" class="dropdown-item">
                                <i class="material-icons">commute</i> Vehículo
                            </a>
                            <a href="../b_comp.php" class="dropdown-item">
                                <i class="material-icons">markunread_mailbox</i> Compañía
                            </a>
                            <a href="../b_reportes.php" class="dropdown-item">
                                <i class="material-icons">library_books</i> Reportes de Cobranza
                            </a>
                        </div>
                    </li>

                    <li class="dropdown nav-item">
                        <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                            <i class="material-icons">trending_up</i> Gráficos
                        </a>
                        <div class="dropdown-menu dropdown-with-icons">
                            <a href="../grafic/porcentaje.php" class="dropdown-item">
                                <i class="material-icons">pie_chart</i> Porcentajes
                            </a>
                            <a href="../grafic/primas_s.php" class="dropdown-item">
                                <i class="material-icons">bar_chart</i> Primas Suscritas
                            </a>
                            <a href="../grafic/primas_c.php" class="dropdown-item">
                                <i class="material-icons">thumb_up</i> Primas Cobradas
                            </a>
                            <a href="../grafic/comisiones_c.php" class="dropdown-item">
                                <i class="material-icons">timeline</i> Comisiones Cobradas
                            </a>
                            <a href="#" class="dropdown-item">
                                <i class="material-icons">show_chart</i> Gestión de Cobranza
                            </a>
                        </div>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="../../sys/cerrar_sesion.php" onclick="scrollToDownload()">
                            <i class="material-icons">eject</i> Cerrar Sesión
                        </a>
                    </li>
                   
                </ul>
            </div>
        </div>
    </nav>




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
                    <h1 class="title">Resultado de Búsqueda de GC a Pagar por Asesor</h1>  
                    <h2>Año: <font style="font-weight:bold"><?php echo $_GET['anio']; 
                        if ($_GET['mes']==null) {
                        }else{
                    ?></font>
                        Mes: <font style="font-weight:bold"><?php echo $mes_arr[$_GET['mes']-1]; } ?></font></h2>
                </div>

                <center><a onclick="generarR()" class="btn btn-info btn-lg" data-toggle="tooltip" data-placement="right" title="Generar Reporte para la Búsqueda Actual" style="color:white">Generar</a></center>
    
                <center><a  class="btn btn-success" onclick="tableToExcel('Exportar_a_Excel', 'GC a Pagar por Asesor')" data-toggle="tooltip" data-placement="right" title="Exportar a Excel"><img src="../../assets/img/excel.png" width="60" alt=""></a></center>
                
                <br><br>
                <!--
                <div class="form-group">
                    <input type="text" class="form-control pull-right" style="width:20%" id="search" placeholder="Escriba para buscar">
                </div>
                -->
                <center>

                <table class="table table-hover table-striped table-bordered display table-responsive" id="mytable" style="cursor: pointer;">
                    <thead style="background-color: #00bcd4;color: white; font-weight: bold;">
                        <tr>
                            <th>Asesor</th>
                            <th>N° Póliza</th>
                            <th>Nombre Titular</th>
                            <th>Cía</th>
                            <th>Prima Cobrada</th>
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
                            $poliza = $obj2->get_gc_by_filtro_by_a($desde,$hasta,$cia,$codEj[$x[$a]]);
                            
                            

                        ?>
                            <tr>
                                <td rowspan="<?php echo sizeof($poliza); ?>" style="background-color: #D9D9D9"><?php echo $nombre; ?></td>

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
                                <td style="color: #2B9E34;font-weight: bold"><?php echo $poliza[$i]['cod_poliza']; ?></td>
                            <?php            
                            } else{
                            ?>
                                <td style="color: #E54848;font-weight: bold"><?php echo $poliza[$i]['cod_poliza']; ?></td>
                            <?php   
                            }

                            ?>
                            
                                <td><?php echo utf8_encode($nombretitu); ?></td>
                                <td nowrap><?php echo $poliza[$i]['nomcia']; ?></td>
                                <td align="right"><?php echo "$ ".number_format($poliza[$i]['prima_com'],2); ?></td>
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
                            <td style="background-color:red;color:white;font-weight: bold" colspan="4">Total General</td>

                            <td align="right" style="background-color: red;color: white;font-weight: bold"><font size=4><?php echo "$ ".number_format($totalprimacomT,2); ?></font></td>
                            <td align="right" style="background-color: red;color: white;font-weight: bold"><font size=4><?php echo "$ ".number_format($totalcomisionT,2); ?></font></td>

                            <td nowrap align="center" style="background-color: red;color: white;font-weight: bold"><font size=4><?php echo number_format(($totalcomisionT*100)/$totalprimacomT,2)." %"; ?></font></td>

                            <td align="right" style="background-color: red;color: white;font-weight: bold"><font size=4><?php echo "$ ".number_format($totalgcT,2); ?></font></td>

                            <td nowrap align="center" style="background-color: red;color: white;font-weight: bold"><font size=4><?php echo number_format(($totalgcT*100)/$totalcomisionT,2)." %"; ?></font></td>
                        </tr>
                    </tbody>


                    <tfoot>
                        <tr>
                            <th>Asesor</th>
                            <th>N° Póliza</th>
                            <th>Nombre Titular</th>
                            <th>Cía</th>
                            <th>Prima Cobrada</th>
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
                            $poliza = $obj2->get_gc_by_filtro_by_a($desde,$hasta,$cia,$codEj[$x[$a]]);
                            
                            


                        ?>
                            <tr>
                                <td rowspan="<?php echo sizeof($poliza); ?>" style="background-color: #D9D9D9"><?php echo utf8_encode($nombre); ?></td>

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
                                <td nowrap><?php echo utf8_encode($poliza[$i]['nomcia']); ?></td>
                                <td align="right"><?php echo "$ ".number_format($poliza[$i]['prima_com'],2); ?></td>
                                <td nowrap><?php echo $newFPagoP; ?></td>
                                <td align="right"><?php echo "$ ".number_format($poliza[$i]['comision'],2); ?></td>
                                <td align="center"><?php echo number_format(($poliza[$i]['comision']*100)/$poliza[$i]['prima_com'],0)." %"; ?></td>
                                <td nowrap><?php echo $newFRepC; ?></td>
                                <td align="right" style="background-color: #E54848;color:white"><?php echo "$ ".number_format(($poliza[$i]['comision']*$poliza[$i]['per_gc'])/100,2); ?></td>
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
                            <td style="background-color:red;color:white;font-weight: bold" colspan="6">Total General</td>

                            <td align="right" style="background-color: red;color: white;font-weight: bold"><font size=4><?php echo "$ ".number_format($totalprimacomT,2); ?></font></td>
                            <td align="right" style="background-color: red;color: white;font-weight: bold"> </td>
                            <td align="right" style="background-color: red;color: white;font-weight: bold"><font size=4><?php echo "$ ".number_format($totalcomisionT,2); ?></font></td>

                            <td nowrap align="center" style="background-color: red;color: white;font-weight: bold"><font size=4><?php echo number_format(($totalcomisionT*100)/$totalprimacomT,2)." %"; ?></font></td>

                            <td align="right" style="background-color: red;color: white;font-weight: bold"> </td>

                            <td align="right" style="background-color: red;color: white;font-weight: bold"><font size=4><?php echo "$ ".number_format($totalgcT,2); ?></font></td>

                            <td nowrap align="center" style="background-color: red;color: white;font-weight: bold"><font size=4><?php echo number_format(($totalgcT*100)/$totalcomisionT,2)." %"; ?></font></td>

                            <td align="right" style="background-color: red;color: white;font-weight: bold"><?php echo $totalpoliza; ?></td>
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
        function generarR(){

            alertify.confirm('!!', '¿Desea Generar la GC para la búsqueda actual?', 
                function(){ 
                    window.location.replace("../../procesos/agregarGC.php?desde=<?php echo $desde;?>&hasta=<?php echo $hasta;?>&cia=<?php echo $ciaEnv;?>&asesor=<?php echo $asesorEnv;?>");
                    
                    




                }, 
                function(){ 
                    alertify.error('Cancelada')
                }).set('labels', {ok:'Sí', cancel:'No'}).set({transition:'zoom'}).show();
        }

        $( "#mytable tbody tr" ).click(function() {

            if ($(this).attr('class') != 'no-tocar') {
                var customerId = $(this).find("td").eq(9).html();  

                if (customerId == null) {
                    var customerId = $(this).find("td").eq(8).html();  
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