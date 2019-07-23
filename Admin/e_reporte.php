<?php 
session_start();
if(isset($_SESSION['seudonimo'])) {

  }
    else {
        header("Location: login.php");
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
        

        

        <div class="section">
            <div class="container">
                <a href="javascript:history.back(-1);" data-tooltip="tooltip" data-placement="right" title="Ir la página anterior" class="btn btn-info btn-round"><- Regresar</a>

                <div class="col-md-auto col-md-offset-2">
                    <h1 class="title">Compañía: <?php echo $cia[0]['nomcia']; ?></h1>
                </div>


                <form class="form-horizontal" id="frmnuevo" action="e_reporte_n.php" method="post" >

                <div class="table-responsive">
                <table class="table table-striped table-bordered display nowrap" id="iddatatable" >
					<thead style="background-color: #00bcd4;color: white; font-weight: bold;">
						<tr>
                            <th >Fecha Hasta Reporte</th>
                            <th >Fecha Pago GC</th>
                            <th hidden>id reporte</th>
						</tr>
					</thead>

					<tbody >
                        <tr style="background-color: white">
                            <td><div class="input-group date">
                                <input type="text" class="form-control" id="f_rep" name="f_rep"  value="<?php echo $f_hasta_rep; ?>">
                            </div></td>
                            <td><div class="input-group date">
                                <input type="text" class="form-control" id="f_pago" name="f_pago"  value="<?php echo $f_pago_gc; ?>">
                            </div></td>
                            <td hidden><input type="text" class="form-control" name="id_rep_com" value="<?php echo $id_rep_com; ?>" ></td>
                        </tr>
                    </tbody>
                </table>
                </div>

                <!--
                <div class="table-responsive">
                <table class="table table-striped table-bordered display nowrap" id="iddatatable" >

                    <thead style="background-color: #00bcd4;color: white; font-weight: bold;">
                        <tr>
                            <th>N° de Póliza</th>
                            <th nowrap>Asegurado</th>
                            <th>Fecha de Pago de la Prima</th>
                            <th style="background-color: #E54848;">Prima Sujeta a Comisión</th>
                            <th>% Comisión</th>
                            <th hidden>cant</th>
                        </tr>
                    </thead>
                    <tbody >

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

                        <tr style="background-color: white">
                            <td><input type="text" class="form-control" name="<?php echo 'n_poliza'.$i;?>" required  value="<?php echo $comision[$i]['num_poliza']; ?>"></td>
                            <td><input type="text" class="form-control" name="<?php echo 'asegurado'.$i;?>" value="<?php echo utf8_encode($nombre); ?>"></td>
                            <td><div class="input-group date">
                                <input type="text" class="form-control" id="<?php echo 'f_pago_prima'.$i;?>" name="<?php echo 'f_pago_prima'.$i;?>"  value="<?php echo $f_pago_prima; ?>">
                            </div></td>
                            <td><input type="text" class="form-control" name="<?php echo 'prima_com'.$i;?>" value="<?php echo $comision[$i]['prima_com']; ?>" ></td>
                            <td><input type="text" class="form-control" name="<?php echo 'comision'.$i;?>" value="<?php echo $comision[$i]['comision']; ?>" ></td>
                            <td hidden><input type="text" class="form-control" name="cantidad" value="<?php echo sizeof($comision); ?>" ></td>
                        </tr>

                        <?php
                        }
                        ?>

					</tbody>
				</table>
                </div>
                -->

                





                <hr>
                <button type="submit" style="width: 100%" data-tooltip="tooltip" data-placement="bottom" title="Previsualizar" class="btn btn-success btn-lg" value="">Previsualizar Edición &nbsp;<i class="fa fa-check" aria-hidden="true"></i></button>
                <hr>

                </form>
                
                
                
                




    

                
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

    <script src="../bootstrap-datepicker/js/bootstrap-datepicker.js"></script>  
    <script src="../bootstrap-datepicker/locales/bootstrap-datepicker.es.min.js" charset="UTF-8"></script>

    




<script language="javascript">

    $(document).ready(function(){
            $('#cant_poliza option:first').prop('selected',true);
            
        });


        $('#f_rep').datepicker({  
            format: "dd-mm-yyyy"
        });

        $('#f_pago').datepicker({  
            format: "dd-mm-yyyy"
        });


        var cant = <?php echo sizeof($comision);?>

        for (let index = 0; index < cant; index++) {
            
            $('#f_pago_prima'+index).datepicker({  
                format: "dd-mm-yyyy"
            });
            
        }

    function mayus(e) {
        e.value = e.value.toUpperCase();
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



</body>

</html>