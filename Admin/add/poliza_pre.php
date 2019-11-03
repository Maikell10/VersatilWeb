<?php

session_start();
if(isset($_SESSION['seudonimo'])) {

  }
    else {
        header("Location: login.php");
        exit();
      }
      
  require_once("../../class/clases.php");




    $n_poliza=$_POST['n_poliza'];
    $idcia=$_GET['cia'];

    $z_produc=$usuario[0]['z_produccion'];
    if ($z_produc=="PANAMÁ") {
		$z_produc=1;
    }else{$z_produc=2;}
    
	$codasesor='AP-1';
	
	$titular=0;
	$tomador=0;
	

	$ob100= new Trabajo();
  $usuario = $ob100->get_element_by_id('usuarios','seudonimo',$_SESSION['seudonimo']);

                  
	$obj1= new Trabajo();
  	$poliza = $obj1->agregarPoliza($n_poliza,'','','N/A','','',1,1,0,$z_produc,$codasesor,0,$idcia,$titular,$tomador,0,1,$usuario[0]['id_usuario'],''); 

  	$obj= new Trabajo();
    $recibo = $obj->agregarRecibo($n_poliza,'','',0,'CONTADO',1,0,$tomador,$titular,$n_poliza,1,0); 
    
    $obj2= new Trabajo();
  	$vehiculo = $obj2->agregarVehiculo('-','-','-','-',
    '-','-','-','-',$n_poliza); 




?>
<!DOCTYPE html>
<html lang="en">

<head>
  <?php require('header.php');?>
</head>

<body class="profile-page ">
    

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


        alertify.alert('Exito!', 'Póliza Cargada con Exito!', function(){ 
            alertify.success('Ok'); 
            window.close();
        });


	</script>

 


</body>

</html>