<?php 
session_start();
if(isset($_SESSION['seudonimo'])) {

  }
    else {
        header("Location: ../sys/login.php");
        exit();
      }
      
  require_once("../class/clases.php");



  $id_asesor = $_GET['id_asesor'];
  $a = $_GET['a'];


    if ($a==1) {
        $obj1= new Trabajo();
        $asesor = $obj1->get_element_by_id('ena','idena',$id_asesor); 
        $nombre=$asesor[0]['idnom'];
    }

    if ($a==2) {
        $ob3= new Trabajo();
        $asesor = $ob3->get_element_by_id('enp','id_enp',$id_asesor); 
        $nombre=$asesor[0]['nombre'];
    }

    if ($a==3) {
        $ob3= new Trabajo();
        $asesor = $ob3->get_element_by_id('enr','id_enr',$id_asesor); 
        $nombre=$asesor[0]['nombre'];
    }

 

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
                    <h1 class="title">Asesor: <?= utf8_encode($nombre); ?></h1>  
                    <h2 class="title">Cod: <?= $asesor[0]['cod']; ?></h2>  
                </div>


                <form class="form-horizontal" id="frmnuevo" action="e_asesor_n.php" method="post" autocomplete="off">

                <div class="table-responsive">
                <table class="table table-striped table-bordered display nowrap" id="iddatatable" >
					<thead style="background-color: #00bcd4;color: white; font-weight: bold;">
						<tr>
                            <th>ID Asesor</th>
                            <th>Nombre Asesor</th>
                            <th>E-Mail</th>
                            <th>Cel</th>
                            <th hidden>id</th>
                            <th hidden>a</th>
						</tr>
					</thead>

					<tbody >
                        <tr style="background-color: white">
                            <td><input type="number" step="0.01" class="form-control" name="id" required value="<?= $asesor[0]['id']; ?>"></td>
                            <td><input type="text" class="form-control" name="nombre" required value="<?= utf8_encode($nombre); ?>" onkeyup="mayus(this);"></td>
                            <td><input type="text" class="form-control" name="email" required value="<?= $asesor[0]['email']; ?>" ></td>
                            <td><input type="text" class="form-control" name="cel" required value="<?= $asesor[0]['cel']; ?>" ></td>
                            <td hidden><input type="text" class="form-control" name="id_asesor" required value="<?= $id_asesor; ?>" ></td>
                            <td hidden><input type="text" class="form-control" name="a" required value="<?= $a; ?>" ></td>
                        </tr>
                        <tr style="background-color: #00bcd4;color: white; font-weight: bold;">
                            <th>Banco</th>
                            <th>Tipo de Cuenta</th>
                            <th colspan="2">N Cuenta</th>
                        </tr>
                        <tr style="background-color: white">
                            <td><input type="text" class="form-control" name="banco" required  value="<?= $asesor[0]['banco']; ?>"></td>
                            <td><input type="text" class="form-control" name="tipo_cuenta" required value="<?= $asesor[0]['tipo_cuenta']; ?>"></td>
                            <td colspan="2"><input type="text" class="form-control" name="num_cuenta" required value="<?= $asesor[0]['num_cuenta']; ?>" ></td>
                        </tr>

                        <?php
                        if ($a==3) {
                        ?>

                        <tr style="background-color: #00bcd4;color: white; font-weight: bold;">
							<th>Forma de Pago</th>
                            <th>Frecuencia de Pago</th>
                            <th colspan="2">Monto</th>
						</tr>
                        <tr style="background-color: white">
                            <td><select class="custom-select" name="f_pago" id="f_pago">
                                    <option value="EFECTIVO">EFECTIVO</option>
                                    <option value="TRANSFERENCIA">TRANSFERENCIA</option>
                            </select></td>
                            <td><select class="custom-select" name="pago" id="pago">
                                    <option value="UNICO">UNICO</option>
                                    <option value="PORCENTUAL">PORCENTUAL</option>
                            </select></td>
                            <td colspan="2"><input type="text" class="form-control validanumericos3" id="monto" name="monto" required data-toggle="tooltip" data-placement="bottom" title="Campo Obligatorio [Sólo introducir números y punto (.) como separador decimal]" value="<?= $asesor[0]['monto']; ?>"></td>
                        </tr>

                        <?php
                        }
                        ?>

                        <tr style="background-color: #00bcd4;color: white; font-weight: bold;">
                            <th colspan="3">Observaciones</th>
                            <th>Estatus</th>
                        </tr>
                        <tr style="background-color: white">
                            <td colspan="3"><input type="text" class="form-control" name="obs" required value="<?= $asesor[0]['obs']; ?>"></td>
                            <td><select name="act" id="act" class="custom-select">
                                <option value="0">Inactivo</option>
                                <option value="1">Activo</option>
                            </select></td>
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
                            <td><input type="text" class="form-control validanumericos" name="nopre1" required value="<?= $asesor[0]['nopre1']; ?>"></td>
                            <td><input type="text" class="form-control validanumericos1" name="nopre1_renov" required value="<?= $asesor[0]['nopre1_renov']; ?>"></td>
                            <td><input type="text" class="form-control validanumericos2" name="gc_viajes" required value="<?= $asesor[0]['gc_viajes']; ?>"></td>
                            <td><input type="text" class="form-control validanumericos3" name="gc_viajes_renov" required value="<?= $asesor[0]['gc_viajes_renov']; ?>"></td>
                        </tr>
                        <?php
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

    $(document).ready(function(){

        document.getElementById("act").value = "<?= $asesor[0]['act'];?>";
        document.getElementById("pago").value =  "<?= $asesor[0]['pago'];?>";
        document.getElementById("f_pago").value = "<?= $asesor[0]['f_pago'];?>";
        
    });

    onload = function(){ 
          var ele = document.querySelectorAll('.validanumericos')[0];
          var ele1 = document.querySelectorAll('.validanumericos1')[0];
          var ele2 = document.querySelectorAll('.validanumericos2')[0];
          var ele3 = document.querySelectorAll('.validanumericos3')[0];

          ele.onkeypress = function(e) {
             if(isNaN(this.value+String.fromCharCode(e.charCode)))
                return false;
          }
          ele.onpaste = function(e){
             e.preventDefault();
          }
          ele1.onkeypress = function(e1) {
             if(isNaN(this.value+String.fromCharCode(e1.charCode)))
                return false;
          }
          ele1.onpaste = function(e1){
             e1.preventDefault();
          }
          ele2.onkeypress = function(e2) {
             if(isNaN(this.value+String.fromCharCode(e2.charCode)))
                return false;
          }
          ele2.onpaste = function(e2){
             e2.preventDefault();
          }
          ele3.onkeypress = function(e3) {
             if(isNaN(this.value+String.fromCharCode(e3.charCode)))
                return false;
          }
          ele3.onpaste = function(e3){
             e3.preventDefault();
          }
        }


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