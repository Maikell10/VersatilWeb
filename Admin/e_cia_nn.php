<?php

session_start();
if(isset($_SESSION['seudonimo'])) {

  }
    else {
        header("Location: login.php");
        exit();
      }
      
  require_once("../class/clases.php");


  $id_cia=$_GET['id_cia'];


  $nombre_cia=$_GET['nombre_cia'];
  $rif=$_GET['rif'];

  $nombre1=$_GET['nombre1'];
  $cargo1=$_GET['cargo1'];
  $tel1=$_GET['tel1'];
  $cel1=$_GET['cel1'];
  $email1=$_GET['email1'];
  
  $nombre2=$_GET['nombre2'];
  $cargo2=$_GET['cargo2'];
  $tel2=$_GET['tel2'];
  $cel2=$_GET['cel2'];
  $email2=$_GET['email2'];

  $nombre3=$_GET['nombre3'];
  $cargo3=$_GET['cargo3'];
  $tel3=$_GET['tel3'];
  $cel3=$_GET['cel3'];
  $email3=$_GET['email3'];

  $nombre4=$_GET['nombre4'];
  $cargo4=$_GET['cargo4'];
  $tel4=$_GET['tel4'];
  $cel4=$_GET['cel4'];
  $email4=$_GET['email4'];

  $nombre5=$_GET['nombre5'];
  $cargo5=$_GET['cargo5'];
  $tel5=$_GET['tel5'];
  $cel5=$_GET['cel5'];
  $email5=$_GET['email5'];
	
	
	


	
	$obj1= new Trabajo();
    $cia = $obj1->editarCia($id_cia,$nombre_cia,$rif); 
      
    $obj2= new Trabajo();
    $e_cia = $obj2->eliminarCiaContacto($id_cia); 
      

    
    if ($nombre1!=null) {
        $ob1= new Trabajo();
        $contacto1 = $ob1->agregarContactoCia($id_cia,$nombre1,$cargo1,$tel1,$cel1,$email1);
    }
    if ($nombre2!=null) {
        $ob2= new Trabajo();
        $contacto2 = $ob2->agregarContactoCia($id_cia,$nombre2,$cargo2,$tel2,$cel2,$email2);
    }
    if ($nombre3!=null) {
        $ob3= new Trabajo();
        $contacto3 = $ob3->agregarContactoCia($id_cia,$nombre3,$cargo3,$tel3,$cel3,$email3);
    }
    if ($nombre4!=null) {
        $ob4= new Trabajo();
        $contacto4 = $ob4->agregarContactoCia($id_cia,$nombre4,$cargo4,$tel4,$cel4,$email4);
    }
    if ($nombre5!=null) {
        $ob5= new Trabajo();
        $contacto5 = $ob5->agregarContactoCia($id_cia,$nombre5,$cargo5,$tel5,$cel5,$email5);
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
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />
    <link rel="stylesheet" href="../assets/css/material-kit.css?v=2.0.1">
    <!-- Documentation extras -->
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="../assets/assets-for-demo/demo.css" rel="stylesheet" />
    <link href="../assets/assets-for-demo/vertical-nav.css" rel="stylesheet" />

    <link href="../bootstrap-datepicker/css/bootstrap-datepicker.css" rel="stylesheet">

    
    <!-- Alertify -->
    <link rel="stylesheet" type="text/css" href="../assets/alertify/css/alertify.css">
    <link rel="stylesheet" type="text/css" href="../assets/alertify/css/themes/bootstrap.css">
    <script src="../assets/alertify/alertify.js"></script>


    <!-- DataTables -->
    <link href="../DataTables/DataTables/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="../DataTables/DataTables/js/jquery.dataTables.min.js"></script>
    <script src="../DataTables/DataTables/js/dataTables.bootstrap4.min.js"></script>


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

        alertify.alert('Compañía Editada con Exito!', 'Compañía Editada Satisfactoriamente', 
        function(){ 
            alertify.success('Ok'); 
            window.close();
        });

	

	</script>
 


</body>

</html>