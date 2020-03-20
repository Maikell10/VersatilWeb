<?php 
session_start();
if(isset($_SESSION['seudonimo'])) {

  }
    else {
        header("Location: ../sys/login.php");
        exit();
      }
      
  require_once("../class/clases.php");

  $id_rep_com = $_GET['id_rep_com'];

  $obj= new Trabajo();
  $rep_com = $obj->get_element_by_id('rep_com','id_rep_com',$id_rep_com); 

  $obj1= new Trabajo();
  $cia = $obj1->get_element_by_id('dcia','idcia',$rep_com[0]['id_cia']); 

  $obj2= new Trabajo();
  $comision = $obj2->get_element_by_id('comision','id_rep_com',$_GET['id_rep_com']);

  $f_pago_gc = date("d-m-Y", strtotime($rep_com[0]['f_pago_gc']));
  //$f_desde_rep = date("d-m-Y", strtotime($rep_com[0]['f_desde_rep']));
  $f_hasta_rep = date("d-m-Y", strtotime($rep_com[0]['f_hasta_rep']));




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
        

        

        <div class="section">
            <div class="container">


            <?php


                $id_rep_com = $id_rep_com . ".pdf";
                $archivo = './' . $id_rep_com;

  /*                            
//190.140.224.69                    
$ftp_server="186.75.241.90";
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
      
                    <a href="download.php?id_rep_com=<?= $_GET['id_rep_com'];?>" class="btn btn-white btn-round" target="_blank" style="float: right"><img src="../assets/img/pdf-logo.png" width="60" alt=""></a>
                    <br>
                <?php
                    }
                ?>
                    <form class="form-horizontal" action="save_rep.php" method="post" enctype="multipart/form-data" >
                    <center>
                        <label for="archivo">Seleccione el Reporte pdf a cargar</label>
                        <input type="file" class="form-control-file" id="archivo" name="archivo" accept="application/pdf" required>
                        <button class="btn btn-success btn-round">Subir Archivo</button>
                        <input type="text" class="form-control" name="id_rep_com" value="<?= $_GET['id_rep_com'];?>" hidden>
                        </center>
                    </form>
                <?php
                    
            ftp_close($con_id);
    }

}
     */               
            

                ?>
            
                <div class="col-md-auto col-md-offset-2">
                    <h1 class="title">Compañía: <?= $cia[0]['nomcia']; ?></h1>
                </div>

                <br>

                <hr>

                <center>

                <a  href="add/c_comision.php?id_rep=<?= $id_rep_com;?>&f_hasta=<?= $f_hasta_rep;?>&cant_poliza=1&f_pagoGc=<?= $f_pago_gc;?>&primat_com=<?= $rep_com[0]['primat_com'];?>&comt=<?= $rep_com[0]['comt'];?>&cia=<?= $rep_com[0]['id_cia'];?>&exx=1" data-toggle="tooltip" data-placement="top" title="Añadir Comisión" class="btn btn-info btn-lg text-center">Añadir Comisión  &nbsp;<i class="fa fa-plus" aria-hidden="true"></i></a>

                <a  href="e_reporte.php?id_rep_com=<?= $id_rep_com;?>" data-toggle="tooltip" data-placement="top" title="Editar Fechas y Montos Totales" class="btn btn-success btn-lg text-center">Editar Reporte  &nbsp;<i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>

                <?php if ($permiso==1) { ?>
                <button  onclick="eliminarDatos('<?= $id_rep_com; ?>')" data-toggle="tooltip" data-placement="top" title="Eliminar" class="btn btn-danger btn-lg">Eliminar Reporte  &nbsp;<i class="fa fa-trash" aria-hidden="true"></i></button>
                <?php }?>
                </center>
                        
                <hr>


                <div class="form-group">
                    <input type="text" class="form-control pull-right" style="width:20%" id="search" placeholder="Escriba para buscar">
                </div>

                <div class="table-responsive">
                <table class="table table-hover table-striped table-bordered" id="" >
                    <thead style="background-color: #00bcd4;color: white; font-weight: bold;">
                        <tr>
                            <th >Fecha Hasta Reporte</th>
                            <th >Fecha Pago GC</th>
                            <th >Prima Sujeta a Comisión Total</th>
                            <th >Comisión Total</th>
                            <th hidden>id reporte</th>
                            <th hidden>cia</th>
                            <th hidden>cant_poliza</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td ><?= $f_hasta_rep; ?></td>
                            <td ><?= $f_pago_gc; ?></td>
                            <td ><?= number_format($rep_com[0]['primat_com'],2); ?></td>
                            <td ><?= number_format($rep_com[0]['comt'],2); ?></td>
                        </tr>
                    </tbody>
                </table>
                </div>

                <center>
                <div class="table-responsive">
                <table class="table table-hover table-striped table-bordered" id="iddatatable" >
                    <thead style="background-color: #00bcd4;color: white; font-weight: bold;">
                        <tr>
                            <th hidden>id</th>
                            <th>N° de Póliza</th>
                            <th nowrap>Asegurado</th>
                            <th>Fecha de Pago de la Prima</th>
                            <th style="background-color: #E54848;">Prima Sujeta a Comisión</th>
                            <th>Comisión</th>
                            <th>% Comisión</th>
                            <th>Asesor - Ejecutivo</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $totalPrimaCom=0;
                        $totalCom=0;
                        for ($i=0; $i < sizeof($comision); $i++) { 
                            $totalPrimaCom=$totalPrimaCom+$comision[$i]['prima_com'];
                            $totalCom=$totalCom+$comision[$i]['comision'];

                            $obj11= new Trabajo();
                            $titu = $obj11->get_poliza_by_id($comision[$i]['id_poliza']);

                            $f_pago_prima = date("d-m-Y", strtotime($comision[$i]['f_pago_prima']));

                            $nombre=$titu[0]['nombre_t']." ".$titu[0]['apellido_t'];
                            if ($titu[0]['id_titular']==0) {
                                $ob11= new Trabajo();
                                $tituprep = $ob11->get_element_by_id('titular_pre_poliza','id_poliza',$comision[$i]['id_poliza']);
                                $nombre=$tituprep[0]['asegurado'];
                            }

                        ?>
                        <tr style="cursor: pointer;">
                            <td hidden><?= $comision[$i]['id_poliza']; ?></td>
                            <td><?= $comision[$i]['num_poliza']; ?></td>
                            <td nowrap><?= utf8_encode($nombre); ?></td>
                            <td><?= $f_pago_prima; ?></td>
                            <td align="right"><?= "$ ".number_format($comision[$i]['prima_com'],2); ?></td>
                            <td align="right"><?= "$ ".number_format($comision[$i]['comision'],2); ?></td>
                            <td align="center"><?= number_format(($comision[$i]['comision']*100)/$comision[$i]['prima_com'],2)." %"; ?></td>
                            <td><?= $comision[$i]['cod_vend']; ?></td>
                            <td><button  onclick="eliminarComision('<?= $comision[$i]['id_comision']; ?>')" data-tooltip="tooltip" data-placement="top" title="Eliminar" class="btn btn-danger btn-sm">&nbsp;<i class="fa fa-trash" aria-hidden="true"></i></button></td>
                        </tr>
                        <?php
                        }
                        ?>
                        
                    </tbody>

                    <tfoot>
                        <tr style="background-color: #00bcd4;color: white; font-weight: bold;">
                            <th hidden>id</th>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td align="right"><font size=4><?= "$ ".number_format($totalPrimaCom,2); ?></font></td>
                            <td align="right"><font size=4><?= "$ ".number_format($totalCom,2); ?></font></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr style="background-color: #00bcd4;color: white; font-weight: bold;">
                            <th hidden>id</th>
                            <th>N° de Póliza</th>
                            <th>Asegurado</th>
                            <th>Fecha de Pago de la Prima</th>
                            <th>Prima Sujeta a Comisión</th>
                            <th>Comisión</th>
                            <th>% Comisión</th>
                            <th>Asesor - Ejecutivo</th>
                            <th></th>
                        </tr>
                    </tfoot>
                </table>
                </div>
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
                    document.write(new Date().getFullYear());
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
    <script src="../assets/assets-for-demo/js/material-kit-demo.js"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>

    
    <script language="javascript">

        $( "#iddatatable tbody tr" ).dblclick(function() {
            var customerId = $(this).find("td").eq(0).html();   

            window.open ("v_poliza.php?id_poliza="+customerId ,'_blank');
        });


        function eliminarDatos(id_rep_com){
            alertify.confirm('Eliminar Reporte de Comisiones', '¿Seguro de eliminar este Reporte de Comisiones?', function(){
                $('.alertify .ajs-header').css('background-color', 'green');
    
                $.ajax({
                    type:"POST",
                    data:"id_rep_com=" + id_rep_com,
                    url:"../procesos/eliminarRepCom.php",
                    success:function(r){
                        if(r==1){
                            alertify.alert('Eliminado con exito !', 'El Reporte de Comisiones fue eliminado con exito', function(){
                                alertify.success('OK');
                                window.close();
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

        function eliminarComision(id_comision){
            alertify.confirm('Eliminar Comisione Seleccionada', '¿Seguro de eliminar esta Comisión?', function(){
                $('.alertify .ajs-header').css('background-color', 'green');
    
                $.ajax({
                    type:"POST",
                    data:"id_comision=" + id_comision,
                    url:"../procesos/eliminarComision.php",
                    success:function(r){
                        if(r==1){
                            alertify.alert('Eliminada con exito !', 'La Comisión fue eliminada con exito', function(){
                                alertify.success('OK');
                                location.reload();
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

    <script>
     // Write on keyup event of keyword input element
     $(document).ready(function(){
     $("#search").keyup(function(){
     _this = this;
     // Show only matching TR, hide rest of them
     $.each($("#iddatatable tbody tr"), function() {
     if($(this).text().toLowerCase().indexOf($(_this).val().toLowerCase()) === -1)
     $(this).hide();
     else
     $(this).show();
     });
     });
    });
    </script>
    


</body>

</html>