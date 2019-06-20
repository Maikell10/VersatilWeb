<?php 
session_start();
if(isset($_SESSION['seudonimo'])) {

  }
    else {
        header("Location: login.php");
        exit();
      }
      
  require_once("../class/clases.php");


  $busq = $_GET['busq'];
  

  
  

  $obj1= new Trabajo();
  $poliza = $obj1->get_poliza_by_busq($busq); 



  $Ejecutivo[sizeof($poliza)]=null;

  for ($i=0; $i < sizeof($poliza); $i++) { 
        $obj111= new Trabajo();
        $asesor1 = $obj111->get_element_by_id('ena','cod',$poliza[$i]['codvend']);
        $nombre=$asesor1[0]['idnom'];

        if (sizeof($asesor1)==null) {
            $ob3= new Trabajo();
            $asesor1 = $ob3->get_element_by_id('enp','cod',$poliza[$i]['codvend']); 
            $nombre=$asesor1[0]['nombre'];
        }
    
        if (sizeof($asesor1)==null) {
            $ob3= new Trabajo();
            $asesor1 = $ob3->get_element_by_id('enr','cod',$poliza[$i]['codvend']); 
            $nombre=$asesor1[0]['nombre'];
        }

        $Ejecutivo[$i]=$nombre;                 
  }


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <!-- Favicons -->
    <link rel="apple-touch-icon" href="../assets/img/apple-icon.png">
    <link rel="icon" href="../assets/img/logo1.png">
    <title>
        Versatil Seguros
    </title>
    <link rel="stylesheet" type="text/css" href="../bootstrap-4.2.1/css/bootstrap.css">
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />
    <link rel="stylesheet" href="../assets/css/material-kit.css?v=2.0.1">
    <!-- Documentation extras -->
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="../assets/assets-for-demo/demo.css" rel="stylesheet" />
    <link href="../assets/assets-for-demo/vertical-nav.css" rel="stylesheet" />

    
    <!-- Alertify -->
    <link rel="stylesheet" type="text/css" href="../assets/alertify/css/alertify.css">
    <link rel="stylesheet" type="text/css" href="../assets/alertify/css/themes/bootstrap.css">
    <script src="../assets/alertify/alertify.js"></script>


    <!-- DataTables -->
    <link href="../DataTables/DataTables/css/dataTables.bootstrap4.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="../DataTables/DataTables/js/jquery.dataTables.min.js"></script>
    <script src="../DataTables/DataTables/js/dataTables.bootstrap4.min.js"></script>

    <link href="../bootstrap-datepicker/css/bootstrap-datepicker.css" rel="stylesheet">



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
                <a class="navbar-brand" href="sesionadmin.php"> <img src="../assets/img/logo1.png" width="40%" /></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                    <span class="navbar-toggler-icon"></span>
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ml-auto">
                    <li><b>[Producción]</b></li>
                    <li class="dropdown nav-item">
                        <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                            <i class="material-icons">plus_one</i> Cargar Datos
                        </a>
                        <div class="dropdown-menu dropdown-with-icons">
                            <a href="add/crear_poliza.php" class="dropdown-item">
                                <i class="material-icons">add_to_photos</i> Póliza
                            </a>
                            <a href="add/crear_comision.php" class="dropdown-item">
                                <i class="material-icons">add_to_photos</i> Comisión
                            </a>
                            <a href="add/crear_asesor.php" class="dropdown-item">
                                <i class="material-icons">person_add</i> Asesor
                            </a>
                            <a href="add/crear_compania.php" class="dropdown-item">
                                <i class="material-icons">markunread_mailbox</i> Compañía
                            </a>
                        </div>
                    </li>

                    <li class="dropdown nav-item">
                        <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                            <i class="material-icons">search</i> Buscar
                        </a>
                        <div class="dropdown-menu dropdown-with-icons">
                            <a href="b_asesor.php" class="dropdown-item">
                                <i class="material-icons">accessibility</i> Asesor
                            </a>
                            <a href="b_cliente.php" class="dropdown-item">
                                <i class="material-icons">accessibility</i> Cliente
                            </a>
                            <a href="b_poliza.php" class="dropdown-item">
                                <i class="material-icons">content_paste</i> Póliza
                            </a>
                            <a href="b_vehiculo.php" class="dropdown-item">
                                <i class="material-icons">commute</i> Vehículo
                            </a>
                            <a href="b_comp.php" class="dropdown-item">
                                <i class="material-icons">markunread_mailbox</i> Compañía
                            </a>
                            <a href="b_reportes.php" class="dropdown-item">
                                <i class="material-icons">library_books</i> Reportes de Cobranza
                            </a>
                        </div>
                    </li>

                    <li class="dropdown nav-item">
                        <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                            <i class="material-icons">trending_up</i> Gráficos
                        </a>
                        <div class="dropdown-menu dropdown-with-icons">
                            <a href="grafic/porcentaje.php" class="dropdown-item">
                                <i class="material-icons">pie_chart</i> Porcentajes
                            </a>
                            <a href="grafic/primas_s.php" class="dropdown-item">
                                <i class="material-icons">bar_chart</i> Primas Suscritas
                            </a>
                            <a href="grafic/primas_c.php" class="dropdown-item">
                                <i class="material-icons">thumb_up</i> Primas Cobradas
                            </a>
                            <a href="grafic/comisiones_c.php" class="dropdown-item">
                                <i class="material-icons">timeline</i> Comisiones Cobradas
                            </a>
                            <a href="#" class="dropdown-item">
                                <i class="material-icons">show_chart</i> Gestión de Cobranza
                            </a>
                        </div>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="../sys/cerrar_sesion.php" onclick="scrollToDownload()">
                            <i class="material-icons">eject</i> Cerrar Sesión
                        </a>
                    </li>
                   
                </ul>
            </div>
        </div>
    </nav>




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
                
                <?php
                if ($status == 1) {

                ?>

                <center>
                <div class="table-responsive">
                <table class="table table-hover table-striped table-bordered" id="iddatatable" >
                    <thead style="background-color: #00bcd4;color: white; font-weight: bold;">
                        <tr>
                            <th hidden>f_poliza</th>
                            <th hidden>id</th>
                            <th>N° Póliza</th>
                            <th>Status</th>
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
                        $f_hoy=date("Y-m-d");
                        $totalsuma=0;
                        $totalprima=0;
                        $currency="";
                        $cant=0;
                        for ($a=0; $a < sizeof($poliza); $a++) { 
                        
                        $obj111= new Trabajo();   
                        $polizat = $obj111->get_poliza_comision_by_id($poliza[$a]['id_poliza']); 
                       
                       

                            if ($polizat[0]['id_titular']==0) {
					
                            } else {
                            $cant=$cant+1;
                            $totalsuma=$totalsuma+$polizat[0]['sumaasegurada'];
                            $totalprima=$totalprima+$polizat[0]['prima'];

                            $originalDesde = $polizat[0]['f_desdepoliza'];
                            $newDesde = date("d/m/Y", strtotime($originalDesde));
                            $originalHasta = $polizat[0]['f_hastapoliza'];
                            $newHasta = date("d/m/Y", strtotime($originalHasta));
                            $originalFProd = $polizat[0]['f_poliza'];
				            $newFProd = date("d/m/Y", strtotime($originalFProd));

                            if ($polizat[0]['currency']==1) {
                                $currency="$ ";
                            }else{$currency="Bs ";}

                            
                            if ( ( $polizat[0]['f_pago_prima'] >= date("Y-m-d",strtotime($f_hoy."- 30 days")) ) || ( $polizat[0]['ncuotas']==1 ) ) {
                                
                            ?>
                            <tr style="cursor: pointer;">
                                <td hidden><?php echo $polizat[0]['f_poliza']; ?></td>
                                <td hidden><?php echo $polizat[0]['id_poliza']; ?></td>
                                <td style="color: #2B9E34;font-weight: bold"><?php echo $polizat[0]['cod_poliza']; ?></td>
                                <td style="color: #2B9E34;font-weight: bold">Activa</td>
                            <?php            
                            } if (( $polizat[0]['f_pago_prima'] >= date("Y-m-d",strtotime($f_hoy."- 60 days")) ) && ( $polizat[0]['f_pago_prima'] <= date("Y-m-d",strtotime($f_hoy."- 31 days")) ) && ( $polizat[0]['ncuotas']!=1 ) ) {
                                
                            ?>
                            <tr style="cursor: pointer;">
                                <td hidden><?php echo $polizat[0]['f_poliza']; ?></td>
                                <td hidden><?php echo $polizat[0]['id_poliza']; ?></td>
                                <td style="color: #D8DC03;font-weight: bold"><?php echo $polizat[0]['cod_poliza']; ?></td>
                                <td style="color: #D8DC03;font-weight: bold">Activa 30</td>
                            <?php
                            }
                            if (( $polizat[0]['f_pago_prima'] >= date("Y-m-d",strtotime($f_hoy."- 120 days")) ) && ( $polizat[0]['f_pago_prima'] <= date("Y-m-d",strtotime($f_hoy."- 61 days")) ) && ( $polizat[0]['ncuotas']!=1 ) ){
                            ?>
                            <tr style="cursor: pointer;">
                                <td hidden><?php echo $polizat[0]['f_poliza']; ?></td>
                                <td hidden><?php echo $polizat[0]['id_poliza']; ?></td>
                                <td style="color: #F27A02;font-weight: bold"><?php echo $polizat[0]['cod_poliza']; ?></td>
                                <td style="color: #F27A02;font-weight: bold">Activa 60</td>
                            <?php   
                            }if ( $polizat[0]['f_pago_prima'] <= date("Y-m-d",strtotime($f_hoy."- 121 days")) && ( $polizat[0]['ncuotas']!=1 ) ){
                            ?>
                            <tr style="cursor: pointer;">
                                <td hidden><?php echo $polizat[0]['f_poliza']; ?></td>
                                <td hidden><?php echo $polizat[0]['id_poliza']; ?></td>
                                <td style="color: red;font-weight: bold"><?php echo $polizat[0]['cod_poliza']; ?></td>
                                <td style="color: red;font-weight: bold">Inactiva</td>
                            <?php
                            }
                            ?>
                            
                                
                                <td><?php echo $Ejecutivo[$i]; ?></td>
                                <td><?php echo utf8_encode($polizat[0]['nomcia']); ?></td>
                                <td><?php echo $newDesde; ?></td>
                                <td><?php echo $newHasta; ?></td>
                                <td><?php echo $currency.number_format($polizat[0]['prima'],2); ?></td>
                                <td nowrap><?php echo utf8_encode($polizat[0]['nombre_t']." ".$polizat[0]['apellido_t']); ?></td>
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
                            <th>Status</th>
                            <th>Nombre Asesor</th>
                            <th>Cía</th>
                            <th>F Desde Seguro</th>
                            <th>F Hasta Seguro</th>
                            <th>Prima Suscrita $<?php echo number_format($totalprima,2); ?></th>
                            <th>Nombre Titular</th>
                        </tr>
                    </tfoot>
                </table></div>


                <h1 class="title">Total de Prima</h1>
                <h1 class="title text-danger">$ <?php  echo number_format($totalprima,2);?></h1>

                <h1 class="title">Total de Pólizas</h1>
                <h1 class="title text-danger"><?php  echo $cant;?></h1>
                </center>


                <?php
                    }
                

                if ($status == 2) {

                ?>
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
                            <th>Nombre Titular</th>
                        </tr>
                    </thead>
                    
                    <tbody >
                        <?php
                        $f_hoy=date("Y-m-d");
                        $totalsuma=0;
                        $totalprima=0;
                        $currency="";
                        $cant=0;
                        for ($a=0; $a < sizeof($poliza); $a++) { 
                        
                        $obj111= new Trabajo();   
                        $polizat = $obj111->get_poliza_comision_by_id($poliza[$a]['id_poliza']); 
                       
                       

                            if ($polizat[0]['id_titular']==0) {
					
                            } else {
                            $cant=$cant+1;
                            $totalsuma=$totalsuma+$polizat[0]['sumaasegurada'];
                            $totalprima=$totalprima+$polizat[0]['prima'];

                            $originalDesde = $polizat[0]['f_desdepoliza'];
                            $newDesde = date("d/m/Y", strtotime($originalDesde));
                            $originalHasta = $polizat[0]['f_hastapoliza'];
                            $newHasta = date("d/m/Y", strtotime($originalHasta));
                            $originalFProd = $polizat[0]['f_poliza'];
				            $newFProd = date("d/m/Y", strtotime($originalFProd));

                            if ($polizat[0]['currency']==1) {
                                $currency="$ ";
                            }else{$currency="Bs ";}

    
                            ?>
                            <tr style="cursor: pointer;">
                                <td hidden><?php echo $polizat[0]['f_poliza']; ?></td>
                                <td hidden><?php echo $polizat[0]['id_poliza']; ?></td>
                                <td style="color: #E54848;font-weight: bold"><?php echo $polizat[0]['cod_poliza']; ?></td>
                            
                                
                                <td><?php echo $Ejecutivo[$i]; ?></td>
                                <td><?php echo utf8_encode($polizat[0]['nomcia']); ?></td>
                                <td><?php echo $newDesde; ?></td>
                                <td><?php echo $newHasta; ?></td>
                                <td><?php echo $currency.number_format($polizat[0]['prima'],2); ?></td>
                                <td nowrap><?php echo utf8_encode($polizat[0]['nombre_t']." ".$polizat[0]['apellido_t']); ?></td>
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
                            <th>Nombre Titular</th>
                        </tr>
                    </tfoot>
                </table></div>


                <h1 class="title">Total de Prima</h1>
                <h1 class="title text-danger">$ <?php  echo number_format($totalprima,2);?></h1>

                <h1 class="title">Total de Pólizas</h1>
                <h1 class="title text-danger"><?php  echo $cant;?></h1>
                </center>


                <?php
                    }if ($status ==  null){
                ?>




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
                                <td hidden><?php echo $poliza[$i]['f_poliza']; ?></td>
                                <td hidden><?php echo $poliza[$i]['id_poliza']; ?></td>
                                <td style="color: #2B9E34;font-weight: bold"><?php echo $poliza[$i]['cod_poliza']; ?></td>
                            <?php            
                            } else{
                            ?>
                            <tr style="cursor: pointer;">
                                <td hidden><?php echo $poliza[$i]['f_poliza']; ?></td>
                                <td hidden><?php echo $poliza[$i]['id_poliza']; ?></td>
                                <td style="color: #E54848;font-weight: bold"><?php echo $poliza[$i]['cod_poliza']; ?></td>
                            <?php   
                            }

                            ?>
                            
                                
                                <td><?php echo $Ejecutivo[$i]; ?></td>
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
                            <th>Nombre Titular</th>
                        </tr>
                    </tfoot>
                </table></div>


                <h1 class="title">Total de Prima</h1>
                <h1 class="title text-danger">$ <?php  echo number_format($totalprima,2);?></h1>

                <h1 class="title">Total de Pólizas</h1>
                <h1 class="title text-danger"><?php  echo $cant;?></h1>
            </center>

            <?php
                }
            ?>


                
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