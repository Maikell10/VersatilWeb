<?php
session_start();
if(isset($_SESSION['seudonimo'])) {

  }
    else {
        header("Location: ../sys/login.php");
        exit();
      }


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php require('header.php');?> 
</head>

<body class="profile-page ">
    
    <?php require('navigation.php');?>


    <div class="page-header  header-filter " data-parallax="true" style="background-image: url('../assets/img/logo2.png');">
        <div class="container">
            <div class="row">
                <div class="col-md-8 ml-auto mr-auto">
                    <div class="brand">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="main main-raised">
        <div class="profile-content">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 ml-auto mr-auto">
                        <div class="profile">
                            <div class="avatar">
                                <img src="../assets/img/perfil/<?= $user[0]['seudonimo'].'.jpg';?>" class="rounded-circle">
                            </div>
                            <div class="name">
                                <h3 class="title"><?= $user[0]['nombre_usuario']." ".$user[0]['apellido_usuario'];?></h3>
                                <h6><?php 
                                    if ($user[0]['id_permiso']==1) {
                                        echo 'Administrador';
                                    }
                                    if ($user[0]['id_permiso']==2) {
                                        echo 'Usuario';
                                    }
                                    if ($user[0]['id_permiso']==3) {
                                        echo 'Asesor';
                                    }
                                ?></h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="description text-center table-responsive">
                    <table class="table table-hover table-striped table-bordered">
                        <tr>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>ID</th>
                            <th>Seudónimo</th>
                            <th>Z Producc</th>
                        </tr>
                        <tr>
                            <td><?= $user[0]['nombre_usuario'];?></td>
                            <td><?= $user[0]['apellido_usuario'];?></td>
                            <td><?= $user[0]['cedula_usuario'];?></td>
                            <td><?= $user[0]['seudonimo'];?></td>
                            <td><?= $user[0]['z_produccion'];?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <br><br>

        <div class="description text-center">
            <form class="" enctype="multipart/form-data" action="" method="POST">
                <label class="form-control h4 font-weight-bold">Cargue o Actualice su Foto de Perfil</label>
                <input name="uploadedfile" type="file" class="form-group btn btn-outline-info">
                <div class="">
                <input type="submit" value="Subir archivo" class="form-group btn btn-info">
                </div>
                
            </form>
        </div>
        
        
        <?php
        $uploadedfileload="true";
        $uploadedfile_size=$_FILES['uploadedfile'][size];
        ?>
        <h4 class="text-center"><?= $_FILES[uploadedfile][name]; ?></h4>
        <?php
        
        if ($_FILES[uploadedfile][size]>20000000)
        {$msg=$msg."El archivo es mayor que 200KB, debes reduzcirlo antes de subirlo<BR>";
        $uploadedfileload="false";}

        if (!($_FILES[uploadedfile][type] =="image/jpeg" OR $_FILES[uploadedfile][type] =="image/jpeg" OR $_FILES[uploadedfile][type] =="image/png"))
        {$msg=$msg." Tu archivo tiene que ser JPG o PNG. Otros archivos no son permitidos.<BR> En lo posible ser imágen cuadrada (preferiblemente 400 x 400)";
        $uploadedfileload="false";}

        $file_name=$user[0]['seudonimo'].".jpg";
        $add="../assets/img/perfil/$file_name";
        if($uploadedfileload=="true"){

        if(move_uploaded_file ($_FILES[uploadedfile][tmp_name], $add)){
        ?>
        <h4 class="text-center"><?= " Ha sido subido satisfactoriamente"; ?></h4>
        <?php
        
        }else{
        ?>
        <h4 class="text-center"><?= "Error al subir el archivo"; ?></h4>
        <?php
        }

        }else{
        ?>
        <h4 class="text-center"><?= $msg; ?></h4>
        <?php
        
        }
        ?>

<br>
        <?php require('footer_b.php');?>
    </div>



    <footer class="footer ">
        <div class="container">
            <nav class="pull-left">
                <ul>
                    <li>
                        <a href="https://www.versatilseguros.com">
                            Versatil Panamá
                        </a>
                    </li>
                </ul>
            </nav>
            <div class="copyright pull-right">
                &copy;
                <script>
                    document.write(new Date().getFullYear())
                </script>, Versatil Seguros S.A.
            </div>
        </div>
    </footer>
    <!--   Core JS Files   -->
    <script src="../assets/js/core/jquery.min.js"></script>
    <script src="../assets/js/core/popper.min.js"></script>
    <script src="../assets/js/bootstrap-material-design.js"></script>
    <!--  Plugin for Date Time Picker and Full Calendar Plugin  -->
    <script src="../assets/js/plugins/moment.min.js"></script>
    <!--	Plugin for the Datepicker, full documentation here: https://github.com/Eonasdan/bootstrap-datetimepicker -->
    <script src="../assets/js/plugins/bootstrap-datetimepicker.min.js"></script>
    <!--	Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
    <script src="../assets/js/plugins/nouislider.min.js"></script>
    <!-- Material Kit Core initialisations of plugins and Bootstrap Material Design Library -->
    <script src="../assets/js/material-kit.js?v=2.0.1"></script>
    <!-- Fixed Sidebar Nav - js With initialisations For Demo Purpose, Don't Include it in your project -->
    <script src="../assets/assets-for-demo/js/material-kit-demo.js"></script>
</body>

</html>