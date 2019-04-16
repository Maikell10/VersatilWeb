<?php 
	
	require_once "../class/clases.php";
	$obj= new Trabajo();

	echo $obj->eliminarPoliza($_POST['idpoliza']);

 ?>