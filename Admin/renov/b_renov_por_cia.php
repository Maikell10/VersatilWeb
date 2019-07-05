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
  $asesor = $obj1->get_element('ena','idena'); 

  $obj2= new Trabajo();
  $fechaMin = $obj2->get_fecha_min('f_hastapoliza','poliza'); 

  $obj3= new Trabajo();
  $fechaMax = $obj3->get_fecha_max('f_hastapoliza','poliza');


  $obj5= new Trabajo();
  $asesor = $obj5->get_element('ena','idnom');

  $obj31= new Trabajo();
  $liderp = $obj31->get_element('enp','nombre'); 

  $obj32= new Trabajo();
  $referidor = $obj32->get_element('enr','nombre'); 


 $fechaMin=date('Y', strtotime($fechaMin[0]["MIN(f_hastapoliza)"]));
 //$fechaMax=date('Y', strtotime($fechaMax[0]["MAX(f_hastapoliza)"]));


 //FECHA MAYORES A 2024
$dateString = $fechaMax[0]["MAX(f_hastapoliza)"];
// Parse a textual date/datetime into a Unix timestamp
$date = new DateTime($dateString);
$format = 'Y';

// Parse a textual date/datetime into a Unix timestamp
$date = new DateTime($dateString);

// Print it
$fechaMax= $date->format($format);


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
    <link rel="stylesheet" type="text/css" href="../../bootstrap-4.2.1/css/bootstrap.css">
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />
    <link rel="stylesheet" href="../../assets/css/material-kit.css?v=2.0.1">
    <!-- Documentation extras -->
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="../../assets/assets-for-demo/demo.css" rel="stylesheet" />
    <link href="../../assets/assets-for-demo/vertical-nav.css" rel="stylesheet" />

    <!-- BOOTSTRAP SELECT CSS -->
    <link rel="stylesheet" href="../../css/bootstrap-select.css">

    
    <!-- Alertify -->
    <link rel="stylesheet" type="text/css" href="../../assets/alertify/css/alertify.css">
    <link rel="stylesheet" type="text/css" href="../../assets/alertify/css/themes/bootstrap.css">
    <script src="../../assets/alertify/alertify.js"></script>


    <!-- DataTables -->
    <link href="../../DataTables/DataTables/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="../../DataTables/DataTables/js/jquery.dataTables.min.js"></script>
    <script src="../../DataTables/DataTables/js/dataTables.bootstrap4.min.js"></script>



    <style type="text/css">
        #carga{
            height: 80vh
        }
    </style>

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
            <div class="container">
            <a href="javascript:history.back(-1);" data-tooltip="tooltip" data-placement="right" title="Ir la página anterior" class="btn btn-info btn-round"><- Regresar</a>
            
                <div class="col-md-auto col-md-offset-2">
                    <center><h1 class="title">Pólizas a Renovar por Cía</h1></center>
                </div> 
                <div class="row" style="justify-content: center;">
                    <h3>Seleccione su Búsqueda</h3>
                </div>
                <br />
    
                <?php if (isset($_GET['m'])==2) {?>
    
                <div class="alert alert-danger" role="alert">
                    No existen datos para la búsqueda seleccionada!
                </div>
    
                <?php } ?>
    
    
                <form class="form-horizontal" action="renov_por_cia.php" method="get">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Año Vigencia Seguro:</label>
                            <select class="form-control" name="anio" id="anio">
    
                                <?php
                                for($i=$fechaMin; $i <= $fechaMax; $i++)
                                { 
                                if ($i<date('Y')) {
                                     
                                 }else{
                            ?>
                                <option value="<?php echo $i;?>"><?php echo $i;?></option>
                                <?php
                                    }
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
                      <div class="form-group col-md-12">
                        <label>Asesor:</label>
                        <select class="form-control selectpicker" name="asesor[]" multiple data-style="btn-white" data-header="Seleccione el Asesor" data-actions-box="true" data-live-search="true">
                           
                            <?php
                            for($i=0;$i<sizeof($asesor);$i++)
                                {  
                            ?>
                                <option value="<?php echo $asesor[$i]["cod"];?>"><?php echo utf8_encode($asesor[$i]["idnom"]);?></option>
                            <?php }for($i=0;$i<sizeof($liderp);$i++)
                                { ?> 
                                <option value="<?php echo $liderp[$i]["cod"];?>"><?php echo utf8_encode($liderp[$i]["nombre"]);?></option>
                            <?php } for($i=0;$i<sizeof($referidor);$i++)
                                {?>
                                <option value="<?php echo $referidor[$i]["cod"];?>"><?php echo utf8_encode($referidor[$i]["nombre"]);?></option>
                            <?php } ?>
                        </select>
                      </div>
                    </div>
    
    
    
    
    
    
                    <center><button type="submit" class="btn btn-success btn-round btn-lg">Buscar</button></center>
    
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

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>

    <!-- Bootstrap Select JavaScript -->
    <script src="../../js/bootstrap-select.js"></script>


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