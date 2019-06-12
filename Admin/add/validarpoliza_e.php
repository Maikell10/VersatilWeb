<?php


	require_once "../../class/clases.php";
	



	$obj1= new Trabajo();

	echo json_encode($obj1->obtenPolizaE($_POST['num_poliza']));
	



?>