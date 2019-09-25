<?php 
session_start();
if(isset($_SESSION['seudonimo'])) {

  }
    else {
        header("Location: login.php");
        exit();
      }
      
  require_once("../class/clases.php");

//----Obtengo el permiso del usuario
    $permiso = $_SESSION['id_permiso'];
//----------------------



  $id_poliza = $_GET['id_poliza'];

  $obj1= new Trabajo();
  $poliza = $obj1->get_poliza_total_by_id($id_poliza); 

  if ($poliza[0]['id_poliza']==0) {  
    $obj1= new Trabajo();
    $poliza = $obj1->get_poliza_total1_by_id($id_poliza); 
  }
  if ($poliza[0]['id_poliza']==0) {  
    $obj1= new Trabajo();
    $poliza = $obj1->get_poliza_total2_by_id($id_poliza); 
  }
  if ($poliza[0]['id_poliza']==0) {  
    $obj1= new Trabajo();
    $poliza = $obj1->get_poliza_total3_by_id($id_poliza); 
  }

  $obj10= new Trabajo();
  $tomador = $obj10->get_element_by_id('titular','id_titular',$poliza[0]['id_tomador']); 

    $currency="";
    if ($poliza[0]['currency']==1) {
        $currency="$ ";
    }else{$currency="Bs ";}

  $ob10= new Trabajo();
  $vehiculo = $ob10->get_element_by_id('dveh','idveh',$poliza[0]['id_poliza']); 

  $ob100= new Trabajo();
  $usuario = $ob100->get_element_by_id('usuarios','id_usuario',$poliza[0]['id_usuario']); 

  $originalCreacion = $poliza[0]['f_poliza'];
  $newCreacion = date("d/m/Y", strtotime($originalCreacion));

    $obj77= new Trabajo();
    $cia_pref = $obj77->get_per_gc_cia_pref($poliza[0]['f_desdepoliza'],$poliza[0]['id_cia'],$poliza[0]['codvend']);


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php require('header.php');?>

    <style>
        .alertify .ajs-header {
            background-color:red;
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
    
    <?php    
    if(isset($_GET['m'])==2){
    ?>
<div class="alert alert-success alert-dismissible fade show text-center" role="alert">
  <strong>Póliza Subida correctamente en .pdf!</strong>
  <button style="cursor: pointer" type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
    <?php    
    }
    ?>
        

        <div class="section">
            <div class="container">
                
                
                


                <?php 
                
                
                    $id_poliza=$poliza[0]['id_poliza'].".pdf";
                    $archivo='./'.$id_poliza;
                    
   /*                 
//190.140.224.69                    
$ftp_server="181.197.87.15";
$port=21;
$ftp_usuario="usuario";
$ftp_pass="20127247";
$con_id=@ftp_connect($ftp_server,$port) or die("Unable to connect to server.");
$lr=ftp_login($con_id, $ftp_usuario, $ftp_pass);

//ftp_pasv($con_id, true);

if ( (!$con_id) || (!$lr) ) {
    echo "no se pudo conectar";
} else {
    
    
    
    
    # Cambiamos al directorio especificado
    if(ftp_chdir($con_id,''))
    {
        
        // Obtener los archivos contenidos en el directorio actual
        $contents = ftp_nlist($con_id, ".");
        
        if (in_array($archivo, $contents)) {
            //echo "<br>";
            //echo "I found ".$archivo." in directory";
        
                    
                    
                    
                ?>
      
                    <a href="download.php?id_poliza=<?php echo $poliza[0]['id_poliza'];?>" class="btn btn-white btn-round" target="_blank" style="float: right"><img src="../assets/img/pdf-logo.png" width="60" alt=""></a>
                    <br>
                <?php
                    }
                ?>
                    <form class="form-horizontal" action="save.php" method="post" enctype="multipart/form-data" >
                    <center>
                        <label for="archivo">Seleccione la Póliza pdf a cargar</label>
                        <input type="file" class="form-control-file" id="archivo" name="archivo" accept="application/pdf" required>
                        <button class="btn btn-success btn-round">Subir Archivo</button>
                        <input type="text" class="form-control" name="id_poliza" value="<?php echo $poliza[0]['id_poliza'];?>" hidden>
                        </center>
                    </form>
                <?php
                    
            ftp_close($con_id);
    }

}
                    
            */
                    
                ?>

                

                
                
    
   

                
                
                <?php 
                    if ($poliza[0]['nombre_t']=='PENDIENTE') {
                ?>  
                        <center><a  href="cargar_pp.php?id_poliza=<?php echo $poliza[0]['id_poliza'];?>"" data-tooltip="tooltip" data-placement="top" title="Cargar Póliza Pendiente" class="btn btn-success btn-lg">Cargar Póliza Pendiente  &nbsp;<i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></center>
                <?php } ?>
                

                <div class="col-md-auto col-md-offset-2">
                    <h1 class="title">Cliente: <?php 
                    if ($poliza[0]['nombre_t']=='PENDIENTE') {
                        $ob1= new Trabajo();
                        $asegurado = $ob1->get_element_by_id('titular_pre_poliza','id_poliza',$poliza[0]['id_poliza']); 
                        
                        $nombre=$asegurado[0]['asegurado'];
                    } else {
                        $nombre=$poliza[0]['nombre_t']." ".$poliza[0]['apellido_t'];
                    }
                    
                    
                    echo utf8_encode($nombre); ?></h1>
                    <h2 class="title">Póliza N°: <?php echo $poliza[0]['cod_poliza']; ?></h2>  
                    <?php 
                        if (isset($poliza[0]['idnom'])==null) {
                            $asesorr=$poliza[0]['cod']." -> ".$poliza[0]['nombre'];
                        }else{$asesorr=$poliza[0]['cod']." -> ".$poliza[0]['idnom'];}
                    ?>
                    <h3 class="title">Asesor: <?php echo utf8_encode($asesorr); ?></h3> 
                </div>
                

                <div class="table-responsive">
                <table class="table table-hover table-striped table-bordered" id="iddatatable" >
                    <thead style="background-color: #00bcd4;color: white; font-weight: bold;">
                        <tr>
                            <th>N° de Póliza</th>
                            <th>Status</th>
                            <th>Fecha Desde Seguro</th>
                            <th>Fecha Hasta Seguro</th>
                            <th>Tipo de Póliza</th>
                        </tr>
                    </thead>

                    <tbody >
                        <?php

                            $originalDesdeP = $poliza[0]['f_desdepoliza'];
                            $newDesdeP = date("d/m/Y", strtotime($originalDesdeP));
                            $originalHastaP = $poliza[0]['f_hastapoliza'];
                            $newHastaP = date("d/m/Y", strtotime($originalHastaP));

                            ?>
                            <tr >
                                <td><?php echo $poliza[0]['cod_poliza']; ?></td>
                                <?php   if ($poliza[0]['f_hastapoliza'] >= date("Y-m-d")) {
                                ?>
                                <td class="btn-success"><?php echo "Activa"; ?></td>
                                <?php            
                                        } else{
                                ?>
                                <td class="btn-danger"><?php echo "Inactiva"; ?></td>
                                <?php
                                        }
                                ?>
                                <td><?php echo $newDesdeP; ?></td>
                                <td><?php echo $newHastaP; ?></td>
                                <td><?php echo utf8_encode($poliza[0]['tipo_poliza']); ?></td>
                            </tr>
                    </tbody>
                </table>
                </div>
                
                <div class="table-responsive">
                <table class="table table-hover table-striped table-bordered" id="iddatatable" >
                    <thead style="background-color: #00bcd4;color: white; font-weight: bold;">
                        <tr>
                            <th>Ramo</th>
                            <th>Compañía</th>
                            <th>Suma Asegurada</th>
                            <th style="background-color: #E54848;">Prima Suscrita</th>
                            <th>Forma de Pago</th>
                            <th>Tipo de Cuenta</th>
                        </tr>
                    </thead>

                    <tbody >
                            <tr >
                                <td><?php echo utf8_encode($poliza[0]['nramo']); ?></td>
                                <td><?php echo ($poliza[0]['nomcia']); ?></td>
                                <td><?php echo $currency.number_format($poliza[0]['sumaasegurada'],2); ?></td>
                                <td><?php echo $currency.number_format($poliza[0]['prima'],2); ?></td>
                                <td><?php echo $poliza[0]['fpago']; ?></td>
                                <td><?php 
                                if ($poliza[0]['t_cuenta']==1) {
                                    echo "Individual";
                                } else {
                                    echo "Colectiva";
                                }
                                
                                ?></td>
                            </tr>
                    </tbody>
                </table>
                </div>

                <div class="table-responsive">
                <table class="table table-hover table-striped table-bordered" id="iddatatable" >
                    <thead style="background-color: #00bcd4;color: white; font-weight: bold;">
                        <tr>
                            <th>N° Recibo</th>
                            <th>Fecha Desde Recibo</th>
                            <th>Fecha Hasta Recibo</th>
                            <th>Zona de Produc</th>
                            <th>N° de Cuotas</th>
                            <th>Monto Cuotas</th>
                        </tr>
                    </thead>

                    <tbody >
                        <?php

                            $originalDesdeR = $poliza[0]['f_desderecibo'];
                            $newDesdeR = date("d/m/Y", strtotime($originalDesdeR));
                            $originalHastaR = $poliza[0]['f_hastarecibo'];
                            $newHastaR = date("d/m/Y", strtotime($originalHastaR));

                            if ($poliza[0]['id_zproduccion']==1) {
                                $z_produc="PANAMÁ";
                            }
                            if ($poliza[0]['id_zproduccion']==2) {
                                $z_produc="CARACAS";
                            }
                            ?>
                            <tr >
                                <td><?php echo $poliza[0]['cod_recibo']; ?></td>
                                <td><?php echo $newDesdeR; ?></td>
                                <td><?php echo $newHastaR; ?></td>
                                <td><?php echo $z_produc; ?></td>
                                <td><?php echo $poliza[0]['ncuotas']; ?></td>
                                <td><?php echo $currency.number_format($poliza[0]['montocuotas'],2); ?></td>
                            </tr>
                    </tbody>
                </table>
                </div>

                <div class="table-responsive">
                <table class="table table-hover table-striped table-bordered" id="iddatatable" >
                    <thead style="background-color: #00bcd4;color: white; font-weight: bold;">
                        <tr>
                            <th>Observaciones</th>
                        </tr>
                    </thead>
                    <tbody >
                        <tr >
                            <td><?php echo $poliza[0]['obs_p']; ?></td>
                        </tr>
                    </tbody>
                </table>
                </div>


<!-- -----------------SI ES PÓLIZA PENDIENTE NO MOSTRAR------------------ -->
                <?php 
                    if ($poliza[0]['nombre_t']!='PENDIENTE') {
                ?>  


                <div class="col-md-auto col-md-offset-2">
                    <h2 class="title">Datos del Titular</h2>  
                </div>

                <div class="table-responsive">
                <table class="table table-hover table-striped table-bordered" id="iddatatable" >
                    <thead style="background-color: #00bcd4;color: white; font-weight: bold;">
                        <tr>
                            <th>Cédula</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <!-- <th>Sexo</th>
                            <th>Estado Civil</th> -->
                            <th>Fecha Nacimiento</th>
                        </tr>
                    </thead>
                    <tbody >
                        <?php

                            $originalFnac = $poliza[0]['f_nac'];
                            $newFnac = date("d/m/Y", strtotime($originalFnac));
                            $sexo="JURÍDICO";
                            $ecivil="DIVORCIADO(A)";
                            if ($poliza[0]['id_sexo']==1) {
                                $sexo="MASCULINO";
                            }if ($poliza[0]['id_sexo']==2) {
                                $sexo="FEMENINO";
                            }if ($poliza[0]['id_ecivil']==1) {
                                $ecivil="SOLTERO(A)";
                            }if ($poliza[0]['id_ecivil']==2) {
                                $ecivil="CASADO(A)";
                            }if ($poliza[0]['id_ecivil']==3) {
                                $ecivil="JURÍDICO";
                            }

                            ?>
                            <tr >
                                <td><?php echo $poliza[0]['ci']; ?></td>
                                <td><?php echo utf8_encode($poliza[0]['nombre_t']); ?></td>
                                <td><?php echo utf8_encode($poliza[0]['apellido_t']); ?></td>
                                <!-- <td><?php echo $sexo; ?></td>
                                <td><?php echo $ecivil; ?></td> -->
                                <td><?php echo $newFnac; ?></td>
                            </tr>
                    </tbody>
                </table>
                </div>

                <div class="table-responsive">
                <table class="table table-hover table-striped table-bordered" id="iddatatable" style="display: table">
                    <thead style="background-color: #00bcd4;color: white; font-weight: bold;">
                        <tr>
                            <th>Celular</th>
                            <th>Teléfono</th>
                            <!-- <th>Teléfono 1</th> -->
                            <th>email</th>
                            <!-- <th>email1</th> -->
                        </tr>
                    </thead>
                    <tbody >
                            <tr >
                                <td><?php echo $poliza[0]['cell']; ?></td>
                                <td><?php echo $poliza[0]['telf']; ?></td>
                                <!-- <td><?php echo $poliza[0]['telf1']; ?></td> -->
                                <td><?php echo $poliza[0]['email']; ?></td>
                                <!-- <td><?php echo $poliza[0]['email1']; ?></td> -->
                            </tr>
                    </tbody>
                </table>
                </div>

                <div class="table-responsive">
                <table class="table table-hover table-striped table-bordered" id="iddatatable" style="display: table">
                    <thead style="background-color: #00bcd4;color: white; font-weight: bold;">
                        <tr>
                            <th>Dirección</th>
                        </tr>
                    </thead>
                    <tbody >
                            <tr >
                                <td><?php echo utf8_encode($poliza[0]['direcc']); ?></td>
                            </tr>
                    </tbody>
                </table>
                </div>
                <!-- <table class="table table-hover table-striped table-bordered display table-responsive nowrap" id="iddatatable" >
                    <thead style="background-color: #00bcd4;color: white; font-weight: bold;">
                        <tr>
                            <th>Dirección 2</th>
                        </tr>
                    </thead>
                    <tbody >
                            <tr >
                                <td><?php echo $poliza[0]['direcc1']; ?></td>
                            </tr>
                    </tbody>
                </table> -->




                <div class="col-md-auto col-md-offset-2">
                    <h2 class="title">Datos del Tomador</h2>  
                </div>


                <div class="table-responsive">
                <table class="table table-hover table-striped table-bordered" id="iddatatable" style="display: table">
                    <thead style="background-color: #00bcd4;color: white; font-weight: bold;">
                        <tr>
                            <th>Cédula</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                        </tr>
                    </thead>
                    <tbody >
                            <tr >
                                <td><?php echo $tomador[0]['ci']; ?></td>
                                <td><?php echo utf8_encode($tomador[0]['nombre_t']); ?></td>
                                <td><?php echo utf8_encode($tomador[0]['apellido_t']); ?></td>
                            </tr>
                    </tbody>
                </table>
                </div>

                <?php
                if ($poliza[0]['cod_ramo']==2 || $poliza[0]['cod_ramo']==25) {
                ?>
                
                <div id="tablaveh" >      

                    <div class="col-md-auto col-md-offset-2">
                        <h2 class="title">Datos del Vehículo</h2>  
                    </div>

                    
                    <div class="table-responsive">
                    <table class="table table-hover table-striped table-bordered" id="idtablaveh" >
                        <thead style="background-color: #00bcd4;color: white; font-weight: bold;">
                            <tr>
                                <th>Placa</th>
                                <th>Marca</th>
                                <th>Modelo</th>
                                <th>Tipo</th>
                                <th>Año</th>
                            </tr>
                        </thead>

                        <tbody >
                            <div class="form-group col-md-12">
                            <tr>
                                <td><?php echo $vehiculo[0]['placa']; ?></td>
                                <td><?php echo $vehiculo[0]['marca']; ?></td>
                                <td><?php echo $vehiculo[0]['mveh']; ?></td>
                                <td><?php echo $vehiculo[0]['tveh']; ?></td>
                                <td><?php echo $vehiculo[0]['f_veh']; ?></td>
                            </tr>
                            </div>
                        </tbody>
                    </table>
                    </div>
                </div>

                <?php 
                }
                ?>
                

                




                <div class="col-md-auto col-md-offset-2">
                    <h2 class="title">Datos del Asesor</h2>  
                </div>


                <div class="table-responsive">
                <table class="table table-hover table-striped table-bordered" id="iddatatable" style="display: table">
                    <thead style="background-color: #00bcd4;color: white; font-weight: bold;">
                        <tr>
                            <th>Código Asesor</th>
                            <th>Cédula</th>
                            <th>Nombre</th>
                            <th>GC Póliza</th>
                        </tr>
                    </thead>
                    <tbody >
                            <tr >
                                <td><?php echo $poliza[0]['cod']; ?></td>
                                <td><?php echo $poliza[0]['id']; ?></td>
                                <td><?php 
                                    if (isset($poliza[0]['idnom'])==null) {
                                        echo utf8_encode($poliza[0]['nombre']);
                                    }else{echo utf8_encode($poliza[0]['idnom']);}
                                ?></td>
                                <td><?php echo $poliza[0]['per_gc']." %"; ?></td>
                            </tr>
                            <?php if ($cia_pref[0]['per_gc_sum']!=null && $ramo!=35) { ?>
                            <tr style="background-color: #00bcd4;color: white; font-weight: bold;">
                                <th>Cía Preferencial</th>
                                <th colspan="2">% GC Base Asesor</th>
                                <th>% GC Preferencial</th>
                            </tr>
                            <tr >
                                <td><?php echo 'Sí' ?></td>
                                <td colspan="2"><?php echo $poliza[0]['nopre1']." %"; ?></td>
                                <td><?php echo $cia_pref[0]['per_gc_sum']." %"; ?></td>
                            </tr>
                            <?php } ?>
                    </tbody>
                </table>
                </div>


                <div class="col-md-auto col-md-offset-2">
                    <h2 class="title">Usuario que Generó la Póliza</h2>  
                </div>


                <div class="table-responsive">
                <table class="table table-hover table-striped table-bordered" id="iddatatable" style="display: table">
                    <thead style="background-color: #00bcd4;color: white; font-weight: bold;">
                        <tr>
                            <th>Nombre Usuario</th>
                            <th>Fecha Creación</th>
                            <th>Fecha y Hora Creación</th>
                        </tr>
                    </thead>
                    <tbody >
                            <tr >
                                <?php 
                                    $originalDesdeP = $poliza[0]['created_at'];
                                    $newCreated = date("d/m/Y", strtotime($originalDesdeP));
                                    $newCreatedH = date("h:i:s a", strtotime($originalDesdeP));
                                ?>
                                <td><?php echo $usuario[0]['nombre_usuario']." ".$usuario[0]['apellido_usuario']; ?></td>
                                <td><?php echo $newCreacion; ?></td>
                                <td><?php echo $newCreated." ".$newCreatedH; ?></td>
                            </tr>
                    </tbody>
                </table>
                </div>



                <hr>
                <center>
                <a href="" data-tooltip="tooltip" data-placement="top" title="Ver Pagos" class="btn btn-info btn-lg" data-toggle="modal" data-target="#pagos">Pagos  &nbsp;<i class="fa fa-money" aria-hidden="true"></i></a>

                <?php 
                    if ($poliza[0]['nombre_t']=='PENDIENTE') {
                    }else {
                ?>  
                    <a  href="e_poliza.php?id_poliza=<?php echo $poliza[0]['id_poliza'];?>"" data-tooltip="tooltip" data-placement="top" title="Editar" class="btn btn-success btn-lg">Editar Póliza  &nbsp;<i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                <?php
                } ?>

                
                
                
                <?php 
                    if ($permiso==1) {
                ?>
                <button  onclick="eliminarDatos('<?php echo $poliza[0]['id_poliza']; ?>')" data-tooltip="tooltip" data-placement="top" title="Eliminar" class="btn btn-danger btn-lg">Eliminar Póliza  &nbsp;<i class="fa fa-trash" aria-hidden="true"></i></button>
                <?php   
                    }
                ?>
                </center>
                <hr>
                

                <?php } ?>


    

                
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
    <!--    Plugin for the Datepicker, full documentation here: https://github.com/Eonasdan/bootstrap-datetimepicker -->
    <script src="../assets/js/plugins/bootstrap-datetimepicker.min.js"></script>
    <!--    Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
    <script src="../assets/js/plugins/nouislider.min.js"></script>
    <!-- Material Kit Core initialisations of plugins and Bootstrap Material Design Library -->
    <script src="../assets/js/material-kit.js?v=2.0.1"></script>
    <!-- Fixed Sidebar Nav - js With initialisations For Demo Purpose, Don't Include it in your project -->
    <script src="./assets/assets-for-demo/js/material-kit-demo.js"></script>

    

    <!-- Modal -->
    <div class="modal fade" id="pagos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    
                    <h5 class="modal-title" id="exampleModalLabel">Cliente: <?php echo utf8_encode($poliza[0]['nombre_t']." ".$poliza[0]['apellido_t']); ?></h5>

                    <hr>
                    <h5 class="modal-title" id="exampleModalLabel">Póliza N°: <?php echo $poliza[0]['cod_poliza']; ?></h5>

                    <hr>
                    <h5 class="modal-title" id="exampleModalLabel">Asesor: 
                    <?php 
                        if (isset($poliza[0]['idnom'])==null) {
                            $asesorr=$poliza[0]['cod']." -> ".$poliza[0]['nombre'];
                        }else{$asesorr=$poliza[0]['cod']." -> ".$poliza[0]['idnom'];} echo utf8_encode($asesorr);
                    ?></h5>
                    <hr>
                    
                    <h5 class="modal-title" id="exampleModalLabel">Cía: <?php echo $poliza[0]['nomcia']; ?></h5>

                    <h5 class="modal-title" id="exampleModalLabel">Ramo: <?php echo utf8_encode($poliza[0]['nramo']); ?></h5>
                    <hr>

                    <h5 class="modal-title" id="exampleModalLabel">Observaciones: <?php echo $poliza[0]['obs']; ?></h5>
                    <hr>

                    <form id="frmnuevoP">
                        <table class="table table-hover table-striped table-bordered" id="iddatatable1">
                            <thead style="background-color: #00bcd4;color: white; font-weight: bold;">
                                <tr>
                                    <th>Prima Cobrada</th>
                                    <th>F Pago Prima</th>
                                    <th>Comisión Cobrada</th>
                                    <th>F Hasta Reporte</th>
                                    <th>GC Pagada</th>
                                    <th>F Pago GC</th>
                                </tr>
                            </thead>
                            <?php   
                                $obj10= new Trabajo();
                                $polizap = $obj10->get_comision_rep_com_by_id($id_poliza); 

                                $totalprimaC=0;
                                $totalcomisionC=0;
                                $totalGC=0;

                                for ($i=0; $i < sizeof($polizap); $i++) { 
                                    $totalprimaC=$totalprimaC+$polizap[$i]['prima_com'];
                                    $totalcomisionC=$totalcomisionC+$polizap[$i]['comision'];
                                    $totalGC=$totalGC+(($polizap[$i]['comision']*$polizap[$i]['per_gc'])/100);

                                    $newFPago = date("d/m/Y", strtotime($polizap[$i]['f_pago_prima']));
                                    $newFHastaR = date("d/m/Y", strtotime($polizap[$i]['f_hasta_rep']));
                                    $newFPagoGC = date("d/m/Y", strtotime($polizap[$i]['f_pago_gc']));
                                
                            ?>
                                <tr >
                                    <td align="right"><?php echo $polizap[$i]['prima_com'];?></td>
                                    <td><?php echo $newFPago;?></td>
                                    <td align="right"><?php echo $polizap[$i]['comision'];?></td>
                                    <td nowrap><?php echo $newFHastaR;?></td>
                                    <td align="right"><?php echo ($polizap[$i]['comision']*$polizap[$i]['per_gc'])/100;?></td>
                                    <td nowrap><?php echo $newFPagoGC;?></td>
                                </tr>
                            <?php
                                }
                            ?> 
                                <tr>
                                    <td style="background-color: #F53333;color: white;font-weight: bold">Prima Cobrada: <?php echo $currency.number_format($totalprimaC,2); ?></td>
                                    <td style="background-color: #F53333;color: white;font-weight: bold">Prima Suscrita: <?php echo $currency.number_format($poliza[0]['prima'],2); ?></td>
                                    <td style="background-color: #F53333;color: white;font-weight: bold">Comisión Cobrada: <?php echo $currency.number_format($totalcomisionC,2); ?></td>
                                    <td style="background-color: #F53333;color: white;font-weight: bold"></td>
                                    <td style="background-color: #F53333;color: white;font-weight: bold">GC Pagada: <?php echo $currency.number_format($totalGC,2); ?></td>
                                    <td style="background-color: #F53333;color: white;font-weight: bold"></td>
                                </tr>
                        </table>
                    </form>
                    <h2>Prima Pendiente: <?php echo $currency.number_format($poliza[0]['prima']-$totalprimaC,2); ?></h2>
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
            if (<?php echo isset($_GET['pagos']); ?> == 1) {
                $('#pagos').modal('show'); 
            }



            $('#btnAgregarnuevo').click(function(){
                datos=$('#frmnuevo').serialize();

                $.ajax({
                    type:"POST",
                    data:datos,
                    url:"../procesos/agregarAsesor.php",
                    success:function(r){
                        if(r==1){
                            $('#frmnuevo')[0].reset();
                            $('#tablaDatatable').load('t_poliza.php');
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
                            $('#tablaDatatable').load('t_poliza.php');
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
            $('#tablaDatatable').load('t_poliza.php');
            $('.alertify .ajs-header').css('background-color', 'red');
        });
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

        function eliminarDatos(idpoliza){
            alertify.confirm('Eliminar una Póliza', '¿Seguro de eliminar esta Póliza?', function(){
                $('.alertify .ajs-header').css('background-color', 'green');
                console.log(idpoliza);
                $.ajax({
                    type:"POST",
                    data:"idpoliza=" + idpoliza,
                    url:"../procesos/eliminarPoliza.php",
                    success:function(r){
                        if(r==1){
                            alertify.alert('Eliminada con exito !', 'La Póliza fue eliminada con exito', function(){
                                alertify.success('OK');
                                window.location.replace("b_poliza.php");
                            });
                        }else{
                            alertify.error("No se pudo eliminar");
                        }
                    }
                });

            }
            , function(){

            });
        }

        $(function () {
          $('[data-tooltip="tooltip"]').tooltip()
        })
    </script>

    <script type="text/javascript">
  

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