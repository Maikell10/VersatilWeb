<?php 
session_start();
if(isset($_SESSION['seudonimo'])) {

  }
    else {
        header("Location: login.php");
        exit();
      }
      
  require_once("../class/clases.php");


  $desdeP=$_GET['desdeP'];
  $hastaP=$_GET['hastaP'];

  $desde = date("Y-m-d", strtotime($desdeP));
  $hasta = date("Y-m-d", strtotime($hastaP));   

  
  

  $obj1= new Trabajo();
  $poliza = $obj1->get_poliza_total_by_filtro_f_product($desde,$hasta); 





  


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
            <div class="container-fluid">


                <div class="col-md-auto col-md-offset-2" id="tablaLoad1" hidden="true">
                    <h1 class="title">Resultado de Búsqueda de Póliza por Fecha de Producción</h1>  
                    <h2 class="title">Desde: <font style="color:red"><?php echo $desdeP; ?></font> Hasta: <font style="color:red"><?php echo $hastaP; ?></font></h2>
                    <a href="javascript:history.back(-1);" data-tooltip="tooltip" data-placement="right" title="Ir la página anterior" class="btn btn-info btn-round"><- Regresar</a>
                </div>
                
                
                <center>
                <div class="table-responsive">
                <table class="table table-hover table-striped table-bordered display nowrap" id="iddatatable" >
                    <thead style="background-color: #00bcd4;color: white; font-weight: bold;">
                        <tr>
                            <th hidden>f_poliza</th>
                            <th hidden>id</th>
                            <th>N° Póliza</th>
                            <th hidden>Código Vendedor</th>
                            <th>Cía</th>
                            <th>F Desde Seguro</th>
                            <th>F Hasta Seguro</th>
                            <th style="background-color: #E54848;">Prima Suscrita</th>
                            <th>Nombre Titular</th>
                        </tr>
                    </thead>
                    
                    <tbody >
                        <?php
                        $totalsuma=0;
                        $totalprima=0;
                        $currency="";
                        $cant=0;
                        for ($i=0; $i < sizeof($poliza); $i++) { 
                            if ($poliza[$i]['id_titular']==0) {
					
                            } else {
                            $cant=$cant+1;
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

                            ?>
                            
                                
                                <td hidden><?php echo $poliza[$i]['codvend']; ?></td>
                                <td><?php echo utf8_encode($poliza[$i]['nomcia']); ?></td>
                                <td><?php echo $newDesde; ?></td>
                                <td><?php echo $newHasta; ?></td>
                                <td><?php echo $currency.number_format($poliza[$i]['prima'],2); ?></td>
                                <td><?php echo utf8_encode($poliza[$i]['nombre_t']." ".$poliza[$i]['apellido_t']); ?></td>
                            </tr>
                            <?php
                            }
                        }
                        ?>
                    </tbody>


                    <tfoot>
                        <tr>
                            <th hidden>f_poliza</th>
                            <th hidden>id</th>
                            <th>N° Póliza</th>
                            <th hidden>Código Vendedor</th>
                            <th>Cía</th>
                            <th>F Desde Seguro</th>
                            <th>F Hasta Seguro</th>
                            <th>Prima Suscrita $<?php echo number_format($totalprima,2); ?></th>
                            <th>Nombre Titular</th>
                        </tr>
                    </tfoot>
                </table></div>


                <h1 class="title">Total de Prima Suscrita</h1>
                <h1 class="title text-danger">$ <?php  echo number_format($totalprima,2);?></h1>

                <h1 class="title">Total de Pólizas</h1>
                <h1 class="title text-danger"><?php  echo $cant;?></h1>
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

   




    <script type="text/javascript">

        const tablaLoad1 = document.getElementById("tablaLoad1");
        const carga = document.getElementById("carga");

        setTimeout(()=>{
            carga.className = 'd-none';
            tablaLoad1.removeAttribute("hidden");
        }, 1000);
        
      

        $(document).ready(function() {
            $('#iddatatable').DataTable({
                scrollX: 300,
                "order": [[ 0, "desc" ]]
            });
        } );

        $(function () {
        $('[data-tooltip="tooltip"]').tooltip()
        });

        $( "#iddatatable tbody tr" ).click(function() {
            var customerId = $(this).find("td").eq(1).html();   

            window.open ("v_poliza.php?id_poliza="+customerId ,'_blank');
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