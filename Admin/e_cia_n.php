<?php

session_start();
if(isset($_SESSION['seudonimo'])) {

  }
    else {
        header("Location: login.php");
        exit();
      }
      
  require_once("../class/clases.php");

 

    $id_cia=$_POST['id_cia'];


	$nombre_cia=$_POST['nombre_cia'];
    $rif=$_POST['rif'];
    $per_com=$_POST['per_com'];
    
	$nombre1=$_POST['nombre1'];
	$cargo1=$_POST['cargo1'];
	$tel1=$_POST['tel1'];
	$cel1=$_POST['cel1'];
    $email1=$_POST['email1'];
    
    $nombre2=$_POST['nombre2'];
	$cargo2=$_POST['cargo2'];
	$tel2=$_POST['tel2'];
	$cel2=$_POST['cel2'];
    $email2=$_POST['email2'];

    $nombre3=$_POST['nombre3'];
	$cargo3=$_POST['cargo3'];
	$tel3=$_POST['tel3'];
	$cel3=$_POST['cel3'];
    $email3=$_POST['email3'];

    $nombre4=$_POST['nombre4'];
	$cargo4=$_POST['cargo4'];
	$tel4=$_POST['tel4'];
	$cel4=$_POST['cel4'];
    $email4=$_POST['email4'];

    $nombre5=$_POST['nombre5'];
	$cargo5=$_POST['cargo5'];
	$tel5=$_POST['tel5'];
	$cel5=$_POST['cel5'];
    $email5=$_POST['email5'];
    

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
            <div class="container" >
            <a href="javascript:history.back(-1);" data-tooltip="tooltip" data-placement="right" title="Ir la página anterior" class="btn btn-info btn-round"><- Regresar</a>

                <center>
                <div class="col-md-auto col-md-offset-2">
                    <h1 class="title"><i class="fa fa-briefcase" aria-hidden="true"></i>&nbsp;Previsualizar Edición de Compañía
                    </h1>  
                </div>


            
                
                <form class="form-horizontal" id="frmnuevo" >
                    <div class="form-row table-responsive">      
                        <table class="table table-hover table-striped table-bordered" id="iddatatable" >
                            <thead style="background-color: #92ACC4;color: white; font-weight: bold;">
                                <tr>
                                    <th colspan="2">Nombre de Cía</th>
                                    <th colspan="2">RUC/RIF</th>
                                    <th>%Comisión</th>
                                </tr>
                            </thead>

                            <tbody >
                                <div class="form-group col-md-12">
                                <tr >
                                    <td colspan="2"><input type="text" class="form-control" name="nombre_cia" readonly="readonly" value="<?= $nombre_cia;?>"></td>
                                    <td colspan="2"><input type="text" class="form-control" name="rif" readonly="readonly" value="<?= $rif;?>"></td>
                                    <td><input type="text" class="form-control" name="per_com" readonly="readonly" value="<?= $per_com;?>"></td>
                                </tr>

                                <tr style="background-color: #92ACC4;color: white; font-weight: bold;">
                                    <th>Nombre del Contacto</th>
                                    <th>Cargo</th>
                                    <th>Telf</th>
                                    <th>Celular</th>
                                    <th>e-mail</th>
                                </tr>
                                <tr>
                                    <td><input type="text" class="form-control" name="nombre1" readonly="readonly" value="<?= $nombre1;?>"></td>
                                    <td><input type="text" class="form-control" name="cargo1" readonly="readonly" value="<?= $cargo1;?>"></td>
                                    <td><input type="text" class="form-control" name="tel1" readonly="readonly" value="<?= $tel1;?>"></td>
                                    <td><input type="text" class="form-control" name="cel1" readonly="readonly" value="<?= $cel1;?>"></td>
                                    <td><input type="text" class="form-control" name="email1" readonly="readonly" value="<?= $email1;?>"></td>
                                </tr>

                                <tr>
                                    <td><input type="text" class="form-control" name="nombre2" readonly="readonly" value="<?= $nombre2;?>"></td>
                                    <td><input type="text" class="form-control" name="cargo2" readonly="readonly" value="<?= $cargo2;?>"></td>
                                    <td><input type="text" class="form-control" name="tel2" readonly="readonly" value="<?= $tel2;?>"></td>
                                    <td><input type="text" class="form-control" name="cel2" readonly="readonly" value="<?= $cel2;?>"></td>
                                    <td><input type="text" class="form-control" name="email2" readonly="readonly" value="<?= $email2;?>"></td>
                                </tr>

                                <tr>
                                    <td><input type="text" class="form-control" name="nombre3" readonly="readonly" value="<?= $nombre3;?>"></td>
                                    <td><input type="text" class="form-control" name="cargo3" readonly="readonly" value="<?= $cargo3;?>"></td>
                                    <td><input type="text" class="form-control" name="tel3" readonly="readonly" value="<?= $tel3;?>"></td>
                                    <td><input type="text" class="form-control" name="cel3" readonly="readonly" value="<?= $cel3;?>"></td>
                                    <td><input type="text" class="form-control" name="email3" readonly="readonly" value="<?= $email3;?>"></td>
                                </tr>

                                <tr>
                                    <td><input type="text" class="form-control" name="nombre4" readonly="readonly" value="<?= $nombre4;?>"></td>
                                    <td><input type="text" class="form-control" name="cargo4" readonly="readonly" value="<?= $cargo4;?>"></td>
                                    <td><input type="text" class="form-control" name="tel4" readonly="readonly" value="<?= $tel4;?>"></td>
                                    <td><input type="text" class="form-control" name="cel4" readonly="readonly" value="<?= $cel4;?>"></td>
                                    <td><input type="text" class="form-control" name="email4" readonly="readonly" value="<?= $email4;?>"></td>
                                </tr>

                                <tr>
                                    <td><input type="text" class="form-control" name="nombre5" readonly="readonly" value="<?= $nombre5;?>"></td>
                                    <td><input type="text" class="form-control" name="cargo5" readonly="readonly" value="<?= $cargo5;?>"></td>
                                    <td><input type="text" class="form-control" name="tel5" readonly="readonly" value="<?= $tel5;?>"></td>
                                    <td><input type="text" class="form-control" name="cel5" readonly="readonly" value="<?= $cel5;?>"></td>
                                    <td><input type="text" class="form-control" name="email5" readonly="readonly" value="<?= $email5;?>"></td>
                                </tr>


                                </div>
                            </tbody>
                        </table>
                    </div>



                    


                      <center>
                        <a name="enlace" href="e_cia_nn.php?id_cia=<?= $id_cia;?>&nombre_cia=<?= $nombre_cia;?>&rif=<?= $rif;?>&per_com=<?= $per_com;?>&nombre1=<?= $nombre1;?>&cargo1=<?= $cargo1;?>&tel1=<?= $tel1;?>&cel1=<?= $cel1;?>&email1=<?= $email1;?>&nombre2=<?= $nombre2;?>&cargo2=<?= $cargo2;?>&tel2=<?= $tel2;?>&cel2=<?= $cel2;?>&email2=<?= $email2;?>&nombre3=<?= $nombre3;?>&cargo3=<?= $cargo3;?>&tel3=<?= $tel3;?>&cel3=<?= $cel3;?>&email3=<?= $email3;?>&nombre4=<?= $nombre4;?>&cargo4=<?= $cargo4;?>&tel4=<?= $tel4;?>&cel4=<?= $cel4;?>&email4=<?= $email4;?>&nombre5=<?= $nombre5;?>&cargo5=<?= $cargo5;?>&tel5=<?= $tel5;?>&cel5=<?= $cel5;?>&email5=<?= $email5;?>" class="btn btn-info btn-lg btn-round">Confirmar</a></center>
                        
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

    <script src="../bootstrap-datepicker/js/bootstrap-datepicker.js"></script>  
    <script src="../bootstrap-datepicker/locales/bootstrap-datepicker.es.min.js" charset="UTF-8"></script>
 
    <script>
        onload = function(){ 
          var ele = document.querySelectorAll('.validanumericos')[0];

          ele.onkeypress = function(e) {
             if(isNaN(this.value+String.fromCharCode(e.charCode)))
                return false;
          }
          ele.onpaste = function(e){
             e.preventDefault();
          }
        }
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