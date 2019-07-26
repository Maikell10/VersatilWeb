<?php 
session_start();
if(isset($_SESSION['seudonimo'])) {

  }
    else {
        header("Location: login.php");
        exit();
      }
      
  require_once("../class/clases.php");



  $id_usuario = $_GET['id_usuario'];

  $obj1= new Trabajo();
  $usuario = $obj1->get_element_by_id('usuarios','id_usuario',$id_usuario); 

 
  

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
                    <h1 class="title">Usuario: <?php echo utf8_encode($usuario[0]['nombre_usuario']." ".$usuario[0]['apellido_usuario']); ?></h1>  
                    <h2 class="title">Seudónimo: <?php echo $usuario[0]['seudonimo']; ?></h2>  
                </div>


                <form class="form-horizontal" id="frmnuevo" action="e_usuario_n.php" method="post" >

                <div class="table-responsive">
                <table class="table table-striped table-bordered display nowrap" id="iddatatable" >
					<thead style="background-color: #00bcd4;color: white; font-weight: bold;">
						<tr>
                            <th>Nombre Usuario</th>
                            <th>Apellido</th>
                            <th>Cédula</th>
                            <th>Z Producc</th>
                            <th hidden>id</th>
						</tr>
					</thead>

					<tbody >
                        <tr style="background-color: white">
                            <td><input type="text" class="form-control" name="nombre" required value="<?php echo utf8_encode($usuario[0]['nombre_usuario']); ?>"></td>
                            <td><input type="text" class="form-control" name="apellido" value="<?php echo utf8_encode($usuario[0]['apellido_usuario']); ?>"></td>
                            <td><input type="text" class="form-control" name="ci" value="<?php echo $usuario[0]['cedula_usuario']; ?>" ></td>
                            <td><select name="zprod" id="zprod" class="custom-select">
                                <option value="PANAMA">PANAMA</option>
                                <option value="CARACAS">CARACAS</option>
                            </select></td>
                            <td hidden><input type="text" class="form-control" name="id_usuario" value="<?php echo $id_usuario; ?>" ></td>
                        </tr>
                        <tr style="background-color: #00bcd4;color: white; font-weight: bold;">
                            <th colspan="2">Seudónimo</th>
                            <th>Clave</th>
                            <th>Permiso</th>
                        </tr>
                        <tr style="background-color: white">
                            <td colspan="2"><input type="text" class="form-control" name="seudonimo" required  value="<?php echo $usuario[0]['seudonimo']; ?>"></td>
                            <td><input type="text" class="form-control" name="clave" value="<?php echo $usuario[0]['clave_usuario']; ?>"></td>
                            <td><select name="id_permiso" id="id_permiso" class="custom-select">
                                <option value="1">Administrador</option>
                                <option value="2">Usuario</option>
                            </select></td>
                        </tr>
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
            $('#cant_poliza option:first').prop('selected',true);

            document.getElementById("zprod").value = "<?php echo $usuario[0]['z_produccion'];?>";

            document.getElementById("id_permiso").value = "<?php echo $usuario[0]['id_permiso'];?>";
            
        });


        $('#f_nac').datepicker({  
            format: "dd-mm-yyyy"
        });

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