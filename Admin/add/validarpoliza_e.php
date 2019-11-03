<?php


	require_once "../../class/clases.php";
	



	$obj1= new Trabajo();

	echo json_encode($obj1->obtenPolizaE($_POST['num_poliza']));
	


	//$array1 = $obj1->obtenPolizaE($_POST['num_poliza']);
	//$array2 = $obj1->obtenPolizaE($_POST['num_poliza']);

	

	//$resultado = array_merge($array1, $array2);

	//echo json_encode($array2);



?>