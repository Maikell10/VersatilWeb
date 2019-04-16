<?php


	require_once "../../class/clases.php";
	


	$obj1= new Trabajo();

	echo json_encode($obj1->obtenReporte($_POST['f_hasta'],$_GET['cia']));
	

?>