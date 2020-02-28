<?php
session_start();
if (isset($_SESSION['seudonimo'])) {
} else {
    header("Location: login.php");
    exit();
}

require_once("../class/clases.php");

$nomcia = $_GET['nomcia'];

$obj1 = new Trabajo();
$cia = $obj1->get_element_by_id('dcia', 'nomcia', $nomcia);

$obj2 = new Trabajo();
$asesor = $obj2->get_element('ena', 'idnom');

$cant_a = sizeof($asesor);

$cia[0]['idcia'];

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
                        <h1 class="title">Hacer Preferencial a la Cía <?= $cia[0]['nomcia']; ?></h1>
            </div>


            <form class="form-horizontal" id="frmnuevo" action="comp_pref_n.php" method="post" onKeypress="if(event.keyCode == 13) event.returnValue = false;">
                <center><button type="submit" id="btnForm" class="btn btn-success btn-lg btn-round">Previsualizar</button></center>
                <div class="table-responsive">
                    <table class="table table-hover table-striped table-bordered">
                        <thead style="background-color: #00bcd4;color: white; font-weight: bold;">
                            <tr>
                                <th>Fecha Desde Preferida *</th>
                                <th>Fecha Hasta Preferida *</th>
                                <th>%GC a Sumar *</th>
                                <th hidden>nomcia</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr style="background-color: white">
                                <td>
                                    <div class="input-group date">
                                        <input onblur="cargarFechaDesde(this)" type="text" class="form-control" id="desdeP" name="desdeP" required data-toggle="tooltip" data-placement="bottom" title="Campo Obligatorio" autocomplete="off">
                                    </div>
                                </td>
                                <td>
                                    <div class="input-group date">
                                        <input type="text" class="form-control" id="hastaP" name="hastaP" required data-toggle="tooltip" data-placement="bottom" title="Campo Obligatorio" autocomplete="off">
                                    </div>
                                </td>
                                <td><input onblur="cargarGC(<?= $cant_a; ?>);" type="text" class="form-control validanumericos" id="per_gc" name="per_gc" required data-toggle="tooltip" data-placement="bottom" title="Campo Obligatorio [Sólo introducir números]"></td>
                                <td hidden><input type="text" class="form-control" id="nomcia" name="nomcia" value="<?= $cia[0]['nomcia']; ?>"></td>
                            </tr>
                        </tbody>
                    </table>

                    <table class="table table-hover table-striped table-bordered" id="iddatatable">
                        <thead style="background-color: #00bcd4;color: white; font-weight: bold;">
                            <tr>
                                <th></th>
                                <th>Nombre Asesor</th>
                                <th>%GC</th>
                                <th>%GC a Sumar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            for ($i = 0; $i < sizeof($asesor); $i++) {

                            ?>
                                <tr>
                                    <td><input class="form-control" type="checkbox" id="<?= 'chk' . $i; ?>" value="<?= $asesor[$i]['cod']; ?>" onChange="validarchk(<?= $i; ?>)"></td>
                                    <td style="background-color: white"><input class="form-control" type="text" name="<?= 'asesor' . $i; ?>" value="<?= utf8_encode($asesor[$i]['idnom']) . " [" . $asesor[$i]['cod'] . "]"; ?>" readonly></td>
                                    <td><?= $asesor[$i]['nopre1'] . " %"; ?></td>
                                    <td style="background-color: white"><input style="text-align:center" type="number" class="form-control validanumericos3" id="<?= 'gc_asesor' . $i; ?>" name="<?= 'gc_asesor' . $i; ?>" min="-90" max="90" data-toggle="tooltip" data-placement="bottom" title="Añadir sólo el numero a sumar al %GC" readonly></td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
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
    <!--  Plugin fo Date Time Picker and Full Calendar Plugin  -->
    <script src="../assets/js/plugins/moment.min.js"></script>
    <!--    Plugin fo the Datepicker, full documentation here: https://github.com/Eonasdan/bootstrap-datetimepicker -->
    <script src="../assets/js/plugins/bootstrap-datetimepicker.min.js"></script>
    <!--    Plugin fo the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
    <script src="../assets/js/plugins/nouislider.min.js"></script>
    <!-- Material Kit Core initialisations of plugins and Bootstrap Material Design Library -->
    <script src="../assets/js/material-kit.js?v=2.0.1"></script>
    <!-- Fixed Sidebar Nav - js With initialisations For Demo Purpose, Dont Include it in your project -->
    <script src="../assets/assets-for-demo/js/material-kit-demo.js"></script>

    <script src="../bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
    <script src="../bootstrap-datepicker/locales/bootstrap-datepicker.es.min.js" charset="UTF-8"></script>





    <script type="text/javascript">
        $(document).ready(function() {
            $('#desdeP').datepicker({
                format: "dd-mm-yyyy"
            });
            $('#hastaP').datepicker({
                format: "dd-mm-yyyy"
            });
        });

        function cargarGC(cant_a) {
            for (let index = 0; index < cant_a; index++) {
                $('#gc_asesor' + index).val($('#per_gc').val());
            }
        }

        function validarchk(id) {

            var chk = document.getElementById('chk' + id);
            if (chk.checked) {
                $('#gc_asesor' + id).removeAttr('readonly');
            } else {
                $("#gc_asesor" + id).attr("readonly", true);
            }
        }

        function cargarFechaDesde(desdeP) {
            var desdeP = $('#desdeP').val();

            $("#hastaP").datepicker("setDate", desdeP);
        }
    </script>

    <script type="text/javascript">
        function agregaFrmActualizar(idena) {
            $.ajax({
                type: "POST",
                data: "idena=" + idena,
                url: "../procesos/obtenDatos.php",
                success: function(r) {
                    datos = jQuery.parseJSON(r);
                    $('#idena').val(datos['idena']);
                    $('#nombreU').val(datos['idnom']);
                    $('#codigoU').val(datos['cod']);
                    $('#ciU').val(datos['id']);
                    $('#refcuentaU').val(datos['refcuenta']);
                }
            });
        }


        $(function() {
            $('[data-tooltip="tooltip"]').tooltip()
        })
    </script>

</body>

</html>