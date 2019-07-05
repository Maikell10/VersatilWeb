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
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <!-- Favicons -->
    <link rel="apple-touch-icon" href="../assets/img/apple-icon.png">
    <link rel="icon" href="../assets/img/logo1.png">
    <title>
        Versatil Seguros
    </title>
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />
    <link rel="stylesheet" href="../assets/css/material-kit.css?v=2.0.1">
    <!-- Documentation extras -->
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="../assets/assets-for-demo/demo.css" rel="stylesheet" />
    <link href="../assets/assets-for-demo/vertical-nav.css" rel="stylesheet" />

    
    <!-- Alertify -->
    <link rel="stylesheet" type="text/css" href="../assets/alertify/css/alertify.css">
    <link rel="stylesheet" type="text/css" href="../assets/alertify/css/themes/bootstrap.css">
    <script src="../assets/alertify/alertify.js"></script>


    <!-- DataTables -->
    <link href="../DataTables/DataTables/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="../DataTables/DataTables/js/jquery.dataTables.min.js"></script>
    <script src="../DataTables/DataTables/js/dataTables.bootstrap4.min.js"></script>



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
                    <h1 class="title">Usuario: <?php echo utf8_encode($usuario[0]['nombre_usuario']." ".$usuario[0]['apellido_usuario']); ?></h1>  
                    <h2 class="title">Seudónimo: <?php echo $usuario[0]['seudonimo']; ?></h2>  
                </div>


                

                <div class="table-responsive">
                <table class="table table-hover table-striped table-bordered" id="" >
                    <thead>
						<tr style="background-color: #00bcd4;color: white; font-weight: bold;">
							<th>Nombre Usuario</th>
                            <th>Apellido</th>
                            <th>Cédula</th>
                            <th>Z Producc</th>
						</tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td ><?php echo utf8_encode($usuario[0]['nombre_usuario']); ?></td>
                            <td ><?php echo utf8_encode($usuario[0]['apellido_usuario']); ?></td>
                            <td ><?php echo $usuario[0]['cedula_usuario']; ?></td>
                            <td ><?php echo $usuario[0]['z_produccion']; ?></td>
                        </tr>
                    </tbody>
                </table>
                </div>

                <div class="table-responsive">
                <table class="table table-hover table-striped table-bordered" id="" >
                    <thead>
						<tr style="background-color: #00bcd4;color: white; font-weight: bold;">
							<th colspan="2">Seudónimo</th>
                            <th>Clave</th>
                            <th>Permiso</th>
						</tr>
                    </thead>
                    <tbody>
                        <?php 
                            
                           
                        ?>
                        <tr>
                            <td colspan="2"><?php echo $usuario[0]['seudonimo']; ?></td>
                            <td ><?php echo $usuario[0]['clave_usuario']; ?></td>
                            <td ><?php echo $usuario[0]['id_permiso']; ?></td>
                        </tr>
                    </tbody>
                </table>
                </div>

                <hr>

                <center>
                <a  href="e_usuario.php?id_usuario=<?php echo $usuario[0]['id_usuario'];?>" data-tooltip="tooltip" data-placement="top" title="Editar" class="btn btn-success btn-lg text-center">Editar Usuario  &nbsp;<i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>

                <button  onclick="eliminarDatos('<?php echo $usuario[0]['id_usuario']; ?>')" data-tooltip="tooltip" data-placement="top" title="Eliminar" class="btn btn-danger btn-lg">Eliminar Usuario  &nbsp;<i class="fa fa-trash" aria-hidden="true"></i></button>
                </center>
                        
                <hr>
                
               
                
                
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

        function eliminarDatos(idusuario){
            alertify.confirm('Eliminar Usuario', '¿Seguro de eliminar este Usuario?', function(){
                $('.alertify .ajs-header').css('background-color', 'green');
                console.log(idusuario);
                $.ajax({
                    type:"POST",
                    data:"idusuario=" + idusuario,
                    url:"../procesos/eliminarUsuario.php",
                    success:function(r){
                        if(r==1){
                            alertify.alert('Eliminado con exito !', 'El Usuario fue eliminado con exito', function(){
                                alertify.success('OK');
                                window.location.replace("b_usuario.php");
                            });
                        }else{
                            alertify.error("No se pudo eliminar");
                        }
                    }
                });

            }
            , function(){

            });
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