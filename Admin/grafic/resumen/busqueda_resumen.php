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
  $fechaMin = $obj2->get_fecha_min('f_hastapoliza','poliza'); 

  $obj3= new Trabajo();
  $fechaMax = $obj3->get_fecha_max('f_hastapoliza','poliza'); 


  $fhoy=date("Y");

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <?php require('header.php');?>
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
                    <h1 class="title">Gráfico Resúmen</h1> 
                    <br/>
                    <a name="nombre"></a>
                    <a href="../resumen.php" class="btn btn-info btn-lg btn-round">Menú de Gráficos</a></center>
                </div>
                <br>




      

      <div class="row" style="justify-content: center;">
        <h3>Seleccione su Búsqueda</h3>
      </div>
      <br/>

      <?php if (isset($_GET['m'])==2) {?>
  
    <div class="alert alert-danger" role="alert">
        No existen datos para la búsqueda seleccionada!
    </div>

    <?php } ?>

      
      <form class="form-horizontal" action="resumen.php" method="get">
        <div class="form-row">
          <div class="form-group col-md-6">
          <label>Año Vigencia Seguro:</label>
            <select class="form-control selectpicker" name="anio" id="anio" data-style="btn-white">
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
        
        <div class="form-row">
          <div class="form-group col-md-12">
            <label>Tipo de Cuenta:</label>
            <select class="form-control selectpicker" name="tipo_cuenta[]" multiple data-style="btn-white" data-header="Tipo de Cuenta" data-actions-box="true" data-live-search="true">
              <option value="1">Individual</option>
              <option value="2">Colectivo</option>
            </select>
          </div>
          <div class="form-group col-md-6" hidden>
            <label>Status Final:</label>
            <select class="form-control" name="status">
              <option>Status Final</option>
              <option value="0">Activa</option>
              <option value="1">Anulada</option>
              <option value="2">Inactiva</option>
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

    <!-- Bootstrap Select JavaScript -->
    <script src="../../../js/bootstrap-select.js"></script>

   

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
    <script type="text/javascript">
      $(document).ready(function(){
          $('#anio').val(<?php echo $fhoy;?>); 
          $('#anio').change(); 
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