<?php
session_start();
if(isset($_SESSION['seudonimo'])) {

}
else {
    header("Location: login.php");
    exit();
}
    
    require_once("../class/clases.php");

    $fhoy=date("Y-m-d");
    $obj10= new Trabajo();
    $tarjeta = $obj10->get_tarjeta_venc($fhoy); 
    
    $contN=sizeof($tarjeta);


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php require('header.php');?> 
</head>

<body class="profile-page ">

    <?php require('navigation.php');?>




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

            <?php 
            if ($contN != 0) {
            ?>
            <div class="float-right">
                <a href="" data-tooltip="tooltip" data-placement="top" title="Ver Tarjeta de Crédito/Débido vencida" class="badge badge-warning navbar-badge" data-toggle="modal" data-target="#tarjetaV"><i class="fa fa-bell" aria-hidden="true"></i> <?php echo $contN;?></a>
            </div>
            <?php 
            }
            ?>
            
            <center><h1>Bienvenido <?php echo $_SESSION['seudonimo'];?> <i class="fa fa-user fa-lg"></i></h1></center>
            <hr>
                <div class="row">
                    <div class="ml-auto mr-auto">
                        <ul class="nav nav-pills nav-pills-icons" role="tablist">
                            <!--
                            color-classes: "nav-pills-primary", "nav-pills-info", "nav-pills-success", "nav-pills-warning","nav-pills-danger"
                        -->
                            <li class="nav-item m-auto">
                                <a class="nav-link" href="produccion.php">
                                    <i class="material-icons">dashboard</i> Producción
                                </a>
                            </li>
                            <li class="nav-item m-auto">
                                <a class="nav-link" href="renovacion.php">
                                    <i class="material-icons">alarm_on</i> Renovación
                                </a>
                            </li>
                            <?php
                                if ($permiso!=3) {
                            ?>
                            <li class="nav-item m-auto">
                                <a class="nav-link" href="administracion.php">
                                    <i class="material-icons">schedule</i> Administración
                                </a>
                            </li>
                            <?php
                                }
                            ?>
                            <li class="nav-item m-auto">
                                <a class="nav-link" href="graficos.php">
                                <i class="material-icons">trending_up</i> Gráficos
                                </a>
                            </li>
                            <li class="nav-item m-auto">
                                <a class="nav-link" href="#tasks-1" role="tab" data-toggle="tab">
                                    <i class="material-icons">list</i> Siniestros
                                </a>
                            </li>
                        </ul>
                        
                        <div class="tab-content tab-space">
                            <div class="tab-pane" id="schedule-1">
                                Módulo en contrucción Administración
                            </div>
                            <div class="tab-pane" id="tasks-1">
                                Módulo en contrucción Siniestros
                            </div>
                        </div>
                    </div>
                </div>
                    
            </div>
        </div>




        <?php require('footer_b.php');?>





        
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
    <!--  Plugin for Date Time Picker and Full Calendar Plugin  -->
    <script src="../assets/js/plugins/moment.min.js"></script>
    <!--	Plugin for the Datepicker, full documentation here: https://github.com/Eonasdan/bootstrap-datetimepicker -->
    <script src="../assets/js/plugins/bootstrap-datetimepicker.min.js"></script>
    <!--	Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
    <script src="../assets/js/plugins/nouislider.min.js"></script>
    <!-- Material Kit Core initialisations of plugins and Bootstrap Material Design Library -->
    <script src="../assets/js/material-kit.js?v=2.0.1"></script>
    <!-- Fixed Sidebar Nav - js With initialisations For Demo Purpose, Don't Include it in your project -->
    <script src="../assets/assets-for-demo/js/material-kit-demo.js"></script>

    <!-- Modal SEGUIMIENTO -->
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
                            </tr>
                        </thead>
                        <tbody >
                            <?php 
                                for ($i=0; $i < sizeof($tarjeta); $i++) { 
                                    $fechaV = date("d/m/Y", strtotime($tarjeta[$i]['fechaV']));
                            ?>
                            <tr>
                                <td hidden><?php echo $tarjeta[$i]['idrecibo']; ?></td>
                                <td><?php echo $tarjeta[$i]['n_tarjeta']; ?></td>
                                <td><?php echo $tarjeta[$i]['cvv']; ?></td>
                                <td><?php echo $fechaV; ?></td>
                                <td><?php echo $tarjeta[$i]['nombre_titular']; ?></td>
                            </tr>
                            <?php
                                }
                            ?>
                        </tbody>
                    </table>
                    </div>


                    <!-- AQUI VA LA TABLA SI LA POLIZA TIENE ALGUNA EDICION -->
                    <?php 

                    $obj99= new Trabajo();
                    $poliza_ed = $obj99->get_element_by_id('poliza_ed','id_poliza',$id_poliza); 

                    ?>
                </div>
            </div>
        </div>
    </div>


    <script>
        $(function () {
          $('[data-tooltip="tooltip"]').tooltip()
        });

        $( "#iddatatable tbody tr" ).dblclick(function() {
            var customerId = $(this).find("td").eq(0).html();   

            window.open ("v_poliza.php?id_poliza="+customerId ,'_blank');
        });
    </script>

    
</body>

</html>