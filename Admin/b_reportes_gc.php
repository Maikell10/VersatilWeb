<?php
session_start();
if (isset($_SESSION['seudonimo'])) {
} else {
    header("Location: ../sys/login.php");
    exit();
}

require_once("../class/clases.php");


$obj1 = new Trabajo();
$asesor = $obj1->get_element('ena', 'idena');


$obj4 = new Trabajo();
$cia = $obj4->get_distinct_element('nomcia', 'dcia');




$obj33 = new Trabajo();
$fechaMinRep = $obj33->get_fecha_min('f_pago_gc', 'rep_com');

$obj55 = new Trabajo();
$fechaMaxRep = $obj55->get_fecha_max('f_pago_gc', 'rep_com');


$totalPrimaCom = 0;
$totalCom = 0;



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
                <a href="javascript:history.back(-1);" data-tooltip="tooltip" data-placement="right" title="Ir la página anterior" class="btn btn-info btn-round">
                    <- Regresar</a> <div class="col-md-auto col-md-offset-2" id="tablaLoad1" hidden="true">
                        <h1 class="title">Lista de Reportes de GC</h1>
            </div>





            <center>
                <table class="table table-hover table-striped table-bordered" id="iddatatable1">
                    <thead style="background-color: #00bcd4;color: white; font-weight: bold;">
                        <tr>
                            <th>Nº Generada</th>
                            <th>Fecha Creación de GC</th>
                            <th>Fecha Desde Reporte GC</th>
                            <th>Fecha Hasta Reporte GC</th>
                            <th>Cant Comisiones</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $obj1 = new Trabajo();
                        $gc_h = $obj1->get_element_desc('gc_h', 'f_hoy_h');

                        for ($i = 0; $i < sizeof($gc_h); $i++) {




                            $f_pago_gc = date("d-m-Y", strtotime($gc_h[$i]['f_hoy_h']));
                            $f_desde_rep = date("d-m-Y", strtotime($gc_h[$i]['f_desde_h']));
                            $f_hasta_rep = date("d-m-Y", strtotime($gc_h[$i]['f_hasta_h']));

                        ?>
                            <tr style="cursor: pointer">
                                <td><?= $gc_h[$i]['id_gc_h']; ?></td>
                                <td><?= $f_pago_gc; ?></td>
                                <td><?= $f_desde_rep; ?></td>
                                <td><?= $f_hasta_rep; ?></td>
                                <td><?= $gc_h[$i]['tPoliza']; ?></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>

                    <tfoot>
                        <tr>
                            <th>Nº Generada</th>
                            <th>Fecha Pago GC</th>
                            <th>Fecha Desde Reporte GC</th>
                            <th>Fecha Hasta Reporte GC</th>
                            <th>Cant Comisiones</th>
                        </tr>
                    </tfoot>
                </table>
            </center>










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
        $(document).ready(function() {
            $('#iddatatable1').DataTable({
                //scrollX: 300,
                "order": [
                    [0, "desc"]
                ],
                "lengthMenu": [
                    [10, 25, 50, -1],
                    [10, 25, 50, "All"]
                ]
            });
            $('#tablaP').removeAttr('hidden');
        });

        const tablaLoad1 = document.getElementById("tablaLoad1");
        const carga = document.getElementById("carga");

        setTimeout(() => {
            carga.className = 'd-none';
            tablaLoad1.removeAttribute("hidden");
        }, 1500);


        $("#iddatatable1 tbody tr").click(function() {
            var customerId = $(this).find("td").eq(0).html();

            window.location.href = "v_reporte_gc.php?id_rep_gc=" + customerId;
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
    </script>



</body>

</html>