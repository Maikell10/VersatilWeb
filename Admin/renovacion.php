<?php
session_start();
if (isset($_SESSION['seudonimo'])) {
} else {
    header("Location: ../sys/login.php");
    exit();
}

require_once("../class/renovar.php");
$obj = new Renovar();
$polizas = $obj->renovar();
$cant_p = $obj->cant_renov;

foreach ($polizas as $poliza) {
    $poliza_renov = $obj->comprobar_poliza($poliza['cod_poliza'], $poliza['id_cia']);
    if (sizeof($poliza_renov) != 0) {
        $cant_p=$cant_p-1;
    }
}


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

                <div class="col-md-auto col-md-offset-2 hover-collapse">
                    <h2 class="title"><a class="dropdown-toggle" data-toggle="collapse" href="#collapse3" role="button" aria-expanded="false" aria-controls="collapse3">Renovación (Listados Pólizas a Renovar)</a></h2>
                </div>
                <br><br>

                <div class="collapse" id="collapse3">
                    <div class="card-deck">
                        <div class="card text-white bg-info mb-3">
                            <a href="renov/b_renov_por_cia.php">
                                <div class="card-body">
                                    <h5 class="card-title">Organizadas Por Cía</h5>
                                </div>
                            </a>
                        </div>

                        <?php if ($permiso != 3) { ?>
                            <div class="card text-white bg-info mb-3">
                                <a href="renov/b_renov_por_asesor.php">
                                    <div class="card-body">
                                        <h5 class="card-title">Organizadas Por Asesor</h5>
                                    </div>
                                </a>
                            </div>
                        <?php } ?>

                        <div class="card text-white bg-info mb-3">
                            <a href="renov/b_renov_g.php">
                                <div class="card-body">
                                    <h5 class="card-title">General</h5>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>


            <?php
            if ($permiso != 3) {
            ?>
                <div class="container">

                    <div class="col-md-auto col-md-offset-2 hover-collapse">
                        <h2 class="title"><a class="dropdown-toggle" data-toggle="collapse" href="#collapse2" role="button" aria-expanded="false" aria-controls="collapse2">Renovación (Carga)</a>

                            <?php
                            if ($cant_p != 0) {
                            ?>
                                <a href="" data-tooltip="tooltip" data-placement="top" title="Hay Pólizas para Renovar" class="badge badge-warning navbar-badge h3 text-white" data-toggle="modal" data-target="#tarjetaV"><i class="fa fa-stopwatch" aria-hidden="true"></i> <?= $cant_p; ?> </a>
                            <?php
                            }
                            ?>

                        </h2>
                    </div>
                    <br><br>

                    <div class="collapse" id="collapse2">

                        <div class="card-deck">
                            <div class="card text-white bg-info mb-3">
                                <a href="renov/b_renov_t.php">
                                    <div class="card-body">
                                        <h5 class="card-title">Renovar Póliza</h5>
                                    </div>
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
            <?php
            }
            ?>

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
    <!--  Plugin fo Date Time Picker and Full Calendar Plugin  -->
    <script src="../assets/js/plugins/moment.min.js"></script>
    <!--	Plugin fo the Datepicker, full documentation here: https://github.com/Eonasdan/bootstrap-datetimepicker -->
    <script src="../assets/js/plugins/bootstrap-datetimepicker.min.js"></script>
    <!--	Plugin fo the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
    <script src="../assets/js/plugins/nouislider.min.js"></script>
    <!-- Material Kit Core initialisations of plugins and Bootstrap Material Design Library -->
    <script src="../assets/js/material-kit.js?v=2.0.1"></script>
    <!-- Fixed Sidebar Nav - js With initialisations For Demo Purpose, Dont Include it in your project -->
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

        $(function() {
            $('[data-tooltip="tooltip"]').tooltip()
        });
    </script>
</body>

</html>