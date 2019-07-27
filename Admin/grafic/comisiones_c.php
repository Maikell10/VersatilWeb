<?php 
session_start();
if(isset($_SESSION['seudonimo'])) {

  }
    else {
        header("Location: login.php");
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
            <div class="container">
            <a href="javascript:history.back(-1);" data-tooltip="tooltip" data-placement="right" title="Ir la página anterior" class="btn btn-info btn-round"><- Regresar</a>
            
                <div class="col-md-auto col-md-offset-2">
                    <h1 class="title">Gráficos de Comisiones Cobradas</h1>  
                </div>
                <br>

                

            <div class="card-deck">
                
                <div class="card text-white bg-info mb-6">
                <a href="Comisiones_Cobradas/busqueda_ramo.php">
                  <div class="card-body">
                    <h5 class="card-title">Por Ramo</h5>
                  </div>
                </a>
                </div>
                
                
                
                <div class="card text-white bg-info mb-6">
                <a href="Comisiones_Cobradas/busqueda_prima_mes.php">
                  <div class="card-body">
                    <h5 class="card-title">Por Mes</h5>
                  </div>
                </a>
                </div>

                
                
                

            </div>

            <div class="card-deck">

                <div class="card text-white bg-info mb-3">
                <a href="Comisiones_Cobradas/busqueda_cia.php">
                  <div class="card-body">
                    <h5 class="card-title">Por Cía</h5>
                  </div>
                </a>
                </div>

                <div class="card text-white bg-info mb-3">
                <a href="Comisiones_Cobradas/busqueda_tipo_poliza.php" >
                  <div class="card-body">
                    <h5 class="card-title">Por Tipo de Póliza</h5>
                  </div>
                </a>
                </div>

                <div class="card text-white bg-info mb-3">
                <a href="Comisiones_Cobradas/busqueda_ejecutivo.php">
                  <div class="card-body">
                    <h5 class="card-title">Por Ejecutivo</h5>
                  </div>
                </a>
                </div>

            </div>

            <div class="card-deck">

                <div class="card text-white bg-info mb-3">
                <a href="Comisiones_Cobradas/busqueda_fpago.php">
                  <div class="card-body">
                    <h5 class="card-title">Por Forma de Pago</h5>
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