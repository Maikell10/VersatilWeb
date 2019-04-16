<?php


	require_once "../../class/clases.php";
	
	$obj= new Trabajo();

	echo json_encode($obj->obtenTitular($_POST['titular']));



?>