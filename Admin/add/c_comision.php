<?php 
session_start();
if(isset($_SESSION['seudonimo'])) {

  }
    else {
        header("Location: login.php");
        exit();
      }
  
  require_once("../../class/clases.php");




if(isset($_POST['f_desde'])){ echo $_POST['f_desde']; }

  $idcia=$_GET['cia'];
  $cant_poliza=$_GET['cant_poliza'];

  $id_rep=$_GET['id_rep'];

  
  //$f_desde = date("Y-m-d", strtotime($_GET['f_desde']));
  $f_hasta = date("Y-m-d", strtotime($_GET['f_hasta']));
  $f_pagoGc = date("Y-m-d", strtotime($_GET['f_pagoGc']));


  $obj1= new Trabajo();
  $cia = $obj1->get_element_by_id('dcia','idcia',$idcia); 

  
 



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

    <link href="../../bootstrap-datepicker/css/bootstrap-datepicker.css" rel="stylesheet">

    
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
                    <li><b>[Administración]</b></li>
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
        

        

        <div class="section">
            <div class="container" >
            <a href="javascript:history.back(-1);" data-tooltip="tooltip" data-placement="right" title="Ir la página anterior" class="btn btn-info btn-round"><- Regresar</a>
                <center>
                <div class="col-md-auto col-md-offset-2">
                    <h1 class="title"><i class="fa fa-info-circle" aria-hidden="true"></i>&nbsp;Compañía: <?php echo utf8_encode($cia[0]['nomcia']);?>
                    </h1>  
                </div>

                <br/><br/>


            
                <h2 id="existeRep" class="text-success"><strong></strong></h2>
                <h2 id="no_existeRep" class="text-danger"><strong></strong></h2>

                <form class="form-horizontal" id="frmnuevo" method="get" action="comision.php" >
                    <div class="form-row table-responsive">
                        <table class="table table-hover table-striped table-bordered" id="iddatatable" >
                            <thead style="background-color: #00bcd4;color: white; font-weight: bold;">
                                <tr>
                                    <th colspan="2">Fecha Creación GC</th>
                                    <th colspan="2">Fecha Hasta Reporte</th>
                                    <th colspan="2">Total Prima Cobrada</th>
                                    <th>Total Comision Cobrada</th>
                                    <th hidden>id reporte</th>
                                    <th hidden>cia</th>
                                    <th hidden>cant_poliza</th>
                                    <th hidden>prima_comt</th>
                                    <th hidden>comt</th>
                                </tr>
                            </thead>
                                <tr>
                                    <td colspan="2"><input type="text" class="form-control" id="f_pagoGc" name="f_pagoGc" readonly value="<?php echo $_GET['f_pagoGc'];?>"></td>
                                    <td colspan="2"><input type="text" class="form-control" id="f_hasta" name="f_hasta" readonly value="<?php echo $_GET['f_hasta'];?>"></td>
                                    <td colspan="2"><input type="text" class="form-control" id="primat_com" name="primat_com" readonly value="<?php echo "$ ".number_format($_GET['primat_com'],2);?>"></td>
                                    <td><input type="text" class="form-control" id="comt" name="comt" readonly value="<?php echo "$ ".number_format($_GET['comt'],2);?>"></td>

                                    <td hidden><input type="text" class="form-control" id="id_rep" name="id_rep" value="<?php echo $id_rep;?>"></td>
                                    <td hidden><input type="text" class="form-control" id="cia" name="cia" value="<?php echo $idcia;?>"></td>
                                    <td hidden><input type="text" class="form-control" id="cant_poliza" name="cant_poliza" value="<?php echo $cant_poliza;?>"></td>

                                    <td hidden><input type="text" class="form-control" id="primat_comt" name="primat_comt" value="<?php echo $_GET['primat_com'];?>"></td>
                                    <td hidden><input type="text" class="form-control" id="comtt" name="comtt" value="<?php echo $_GET['comt'];?>"></td>
                                </tr>

                                <tr style="background-color: #00bcd4;color: white; font-weight: bold;">
                                    <th>N° de Póliza *</th>
                                    <th>Asegurado</th>
                                    <th>Fecha de Pago de la Prima *</th>
                                    <th style="background-color: #E54848;">Prima Sujeta a Comisión *</th>
                                    <th>% Comisión *</th>
                                    <th>Comisión</th>
                                    <th>Asesor - Ejecutivo</th>
                                    <th hidden>Cod Asesor - Ejecutivo</th>
                                    <th hidden>idpoliza</th>
                                </tr>
                            <?php
                                if ($_GET['exx']==1) {
                                    $obj10= new Trabajo();
                                    $repEx = $obj10->get_comision($id_rep);
                                    $totalprimaant=0;
                                    $totalcomant=0;

                                    for ($i=0; $i < sizeof($repEx) ; $i++) {   
                                        $obj11= new Trabajo();
                                        $titu = $obj11->get_poliza_by_id($repEx[$i]['id_poliza']);

                                        $totalprimaant=$totalprimaant+$repEx[$i]['prima_com'];
                                        $totalcomant=$totalcomant+$repEx[$i]['comision'];

                                        $nombre=$titu[0]['nombre_t']." ".$titu[0]['apellido_t'];
                                        if ($titu[0]['id_titular']==0) {
                                            $ob11= new Trabajo();
                                            $tituprep = $ob11->get_element_by_id('titular_pre_poliza','id_poliza',$repEx[$i]['id_poliza']);
                                            $nombre=$tituprep[0]['asegurado'];
                                        }

                                        $originalFPP = $repEx[$i]['f_pago_prima'];
				                        $newFPP = date("d/m/Y", strtotime($originalFPP));
                            ?>
                                    <tr >
                                        <td><input type="text" class="form-control" value="<?php echo $repEx[$i]['num_poliza'];?>" readonly></td>
                                        <td><input type="text" class="form-control" value="<?php echo $nombre;?>" readonly></td>
                                        <td><input type="text" class="form-control" value="<?php echo $newFPP;?>" readonly></td>
                                        <td><input type="text" class="form-control" value="<?php echo "$ ".number_format($repEx[$i]['prima_com'],2);?>" readonly style="text-align:right"></td>
                                        <td><input type="text" class="form-control" value="<?php echo number_format((($repEx[$i]['comision']*100)/$repEx[$i]['prima_com']),2)."%";?>" readonly style="text-align:center"></td>
                                        <td><input type="text" class="form-control" value="<?php echo "$ ".number_format($repEx[$i]['comision'],2);?>" readonly style="text-align:right"></td>
                                        
                                        <td><input type="text" class="form-control" value="<?php echo $repEx[$i]['cod_vend'];?>" readonly></td>
                                        <td hidden><input type="text" class="form-control" ></td>
                                        <td hidden><input type="text" class="form-control" ></td>
                                    </tr>
                            <?php
                                    }
                                }

                                for ($i=0; $i < $cant_poliza ; $i++) {   
                                
                            ?>
                            <tbody >
                                <tr style="background-color: white">
                                    <td><input onblur="<?php echo 'validarPoliza'.$i.'(this)';?>" type="text" class="form-control <?php echo 'validarpoliza'.$i;?>" id="<?php echo 'n_poliza'.$i;?>" name="<?php echo 'n_poliza'.$i;?>" required data-toggle="tooltip" data-placement="bottom" title="Sólo introducir números"></td>

                                    

                                    <td><input type="text" class="form-control" readonly="true" id="<?php echo 'nom_titu'.$i;?>" name="<?php echo 'nom_titu'.$i;?>" ></td>
                                    <td><div class="input-group date">
                                            <input type="text" class="form-control" id="<?php echo 'f_pago'.$i;?>" name="<?php echo 'f_pago'.$i;?>" required data-toggle="tooltip" data-placement="bottom" title="Campo Obligatorio" autocomplete="off"> 
                                        </div>
                                    </td>
                                    <td><input type="number" step="0.01" onblur="<?php echo 'calcularRest(this)';?>" class="form-control" id="<?php echo 'prima'.$i;?>" name="<?php echo 'prima'.$i;?>" required data-toggle="tooltip" data-placement="bottom" title="Campo Obligatorio [Sólo introducir números y punto (.) como separador decimal]"></td>

                                    <td><input style="text-align: center" onblur="<?php echo 'calcularP'.$i.'(this)';?>" type="number" step="0.01" class="form-control" id="<?php echo 'comisionPor'.$i;?>" name="<?php echo 'comisionPor'.$i;?>" required data-toggle="tooltip" data-placement="bottom" title="Campo Obligatorio [Sólo introducir números y punto (.) como separador decimal]"></td> 

                                    <td><input  type="text"  class="form-control" id="<?php echo 'comision'.$i;?>" name="<?php echo 'comision'.$i;?>"  readonly></td>   

                                    
                                    <td><input type="text" class="form-control" readonly="true" id="<?php echo 'asesor'.$i;?>" name="<?php echo 'asesor'.$i;?>" ></td>

                                    <td hidden><input type="text" class="form-control" id="<?php echo 'codasesor'.$i;?>" name="<?php echo 'codasesor'.$i;?>" ></td>

                                    <td hidden><input type="text" class="form-control" id="<?php echo 'id_poliza'.$i;?>" name="<?php echo 'id_poliza'.$i;?>" ></td>

                                    
                                </tr>
                                <tr><td colspan="7" style="padding:0px;background-color: white"><a style="width: 100%" href="" class="btn btn-round btn btn-danger" data-toggle="modal" data-target="#precargapoliza" id="<?php echo 'btnPre'.$i;?>" name="<?php echo 'btnPre'.$i;?>" onclick="<?php echo 'botonPreCarga'.$i.'()';?>" hidden>Precargar Póliza</a></td></tr>
                                
                            </tbody>
                            <?php
                            }
                            ?>
                        </table>
                        
                        <input style="width:100%" type="button" onclick="deleterow()" class="btn btn-danger borrar" value="Eliminar Última Fila" id="borrar"/>
                        
                        
                    </div>

                        <?php
                        $primaRestante=$_GET['primat_com']-isset($totalprimaant);
                            if (isset($totalprimaant)>$_GET['primat_com']) {
                        ?>  
                            <h2 style="color:red">[Error!] Las comisiones cargadas son superiores al total del reporte</h2>
                        <?php      
                            } elseif(isset($totalprimaant)<$_GET['primat_com']) {
                        ?>
                            <h2 style="color:red;font-weight:bold" id="Rest">Falta cargar <?php echo "$ ".number_format($primaRestante,2);?> de prima sujeta a comisión</h2>
                        <?php 
                            }elseif(isset($totalprimaant)==$_GET['primat_com']) {
                                $primaRestante=0;
                        ?>
                        <h2 style="color:green;font-weight:bold" id="Rest">Pendiente a Cargar $0</h2>
                        <?php 
                            }
                        ?>
                    

                    <button type="submit" id="btnForm" class="btn btn-info btn-lg btn-round">Previsualizar</button>
                </form>
                </center>





                
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

    <script src="../../bootstrap-datepicker/js/bootstrap-datepicker.js"></script>  
    <script src="../../bootstrap-datepicker/locales/bootstrap-datepicker.es.min.js" charset="UTF-8"></script>

    <!-- Modal -->
    <div class="modal fade" id="precargapoliza" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Agrega nueva Pre-Póliza</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="frmnuevoP">
                        <table class="table table-hover table-striped table-bordered" id="iddatatable1">
                            <thead style="background-color: #00bcd4;color: white; font-weight: bold;">
                                <tr>
                                <th>Nº de Póliza</th>
                                <th>Nombre Asegurado</th>
                                <th hidden>Cía</th>
                                </tr>
                            </thead>
                                <tr style="background-color:white">
                                    <td><input type="text" class="form-control" id="num_poliza" name="num_poliza" readonly></td>
                                    <td><input type="text" class="form-control" id="asegurado" name="asegurado" required onkeyup="mayus(this);"></td>
                                    <td hidden><input type="text" class="form-control" id="idcia" name="idcia" readonly value="<?php echo $idcia;?>"></td>
                                </tr>
                        </table>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" id="btnAgregarnuevo" class="btn btn-info">Agregar nuevo</button>
                </div>
            </div>
        </div>
    </div>



    <script>
        $(document).ready(function(){

            var variable='<?php echo $cant_poliza;?>';
            $('#cant_poliza').val('<?php echo $cant_poliza;?>');
            
            console.log(variable);
        });
        function deleterow() {
            
            if ($('#cant_poliza').val()==1 ) {
                alertify.error('No se ha Eliminado por que es la fila restante')
            } else {
                alertify.confirm('Eliminar Fila!', '¿Desea Eliminar la Fila?', 
            function(){ 
                var table = document.getElementById("iddatatable");
                table.deleteRow(-1);
                table.deleteRow(-1);
                alertify.success('Fila Eliminada');

                
                var cant_poliza = $('#cant_poliza').val();
                var cant_poliza = cant_poliza-1;
                $('#cant_poliza').val(cant_poliza);
                console.log(cant_poliza);
            }, 
            function(){ 
                alertify.error('No se ha Eliminado')
            }).set('labels', {ok:'Sí', cancel:'No'}).set({transition:'zoom'}).show();
            }
            
               
            
        }


        
       
        function unaMas(arg){

            //cuento las filas de la tabla
            var num_fila = ($('#miTabla >tbody >tr').length)-1;

          
            var num_poliza = {};
            var prefijo = 'texto';
            for (var i = 0; i < num_fila; i++) {
              num_poliza[prefijo + i] = $('#n_poliza'+i).val();
              alert(num_poliza[prefijo + i]);
            }




            if(document.getElementById(arg)){
                document.getElementById(arg).innerHTML += 
                '<tr style="background-color:white;color:black"><td name="campo[]">nueva fila<\/td><td><input onblur="validarPoliza'+num_fila+'(this)" type="text" class="form-control validarPoliza'+num_fila+'" id="n_poliza'+num_fila+'" name="n_poliza'+num_fila+'" required data-toggle="tooltip" data-placement="bottom" title="Sólo introducir números"></td><\/tr>';

            }

            //$('#n_poliza00').val(num_poliza1);
            for (var i = 0; i < num_fila; i++) {
              $('#n_poliza'+i).val(num_poliza[prefijo + i]);
            }
        }

        $(document).ready(function(){

            $('#btnAgregarnuevo').click(function(){
                

                if($("#asegurado").val().length < 1) {  
                    alertify.error("El Nombre del Cliente es Obligatorio");
                    return false;  
                } 
                datos=$('#frmnuevoP').serialize();
                var num_poliza = $('#num_poliza').val();
                var asegurado = $('#asegurado').val();

                $.ajax({
                    type:"POST",
                    data:datos,
                    url:"../../procesos/agregarPrePoliza.php",
                    success:function(r){
                        if(r==1){
                            $('#frmnuevoP')[0].reset();
                            alertify.success("Agregada con Exito!!");

                            if (($("#num").val())==0) {
                                $("#n_poliza0").val(datos['cod_poliza']);
                                $("#n_poliza0").css('background-color', 'green');
                                $("#n_poliza0").css('color', 'white');
                                $('#n_poliza0').attr('data-original-title','Póliza Existente');   
                                $('#btnForm').removeAttr('disabled');   
                                $('#n_poliza0').val(num_poliza);   
                                $('#nom_titu0').val(asegurado);   
                                $('#asesor0').val('PENDIENTE');    
                                $('#codasesor0').val('AP-1'); 
                                $('#btnPre0').attr('hidden',true);
                                $('#id_poliza0').val('0'); 
                            }
                            if (($("#num").val())==1) {
                                $("#n_poliza1").val(datos['cod_poliza']);
                                $("#n_poliza1").css('background-color', 'green');
                                $("#n_poliza1").css('color', 'white');
                                $('#n_poliza1').attr('data-original-title','Póliza Existente');   
                                $('#btnForm').removeAttr('disabled');   
                                $('#n_poliza1').val(num_poliza);   
                                $('#nom_titu1').val(asegurado);   
                                $('#asesor1').val('PENDIENTE');    
                                $('#codasesor1').val('AP-1'); 
                                $('#btnPre1').attr('hidden',true);
                                $('#id_poliza1').val('0'); 
                            }
                            if (($("#num").val())==2) {
                                $("#n_poliza2").val(datos['cod_poliza']);
                                $("#n_poliza2").css('background-color', 'green');
                                $("#n_poliza2").css('color', 'white');
                                $('#n_poliza2').attr('data-original-title','Póliza Existente');   
                                $('#btnForm').removeAttr('disabled');   
                                $('#n_poliza2').val(num_poliza);   
                                $('#nom_titu2').val(asegurado);   
                                $('#asesor2').val('PENDIENTE');    
                                $('#codasesor2').val('AP-1'); 
                                $('#btnPre2').attr('hidden',true);
                                $('#id_poliza2').val('0'); 
                            }
                            if (($("#num").val())==3) {
                                $("#n_poliza3").val(datos['cod_poliza']);
                                $("#n_poliza3").css('background-color', 'green');
                                $("#n_poliza3").css('color', 'white');
                                $('#n_poliza3').attr('data-original-title','Póliza Existente');   
                                $('#btnForm').removeAttr('disabled');   
                                $('#n_poliza3').val(num_poliza);   
                                $('#nom_titu3').val(asegurado);   
                                $('#asesor3').val('PENDIENTE');    
                                $('#codasesor3').val('AP-1'); 
                                $('#btnPre3').attr('hidden',true);
                                $('#id_poliza3').val('0'); 
                            }
                            if (($("#num").val())==4) {
                                $("#n_poliza4").val(datos['cod_poliza']);
                                $("#n_poliza4").css('background-color', 'green');
                                $("#n_poliza4").css('color', 'white');
                                $('#n_poliza4').attr('data-original-title','Póliza Existente');   
                                $('#btnForm').removeAttr('disabled');   
                                $('#n_poliza4').val(num_poliza);   
                                $('#nom_titu4').val(asegurado);   
                                $('#asesor4').val('PENDIENTE');    
                                $('#codasesor4').val('AP-1'); 
                                $('#btnPre4').attr('hidden',true);
                                $('#id_poliza4').val('0'); 
                            }
                            if (($("#num").val())==5) {
                                $("#n_poliza5").val(datos['cod_poliza']);
                                $("#n_poliza5").css('background-color', 'green');
                                $("#n_poliza5").css('color', 'white');
                                $('#n_poliza5').attr('data-original-title','Póliza Existente');   
                                $('#btnForm').removeAttr('disabled');   
                                $('#n_poliza5').val(num_poliza);   
                                $('#nom_titu5').val(asegurado);   
                                $('#asesor5').val('PENDIENTE');    
                                $('#codasesor5').val('AP-1'); 
                                $('#btnPre5').attr('hidden',true);
                                $('#id_poliza5').val('0'); 
                            }
                            if (($("#num").val())==6) {
                                $("#n_poliza6").val(datos['cod_poliza']);
                                $("#n_poliza6").css('background-color', 'green');
                                $("#n_poliza6").css('color', 'white');
                                $('#n_poliza6').attr('data-original-title','Póliza Existente');   
                                $('#btnForm').removeAttr('disabled');   
                                $('#n_poliza6').val(num_poliza);   
                                $('#nom_titu6').val(asegurado);   
                                $('#asesor6').val('PENDIENTE');    
                                $('#codasesor6').val('AP-1'); 
                                $('#btnPre6').attr('hidden',true);
                                $('#id_poliza6').val('0'); 
                            }
                            if (($("#num").val())==7) {
                                $("#n_poliza7").val(datos['cod_poliza']);
                                $("#n_poliza7").css('background-color', 'green');
                                $("#n_poliza7").css('color', 'white');
                                $('#n_poliza7').attr('data-original-title','Póliza Existente');   
                                $('#btnForm').removeAttr('disabled');   
                                $('#n_poliza7').val(num_poliza);   
                                $('#nom_titu7').val(asegurado);   
                                $('#asesor7').val('PENDIENTE');    
                                $('#codasesor7').val('AP-1'); 
                                $('#btnPre7').attr('hidden',true);
                                $('#id_poliza7').val('0'); 
                            }
                            if (($("#num").val())==8) {
                                $("#n_poliza8").val(datos['cod_poliza']);
                                $("#n_poliza8").css('background-color', 'green');
                                $("#n_poliza8").css('color', 'white');
                                $('#n_poliza8').attr('data-original-title','Póliza Existente');   
                                $('#btnForm').removeAttr('disabled');   
                                $('#n_poliza8').val(num_poliza);   
                                $('#nom_titu8').val(asegurado);   
                                $('#asesor8').val('PENDIENTE');    
                                $('#codasesor8').val('AP-1'); 
                                $('#btnPre8').attr('hidden',true);
                                $('#id_poliza8').val('0'); 
                            }
                            if (($("#num").val())==9) {
                                $("#n_poliza9").val(datos['cod_poliza']);
                                $("#n_poliza9").css('background-color', 'green');
                                $("#n_poliza9").css('color', 'white');
                                $('#n_poliza9').attr('data-original-title','Póliza Existente');   
                                $('#btnForm').removeAttr('disabled');   
                                $('#n_poliza9').val(num_poliza);   
                                $('#nom_titu9').val(asegurado);   
                                $('#asesor9').val('PENDIENTE');    
                                $('#codasesor9').val('AP-1'); 
                                $('#btnPre9').attr('hidden',true);
                                $('#id_poliza9').val('0'); 
                            }

                            $('#precargapoliza').modal('hide');

                        }else{
                            alertify.error("Fallo al agregar!");
                            
                        }
                    }
                });
            });
        });

        onload = function(){ 
          var elee = document.querySelectorAll('.validarpoliza0')[0];
          var elee1 = document.querySelectorAll('.validarpoliza1')[0];
          var elee2 = document.querySelectorAll('.validarpoliza2')[0];
          var elee3 = document.querySelectorAll('.validarpoliza3')[0];
          var elee4 = document.querySelectorAll('.validarpoliza4')[0];
          var elee5 = document.querySelectorAll('.validarpoliza5')[0];
          var elee6 = document.querySelectorAll('.validarpoliza6')[0];
          var elee7 = document.querySelectorAll('.validarpoliza7')[0];
          var elee8 = document.querySelectorAll('.validarpoliza8')[0];
          var elee9 = document.querySelectorAll('.validarpoliza9')[0];


      
          elee.onkeypress = function(e) {
             if(isNaN(this.value+String.fromCharCode(e.charCode)))
                return false;
          }
          
          elee1.onkeypress = function(e1) {
             if(isNaN(this.value+String.fromCharCode(e1.charCode)))
                return false;
          }
          
          elee2.onkeypress = function(e2) {
             if(isNaN(this.value+String.fromCharCode(e2.charCode)))
                return false;
          }
          
          elee3.onkeypress = function(e3) {
             if(isNaN(this.value+String.fromCharCode(e3.charCode)))
                return false;
          }
          
          elee4.onkeypress = function(e4) {
             if(isNaN(this.value+String.fromCharCode(e4.charCode)))
                return false;
          }
          
          elee5.onkeypress = function(e5) {
             if(isNaN(this.value+String.fromCharCode(e5.charCode)))
                return false;
          }
          
          elee6.onkeypress = function(e6) {
             if(isNaN(this.value+String.fromCharCode(e6.charCode)))
                return false;
          }
          
          elee7.onkeypress = function(e7) {
             if(isNaN(this.value+String.fromCharCode(e7.charCode)))
                return false;
          }
          
          elee8.onkeypress = function(e8) {
             if(isNaN(this.value+String.fromCharCode(e8.charCode)))
                return false;
          }
          
          elee9.onkeypress = function(e9) {
             if(isNaN(this.value+String.fromCharCode(e9.charCode)))
                return false;
          }
          
          
        }

        
        $('#f_pago0').datepicker({
            format: "dd-mm-yyyy",
        });
        $("#f_pago0").datepicker("setDate", $("#f_hasta").val());
        $('#f_pago1').datepicker({  
            format: "dd-mm-yyyy",
        });
        $("#f_pago1").datepicker("setDate", $("#f_hasta").val());
        $('#f_pago2').datepicker({  
            format: "dd-mm-yyyy",
        });
        $("#f_pago2").datepicker("setDate", $("#f_hasta").val());
        $('#f_pago3').datepicker({  
            format: "dd-mm-yyyy",
        });
        $("#f_pago3").datepicker("setDate", $("#f_hasta").val());
        $('#f_pago4').datepicker({  
            format: "dd-mm-yyyy",
        });
        $("#f_pago4").datepicker("setDate", $("#f_hasta").val());
        $('#f_pago5').datepicker({  
            format: "dd-mm-yyyy",
        });
        $("#f_pago5").datepicker("setDate", $("#f_hasta").val());
        $('#f_pago6').datepicker({  
            format: "dd-mm-yyyy",
        });
        $("#f_pago6").datepicker("setDate", $("#f_hasta").val());
        $('#f_pago7').datepicker({  
            format: "dd-mm-yyyy",
        });
        $("#f_pago7").datepicker("setDate", $("#f_hasta").val());
        $('#f_pago8').datepicker({  
            format: "dd-mm-yyyy",
        });
        $("#f_pago8").datepicker("setDate", $("#f_hasta").val());
        $('#f_pago9').datepicker({  
            format: "dd-mm-yyyy",
        });
        $("#f_pago9").datepicker("setDate", $("#f_hasta").val());

        



        function validarPoliza0(num_poliza){
            $.ajax({
                type:"POST",
                data:"num_poliza=" + num_poliza.value,        
                url:"validarpoliza.php",
                success:function(r){
                    datos=jQuery.parseJSON(r);

                    if (datos['id_cod_ramo']==null) {
                        $("#n_poliza0").css('background-color', 'red');
                        $("#n_poliza0").css('color', 'white');
             
                        $('#n_poliza0').attr('data-original-title','No Existe la Póliza para la Compañía Seleccionada, Debe Crearla y luego volver a introducir su Nº');
                        $('#btnForm').attr('disabled',true);

                        $('#btnPre0').removeAttr('hidden');

                        $('#nom_titu0').val('');
                        $('#asesor0').val('');
                    }
                    else{
                        $("#n_poliza0").css('background-color', 'green');
                        $("#n_poliza0").css('color', 'white');

                        $('#n_poliza0').attr('data-original-title','Póliza Existente');   
                        $('#btnForm').removeAttr('disabled');   
                        
                        $('#btnPre0').attr('hidden',true);
                              
                        $('#nom_titu0').val(datos['nombre_t']+" "+datos['apellido_t']);   
                        $('#asesor0').val(datos['idnom']);    

                        $('#codasesor0').val(datos['codvend']);  

                        $('#id_poliza0').val(datos['id_poliza']);            
                    }
                }
            });
        }

        function validarPoliza1(num_poliza){
            $.ajax({
                type:"POST",
                data:"num_poliza=" + num_poliza.value,
                url:"validarpoliza.php",
                success:function(r){
                    datos=jQuery.parseJSON(r);

                    if (datos['id_cod_ramo']==null) {
                        $("#n_poliza1").css('background-color', 'red');
                        $("#n_poliza1").css('color', 'white');
             
                        $('#n_poliza1').attr('data-original-title','No Existe la Póliza para la Compañía Seleccionada, Debe Crearla y luego volver a introducir su Nº');
                        $('#btnForm').attr('disabled',true);

                        $('#btnPre1').removeAttr('hidden');

                        $('#nom_titu1').val('');
                        $('#asesor1').val('');
                    }
                    else{
                        $("#n_poliza1").css('background-color', 'green');
                        $("#n_poliza1").css('color', 'white');

                        $('#n_poliza1').attr('data-original-title','Póliza Existente');   
                        $('#btnForm').removeAttr('disabled');    

                        $('#btnPre1').attr('hidden',true);

                        $('#nom_titu1').val(datos['nombre_t']+" "+datos['apellido_t']);   
                        $('#asesor1').val(datos['idnom']);     

                        $('#codasesor1').val(datos['codvend']);       

                        $('#id_poliza1').val(datos['id_poliza']);     
                    }
                }
            });
        }

        function validarPoliza2(num_poliza){
            $.ajax({
                type:"POST",
                data:"num_poliza=" + num_poliza.value,
                url:"validarpoliza.php",
                success:function(r){
                    datos=jQuery.parseJSON(r);

                    if (datos['id_cod_ramo']==null) {
                        $("#n_poliza2").css('background-color', 'red');
                        $("#n_poliza2").css('color', 'white');
             
                        $('#n_poliza2').attr('data-original-title','No Existe la Póliza para la Compañía Seleccionada, Debe Crearla y luego volver a introducir su Nº');
                        $('#btnForm').attr('disabled',true);

                        $('#btnPre2').removeAttr('hidden');

                        $('#nom_titu2').val('');
                        $('#asesor2').val('');
                    }
                    else{
                        $("#n_poliza2").css('background-color', 'green');
                        $("#n_poliza2").css('color', 'white');

                        $('#n_poliza2').attr('data-original-title','Póliza Existente');   
                        $('#btnForm').removeAttr('disabled'); 

                        $('#btnPre2').attr('hidden',true);

                        $('#nom_titu2').val(datos['nombre_t']+" "+datos['apellido_t']);   
                        $('#asesor2').val(datos['idnom']);   

                        $('#codasesor2').val(datos['codvend']);   

                        $('#id_poliza2').val(datos['id_poliza']);              
                    }
                }
            });
        }

        function validarPoliza3(num_poliza){
            $.ajax({
                type:"POST",
                data:"num_poliza=" + num_poliza.value,
                url:"validarpoliza.php",
                success:function(r){
                    datos=jQuery.parseJSON(r);

                    if (datos['id_cod_ramo']==null) {
                        $("#n_poliza3").css('background-color', 'red');
                        $("#n_poliza3").css('color', 'white');
             
                        $('#n_poliza3').attr('data-original-title','No Existe la Póliza para la Compañía Seleccionada, Debe Crearla y luego volver a introducir su Nº');
                        $('#btnForm').attr('disabled',true);

                        $('#btnPre3').removeAttr('hidden');

                        $('#nom_titu3').val('');
                        $('#asesor3').val('');
                    }
                    else{
                        $("#n_poliza3").css('background-color', 'green');
                        $("#n_poliza3").css('color', 'white');

                        $('#n_poliza3').attr('data-original-title','Póliza Existente');   
                        $('#btnForm').removeAttr('disabled');   

                        $('#btnPre3').attr('hidden',true);

                        $('#nom_titu3').val(datos['nombre_t']+" "+datos['apellido_t']);   
                        $('#asesor3').val(datos['idnom']);      

                        $('#codasesor3').val(datos['codvend']);    

                        $('#id_poliza3').val(datos['id_poliza']);        
                    }
                }
            });
        }

        function validarPoliza4(num_poliza){
            $.ajax({
                type:"POST",
                data:"num_poliza=" + num_poliza.value,
                url:"validarpoliza.php",
                success:function(r){
                    datos=jQuery.parseJSON(r);

                    if (datos['id_cod_ramo']==null) {
                        $("#n_poliza4").css('background-color', 'red');
                        $("#n_poliza4").css('color', 'white');
             
                        $('#n_poliza4').attr('data-original-title','No Existe la Póliza para la Compañía Seleccionada, Debe Crearla y luego volver a introducir su Nº');
                        $('#btnForm').attr('disabled',true);

                        $('#btnPre4').removeAttr('hidden');

                        $('#nom_titu4').val('');
                        $('#asesor4').val('');
                    }
                    else{
                        $("#n_poliza4").css('background-color', 'green');
                        $("#n_poliza4").css('color', 'white');

                        $('#n_poliza4').attr('data-original-title','Póliza Existente');   
                        $('#btnForm').removeAttr('disabled');   

                        $('#btnPre4').attr('hidden',true);

                        $('#nom_titu4').val(datos['nombre_t']+" "+datos['apellido_t']);   
                        $('#asesor4').val(datos['idnom']);    

                        $('#codasesor4').val(datos['codvend']);    

                        $('#id_poliza4').val(datos['id_poliza']);          
                    }
                }
            });
        }

        function validarPoliza5(num_poliza){
            $.ajax({
                type:"POST",
                data:"num_poliza=" + num_poliza.value,
                url:"validarpoliza.php",
                success:function(r){
                    datos=jQuery.parseJSON(r);

                    if (datos['id_cod_ramo']==null) {
                        $("#n_poliza5").css('background-color', 'red');
                        $("#n_poliza5").css('color', 'white');
             
                        $('#n_poliza5').attr('data-original-title','No Existe la Póliza para la Compañía Seleccionada, Debe Crearla y luego volver a introducir su Nº');
                        $('#btnForm').attr('disabled',true);

                        $('#btnPre5').removeAttr('hidden');

                        $('#nom_titu5').val('');
                        $('#asesor5').val('');
                    }
                    else{
                        $("#n_poliza5").css('background-color', 'green');
                        $("#n_poliza5").css('color', 'white');

                        $('#n_poliza5').attr('data-original-title','Póliza Existente');   
                        $('#btnForm').removeAttr('disabled');   

                        $('#btnPre5').attr('hidden',true);

                        $('#nom_titu5').val(datos['nombre_t']+" "+datos['apellido_t']);   
                        $('#asesor5').val(datos['idnom']);       

                        $('#codasesor5').val(datos['codvend']);    

                        $('#id_poliza5').val(datos['id_poliza']);       
                    }
                }
            });
        }

        function validarPoliza6(num_poliza){
            $.ajax({
                type:"POST",
                data:"num_poliza=" + num_poliza.value,
                url:"validarpoliza.php",
                success:function(r){
                    datos=jQuery.parseJSON(r);

                    if (datos['id_cod_ramo']==null) {
                        $("#n_poliza6").css('background-color', 'red');
                        $("#n_poliza6").css('color', 'white');
             
                        $('#n_poliza6').attr('data-original-title','No Existe la Póliza para la Compañía Seleccionada, Debe Crearla y luego volver a introducir su Nº');
                        $('#btnForm').attr('disabled',true);

                        $('#btnPre6').removeAttr('hidden');

                        $('#nom_titu6').val('');
                        $('#asesor6').val('');
                    }
                    else{
                        $("#n_poliza6").css('background-color', 'green');
                        $("#n_poliza6").css('color', 'white');

                        $('#n_poliza6').attr('data-original-title','Póliza Existente');   
                        $('#btnForm').removeAttr('disabled');   

                        $('#btnPre6').attr('hidden',true);

                        $('#nom_titu6').val(datos['nombre_t']+" "+datos['apellido_t']);   
                        $('#asesor6').val(datos['idnom']);       

                        $('#codasesor6').val(datos['codvend']);  

                        $('#id_poliza6').val(datos['id_poliza']);         
                    }
                }
            });
        }

        function validarPoliza7(num_poliza){
            $.ajax({
                type:"POST",
                data:"num_poliza=" + num_poliza.value,
                url:"validarpoliza.php",
                success:function(r){
                    datos=jQuery.parseJSON(r);

                    if (datos['id_cod_ramo']==null) {
                        $("#n_poliza7").css('background-color', 'red');
                        $("#n_poliza7").css('color', 'white');
             
                        $('#n_poliza7').attr('data-original-title','No Existe la Póliza para la Compañía Seleccionada, Debe Crearla y luego volver a introducir su Nº');
                        $('#btnForm').attr('disabled',true);

                        $('#btnPre7').removeAttr('hidden');

                        $('#nom_titu7').val('');
                        $('#asesor7').val('');
                    }
                    else{
                        $("#n_poliza7").css('background-color', 'green');
                        $("#n_poliza7").css('color', 'white');

                        $('#n_poliza7').attr('data-original-title','Póliza Existente');   
                        $('#btnForm').removeAttr('disabled');   
                        
                        $('#btnPre7').attr('hidden',true);

                        $('#nom_titu7').val(datos['nombre_t']+" "+datos['apellido_t']);   
                        $('#asesor7').val(datos['idnom']);     

                        $('#codasesor7').val(datos['codvend']);   

                        $('#id_poliza7').val(datos['id_poliza']);        
                    }
                }
            });
        }

        function validarPoliza8(num_poliza){
            $.ajax({
                type:"POST",
                data:"num_poliza=" + num_poliza.value,
                url:"validarpoliza.php",
                success:function(r){
                    datos=jQuery.parseJSON(r);

                    if (datos['id_cod_ramo']==null) {
                        $("#n_poliza8").css('background-color', 'red');
                        $("#n_poliza8").css('color', 'white');
             
                        $('#n_poliza8').attr('data-original-title','No Existe la Póliza para la Compañía Seleccionada, Debe Crearla y luego volver a introducir su Nº');
                        $('#btnForm').attr('disabled',true);

                        $('#btnPre8').removeAttr('hidden');

                        $('#nom_titu8').val('');
                        $('#asesor8').val('');
                    }
                    else{
                        $("#n_poliza8").css('background-color', 'green');
                        $("#n_poliza8").css('color', 'white');

                        $('#n_poliza8').attr('data-original-title','Póliza Existente');   
                        $('#btnForm').removeAttr('disabled');  
                        
                        $('#btnPre8').attr('hidden',true);

                        $('#nom_titu8').val(datos['nombre_t']+" "+datos['apellido_t']);   
                        $('#asesor8').val(datos['idnom']);    

                        $('#codasesor8').val(datos['codvend']);     

                        $('#id_poliza8').val(datos['id_poliza']);       
                    }
                }
            });
        }

        function validarPoliza9(num_poliza){
            $.ajax({
                type:"POST",
                data:"num_poliza=" + num_poliza.value,
                url:"validarpoliza.php",
                success:function(r){
                    datos=jQuery.parseJSON(r);

                    if (datos['id_cod_ramo']==null) {
                        $("#n_poliza9").css('background-color', 'red');
                        $("#n_poliza9").css('color', 'white');
             
                        $('#n_poliza9').attr('data-original-title','No Existe la Póliza para la Compañía Seleccionada, Debe Crearla y luego volver a introducir su Nº');
                        $('#btnForm').attr('disabled',true);

                        $('#btnPre9').removeAttr('hidden');

                        $('#nom_titu9').val('');
                        $('#asesor9').val('');
                    }
                    else{
                        $("#n_poliza9").css('background-color', 'green');
                        $("#n_poliza9").css('color', 'white');

                        $('#n_poliza9').attr('data-original-title','Póliza Existente');   
                        $('#btnForm').removeAttr('disabled');   

                        $('#btnPre9').attr('hidden',true);

                        $('#nom_titu9').val(datos['nombre_t']+" "+datos['apellido_t']);   
                        $('#asesor9').val(datos['idnom']);    

                        $('#codasesor9').val(datos['codvend']);     

                        $('#id_poliza9').val(datos['id_poliza']);         
                    }
                }
            });
        }


        function calcularRest(comision){
            
            var prima0 = $("#prima0").val();
            var prima1 = $("#prima1").val();
            var prima2 = $("#prima2").val();
            var prima3 = $("#prima3").val();
            var prima4 = $("#prima4").val();
            var prima5 = $("#prima5").val();
            var prima6 = $("#prima6").val();
            var prima7 = $("#prima7").val();
            var prima8 = $("#prima8").val();
            var prima9 = $("#prima9").val();

            if (($("#prima0").val() == '')){
               var prima0 = 0;
            }
            if (($("#prima1").val() == '') || ($("#prima1").val() == null)){
               var prima1 = 0;
            }
            if (($("#prima2").val() == '') || ($("#prima2").val() == null)){
               var prima2 = 0;
            }
            if (($("#prima3").val() == '') || ($("#prima3").val() == null)){
               var prima3 = 0;
            }
            if (($("#prima4").val() == '') || ($("#prima4").val() == null)){
               var prima4 = 0;
            }
            if (($("#prima5").val() == '') || ($("#prima5").val() == null)){
               var prima5 = 0;
            }
            if (($("#prima6").val() == '') || ($("#prima6").val() == null)){
               var prima6 = 0;
            }
            if (($("#prima7").val() == '') || ($("#prima7").val() == null)){
               var prima7 = 0;
            }
            if (($("#prima8").val() == '') || ($("#prima8").val() == null)){
               var prima8 = 0;
            }
            if (($("#prima9").val() == '') || ($("#prima9").val() == null)){
               var prima9 = 0;
            }

console.log(prima9);

            var primaRestante = '<?php echo $primaRestante;?>';

            var Rest=primaRestante-prima0-prima1-prima2-prima3-prima4-prima5-prima6-prima7-prima8-prima9;

            $("#Rest").text('Falta cargar $'+Rest);
        }

        function calcularP0(comision){
            var comision = $("#comision0").val();
            var prima = $("#prima0").val();
            var porcent = $("#comisionPor0").val();

            $("#comision0").val(((prima*porcent)/100));
        }
        function calcularP1(comision){
            var comision = $("#comision1").val();
            var prima = $("#prima1").val();
            var porcent = $("#comisionPor1").val();

            $("#comision1").val(((prima*porcent)/100));
        }
        function calcularP2(comision){
            var comision = $("#comision2").val();
            var prima = $("#prima2").val();
            var porcent = $("#comisionPor2").val();

            $("#comision2").val(((prima*porcent)/100));
        }
        function calcularP3(comision){
            var comision = $("#comision3").val();
            var prima = $("#prima3").val();
            var porcent = $("#comisionPor3").val();

            $("#comision3").val(((prima*porcent)/100));
        }
        function calcularP4(comision){
            var comision = $("#comision4").val();
            var prima = $("#prima4").val();
            var porcent = $("#comisionPor4").val();

            $("#comision4").val(((prima*porcent)/100));
        }
        function calcularP5(comision){
            var comision = $("#comision5").val();
            var prima = $("#prima5").val();
            var porcent = $("#comisionPor5").val();

            $("#comision5").val(((prima*porcent)/100));
        }
        function calcularP6(comision){
            var comision = $("#comision6").val();
            var prima = $("#prima6").val();
            var porcent = $("#comisionPor6").val();

            $("#comision6").val(((prima*porcent)/100));
        }
        function calcularP7(comision){
            var comision = $("#comision7").val();
            var prima = $("#prima7").val();
            var porcent = $("#comisionPor7").val();

            $("#comision7").val(((prima*porcent)/100));
        }
        function calcularP8(comision){
            var comision = $("#comision8").val();
            var prima = $("#prima8").val();
            var porcent = $("#comisionPor8").val();

            $("#comision8").val(((prima*porcent)/100));
        }
        function calcularP9(comision){
            var comision = $("#comision9").val();
            var prima = $("#prima9").val();
            var porcent = $("#comisionPor9").val();

            $("#comision9").val(((prima*porcent)/100));
        }


//-------------------------------------------------------------------------
        function botonPreCarga0(){
            if ($("#n_poliza0").val() != '') {
                $("#num_poliza").val($("#n_poliza0").val());
                $("#num").val(0);
                $("#asegurado").val('');
            }
        }
        function botonPreCarga1(){
            if ($("#n_poliza1").val() != '') {
                $("#num_poliza").val($("#n_poliza1").val());
                $("#num").val(1);
                $("#asegurado").val('');
            }
        }
        function botonPreCarga2(){
            if ($("#n_poliza2").val() != '') {
                $("#num_poliza").val($("#n_poliza2").val());
                $("#num").val(2);
                $("#asegurado").val('');
            }
        }
        function botonPreCarga3(){
            if ($("#n_poliza3").val() != '') {
                $("#num_poliza").val($("#n_poliza3").val());
                $("#num").val(3);
            }
        }
        function botonPreCarga4(){
            if ($("#n_poliza4").val() != '') {
                $("#num_poliza").val($("#n_poliza4").val());
                $("#num").val(4);
                $("#asegurado").val('');
            }
        }
        function botonPreCarga5(){
            if ($("#n_poliza5").val() != '') {
                $("#num_poliza").val($("#n_poliza5").val());
                $("#num").val(5);
                $("#asegurado").val('');
            }
        }
        function botonPreCarga6(){
            if ($("#n_poliza6").val() != '') {
                $("#num_poliza").val($("#n_poliza6").val());
                $("#num").val(6);
                $("#asegurado").val('');
            }
        }
        function botonPreCarga7(){
            if ($("#n_poliza7").val() != '') {
                $("#num_poliza").val($("#n_poliza7").val());
                $("#num").val(7);
                $("#asegurado").val('');
            }
        }
        function botonPreCarga8(){
            if ($("#n_poliza8").val() != '') {
                $("#num_poliza").val($("#n_poliza8").val());
                $("#num").val(8);
                $("#asegurado").val('');
            }
        }
        function botonPreCarga9(){
            if ($("#n_poliza9").val() != '') {
                $("#num_poliza").val($("#n_poliza9").val());
                $("#num").val(9);
                $("#asegurado").val('');
            }
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