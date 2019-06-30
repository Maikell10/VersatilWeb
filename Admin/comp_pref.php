<?php 
session_start();
if(isset($_SESSION['seudonimo'])) {

  }
    else {
        header("Location: login.php");
        exit();
      }
      
  require_once("../class/clases.php");

  $nomcia=$_GET['nomcia'];

  $obj1= new Trabajo();
  $cia = $obj1->get_element_by_id('dcia','nomcia',$nomcia); 

  $obj2= new Trabajo();
  $asesor = $obj2->get_element('ena','idnom'); 

  $cant_a=sizeof($asesor);

 $cia[0]['idcia'];

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
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />
    <link rel="stylesheet" href="../assets/css/material-kit.css?v=2.0.1">
    <!-- Documentation extras -->
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="../assets/assets-for-demo/demo.css" rel="stylesheet" />
    <link href="../assets/assets-for-demo/vertical-nav.css" rel="stylesheet" />

    <link href="../bootstrap-datepicker/css/bootstrap-datepicker.css" rel="stylesheet">

    
    <!-- Alertify -->
    <link rel="stylesheet" type="text/css" href="../assets/alertify/css/alertify.css">
    <link rel="stylesheet" type="text/css" href="../assets/alertify/css/themes/bootstrap.css">
    <script src="../assets/alertify/alertify.js"></script>


    <!-- DataTables -->
    <link href="../DataTables/DataTables/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="../DataTables/DataTables/js/jquery.dataTables.min.js"></script>
    <script src="../DataTables/DataTables/js/dataTables.bootstrap4.min.js"></script>

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
                    <h1 class="title">Hacer Preferencial a la Cía <?php echo $cia[0]['nomcia']; ?></h1>  
                </div>


                <form class="form-horizontal" id="frmnuevo" action="comp_pref_n.php" method="post" onKeypress="if(event.keyCode == 13) event.returnValue = false;">
                <center><button type="submit" id="btnForm" class="btn btn-success btn-lg btn-round">Previsualizar</button></center>
                    <div class="table-responsive">   
                    <table class="table table-hover table-striped table-bordered">
                            <thead style="background-color: #00bcd4;color: white; font-weight: bold;">
                                <tr>
                                    <th>Fecha Desde Preferida *</th>
                                    <th>Fecha Hasta Preferida *</th>
                                    <th>%GC a Sumar *</th>
                                    <th hidden>nomcia</th>
                                </tr>
                            </thead>

                            <tbody >
                                <tr style="background-color: white">
                                    <td><div class="input-group date">
                                            <input  onblur="cargarFechaDesde(this)" type="text" class="form-control" id="desdeP" name="desdeP" required data-toggle="tooltip" data-placement="bottom" title="Campo Obligatorio" autocomplete="off" > 
                                        </div>
                                    </td>
                                    <td><div class="input-group date">
                                            <input type="text" class="form-control" id="hastaP" name="hastaP" required data-toggle="tooltip" data-placement="bottom" title="Campo Obligatorio" autocomplete="off">
                                        </div>
                                    </td>
                                    <td><input onblur="cargarGC(<?php echo $cant_a;?>);" type="text" class="form-control validanumericos" id="per_gc" name="per_gc" required data-toggle="tooltip" data-placement="bottom" title="Campo Obligatorio [Sólo introducir números]"></td>
                                    <td hidden><input type="text" class="form-control" id="nomcia" name="nomcia" value="<?php echo $cia[0]['nomcia']; ?>"></td>
                                </tr>
                            </tbody>
                        </table>

                        <table class="table table-hover table-striped table-bordered" id="iddatatable" >
                            <thead style="background-color: #00bcd4;color: white; font-weight: bold;">
                                <tr>
                                    <th></th>
                                    <th>Nombre Asesor</th>
                                    <th>%GC</th>
                                    <th>%GC a Sumar</th>
                                </tr>
                            </thead>
                            <tbody >
                            <?php
                                for ($i=0; $i < sizeof($asesor); $i++) { 
                                    
                            ?>
                                <tr>
                                    <td><input class="form-control" type="checkbox" id="<?php echo 'chk'.$i;?>" value="<?php echo $asesor[$i]['cod']; ?>" onChange="validarchk(<?php echo $i;?>)"></td>
                                    <td style="background-color: white"><input class="form-control" type="text" name="<?php echo 'asesor'.$i;?>" value="<?php echo utf8_encode($asesor[$i]['idnom'])." [".$asesor[$i]['cod']."]"; ?>" readonly></td>
                                    <td><?php echo $asesor[$i]['nopre1']." %"; ?></td>
                                    <td style="background-color: white"><input style="text-align:center" type="number" class="form-control validanumericos3" id="<?php echo 'gc_asesor'.$i;?>" name="<?php echo 'gc_asesor'.$i;?>" min="-90" max="90" data-toggle="tooltip" data-placement="bottom" title="Añadir sólo el numero a sumar al %GC" readonly></td>
                                </tr>
                            <?php   
                                }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </form>
    
                

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
    <script src="../assets/assets-for-demo/js/material-kit-demo.js"></script>

    <script src="../bootstrap-datepicker/js/bootstrap-datepicker.js"></script>  
    <script src="../bootstrap-datepicker/locales/bootstrap-datepicker.es.min.js" charset="UTF-8"></script>

    



    <script type="text/javascript">
        $(document).ready(function(){
            $('#desdeP').datepicker({  
                format: "dd-mm-yyyy"
            });
            $('#hastaP').datepicker({  
                format: "dd-mm-yyyy"
            });


            
        });

        function cargarGC(cant_a){
            for (let index = 0; index < cant_a; index++) {
                $('#gc_asesor'+index).val($('#per_gc').val());
            }
        }

        function validarchk(id){
  
            var chk = document.getElementById('chk'+id);
            if(chk.checked){
                $('#gc_asesor'+id).removeAttr('readonly');
            }else{
                $("#gc_asesor"+id).attr("readonly",true);
            }
        }
        
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

        function eliminarDatos(idena){
            alertify.confirm('Eliminar una Compañía', '¿Seguro de eliminar esta Compañía?', function(){

                $.ajax({
                    type:"POST",
                    data:"idena=" + idena,
                    url:"../procesos/eliminarAsesor.php",
                    success:function(r){
                        if(r==1){
                            $('#tablaDatatable').load('t_comp.php');
                            alertify.success("Eliminado con exito !");
                        }else{
                            alertify.error("No se pudo eliminar...");
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