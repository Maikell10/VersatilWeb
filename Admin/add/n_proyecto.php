<?php 
session_start();
if(isset($_SESSION['seudonimo'])) {

  }
    else {
        header("Location: login.php");
        exit();
      }
      
  require_once("../../class/clases.php");

  if (isset($_POST['cod_proyecto'])==null) {
    $cod_proyecto=$_GET['cod_proyecto'];
  }else{
    $cod_proyecto=$_POST['cod_proyecto'];
  }
  

  

  if ($cod_proyecto==1) {
      $obj1= new Trabajo();
      $lProyecto = $obj1->get_ultimo_proyecto(); 

      $u= $lProyecto[0]['cod_proyecto'];

      $u=explode('-', $lProyecto[0]['cod_proyecto']);
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

    
    <!-- Alertify -->
    <link rel="stylesheet" type="text/css" href="../../assets/alertify/css/alertify.css">
    <link rel="stylesheet" type="text/css" href="../../assets/alertify/css/themes/bootstrap.css">
    <script src="../../assets/alertify/alertify.js"></script>


    <!-- DataTables -->
    <link href="../../DataTables/DataTables/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="../../DataTables/DataTables/js/jquery.dataTables.min.js"></script>
    <script src="../../DataTables/DataTables/js/dataTables.bootstrap4.min.js"></script>


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
        

        
        <?php
            if ($cod_proyecto==1) { 
        ?>
        <div class="section">
            <div class="container" >
                <center>
                <div class="col-md-auto col-md-offset-2">
                    <h1 class="title"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Añadir Nuevo Proyecto
                    </h1>  
                </div>


                
                <form class="form-horizontal" id="frmnuevo" autocomplete="off">
                    <div class="table-responsive">  
                    <table class="table table-hover table-striped table-bordered" id="iddatatable" style="width: 60%;text-align: center">
                        <thead style="background-color: #00bcd4;color: white; font-weight: bold;">
                            <tr>
                                <th nowrap>Cod Proyecto *</th>
                                <th nowrap>Nº ID *</th>
                                <th nowrap>Nombre Líder *</th>
                                <th nowrap>Nombre del Proyecto</th>
                            </tr>
                        </thead>

                        <tbody >
                            <div class="form-group col-md-12">
                            <tr style="background-color: white">
                                <td><input type="text" class="form-control" name="cod" readonly="true" value="<?php echo $u[0]."-".($u[1]+1);?> "></td>
                                <td><input type="text" class="form-control validanumericos" id="id_lider" name="id_lider" required data-toggle="tooltip" data-placement="bottom" title="Campo Obligatorio [Sólo introducir números]"></td>
                                <td><input onblur="cargarCuenta(this)" type="text" class="form-control" id="nombre_l" name="nombre_l" required onkeyup="mayus(this);" data-toggle="tooltip" data-placement="bottom" title="Campo Obligatorio"></td>
                                <td><input type="text" class="form-control" id="cuenta" name="cuenta" required readonly="true"></td>
                            </tr>

                            <tr style="background-color: #00bcd4;color: white; font-weight: bold;">
                                <th nowrap colspan="2">Forma de Pago *</th>
                                <th nowrap colspan="2">Observaciones</th>
                            </tr>
                            <tr style="background-color: white">
                                <td colspan="2"><select class="custom-select" id="pago" name="pago" required data-toggle="tooltip" data-placement="bottom" title="Seleccione un elemento de la lista">
                                    <option value="ÚNICO MENSUAL">ÚNICO MENSUAL</option>
                                    <option value="ÚNICO SEMANAL">ÚNICO SEMANAL</option>
                                </select></td>
                                <td colspan="2"><input type="text" class="form-control" id="obs" name="obs"></td>
                            </tr>
                            </div>
                        </tbody>
                    </table>
                    </div>

                
                    <button type="button" id="btnAgregarProyecto" class="btn btn-info btn-lg btn-round">Agregar nuevo</button>
                </center>
                </form>
            </div>

        </div>

        <?php
            }else{

                $obj3= new Trabajo();
                $lider_p = $obj3->get_element_by_id('lider_enp','cod_proyecto',$cod_proyecto); 

                $cod_enp="";
                $obj2= new Trabajo();
                $proyecto = $obj2->get_ultimo_a_proyecto($lider_p[0]['id_proyecto']); 

                $u= $proyecto[0]['cod'];

                $u=explode('-', $proyecto[0]['cod']);

                if ($proyecto[0]['cod']==null) {
                    $cod_enp = $cod_proyecto."-1";
                }else{$cod_enp = $u[0]."-".$u[1]."-".($u[2]+1);}

                
        ?>

        <div class="section">
            <div class="container" >
                <center>
                <div class="col-md-auto col-md-offset-2">
                    <h1 class="title"><i class="fa fa-user-plus" aria-hidden="true"></i>&nbsp;Añadir Nuevo Asesor de Proyecto
                    </h1>  
                </div>


                
                <form class="form-horizontal" id="frmnuevo1" autocomplete="off">
                    <div class="table-responsive">  
                    <table class="table table-hover table-striped table-bordered" id="iddatatable" style="width: 80%;text-align: center">
                        <thead style="background-color: #00bcd4;color: white; font-weight: bold;">
                            <tr>
                                <th hidden>ID Proyecto</th>
                                <th>Cod Proyecto *</th>
                                <th>Nº ID *</th>
                                <th>Nombre Asesor *</th>
                                <th></th>
                                <th>Monto / % *</th>
                                <th>E-Mail *</th>
                            </tr>
                        </thead>

                        <tbody >
                            <tr style="background-color: white">
                                <td hidden><input type="text" class="form-control" name="id_proyecto" value="<?php echo $lider_p[0]['id_proyecto'];?> "></td>
                                <td><input type="text" class="form-control" name="cod_proyecto" readonly="true" value="<?php echo $cod_enp;?> "></td>
                                <td><input type="text" class="form-control validanumericos" id="id" name="id" required data-toggle="tooltip" data-placement="bottom" title="Campo Obligatorio [Sólo introducir números]"></td>
                                <td><input type="text" class="form-control" id="nombre_a" name="nombre_a" required onkeyup="mayus(this);" data-toggle="tooltip" data-placement="bottom" title="Campo Obligatorio"></td>
                                <td><select class="custom-select" name="currency" required>
                                        <option value="$">$</option>
                                        <option value="BsS">BsS</option>
                                        <option value="%">%</option>
                                    </select>
                                </td>
                                <td><input type="text" class="form-control validanumericos1" id="monto_a" name="monto_a" required data-toggle="tooltip" data-placement="bottom" title="Campo Obligatorio [Sólo introducir números y punto (.) como separador decimal]"></td>
                                <td><input type="email" class="form-control" id="email" name="email" required data-toggle="tooltip" data-placement="bottom" title="Campo Obligatorio" placeholder="ejemplo@email.com"></td>
                            </tr>

                            <tr style="background-color: #00bcd4;color: white; font-weight: bold;">
                                <th>Banco *</th>
                                <th>Tipo Cuenta *</th>
                                <th colspan="2">N° Cuenta *</th>
                                <th>Cel *</th>
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
                                <td><input type="text" class="form-control validanumericos3" id="cel" name="cel" required data-toggle="tooltip" data-placement="bottom" title="Campo Obligatorio [Sólo introducir números]"></td>
                                <td><input type="text" class="form-control" id="obs" name="obs" onkeyup="mayus(this);"></td>
                            </tr>
                        </tbody>
                    </table>
                    </div>
                

                
                    <button type="button" id="btnAgregarAsesorProyecto" class="btn btn-info btn-lg btn-round">Agregar nuevo</button>
                </center>
                </form>
            </div>

        </div>
        <?php
            }
        ?>







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

    



    <script type="text/javascript">
        $(document).ready(function(){
            $('#btnAgregarProyecto').click(function(){

                if($("#nombre_l").val().length < 1) {  
                    alertify.error("El Nombre es Obligatorio");
                    return false;  
                } 
                if($("#pago").val().length < 1) {  
                    alertify.error("El Pago es Obligatorio");
                    return false;  
                } 

                datos=$('#frmnuevo').serialize();

                $.ajax({
                    type:"POST",
                    data:datos,
                    url:"../../procesos/agregarProyecto.php",
                    success:function(r){
                        if(r==1){
                            $('#frmnuevo')[0].reset();
                            
                            alertify.alert('Exito!', 'Proyecto agregado satisfactoriamente, será redirigido a la selección de Proyecto', function(){ 
                                window.location.replace("c_proyecto.php?en=7");
                                alertify.success('Ok'); 
                            });


                        }else{
                            alertify.error("Fallo al Agregar");
                        }
                    }
                });
            });



            $('#btnAgregarAsesorProyecto').click(function(){

                if($("#id").val().length < 1) {  
                    alertify.error("El N° de ID es Obligatorio");
                    return false;  
                }
                if($("#nombre_a").val().length < 1) {  
                    alertify.error("El Nombre del Asesor es Obligatorio");
                    return false;  
                } 
                if($("#monto_a").val().length < 1) {  
                    alertify.error("El Monto es Obligatorio");
                    return false;  
                } 
                if($("#email").val().length < 1) {  
                    alertify.error("El E-Mail es Obligatorio");
                    return false;  
                }
                if($("#banco").val().length < 1) {  
                    alertify.error("El Banco es Obligatorio");
                    return false;  
                }
                if($("#num_cuenta").val().length < 1) {  
                    alertify.error("El N° de Cuenta es Obligatorio");
                    return false;  
                }

                datos=$('#frmnuevo1').serialize();

                $.ajax({
                    type:"POST",
                    data:datos,
                    url:"../../procesos/agregarAsesorProyecto.php",
                    success:function(r){
                        if(r==1){
                            $('#frmnuevo1')[0].reset();
                            
                            alertify.alert('Exito!', 'Asesor agregado satisfactoriamente, será redirigido a la página principal', function(){ 
                                window.location.replace("../sesionadmin.php");
                                alertify.success('Ok'); 
                            });


                        }else{
                            alertify.error("Fallo al Agregar");
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


        function cargarCuenta(nombre_l){
            $('#cuenta').val("P. "+$(nombre_l).val());
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