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

  $obj1= new Trabajo();
  $cliente = $obj1->get_poliza_by_cliente($ci_cliente); 


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
            <a href="javascript:history.back(-1);" data-tooltip="tooltip" data-placement="right" title="Ir la página anterior" class="btn btn-info btn-round"><- Regresar</a>

                <div class="col-md-auto col-md-offset-2">
                    <h1 class="title">Cliente: <?php echo $cliente[0]['nombre_t']." ".$cliente[0]['apellido_t']; ?></h1>  
                    <h2 class="title">Nº ID: <?php echo $cliente[0]['ci']; ?></h2>  
                </div>



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
                <table class="table table-hover table-striped table-bordered table-responsive" id="" >
                    <thead>
                        <tr style="background-color: green;color: white; font-weight: bold; font-size: 25px;text-align: center"><th colspan="10">Activas</th></tr>
						<tr style="background-color: #00bcd4;color: white; font-weight: bold;">
							<th>N° de Póliza</th>
							<th>Ramo</th>
                            <th>Cía</th>
                            <th>Nombre Asesor</th>
			                <th>Fecha Desde Rec</th>
			                <th>Fecha Hasta Rec</th>
                            <th>N° de Recibo</th>
                            <th>Prima</th>
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

                            $newDesde = date("d-m-Y", strtotime($cliente[$i]["f_desderecibo"]));
                            $newHasta = date("d-m-Y", strtotime($cliente[$i]["f_hastarecibo"]));

                            ?>
							<tr>
				                <td ><?php echo $cliente[$i]['cod_poliza']; ?></td>
				                <td ><?php echo utf8_encode($cliente[$i]['nramo']); ?></td>
                                <td ><?php echo utf8_encode($cliente[$i]['nomcia']); ?></td>
                                <td ><?php echo utf8_encode($cliente[$i]['idnom']); ?></td>
                                <td nowrap><?php echo $newDesde; ?></td>
                                <td nowrap><?php echo $newHasta; ?></td>
                                <td ><?php echo $cliente[$i]['cod_recibo']; ?></td>
                                <td nowrap><?php echo $currency.number_format($cliente[$i]['prima'],2); ?></td>
                                <td><a href="v_poliza.php?id_poliza=<?php echo $cliente[$i]['id_poliza']; ?>" data-tooltip="tooltip" data-placement="top" title="Ver" class="btn btn-info btn-sm" ><i class="fa fa-info" aria-hidden="true" ></i></a></td>
							</tr>
							<?php
                            }
						  }
                        }
                        ?>
                    </tbody>
                </table>
                        <?php
                        if ($contInact>0) {
						?>
                <table class="table table-hover table-striped table-bordered display table-responsive nowrap" id="" >
                            <tr style="background-color: red;color: white; font-weight: bold;font-size: 25px;text-align: center"><th colspan="10">Inactivas</th></tr>
                            <tr style="background-color: #00bcd4;color: white; font-weight: bold;">
                                <th>N° de Póliza</th>
                                <th>Ramo</th>
                                <th>Cía</th>
                                <th>Nombre Asesor</th>
                                <th>Fecha Desde Rec</th>
                                <th>Fecha Hasta Rec</th>
                                <th>N° de Recibo</th>
                                <th>Prima</th>
                                <th>Info</th>
                            </tr>
                        <?php
                        for ($i=0; $i < sizeof($cliente); $i++) { 
                            if ($cliente[$i]['f_hastapoliza'] <= date("Y-m-d")) {
                                if ($cliente[$i]['currency']==1) {
                                    $currency="$ ";
                                }else{$currency="Bs ";}

                            $newDesde = date("d-m-Y", strtotime($cliente[$i]["f_desderecibo"]));
                            $newHasta = date("d-m-Y", strtotime($cliente[$i]["f_hastarecibo"]));
                            ?>
                            <tr>
                                <td ><?php echo $cliente[$i]['cod_poliza']; ?></td>
                                <td ><?php echo utf8_encode($cliente[$i]['nramo']); ?></td>
                                <td ><?php echo utf8_encode($cliente[$i]['nomcia']); ?></td>
                                <td ><?php echo utf8_encode($cliente[$i]['idnom']); ?></td>
                                <td nowrap><?php echo $newDesde; ?></td>
                                <td nowrap><?php echo $newHasta; ?></td>
                                <td ><?php echo $cliente[$i]['cod_recibo']; ?></td>
                                <td nowrap><?php echo $currency.number_format($cliente[$i]['prima'],2); ?></td>
                                <td><a href="v_poliza.php?id_poliza=<?php echo $cliente[$i]['id_poliza']; ?>" data-tooltip="tooltip" data-placement="top" title="Ver" class="btn btn-info btn-sm" ><i class="fa fa-info" aria-hidden="true" ></i></a></td>
                            </tr>
                            <?php
                                }
                            }
                        }
                        ?>
					</tbody>
				</table>




                







    

                
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