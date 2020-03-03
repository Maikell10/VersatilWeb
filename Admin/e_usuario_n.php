<?php

session_start();
if(isset($_SESSION['seudonimo'])) {

  }
    else {
        header("Location: ../sys/login.php");
        exit();
      }
      
  require_once("../class/clases.php");

 

    $id_usuario=$_POST['id_usuario'];


	$nombre=$_POST['nombre'];
    $apellido=$_POST['apellido'];
    $ci=$_POST['ci'];
    $zprod=$_POST['zprod'];

	$seudonimo=$_POST['seudonimo'];
	$clave=$_POST['clave'];
    $id_permiso=$_POST['id_permiso'];

    $activo=$_POST['activo'];

    $asesor=$_POST['asesor'];

    if ($id_permiso == '3') {

        $obj111= new Trabajo();
        $asesor1 = $obj111->get_element_by_id('ena','cod',$asesor);
        $nombre_a=$asesor1[0]['idnom'];

        if (sizeof($asesor1)==null) {
            $ob3= new Trabajo();
            $asesor1 = $ob3->get_element_by_id('enp','cod',$asesor); 
            $nombre_a=$asesor1[0]['nombre'];
        }
    
        if (sizeof($asesor1)==null) {
            $ob3= new Trabajo();
            $asesor1 = $ob3->get_element_by_id('enr','cod',$asesor); 
            $nombre_a=$asesor1[0]['nombre'];
        }

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
                    <h1 class="title"><i class="fa fa-user" aria-hidden="true"></i>&nbsp;Previsualizar Edición del Cliente
                    </h1>  
                </div>


            
                
                <form class="form-horizontal" id="frmnuevo" >
                    <div class="table-responsive">      
                        <table class="table table-hover table-striped table-bordered" id="iddatatable" >
                            <thead style="background-color: #92ACC4;color: white; font-weight: bold;">
                                <tr>
                                    <th>Nombre Usuario</th>
                                    <th>Apellido</th>
                                    <th>Cédula</th>
                                    <th>Z Producc</th>
                                </tr>
                            </thead>

                            <tbody >
                                <div class="form-group col-md-12">
                                <tr >
                                    <td><input type="text" class="form-control" name="nombre" readonly value="<?= utf8_encode($nombre); ?>"></td>
                                    <td><input type="text" class="form-control" name="apellido" readonly value="<?= utf8_encode($apellido); ?>"></td>
                                    <td><input type="text" class="form-control" name="ci" readonly value="<?= $ci; ?>" ></td>
                                    <td><input type="text" class="form-control" name="zprod" readonly value="<?= $zprod;?>"></td>
                                </tr>

                                <tr style="background-color: #92ACC4;color: white; font-weight: bold;">
                                    <th>Seudónimo</th>
                                    <th>Clave</th>
                                    <th>Permiso</th>
                                    <th>Activo</th>
                                </tr>
                                <?php
                                    if ($id_permiso==1) {
                                        $permiso='Administrador';
                                    }
                                    if ($id_permiso==2) {
                                        $permiso='Usuario';
                                    }
                                    if ($id_permiso==3) {
                                        $permiso='Asesor';
                                    }

                                    if ($activo==0) {
                                        $estado='Inactivo';
                                    }else {
                                        $estado='Activo';
                                    }
                                ?>
                                <tr>
                                    <td><input type="text" class="form-control" name="seudonimo" readonly="readonly" value="<?= $seudonimo;?>"></td>
                                    <td><input type="text" class="form-control" name="clave" readonly="readonly" value="<?= $clave;?>"></td>
                                    <td><input type="text" class="form-control" name="permiso" readonly="readonly" value="<?= $permiso;?>"></td>
                                    <td><input type="text" class="form-control" name="activo" readonly="readonly" value="<?= $estado;?>"></td>
                                </tr>

                                <?php if ($id_permiso == '3') {   
                                ?>
                                <tr style="background-color: #92ACC4;color: white; font-weight: bold;">
                                    <th colspan="4">Asesor Asociado</th>
                                </tr>
                                <tr>
                                    <td colspan="4"><input type="text" class="form-control" name="nombre_a" readonly="readonly" value="<?= utf8_encode($nombre_a);?>"></td>
                                </tr>
                                <?php 
                                }
                                ?>
 

                                </div>
                            </tbody>
                        </table>
                    </div>



                    


                      <center>
                        <a name="enlace" href="e_usuario_nn.php?id_usuario=<?= $id_usuario;?>&nombre=<?= $nombre;?>&apellido=<?= $apellido;?>&ci=<?= $ci;?>&zprod=<?= $zprod;?>&seudonimo=<?= $seudonimo;?>&clave=<?= $clave;?>&id_permiso=<?= $id_permiso;?>&asesor=<?= $asesor;?>&activo=<?= $activo;?>" class="btn btn-info btn-lg btn-round">Confirmar</a></center>
                        
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