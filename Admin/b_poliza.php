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
    $fechaMin = $obj2->get_fecha_min('f_desdepoliza','poliza'); 


    $obj3= new Trabajo();
    $fechaMax = $obj3->get_fecha_max('f_desdepoliza','poliza');

    //FECHA MAYORES A 2024
    $dateString = $fechaMax[0]["MAX(f_desdepoliza)"];
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
  $poliza = $obj1->get_poliza_total_by_asesor_ena(); 

  $obj3= new Trabajo();
  $poliza1 = $obj3->get_poliza_total_by_asesor_enp(); 

  $obj4= new Trabajo();
  $poliza2 = $obj4->get_poliza_total_by_asesor_enr(); 

  $obj1= new Trabajo();
  $cia = $obj1->get_distinct_element('nomcia','dcia'); 
  


  $dest= new Trabajo();
  $dest = $dest->destruir(); 

  $fhoy=date("Y");




?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php require('header.php');?>


    <script type="text/javascript">
        $(document).ready(function() {
            $('#example').DataTable();
        } );
    </script>
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
                        <?php if ($permiso!=3) { ?>
                        <a href="add/crear_poliza.php" class="btn btn-info pull-right menu"><i class="fa fa-plus-circle" aria-hidden="true"></i>&nbsp;&nbsp;Nueva Póliza</a>
                        <?php } ?>
                    </h1>  
                </div>
                <br><br>

                <?php if (isset($_GET['m'])==2) {?>
  
                <div class="alert alert-danger" role="alert">
                    No existen datos para la búsqueda seleccionada!
                </div>
                
                <?php } ?>
                <?php if ($permiso!=3) { ?>

                <center><form class="form-horizontal" action="b_poliza1.php" method="get" style="width: 80%">
                    <div class="form-row" style="text-align: left;">
                      
                      <div class="form-group col-md-6">
                        <label align="left">Año Vigencia Desde Seguro:</label>
                        <select class="form-control selectpicker" name="anio[]" id="anio" multiple data-style="btn-white" data-size="13" data-header="Seleccione Año" data-actions-box="true" data-live-search="true">
                        <?php
                            $date=date('Y', strtotime($fechaMin[0]["MIN(f_desdepoliza)"]));
                            for($i=date('Y', strtotime($fechaMin[0]["MIN(f_desdepoliza)"])); $i <= $fechaMax; $i++)
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
                        <label>Mes Vigencia Desde Seguro:</label>
                        <select class="form-control selectpicker" name="mes[]" id="mes" multiple data-style="btn-white" data-header="Seleccione Mes" data-actions-box="true" data-live-search="true">
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
                        <label>Cía:</label>
                        <select class="form-control selectpicker" name="cia[]" multiple data-style="btn-white" data-header="Seleccione Cía" data-actions-box="true" data-live-search="true">
                        <?php
                            for($i=0;$i<sizeof($cia);$i++)
                            {  
                        ?>
                            <option value="<?php echo $cia[$i]["nomcia"];?>"><?php echo ($cia[$i]["nomcia"]);?></option>
                        <?php
                            } 
                        ?> 
                        </select>
                      </div>

                      <div class="form-group col-md-6">
                        <label>Asesor:</label>
                        <select class="form-control selectpicker" name="asesor[]" multiple data-style="btn-white" data-header="Seleccione el Asesor" data-size="12" data-actions-box="true" data-live-search="true">
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
            </div>

            <div class="container-fluid" id="tablaP" hidden>
                

                <center><a  class="btn btn-success" onclick="tableToExcel('Exportar_a_Excel', 'Listado de Pólizas')" data-toggle="tooltip" data-placement="right" title="Exportar a Excel"><img src="../assets/img/excel.png" width="60" alt=""></a></center>

                <center>
                <div class="table-responsive" >
                    <table class="table table-hover table-striped table-bordered text-left" id="iddatatable">
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
                                <th >Nombre Titular</th>
                                <th>PDF</th>
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
                                
                                    
                                    <td><?php echo utf8_encode($poliza[$i]['idnom']); ?></td>
                                    <td><?php echo ($poliza[$i]['nomcia']); ?></td>
                                    <td><?php echo $newDesde; ?></td>
                                    <td><?php echo $newHasta; ?></td>
                                    <td><?php echo $currency.number_format($poliza[$i]['prima'],2); ?></td>
                                    <td nowrap><?php echo utf8_encode($nombre); ?></td>
                                    <td>
                                        <?php 
                                            if ($poliza[$i]['pdf']==1) {
                                                
                                        ?>
                                        <a href="download.php?id_poliza=<?php echo $poliza[$i]['id_poliza'];?>" class="btn btn-white btn-round btn-sm" target="_blank" style="float: right"><img src="../assets/img/pdf-logo.png" width="30" id="pdf"></a>
                                        <?php 
                                            } else {}
                                        ?>
                                    </td>
                                </tr>
                                <?php
                                //}
                            }
                            ?>
                            <?php
                            //asesor enp
                            for ($i=0; $i < sizeof($poliza1); $i++) { 
                                
                                $totalsuma=$totalsuma+$poliza1[$i]['sumaasegurada'];
                                $totalprima=$totalprima+$poliza1[$i]['prima'];

                                $originalDesde = $poliza1[$i]['f_desdepoliza'];
                                $newDesde = date("d/m/Y", strtotime($originalDesde));
                                $originalHasta = $poliza1[$i]['f_hastapoliza'];
                                $newHasta = date("d/m/Y", strtotime($originalHasta));

                                $originalFProd = $poliza1[$i]['f_poliza'];
                                $newFProd = date("d/m/Y", strtotime($originalFProd));

                                if ($poliza1[$i]['currency']==1) {
                                    $currency="$ ";
                                }else{$currency="Bs ";}


                                if ($poliza1[$i]['f_hastapoliza'] >= date("Y-m-d")) {
                                ?>
                                <tr style="cursor: pointer;">
                                    <td hidden><?php echo $poliza1[$i]['f_poliza']; ?></td>
                                    <td hidden><?php echo $poliza1[$i]['id_poliza']; ?></td>
                                    <td style="color: #2B9E34;font-weight: bold"><?php echo $poliza1[$i]['cod_poliza']; ?></td>
                                <?php            
                                } else{
                                ?>
                                <tr style="cursor: pointer;">
                                    <td hidden><?php echo $poliza1[$i]['f_poliza']; ?></td>
                                    <td hidden><?php echo $poliza1[$i]['id_poliza']; ?></td>
                                    <td style="color: #E54848;font-weight: bold"><?php echo $poliza1[$i]['cod_poliza']; ?></td>
                                <?php   
                                }

                                $nombre=$poliza1[$i]['nombre_t']." ".$poliza1[$i]['apellido_t'];
                                ?>
                                
                                    
                                    <td><?php echo utf8_encode($poliza1[$i]['nombre']); ?></td>
                                    <td><?php echo ($poliza1[$i]['nomcia']); ?></td>
                                    <td><?php echo $newDesde; ?></td>
                                    <td><?php echo $newHasta; ?></td>
                                    <td><?php echo $currency.number_format($poliza1[$i]['prima'],2); ?></td>
                                    <td nowrap><?php echo utf8_encode($nombre); ?></td>
                                    <td>
                                        <?php 
                                            if ($poliza1[$i]['pdf']==1) {
                                                
                                        ?>
                                        <a href="download.php?id_poliza=<?php echo $poliza1[$i]['id_poliza'];?>" class="btn btn-white btn-round btn-sm" target="_blank" style="float: right"><img src="../assets/img/pdf-logo.png" width="30" id="pdf"></a>
                                        <?php 
                                            } else {}
                                        ?>
                                    </td>
                                </tr>
                                <?php
                                //}
                            }
                            ?>
                            <?php
                            //asesor enr
                            for ($i=0; $i < sizeof($poliza2); $i++) { 
                                
                                $totalsuma=$totalsuma+$poliza2[$i]['sumaasegurada'];
                                $totalprima=$totalprima+$poliza2[$i]['prima'];

                                $originalDesde = $poliza2[$i]['f_desdepoliza'];
                                $newDesde = date("d/m/Y", strtotime($originalDesde));
                                $originalHasta = $poliza2[$i]['f_hastapoliza'];
                                $newHasta = date("d/m/Y", strtotime($originalHasta));

                                $originalFProd = $poliza2[$i]['f_poliza'];
                                $newFProd = date("d/m/Y", strtotime($originalFProd));

                                if ($poliza2[$i]['currency']==1) {
                                    $currency="$ ";
                                }else{$currency="Bs ";}


                                if ($poliza2[$i]['f_hastapoliza'] >= date("Y-m-d")) {
                                ?>
                                <tr style="cursor: pointer;">
                                    <td hidden><?php echo $poliza2[$i]['f_poliza']; ?></td>
                                    <td hidden><?php echo $poliza2[$i]['id_poliza']; ?></td>
                                    <td style="color: #2B9E34;font-weight: bold"><?php echo $poliza2[$i]['cod_poliza']; ?></td>
                                <?php            
                                } else{
                                ?>
                                <tr style="cursor: pointer;">
                                    <td hidden><?php echo $poliza2[$i]['f_poliza']; ?></td>
                                    <td hidden><?php echo $poliza2[$i]['id_poliza']; ?></td>
                                    <td style="color: #E54848;font-weight: bold"><?php echo $poliza2[$i]['cod_poliza']; ?></td>
                                <?php   
                                }

                                $nombre=$poliza2[$i]['nombre_t']." ".$poliza2[$i]['apellido_t'];
                                ?>
                                
                                    
                                    <td><?php echo utf8_encode($poliza2[$i]['nombre']); ?></td>
                                    <td><?php echo ($poliza2[$i]['nomcia']); ?></td>
                                    <td><?php echo $newDesde; ?></td>
                                    <td><?php echo $newHasta; ?></td>
                                    <td><?php echo $currency.number_format($poliza2[$i]['prima'],2); ?></td>
                                    <td nowrap><?php echo utf8_encode($nombre); ?></td>
                                    <td>
                                        <?php 
                                            if ($poliza2[$i]['pdf']==1) {
                                        ?>
                                        <a href="download.php?id_poliza=<?php echo $poliza2[0]['id_poliza'];?>" class="btn btn-white btn-round btn-sm" target="_blank" style="float: right"><img src="../assets/img/pdf-logo.png" width="30" id="pdf"></a>
                                        <?php 
                                            } else {}
                                        ?>
                                    </td>
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
                                <th>PDF</th>
                            </tr>
                        </tfoot>
                    </table>
                    </div>


                    <h1 class="title">Total de Prima Suscrita</h1>
                    <h1 class="title text-danger">$ <?php  echo number_format($totalprima,2);?></h1>

                    <h1 class="title">Total de Pólizas</h1>
                    <h1 class="title text-danger"><?php  echo sizeof($poliza)+sizeof($poliza1)+sizeof($poliza2);?></h1>

                </center>



                <table class="table table-hover table-striped table-bordered" id="Exportar_a_Excel" hidden>
                        <thead style="background-color: #00bcd4;color: white; font-weight: bold;">
                            <tr>
                                <th>N° Póliza</th>
                                <th>Nombre Asesor</th>
                                <th>Cía</th>
                                <th>F Desde Seguro</th>
                                <th>F Hasta Seguro</th>
                                <th style="background-color: #E54848;">Prima Suscrita</th>
                                <th nowrap>Nombre Titular</th>
                                <th>PDF</th>
                            </tr>
                        </thead>
                        
                        <tbody >
                            <?php
                            $totalsuma=0;
                            $totalprima=0;
                            $currency="";
                            for ($i=0; $i < sizeof($poliza); $i++) { 
                             
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
                                    <td style="color: #2B9E34;font-weight: bold"><?php echo $poliza[$i]['cod_poliza']; ?></td>
                                <?php            
                                } else{
                                ?>
                                <tr style="cursor: pointer;">
                                    <td style="color: #E54848;font-weight: bold"><?php echo $poliza[$i]['cod_poliza']; ?></td>
                                <?php   
                                }

                                $nombre=$poliza[$i]['nombre_t']." ".$poliza[$i]['apellido_t'];
                                ?>
                                
                                    
                                    <td><?php echo utf8_encode($poliza[$i]['idnom']); ?></td>
                                    <td><?php echo ($poliza[$i]['nomcia']); ?></td>
                                    <td><?php echo $newDesde; ?></td>
                                    <td><?php echo $newHasta; ?></td>
                                    <td><?php echo $currency.number_format($poliza[$i]['prima'],2); ?></td>
                                    <td nowrap><?php echo utf8_encode($nombre); ?></td>
                                    <td>
                                        <?php 
                                            if ($poliza[$i]['pdf']==1) {
                                        ?>
                                        <a href="download.php?id_poliza=<?php echo $poliza[0]['id_poliza'];?>" class="btn btn-white btn-round btn-sm" target="_blank" style="float: right"><img src="../assets/img/pdf-logo.png" width="30" id="pdf"></a>
                                        <?php 
                                            } else {
                                                echo 'No';
                                            }
                                        ?>
                                    </td>
                                </tr>
                                <?php
                                //}
                            }
                            ?>
                            <?php
                            //asesor enp
                            for ($i=0; $i < sizeof($poliza1); $i++) { 
                                
                                $totalsuma=$totalsuma+$poliza1[$i]['sumaasegurada'];
                                $totalprima=$totalprima+$poliza1[$i]['prima'];

                                $originalDesde = $poliza1[$i]['f_desdepoliza'];
                                $newDesde = date("d/m/Y", strtotime($originalDesde));
                                $originalHasta = $poliza1[$i]['f_hastapoliza'];
                                $newHasta = date("d/m/Y", strtotime($originalHasta));

                                $originalFProd = $poliza1[$i]['f_poliza'];
                                $newFProd = date("d/m/Y", strtotime($originalFProd));

                                if ($poliza1[$i]['currency']==1) {
                                    $currency="$ ";
                                }else{$currency="Bs ";}


                                if ($poliza1[$i]['f_hastapoliza'] >= date("Y-m-d")) {
                                ?>
                                <tr style="cursor: pointer;">
                                    <td style="color: #2B9E34;font-weight: bold"><?php echo $poliza1[$i]['cod_poliza']; ?></td>
                                <?php            
                                } else{
                                ?>
                                <tr style="cursor: pointer;">
                                    <td style="color: #E54848;font-weight: bold"><?php echo $poliza1[$i]['cod_poliza']; ?></td>
                                <?php   
                                }

                                $nombre=$poliza1[$i]['nombre_t']." ".$poliza1[$i]['apellido_t'];
                                ?>
                                
                                    
                                    <td><?php echo utf8_encode($poliza1[$i]['nombre']); ?></td>
                                    <td><?php echo ($poliza1[$i]['nomcia']); ?></td>
                                    <td><?php echo $newDesde; ?></td>
                                    <td><?php echo $newHasta; ?></td>
                                    <td><?php echo $currency.number_format($poliza1[$i]['prima'],2); ?></td>
                                    <td nowrap><?php echo utf8_encode($nombre); ?></td>
                                    <td>
                                        <?php 
                                            if ($poliza[$i]['pdf']==1) {
                                        ?>
                                        <a href="download.php?id_poliza=<?php echo $poliza[0]['id_poliza'];?>" class="btn btn-white btn-round btn-sm" target="_blank" style="float: right"><img src="../assets/img/pdf-logo.png" width="30" id="pdf"></a>
                                        <?php 
                                            } else {
                                                echo 'No';
                                            }
                                        ?>
                                    </td>
                                </tr>
                                <?php
                                //}
                            }
                            ?>
                            <?php
                            //asesor enr
                            for ($i=0; $i < sizeof($poliza2); $i++) { 
                                
                                $totalsuma=$totalsuma+$poliza2[$i]['sumaasegurada'];
                                $totalprima=$totalprima+$poliza2[$i]['prima'];

                                $originalDesde = $poliza2[$i]['f_desdepoliza'];
                                $newDesde = date("d/m/Y", strtotime($originalDesde));
                                $originalHasta = $poliza2[$i]['f_hastapoliza'];
                                $newHasta = date("d/m/Y", strtotime($originalHasta));

                                $originalFProd = $poliza2[$i]['f_poliza'];
                                $newFProd = date("d/m/Y", strtotime($originalFProd));

                                if ($poliza2[$i]['currency']==1) {
                                    $currency="$ ";
                                }else{$currency="Bs ";}


                                if ($poliza2[$i]['f_hastapoliza'] >= date("Y-m-d")) {
                                ?>
                                <tr style="cursor: pointer;">
                                    <td style="color: #2B9E34;font-weight: bold"><?php echo $poliza2[$i]['cod_poliza']; ?></td>
                                <?php            
                                } else{
                                ?>
                                <tr style="cursor: pointer;">
                                    <td style="color: #E54848;font-weight: bold"><?php echo $poliza2[$i]['cod_poliza']; ?></td>
                                <?php   
                                }

                                $nombre=$poliza2[$i]['nombre_t']." ".$poliza2[$i]['apellido_t'];
                                ?>
                                
                                    
                                    <td><?php echo utf8_encode($poliza2[$i]['nombre']); ?></td>
                                    <td><?php echo ($poliza2[$i]['nomcia']); ?></td>
                                    <td><?php echo $newDesde; ?></td>
                                    <td><?php echo $newHasta; ?></td>
                                    <td><?php echo $currency.number_format($poliza2[$i]['prima'],2); ?></td>
                                    <td nowrap><?php echo utf8_encode($nombre); ?></td>
                                    <td>
                                        <?php 
                                            if ($poliza[$i]['pdf']==1) {
                                        ?>
                                        <a href="download.php?id_poliza=<?php echo $poliza[0]['id_poliza'];?>" class="btn btn-white btn-round btn-sm" target="_blank" style="float: right"><img src="../assets/img/pdf-logo.png" width="30" id="pdf"></a>
                                        <?php 
                                            } else {
                                                echo 'No';
                                            }
                                        ?>
                                    </td>
                                </tr>
                                <?php
                                //}
                            }
                            ?>
                        </tbody>


                        <tfoot>
                            <tr>
                                <th>N° Póliza</th>
                                <th>Nombre Asesor</th>
                                <th>Cía</th>
                                <th>F Desde Seguro</th>
                                <th>F Hasta Seguro</th>
                                <th>Prima Suscrita $<?php echo number_format($totalprima,2); ?></th>
                                <th>Nombre Titular</th>
                                <th>PDF</th>
                            </tr>
                        </tfoot>
                    </table>













<!--   TABLA PARA USUARIOS QUE SON ASESORES   -->

                    <?php }if ($permiso==3) {  $cod_asesor_user=$user[0]['cod_vend'];?>



                    
                        <center><form class="form-horizontal" action="b_poliza1.php" method="get" style="width: 80%">
                        <div class="form-row" style="text-align: left;">
                        
                        <div class="form-group col-md-6">
                            <label align="left">Año Vigencia Seguro:</label>
                            <select class="form-control selectpicker" name="anio[]" id="anio" multiple data-style="btn-white" data-size="13" data-header="Seleccione Año" data-actions-box="true" data-live-search="true">
                            <?php
                                $date=date('Y', strtotime($fechaMin[0]["MIN(f_desdepoliza)"]));
                                for($i=date('Y', strtotime($fechaMin[0]["MIN(f_desdepoliza)"])); $i <= $fechaMax; $i++)
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
                            <select class="form-control selectpicker" name="mes[]" id="mes" multiple data-style="btn-white" data-header="Seleccione Mes" data-actions-box="true" data-live-search="true">
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
                            <label>Cía:</label>
                            <select class="form-control selectpicker" name="cia[]" multiple data-style="btn-white" data-header="Seleccione Cía" data-actions-box="true" data-live-search="true">
                            <?php
                                for($i=0;$i<sizeof($cia);$i++)
                                {  
                            ?>
                                <option value="<?php echo $cia[$i]["nomcia"];?>"><?php echo ($cia[$i]["nomcia"]);?></option>
                            <?php
                                } 
                            ?> 
                            </select>
                        </div>

                        <div class="form-group col-md-6" hidden>
                            <label>Asesor:</label>
                            <select class="form-control selectpicker" name="asesor[]"  data-style="btn-white" >
                                    <option value="<?php echo $user[0]['cod_vend'];?>">d</option>
                            </select>
                        </div>
                        </div>


                        <button type="submit" class="btn btn-success btn-round btn-lg" >Buscar</button>

                    </form></center>


                    <center><a  class="btn btn-success" onclick="tableToExcel('Exportar_a_Excel', 'Listado de Pólizas')" data-toggle="tooltip" data-placement="right" title="Exportar a Excel"><img src="../assets/img/excel.png" width="60" alt=""></a></center>

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
                                $obj1= new Trabajo();
                                $poliza = $obj1->get_poliza_total_by_asesor_ena_user($cod_asesor_user); 

                                $totalsuma=0;
                                $totalprima=0;
                                $currency="";
                                for ($i=0; $i < sizeof($poliza); $i++) { 
                                    
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
                                    
                                        
                                        <td><?php echo utf8_encode($poliza[$i]['idnom']); ?></td>
                                        <td><?php echo ($poliza[$i]['nomcia']); ?></td>
                                        <td><?php echo $newDesde; ?></td>
                                        <td><?php echo $newHasta; ?></td>
                                        <td><?php echo $currency.number_format($poliza[$i]['prima'],2); ?></td>
                                        <td nowrap><?php echo utf8_encode($nombre); ?></td>
                                    </tr>
                                    <?php
                                    //}
                                }
                                ?>
                                <?php
                                //asesor enp
                                $obj1= new Trabajo();
                                $poliza1 = $obj1->get_poliza_total_by_asesor_enp_user($cod_asesor_user); 
                                for ($i=0; $i < sizeof($poliza1); $i++) { 
                                    
                                    $totalsuma=$totalsuma+$poliza1[$i]['sumaasegurada'];
                                    $totalprima=$totalprima+$poliza1[$i]['prima'];

                                    $originalDesde = $poliza1[$i]['f_desdepoliza'];
                                    $newDesde = date("d/m/Y", strtotime($originalDesde));
                                    $originalHasta = $poliza1[$i]['f_hastapoliza'];
                                    $newHasta = date("d/m/Y", strtotime($originalHasta));

                                    $originalFProd = $poliza1[$i]['f_poliza'];
                                    $newFProd = date("d/m/Y", strtotime($originalFProd));

                                    if ($poliza1[$i]['currency']==1) {
                                        $currency="$ ";
                                    }else{$currency="Bs ";}


                                    if ($poliza1[$i]['f_hastapoliza'] >= date("Y-m-d")) {
                                    ?>
                                    <tr style="cursor: pointer;">
                                        <td hidden><?php echo $poliza1[$i]['f_poliza']; ?></td>
                                        <td hidden><?php echo $poliza1[$i]['id_poliza']; ?></td>
                                        <td style="color: #2B9E34;font-weight: bold"><?php echo $poliza1[$i]['cod_poliza']; ?></td>
                                    <?php            
                                    } else{
                                    ?>
                                    <tr style="cursor: pointer;">
                                        <td hidden><?php echo $poliza1[$i]['f_poliza']; ?></td>
                                        <td hidden><?php echo $poliza1[$i]['id_poliza']; ?></td>
                                        <td style="color: #E54848;font-weight: bold"><?php echo $poliza1[$i]['cod_poliza']; ?></td>
                                    <?php   
                                    }

                                    $nombre=$poliza1[$i]['nombre_t']." ".$poliza1[$i]['apellido_t'];
                                    ?>
                                    
                                        
                                        <td><?php echo utf8_encode($poliza1[$i]['nombre']); ?></td>
                                        <td><?php echo ($poliza1[$i]['nomcia']); ?></td>
                                        <td><?php echo $newDesde; ?></td>
                                        <td><?php echo $newHasta; ?></td>
                                        <td><?php echo $currency.number_format($poliza1[$i]['prima'],2); ?></td>
                                        <td nowrap><?php echo utf8_encode($nombre); ?></td>
                                    </tr>
                                    <?php
                                    //}
                                }
                                ?>
                                <?php
                                //asesor enr
                                $obj1= new Trabajo();
                                $poliza2 = $obj1->get_poliza_total_by_asesor_enr_user($cod_asesor_user); 
                                for ($i=0; $i < sizeof($poliza2); $i++) { 
                                    
                                    $totalsuma=$totalsuma+$poliza2[$i]['sumaasegurada'];
                                    $totalprima=$totalprima+$poliza2[$i]['prima'];

                                    $originalDesde = $poliza2[$i]['f_desdepoliza'];
                                    $newDesde = date("d/m/Y", strtotime($originalDesde));
                                    $originalHasta = $poliza2[$i]['f_hastapoliza'];
                                    $newHasta = date("d/m/Y", strtotime($originalHasta));

                                    $originalFProd = $poliza2[$i]['f_poliza'];
                                    $newFProd = date("d/m/Y", strtotime($originalFProd));

                                    if ($poliza2[$i]['currency']==1) {
                                        $currency="$ ";
                                    }else{$currency="Bs ";}


                                    if ($poliza2[$i]['f_hastapoliza'] >= date("Y-m-d")) {
                                    ?>
                                    <tr style="cursor: pointer;">
                                        <td hidden><?php echo $poliza2[$i]['f_poliza']; ?></td>
                                        <td hidden><?php echo $poliza2[$i]['id_poliza']; ?></td>
                                        <td style="color: #2B9E34;font-weight: bold"><?php echo $poliza2[$i]['cod_poliza']; ?></td>
                                    <?php            
                                    } else{
                                    ?>
                                    <tr style="cursor: pointer;">
                                        <td hidden><?php echo $poliza2[$i]['f_poliza']; ?></td>
                                        <td hidden><?php echo $poliza2[$i]['id_poliza']; ?></td>
                                        <td style="color: #E54848;font-weight: bold"><?php echo $poliza2[$i]['cod_poliza']; ?></td>
                                    <?php   
                                    }

                                    $nombre=$poliza2[$i]['nombre_t']." ".$poliza2[$i]['apellido_t'];
                                    ?>
                                    
                                        
                                        <td><?php echo utf8_encode($poliza2[$i]['nombre']); ?></td>
                                        <td><?php echo ($poliza2[$i]['nomcia']); ?></td>
                                        <td><?php echo $newDesde; ?></td>
                                        <td><?php echo $newHasta; ?></td>
                                        <td><?php echo $currency.number_format($poliza2[$i]['prima'],2); ?></td>
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
                        <h1 class="title text-danger"><?php  echo sizeof($poliza)+sizeof($poliza1)+sizeof($poliza2);?></h1>

                    </center>
                        








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

    <!-- Bootstrap Select JavaScript -->
    <script src="../js/bootstrap-select.js"></script>

    

    


   
    <script type="text/javascript">
        $(document).ready(function(){
            $('#tablaDatatable').load('t_poliza.php');
        });

        const tablaLoad = document.getElementById("tablaLoad");
        const carga = document.getElementById("carga");
        //const tablaP = document.getElementById("tablaP");

        setTimeout(()=>{
            carga.className = 'd-none';
            tablaLoad.removeAttribute("hidden");
            //tablaP.removeAttribute("hidden");
        }, 1500);
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#iddatatable').DataTable({
                //scrollX: 300,
                "order": [[ 0, "desc" ]],
                "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]]
            });
            $('#tablaP').removeAttr('hidden');
        } );

        $(function () {
          $('[data-tooltip="tooltip"]').tooltip()
        });

        $( "#iddatatable tbody tr" ).dblclick(function() {
            var customerId = $(this).find("td").eq(1).html();   

            window.open ("v_poliza.php?id_poliza="+customerId ,'_blank');
            
            
        });

        $(function () {
          $('[data-tooltip="tooltip"]').tooltip()
        })
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