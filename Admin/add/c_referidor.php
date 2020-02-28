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
  $referidor = $obj1->get_ultimo_referidor(); 

  

  if ($referidor[0]['cod']==null) {
      $cod_ref="R-1";
  }else{
    $u= $referidor[0]['cod'];
    $u=explode('-', $referidor[0]['cod']);
    $cod_ref = $u[0]."-".($u[1]+1);
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
                    <h1 class="title"><i class="fa fa-user-plus" aria-hidden="true"></i>&nbsp;Añadir Nuevo Referidor
                    </h1>  
                </div>


            
                
                <form class="form-horizontal" id="frmnuevo" autocomplete="off" action="../../procesos/agregarReferidor.php" method="post">
                    <div class="form-row table-responsive">      
                        <table class="table table-hover table-striped table-bordered" id="iddatatable" >
                            <thead style="background-color: #00bcd4;color: white; font-weight: bold;">
                                <tr>
                                    <th nowrap>Cod Referidor *</th>
                                    <th nowrap>N° ID *</th>
                                    <th nowrap>Nombre Completo *</th>
                                    <th nowrap>Cel *</th>
                                    <th nowrap>Cuenta *</th>
                                    <th nowrap>E-Mail *</th>
                                </tr>
                            </thead>

                            <tbody >
                                <tr style="background-color: white">
                                    <td><input type="text" class="form-control" name="cod" readonly="true" value="<?= $cod_ref;?> "></td>
                                    <td><input type="text" class="form-control validanumericos" name="id_r" required data-toggle="tooltip" data-placement="bottom" title="Campo Obligatorio [Sólo introducir números]"></td>
                                    <td><input onblur="cargarCuenta(this)" type="text" class="form-control" name="nombre_r" required onkeyup="mayus(this);" data-toggle="tooltip" data-placement="bottom" title="Campo Obligatorio"></td>
                                    <td><input type="text" class="form-control validanumericos1" name="cel" required data-toggle="tooltip" data-placement="bottom" title="Campo Obligatorio [Sólo introducir números]"></td>
                                    <td><input type="text" class="form-control" id="cuenta" name="cuenta" readonly="true"></td>
                                    <td><input type="email" class="form-control" id="email" name="email" required data-toggle="tooltip" data-placement="bottom" title="Campo Obligatorio" placeholder="ejemplo@email.com"></td>
                                </tr>

                                <tr style="background-color: #00bcd4;color: white; font-weight: bold;">
                                    <th>Banco *</th>
                                    <th>Tipo Cuenta</th>
                                    <th colspan="2">N° Cuenta *</th>
                                    <th></th>
                                    <th>Monto *</th>
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
                                    <td><select class="custom-select" name="currency" required>
                                            <option value="$">$</option>
                                            <option value="BsS">BsS</option>
                                            <option value="%">%</option>
                                        </select>
                                    </td>
                                    <td><input type="text" class="form-control validanumericos3" id="monto" name="monto" required data-toggle="tooltip" data-placement="bottom" title="Campo Obligatorio [Sólo introducir números y punto (.) como separador decimal]"></td>
                                </tr>

                                <tr style="background-color: #00bcd4;color: white; font-weight: bold;">
                                    <th>Forma de Pago</th>
                                    <th>Frecuencia de Pago</th>
                                    <th colspan="4">Observaciones</th>
                                </tr>
                                <tr style="background-color: white">
                                    <td><select class="custom-select" name="f_pago" required>
                                            <option value="EFECTIVO">EFECTIVO</option>
                                            <option value="TRANSFERENCIA">TRANSFERENCIA</option>
                                        </select>
                                    </td>
                                    <td><select class="custom-select" name="pago" required>
                                            <option value="UNICO">UNICO</option>
                                            <option value="PORCENTUAL">PORCENTUAL</option>
                                        </select>
                                    </td>
                                    <td colspan="4"><input type="text" class="form-control" id="obs" name="obs" onkeyup="mayus(this);"></td>
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
                    document.write(new Date().getFullYear())
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