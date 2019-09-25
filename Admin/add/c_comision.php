<?php 
//Desactivar errores
error_reporting(E_ALL ^ E_NOTICE);

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
    <?php require('header.php');?>

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
            <div class="container" >
            <a href="javascript:history.back(-1);" data-tooltip="tooltip" data-placement="right" title="Ir la página anterior" class="btn btn-info btn-round"><- Regresar</a>
                <center>
                <div class="col-md-auto col-md-offset-2">
                    <h1 class="title"><i class="fa fa-info-circle" aria-hidden="true"></i>&nbsp;Compañía: <?php echo ($cia[0]['nomcia']);?>
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
                                    <th hidden>num</th>
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

                                    <td><input style="text-align: center" onblur="<?php echo 'calcularP'.$i.'(this)';?>, <?php echo 'calcularRest1(this)';?>" type="number" step="0.01" class="form-control" id="<?php echo 'comisionPor'.$i;?>" name="<?php echo 'comisionPor'.$i;?>" required data-toggle="tooltip" data-placement="bottom" title="Campo Obligatorio [Sólo introducir números y punto (.) como separador decimal]" autocomplete="off"></td> 

                                    <td><input  type="text"  class="form-control" id="<?php echo 'comision'.$i;?>" name="<?php echo 'comision'.$i;?>"  readonly></td>   

                                    
                                    <td><input type="text" class="form-control" readonly="true" id="<?php echo 'asesor'.$i;?>" name="<?php echo 'asesor'.$i;?>" ></td>

                                    <td hidden><input type="text" class="form-control" id="<?php echo 'codasesor'.$i;?>" name="<?php echo 'codasesor'.$i;?>" ></td>

                                    <td hidden><input type="text" class="form-control" id="<?php echo 'id_poliza'.$i;?>" name="<?php echo 'id_poliza'.$i;?>" ></td>

                                    <td hidden><input type="text" class="form-control" id="<?php echo 'num'.$i;?>" name="<?php echo 'num'.$i;?>" ></td>

                                    
                                </tr>
                                <tr><td colspan="7" style="padding:0px;background-color: white;text-align: center"><a style="width: 40%" href="" class="btn btn-round btn btn-primary" data-toggle="modal" data-target="#precargapoliza" id="<?php echo 'btnPre'.$i;?>" name="<?php echo 'btnPre'.$i;?>" onclick="<?php echo 'botonPreCarga'.$i.'()';?>" hidden>Precargar Póliza</a></td></tr>
                                
                            </tbody>
                            <?php
                            }
                            ?>
                        </table>
                        
                        
                        
                        
                    </div>
                    <input style="width:40%" type="button" onclick="deleterow()" class="btn btn-danger borrar" value="Eliminar Última Fila" id="borrar"/>

                        <?php
                        $primaRestante=$_GET['primat_com']-$totalprimaant;
                            if ($totalprimaant>$_GET['primat_com']) {
                        ?>  
                            <h2 style="color:red">[Error!] Las comisiones cargadas son superiores al total del reporte</h2>
                        <?php      
                            } elseif($totalprimaant<$_GET['primat_com']) {
                        ?>
                            <h2 style="color:red;font-weight:bold" id="Rest">Falta cargar <?php echo "$ ".number_format($primaRestante,2);?> de prima sujeta a comisión</h2>
                        <?php 
                            }elseif($totalprimaant==$_GET['primat_com']) {
                                $primaRestante=0;
                        ?>
                        <h2 style="color:green;font-weight:bold" id="Rest">Pendiente a Cargar $0</h2>
                        <?php 
                            }
                        ?>

                        <?php
                            $comRestante=$_GET['comt']-$totalcomant;
                            if ($totalprimaant>$_GET['comt']) {
                        ?>  
                            <h2 style="color:red">[Error!] Las comisiones cargadas son superiores al total del reporte</h2>
                        <?php      
                            } elseif($totalcomant<$_GET['comt']) {
                        ?>
                            <h2 style="color:red;font-weight:bold" id="Rest1">Falta cargar <?php echo "$ ".number_format($comRestante,2);?> de comisiones</h2>
                        <?php 
                            }elseif($totalcomant==$_GET['comt']) {
                                $comRestante=0;
                        ?>
                        <h2 style="color:green;font-weight:bold" id="Rest1">Pendiente a Cargar $0</h2>
                        <?php 
                            }
                        ?>
                    

                    <button type="submit" id="btnForm" class="btn btn-info btn-lg btn-round">Previsualizar</button>
                </form>
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
                            <thead style="background-color: #2737B0;color: white; font-weight: bold;">
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
                    <button type="button" id="btnAgregarnuevo" class="btn btn-primary">Agregar nuevo</button>
                </div>
            </div>
        </div>
    </div>



    <!-- Modal Pre-CArga Poliza Existente-->
    <div class="modal fade" id="precargapolizaE" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Agrega nueva Pre-Póliza</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="frmnuevoPE">
                        <div class="table-responsive">
                        <table class="table table-hover table-striped table-bordered" id="iddatatable1">
                            <thead style="background-color: #2737B0;color: white; font-weight: bold;">
                                <tr>
                                <th>Nº de Póliza</th>
                                <th>Asegurado</th>
                                <th>F Desde Seg</th>
                                <th>F Hasta Seg</th>
                                <th hidden>Cía</th>
                                <th hidden>id poliza</th>
                                </tr>
                            </thead>
                                <tr style="background-color:white">
                                    <td><input type="text" class="form-control" id="num_polizaE" name="num_polizaE"></td>
                                    <td><input type="text" class="form-control" id="aseguradoE" name="aseguradoE" readonly></td>
                                    <td><div class="input-group date">
                                            <input type="text" class="form-control" id="f_desde_se" name="f_desde_se" required readonly> 
                                        </div>
                                    </td>
                                    <td><div class="input-group date">
                                            <input type="text" class="form-control" id="f_hasta_se" name="f_hasta_se" required readonly> 
                                        </div>
                                    </td>
                                    <td hidden><input type="text" class="form-control" id="idciaE" name="idciaE" readonly value="<?php echo $idcia;?>"></td>
                                    <td hidden><input type="text" class="form-control" id="idpolizaE" name="idpolizaE"></td>
                                </tr>
                        </table>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" id="btnAgregarnuevoE" class="btn btn-primary">Pre-Cargar Póliza</button>
                </div>
            </div>
        </div>
    </div>




    



    <script>
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

                            if (($("#num0").val())==0) {
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
                            if (($("#num1").val())==1) {
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
                            if (($("#num2").val())==2) {
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
                            if (($("#num3").val())==3) {
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
                            if (($("#num4").val())==4) {
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
                            if (($("#num5").val())==5) {
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
                            if (($("#num6").val())==6) {
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
                            if (($("#num7").val())==7) {
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
                            if (($("#num8").val())==8) {
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
                            if (($("#num9").val())==9) {
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

            $('#btnAgregarnuevoE').click(function(){
                

                
                datos=$('#frmnuevoPE').serialize();
                var num_poliza = $('#num_polizaE').val();

                $.ajax({
                    type:"POST",
                    data:datos,
                    url:"../../procesos/agregarPrePolizaE.php",
                    success:function(r){
                        if(r==1){
                            $('#frmnuevoP')[0].reset();
                            
                            alertify.set('notifier','position', 'top-center');
                            var msg = alertify.success('Agregada con Exito!! Vuelva a hacer click en Nº de Póliza y luego seleccione la Póliza', 'custom', 2, function(){console.log('dismissed');});
                            msg.delay(8);

                            $('#precargapolizaE').modal('hide');

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


        

        
        function btnPrePolizaE(id_poliza, cod_poliza) {
            $('#idpolizaE').val(id_poliza);   
            $('#num_polizaE').val(cod_poliza);    
            
            $('#polizaexistente').modal('hide'); 
            $('#precargapolizaE').modal({backdrop: 'static', keyboard: false});
            $('#precargapolizaE').modal('show'); 

            $.ajax({
                type:"POST",
                data:"id_poliza=" + id_poliza,        
                url:"validarpoliza_id.php",
                success:function(r){
                    datos=jQuery.parseJSON(r);
                    console.log(datos);
                    if (datos[0]['id_poliza']==null) {
                        console.log('vacio');
                        alert('seleccione una póliza');
                    }
                    else{
                        console.log(datos[0]['nombre_t']);
                        $('#aseguradoE').val(datos[0]['nombre_t'] + ' ' + datos[0]['apellido_t']);  

                        var f = new Date(datos[0]['f_desdepoliza']);
                        var f_desde = (f.getDate()+1) + "-" + (f.getMonth()+1) + "-" + (f.getFullYear()+1);
                        var f = new Date(datos[0]['f_hastapoliza']);
                        var f_hasta = (f.getDate()+1) + "-" + (f.getMonth()+1) + "-" + (f.getFullYear()+1);

                        $('#f_desde_se').val(f_desde); 

                        $('#f_hasta_se').val(f_hasta);  
                        
                    }
                }   
            });
        }

        function btnPoliza0(id_poliza) {
            $.ajax({
                type:"POST",
                data:"id_poliza=" + id_poliza,        
                url:"validarpoliza_id.php",
                success:function(r){
                    datos=jQuery.parseJSON(r);
                    console.log(datos);
                    if (datos[0]['id_poliza']==null) {
                        console.log('vacio');
                        alert('seleccione una póliza');
                    }
                    else{
                        console.log(datos[0]['idnom']);
                        $("#n_poliza0").css('background-color', 'green');
                        $("#n_poliza0").css('color', 'white');

                        $('#n_poliza0').attr('data-original-title','Póliza Existente');   
                        $('#btnForm').removeAttr('disabled');   
                        
                        $('#btnPre0').attr('hidden',true);
                              
                        $('#nom_titu0').val(datos[0]['nombre_t']+" "+datos[0]['apellido_t']);   
                        $('#asesor0').val(datos[0]['idnom']);    

                        $('#codasesor0').val(datos[0]['codvend']);  

                        $('#id_poliza0').val(datos[0]['id_poliza']);

                        $('#n_poliza0').val(datos[0]['cod_poliza']);      
                        
                        $('#polizaexistente').modal('hide'); 
                    }
                }   
            });
        }

        function btnPoliza1(id_poliza) {
            $.ajax({
                type:"POST",
                data:"id_poliza=" + id_poliza,        
                url:"validarpoliza_id.php",
                success:function(r){
                    datos=jQuery.parseJSON(r);
                    if (datos[0]['id_poliza']==null) {
                        console.log('vacio');
                        alert('seleccione una póliza');
                    }
                    else{
                        $("#n_poliza1").css('background-color', 'green');
                        $("#n_poliza1").css('color', 'white');

                        $('#n_poliza1').attr('data-original-title','Póliza Existente');   
                        $('#btnForm').removeAttr('disabled');   
                        
                        $('#btnPre1').attr('hidden',true);
                              
                        $('#nom_titu1').val(datos[0]['nombre_t']+" "+datos[0]['apellido_t']);   
                        $('#asesor1').val(datos[0]['idnom']);    

                        $('#codasesor1').val(datos[0]['codvend']);  

                        $('#id_poliza1').val(datos[0]['id_poliza']);

                        $('#n_poliza1').val(datos[0]['cod_poliza']);      
                        
                        $('#polizaexistente').modal('hide'); 
                    }
                }   
            });
        }

        function btnPoliza2(id_poliza) {
            $.ajax({
                type:"POST",
                data:"id_poliza=" + id_poliza,        
                url:"validarpoliza_id.php",
                success:function(r){
                    datos=jQuery.parseJSON(r);
                    if (datos[0]['id_poliza']==null) {
                        console.log('vacio');
                        alert('seleccione una póliza');
                    }
                    else{
                        $("#n_poliza2").css('background-color', 'green');
                        $("#n_poliza2").css('color', 'white');

                        $('#n_poliza2').attr('data-original-title','Póliza Existente');   
                        $('#btnForm').removeAttr('disabled');   
                        
                        $('#btnPre2').attr('hidden',true);
                              
                        $('#nom_titu2').val(datos[0]['nombre_t']+" "+datos[0]['apellido_t']);   
                        $('#asesor2').val(datos[0]['idnom']);    

                        $('#codasesor2').val(datos[0]['codvend']);  

                        $('#id_poliza2').val(datos[0]['id_poliza']);

                        $('#n_poliza2').val(datos[0]['cod_poliza']);      
                        
                        $('#polizaexistente').modal('hide'); 
                    }
                }   
            });
        }


        function btnPoliza3(id_poliza) {
            $.ajax({
                type:"POST",
                data:"id_poliza=" + id_poliza,        
                url:"validarpoliza_id.php",
                success:function(r){
                    datos=jQuery.parseJSON(r);
                    if (datos[0]['id_poliza']==null) {
                        console.log('vacio');
                        alert('seleccione una póliza');
                    }
                    else{
                        $("#n_poliza3").css('background-color', 'green');
                        $("#n_poliza3").css('color', 'white');

                        $('#n_poliza3').attr('data-original-title','Póliza Existente');   
                        $('#btnForm').removeAttr('disabled');   
                        
                        $('#btnPre3').attr('hidden',true);
                              
                        $('#nom_titu3').val(datos[0]['nombre_t']+" "+datos[0]['apellido_t']);   
                        $('#asesor3').val(datos[0]['idnom']);    

                        $('#codasesor3').val(datos[0]['codvend']);  

                        $('#id_poliza3').val(datos[0]['id_poliza']);

                        $('#n_poliza3').val(datos[0]['cod_poliza']);      
                        
                        $('#polizaexistente').modal('hide'); 
                    }
                }   
            });
        }

        function btnPoliza4(id_poliza) {
            $.ajax({
                type:"POST",
                data:"id_poliza=" + id_poliza,        
                url:"validarpoliza_id.php",
                success:function(r){
                    datos=jQuery.parseJSON(r);
                    if (datos[0]['id_poliza']==null) {
                        console.log('vacio');
                        alert('seleccione una póliza');
                    }
                    else{
                        $("#n_poliza4").css('background-color', 'green');
                        $("#n_poliza4").css('color', 'white');

                        $('#n_poliza4').attr('data-original-title','Póliza Existente');   
                        $('#btnForm').removeAttr('disabled');   
                        
                        $('#btnPre4').attr('hidden',true);
                              
                        $('#nom_titu4').val(datos[0]['nombre_t']+" "+datos[0]['apellido_t']);   
                        $('#asesor4').val(datos[0]['idnom']);    

                        $('#codasesor4').val(datos[0]['codvend']);  

                        $('#id_poliza4').val(datos[0]['id_poliza']);

                        $('#n_poliza4').val(datos[0]['cod_poliza']);      
                        
                        $('#polizaexistente').modal('hide'); 
                    }
                }   
            });
        }

        function btnPoliza5(id_poliza) {
            $.ajax({
                type:"POST",
                data:"id_poliza=" + id_poliza,        
                url:"validarpoliza_id.php",
                success:function(r){
                    datos=jQuery.parseJSON(r);
                    if (datos[0]['id_poliza']==null) {
                        console.log('vacio');
                        alert('seleccione una póliza');
                    }
                    else{
                        $("#n_poliza5").css('background-color', 'green');
                        $("#n_poliza5").css('color', 'white');

                        $('#n_poliza5').attr('data-original-title','Póliza Existente');   
                        $('#btnForm').removeAttr('disabled');   
                        
                        $('#btnPre5').attr('hidden',true);
                              
                        $('#nom_titu5').val(datos[0]['nombre_t']+" "+datos[0]['apellido_t']);   
                        $('#asesor5').val(datos[0]['idnom']);    

                        $('#codasesor5').val(datos[0]['codvend']);  

                        $('#id_poliza5').val(datos[0]['id_poliza']);

                        $('#n_poliza5').val(datos[0]['cod_poliza']);      
                        
                        $('#polizaexistente').modal('hide'); 
                    }
                }   
            });
        }

        function btnPoliza6(id_poliza) {
            $.ajax({
                type:"POST",
                data:"id_poliza=" + id_poliza,        
                url:"validarpoliza_id.php",
                success:function(r){
                    datos=jQuery.parseJSON(r);
                    if (datos[0]['id_poliza']==null) {
                        console.log('vacio');
                        alert('seleccione una póliza');
                    }
                    else{
                        $("#n_poliza6").css('background-color', 'green');
                        $("#n_poliza6").css('color', 'white');

                        $('#n_poliza6').attr('data-original-title','Póliza Existente');   
                        $('#btnForm').removeAttr('disabled');   
                        
                        $('#btnPre6').attr('hidden',true);
                              
                        $('#nom_titu6').val(datos[0]['nombre_t']+" "+datos[0]['apellido_t']);   
                        $('#asesor6').val(datos[0]['idnom']);    

                        $('#codasesor6').val(datos[0]['codvend']);  

                        $('#id_poliza6').val(datos[0]['id_poliza']);

                        $('#n_poliza6').val(datos[0]['cod_poliza']);      
                        
                        $('#polizaexistente').modal('hide'); 
                    }
                }   
            });
        }

        function btnPoliza7(id_poliza) {
            $.ajax({
                type:"POST",
                data:"id_poliza=" + id_poliza,        
                url:"validarpoliza_id.php",
                success:function(r){
                    datos=jQuery.parseJSON(r);
                    if (datos[0]['id_poliza']==null) {
                        console.log('vacio');
                        alert('seleccione una póliza');
                    }
                    else{
                        $("#n_poliza7").css('background-color', 'green');
                        $("#n_poliza7").css('color', 'white');

                        $('#n_poliza7').attr('data-original-title','Póliza Existente');   
                        $('#btnForm').removeAttr('disabled');   
                        
                        $('#btnPre7').attr('hidden',true);
                              
                        $('#nom_titu7').val(datos[0]['nombre_t']+" "+datos[0]['apellido_t']);   
                        $('#asesor7').val(datos[0]['idnom']);    

                        $('#codasesor7').val(datos[0]['codvend']);  

                        $('#id_poliza7').val(datos[0]['id_poliza']);

                        $('#n_poliza7').val(datos[0]['cod_poliza']);      
                        
                        $('#polizaexistente').modal('hide'); 
                    }
                }   
            });
        }

        function btnPoliza8(id_poliza) {
            $.ajax({
                type:"POST",
                data:"id_poliza=" + id_poliza,        
                url:"validarpoliza_id.php",
                success:function(r){
                    datos=jQuery.parseJSON(r);
                    if (datos[0]['id_poliza']==null) {
                        console.log('vacio');
                        alert('seleccione una póliza');
                    }
                    else{
                        $("#n_poliza8").css('background-color', 'green');
                        $("#n_poliza8").css('color', 'white');

                        $('#n_poliza8').attr('data-original-title','Póliza Existente');   
                        $('#btnForm').removeAttr('disabled');   
                        
                        $('#btnPre8').attr('hidden',true);
                              
                        $('#nom_titu8').val(datos[0]['nombre_t']+" "+datos[0]['apellido_t']);   
                        $('#asesor8').val(datos[0]['idnom']);    

                        $('#codasesor8').val(datos[0]['codvend']);  

                        $('#id_poliza8').val(datos[0]['id_poliza']);

                        $('#n_poliza8').val(datos[0]['cod_poliza']);      
                        
                        $('#polizaexistente').modal('hide'); 
                    }
                }   
            });
        }

        function btnPoliza9(id_poliza) {
            $.ajax({
                type:"POST",
                data:"id_poliza=" + id_poliza,        
                url:"validarpoliza_id.php",
                success:function(r){
                    datos=jQuery.parseJSON(r);
                    if (datos[0]['id_poliza']==null) {
                        console.log('vacio');
                        alert('seleccione una póliza');
                    }
                    else{
                        $("#n_poliza9").css('background-color', 'green');
                        $("#n_poliza9").css('color', 'white');

                        $('#n_poliza9').attr('data-original-title','Póliza Existente');   
                        $('#btnForm').removeAttr('disabled');   
                        
                        $('#btnPre9').attr('hidden',true);
                              
                        $('#nom_titu9').val(datos[0]['nombre_t']+" "+datos[0]['apellido_t']);   
                        $('#asesor9').val(datos[0]['idnom']);    

                        $('#codasesor9').val(datos[0]['codvend']);  

                        $('#id_poliza9').val(datos[0]['id_poliza']);

                        $('#n_poliza9').val(datos[0]['cod_poliza']);      
                        
                        $('#polizaexistente').modal('hide'); 
                    }
                }   
            });
        }



        function validarPoliza0(num_poliza){


            if($("#n_poliza0").val().length < 1) {  
                alertify.error("Debe escribir en la casilla para realizar la búsqueda");
                return false;  
            } 



  




            $.ajax({
                type:"POST",
                data:"num_poliza=" + num_poliza.value,        
                url:"validarpoliza_e.php",
                success:function(r){
                    datos=jQuery.parseJSON(r);
                    //console.log(datos);


                    if (datos == null) {
                            $("#n_poliza0").css('background-color', 'red');
                            $("#n_poliza0").css('color', 'white');
                 
                            $('#n_poliza0').attr('data-original-title','No Existe la Póliza para la Compañía Seleccionada, Debe Crearla y luego volver a introducir su Nº');
                            $('#btnForm').attr('disabled',true);

                            $('#btnPre0').removeAttr('hidden');

                            $('#nom_titu0').val('');
                            $('#asesor0').val('');
                    }
                    else{

                        if (datos[0]['id_poliza']==null) {
                            $("#n_poliza0").css('background-color', 'red');
                            $("#n_poliza0").css('color', 'white');
                 
                            $('#n_poliza0').attr('data-original-title','No Existe la Póliza para la Compañía Seleccionada, Debe Crearla y luego volver a introducir su Nº');
                            $('#btnForm').attr('disabled',true);

                            $('#btnPre0').removeAttr('hidden');

                            $('#nom_titu0').val('');
                            $('#asesor0').val('');
                        }
                        else{

                            $("#tablaPE  tbody").empty();

                            for (let index = 0; index < datos.length; index++) {

                                $.ajax({
                                    //console.log(datos[0].id_poliza);
                                    type:"POST",
                                    data:"id_poliza=" + datos[index].id_poliza,        
                                    url:"validar_comisiones_poliza.php",
                                    success:function(r){
                                        datos1=jQuery.parseJSON(r);
                                        console.log(datos[index].id_poliza);
                                        console.log(datos1);

                                        
                                        console.log(datos1[0]['SUM(prima_com)']);
                                        console.log(datos1[0]['SUM(comision)']);


                                        var d = new Date();
                                        var strDate = d.getFullYear() + "-" + (d.getMonth()+1) + "-" + d.getDate();
                                        
                                        var f = new Date(datos[index]['f_hastapoliza']);
                                        var f_hasta = (f.getDate()+1) + "-" + (f.getMonth()+1) + "-" + f.getFullYear();

                                        var f = new Date(datos[index]['f_desdepoliza']);
                                        var f_desde = (f.getDate()+1) + "-" + (f.getMonth()+1) + "-" + f.getFullYear();


                                        if( (new Date(strDate).getTime() <= new Date(datos[index]['f_hastapoliza']).getTime()))
                                        {
                                            //console.log('vigente');
                                            var nombre_t=datos[index]['nombre_t'];

                                            var htmlTags = '<tr ondblclick="btnPoliza0(' + datos[index]['id_poliza'] +')" style="cursor:pointer">'+
                                                '<td style="color:green">' + datos[index]['cod_poliza'] + '</td>'+
                                                '<td nowrap>' + f_desde + '</td>'+
                                                '<td nowrap>' + f_hasta + '</td>'+
                                                '<td>' + datos[index]['nombre_t']+" "+datos[index]['apellido_t'] + '</td>'+
                                                '<td nowrap>' + datos[index]['nomcia'] + '</td>'+
                                                '<td nowrap>' + datos[index]['prima'] + '</td>'+
                                                '<td nowrap>' + datos1[0]['SUM(prima_com)'] + '</td>'+
                                                '<td nowrap>' + (datos[index]['prima']-datos1[0]['SUM(prima_com)']).toFixed(2) + '</td>'+
                                                '<td nowrap style="color:white"><a onclick="btnPoliza0(' + datos[index]['id_poliza'] +')" style="color:white" data-tooltip="tooltip" data-placement="top" title="Añadir Póliza" class="btn btn-success btn-sm"><i class="fa fa-check-square-o" aria-hidden="true"></i></a><a onclick="btnPrePolizaE(' + datos[index]['id_poliza'] +',' + datos[index]['cod_poliza'] +')" style="color:white" data-tooltip="tooltip" data-placement="top" title="Pre-Cargar Póliza" class="btn btn-primary btn-sm"><i class="fa fa-plus-square-o" aria-hidden="true"></i></a><a href="../v_poliza.php?id_poliza=' + datos[index]['id_poliza'] +'&pagos=1" target="_blank" style="color:white" data-tooltip="tooltip" data-placement="top" title="Ver Póliza" class="btn btn-info btn-sm" ><i class="fa fa-eye"></i></i></a></td>'+
                                            '</tr>';

                                        } else {
                                            
                                            //console.log('vencida');

                                            var htmlTags = '<tr ondblclick="btnPoliza0(' + datos[index]['id_poliza'] +')" style="cursor:pointer">'+
                                                '<td style="color:red">' + datos[index]['cod_poliza'] + '</td>'+
                                                '<td nowrap>' + f_desde + '</td>'+
                                                '<td nowrap>' + f_hasta + '</td>'+
                                                '<td>' + datos[index]['nombre_t']+" "+datos[index]['apellido_t'] + '</td>'+
                                                '<td nowrap>' + datos[index]['nomcia'] + '</td>'+
                                                '<td nowrap>' + datos[index]['prima'] + '</td>'+
                                                '<td nowrap>' + datos1[0]['SUM(prima_com)'] + '</td>'+
                                                '<td nowrap>' + (datos[index]['prima']-datos1[0]['SUM(prima_com)']).toFixed(2) + '</td>'+
                                                '<td nowrap style="color:white"><a onclick="btnPoliza0(' + datos[index]['id_poliza'] +')" style="color:wwhite" data-tooltip="tooltip" data-placement="top" title="Añadir Póliza" class="btn btn-success btn-sm"><i class="fa fa-check-square-o" aria-hidden="true"></i></a><a onclick="btnPrePolizaE(' + datos[index]['id_poliza'] +',' + datos[index]['cod_poliza']+')" style="color:wwhite" data-tooltip="tooltip" data-placement="top" title="Pre-Cargar Póliza" class="btn btn-primary btn-sm"><i class="fa fa-plus-square-o" aria-hidden="true"></i></a><a href="../v_poliza.php?id_poliza=' + datos[index]['id_poliza'] +'&pagos=1" target="_blank" style="color:white" data-tooltip="tooltip" data-placement="top" title="Ver Póliza" class="btn btn-info btn-sm" ><i class="fa fa-eye"></i></i></a></td>'+
                                            '</tr>';
                                        }
                                        $('#tablaPE tbody').append(htmlTags);
                                        

                                        
                                    }
                                });
                            }

                            
                            
                            $('#polizaexistente').modal({backdrop: 'static', keyboard: false});
                            $('#polizaexistente').modal('show'); 

                        }
                    } 
                }
            });
        }

        function validarPoliza1(num_poliza){
            if($("#n_poliza1").val().length < 1) {  
                alertify.error("Debe escribir en la casilla para realizar la búsqueda");
                return false;  
            }
            $.ajax({
                type:"POST",
                data:"num_poliza=" + num_poliza.value,        
                url:"validarpoliza_e.php",
                success:function(r){
                    datos=jQuery.parseJSON(r);


                    if (datos == null) {
                            $("#n_poliza1").css('background-color', 'red');
                            $("#n_poliza1").css('color', 'white');
                 
                            $('#n_poliza1').attr('data-original-title','No Existe la Póliza para la Compañía Seleccionada, Debe Crearla y luego volver a introducir su Nº');
                            $('#btnForm').attr('disabled',true);

                            $('#btnPre1').removeAttr('hidden');

                            $('#nom_titu1').val('');
                            $('#asesor1').val('');
                    }
                    else{

                        if (datos[0]['id_poliza']==null) {
                            $("#n_poliza1").css('background-color', 'red');
                            $("#n_poliza1").css('color', 'white');
                 
                            $('#n_poliza1').attr('data-original-title','No Existe la Póliza para la Compañía Seleccionada, Debe Crearla y luego volver a introducir su Nº');
                            $('#btnForm').attr('disabled',true);

                            $('#btnPre1').removeAttr('hidden');

                            $('#nom_titu1').val('');
                            $('#asesor1').val('');
                        }
                        else{
                            $("#tablaPE  tbody").empty();

                            for (let index = 0; index < datos.length; index++) {

                                var d = new Date();
                                var strDate = d.getFullYear() + "-" + (d.getMonth()+1) + "-" + d.getDate();
                                
                                var f = new Date(datos[index]['f_hastapoliza']);
                                var f_hasta = (f.getDate()+1) + "-" + (f.getMonth()+1) + "-" + f.getFullYear();

                                var f = new Date(datos[index]['f_desdepoliza']);
                                var f_desde = (f.getDate()+1) + "-" + (f.getMonth()+1) + "-" + f.getFullYear();


                                if( (new Date(strDate).getTime() <= new Date(datos[index]['f_hastapoliza']).getTime()))
                                {
                                    //console.log('vigente');

                                    var htmlTags = '<tr ondblclick="btnPoliza1(' + datos[index]['id_poliza'] +')" style="cursor:pointer">>'+
                                        '<td style="color:green">' + datos[index]['cod_poliza'] + '</td>'+
                                        '<td nowrap>' + f_desde + '</td>'+
                                        '<td nowrap>' + f_hasta + '</td>'+
                                        '<td>' + datos[index]['nombre_t']+" "+datos[index]['apellido_t'] + '</td>'+
                                        '<td nowrap>' + datos[index]['nomcia'] + '</td>'+
                                        '<td nowrap>' + datos[index]['prima'] + '</td>'+
                                        '<td nowrap style="color:white"><a onclick="btnPoliza1(' + datos[index]['id_poliza'] +')" style="color:white" data-tooltip="tooltip" data-placement="top" title="Añadir Póliza" class="btn btn-success btn-sm"><i class="fa fa-check-square-o" aria-hidden="true"></i></a><a onclick="btnPrePolizaE(' + datos[index]['id_poliza'] +',' + datos[index]['cod_poliza'] + ')" style="color:white" data-tooltip="tooltip" data-placement="top" title="Pre-Cargar Póliza" class="btn btn-primary btn-sm"><i class="fa fa-plus-square-o" aria-hidden="true"></i></a><a href="../v_poliza.php?id_poliza=' + datos[index]['id_poliza'] +'&pagos=1" target="_blank" style="color:white" data-tooltip="tooltip" data-placement="top" title="Ver Póliza" class="btn btn-info btn-sm" ><i class="fa fa-eye"></i></i></a></td>'+
                                    '</tr>';

                                } else {
                                    
                                    //console.log('vencida');

                                    var htmlTags = '<tr ondblclick="btnPoliza1(' + datos[index]['id_poliza'] +')" style="cursor:pointer">>'+
                                        '<td style="color:red">' + datos[index]['cod_poliza'] + '</td>'+
                                        '<td nowrap>' + f_desde + '</td>'+
                                        '<td nowrap>' + f_hasta + '</td>'+
                                        '<td>' + datos[index]['nombre_t']+" "+datos[index]['apellido_t'] + '</td>'+
                                        '<td nowrap>' + datos[index]['nomcia'] + '</td>'+
                                        '<td nowrap>' + datos[index]['prima'] + '</td>'+
                                        '<td nowrap style="color:white"><a onclick="btnPoliza1(' + datos[index]['id_poliza'] +')" style="color:wwhite" data-tooltip="tooltip" data-placement="top" title="Añadir Póliza" class="btn btn-success btn-sm"><i class="fa fa-check-square-o" aria-hidden="true"></i></a><a onclick="btnPrePolizaE(' + datos[index]['id_poliza'] +',' + datos[index]['cod_poliza']+')" style="color:wwhite" data-tooltip="tooltip" data-placement="top" title="Pre-Cargar Póliza" class="btn btn-primary btn-sm"><i class="fa fa-plus-square-o" aria-hidden="true"></i></a><a href="../v_poliza.php?id_poliza=' + datos[index]['id_poliza'] +'&pagos=1" target="_blank" style="color:white" data-tooltip="tooltip" data-placement="top" title="Ver Póliza" class="btn btn-info btn-sm" ><i class="fa fa-eye"></i></i></a></td>'+
                                    '</tr>';
                                }
                                $('#tablaPE tbody').append(htmlTags);
                            }
                            
                            $('#polizaexistente').modal({backdrop: 'static', keyboard: false});
                            $('#polizaexistente').modal('show'); 

                        }
                    } 
                }
            });
        }

        function validarPoliza2(num_poliza){
            if($("#n_poliza2").val().length < 1) {  
                alertify.error("Debe escribir en la casilla para realizar la búsqueda");
                return false;  
            }
            $.ajax({
                type:"POST",
                data:"num_poliza=" + num_poliza.value,        
                url:"validarpoliza_e.php",
                success:function(r){
                    datos=jQuery.parseJSON(r);
                    if (datos == null) {
                            $("#n_poliza2").css('background-color', 'red');
                            $("#n_poliza2").css('color', 'white');
                 
                            $('#n_poliza2').attr('data-original-title','No Existe la Póliza para la Compañía Seleccionada, Debe Crearla y luego volver a introducir su Nº');
                            $('#btnForm').attr('disabled',true);

                            $('#btnPre2').removeAttr('hidden');

                            $('#nom_titu2').val('');
                            $('#asesor2').val('');
                    }
                    else{

                        if (datos[0]['id_poliza']==null) {
                            $("#n_poliza2").css('background-color', 'red');
                            $("#n_poliza2").css('color', 'white');
                 
                            $('#n_poliza2').attr('data-original-title','No Existe la Póliza para la Compañía Seleccionada, Debe Crearla y luego volver a introducir su Nº');
                            $('#btnForm').attr('disabled',true);

                            $('#btnPre2').removeAttr('hidden');

                            $('#nom_titu2').val('');
                            $('#asesor2').val('');
                        }
                        else{
                            $("#tablaPE  tbody").empty();

                            for (let index = 0; index < datos.length; index++) {

                                var d = new Date();
                                var strDate = d.getFullYear() + "-" + (d.getMonth()+1) + "-" + d.getDate();
                                
                                var f = new Date(datos[index]['f_hastapoliza']);
                                var f_hasta = (f.getDate()+1) + "-" + (f.getMonth()+1) + "-" + f.getFullYear();

                                var f = new Date(datos[index]['f_desdepoliza']);
                                var f_desde = (f.getDate()+1) + "-" + (f.getMonth()+1) + "-" + f.getFullYear();


                                if( (new Date(strDate).getTime() <= new Date(datos[index]['f_hastapoliza']).getTime()))
                                {
                                    //console.log('vigente');

                                    var htmlTags = '<tr ondblclick="btnPoliza2(' + datos[index]['id_poliza'] +')" style="cursor:pointer">>'+
                                        '<td style="color:green">' + datos[index]['cod_poliza'] + '</td>'+
                                        '<td nowrap>' + f_desde + '</td>'+
                                        '<td nowrap>' + f_hasta + '</td>'+
                                        '<td>' + datos[index]['nombre_t']+" "+datos[index]['apellido_t'] + '</td>'+
                                        '<td nowrap>' + datos[index]['nomcia'] + '</td>'+
                                        '<td nowrap>' + datos[index]['prima'] + '</td>'+
                                        '<td nowrap style="color:white"><a onclick="btnPoliza2(' + datos[index]['id_poliza'] +')" style="color:white" data-tooltip="tooltip" data-placement="top" title="Añadir Póliza" class="btn btn-success btn-sm"><i class="fa fa-check-square-o" aria-hidden="true"></i></a><a onclick="btnPrePolizaE(' + datos[index]['id_poliza'] +',' + datos[index]['cod_poliza'] + ')" style="color:white" data-tooltip="tooltip" data-placement="top" title="Pre-Cargar Póliza" class="btn btn-primary btn-sm"><i class="fa fa-plus-square-o" aria-hidden="true"></i></a><a href="../v_poliza.php?id_poliza=' + datos[index]['id_poliza'] +'&pagos=1" target="_blank" style="color:white" data-tooltip="tooltip" data-placement="top" title="Ver Póliza" class="btn btn-info btn-sm" ><i class="fa fa-eye"></i></i></a></td>'+
                                    '</tr>';

                                } else {
                                    
                                    //console.log('vencida');

                                    var htmlTags = '<tr ondblclick="btnPoliza2(' + datos[index]['id_poliza'] +')" style="cursor:pointer">>'+
                                        '<td style="color:red">' + datos[index]['cod_poliza'] + '</td>'+
                                        '<td nowrap>' + f_desde + '</td>'+
                                        '<td nowrap>' + f_hasta + '</td>'+
                                        '<td>' + datos[index]['nombre_t']+" "+datos[index]['apellido_t'] + '</td>'+
                                        '<td nowrap>' + datos[index]['nomcia'] + '</td>'+
                                        '<td nowrap>' + datos[index]['prima'] + '</td>'+
                                        '<td nowrap style="color:white"><a onclick="btnPoliza2(' + datos[index]['id_poliza'] +')" style="color:wwhite" data-tooltip="tooltip" data-placement="top" title="Añadir Póliza" class="btn btn-success btn-sm"><i class="fa fa-check-square-o" aria-hidden="true"></i></a><a onclick="btnPrePolizaE(' + datos[index]['id_poliza'] +',' + datos[index]['cod_poliza']+')" style="color:wwhite" data-tooltip="tooltip" data-placement="top" title="Pre-Cargar Póliza" class="btn btn-primary btn-sm"><i class="fa fa-plus-square-o" aria-hidden="true"></i></a><a href="../v_poliza.php?id_poliza=' + datos[index]['id_poliza'] +'&pagos=1" target="_blank" style="color:white" data-tooltip="tooltip" data-placement="top" title="Ver Póliza" class="btn btn-info btn-sm" ><i class="fa fa-eye"></i></i></a></td>'+
                                    '</tr>';
                                }
                                $('#tablaPE tbody').append(htmlTags);
                            }
                            
                            $('#polizaexistente').modal({backdrop: 'static', keyboard: false});
                            $('#polizaexistente').modal('show'); 

                        }
                    } 
                }
            });
        }

        function validarPoliza3(num_poliza){
            if($("#n_poliza3").val().length < 1) {  
                alertify.error("Debe escribir en la casilla para realizar la búsqueda");
                return false;  
            }
            $.ajax({
                type:"POST",
                data:"num_poliza=" + num_poliza.value,        
                url:"validarpoliza_e.php",
                success:function(r){
                    datos=jQuery.parseJSON(r);


                    if (datos == null) {
                            $("#n_poliza3").css('background-color', 'red');
                            $("#n_poliza3").css('color', 'white');
                 
                            $('#n_poliza3').attr('data-original-title','No Existe la Póliza para la Compañía Seleccionada, Debe Crearla y luego volver a introducir su Nº');
                            $('#btnForm').attr('disabled',true);

                            $('#btnPre3').removeAttr('hidden');

                            $('#nom_titu3').val('');
                            $('#asesor3').val('');
                    }
                    else{

                        if (datos[0]['id_poliza']==null) {
                            $("#n_poliza3").css('background-color', 'red');
                            $("#n_poliza3").css('color', 'white');
                 
                            $('#n_poliza3').attr('data-original-title','No Existe la Póliza para la Compañía Seleccionada, Debe Crearla y luego volver a introducir su Nº');
                            $('#btnForm').attr('disabled',true);

                            $('#btnPre3').removeAttr('hidden');

                            $('#nom_titu3').val('');
                            $('#asesor3').val('');
                        }
                        else{
                            $("#tablaPE  tbody").empty();

                            for (let index = 0; index < datos.length; index++) {

                                var d = new Date();
                                var strDate = d.getFullYear() + "-" + (d.getMonth()+1) + "-" + d.getDate();
                                
                                var f = new Date(datos[index]['f_hastapoliza']);
                                var f_hasta = (f.getDate()+1) + "-" + (f.getMonth()+1) + "-" + f.getFullYear();

                                var f = new Date(datos[index]['f_desdepoliza']);
                                var f_desde = (f.getDate()+1) + "-" + (f.getMonth()+1) + "-" + f.getFullYear();


                                if( (new Date(strDate).getTime() <= new Date(datos[index]['f_hastapoliza']).getTime()))
                                {
                                    //console.log('vigente');

                                    var htmlTags = '<tr ondblclick="btnPoliza3(' + datos[index]['id_poliza'] +')" style="cursor:pointer">>'+
                                        '<td style="color:green">' + datos[index]['cod_poliza'] + '</td>'+
                                        '<td nowrap>' + f_desde + '</td>'+
                                        '<td nowrap>' + f_hasta + '</td>'+
                                        '<td>' + datos[index]['nombre_t']+" "+datos[index]['apellido_t'] + '</td>'+
                                        '<td nowrap>' + datos[index]['nomcia'] + '</td>'+
                                        '<td nowrap>' + datos[index]['prima'] + '</td>'+
                                        '<td nowrap style="color:white"><a onclick="btnPoliza3(' + datos[index]['id_poliza'] +')" style="color:white" data-tooltip="tooltip" data-placement="top" title="Añadir Póliza" class="btn btn-success btn-sm"><i class="fa fa-check-square-o" aria-hidden="true"></i></a><a onclick="btnPrePolizaE(' + datos[index]['id_poliza'] +',' + datos[index]['cod_poliza'] + ')" style="color:white" data-tooltip="tooltip" data-placement="top" title="Pre-Cargar Póliza" class="btn btn-primary btn-sm"><i class="fa fa-plus-square-o" aria-hidden="true"></i></a><a href="../v_poliza.php?id_poliza=' + datos[index]['id_poliza'] +'&pagos=1" target="_blank" style="color:white" data-tooltip="tooltip" data-placement="top" title="Ver Póliza" class="btn btn-info btn-sm" ><i class="fa fa-eye"></i></i></a></td>'+
                                    '</tr>';

                                } else {
                                    
                                    //console.log('vencida');

                                    var htmlTags = '<tr ondblclick="btnPoliza3(' + datos[index]['id_poliza'] +')" style="cursor:pointer">>'+
                                        '<td style="color:red">' + datos[index]['cod_poliza'] + '</td>'+
                                        '<td nowrap>' + f_desde + '</td>'+
                                        '<td nowrap>' + f_hasta + '</td>'+
                                        '<td>' + datos[index]['nombre_t']+" "+datos[index]['apellido_t'] + '</td>'+
                                        '<td nowrap>' + datos[index]['nomcia'] + '</td>'+
                                        '<td nowrap>' + datos[index]['prima'] + '</td>'+
                                        '<td nowrap style="color:white"><a onclick="btnPoliza3(' + datos[index]['id_poliza'] +')" style="color:wwhite" data-tooltip="tooltip" data-placement="top" title="Añadir Póliza" class="btn btn-success btn-sm"><i class="fa fa-check-square-o" aria-hidden="true"></i></a><a onclick="btnPrePolizaE(' + datos[index]['id_poliza'] +',' + datos[index]['cod_poliza']+')" style="color:wwhite" data-tooltip="tooltip" data-placement="top" title="Pre-Cargar Póliza" class="btn btn-primary btn-sm"><i class="fa fa-plus-square-o" aria-hidden="true"></i></a><a href="../v_poliza.php?id_poliza=' + datos[index]['id_poliza'] +'&pagos=1" target="_blank" style="color:white" data-tooltip="tooltip" data-placement="top" title="Ver Póliza" class="btn btn-info btn-sm" ><i class="fa fa-eye"></i></i></a></td>'+
                                    '</tr>';
                                }
                                $('#tablaPE tbody').append(htmlTags);
                            }
                            
                            $('#polizaexistente').modal({backdrop: 'static', keyboard: false});
                            $('#polizaexistente').modal('show'); 

                        }
                    } 
                }
            });
        }

        function validarPoliza4(num_poliza){
            if($("#n_poliza4").val().length < 1) {  
                alertify.error("Debe escribir en la casilla para realizar la búsqueda");
                return false;  
            }
            $.ajax({
                type:"POST",
                data:"num_poliza=" + num_poliza.value,        
                url:"validarpoliza_e.php",
                success:function(r){
                    datos=jQuery.parseJSON(r);


                    if (datos == null) {
                            $("#n_poliza4").css('background-color', 'red');
                            $("#n_poliza4").css('color', 'white');
                 
                            $('#n_poliza4').attr('data-original-title','No Existe la Póliza para la Compañía Seleccionada, Debe Crearla y luego volver a introducir su Nº');
                            $('#btnForm').attr('disabled',true);

                            $('#btnPre4').removeAttr('hidden');

                            $('#nom_titu4').val('');
                            $('#asesor4').val('');
                    }
                    else{

                        if (datos[0]['id_poliza']==null) {
                            $("#n_poliza4").css('background-color', 'red');
                            $("#n_poliza4").css('color', 'white');
                 
                            $('#n_poliza4').attr('data-original-title','No Existe la Póliza para la Compañía Seleccionada, Debe Crearla y luego volver a introducir su Nº');
                            $('#btnForm').attr('disabled',true);

                            $('#btnPre4').removeAttr('hidden');

                            $('#nom_titu4').val('');
                            $('#asesor4').val('');
                        }
                        else{
                            $("#tablaPE  tbody").empty();

                            for (let index = 0; index < datos.length; index++) {

                                var d = new Date();
                                var strDate = d.getFullYear() + "-" + (d.getMonth()+1) + "-" + d.getDate();
                                
                                var f = new Date(datos[index]['f_hastapoliza']);
                                var f_hasta = (f.getDate()+1) + "-" + (f.getMonth()+1) + "-" + f.getFullYear();

                                var f = new Date(datos[index]['f_desdepoliza']);
                                var f_desde = (f.getDate()+1) + "-" + (f.getMonth()+1) + "-" + f.getFullYear();


                                if( (new Date(strDate).getTime() <= new Date(datos[index]['f_hastapoliza']).getTime()))
                                {
                                    //console.log('vigente');

                                    var htmlTags = '<tr ondblclick="btnPoliza4(' + datos[index]['id_poliza'] +')" style="cursor:pointer">>'+
                                        '<td style="color:green">' + datos[index]['cod_poliza'] + '</td>'+
                                        '<td nowrap>' + f_desde + '</td>'+
                                        '<td nowrap>' + f_hasta + '</td>'+
                                        '<td>' + datos[index]['nombre_t']+" "+datos[index]['apellido_t'] + '</td>'+
                                        '<td nowrap>' + datos[index]['nomcia'] + '</td>'+
                                        '<td nowrap>' + datos[index]['prima'] + '</td>'+
                                        '<td nowrap style="color:white"><a onclick="btnPoliza4(' + datos[index]['id_poliza'] +')" style="color:white" data-tooltip="tooltip" data-placement="top" title="Añadir Póliza" class="btn btn-success btn-sm"><i class="fa fa-check-square-o" aria-hidden="true"></i></a><a onclick="btnPrePolizaE(' + datos[index]['id_poliza'] +',' + datos[index]['cod_poliza'] + ')" style="color:white" data-tooltip="tooltip" data-placement="top" title="Pre-Cargar Póliza" class="btn btn-primary btn-sm"><i class="fa fa-plus-square-o" aria-hidden="true"></i></a><a href="../v_poliza.php?id_poliza=' + datos[index]['id_poliza'] +'&pagos=1" target="_blank" style="color:white" data-tooltip="tooltip" data-placement="top" title="Ver Póliza" class="btn btn-info btn-sm" ><i class="fa fa-eye"></i></i></a></td>'+
                                    '</tr>';

                                } else {
                                    
                                    //console.log('vencida');

                                    var htmlTags = '<tr ondblclick="btnPoliza4(' + datos[index]['id_poliza'] +')" style="cursor:pointer">>'+
                                        '<td style="color:red">' + datos[index]['cod_poliza'] + '</td>'+
                                        '<td nowrap>' + f_desde + '</td>'+
                                        '<td nowrap>' + f_hasta + '</td>'+
                                        '<td>' + datos[index]['nombre_t']+" "+datos[index]['apellido_t'] + '</td>'+
                                        '<td nowrap>' + datos[index]['nomcia'] + '</td>'+
                                        '<td nowrap>' + datos[index]['prima'] + '</td>'+
                                        '<td nowrap style="color:white"><a onclick="btnPoliza4(' + datos[index]['id_poliza'] +')" style="color:wwhite" data-tooltip="tooltip" data-placement="top" title="Añadir Póliza" class="btn btn-success btn-sm"><i class="fa fa-check-square-o" aria-hidden="true"></i></a><a onclick="btnPrePolizaE(' + datos[index]['id_poliza'] +',' + datos[index]['cod_poliza']+')" style="color:wwhite" data-tooltip="tooltip" data-placement="top" title="Pre-Cargar Póliza" class="btn btn-primary btn-sm"><i class="fa fa-plus-square-o" aria-hidden="true"></i></a><a href="../v_poliza.php?id_poliza=' + datos[index]['id_poliza'] +'&pagos=1" target="_blank" style="color:white" data-tooltip="tooltip" data-placement="top" title="Ver Póliza" class="btn btn-info btn-sm" ><i class="fa fa-eye"></i></i></a></td>'+
                                    '</tr>';
                                }
                                $('#tablaPE tbody').append(htmlTags);
                            }
                            
                            $('#polizaexistente').modal({backdrop: 'static', keyboard: false});
                            $('#polizaexistente').modal('show'); 

                        }
                    } 
                }
            });
        }

        function validarPoliza5(num_poliza){
            if($("#n_poliza5").val().length < 1) {  
                alertify.error("Debe escribir en la casilla para realizar la búsqueda");
                return false;  
            }
            $.ajax({
                type:"POST",
                data:"num_poliza=" + num_poliza.value,        
                url:"validarpoliza_e.php",
                success:function(r){
                    datos=jQuery.parseJSON(r);


                    if (datos == null) {
                            $("#n_poliza5").css('background-color', 'red');
                            $("#n_poliza5").css('color', 'white');
                 
                            $('#n_poliza5').attr('data-original-title','No Existe la Póliza para la Compañía Seleccionada, Debe Crearla y luego volver a introducir su Nº');
                            $('#btnForm').attr('disabled',true);

                            $('#btnPre5').removeAttr('hidden');

                            $('#nom_titu5').val('');
                            $('#asesor5').val('');
                    }
                    else{

                        if (datos[0]['id_poliza']==null) {
                            $("#n_poliza5").css('background-color', 'red');
                            $("#n_poliza5").css('color', 'white');
                 
                            $('#n_poliza5').attr('data-original-title','No Existe la Póliza para la Compañía Seleccionada, Debe Crearla y luego volver a introducir su Nº');
                            $('#btnForm').attr('disabled',true);

                            $('#btnPre5').removeAttr('hidden');

                            $('#nom_titu5').val('');
                            $('#asesor5').val('');
                        }
                        else{
                            $("#tablaPE  tbody").empty();

                            for (let index = 0; index < datos.length; index++) {

                                var d = new Date();
                                var strDate = d.getFullYear() + "-" + (d.getMonth()+1) + "-" + d.getDate();
                                
                                var f = new Date(datos[index]['f_hastapoliza']);
                                var f_hasta = (f.getDate()+1) + "-" + (f.getMonth()+1) + "-" + f.getFullYear();

                                var f = new Date(datos[index]['f_desdepoliza']);
                                var f_desde = (f.getDate()+1) + "-" + (f.getMonth()+1) + "-" + f.getFullYear();


                                if( (new Date(strDate).getTime() <= new Date(datos[index]['f_hastapoliza']).getTime()))
                                {
                                    //console.log('vigente');

                                    var htmlTags = '<tr ondblclick="btnPoliza5(' + datos[index]['id_poliza'] +')" style="cursor:pointer">>'+
                                        '<td style="color:green">' + datos[index]['cod_poliza'] + '</td>'+
                                        '<td nowrap>' + f_desde + '</td>'+
                                        '<td nowrap>' + f_hasta + '</td>'+
                                        '<td>' + datos[index]['nombre_t']+" "+datos[index]['apellido_t'] + '</td>'+
                                        '<td nowrap>' + datos[index]['nomcia'] + '</td>'+
                                        '<td nowrap>' + datos[index]['prima'] + '</td>'+
                                        '<td nowrap style="color:white"><a onclick="btnPoliza5(' + datos[index]['id_poliza'] +')" style="color:white" data-tooltip="tooltip" data-placement="top" title="Añadir Póliza" class="btn btn-success btn-sm"><i class="fa fa-check-square-o" aria-hidden="true"></i></a><a onclick="btnPrePolizaE(' + datos[index]['id_poliza'] +',' + datos[index]['cod_poliza'] + ')" style="color:white" data-tooltip="tooltip" data-placement="top" title="Pre-Cargar Póliza" class="btn btn-primary btn-sm"><i class="fa fa-plus-square-o" aria-hidden="true"></i></a><a href="../v_poliza.php?id_poliza=' + datos[index]['id_poliza'] +'&pagos=1" target="_blank" style="color:white" data-tooltip="tooltip" data-placement="top" title="Ver Póliza" class="btn btn-info btn-sm" ><i class="fa fa-eye"></i></i></a></td>'+
                                    '</tr>';

                                } else {
                                    
                                    //console.log('vencida');

                                    var htmlTags = '<tr ondblclick="btnPoliza5(' + datos[index]['id_poliza'] +')" style="cursor:pointer">>'+
                                        '<td style="color:red">' + datos[index]['cod_poliza'] + '</td>'+
                                        '<td nowrap>' + f_desde + '</td>'+
                                        '<td nowrap>' + f_hasta + '</td>'+
                                        '<td>' + datos[index]['nombre_t']+" "+datos[index]['apellido_t'] + '</td>'+
                                        '<td nowrap>' + datos[index]['nomcia'] + '</td>'+
                                        '<td nowrap>' + datos[index]['prima'] + '</td>'+
                                        '<td nowrap style="color:white"><a onclick="btnPoliza5(' + datos[index]['id_poliza'] +')" style="color:wwhite" data-tooltip="tooltip" data-placement="top" title="Añadir Póliza" class="btn btn-success btn-sm"><i class="fa fa-check-square-o" aria-hidden="true"></i></a><a onclick="btnPrePolizaE(' + datos[index]['id_poliza'] +',' + datos[index]['cod_poliza']+')" style="color:wwhite" data-tooltip="tooltip" data-placement="top" title="Pre-Cargar Póliza" class="btn btn-primary btn-sm"><i class="fa fa-plus-square-o" aria-hidden="true"></i></a><a href="../v_poliza.php?id_poliza=' + datos[index]['id_poliza'] +'&pagos=1" target="_blank" style="color:white" data-tooltip="tooltip" data-placement="top" title="Ver Póliza" class="btn btn-info btn-sm" ><i class="fa fa-eye"></i></i></a></td>'+
                                    '</tr>';
                                }
                                $('#tablaPE tbody').append(htmlTags);
                            }
                            
                            $('#polizaexistente').modal({backdrop: 'static', keyboard: false});
                            $('#polizaexistente').modal('show'); 

                        }
                    } 
                }
            });
        }

        function validarPoliza6(num_poliza){
            if($("#n_poliza6").val().length < 1) {  
                alertify.error("Debe escribir en la casilla para realizar la búsqueda");
                return false;  
            }
            $.ajax({
                type:"POST",
                data:"num_poliza=" + num_poliza.value,        
                url:"validarpoliza_e.php",
                success:function(r){
                    datos=jQuery.parseJSON(r);


                    if (datos == null) {
                            $("#n_poliza6").css('background-color', 'red');
                            $("#n_poliza6").css('color', 'white');
                 
                            $('#n_poliza6').attr('data-original-title','No Existe la Póliza para la Compañía Seleccionada, Debe Crearla y luego volver a introducir su Nº');
                            $('#btnForm').attr('disabled',true);

                            $('#btnPre6').removeAttr('hidden');

                            $('#nom_titu6').val('');
                            $('#asesor6').val('');
                    }
                    else{

                        if (datos[0]['id_poliza']==null) {
                            $("#n_poliza6").css('background-color', 'red');
                            $("#n_poliza6").css('color', 'white');
                 
                            $('#n_poliza6').attr('data-original-title','No Existe la Póliza para la Compañía Seleccionada, Debe Crearla y luego volver a introducir su Nº');
                            $('#btnForm').attr('disabled',true);

                            $('#btnPre6').removeAttr('hidden');

                            $('#nom_titu6').val('');
                            $('#asesor6').val('');
                        }
                        else{
                            $("#tablaPE  tbody").empty();

                            for (let index = 0; index < datos.length; index++) {

                                var d = new Date();
                                var strDate = d.getFullYear() + "-" + (d.getMonth()+1) + "-" + d.getDate();
                                
                                var f = new Date(datos[index]['f_hastapoliza']);
                                var f_hasta = (f.getDate()+1) + "-" + (f.getMonth()+1) + "-" + f.getFullYear();

                                var f = new Date(datos[index]['f_desdepoliza']);
                                var f_desde = (f.getDate()+1) + "-" + (f.getMonth()+1) + "-" + f.getFullYear();


                                if( (new Date(strDate).getTime() <= new Date(datos[index]['f_hastapoliza']).getTime()))
                                {
                                    //console.log('vigente');

                                    var htmlTags = '<tr ondblclick="btnPoliza6(' + datos[index]['id_poliza'] +')" style="cursor:pointer">>'+
                                        '<td style="color:green">' + datos[index]['cod_poliza'] + '</td>'+
                                        '<td nowrap>' + f_desde + '</td>'+
                                        '<td nowrap>' + f_hasta + '</td>'+
                                        '<td>' + datos[index]['nombre_t']+" "+datos[index]['apellido_t'] + '</td>'+
                                        '<td nowrap>' + datos[index]['nomcia'] + '</td>'+
                                        '<td nowrap>' + datos[index]['prima'] + '</td>'+
                                        '<td nowrap style="color:white"><a onclick="btnPoliza6(' + datos[index]['id_poliza'] +')" style="color:white" data-tooltip="tooltip" data-placement="top" title="Añadir Póliza" class="btn btn-success btn-sm"><i class="fa fa-check-square-o" aria-hidden="true"></i></a><a onclick="btnPrePolizaE(' + datos[index]['id_poliza'] +',' + datos[index]['cod_poliza'] + ')" style="color:white" data-tooltip="tooltip" data-placement="top" title="Pre-Cargar Póliza" class="btn btn-primary btn-sm"><i class="fa fa-plus-square-o" aria-hidden="true"></i></a><a href="../v_poliza.php?id_poliza=' + datos[index]['id_poliza'] +'&pagos=1" target="_blank" style="color:white" data-tooltip="tooltip" data-placement="top" title="Ver Póliza" class="btn btn-info btn-sm" ><i class="fa fa-eye"></i></i></a></td>'+
                                    '</tr>';

                                } else {
                                    
                                    //console.log('vencida');

                                    var htmlTags = '<tr ondblclick="btnPoliza6(' + datos[index]['id_poliza'] +')" style="cursor:pointer">>'+
                                        '<td style="color:red">' + datos[index]['cod_poliza'] + '</td>'+
                                        '<td nowrap>' + f_desde + '</td>'+
                                        '<td nowrap>' + f_hasta + '</td>'+
                                        '<td>' + datos[index]['nombre_t']+" "+datos[index]['apellido_t'] + '</td>'+
                                        '<td nowrap>' + datos[index]['nomcia'] + '</td>'+
                                        '<td nowrap>' + datos[index]['prima'] + '</td>'+
                                        '<td nowrap style="color:white"><a onclick="btnPoliza6(' + datos[index]['id_poliza'] +')" style="color:wwhite" data-tooltip="tooltip" data-placement="top" title="Añadir Póliza" class="btn btn-success btn-sm"><i class="fa fa-check-square-o" aria-hidden="true"></i></a><a onclick="btnPrePolizaE(' + datos[index]['id_poliza'] +',' + datos[index]['cod_poliza']+')" style="color:wwhite" data-tooltip="tooltip" data-placement="top" title="Pre-Cargar Póliza" class="btn btn-primary btn-sm"><i class="fa fa-plus-square-o" aria-hidden="true"></i></a><a href="../v_poliza.php?id_poliza=' + datos[index]['id_poliza'] +'&pagos=1" target="_blank" style="color:white" data-tooltip="tooltip" data-placement="top" title="Ver Póliza" class="btn btn-info btn-sm" ><i class="fa fa-eye"></i></i></a></td>'+
                                    '</tr>';
                                }
                                $('#tablaPE tbody').append(htmlTags);
                            }
                            
                            $('#polizaexistente').modal({backdrop: 'static', keyboard: false});
                            $('#polizaexistente').modal('show'); 

                        }
                    } 
                }
            });
        }

        function validarPoliza7(num_poliza){
            if($("#n_poliza7").val().length < 1) {  
                alertify.error("Debe escribir en la casilla para realizar la búsqueda");
                return false;  
            }
            $.ajax({
                type:"POST",
                data:"num_poliza=" + num_poliza.value,        
                url:"validarpoliza_e.php",
                success:function(r){
                    datos=jQuery.parseJSON(r);


                    if (datos == null) {
                            $("#n_poliza7").css('background-color', 'red');
                            $("#n_poliza7").css('color', 'white');
                 
                            $('#n_poliza7').attr('data-original-title','No Existe la Póliza para la Compañía Seleccionada, Debe Crearla y luego volver a introducir su Nº');
                            $('#btnForm').attr('disabled',true);

                            $('#btnPre7').removeAttr('hidden');

                            $('#nom_titu7').val('');
                            $('#asesor7').val('');
                    }
                    else{

                        if (datos[0]['id_poliza']==null) {
                            $("#n_poliza7").css('background-color', 'red');
                            $("#n_poliza7").css('color', 'white');
                 
                            $('#n_poliza7').attr('data-original-title','No Existe la Póliza para la Compañía Seleccionada, Debe Crearla y luego volver a introducir su Nº');
                            $('#btnForm').attr('disabled',true);

                            $('#btnPre7').removeAttr('hidden');

                            $('#nom_titu7').val('');
                            $('#asesor7').val('');
                        }
                        else{
                            $("#tablaPE  tbody").empty();

                            for (let index = 0; index < datos.length; index++) {

                                var d = new Date();
                                var strDate = d.getFullYear() + "-" + (d.getMonth()+1) + "-" + d.getDate();
                                
                                var f = new Date(datos[index]['f_hastapoliza']);
                                var f_hasta = (f.getDate()+1) + "-" + (f.getMonth()+1) + "-" + f.getFullYear();

                                var f = new Date(datos[index]['f_desdepoliza']);
                                var f_desde = (f.getDate()+1) + "-" + (f.getMonth()+1) + "-" + f.getFullYear();


                                if( (new Date(strDate).getTime() <= new Date(datos[index]['f_hastapoliza']).getTime()))
                                {
                                    //console.log('vigente');

                                    var htmlTags = '<tr ondblclick="btnPoliza7(' + datos[index]['id_poliza'] +')" style="cursor:pointer">>'+
                                        '<td style="color:green">' + datos[index]['cod_poliza'] + '</td>'+
                                        '<td nowrap>' + f_desde + '</td>'+
                                        '<td nowrap>' + f_hasta + '</td>'+
                                        '<td>' + datos[index]['nombre_t']+" "+datos[index]['apellido_t'] + '</td>'+
                                        '<td nowrap>' + datos[index]['nomcia'] + '</td>'+
                                        '<td nowrap>' + datos[index]['prima'] + '</td>'+
                                        '<td nowrap style="color:white"><a onclick="btnPoliza7(' + datos[index]['id_poliza'] +')" style="color:white" data-tooltip="tooltip" data-placement="top" title="Añadir Póliza" class="btn btn-success btn-sm"><i class="fa fa-check-square-o" aria-hidden="true"></i></a><a onclick="btnPrePolizaE(' + datos[index]['id_poliza'] +',' + datos[index]['cod_poliza'] + ')" style="color:white" data-tooltip="tooltip" data-placement="top" title="Pre-Cargar Póliza" class="btn btn-primary btn-sm"><i class="fa fa-plus-square-o" aria-hidden="true"></i></a><a href="../v_poliza.php?id_poliza=' + datos[index]['id_poliza'] +'&pagos=1" target="_blank" style="color:white" data-tooltip="tooltip" data-placement="top" title="Ver Póliza" class="btn btn-info btn-sm" ><i class="fa fa-eye"></i></i></a></td>'+
                                    '</tr>';

                                } else {
                                    
                                    //console.log('vencida');

                                    var htmlTags = '<tr ondblclick="btnPoliza7(' + datos[index]['id_poliza'] +')" style="cursor:pointer">>'+
                                        '<td style="color:red">' + datos[index]['cod_poliza'] + '</td>'+
                                        '<td nowrap>' + f_desde + '</td>'+
                                        '<td nowrap>' + f_hasta + '</td>'+
                                        '<td>' + datos[index]['nombre_t']+" "+datos[index]['apellido_t'] + '</td>'+
                                        '<td nowrap>' + datos[index]['nomcia'] + '</td>'+
                                        '<td nowrap>' + datos[index]['prima'] + '</td>'+
                                        '<td nowrap style="color:white"><a onclick="btnPoliza7(' + datos[index]['id_poliza'] +')" style="color:wwhite" data-tooltip="tooltip" data-placement="top" title="Añadir Póliza" class="btn btn-success btn-sm"><i class="fa fa-check-square-o" aria-hidden="true"></i></a><a onclick="btnPrePolizaE(' + datos[index]['id_poliza'] +',' + datos[index]['cod_poliza']+')" style="color:wwhite" data-tooltip="tooltip" data-placement="top" title="Pre-Cargar Póliza" class="btn btn-primary btn-sm"><i class="fa fa-plus-square-o" aria-hidden="true"></i></a><a href="../v_poliza.php?id_poliza=' + datos[index]['id_poliza'] +'&pagos=1" target="_blank" style="color:white" data-tooltip="tooltip" data-placement="top" title="Ver Póliza" class="btn btn-info btn-sm" ><i class="fa fa-eye"></i></i></a></td>'+
                                    '</tr>';
                                }
                                $('#tablaPE tbody').append(htmlTags);
                            }
                            
                            $('#polizaexistente').modal({backdrop: 'static', keyboard: false});
                            $('#polizaexistente').modal('show'); 

                        }
                    } 
                }
            });
        }

        function validarPoliza8(num_poliza){
            if($("#n_poliza8").val().length < 1) {  
                alertify.error("Debe escribir en la casilla para realizar la búsqueda");
                return false;  
            }
            $.ajax({
                type:"POST",
                data:"num_poliza=" + num_poliza.value,        
                url:"validarpoliza_e.php",
                success:function(r){
                    datos=jQuery.parseJSON(r);


                    if (datos == null) {
                            $("#n_poliza8").css('background-color', 'red');
                            $("#n_poliza8").css('color', 'white');
                 
                            $('#n_poliza8').attr('data-original-title','No Existe la Póliza para la Compañía Seleccionada, Debe Crearla y luego volver a introducir su Nº');
                            $('#btnForm').attr('disabled',true);

                            $('#btnPre8').removeAttr('hidden');

                            $('#nom_titu8').val('');
                            $('#asesor8').val('');
                    }
                    else{

                        if (datos[0]['id_poliza']==null) {
                            $("#n_poliza8").css('background-color', 'red');
                            $("#n_poliza8").css('color', 'white');
                 
                            $('#n_poliza8').attr('data-original-title','No Existe la Póliza para la Compañía Seleccionada, Debe Crearla y luego volver a introducir su Nº');
                            $('#btnForm').attr('disabled',true);

                            $('#btnPre8').removeAttr('hidden');

                            $('#nom_titu8').val('');
                            $('#asesor8').val('');
                        }
                        else{
                            $("#tablaPE  tbody").empty();

                            for (let index = 0; index < datos.length; index++) {

                                var d = new Date();
                                var strDate = d.getFullYear() + "-" + (d.getMonth()+1) + "-" + d.getDate();
                                
                                var f = new Date(datos[index]['f_hastapoliza']);
                                var f_hasta = (f.getDate()+1) + "-" + (f.getMonth()+1) + "-" + f.getFullYear();

                                var f = new Date(datos[index]['f_desdepoliza']);
                                var f_desde = (f.getDate()+1) + "-" + (f.getMonth()+1) + "-" + f.getFullYear();


                                if( (new Date(strDate).getTime() <= new Date(datos[index]['f_hastapoliza']).getTime()))
                                {
                                    //console.log('vigente');

                                    var htmlTags = '<tr ondblclick="btnPoliza8(' + datos[index]['id_poliza'] +')" style="cursor:pointer">>'+
                                        '<td style="color:green">' + datos[index]['cod_poliza'] + '</td>'+
                                        '<td nowrap>' + f_desde + '</td>'+
                                        '<td nowrap>' + f_hasta + '</td>'+
                                        '<td>' + datos[index]['nombre_t']+" "+datos[index]['apellido_t'] + '</td>'+
                                        '<td nowrap>' + datos[index]['nomcia'] + '</td>'+
                                        '<td nowrap>' + datos[index]['prima'] + '</td>'+
                                        '<td nowrap style="color:white"><a onclick="btnPoliza8(' + datos[index]['id_poliza'] +')" style="color:white" data-tooltip="tooltip" data-placement="top" title="Añadir Póliza" class="btn btn-success btn-sm"><i class="fa fa-check-square-o" aria-hidden="true"></i></a><a onclick="btnPrePolizaE(' + datos[index]['id_poliza'] +',' + datos[index]['cod_poliza'] + ')" style="color:white" data-tooltip="tooltip" data-placement="top" title="Pre-Cargar Póliza" class="btn btn-primary btn-sm"><i class="fa fa-plus-square-o" aria-hidden="true"></i></a><a href="../v_poliza.php?id_poliza=' + datos[index]['id_poliza'] +'&pagos=1" target="_blank" style="color:white" data-tooltip="tooltip" data-placement="top" title="Ver Póliza" class="btn btn-info btn-sm" ><i class="fa fa-eye"></i></i></a></td>'+
                                    '</tr>';

                                } else {
                                    
                                    //console.log('vencida');

                                    var htmlTags = '<tr ondblclick="btnPoliza8(' + datos[index]['id_poliza'] +')" style="cursor:pointer">>'+
                                        '<td style="color:red">' + datos[index]['cod_poliza'] + '</td>'+
                                        '<td nowrap>' + f_desde + '</td>'+
                                        '<td nowrap>' + f_hasta + '</td>'+
                                        '<td>' + datos[index]['nombre_t']+" "+datos[index]['apellido_t'] + '</td>'+
                                        '<td nowrap>' + datos[index]['nomcia'] + '</td>'+
                                        '<td nowrap>' + datos[index]['prima'] + '</td>'+
                                        '<td nowrap style="color:white"><a onclick="btnPoliza8(' + datos[index]['id_poliza'] +')" style="color:wwhite" data-tooltip="tooltip" data-placement="top" title="Añadir Póliza" class="btn btn-success btn-sm"><i class="fa fa-check-square-o" aria-hidden="true"></i></a><a onclick="btnPrePolizaE(' + datos[index]['id_poliza'] +',' + datos[index]['cod_poliza']+')" style="color:wwhite" data-tooltip="tooltip" data-placement="top" title="Pre-Cargar Póliza" class="btn btn-primary btn-sm"><i class="fa fa-plus-square-o" aria-hidden="true"></i></a><a href="../v_poliza.php?id_poliza=' + datos[index]['id_poliza'] +'&pagos=1" target="_blank" style="color:white" data-tooltip="tooltip" data-placement="top" title="Ver Póliza" class="btn btn-info btn-sm" ><i class="fa fa-eye"></i></i></a></td>'+
                                    '</tr>';
                                }
                                $('#tablaPE tbody').append(htmlTags);
                            }
                            
                            $('#polizaexistente').modal({backdrop: 'static', keyboard: false});
                            $('#polizaexistente').modal('show'); 

                        }
                    } 
                }
            });
        }

        function validarPoliza9(num_poliza){
            if($("#n_poliza9").val().length < 1) {  
                alertify.error("Debe escribir en la casilla para realizar la búsqueda");
                return false;  
            }
            $.ajax({
                type:"POST",
                data:"num_poliza=" + num_poliza.value,        
                url:"validarpoliza_e.php",
                success:function(r){
                    datos=jQuery.parseJSON(r);


                    if (datos == null) {
                            $("#n_poliza9").css('background-color', 'red');
                            $("#n_poliza9").css('color', 'white');
                 
                            $('#n_poliza9').attr('data-original-title','No Existe la Póliza para la Compañía Seleccionada, Debe Crearla y luego volver a introducir su Nº');
                            $('#btnForm').attr('disabled',true);

                            $('#btnPre9').removeAttr('hidden');

                            $('#nom_titu9').val('');
                            $('#asesor9').val('');
                    }
                    else{

                        if (datos[0]['id_poliza']==null) {
                            $("#n_poliza9").css('background-color', 'red');
                            $("#n_poliza9").css('color', 'white');
                 
                            $('#n_poliza9').attr('data-original-title','No Existe la Póliza para la Compañía Seleccionada, Debe Crearla y luego volver a introducir su Nº');
                            $('#btnForm').attr('disabled',true);

                            $('#btnPre9').removeAttr('hidden');

                            $('#nom_titu9').val('');
                            $('#asesor9').val('');
                        }
                        else{
                            $("#tablaPE  tbody").empty();

                            for (let index = 0; index < datos.length; index++) {

                                var d = new Date();
                                var strDate = d.getFullYear() + "-" + (d.getMonth()+1) + "-" + d.getDate();
                                
                                var f = new Date(datos[index]['f_hastapoliza']);
                                var f_hasta = (f.getDate()+1) + "-" + (f.getMonth()+1) + "-" + f.getFullYear();

                                var f = new Date(datos[index]['f_desdepoliza']);
                                var f_desde = (f.getDate()+1) + "-" + (f.getMonth()+1) + "-" + f.getFullYear();


                                if( (new Date(strDate).getTime() <= new Date(datos[index]['f_hastapoliza']).getTime()))
                                {
                                    //console.log('vigente');

                                    var htmlTags = '<tr ondblclick="btnPoliza9(' + datos[index]['id_poliza'] +')" style="cursor:pointer">>'+
                                        '<td style="color:green">' + datos[index]['cod_poliza'] + '</td>'+
                                        '<td nowrap>' + f_desde + '</td>'+
                                        '<td nowrap>' + f_hasta + '</td>'+
                                        '<td>' + datos[index]['nombre_t']+" "+datos[index]['apellido_t'] + '</td>'+
                                        '<td nowrap>' + datos[index]['nomcia'] + '</td>'+
                                        '<td nowrap>' + datos[index]['prima'] + '</td>'+
                                        '<td nowrap style="color:white"><a onclick="btnPoliza9(' + datos[index]['id_poliza'] +')" style="color:white" data-tooltip="tooltip" data-placement="top" title="Añadir Póliza" class="btn btn-success btn-sm"><i class="fa fa-check-square-o" aria-hidden="true"></i></a><a onclick="btnPrePolizaE(' + datos[index]['id_poliza'] +',' + datos[index]['cod_poliza'] + ')" style="color:white" data-tooltip="tooltip" data-placement="top" title="Pre-Cargar Póliza" class="btn btn-primary btn-sm"><i class="fa fa-plus-square-o" aria-hidden="true"></i></a><a href="../v_poliza.php?id_poliza=' + datos[index]['id_poliza'] +'&pagos=1" target="_blank" style="color:white" data-tooltip="tooltip" data-placement="top" title="Ver Póliza" class="btn btn-info btn-sm" ><i class="fa fa-eye"></i></i></a></td>'+
                                    '</tr>';

                                } else {
                                    
                                    //console.log('vencida');

                                    var htmlTags = '<tr ondblclick="btnPoliza9(' + datos[index]['id_poliza'] +')" style="cursor:pointer">>'+
                                        '<td style="color:red">' + datos[index]['cod_poliza'] + '</td>'+
                                        '<td nowrap>' + f_desde + '</td>'+
                                        '<td nowrap>' + f_hasta + '</td>'+
                                        '<td>' + datos[index]['nombre_t']+" "+datos[index]['apellido_t'] + '</td>'+
                                        '<td nowrap>' + datos[index]['nomcia'] + '</td>'+
                                        '<td nowrap>' + datos[index]['prima'] + '</td>'+
                                        '<td nowrap style="color:white"><a onclick="btnPoliza9(' + datos[index]['id_poliza'] +')" style="color:wwhite" data-tooltip="tooltip" data-placement="top" title="Añadir Póliza" class="btn btn-success btn-sm"><i class="fa fa-check-square-o" aria-hidden="true"></i></a><a onclick="btnPrePolizaE(' + datos[index]['id_poliza'] +',' + datos[index]['cod_poliza']+')" style="color:wwhite" data-tooltip="tooltip" data-placement="top" title="Pre-Cargar Póliza" class="btn btn-primary btn-sm"><i class="fa fa-plus-square-o" aria-hidden="true"></i></a><a href="../v_poliza.php?id_poliza=' + datos[index]['id_poliza'] +'&pagos=1" target="_blank" style="color:white" data-tooltip="tooltip" data-placement="top" title="Ver Póliza" class="btn btn-info btn-sm" ><i class="fa fa-eye"></i></i></a></td>'+
                                    '</tr>';
                                }
                                $('#tablaPE tbody').append(htmlTags);
                            }
                            
                            $('#polizaexistente').modal({backdrop: 'static', keyboard: false});
                            $('#polizaexistente').modal('show'); 

                        }
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

            $("#Rest").text('Falta cargar $'+Rest+' de prima sujeta a comisión');
        }

        function calcularRest1(comision){
            
            var comision0 = $("#comision0").val();
            var comision1 = $("#comision1").val();
            var comision2 = $("#comision2").val();
            var comision3 = $("#comision3").val();
            var comision4 = $("#comision4").val();
            var comision5 = $("#comision5").val();
            var comision6 = $("#comision6").val();
            var comision7 = $("#comision7").val();
            var comision8 = $("#comision8").val();
            var comision9 = $("#comision9").val();

            if (($("#comision0").val() == '')){
               var comision0 = 0;
            }
            if (($("#comision1").val() == '') || ($("#comision1").val() == null)){
               var comision1 = 0;
            }
            if (($("#comision2").val() == '') || ($("#comision2").val() == null)){
               var comision2 = 0;
            }
            if (($("#comision3").val() == '') || ($("#comision3").val() == null)){
               var comision3 = 0;
            }
            if (($("#comision4").val() == '') || ($("#comision4").val() == null)){
               var comision4 = 0;
            }
            if (($("#comision5").val() == '') || ($("#comision5").val() == null)){
               var comision5 = 0;
            }
            if (($("#comision6").val() == '') || ($("#comision6").val() == null)){
               var comision6 = 0;
            }
            if (($("#comision7").val() == '') || ($("#comision7").val() == null)){
               var comision7 = 0;
            }
            if (($("#comision8").val() == '') || ($("#comision8").val() == null)){
               var comision8 = 0;
            }
            if (($("#comision9").val() == '') || ($("#comision9").val() == null)){
               var comision9 = 0;
            }

            console.log(comision0);

            var comRestante = '<?php echo $comRestante;?>';

            var Rest=comRestante-comision0-comision1-comision2-comision3-comision4-comision5-comision6-comision7-comision8-comision9;

            $("#Rest1").text('Falta cargar $'+Rest+' de comisiones');
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
                $("#num0").val(0);
                $("#asegurado").val('');
            }
        }
        function botonPreCarga1(){
            if ($("#n_poliza1").val() != '') {
                $("#num_poliza").val($("#n_poliza1").val());
                $("#num1").val(1);
                $("#asegurado").val('');
            }
        }
        function botonPreCarga2(){
            if ($("#n_poliza2").val() != '') {
                $("#num_poliza").val($("#n_poliza2").val());
                $("#num2").val(2);
                $("#asegurado").val('');
            }
        }
        function botonPreCarga3(){
            if ($("#n_poliza3").val() != '') {
                $("#num_poliza").val($("#n_poliza3").val());
                $("#num3").val(3);
                $("#asegurado").val('');
            }
        }
        function botonPreCarga4(){
            if ($("#n_poliza4").val() != '') {
                $("#num_poliza").val($("#n_poliza4").val());
                $("#num4").val(4);
                $("#asegurado").val('');
            }
        }
        function botonPreCarga5(){
            if ($("#n_poliza5").val() != '') {
                $("#num_poliza").val($("#n_poliza5").val());
                $("#num5").val(5);
                $("#asegurado").val('');
            }
        }
        function botonPreCarga6(){
            if ($("#n_poliza6").val() != '') {
                $("#num_poliza").val($("#n_poliza6").val());
                $("#num6").val(6);
                $("#asegurado").val('');
            }
        }
        function botonPreCarga7(){
            if ($("#n_poliza7").val() != '') {
                $("#num_poliza").val($("#n_poliza7").val());
                $("#num7").val(7);
                $("#asegurado").val('');
            }
        }
        function botonPreCarga8(){
            if ($("#n_poliza8").val() != '') {
                $("#num_poliza").val($("#n_poliza8").val());
                $("#num8").val(8);
                $("#asegurado").val('');
            }
        }
        function botonPreCarga9(){
            if ($("#n_poliza9").val() != '') {
                $("#num_poliza").val($("#n_poliza9").val());
                $("#num9").val(9);
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


    

    <!-- Modal Polizas Existentes-->
    <div class="modal fade" id="polizaexistente" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Seleccione la Póliza</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="frmnuevoP">
                        <div class="table-responsive">
                        <table class="table table-hover table-striped table-bordered" id="tablaPE">
                            <thead style="background-color: #00bcd4;color: white; font-weight: bold;">
                                <tr>
                                    <th>Nº de Póliza</th>
                                    <th>F Desde Seg</th>
                                    <th>F Hasta Seg</th>
                                    <th>Nombre Asegurado</th>
                                    <th>Cía</th>
                                    <th>Prima Suscrita</th>
                                    <th>Prima Cobrada</th>
                                    <th>Prima Pendiente</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                        </div>
                    </form>
                </div>
                <!--
                <div class="modal-footer">
                    <button type="button" id="btnAgregarnuevo" class="btn btn-info">Agregar nuevo</button>
                </div>
                -->
            </div>
        </div>
    </div>

    

</body>

</html>