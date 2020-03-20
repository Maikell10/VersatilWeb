<?php
session_start();
if (isset($_SESSION['seudonimo'])) {
} else {
    header("Location: ../sys/login.php");
    exit();
}

require_once("../class/clases.php");



$id_titular = $_GET['id_titu'];

$obj1 = new Trabajo();
$cliente = $obj1->get_element_by_id('titular', 'id_titular', $id_titular);


$originalFPP = $cliente[0]['f_nac'];
$newFPP = date("d-m-Y", strtotime($originalFPP));

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php require('header.php'); ?>

    <style>
        .alertify .ajs-header {
            background-color: red;
        }
    </style>


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
                        <h1 class="title">Cliente: <?= $cliente[0]['nombre_t'] . " " . $cliente[0]['apellido_t']; ?></h1>
                        <h2 class="title">Nº ID: <?= $cliente[0]['ci']; ?></h2>
            </div>


            <form class="form-horizontal" id="frmnuevo" action="e_cliente_n.php" method="post">

                <div class="table-responsive">
                    <table class="table table-striped table-bordered display nowrap" id="iddatatable">
                        <thead style="background-color: #00bcd4;color: white; font-weight: bold;">
                            <tr>
                                <th>Cédula</th>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>Fecha Nacimiento</th>
                                <th hidden>id</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr style="background-color: white">
                                <td><input type="number" step="0.01" class="form-control" name="ci" required data-toggle="tooltip" data-placement="bottom" title="Campo Obligatorio" value="<?= $cliente[0]['ci']; ?>"></td>
                                <td><input type="text" class="form-control" name="nombre" value="<?= $cliente[0]['nombre_t']; ?>" onkeyup="mayus(this);"></td>
                                <td><input type="text" class="form-control" name="apellido" value="<?= $cliente[0]['apellido_t']; ?>" onkeyup="mayus(this);"></td>
                                <td>
                                    <div class="input-group date">
                                        <input type="text" class="form-control" id="f_nac" name="f_nac" value="<?= $newFPP; ?>">
                                    </div>
                                </td>
                                <td hidden><input type="text" class="form-control" name="id_titular" value="<?= $cliente[0]['id_titular']; ?>"></td>
                            </tr>
                            <tr style="background-color: #00bcd4;color: white; font-weight: bold;">
                                <th>Celular</th>
                                <th>Teléfono</th>
                                <th colspan="2">email</th>
                            </tr>
                            <tr style="background-color: white">
                                <td><input type="text" class="form-control" name="cel" required value="<?= $cliente[0]['cell']; ?>"></td>
                                <td><input type="text" class="form-control" name="telf" value="<?= $cliente[0]['telf']; ?>"></td>
                                <td colspan="2"><input type="text" class="form-control" name="email" value="<?= $cliente[0]['email']; ?>"></td>
                            </tr>
                            <tr style="background-color: #00bcd4;color: white; font-weight: bold;">
                                <th colspan="4">Dirección</th>
                            </tr>
                            <tr style="background-color: white">
                                <td colspan="4"><input type="text" class="form-control" name="direcc" value="<?= $cliente[0]['direcc']; ?>" onkeyup="mayus(this);"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>








                <hr>
                <button type="submit" style="width: 100%" data-tooltip="tooltip" data-placement="bottom" title="Previsualizar" class="btn btn-success btn-lg" value="">Previsualizar Edición &nbsp;<i class="fa fa-check" aria-hidden="true"></i></button>
                <hr>

            </form>











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

    <script src="../bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
    <script src="../bootstrap-datepicker/locales/bootstrap-datepicker.es.min.js" charset="UTF-8"></script>






    <script language="javascript">
        $(document).ready(function() {
            $('#cant_poliza option:first').prop('selected', true);

        });


        $('#f_nac').datepicker({
            format: "dd-mm-yyyy"
        });

        function mayus(e) {
            e.value = e.value.toUpperCase();
        }

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
    </script>



</body>

</html>