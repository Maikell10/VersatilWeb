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

  $obj1= new Trabajo();
  $cia = $obj1->get_element_by_id('dcia','idcia',$idcia); 



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php require('header.php');?>
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
            <a href="javascript:history.back(-1);" data-tooltip="tooltip" data-placement="right" title="Ir la página anterior" class="btn btn-info btn-round"><- Regresar</a>
                <center>
                <div class="col-md-auto col-md-offset-2">
                    <h1 class="title"><i class="fa fa-info-circle" aria-hidden="true"></i>&nbsp;Compañía: <?= ($cia[0]['nomcia']);?>
                    </h1>   
                </div>

                <br/><br/>


                <h2 id="existeRep" class="text-success"><strong></strong></h2>
                <h2 id="no_existeRep" class="text-danger"><strong></strong></h2>
            
                
                <form class="form-horizontal" id="frmnuevo" method="get" action="c_comision.php" autocomplete="off">
                
                    <div class="form-row table-responsive">
                            <table class="table table-hover table-striped table-bordered" id="iddatatable" >
                            <thead style="background-color: #00bcd4;color: white; font-weight: bold;">
                                <tr>
                                    <th>Fecha Hasta *</th>
                                    <th>Seleccione Cantidad de Pólizas *</th>
                                    <th>Total Prima Cobrada</th>
                                    <th>Total Comisión Cobrada</th>
                                    <th>Fecha Creación GC *</th>
                                    <th hidden>id reporte</th>
                                    <th hidden>cia</th>
                                    <th hidden>cant_poliza</th>
                                    <th hidden></th>
                                </tr>
                            </thead>
                            <tbody >
                                <tr style="background-color: white">
                                    
                                    <td><div class="input-group date">
                                            <input onblur="validarReporte(this)" type="text" class="form-control" id="f_hasta" name="f_hasta" required >
                                        </div>
                                    </td>

                                    
                                    <td><select class="custom-select" id="cant_poliza" name="cant_poliza" required data-toggle="tooltip" data-placement="bottom" title="Seleccione un Nº correspondiente a la Cantidad de Pólizas a Cargar">
                                        <option value="">Seleccione Cantidad de Pólizas</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option> 
                                        <option value="3">3</option> 
                                        <option value="4">4</option> 
                                        <option value="5">5</option> 
                                        <option value="6">6</option> 
                                        <option value="7">7</option> 
                                        <option value="8">8</option> 
                                        <option value="9">9</option> 
                                        <option value="10">10</option> 
                                    </select></td>
                                    <td><input type="number" step="0.01" class="form-control" id="primat_com" name="primat_com" required></td>
                                    <td><input type="number" step="0.01" class="form-control" id="comt" name="comt" required></td>

                                    <td><div class="input-group date">
                                            <input onblur="cargar_f()" type="text" class="form-control" id="f_pagoGc" name="f_pagoGc" required >
                                        </div>
                                    </td>

                                    <td hidden><input type="text" class="form-control" id="id_rep" name="id_rep" value="0"></td>
                                    <td hidden><input type="text" class="form-control" id="cia" name="cia" value="<?= $idcia;?>"></td>
                                    <td hidden><input type="text" class="form-control" id="exx" name="exx"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <button type="submit" id="btnForm" class="btn btn-info btn-lg btn-round">Confirmar</button>
                </form>
                </center>

 
                
                <h2 style="color:green" id="sumaP"></h2>
                <h2 style="color:green" id="sumaP1"></h2>
                        
                            
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

    <script src="../../bootstrap-datepicker/js/bootstrap-datepicker.js"></script>  
    <script src="../../bootstrap-datepicker/locales/bootstrap-datepicker.es.min.js" charset="UTF-8"></script>

    
    <script type="text/javascript">

        $(document).ready(function(){
            $('#cant_poliza option:first').prop('selected',true);
            
        });


        $('#f_desde').datepicker({  
            format: "dd-mm-yyyy"
        });

        $('#f_hasta').datepicker({  
            format: "dd-mm-yyyy"
        });

        $('#f_pagoGc').datepicker({  
            format: "dd-mm-yyyy"
        });

        function validarReporte(f_hasta){
            
            if (f_hasta.value=='') {
                
            } else {
                

                var fecha = f_hasta.value.split('-').reverse().join('-');
                let date = new Date(fecha)
                let day = 10
                let month = date.getMonth()+2
                let year = date.getFullYear()

            
            $.ajax({
                
                
                type:"POST",
                data:"f_hasta=" + (f_hasta.value.split('-').reverse().join('-')),        
                url:"validarreporte.php?cia=<?= $cia[0]['idcia'];?>",
                success:function(r){
                    datos=jQuery.parseJSON(r);

                    if (datos['id_rep_com']==null) {
                        $("#existeRep").text('');
                        $("#no_existeRep").text('No se ha creado el Reporte de Comisión para la Cía y Fecha Seleccionada');
                        
                        $("#id_rep").val(0); 
                        $("#f_pagoGc").datepicker("setDate", `${day}-${month}-${year}`);  
                        $("#f_pagoGc").css('background-color', 'gold');

                        


                        $("#exx").val(0);  

                        $("#primat_com").val('');
                        $("#comt").val('');
                        
                    }
                    else{
                        $("#existeRep").text('Reporte de Comisión ya Generado para la Cía y Fecha Seleccionada');
                        $("#no_existeRep").text('');   

                        $("#id_rep").val(datos['id_rep_com']);  

                        var f_pagoGc = datos['f_pago_gc'].split('-').reverse().join('-');
                        //var f_desde = datos['f_desde_rep'].split('-').reverse().join('-');
                        $("#f_pagoGc").val(f_pagoGc); 
                        $( "#f_pagoGc" ).datepicker( "setDate", f_pagoGc );
                        $("#f_pagoGc").css('background-color', 'white');

                        $("#exx").val(1);

                        $("#primat_com").val(datos['primat_com']);
                        $("#comt").val(datos['comt']);


                    
                        $.ajax({
                            type:"POST",
                            data:"id_rep_com=" + (datos['id_rep_com']),        
                            url:"sumar_rep.php?id_rep_com="+datos['id_rep_com'],
                            success:function(r){
                                datos1=jQuery.parseJSON(r);
                                console.log(datos1);
                                if (datos1['SUM(prima_com)']==null) {
                                    $("#sumaP").text('No se han cargado comisiones al reporte todavía');
                                }   
                                else{
                                    
                                    
                                    var restante = new Intl.NumberFormat().format(datos['primat_com'] - datos1['SUM(prima_com)']);
                                    $("#sumaP").text('La Prima Cobrada Pendiente a Cargar es: $'+restante);


                                    var comRestante = new Intl.NumberFormat().format(datos['comt'] - datos1['SUM(comt)']);
                                    $("#sumaP1").text('La Comisión Cobrada Pendiente a Cargar es: $'+comRestante);
                                }
                                
                            }
                        });
                        




                    }
                }
            });
            }

        }

        function cargar_f(){
            $("#f_pagoGc").css('background-color', 'white');
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