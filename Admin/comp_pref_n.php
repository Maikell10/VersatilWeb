<?php 
session_start();
if(isset($_SESSION['seudonimo'])) {

  }
    else {
        header("Location: ../sys/login.php");
        exit();
      }
      
  require_once("../class/clases.php");



  $nomcia=$_POST['nomcia'];

  $obj1= new Trabajo();
  $cia = $obj1->get_element_by_id('dcia','nomcia',$nomcia); 

  $obj2= new Trabajo();
  $asesor = $obj2->get_element('ena','idnom'); 

  $cant_a=sizeof($asesor);


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
            <a href="javascript:history.back(-1);" data-tooltip="tooltip" data-placement="right" title="Ir la página anterior" class="btn btn-info btn-round"><- Regresar</a>

                <div class="col-md-auto col-md-offset-2">
                    <h1 class="title">Previsualizar Preferencial de la Cía <?= $cia[0]['nomcia']; ?></h1>  
                </div>


                <form class="form-horizontal" id="frmnuevo" action="comp_pref_nn.php" method="post" >
                <center><button type="submit" id="btnForm" class="btn btn-success btn-lg btn-round">Agregar Preferencial</button></center>
                    <div class="table-responsive">   
                    <table class="table table-hover table-striped table-bordered">
                            <thead style="background-color: #00bcd4;color: white; font-weight: bold;">
                                <tr>
                                    <th>Fecha Desde Preferida</th>
                                    <th>Fecha Hasta Preferida</th>
                                    <th>%GC a Sumar</th>
                                    <th hidden>nomcia</th>
                                </tr>
                            </thead>

                            <tbody >
                                <tr>
                                    <td><input type="text" class="form-control" id="desdeP" name="desdeP" readonly value="<?= $_POST['desdeP'];?>"></td>
                                    <td><input type="text" class="form-control" id="hastaP" name="hastaP" readonly value="<?= $_POST['hastaP'];?>"></td>
                                    <td><input type="text" class="form-control" id="per_gc" name="per_gc" readonly value="<?= $_POST['per_gc'];?>"></td>

                                    <td hidden><input type="text" class="form-control" id="id_cia" name="id_cia" value="<?= $cia[0]['idcia']; ?>"></td>
                                </tr>
                            </tbody>
                        </table>

                        <table class="table table-hover table-striped table-bordered" id="iddatatable" >
                            <thead style="background-color: #00bcd4;color: white; font-weight: bold;">
                                <tr>
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
                                    <td><?= utf8_encode($asesor[$i]['idnom'])." [".$asesor[$i]['cod']."]"; ?></td>
                                    <td><?= $asesor[$i]['nopre1']." %"; ?></td>
                                    <td><input style="text-align:center" type="text" class="form-control" id="<?= 'gc_asesor'.$i;?>" name="<?= 'gc_asesor'.$i;?>" readonly value="<?= $_POST['gc_asesor'.$i];?>"></td>
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

    <script src="../bootstrap-datepicker/js/bootstrap-datepicker.js"></script>  
    <script src="../bootstrap-datepicker/locales/bootstrap-datepicker.es.min.js" charset="UTF-8"></script>

    
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