<?php
session_start();
if (isset($_SESSION['seudonimo'])) { } else {
    header("Location: login.php");
    exit();
}

require_once("../../class/clases.php");

$obj1 = new Trabajo();
$ref = $obj1->get_gc_h_r();


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

        <div class="section">
            <div class="container">
                <a href="javascript:history.back(-1);" data-tooltip="tooltip" data-placement="right" title="Ir la página anterior" class="btn btn-info btn-round"><- Regresar
                </a>
                <div class="col-md-auto col-md-offset-2 text-center">
                    <h1 class="title">Listado pago de Referidores</h1>
                </div>

                </br></br>

                <?php 
                    if ($ref!='no') {    
                ?>

                <div class="table-responsive">
                    <div id="tablaDatatable"></div>
                </div>

                <?php 
                    }else{        
                ?>
                <div class="col-md-auto col-md-offset-2 text-center">
                    <h2 class="title text-danger">No se encuentran pagos a Referidores pendientes</h2>
                </div>
                <?php 
                    }       
                ?>


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
    <!--	Plugin for the Datepicker, full documentation here: https://github.com/Eonasdan/bootstrap-datetimepicker -->
    <script src="../../assets/js/plugins/bootstrap-datetimepicker.min.js"></script>
    <!--	Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
    <script src="../../assets/js/plugins/nouislider.min.js"></script>
    <!-- Material Kit Core initialisations of plugins and Bootstrap Material Design Library -->
    <script src="../../assets/js/material-kit.js?v=2.0.1"></script>
    <!-- Fixed Sidebar Nav - js With initialisations For Demo Purpose, Don't Include it in your project -->
    <script src="../../assets/assets-for-demo/js/material-kit-demo.js"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>


    <script>
        function eliminar(id_poliza) {

            alertify.confirm('!!', '¿Desea eliminar el pago al Referidor seleccionado?',
                function() {
                    console.log(id_poliza);

                    

                    $.ajax({
                    type:"POST",
                    data:"id_poliza=" + id_poliza,
                    url:"../../procesos/eliminarPagoR.php",
                    success:function(r){
                        if(r==1){
                            
                            alertify.success("Eliminado con Exito!!");
                            $('#tablaDatatable').load('t_pagosR.php');

                        }else{
                            alertify.error("Fallo al eliminar!");
                        }
                    }
                    });



                },
                function() {
                    alertify.error('Cancelado')
                }).set('labels', {
                ok: 'Sí',
                cancel: 'No'
            }).set({
                transition: 'zoom'
            }).show();
        }

        $("#iddatatable tbody tr").dblclick(function() {

            if ($(this).attr('class') != 'no-tocar') {
                var customerId = $(this).find("td").eq(0).html();


                window.open("../v_poliza.php?id_poliza=" + customerId, '_blank');
            }
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

        $(document).ready(function() {
            $(document).ready(function(){
                $('#tablaDatatable').load('t_pagosR.php');
            });

            
            //$('#tablaP').removeAttr('hidden');
        } );
    </script>


</body>

</html>