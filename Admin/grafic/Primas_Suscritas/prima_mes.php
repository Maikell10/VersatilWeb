<?php 
session_start();
if(isset($_SESSION['seudonimo'])) {

  }
    else {
        header("Location: login.php");
        exit();
      }
      
  require_once("../../../class/clases.php");

$desde=$_GET['desde'].'-01-01';
$hasta=($_GET['desde']).'-12-31';

  $obj1= new Trabajo();
  $mes = $obj1->get_mes_prima($desde,$hasta,$_GET['cia'],$_GET['ramo']); 




  $totals=0;
  $totalCant=0;

  $mesArray = array('Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre');




  $ramoArray[sizeof($mes)]=null;
  $cantArray[sizeof($mes)]=null;
  $primaPorMes[sizeof($mes)]=null;


  for($i=0;$i<sizeof($mes);$i++)
    {  
      $desde=$_GET['desde']."-".$mes[$i]["Month(f_desderecibo)"]."-01";
      $hasta=$_GET['desde']."-".$mes[$i]["Month(f_desderecibo)"]."-31";

      $obj2= new Trabajo();
      $primaMes = $obj2->get_poliza_grafp_2($_GET['ramo'],$desde,$hasta,$_GET['cia']); 
    
      $cantArray[$i]=sizeof($primaMes);
      $sumasegurada=0;
      for($a=0;$a<sizeof($primaMes);$a++)
        { 
          $sumasegurada=$sumasegurada+$primaMes[$a]['prima'];

        } 
        $totals=$totals+$sumasegurada;
        $totalCant=$totalCant+$cantArray[$i];
        $ramoArray[$i]=$primaMes[0]['cod_ramo'];
        $primaPorMes[$i]=$sumasegurada;
    }


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    
    <!-- Favicons -->
    <link rel="icon" href="../../../assets/img/logo1.png">
    <title>
        Versatil Seguros
    </title>
    <script src="../../../tableToExcel.js"></script>

    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />

    
    <link rel="stylesheet" href="../../../assets/css/material-kit.css?v=2.0.1">
    <!-- Documentation extras -->
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="../../../assets/assets-for-demo/demo.css" rel="stylesheet" />
    <link href="../../../assets/assets-for-demo/vertical-nav.css" rel="stylesheet" />
    
    <link href="../../../bootstrap-datepicker/css/bootstrap-datepicker.css" rel="stylesheet">

    <link href="../../../Chart/samples/style.css" rel="stylesheet">

   <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>

</head>

<body class="profile-page ">
    <nav class="navbar navbar-color-on-scroll navbar-transparent    fixed-top  navbar-expand-lg bg-info" color-on-scroll="100" id="sectionsNav">
        <div class="container">
            <div class="navbar-translate">
                <a class="navbar-brand" href="../../sesionadmin.php"> <img src="../../../assets/img/logo1.png" width="45%" /></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                    <span class="navbar-toggler-icon"></span>
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ml-auto">
                    <li class="dropdown nav-item">
                        <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                            <i class="material-icons">plus_one</i> Cargar Datos
                        </a>
                        <div class="dropdown-menu dropdown-with-icons">
                            <a href="../../add/crear_poliza.php" class="dropdown-item">
                                <i class="material-icons">add_to_photos</i> Póliza
                            </a>
                            <a href="../../add/crear_comision.php" class="dropdown-item">
                                <i class="material-icons">add_to_photos</i> Comisión
                            </a>
                            <a href="../../add/crear_asesor.php" class="dropdown-item">
                                <i class="material-icons">person_add</i> Asesor
                            </a>
                            <a href="../../add/crear_compania.php" class="dropdown-item">
                                <i class="material-icons">markunread_mailbox</i> Compañía
                            </a>
                        </div>
                    </li>

                    <li class="dropdown nav-item">
                        <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                            <i class="material-icons">search</i> Buscar
                        </a>
                        <div class="dropdown-menu dropdown-with-icons">
                            <a href="../../b_asesor.php" class="dropdown-item">
                                <i class="material-icons">accessibility</i> Asesor
                            </a>
                            <a href="../../b_cliente.php" class="dropdown-item">
                                <i class="material-icons">accessibility</i> Cliente
                            </a>
                            <a href="../../b_poliza.php" class="dropdown-item">
                                <i class="material-icons">content_paste</i> Póliza
                            </a>
                            <a href="../../b_vehiculo.php" class="dropdown-item">
                                <i class="material-icons">commute</i> Vehículo
                            </a>
                            <a href="../../b_comp.php" class="dropdown-item">
                                <i class="material-icons">markunread_mailbox</i> Compañía
                            </a>
                            <a href="../../b_reportes.php" class="dropdown-item">
                                <i class="material-icons">library_books</i> Reportes de Cobranza
                            </a>
                        </div>
                    </li>

                    <li class="dropdown nav-item">
                        <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                            <i class="material-icons">trending_up</i> Gráficos
                        </a>
                        <div class="dropdown-menu dropdown-with-icons">
                            <a href="../porcentaje.php" class="dropdown-item">
                                <i class="material-icons">pie_chart</i> Porcentajes
                            </a>
                            <a href="../primas_s.php" class="dropdown-item">
                                <i class="material-icons">bar_chart</i> Primas Suscritas
                            </a>
                            <a href="../primas_c.php" class="dropdown-item">
                                <i class="material-icons">thumb_up</i> Primas Cobradas
                            </a>
                            <a href="../comisiones_c.php" class="dropdown-item">
                                <i class="material-icons">timeline</i> Comisiones Cobradas
                            </a>
                            <a href="" class="dropdown-item">
                                <i class="material-icons">show_chart</i> Gestión de Cobranza
                            </a>
                        </div>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="../../../sys/cerrar_sesion.php" >
                            <i class="material-icons">eject</i> Cerrar Sesión
                        </a>
                    </li>
                   
                </ul>
            </div>
        </div>
    </nav>




    <div class="page-header  header-filter " data-parallax="true" style="background-image: url('../../../assets/img/logo2.png');">
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
                  <center>
                    <h1 class="title">Primas Suscritas por Mes del Año <?php echo $_GET['desde'];?></h1></h1> 
                    <br/>
                    
                    <a href="../primas_s.php" class="btn btn-info btn-lg btn-round">Menú de Gráficos</a></center>
                    <center><a  class="btn btn-success" onclick="tableToExcel('Exportar_a_Excel', 'Pólizas a Renovar por Asesor')" data-toggle="tooltip" data-placement="right" title="Exportar a Excel"><img src="../../../assets/img/excel.png" width="40" alt=""></a></center>
                </div>
                <br>




    <table class="table table-hover" id="Exportar_a_Excel">
      <thead class="thead-dark">
        <tr>
          <th scope="col">Mes Desde Recibo</th>
          <th scope="col">Prima Suscrita</th>
          <th scope="col">Cantidad</th>
        </tr>
      </thead>
      <tbody>
        <?php
          

          for ($i=0; $i < sizeof($mes); $i++) { 
              //echo $sumatotalRamo[$x[$i]]." - ".$ramoArray[$x[$i]];

        ?>
        <tr>
          <th scope="row"><?php echo $mesArray[$mes[$i]["Month(f_desderecibo)"]-1]; ?></th>
          <td align="right"><?php echo "$".number_format($primaPorMes[$i],2); ?></td>
          <td><?php echo $cantArray[$i]; ?></td>
        </tr>
        <?php
            }
        ?>
      </tbody>
      <thead class="thead-dark">
        <tr>
          <th scope="col">TOTAL</th>
          <th align="right"><?php echo "$".number_format($totals,2); ?></th>
          <th scope="col"><?php echo $totalCant; ?></th>
        </tr>
      </thead>
    </table>
    
        


    
    
    </div>



    <div class="container">
      <div class="wrapper col-12"><canvas id="chart-0"></canvas></div>
    </div>

    <br><br><br><br>



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
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="../../../assets/js/core/popper.min.js"></script>
    <script src="../../../assets/js/bootstrap-material-design.js"></script>
    <!-- Material Kit Core initialisations of plugins and Bootstrap Material Design Library -->
    <script src="../../../assets/js/material-kit.js?v=2.0.1"></script>
    <!-- Fixed Sidebar Nav - js With initialisations For Demo Purpose, Don't Include it in your project -->
    <script src="../../../assets/assets-for-demo/js/material-kit-demo.js"></script>

    <script src="../../../Chart/Chart.bundle.js"></script>  
    <script src="../../../Chart/samples/utils.js"></script>
    <script src="../../../Chart/samples/charts/area/analyser.js"></script>

    
    <script>
    var presets = window.chartColors;
    var utils = Samples.utils;
    var inputs = {
      min: 0,
      count: 12,
      decimals: 2,
      continuity: 1
    };

    function generateData(config) {
      return utils.numbers(Chart.helpers.merge(inputs, config || {}));
    }

    function generateLabels(config) {
      return utils.months(Chart.helpers.merge({
        count: inputs.count,
        section: 3
      }, config || {}));
    }

    var options = {
      maintainAspectRatio: false,
      spanGaps: false,
      elements: {
        line: {
          tension: 0.000001
        }
      },
      plugins: {
        filler: {
          propagate: false
        }
      },
      scales: {
        xAxes: [{
          ticks: {
            autoSkip: false,
            maxRotation: 0
          }
        }]
      }
    };

    [false, 'origin', 'start', 'end'].forEach(function(boundary, index) {

      // reset the random seed to generate the same data for all charts
      utils.srand(12);

      new Chart('chart-' + index, {
        type: 'line',
        data: {
          labels: ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
          datasets: [{
            backgroundColor: utils.transparentize(presets.red),
            borderColor: presets.red,
            data: [<?php $a=0; for($i=0;$i<=11;$i++)
            {   
                if (($mes[$a]["Month(f_desderecibo)"]-1) == $i) {
                  $dataPrima=$primaPorMes[$a]; 
                  if ($a<(sizeof($mes)-1)) {
                    $a++;
                  }
                }else{$dataPrima=0;}
                ?>
                '<?php echo $dataPrima; ?>',
            <?php }?>
          ],
            label: 'Prima Suscrita',
            fill: boundary,
            pointHoverRadius: 30,
            pointHitRadius: 20,
            pointRadius: 5,
          }]
        },
        options: Chart.helpers.merge(options, {
          title: {
            text: 'Gráfico Prima Suscrita por Mes',
            fontSize:25,
            display: true
          }
        })
      });
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