<?php
session_start();
if (isset($_SESSION['seudonimo'])) { } else {
    header("Location: login.php");
    exit();
}

require_once("../class/clases.php");

$fhoy = date("Y-m-d");
$obj10 = new Trabajo();
$tarjeta = $obj10->get_tarjeta_venc($fhoy);

$contN = sizeof($tarjeta);

$obj10 = new Trabajo();
$polizas_r = $obj10->get_polizas_r();

$contPR = sizeof($polizas_r);


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php require('header.php'); ?>
</head>

<body class="profile-page ">

    <?php require('navigation.php'); ?>




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


                <center>
                    <h1>Bienvenido <?php echo $_SESSION['seudonimo']; ?> <i class="fa fa-user fa-lg"></i></h1>
                </center>
                <hr>
                <div class="row">
                    <div class="ml-auto mr-auto">
                        <ul class="nav nav-pills nav-pills-icons" role="tablist">
                            <li class="nav-item m-auto">
                                <a class="nav-link" href="produccion.php">
                                    <i class="material-icons">dashboard</i> Producción

                                    <?php
                                    if ($contN != 0) {
                                        ?>
                                        <span class="badge badge-warning ml-2"><?php echo $contN; ?></span>
                                    <?php
                                    }
                                    ?>
                                </a>
                            </li>
                            <li class="nav-item m-auto">
                                <a class="nav-link" href="renovacion.php">
                                    <i class="material-icons">alarm_on</i> Renovación
                                </a>
                            </li>
                            <?php
                            if ($permiso != 3) {
                                ?>
                                <li class="nav-item m-auto">
                                    <a class="nav-link" href="administracion.php">
                                        <i class="material-icons">schedule</i> Administración

                                        <?php
                                            if ($contPR != 0 && $permiso == 1) {
                                                ?>
                                            <span class="badge badge-warning ml-2"><?php echo $contPR; ?></span>
                                        <?php
                                            }
                                            ?>
                                    </a>
                                </li>
                            <?php
                            }
                            ?>
                            <li class="nav-item m-auto">
                                <a class="nav-link" href="graficos.php">
                                    <i class="material-icons">trending_up</i> Gráficos
                                </a>
                            </li>
                            <li class="nav-item m-auto">
                                <a class="nav-link" href="#tasks-1" role="tab" data-toggle="tab">
                                    <i class="material-icons">list</i> Siniestros
                                </a>
                            </li>
                        </ul>

                        <div class="tab-content tab-space">
                            <div class="tab-pane" id="schedule-1">
                                Módulo en contrucción Administración
                            </div>
                            <div class="tab-pane" id="tasks-1">
                                Módulo en contrucción Siniestros
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>




        <?php require('footer_b.php'); ?>






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
    <!--  //Plugin for Date Time Picker and Full Calendar Plugin  -->
    <script src="../assets/js/plugins/moment.min.js"></script>
    <!--	//Plugin for the Datepicker, full documentation here: https://github.com/Eonasdan/bootstrap-datetimepicker -->
    <script src="../assets/js/plugins/bootstrap-datetimepicker.min.js"></script>
    <!--	//Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
    <script src="../assets/js/plugins/nouislider.min.js"></script>
    <!-- //Material Kit Core initialisations of plugins and Bootstrap Material Design Library -->
    <script src="../assets/js/material-kit.js?v=2.0.1"></script>
    <!-- //Fixed Sidebar Nav - js With initialisations For Demo Purpose, Don't Include it in your project -->
    <script src="../assets/assets-for-demo/js/material-kit-demo.js"></script>


    <script>
        $(function() {
            $('[data-tooltip="tooltip"]').tooltip()
        });

        $("#iddatatable tbody tr").dblclick(function() {
            var customerId = $(this).find("td").eq(0).html();

            window.open("v_poliza.php?id_poliza=" + customerId, '_blank');
        });
    </script>


</body>

</html>