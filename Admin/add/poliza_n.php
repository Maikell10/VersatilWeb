<?php

session_start();
if(isset($_SESSION['seudonimo'])) {

  }
    else {
        header("Location: login.php");
        exit();
      }
      
  require_once("../../class/clases.php");

  $ob100= new Trabajo();
  $usuario = $ob100->get_element_by_id('usuarios','seudonimo',$_SESSION['seudonimo']);


	$n_poliza=$_GET['n_poliza'];
	$fhoy=$_GET['fhoy'];
    //$femisionP=$_GET['emisionP'];
    //$femisionP = date("Y-m-d", strtotime($femisionP));
    $femisionP=$_GET['fhoy'];
	$t_cobertura=$_GET['t_cobertura'];
	$fdesdeP=$_GET['desdeP'];
    $fhastaP=$_GET['hastaP'];
    $fdesdeP = date("Y-m-d", strtotime($fdesdeP));
    $fhastaP = date("Y-m-d", strtotime($fhastaP));    
	$currency=$_GET['currency'];
	$tipo_poliza=$_GET['tipo_poliza'];
	$sumaA=$_GET['sumaA'];
	$z_produc=$_GET['z_produc'];
	if ($z_produc=="PANAMÁ") {
		$z_produc=1;
	}else{$z_produc=2;}
	$codasesor=$_GET['asesor'];
	$ramo=$_GET['ramo'];
	$cia=$_GET['cia'];
	$titular=$_GET['titular'];
    $tomador=$_GET['tomador'];
    $t_cuenta=$_GET['t_cuenta'];
    $asesor_ind=$_GET['asesor_ind'];
    if ($asesor_ind==null) {
        $asesor_ind=0;
    }
	
	
	$n_recibo=$_GET['n_recibo'];
	$fdesde_recibo=$_GET['desde_recibo'];
    $fhasta_recibo=$_GET['hasta_recibo'];
    $fdesde_recibo = date("Y-m-d", strtotime($fdesde_recibo));    
    $fhasta_recibo = date("Y-m-d", strtotime($fhasta_recibo));    
	$prima=$_GET['prima'];
	$f_pago=$_GET['f_pago'];

	$n_cuotas=$_GET['n_cuotas'];
	$monto_cuotas=$_GET['monto_cuotas'];

	
	$tomador=$_GET['tomador'];
	$titular=$_GET['titular'];

	$obj3= new Trabajo();
  	$idtomador = $obj3->get_id_cliente($tomador); 

  	$obj4= new Trabajo();
    $idtitular = $obj4->get_id_cliente($titular); 
      

    $placa=$_GET['placa'];
    $tipo=$_GET['tipo'];
    $marca=$_GET['marca'];
    $modelo=$_GET['modelo'];
    $anio=$_GET['anio'];
    $color=$_GET['color'];
    $serial=$_GET['serial'];
    $categoria=$_GET['categoria'];

    if ($placa==null) {
        $placa='-';
        $tipo='-';
        $marca='-';
        $modelo='-';
        $anio='-';
        $color='-';
        $serial='-';
        $categoria='-';
    }

	
	$obj1= new Trabajo();
  	$poliza = $obj1->agregarPoliza($n_poliza,$fhoy,$femisionP,$t_cobertura,$fdesdeP,$fhastaP,$currency,$tipo_poliza,$sumaA,$z_produc,$codasesor,$ramo,$cia,$idtitular[0]['id_titular'],$idtomador[0]['id_titular'],$asesor_ind,$t_cuenta,$usuario[0]['id_usuario']); 

  	$obj= new Trabajo();
    $recibo = $obj->agregarRecibo($n_recibo,$fdesde_recibo,$fhasta_recibo,$prima,$f_pago,$n_cuotas,$monto_cuotas,$idtomador[0]['id_titular'],$idtitular[0]['id_titular'],$n_poliza); 
      
    $obj11= new Trabajo();
  	$vehiculo = $obj11->agregarVehiculo($placa,$tipo,$marca,$modelo,$anio,$serial,$color,$categoria,$n_recibo); 

  	$tipo_poliza_print="";
  	if ($tipo_poliza==1) {
  		$tipo_poliza_print="Primer Año";
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
                    <li><b>[Producción]</b></li>
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

    <script>


	  alertify.confirm('Póliza Cargada con Exito!', '¿Desea Cargar una nueva Póliza?', 
	  	function(){ 
	  		window.location.replace("crear_poliza.php?cond=1");
	  		alertify.success('Ok') 
	  	}, 
	  	function(){ 
	  		window.location.replace("../sesionadmin.php");
	  		alertify.error('Cancel')
	  	}).set('labels', {ok:'Sí', cancel:'No'}).set({transition:'zoom'}).show(); 

	

	</script>
 


</body>

</html>