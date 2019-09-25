<?php 
session_start();
if(isset($_SESSION['seudonimo'])) {

  }
    else {
        header("Location: login.php");
        exit();
      }
      
  require_once("../class/clases.php");


  $obj2= new Trabajo();
  $usuario = $obj2->get_element('usuarios','id_usuario'); 


  $dest= new Trabajo();
  $dest = $dest->destruir(); 


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
            <div class="container">

                <div class="col-md-auto col-md-offset-2" id="tablaLoad" hidden="true">
                <a href="javascript:history.back(-1);" data-tooltip="tooltip" data-placement="right" title="Ir la página anterior" class="btn btn-info btn-round"><- Regresar</a>
                    <h1 class="title">Lista Usuarios
                        <a href="add/crear_usuario.php" class="btn btn-info pull-right menu"><i class="fa fa-plus-circle" aria-hidden="true"></i>&nbsp;&nbsp;Nuevo Usuario</a>
                    </h1>  
                </div>
                <br><br>




                <center>
                <div class="table-responsive">
                    <table class="table table-hover table-striped table-bordered" id="iddatatable" >
                        <thead style="background-color: #00bcd4;color: white; font-weight: bold;">
                            <tr>
                                <th hidden>id</th>
                                <th>Seudónimo</th>
                                <th>Nombre Usuario</th>
                                <th>CI</th>
                                <th>Permiso</th>
                                <th nowrap>Z Producc</th>
                            </tr>
                        </thead>
                        
                        <tbody >
                            <?php

                            for ($i=0; $i < sizeof($usuario); $i++) { 

                                if ($usuario[$i]['id_permiso']==1) {
                                    $permiso='Administrador';
                                }
                                if ($usuario[$i]['id_permiso']==2) {
                                    $permiso='Usuario';
                                }
                                if ($usuario[$i]['id_permiso']==3) {
                                    $permiso='Asesor';
                                }
    
                            ?>
                            <tr style="cursor: pointer;">
                                <td hidden><?php echo $usuario[$i]['id_usuario']; ?></td>
                                <?php
                                if ($usuario[$i]['activo']==0) {
                                ?>
                                <td class="text-danger"><?php echo $usuario[$i]['seudonimo']; ?></td>
                                <?php
                                }if ($usuario[$i]['activo']==1) {
                                ?>
                                <td class="text-success font-weight-bold"><?php echo $usuario[$i]['seudonimo']; ?></td>
                                <?php
                                }
                                ?>
                                <td nowrap><?php echo utf8_encode($usuario[$i]['nombre_usuario']." ".$usuario[$i]['apellido_usuario']); ?></td>
                                <td><?php echo $usuario[$i]['cedula_usuario']; ?></td>
                                <td><?php echo $permiso; ?></td>
                                <td><?php echo utf8_encode($usuario[$i]['z_produccion']); ?></td>
                            </tr>
                            <?php
                                
                            }
                            ?>
                        </tbody>


                        <tfoot>
                            <tr>
                                <th hidden>id</th>
                                <th>Seudónimo</th>
                                <th>Nombre Usuario</th>
                                <th>CI</th>
                                <th>Permiso</th>
                                <th>Z Producc</th>
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

    <!-- Bootstrap Select JavaScript -->
    <script src="../js/bootstrap-select.js"></script>

    


   
    <script type="text/javascript">
       
        const carga = document.getElementById("carga");

        setTimeout(()=>{
            carga.className = 'd-none';
            tablaLoad.removeAttribute("hidden");
        }, 1000);
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#iddatatable').DataTable({
            });
        } );

        $(function () {
          $('[data-tooltip="tooltip"]').tooltip()
        });

        $( "#iddatatable tbody tr" ).click(function() {
            var customerId = $(this).find("td").eq(0).html();   

            window.open ("v_usuario.php?id_usuario="+customerId ,'_blank');
        });

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