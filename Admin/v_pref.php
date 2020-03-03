<?php
session_start();
if (isset($_SESSION['seudonimo'])) {
} else {
    header("Location: ../sys/login.php");
    exit();
}

require_once("../class/clases.php");

$id_cia = $_GET['id_cia'];
$f_desde = $_GET['f_desde'];
$f_hasta = $_GET['f_hasta'];

$obj1 = new Trabajo();
$cia = $obj1->get_cia_pref($id_cia, $f_desde, $f_hasta);


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
                <a href="javascript:history.back(-1);" data-tooltip="tooltip" data-placement="right" title="Ir la página anterior" class="btn btn-info btn-round">
                    <- Regresar</a> <div class="col-md-auto col-md-offset-2">
                        <h1 class="title">Cía: <?= ($cia[0]['nomcia']); ?></h1>
                        <h2 class="title">RUC/Rif: <?= $cia[0]['rif']; ?></h2>
            </div>


            <div class="table-responsive">
                <table class="table table-hover table-striped table-bordered" id="">
                    <thead>
                        <tr style="background-color: #00bcd4;color: white; font-weight: bold;">
                            <th>Fecha Desde Preferencial</th>
                            <th>Fecha Hasta Preferencial</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $desde_prefn = date("d/m/Y", strtotime($cia[0]['f_desde_pref']));
                        $hasta_prefn = date("d/m/Y", strtotime($cia[0]['f_hasta_pref']));
                        ?>
                        <tr>
                            <td><?= $desde_prefn; ?></td>
                            <td><?= $hasta_prefn; ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <hr>

            <div class="table-responsive">
                <table class="table table-hover table-striped table-bordered" id="">
                    <thead>
                        <tr style="background-color: #00bcd4;color: white; font-weight: bold;">
                            <th>Asesor</th>
                            <th>%GC</th>
                            <th>%GC Viajes</th>
                            <th>%GC a Sumar</th>
                            <th>%GC Preferencial</th>
                            <th>%GC Preferencial Viajes</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php for ($i = 0; $i < sizeof($cia); $i++) { ?>
                            <tr>
                                <td><?= utf8_encode($cia[$i]['idnom']); ?></td>
                                <td><?= $cia[$i]['nopre1']; ?></td>
                                <td><?= $cia[$i]['gc_viajes']; ?></td>
                                <td><?= $cia[$i]['per_gc_sum']; ?></td>
                                <td class="text-danger font-weight-bold"><?= $cia[$i]['nopre1'] + $cia[$i]['per_gc_sum']; ?></td>
                                <td class="text-danger font-weight-bold"><?= $cia[$i]['gc_viajes'] + $cia[$i]['per_gc_sum']; ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
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
                    document.write(new Date().getFullYear());
                </script>, Versatil Seguros S.A.
            </div>
        </div>
    </footer>
    <!--   Core JS Files   -->

    <script src="../assets/js/core/popper.min.js"></script>
    <script src="../assets/js/bootstrap-material-design.js"></script>
    <!--  Plugin fo Date Time Picker and Full Calendar Plugin  -->
    <script src="../assets/js/plugins/moment.min.js"></script>
    <!--    Plugin fo the Datepicker, full documentation here: https://github.com/Eonasdan/bootstrap-datetimepicker -->
    <script src="../assets/js/plugins/bootstrap-datetimepicker.min.js"></script>
    <!--    Plugin fo the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
    <script src="../assets/js/plugins/nouislider.min.js"></script>
    <!-- Material Kit Core initialisations of plugins and Bootstrap Material Design Library -->
    <script src="../assets/js/material-kit.js?v=2.0.1"></script>
    <!-- Fixed Sidebar Nav - js With initialisations For Demo Purpose, Dont Include it in your project -->
    <script src="./assets/assets-for-demo/js/material-kit-demo.js"></script>

    <script>
        $(function() {
            $('[data-tooltip="tooltip"]').tooltip()
        });
    </script>


</body>

</html>