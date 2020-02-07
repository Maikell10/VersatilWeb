<?php 
session_start();
if(isset($_SESSION['seudonimo'])) {

  }
    else {
        header("Location: login.php");
        exit();
      }
      
  require_once("../class/clases.php");

  $ci_cliente = $_GET['id_cliente'];
  $id_titular = $_GET['id_titu'];

  $obj1= new Trabajo();
  $cliente = $obj1->get_poliza_by_cliente($ci_cliente); 

  $obj2= new Trabajo();
  $datos_c = $obj2->get_element_by_id('titular','id_titular',$id_titular);


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
                    <h1 class="title">Cliente: <?php echo utf8_encode($datos_c[0]['nombre_t'])." ".utf8_encode($datos_c[0]['apellido_t']); ?></h1>  
                    <h2 class="title">Nº ID: <?php echo $datos_c[0]['ci']; ?></h2>  
                </div>

                <hr>
                <center>
                <a  href="e_cliente.php?id_titu=<?php echo $id_titular;?>"" data-tooltip="tooltip" data-placement="top" title="Editar" class="btn btn-success btn-lg">Editar Cliente  &nbsp;<i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                </center>
                <hr>

                <?php
                $contAct=0;
                $contInact=0;
                $currency="";
                    for ($i=0; $i < sizeof($cliente); $i++) { 
                        if ($cliente[$i]['f_hastapoliza'] >= date("Y-m-d")) {
                            $contAct=$contAct+1;
                        }
                    }
                    for ($i=0; $i < sizeof($cliente); $i++) { 
                        if ($cliente[$i]['f_hastapoliza'] <= date("Y-m-d")) {
                            $contInact=$contInact+1;
                        }
                    }
                ?>

                
                    <?php
                        if ($contAct>0) {
                    ?>

                <div class="table-responsive">
                <table class="table table-hover table-striped table-bordered" id="" >
                    <thead>
                        <tr style="background-color: green;color: white; font-weight: bold; font-size: 25px;text-align: center"><th colspan="10">Activas</th></tr>
						<tr style="background-color: #00bcd4;color: white; font-weight: bold;">
							<th>N° de Póliza</th>
							<th>Ramo</th>
                            <th>Cía</th>
                            <th>Nombre Asesor</th>
			                <th>Fecha Desde Póliza</th>
			                <th>Fecha Hasta Póliza</th>
                            <th>Prima Suscrita</th>
                            <th>Info</th>
						</tr>
                    </thead>
                    <tbody>
                        <?php
                        for ($i=0; $i < sizeof($cliente); $i++) { 
                            if ($cliente[$i]['f_hastapoliza'] >= date("Y-m-d")) {
                                if ($cliente[$i]['currency']==1) {
                                    $currency="$ ";
                                }else{$currency="Bs ";}

                            $newDesde = date("d-m-Y", strtotime($cliente[$i]["f_desdepoliza"]));
                            $newHasta = date("d-m-Y", strtotime($cliente[$i]["f_hastapoliza"]));

                            ?>
							<tr>
				                <td ><?php echo $cliente[$i]['cod_poliza']; ?></td>
				                <td ><?php echo utf8_encode($cliente[$i]['nramo']); ?></td>
                                <td ><?php echo ($cliente[$i]['nomcia']); ?></td>
                                <td ><?php echo utf8_encode($cliente[$i]['idnom']); ?></td>
                                <td nowrap><?php echo $newDesde; ?></td>
                                <td nowrap><?php echo $newHasta; ?></td>
                                <td nowrap><?php echo $currency.number_format($cliente[$i]['prima'],2); ?></td>
                                <td><a href="v_poliza.php?id_poliza=<?php echo $cliente[$i]['id_poliza']; ?>" data-tooltip="tooltip" data-placement="top" title="Ver" class="btn btn-info btn-sm" target="_blank"><i class="fa fa-info" aria-hidden="true"></i></a></td>
							</tr>
							<?php
                            }
						  }
                        ?>
                    </tbody>
                </table>
                </div>
                        <?php
                        }
                        if ($contInact>0) {
						?>

                <div class="table-responsive">
                <table class="table table-hover table-striped table-bordered display" id="" >
                            <tr style="background-color: red;color: white; font-weight: bold;font-size: 25px;text-align: center"><th colspan="10">Inactivas</th></tr>
                            <tr style="background-color: #00bcd4;color: white; font-weight: bold;">
                                <th>N° de Póliza</th>
                                <th>Ramo</th>
                                <th>Cía</th>
                                <th>Nombre Asesor</th>
                                <th>Fecha Desde Póliza</th>
                                <th>Fecha Hasta Póliza</th>
                                <th>Prima Suscrita</th>
                                <th>Info</th>
                            </tr>
                        <?php
                        for ($i=0; $i < sizeof($cliente); $i++) { 
                            if ($cliente[$i]['f_hastapoliza'] <= date("Y-m-d")) {
                                if ($cliente[$i]['currency']==1) {
                                    $currency="$ ";
                                }else{$currency="Bs ";}

                            $newDesde = date("d-m-Y", strtotime($cliente[$i]["f_desdepoliza"]));
                            $newHasta = date("d-m-Y", strtotime($cliente[$i]["f_hastapoliza"]));
                            ?>
                            <tr>
                                <td ><?php echo $cliente[$i]['cod_poliza']; ?></td>
                                <td ><?php echo utf8_encode($cliente[$i]['nramo']); ?></td>
                                <td ><?php echo ($cliente[$i]['nomcia']); ?></td>
                                <td ><?php echo utf8_encode($cliente[$i]['idnom']); ?></td>
                                <td nowrap><?php echo $newDesde; ?></td>
                                <td nowrap><?php echo $newHasta; ?></td>
                                <td nowrap><?php echo $currency.number_format($cliente[$i]['prima'],2); ?></td>
                                <td><a href="v_poliza.php?id_poliza=<?php echo $cliente[$i]['id_poliza']; ?>" data-tooltip="tooltip" data-placement="top" title="Ver" class="btn btn-info btn-sm" target="_blank"><i class="fa fa-info" aria-hidden="true" ></i></a></td>
                            </tr>
                            <?php
                                }
                            }
                            ?>
					</tbody>
				</table>
                </div>

                <?php
                    }
                ?>


                <div class="col-md-auto col-md-offset-2">
                    <h2 class="title">Datos del Cliente</h2>  
                </div>

                <div class="table-responsive">
                <table class="table table-hover table-striped table-bordered" id="iddatatable" >
                    <thead style="background-color: #00bcd4;color: white; font-weight: bold;">
                        <tr>
                            <th>Cédula</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Fecha Nacimiento</th>
                        </tr>
                    </thead>
                    <tbody >
                        <?php

                            $originalFnac = $datos_c[0]['f_nac'];
                            $newFnac = date("d/m/Y", strtotime($originalFnac));
                           

                            ?>
                            <tr >
                                <td><?php echo $datos_c[0]['ci']; ?></td>
                                <td><?php echo utf8_encode($datos_c[0]['nombre_t']); ?></td>
                                <td><?php echo utf8_encode($datos_c[0]['apellido_t']); ?></td>
                                <td><?php echo $newFnac; ?></td>
                            </tr>
                            <tr style="background-color: #00bcd4;color: white; font-weight: bold;">
                                <th>Celular</th>
                                <th>Teléfono</th>
                                <th colspan="2">email</th>
                            </tr>
                            <tr >
                                <td><?php echo $datos_c[0]['cell']; ?></td>
                                <td><?php echo $datos_c[0]['telf']; ?></td>
                                <td colspan="2"><a href=mailto:<?php echo $datos_c[0]['email']; ?> data-toggle="tooltip" data-placement="bottom" title="Enviar Correo"><?php echo $datos_c[0]['email']; ?></a></td>
                            </tr>
                            <tr style="background-color: #00bcd4;color: white; font-weight: bold;">
                                <th colspan="4">Dirección</th>
                            </tr>
                            <tr >
                                <td colspan="4"><?php echo utf8_encode($datos_c[0]['direcc']); ?></td>
                            </tr>
                    </tbody>
                </table>
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