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
  $ramo = $obj1->get_element('dramo','cod_ramo'); 

  $obj2= new Trabajo();
  $cia = $obj2->get_element('dcia','nomcia'); 

  $obj3= new Trabajo();
  $asesor = $obj3->get_element('ena','idena'); 

  $obj4= new Trabajo();
  $usuario = $obj4->get_element_by_id('usuarios','seudonimo',$_SESSION['seudonimo']); 

  $obj31= new Trabajo();
  $liderp = $obj31->get_element('enp','id_enp'); 

  $obj32= new Trabajo();
  $referidor = $obj32->get_element('enr','id_enr'); 




?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php require('header.php');?>


    <script type="text/javascript">
        function tabular(e,obj) {
            tecla=(document.all) ? e.keyCode : e.which;
            if(tecla!=13) return;
            frm=obj.form;
            for(i=0;i<frm.elements.length;i++) 
            if(frm.elements[i]==obj) { 
                if (i==frm.elements.length-1) i=-1;
            break }
            frm.elements[i+1].focus();
            return false;
        }
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
            <a href="javascript:history.back(-1);" data-tooltip="tooltip" data-placement="right" title="Ir la página anterior" class="btn btn-info btn-round"><- Regresar</a>
            
                <center>
                <div class="col-md-auto col-md-offset-2">
                    <?php 
                        if (isset($_GET['cond'])) {
                    ?> 
                    <h1 class="title"><i class="fa fa-check-square-o text-success" aria-hidden="true"></i>&nbsp;Agregado con Éxito</h1>  
                    <?php       
                        }
                    ?>
                    <h1 class="title"><i class="fa fa-user" aria-hidden="true"></i>&nbsp;Añadir Nuevo Usuario</h1>  
                </div>


            
                <form class="form-horizontal" id="frmnuevo" action="usuario.php" method="post" >
                    <div class="form-row table-responsive">      
                        <table class="table table-hover table-striped table-bordered" id="iddatatable" >
                            <thead style="background-color: #00bcd4;color: white; font-weight: bold;">
                                <tr>
                                    <th>Nombre del Usuario *</th>
                                    <th>Apellido *</th>
                                    <th>Cédula *</th>
                                    <th>Z Producc *</th>
                                </tr>
                            </thead>

                            <tbody >
                                <div class="form-group col-md-12">
                                <tr style="background-color: white">
                                    <td><input type="text" class="form-control" id="nombre" name="nombre" required data-toggle="tooltip" data-placement="bottom" title="Campo Obligatorio" onkeyup="mayus(this);"></td>
                                    <td><input type="text" class="form-control" id="apellido" name="apellido" required data-toggle="tooltip" data-placement="bottom" title="Campo Obligatorio" onkeyup="mayus(this);"></td>
                                    <td><input type="text" class="form-control" id="ci" name="ci"></td>
                                    <td><select name="zprod" id="zprod" class="custom-select">
                                        <option value="PANAMA">PANAMA</option>
                                        <option value="CARACAS">CARACAS</option>
                                    </select></td>
                                </tr>
                                </div>
                            </tbody>
                        </table>
                    </div>

                    <div class="form-row table-responsive">      
                        <table class="table table-hover table-striped table-bordered" id="iddatatable" >
                            <thead style="background-color: #00bcd4;color: white; font-weight: bold;">
                                <tr>
                                    <th>Seudónimo</th>
                                    <th>Clave</th>
                                    <th>Permisos</th>
                                </tr>
                            </thead>

                            <tbody >
                                <div class="form-group col-md-12">
                                <tr style="background-color: white">
                                    <td><input type="text" class="form-control" id="seudonimo" name="seudonimo"></td>
                                    <td><input type="text" class="form-control" id="clave" name="clave"></td>
                                    <td><select name="id_permiso" id="id_permiso" class="custom-select">
                                        <option value="1">Administrador</option>
                                        <option value="2">Usuario</option>
                                        <option value="3">Asesor</option>
                                    </select></td>
                                </tr>
                                </div>
                            </tbody>
                        </table>
                    </div>



        

                      <center>
                        <button type="submit" id="btnForm" class="btn btn-info btn-lg btn-round">Previsualizar</button></center>

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

    <script src="../../bootstrap-datepicker/js/bootstrap-datepicker.js"></script>  
    <script src="../../bootstrap-datepicker/locales/bootstrap-datepicker.es.min.js" charset="UTF-8"></script>

      
    
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