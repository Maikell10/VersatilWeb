<?php 
session_start();
if(isset($_SESSION['seudonimo'])) {

  }
    else {
        header("Location: login.php");
        exit();
      }
      
  require_once("../../class/clases.php");

  $obj1= new Trabajo();
  $asesor = $obj1->get_element('ena','cod'); 

  $estructura=$_GET['en'];

  if ($estructura==1) {
      $obj2= new Trabajo();
      $uAsesor = $obj2->get_ultimo_asesor(); 

      $u= $uAsesor[0]['cod'];

      $u=explode('-', $uAsesor[0]['cod']);
  }

  



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php require('header.php');?>


    <script type="text/javascript">
        $(document).ready(function() {
            $("form").keypress(function(e) {
                if (e.which == 13) {
                    return false;
                }
            });
        });
    </script>
</head>

<body class="profile-page ">

    <?php require('navigation.php');?>




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
            <div class="container" >
                <center>
                <div class="col-md-auto col-md-offset-2">
                    <h1 class="title"><i class="fa fa-user-plus" aria-hidden="true"></i>&nbsp;Añadir Nuevo Asesor
                    </h1>  
                </div>


            
                
                <form class="form-horizontal" id="frmnuevo" autocomplete="off" action="../../procesos/agregarAsesor.php" method="post">
                    <div class="form-row table-responsive">      
                        <table class="table table-hover table-striped table-bordered" id="iddatatable" >
                            <thead style="background-color: #00bcd4;color: white; font-weight: bold;">
                                <tr>
                                    <th>Cod Asesor *</th>
                                    <th>N° ID *</th>
                                    <th>Nombre Completo *</th>
                                    <th>E-Mail *</th>
                                    <th>Cel *</th>
                                </tr>
                            </thead>

                            <tbody >
                                <tr style="background-color: white">
                                    <td><input type="text" class="form-control" name="cod" readonly="true" value="<?= $u[0]."-".($u[1]+1);?> "></td>
                                    <td><input type="text" class="form-control validanumericos" name="id_a" required data-toggle="tooltip" data-placement="bottom" title="Campo Obligatorio [Sólo introducir números]"></td>
                                    <td><input type="text" class="form-control" name="nombre_a" required onkeyup="mayus(this);" data-toggle="tooltip" data-placement="bottom" title="Campo Obligatorio"></td>
                                    <td><input type="email" class="form-control" name="email" data-toggle="tooltip" data-placement="bottom" title="Campo Obligatorio" placeholder="ejemplo@email.com"></td>
                                    <td><input type="text" class="form-control validanumericos1" id="cel" name="cel" data-toggle="tooltip" data-placement="bottom" title="Campo Obligatorio [Sólo introducir números]"></td>
                                </tr>
                                
                                <tr style="background-color: #00bcd4;color: white; font-weight: bold;">
                                    <th>Banco *</th>
                                    <th>Tipo Cuenta</th>
                                    <th colspan="2">N° Cuenta *</th>
                                    
                                    <th>Observaciones</th>
                                </tr>
                                <tr style="background-color: white">
                                    <td><input type="text" class="form-control" id="banco" name="banco" required onkeyup="mayus(this);" data-toggle="tooltip" data-placement="bottom" title="Campo Obligatorio"></td>
                                    <td><select class="custom-select" name="tipo_cuenta" required>
                                            <option value="CORRIENTE">CORRIENTE</option>
                                            <option value="AHORRO">AHORRO</option>
                                            <option value="JURÍDICO">JURÍDICO</option>
                                        </select>
                                    </td>
                                    <td colspan="2"><input type="text" class="form-control validanumericos2" id="num_cuenta" name="num_cuenta" required data-toggle="tooltip" data-placement="bottom" title="Campo Obligatorio [Sólo introducir números]"></td>
                                    
                                    <td><input type="text" class="form-control" id="obs" name="obs" onkeyup="mayus(this);"></td>
                                </tr>

                                <tr style="background-color: #00bcd4;color: white; font-weight: bold;">
                                    <th colspan="2">%GC (Nuevo) *</th>
                                    <th>%GC (Renovación) *</th>
                                    <th>%GC Viajes (Nuevo) *</th>
                                    <th>%GC Viajes (Renovación) *</th>
                                </tr>
                                <tr style="background-color: white">
                                    <td colspan="2"><input type="text" class="form-control validanumericos3" id="gc" name="gc" required data-toggle="tooltip" data-placement="bottom" title="Campo Obligatorio [Sólo introducir números y punto (.) como separador decimal]"></td>
                                    <td><input type="text" class="form-control validanumericos4" id="gc_renov" name="gc_renov" required data-toggle="tooltip" data-placement="bottom" title="Campo Obligatorio [Sólo introducir números y punto (.) como separador decimal]"></td>
                                    <td><input type="text" class="form-control validanumericos5" id="viajes" name="viajes" required data-toggle="tooltip" data-placement="bottom" title="Campo Obligatorio [Sólo introducir números y punto (.) como separador decimal]"></td>
                                    <td><input type="text" class="form-control validanumericos6" id="viajes_renov" name="viajes_renov" required data-toggle="tooltip" data-placement="bottom" title="Campo Obligatorio [Sólo introducir números y punto (.) como separador decimal]"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <center>
                        <button type="submit" id="" class="btn btn-info btn-lg btn-round">Agregar nuevo</button>
                    </center>
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

    



    <script type="text/javascript">
        $(document).ready(function(){
            $('#btnAgregarnuevo').click(function(){
                datos=$('#frmnuevo').serialize();

                $.ajax({
                    type:"POST",
                    data:datos,
                    url:"../../procesos/agregarAsesor.php",
                    success:function(r){
                        if(r==1){
                            $('#frmnuevo')[0].reset();
                            $('#tablaDatatable').load('../t_asesor.php');
                            alertify.success("agregado con exito :D");
                        }else{
                            alertify.error("Fallo al agregar :(");
                        }
                    }
                });
            });
        });




        onload = function(){ 
          var ele = document.querySelectorAll('.validanumericos')[0];
          var ele1 = document.querySelectorAll('.validanumericos1')[0];
          var ele2 = document.querySelectorAll('.validanumericos2')[0];
          var ele3 = document.querySelectorAll('.validanumericos3')[0];
          var ele4 = document.querySelectorAll('.validanumericos4')[0];
          var ele5 = document.querySelectorAll('.validanumericos5')[0];
          var ele6 = document.querySelectorAll('.validanumericos6')[0];

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
          ele4.onkeypress = function(e4) {
             if(isNaN(this.value+String.fromCharCode(e4.charCode)))
                return false;
          }
          ele4.onpaste = function(e4){
             e4.preventDefault();
          }
          ele5.onkeypress = function(e5) {
             if(isNaN(this.value+String.fromCharCode(e5.charCode)))
                return false;
          }
          ele5.onpaste = function(e5){
             e5.preventDefault();
          }
          ele6.onkeypress = function(e6) {
             if(isNaN(this.value+String.fromCharCode(e6.charCode)))
                return false;
          }
          ele6.onpaste = function(e6){
             e6.preventDefault();
          }
        }


        function cargarCuenta(nombre_r){
            $('#cuenta').val("R. "+$(nombre_r).val());
        }

        function mayus(e) {
            e.value = e.value.toUpperCase();
        }
    </script>
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