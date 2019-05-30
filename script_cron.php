<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />
    <link rel="stylesheet" href="assets/css/material-kit.css?v=2.0.1">
    <!-- Documentation extras -->
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="assets/assets-for-demo/demo.css" rel="stylesheet" />
    <link href="assets/assets-for-demo/vertical-nav.css" rel="stylesheet" />

 

    <style>
        .alertify .ajs-header {
            background-color:red;
        }
    </style>


</head>

<body>
<?php

  require_once("class/clases.php");
  
  $desde=date('Y')."-".date('m')."-".date('d');
  $hasta=date('Y')."-".(date('m')+1)."-".date('d');

  $cia = '';
  $asesor = '';

  $totalsuma=0;
  $totalprima=0;
  $totalpoliza=0;


  $obj1= new Trabajo();
  $distinct_c = $obj1->get_poliza_total_by_filtro_renov_distinct_ac($desde,$hasta,$cia,$asesor); 

    $fhoy=date("Y-m-d");

    ini_set( 'display_errors', 1 );
    error_reporting( E_ALL );
    $from = "info@versatilseguros.com";
    $to = "maikell.ods10@gmail.com";
    $subject = "Polizas Proximas a Vencer";
    
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= "From:" . $from;
    


    $message = "
    <html>
    
    <body >
        
     
            <div class='section'>
                <div class='container'>
                    <div class='col-md-auto col-md-offset-2' id='tablaLoad1'>
                        <h2 class='title'>Polizas proximas a vencer a partir de hoy a dentro de un mes</h2>  
                    </div>
                    
                    <center>
    
                    <table class='table table-striped ' border=1 cellspacing=0 cellpadding=2>
                        <thead style='background-color: #00bcd4;color: white; font-weight: bold;'>
                            <tr>
                                <th>Cia</th>
                                <th>Num Poliza</th>
                                <th>F Hasta Seguro</th>
                                <th>Nombre Titular</th>
                                <th>Ramo</th>
                                <th>Asesor</th>
                            </tr>
                        </thead>
                        
                        <tbody>";
                            
    
                            for ($a=0; $a < sizeof($distinct_c); $a++) { 
                                
                            
    
                            $obj2= new Trabajo();
                            $poliza = $obj2->get_poliza_total_by_filtro_renov_ac($desde,$hasta,$distinct_c[$a]['nomcia'],$asesor); 
                            
                            
                            
   
    
                          
    
                            for ($i=0; $i < sizeof($poliza); $i++) { 
                                $totalsuma=$totalsuma+$poliza[$i]['sumaasegurada'];
                                $totalprima=$totalprima+$poliza[$i]['prima'];
    
                                $newHasta = date('d/m/Y', strtotime($poliza[$i]['f_hastapoliza']));
    
    
    
                      
    
            $message .= "   <tr>
            <td> ".$distinct_c[$a]['nomcia']."</td>
            <td style='color: #2B9E34;font-weight: bold'>".$poliza[$i]['cod_poliza']."</td>";
                                         
                     
    
                                $ob2= new Trabajo();
                                $ejecutivoPoliza = $ob2->get_element_by_id('ena','cod',$poliza[$i]['codvend']); 
                                $nombre=$ejecutivoPoliza[0]['idnom'];
                                if (sizeof($ejecutivoPoliza)==null) {
                                    $ob2= new Trabajo();
                                    $ejecutivoPoliza = $ob2->get_element_by_id('enp','cod',$poliza[$i]['codvend']); 
                                    $nombre=$ejecutivoPoliza[0]['nombre'];
                                }
                                if (sizeof($ejecutivoPoliza)==null) {
                                    $ob2= new Trabajo();
                                    $ejecutivoPoliza = $ob2->get_element_by_id('enr','cod',$poliza[$i]['codvend']); 
                                    $nombre=$ejecutivoPoliza[0]['nombre'];
                                }
    
                                
                                
            $message .= "           <td>".$newHasta."</td>
                                    <td nowrap>".$poliza[$i]['nombre_t']." ".$poliza[$i]['apellido_t']."</td>
                                    <td nowrap>".$poliza[$i]['nramo']."</td>
                                    <td nowrap>".$nombre."</td>
                                </tr>";
                              
                                }
                              
            $message .= "       <tr>
                                    <td colspan='6' style='background-color: #F53333;color: white;font-weight: bold'>Total ".$distinct_c[$a]['nomcia'].": <font size=4 color='aqua'>".sizeof($poliza)."</font></td>
                                </tr>";
                          
                            $totalpoliza=$totalpoliza+sizeof($poliza);
                            }
                           
            $message .= "  </tbody>
    
    
                        <tfoot>
                            <tr>
                                <th>Cia</th>
                                <th>Num Poliza</th>
                                <th>F Hasta Seguro</th>
                                <th>Nombre Titular</th>
                                <th>Ramo</th>
                                <th>Asesor</th>
                            </tr>
                        </tfoot>
                    </table>
    
    
                    
    
                    <h1 class='title'>Total de Prima Suscrita</h1>
                    <h1 class='title text-danger'>$ ".number_format($totalprima,2)."</h1>
    
                    <h1 class='title'>Total de Polizas</h1>
                    <h1 class='title text-danger'>".$totalpoliza."</h1>
                </center>
    
    
                    
                </div>
    
            </div>
    
    
    </body>
    
    </html>";
                
    
    mail($to,$subject,$message, $headers);
    echo "The email message was sent.";
    
    

 
 
?>





<div class='section'>
                <div class='container'>
                    <div class='col-md-auto col-md-offset-2' id='tablaLoad1'>
                        <h2 class='title'>Polizas proximas a vencer a partir de hoy a dentro de un mes</h2>  
                    </div>
                    
                    <center>
    
                    <table class='table table-striped ' >
                        <thead style='background-color: #00bcd4;color: white; font-weight: bold;'>
                            <tr>
                                <th>Cia</th>
                                <th>Num Poliza</th>
                                <th>F Hasta Seguro</th>
                                <th>Nombre Titular</th>
                                <th>Ramo</th>
                                <th>Asesor</th>
                            </tr>
                        </thead>
                        
                        <tbody >
                            
    
                            <?php for ($a=0; $a < sizeof($distinct_c); $a++) { 
                                
                            
    
                            $obj2= new Trabajo();
                            $poliza = $obj2->get_poliza_total_by_filtro_renov_ac($desde,$hasta,$distinct_c[$a]['nomcia'],$asesor); 
                            
                            
            ?>                
                    
                            
    
                          
    <?php
                            for ($i=0; $i < sizeof($poliza); $i++) { 
                                $totalsuma=$totalsuma+$poliza[$i]['sumaasegurada'];
                                $totalprima=$totalprima+$poliza[$i]['prima'];
    
                                $newHasta = date('d/m/Y', strtotime($poliza[$i]['f_hastapoliza']));
    
    
    ?>
             <tr>          
            <td> <?php echo $distinct_c[$a]['nomcia'];?>  </td>
                  <td style='color: #2B9E34;font-weight: bold'><?php echo $poliza[$i]['cod_poliza'];?></td>
                                         
                     
    <?php
                                $ob2= new Trabajo();
                                $ejecutivoPoliza = $ob2->get_element_by_id('ena','cod',$poliza[$i]['codvend']); 
                                $nombre=$ejecutivoPoliza[0]['idnom'];
                                if (sizeof($ejecutivoPoliza)==null) {
                                    $ob2= new Trabajo();
                                    $ejecutivoPoliza = $ob2->get_element_by_id('enp','cod',$poliza[$i]['codvend']); 
                                    $nombre=$ejecutivoPoliza[0]['nombre'];
                                }
                                if (sizeof($ejecutivoPoliza)==null) {
                                    $ob2= new Trabajo();
                                    $ejecutivoPoliza = $ob2->get_element_by_id('enr','cod',$poliza[$i]['codvend']); 
                                    $nombre=$ejecutivoPoliza[0]['nombre'];
                                }
    
                                
               ?>                 
                  <td><?php echo $newHasta;?></td>
                                    <td nowrap><?php echo $poliza[$i]['nombre_t']." ".$poliza[$i]['apellido_t'];?></td>
                                    <td nowrap><?php echo $poliza[$i]['nramo'];?></td>
                                    <td nowrap><?php echo $nombre;?></td>
                                </tr>";
                              
                              <?php  }?> 
                              
                            <tr>
                                    <td colspan='6' style='background-color: #F53333;color: white;font-weight: bold'>Total <?php echo $distinct_c[$a]['nomcia'];?>: <font size=4 color='aqua'><?php echo sizeof($poliza);?></font></td>
                                </tr>
                          <?php
                            $totalpoliza=$totalpoliza+sizeof($poliza);
                            }?> 
                           
             </tbody>
    
    
                        <tfoot>
                            <tr>
                                <th>Cia</th>
                                <th>Num Poliza</th>
                                <th>F Hasta Seguro</th>
                                <th>Nombre Titular</th>
                                <th>Ramo</th>
                            </tr>
                        </tfoot>
                    </table>
    
    
                    
    
                    <h1 class='title'>Total de Prima Suscrita</h1>
                    <h1 class='title text-danger'>$ <?php echo number_format($totalprima,2);?>"</h1>
    
                    <h1 class='title'>Total de Polizas</h1>
                    <h1 class='title text-danger'><?php echo $totalpoliza;?></h1>
                </center>
    
    
                    
                </div>
    
            </div>


</body>

</html>