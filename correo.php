<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=gb18030">

    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />
    <link rel="stylesheet" href="assets/css/material-kit.css?v=2.0.1">
    <!-- Documentation extras -->
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="assets/assets-for-demo/demo.css" rel="stylesheet" />
    <link href="assets/assets-for-demo/vertical-nav.css" rel="stylesheet" />


</head>

<body>
    <?php

    require_once("class/clases.php");



    $obj1 = new Trabajo();
    $cliente = $obj1->get_element('titular', 'email');

    $emailC = 'maikell.ods10@gmail.com';

    for ($i = 0; $i < sizeof($cliente); $i++) {
        if ($cliente[$i]['email'] != '-') {

            if ($cliente[$i]['email'] != ' -') {

                if ($cliente[$i]['email'] != '') {
                    

                    ini_set('display_errors', 1);
                    error_reporting(E_ALL);
                    $from = "VersatilSeguros@versatilseguros.com";
                    $to = $cliente[$i]['email'];
                    $subject = "Feliz Navidad de Versatil Seguros";
                
                    $headers = "MIME-Version: 1.0" . "\r\n";
                    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                    $headers .= "From:" . $from;
                
                
                
                    $message = "
                    <html>
                    
                    <body >
                        
                     
                        <div class='section'>
                            <div class='container'>
                                <div class='col-md-auto col-md-offset-2 text-center' id='tablaLoad1'>
                                    <h2 class='title'>Feliz Navidad!!</h2>  
                                </div>
                                
                                <center>
                
                                <img src='http://imgfz.com/i/iGUxECc.jpeg' alt='image' >
                
                                </center>
                            </div>
                
                        </div>
                    
                    
                    </body>
                    
                    </html>";
                
                
                    mail($to, $subject, $message, $headers);
                    echo "The email message was sent.";





                }
            }
        }
    }



    ini_set('display_errors', 1);
    error_reporting(E_ALL);
    $from = "VersatilSeguros@versatilseguros.com";
    $to = $emailC;
    $subject = "Feliz Navidad de Versatil Seguros";

    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= "From:" . $from;



    $message = "
    <html>
    
    <body >
        
     
        <div class='section'>
            <div class='container'>
                <div class='col-md-auto col-md-offset-2 text-center' id='tablaLoad1'>
                    <h2 class='title'>Feliz Navidad!!</h2>  
                </div>
                
                <center>

                <img src='http://imgfz.com/i/iGUxECc.jpeg' alt='image' >

                </center>
            </div>

        </div>
    
    
    </body>
    
    </html>";


    mail($to, $subject, $message, $headers);
    echo "The email message was sent.";





    ?>





    <div class='section'>
        <div class='container'>
            <div class='col-md-auto col-md-offset-2 text-center' id='tablaLoad1'>
                <h2 class='title'>Feliz Navidad!!</h2>
            </div>

            <center>

                <?php

                //$emailC[sizeof($cliente)]=null;
                $emailC = 'maikell.ods10@gmail.com';

                for ($i = 0; $i < sizeof($cliente); $i++) {
                    if ($cliente[$i]['email'] != '-') {

                        if ($cliente[$i]['email'] != ' -') {

                            if ($cliente[$i]['email'] != '') {
                                $emailC = $emailC . ', ' . $cliente[$i]['email'];
                                ?>

                <?php
                            }
                        }
                    }
                }

                ?>
                <p><?php echo $emailC; ?></p>
                <img src='http://imgfz.com/i/iGUxECc.jpeg' alt='image'>

            </center>
        </div>

    </div>


</body>

</html>