<?php 
	
	require_once "../class/clases.php";
	$obj= new Trabajo();

	echo $obj->eliminarAsesor($_POST['idena']);

 ?>