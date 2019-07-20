<?php 
session_start();
if(isset($_SESSION['seudonimo'])) {

  }
    else {
        header("Location: login.php");
        exit();
      }
      
  require_once("../../class/clases.php");

  $obj1= new Trabajo();
  $asesor = $obj1->get_element('ena','idena'); 

  $estructura=$_GET['en'];

  if ($estructura==7) {
      $obj2= new Trabajo();
      $lider_proyecto = $obj2->get_element('lider_enp','id_proyecto'); 
  }

  



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




    <div class="page-header  header-filter " data-parallax="true" style="background-image: url('../../assets/img/logo2.png');">
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
            <div class="container" >
                <center>

                <div class="col-md-auto col-md-offset-2">
                    <h1 class="title"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Crear Proyecto
                    </h1>  
                </div>

                <a href="n_proyecto.php?cod_proyecto=<?php echo 1; ?>" class="btn btn-danger btn-lg btn-round" >Crear Proyecto</a>

                <div class="col-md-auto col-md-offset-2">
                    <h1 class="title"><i class="fa fa-eye" aria-hidden="true"></i>&nbsp;Seleccione Proyecto Existente
                    </h1>  
                </div>


            
                
                <form class="form-horizontal" id="frmnuevo" autocomplete="off" action="n_proyecto.php" method="post">
                        
                        <table class="table table-hover table-striped table-bordered display nowrap" id="iddatatable" style="width: 50%;text-align: center">
                            <thead style="background-color: #00bcd4;color: white; font-weight: bold;">
                                <tr>
                                    <th>Seleccione Proyecto Existente</th>
                                </tr>
                            </thead>

                            <tbody >
                                <tr >
                                    <td><select class="custom-select" name="cod_proyecto" required>
                                            <option value="">Seleccione Proyecto Existente</option>
                                            <?php
                                                for($i=0;$i<sizeof($lider_proyecto);$i++)
                                                  {  
                                              ?>
                                                  <option value="<?php echo $lider_proyecto[$i]["cod_proyecto"];?>"><?php echo utf8_encode($lider_proyecto[$i]["cod_proyecto"])." -> ".$lider_proyecto[$i]["lider"];?></option>
                                              <?php } ?> 
                                        </select>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    

                    
                        <button type="submit" id="" class="btn btn-info btn-lg btn-round">Confirmar</button>
                    
                </form>

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

    <script src="../../assets/js/core/popper.min.js"></script>
    <script src="../../assets/js/bootstrap-material-design.js"></script>
    <!--  Plugin for Date Time Picker and Full Calendar Plugin  -->
    <script src="../../assets/js/plugins/moment.min.js"></script>
    <!--	Plugin for the Datepicker, full documentation here: https://github.com/Eonasdan/bootstrap-datetimepicker -->
    <script src="../../assets/js/plugins/bootstrap-datetimepicker.min.js"></script>
    <!--	Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
    <script src="../../assets/js/plugins/nouislider.min.js"></script>
    <!-- Material Kit Core initialisations of plugins and Bootstrap Material Design Library -->
    <script src="../../assets/js/material-kit.js?v=2.0.1"></script>
    <!-- Fixed Sidebar Nav - js With initialisations For Demo Purpose, Don't Include it in your project -->
    <script src="../../assets/assets-for-demo/js/material-kit-demo.js"></script>

    



    <script type="text/javascript">
        $(document).ready(function(){
            $('#btnAgregarnuevo').click(function(){
                datos=$('#frmnuevo').serialize();

                $.ajax({
                    type:"POST",
                    data:datos,
                    url:"../../procesos/agregarAsesor.php",
                    success:function(r){
                        if(r==1){
                            $('#frmnuevo')[0].reset();
                            $('#tablaDatatable').load('../t_asesor.php');
                            alertify.success("agregado con exito :D");
                        }else{
                            alertify.error("Fallo al agregar :(");
                        }
                    }
                });
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