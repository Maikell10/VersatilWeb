<?php

session_start();
if(isset($_SESSION['seudonimo'])) {

  }
    else {
        header("Location: login.php");
        exit();
      }
      
  require_once("../../class/clases.php");

  //----Obtengo el permiso del usuario
  $permiso = $_SESSION['id_permiso'];
  //----------------------




	$n_poliza=$_POST['n_poliza'];
	$fhoy=date("Y-m-d");
    //$femisionP=$_POST['emisionP'];
    $femisionP=date("Y-m-d");
	$t_cobertura=$_POST['t_cobertura'];
	$fdesdeP=$_POST['desdeP'];
	$fhastaP=$_POST['hastaP'];
	$currency=$_POST['currency'];
	$tipo_poliza=$_POST['tipo_poliza'];
	$sumaA=$_POST['sumaA'];
	$z_produc=$_POST['z_produc'];
	$codasesor=$_POST['asesor'];
    $u=explode('=', $codasesor);
	$ramo=$_POST['ramo'];
	$cia=$_POST['cia'];
	$titular=$_POST['titular'];
	
	
	$n_recibo=$_POST['n_recibo'];
	$fdesde_recibo=$_POST['desde_recibo'];
	$fhasta_recibo=$_POST['hasta_recibo'];
	$prima=$_POST['prima'];
    $f_pago=$_POST['f_pago'];

    $forma_pago='PAGO VOLUNTARIO';
    if ($_POST['forma_pago']==1) {
        $forma_pago='ACH (CARGO EN CUENTA)';
    }
    if ($_POST['forma_pago']==2) {
        $forma_pago='TARJETA DE CREDITO / DEBITO';
    }
    $n_tarjeta=$_POST['n_tarjeta'];
    if ($_POST['n_tarjeta']==null) {
        $n_tarjeta='N/A';
    }
    $cvv=$_POST['cvv'];
    if ($_POST['cvv']==null) {
        $cvv='N/A';
    }
    $fechaV=$_POST['fechaV'];
    if ($_POST['fechaV']==null) {
        $fechaV='N/A';
    }
    $titular_tarjeta=$_POST['titular_tarjeta'];
    if ($_POST['titular_tarjeta']==null) {
        $titular_tarjeta='N/A';
    }
    
    $obs=$_POST['obs'];

	$n_cuotas=$_POST['n_cuotas'];

	if ($f_pago==1) {
		$n_cuotas=1;
		$monto_cuotas=$prima;
	}else{
		$monto_cuotas=$prima/$n_cuotas;
	}

	
	$tomador=$_POST['tomador'];
	$titular=$_POST['titular'];

	$obj3= new Trabajo();
  	$idtomador = $obj3->get_id_cliente($tomador); 


  	$obj4= new Trabajo();
  	$idtitular = $obj4->get_id_cliente($titular); 

	

  	$tipo_poliza_print="";
  	if ($tipo_poliza==1) {
  		$tipo_poliza_print="Primer Año";
  	}
    if ($tipo_poliza==2) {
        $tipo_poliza_print="Renovación";
    }
    if ($tipo_poliza==3) {
        $tipo_poliza_print="Traspaso de Cartera";
    }
    if ($tipo_poliza==4) {
        $tipo_poliza_print="Anexos";
    }
    if ($tipo_poliza==5) {
        $tipo_poliza_print="Revalorización";
    }


    $obj5= new Trabajo();
    $nombre_ramo = $obj5->get_element_by_id('dramo','cod_ramo',$ramo); 

    $obj6= new Trabajo();
    $nombre_cia = $obj6->get_element_by_id('dcia','idcia',$cia); 

    if ($f_pago==1) {
        $f_pago='CONTADO';
    }
    if ($f_pago==2) {
        $f_pago='FRACCIONADO';
    }
    if ($f_pago==3) {
        $f_pago='FINANCIADO';
    }


    $currencyl="";
    if ($currency==1) {
        $currencyl="$ ";
    }else{$currencyl="Bs ";}

    if ($_POST['t_cuenta']==1) {
        $t_cuenta='Individual';
    } else {
        $t_cuenta='Colectivo';
    }
    


    //$originalEmision = $_POST['emisionP'];
    //$newEmision = date("d/m/Y", strtotime($originalEmision));
    $originalDesdeP = $_POST['desdeP'];
    $newDesdeP = date("d/m/Y", strtotime($originalDesdeP));
    $originalHastaP = $_POST['hastaP'];
    $newHastaP = date("d/m/Y", strtotime($originalHastaP));
    $originalDesdeR = $_POST['desde_recibo'];
    $newDesdeR = date("d/m/Y", strtotime($originalDesdeR));
    $originalHastaR = $_POST['hasta_recibo'];
    $newHastaR = date("d/m/Y", strtotime($originalHastaR));


    if ($sumaA=="") {
        $sumaA=0;
    }


    if ($nombre_cia[0]['preferencial']==1) {
        
    }


    $obj7= new Trabajo();
    $asesor_ind = $obj7->get_element_by_id('ena','cod',$u[0]); 
    $as=0;
    if ($ramo==35) {
        $per_gc=$asesor_ind[0]['gc_viajes'];
    } else {
        $per_gc=$asesor_ind[0]['nopre1'];
    }

    if ($asesor_ind[0]['nopre1']==null) {
        //buscar en referidor";
        $obj7= new Trabajo();
        $asesor_ind_r = $obj7->get_element_by_id('enr','cod',$u[0]); 
        $per_gc=$asesor_ind_r[0]['monto'];
        $as=1;
        if ($asesor_ind_r[0]['currency']=='$') {
           $tipo_r=1;
        }
        if ($asesor_ind_r[0]['currency']=='%') {
            $tipo_r=2;
        }

    }
    if ($asesor_ind[0]['nopre1']==null && $asesor_ind_r[0]['monto']==null) {
        //buscar en proyecto";
        echo 'Aún módulo para Proyecto no esta generado';
        exit();
        $obj7= new Trabajo();
        $asesor_ind = $obj7->get_element_by_id('enr','cod',$u[0]); 
        $as=2;

    }

    $placa=$_POST['placa'];
    $tipo=$_POST['tipo'];
    $marca=$_POST['marca'];
    $modelo=$_POST['modelo'];
    $anio=$_POST['anio'];
    //$color=$_POST['color'];
    //$serial=$_POST['serial'];
    //$categoria=$_POST['categoria'];
    $color='-';
    $serial='-';
    $categoria='-';


    $fdesdeCP = date("Y-m-d", strtotime($fdesdeP));
    $obj77= new Trabajo();
    $cia_pref = $obj77->get_per_gc_cia_pref($fdesdeCP,$cia,$u[0]); 
    if ($cia_pref[0]['per_gc_sum']!=null && $ramo!=35) {
        $per_gc=$per_gc+$cia_pref[0]['per_gc_sum'];
    }

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
                <center>
                <div class="col-md-auto col-md-offset-2">
                    <h1 class="title"><i class="fa fa-book" aria-hidden="true"></i>&nbsp;Previsualizar Nueva Póliza
                    </h1>  
                </div>


            
                
                <form class="form-horizontal" id="frmnuevo" >
                    <div class="form-row table-responsive">      
                        <table class="table table-hover table-striped table-bordered" id="iddatatable" >
                            <thead style="background-color: #92ACC4;color: white; font-weight: bold;">
                                <tr>
                                    <th nowrap colspan="2">N° de Póliza</th>
                                    <!--<th nowrap>Fecha Emisión</th>-->
                                    <th nowrap>Fecha Desde Seguro</th>
                                    <th nowrap>Fecha Hasta Seguro</th>
                                    <th nowrap>Tipo de Póliza</th>
                                </tr>
                            </thead>

                            <tbody >
                                <div class="form-group col-md-12">
                                <tr >
                                    <td colspan="2"><input type="text" class="form-control" name="n_poliza" readonly="readonly" value="<?php echo $n_poliza;?>" style="background-color:rgba(26, 197, 26, 0.932);color:white"></td>
                                    <!--<td><input type="text" class="form-control" name="emisionP" readonly="readonly" value="<?php echo $newEmision;?>"></td>-->
                                    <td><input type="text" class="form-control" name="desdeP" readonly="readonly" value="<?php echo $newDesdeP;?>"></td>
                                    <td><input type="text" class="form-control" name="hastaP" readonly="readonly" value="<?php echo $newHastaP;?>"></td>
                                    <td><input type="text" class="form-control" name="tipo_poliza" readonly="readonly" value="<?php echo $tipo_poliza_print;?>"></td>
                                </tr>

                                <tr style="background-color: #92ACC4;color: white; font-weight: bold;">
                                    <th colspan="2">Ramo</th>
                                    <th colspan="2">Compañía</th>
                                    <th>Tipo Cuenta</th>
                                    <th hidden nowrap>Tipo de Cobertura</th>
                                </tr>
                                <tr>
                                    <td colspan="2"><input type="text" class="form-control" name="ramo" readonly="readonly" value="<?php echo $nombre_ramo[0]['nramo'];?>"></td>
                                    <td colspan="2"><input type="text" class="form-control" name="cia" readonly="readonly" value="<?php echo $nombre_cia[0]['nomcia'];?>" style="background-color:rgba(26, 197, 26, 0.932);color:white"></td>
                                    <td><input type="text" class="form-control" name="t_cuenta" readonly="readonly" value="<?php echo $t_cuenta;?>"></td>
                                    <td hidden><input type="text" class="form-control" name="t_cobertura" readonly="readonly" value="<?php echo $t_cobertura;?>"></td>
                                </tr>

                                <tr style="background-color: #92ACC4;color: white; font-weight: bold;">
                                    <th nowrap>Suma Asegurada</th>
                                    <th nowrap>Prima Suscrita</th>
                                    <th nowrap>Periocidad de Pago</th>
                                    <th nowrap>N° de Cuotas</th>
                                    <th nowrap>Monto Cuotas</th>
                                </tr>
                                <tr >
                                    <td><input type="text" class="form-control" name="sumaA" readonly="readonly" value="<?php echo $currencyl.number_format($sumaA,2);?>"></td>
                                    <td><input type="text" class="form-control" name="prima" readonly="readonly" value="<?php echo $currencyl.number_format($prima,2);?>" style="background-color:rgba(228, 66, 66, 0.87);color:white"></td>
                                    <td><input type="text" class="form-control" name="f_pago" readonly="readonly" value="<?php echo $f_pago;?>"></td>
                                    <td><input type="text" class="form-control" name="n_cuotas" readonly="readonly" value="<?php echo $n_cuotas;?>"></td>
                                    <td><input type="text" class="form-control" name="monto_cuotas" readonly="readonly" value="<?php echo $currencyl.number_format($monto_cuotas,2);?>"></td>
                                </tr>

                                <tr style="background-color: #92ACC4;color: white; font-weight: bold;">
                                    <th nowrap>Forma de Pago</th>
                                    <th nowrap>Nº Tarjeta</th>
                                    <th nowrap>CVV</th>
                                    <th nowrap>Fecha de Vencimiento</th>
                                    <th nowrap>Nombre Tarjetahabiente</th>
                                </tr>
                                <tr >
                                    <td><input type="text" class="form-control" name="forma_pago" readonly="readonly" value="<?php echo $forma_pago;?>"></td>
                                    <td><input type="text" class="form-control" name="n_tarjeta" readonly="readonly" value="<?php echo $n_tarjeta;?>"></td>
                                    <td><input type="text" class="form-control" name="cvv" readonly="readonly" value="<?php echo $cvv;?>"></td>
                                    <td><input type="text" class="form-control" name="fechaV" readonly="readonly" value="<?php echo $fechaV;?>"></td>
                                    <td><input type="text" class="form-control" name="titular_tarjeta" readonly="readonly" value="<?php echo $titular_tarjeta;?>"></td>
                                </tr>

                                <tr style="background-color: #92ACC4;color: white; font-weight: bold;">
                                    <th nowrap colspan="2">N° Recibo</th>
                                    <th nowrap>Fecha Desde Recibo</th>
                                    <th nowrap>Fecha Hasta Recibo</th>
                                    <th nowrap>Zona de Produc</th>
                                </tr>
                                <tr >
                                    <td colspan="2"><input type="text" class="form-control" name="n_recibo" readonly="readonly" value="<?php echo $n_recibo;?>"></td>
                                    <td><input type="text" class="form-control" name="desde_recibo" readonly="readonly" value="<?php echo $newDesdeR;?>"></td>
                                    <td><input type="text" class="form-control" name="hasta_recibo" readonly="readonly" value="<?php echo $newHastaR;?>"></td>
                                    <td><input type="text" class="form-control" name="z_produc" readonly="readonly" value="<?php echo $z_produc;?>"></td>
                                </tr>

                                <?php   if ($cia_pref[0]['per_gc_sum']!=null && $ramo!=35 && $as==0) {
                                            //$per_gc=$per_gc+$cia_pref[0]['per_gc_sum'];
                                ?>
                                <tr style="background-color: #92ACC4;color: white; font-weight: bold;">
                                    <th nowrap >Cía Preferencial</th>
                                    <th colspan="2">% GC Base Asesor</th>
                                    <th nowrap colspan="2">% GC Preferencial del Asesor por Cía</th>
                                </tr>
                                <tr >
                                    <td><input type="text" class="form-control" name="asesor" readonly="readonly" value="<?php echo 'Sí';?>"></td>
                                    <td colspan="2"><input type="text" class="form-control" name="asesor" readonly="readonly" value="<?php echo $per_gc-$cia_pref[0]['per_gc_sum'];?>" style="background-color:rgba(26, 197, 26, 0.932);color:white"></td>
                                    <td colspan="3"><input type="text" class="form-control" name="asesor" readonly="readonly" value="<?php echo $cia_pref[0]['per_gc_sum'];?>" style="background-color:rgba(26, 197, 26, 0.932);color:white"></td>
                                </tr>
                                <?php   
                                        }
                                        if ($as==0) {
                                ?>   
                                <tr style="background-color: #92ACC4;color: white; font-weight: bold;">
                                    <th nowrap colspan="3">Asesor</th>
                                    <th nowrap colspan="2">% GC Asesor</th>
                                </tr>
                                <tr >
                                    <td colspan="3"><input type="text" class="form-control" name="asesor" readonly="readonly" value="<?php echo $u[0]." => ".$u[1];?>" style="background-color:rgba(26, 197, 26, 0.932);color:white"></td>
                                    <?php if ($permiso==1) { ?>
                                        <td colspan="2" style="background-color:white"><input type="text" onChange="document.links.enlace.href='poliza_n.php?n_poliza=<?php echo $n_poliza;?>&fhoy=<?php echo $fhoy;?>&emisionP=<?php echo $femisionP;?>&t_cobertura=<?php echo $t_cobertura;?>&desdeP=<?php echo $fdesdeP;?>&hastaP=<?php echo $fhastaP;?>&currency=<?php echo $currency;?>&tipo_poliza=<?php echo $tipo_poliza;?>&sumaA=<?php echo $sumaA;?>&z_produc=<?php echo $z_produc;?>&asesor=<?php echo $u[0];?>&ramo=<?php echo $ramo;?>&cia=<?php echo $cia;?>&titular=<?php echo $titular;?>&n_recibo=<?php echo $n_recibo;?>&desde_recibo=<?php echo $fdesde_recibo;?>&hasta_recibo=<?php echo $fhasta_recibo;?>&prima=<?php echo $prima;?>&f_pago=<?php echo $f_pago;?>&n_cuotas=<?php echo $n_cuotas;?>&monto_cuotas=<?php echo $monto_cuotas;?>&tomador=<?php echo $tomador;?>&placa=<?php echo $placa;?>&tipo=<?php echo $tipo;?>&marca=<?php echo $marca;?>&modelo=<?php echo $modelo;?>&anio=<?php echo $anio;?>&color=<?php echo $color;?>&serial=<?php echo $serial;?>&categoria=<?php echo $categoria;?>&t_cuenta=<?php echo $_POST['t_cuenta'];?>&obs=<?php echo $obs;?>&forma_pago=<?php echo $_POST['forma_pago'];?>&n_tarjeta=<?php echo $n_tarjeta;?>&cvv=<?php echo $cvv;?>&fechaV=<?php echo $fechaV;?>&titular_tarjeta=<?php echo $titular_tarjeta;?>&asesor_ind='+this.value+'';" class="form-control validanumericos" name="per_gc" value="<?php echo $per_gc;?>" require data-toggle="tooltip" data-placement="bottom" title="Ingrese % de GC del Asesor (Sólo números)"></td>
                                    <?php } else {?>
                                        <td colspan="2" ><input type="text" class="form-control" name="per_gc" value="<?php echo $per_gc;?>" readonly></td>
                                    <?php    } ?>
                                    
                                </tr>
                                <?php  
                                        }
                                        if ($as==1 && $tipo_r==1) {
                                ?>
                                <tr style="background-color: #92ACC4;color: white; font-weight: bold;">
                                    <th nowrap colspan="3">Referidor</th>
                                    <th nowrap colspan="2">Monto GC Referidor</th>
                                </tr>
                                <tr >
                                    <td colspan="3"><input type="text" class="form-control" name="asesor" readonly="readonly" value="<?php echo $u[0]." => ".$u[1];?>" style="background-color:rgba(26, 197, 26, 0.932);color:white"></td>
                                    <?php if ($permiso==1) { ?>
                                        <td colspan="2" style="background-color:white"><input type="text" onChange="document.links.enlace.href='poliza_n.php?n_poliza=<?php echo $n_poliza;?>&fhoy=<?php echo $fhoy;?>&emisionP=<?php echo $femisionP;?>&t_cobertura=<?php echo $t_cobertura;?>&desdeP=<?php echo $fdesdeP;?>&hastaP=<?php echo $fhastaP;?>&currency=<?php echo $currency;?>&tipo_poliza=<?php echo $tipo_poliza;?>&sumaA=<?php echo $sumaA;?>&z_produc=<?php echo $z_produc;?>&asesor=<?php echo $u[0];?>&ramo=<?php echo $ramo;?>&cia=<?php echo $cia;?>&titular=<?php echo $titular;?>&n_recibo=<?php echo $n_recibo;?>&desde_recibo=<?php echo $fdesde_recibo;?>&hasta_recibo=<?php echo $fhasta_recibo;?>&prima=<?php echo $prima;?>&f_pago=<?php echo $f_pago;?>&n_cuotas=<?php echo $n_cuotas;?>&monto_cuotas=<?php echo $monto_cuotas;?>&tomador=<?php echo $tomador;?>&placa=<?php echo $placa;?>&tipo=<?php echo $tipo;?>&marca=<?php echo $marca;?>&modelo=<?php echo $modelo;?>&anio=<?php echo $anio;?>&color=<?php echo $color;?>&serial=<?php echo $serial;?>&categoria=<?php echo $categoria;?>&t_cuenta=<?php echo $_POST['t_cuenta'];?>&obs=<?php echo $obs;?>&forma_pago=<?php echo $_POST['forma_pago'];?>&n_tarjeta=<?php echo $n_tarjeta;?>&cvv=<?php echo $cvv;?>&fechaV=<?php echo $fechaV;?>&titular_tarjeta=<?php echo $titular_tarjeta;?>&asesor_ind='+this.value+'';" class="form-control validanumericos" name="per_gc" value="<?php echo $per_gc;?>" require data-toggle="tooltip" data-placement="bottom" title="Ingrese Monto de GC del Referidor (Sólo números)"></td>
                                    <?php } else {?>
                                        <td colspan="2" ><input type="text" class="form-control" name="per_gc" value="<?php echo $per_gc;?>" readonly></td>
                                    <?php    } ?>
                                    
                                </tr>
                                <?php  
                                        }
                                        if ($as==1 && $tipo_r==2) {
                                ?>
                                <tr style="background-color: #92ACC4;color: white; font-weight: bold;">
                                    <th nowrap colspan="3">Referidor</th>
                                    <th nowrap colspan="2">% GC Referidor</th>
                                </tr>
                                <tr >
                                    <td colspan="3"><input type="text" class="form-control" name="asesor" readonly="readonly" value="<?php echo $u[0]." => ".$u[1];?>" style="background-color:rgba(26, 197, 26, 0.932);color:white"></td>
                                    <?php if ($permiso==1) { ?>
                                        <td colspan="2" style="background-color:white"><input type="text" onChange="document.links.enlace.href='poliza_n.php?n_poliza=<?php echo $n_poliza;?>&fhoy=<?php echo $fhoy;?>&emisionP=<?php echo $femisionP;?>&t_cobertura=<?php echo $t_cobertura;?>&desdeP=<?php echo $fdesdeP;?>&hastaP=<?php echo $fhastaP;?>&currency=<?php echo $currency;?>&tipo_poliza=<?php echo $tipo_poliza;?>&sumaA=<?php echo $sumaA;?>&z_produc=<?php echo $z_produc;?>&asesor=<?php echo $u[0];?>&ramo=<?php echo $ramo;?>&cia=<?php echo $cia;?>&titular=<?php echo $titular;?>&n_recibo=<?php echo $n_recibo;?>&desde_recibo=<?php echo $fdesde_recibo;?>&hasta_recibo=<?php echo $fhasta_recibo;?>&prima=<?php echo $prima;?>&f_pago=<?php echo $f_pago;?>&n_cuotas=<?php echo $n_cuotas;?>&monto_cuotas=<?php echo $monto_cuotas;?>&tomador=<?php echo $tomador;?>&placa=<?php echo $placa;?>&tipo=<?php echo $tipo;?>&marca=<?php echo $marca;?>&modelo=<?php echo $modelo;?>&anio=<?php echo $anio;?>&color=<?php echo $color;?>&serial=<?php echo $serial;?>&categoria=<?php echo $categoria;?>&t_cuenta=<?php echo $_POST['t_cuenta'];?>&obs=<?php echo $obs;?>&forma_pago=<?php echo $_POST['forma_pago'];?>&n_tarjeta=<?php echo $n_tarjeta;?>&cvv=<?php echo $cvv;?>&fechaV=<?php echo $fechaV;?>&titular_tarjeta=<?php echo $titular_tarjeta;?>&asesor_ind='+this.value+'';" class="form-control validanumericos" name="per_gc" value="<?php echo $per_gc;?>" require data-toggle="tooltip" data-placement="bottom" title="Ingrese % de GC del Referidor (Sólo números)"></td>
                                    <?php } else {?>
                                        <td colspan="2" ><input type="text" class="form-control" name="per_gc" value="<?php echo $per_gc;?>" readonly></td>
                                    <?php    } ?>
                                    
                                </tr>
                                <?php  
                                        }
                                ?>
                                

                                
                                


                                <tr style="background-color: #92ACC4;color: white; font-weight: bold;">
                                    <th colspan="2">N° ID Titular</th>
                                    <th colspan="3">Nombre(s) y Apellido(s) Titular</th>
                                </tr>
                                <tr >
                                    <td colspan="2"><input type="text" class="form-control" name="titular" readonly="readonly" value="<?php echo $titular;?>"></td>
                                    <td colspan="3"><input type="text" class="form-control" name="n_titular" readonly="readonly" value="<?php echo $idtitular[0]['nombre_t']." ".$idtitular[0]['apellido_t'];?>" style="background-color:rgba(26, 197, 26, 0.932);color:white"></td>
                                </tr>

                                <tr style="background-color: #92ACC4;color: white; font-weight: bold;">
                                    <th colspan="2">N° ID Tomador</th>
                                    <th colspan="3">Nombre(s) y Apellido(s) Tomador</th>
                                </tr>
                                <tr >
                                    <td colspan="2"><input type="text" class="form-control" name="tomador" readonly="readonly" value="<?php echo $idtomador[0]['ci'];?>"></td>
                                    <td colspan="3"><input type="text" class="form-control" name="n_tomador" readonly="readonly" value="<?php echo $idtomador[0]['nombre_t']." ".$idtomador[0]['apellido_t'];?>"></td>
                                </tr>

                                <?php 
                                    if ($ramo==2 || $ramo==25) {
                                ?>
                                <tr style="background-color: #92ACC4;color: white; font-weight: bold;">
                                    <th>Placa</th>
                                    <th>Marca</th>
                                    <th>Modelo</th>
                                    <th>Tipo</th>
                                    <th>Año</th>
                                </tr>
                                <tr >
                                    <td><input type="text" class="form-control" name="placa" readonly="readonly" value="<?php echo $placa;?>"></td>
                                    <td><input type="text" class="form-control" name="marca" readonly="readonly" value="<?php echo $marca;?>"></td>
                                    <td><input type="text" class="form-control" name="modelo" readonly="readonly" value="<?php echo $modelo;?>"></td>
                                    <td><input type="text" class="form-control" name="tipo" readonly="readonly" value="<?php echo $tipo;?>"></td>
                                    <td><input type="text" class="form-control" name="anio" readonly="readonly" value="<?php echo $anio;?>"></td>
                                </tr>

                                <!--<tr style="background-color: #92ACC4;color: white; font-weight: bold;">
                                    <th>Año</th>
                                    <th>Color</th>
                                    <th>Serial</th>
                                    <th colspan="2">Categoría</th>
                                </tr>
                                <tr >
                                    <td><input type="text" class="form-control" name="anio" readonly="readonly" value="<?php echo $anio;?>"></td>
                                    <td><input type="text" class="form-control" name="color" readonly="readonly" value="<?php echo $color;?>"></td>
                                    <td><input type="text" class="form-control" name="serial" readonly="readonly" value="<?php echo $serial;?>"></td>
                                    <td colspan="2"><input type="text" class="form-control" name="categoria" readonly="readonly" value="<?php echo $categoria;?>"></td>
                                </tr>-->

                                <?php   
                                    }
                                ?>

                                <tr style="background-color: #92ACC4;color: white; font-weight: bold;">
                                    <th colspan="5">Observaciones</th>
                                </tr>
                                <tr >
                                    <td colspan="5"><input type="text" class="form-control" name="obs" readonly="readonly" value="<?php echo $obs;?>"></td>
                                </tr>

                                </div>
                            </tbody>
                        </table>
                    </div>




                      <center>
                        <a name="enlace" href="poliza_n.php?n_poliza=<?php echo $n_poliza;?>&fhoy=<?php echo $fhoy;?>&emisionP=<?php echo $femisionP;?>&t_cobertura=<?php echo $t_cobertura;?>&desdeP=<?php echo $fdesdeP;?>&hastaP=<?php echo $fhastaP;?>&currency=<?php echo $currency;?>&tipo_poliza=<?php echo $tipo_poliza;?>&sumaA=<?php echo $sumaA;?>&z_produc=<?php echo $z_produc;?>&asesor=<?php echo $u[0];?>&ramo=<?php echo $ramo;?>&cia=<?php echo $cia;?>&titular=<?php echo $titular;?>&n_recibo=<?php echo $n_recibo;?>&desde_recibo=<?php echo $fdesde_recibo;?>&hasta_recibo=<?php echo $fhasta_recibo;?>&prima=<?php echo $prima;?>&f_pago=<?php echo $f_pago;?>&n_cuotas=<?php echo $n_cuotas;?>&monto_cuotas=<?php echo $monto_cuotas;?>&tomador=<?php echo $tomador;?>&placa=<?php echo $placa;?>&tipo=<?php echo $tipo;?>&marca=<?php echo $marca;?>&modelo=<?php echo $modelo;?>&anio=<?php echo $anio;?>&color=<?php echo $color;?>&serial=<?php echo $serial;?>&categoria=<?php echo $categoria;?>&asesor_ind=<?php echo $per_gc;?>&t_cuenta=<?php echo $_POST['t_cuenta'];?>&obs=<?php echo $obs;?>&forma_pago=<?php echo $_POST['forma_pago'];?>&n_tarjeta=<?php echo $n_tarjeta;?>&cvv=<?php echo $cvv;?>&fechaV=<?php echo $fechaV;?>&titular_tarjeta=<?php echo $titular_tarjeta;?>" class="btn btn-info btn-lg btn-round">Confirmar</a></center>
                        
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