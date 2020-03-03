<?php 
session_start();
if(isset($_SESSION['seudonimo'])) {

  }
    else {
        header("Location: ../sys/login.php");
        exit();
      }
      
  require_once("../class/clases.php");



  $id_cia = $_GET['id_cia'];

  $obj1= new Trabajo();
  $cia = $obj1->get_element_by_id('dcia','idcia',$id_cia); 



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php require('header.php');?>
    
    <style>
        .alertify .ajs-header {
            background-color:red;
        }
    </style>


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
                    <h1 class="title">Cía: <?= ($cia[0]['nomcia']); ?></h1>
                    <h2 class="title">RUC/Rif: <?= $cia[0]['rif']; ?></h2>  
                </div>


                <form class="form-horizontal" id="frmnuevo" action="e_cia_n.php" method="post" >

                <div class="table-responsive">
                <table class="table table-striped table-bordered display nowrap" id="iddatatable" >
					<thead style="background-color: #00bcd4;color: white; font-weight: bold;">
						<tr>
                            <th>Nombre Compañía</th>
                            <th>RUC/Rif</th>
                            <th>%Comisión</th>
                            <th hidden>id</th>
						</tr>
					</thead>

					<tbody >
                        <tr style="background-color: white">
                            <td><input type="text" class="form-control" name="nombre_cia" required data-toggle="tooltip" data-placement="bottom" title="Campo Obligatorio" value="<?= ($cia[0]['nomcia']); ?>" onkeyup="mayus(this);"></td>
                            <td><input type="text" class="form-control" name="rif" value="<?= $cia[0]['rif']; ?>"></td>
                            <td><input type="text" class="form-control" name="per_com" value="<?= $cia[0]['per_com']; ?>"></td>
                            <td hidden><input type="text" class="form-control" name="id_cia" value="<?= $cia[0]['idcia']; ?>"></td>
                        </tr>
					</tbody>
				</table>
                </div>


                <div class="table-responsive">
                <table class="table table-striped table-bordered" id="" >
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
                            $obj11= new Trabajo();
                            $contacto_cia = $obj11->get_element_by_id('contacto_cia','id_cia',$cia[0]['idcia']); 

                            for ($i=0; $i < sizeof($contacto_cia); $i++) { 
                           
                        ?>
                        <tr style="background-color: white">
                            <td ><input type="text" class="form-control" name="<?= 'nombre'.($i+1); ?>" value="<?= ($contacto_cia[$i]['nombre']); ?>" onkeyup="mayus(this);"></td>
                            <td ><input type="text" class="form-control" name="<?= 'cargo'.($i+1); ?>" value="<?= ($contacto_cia[$i]['cargo']); ?>" onkeyup="mayus(this);"></td>
                            <td ><input type="text" class="form-control" name="<?= 'tel'.($i+1); ?>" value="<?= $contacto_cia[$i]['tel']; ?>"></td>
                            <td ><input type="text" class="form-control" name="<?= 'cel'.($i+1); ?>" value="<?= $contacto_cia[$i]['cel']; ?>"></td>
                            <td ><input type="text" class="form-control" name="<?= 'email'.($i+1); ?>" value="<?= $contacto_cia[$i]['email']; ?>"></td>
                        </tr>
                        <?php
                            }
                            if ( sizeof($contacto_cia) < 5 ) {
                                $dif= 5-sizeof($contacto_cia);
                                for ($a=$i; $a < 5; $a++) { 
                            
                        ?>

                        <tr style="background-color: white">
                            <td ><input type="text" class="form-control" name="<?= 'nombre'.($a+1); ?>" onkeyup="mayus(this);"></td>
                            <td ><input type="text" class="form-control" name="<?= 'cargo'.($a+1); ?>" onkeyup="mayus(this);"></td>
                            <td ><input type="text" class="form-control" name="<?= 'tel'.($a+1); ?>"></td>
                            <td ><input type="text" class="form-control" name="<?= 'cel'.($a+1); ?>"></td>
                            <td ><input type="text" class="form-control" name="<?= 'email'.($a+1); ?>"></td>
                        </tr>

                        <?php
                                }
                            }
                        ?>
                    </tbody>
                </table>
                </div>

                





                <hr>
                <button type="submit" style="width: 100%" data-tooltip="tooltip" data-placement="bottom" title="Previsualizar" class="btn btn-success btn-lg" value="">Previsualizar Edición &nbsp;<i class="fa fa-check" aria-hidden="true"></i></button>
                <hr>

                </form>
                
                
                
                




    

                
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

    <script src="../bootstrap-datepicker/js/bootstrap-datepicker.js"></script>  
    <script src="../bootstrap-datepicker/locales/bootstrap-datepicker.es.min.js" charset="UTF-8"></script>

    




<script language="javascript">

    function mayus(e) {
        e.value = e.value.toUpperCase();
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