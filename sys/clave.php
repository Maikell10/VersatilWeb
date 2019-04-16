<?php
session_start();
if(isset($_SESSION['username'])) {

	}
		else {
				header("Location: login.php");
				exit();
			}



require_once("../class/usuarios.class.php");
$tra=new Trabajo();
$datos=$tra->get_usuario_por_seudonimo($_GET["usuario"]);

if(isset($_POST["grabar"]) and $_POST["grabar"]=="si")
{
    $tra->edit_clave($_SESSION['username']);
    exit;
}

?>

<html>
	<head>
	<title>Cambio Clave</title>
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
					<h1 class="text-center"><?php echo "Cambio de Clave Usuario: ".$_SESSION['username'];?></h1>
				</div>
			</div>
		</div>


		<?php
			if(isset($_GET["m"]))
			{
			    switch($_GET["m"])
			    {
			        case '1':
			            ?>
			            <h4 style="color: red;">Los datos están vacíos</h4>
			            <?php
			        break;
			        case '2':
			            ?>
			            <h4 style="color: green;">La clave ha sido editada exitosamente</h4>
			            <?php
			        break;
			    }
			}
		?>


		<center><a href="clave.php?usuario=<?php echo $_SESSION['username'];?>" class="btn btn-success">Cambiar Clave de Ingreso <i class="fa fa-user fa-lg"></i></a></td>



		<form name="form" action="" method="post">
		   <table id="myTable" class="tablesorter table table-bordered table-hover table-condensed">
			   <tr>
			   	<th style="background-color:red">Clave : </th>
			   	<td><input type="password" name="clave" class="form-control" value="<?php echo $datos[0]['clave'];?>" maxlength="20"/></td>
			   </tr>
		  	</table>
  			<input type="hidden" name="grabar" value="si" />
		   <input type="hidden" name="id"  value="<?php echo $_GET['usuario'];?>" />
		   <center><input type="submit" value="Editar" title="Editar" class="btn btn-danger" /></center>
		</form>





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