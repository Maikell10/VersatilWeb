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
      $dia=$dia_mes[$i]['f_desdepoliza'];

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
    
  <?php require('navigation.php');?>




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
                    <h1 class="title">Primas Suscritas por Semana del Año <?php echo $_GET['desde'];?></h1> 
                    <br/>
                    
                    <a href="../primas_s.php" class="btn btn-info btn-lg btn-round">Menú de Gráficos</a></center>
                    <center><a  class="btn btn-success" onclick="tableToExcel('Exportar_a_Excel', 'Pólizas a Renovar por Asesor')" data-toggle="tooltip" data-placement="right" title="Exportar a Excel"><img src="../../../assets/img/excel.png" width="40" alt=""></a></center>
                </div>
                <br>





    <div class="table-responsive">
    <table class="table table-hover table-striped table-bordered" id="Exportar_a_Excel">
      <thead style="background-color: #00bcd4;color: white; font-weight: bold;">
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
    
        


    
    
    </div>



    <div class="container">
      <canvas id="myChart">
        
      </canvas>
    </div>


    <br><br><br><br>



    <?php require('footer_b.php');?>
    
    
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