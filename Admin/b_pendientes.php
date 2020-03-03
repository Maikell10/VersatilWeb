<?php
session_start();
if (isset($_SESSION['seudonimo'])) {
} else {
    header("Location: ../sys/login.php");
    exit();
}

require_once("../class/clases.php");

$obj1 = new Trabajo();
$poliza = $obj1->get_poliza_pendiente();



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


        <div id="carga" class="d-flex justify-content-center align-items-center">
            <div class="spinner-grow text-info" style="width: 7rem; height: 7rem;"></div>
        </div>

        <div class="section">
            <div class="container">


                <div class="col-md-auto col-md-offset-2" id="tablaLoad1" hidden="true">
                    <h1 class="title">Pólizas Pendientes a Cargar</h1>
                    <a href="javascript:history.back(-1);" data-tooltip="tooltip" data-placement="right" title="Ir la página anterior" class="btn btn-info btn-round">
                        <- Regresar</a> </div> <?php
                                                if ($poliza == 0) {
                                                ?> <h3 class="title text-center">No hay Pólizas Pendientes</h3>
                        <?php
                                                } else {
                        ?>


                            <center>
                                <div class="table-responsive">
                                    <table class="table table-hover table-striped table-bordered" id="iddatatable">
                                        <thead style="background-color: #00bcd4;color: white; font-weight: bold;">
                                            <tr>
                                                <th hidden>f_poliza</th>
                                                <th hidden>id</th>
                                                <th>N° Póliza</th>
                                                <th hidden>Código Vendedor</th>
                                                <th>F Producción</th>
                                                <th>F Hasta Reporte</th>
                                                <th>Cia</th>
                                                <th>Asesor</th>
                                                <th>Asegurado</th>
                                                <th>Prima Cobrada</th>
                                                <th></th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php
                                                    $totalsuma = 0;
                                                    $totalprima = 0;
                                                    $currency = "";
                                                    $cont = 0;
                                                    for ($i = 0; $i < sizeof($poliza); $i++) {

                                                        $obj11 = new Trabajo();
                                                        $rep_com = $obj11->get_poliza_rep_com($poliza[$i]['id_poliza']);

                                                        $cont = $cont + 1;
                                                        $totalsuma = $totalsuma + $poliza[$i]['sumaasegurada'];
                                                        $totalprima = $totalprima + $poliza[$i]['prima'];


                                                        $originalFProd = $poliza[$i]['f_poliza'];
                                                        $newFProd = date("d/m/Y", strtotime($originalFProd));

                                                        $originalFRep = $rep_com[0]['f_hasta_rep'];
                                                        $newFRep = date("d/m/Y", strtotime($originalFRep));

                                                        $ob1 = new Trabajo();
                                                        $asegurado = $ob1->get_element_by_id('titular_pre_poliza', 'id_poliza', $poliza[$i]['id_poliza']);

                                                        $ob11 = new Trabajo();
                                                        $asesor = $ob11->get_ejecutivo($poliza[$i]['codvend']);

                                                        $obj10 = new Trabajo();
                                                        $polizap = $obj10->get_comision_rep_com_by_id($poliza[$i]['id_poliza']);
                                                        $totalprimaC = 0;
                                                        for ($a = 0; $a < sizeof($polizap); $a++) {
                                                            $totalprimaC = $totalprimaC + $polizap[$a]['prima_com'];
                                                        }


                                                        if ($poliza[$i]['f_hastapoliza'] >= date("Y-m-d")) {
                                            ?>
                                                    <tr style="cursor: pointer;">
                                                        <td hidden><?= $poliza[$i]['f_poliza']; ?></td>
                                                        <td hidden><?= $poliza[$i]['id_poliza']; ?></td>
                                                        <td style="color: #2B9E34;font-weight: bold"><?= $poliza[$i]['cod_poliza']; ?></td>
                                                    <?php
                                                        } else {
                                                    ?>
                                                    <tr style="cursor: pointer;">
                                                        <td hidden><?= $poliza[$i]['f_poliza']; ?></td>
                                                        <td hidden><?= $poliza[$i]['id_poliza']; ?></td>
                                                        <td style="color: #E54848;font-weight: bold"><?= $poliza[$i]['cod_poliza']; ?></td>
                                                    <?php
                                                        }

                                                    ?>

                                                    <td hidden><?= $poliza[$i]['codvend']; ?></td>
                                                    <td><?= $newFProd; ?></td>
                                                    <td><?= $newFRep; ?></td>
                                                    <td><?= $poliza[$i]['nomcia']; ?></td>
                                                    <td><?= $asesor[0]['nombre']; ?></td>
                                                    <td><?= $asegurado[0]['asegurado']; ?></td>
                                                    <td><?= '$ ' . number_format($totalprimaC, 2); ?></td>
                                                    <?php
                                                        if ($totalprimaC == 0) {
                                                    ?>
                                                        <td><button onclick="eliminarDatos('<?= $poliza[$i]['id_poliza']; ?>')" data-tooltip="tooltip" data-placement="top" title="Eliminar" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button></td>
                                                    <?php
                                                        } else {
                                                    ?>
                                                        <td></td>
                                                    <?php
                                                        }
                                                    ?>
                                                    </tr>
                                                <?php

                                                    }
                                                ?>
                                        </tbody>


                                        <tfoot>
                                            <tr>
                                                <th hidden>f_poliza</th>
                                                <th hidden>id</th>
                                                <th>N° Póliza</th>
                                                <th hidden>Código Vendedor</th>
                                                <th>F Producción</th>
                                                <th>F Hasta Reporte</th>
                                                <th>Cia</th>
                                                <th>Asesor</th>
                                                <th>Asegurado</th>
                                                <th>Prima Cobrada</th>
                                                <th></th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>


                                <h1 class="title">Total de Pólizas Pendientes</h1>
                                <h1 class="title text-danger"><?= $cont; ?></h1>
                            </center>
                        <?php } ?>


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
        <!--	Plugin fo the Datepicker, full documentation here: https://github.com/Eonasdan/bootstrap-datetimepicker -->
        <script src="../assets/js/plugins/bootstrap-datetimepicker.min.js"></script>
        <!--	Plugin fo the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
        <script src="../assets/js/plugins/nouislider.min.js"></script>
        <!-- Material Kit Core initialisations of plugins and Bootstrap Material Design Library -->
        <script src="../assets/js/material-kit.js?v=2.0.1"></script>
        <!-- Fixed Sidebar Nav - js With initialisations For Demo Purpose, Dont Include it in your project -->
        <script src="../assets/assets-for-demo/js/material-kit-demo.js"></script>

        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>

        <script src="../bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
        <script src="../bootstrap-datepicker/locales/bootstrap-datepicker.es.min.js" charset="UTF-8"></script>


        <script type="text/javascript">
            const tablaLoad1 = document.getElementById("tablaLoad1");
            const carga = document.getElementById("carga");

            setTimeout(() => {
                carga.className = 'd-none';
                tablaLoad1.removeAttribute("hidden");
            }, 1000);



            $(document).ready(function() {
                $('#iddatatable').DataTable({
                    //scrollX: 900,
                    "order": [
                        [0, "desc"]
                    ],
                    "lengthMenu": [
                        [10, 25, 50, -1],
                        [10, 25, 50, "All"]
                    ]
                });
            });

            $(function() {
                $('[data-tooltip="tooltip"]').tooltip()
            });

            $("#iddatatable tbody tr").dblclick(function() {
                var customerId = $(this).find("td").eq(1).html();

                window.open("v_poliza.php?id_poliza=" + customerId, '_blank');
            });


            function eliminarDatos(idpoliza) {
                alertify.confirm('Eliminar una Póliza Pendiente', '¿Seguro de eliminar esta Póliza?', function() {
                    $('.alertify .ajs-header').css('background-color', 'green');
                    console.log(idpoliza);
                    $.ajax({
                        type: "POST",
                        data: "idpoliza=" + idpoliza,
                        url: "../procesos/eliminarPoliza.php",
                        success: function(r) {
                            if (r == 1) {
                                alertify.alert('Eliminada con exito !', 'La Póliza fue eliminada con exito', function() {
                                    alertify.success('OK');
                                    window.location.replace("b_pendientes.php");
                                });
                            } else {
                                alertify.error("No se pudo eliminar");
                            }
                        }
                    });

                }, function() {

                });
            }
        </script>
</body>

</html>