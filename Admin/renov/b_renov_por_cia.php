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
    <?php require('header.php');?>
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
            <a name="nombre"></a>
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
                            <select class="form-control selectpicker" name="anio" id="anio" data-style="btn-white">
    
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
                            <select class="form-control selectpicker" name="mes" id="mes" data-style="btn-white">
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
                    
                    <?php if ($permiso!=3) { ?>
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
                    <?php }?>

                    <?php if ($permiso==3) { ?>
                    <div class="form-row" hidden>
                      <div class="form-group col-md-12">
                        <select class="form-control selectpicker" name="asesor[]" >
                            <option value="<?php echo $user[0]['cod_vend'];?>"></option>
                        </select>
                      </div>
                    </div>
                    <?php }?>
    
    
    
    
    
    
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