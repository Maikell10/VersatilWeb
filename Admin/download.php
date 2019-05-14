<?php 

$id_poliza=$_GET['id_poliza'].".pdf";

$archivo='C:\Users\HP-USER\Desktop\archivo/'.$id_poliza;
$mi_pdf = fopen ($archivo, "r");
if (!$mi_pdf) {
    echo "<p>No puedo abrir el archivo para lectura</p>";
    exit;
}
header('Content-type: application/pdf');
fpassthru($mi_pdf); // Esto hace la magia
fclose ($archivo);

exit;

$fileName = basename('1988.pdf');
$filePath = 'C:\Users\HP-USER\Desktop\archivo/'.$fileName;
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

?>