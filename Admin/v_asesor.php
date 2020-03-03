<?php 
session_start();
if(isset($_SESSION['seudonimo'])) {

  }
    else {
        header("Location: ../sys/login.php");
        exit();
      }
      
  require_once("../class/clases.php");

  $cod_asesor = $_GET['cod_asesor'];

  $obj1= new Trabajo();
  $asesor = $obj1->get_element_by_id('ena','cod',$cod_asesor); 
  $nombre=$asesor[0]['idnom'];
  $id=$asesor[0]['idena'];
  $a=1;

    if (sizeof($asesor)==null) {
        $ob3= new Trabajo();
        $asesor = $ob3->get_element_by_id('enp','cod',$cod_asesor); 
        $nombre=$asesor[0]['nombre'];
        $id=$asesor[0]['id_enp'];
        $a=2;
    }

    if (sizeof($asesor)==null) {
        $ob3= new Trabajo();
        $asesor = $ob3->get_element_by_id('enr','cod',$cod_asesor); 
        $nombre=$asesor[0]['nombre'];
        $id=$asesor[0]['id_enr'];
        $a=3;
    }


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

                <div class="col-md-auto col-md-offset-2">
                    <h1 class="title">Asesor: <?= utf8_encode($nombre); ?></h1>  
                    <?php 
                    if ($asesor[0]['act']==0) {
                    ?>
                    <h2 class="float-right text-danger">Inactivo &nbsp;<i class="fa fa-times" aria-hidden="true"></i></h2>
                    <?php
                    }if ($asesor[0]['act']==1) {
                    ?>
                    <h2 class="float-right text-success">Activo &nbsp;<i class="fa fa-check" aria-hidden="true"></i></h2>
                    <?php
                    }
                    ?>
                    <h2 class="title">Cod: <?= $asesor[0]['cod']; ?></h2>  
                </div>

                

                <div class="table-responsive">
                <table class="table table-hover table-striped table-bordered" id="" >
                    <thead>
						<tr style="background-color: #00bcd4;color: white; font-weight: bold;">
							<th>ID Asesor</th>
                            <th>Nombre Asesor</th>
                            <th>E-Mail</th>
                            <th>Cel</th>
						</tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td ><?= $asesor[0]['id']; ?></td>
                            <td ><?= utf8_encode($nombre); ?></td>
                            <td><a href=mailto:<?= $asesor[0]['email']; ?> data-toggle="tooltip" data-placement="bottom" title="Enviar Correo"><?= $asesor[0]['email']; ?></a></td>
                            <td><?= $asesor[0]['cel']; ?></td>
                        </tr>

                        <tr style="background-color: #00bcd4;color: white; font-weight: bold;">
							<th>Banco</th>
                            <th>Tipo de Cuenta</th>
                            <th colspan="2">N Cuenta</th>
						</tr>
                        <tr>
                            <td ><?= $asesor[0]['banco']; ?></td>
                            <td ><?= $asesor[0]['tipo_cuenta']; ?></td>
                            <td colspan="2"><?= $asesor[0]['num_cuenta']; ?></td>
                        </tr>

                        <?php
                        if ($a==3) {
                        ?>

                        <tr style="background-color: #00bcd4;color: white; font-weight: bold;">
							<th>Forma de Pago</th>
                            <th>Frecuencia de Pago</th>
                            <th colspan="2">Monto</th>
						</tr>
                        <tr>
                            <td ><?= $asesor[0]['f_pago']; ?></td>
                            <td ><?= $asesor[0]['pago']; ?></td>
                            <td colspan="2"><?= $asesor[0]['monto']; ?></td>
                        </tr>

                        <?php
                        }
                        ?>

                        <tr style="background-color: #00bcd4;color: white; font-weight: bold;">
							<th colspan="3">Observaciones</th>
                            <th>Estatus</th>
						</tr>
                        <tr>
                            <td colspan="3"><?= utf8_encode($asesor[0]['obs']); ?></td>
                            <td><?php   $estatus='Inactivo';
                                        if ($asesor[0]['act']==1) {
                                            $estatus='Activo';
                                        }
                            echo $estatus; ?></td>
                        </tr>
                        
                        <?php
                        if ($asesor[0]['nopre1']!=null) {
                            
                        
                        ?>
                        <tr style="background-color: #00bcd4;color: white; font-weight: bold;">
                            <th>%GC (Nuevo)</th>
                            <th>%GC (Renovación)</th>
                            <th>%GC Viajes (Nuevo)</th>
                            <th>%GC Viajes (Renovación)</th>
                        </tr>
                        <tr>
                            <td><?= $asesor[0]['nopre1']." %"; ?></td>
                            <td><?= $asesor[0]['nopre1_renov']." %"; ?></td>
                            <td><?= $asesor[0]['gc_viajes']." %"; ?></td>
                            <td><?= $asesor[0]['gc_viajes_renov']." %"; ?></td>
                        </tr>
                        <?php
                        }
                        ?>

                    </tbody>
                </table>
                </div>


                <hr>
                <center>
                <a  href="b_poliza1.php?anio=&mes=&asesor%5B%5D=<?= $asesor[0]['cod'];?>" data-tooltip="tooltip" data-placement="top" title="Ver" class="btn btn-info btn-lg">Ver Pólizas Asesor  &nbsp;<i class="fa fa-eye" aria-hidden="true"></i></a>

                <a  href="e_asesor.php?id_asesor=<?= $id;?>&a=<?= $a;?>" data-tooltip="tooltip" data-placement="top" title="Editar" class="btn btn-success btn-lg">Editar Asesor  &nbsp;<i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>


                <?php if ($permiso==1) { ?>
                <button  onclick="eliminarDatos('<?= $id; ?>', '<?= $a; ?>')" data-tooltip="tooltip" data-placement="top" title="Eliminar" class="btn btn-danger btn-lg">Eliminar Asesor  &nbsp;<i class="fa fa-trash" aria-hidden="true"></i></button>
                <?php }?>
                </center>
                <hr>
                        
    

                
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

    <script language="javascript">

    function eliminarDatos(idasesor, a){
            alertify.confirm('Eliminar Asesor', '¿Seguro de eliminar este Asesor?', function(){
                $('.alertify .ajs-header').css('background-color', 'green');
               
                $.ajax({
                    type:"POST",
                    data:"idasesor=" + idasesor ,
                    url:"../procesos/eliminarAsesor.php?a="+a,
                    success:function(r){
                        if(r==1){
                            alertify.alert('Eliminado con exito !', 'El Asesor fue eliminado con exito', function(){
                                alertify.success('OK');
                                window.close();
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


    function Exportar(table, name){
        var uri = 'data:application/vnd.ms-excel;base64,'
        , template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><meta http-equiv="content-type" content="application/vnd.ms-excel; charset=UTF-8"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>'
        , base64 = function (s) { return window.btoa(unescape(encodeURIComponent(s))) }
        , format = function (s, c) { return s.replace(/{(\w+)}/g, function (m, p) { return c[p]; }) }
        if (!table.nodeType) table = document.getElementById(table)
         var ctx = { worksheet: name || 'Worksheet', table: table.innerHTML }
         window.location.href = uri + base64(format(template, ctx))
        }
    </script>


</body>

</html>