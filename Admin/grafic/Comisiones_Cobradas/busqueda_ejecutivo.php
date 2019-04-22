<?php 
session_start();
if(isset($_SESSION['seudonimo'])) {

  }
    else {
        header("Location: login.php");
        exit();
      }
      
  require_once("../../../class/clases.php");

  $obj1= new Trabajo();
  $cia = $obj1->get_distinct_element('nomcia','dcia'); 

  $obj2= new Trabajo();
  $ramo = $obj2->get_distinct_element('nramo','dramo'); 

  $obj2= new Trabajo();
  $fechaMin = $obj2->get_fecha_min('f_hastapoliza','poliza'); 

  $obj3= new Trabajo();
  $fechaMax = $obj3->get_fecha_max('f_hastapoliza','poliza'); 




?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    
    <!-- Favicons -->
    <link rel="icon" href="../../../assets/img/logo1.png">
    <title>
        Versatil Seguros
    </title>

    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />

    
    <link rel="stylesheet" href="../../../assets/css/material-kit.css?v=2.0.1">
    <!-- Documentation extras -->
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="../../../assets/assets-for-demo/demo.css" rel="stylesheet" />
    <link href="../../../assets/assets-for-demo/vertical-nav.css" rel="stylesheet" />
    
    <link href="../../../bootstrap-datepicker/css/bootstrap-datepicker.css" rel="stylesheet">

   

 

</head>


<body class="profile-page ">
    <nav class="navbar navbar-color-on-scroll navbar-transparent    fixed-top  navbar-expand-lg bg-info" color-on-scroll="100" id="sectionsNav">
        <div class="container">
            <div class="navbar-translate">
                <a class="navbar-brand" href="../../sesionadmin.php"> <img src="../../../assets/img/logo1.png" width="45%" /></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                    <span class="navbar-toggler-icon"></span>
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ml-auto">
                    <li class="dropdown nav-item">
                        <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                            <i class="material-icons">plus_one</i> Cargar Datos
                        </a>
                        <div class="dropdown-menu dropdown-with-icons">
                            <a href="../../add/crear_poliza.php" class="dropdown-item">
                                <i class="material-icons">add_to_photos</i> Póliza
                            </a>
                            <a href="../../add/crear_comision.php" class="dropdown-item">
                                <i class="material-icons">add_to_photos</i> Comisión
                            </a>
                            <a href="../../add/crear_asesor.php" class="dropdown-item">
                                <i class="material-icons">person_add</i> Asesor
                            </a>
                            <a href="../../add/crear_compania.php" class="dropdown-item">
                                <i class="material-icons">markunread_mailbox</i> Compañía
                            </a>
                        </div>
                    </li>

                    <li class="dropdown nav-item">
                        <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                            <i class="material-icons">search</i> Buscar
                        </a>
                        <div class="dropdown-menu dropdown-with-icons">
                            <a href="../../b_asesor.php" class="dropdown-item">
                                <i class="material-icons">accessibility</i> Asesor
                            </a>
                            <a href="../../b_cliente.php" class="dropdown-item">
                                <i class="material-icons">accessibility</i> Cliente
                            </a>
                            <a href="../../b_poliza.php" class="dropdown-item">
                                <i class="material-icons">content_paste</i> Póliza
                            </a>
                            <a href="../../b_vehiculo.php" class="dropdown-item">
                                <i class="material-icons">commute</i> Vehículo
                            </a>
                            <a href="../../b_comp.php" class="dropdown-item">
                                <i class="material-icons">markunread_mailbox</i> Compañía
                            </a>
                            <a href="../../b_reportes.php" class="dropdown-item">
                                <i class="material-icons">library_books</i> Reportes de Cobranza
                            </a>
                        </div>
                    </li>

                    <li class="dropdown nav-item">
                        <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                            <i class="material-icons">trending_up</i> Gráficos
                        </a>
                        <div class="dropdown-menu dropdown-with-icons">
                            <a href="../porcentaje.php" class="dropdown-item">
                                <i class="material-icons">pie_chart</i> Porcentajes
                            </a>
                            <a href="../primas_s.php" class="dropdown-item">
                                <i class="material-icons">bar_chart</i> Primas Suscritas
                            </a>
                            <a href="../primas_c.php" class="dropdown-item">
                                <i class="material-icons">thumb_up</i> Primas Cobradas
                            </a>
                            <a href="../comisiones_c.php" class="dropdown-item">
                                <i class="material-icons">timeline</i> Comisiones Cobradas
                            </a>
                            <a href="" class="dropdown-item">
                                <i class="material-icons">show_chart</i> Gestión de Cobranza
                            </a>
                        </div>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="../../../sys/cerrar_sesion.php">
                            <i class="material-icons">eject</i> Cerrar Sesión
                        </a>
                    </li>
                   
                </ul>
            </div>
        </div>
    </nav>




    <div class="page-header  header-filter " data-parallax="true" style="background-image: url('../../../assets/img/logo2.png');">
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
                  <center>
                    <h1 class="title">Comisiones Cobradas por Ejecutivo</h1> 
                    <br/>
                    <a name="nombre"></a>
                    <a href="../primas_s.php" class="btn btn-danger btn-lg btn-round">Gráficos de Prima Suscrita</a></center>
                </div>
                <br>


      

      <div class="row" style="justify-content: center;">
        <h3>Seleccione su Búsqueda</h3>
      </div>
      <br/>

      <?php if ($_GET['m']==2) {?>
  
    <div class="alert alert-danger" role="alert">
        No existen datos para la búsqueda seleccionada!
    </div>

    <?php } ?>

      <form class="form-horizontal" action="ejecutivo.php" method="get">
        <div class="form-row">
          <div class="form-group col-md-6">
          <label>Año Vigencia Seguro:</label>
            <select class="form-control" name="anio" id="anio">
                <option value="">Seleccione Año</option>
            <?php
                $date=date('Y', strtotime($fechaMin[0]["MIN(f_hastapoliza)"]));
                for($i=date('Y', strtotime($fechaMin[0]["MIN(f_hastapoliza)"])); $i <= date('Y', strtotime($fechaMax[0]["MAX(f_hastapoliza)"])); $i++)
                {  
            ?>
                <option value="<?php echo $date;?>"><?php echo $date;?></option>
            <?php
                $date=$date+1;
                } 
            ?> 
            </select>
          </div>
          <div class="form-group col-md-6">
          <label>Mes Vigencia Seguro:</label>
            <select class="form-control" name="mes" id="mes">
                <option value="">Seleccione Mes</option>
                <option value="1">Enero</option>
                <option value="2">Febrero</option>
                <option value="3">Marzo</option>
                <option value="4">Abril</option>
                <option value="5">Mayo</option>
                <option value="6">Junio</option>
                <option value="7">Julio</option>
                <option value="8">Agosto</option>
                <option value="9">Septiembre</option>
                <option value="10">Octubre</option>
                <option value="11">Noviembre</option>
                <option value="12">Diciembre</option>
            </select>
          </div>
        </div>
        
        <div class="form-row">
          <div class="form-group col-md-6">
            <label>Tipo de Cuenta:</label>
            <select class="form-control" name="tipo_cuenta">
              <option>Tipo Cuenta</option>
              <option value="0">Individual</option>
              <option value="1">Colectivo</option>
            </select>
          </div>
          <div class="form-group col-md-6">
            <label>Status Final:</label>
            <select class="form-control" name="status">
              <option>Status Final</option>
              <option value="0">Activa</option>
              <option value="1">Anulada</option>
              <option value="2">Inactiva</option>
            </select>
          </div>
        </div>

        <div class="form-row">
          <div class="form-group col-md-12">
            <label>Cía:</label>
            <select class="form-control" name="cia">
              <option>Seleccione Cía</option>
              <?php
                for($i=0;$i<sizeof($cia);$i++)
                  {  
              ?>
                  <option value="<?php echo $cia[$i]["nomcia"];?>"><?php echo utf8_encode($cia[$i]["nomcia"]);?></option>
              <?php
                } 
              ?> 
            </select>
          </div>
        </div>

        <div class="form-row">
          <div class="form-group col-md-12">
            <label>Ramo:</label>
            <select class="form-control" name="ramo">
              <option>Seleccione Ramo</option>
              <?php
                for($i=0;$i<sizeof($ramo);$i++)
                  {  
              ?>
                  <option value="<?php echo $ramo[$i]["nramo"];?>"><?php echo utf8_encode($ramo[$i]["nramo"]);?></option>
              <?php
                } 
              ?> 
            </select>
          </div>
        </div>


          <center><button type="submit" class="btn btn-success btn-lg btn-round">Buscar</button></center>

      </form>
      


      


    
    </div>
      </div>
      <br><br><br><br>



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
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="../../../assets/js/core/popper.min.js"></script>
    <script src="../../../assets/js/bootstrap-material-design.js"></script>
    <!-- Material Kit Core initialisations of plugins and Bootstrap Material Design Library -->
    <script src="../../../assets/js/material-kit.js?v=2.0.1"></script>
    <!-- Fixed Sidebar Nav - js With initialisations For Demo Purpose, Don't Include it in your project -->
    <script src="../../../assets/assets-for-demo/js/material-kit-demo.js"></script>
   
    <script src="../../../bootstrap-datepicker/js/bootstrap-datepicker.js"></script>  
    <script src="../../../bootstrap-datepicker/locales/bootstrap-datepicker.es.min.js" charset="UTF-8"></script>

   

    <script type="text/javascript">
      $('#desde').datepicker({  
        format: "yyyy-mm-dd", 
        startDate: '<?php echo $fechaMin[0]["MIN(f_desdepoliza)"];?>',
      });

      $('#hasta').datepicker({  
        format: "yyyy-mm-dd", 
        endDate: '<?php echo $fechaMax[0]["MAX(f_hastapoliza)"];?>',
      });
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