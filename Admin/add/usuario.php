<?php

session_start();
if(isset($_SESSION['seudonimo'])) {

  }
    else {
        header("Location: login.php");
        exit();
      }
      
  require_once("../../class/clases.php");

 




    $nombre=$_POST['nombre'];
    $apellido=$_POST['apellido'];
    $ci=$_POST['ci'];
    
	$zprod=$_POST['zprod'];
	$seudonimo=$_POST['seudonimo'];
	$clave=$_POST['clave'];
    $id_permiso=$_POST['id_permiso'];

    $permiso_user='';
    
    if ($id_permiso == '1') {
        $permiso_user='ADMINISTRADOR';
    } 
    if ($id_permiso == '2') {
        $permiso_user='USUARIO';
    }
    
    

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <!-- Favicons -->
    <link rel="apple-touch-icon" href="../../assets/img/apple-icon.png">
    <link rel="icon" href="../../assets/img/logo1.png">
    <title>
        Versatil Seguros
    </title>
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />
    <link rel="stylesheet" href="../../assets/css/material-kit.css?v=2.0.1">
    <!-- Documentation extras -->
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="../../assets/assets-for-demo/demo.css" rel="stylesheet" />
    <link href="../../assets/assets-for-demo/vertical-nav.css" rel="stylesheet" />

    <link href="../../bootstrap-datepicker/css/bootstrap-datepicker.css" rel="stylesheet">

    
    <!-- Alertify -->
    <link rel="stylesheet" type="text/css" href="../../assets/alertify/css/alertify.css">
    <link rel="stylesheet" type="text/css" href="../../assets/alertify/css/themes/bootstrap.css">
    <script src="../../assets/alertify/alertify.js"></script>


    <!-- DataTables -->
    <link href="../../DataTables/DataTables/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="../../DataTables/DataTables/js/jquery.dataTables.min.js"></script>
    <script src="../../DataTables/DataTables/js/dataTables.bootstrap4.min.js"></script>


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
                    <h1 class="title"><i class="fa fa-user" aria-hidden="true"></i>&nbsp;Previsualizar Nuevo Usuario
                    </h1>  
                </div>


                
                
                <form class="form-horizontal" id="frmnuevo" >
                    <div class="form-row table-responsive">      
                        <table class="table table-hover table-striped table-bordered" id="iddatatable" >
                            <thead style="background-color: #92ACC4;color: white; font-weight: bold;">
                                <tr>
                                    <th>Nombre del Usuario</th>
                                    <th>Apellido</th>
                                    <th>Cédula</th>
                                    <th>Z Producc</th>
                                </tr>
                            </thead>

                            <tbody >
                                <div class="form-group col-md-12">
                                <tr >
                                    <td><input type="text" class="form-control" name="nombre" readonly="readonly" value="<?php echo $nombre;?>"></td>
                                    <td><input type="text" class="form-control" name="apellido" readonly="readonly" value="<?php echo $apellido;?>"></td>
                                    <td><input type="text" class="form-control" name="ci" readonly="readonly" value="<?php echo $ci;?>"></td>
                                    <td><input type="text" class="form-control" name="zprod" readonly="readonly" value="<?php echo $zprod;?>"></td>
                                </tr>

                                <tr style="background-color: #92ACC4;color: white; font-weight: bold;">
                                    <th colspan="2">Seudónimo</th>
                                    <th>Clave</th>
                                    <th>Permisos</th>
                                </tr>
                                <tr>
                                    <td colspan="2"><input type="text" class="form-control" name="seudonimo" readonly="readonly" value="<?php echo $seudonimo;?>"></td>
                                    <td><input type="text" class="form-control" name="clave" readonly="readonly" value="<?php echo $clave;?>"></td>
                                    <td><input type="text" class="form-control" name="permiso" readonly="readonly" value="<?php echo $permiso_user;?>"></td>
                                </tr>

                                

                                </div>
                            </tbody>
                        </table>
                    </div>



                    


                      <center>
                        <a name="enlace" href="usuario_n.php?nombre=<?php echo $nombre;?>&apellido=<?php echo $apellido;?>&ci=<?php echo $ci;?>&zprod=<?php echo $zprod;?>&seudonimo=<?php echo $seudonimo;?>&clave=<?php echo $clave;?>&id_permiso=<?php echo $id_permiso;?>" class="btn btn-info btn-lg btn-round">Confirmar</a></center>
                        
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