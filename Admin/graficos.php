<?php 
session_start();
if(isset($_SESSION['seudonimo'])) {

  }
    else {
        header("Location: ../sys/login.php");
        exit();
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

                <div class="col-md-auto col-md-offset-2">
                    <h1 class="title">Gráficos</h1>  
                </div>
                <br>

                

            <div class="card-deck">
                
                <div class="card text-white bg-info mb-3">
                <a href="grafic/porcentaje.php">
                  <div class="card-body">
                    <center><h5 class="card-title">Porcentaje</h5></center>
                  </div>
                </a>
                </div>
                
                
                
                <div class="card text-white bg-info mb-3">
                <a href="grafic/primas_s.php">
                  <div class="card-body">
                    <center><h5 class="card-title">Primas Suscritas</h5></center>
                  </div>
                </a>
                </div>

                <div class="card text-white bg-info mb-3">
                <a href="grafic/primas_c.php">
                  <div class="card-body">
                    <center><h5 class="card-title">Primas Cobradas</h5></center>
                  </div>
                </a>
                </div>
                
                

            </div>

            <div class="card-deck">

                <div class="card text-white bg-info mb-6">
                <a href="grafic/comisiones_c.php">
                  <div class="card-body">
                    <center><h5 class="card-title">Comisiones Cobradas</h5></center>
                  </div>
                </a>
                </div>

                <?php if ($permiso!=3) {?>
                <div class="card text-white bg-info mb-6">
                <a href="grafic/resumen.php" >
                  <div class="card-body">
                    <center><h5 class="card-title">Resúmenes</h5></center>
                  </div>
                </a>
                </div>
                <?php }?>

                <div class="card text-white bg-info mb-6">
                <a href="grafic/comparativo.php" >
                  <div class="card-body">
                    <center><h5 class="card-title">Comparativo</h5></center>
                  </div>
                </a>
                </div>


            </div>
            

         

        </div>
        



        <br><br><br><br>

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
    <!--	Plugin for the Datepicker, full documentation here: https://github.com/Eonasdan/bootstrap-datetimepicker -->
    <script src="../assets/js/plugins/bootstrap-datetimepicker.min.js"></script>
    <!--	Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
    <script src="../assets/js/plugins/nouislider.min.js"></script>
    <!-- Material Kit Core initialisations of plugins and Bootstrap Material Design Library -->
    <script src="../assets/js/material-kit.js?v=2.0.1"></script>
    <!-- Fixed Sidebar Nav - js With initialisations For Demo Purpose, Don't Include it in your project -->
    <script src="../assets/assets-for-demo/js/material-kit-demo.js"></script>

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