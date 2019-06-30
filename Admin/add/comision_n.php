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