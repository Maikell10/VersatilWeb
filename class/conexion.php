

<?php

	class conectar{
		public function conexion(){
			$conexion=mysqli_connect('127.0.0.1',
										'root',
										'',
										'versatil_sdb');
			return $conexion;
		}
	}


 ?>
