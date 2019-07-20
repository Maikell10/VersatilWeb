<?php 
session_start();
if(isset($_SESSION['seudonimo'])) {

  }
    else {
        header("Location: login.php");
        exit();
      }
      
  require_once("../class/clases.php");

  $cod_asesor = $_GET['cod_asesor'];

  $obj1= new Trabajo();
  $asesor = $obj1->get_element_by_id('ena','cod',$cod_asesor); 
  $nombre=$asesor[0]['idnom'];

    if (sizeof($asesor)==null) {
        $ob3= new Trabajo();
        $asesor = $ob3->get_element_by_id('enp','cod',$cod_asesor); 
        $nombre=$asesor[0]['nombre'];
    }

    if (sizeof($asesor)==null) {
        $ob3= new Trabajo();
        $asesor = $ob3->get_element_by_id('enr','cod',$cod_asesor); 
        $nombre=$asesor[0]['nombre'];
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
            <div class="container">
            <a href="javascript:history.back(-1);" data-tooltip="tooltip" data-placement="right" title="Ir la página anterior" class="btn btn-info btn-round"><- Regresar</a>

                <div class="col-md-auto col-md-offset-2">
                    <h1 class="title">Asesor: <?php echo $nombre; ?></h1>  
                    <h2 class="title">Cod: <?php echo $asesor[0]['cod']; ?></h2>  
                </div>



                <table class="table table-hover table-striped table-bordered table-responsive" id="" >
                    <thead>
						<tr style="background-color: #00bcd4;color: white; font-weight: bold;">
							<th>ID Asesor</th>
                            <th>Nombre Asesor</th>
                            <th>E-Mail</th>
                            <th>Cel</th>
						</tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td ><?php echo $asesor[0]['id']; ?></td>
                            <td ><?php echo $nombre; ?></td>
                            <td ><?php echo $asesor[0]['email']; ?></td>
                            <td><?php echo $asesor[0]['cel']; ?></td>
                        </tr>
                    </tbody>
                </table>
                        
    

                
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