<?php

session_start();
	$user=$_POST['campousuario'];
	$pass=$_POST['campoclave'];
	
	require_once("conexionbd1.php");
			
			$obj1= new Trabajo();
			$datos = $obj1->get_usuario($user);	
			
			if($pass == $datos[0]['clave_usuario']) 
			{
				$_SESSION['seudonimo'] = $user;
				echo "Sesión exitosa";	
				$permiso = $datos[0]['id_permiso'];	
				if ($datos[0]['activo']==0) {
					header("Location: login.php?m=3");
					exit();
				}				
			}
			
			else {
						header("Location: incorrecto.php?m=1");
						exit();
				  }
	if ($permiso==1) {
		$_SESSION['id_permiso'] = $permiso;
		header("Location: ../Admin/sesionadmin.php?m=1");
	}
	if ($permiso==2) {
		$_SESSION['id_permiso'] = $permiso;
		header("Location: ../Admin/sesionadmin.php?m=1");
	}
	if ($permiso==3) {
		$_SESSION['id_permiso'] = $permiso;
		header("Location: ../Admin/sesionadmin.php?m=1");
	}
				
 
?>