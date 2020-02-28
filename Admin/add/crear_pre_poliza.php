<?php 
session_start();
if(isset($_SESSION['seudonimo'])) {

  }
    else {
        header("Location: login.php");
        exit();
      }
  
  require_once("../../class/clases.php");
  $idcia=$_GET['cia'];


  $obj2= new Trabajo();
  $cia = $obj2->get_element_by_id('dcia','idcia',$idcia); 


  $obj4= new Trabajo();
  $usuario = $obj4->get_element_by_id('usuarios','seudonimo',$_SESSION['seudonimo']); 


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php require('header.php');?>


    <script type="text/javascript">
        $(document).ready(function() {
            $("form").keypress(function(e) {
                if (e.which == 13) {
                    return false;
                }
            });
        });
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
                    <h1 class="title"><i class="fa fa-check-square-o text-success" aria-hidden="true"></i>&nbsp;Agregada con Éxito</h1>  
                    <?php       
                        }
                    ?>
                    <h1 class="title"><i class="fa fa-book" aria-hidden="true"></i>&nbsp;Añadir Póliza de Pre-Carga</h1>  
                </div>


            
                <h2 id="existeP" class="bg-success text-white"><strong></strong></h2>
                <h2 id="no_existeP" class="bg-danger text-white"><strong></strong></h2>
                <form class="form-horizontal" id="frmnuevo" action="poliza_pre.php?cia=<?= $idcia;?>" method="post" >
                    <div class="form-row">      
                        <table class="table table-hover table-striped table-bordered display table-responsive nowrap" id="iddatatable" >
                            <thead style="background-color: #00bcd4;color: white; font-weight: bold;">
                                <tr>
                                    <th>N° de Póliza *</th>
                                    <th>Zona de Produc</th>
                                    <th>Cod Vend</th>
                                    <th>Cía</th>
                                    <th>Titular</th>
                                </tr>
                            </thead>

                            <tbody >
                                <div class="form-group col-md-12">
                                <tr style="background-color: white">
                                    <td><input onblur="validarPoliza(this)" type="text" class="form-control validanumericos" id="n_poliza" name="n_poliza" required data-toggle="tooltip" data-placement="bottom" title="Campo Obligatorio [Sólo introducir números]"></td>
                                    <td><input type="text" class="form-control" id="z_produc" name="z_produc" readonly="true" value="<?= utf8_encode($usuario[0]['z_produccion']);?>"></td>
                                    <td><input type="text" class="form-control" id="cod_vend" name="cod_vend" readonly="true" value="AP-1"></td>
                                    <td><input type="text" class="form-control" id="cia" name="cia" readonly="true" value="<?= utf8_encode($cia[0]['nomcia']);?>"></td>

                                    <td><input type="text" class="form-control" id="cod_vend" name="cod_vend" readonly="true" value="Cliente Pendiente"></td>
                                </tr>
                                </div>
                            </tbody>
                        </table>
                    </div>

         

                      <center>
                        <button type="submit" id="btnForm" class="btn btn-info btn-lg btn-round">Agregar Pre-Carga</button></center>

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

    <script src="../../bootstrap-datepicker/js/bootstrap-datepicker.js"></script>  
    <script src="../../bootstrap-datepicker/locales/bootstrap-datepicker.es.min.js" charset="UTF-8"></script>

      


    <script type="text/javascript">

        function validarPoliza(num_poliza){
            $.ajax({
                type:"POST",
                data:"num_poliza=" + num_poliza.value,
                url:"validarpoliza.php?var=0",
                success:function(r){
                    datos=jQuery.parseJSON(r);

                    if (datos['id_cod_ramo']==null) {

                        $('#existeP').text("");
                        $('#no_existeP').text("No Existe Póliza");
                    
                        
                        $('#btnForm').removeAttr('disabled');
                    }
                    else{

                        $('#existeP').text("Existe Póliza");
                        $('#no_existeP').text("");

                        $('#btnForm').attr('disabled',true);

                    }
                }
            });
        }

    </script>


</body>

</html>