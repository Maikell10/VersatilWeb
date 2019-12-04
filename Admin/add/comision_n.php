<?php

session_start();
if(isset($_SESSION['seudonimo'])) {

  }
    else {
        header("Location: login.php");
        exit();
      }
      
  require_once("../../class/clases.php");


  $id_rep=$_GET['id_rep'];
  $fhastaP=$_GET['f_hasta'];
  $f_pagoGcP=$_GET['f_pagoGc']; 
  $fhasta = date("Y-m-d", strtotime($fhastaP)); 
  $f_pagoGc = date("Y-m-d", strtotime($f_pagoGcP)); 
  $idcia=$_GET['cia'];
  $cant_poliza=$_GET['cant_poliza'];

  $prima_comt=$_GET['primat_comt'];
  $comt=$_GET['comtt'];



  if ($id_rep==0) {

      $obj1= new Trabajo();
      $rep_com = $obj1->agregarRepCom($fhasta,$f_pagoGc,$idcia,$prima_comt,$comt); 

      $obj2= new Trabajo();
      $rep_comU = $obj2->get_last_element('rep_com','id_rep_com'); 

      for ($i=0; $i < $cant_poliza; $i++) { 
          
        $f_pago = date("Y-m-d", strtotime($_GET['f_pago'.$i]));

        if ($_GET['id_poliza'.$i]=='0') {
            $ob= new Trabajo();
            $id_poliza_u = $ob->get__last_poliza_by_id($_GET['n_poliza'.$i]); 

            $obj= new Trabajo();
            $comision = $obj->agregarCom($rep_comU[0]['id_rep_com'],$_GET['n_poliza'.$i],$_GET['codasesor'.$i],$f_pago,$_GET['prima'.$i],$_GET['comision'.$i],$id_poliza_u[0]['id_poliza']); 

        } else {
            $obj= new Trabajo();
            $comision = $obj->agregarCom($rep_comU[0]['id_rep_com'],$_GET['n_poliza'.$i],$_GET['codasesor'.$i],$f_pago,$_GET['prima'.$i],$_GET['comision'.$i],$_GET['id_poliza'.$i]); 
        }
        

      }
  }else{

    for ($i=0; $i < $cant_poliza; $i++) { 

        $f_pago = date("Y-m-d", strtotime($_GET['f_pago'.$i]));

        if ($_GET['id_poliza'.$i]=='0') {
            $ob= new Trabajo();
            $id_poliza_u = $ob->get__last_poliza_by_id($_GET['n_poliza'.$i]); 

            $obj= new Trabajo();
            $comision = $obj->agregarCom($id_rep,$_GET['n_poliza'.$i],$_GET['codasesor'.$i],$f_pago,$_GET['prima'.$i],$_GET['comision'.$i],$id_poliza_u[0]['id_poliza']); 

        } else {
            $obj= new Trabajo();
            $comision = $obj->agregarCom($id_rep,$_GET['n_poliza'.$i],$_GET['codasesor'.$i],$f_pago,$_GET['prima'.$i],$_GET['comision'.$i],$_GET['id_poliza'.$i]); 
        }

      }

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


	  alertify.confirm('Reporte de Comisiones Cargado con Exito!', '¿Desea Cargar un nuevo Reporte?', 
	  	function(){ 
	  		window.location.replace("crear_comision.php?cond=1");
	  		alertify.success('Ok') 
	  	}, 
	  	function(){ 
	  		window.location.replace("../sesionadmin.php");
	  		alertify.error('Cancel')
	  	}).set('labels', {ok:'Sí', cancel:'No'}).set({transition:'zoom'}).show(); ;

	

	</script>
 


</body>

</html>