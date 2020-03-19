<?php
session_start();
if (isset($_SESSION['seudonimo'])) {
} else {
    header("Location: login.php");
    exit();
}

require_once("../../class/clases.php");

$obj1 = new Trabajo();
$ramo = $obj1->get_element('dramo', 'cod_ramo');

$obj2 = new Trabajo();
$cia = $obj2->get_element('dcia', 'nomcia');

$obj4 = new Trabajo();
$usuario = $obj4->get_element_by_id('usuarios', 'seudonimo', $_SESSION['seudonimo']);

$obj3 = new Trabajo();
$asesor = $obj3->get_element('ena', 'idnom');

$obj31 = new Trabajo();
$liderp = $obj31->get_element('enp', 'nombre');

$obj32 = new Trabajo();
$referidor = $obj32->get_element('enr', 'nombre');





?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php require('header.php'); ?>


    <script type="text/javascript">
        function tabular(e, obj) {
            tecla = (document.all) ? e.keyCode : e.which;
            if (tecla != 13) return;
            frm = obj.form;
            for (i = 0; i < frm.elements.length; i++)
                if (frm.elements[i] == obj) {
                    if (i == frm.elements.length - 1) i = -1;
                    break
                }
            frm.elements[i + 1].focus();
            return false;
        }
    </script>
</head>

<body class="profile-page ">

    <?php require('navigation.php'); ?>




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
            <div class="container">
                <center>
                    <div class="col-md-auto col-md-offset-2">
                        <?php
                        if (isset($_GET['cond'])) {
                        ?>
                            <h1 class="title"><i class="fa fa-check-square-o text-success" aria-hidden="true"></i>&nbsp;Agregada con Éxito</h1>
                        <?php
                        }
                        ?>
                        <h1 class="title"><i class="fa fa-book" aria-hidden="true"></i>&nbsp;Añadir Nueva Póliza</h1>
                    </div>

                    <h2 id="verifP" class="bg-warning" hidden>Espere mientras se verifica la póliza!</h2>

                    <h2 id="existeP" class="bg-success text-white"><strong></strong></h2>
                    <h2 id="no_existeP" class="bg-danger text-white"><strong></strong></h2>
                    <form class="form-horizontal" id="frmnuevo" action="poliza.php" method="post">
                        <div class="form-row table-responsive">
                            <table class="table table-hover table-striped table-bordered" id="iddatatable">
                                <thead style="background-color: #00bcd4;color: white; font-weight: bold;">
                                    <tr>
                                        <th>N° de Póliza *</th>
                                        <!-- <th>Fecha Emisión *</th> -->
                                        <th>Fecha Desde Seguro *</th>
                                        <th>Fecha Hasta Seguro *</th>
                                        <th>Tipo de Póliza *</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <div class="form-group col-md-12">
                                        <tr style="background-color: white">
                                            <td><input onblur="cargarRecibo(this);validarPoliza(this)" onkeypress="return tabular(event,this)" type="text" class="form-control validanumericos" id="n_poliza" name="n_poliza" required data-toggle="tooltip" data-placement="bottom" title="Campo Obligatorio [Sólo introducir números]"></td>
                                            <!-- <td hidden="true"><div class="input-group date">
                                            <input onblur="cargarFecha(this)" type="text" class="form-control" id="emisionP" name="emisionP" required data-toggle="tooltip" data-placement="bottom" title="Campo Obligatorio"> 
                                        </div>
                                    </td>
                                    <td hidden="true">
                                        <input type="text" class="form-control" id="emisionP1" name="emisionP1">
                                    </td>-->
                                            <td>
                                                <div class="input-group date">
                                                    <input onblur="cargarFechaDesde(this)" type="text" class="form-control" id="desdeP" name="desdeP" required data-toggle="tooltip" data-placement="bottom" title="Campo Obligatorio" autocomplete="off">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="input-group date">
                                                    <input type="text" class="form-control" id="hastaP" name="hastaP" required data-toggle="tooltip" data-placement="bottom" title="Campo Obligatorio" autocomplete="off">
                                                </div>
                                            </td>
                                            <td><select class="custom-select" id="tipo_poliza" name="tipo_poliza" required data-toggle="tooltip" data-placement="bottom" title="Seleccione un elemento de la lista">
                                                    <option value="">Seleccione Tipo Póliza</option>
                                                    <option value="1">Primer Año</option>
                                                    <option value="2">Renovación</option>
                                                    <option value="3">Traspaso de Cartera</option>
                                                    <option value="4">Anexos</option>
                                                    <option value="5">Revalorización</option>
                                                </select>
                                            </td>
                                        </tr>
                                    </div>
                                </tbody>
                            </table>
                        </div>



                        <div class="form-row table-responsive">
                            <table class="table table-hover table-striped table-bordered">
                                <thead style="background-color: #00bcd4;color: white; font-weight: bold;">
                                    <tr>
                                        <th>Ramo *</th>
                                        <th>Compañía *</th>
                                        <th>Tipo de Cuenta</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <tr style="background-color: white">
                                        <td><select class="custom-select" id="ramo" name="ramo" required data-toggle="tooltip" data-placement="bottom" title="Seleccione un elemento de la lista">
                                                <option value="">Seleccione el Ramo</option>
                                                <?php
                                                for ($i = 0; $i < sizeof($ramo); $i++) {
                                                ?>
                                                    <option value="<?= $ramo[$i]["cod_ramo"]; ?>"><?= utf8_encode($ramo[$i]["nramo"]); ?></option>
                                                <?php } ?>
                                            </select>
                                        </td>
                                        <td><select class="custom-select" id="cia" name="cia" required data-toggle="tooltip" data-placement="bottom" title="Seleccione un elemento de la lista">
                                                <option value="">Seleccione Compañía</option>
                                                <?php
                                                for ($i = 0; $i < sizeof($cia); $i++) {
                                                ?>
                                                    <option value="<?= $cia[$i]["idcia"]; ?>"><?= ($cia[$i]["nomcia"]); ?></option>
                                                <?php } ?>
                                            </select>
                                        </td>
                                        <td><select class="custom-select" id="t_cuenta" name="t_cuenta" required data-toggle="tooltip" data-placement="bottom" title="Seleccione un elemento de la lista">
                                                <option value="1">Individual</option>
                                                <option value="2">Colectivo</option>
                                            </select>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>


                        <div class="form-row table-responsive">
                            <table class="table table-hover table-striped table-bordered" id="iddatatable">
                                <thead style="background-color: #00bcd4;color: white; font-weight: bold;">
                                    <tr>
                                        <th hidden>Tipo de Cobertura</th>
                                        <th>Moneda</th>
                                        <th>Suma Asegurada</th>
                                        <th style="background-color: #E54848;">Prima Total sin Impuesto *</th>
                                        <th>Periocidad de Pago *</th>
                                        <th>Forma de Pago *</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <div class="form-group col-md-12">
                                        <tr style="background-color: white">
                                            <td hidden><input type="text" class="form-control" id="t_cobertura" name="t_cobertura" onkeyup="mayus(this)" onkeypress="return tabular(event,this)" /></td>
                                            <td><select class="custom-select" id="currency" name="currency" required>
                                                    <option value="1">$</option>
                                                    <option value="2">BsS</option>
                                                </select>
                                            </td>
                                            <td><input type="text" class="form-control validanumericos1" id="sumaA" name="sumaA" data-toggle="tooltip" data-placement="bottom" title="Sólo introducir números y punto (.) como separador decimal" onkeypress="return tabular(event,this)" /></td>
                                            <td><input type="text" class="form-control validanumericos2" id="prima" name="prima" required data-toggle="tooltip" data-placement="bottom" title="Campo Obligatorio [Sólo introducir números y punto (.) como separador decimal]" onkeypress="return tabular(event,this)" /></td>
                                            <td><select onblur="cargarCuotas(this)" class="custom-select" name="f_pago" id="f_pago" required>
                                                    <option value="">Seleccione Forma de Pago</option>
                                                    <option value="1">CONTADO</option>
                                                    <option value="2">FRACCIONADO</option>
                                                    <option value="3">FINANCIADO</option>
                                                </select>
                                            </td>

                                            <td><select onblur="cargarTarjeta(this)" class="custom-select" name="forma_pago" id="forma_pago" required>
                                                    <option value="1">ACH (CARGO EN CUENTA)</option>
                                                    <option value="2">TARJETA DE CREDITO / DEBITO</option>
                                                    <option value="3">PAGO VOLUNTARIO</option>
                                                </select>
                                            </td>
                                        </tr>

                                        <tr style="background-color: #00bcd4;color: white; font-weight: bold;" hidden id="trTarjeta1">
                                            <th>Nº Tarjeta</th>
                                            <th>CVV</th>
                                            <th>Fecha de Vencimiento</th>
                                            <th>Nombre Tarjetahabiente</th>
                                            <th>Banco</th>
                                            <th hidden>alert</th>
                                            <th hidden>id_tarjeta</th>
                                        </tr>
                                        <tr style="background-color: white" hidden id="trTarjeta2">
                                            <td><input type="number" step="0.01" onblur="validarTarjeta(this)" class="form-control" id="n_tarjeta" name="n_tarjeta" data-toggle="tooltip" data-placement="bottom" title="Campo Obligatorio [Sólo introducir números]" onkeypress="return tabular(event,this)" /></td>
                                            <td><input type="text" class="form-control validanumericos7" id="cvv" name="cvv" data-toggle="tooltip" data-placement="bottom" title="Campo Obligatorio [Sólo introducir números]" onkeypress="return tabular(event,this)" /></td>
                                            <td>
                                                <div class="input-group date">
                                                    <input type="text" class="form-control" id="fechaV" name="fechaV" data-toggle="tooltip" data-placement="bottom" title="Campo Obligatorio" autocomplete="off" />
                                                </div>
                                            </td>
                                            <td><input type="text" class="form-control" id="titular_tarjeta" name="titular_tarjeta" onkeyup="mayus(this);" data-toggle="tooltip" data-placement="bottom" title="Nombre del Tarjetahabiente" onkeypress="return tabular(event,this)" /></td>
                                            <td><input type="text" class="form-control" id="bancoT" name="bancoT" onkeyup="mayus(this);" data-toggle="tooltip" data-placement="bottom" title="Nombre del Banco" onkeypress="return tabular(event,this)" /></td>

                                            <td hidden><input type="text" class="form-control" id="alert" name="alert" value="0" /></td>
                                            <td hidden><input type="text" class="form-control" id="id_tarjeta" name="id_tarjeta" value="0" /></td>

                                            <td hidden><input type="text" class="form-control" id="cvv_h" name="cvv_h" value="0" /></td>
                                            <td hidden>
                                                <div class="input-group date">
                                                    <input type="text" class="form-control" id="fechaV_h" name="fechaV_h" value="0" />
                                                </div>
                                            </td>
                                            <td hidden><input type="text" class="form-control" id="titular_tarjeta_h" name="titular_tarjeta_h" value="0" /></td>
                                            <td hidden><input type="text" class="form-control" id="bancoT_h" name="bancoT_h" value="0" /></td>
                                        </tr>

                                    </div>
                                </tbody>
                            </table>
                        </div>



                        <div class="form-row table-responsive">
                            <table class="table table-hover table-striped table-bordered" id="iddatatable">
                                <thead style="background-color: #00bcd4;color: white; font-weight: bold;">
                                    <tr>
                                        <th>N° Recibo *</th>
                                        <th>Fecha Desde Recibo *</th>
                                        <th>Fecha Hasta Recibo *</th>
                                        <th>Zona de Produc</th>
                                        <th>N° de Cuotas *</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <div class="form-group col-md-12">
                                        <tr style="background-color: white">
                                            <td><input type="text" class="form-control" id="n_recibo" name="n_recibo" required data-toggle="tooltip" data-placement="bottom" title="Campo Obligatorio [Sólo introducir números]" /></td>
                                            <td>
                                                <div class="input-group date">
                                                    <input type="text" class="form-control" id="desde_recibo" name="desde_recibo" required data-toggle="tooltip" data-placement="bottom" title="Campo Obligatorio" />
                                                </div>
                                            </td>
                                            <td>
                                                <div class="input-group date">
                                                    <input type="text" class="form-control" id="hasta_recibo" name="hasta_recibo" required data-toggle="tooltip" data-placement="bottom" title="Campo Obligatorio" />
                                                </div>
                                            </td>
                                            <td><input type="text" class="form-control" id="z_produc" name="z_produc" readonly="true" value="<?= utf8_encode($usuario[0]['z_produccion']); ?>" /></td>
                                            <td><input type="number" class="form-control validanumericos3" id="n_cuotas" name="n_cuotas" min="1" max="12" required data-toggle="tooltip" data-placement="bottom" title="Campo Obligatorio" /></td>
                                        </tr>
                                    </div>
                                </tbody>
                            </table>
                        </div>


                        <h2 id="existeT" class="text-success"><strong></strong></h2>
                        <h2 id="no_existeT" class="text-danger"><strong></strong></h2>
                        <div class="form-row table-responsive">
                            <table class="table table-hover table-striped table-bordered" id="iddatatable">
                                <thead style="background-color: #00bcd4;color: white; font-weight: bold;">
                                    <tr>
                                        <th>N° ID Titular *</th>
                                        <th>Nombre(s) Titular</th>
                                        <th>Apellido(s) Titular</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <div class="form-group col-md-12">
                                        <tr style="background-color: white">
                                            <td><input onblur="validartitular(this)" type="text" class="form-control validanumericos5" id="titular" name="titular" required data-toggle="tooltip" data-placement="bottom" title="Campo Obligatorio" /></td>
                                            <td><input type="text" class="form-control" id="n_titular" name="n_titular" readonly="readonly" required="true" /></td>
                                            <td><input type="text" class="form-control" id="a_titular" name="a_titular" readonly="readonly" required="true" /></td>
                                        </tr>
                                    </div>
                                </tbody>
                            </table>
                        </div>


                        <center><a href="" class="btn btn-danger btn-lg btn-round" id="btnAggT" hidden="true" data-toggle="modal" data-target="#agregarnuevotitular">Crear Nuevo Titular</a></center>


                        <h2 id="existeTom" class="text-success"><strong></strong></h2>
                        <h2 id="no_existeTom" class="text-danger"><strong></strong></h2>
                        <div class="form-row table-responsive" id="tablatomador" hidden="true">
                            <table class="table table-hover table-striped table-bordered" id="iddatatable">
                                <thead style="background-color: #00bcd4;color: white; font-weight: bold;">
                                    <tr>
                                        <th>N° ID Tomador *</th>
                                        <th>Nombre(s) Tomador</th>
                                        <th>Apellido(s) Tomador</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <div class="form-group col-md-12">
                                        <tr style="background-color: white">
                                            <td><input onblur="validartomador(this)" type="text" class="form-control validanumericos6" id="tomador" name="tomador" required data-toggle="tooltip" data-placement="bottom" title="Campo Obligatorio" /></td>
                                            <td><input type="text" class="form-control" id="n_tomador" name="n_tomador" readonly="readonly" /></td>
                                            <td><input type="text" class="form-control" id="a_tomador" name="a_tomador" readonly="readonly" /></td>
                                        </tr>
                                    </div>
                                </tbody>
                            </table>
                        </div>

                        <center><a href="" class="btn btn-danger btn-lg btn-round" id="btnAggTom" hidden="true" data-toggle="modal" data-target="#agregarnuevotomador">Crear Nuevo Tomador</a></center>


                        <div class="form-row table-responsive" id="tablaveh" hidden="true">
                            <h2 class="text-info"><strong>Datos Vehículo</strong></h2>
                            <table class="table table-hover table-striped table-bordered" id="idtablaveh">
                                <thead style="background-color: #00bcd4;color: white; font-weight: bold;">
                                    <tr>
                                        <th>Placa</th>
                                        <th>Marca</th>
                                        <th>Modelo</th>
                                        <th>Tipo</th>
                                        <th>Año</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <div class="form-group col-md-12">
                                        <tr style="background-color: white">
                                            <td><input type="text" class="form-control" id="placa" name="placa" /></td>
                                            <td><input type="text" class="form-control" id="marca" name="marca" /></td>
                                            <td><input type="text" class="form-control" id="modelo" name="modelo" /></td>
                                            <td><input type="text" class="form-control" id="tipo" name="tipo" /></td>
                                            <td><input type="text" class="form-control" id="anio" name="anio" placeholder="2019" /></td>
                                        </tr>
                                        <!--<tr style="background-color: #00bcd4;color: white; font-weight: bold;">
                                    <th>Año</th>
                                    <th>Color</th>
                                    <th>Serial</th>
                                    <th>Categoría</th>
                                </tr>
                                <tr style="background-color: white">
                                    <td><input type="text" class="form-control" id="anio" name="anio" placeholder="2019" /></td>
                                    <td><input type="text" class="form-control" id="color" name="color" /></td>
                                    <td><input type="text" class="form-control" id="serial" name="serial" /></td>
                                    <td><input type="text" class="form-control" id="categoria" name="categoria" /></td>
                                </tr>-->
                                    </div>
                                </tbody>
                            </table>
                        </div>


                        <center>
                            <div>
                                <table class="table table-hover table-striped table-bordered" id="tablaAsesor">
                                    <thead style="background-color: #00bcd4;color: white; font-weight: bold;">
                                        <tr>
                                            <th>Asesor *</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <tr style="background-color: white">
                                            <td align="center"><select class="form-control selectpicker" id="asesor" name="asesor" required data-toggle="tooltip" data-placement="bottom" title="Seleccione un elemento de la lista" data-style="btn-white" data-header="Seleccione Cía" data-actions-box="true" data-live-search="true">
                                                    <option value="">Seleccione el Asesor</option>
                                                    <?php
                                                    for ($i = 0; $i < sizeof($asesor); $i++) {
                                                    ?>
                                                        <option value="<?= utf8_encode($asesor[$i]["cod"] . "=" . $asesor[$i]["idnom"]); ?>"><?= utf8_encode($asesor[$i]["idnom"]); ?> (Asesor)</option>
                                                    <?php }
                                                    for ($i = 0; $i < sizeof($liderp); $i++) { ?>
                                                        <option value="<?= $liderp[$i]["cod"] . "=" . $liderp[$i]["nombre"]; ?>"><?= utf8_encode($liderp[$i]["nombre"]); ?> (Proyecto)</option>
                                                    <?php }
                                                    for ($i = 0; $i < sizeof($referidor); $i++) { ?>
                                                        <option value="<?= $referidor[$i]["cod"] . "=" . $referidor[$i]["nombre"]; ?>"><?= utf8_encode($referidor[$i]["nombre"]); ?> (Referidor)</option>
                                                    <?php } ?>
                                                </select>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </center>


                        <div class="form-row table-responsive">
                            <table class="table table-hover table-striped table-bordered" id="iddatatable">
                                <thead style="background-color: #00bcd4;color: white; font-weight: bold;">
                                    <tr>
                                        <th>Observaciones</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <div class="form-group col-md-12">
                                        <tr style="background-color: white">
                                            <td><input type="text" class="form-control" id="obs" name="obs" maxlength="200" autocomplete="off" /></td>
                                        </tr>
                                    </div>
                                </tbody>
                            </table>
                        </div>



                        <center>
                            <button type="submit" id="btnForm" class="btn btn-info btn-lg btn-round">Previsualizar</button>
                        </center>

                    </form>
                </center>
            </div>

        </div>







        <?php require('footer_b.php'); ?>






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
    <!-- Fixed Sidebar Nav - js With initialisations For Demo Purpose, Dont Include it in your project -->
    <script src="../../assets/assets-for-demo/js/material-kit-demo.js"></script>

    <script src="../../bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
    <script src="../../bootstrap-datepicker/locales/bootstrap-datepicker.es.min.js" charset="UTF-8"></script>

    <!-- Bootstrap Select JavaScript -->
    <script src="../../js/bootstrap-select.js"></script>



    <!-- Modal -->
    <div class="modal fade" id="agregarnuevotitular" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Debe Agregar Nuevo Cliente</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="frmnuevoT" autocomplete="off">

                        <div class="form-row">
                            <table class="table table-hover table-striped table-bordered" id="iddatatable">
                                <thead style="background-color: #00bcd4;color: white; font-weight: bold;">
                                    <tr>
                                        <th>Razón Social *</th>
                                        <th colspan="3">N° ID Titular</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <div class="form-group col-md-12">
                                        <tr style="background-color: white">
                                            <td><select class="custom-select" name="r_sNew" id="r_sNew" required>
                                                    <option value="">Seleccione</option>
                                                    <option value="PN-">PN-</option>
                                                    <option value="J-">J-</option>
                                                </select>
                                            </td>
                                            <td colspan="3"><input type="text" class="form-control" id="id_new_titular" name="id_new_titular" readonly="readonly"></td>
                                        </tr>
                                        <tr style="background-color: #00bcd4;color: white; font-weight: bold;">
                                            <th colspan="2">Nombre(s) Titular *</th>
                                            <th colspan="2">Apellido(s) Titular</th>
                                        </tr>
                                        <tr style="background-color: white">
                                            <td colspan="2"><input type="text" class="form-control" id="nT_new" name="nT_new" required onkeyup="mayus(this);"></td>
                                            <td colspan="2"><input type="text" class="form-control" id="aT_new" name="aT_new" required onkeyup="mayus(this);"></td>
                                        </tr>
                                        <tr style="background-color: #00bcd4;color: white; font-weight: bold;">
                                            <!--<th>Sexo *</th>-->
                                            <th colspan="2">Celular *</th>
                                            <th colspan="2">Teléfono</th>
                                            <!--<th>Teléfono Adicional</th>-->
                                        </tr>
                                        <tr style="background-color: white">
                                            <!--<td><select class="custom-select" name="sT_new" required>
                                            <option value="">Seleccione</option>
                                            <option value="1">MASCULINO</option>
                                            <option value="2">FEMENINO</option>
                                            <option value="3">JURIDICO</option>
                                        </select>
                                    </td>-->
                                            <td colspan="2"><input type="text" class="form-control" id="cT_new" name="cT_new" required></td>
                                            <td colspan="2"><input type="text" class="form-control" id="tT_new" name="tT_new" required></td>
                                            <!--<td><input type="text" class="form-control" id="t1T_new" name="t1T_new" required></td>-->
                                        </tr>
                                        <tr style="background-color: #00bcd4;color: white; font-weight: bold;">
                                            <!--<th>Estado Civil *</th>-->
                                            <th>Fecha de Nacimiento</th>
                                            <th colspan="2">Email *</th>
                                            <!--<th>Email Adicional</th>-->
                                        </tr>
                                        <tr style="background-color: white">
                                            <!--<td><select class="custom-select" name="ecT_new" required>
                                            <option value="1">SOLTERO</option>
                                            <option value="2">CASADO</option>
                                            <option value="3">DIVORCIADO</option>
                                        </select>
                                    </td>-->
                                            <td><input type="text" class="form-control" id="fnT_new" name="fnT_new" required></td>
                                            <td colspan="2"><input type="email" class="form-control" id="eT_new" name="eT_new" required></td>
                                            <!--<td><input type="email" class="form-control" id="e1T_new" name="e1T_new" required></td>-->
                                        </tr>
                                        <tr style="background-color: #00bcd4;color: white; font-weight: bold;">
                                            <th colspan=4>Dirección *</th>
                                        </tr>
                                        <tr style="background-color: white">
                                            <td colspan=4><input type="text" class="form-control" id="dT_new" name="dT_new" required onkeyup="mayus(this);"></td>
                                        </tr>
                                        <!--<tr style="background-color: #00bcd4;color: white; font-weight: bold;">
                                    <th colspan=4>Dirección Oficina</th>
                                </tr>
                                <tr style="background-color: white">
                                    <td colspan=4><input type="text" class="form-control" id="d1T_new" name="d1T_new" required onkeyup="mayus(this);"></td>
                                </tr>-->
                                        <tr style="background-color: #00bcd4;color: white; font-weight: bold;">
                                            <th colspan=2>Ocupación</th>
                                            <th colspan=2>Ingreso</th>
                                        </tr>
                                        <tr style="background-color: white">
                                            <td colspan=2><input type="text" class="form-control" id="oT_new" name="oT_new" required onkeyup="mayus(this);"></td>
                                            <td colspan=2><input type="text" class="form-control validanumericos4" id="iT_new" name="iT_new" value="0" required></td>
                                        </tr>
                                    </div>
                                </tbody>
                            </table>
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="btnAgregarnuevo" class="btn btn-success">Agregar nuevo</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal TOMADOR -->
    <div class="modal fade" id="agregarnuevotomador" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Debe Agregar Nuevo Cliente</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="frmnuevoTom" autocomplete="off">

                        <div class="form-row">
                            <table class="table table-hover table-striped table-bordered nowrap" id="iddatatable1">
                                <thead style="background-color: #00bcd4;color: white; font-weight: bold;">
                                    <tr>
                                        <th>Razón Social *</th>
                                        <th colspan="3">N° ID Tomador</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <div class="form-group col-md-12">
                                        <tr style="background-color: white">
                                            <td><select class="custom-select" name="r_sNewT" id="r_sNewT" required>
                                                    <option value="">Seleccione</option>
                                                    <option value="PN-">PN-</option>
                                                    <option value="J-">J-</option>
                                                </select>
                                            </td>
                                            <td colspan="3"><input type="text" class="form-control" id="id_new_titularT" name="id_new_titularT" readonly="readonly"></td>
                                        </tr>
                                        <tr style="background-color: #00bcd4;color: white; font-weight: bold;">
                                            <th colspan="2">Nombre(s) Tomador *</th>
                                            <th colspan="2">Apellido(s) Tomador</th>
                                        </tr>
                                        <tr style="background-color: white">
                                            <td colspan="2"><input type="text" class="form-control" id="nT_newT" name="nT_newT" required onkeyup="mayus(this);"></td>
                                            <td colspan="2"><input type="text" class="form-control" id="aT_newT" name="aT_newT" required onkeyup="mayus(this);"></td>
                                        </tr>
                                        <tr style="background-color: #00bcd4;color: white; font-weight: bold;">
                                            <!--<th>Sexo *</th>-->
                                            <th colspan="2">Celular *</th>
                                            <th colspan="2">Teléfono</th>
                                            <!--<th>Teléfono Adicional</th>-->
                                        </tr>
                                        <tr style="background-color: white">
                                            <!--<td><select class="custom-select" name="sT_newT" required>
                                            <option value="">Seleccione</option>
                                            <option value="1">MASCULINO</option>
                                            <option value="2">FEMENINO</option>
                                            <option value="3">JURIDICO</option>
                                        </select>
                                    </td>-->
                                            <td colspan="2"><input type="text" class="form-control" id="cT_newT" name="cT_newT" required></td>
                                            <td colspan="2"><input type="text" class="form-control" id="tT_newT" name="tT_newT" required></td>
                                            <!--<td><input type="text" class="form-control" id="t1T_newT" name="t1T_newT" required></td>-->
                                        </tr>
                                        <tr style="background-color: #00bcd4;color: white; font-weight: bold;">
                                            <!--<th>Estado Civil *</th>-->
                                            <th>Fecha de Nacimiento</th>
                                            <th colspan="2">Email *</th>
                                            <!--<th>Email Adicional</th>-->
                                        </tr>
                                        <tr style="background-color: white">
                                            <!--<td><select class="custom-select" name="ecT_newT" required>
                                            <option value="1">SOLTERO</option>
                                            <option value="2">CASADO</option>
                                            <option value="3">DIVORCIADO</option>
                                        </select>
                                    </td>-->
                                            <td><input type="text" class="form-control" id="fnT_newT" name="fnT_newT" required></td>
                                            <td colspan="2"><input type="email" class="form-control" id="eT_newT" name="eT_newT" required></td>
                                            <!--<td><input type="email" class="form-control" id="e1T_newT" name="e1T_newT" required></td>-->
                                        </tr>
                                        <tr style="background-color: #00bcd4;color: white; font-weight: bold;">
                                            <th colspan=4>Dirección *</th>
                                        </tr>
                                        <tr style="background-color: white">
                                            <td colspan=4><input type="text" class="form-control" id="dT_newT" name="dT_newT" required onkeyup="mayus(this);"></td>
                                        </tr>
                                        <!--<tr style="background-color: #00bcd4;color: white; font-weight: bold;">
                                    <th colspan=4>Dirección Oficina</th>
                                </tr>
                                <tr style="background-color: white">
                                    <td colspan=4><input type="text" class="form-control" id="d1T_newT" name="d1T_newT" required onkeyup="mayus(this);"></td>
                                </tr>-->
                                        <tr style="background-color: #00bcd4;color: white; font-weight: bold;">
                                            <th colspan=2>Ocupación</th>
                                            <th colspan=2>Ingreso</th>
                                        </tr>
                                        <tr style="background-color: white">
                                            <td colspan=2><input type="text" class="form-control" id="oT_newT" name="oT_newT" required onkeyup="mayus(this);"></td>
                                            <td colspan=2><input type="text" class="form-control validanumericos4" id="iT_newT" name="iT_newT" value="0" required></td>
                                        </tr>
                                    </div>
                                </tbody>
                            </table>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="btnAgregarnuevoT" class="btn btn-success">Agregar nuevo</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal Tarjetas Existentes-->
    <div class="modal fade" id="tarjetaexistente" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Seleccione la Tarjeta</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body ">
                    <form id="frmnuevoP">
                        <div class="table-responsive">
                            <a onclick="selecTarjetaNew()" style="color:white" data-tooltip="tooltip" data-placement="top" title="Añadir Tarjeta Nueva" class="btn btn-success btn-sm pull-right">Añadir Tarjeta Nueva <i class="fa fa-plus" aria-hidden="true"></i></a>
                            <table class="table table-hover table-striped table-bordered" id="tablaPE">
                                <thead style="background-color: #00bcd4;color: white; font-weight: bold;">
                                    <tr>
                                        <th>Nº de Tarjeta</th>
                                        <th>CVV</th>
                                        <th>F Vencimiento</th>
                                        <th>Nombre Tarjetahabiente</th>
                                        <th>Banco</th>
                                        <th>Póliza(s) Asociada(s)</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </form>
                </div>
                <!--
                <div class="modal-footer">
                    <button type="button" id="btnAgregarnuevo" class="btn btn-info">Agregar nuevo</button>
                </div>
                -->
            </div>
        </div>
    </div>




    <script type="text/javascript">
        $(document).ready(function() {

            $("#tipo_poliza").val(1);
            $("#f_pago").val(1);
            $('#n_cuotas').val(1);
            $("#n_cuotas").attr("readonly", true);

            $('#btnAgregarnuevo').click(function() {


                if ($("#r_sNew").val().length < 1) {
                    alertify.error("La Razón Social del Cliente es Obligatoria");
                    return false;
                }
                if ($("#id_new_titular").val().length < 1) {
                    alertify.error("El Nº de ID del Cliente es Obligatorio");
                    return false;
                }
                if ($("#nT_new").val().length < 1) {
                    alertify.error("El Nombre del Cliente es Obligatorio");
                    return false;
                }
                if ($("#dT_new").val().length < 1) {
                    alertify.error("La Dirección del Cliente es Obligatorio");
                    return false;
                }

                datos = $('#frmnuevoT').serialize();
                var titular = $('#id_new_titular').val();
                var n_titular = $('#nT_new').val();
                var a_titular = $('#aT_new').val();

                $.ajax({
                    type: "POST",
                    data: datos,
                    url: "../../procesos/agregarCliente.php",
                    success: function(r) {
                        console.log(r);
                        if (r == 1) {
                            $('#frmnuevoT')[0].reset();
                            alertify.success("Agregado con Exito!!");

                            $('#titular').val(titular);
                            $('#titular').removeAttr('hidden');
                            $('#n_titular').val(n_titular);
                            $('#a_titular').val(a_titular);

                            //$("#btnAggT").attr("hidden",true);
                            $('#no_existeT').text("");
                            $("#titular").attr("readonly", true);
                            $('#titular').removeAttr('onblur');

                            $('#tablatomador').removeAttr('hidden');
                            $('#tomador').val(titular);
                            $('#n_tomador').val(n_titular);
                            $('#a_tomador').val(a_titular);

                            $('#agregarnuevotitular').modal('hide');

                        } else {
                            alertify.error("Fallo al agregar!");

                        }
                    }
                });
            });


            $('#btnAgregarnuevoT').click(function() {


                if ($("#r_sNewT").val().length < 1) {
                    alertify.error("La Razón Social del Cliente es Obligatoria");
                    return false;
                }
                if ($("#id_new_titularT").val().length < 1) {
                    alertify.error("El Nº de ID del Cliente es Obligatorio");
                    return false;
                }
                if ($("#nT_newT").val().length < 1) {
                    alertify.error("El Nombre del Cliente es Obligatorio");
                    return false;
                }
                if ($("#dT_newT").val().length < 1) {
                    alertify.error("La Dirección del Cliente es Obligatorio");
                    return false;
                }

                datos = $('#frmnuevoTom').serialize();
                var titular = $('#id_new_titularT').val();
                var n_titular = $('#nT_newT').val();
                var a_titular = $('#aT_newT').val();

                $.ajax({
                    type: "POST",
                    data: datos,
                    url: "../../procesos/agregarTomador.php",
                    success: function(r) {
                        if (r == 1) {
                            $('#frmnuevoTom')[0].reset();
                            alertify.success("Agregado con Exito!!");



                            //$("#btnAggTom").attr("hidden",true);
                            $('#no_existeTom').text("");

                            $('#tablatomador').removeAttr('hidden');
                            $('#tomador').val(titular);
                            $('#n_tomador').val(n_titular);
                            $('#a_tomador').val(a_titular);

                            $('#agregarnuevotomador').modal('hide');

                        } else {
                            alertify.error("Fallo al agregar!");

                        }
                    }
                });
            });

        });





        $('#emisionP').datepicker({
            format: "dd-mm-yyyy",

        });
        $("#emisionP").datepicker("setDate", new Date());

        $('#desdeP').datepicker({
            format: "dd-mm-yyyy"
        });

        $('#hastaP').datepicker({
            format: "dd-mm-yyyy"
        });

        $('#fechaV').datepicker({
            format: "dd-mm-yyyy"
        });
        $('#fechaV_h').datepicker({
            format: "dd-mm-yyyy"
        });

        $('#desde_recibo').datepicker({
            format: "dd-mm-yyyy"
        });

        $('#hasta_recibo').datepicker({
            format: "dd-mm-yyyy"
        });

        $('#fnT_new').datepicker({
            format: "dd-mm-yyyy"
        });
        $('#fnT_newT').datepicker({
            format: "dd-mm-yyyy"
        });


        onload = function() {
            var ele = document.querySelectorAll('.validanumericos')[0];
            var ele1 = document.querySelectorAll('.validanumericos1')[0];
            var ele2 = document.querySelectorAll('.validanumericos2')[0];
            var ele3 = document.querySelectorAll('.validanumericos3')[0];
            var ele4 = document.querySelectorAll('.validanumericos4')[0];
            var ele5 = document.querySelectorAll('.validanumericos5')[0];
            var ele6 = document.querySelectorAll('.validanumericos6')[0];
            var ele7 = document.querySelectorAll('.validanumericos7')[0];

            ele.onkeypress = function(e) {
                if (isNaN(this.value + String.fromCharCode(e.charCode)))
                    return false;
            }
            ele1.onkeypress = function(e1) {
                if (isNaN(this.value + String.fromCharCode(e1.charCode)))
                    return false;
            }
            ele1.onpaste = function(e1) {
                e1.preventDefault();
            }
            ele2.onkeypress = function(e2) {
                if (isNaN(this.value + String.fromCharCode(e2.charCode)))
                    return false;
            }
            ele2.onpaste = function(e2) {
                e2.preventDefault();
            }
            ele3.onkeypress = function(e3) {
                if (isNaN(this.value + String.fromCharCode(e3.charCode)))
                    return false;
            }
            ele3.onpaste = function(e3) {
                e3.preventDefault();
            }
            ele4.onkeypress = function(e4) {
                if (isNaN(this.value + String.fromCharCode(e4.charCode)))
                    return false;
            }
            ele4.onpaste = function(e4) {
                e4.preventDefault();
            }
            ele5.onkeypress = function(e5) {
                if (isNaN(this.value + String.fromCharCode(e5.charCode)))
                    return false;
            }
            ele5.onpaste = function(e5) {
                e5.preventDefault();
            }
            ele6.onkeypress = function(e6) {
                if (isNaN(this.value + String.fromCharCode(e6.charCode)))
                    return false;
            }
            ele6.onpaste = function(e6) {
                e6.preventDefault();
            }
            ele7.onkeypress = function(e7) {
                if (isNaN(this.value + String.fromCharCode(e7.charCode)))
                    return false;
            }
            ele7.onpaste = function(e7) {
                e7.preventDefault();
            }
        }



        async function validarPoliza(num_poliza) {
            $('#verifP').removeAttr('hidden');

            $('#trTarjeta1').attr('hidden', true);
            $('#trTarjeta2').attr('hidden', true);
            $('#forma_pago').val(1);
            $('#n_tarjeta').val('');
            $('#cvv').val('');
            $('#fechaV').val('');
            $('#titular_tarjeta').val('');
            $('#bancoT').val('');

            $("#bancoT").css('background-color', 'white');
            await $.ajax({
                type: "POST",
                data: "num_poliza=" + num_poliza.value,
                url: "validarpoliza.php?num_poliza=" + num_poliza.value,
                success: function(r) {
                    datos = jQuery.parseJSON(r);


                    if (datos == null) {
                        $('#id_new_titular').val("");
                        $('#existeP').text("");
                        $('#no_existeP').text("No Existe Póliza");
                        $('#titular').val("");
                        $('#n_titular').val("");
                        $('#a_titular').val("");

                        $('#titular').removeAttr("readonly", true);
                        $('#titular').attr('onblur', 'validartitular(this)');

                        $('#tipo_poliza option:first').prop('selected', true);

                        $('#ramo option:first').prop('selected', true);
                        $('#ramo').css('pointer-events', 'auto');
                        $("#ramo").css('background-color', 'white');
                        $('#cia option:first').prop('selected', true);
                        $('#cia').css('pointer-events', 'auto');
                        $("#cia").css('background-color', 'white');
                        $('#t_cuenta option:first').prop('selected', true);
                        $('#t_cuenta').css('pointer-events', 'auto');
                        $("#t_cuenta").css('background-color', 'white');
                        $("#emisionP").val("");
                        //$("#emisionP").css('background-color', 'transparent');
                        //$("#emisionP").css('color', 'black');
                        $('#desdeP').val("");
                        $('#hastaP').val("");

                        $('#btnForm').removeAttr('disabled');

                        var emisionP = new Date();
                        var desdeP = $('#desdeP').val();
                        var hastaP = $('#hastaP').val();
                        $("#emisionP").datepicker("setDate", emisionP);
                        $("#desdeP").datepicker("setDate", desdeP);
                        $("#hastaP").datepicker("setDate", hastaP);
                        $("#desde_recibo").datepicker("setDate", desdeP);
                        $("#hasta_recibo").datepicker("setDate", hastaP);


                        $('#t_cobertura').val("");
                        $('#t_cobertura').removeAttr('readonly');
                        $('#currency option:first').prop('selected', true);
                        $('#currency').css('pointer-events', 'auto');
                        $("#currency").css('background-color', 'white');



                        $('#tomador').val("");
                        $('#n_tomador').val("");
                        $('#a_tomador').val("");

                        $('#asesor option:first').prop('selected', true);

                        $('#existeT').text("");
                        $('#no_existeT').text("");
                        $('#titular').val("");

                        $('#tablatomador').attr("hidden", true);

                        $('#existeTom').text("");
                        $('#no_existeTom').text("");
                        $("#tomador").css('color', 'black');

                        $('#tablaveh').attr('hidden', true);
                        $('#placa').val('');
                        $('#tipo').val('');
                        $('#marca').val('');
                        $('#modelo').val('');
                        $('#anio').val('');
                        $('#serial').val('');
                        $('#color').val('');
                        $('#categoria').val('');


                    } else {

                        if (datos[0]['id_cod_ramo'] == null) {

                            $('#id_new_titular').val("");
                            $('#existeP').text("");
                            $('#no_existeP').text("No Existe Póliza");
                            $('#titular').val("");
                            $('#n_titular').val("");
                            $('#a_titular').val("");

                            $('#titular').removeAttr("readonly", true);
                            $('#titular').attr('onblur', 'validartitular(this)');

                            $('#tipo_poliza option:first').prop('selected', true);

                            $('#ramo option:first').prop('selected', true);
                            $('#ramo').css('pointer-events', 'auto');
                            $("#ramo").css('background-color', 'white');
                            $('#cia option:first').prop('selected', true);
                            $('#cia').css('pointer-events', 'auto');
                            $("#cia").css('background-color', 'white');
                            $('#t_cuenta option:first').prop('selected', true);
                            $('#t_cuenta').css('pointer-events', 'auto');
                            $("#t_cuenta").css('background-color', 'white');
                            $("#emisionP").val("");
                            //$("#emisionP").css('background-color', 'transparent');
                            //$("#emisionP").css('color', 'black');
                            $('#desdeP').val("");
                            $('#hastaP').val("");

                            $('#btnForm').removeAttr('disabled');

                            var emisionP = new Date();
                            var desdeP = $('#desdeP').val();
                            var hastaP = $('#hastaP').val();
                            $("#emisionP").datepicker("setDate", emisionP);
                            $("#desdeP").datepicker("setDate", desdeP);
                            $("#hastaP").datepicker("setDate", hastaP);
                            $("#desde_recibo").datepicker("setDate", desdeP);
                            $("#hasta_recibo").datepicker("setDate", hastaP);


                            $('#t_cobertura').val("");
                            $('#t_cobertura').removeAttr('readonly');
                            $('#currency option:first').prop('selected', true);
                            $('#currency').css('pointer-events', 'auto');
                            $("#currency").css('background-color', 'white');



                            $('#tomador').val("");
                            $('#n_tomador').val("");
                            $('#a_tomador').val("");

                            $('#asesor option:first').prop('selected', true);

                            $('#existeT').text("");
                            $('#no_existeT').text("");
                            $('#titular').val("");

                            $('#tablatomador').attr("hidden", true);

                            $('#existeTom').text("");
                            $('#no_existeTom').text("");
                            $("#tomador").css('color', 'black');

                            $('#tablaveh').attr('hidden', true);
                            $('#placa').val('');
                            $('#tipo').val('');
                            $('#marca').val('');
                            $('#modelo').val('');
                            $('#anio').val('');
                            $('#serial').val('');
                            $('#color').val('');
                            $('#categoria').val('');
                        } else if (datos[0]['id_cod_ramo'] == 2 || datos[0]['id_cod_ramo'] == 25) {
                            alertify.confirm('Existe!', 'La Póliza que introdujo ya Existe ¿Desea Renovarla?',
                                function() {
                                    alertify.prompt('Desea modificar el Nº de Póliza?', 'Ingrese el Nº de Póliza Nuevo', num_poliza.value,
                                        function(evt, value) {
                                            alertify.notify('Nuevo Nº de Póliza es: ' + value);
                                            alertify.success('Proceda a Renovar la Póliza');
                                            $('#n_poliza').val(value);
                                            $('#titular').val(datos[0]['ci']);
                                            $('#titular').removeAttr('onblur');
                                            $('#titular').attr("readonly", true);
                                            $('#n_titular').val(datos[0]['nombre_t']);
                                            $('#a_titular').val(datos[0]['apellido_t']);

                                            $("#tipo_poliza").val(2);
                                            $("#ramo").val(datos[0]['id_cod_ramo']);
                                            //$('#ramo').css('pointer-events','none');
                                            //$("#ramo").css('background-color', '#e6e6e6');
                                            $("#cia").val(datos[0]['id_cia']);
                                            //$('#cia').css('pointer-events','none');
                                            //$("#cia").css('background-color', '#e6e6e6');
                                            $("#t_cuenta").val(datos[0]['t_cuenta']);
                                            $('#t_cuenta').css('pointer-events', 'none');
                                            $("#t_cuenta").css('background-color', '#e6e6e6');
                                            var emisionP = datos[0]['f_emi'].split('-').reverse().join('-');
                                            $("#emisionP").val(emisionP);
                                            //$("#emisionP1").val(datos[0]['f_emi']);
                                            //$('#emisionP').attr("disabled",true);
                                            $('#desdeP').val(datos[0]['f_desdepoliza']);
                                            $('#hastaP').val(datos[0]['f_hastapoliza']);


                                            var mydate = new Date($('#desdeP').val());
                                            $('#desdeP').val((mydate.getFullYear() + 1) + '-' + (mydate.getMonth() + 01) + '-' + (mydate.getDate() + 1));

                                            var mydate1 = new Date($('#hastaP').val());
                                            $('#hastaP').val((mydate1.getFullYear() + 1) + '-' + (mydate1.getMonth() + 01) + '-' + (mydate1.getDate() + 1));


                                            var desdeP = ($('#desdeP').val()).split('-').reverse().join('-');
                                            var hastaP = ($('#hastaP').val()).split('-').reverse().join('-');
                                            $('#desdeP').val(desdeP);
                                            $('#hastaP').val(hastaP);
                                            $("#emisionP").datepicker("setDate", emisionP);
                                            $("#desdeP").datepicker("setDate", desdeP);
                                            $("#hastaP").datepicker("setDate", hastaP);


                                            $("#desde_recibo").datepicker("setDate", desdeP);
                                            $("#hasta_recibo").datepicker("setDate", hastaP);

                                            $('#placa').val(datos[0]['placa']);
                                            $('#tipo').val(datos[0]['tveh']);
                                            $('#marca').val(datos[0]['marca']);
                                            $('#modelo').val(datos[0]['mveh']);
                                            $('#anio').val(datos[0]['f_veh']);
                                            $('#serial').val(datos[0]['serial']);
                                            $('#color').val(datos[0]['cveh']);
                                            $('#categoria').val(datos[0]['catveh']);

                                            $('#t_cobertura').val(datos[0]['tcobertura']);
                                            $('#t_cobertura').attr("readonly", true);
                                            $("#currency").val(datos[0]['currency']);
                                            $('#currency').css('pointer-events', 'none');
                                            $("#currency").css('background-color', '#e6e6e6');


                                            $('#existeP').text("Existe Póliza");
                                            $('#no_existeP').text("");

                                            $('#id_new_titular').val("");

                                            $('#tomador').val(titular.value);
                                            $('#n_tomador').val(datos[0]['nombre_t']);
                                            $('#a_tomador').val(datos[0]['apellido_t']);

                                            $("#asesor").val(datos[0]['codvend'] + "=" + datos[0]['idnom']);
                                            $('#asesor').change();
                                            console.log(datos[0]['codvend'] + "=" + datos[0]['idnom']);

                                            $('#existeT').text("");
                                            $('#no_existeT').text("");
                                            $('#existeTom').text("");
                                            $('#no_existeTom').text("");

                                            $('#tablatomador').removeAttr('hidden');
                                            $("#tomador").css('color', 'red');

                                            $('#tablaveh').removeAttr('hidden');
                                        },
                                        function() {
                                            alertify.notify('No se modificó el Nº de Póliza');
                                            alertify.success('Proceda a Renovar la Póliza');
                                            $('#titular').val(datos[0]['ci']);
                                            $('#titular').removeAttr('onblur');
                                            $('#titular').attr("readonly", true);
                                            $('#n_titular').val(datos[0]['nombre_t']);
                                            $('#a_titular').val(datos[0]['apellido_t']);

                                            $("#tipo_poliza").val(2);
                                            $("#ramo").val(datos[0]['id_cod_ramo']);
                                            //$('#ramo').css('pointer-events','none');
                                            //$("#ramo").css('background-color', '#e6e6e6');
                                            $("#cia").val(datos[0]['id_cia']);
                                            //$('#cia').css('pointer-events','none');
                                            //$("#cia").css('background-color', '#e6e6e6');
                                            $("#t_cuenta").val(datos[0]['t_cuenta']);
                                            $('#t_cuenta').css('pointer-events', 'none');
                                            $("#t_cuenta").css('background-color', '#e6e6e6');
                                            var emisionP = datos[0]['f_emi'].split('-').reverse().join('-');
                                            $("#emisionP").val(emisionP);
                                            //$("#emisionP1").val(datos[0]['f_emi']);
                                            //$('#emisionP').attr("disabled",true);
                                            $('#desdeP').val(datos[0]['f_desdepoliza']);
                                            $('#hastaP').val(datos[0]['f_hastapoliza']);


                                            var mydate = new Date($('#desdeP').val());
                                            $('#desdeP').val((mydate.getFullYear() + 1) + '-' + (mydate.getMonth() + 01) + '-' + (mydate.getDate() + 1));

                                            var mydate1 = new Date($('#hastaP').val());
                                            $('#hastaP').val((mydate1.getFullYear() + 1) + '-' + (mydate1.getMonth() + 01) + '-' + (mydate1.getDate() + 1));


                                            var desdeP = ($('#desdeP').val()).split('-').reverse().join('-');
                                            var hastaP = ($('#hastaP').val()).split('-').reverse().join('-');
                                            $('#desdeP').val(desdeP);
                                            $('#hastaP').val(hastaP);
                                            $("#emisionP").datepicker("setDate", emisionP);
                                            $("#desdeP").datepicker("setDate", desdeP);
                                            $("#hastaP").datepicker("setDate", hastaP);


                                            $("#desde_recibo").datepicker("setDate", desdeP);
                                            $("#hasta_recibo").datepicker("setDate", hastaP);

                                            $('#placa').val(datos[0]['placa']);
                                            $('#tipo').val(datos[0]['tveh']);
                                            $('#marca').val(datos[0]['marca']);
                                            $('#modelo').val(datos[0]['mveh']);
                                            $('#anio').val(datos[0]['f_veh']);
                                            $('#serial').val(datos[0]['serial']);
                                            $('#color').val(datos[0]['cveh']);
                                            $('#categoria').val(datos[0]['catveh']);

                                            $('#t_cobertura').val(datos[0]['tcobertura']);
                                            $('#t_cobertura').attr("readonly", true);
                                            $("#currency").val(datos[0]['currency']);
                                            $('#currency').css('pointer-events', 'none');
                                            $("#currency").css('background-color', '#e6e6e6');


                                            $('#existeP').text("Existe Póliza");
                                            $('#no_existeP').text("");

                                            $('#id_new_titular').val("");

                                            $('#tomador').val(titular.value);
                                            $('#n_tomador').val(datos[0]['nombre_t']);
                                            $('#a_tomador').val(datos[0]['apellido_t']);

                                            $("#asesor").val(datos[0]['codvend'] + "=" + datos[0]['idnom']);
                                            $('#asesor').change();
                                            console.log(datos[0]['codvend'] + "=" + datos[0]['idnom']);

                                            $('#existeT').text("");
                                            $('#no_existeT').text("");
                                            $('#existeTom').text("");
                                            $('#no_existeTom').text("");

                                            $('#tablatomador').removeAttr('hidden');
                                            $("#tomador").css('color', 'red');

                                            $('#tablaveh').removeAttr('hidden');
                                        }).set('labels', {
                                        ok: 'Sí',
                                        cancel: 'No'
                                    }).set({
                                        transition: 'zoom'
                                    }).show();
                                },
                                function() {
                                    window.location.replace("crear_poliza.php");
                                    alertify.error('Cancel')
                                }).set('labels', {
                                ok: 'Sí',
                                cancel: 'No'
                            }).set({
                                transition: 'zoom'
                            }).show();


                        } else {
                            alertify.confirm('Existe!', 'La Póliza que introdujo ya Existe ¿Desea Renovarla?',
                                function() {
                                    alertify.prompt('Desea modificar el Nº de Póliza?', 'Ingrese el Nº de Póliza Nuevo', num_poliza.value,
                                        function(evt, value) {
                                            alertify.notify('Nuevo Nº de Póliza es: ' + value);
                                            alertify.success('Proceda a Renovar la Póliza');
                                            $('#n_poliza').val(value);
                                            $('#titular').val(datos[0]['ci']);
                                            $('#titular').removeAttr('onblur');
                                            $('#titular').attr("readonly", true);
                                            $('#n_titular').val(datos[0]['nombre_t']);
                                            $('#a_titular').val(datos[0]['apellido_t']);

                                            $("#tipo_poliza").val(2);
                                            $("#ramo").val(datos[0]['id_cod_ramo']);
                                            //$('#ramo').css('pointer-events','none');
                                            //$("#ramo").css('background-color', '#e6e6e6');
                                            $("#cia").val(datos[0]['id_cia']);
                                            //$('#cia').css('pointer-events','none');
                                            //$("#cia").css('background-color', '#e6e6e6');
                                            $("#t_cuenta").val(datos[0]['t_cuenta']);
                                            $('#t_cuenta').css('pointer-events', 'none');
                                            $("#t_cuenta").css('background-color', '#e6e6e6');
                                            var emisionP = datos[0]['f_emi'].split('-').reverse().join('-');
                                            $("#emisionP").val(emisionP);
                                            //$("#emisionP1").val(datos[0]['f_emi']);
                                            //$('#emisionP').attr("disabled",true);
                                            $('#desdeP').val(datos[0]['f_desdepoliza']);
                                            $('#hastaP').val(datos[0]['f_hastapoliza']);


                                            var mydate = new Date($('#desdeP').val());
                                            $('#desdeP').val((mydate.getFullYear() + 1) + '-' + (mydate.getMonth() + 01) + '-' + (mydate.getDate() + 1));

                                            var mydate1 = new Date($('#hastaP').val());
                                            $('#hastaP').val((mydate1.getFullYear() + 1) + '-' + (mydate1.getMonth() + 01) + '-' + (mydate1.getDate() + 1));


                                            var desdeP = ($('#desdeP').val()).split('-').reverse().join('-');
                                            var hastaP = ($('#hastaP').val()).split('-').reverse().join('-');
                                            $('#desdeP').val(desdeP);
                                            $('#hastaP').val(hastaP);
                                            $("#emisionP").datepicker("setDate", emisionP);
                                            $("#desdeP").datepicker("setDate", desdeP);
                                            $("#hastaP").datepicker("setDate", hastaP);


                                            $("#desde_recibo").datepicker("setDate", desdeP);
                                            $("#hasta_recibo").datepicker("setDate", hastaP);


                                            $('#t_cobertura').val(datos[0]['tcobertura']);
                                            $('#t_cobertura').attr("readonly", true);
                                            $("#currency").val(datos[0]['currency']);
                                            $('#currency').css('pointer-events', 'none');
                                            $("#currency").css('background-color', '#e6e6e6');


                                            $('#existeP').text("Existe Póliza");
                                            $('#no_existeP').text("");

                                            $('#id_new_titular').val("");

                                            $('#tomador').val(titular.value);
                                            $('#n_tomador').val(datos[0]['nombre_t']);
                                            $('#a_tomador').val(datos[0]['apellido_t']);

                                            $("#asesor").val(datos[0]['codvend'] + "=" + datos[0]['idnom']);
                                            $('#asesor').change();
                                            console.log(datos[0]['codvend'] + "=" + datos[0]['idnom']);

                                            $('#existeT').text("");
                                            $('#no_existeT').text("");
                                            $('#existeTom').text("");
                                            $('#no_existeTom').text("");

                                            $('#tablatomador').removeAttr('hidden');
                                            $("#tomador").css('color', 'red');

                                            $('#tablaveh').attr('hidden', true);
                                            $('#placa').val('');
                                            $('#tipo').val('');
                                            $('#marca').val('');
                                            $('#modelo').val('');
                                            $('#anio').val('');
                                            $('#serial').val('');
                                            $('#color').val('');
                                            $('#categoria').val('');
                                        },
                                        function() {
                                            alertify.notify('No se modificó el Nº de Póliza');
                                            alertify.success('Proceda a Renovar la Póliza');
                                            $('#titular').val(datos[0]['ci']);
                                            $('#titular').removeAttr('onblur');
                                            $('#titular').attr("readonly", true);
                                            $('#n_titular').val(datos[0]['nombre_t']);
                                            $('#a_titular').val(datos[0]['apellido_t']);

                                            $("#tipo_poliza").val(2);
                                            $("#ramo").val(datos[0]['id_cod_ramo']);
                                            //$('#ramo').css('pointer-events','none');
                                            //$("#ramo").css('background-color', '#e6e6e6');
                                            $("#cia").val(datos[0]['id_cia']);
                                            //$('#cia').css('pointer-events','none');
                                            //$("#cia").css('background-color', '#e6e6e6');
                                            $("#t_cuenta").val(datos[0]['t_cuenta']);
                                            $('#t_cuenta').css('pointer-events', 'none');
                                            $("#t_cuenta").css('background-color', '#e6e6e6');
                                            var emisionP = datos[0]['f_emi'].split('-').reverse().join('-');
                                            $("#emisionP").val(emisionP);
                                            //$("#emisionP1").val(datos[0]['f_emi']);
                                            //$('#emisionP').attr("disabled",true);
                                            $('#desdeP').val(datos[0]['f_desdepoliza']);
                                            $('#hastaP').val(datos[0]['f_hastapoliza']);


                                            var mydate = new Date($('#desdeP').val());
                                            $('#desdeP').val((mydate.getFullYear() + 1) + '-' + (mydate.getMonth() + 01) + '-' + (mydate.getDate() + 1));

                                            var mydate1 = new Date($('#hastaP').val());
                                            $('#hastaP').val((mydate1.getFullYear() + 1) + '-' + (mydate1.getMonth() + 01) + '-' + (mydate1.getDate() + 1));


                                            var desdeP = ($('#desdeP').val()).split('-').reverse().join('-');
                                            var hastaP = ($('#hastaP').val()).split('-').reverse().join('-');
                                            $('#desdeP').val(desdeP);
                                            $('#hastaP').val(hastaP);
                                            $("#emisionP").datepicker("setDate", emisionP);
                                            $("#desdeP").datepicker("setDate", desdeP);
                                            $("#hastaP").datepicker("setDate", hastaP);


                                            $("#desde_recibo").datepicker("setDate", desdeP);
                                            $("#hasta_recibo").datepicker("setDate", hastaP);


                                            $('#t_cobertura').val(datos[0]['tcobertura']);
                                            $('#t_cobertura').attr("readonly", true);
                                            $("#currency").val(datos[0]['currency']);
                                            $('#currency').css('pointer-events', 'none');
                                            $("#currency").css('background-color', '#e6e6e6');


                                            $('#existeP').text("Existe Póliza");
                                            $('#no_existeP').text("");

                                            $('#id_new_titular').val("");

                                            $('#tomador').val(titular.value);
                                            $('#n_tomador').val(datos[0]['nombre_t']);
                                            $('#a_tomador').val(datos[0]['apellido_t']);

                                            $("#asesor").val(datos[0]['codvend'] + "=" + datos[0]['idnom']);
                                            $('#asesor').change();
                                            console.log(datos[0]['codvend'] + "=" + datos[0]['idnom']);

                                            $('#existeT').text("");
                                            $('#no_existeT').text("");
                                            $('#existeTom').text("");
                                            $('#no_existeTom').text("");

                                            $('#tablatomador').removeAttr('hidden');
                                            $("#tomador").css('color', 'red');

                                            $('#tablaveh').attr('hidden', true);
                                            $('#placa').val('');
                                            $('#tipo').val('');
                                            $('#marca').val('');
                                            $('#modelo').val('');
                                            $('#anio').val('');
                                            $('#serial').val('');
                                            $('#color').val('');
                                            $('#categoria').val('');
                                        }).set('labels', {
                                        ok: 'Sí',
                                        cancel: 'No'
                                    }).set({
                                        transition: 'zoom'
                                    }).show();
                                },
                                function() {
                                    window.location.replace("crear_poliza.php");
                                    alertify.error('Cancel')
                                }).set('labels', {
                                ok: 'Sí',
                                cancel: 'No'
                            }).set({
                                transition: 'zoom'
                            }).show();


                        }
                    }

                }
            });
            $('#verifP').attr('hidden', true);
        }


        async function validarTarjeta(n_tarjeta) {
            $('#alert').val('0');
            $('#id_tarjeta').val('0');

            if ($("#n_tarjeta").val().length < 1) {
                alertify.error("Debe escribir en la casilla para realizar la búsqueda");
                return false;
            }

            $.ajax({
                type: "POST",
                data: "n_tarjeta=" + n_tarjeta.value,
                url: "validar_tarjeta.php",
                success: function(r) {
                    datos = jQuery.parseJSON(r);



                    if (datos == null) {
                        $('#cvv').val('');
                        $('#fechaV').val('');
                        $('#titular_tarjeta').val('');
                        $('#bancoT').val('');
                        $('#cvv_h').val('');
                        $('#fechaV_h').val('');
                        $('#titular_tarjeta_h').val('');
                        $('#bancoT_h').val('');
                        $("#bancoT").css('background-color', 'white');
                        $('#alert').val('1');
                        alertify.success('Número de Tarjeta no existente en la BD');
                    } else {

                        if (datos[0]['n_tarjeta'] == null) {
                            $('#cvv').val('');
                            $('#fechaV').val('');
                            $('#titular_tarjeta').val('');
                            $('#bancoT').val('');
                            $('#cvv_h').val('');
                            $('#fechaV_h').val('');
                            $('#titular_tarjeta_h').val('');
                            $('#bancoT_h').val('');
                            $("#bancoT").css('background-color', 'white');
                            $('#alert').val('1');
                            alertify.success('Número de Tarjeta no existente en la BD');
                        } else {

                            $("#tablaPE  tbody").empty();

                            for (let index = 0; index < datos.length; index++) {

                                $.ajax({
                                    type: "POST",
                                    data: "id_tarjeta=" + datos[index].id_tarjeta,
                                    url: "ver_poliza_tarjeta.php",
                                    success: function(r) {
                                        datos1 = jQuery.parseJSON(r);
                                        //console.log(datos1);

                                        var d = new Date();
                                        var strDate = d.getFullYear() + "-" + (d.getMonth() + 1) + "-" + d.getDate();

                                        var f = new Date(datos[index]['fechaV']);
                                        var f_venc = (f.getDate() + 1) + "-" + (f.getMonth() + 1) + "-" + f.getFullYear();

                                        if (datos1 == null) {
                                            if ((new Date(strDate).getTime() <= new Date(datos[index]['fechaV']).getTime())) {
                                                var htmlTags = '<tr ondblclick="selecTarjeta(' + datos[index]['id_tarjeta'] + ')" style="cursor:pointer">' +
                                                    '<td style="color:green">' + datos[index]['n_tarjeta'] + '</td>' +
                                                    '<td nowrap>' + datos[index]['cvv'] + '</td>' +
                                                    '<td nowrap>' + f_venc + '</td>' +
                                                    '<td>' + datos[index]['nombre_titular'] + '</td>' +
                                                    '<td nowrap>' + datos[index]['banco'] + '</td>' +
                                                    '<td nowrap>No</td>' +

                                                    '<td nowrap style="color:white"><a onclick="selecTarjeta(' + datos[index]['id_tarjeta'] + ')" style="color:white" data-tooltip="tooltip" data-placement="top" title="Añadir Tarjeta" class="btn btn-success btn-sm"><i class="fa fa-check-square" ></i></a></td>' +
                                                    '</tr>';

                                            } else {

                                                var htmlTags = '<tr ondblclick="selecTarjeta(' + datos[index]['id_tarjeta'] + ')" style="cursor:pointer">' +
                                                    '<td style="color:red">' + datos[index]['n_tarjeta'] + '</td>' +
                                                    '<td nowrap>' + datos[index]['cvv'] + '</td>' +
                                                    '<td nowrap>' + f_venc + '</td>' +
                                                    '<td>' + datos[index]['nombre_titular'] + '</td>' +
                                                    '<td nowrap>' + datos[index]['banco'] + '</td>' +
                                                    '<td nowrap>No</td>' +

                                                    '<td nowrap style="color:white"><a onclick="selecTarjeta(' + datos[index]['id_tarjeta'] + ')" style="color:white" data-tooltip="tooltip" data-placement="top" title="Añadir Tarjeta" class="btn btn-success btn-sm"><i class="fa fa-check-square"></i></a></td>' +
                                                    '</tr>';

                                            }
                                        } else {
                                            if ((new Date(strDate).getTime() <= new Date(datos[index]['fechaV']).getTime())) {
                                                var htmlTags = '<tr ondblclick="selecTarjeta(' + datos[index]['id_tarjeta'] + ')" style="cursor:pointer">' +
                                                    '<td style="color:green">' + datos[index]['n_tarjeta'] + '</td>' +
                                                    '<td nowrap>' + datos[index]['cvv'] + '</td>' +
                                                    '<td nowrap>' + f_venc + '</td>' +
                                                    '<td>' + datos[index]['nombre_titular'] + '</td>' +
                                                    '<td nowrap>' + datos[index]['banco'] + '</td>' +
                                                    '<td nowrap>Sí</td>' +

                                                    '<td nowrap style="color:white"><a onclick="selecTarjeta(' + datos[index]['id_tarjeta'] + ')" style="color:white" data-tooltip="tooltip" data-placement="top" title="Añadir Tarjeta" class="btn btn-success btn-sm"><i class="fa fa-check-square" ></i></a><a href="../b_polizaT.php?id_tarjeta=' + datos[index]['id_tarjeta'] + '" target="_blank" style="color:white" data-tooltip="tooltip" data-placement="top" title="Ver Pólizas" class="btn btn-info btn-sm" ><i class="fa fa-eye"></i></a></td>' +
                                                    '</tr>';

                                            } else {

                                                var htmlTags = '<tr ondblclick="selecTarjeta(' + datos[index]['id_tarjeta'] + ')" style="cursor:pointer">' +
                                                    '<td style="color:red">' + datos[index]['n_tarjeta'] + '</td>' +
                                                    '<td nowrap>' + datos[index]['cvv'] + '</td>' +
                                                    '<td nowrap>' + f_venc + '</td>' +
                                                    '<td>' + datos[index]['nombre_titular'] + '</td>' +
                                                    '<td nowrap>' + datos[index]['banco'] + '</td>' +
                                                    '<td nowrap>Sí</td>' +

                                                    '<td nowrap style="color:white"><a onclick="selecTarjeta(' + datos[index]['id_tarjeta'] + ')" style="color:white" data-tooltip="tooltip" data-placement="top" title="Añadir Tarjeta" class="btn btn-success btn-sm"><i class="fa fa-check-square"></i></a><a href="../b_polizaT.php?id_tarjeta=' + datos[index]['id_tarjeta'] + '" target="_blank" style="color:white" data-tooltip="tooltip" data-placement="top" title="Ver Pólizas" class="btn btn-info btn-sm" ><i class="fa fa-eye"></i></a></td>' +
                                                    '</tr>';

                                            }
                                        }



                                        $('#tablaPE tbody').append(htmlTags);


                                    }
                                });


                            }
                            $('#tarjetaexistente').modal({
                                backdrop: 'static',
                                keyboard: false
                            });
                            $('#tarjetaexistente').modal('show');
                        }
                    }
                }
            });
        }

        async function selecTarjeta(id_tarjeta) {
            await $.ajax({
                type: "POST",
                data: "id_tarjeta=" + id_tarjeta,
                url: "b_tarjeta.php",
                success: function(r) {
                    datos = jQuery.parseJSON(r);

                    if (datos[0]['id_tarjeta'] == null) {
                        //console.log('vacio');
                        alert('seleccione una tarjeta');
                    } else {
                        $('#n_tarjeta').val(datos[0]['n_tarjeta']);
                        $('#cvv').val(datos[0]['cvv']);
                        $('#titular_tarjeta').val(datos[0]['nombre_titular']);
                        $('#bancoT').val(datos[0]['banco']);

                        $('#n_tarjeta_h').val(datos[0]['n_tarjeta_h']);
                        $('#cvv_h').val(datos[0]['cvv']);
                        $('#titular_tarjeta_h').val(datos[0]['nombre_titular']);
                        $('#bancoT_h').val(datos[0]['banco']);

                        $('#id_tarjeta').val(datos[0]['id_tarjeta']);


                        $('#fechaV').val(datos[0]['fechaV']);
                        var mydate = new Date($('#fechaV').val());
                        $('#fechaV').val((mydate.getFullYear()) + '-' + (mydate.getMonth() + 01) + '-' + (mydate.getDate() + 1));
                        var fechaV = ($('#fechaV').val()).split('-').reverse().join('-');
                        $('#fechaV').val(fechaV);
                        $("#fechaV").datepicker("setDate", fechaV);

                        $('#fechaV_h').val(datos[0]['fechaV']);
                        var mydate = new Date($('#fechaV_h').val());
                        $('#fechaV_h').val((mydate.getFullYear()) + '-' + (mydate.getMonth() + 01) + '-' + (mydate.getDate() + 1));
                        var fechaV = ($('#fechaV_h').val()).split('-').reverse().join('-');
                        $('#fechaV_h').val(fechaV);
                        $("#fechaV_h").datepicker("setDate", fechaV);

                        alertify.success('Tarjeta Existente');



                        $('#tarjetaexistente').modal('hide');
                    }
                }
            });
        }

        function selecTarjetaNew() {
            $('#cvv').val('');
            $('#fechaV').val('');
            $('#titular_tarjeta').val('');
            $('#bancoT').val('');
            $('#cvv_h').val('');
            $('#fechaV_h').val('');
            $('#titular_tarjeta_h').val('');
            $('#bancoT_h').val('');
            $('#tarjetaexistente').modal('hide');
            $('#alert').val('1');
            $('#id_tarjeta').val('0');

            alertify.success('Ingrese los datos faltantes de la Tarjeta');
        }





        function validartitular(titular) {
            $.ajax({
                type: "POST",
                data: "titular=" + titular.value,
                url: "validartitular.php",
                success: function(r) {
                    datos = jQuery.parseJSON(r);

                    if (datos['nombre_t'] == null) {
                        //$('#btnAggT').removeAttr('hidden');

                        $('#n_titular').val("");
                        $('#a_titular').val("");

                        $('#id_new_titular').val(titular.value);
                        $('#existeT').text("");
                        $('#no_existeT').text("No Existe Titular");
                        $('#titular').val("");
                        $('#agregarnuevotitular').modal('show');

                        $('#tablatomador').attr("hidden", true);
                    } else {
                        $('#tablatomador').removeAttr('readonly');
                        $('#n_titular').val(datos['nombre_t']);
                        $('#a_titular').val(datos['apellido_t']);

                        //$("#btnAggT").attr("hidden",true);

                        $('#existeT').text("Existe Titular");
                        $('#no_existeT').text("");

                        $('#id_new_titular').val("");

                        $('#tablatomador').removeAttr('hidden');
                        $('#tomador').val(titular.value);
                        $('#n_tomador').val(datos['nombre_t']);
                        $('#a_tomador').val(datos['apellido_t']);

                    }
                }
            });
        }

        function validartomador(titular) {
            $.ajax({
                type: "POST",
                data: "titular=" + titular.value,
                url: "validartitular.php",
                success: function(r) {
                    datos = jQuery.parseJSON(r);

                    if (datos['nombre_t'] == null) {
                        //$('#btnAggTom').removeAttr('hidden');

                        $('#n_tomador').val("");
                        $('#a_tomador').val("");

                        $('#id_new_titularT').val(titular.value);
                        $('#existeTom').text("");
                        $('#no_existeTom').text("No Existe Tomador");
                        $('#tomador').val("");
                        $("#tomador").css('color', 'black');

                        $('#agregarnuevotomador').modal('show');

                    } else {
                        $('#n_tomador').val(datos['nombre_t']);
                        $('#a_tomador').val(datos['apellido_t']);

                        $("#btnAggTom").attr("hidden", true);

                        $('#existeTom').text("Existe Tomador");
                        $('#no_existeTom').text("");

                        $('#id_new_titularT').val("");
                        $("#tomador").css('color', 'black');

                        //$('#tomador').val(tomador.value);
                    }
                }
            });
        }

        function cargarFecha(emisionP) {
            $('#desdeP').val($(emisionP).val());

            var emisionP = ($(emisionP).val()).split('-').reverse().join('-');

            var mydate = new Date(emisionP);
            $('#hastaP').val((mydate.getFullYear() + 1) + '-' + (mydate.getMonth() + 01) + '-' + (mydate.getDate() + 1));

            var desdeP = $('#desdeP').val();
            var hastaP = ($('#hastaP').val()).split('-').reverse().join('-');

            $("#desdeP").datepicker("setDate", desdeP);
            $("#hastaP").datepicker("setDate", hastaP);


            $("#desde_recibo").datepicker("setDate", desdeP);
            $("#hasta_recibo").datepicker("setDate", hastaP);

            $("#emisionP").css('background-color', 'transparent');
            $("#emisionP").css('color', 'black');
            $('#btnForm').removeAttr('disabled');
        }

        function cargarFechaDesde(desdeP) {

            var desdeP = ($(desdeP).val()).split('-').reverse().join('-');

            var mydate = new Date(desdeP);
            $('#hastaP').val((mydate.getFullYear() + 1) + '-' + (mydate.getMonth() + 01) + '-' + (mydate.getDate() + 1));

            var desdeP = $('#desdeP').val();
            var hastaP = ($('#hastaP').val()).split('-').reverse().join('-');

            $("#desdeP").datepicker("setDate", desdeP);
            $("#hastaP").datepicker("setDate", hastaP);


            $("#desde_recibo").datepicker("setDate", desdeP);
            $("#hasta_recibo").datepicker("setDate", hastaP);
        }


        function cargarRecibo(n_poliza) {
            $('#n_recibo').val($(n_poliza).val());
        }

        function cargarCuotas(f_pago) {

            if (f_pago.value == 1) {
                $('#n_cuotas').val(1);
                $("#n_cuotas").attr("readonly", true);
            } else {
                $('#n_cuotas').removeAttr('readonly');
            }


        }

        function cargarTarjeta(forma_pago) {
            if (forma_pago.value == 2) {
                $('#trTarjeta1').removeAttr('hidden');
                $('#trTarjeta2').removeAttr('hidden');
            } else {
                $('#trTarjeta1').attr('hidden', true);
                $('#trTarjeta2').attr('hidden', true);
                $('#n_tarjeta').val('');
                $('#cvv').val('');
                $('#fechaV').val('');
                $('#titular_tarjeta').val('');
                $('#bancoT').val('');
                $('#alert').val('0');
                $('#id_tarjeta').val('0');
            }
        }

        function mayus(e) {
            e.value = e.value.toUpperCase();
        }

        $("#ramo").change(function() {
            if ($('#ramo').val() == 2 || $('#ramo').val() == 25) {
                $('#tablaveh').removeAttr('hidden');
            } else {
                $('#tablaveh').attr('hidden', true);
            }
        });
    </script>
    <script language="javascript">
        function Exportar(table, name) {
            var uri = 'data:application/vnd.ms-excel;base64,',
                template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><meta http-equiv="content-type" content="application/vnd.ms-excel; charset=UTF-8"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>',
                base64 = function(s) {
                    return window.btoa(unescape(encodeURIComponent(s)))
                },
                format = function(s, c) {
                    return s.replace(/{(\w+)}/g, function(m, p) {
                        return c[p];
                    })
                }
            if (!table.nodeType) table = document.getElementById(table)
            var ctx = {
                worksheet: name || 'Worksheet',
                table: table.innerHTML
            }
            window.location.href = uri + base64(format(template, ctx))
        }
    </script>


</body>

</html>