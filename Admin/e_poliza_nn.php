<?php

session_start();
if(isset($_SESSION['seudonimo'])) {

  }
    else {
        header("Location: ../sys/login.php");
        exit();
      }
      
  require_once("../class/clases.php");

  

    $id_poliza=$_GET['id_poliza'];
    $ob= new Trabajo();
    $poliza_f = $ob->get_element_by_id('poliza','id_poliza',$id_poliza);


	$n_poliza=$_GET['n_poliza'];
	$fhoy=$poliza_f[0]['f_poliza'];
    //$femisionP=$_GET['emisionP'];
    //$femisionP = date("Y-m-d", strtotime($femisionP));
    $femisionP=$poliza_f[0]['f_emi'];
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
    $asesor_ind=$_GET['per_gc'];
    if ($per_gc==null) {
        $per_gc=0;
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

    
    $obs_p=$_GET['obs_p'];



    $per_gc_antigo=$poliza_f[0]['per_gc'];

    $campos=$_GET['campos'];
    if ($per_gc_antigo!=$asesor_ind) {
        $campos=$campos.'%GC. ';
    }


    $forma_pago=$_GET['forma_pago'];
    $n_tarjeta=$_GET['n_tarjeta'];
    $cvv=$_GET['cvv'];
    $fechaV=$_GET['fechaV'];
    $fechaVP = date("Y-m-d", strtotime($fechaV));
    $titular_tarjeta=$_GET['titular_tarjeta'];
    $bancoT=$_GET['bancoT'];

    $id_tarjeta = $_GET['id_tarjeta'];
    $n_tarjeta_h=$_GET['n_tarjeta_h'];

    //Editar la tarjeta si la forma de pago es por tarjeta
    if ($forma_pago==2) {

        if ($_GET['alert']==1) {
            $obj4= new Trabajo();
            $tarjeta = $obj4->agregarTarjeta($n_tarjeta,$cvv,$fechaVP,$titular_tarjeta,$bancoT); 
            
            $ob10= new Trabajo();
            $id_tarjeta = $ob10->get_last_element('tarjeta','id_tarjeta');

            $id_tarjeta = $id_tarjeta[0]['id_tarjeta'];
        }

        if ($_GET['alert']==0) {

            if ($_GET['condTar']==0) {
                if ($_GET['id_tarjeta']!=0) {
                    $ob10= new Trabajo();
                    $id_tarjeta = $ob10->get_element_by_id('tarjeta','id_tarjeta',$_GET['id_tarjeta']);
                    $id_tarjeta = $id_tarjeta[0]['id_tarjeta'];
                }
            }

            if ($_GET['condTar']==1) {
                $obj4= new Trabajo();
                $tarjeta = $obj4->agregarTarjeta($n_tarjeta,$cvv,$fechaVP,$titular_tarjeta,$bancoT); 
                
                $ob10= new Trabajo();
                $id_tarjeta = $ob10->get_last_element('tarjeta','id_tarjeta');
    
                $id_tarjeta = $id_tarjeta[0]['id_tarjeta'];
            }
        }

    }

    

	$obj1= new Trabajo();
    $poliza = $obj1->editarPoliza($id_poliza,$n_poliza,$fhoy,$t_cobertura,$fdesdeP,$fhastaP,$currency,$tipo_poliza,$sumaA,$z_produc,$codasesor,$ramo,$cia,$idtitular[0]['id_titular'],$idtomador[0]['id_titular'],$asesor_ind,$t_cuenta,$obs_p); 
      
    if ($forma_pago!=2) {
        $obj= new Trabajo();
        $recibo = $obj->editarRecibo($id_poliza,$n_recibo,$fdesde_recibo,$fhasta_recibo,$prima,$f_pago,$n_cuotas,$monto_cuotas,$idtomador[0]['id_titular'],$idtitular[0]['id_titular'],$n_poliza,$forma_pago,'no'); 
    }
    else {
        $obj= new Trabajo();
        $recibo = $obj->editarRecibo($id_poliza,$n_recibo,$fdesde_recibo,$fhasta_recibo,$prima,$f_pago,$n_cuotas,$monto_cuotas,$idtomador[0]['id_titular'],$idtitular[0]['id_titular'],$n_poliza,$forma_pago,$id_tarjeta); 
    }

  	
      
    $obj11= new Trabajo();
    $vehiculo = $obj11->editarVehiculo($id_poliza,$placa,$tipo,$marca,$modelo,$anio,$serial,$color,$categoria,$n_recibo); 
      
    $obj111= new Trabajo();
  	$asesorCom = $obj111->editarAsesorCom($id_poliza,$codasesor); 

  	$tipo_poliza_print="";
  	if ($tipo_poliza==1) {
  		$tipo_poliza_print="Primer Año";
    }
      
    //$campos=$_GET['campos'];
    if ($campos!='') {
        $obj1111= new Trabajo();
  	    $editP = $obj1111->agregarEditP($id_poliza,$campos,$_SESSION['seudonimo']); 
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
            <div class="container" >
                
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
                    document.write(new Date().getFullYear());
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

    <script src="../bootstrap-datepicker/js/bootstrap-datepicker.js"></script>  
    <script src="../bootstrap-datepicker/locales/bootstrap-datepicker.es.min.js" charset="UTF-8"></script>

    <script>


	 

	   alertify.alert('Póliza Editada con Exito!', 'Póliza Editada Satisfactoriamente', 
        function(){ 
            alertify.success('Ok'); 
            window.close();
        });

	</script>
 


</body>

</html>