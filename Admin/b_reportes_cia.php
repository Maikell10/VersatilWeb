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

  $obj2= new Trabajo();
  $fechaMinRep = $obj2->get_fecha_min('f_hasta_rep','rep_com'); 

  $obj3= new Trabajo();
  $fechaMaxRep = $obj3->get_fecha_max('f_hasta_rep','rep_com');

   $fechaMinRep=date('Y', strtotime($fechaMinRep[0]["MIN(f_hasta_rep)"]));
   $fechaMaxRep=date('Y', strtotime($fechaMaxRep[0]["MAX(f_hasta_rep)"]));

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

                <div class="col-md-auto col-md-offset-2" id="tablaLoad" hidden="true">
                    <h1 class="title">Lista de Reporte de Comisiones por Cía
                    </h1>  
                </div>

                <div class="row" style="justify-content: center;">
                    <h3>Seleccione su Búsqueda</h3>
                </div>
                <br/>


                <center><form class="form-horizontal" action="b_reportes_cia1.php" method="get" style="width: 80%">
                    <div class="form-row" style="text-align: left;">
                      
                      <div class="form-group col-md-6">
                        <label align="left">Año Reporte:</label>
                        <select class="form-control" name="anio" id="anio">
                            <option value="">Seleccione Año</option>
                        <?php
                            
                            for($i=$fechaMinRep; $i <= $fechaMaxRep; $i++)
                            {  
                        ?>
                            <option value="<?php echo $i;?>"><?php echo $i;?></option>
                        <?php
                            } 
                        ?> 
                        </select>
                      </div>
                      <div class="form-group col-md-6">
                        <label>Mes Reporte:</label>
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


                      <button type="submit" class="btn btn-success btn-round btn-lg" >Buscar</button>

                </form></center>




                <div id="tablaDatatable"></div>
          


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

    

    <!-- Modal -->
    <div class="modal fade" id="agregarnuevosdatosmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Agrega nuevo Asesor</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="frmnuevo">
                        <label>Código</label>
                        <input type="text" class="form-control input-sm" id="codigo" name="codigo">
                        <label>Nombre</label>
                        <input type="text" class="form-control input-sm" id="nombre" name="nombre">
                        <label>C.I o Pasaporte</label>
                        <input type="text" class="form-control input-sm" id="ci" name="ci">
                        <label>Ref Cuenta</label>
                        <input type="text" class="form-control input-sm" id="refcuenta" name="refcuenta">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                    <button type="button" id="btnAgregarnuevo" class="btn btn-info">Agregar nuevo</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Editar-->
    <div class="modal fade" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar Asesor</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="frmnuevoU">
                        <input type="text" class="form-control input-sm" id="idena" name="idena" hidden="">
                        <label>Código</label>
                        <input type="text" class="form-control input-sm" id="codigoU" name="codigoU">
                        <label>Nombre</label>
                        <input type="text" class="form-control input-sm" id="nombreU" name="nombreU">
                        <label>C.I o Pasaporte</label>
                        <input type="text" class="form-control input-sm" id="ciU" name="ciU">
                        <label>Ref Cuenta</label>
                        <input type="text" class="form-control input-sm" id="refcuentaU" name="refcuentaU">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-success" id="btnActualizar">Actualizar</button>
                </div>
            </div>
        </div>
    </div>



    <!-- Modal Monto-->
    <div class="modal fade" id="modalMonto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Totales de Asesor</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table table-hover table-striped table-bordered display table-responsive nowrap" id="iddatatable" >
                    <thead style="background-color: #00bcd4;color: white; font-weight: bold;">
                        <tr>
                            <th>Código</th>
                            <th>Nombre</th>
                            <th>C.I o Pasaporte</th>
                            <th>Ref Cuenta</th>
                        </tr>
                    </thead>

                    <tbody >
                            <tr >
                                <td><input type="text" class="form-control input-sm" id="codigoU1" name="codigoU1" readonly="true"></td>
                                <td><input type="text" class="form-control input-sm" id="nombreU1" name="nombreU1" readonly="true"></td>
                                <td><input type="text" class="form-control input-sm" id="ciU1" name="ciU1" readonly="true"></td>
                                <td><input type="text" class="form-control input-sm" id="refcuentaU1" name="refcuentaU1" readonly="true"></td>
                            </tr>
                    </tbody>
                </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>


    <script type="text/javascript">
        
        $(document).ready(function(){
            $('#tablaDatatable').load('t_reportes.php');
        });

        const tablaLoad = document.getElementById("tablaLoad");
        const carga = document.getElementById("carga");

        setTimeout(()=>{
            carga.className = 'd-none';
            tablaLoad.removeAttribute("hidden");
        }, 4500);

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