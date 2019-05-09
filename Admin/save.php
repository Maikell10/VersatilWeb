<?php 

$id_poliza=$_POST['id_poliza'].".pdf";
$nombre=$id_poliza;
$guardado=$_FILES['archivo']['tmp_name'];

$permitidos = array("application/pdf");
$limite_kb = 200;

if(!file_exists('C:\Users\HP-USER\Desktop\archivo')){
	mkdir('C:\Users\HP-USER\Desktop\archivo',0777,true);
	if(file_exists('C:\Users\HP-USER\Desktop\archivo')){
		if(move_uploaded_file($guardado, 'C:\Users\HP-USER\Desktop\archivo/'.$nombre)){
			echo "Archivo guardado con exito";
		}else{
			echo "Archivo no se pudo guardar";
		}
	}
}else{
	if(move_uploaded_file($guardado, 'C:\Users\HP-USER\Desktop\archivo/'.$nombre)){
		echo "Archivo guardado con exito";
	}else{
		echo "Archivo no se pudo guardar";
	}
}

?>