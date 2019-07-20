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

        alertify.alert('Compañía Editada con Exito!', 'Compañía Editada Satisfactoriamente', 
        function(){ 
            alertify.success('Ok'); 
            window.close();
        });

	

	</script>
 


</body>

</html>