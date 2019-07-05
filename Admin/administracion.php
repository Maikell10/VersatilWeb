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

                <div class="col-md-auto col-md-offset-2 hover-collapse">
                    <h2 class="title"><a class="dropdown-toggle" data-toggle="collapse" href="#collapse1" role="button" aria-expanded="false" aria-controls="collapse1">Administración (Listados)</a></h2>
                </div>
                <br><br>
               
                
                <div class="collapse" id="collapse1">
                    <div class="card-deck">
                        <div class="card text-white bg-info mb-3">
                            <a href="b_reportes.php">
                                <div class="card-body">
                                    <h5 class="card-title">Reportes de Comisión</h5>
                                </div>
                            </a>
                        </div>
                        <div class="card text-white bg-info mb-3">
                            <a href="b_reportes_cia.php">
                                <div class="card-body">
                                    <h5 class="card-title">Reportes de Comisión por Compañias</h5>
                                </div>
                            </a>
                        </div> 
                        <div class="card text-white bg-info mb-3">
                            <a href="b_reportes_gc.php">
                                <div class="card-body">
                                    <h5 class="card-title">Reportes de GC</h5>
                                </div>
                            </a>
                        </div> 
                    </div>
                </div>
            </div>
 
            <div class="container">

                <div class="col-md-auto col-md-offset-2 hover-collapse">
                    <h2 class="title"><a class="dropdown-toggle" data-toggle="collapse" href="#collapse2" role="button" aria-expanded="false" aria-controls="collapse2">Administración (Carga)</a></h2>
                </div>
                <br><br>

                <div class="collapse" id="collapse2">
                    <div class="card-deck">
                        <div class="card text-white bg-info mb-3">
                            <a href="add/crear_comision.php">
                                <div class="card-body">
                                    <h5 class="card-title">Comisiones</h5>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container">

                <div class="col-md-auto col-md-offset-2 hover-collapse">
                    <h2 class="title"><a class="dropdown-toggle" data-toggle="collapse" href="#collapse3" role="button" aria-expanded="false" aria-controls="collapse3">Generar Pago GC</a></h2>
                </div>
                <br><br>

                <div class="collapse" id="collapse3">
                    <div class="card-deck">
                        <div class="card text-white bg-info mb-3">
                            <a href="gc/b_gc.php">
                                <div class="card-body">
                                    <h5 class="card-title">Generar</h5>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
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
    <script src="../assets/js/core/jquery.min.js"></script>
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
    <script src="./assets/assets-for-demo/js/material-kit-demo.js"></script>
    <script>
        $(document).ready(function() {
            materialKitDemo.initFormExtendedDatetimepickers();
            // Sliders for demo purpose in refine cards section
            var slider = document.getElementById('sliderRegular');

            noUiSlider.create(slider, {
                start: 40,
                connect: [true, false],
                range: {
                    min: 0,
                    max: 100
                }
            });

            var slider2 = document.getElementById('sliderDouble');

            noUiSlider.create(slider2, {
                start: [20, 60],
                connect: true,
                range: {
                    min: 0,
                    max: 100
                }
            });
        });
    </script>
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