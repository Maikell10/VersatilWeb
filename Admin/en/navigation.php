<?php
//----Obtengo el permiso del usuario
require_once("../../class/clases.php");

$obj11= new Trabajo();
$user = $obj11->get_element_by_id('usuarios','seudonimo',$_SESSION['seudonimo']); 

$permiso = $user[0]['id_permiso'];
//----------------------
?>
<nav class="navbar navbar-color-on-scroll navbar-transparent    fixed-top  navbar-expand-lg bg-info" color-on-scroll="100" id="sectionsNav">
        <div class="container">
            <div class="navbar-translate">
                <a class="navbar-brand" href="../sesionadmin.php"> <img src="../../assets/img/logv.png" width="120" /></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                    <span class="navbar-toggler-icon"></span>
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ml-auto">
                    <?php
                        if ($permiso!=3) {
                    ?>
                    <li class="dropdown nav-item">
                        <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                            <i class="material-icons">plus_one</i> Cargar Datos
                        </a>
                        <div class="dropdown-menu dropdown-with-icons">
                            <a href="../add/crear_poliza.php" class="dropdown-item">
                                <i class="material-icons">add_to_photos</i> Póliza
                            </a>
                            <a href="../add/crear_comision.php" class="dropdown-item">
                                <i class="material-icons">add_to_photos</i> Comisión
                            </a>
                            <a href="../add/crear_asesor.php" class="dropdown-item">
                                <i class="material-icons">person_add</i> Asesor
                            </a>
                            <?php
                                if ($permiso==1) {
                            ?>
                            <a href="../add/crear_compania.php" class="dropdown-item">
                                <i class="material-icons">markunread_mailbox</i> Compañía
                            </a>
                            <a href="../add/crear_usuario.php" class="dropdown-item">
                                <i class="material-icons">person_add</i> Usuario
                            </a>
                            <?php
                                }
                            ?>
                        </div>
                    </li>
                    <?php
                        }
                    ?>

                    <li class="dropdown nav-item">
                        <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                            <i class="material-icons">search</i> Buscar
                        </a>
                        <div class="dropdown-menu dropdown-with-icons">
                            <?php
                                if ($permiso!=3) {
                            ?>
                            <a href="../b_asesor.php" class="dropdown-item">
                                <i class="material-icons">accessibility</i> Asesor
                            </a>
                            <a href="../b_cliente.php" class="dropdown-item">
                                <i class="material-icons">accessibility</i> Cliente
                            </a>
                            <?php
                                }
                            ?>
                            <a href="../b_poliza.php" class="dropdown-item">
                                <i class="material-icons">content_paste</i> Póliza
                            </a>
                            <?php
                                if ($permiso!=3) {
                            ?>
                            <a href="../b_comp.php" class="dropdown-item">
                                <i class="material-icons">markunread_mailbox</i> Compañía
                            </a>
                            <a href="../b_reportes.php" class="dropdown-item">
                                <i class="material-icons">library_books</i> Reportes de Cobranza
                            </a>
                            <?php
                                }
                            ?>
                            <?php
                                if ($permiso==1) {
                            ?>
                            <a href="../b_usuario.php" class="dropdown-item">
                                <i class="material-icons">person</i> Usuario
                            </a>
                            <?php
                                }
                            ?>
                        </div>
                    </li>

                    <li class="dropdown nav-item">
                        <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                            <i class="material-icons">trending_up</i> Gráficos
                        </a>
                        <div class="dropdown-menu dropdown-with-icons">
                            <a href="../grafic/porcentaje.php" class="dropdown-item">
                                <i class="material-icons">pie_chart</i> Porcentajes
                            </a>
                            <a href="../grafic/primas_s.php" class="dropdown-item">
                                <i class="material-icons">bar_chart</i> Primas Suscritas
                            </a>
                            <a href="../grafic/primas_c.php" class="dropdown-item">
                                <i class="material-icons">thumb_up</i> Primas Cobradas
                            </a>
                            <a href="../grafic/comisiones_c.php" class="dropdown-item">
                                <i class="material-icons">timeline</i> Comisiones Cobradas
                            </a>
                            <a href="#" class="dropdown-item">
                                <i class="material-icons">show_chart</i> Gestión de Cobranza
                            </a>
                        </div>
                    </li>

                    <li class="dropdown nav-item">
                        <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                        <i class="fa fa-user fa-lg"></i> <?php echo $_SESSION['seudonimo']?>
                        </a>
                        <div class="dropdown-menu dropdown-with-icons" style="padding:0px">
                            <a class="btn btn-outline-info btn-block" href="../perfil.php">
                                <i class="fa fa-user-cog"> </i>  Ver Perfil
                            </a>
                            <div style="background-color: #00bcd4">
                                <img src="../../assets/img/perfil/<?php echo $user[0]['seudonimo'].'.jpg';?>" class="rounded-circle card-img-top btn-sm">
                            </div>
                            <a class="btn btn-outline-danger btn-block" href="../../sys/cerrar_sesion.php">
                                <i class="fa fa-power-off"> </i>  Cerrar Sesión
                            </a>
                        </div>
                    </li>
                   
                </ul>
            </div>
        </div>
    </nav>