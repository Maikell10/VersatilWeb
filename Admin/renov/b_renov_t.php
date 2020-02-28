<?php
session_start();
if (isset($_SESSION['seudonimo'])) {
} else {
    header("Location: login.php");
    exit();
}

require_once("../../class/renovar.php");


$obj = new Renovar();
$polizas = $obj->renovar();

$cant_p = $obj->cant_renov;

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php require('header.php'); ?>
</head>

<body class="profile-page ">

    <?php require('navigation.php'); ?>


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

        <div id="carga" class="d-flex justify-content-center align-items-center">
            <div class="spinner-grow text-info" style="width: 7rem; height: 7rem;"></div>
        </div>

        <div class="section">
            <div class="container">

                <div class="col-md-auto col-md-offset-2" id="tablaLoad" hidden="true">
                    <a href="javascript:history.back(-1);" data-tooltip="tooltip" data-placement="right" title="Ir la página anterior" class="btn btn-info btn-round">
                        <- Regresar</a> <h1 class="title">Lista Pólizas Vencidas a Renovar</h1>
                </div>
                <br><br>

                <?php if (isset($_GET['m']) == 2) { ?>

                    <div class="alert alert-danger" role="alert">
                        No existen datos para la búsqueda seleccionada!
                    </div>

                <?php } ?>
                <?php if ($permiso != 3) { ?>


            </div>

            <div class="container-fluid" id="tablaP">


                <center><a class="btn btn-success" onclick="tableToExcel('Exportar_a_Excel', 'Listado de Pólizas')" data-toggle="tooltip" data-placement="right" title="Exportar a Excel"><img src="../../assets/img/excel.png" width="60" alt=""></a></center>

                <center>
                    <div class="table-responsive">
                        <table class="table table-hover table-striped table-bordered text-left" id="iddatatable">
                            <thead style="background-color: #00bcd4;color: white; font-weight: bold;">
                                <tr>
                                    <th hidden>f_hastapoliza</th>
                                    <th hidden>id</th>
                                    <th>N° Póliza</th>
                                    <th>Nombre Asesor</th>
                                    <th>Cía</th>
                                    <th>F Desde Seguro</th>
                                    <th>F Hasta Seguro</th>
                                    <th style="background-color: #E54848;">Prima Suscrita</th>
                                    <th>Nombre Titular</th>
                                    <th>PDF</th>
                                    <th></th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                $prima_t = 0;
                                foreach ($polizas as $poliza) {
                                    
                                    $poliza_renov = $obj->comprobar_poliza($poliza['cod_poliza'], $poliza['id_cia']);
                                    if (sizeof($poliza_renov) == 0) { 
                                        $prima_t = $prima_t + $poliza['prima'];
                                    
                                ?>

                                    <tr style="cursor: pointer;">
                                        <td hidden><?= $poliza['f_hastapoliza']; ?></td>
                                        <td hidden><?= $poliza['id_poliza']; ?></td>
                                        <td style="color: #E54848;font-weight: bold"><?= $poliza['cod_poliza']; ?></td>
                                        <td><?= $poliza['nombre']; ?></td>
                                        <td><?= $poliza['nomcia']; ?></td>
                                        <td><?= $poliza['f_desdepoliza']; ?></td>
                                        <td><?= $poliza['f_hastapoliza']; ?></td>
                                        <td align="right"><?= number_format($poliza['prima'], 2); ?></td>
                                        <td><?= $poliza['nombre_t'] . ' ' . $poliza['apellido_t']; ?></td>
                                        <?php if ($poliza['pdf'] == 1) { ?>
                                            <td><a href="../download.php?id_poliza=<?= $poliza['id_poliza']; ?>" class="btn btn-white btn-round btn-sm" target="_blank" style="float: right"><img src="../../assets/img/pdf-logo.png" width="30" id="pdf"></a></td>
                                        <?php } else { ?>
                                            <td></td>
                                        <?php } ?>
                                        <td><a href="#" data-tooltip="tooltip" data-placement="top" title="Renovar" class="btn btn-success btn-round"><i class="fa fa-check-circle" aria-hidden="true"></i> </a></td>
                                    </tr>

                                <?php }else {$cant_p=$cant_p-1;} } ?>
                            </tbody>


                            <tfoot>
                                <tr>
                                    <th hidden>f_hastapoliza</th>
                                    <th hidden>id</th>
                                    <th>N° Póliza</th>
                                    <th>Nombre Asesor</th>
                                    <th>Cía</th>
                                    <th>F Desde Seguro</th>
                                    <th>F Hasta Seguro</th>
                                    <th>Prima Suscrita $<?= number_format($prima_t, 2); ?></th>
                                    <th>Nombre Titular</th>
                                    <th>PDF</th>
                                    <th></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>


                    <h1 class="title">Total de Prima Suscrita</h1>
                    <h1 class="title text-danger">$ <?= number_format($prima_t, 2); ?></h1>

                    <h1 class="title">Total de Pólizas</h1>
                    <h1 class="title text-danger"><?= $cant_p; ?></h1>


                </center>



                <table class="table table-hover table-striped table-bordered" id="Exportar_a_Excel" hidden>
                    <thead style="background-color: #00bcd4;color: white; font-weight: bold;">
                        <tr>
                            <th>N° Póliza</th>
                            <th>Nombre Asesor</th>
                            <th>Cía</th>
                            <th>F Desde Seguro</th>
                            <th>F Hasta Seguro</th>
                            <th style="background-color: #E54848;">Prima Suscrita</th>
                            <th nowrap>Nombre Titular</th>
                            <th>PDF</th>
                        </tr>
                    </thead>

                    <tbody>

                    </tbody>


                    <tfoot>
                        <tr>
                            <th>N° Póliza</th>
                            <th>Nombre Asesor</th>
                            <th>Cía</th>
                            <th>F Desde Seguro</th>
                            <th>F Hasta Seguro</th>
                            <th>Prima Suscrita $<?= number_format($totalprima, 2); ?></th>
                            <th>Nombre Titular</th>
                            <th>PDF</th>
                        </tr>
                    </tfoot>
                </table>




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

    <script src="../../assets/js/core/popper.min.js"></script>
    <script src="../../assets/js/bootstrap-material-design.js"></script>
    <!--  Plugin for Date Time Picker and Full Calendar Plugin  -->
    <script src="../../assets/js/plugins/moment.min.js"></script>
    <!--    Plugin for the Datepicker, full documentation here: https://github.com/Eonasdan/bootstrap-datetimepicker -->
    <script src="../../assets/js/plugins/bootstrap-datetimepicker.min.js"></script>
    <!--    Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
    <script src="../../assets/js/plugins/nouislider.min.js"></script>
    <!-- Material Kit Core initialisations of plugins and Bootstrap Material Design Library -->
    <script src="../../assets/js/material-kit.js?v=2.0.1"></script>
    <!-- Fixed Sidebar Nav - js With initialisations For Demo Purpose, Don't Include it in your project -->
    <script src="./../assets/assets-for-demo/js/material-kit-demo.js"></script>

    <!-- Bootstrap Select JavaScript -->
    <script src="../../js/bootstrap-select.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#iddatatable').DataTable({
                "order": [[ 0, "desc" ]],
            });
            $('#iddatatable1').DataTable({});
            $('#tablaP').removeAttr('hidden');
        });

        const tablaLoad = document.getElementById("tablaLoad");
        const carga = document.getElementById("carga");
        //const tablaP = document.getElementById("tablaP");

        setTimeout(() => {
            carga.className = 'd-none';
            tablaLoad.removeAttribute("hidden");
            //tablaP.removeAttribute("hidden");
        }, 1000);

        $("#iddatatable tbody tr").dblclick(function() {
            var customerId = $(this).find("td").eq(0).html();

            window.open("../v_poliza.php?id_poliza=" + customerId, '_blank');

        });
        $(function() {
            $('[data-tooltip="tooltip"]').tooltip()
        });
    </script>

</body>

</html>