<?php 
session_start();
if(isset($_SESSION['seudonimo'])) {

  }
    else {
        header("Location: login.php");
        exit();
      }
      
  require_once("../class/clases.php");


  $obj2= new Trabajo();
  $fechaMin = $obj2->get_fecha_min('f_hastapoliza','poliza'); 


  $obj3= new Trabajo();
  $fechaMax = $obj3->get_fecha_max('f_hastapoliza','poliza');

  //FECHA MAYORES A 2024
$dateString = $fechaMax[0]["MAX(f_hastapoliza)"];
// Parse a textual date/datetime into a Unix timestamp
$date = new DateTime($dateString);
$format = 'Y';

// Parse a textual date/datetime into a Unix timestamp
$date = new DateTime($dateString);

// Print it
$fechaMax= $date->format($format);



  $obj3= new Trabajo();
  $asesor = $obj3->get_element('ena','idena'); 

  $obj31= new Trabajo();
  $liderp = $obj31->get_element('enp','id_enp'); 

  $obj32= new Trabajo();
  $referidor = $obj32->get_element('enr','id_enr'); 


  $obj1= new Trabajo();
  $poliza = $obj1->get_poliza_total(); 


  $Ejecutivo[sizeof($poliza)]=null;

  for ($i=0; $i < sizeof($poliza); $i++) { 
        $obj111= new Trabajo();
        $asesor1 = $obj111->get_element_by_id('ena','cod',$poliza[$i]['codvend']);
        $nombre=$asesor1[0]['idnom'];

        if (sizeof($asesor1)==null) {
            $ob3= new Trabajo();
            $asesor1 = $ob3->get_element_by_id('enp','cod',$poliza[$i]['codvend']); 
            $nombre=$asesor1[0]['nombre'];
        }
    
        if (sizeof($asesor1)==null) {
            $ob3= new Trabajo();
            $asesor1 = $ob3->get_element_by_id('enr','cod',$poliza[$i]['codvend']); 
            $nombre=$asesor1[0]['nombre'];
        }

        $Ejecutivo[$i]=$nombre;                 
  }




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
    <link rel="stylesheet" href="../assets/css/material-kit.css">
    <!-- Documentation extras -->
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="../assets/assets-for-demo/demo.css" rel="stylesheet" />
    <link href="../assets/assets-for-demo/vertical-nav.css" rel="stylesheet" />

    <!-- BOOTSTRAP SELECT CSS -->
    <link rel="stylesheet" href="../css/bootstrap-select.css">

    
    <!-- Alertify -->
    <link rel="stylesheet" type="text/css" href="../assets/alertify/css/alertify.css">
    <link rel="stylesheet" type="text/css" href="../assets/alertify/css/themes/bootstrap.css">
    <script src="../assets/alertify/alertify.js"></script>


    <!-- DataTables -->
    <link href="../DataTables/DataTables/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="../DataTables/DataTables/js/jquery.dataTables.min.js"></script>
    <script src="../DataTables/DataTables/js/dataTables.bootstrap4.min.js"></script>


    <script type="text/javascript">
        $(document).ready(function() {
            $('#example').DataTable();
        } );
    </script>
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

                <div class="col-md-auto col-md-offset-2" id="tablaLoad" hidden="true">
                <a href="javascript:history.back(-1);" data-tooltip="tooltip" data-placement="right" title="Ir la página anterior" class="btn btn-info btn-round"><- Regresar</a>
                    <h1 class="title">Lista Pólizas
                        <a href="add/crear_poliza.php" class="btn btn-info pull-right menu"><i class="fa fa-plus-circle" aria-hidden="true"></i>&nbsp;&nbsp;Nueva Póliza</a>
                    </h1>  
                </div>
                <br><br>

                <?php if (isset($_GET['m'])==2) {?>
  
                <div class="alert alert-danger" role="alert">
                    No existen datos para la búsqueda seleccionada!
                </div>
                
                <?php } ?>

                <center><form class="form-horizontal" action="b_poliza1.php" method="get" style="width: 80%">
                    <div class="form-row" style="text-align: left;">
                      
                      <div class="form-group col-md-6">
                        <label align="left">Año Vigencia Seguro:</label>
                        <select class="form-control selectpicker" name="anio" id="anio" data-style="btn-white" data-size="13">
                            <option value="">Seleccione Año</option>
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
                    
                    

                    <div class="form-row" style="text-align: left;">
                      <div class="form-group col-md-6">
                        <label align="left">Status:</label>
                        <select class="form-control selectpicker" name="status" multiple data-style="btn-white">
                            <optgroup label="Seleccione Status">
                                <option value="1">Activa</option>
                                <option value="2">Inactiva</option>
                                <option value="3">Anulada</option>
                            </optgroup>
                        </select>
                      </div>

                      <div class="form-group col-md-6">
                        <label>Asesor:</label>
                        <select class="form-control selectpicker" name="asesor[]" multiple data-style="btn-white" data-header="Seleccione el Asesor" data-size="12" data-live-search="true">
                            <option value="">Seleccione el Asesor</option>
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


                      <button type="submit" class="btn btn-success btn-round btn-lg" >Buscar</button>

                </form></center>


                





                <center>
                <div class="table-responsive">
                    <table class="table table-hover table-striped table-bordered" id="iddatatable" >
                        <thead style="background-color: #00bcd4;color: white; font-weight: bold;">
                            <tr>
                                <th hidden>f_poliza</th>
                                <th hidden>id</th>
                                <th>N° Póliza</th>
                                <th>Nombre Asesor</th>
                                <th>Cía</th>
                                <th>F Desde Seguro</th>
                                <th>F Hasta Seguro</th>
                                <th style="background-color: #E54848;">Prima Suscrita</th>
                                <th nowrap>Nombre Titular</th>
                            </tr>
                        </thead>
                        
                        <tbody >
                            <?php
                            $totalsuma=0;
                            $totalprima=0;
                            $currency="";
                            for ($i=0; $i < sizeof($poliza); $i++) { 
                                //if ($poliza[$i]['id_titular']==0) {
                                    
                                //} else {

                                    
                                    
                                
                                
                                $totalsuma=$totalsuma+$poliza[$i]['sumaasegurada'];
                                $totalprima=$totalprima+$poliza[$i]['prima'];

                                $originalDesde = $poliza[$i]['f_desdepoliza'];
                                $newDesde = date("d/m/Y", strtotime($originalDesde));
                                $originalHasta = $poliza[$i]['f_hastapoliza'];
                                $newHasta = date("d/m/Y", strtotime($originalHasta));

                                $originalFProd = $poliza[$i]['f_poliza'];
                                $newFProd = date("d/m/Y", strtotime($originalFProd));

                                if ($poliza[$i]['currency']==1) {
                                    $currency="$ ";
                                }else{$currency="Bs ";}


                                if ($poliza[$i]['f_hastapoliza'] >= date("Y-m-d")) {
                                ?>
                                <tr style="cursor: pointer;">
                                    <td hidden><?php echo $poliza[$i]['f_poliza']; ?></td>
                                    <td hidden><?php echo $poliza[$i]['id_poliza']; ?></td>
                                    <td style="color: #2B9E34;font-weight: bold"><?php echo $poliza[$i]['cod_poliza']; ?></td>
                                <?php            
                                } else{
                                ?>
                                <tr style="cursor: pointer;">
                                    <td hidden><?php echo $poliza[$i]['f_poliza']; ?></td>
                                    <td hidden><?php echo $poliza[$i]['id_poliza']; ?></td>
                                    <td style="color: #E54848;font-weight: bold"><?php echo $poliza[$i]['cod_poliza']; ?></td>
                                <?php   
                                }

                                $nombre=$poliza[$i]['nombre_t']." ".$poliza[$i]['apellido_t'];
                                ?>
                                
                                    
                                    <td><?php echo utf8_encode($Ejecutivo[$i]); ?></td>
                                    <td><?php echo utf8_encode($poliza[$i]['nomcia']); ?></td>
                                    <td><?php echo $newDesde; ?></td>
                                    <td><?php echo $newHasta; ?></td>
                                    <td><?php echo $currency.number_format($poliza[$i]['prima'],2); ?></td>
                                    <td nowrap><?php echo utf8_encode($nombre); ?></td>
                                </tr>
                                <?php
                                //}
                            }
                            ?>
                        </tbody>


                        <tfoot>
                            <tr>
                                <th hidden>f_poliza</th>
                                <th hidden>id</th>
                                <th>N° Póliza</th>
                                <th>Nombre Asesor</th>
                                <th>Cía</th>
                                <th>F Desde Seguro</th>
                                <th>F Hasta Seguro</th>
                                <th>Prima Suscrita $<?php echo number_format($totalprima,2); ?></th>
                                <th>Nombre Titular</th>
                            </tr>
                        </tfoot>
                    </table>
                    </div>


                    <h1 class="title">Total de Prima Suscrita</h1>
                    <h1 class="title text-danger">$ <?php  echo number_format($totalprima,2);?></h1>

                    <h1 class="title">Total de Pólizas</h1>
                    <h1 class="title text-danger"><?php  echo sizeof($poliza);?></h1>

                </center>



    
                <!--
                <center><div id="tablaDatatable"></div></center>
                -->
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

    <script src="../assets/js/core/popper.min.js"></script>
    <script src="../assets/js/bootstrap-material-design.js"></script>
    <!--  Plugin for Date Time Picker and Full Calendar Plugin  -->
    <script src="../assets/js/plugins/moment.min.js"></script>
    <!--    Plugin for the Datepicker, full documentation here: https://github.com/Eonasdan/bootstrap-datetimepicker -->
    <script src="../assets/js/plugins/bootstrap-datetimepicker.min.js"></script>
    <!--    Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
    <script src="../assets/js/plugins/nouislider.min.js"></script>
    <!-- Material Kit Core initialisations of plugins and Bootstrap Material Design Library -->
    <script src="../assets/js/material-kit.js?v=2.0.1"></script>
    <!-- Fixed Sidebar Nav - js With initialisations For Demo Purpose, Don't Include it in your project -->
    <script src="./assets/assets-for-demo/js/material-kit-demo.js"></script>

    <!-- Bootstrap Select JavaScript -->
    <script src="../js/bootstrap-select.js"></script>

    

    <!-- Modal -->
    <div class="modal fade" id="agregarnuevosdatosmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Agrega nueva Póliza</h5>
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
                    <button type="button" id="btnAgregarnuevo" class="btn btn-info">Agregar Nuevo</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Editar-->
    <div class="modal fade" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar Póliza</h5>
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


   
    <script type="text/javascript">
        $(document).ready(function(){
            $('#tablaDatatable').load('t_poliza.php');
        });

        const tablaLoad = document.getElementById("tablaLoad");
        const carga = document.getElementById("carga");

        setTimeout(()=>{
            carga.className = 'd-none';
            tablaLoad.removeAttribute("hidden");
        }, 1500);
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#iddatatable').DataTable({
                scrollX: 300,
                "order": [[ 0, "desc" ]],
                "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]]
            });
        } );

        $(function () {
          $('[data-tooltip="tooltip"]').tooltip()
        });

        $( "#iddatatable tbody tr" ).click(function() {
            var customerId = $(this).find("td").eq(1).html();   

            window.open ("v_poliza.php?id_poliza="+customerId ,'_blank');
        });

        $(function () {
          $('[data-tooltip="tooltip"]').tooltip()
        })
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