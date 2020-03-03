<?php
session_start();
if (isset($_SESSION['seudonimo'])) {
} else {
    header("Location: ../sys/login.php");
    exit();
}

require_once("../class/clases.php");

$id_cia = $_GET['id_cia'];

$obj1 = new Trabajo();
$cia = $obj1->get_element_by_id('dcia', 'idcia', $id_cia);


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

                <div class="col-md-auto col-md-offset-2">
                    <h1 class="title">Cía: <?= ($cia[0]['nomcia']); ?></h1>
                    <h2 class="title">RUC/Rif: <?= $cia[0]['rif']; ?></h2>
                </div>




                <div class="table-responsive">
                    <table class="table table-hover table-striped table-bordered" id="">
                        <thead>
                            <tr style="background-color: #00bcd4;color: white; font-weight: bold;">
                                <th>Nombre Compañía</th>
                                <th>RUC/Rif</th>
                                <th>%Comisión</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><?= ($cia[0]['nomcia']); ?></td>
                                <td><?= $cia[0]['rif']; ?></td>
                                <td><?= number_format($cia[0]['per_com'],2).' %'; ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover table-striped table-bordered" id="">
                        <thead>
                            <tr style="background-color: #00bcd4;color: white; font-weight: bold;">
                                <th>Nombre Contacto</th>
                                <th>Cargo</th>
                                <th>Tel</th>
                                <th>Cel</th>
                                <th>E-Mail</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $obj11 = new Trabajo();
                            $contacto_cia = $obj11->get_element_by_id('contacto_cia', 'id_cia', $cia[0]['idcia']);

                            for ($i = 0; $i < sizeof($contacto_cia); $i++) {

                            ?>
                                <tr>
                                    <td><?= $contacto_cia[$i]['nombre']; ?></td>
                                    <td><?= utf8_decode($contacto_cia[$i]['cargo']); ?></td>
                                    <td><?= $contacto_cia[$i]['tel']; ?></td>
                                    <td><?= $contacto_cia[$i]['cel']; ?></td>
                                    <td><?= $contacto_cia[$i]['email']; ?></td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>

                <hr>

                <center><a href="e_cia.php?id_cia=<?= $cia[0]['idcia']; ?>" data-tooltip="tooltip" data-placement="top" title="Editar" class="btn btn-success btn-lg text-center">Editar Cía &nbsp;<i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></center>

                <hr>

                <?php
                //Si es preferencial

                $obj2 = new Trabajo();
                $f_cia_pref = $obj2->get_f_cia_pref($cia[0]['idcia']);

                if ($f_cia_pref[0]['f_desde_pref'] == 0) {
                    //No es preferencial
                } else {
                    //Si es preferencial


                ?>
                    <div class="col-md-auto col-md-offset-2">
                        <h2 class="title">Fechas en que es preferencial (Mayor a Menor)</h2>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-hover table-striped table-bordered" id="">
                            <thead>
                                <tr style="background-color: #00bcd4;color: white; font-weight: bold;">
                                    <th>Fecha Desde Preferencial</th>
                                    <th>Fecha Hasta Preferencial</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                for ($i = 0; $i < sizeof($f_cia_pref); $i++) {

                                    $desde_prefn = date("d/m/Y", strtotime($f_cia_pref[$i]['f_desde_pref']));
                                    $hasta_prefn = date("d/m/Y", strtotime($f_cia_pref[$i]['f_hasta_pref']));

                                ?>
                                    <tr>
                                        <td><?= $desde_prefn; ?></td>
                                        <td><?= $hasta_prefn; ?></td>
                                        <td style="text-align: center;">
                                            <a data-tooltip="tooltip" data-placement="top" title="Ver Preferencial" href="v_pref.php?id_cia=<?= $cia[0]['idcia']; ?>&f_desde=<?= $f_cia_pref[$i]['f_desde_pref']; ?>&f_hasta=<?= $f_cia_pref[$i]['f_hasta_pref']; ?>" class="btn btn-success btn-sm btn-round"><i class="fa fa-check-circle" aria-hidden="true"></i></a>
                                            <a onclick="eliminarCiaPref('<?= $cia[0]['idcia']; ?>','<?= $f_cia_pref[$i]['f_desde_pref']; ?>','<?= $f_cia_pref[$i]['f_hasta_pref']; ?>')" data-tooltip="tooltip" data-placement="top" title="Eliminar" class="btn btn-danger btn-sm btn-round text-white"><i class="fa fa-trash-alt" aria-hidden="true"></i></a>
                                        </td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
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

        function eliminarCiaPref(idcia,f_desde,f_hasta){
            alertify.confirm('Eliminar Datos de Preferencial', '¿Seguro de eliminar estos datos de la Cía en la fecha preferencial seleccionada?', function(){
                $('.alertify .ajs-header').css('background-color', 'green');
                console.log(idcia);
                $.ajax({
                    type:"POST",
                    data:"idcia=" + idcia + "&f_desde="+ f_desde + "&f_hasta="+ f_hasta,
                    url:"../procesos/eliminarCiaPref.php",
                    success:function(r){
                        if(r==1){
                            alertify.alert('Eliminada con exito !', 'Fue eliminado con exito', function(){
                                alertify.success('OK');
                                window.location.replace("v_cia.php?id_cia="+idcia);
                            });
                        }else{
                            alertify.error("No se pudo eliminar");
                        }
                    }
                });

            }
            , function(){

            });
        }
    </script>


</body>

</html>