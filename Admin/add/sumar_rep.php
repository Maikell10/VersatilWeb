<?php


	require_once "../../class/clases.php";
	


	$obj1= new Trabajo();

	echo json_encode($obj1->obtenSumaReporte($_POST['id_rep_com']));
	

?>