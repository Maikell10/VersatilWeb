<?php
session_start();
if(isset($_SESSION['username'])) {

	}
		else {
				header("Location: login.php");
				exit();
			}

?>

<html>
	<head>
	<title>Usuario</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="../estilo.css">
	<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap-responsive.css">
	<link rel="stylesheet" type="text/css" href="../bootstrap/tablesorter/themes/green/style.css">
	<link rel="stylesheet" type="text/css" href="../bootstrap/font-awesome-4.3.0/css/font-awesome.min.css">
	<script src="../bootstrap/js/jquery-2.1.0.min.js"></script>
	<script src="../bootstrap/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="../bootstrap/tablesorter/jquery.tablesorter.js"></script>
	<script type="text/javascript" src="../bootstrap/tablesorter/jquery.latest.js"></script>
	<style type="text/css">
		.well{
			
			border-radius: 20px;
		}
		nav ul li a:hover{
			color:white;
			text-decoration: none;
		}
		.btn:hover{
			color: black;
		}
		.disabled{
			color: black;
		}
	</style>
	</head>
	<body>

<!-- ********************************************************************  -->
<!--  Menú Hover  -->
	<div >
		<div id="tablamenu">
			<div id="logo-principal">
			</div>
			
			<div id="contenedor-general-primero" class="contenedor-general">
				<div class="logo-interior">
				</div>
				<p class="texto"><a class="btn btn-danger  disabled" href="sesionuser.php"><i class="fa fa-home fa-2x"></i> Home</a></p>
			</div>
			<hr>
			<div class="contenedor-general">
				<div class="logo-interior">
				</div>
				<p class="texto"><a class="btn btn-danger disabled" href="../Usuario/Crear_ETAD/crear_etad.php"><i class="fa fa-plus fa-lg"></i> Crear ETAD</a></p>
			</div>
			<hr>
			<div class="contenedor-general">
				<div class="logo-interior">
				</div>
				<p class="texto"><a class="btn btn-danger " href="../Usuario/Ver_ETAD/tipo_etad.php"><i class="fa fa-book fa-lg"></i> Ver ETAD</a></p>
			</div>
			<hr>
		</div>
	</div>

<!-- ********************************************************************  -->

	<div class="container">	
		<header>	
			<div id="">   
				<img src="../images/encabezado.png" id="logoi">
                <a href="http://www.pdvsa.com"><img src="../images/pdvsa.png" id="logod"></a>
                <hr id="linea">
            </div>
		</header>
		

		<div class="row">
			<div class="col-sm-12">
				<ul class="nav nav-tabs">
					<li class="active"><a href="#" class="btn"><i class="fa fa-home fa-lg"></i> Inicio</a></li>

					<li class=""><a href="../Usuario/Materiales/materiales.php" class="btn" ><i class="fa fa-wrench fa-lg"></i> Materiales </a></li>

					<li class=""><a href="../Usuario/Empresas/empresas.php" class="btn" ><i class="fa fa-suitcase fa-lg"></i> Empresas </a></li>

					<li class=""><a href="../Usuario/Paridad_cambiaria/p_cambiaria.php" class="btn" ><i class="fa fa-usd fa-lg"></i> Paridad Cambiaria</a></li>
					
								
					<li class="pull-right"><a href="cerrar_sesion.php" class="btn btn-danger">Cerrar Sesión <i class="fa fa-user-times fa-lg"></i></a></li>
				</ul>
			</div>
		</div>
		<hr>




	
		
<!-- ************************************************************************************************************************ -->	
<!-- PAGINA DE INICIO DEL PROGRAMA -->	

		<div class="row">
			<div class="col-sm-12">
				<div class="well visible-lg-block">
					<h1 class="text-center"><?php echo "Bienvenido Usuario: ".$_SESSION['username'];?></h1>
				</div>
			</div>
		</div>

		<center><a href="clave.php?usuario=<?php echo $_SESSION['username'];?>" class="btn btn-success">Cambiar Clave de Ingreso <i class="fa fa-user fa-lg"></i></a></td>

		<br><br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		
		
		

		<footer>
			<div id="pie">Sistema ETAD</div>
         <div id="fecha">
        	<?php
				echo date("d/m/Y");
			?>
        </div>
		</footer>
		</div>		
	</body>
</html> 