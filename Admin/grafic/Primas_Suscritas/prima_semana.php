<?php 
session_start();
if(isset($_SESSION['seudonimo'])) {

  }
    else {
        header("Location: login.php");
        exit();
      }
      
  require_once("../../../class/clases.php");


$mesA=$_GET['mes']+01;
$numeroConCeros = str_pad($mesA, 2, "0", STR_PAD_LEFT);


$desde=$_GET['desde'].'-'.$numeroConCeros.'-01';
$hasta=$_GET['desde'].'-'.$numeroConCeros.'-31';




#separas la fecha en subcadenas y asignarlas a variables
#relacionadas en contenido, por ejemplo dia, mes y anio.

$dia   = substr($desde,8,2);
$mes = substr($desde,5,2);
$anio = substr($desde,0,4); 


$semana = date('W',  mktime(0,0,0,$mes,$dia,$anio));  

//donde:
        
#W (mayúscula) te devuelve el número de semana
#w (minúscula) te devuelve el número de día dentro de la semana (0=domingo, #6=sabado)

//echo $semana;  





  $obj1= new Trabajo();
  $dia_mes = $obj1->get_dia_mes_prima($desde,$hasta,$_GET['cia'],$_GET['ramo']); 



  $totals=0;
  $totalCant=0;

  $mesArray = array('Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre');




  $ramoArray[sizeof($dia_mes)]=null;
  $cantArray[sizeof($dia_mes)]=null;
  $primaPorMes[sizeof($dia_mes)]=null;

  

  for($i=0;$i<sizeof($dia_mes);$i++)
    {  
      $dia=$dia_mes[$i]['f_desderecibo'];

      $dia1   = substr($dia,8,2);
      $mes1 = substr($dia,5,2);
      $anio1 = substr($dia,0,4); 


      $semana = date('W',  mktime(0,0,0,$mes1,$dia1,$anio1));  

      $obj2= new Trabajo();
      $primaMes = $obj2->get_poliza_graf_p3($_GET['ramo'],$dia,$_GET['cia']); 
    
      
      $sumasegurada=0;
      for($a=0;$a<sizeof($primaMes);$a++)
        { 
          $sumasegurada=$sumasegurada+$primaMes[$a]['prima'];

        } 
        $cantArray[$i]=sizeof($primaMes);
        $totals=$totals+$sumasegurada;
        $totalCant=$totalCant+$cantArray[$i];
        $semanaMesArray[$i]=$semana;
        $primaPorMes[$i]=$sumasegurada;

    }



$semSinDuplicado=array_values(array_unique($semanaMesArray));





    for ($i=0; $i < sizeof($semSinDuplicado); $i++) { 
      $var1=0;
      $cant1=0;
      for ($a=0; $a < sizeof($semanaMesArray); $a++) { 
        if ($semanaMesArray[$a]==$semSinDuplicado[$i]) {
          $var1=$var1+$primaPorMes[$a];
          $cant1=$cant1+$cantArray[$a];
        }
      }
      $primaPorMesF[$i]=$var1;
      $cantArrayF[$i]=$cant1;
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
                            <a href="../procentaje.php" class="dropdown-item">
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

                <div class="col-md-auto col-md-offset-2">
                  <center>
                    <h1 class="title">Primas Suscritas por Semana del Año <?php echo $_GET['desde'];?></h1> 
                    <br/>
                    
                    <a href="../primas_s.php" class="btn btn-danger btn-lg btn-round">Gráficos de Primas Suscritas</a></center>
                    <a href="busqueda_prima_semana.php?m=1" class="btn btn-info btn-lg btn-round"><-</a>
                </div>
                <br>





    <table class="table table-hover" id="myTable">
      <thead class="thead-dark">
        <tr>
          <th scope="col">Semana del Año Desde Recibo</th>
          <th scope="col">Prima Suscrita</th>
          <th scope="col">Cantidad</th>
        </tr>
      </thead>
      <tbody>
        <?php
          

          for ($i=0; $i < sizeof($semSinDuplicado); $i++) { 

        ?>
        <tr>
          <th scope="row"><?php echo $semSinDuplicado[$i]; ?></th>
          <td align="right"><?php echo "$".number_format($primaPorMesF[$i],2); ?></td>
          <td><?php echo $cantArrayF[$i]; ?></td>
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
      <canvas id="myChart">
        
      </canvas>
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
    let myChart = document.getElementById('myChart').getContext('2d');

    // Global Options
    Chart.defaults.global.defaultFontFamily = 'Lato';
    Chart.defaults.global.defaultFontSize = 18;
    Chart.defaults.global.defaultFontColor = '#777';

    let massPopChart = new Chart(myChart, {
      type:'bar', // bar, horizontalBar, pie, line, doughnut, radar, polarArea
      data:{
        labels:[<?php for($i=0; $i < sizeof($semSinDuplicado); $i++){ ?>
        '<?php echo $semSinDuplicado[$i];?>',

                <?php }?>],

        datasets:[{
          label:"Prima por Semana",
          data:[<?php for($i=0; $i < sizeof($semSinDuplicado); $i++)
            {  
                ?>
                '<?php echo $primaPorMesF[$i]; ?>',
            <?php }?>],
          //backgroundColor:'green',
          backgroundColor:'rgba(120, 255, 86, 0.6)',
          borderWidth:1,
          borderColor:'#777',
          hoverBorderWidth:3,
          hoverBorderColor:'#000'
        }]
      },
      options:{
        title:{
          display:true,
          text:'Prima Suscrita por Semana',
          fontSize:25
        },
        legend:{
          display:true,
          position:'right',
          labels:{
            fontColor:'#000'
          }
        },
        layout:{
          padding:{
            left:50,
            right:0,
            bottom:0,
            top:0
          }
        },
        tooltips:{
          enabled:true
        }
      }
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