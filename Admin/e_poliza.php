<?php
session_start();
if (isset($_SESSION['seudonimo'])) {
} else {
    header("Location: ../sys/login.php");
    exit();
}

require_once("../class/clases.php");

//----Obtengo el permiso del usuario
$permiso = $_SESSION['id_permiso'];
//----------------------



$id_poliza = $_GET['id_poliza'];

$obj1 = new Trabajo();
$poliza = $obj1->get_poliza_total_by_id($id_poliza);

if ($poliza[0]['id_poliza'] == 0) {
    $obj1 = new Trabajo();
    $poliza = $obj1->get_poliza_total1_by_id($id_poliza);
}
if ($poliza[0]['id_poliza'] == 0) {
    $obj1 = new Trabajo();
    $poliza = $obj1->get_poliza_total2_by_id($id_poliza);
}
if ($poliza[0]['id_poliza'] == 0) {
    $obj1 = new Trabajo();
    $poliza = $obj1->get_poliza_total3_by_id($id_poliza);
}

$obj10 = new Trabajo();
$tomador = $obj10->get_element_by_id('titular', 'id_titular', $poliza[0]['id_tomador']);

$currency = "";
if ($poliza[0]['currency'] == 1) {
    $currency = "$ ";
} else {
    $currency = "Bs ";
}



$ob1 = new Trabajo();
$ramo = $ob1->get_element('dramo', 'cod_ramo');

$ob2 = new Trabajo();
$cia = $ob2->get_element('dcia', 'nomcia');

$ob3 = new Trabajo();
$asesor = $ob3->get_element('ena', 'idnom');

$obj31 = new Trabajo();
$liderp = $obj31->get_element('enp', 'nombre');

$obj32 = new Trabajo();
$referidor = $obj32->get_element('enr', 'nombre');

$obj4 = new Trabajo();
$usuario = $obj4->get_element_by_id('usuarios', 'seudonimo', $_SESSION['seudonimo']);

$ob10 = new Trabajo();
$vehiculo = $ob10->get_element_by_id('dveh', 'idveh', $poliza[0]['id_poliza']);



$newfechaV = date("d-m-Y", strtotime($poliza[0]['fechaV']));

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php require('header.php'); ?>

    <style>
        .alertify .ajs-header {
            background-color: red;
        }
    </style>


</head>

<body class="profile-page ">

    <?php require('navigation.php'); ?>




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
                <a href="javascript:history.back(-1);" data-tooltip="tooltip" data-placement="right" title="Ir la página anterior" class="btn btn-info btn-round">
                    <- Regresar</a> <div class="col-md-auto col-md-offset-2">
                        <h1 class="title">Cliente: <?= utf8_encode($poliza[0]['nombre_t'] . " " . $poliza[0]['apellido_t']); ?></h1>
                        <h2 class="title">Póliza N°: <?= $poliza[0]['cod_poliza']; ?></h2>
                        <?php
                        
                            $asesorr = $poliza[0]['cod'] . " -> " . $poliza[0]['nombre'];
                        
                        ?>
                        <h3 class="title">Asesor: <?= utf8_encode($asesorr); ?></h3>
            </div>


            <form class="form-horizontal" id="frmnuevo" action="e_poliza_n.php" method="post">

                <div class="table-responsive">
                    <table class="table table-hover table-striped table-bordered display nowrap" id="iddatatable">
                        <thead style="background-color: #00bcd4;color: white; font-weight: bold;">
                            <tr>
                                <th>N° de Póliza</th>
                                <th>Fecha Desde Seguro</th>
                                <th>Fecha Hasta Seguro</th>
                                <th>Tipo de Póliza</th>
                                <th hidden>id Póliza</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php

                            $originalDesdeP = $poliza[0]['f_desdepoliza'];
                            $newDesdeP = date("d-m-Y", strtotime($originalDesdeP));
                            $originalHastaP = $poliza[0]['f_hastapoliza'];
                            $newHastaP = date("d-m-Y", strtotime($originalHastaP));

                            ?>
                            <tr>
                                <?php
                                if ($user[0]['id_permiso'] == 1) {
                                ?>
                                    <td style="background-color:white"><input type="text" class="form-control" id="n_poliza" name="n_poliza" value="<?= $poliza[0]['cod_poliza']; ?>"></td>
                                <?php
                                } else {
                                ?>
                                    <td><input type="text" class="form-control" id="n_poliza" name="n_poliza" value="<?= $poliza[0]['cod_poliza']; ?>" readonly></td>
                                <?php
                                }
                                ?>


                                <td style="background-color:white">
                                    <div class="input-group date">
                                        <input onblur="cargarFechaDesde(this)" type="text" class="form-control" id="desdeP" name="desdeP" required autocomplete="off" value="<?= $newDesdeP; ?>">
                                    </div>
                                </td>
                                <td style="background-color:white">
                                    <div class="input-group date">
                                        <input type="text" class="form-control" id="hastaP" name="hastaP" required autocomplete="off" value="<?= $newHastaP; ?>">
                                    </div>
                                </td>

                                <td style="background-color:white"><select class="custom-select" id="tipo_poliza" name="tipo_poliza" required data-toggle="tooltip" data-placement="bottom" title="Seleccione un elemento de la lista">
                                        <option value="1">Primer Año</option>
                                        <option value="2">Renovación</option>
                                        <option value="3">Traspaso de Cartera</option>
                                        <option value="4">Anexos</option>
                                        <option value="5">Revalorización</option>
                                    </select>
                                </td>
                                <td hidden><input type="text" class="form-control" id="id_poliza" name="id_poliza" value="<?= $id_poliza; ?>"></td>
                                <td hidden><input type="text" class="form-control" id="id_tpoliza" name="id_tpoliza" value="<?= $poliza[0]['id_tpoliza']; ?>"></td>

                                <!-- Hidden -->
                                <td hidden><input type="text" class="form-control" id="n_poliza1" name="n_poliza1" value="<?= $poliza[0]['cod_poliza']; ?>"></td>
                                <td hidden><input type="text" class="form-control" id="desdeP1" name="desdeP1" value="<?= $newDesdeP; ?>"></td>
                                <td hidden><input type="text" class="form-control" id="hastaP1" name="hastaP1" value="<?= $newHastaP; ?>"></td>
                                <td hidden><input type="text" class="form-control" id="tipo_poliza1" name="tipo_poliza1" value="<?= $poliza[0]['id_tpoliza']; ?>"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover table-striped table-bordered display nowrap" id="iddatatable">
                        <thead style="background-color: #00bcd4;color: white; font-weight: bold;">
                            <tr>
                                <th>Ramo</th>
                                <th>Compañía</th>
                                <th>Tipo de Cuenta</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr style="background-color: white">
                                <td><select class="custom-select" id="ramo" name="ramo" required data-toggle="tooltip" data-placement="bottom" title="Seleccione un elemento de la lista">
                                        <?php
                                        for ($i = 0; $i < sizeof($ramo); $i++) {
                                        ?>
                                            <option value="<?= $ramo[$i]["cod_ramo"]; ?>"><?= utf8_encode($ramo[$i]["nramo"]); ?></option>
                                        <?php } ?>
                                    </select>
                                </td>
                                <td><select class="custom-select" id="cia" name="cia" readonly="true">
                                        <?php
                                        for ($i = 0; $i < sizeof($cia); $i++) {
                                        ?>
                                            <option value="<?= $cia[$i]["idcia"]; ?>"><?= utf8_encode($cia[$i]["nomcia"]); ?></option>
                                        <?php } ?>
                                    </select>
                                </td>
                                <td><select class="custom-select" id="t_cuenta" name="t_cuenta" required data-toggle="tooltip" data-placement="bottom" title="Seleccione un elemento de la lista">
                                        <option value="1">Individual</option>
                                        <option value="2">Colectivo</option>
                                    </select>
                                </td>

                                <td hidden><input type="text" class="form-control" id="ramo_e" name="ramo_e" value="<?= utf8_encode($poliza[0]['id_cod_ramo']); ?>"></td>
                                <td hidden><input type="text" class="form-control" id="cia_e" name="cia_e" value="<?= utf8_encode($poliza[0]['id_cia']); ?>"></td>

                                <td hidden><input type="text" class="form-control" id="t_cuenta1" name="t_cuenta1" value="<?= utf8_encode($poliza[0]['t_cuenta']); ?>"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover table-striped table-bordered display nowrap" id="iddatatable">
                        <thead style="background-color: #00bcd4;color: white; font-weight: bold;">
                            <tr>
                                <th>Moneda</th>
                                <th>Suma Asegurada</th>
                                <th style="background-color: #E54848;">Prima Total sin Impuesto *</th>
                                <th>Periocidad de Pago</th>
                                <th>Forma de Pago</th>
                            </tr>
                        </thead>

                        <tbody>
                            <div class="form-group col-md-12">
                                <tr style="background-color: white">
                                    <td><select class="custom-select" id="currency" name="currency" required>
                                            <option value="1">$</option>
                                            <option value="2">BsS</option>
                                        </select>
                                    </td>
                                    <td><input type="text" class="form-control validanumericos" id="sumaA" name="sumaA" data-toggle="tooltip" data-placement="bottom" title="Sólo introducir números y punto (.) como separador decimal" onkeypress="return tabular(event,this)"></td>
                                    <td><input type="text" class="form-control validanumericos1" id="prima" name="prima" required data-toggle="tooltip" data-placement="bottom" title="Campo Obligatorio [Sólo introducir números y punto (.) como separador decimal]" onkeypress="return tabular(event,this)"></td>
                                    <td><select onblur="cargarCuotas(this)" class="custom-select" name="f_pago" id="f_pago" required>
                                            <option value="CONTADO">CONTADO</option>
                                            <option value="FRACCIONADO">FRACCIONADO</option>
                                            <option value="FINANCIADO">FINANCIADO</option>
                                        </select>
                                    </td>
                                    <td><select onblur="cargarTarjeta(this)" class="custom-select" name="forma_pago" id="forma_pago" required>
                                            <option value="1">ACH (CARGO EN CUENTA)</option>
                                            <option value="2">TARJETA DE CREDITO / DEBITO</option>
                                            <option value="3">PAGO VOLUNTARIO</option>
                                        </select>
                                    </td>

                                    <td hidden><input type="text" class="form-control" id="currency_h" name="currency_h" value="<?= $poliza[0]['currency']; ?>"></td>
                                    <td hidden><input type="text" class="form-control" id="sumaA_h" name="sumaA_h" value="<?= $poliza[0]['sumaasegurada']; ?>"></td>
                                    <td hidden><input type="text" class="form-control" id="prima_h" name="prima_h" value="<?= $poliza[0]['prima']; ?>"></td>
                                    <td hidden><input type="text" class="form-control" id="f_pago_h" name="f_pago_h" value="<?= $poliza[0]['fpago']; ?>"></td>

                                    <td hidden><input type="text" class="form-control" id="forma_pago_e" name="forma_pago_h" value="<?= $poliza[0]['forma_pago']; ?>"></td>
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
                                    <td><input type="number" step="0.01" class="form-control" onblur="validarTarjeta(this)" id="n_tarjeta" name="n_tarjeta" data-toggle="tooltip" data-placement="bottom" title="Campo Obligatorio [Sólo introducir números]" value="<?= $poliza[0]['n_tarjeta']; ?>"></td>
                                    <td><input type="text" class="form-control validanumericos7" id="cvv" name="cvv" data-toggle="tooltip" data-placement="bottom" title="Campo Obligatorio [Sólo introducir números]" value="<?= $poliza[0]['cvv']; ?>"></td>
                                    <td>
                                        <div class="input-group date">
                                            <input type="text" class="form-control" id="fechaV" name="fechaV" data-toggle="tooltip" data-placement="bottom" title="Campo Obligatorio" autocomplete="off" value="<?= $newfechaV; ?>">
                                        </div>
                                    </td>
                                    <td><input type="text" class="form-control" id="titular_tarjeta" name="titular_tarjeta" onkeyup="mayus(this);" data-toggle="tooltip" data-placement="bottom" title="Nombre del Tarjetahabiente" value="<?= $poliza[0]['nombre_titular']; ?>"></td>
                                    <td><input type="text" class="form-control" id="bancoT" name="bancoT" onkeyup="mayus(this);" data-toggle="tooltip" data-placement="bottom" title="Nombre del Banco" value="<?= $poliza[0]['banco']; ?>"></td>

                                    <!-- HIDDEN -->
                                    <td hidden><input type="text" class="form-control" id="n_tarjeta_h" name="n_tarjeta_h" value="<?= $poliza[0]['n_tarjeta']; ?>"></td>
                                    <td hidden><input type="text" class="form-control" id="cvv_h" name="cvv_h" value="<?= $poliza[0]['cvv']; ?>"></td>
                                    <td hidden>
                                        <div class="input-group date">
                                            <input type="text" class="form-control" id="fechaV_h" name="fechaV_h" value="<?= $newfechaV; ?>">
                                        </div>
                                    </td>
                                    <td hidden><input type="text" class="form-control" id="titular_tarjeta_h" name="titular_tarjeta_h" value="<?= $poliza[0]['nombre_titular']; ?>"></td>
                                    <td hidden><input type="text" class="form-control" id="bancoT_h" name="bancoT_h" value="<?= $poliza[0]['banco']; ?>"></td>
                                    <td hidden><input type="text" class="form-control" id="alert" name="alert" value="0"></td>
                                    <td hidden><input type="text" class="form-control" id="id_tarjeta" name="id_tarjeta" value="0"></td>
                                </tr>
                            </div>
                        </tbody>
                    </table>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover table-striped table-bordered display nowrap" id="iddatatable">
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
                            <?php

                            $originalDesdeR = $poliza[0]['f_desderecibo'];
                            $newDesdeR = date("d-m-Y", strtotime($originalDesdeR));
                            $originalHastaR = $poliza[0]['f_hastarecibo'];
                            $newHastaR = date("d-m-Y", strtotime($originalHastaR));


                            ?>
                            <tr style="background-color:white">
                                <td><input type="text" class="form-control validanumericos2" id="n_recibo" name="n_recibo" value="<?= $poliza[0]['cod_recibo']; ?>" required></td>
                                <td>
                                    <div class="input-group date">
                                        <input onblur="cargarFechaDesde(this)" type="text" class="form-control" id="desde_recibo" name="desde_recibo" required autocomplete="off" value="<?= $newDesdeR; ?>">
                                    </div>
                                </td>
                                <td>
                                    <div class="input-group date">
                                        <input type="text" class="form-control" id="hasta_recibo" name="hasta_recibo" required autocomplete="off" value="<?= $newHastaR; ?>">
                                    </div>
                                </td>

                                <td><input type="text" class="form-control" id="z_produc" name="z_produc" readonly="true" value="<?= utf8_encode($usuario[0]['z_produccion']); ?>"></td>
                                <td><input type="number" class="form-control validanumericos3" id="n_cuotas" name="n_cuotas" min="1" max="12" required></td>

                                <td hidden><input type="text" class="form-control" id="n_cuotas_h" name="n_cuotas_h" value="<?= $poliza[0]['ncuotas']; ?>"></td>

                                <td hidden><input type="text" class="form-control" id="n_recibo1" name="n_recibo1" value="<?= $poliza[0]['cod_recibo']; ?>"></td>
                                <td hidden><input type="text" class="form-control" id="desde_recibo1" name="desde_recibo1" value="<?= $newDesdeR; ?>"></td>
                                <td hidden><input type="text" class="form-control" id="hasta_recibo1" name="hasta_recibo1" value="<?= $newHastaR; ?>"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>



                <div class="col-md-auto col-md-offset-2">
                    <h2 class="title">Datos del Titular</h2>
                </div>

                <h2 id="existeT" class="text-success"><strong></strong></h2>
                <h2 id="no_existeT" class="text-danger"><strong></strong></h2>
                <div class="table-responsive">
                    <table class="table table-hover table-striped table-bordered display" id="iddatatable">
                        <thead style="background-color: #00bcd4;color: white; font-weight: bold;">
                            <tr>
                                <th>Cédula *</th>
                                <th>Nombre</th>
                                <th>Apellido</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr style="background-color: white">
                                <td><input onblur="validartitular(this)" type="text" class="form-control validanumericos5" id="titular" name="titular" required data-toggle="tooltip" data-placement="bottom" title="Campo Obligatorio"></td>
                                <td><input type="text" class="form-control" id="n_titular" name="n_titular" readonly="readonly" required="true"></td>
                                <td><input type="text" class="form-control" id="a_titular" name="a_titular" readonly="readonly" required="true"></td>

                                <td hidden><input type="text" class="form-control" id="ci_t" name="ci_t" value="<?= $poliza[0]['ci']; ?>"></td>
                                <td hidden><input type="text" class="form-control" id="nombre_tit" name="nombre_tit" value="<?= utf8_encode($poliza[0]['nombre_t']); ?>"></td>
                                <td hidden><input type="text" class="form-control" id="apellido_tit" name="apellido_tit" value="<?= utf8_encode($poliza[0]['apellido_t']); ?>"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>





                <div class="col-md-auto col-md-offset-2">
                    <h2 class="title">Datos del Tomador</h2>
                </div>

                <h2 id="existeTom" class="text-success"><strong></strong></h2>
                <h2 id="no_existeTom" class="text-danger"><strong></strong></h2>
                <div class="table-responsive">
                    <table class="table table-hover table-striped table-bordered display" id="iddatatable">
                        <thead style="background-color: #00bcd4;color: white; font-weight: bold;">
                            <tr>
                                <th>Cédula *</th>
                                <th>Nombre</th>
                                <th>Apellido</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr style="background-color: white">
                                <td><input onblur="validartomador(this)" type="text" class="form-control validanumericos6" id="tomador" name="tomador" required data-toggle="tooltip" data-placement="bottom" title="Campo Obligatorio"></td>
                                <td><input type="text" class="form-control" id="n_tomador" name="n_tomador" readonly="readonly"></td>
                                <td><input type="text" class="form-control" id="a_tomador" name="a_tomador" readonly="readonly"></td>

                                <td hidden><input type="text" class="form-control" id="ci_tom" name="ci_tom" value="<?= $tomador[0]['ci']; ?>"></td>
                                <td hidden><input type="text" class="form-control" id="nombre_tom" name="nombre_tom" value="<?= utf8_encode($tomador[0]['nombre_t']); ?>"></td>
                                <td hidden><input type="text" class="form-control" id="apellido_tom" name="apellido_tom" value="<?= utf8_encode($tomador[0]['apellido_t']); ?>"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>



                <div id="tablaveh" hidden="true">
                    <h2 class="text-info"><strong>Datos Vehículo</strong></h2>
                    <div class="table-responsive">
                        <table class="table table-hover table-striped table-bordered display" id="idtablaveh">
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
                                        <td><input type="text" class="form-control" id="placa" name="placa"></td>
                                        <td><input type="text" class="form-control" id="marca" name="marca"></td>
                                        <td><input type="text" class="form-control" id="modelo" name="modelo"></td>
                                        <td><input type="text" class="form-control" id="tipo" name="tipo"></td>
                                        <td><input type="text" class="form-control" id="anio" name="anio" placeholder="2019"></td>

                                        <td hidden><input type="text" class="form-control" id="placa_h" name="placa_h" value="<?= $vehiculo[0]['placa']; ?>"></td>
                                        <td hidden><input type="text" class="form-control" id="marca_h" name="marca_h" value="<?= $vehiculo[0]['marca']; ?>"></td>
                                        <td hidden><input type="text" class="form-control" id="modelo_h" name="modelo_h" value="<?= $vehiculo[0]['mveh']; ?>"></td>
                                        <td hidden><input type="text" class="form-control" id="tipo_h" name="tipo_h" value="<?= $vehiculo[0]['tveh']; ?>"></td>
                                        <td hidden><input type="text" class="form-control" id="anio_h" name="anio_h" value="<?= $vehiculo[0]['f_veh']; ?>"></td>
                                    </tr>
                                </div>
                            </tbody>
                        </table>
                    </div>
                </div>






                <div class="col-md-auto col-md-offset-2">
                    <h2 class="title">Datos del Asesor</h2>
                </div>


                <center>
                    <table class="table table-hover table-striped table-bordered display" id="tablaAsesor">
                        <thead style="background-color: #00bcd4;color: white; font-weight: bold;">
                            <tr>
                                <th style="text-align:center">Asesor *</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr style="background-color: white">
                                <td style="text-align:center"><select class="form-control selectpicker" id="asesor" name="asesor" required data-style="btn-white" data-header="Seleccione Cía" data-actions-box="true" data-live-search="true">
                                        <?php
                                        for ($i = 0; $i < sizeof($asesor); $i++) {
                                        ?>
                                            <option value="<?= $asesor[$i]["cod"] . "=" . $asesor[$i]["idnom"]; ?>"><?= utf8_encode($asesor[$i]["idnom"]); ?> (Asesor)</option>
                                        <?php }
                                        for ($i = 0; $i < sizeof($liderp); $i++) { ?>
                                            <option value="<?= $liderp[$i]["cod"] . "=" . $liderp[$i]["nombre"]; ?>"><?= utf8_encode($liderp[$i]["nombre"]); ?> (Proyecto)</option>
                                        <?php }
                                        for ($i = 0; $i < sizeof($referidor); $i++) { ?>
                                            <option value="<?= $referidor[$i]["cod"] . "=" . $referidor[$i]["nombre"]; ?>"><?= utf8_encode($referidor[$i]["nombre"]); ?> (Referidor)</option>
                                        <?php } ?>

                                <td hidden><input type="text" class="form-control" id="asesor_h" name="asesor_h" value="<?= $poliza[0]['cod'] . "=" . $poliza[0]['nombre']; ?>"></td>
                                </select>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </center>


                <div class="table-responsive">
                    <table class="table table-hover table-striped table-bordered display nowrap" id="iddatatable">
                        <thead style="background-color: #00bcd4;color: white; font-weight: bold;">
                            <tr>
                                <th>Observaciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr style="background-color:white">
                                <td><input type="text" class="form-control validanumericos2" id="obs_p" name="obs_p" value="<?= $poliza[0]['obs_p']; ?>"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>



                <hr>
                <button type="submit" style="width: 100%" data-tooltip="tooltip" data-placement="bottom" title="Previsualizar" class="btn btn-success btn-lg" value="">Previsualizar Edición &nbsp;<i class="fa fa-check" aria-hidden="true"></i></button>
                <hr>

            </form>











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
                    document.write(new Date().getFullYear())
                </script>, Versatil Seguros S.A.
            </div>
        </div>
    </footer>
    <!--   Core JS Files   -->

    <script src="../assets/js/core/popper.min.js"></script>
    <script src="../assets/js/bootstrap-material-design.js"></script>
    <!--  Plugin fo Dat Time Picker and Full Calendar Plugin  -->
    <script src="../assets/js/plugins/moment.min.js"></script>
    <!--    Plugin fo the Datepicker, full documentation here: https://github.com/Eonasdan/bootstrap-datetimepicker -->
    <script src="../assets/js/plugins/bootstrap-datetimepicker.min.js"></script>
    <!--    Plugin fo the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
    <script src="../assets/js/plugins/nouislider.min.js"></script>
    <!-- Material Kit Core initialisations of plugins and Bootstrap Material Design Library -->
    <script src="../assets/js/material-kit.js?v=2.0.1"></script>
    <!-- Fixed Sidebar Nav - js With initialisations For Demo Purpose, Dont Include it in your project -->
    <script src="../assets/assets-for-demo/js/material-kit-demo.js"></script>

    <script src="../bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
    <script src="../bootstrap-datepicker/locales/bootstrap-datepicker.es.min.js" charset="UTF-8"></script>

    <!-- Bootstrap Select JavaScript -->
    <script src="../js/bootstrap-select.js"></script>

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

                        <div class="table-responsive">
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
                                            <th colspan="2">Celular *</th>
                                            <th colspan="2">Teléfono</th>
                                        </tr>
                                        <tr style="background-color: white">
                                            <td colspan="2"><input type="text" class="form-control" id="cT_new" name="cT_new" required></td>
                                            <td colspan="2"><input type="text" class="form-control" id="tT_new" name="tT_new" required></td>
                                        </tr>
                                        <tr style="background-color: #00bcd4;color: white; font-weight: bold;">
                                            <th>Fecha de Nacimiento</th>
                                            <th colspan="2">Email *</th>
                                        </tr>
                                        <tr style="background-color: white">
                                            <td><input type="text" class="form-control" id="fnT_new" name="fnT_new" required></td>
                                            <td colspan="2"><input type="email" class="form-control" id="eT_new" name="eT_new" required></td>
                                        </tr>
                                        <tr style="background-color: #00bcd4;color: white; font-weight: bold;">
                                            <th colspan=4>Dirección *</th>
                                        </tr>
                                        <tr style="background-color: white">
                                            <td colspan=4><input type="text" class="form-control" id="dT_new" name="dT_new" required onkeyup="mayus(this);"></td>
                                        </tr>
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

                        <div class="table-responsive">
                            <table class="table table-hover table-striped table-bordered" id="iddatatable1">
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
                                            <th colspan="2">Celular *</th>
                                            <th colspan="2">Teléfono</th>
                                        </tr>
                                        <tr style="background-color: white">
                                            <td colspan="2"><input type="text" class="form-control" id="cT_newT" name="cT_newT" required></td>
                                            <td colspan="2"><input type="text" class="form-control" id="tT_newT" name="tT_newT" required></td>
                                        </tr>
                                        <tr style="background-color: #00bcd4;color: white; font-weight: bold;">
                                            <th>Fecha de Nacimiento</th>
                                            <th colspan="2">Email *</th>
                                        </tr>
                                        <tr style="background-color: white">
                                            <td><input type="text" class="form-control" id="fnT_newT" name="fnT_newT" required></td>
                                            <td colspan="2"><input type="email" class="form-control" id="eT_newT" name="eT_newT" required></td>
                                        </tr>
                                        <tr style="background-color: #00bcd4;color: white; font-weight: bold;">
                                            <th colspan=4>Dirección *</th>
                                        </tr>
                                        <tr style="background-color: white">
                                            <td colspan=4><input type="text" class="form-control" id="dT_newT" name="dT_newT" required onkeyup="mayus(this);"></td>
                                        </tr>
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

            $("#f_pago").val(1);
            $('#n_cuotas').val(1);
            $("#n_cuotas").attr("readonly", true);

            $('#desdeP').datepicker({
                format: "dd-mm-yyyy"
            });
            $('#hastaP').datepicker({
                format: "dd-mm-yyyy"
            });

            $('#desde_recibo').datepicker({
                format: "dd-mm-yyyy"
            });

            $('#hasta_recibo').datepicker({
                format: "dd-mm-yyyy"
            });

            $('#fechaV').datepicker({
                format: "dd-mm-yyyy"
            });

            $('#fechaV_h').datepicker({
                format: "dd-mm-yyyy"
            });



            $("#tipo_poliza").val($('#id_tpoliza').val());
            $('#ramo').val($('#ramo_e').val());
            $('#cia').val($('#cia_e').val());
            $('#titular').val($('#ci_t').val());
            $('#n_titular').val($('#nombre_tit').val());
            $('#a_titular').val($('#apellido_tit').val());
            $('#tomador').val($('#ci_tom').val());
            $('#n_tomador').val($('#nombre_tom').val());
            $('#a_tomador').val($('#apellido_tom').val());
            $('#placa').val($('#placa_h').val());
            $('#marca').val($('#marca_h').val());
            $('#modelo').val($('#modelo_h').val());
            $('#tipo').val($('#tipo_h').val());
            $('#anio').val($('#anio_h').val());
            $('#asesor').val($('#asesor_h').val());
            $('#asesor').change();

            $('#currency').val($('#currency_h').val());
            $('#sumaA').val($('#sumaA_h').val());
            $('#prima').val($('#prima_h').val());
            $('#f_pago').val($('#f_pago_h').val());
            $('#n_cuotas').val($('#n_cuotas_h').val());




            if ($('#ramo').val() == 2 || $('#ramo').val() == 25) {
                $('#tablaveh').removeAttr('hidden');
                console.log('si esta trabajando');
            } else {
                $('#tablaveh').attr('hidden', true);
            }

            $('#forma_pago').val($('#forma_pago_e').val());
            if ($('#forma_pago').val() == 2) {
                $('#trTarjeta1').removeAttr('hidden');
                $('#trTarjeta2').removeAttr('hidden');
            } else {
                $('#trTarjeta1').attr('hidden', true);
                $('#trTarjeta2').attr('hidden', true);
            }


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
                    url: "../procesos/agregarCliente.php",
                    success: function(r) {
                        if (r == 1) {
                            $('#frmnuevoT')[0].reset();
                            alertify.success("Agregado con Exito!!");

                            $('#titular').val(titular);
                            $('#titular').removeAttr('hidden');
                            $('#n_titular').val(n_titular);
                            $('#a_titular').val(a_titular);

                            $('#no_existeT').text("");
                            $("#titular").attr("readonly", true);
                            $('#titular').removeAttr('onblur');

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
                    url: "../procesos/agregarTomador.php",
                    success: function(r) {
                        if (r == 1) {
                            $('#frmnuevoTom')[0].reset();
                            alertify.success("Agregado con Exito!!");


                            $('#no_existeTom').text("");

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

            $('#fnT_new').datepicker({
                format: "dd-mm-yyyy"
            });
            $('#fnT_newT').datepicker({
                format: "dd-mm-yyyy"
            });


        });


        function cargarTarjeta(forma_pago) {
            if (forma_pago.value == 2) {
                $('#trTarjeta1').removeAttr('hidden');
                $('#trTarjeta2').removeAttr('hidden');
                $('#n_tarjeta').val('');
                $('#cvv').val('');
                $('#fechaV').val('');
                $('#titular_tarjeta').val('');
                $('#bancoT').val('');
                $('#alert').val('0');
                $('#id_tarjeta').val('0');
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
            ele6.onkeypress = function(e6) {
                if (isNaN(this.value + String.fromCharCode(e6.charCode)))
                    return false;
            }
            ele7.onkeypress = function(e7) {
                if (isNaN(this.value + String.fromCharCode(e7.charCode)))
                    return false;
            }
            ele7.onpaste = function(e7) {
                e7.preventDefault();
            }
        }
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#tablaDatatable').load('t_poliza.php');
            $('.alertify .ajs-header').css('background-color', 'red');
        });
    </script>

    <script type="text/javascript">
        $(function() {
            $('[data-tooltip="tooltip"]').tooltip()
        });


        function cargarFechaDesde(desdeP) {
            $('#desdeP').val($(desdeP).val());

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

        function cargarCuotas(f_pago) {
            if (f_pago.value == 1) {
                $('#n_cuotas').val(1);
                $("#n_cuotas").attr("readonly", true);
            } else {
                $('#n_cuotas').removeAttr('readonly');
            }
        }




        function validartitular(titular) {
            $.ajax({
                type: "POST",
                data: "titular=" + titular.value,
                url: "add/validartitular.php",
                success: function(r) {
                    datos = jQuery.parseJSON(r);

                    if (datos['nombre_t'] == null) {

                        $('#n_titular').val("");
                        $('#a_titular').val("");

                        $('#id_new_titular').val(titular.value);
                        $('#existeT').text("");
                        $('#no_existeT').text("No Existe Titular");
                        $('#titular').val("");
                        $('#agregarnuevotitular').modal('show');

                    } else {
                        //$('#tablatomador').removeAttr('readonly');
                        $('#n_titular').val(datos['nombre_t']);
                        $('#a_titular').val(datos['apellido_t']);


                        $('#existeT').text("Existe Titular");
                        $('#no_existeT').text("");

                        $('#id_new_titular').val("");

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
                url: "add/validartitular.php",
                success: function(r) {
                    datos = jQuery.parseJSON(r);

                    if (datos['nombre_t'] == null) {

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

                        $('#existeTom').text("Existe Tomador");
                        $('#no_existeTom').text("");

                        $('#id_new_titularT').val("");
                        $("#tomador").css('color', 'black');

                    }
                }
            });
        }


        $("#ramo").change(function() {
            if ($('#ramo').val() == 2 || $('#ramo').val() == 25) {
                $('#tablaveh').removeAttr('hidden');
            } else {
                $('#tablaveh').attr('hidden', true);
            }
        });




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
                url: "add/validar_tarjeta.php",
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
                                    url: "add/ver_poliza_tarjeta.php",
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

                                                    '<td nowrap style="color:white"><a onclick="selecTarjeta(' + datos[index]['id_tarjeta'] + ')" style="color:white" data-tooltip="tooltip" data-placement="top" title="Añadir Tarjeta" class="btn btn-success btn-sm"><i class="fa fa-check-square" ></i></a><a href="b_polizaT.php?id_tarjeta=' + datos[index]['id_tarjeta'] + '" target="_blank" style="color:white" data-tooltip="tooltip" data-placement="top" title="Ver Pólizas" class="btn btn-info btn-sm" ><i class="fa fa-eye"></i></a></td>' +
                                                    '</tr>';

                                            } else {

                                                var htmlTags = '<tr ondblclick="selecTarjeta(' + datos[index]['id_tarjeta'] + ')" style="cursor:pointer">' +
                                                    '<td style="color:red">' + datos[index]['n_tarjeta'] + '</td>' +
                                                    '<td nowrap>' + datos[index]['cvv'] + '</td>' +
                                                    '<td nowrap>' + f_venc + '</td>' +
                                                    '<td>' + datos[index]['nombre_titular'] + '</td>' +
                                                    '<td nowrap>' + datos[index]['banco'] + '</td>' +
                                                    '<td nowrap>Sí</td>' +

                                                    '<td nowrap style="color:white"><a onclick="selecTarjeta(' + datos[index]['id_tarjeta'] + ')" style="color:white" data-tooltip="tooltip" data-placement="top" title="Añadir Tarjeta" class="btn btn-success btn-sm"><i class="fa fa-check-square"></i></a><a href="b_polizaT.php?id_tarjeta=' + datos[index]['id_tarjeta'] + '" target="_blank" style="color:white" data-tooltip="tooltip" data-placement="top" title="Ver Pólizas" class="btn btn-info btn-sm" ><i class="fa fa-eye"></i></a></td>' +
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
                url: "add/b_tarjeta.php",
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