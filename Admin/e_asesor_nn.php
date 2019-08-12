<?php

session_start();
if(isset($_SESSION['seudonimo'])) {

  }
    else {
        header("Location: login.php");
        exit();
      }
      
  require_once("../class/clases.php");


    $id_asesor=$_GET['id_asesor'];
    $a=$_GET['a'];

    $id=$_GET['id'];
    $nombre=$_GET['nombre'];
	$cel=$_GET['cel'];
	$email=$_GET['email'];
    $banco=$_GET['banco'];
    $tipo_cuenta=$_GET['tipo_cuenta'];
    $num_cuenta=$_GET['num_cuenta'];
    $obs=$_GET['obs'];
    $act=$_GET['act'];
	
    $nopre1=$_GET['nopre1'];
    $gc_viajes=$_GET['gc_viajes'];
	

    if ($nopre1!=null) {
        $obj1= new Trabajo();
        $asesor = $obj1->editarAsesorA($id_asesor,$id,$nombre,$cel,$email,$banco,$tipo_cuenta,$num_cuenta,$obs,$act,$nopre1,$gc_viajes); 
    }

    if ($nopre1==null) {
        $obj1= new Trabajo();
        $asesor = $obj1->editarAsesor($id_asesor,$a,$id,$nombre,$cel,$email,$banco,$tipo_cuenta,$num_cuenta,$obs,$act); 
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

        alertify.alert('Asesor Editado con Exito!', 'Asesor Editado Satisfactoriamente', 
        function(){ 
            alertify.success('Ok'); 
            window.close();
        });

	

	</script>
 


</body>

</html>