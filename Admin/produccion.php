<?php
session_start();
if (isset($_SESSION['seudonimo'])) {
} else {
    header("Location: ../sys/login.php");
    exit();
}


require_once("../class/clases.php");

$fhoy = date("Y-m-d");
$obj10 = new Trabajo();
$tarjeta = $obj10->get_tarjeta_venc($fhoy);

$contN = sizeof($tarjeta);




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

                <?php if ($contN != 0) { ?>
                    <div class="float-right">
                        <a href="" data-tooltip="tooltip" data-placement="top" title="Ver Tarjeta de Crédito/Débido vencida" class="badge badge-warning navbar-badge h3" data-toggle="modal" data-target="#tarjetaV"><i class="fa fa-bell" aria-hidden="true"></i> <?= $contN; ?></a>
                    </div>
                <?php } ?>

                <div class="col-md-auto col-md-offset-2 hover-collapse">
                    <h2 class="title"><a class="dropdown-toggle" data-toggle="collapse" href="#collapse1" role="button" aria-expanded="false" aria-controls="collapse1">Producción (Listados)</a></h2>
                </div>
                <br><br>

                <div class="collapse" id="collapse1">
                    <div class="card-deck">

                        <div class="card text-white bg-info mb-3">
                            <a href="b_poliza.php">
                                <div class="card-body">
                                    <h5 class="card-title">Pólizas</h5>
                                </div>
                            </a>
                        </div>

                        <div class="card text-white bg-info mb-3">
                            <a href="b_pendientes.php">
                                <div class="card-body">
                                    <h5 class="card-title">Pólizas Pendientes</h5>
                                </div>
                            </a>
                        </div>
                    </div>

                    <?php if ($permiso != 3) { ?>
                        <div class="card-deck">
                            <div class="card text-white bg-info mb-3">
                                <a href="b_comp.php">
                                    <div class="card-body">
                                        <h5 class="card-title">Compañias</h5>
                                    </div>
                                </a>
                            </div>
                            <div class="card text-white bg-info mb-3">
                                <a href="estructura_n.php">
                                    <div class="card-body">
                                        <h5 class="card-title">Estructura de Negocios</h5>
                                    </div>
                                </a>
                            </div>
                        </div>

                        <div class="card-deck">
                            <div class="card text-white bg-info mb-3">
                                <a href="b_f_product.php">
                                    <div class="card-body">
                                        <h5 class="card-title">Pólizas Fecha Producción</h5>
                                    </div>
                                </a>
                            </div>
                            <div class="card text-white bg-info mb-3">
                                <a href="b_cliente.php">
                                    <div class="card-body">
                                        <h5 class="card-title">Clientes</h5>
                                    </div>
                                </a>
                            </div>
                        </div>
                    <?php } ?>

                </div>

            </div>


            <?php
            if ($permiso != 3) {
            ?>
                <div class="container">

                    <div class="col-md-auto col-md-offset-2 hover-collapse">
                        <h2 class="title"><a class="dropdown-toggle" data-toggle="collapse" href="#collapse2" role="button" aria-expanded="false" aria-controls="collapse2">Producción (Carga)</a></h2>
                    </div>
                    <br><br>

                    <div class="collapse" id="collapse2">

                        <div class="card-deck">
                            <div class="card text-white bg-info mb-3">
                                <a href="add/crear_poliza.php">
                                    <div class="card-body">
                                        <h5 class="card-title">Póliza Nueva</h5>
                                    </div>
                                </a>
                            </div>
                        </div>

                        <div class="card-deck">
                            <div class="card text-white bg-info mb-3">
                                <a href="add/crear_asesor.php">
                                    <div class="card-body">
                                        <h5 class="card-title">Asesor, Ejecutivo, Vendedor o Líder de Proyecto</h5>
                                    </div>
                                </a>
                            </div>
                            <div class="card text-white bg-info mb-3">
                                <a href="add/crear_compania.php">
                                    <div class="card-body">
                                        <h5 class="card-title">Compañía Nueva</h5>
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
                    document.write(new Date().getFullYear());
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
    <script src="./assets/assets-for-demo/js/material-kit-demo.js"></script>


    <!-- Modal TARJETA -->
    <div class="modal fade" id="tarjetaV" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="exampleModalLabel">Tarjeta(s) de Crédito / Débito vencida(s)</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <hr>
                    <div class="col-md-auto col-md-offset-2">
                        <h3 class="title text-warning">La(s) siguientes tarjetas se encuentran vencidas o próximas a vencer</h3>
                    </div>


                    <div class="table-responsive">
                        <table class="table table-hover table-striped table-bordered" id="iddatatable" style="display: table">
                            <thead style="background-color: #00bcd4;color: white; font-weight: bold;">
                                <tr>
                                    <th hidden>id</th>
                                    <th>Nº Tarjeta</th>
                                    <th>CVV</th>
                                    <th>Fecha Vencimiento</th>
                                    <th>Nombre titular</th>
                                    <th>Banco</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                for ($i = 0; $i < sizeof($tarjeta); $i++) {
                                    $fechaV = date("d/m/Y", strtotime($tarjeta[$i]['fechaV']));
                                ?>
                                    <tr style="cursor:pointer">
                                        <td hidden><?= $tarjeta[$i]['idrecibo']; ?></td>
                                        <td><?= $tarjeta[$i]['n_tarjeta']; ?></td>
                                        <td><?= $tarjeta[$i]['cvv']; ?></td>
                                        <td><?= $fechaV; ?></td>
                                        <td><?= $tarjeta[$i]['nombre_titular']; ?></td>
                                        <td><?= $tarjeta[$i]['banco']; ?></td>
                                        <td class="text-center"><a href="b_polizaT.php?id_tarjeta=<?= $tarjeta[$i]['id_tarjeta']; ?>" target="_blank" data-tooltip="tooltip" data-placement="top" title="Ver Pólizas" class="btn btn-info btn-sm"><i class="fa fa-eye"></i></a></td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
        function Exportar(table, name) {
            var uri = 'data:application/vnd.ms-excel;base64,',
                template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><meta http-equiv="content-type" content="application/vnd.ms-excel; charset=UTF-8"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>',
                base64 = function(s) {
                    return window.btoa(unescape(encodeURIComponent(s)))
                },
                format = function(s, c) {
                    return s.replace(/{(\w+)}/g, function(m, p) {
                        return c[p];
                    })
                }
            if (!table.nodeType) table = document.getElementById(table)
            var ctx = {
                worksheet: name || 'Worksheet',
                table: table.innerHTML
            }
            window.location.href = uri + base64(format(template, ctx))
        }

        $(function() {
            $('[data-tooltip="tooltip"]').tooltip()
        });
    </script>
</body>

</html>