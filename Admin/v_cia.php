<?php 
session_start();
if(isset($_SESSION['seudonimo'])) {

  }
    else {
        header("Location: login.php");
        exit();
      }
      
  require_once("../class/clases.php");

  $id_cia = $_GET['id_cia'];

  $obj1= new Trabajo();
  $cia = $obj1->get_element_by_id('dcia','idcia',$id_cia); 

  
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
            <div class="container">

                <div class="col-md-auto col-md-offset-2">
                    <h1 class="title">Cía: <?php echo utf8_encode($cia[0]['nomcia']); ?></h1>  
                    <h2 class="title">Rif: <?php echo $cia[0]['rif']; ?></h2>  
                </div>


                

                <div class="table-responsive">
                <table class="table table-hover table-striped table-bordered" id="" >
                    <thead>
						<tr style="background-color: #00bcd4;color: white; font-weight: bold;">
							<th>Nombre Compañía</th>
                            <th>Rif</th>
						</tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td ><?php echo utf8_encode($cia[0]['nomcia']); ?></td>
                            <td ><?php echo $cia[0]['rif']; ?></td>
                        </tr>
                    </tbody>
                </table>
                </div>

                <div class="table-responsive">
                <table class="table table-hover table-striped table-bordered" id="" >
                    <thead>
						<tr style="background-color: #00bcd4;color: white; font-weight: bold;">
							<th>Nombre Contacto</th>
                            <th>Cargo</th>
                            <th>Tel</th>
                            <th>Cel</th>
                            <th>E-Mail</th>
						</tr>
                    </thead>
                    <tbody>
                        <?php 
                            $obj11= new Trabajo();
                            $contacto_cia = $obj11->get_element_by_id('contacto_cia','id_cia',$cia[0]['idcia']); 

                            for ($i=0; $i < sizeof($contacto_cia); $i++) { 
                           
                        ?>
                        <tr>
                            <td ><?php echo $contacto_cia[$i]['nombre']; ?></td>
                            <td ><?php echo utf8_encode($contacto_cia[$i]['cargo']); ?></td>
                            <td ><?php echo $contacto_cia[$i]['tel']; ?></td>
                            <td ><?php echo $contacto_cia[$i]['cel']; ?></td>
                            <td ><?php echo $contacto_cia[$i]['email']; ?></td>
                        </tr>
                        <?php
                            }
                        ?>
                    </tbody>
                </table>
                </div>

                <hr>

                <center><a  href="e_cia.php?id_cia=<?php echo $cia[0]['idcia'];?>" data-tooltip="tooltip" data-placement="top" title="Editar" class="btn btn-success btn-lg text-center">Editar Cía  &nbsp;<i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></center>
                        
                <hr>
                
                <?php
                //Si es preferencial
                
                $obj2= new Trabajo();
                $desde_pref = $obj2->get_f_cia_pref('f_desde_pref',$cia[0]['idcia']);
                
                $obj3= new Trabajo();
				$hasta_pref = $obj3->get_f_cia_pref('f_hasta_pref',$cia[0]['idcia']);

                
                if ($desde_pref[0]['f_desde_pref']==0) {
                    //No es preferencial
                } else {
                    //Si es preferencial
                

                ?>
                <div class="col-md-auto col-md-offset-2">  
                    <h2 class="title">Fechas en que es preferencial (Mayor a Menor)</h2>  
                </div>

                <div class="table-responsive">
                <table class="table table-hover table-striped table-bordered" id="" >
                    <thead>
						<tr style="background-color: #00bcd4;color: white; font-weight: bold;">
							<th>Fecha Desde Preferencial</th>
                            <th>Fecha Hasta Preferencial</th>
						</tr>
                    </thead>
                    <tbody>
                        <?php 
                            $obj11= new Trabajo();
                            $contacto_cia = $obj11->get_element_by_id('contacto_cia','id_cia',$cia[0]['idcia']); 

                            for ($i=0; $i < sizeof($desde_pref); $i++) { 

                                $desde_prefn = date("d/m/Y", strtotime($desde_pref[$i]['f_desde_pref']));
				                $hasta_prefn = date("d/m/Y", strtotime($hasta_pref[$i]['f_hasta_pref']));
                           
                        ?>
                        <tr>
                            <td ><?php echo $desde_prefn; ?></td>
                            <td ><?php echo $hasta_prefn; ?></td>
                        </tr>
                        <?php
                            }
                        ?>
                    </tbody>
                </table>
                </div>

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
    <!--    Plugin for the Datepicker, full documentation here: https://github.com/Eonasdan/bootstrap-datetimepicker -->
    <script src="../assets/js/plugins/bootstrap-datetimepicker.min.js"></script>
    <!--    Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
    <script src="../assets/js/plugins/nouislider.min.js"></script>
    <!-- Material Kit Core initialisations of plugins and Bootstrap Material Design Library -->
    <script src="../assets/js/material-kit.js?v=2.0.1"></script>
    <!-- Fixed Sidebar Nav - js With initialisations For Demo Purpose, Don't Include it in your project -->
    <script src="./assets/assets-for-demo/js/material-kit-demo.js"></script>

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