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


  $totalPrimaCom=0;
  $totalCom=0;

  

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <!-- Favicons -->
    <link rel="apple-touch-icon" href="../assets/img/apple-icon.png">
    <link rel="icon" href="../assets/img/logo1.png">
    <title>
        Versatil Seguros
    </title>
    <link rel="stylesheet" type="text/css" href="../bootstrap-4.2.1/css/bootstrap.css">
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />
    <link rel="stylesheet" href="../assets/css/material-kit.css?v=2.0.1">
    <!-- Documentation extras -->
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="../assets/assets-for-demo/demo.css" rel="stylesheet" />
    <link href="../assets/assets-for-demo/vertical-nav.css" rel="stylesheet" />

    
    <!-- Alertify -->
    <link rel="stylesheet" type="text/css" href="../assets/alertify/css/alertify.css">
    <link rel="stylesheet" type="text/css" href="../assets/alertify/css/themes/bootstrap.css">
    <script src="../assets/alertify/alertify.js"></script>


    <!-- DataTables -->
    <link href="../DataTables/DataTables/css/dataTables.bootstrap4.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="../DataTables/DataTables/js/jquery.dataTables.min.js"></script>
    <script src="../DataTables/DataTables/js/dataTables.bootstrap4.min.js"></script>

    <link href="../bootstrap-datepicker/css/bootstrap-datepicker.css" rel="stylesheet">



    <style type="text/css">
        #carga{
            height: 80vh
        }
    </style>

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
                    <h1 class="title">Lista de Reportes de GC</h1>  
                </div>
                



                
                <center>
                <table class="table table-hover table-striped table-bordered" id="iddatatable1">
                    <thead style="background-color: #00bcd4;color: white; font-weight: bold;">
                        <tr>
                            <th>Nº Generada</th>
                            <th>Fecha Creación de GC</th>
                            <th>Fecha Desde Reporte GC</th>
                            <th>Fecha Hasta Reporte GC</th>
                        </tr>
                    </thead>
                    
                    <tbody >
                        <?php
                        $obj1= new Trabajo();
                        $gc_h = $obj1->get_element('gc_h','f_hoy_h'); 

                        for ($i=0; $i < sizeof($gc_h); $i++) { 

                        
                            

                            $f_pago_gc = date("d-m-Y", strtotime($gc_h[$i]['f_hoy_h']));
                            $f_desde_rep = date("d-m-Y", strtotime($gc_h[$i]['f_desde_h']));
                            $f_hasta_rep = date("d-m-Y", strtotime($gc_h[$i]['f_hasta_h']));
                            
                            ?>
                            <tr style="cursor: pointer">
                                <td><?php echo $gc_h[$i]['id_gc_h']; ?></td>
                                <td><?php echo $f_pago_gc; ?></td>
                                <td><?php echo $f_desde_rep; ?></td>
                                <td><?php echo $f_hasta_rep; ?></td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>

                    <tfoot>
                        <tr>
                            <th>Nº Generada</th>
                            <th>Fecha Pago GC</th>
                            <th>Fecha Desde Reporte GC</th>
                            <th>Fecha Hasta Reporte GC</th>
                        </tr>
                    </tfoot>
                </table>
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
            //$('#tablaDatatable1').load('t_reporte_com.php');
        });

        const tablaLoad1 = document.getElementById("tablaLoad1");
        const carga = document.getElementById("carga");

        setTimeout(()=>{
            carga.className = 'd-none';
            tablaLoad1.removeAttribute("hidden");
        }, 1500);


        $( "#iddatatable1 tbody tr" ).click(function() {
            var customerId = $(this).find("td").eq(0).html();   

            window.location.href = "v_reporte_gc.php?id_rep_gc="+customerId;
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