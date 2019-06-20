<?php

session_start();
if(isset($_SESSION['seudonimo'])) {

  }
    else {
        header("Location: login.php");
        exit();
      }
      
  require_once("../../class/clases.php");

 




	$nombre_cia=$_POST['nombre_cia'];
    $rif=$_POST['rif'];
    
	$nombre1=$_POST['nombre1'];
	$cargo1=$_POST['cargo1'];
	$tel1=$_POST['tel1'];
	$cel1=$_POST['cel1'];
    $email1=$_POST['email1'];
    
    $nombre2=$_POST['nombre2'];
	$cargo2=$_POST['cargo2'];
	$tel2=$_POST['tel2'];
	$cel2=$_POST['cel2'];
    $email2=$_POST['email2'];

    $nombre3=$_POST['nombre3'];
	$cargo3=$_POST['cargo3'];
	$tel3=$_POST['tel3'];
	$cel3=$_POST['cel3'];
    $email3=$_POST['email3'];

    $nombre4=$_POST['nombre4'];
	$cargo4=$_POST['cargo4'];
	$tel4=$_POST['tel4'];
	$cel4=$_POST['cel4'];
    $email4=$_POST['email4'];

    $nombre5=$_POST['nombre5'];
	$cargo5=$_POST['cargo5'];
	$tel5=$_POST['tel5'];
	$cel5=$_POST['cel5'];
    $email5=$_POST['email5'];
    

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
    <nav class="navbar navbar-color-on-scroll navbar-transparent    fixed-top  navbar-expand-lg bg-info" color-on-scroll="100" id="sectionsNav">
        <div class="container">
            <div class="navbar-translate">
                <a class="navbar-brand" href="../sesionadmin.php"> <img src="../../assets/img/logo1.png" width="45%" /></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                    <span class="navbar-toggler-icon"></span>
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ml-auto">
                    <li><b>[Producción]</b></li>
                    <li class="dropdown nav-item">
                        <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                            <i class="material-icons">plus_one</i> Cargar Datos
                        </a>
                        <div class="dropdown-menu dropdown-with-icons">
                            <a href="crear_poliza.php" class="dropdown-item">
                                <i class="material-icons">add_to_photos</i> Póliza
                            </a>
                            <a href="crear_comision.php" class="dropdown-item">
                                <i class="material-icons">add_to_photos</i> Comisión
                            </a>
                            <a href="crear_asesor.php" class="dropdown-item">
                                <i class="material-icons">person_add</i> Asesor
                            </a>
                            <a href="crear_compania.php" class="dropdown-item">
                                <i class="material-icons">markunread_mailbox</i> Compañía
                            </a>
                        </div>
                    </li>

                    <li class="dropdown nav-item">
                        <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                            <i class="material-icons">search</i> Buscar
                        </a>
                        <div class="dropdown-menu dropdown-with-icons">
                            <a href="../b_asesor.php" class="dropdown-item">
                                <i class="material-icons">accessibility</i> Asesor
                            </a>
                            <a href="../b_cliente.php" class="dropdown-item">
                                <i class="material-icons">accessibility</i> Cliente
                            </a>
                            <a href="../b_poliza.php" class="dropdown-item">
                                <i class="material-icons">content_paste</i> Póliza
                            </a>
                            <a href="../b_vehiculo.php" class="dropdown-item">
                                <i class="material-icons">commute</i> Vehículo
                            </a>
                            <a href="../b_comp.php" class="dropdown-item">
                                <i class="material-icons">markunread_mailbox</i> Compañía
                            </a>
                            <a href="../b_reportes.php" class="dropdown-item">
                                <i class="material-icons">library_books</i> Reportes de Cobranza
                            </a>
                        </div>
                    </li>

                    <li class="dropdown nav-item">
                        <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                            <i class="material-icons">trending_up</i> Gráficos
                        </a>
                        <div class="dropdown-menu dropdown-with-icons">
                            <a href="../grafic/porcentaje.php" class="dropdown-item">
                                <i class="material-icons">pie_chart</i> Porcentajes
                            </a>
                            <a href="../grafic/primas_s.php" class="dropdown-item">
                                <i class="material-icons">bar_chart</i> Primas Suscritas
                            </a>
                            <a href="../grafic/primas_c.php" class="dropdown-item">
                                <i class="material-icons">thumb_up</i> Primas Cobradas
                            </a>
                            <a href="../grafic/comisiones_c.php" class="dropdown-item">
                                <i class="material-icons">timeline</i> Comisiones Cobradas
                            </a>
                            <a href="#" class="dropdown-item">
                                <i class="material-icons">show_chart</i> Gestión de Cobranza
                            </a>
                        </div>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="../../sys/cerrar_sesion.php" onclick="scrollToDownload()">
                            <i class="material-icons">eject</i> Cerrar Sesión
                        </a>
                    </li>
                   
                </ul>
            </div>
        </div>
    </nav>




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
                    <h1 class="title"><i class="fa fa-briefcase" aria-hidden="true"></i>&nbsp;Previsualizar Nueva Compañía
                    </h1>  
                </div>


            
                
                <form class="form-horizontal" id="frmnuevo" >
                    <div class="form-row table-responsive">      
                        <table class="table table-hover table-striped table-bordered" id="iddatatable" >
                            <thead style="background-color: #92ACC4;color: white; font-weight: bold;">
                                <tr>
                                    <th colspan="3">Nombre de Cía</th>
                                    <th colspan="2">RIF</th>
                                </tr>
                            </thead>

                            <tbody >
                                <div class="form-group col-md-12">
                                <tr >
                                    <td colspan="3"><input type="text" class="form-control" name="nombre_cia" readonly="readonly" value="<?php echo $nombre_cia;?>"></td>
                                    <td colspan="2"><input type="text" class="form-control" name="rif" readonly="readonly" value="<?php echo $rif;?>"></td>
                                </tr>

                                <tr style="background-color: #92ACC4;color: white; font-weight: bold;">
                                    <th>Nombre del Contacto</th>
                                    <th>Cargo</th>
                                    <th>Telf</th>
                                    <th>Celular</th>
                                    <th>e-mail</th>
                                </tr>
                                <tr>
                                    <td><input type="text" class="form-control" name="nombre1" readonly="readonly" value="<?php echo $nombre1;?>"></td>
                                    <td><input type="text" class="form-control" name="cargo1" readonly="readonly" value="<?php echo $cargo1;?>"></td>
                                    <td><input type="text" class="form-control" name="tel1" readonly="readonly" value="<?php echo $tel1;?>"></td>
                                    <td><input type="text" class="form-control" name="cel1" readonly="readonly" value="<?php echo $cel1;?>"></td>
                                    <td><input type="text" class="form-control" name="email1" readonly="readonly" value="<?php echo $email1;?>"></td>
                                </tr>

                                <tr>
                                    <td><input type="text" class="form-control" name="nombre2" readonly="readonly" value="<?php echo $nombre2;?>"></td>
                                    <td><input type="text" class="form-control" name="cargo2" readonly="readonly" value="<?php echo $cargo2;?>"></td>
                                    <td><input type="text" class="form-control" name="tel2" readonly="readonly" value="<?php echo $tel2;?>"></td>
                                    <td><input type="text" class="form-control" name="cel2" readonly="readonly" value="<?php echo $cel2;?>"></td>
                                    <td><input type="text" class="form-control" name="email2" readonly="readonly" value="<?php echo $email2;?>"></td>
                                </tr>

                                <tr>
                                    <td><input type="text" class="form-control" name="nombre3" readonly="readonly" value="<?php echo $nombre3;?>"></td>
                                    <td><input type="text" class="form-control" name="cargo3" readonly="readonly" value="<?php echo $cargo3;?>"></td>
                                    <td><input type="text" class="form-control" name="tel3" readonly="readonly" value="<?php echo $tel3;?>"></td>
                                    <td><input type="text" class="form-control" name="cel3" readonly="readonly" value="<?php echo $cel3;?>"></td>
                                    <td><input type="text" class="form-control" name="email3" readonly="readonly" value="<?php echo $email3;?>"></td>
                                </tr>

                                <tr>
                                    <td><input type="text" class="form-control" name="nombre4" readonly="readonly" value="<?php echo $nombre4;?>"></td>
                                    <td><input type="text" class="form-control" name="cargo4" readonly="readonly" value="<?php echo $cargo4;?>"></td>
                                    <td><input type="text" class="form-control" name="tel4" readonly="readonly" value="<?php echo $tel4;?>"></td>
                                    <td><input type="text" class="form-control" name="cel4" readonly="readonly" value="<?php echo $cel4;?>"></td>
                                    <td><input type="text" class="form-control" name="email4" readonly="readonly" value="<?php echo $email4;?>"></td>
                                </tr>

                                <tr>
                                    <td><input type="text" class="form-control" name="nombre5" readonly="readonly" value="<?php echo $nombre5;?>"></td>
                                    <td><input type="text" class="form-control" name="cargo5" readonly="readonly" value="<?php echo $cargo5;?>"></td>
                                    <td><input type="text" class="form-control" name="tel5" readonly="readonly" value="<?php echo $tel5;?>"></td>
                                    <td><input type="text" class="form-control" name="cel5" readonly="readonly" value="<?php echo $cel5;?>"></td>
                                    <td><input type="text" class="form-control" name="email5" readonly="readonly" value="<?php echo $email5;?>"></td>
                                </tr>


                                </div>
                            </tbody>
                        </table>
                    </div>



                    


                      <center>
                        <a name="enlace" href="cia_n.php?nombre_cia=<?php echo $nombre_cia;?>&rif=<?php echo $rif;?>&nombre1=<?php echo $nombre1;?>&cargo1=<?php echo $cargo1;?>&tel1=<?php echo $tel1;?>&cel1=<?php echo $cel1;?>&email1=<?php echo $email1;?>&nombre2=<?php echo $nombre2;?>&cargo2=<?php echo $cargo2;?>&tel2=<?php echo $tel2;?>&cel2=<?php echo $cel2;?>&email2=<?php echo $email2;?>&nombre3=<?php echo $nombre3;?>&cargo3=<?php echo $cargo3;?>&tel3=<?php echo $tel3;?>&cel3=<?php echo $cel3;?>&email3=<?php echo $email3;?>&nombre4=<?php echo $nombre4;?>&cargo4=<?php echo $cargo4;?>&tel4=<?php echo $tel4;?>&cel4=<?php echo $cel4;?>&email4=<?php echo $email4;?>&nombre5=<?php echo $nombre5;?>&cargo5=<?php echo $cargo5;?>&tel5=<?php echo $tel5;?>&cel5=<?php echo $cel5;?>&email5=<?php echo $email5;?>" class="btn btn-info btn-lg btn-round">Confirmar</a></center>
                        
                </form>
                </center>
            </div>

        </div>







        <div class="section" style="background-color: #40A8CB;">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 ml-auto mr-auto">
                        <div class="card card-signup">
                            <form class="form" method="" action="">
                                <div class="card-header card-header-info text-center">
                                    <h3>¿Necesitas cotizar tu póliza de seguros?</h3>
                                </div>
                                <div class="card-body">
                                    <center><a href="" class="btn btn-lg btn-info">Cotizar</a></center>
                                </div>
                                
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>





        
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