<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <!-- Favicons -->
    <link rel="apple-touch-icon" href="../assets/img/apple-icon.png">
    <link rel="icon" href="../assets/img/logo1.png">
    <title>
        Versatil Seguros
    </title>
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />
    <link rel="stylesheet" href="../assets/css/material-kit.css?v=2.0.1">
    <!-- Documentation extras -->
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="../assets/assets-for-demo/demo.css" rel="stylesheet" />
    <link href="../assets/assets-for-demo/vertical-nav.css" rel="stylesheet" />
</head>

<body class="signup-page ">
    <nav class="navbar navbar-color-on-scroll fixed-top navbar-expand-lg bg-info">
        <div class="container">
            <div class="navbar-translate">
                <a class="navbar-brand" href="../index.html"> <img src="../assets/img/logv.png" width="120" /></a>
            </div>
            <div class="collapse navbar-collapse">
               
            </div>
        </div>
    </nav>




    <div class="page-header header-filter" filter-color="purple" style="background-image: url('../assets/img/corolla.jpg'); background-size: cover; background-position: top center;">
        <div class="container">
            <div class="row">
                <div class="col-md-8 ml-auto mr-auto">
                    <div class="card card-signup">
                        <?php
                        if ($_GET['m']==1) {
                        ?>
                        <h4 class="card-title text-center text-danger">No Posee un Asesor Asociado a la Cédula que ingresó</h4>
                        <?php
                        }if ($_GET['m']==2) {
                        ?>
                        <h4 class="card-title text-center text-success">Registrado exitosamente, debe esperar un período de 24h para activación</h4>
                        <?php
                        }if ($_GET['m']==3) {
                        ?>
                        <h4 class="card-title text-center text-danger">Aún no posee usuario activado</h4>
                        <?php
                        }
                        ?>
                        <h2 class="card-title text-center">Ingrese al Sistema de Versatil Seguros</h2>
                        <div class="card-body">
                            <div class="row">
                                
                                <div class="col-md-6 mx-auto ">
                                    
                                    <form class="form" method="post" action="sesion.php">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="material-icons">face</i>
                                                </span>
                                                <input type="text" class="form-control" placeholder="Usuario..." name="campousuario" required>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="material-icons">lock_outline</i>
                                                </span>
                                                <input type="password" placeholder="Password..." class="form-control" name="campoclave" required/>
                                            </div>
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-info btn-round">Login</button>
                                        </div>
                                    </form>
                                    <h4 class="text-center">No tienes una cuenta? <a href="register.php" class="text-danger font-weight-bold">Registrate</a></h4 class="text-center">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
    </div>
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
    <script src="./assets/assets-for-demo/js/material-kit-demo.js"></script>
    <script>
        $(document).ready(function() {
            materialKitDemo.initFormExtendedDatetimepickers();
            // Sliders for demo purpose in refine cards section
            var slider = document.getElementById('sliderRegular');

            noUiSlider.create(slider, {
                start: 40,
                connect: [true, false],
                range: {
                    min: 0,
                    max: 100
                }
            });

            var slider2 = document.getElementById('sliderDouble');

            noUiSlider.create(slider2, {
                start: [20, 60],
                connect: true,
                range: {
                    min: 0,
                    max: 100
                }
            });
        });
    </script>
</body>

</html>