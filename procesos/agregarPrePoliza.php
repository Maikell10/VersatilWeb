<?php 
session_start();
if(isset($_SESSION['seudonimo'])) {

  }
    else {
        header("Location: login.php");
        exit();
      }

    require_once "../class/clases.php";

    $ob100= new Trabajo();
    $usuario = $ob100->get_element_by_id('usuarios','seudonimo',$_SESSION['seudonimo']);



    $obj3= new Trabajo();
    $ultimo_id_p = $obj3->get_last_element('poliza','id_poliza');
    $u_id_p=($ultimo_id_p[0]['id_poliza']+1);

    $obj4= new Trabajo();
    $asegurado = $obj4->agregarAsegurado($_POST['asegurado'],$u_id_p);

    $obj5= new Trabajo();
    $veh = $obj5->agregarVehiculo('-','-','-','-','-','-','-','-',$_POST['num_poliza']);

    $obj6= new Trabajo();
    $recibo = $obj6->agregarRecibo($_POST['num_poliza'],'2017-01-01','2017-01-01',0,
    'CONTADO',1,0,0,0,$_POST['num_poliza']);

    $obj7= new Trabajo();
    $usuario = $obj7->get_element_by_id('usuarios','seudonimo',$_SESSION['seudonimo']); 
    $z_produc='';
    if (utf8_encode($usuario[0]['z_produccion'])=='PANAMÁ') {
        $z_produc=1;
    }
    if (utf8_encode($usuario[0]['z_produccion'])=='CARACAS') {
        $z_produc=2;
    }
    
    
    $obj= new Trabajo();
    $fhoy=date("Y-m-d");
    $datos=array(
        $_POST['num_poliza'],
        $_POST['idcia'],
        $fhoy,
        $z_produc,
        $usuario[0]['id_usuario']);

    echo $obj->agregarPrePoliza($datos);
    

 ?>