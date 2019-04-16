<?php 
session_start();
if(isset($_SESSION['seudonimo'])) {

  }
    else {
        header("Location: login.php");
        exit();
      }
  
  require_once("../../class/clases.php");



  $f_desde=$_GET['f_desde'];
  $f_hasta=$_GET['f_hasta'];
  $f_pagoGc=$_GET['f_pagoGc'];
  $id_rep=$_GET['id_rep'];

  $i=0;
  $_GET['n_poliza'.$i];
  $nom_titu0=$_GET['nom_titu0'];
  $f_pago0=$_GET['f_pago0'];
  $prima=$_GET['prima0'];
  $comision=$_GET['comision0'];
  $asesor0=$_GET['asesor0'];
  $codasesor0=$_GET['codasesor0'];


  $idcia=$_GET['cia'];
  $cant_poliza=$_GET['cant_poliza'];


  $obj1= new Trabajo();
  $cia = $obj1->get_element_by_id('dcia','idcia',$idcia); 

  $historial=0;
  if ($id_rep==0) {

  }else{
    $historial=1;
    $obj2= new Trabajo();
    $historialC = $obj2->get_element_by_id('comision','id_rep_com',$id_rep); 
  }




?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <!-- Favicons -->
    <link rel="apple-touch-icon" href="../../assets/img/apple-icon.png">
    <link rel="icon" href="../../assets/img/logo1.png">
    <title>
        Versatil Seguros
    </title>
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />
    <link rel="stylesheet" href="../../assets/css/material-kit.css?v=2.0.1">
    <!-- Documentation extras -->
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="../../assets/assets-for-demo/demo.css" rel="stylesheet" />
    <link href="../../assets/assets-for-demo/vertical-nav.css" rel="stylesheet" />

    <link href="../../bootstrap-datepicker/css/bootstrap-datepicker.css" rel="stylesheet">

    
    <!-- Alertify -->
    <link rel="stylesheet" type="text/css" href="../../assets/alertify/css/alertify.css">
    <link rel="stylesheet" type="text/css" href="../../assets/alertify/css/themes/bootstrap.css">
    <script src="../../assets/alertify/alertify.js"></script>


    <!-- DataTables -->
    <link href="../../DataTables/DataTables/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="../../DataTables/DataTables/js/jquery.dataTables.min.js"></script>
    <script src="../../DataTables/DataTables/js/dataTables.bootstrap4.min.js"></script>


</head>

<body class="profile-page ">
    <nav class="navbar navbar-color-on-scroll navbar-transparent    fixed-top  navbar-expand-lg bg-info" color-on-scroll="100" id="sectionsNav">
        <div class="container">
            <div class="navbar-translate">
                <a class="navbar-brand" href="../sesionadmin.php"> <img src="../../assets/img/logo1.png" width="45%" /></a>
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
                            <a href="crear_poliza.php" class="dropdown-item">
                                <i class="material-icons">add_to_photos</i> Póliza
                            </a>
                            <a href="crear_comision.php" class="dropdown-item">
                                <i class="material-icons">add_to_photos</i> Comisión
                            </a>
                            <a href="crear_asesor.php" class="dropdown-item">
                                <i class="material-icons">person_add</i> Asesor
                            </a>
                            <a href="crear_compania.php" class="dropdown-item">
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
            <div class="container" >
                <center>
                <div class="col-md-auto col-md-offset-2">
                    <h1 class="title"><i class="fa fa-info-circle" aria-hidden="true"></i>&nbsp;Vista Previa de la Carga para la Compañía: <?php echo $cia[0]['nomcia'];?>
                    </h1>  
                </div>

                <br/><br/>


                <h2 id="existeRep" class="text-success"><strong></strong></h2>
                <h2 id="no_existeRep" class="text-danger"><strong></strong></h2>

                <form class="form-horizontal" id="frmnuevo" method="get" action="comision_n.php" autocomplete="off">
                    <div class="form-row">
                            <table class="table table-hover table-striped table-bordered display table-responsive nowrap" id="iddatatable" >
                            <thead style="background-color: #92ACC4;color: white; font-weight: bold;">
                                <tr>
                                    <th colspan="2">Fecha Desde *</th>
                                    <th colspan="3">Fecha Hasta *</th>
                                    <th colspan="2">Fecha Pago GC *</th>
                                    <th hidden>id reporte</th>
                                    <th hidden>cia</th>
                                    <th hidden>cant_poliza</th>
                                </tr>
                            </thead>
                                <tr style="background-color: white">
                                    <td colspan="2"><input type="text" class="form-control" id="f_desde" name="f_desde" value="<?php echo $f_desde;?>" readonly></td>
                                    <td colspan="3"><input type="text" class="form-control" id="f_hasta" name="f_hasta" value="<?php echo $f_hasta;?>" readonly></td>
                                    <td colspan="2"><input type="text" class="form-control" id="f_pagoGc" name="f_pagoGc" value="<?php echo $f_pagoGc;?>" readonly></td>
                                   
                                    <td hidden><input type="text" class="form-control" id="id_rep" name="id_rep" value="<?php echo $id_rep;?>"></td>
                                    <td hidden><input type="text" class="form-control" id="cia" name="cia" value="<?php echo $idcia;?>"></td>
                                    <td hidden><input type="text" class="form-control" id="cant_poliza" name="cant_poliza" value="<?php echo $cant_poliza;?>"></td>
                                </tr>
                                <tr style="background-color: #92ACC4;color: white; font-weight: bold;">
                                    <th>N° de Póliza *</th>
                                    <th>Nombre Titular</th>
                                    <th>Fecha de Pago de la Prima *</th>
                                    <th>Prima Sujeta a Comisión *</th>
                                    <th>Comisión *</th>
                                    <th>% Comisión</th>
                                    <th>Asesor - Ejecutivo</th>
                                    <th hidden>Cod Asesor - Ejecutivo</th>
                                    <th hidden>id_poliza</th>
                                </tr>
                            <?php
                                $totalPrima=0;
                                $totalComision=0;
                                if ($historial==1) {

                                    for ($i=0; $i < sizeof($historialC); $i++) { 
                                        $obj3= new Trabajo();
                                        $cliente = $obj3->get_poliza_by_num($historialC[$i]['num_poliza']);
                                        $totalPrima=$totalPrima+$historialC[$i]['prima_com'];
                                        $totalComision=$totalComision+$historialC[$i]['comision'];

                                        $obj4= new Trabajo();
                                        $asesor = $obj4->get_element_by_id('ena','cod',$historialC[$i]['cod_vend']);
                                        $nombrea=$asesor[0]['idnom'];
                            ?>
                                <tr>
                                    <td><?php echo $historialC[$i]['num_poliza'];?></td>
                                    <td><?php echo $cliente[0]['nombre_t']." ".$cliente[0]['apellido_t'];?></td>
                                    <td><?php echo $historialC[$i]['f_pago_prima'];?></td>
                                    <td style="background-color: #E54848;color: white" align="right"><?php echo number_format($historialC[$i]['prima_com'],2);?></td>
                                    <td align="right"><?php echo number_format($historialC[$i]['comision'],2);?></td>
                                    <td style="text-align: center;"><?php echo number_format(($historialC[$i]['comision']*100)/$historialC[$i]['prima_com'],2)." %";?></td>
                                    <td><?php echo $nombrea;?></td>
                                    <th hidden>id_poliza</th>
                                    <th hidden>id_poliza</th>
                                </tr>
                            <?php
                                    }
                                }
                                for ($i=0; $i < $cant_poliza ; $i++) { 
                                    $totalPrima=$totalPrima+$_GET['prima'.$i];
                                    $totalComision=$totalComision+$_GET['comision'.$i];
                            ?>
                                <tr style="background-color: #92ACC4;">
                                    <td colspan="7"></td>
                                </tr>
                            <tbody >
                                <tr style="background-color: white">
                                    <td><input type="text" class="form-control" id="<?php echo 'n_poliza'.$i;?>" name="<?php echo 'n_poliza'.$i;?>" value="<?php echo $_GET['n_poliza'.$i];?>" readonly></td>
                                    <td><input type="text" class="form-control" id="<?php echo 'nom_titu'.$i;?>" name="<?php echo 'nom_titu'.$i;?>" value="<?php echo $_GET['nom_titu'.$i];?>" readonly></td>
                                    <td><input type="text" class="form-control" id="<?php echo 'f_pago'.$i;?>" name="<?php echo 'f_pago'.$i;?>" value="<?php echo $_GET['f_pago'.$i];?>" readonly></td>
                                    <td style="background-color: #E54848"><input style="background-color: #E54848;color: white;text-align: right" type="text" class="form-control" id="<?php echo 'prima'.$i;?>" name="<?php echo 'prima'.$i;?>" value="<?php echo number_format($_GET['prima'.$i],2);?>" readonly></td>
                                    <td><input type="text" class="form-control" id="<?php echo 'comision'.$i;?>" name="<?php echo 'comision'.$i;?>" value="<?php echo number_format($_GET['comision'.$i],2);?>" readonly style="text-align: right"></td>
                                    <td><input style="text-align: center;" type="text" class="form-control" id="<?php echo 'comisionPor'.$i;?>" name="<?php echo 'comisionPor'.$i;?>" value="<?php echo $_GET['comisionPor'.$i];?>" readonly></td>
                                    <td><input type="text" class="form-control" id="<?php echo 'asesor'.$i;?>" name="<?php echo 'asesor'.$i;?>" value="<?php echo $_GET['asesor'.$i];?>" readonly></td>
                                    
                                     

                                    <td hidden><input type="text" class="form-control" id="<?php echo 'codasesor'.$i;?>" name="<?php echo 'codasesor'.$i;?>" value="<?php echo $_GET['codasesor'.$i];?>"></td>

                                    <td hidden><input type="text" class="form-control" id="<?php echo 'id_poliza'.$i;?>" name="<?php echo 'id_poliza'.$i;?>" value="<?php echo $_GET['id_poliza'.$i];?>"></td>
                                </tr>
                                
                            
                            <?php
                            }
                                ?>
                                <tr style="background-color: #92ACC4;color: white; font-weight: bold;">
                                    <td colspan="3">Total</td>
                                    <td align="right"><?php echo number_format($totalPrima,2);?></td>
                                    <td align="right"><?php echo number_format($totalComision,2);?></td>
                                    <td colspan="2"></td>
                                </tr>
                            </tbody>
                        </table>

                        
                    </div>
                    
                    
                    <button type="submit" id="btnForm" class="btn btn-info btn-lg btn-round">Confirmar</button>
                </form>
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

    <script src="../../bootstrap-datepicker/js/bootstrap-datepicker.js"></script>  
    <script src="../../bootstrap-datepicker/locales/bootstrap-datepicker.es.min.js" charset="UTF-8"></script>

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