<?php

session_start();
if(isset($_SESSION['seudonimo'])) {

  }
    else {
        header("Location: login.php");
        exit();
      }
      
  require_once("../class/clases.php");

	$id_asesor=$_POST['id_asesor'];
    $a=$_POST['a'];

    $id=$_POST['id'];
    $nombre=$_POST['nombre'];
	$cel=$_POST['cel'];
	$email=$_POST['email'];
    $banco=$_POST['banco'];
    $tipo_cuenta=$_POST['tipo_cuenta'];
    $num_cuenta=$_POST['num_cuenta'];
    $obs=$_POST['obs'];
    $act=$_POST['act'];

    $estatus='Inactivo';
    if ($act==1) {
        $estatus='Activo';
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
            <div class="container" >
            <a href="javascript:history.back(-1);" data-tooltip="tooltip" data-placement="right" title="Ir la página anterior" class="btn btn-info btn-round"><- Regresar</a>

                <center>
                <div class="col-md-auto col-md-offset-2">
                    <h1 class="title"><i class="fa fa-user" aria-hidden="true"></i>&nbsp;Previsualizar Edición del Asesor
                    </h1>  
                </div>


            
                
                <form class="form-horizontal" id="frmnuevo" >
                    <div class="table-responsive">      
                        <table class="table table-hover table-striped table-bordered" id="iddatatable" >
                            <thead style="background-color: #92ACC4;color: white; font-weight: bold;">
                                <tr>
                                    <th>ID Asesor</th>
                                    <th>Nombre Asesor</th>
                                    <th>E-Mail</th>
                                    <th>Cel</th>
                                </tr>
                            </thead>

                            <tbody >
                                <div class="form-group col-md-12">
                                <tr >
                                    <td><input type="text" class="form-control" name="id" readonly="readonly" value="<?php echo $id;?>"></td>
                                    <td><input type="text" class="form-control" name="nombre" readonly="readonly" value="<?php echo $nombre;?>"></td>
                                    <td><input type="text" class="form-control" name="email" readonly="readonly" value="<?php echo $email;?>"></td>
                                    <td><input type="text" class="form-control" name="cel" readonly="readonly" value="<?php echo $cel;?>"></td>
                                </tr>

                                <tr style="background-color: #92ACC4;color: white; font-weight: bold;">
                                    <th>Banco</th>
                                    <th>Tipo de Cuenta</th>
                                    <th colspan="2">N Cuenta</th>
                                </tr>
                                <tr>
                                    <td><input type="text" class="form-control" name="banco" readonly="readonly" value="<?php echo $banco;?>"></td>
                                    <td><input type="text" class="form-control" name="tipo_cuenta" readonly="readonly" value="<?php echo $tipo_cuenta;?>"></td>
                                    <td colspan="2"><input type="text" class="form-control" name="num_cuenta" readonly="readonly" value="<?php echo $num_cuenta;?>"></td>
                                </tr>
                                    
                                <tr style="background-color: #92ACC4;color: white; font-weight: bold;">
                                    <th colspan="3">Observaciones</th>
                                    <th>Estatus</th>
                                </tr>

                                <tr>
                                    <td colspan="3"><input type="text" class="form-control" name="obs" readonly="readonly" value="<?php echo $obs;?>"></td>
                                    <td><input type="text" class="form-control" name="act" readonly="readonly" value="<?php echo $estatus;?>"></td>
                                </tr>

                               

                               

                                </div>
                            </tbody>
                        </table>
                    </div>



                    


                      <center>
                        <a name="enlace" href="e_asesor_nn.php?id_asesor=<?php echo $id_asesor;?>&nombre=<?php echo $nombre;?>&email=<?php echo $email;?>&id=<?php echo $id;?>&cel=<?php echo $cel;?>&banco=<?php echo $banco;?>&tipo_cuenta=<?php echo $tipo_cuenta;?>&num_cuenta=<?php echo $num_cuenta;?>&obs=<?php echo $obs;?>&a=<?php echo $a;?>&act=<?php echo $act;?>" class="btn btn-info btn-lg btn-round">Confirmar</a></center>
                        
                </form>
                </center>
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
    <!--	Plugin for the Datepicker, full documentation here: https://github.com/Eonasdan/bootstrap-datetimepicker -->
    <script src="../assets/js/plugins/bootstrap-datetimepicker.min.js"></script>
    <!--	Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
    <script src="../assets/js/plugins/nouislider.min.js"></script>
    <!-- Material Kit Core initialisations of plugins and Bootstrap Material Design Library -->
    <script src="../assets/js/material-kit.js?v=2.0.1"></script>
    <!-- Fixed Sidebar Nav - js With initialisations For Demo Purpose, Don't Include it in your project -->
    <script src="../assets/assets-for-demo/js/material-kit-demo.js"></script>

    <script src="../bootstrap-datepicker/js/bootstrap-datepicker.js"></script>  
    <script src="../bootstrap-datepicker/locales/bootstrap-datepicker.es.min.js" charset="UTF-8"></script>
 
    <script>
        onload = function(){ 
          var ele = document.querySelectorAll('.validanumericos')[0];

          ele.onkeypress = function(e) {
             if(isNaN(this.value+String.fromCharCode(e.charCode)))
                return false;
          }
          ele.onpaste = function(e){
             e.preventDefault();
          }
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