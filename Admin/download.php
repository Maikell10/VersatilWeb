<?php 

$ftp_server="181.197.87.15";
$port=21;
$ftp_usuario="usuario";
$ftp_pass="20127247";
$con_id=@ftp_connect($ftp_server,$port) or die("Unable to connect to server.");
$lr=ftp_login($con_id, $ftp_usuario, $ftp_pass);



$id_poliza=$_GET['id_poliza'].".pdf";
$archivo='./'.$id_poliza;


if ( (!$con_id) || (!$lr) ) {
    echo "no se pudo conectar";
} else {
    
    # Cambiamos al directorio especificado
    if(ftp_chdir($con_id,''))
    {
        // Obtener los archivos contenidos en el directorio actual
        $contents = ftp_nlist($con_id, ".");
        
        foreach(ftp_nlist($con_id, ".") as $val){
            //print $val. "<br>";
        }
        if(ftp_get($con_id, "polizas/".$id_poliza, $id_poliza, FTP_BINARY)){
            //print "el archivo se ha descargado correctamente";
        }else{
            print "ha ocurrido un error";
        }
        
    }
    
    
}



$mi_pdf = fopen ("polizas/".$id_poliza, "r");
if (!$mi_pdf) {
    echo "<p>No puedo abrir el archivo para lectura</p>";
    exit;
}
header('Content-type: application/pdf');
fpassthru($mi_pdf); // Esto hace la magia
//fclose ("polizas/".$id_poliza);
fclose ($mi_pdf);

unlink("polizas/".$id_poliza);
exit;








/*
$fileName = basename('1988.pdf');
$filePath = './'.$fileName;
if(!empty($fileName) && file_exists($filePath)){
    // Define headers
    header("Cache-Control: public");
    header("Content-Description: File Transfer");
    header("Content-Disposition: attachment; filename=$fileName");
    header("Content-Type: application/pdf");
    header("Content-Transfer-Encoding: binary");
    
    // Read the file
    readfile($filePath);
    exit;
    
}else{
    echo 'The file does not exist.';
}
*/
?>