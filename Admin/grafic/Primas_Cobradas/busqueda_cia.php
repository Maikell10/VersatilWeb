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

  $obj3= new Trabajo();
  $fechaMin = $obj3->get_fecha_min('f_hastapoliza','poliza'); 

  $obj4= new Trabajo();
  $fechaMax = $obj4->get_fecha_max('f_hastapoliza','poliza'); 


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

    <?php require('navigation.php');?>




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
                    <h1 class="title">Primas Cobradas por Cía</h1> 
                    <br/>
                    
                    <a href="../primas_c.php" class="btn btn-info btn-lg btn-round">Menú de Gráficos</a></center>
                </div>
                <br>
 
      

      <div class="row" style="justify-content: center;">
        <h3>Seleccione su Búsqueda</h3>
      </div>
      <br/>

      <form class="form-horizontal" action="cia.php" method="get">
        <div class="form-row">
          <div class="form-group col-md-12">
            <label>Seleccione el Año de Pago:</label>
            <select class="form-control" name="anio">
              <?php
                $date=date('Y', strtotime($fechaMin[0]["MIN(f_hastapoliza)"]));
                for($i=date('Y', strtotime($fechaMin[0]["MIN(f_hastapoliza)"])); $i <= $fechaMax; $i++)
                  {  
              ?>
                  <option value="<?php echo $date;?>"><?php echo $date;?></option>
              <?php
                  $date=$date+1;
                } 
              ?> 
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
            <label>Status:</label>
            <select class="form-control" name="status">
              <option>Status</option>
              <option value="0">Activa</option>
              <option value="1">Anulada</option>
              <option value="2">Inactiva</option>
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



          <center><button type="submit" class="btn btn-success btn-round btn-lg">Buscar</button></center>

      </form>
      
      </div>
      </div>
      <br><br><br><br>



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