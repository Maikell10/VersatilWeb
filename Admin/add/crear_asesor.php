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
                    <?php 
                        if (isset($_GET['cond'])) {
                    ?> 
                    <h1 class="title"><i class="fa fa-check-square-o text-success" aria-hidden="true"></i>&nbsp;Agregado con Éxito</h1>  
                    <?php       
                        }
                    ?>
                    <h1 class="title"><i class="fa fa-search-plus" aria-hidden="true"></i>&nbsp;Seleccione Estructura de Negocios
                    </h1>  
                </div>

                <br/><br/><br/>


            
                
                <form class="form-horizontal" id="frmnuevo" style="width: 50%">
                    <div class="form-row">
                      <div class="form-group col-md-12">
                            <select class="custom-select" id="estructura_neg" name="estructura_neg" required onchange="document.location.href=this.value">
                                <option value="">Seleccione Estructura de Negocios</option>
                                <option value="c_asesor.php?en=1">Asesor Independiente [A]</option>
                                <option value="">Ejecutivo de Cuentas [E]</option>
                                <option value="">Concesionario [C]</option>
                                <option value="">Negocio Versatil [NV]</option>
                                <option value="">Negocio Propio [NP]</option>
                                <option value="c_proyecto.php?en=7">Proyecto [P]</option>
                                <option value="c_referidor.php">Referidor [R]</option>
                            </select>
                      </div>
                    </div>
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
                    document.write(new Date().getFullYear());
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
        $('estructura_neg').on('change', function() {
          datos=this.value;
          $.ajax({
            type:"POST",
            data:datos,
            url:"c_asesor.php",
          });
        });

        $(document).ready(function(){
            $('#estructura_neg option:first').prop('selected',true);
            console.log("!");
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