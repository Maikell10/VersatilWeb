<?php 
session_start();
if(isset($_SESSION['seudonimo'])) {

  }
    else {
        header("Location: login.php");
        exit();
      }
      
  require_once("../class/clases.php");


  $obj1= new Trabajo();
  $asesor = $obj1->get_element('ena','idena'); 


  $obj4= new Trabajo();
  $cia = $obj4->get_distinct_element('nomcia','dcia'); 

  


  $obj33= new Trabajo();
  $fechaMinRep = $obj33->get_fecha_min('f_pago_gc','rep_com'); 

  $obj55= new Trabajo();
  $fechaMaxRep = $obj55->get_fecha_max('f_pago_gc','rep_com'); 

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php require('header.php');?>
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
        

        <div id="carga" class="d-flex justify-content-center align-items-center">
            <div class="spinner-grow text-info" style="width: 7rem; height: 7rem;"></div>
        </div>
 
        <div class="section">
            <div class="container">
            <a href="javascript:history.back(-1);" data-tooltip="tooltip" data-placement="right" title="Ir la página anterior" class="btn btn-info btn-round"><- Regresar</a>

                <div class="col-md-auto col-md-offset-2" id="tablaLoad1" hidden="true">
                    <h1 class="title">Lista de Reporte de Comisiones</h1>  
                </div>
                
                <div class="row" style="justify-content: center;">
                    <h3>Seleccione su Búsqueda</h3>
                </div>
                <br/>

                <center><form class="form-horizontal" action="b_reportes1.php" method="get" style="width: 80%">
                    <div class="form-row" style="text-align: left;">
                      
                      <div class="form-group col-md-6">
                        <label align="left">Año Reporte Pago GC:</label>
                        <select class="form-control selectpicker" name="anio" id="anio" data-style="btn-white">
                            <option value="">Seleccione Año</option>
                        <?php
                            $date=date('Y', strtotime($fechaMinRep[0]["MIN(f_pago_gc)"]));
                            for($i=date('Y', strtotime($fechaMinRep[0]["MIN(f_pago_gc)"])); $i <= date('Y', strtotime($fechaMaxRep[0]["MAX(f_pago_gc)"])); $i++)
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
                        <label>Mes Reporte Pago GC:</label>
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
                    
                    

                    <div class="form-row" style="text-align: left;">
                      <div class="form-group col-md-12">
                        <label align="left">Cía:</label>
                        <select class="form-control selectpicker" name="cia" data-style="btn-white"  data-actions-box="true" data-live-search="true">
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


                      <button type="submit" class="btn btn-success btn-round btn-lg" >Buscar</button>

                </form></center>



                <div id="tablaDatatable1"></div>
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
    <!--	Plugin for the Datepicker, full documentation here: https://github.com/Eonasdan/bootstrap-datetimepicker -->
    <script src="../assets/js/plugins/bootstrap-datetimepicker.min.js"></script>
    <!--	Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
    <script src="../assets/js/plugins/nouislider.min.js"></script>
    <!-- Material Kit Core initialisations of plugins and Bootstrap Material Design Library -->
    <script src="../assets/js/material-kit.js?v=2.0.1"></script>
    <!-- Fixed Sidebar Nav - js With initialisations For Demo Purpose, Don't Include it in your project -->
    <script src="../assets/assets-for-demo/js/material-kit-demo.js"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>

    <script src="../bootstrap-datepicker/js/bootstrap-datepicker.js"></script>  
    <script src="../bootstrap-datepicker/locales/bootstrap-datepicker.es.min.js" charset="UTF-8"></script>

    
    <!-- Bootstrap Select JavaScript -->
    <script src="../js/bootstrap-select.js"></script>


    <script type="text/javascript">
        $(document).ready(function(){
            $('#btnAgregarnuevo').click(function(){
                datos=$('#frmnuevo').serialize();

                $.ajax({
                    type:"POST",
                    data:datos,
                    url:"../procesos/agregarAsesor.php",
                    success:function(r){
                        if(r==1){
                            $('#frmnuevo')[0].reset();
                            $('#tablaDatatable').load('t_asesor.php');
                            alertify.success("agregado con exito :D");
                        }else{
                            alertify.error("Fallo al agregar :(");
                        }
                    }
                });
            });

            $('#btnActualizar').click(function(){
                datos=$('#frmnuevoU').serialize();

                $.ajax({
                    type:"POST",
                    data:datos,
                    url:"../procesos/actualizarAsesor.php",
                    success:function(r){
                        if(r==1){
                            $('#tablaDatatable').load('t_asesor.php');
                            alertify.success("Actualizado con exito :D");
                        }else{
                            alertify.error("Fallo al actualizar :(");
                        }
                    }
                });
            });
        });
    </script>
    <script type="text/javascript">
        
        $(document).ready(function(){
            $('#tablaDatatable1').load('t_reporte_com.php');
        });

        const tablaLoad1 = document.getElementById("tablaLoad1");
        const carga = document.getElementById("carga");

        setTimeout(()=>{
            carga.className = 'd-none';
            tablaLoad1.removeAttribute("hidden");
        }, 6500);

    </script>

    <script type="text/javascript">
        function agregaFrmActualizar(idena){
            $.ajax({
                type:"POST",
                data:"idena=" + idena,
                url:"../procesos/obtenDatos.php",
                success:function(r){
                    datos=jQuery.parseJSON(r);
                    $('#idena').val(datos['idena']);
                    $('#nombreU').val(datos['idnom']);
                    $('#codigoU').val(datos['cod']);
                    $('#ciU').val(datos['id']);
                    $('#refcuentaU').val(datos['refcuenta']);
                }
            });
        }


        $(function () {
          $('[data-tooltip="tooltip"]').tooltip()
        })



        function agregaFrmMonto(idena){
            $.ajax({
                type:"POST",
                data:"idena=" + idena,
                url:"../procesos/obtenDatos.php",
                success:function(r){
                    datos=jQuery.parseJSON(r);
                    $('#idena1').val(datos['idena']);
                    $('#nombreU1').val(datos['idnom']);
                    $('#codigoU1').val(datos['cod']);
                    $('#ciU1').val(datos['id']);
                    $('#refcuentaU1').val(datos['refcuenta']);
                }
            });
        }
    </script>

    <script type="text/javascript">
      $('#desde').datepicker({  
        format: "dd-mm-yyyy", 
        startDate: '<?php echo $newDesde;?>',
      });

      $('#hasta').datepicker({  
        format: "dd-mm-yyyy", 
        endDate: '<?php echo $newHasta;?>',
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