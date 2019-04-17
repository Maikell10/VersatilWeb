<?php
class Conectar{

	protected function con() {

		$hostname="127.0.0.1";
		$username="root";
		$password="";
		$dbname="versatil_sdb";
		
		$con=mysqli_connect($hostname,$username, $password, $dbname) or die ("No se Conecta");
		//$con=mysql_connect($hostname,$username, $password) or die ("No se Conecta");
		//mysql_select_db($dbname,$con) or die ("No conecta bd");
		

		return $con;
	}	
	
}	

class Trabajo extends Conectar{
		



	public function get_element($tabla,$campo)
		    {
		      	$sql="SELECT * FROM $tabla ORDER BY $campo ASC";
				$res=mysqli_query(Conectar::con(),$sql);
				
				if (!$res) {
				    //No hay registros
				}else{
					$filas=mysqli_num_rows($res); 
					if ($filas == 0) { 
				      	//header("Location: incorrecto.php?m=2");
				      	exit();
			      	}else
		            	{
		               		while($reg=mysqli_fetch_assoc($res)) {
		               			$this->t[]=$reg;
		              		}
	              			return $this->t;
						}
				}

				
		       }



	public function get_distinct_element($campo,$tabla)
		    {
		      	$sql="SELECT DISTINCT $campo FROM $tabla ORDER BY $campo ASC";
				$res=mysqli_query(Conectar::con(),$sql);
				
				if (!$res) {
				    //No hay registros
				}else{
					$filas=mysqli_num_rows($res); 
					if ($filas == 0) { 
				      	//header("Location: incorrecto.php?m=2");
				      	exit();
			      	}else
		            	{
		               		while($reg=mysqli_fetch_assoc($res)) {
		               			$this->t[]=$reg;
		              		}
	              			return $this->t;
						}
				}
		       }



	public function get_element_by_id($tabla,$cond,$campo)
		  {
		      	$sql="SELECT * FROM $tabla WHERE $cond = '$campo'";
				$res=mysqli_query(Conectar::con(),$sql);
				
				if (!$res) {
				    //No hay registros
				}else{
					$filas=mysqli_num_rows($res); 
					if ($filas == 0) { 
				      	//header("Location: incorrecto.php?m=2");
				      	//exit();
			      	}else
		            	{
		               		while($reg=mysqli_fetch_assoc($res)) {
		               			$this->t[]=$reg;
		              		}
	              			return $this->t;
						}
				}
		  }


	public function get_last_element($tabla,$campo)
		    {
		      	$sql="SELECT * FROM $tabla ORDER BY $campo DESC";
				$res=mysqli_query(Conectar::con(),$sql);
				
				if (!$res) {
				    //No hay registros
				}else{
					$filas=mysqli_num_rows($res); 
					if ($filas == 0) { 
				      	//header("Location: incorrecto.php?m=2");
				      	exit();
			      	}else
		            	{
		               		while($reg=mysqli_fetch_assoc($res)) {
		               			$this->t[]=$reg;
		              		}
	              			return $this->t;
						}
				}
		       }











//-------------------------------------------------------------       
//-------------------------------------------------------------
//-------------------------------------------------------------
//-------------------------------PRODUCCION--------------------

		public function get_poliza_total()
		    {
		      	$sql="SELECT *  FROM 
                    poliza
                  	INNER JOIN drecibo, titular, tipo_poliza
                  	WHERE 
                  	poliza.id_poliza = drecibo.idrecibo AND
                  	poliza.id_tpoliza = tipo_poliza.id_t_poliza AND
                  	drecibo.idtitu = titular.id_titular
                    ORDER BY poliza.id_poliza ASC";
				$res=mysqli_query(Conectar::con(),$sql);
				
				if (!$res) {
				    //No hay registros
				}else{
					$filas=mysqli_num_rows($res); 
					if ($filas == 0) { 
				      	//header("Location: incorrecto.php?m=2");
				      	exit();
			      	}else
			      		{
		               		while($reg=mysqli_fetch_assoc($res)) {
		               			$this->t[]=$reg;
		              		}
	              			return $this->t;
						}
				}

				
			}	


		public function get_poliza_total_by_id($id_poliza)
		    {
		      	$sql="SELECT *  FROM 
                    poliza
                  	INNER JOIN drecibo, titular, tipo_poliza, dramo, dcia, ena
                  	WHERE 
                  	poliza.id_poliza = drecibo.idrecibo AND
                  	poliza.id_titular = titular.id_titular AND 
                  	poliza.id_tpoliza = tipo_poliza.id_t_poliza AND
                  	poliza.id_cod_ramo = dramo.cod_ramo AND
                    poliza.id_cia = dcia.idcia AND
                    poliza.codvend = ena.cod AND
                  	poliza.id_poliza = $id_poliza
                    ORDER BY poliza.id_poliza ASC";
				$res=mysqli_query(Conectar::con(),$sql);
				
				if (!$res) {
				    //No hay registros
				}else{
					$filas=mysqli_num_rows($res); 
					if ($filas == 0) { 
				      	//header("Location: incorrecto.php?m=2");
				      	//exit();
			      	}else
			      		{
		               		while($reg=mysqli_fetch_assoc($res)) {
		               			$this->t[]=$reg;
		              		}
	              			return $this->t;
						}
				}

				
			}	

		public function get_poliza_total1_by_id($id_poliza)
		    {
		      	$sql="SELECT *  FROM 
	                    poliza
	                  	INNER JOIN drecibo, titular, tipo_poliza, dramo, dcia, enp
	                  	WHERE 
	                  	poliza.id_poliza = drecibo.idrecibo AND
	                  	poliza.id_titular = titular.id_titular AND 
	                  	poliza.id_tpoliza = tipo_poliza.id_t_poliza AND
	                  	poliza.id_cod_ramo = dramo.cod_ramo AND
	                    poliza.id_cia = dcia.idcia AND
	                    poliza.codvend = enp.cod AND
	                  	poliza.id_poliza = $id_poliza
	                    ORDER BY poliza.id_poliza ASC";
				$res=mysqli_query(Conectar::con(),$sql);
				
				if (!$res) {
				    //No hay registros
				}else{
					$filas=mysqli_num_rows($res); 
					if ($filas == 0) { 
				      	//header("Location: incorrecto.php?m=2");
				      	//exit();
			      	}else
			      		{
		               		while($reg=mysqli_fetch_assoc($res)) {
		               			$this->t[]=$reg;
		              		}
	              			return $this->t;
						}
				}
			}	

		public function get_poliza_total2_by_id($id_poliza)
		    {
		      	$sql="SELECT *  FROM 
	                    poliza
	                  	INNER JOIN drecibo, titular, tipo_poliza, dramo, dcia, enr
	                  	WHERE 
	                  	poliza.id_poliza = drecibo.idrecibo AND
	                  	poliza.id_titular = titular.id_titular AND 
	                  	poliza.id_tpoliza = tipo_poliza.id_t_poliza AND
	                  	poliza.id_cod_ramo = dramo.cod_ramo AND
	                    poliza.id_cia = dcia.idcia AND
	                    poliza.codvend = enr.cod AND
	                  	poliza.id_poliza = $id_poliza
	                    ORDER BY poliza.id_poliza ASC";
				$res=mysqli_query(Conectar::con(),$sql);
				
				if (!$res) {
				    //No hay registros
				}else{
					$filas=mysqli_num_rows($res); 
					if ($filas == 0) { 
				      	//header("Location: incorrecto.php?m=2");
				      	//exit();
			      	}else
			      		{
		               		while($reg=mysqli_fetch_assoc($res)) {
		               			$this->t[]=$reg;
		              		}
	              			return $this->t;
						}
				}
			}

		public function get_poliza_total3_by_id($id_poliza)
		    {
		      	$sql="SELECT *  FROM 
	                    poliza
	                  	INNER JOIN drecibo, titular, tipo_poliza, dramo, dcia, lider_enp
	                  	WHERE 
	                  	poliza.id_poliza = drecibo.idrecibo AND
	                  	poliza.id_titular = titular.id_titular AND 
	                  	poliza.id_tpoliza = tipo_poliza.id_t_poliza AND
	                  	poliza.id_cod_ramo = dramo.cod_ramo AND
	                    poliza.id_cia = dcia.idcia AND
	                    poliza.codvend = lider_enp.cod_proyecto AND
	                  	poliza.id_poliza = $id_poliza
	                    ORDER BY poliza.id_poliza ASC";
				$res=mysqli_query(Conectar::con(),$sql);
				
				if (!$res) {
				    //No hay registros
				}else{
					$filas=mysqli_num_rows($res); 
					if ($filas == 0) { 
				      	//header("Location: incorrecto.php?m=2");
				      	//exit();
			      	}else
			      		{
		               		while($reg=mysqli_fetch_assoc($res)) {
		               			$this->t[]=$reg;
		              		}
	              			return $this->t;
						}
				}
			}



		public function get_asesor_total($id)
		    {
		      	$sql="SELECT *  FROM 
	                    poliza
	                  	INNER JOIN drecibo, titular, tipo_poliza, dramo, dcia, ena
	                  	WHERE 
	                  	poliza.id_poliza = drecibo.idrecibo AND
	                  	poliza.id_titular = titular.id_titular AND 
	                  	poliza.id_tpoliza = tipo_poliza.id_t_poliza AND
	                  	poliza.id_cod_ramo = dramo.cod_ramo AND
	                    poliza.id_cia = dcia.idcia AND
	                    poliza.codvend = ena.cod AND
	                  	ena.cod = '$id'
	                    ORDER BY poliza.id_poliza ASC";
				$res=mysqli_query(Conectar::con(),$sql);
				
				if (!$res) {
				    //No hay registros
				}else{
					$filas=mysqli_num_rows($res); 
					if ($filas == 0) { 
				      	//header("Location: incorrecto.php?m=2");
				      	//exit();
			      	}else
			      		{
		               		while($reg=mysqli_fetch_assoc($res)) {
		               			$this->t[]=$reg;
		              		}
	              			return $this->t;
						}
				}

				
			}

		public function get_asesor_proyecto_total($id)
		    {
		      	$sql="SELECT *  FROM 
	                    poliza
	                  	INNER JOIN drecibo, titular, tipo_poliza, dramo, dcia, enp
	                  	WHERE 
	                  	poliza.id_poliza = drecibo.idrecibo AND
	                  	poliza.id_titular = titular.id_titular AND 
	                  	poliza.id_tpoliza = tipo_poliza.id_t_poliza AND
	                  	poliza.id_cod_ramo = dramo.cod_ramo AND
	                    poliza.id_cia = dcia.idcia AND
	                    poliza.codvend = enp.cod AND
	                  	enp.cod = '$id'
	                    ORDER BY poliza.id_poliza ASC";
				$res=mysqli_query(Conectar::con(),$sql);
				
				if (!$res) {
				    //No hay registros
				}else{
					$filas=mysqli_num_rows($res); 
					if ($filas == 0) { 
				      	//header("Location: incorrecto.php?m=2");
				      	//exit();
			      	}else
			      		{
		               		while($reg=mysqli_fetch_assoc($res)) {
		               			$this->t[]=$reg;
		              		}
	              			return $this->t;
						}
				}
			}


		public function get_referidor_total($id)
		    {
		      	$sql="SELECT *  FROM 
	                    poliza
	                  	INNER JOIN drecibo, titular, tipo_poliza, dramo, dcia, enr
	                  	WHERE 
	                  	poliza.id_poliza = drecibo.idrecibo AND
	                  	poliza.id_titular = titular.id_titular AND 
	                  	poliza.id_tpoliza = tipo_poliza.id_t_poliza AND
	                  	poliza.id_cod_ramo = dramo.cod_ramo AND
	                    poliza.id_cia = dcia.idcia AND
	                    poliza.codvend = enr.cod AND
	                  	enr.cod = '$id'
	                    ORDER BY poliza.id_poliza ASC";
				$res=mysqli_query(Conectar::con(),$sql);
				
				if (!$res) {
				    //No hay registros
				}else{
					$filas=mysqli_num_rows($res); 
					if ($filas == 0) { 
				      	//header("Location: incorrecto.php?m=2");
				      	//exit();
			      	}else
			      		{
		               		while($reg=mysqli_fetch_assoc($res)) {
		               			$this->t[]=$reg;
		              		}
	              			return $this->t;
						}
				}

				
			}



		public function get_poliza_by_cliente($id)
		    {
		      	$sql="SELECT *  FROM 
	                    poliza, titular
	                  	INNER JOIN drecibo, tipo_poliza, dramo, dcia, ena
	                  	WHERE 
	                  	poliza.id_poliza = drecibo.idrecibo AND
	                  	poliza.id_titular = titular.id_titular AND 
	                  	poliza.id_tpoliza = tipo_poliza.id_t_poliza AND
	                  	poliza.id_cod_ramo = dramo.cod_ramo AND
	                    poliza.id_cia = dcia.idcia AND
	                    poliza.codvend = ena.cod AND
	                  	titular.ci = '$id'
	                    ORDER BY poliza.id_poliza ASC";
				$res=mysqli_query(Conectar::con(),$sql);
				
				if (!$res) {
				    //No hay registros
				}else{
					$filas=mysqli_num_rows($res); 
					if ($filas == 0) { 
				      	//header("Location: incorrecto.php?m=2");
				      	//exit();
			      	}else
			      		{
		               		while($reg=mysqli_fetch_assoc($res)) {
		               			$this->t[]=$reg;
		              		}
	              			return $this->t;
						}
				}

				
			}


		public function get_id_cliente($ci)
		    {
		      	$sql="SELECT id_titular, nombre_t, apellido_t, ci  FROM 
	                    titular
	                  	WHERE 
	                  	ci = $ci ";
				$res=mysqli_query(Conectar::con(),$sql);
				
				if (!$res) {
				    //No hay registros
				}else{
					$filas=mysqli_num_rows($res); 
					if ($filas == 0) { 
				      	//header("Location: incorrecto.php?m=2");
				      	//exit();
			      	}else
			      		{
		               		while($reg=mysqli_fetch_assoc($res)) {
		               			$this->t[]=$reg;
		              		}
	              			return $this->t;
						}
				}

				
			}


		public function get_ultimo_asesor()
		    {
		      	$sql="SELECT * FROM ena order by idena DESC";

				$res=mysqli_query(Conectar::con(),$sql);
				
				if (!$res) {
				    //No hay registros
				}else{
					$filas=mysqli_num_rows($res); 
					if ($filas == 0) { 
				      	//header("Location: incorrecto.php?m=2");
				      	//exit();
			      	}else
			      		{
		               		while($reg=mysqli_fetch_assoc($res)) {
		               			$this->t[]=$reg;
		              		}
	              			return $this->t;
						}
				}
			}

		public function get_ultimo_proyecto()
		    {
		      	$sql="SELECT * FROM lider_enp order by id_proyecto DESC";

				$res=mysqli_query(Conectar::con(),$sql);
				
				if (!$res) {
				    //No hay registros
				}else{
					$filas=mysqli_num_rows($res); 
					if ($filas == 0) { 
				      	//header("Location: incorrecto.php?m=2");
				      	//exit();
			      	}else
			      		{
		               		while($reg=mysqli_fetch_assoc($res)) {
		               			$this->t[]=$reg;
		              		}
	              			return $this->t;
						}
				}
			}

		public function get_ultimo_a_proyecto($id)
		    {
		      	$sql="SELECT * FROM enp WHERE id_proyecto = $id order by cod DESC";

				$res=mysqli_query(Conectar::con(),$sql);
				
				if (!$res) {
				    //No hay registros
				}else{
					$filas=mysqli_num_rows($res); 
					if ($filas == 0) { 
				      	//header("Location: incorrecto.php?m=2");
				      	//exit();
			      	}else
			      		{
		               		while($reg=mysqli_fetch_assoc($res)) {
		               			$this->t[]=$reg;
		              		}
	              			return $this->t;
						}
				}
			}

		public function get_ultimo_referidor()
		    {
		      	$sql="SELECT * FROM enr order by cod DESC";

				$res=mysqli_query(Conectar::con(),$sql);
				
				if (!$res) {
				    //No hay registros
				}else{
					$filas=mysqli_num_rows($res); 
					if ($filas == 0) { 
				      	//header("Location: incorrecto.php?m=2");
				      	//exit();
			      	}else
			      		{
		               		while($reg=mysqli_fetch_assoc($res)) {
		               			$this->t[]=$reg;
		              		}
	              			return $this->t;
						}
				}
			}



		public function get_cliente_total($id)
		    {
		      	$sql="SELECT * FROM poliza 
		      					INNER JOIN titular WHERE 
		      					poliza.id_titular = titular.id_titular AND 
		      					titular.id_titular = '$id' 
		      					ORDER BY poliza.id_poliza ASC";
				$res=mysqli_query(Conectar::con(),$sql);
				
				if (!$res) {
				    //No hay registros
				}else{
					$filas=mysqli_num_rows($res); 
					if ($filas == 0) { 
				      	//header("Location: incorrecto.php?m=2");
				      	//exit();
			      	}else
			      		{
		               		while($reg=mysqli_fetch_assoc($res)) {
		               			$this->t[]=$reg;
		              		}
	              			return $this->t;
						}
				}
			}





	public function get_poliza_total_by_filtro($f_desde,$f_hasta)
			{
					$sql="SELECT *  FROM 
									poliza
									INNER JOIN drecibo, titular, tipo_poliza
									WHERE 
									poliza.id_poliza = drecibo.idrecibo AND
									poliza.id_tpoliza = tipo_poliza.id_t_poliza AND
									drecibo.idtitu = titular.id_titular AND
									poliza.f_hastapoliza >= '$f_desde' AND
									poliza.f_hastapoliza <= '$f_hasta'
									ORDER BY poliza.id_poliza ASC";
			$res=mysqli_query(Conectar::con(),$sql);
			
			$filas=mysqli_num_rows($res); 
			if (!$res) {
				    //No hay registros
				}else{
					$filas=mysqli_num_rows($res); 
					if ($filas == 0) { 
						echo "No hay registros";
				      	header("Location: b_poliza.php?m=2");
				      	exit();
			      	}else
		            	{
		               		while($reg=mysqli_fetch_assoc($res)) {
		               			$this->t[]=$reg;
		              		}
	              			return $this->t;
						}
				}
		}	




	public function get_poliza_total_by_filtro_renov_distinct_a($f_desde,$f_hasta,$cia)
			{
				if ($cia=='Seleccione Cía') {
					$cia='';
				}
				$sql="SELECT DISTINCT codvend FROM 
					poliza
					INNER JOIN drecibo, titular, tipo_poliza, dcia, dramo
					WHERE 
					poliza.id_poliza = drecibo.idrecibo AND
					poliza.id_tpoliza = tipo_poliza.id_t_poliza AND
					drecibo.idtitu = titular.id_titular AND
					poliza.id_cia = dcia.idcia AND
					poliza.id_cod_ramo = dramo.cod_ramo AND
					poliza.f_hastapoliza >= '$f_desde' AND
					poliza.f_hastapoliza <= '$f_hasta' AND
					nomcia LIKE '%$cia%'
					ORDER BY poliza.codvend ASC";
			$res=mysqli_query(Conectar::con(),$sql);
			
			$filas=mysqli_num_rows($res); 
			if (!$res) {
				    //No hay registros
				}else{
					$filas=mysqli_num_rows($res); 
					if ($filas == 0) { 
						echo "No hay registros";
				      	header("Location: b_poliza.php?m=2");
				      	exit();
			      	}else
		            	{
		               		while($reg=mysqli_fetch_assoc($res)) {
		               			$this->t[]=$reg;
		              		}
	              			return $this->t;
						}
				}
		}

	public function get_poliza_total_by_filtro_renov_distinct_c($f_desde,$f_hasta)
			{
				$sql="SELECT DISTINCT nomcia FROM 
					poliza
					INNER JOIN drecibo, titular, tipo_poliza, dcia, dramo
					WHERE 
					poliza.id_poliza = drecibo.idrecibo AND
					poliza.id_tpoliza = tipo_poliza.id_t_poliza AND
					drecibo.idtitu = titular.id_titular AND
					poliza.id_cia = dcia.idcia AND
					poliza.id_cod_ramo = dramo.cod_ramo AND
					poliza.f_hastapoliza >= '$f_desde' AND
					poliza.f_hastapoliza <= '$f_hasta'
					ORDER BY nomcia ASC";
			$res=mysqli_query(Conectar::con(),$sql);
			
			$filas=mysqli_num_rows($res); 
			if (!$res) {
				    //No hay registros
				}else{
					$filas=mysqli_num_rows($res); 
					if ($filas == 0) { 
						echo "No hay registros";
				      	header("Location: b_poliza.php?m=2");
				      	exit();
			      	}else
		            	{
		               		while($reg=mysqli_fetch_assoc($res)) {
		               			$this->t[]=$reg;
		              		}
	              			return $this->t;
						}
				}
		}

	public function get_poliza_total_by_filtro_renov_distinct_ac($f_desde,$f_hasta,$cia,$asesor)
		{
			if ($cia=='Seleccione Cía') {
				$cia='';
			}
			if ($asesor=='Seleccione el Asesor') {
				$asesor='';
			}
			$sql="SELECT DISTINCT nomcia FROM 
				poliza
				INNER JOIN drecibo, titular, tipo_poliza, dcia, dramo
				WHERE 
				poliza.id_poliza = drecibo.idrecibo AND
				poliza.id_tpoliza = tipo_poliza.id_t_poliza AND
				drecibo.idtitu = titular.id_titular AND
				poliza.id_cia = dcia.idcia AND
				poliza.id_cod_ramo = dramo.cod_ramo AND
				poliza.f_hastapoliza >= '$f_desde' AND
				poliza.f_hastapoliza <= '$f_hasta' AND
				nomcia LIKE '%$cia%' AND
                codvend LIKE '%$asesor%'
				ORDER BY nomcia ASC";
		$res=mysqli_query(Conectar::con(),$sql);
		
		$filas=mysqli_num_rows($res); 
		if (!$res) {
				//No hay registros
			}else{
				$filas=mysqli_num_rows($res); 
				if ($filas == 0) { 
					echo "No hay registros";
					  header("Location: b_renov_g.php?m=2");
					  exit();
				  }else
					{
						   while($reg=mysqli_fetch_assoc($res)) {
							   $this->t[]=$reg;
						  }
						  return $this->t;
					}
			}
	}

	public function get_poliza_total_by_filtro_renov_a($f_desde,$f_hasta,$cia,$asesor)
			{
				if ($cia=='Seleccione Cía') {
					$cia='';
				}
				$sql="SELECT *  FROM 
					poliza
					INNER JOIN drecibo, titular, tipo_poliza, dcia, dramo
					WHERE 
					poliza.id_poliza = drecibo.idrecibo AND
					poliza.id_tpoliza = tipo_poliza.id_t_poliza AND
					drecibo.idtitu = titular.id_titular AND
					poliza.id_cia = dcia.idcia AND
					poliza.id_cod_ramo = dramo.cod_ramo AND
					poliza.f_hastapoliza >= '$f_desde' AND
					poliza.f_hastapoliza <= '$f_hasta' AND
					poliza.codvend = '$asesor' AND
					nomcia LIKE '%$cia%'
					ORDER BY poliza.f_hastapoliza ASC";
			$res=mysqli_query(Conectar::con(),$sql);
			
			$filas=mysqli_num_rows($res); 
			if (!$res) {
				    //No hay registros
				}else{
					$filas=mysqli_num_rows($res); 
					if ($filas == 0) { 
				      	//exit();
			      	}else
		            	{
		               		while($reg=mysqli_fetch_assoc($res)) {
		               			$this->t[]=$reg;
		              		}
	              			return $this->t;
						}
				}
		}	

		public function get_poliza_total_by_filtro_renov_c($f_desde,$f_hasta,$cia)
			{
				
				$sql="SELECT *  FROM 
					poliza
					INNER JOIN drecibo, titular, tipo_poliza, dcia, dramo
					WHERE 
					poliza.id_poliza = drecibo.idrecibo AND
					poliza.id_tpoliza = tipo_poliza.id_t_poliza AND
					drecibo.idtitu = titular.id_titular AND
					poliza.id_cia = dcia.idcia AND
					poliza.id_cod_ramo = dramo.cod_ramo AND
					poliza.f_hastapoliza >= '$f_desde' AND
					poliza.f_hastapoliza <= '$f_hasta' AND
					nomcia = '$cia'
					ORDER BY poliza.f_hastapoliza ASC";
			$res=mysqli_query(Conectar::con(),$sql);
			
			$filas=mysqli_num_rows($res); 
			if (!$res) {
				    //No hay registros
				}else{
					$filas=mysqli_num_rows($res); 
					if ($filas == 0) { 
						echo "No hay registros";
				      	header("Location: b_poliza.php?m=2");
				      	exit();
			      	}else
		            	{
		               		while($reg=mysqli_fetch_assoc($res)) {
		               			$this->t[]=$reg;
		              		}
	              			return $this->t;
						}
				}
		}	


	public function get_poliza_total_by_filtro_renov_ac($f_desde,$f_hasta,$cia,$asesor)
		{
			if ($asesor=='Seleccione el Asesor') {
				$asesor='';
			}
			$sql="SELECT *  FROM 
				poliza
				INNER JOIN drecibo, titular, tipo_poliza, dcia, dramo
				WHERE 
				poliza.id_poliza = drecibo.idrecibo AND
				poliza.id_tpoliza = tipo_poliza.id_t_poliza AND
				drecibo.idtitu = titular.id_titular AND
				poliza.id_cia = dcia.idcia AND
				poliza.id_cod_ramo = dramo.cod_ramo AND
				poliza.f_hastapoliza >= '$f_desde' AND
				poliza.f_hastapoliza <= '$f_hasta' AND
				nomcia = '$cia' AND
				codvend LIKE '%$asesor%'
				ORDER BY poliza.f_hastapoliza ASC";
		$res=mysqli_query(Conectar::con(),$sql);
		
		$filas=mysqli_num_rows($res); 
		if (!$res) {
				//No hay registros
			}else{
				$filas=mysqli_num_rows($res); 
				if ($filas == 0) { 
					echo "No hay registros";
					  header("Location: renov_g.php?m=2");
					  exit();
				  }else
					{
						   while($reg=mysqli_fetch_assoc($res)) {
							   $this->t[]=$reg;
						  }
						  return $this->t;
					}
			}
	}	





	public function get__last_poliza_by_id($cod_poliza,$cond,$campo)
		  {
		      	$sql="SELECT id_poliza FROM poliza WHERE cod_poliza = '$cod_poliza'
		      							ORDER BY f_poliza DESC";
				$res=mysqli_query(Conectar::con(),$sql);
				
				if (!$res) {
				    //No hay registros
				}else{
					$filas=mysqli_num_rows($res); 
					if ($filas == 0) { 
				      	//header("Location: incorrecto.php?m=2");
				      	//exit();
			      	}else
		            	{
		               		while($reg=mysqli_fetch_assoc($res)) {
		               			$this->t[]=$reg;
		              		}
	              			return $this->t;
						}
				}
		  }




	public function get_poliza_pendiente()
		  {
				$sql="SELECT *  FROM 
				  poliza
					INNER JOIN drecibo, titular, tipo_poliza
					WHERE 
					poliza.id_poliza = drecibo.idrecibo AND
					poliza.id_tpoliza = tipo_poliza.id_t_poliza AND
					drecibo.idtitu = titular.id_titular
				  ORDER BY poliza.id_poliza ASC";
			  $res=mysqli_query(Conectar::con(),$sql);
			  
			  if (!$res) {
				  //No hay registros
			  }else{
				  $filas=mysqli_num_rows($res); 
				  if ($filas == 0) { 
						//header("Location: incorrecto.php?m=2");
						exit();
					}else
						{
							 while($reg=mysqli_fetch_assoc($res)) {
								 $this->t[]=$reg;
							}
							return $this->t;
					  }
			  }

			  
		  }



















//-------------------------------------------------------------       
//-------------------------------------------------------------
//-------------------------------------------------------------
//---------------------------FIN PRODUCCION--------------------

//-------------------------------------------------------------       
//-------------------------------------------------------------
//-------------------------------------------------------------
//---------------------------ADMINISTRACIÓN--------------------





		public function get_poliza_total_by_num($id_cia)
		    {
		      	$sql="SELECT prima  FROM 
                    poliza
                  	INNER JOIN drecibo, dcia
                  	WHERE 
                  	poliza.id_poliza = drecibo.idrecibo AND
                    poliza.id_cia = dcia.idcia AND
                  	poliza.id_cia = $id_cia
                    ORDER BY poliza.id_poliza ASC";
				$res=mysqli_query(Conectar::con(),$sql);
				
				if (!$res) {
				    //No hay registros
				}else{
					$filas=mysqli_num_rows($res); 
					if ($filas == 0) { 
				      	//header("Location: incorrecto.php?m=2");
				      	//exit();
			      	}else
			      		{
		               		while($reg=mysqli_fetch_assoc($res)) {
		               			$this->t[]=$reg;
		              		}
	              			return $this->t;
						}
				}
			}	


		
		public function get_comision($id_rep_com)
		    {
		      	$sql="SELECT *  FROM 
                    comision
                  	WHERE 
						id_rep_com = $id_rep_com
                    ORDER BY id_comision ASC";
				$res=mysqli_query(Conectar::con(),$sql);
				
				if (!$res) {
				    //No hay registros
				}else{
					$filas=mysqli_num_rows($res); 
					if ($filas == 0) { 
				      	//header("Location: incorrecto.php?m=2");
				      	//exit();
			      	}else
			      		{
		               		while($reg=mysqli_fetch_assoc($res)) {
		               			$this->t[]=$reg;
		              		}
	              			return $this->t;
						}
				}
			}	



		public function get_comision_by_id($id_comision)
			{
					$sql="SELECT *  FROM 
									comision
									WHERE 
					id_comision = $id_comision ";
			$res=mysqli_query(Conectar::con(),$sql);
			
			if (!$res) {
					//No hay registros
			}else{
				$filas=mysqli_num_rows($res); 
				if ($filas == 0) { 
							//header("Location: incorrecto.php?m=2");
							//exit();
						}else
							{
										 while($reg=mysqli_fetch_assoc($res)) {
											 $this->t[]=$reg;
										}
										return $this->t;
					}
			}
		}	



		public function get_poliza_by_id($id_poliza)
			{
				$sql="SELECT poliza.id_titular, nombre_t, apellido_t  FROM 
						poliza
						INNER JOIN titular, drecibo
						WHERE 
						poliza.id_poliza= drecibo.idrecibo AND
						poliza.id_titular = titular.id_titular AND
						poliza.id_poliza = $id_poliza";
			$res=mysqli_query(Conectar::con(),$sql);
			
			if (!$res) {
					//No hay registros
			}else{
				$filas=mysqli_num_rows($res); 
				if ($filas == 0) { 
							//header("Location: incorrecto.php?m=2");
							//exit();
						}else
							{
										 while($reg=mysqli_fetch_assoc($res)) {
											 $this->t[]=$reg;
										}
										return $this->t;
					}
				}
			}	



		public function get_rep_comision_por_busqueda($f_desde_rep,$f_hasta_rep,$id_cia)
		    {
					if ($id_cia==0) {
						$sql="SELECT * FROM rep_com WHERE 
							f_pago_gc >= '$f_desde_rep' AND
					        f_pago_gc <= '$f_hasta_rep'";
					} else {
						$sql="SELECT * FROM rep_com WHERE 
							f_pago_gc >= '$f_desde_rep' AND
					        f_pago_gc <= '$f_hasta_rep' AND
					        id_cia = $id_cia";
					}
					
				$res=mysqli_query(Conectar::con(),$sql);
				
				if (!$res) {
				    //No hay registros
				}else{
					$filas=mysqli_num_rows($res); 
					if ($filas == 0) { 
				      	//header("Location: incorrecto.php?m=2");
				      	//exit();
			      	}else
			      		{
		               		while($reg=mysqli_fetch_assoc($res)) {
		               			$this->t[]=$reg;
		              		}
	              			return $this->t;
						}
				}
			}


	public function get_comision_por_poliza($num_poliza)
		    {
		      	$sql="SELECT *  FROM 
                    comision
                  	WHERE 
						num_poliza = $num_poliza
                    ORDER BY id_comision ASC";
				$res=mysqli_query(Conectar::con(),$sql);
				
				if (!$res) {
				    //No hay registros
				}else{
					$filas=mysqli_num_rows($res); 
					if ($filas == 0) { 
				      	//header("Location: incorrecto.php?m=2");
				      	//exit();
			      	}else
			      		{
		               		while($reg=mysqli_fetch_assoc($res)) {
		               			$this->t[]=$reg;
		              		}
	              			return $this->t;
						}
				}
			}




	public function get_gc_by_filtro_distinct_a($f_desde,$f_hasta,$cia)
			{
				if ($cia=='Seleccione Cía') {
					$cia='';
				}
				$sql="SELECT DISTINCT codvend FROM 
							comision
							INNER JOIN poliza, rep_com, dcia
							WHERE 
							poliza.id_poliza = comision.id_poliza AND
							comision.id_rep_com = rep_com.id_rep_com AND
												poliza.id_cia=dcia.idcia AND
							rep_com.f_pago_gc >= '$f_desde' AND
							rep_com.f_pago_gc <= '$f_hasta' AND
							nomcia LIKE '%$cia%'
							ORDER BY comision.cod_vend ASC";
			$res=mysqli_query(Conectar::con(),$sql);
			
			$filas=mysqli_num_rows($res); 
			if (!$res) {
				    //No hay registros
				}else{
					$filas=mysqli_num_rows($res); 
					if ($filas == 0) { 
						echo "No hay registros";
				      	header("Location: b_gc.php?m=2");
				      	exit();
			      	}else
		            	{
		               		while($reg=mysqli_fetch_assoc($res)) {
		               			$this->t[]=$reg;
		              		}
	              			return $this->t;
						}
				}
		}


		public function get_gc_by_filtro_by_a($f_desde,$f_hasta,$cia,$asesor)
			{
				if ($cia=='Seleccione Cía') {
					$cia='';
				}
				$sql="SELECT * FROM comision 
							INNER JOIN drecibo, titular, tipo_poliza, dcia, dramo, poliza, rep_com 
							WHERE poliza.id_poliza = drecibo.idrecibo AND 
							poliza.id_tpoliza = tipo_poliza.id_t_poliza AND 
							drecibo.idtitu = titular.id_titular AND
							poliza.id_cia = dcia.idcia AND
							poliza.id_cod_ramo = dramo.cod_ramo AND
							poliza.id_poliza = comision.id_poliza AND
							comision.id_rep_com = rep_com.id_rep_com AND 
							rep_com.f_pago_gc >= '$f_desde' AND
							rep_com.f_pago_gc <= '$f_hasta' AND
							poliza.codvend = '$asesor' AND 
							nomcia LIKE '%$cia%' 
							ORDER BY rep_com.f_pago_gc ASC";
			$res=mysqli_query(Conectar::con(),$sql);
			
			$filas=mysqli_num_rows($res); 
			if (!$res) {
				    //No hay registros
				}else{
					$filas=mysqli_num_rows($res); 
					if ($filas == 0) { 
						echo "No hay registros";
				      	header("Location: b_gc.php?m=2");
				      	exit();
			      	}else
		            	{
		               		while($reg=mysqli_fetch_assoc($res)) {
		               			$this->t[]=$reg;
		              		}
	              			return $this->t;
						}
				}
		}




	public function get_comision_rep_com_by_id($id_poliza)
		{
				$sql="SELECT * FROM comision 
					INNER JOIN rep_com, poliza
					WHERE 
					comision.id_rep_com = rep_com.id_rep_com AND
					poliza.id_poliza = comision.id_poliza AND
					comision.id_poliza = '$id_poliza'";
			  $res=mysqli_query(Conectar::con(),$sql);
			  
			  if (!$res) {
				  //No hay registros
			  }else{
				  $filas=mysqli_num_rows($res); 
				  if ($filas == 0) { 
						//header("Location: incorrecto.php?m=2");
						//exit();
					}else
					  {
							 while($reg=mysqli_fetch_assoc($res)) {
								 $this->t[]=$reg;
							}
							return $this->t;
					  }
			  }
		}

































//-------------------------------------------------------------       
//-------------------------------------------------------------
//-------------------------------------------------------------
//---------------------------FIN ADMINISTRACIÓN--------------------



//--------------------GRÁFICO 1 RAMO-------------------
	public function get_distinct_element_ramo($desde,$hasta,$cia)
		  {
		    	if ($cia=='Seleccione Cía') {
		    		$cia='';
		    	}
		      	$sql="SELECT DISTINCT dramo.nramo FROM comision 
		      			INNER JOIN dramo, dcia, poliza WHERE 
		      			poliza.id_cod_ramo=dramo.cod_ramo AND
		      			poliza.id_cia=dcia.idcia AND
								poliza.id_poliza=comision.id_poliza AND
		      			f_hastapoliza >= '$desde' AND
		      			f_hastapoliza <= '$hasta' AND
		      			nomcia LIKE '%$cia%'
								ORDER BY dramo.nramo ASC ";
				$res=mysqli_query(Conectar::con(),$sql);
				if (!$res) {
				    //No hay registros
				}else{
					$filas=mysqli_num_rows($res); 
					if ($filas == 0) { 
								header("Location: busqueda_ramo.php?m=2#nombre");
				      	//exit();
			      	}else
		            	{
		               		while($reg=mysqli_fetch_assoc($res)) {
		               			$this->t[]=$reg;
		              		}
	              			return $this->t;
						}
				}
			}
					 
		public function get_distinct_element_ramo3($desde,$hasta,$cia)
			{
					if ($cia=='Seleccione Cía') {
						$cia='';
					}
						$sql="SELECT DISTINCT dramo.nramo FROM poliza 
								INNER JOIN dramo, dcia WHERE 
								poliza.id_cod_ramo=dramo.cod_ramo AND
								poliza.id_cia=dcia.idcia AND
								f_hastapoliza >= '$desde' AND
								f_hastapoliza <= '$hasta' AND
								nomcia LIKE '%$cia%' ";
				$res=mysqli_query(Conectar::con(),$sql);
				if (!$res) {
						//No hay registros
				}else{
					$filas=mysqli_num_rows($res); 
					if ($filas == 0) { 
								header("Location: busqueda_resumen_ramo.php?m=2#nombre");
								//exit();
							}else
									{
											while($reg=mysqli_fetch_assoc($res)) {
												$this->t[]=$reg;
											}
											return $this->t;
						}
				}
			}

		public function get_distinct_element_ramo2($desde,$hasta,$cia)
			{
			
					if ($cia=='Seleccione Cía') {
						$cia='';
					}
						$sql="SELECT DISTINCT dramo.nramo FROM poliza 
								INNER JOIN dramo, dcia WHERE 
								poliza.id_cod_ramo=dramo.cod_ramo AND
								poliza.id_cia=dcia.idcia AND
								f_hastapoliza >= '$desde' AND
								f_hastapoliza <= '$hasta' AND
								nomcia LIKE '%$cia%' ";
				$res=mysqli_query(Conectar::con(),$sql);
				if (!$res) {
						//No hay registros
				}else{
					$filas=mysqli_num_rows($res); 
					if ($filas == 0) { 
								header("Location: busqueda_ramo_promedio.php?m=2#nombre");
								//exit();
							}else
									{
												while($reg=mysqli_fetch_assoc($res)) {
													$this->t[]=$reg;
											}
											return $this->t;
						}
				}
			}

		public function get_distinct_element_ramo4($desde,$hasta,$cia)
			{
			
					if ($cia=='Seleccione Cía') {
						$cia='';
					}
						$sql="SELECT DISTINCT dramo.nramo FROM poliza 
								INNER JOIN dramo, dcia WHERE 
								poliza.id_cod_ramo=dramo.cod_ramo AND
								poliza.id_cia=dcia.idcia AND
								f_hastapoliza >= '$desde' AND
								f_hastapoliza <= '$hasta' AND
								nomcia LIKE '%$cia%' ";
				$res=mysqli_query(Conectar::con(),$sql);
				if (!$res) {
						//No hay registros
				}else{
					$filas=mysqli_num_rows($res); 
					if ($filas == 0) { 
								header("Location: busqueda_resumen.php?m=2#nombre");
								//exit();
							}else
									{
												while($reg=mysqli_fetch_assoc($res)) {
													$this->t[]=$reg;
											}
											return $this->t;
						}
				}
			}

		



	public function get_poliza_graf_1($ramo,$desde,$hasta,$cia)
		    {
		
		    	if ($cia=='Seleccione Cía') {
		    		$cia='';
		    	}

		    	

		      	$sql="SELECT * FROM poliza, drecibo, dramo, dcia WHERE 
		      			poliza.id_poliza = drecibo.idrecibo AND
								poliza.id_cod_ramo=dramo.cod_ramo AND
								poliza.id_cia=dcia.idcia AND
								f_hastapoliza >= '$desde' AND
		      			f_hastapoliza <= '$hasta' AND
		      			dcia.nomcia LIKE '%$cia%' AND
		      			dramo.nramo = '$ramo' ";
				$res=mysqli_query(Conectar::con(),$sql);
				
				if (!$res) {
				    //No hay registros
				}else{
					$filas=mysqli_num_rows($res); 
					if ($filas == 0) { 
				      	//header("Location: incorrecto.php?m=2");
				      	exit();
			      	}else
		            	{
		               		while($reg=mysqli_fetch_assoc($res)) {
		               			$this->t[]=$reg;
		              		}
	              			return $this->t;
						}
				}

		       }
//--------------------FIN GRÁFICO 1 RAMO-------------------

//--------------------GRÁFICO 2 TPOLIZA-------------------


	public function get_distinct_element_tpoliza($desde,$hasta,$cia,$ramo)
		    {

		  
		    	if ($cia=='Seleccione Cía') {
		    		$cia='';
		    	}
		    	if ($ramo=='Seleccione Ramo') {
		    		$ramo='';
		    	}

		      	$sql="SELECT DISTINCT tipo_poliza FROM poliza, tipo_poliza, dcia, dramo WHERE 
		      			poliza.id_tpoliza=tipo_poliza.id_t_poliza AND
								poliza.id_cia=dcia.idcia AND
								poliza.id_cod_ramo=dramo.cod_ramo AND
								f_hastapoliza >= '$desde' AND
		      			f_hastapoliza <= '$hasta' AND
		      			nomcia LIKE '%$cia%' AND
		      			nramo LIKE '%$ramo%' ";
				$res=mysqli_query(Conectar::con(),$sql);
				
				if (!$res) {
				    //No hay registros
				}else{
					$filas=mysqli_num_rows($res); 
					if ($filas == 0) { 
				      	header("Location: busqueda_tipo_poliza.php?m=2#nombre");
				      	//exit();
			      	}else
		            	{
		               		while($reg=mysqli_fetch_assoc($res)) {
		               			$this->t[]=$reg;
		              		}
	              			return $this->t;
						}
				}

				
		       }




	public function get_poliza_graf_2($tpoliza,$ramo,$desde,$hasta,$cia)
		    {
		    	
		    	if ($cia=='Seleccione Cía') {
		    		$cia='';
		    	}
		    	if ($ramo=='Seleccione Ramo') {
		    		$ramo='';
		    	}

		      	$sql="SELECT * FROM poliza, drecibo, dramo, dcia, tipo_poliza WHERE 
		      			poliza.id_poliza = drecibo.idrecibo AND
								poliza.id_cod_ramo=dramo.cod_ramo AND
								poliza.id_cia=dcia.idcia AND
								poliza.id_tpoliza=tipo_poliza.id_t_poliza AND
								f_hastapoliza >= '$desde' AND
		      			f_hastapoliza <= '$hasta' AND
		      			nomcia LIKE '%$cia%' AND
		      			nramo LIKE '%$ramo%' AND
		      			tipo_poliza = '$tpoliza' ";
				$res=mysqli_query(Conectar::con(),$sql);
				
				if (!$res) {
				    //No hay registros
				}else{
					$filas=mysqli_num_rows($res); 
					if ($filas == 0) { 
				      	//header("Location: incorrecto.php?m=2");
				      	exit();
			      	}else
		            	{
		               		while($reg=mysqli_fetch_assoc($res)) {
		               			$this->t[]=$reg;
		              		}
	              			return $this->t;
						}
				}

		       }
//--------------------FIN GRÁFICO 2 TPOLIZA-------------------

//--------------------GRÁFICO 3 CIA-------------------


	public function get_distinct_element_cia($desde,$hasta,$ramo)
		    {

		    	if ($ramo=='Seleccione Ramo') {
		    		$ramo='';
		    	}

		      	$sql="SELECT DISTINCT nomcia FROM poliza, dcia, dramo WHERE 
		      			poliza.id_cia=dcia.idcia AND
								poliza.id_cod_ramo=dramo.cod_ramo AND
								f_hastapoliza >= '$desde' AND
		      			f_hastapoliza <= '$hasta' AND
		      			nramo LIKE '%$ramo%' ";
				$res=mysqli_query(Conectar::con(),$sql);
				
				if (!$res) {
				    //No hay registros
				}else{
					$filas=mysqli_num_rows($res); 
					if ($filas == 0) { 
								header("Location: busqueda_cia.php?m=2#nombre");
				      	exit();
			      	}else
		            	{
		               		while($reg=mysqli_fetch_assoc($res)) {
		               			$this->t[]=$reg;
		              		}
	              			return $this->t;
						}
				}

				
		       }




	public function get_poliza_graf_3($cia,$ramo,$desde,$hasta)
		    {
		    	
		    	if ($ramo=='Seleccione Ramo') {
		    		$ramo='';
		    	}

		      	$sql="SELECT * FROM poliza, drecibo, dramo, dcia WHERE 
		      			poliza.id_poliza = drecibo.idrecibo AND
								poliza.id_cod_ramo=dramo.cod_ramo AND
								poliza.id_cia=dcia.idcia AND
								f_hastapoliza >= '$desde' AND
		      			f_hastapoliza <= '$hasta' AND
		      			nramo LIKE '%$ramo%' AND
		      			nomcia = '$cia' ";
				$res=mysqli_query(Conectar::con(),$sql);
				
				if (!$res) {
				    //No hay registros
				}else{
					$filas=mysqli_num_rows($res); 
					if ($filas == 0) { 
				      	//header("Location: incorrecto.php?m=2");
				      	exit();
			      	}else
		            	{
		               		while($reg=mysqli_fetch_assoc($res)) {
		               			$this->t[]=$reg;
		              		}
	              			return $this->t;
						}
				}

		       }
//--------------------FIN GRÁFICO 3 CIA-------------------		   

//--------------------GRÁFICO 4 FPAGO-------------------


	public function get_distinct_element_fpago($desde,$hasta,$cia,$ramo)
		    {

		    
		    	if ($ramo=='Seleccione Ramo') {
		    		$ramo='';
		    	}
		    	if ($cia=='Seleccione Cía') {
		    		$cia='';
		    	}

		      	$sql="SELECT DISTINCT fpago FROM poliza, drecibo, dcia, dramo WHERE 
		      			poliza.id_poliza = drecibo.idrecibo AND
		      			poliza.id_cia=dcia.idcia AND
								poliza.id_cod_ramo=dramo.cod_ramo AND
								f_hastapoliza >= '$desde' AND
		      			f_hastapoliza <= '$hasta' AND
		      			nramo LIKE '%$ramo%' AND
		      			nomcia LIKE '%$cia%' ORDER BY fpago ASC";
				$res=mysqli_query(Conectar::con(),$sql);
				
				if (!$res) {
				    //No hay registros
				}else{
					$filas=mysqli_num_rows($res); 
					if ($filas == 0) { 
								header("Location: busqueda_fpago.php?m=2#nombre");
				      	exit();
			      	}else
		            	{
		               		while($reg=mysqli_fetch_assoc($res)) {
		               			$this->t[]=$reg;
		              		}
	              			return $this->t;
						}
				}

				
		       }




	public function get_poliza_graf_4($fpago,$ramo,$desde,$hasta,$cia)
		    {
		    
		    	if ($ramo=='Seleccione Ramo') {
		    		$ramo='';
		    	}
		    	if ($cia=='Seleccione Cía') {
		    		$cia='';
		    	}

		      	$sql="SELECT * FROM poliza, drecibo, dramo, dcia WHERE 
		      			poliza.id_poliza = drecibo.idrecibo AND
								poliza.id_cod_ramo=dramo.cod_ramo AND
								poliza.id_cia=dcia.idcia AND
								f_hastapoliza >= '$desde' AND
		      			f_hastapoliza <= '$hasta' AND
		      			nramo LIKE '%$ramo%' AND
		      			nomcia LIKE '%$cia%' AND
		      			fpago = '$fpago' ";
				$res=mysqli_query(Conectar::con(),$sql);
				
				if (!$res) {
				    //No hay registros
				}else{
					$filas=mysqli_num_rows($res); 
					if ($filas == 0) { 
				      	//header("Location: incorrecto.php?m=2");
				      	exit();
			      	}else
		            	{
		               		while($reg=mysqli_fetch_assoc($res)) {
		               			$this->t[]=$reg;
		              		}
	              			return $this->t;
						}
				}

		       }
//--------------------FIN GRÁFICO 4 FPAGO-------------------	


//--------------------GRÁFICO 1 Resumen RAMO-------------------

	public function get_distinct_cia_comision($desde,$hasta)
		    {
		      	$sql="SELECT DISTINCT rep_com.id_cia, nomcia FROM comision 
		      			INNER JOIN dcia, poliza, rep_com WHERE 
		      			rep_com.id_cia=dcia.idcia AND
		      			poliza.id_poliza = comision.id_poliza AND
								comision.id_rep_com = rep_com.id_rep_com AND
		      			f_hastapoliza >= '$desde' AND
		      			f_hastapoliza <= '$hasta'
								ORDER BY nomcia ASC ";
				$res=mysqli_query(Conectar::con(),$sql);
				
				if (!$res) {
				    //No hay registros
				}else{
					$filas=mysqli_num_rows($res); 
					if ($filas == 0) { 
				      	//header("Location: incorrecto.php?m=2");
				      	//exit();
			      	}else
		            	{
		               		while($reg=mysqli_fetch_assoc($res)) {
		               			$this->t[]=$reg;
		              		}
	              			return $this->t;
						}
				}
			}


	public function get_resumen_por_ramo($desde,$hasta,$cia,$ramo)
		    {

		    	if ($cia=='Seleccione Cía') {
		    		$cia='';
		    	}

		      	$sql="SELECT * FROM poliza 
		      			INNER JOIN dramo, dcia, drecibo, comision, rep_com WHERE 
		      			poliza.id_cod_ramo=dramo.cod_ramo AND
		      			rep_com.id_cia=dcia.idcia AND
		      			poliza.id_poliza=drecibo.idrecibo AND 
		      			poliza.id_poliza = comision.id_poliza AND
								rep_com.id_rep_com=comision.id_rep_com AND
		      			f_hastapoliza >= '$desde' AND
		      			f_hastapoliza <= '$hasta' AND
		      			nomcia = '$cia' AND
		      			nramo = '$ramo' ";
				$res=mysqli_query(Conectar::con(),$sql);
				
				if (!$res) {
				    //No hay registros
				}else{
					$filas=mysqli_num_rows($res); 
					if ($filas == 0) { 
				      	//header("Location: incorrecto.php?m=2");
				      	//exit();
			      	}else
		            	{
		               		while($reg=mysqli_fetch_assoc($res)) {
		               			$this->t[]=$reg;
		              		}
	              			return $this->t;
						}
				}
			}
				
			

		public function get_resumen_comision($desde,$hasta,$cia)
			{
					$sql="SELECT * FROM comision 
							INNER JOIN dcia, drecibo, poliza, rep_com WHERE 
							rep_com.id_cia=dcia.idcia AND
							poliza.id_poliza=drecibo.idrecibo AND 
							poliza.id_poliza = comision.id_poliza AND
							comision.id_rep_com=rep_com.id_rep_com AND
							f_hastapoliza >= '$desde' AND
							f_hastapoliza <= '$hasta' AND
							rep_com.id_cia = '$cia' ";
			$res=mysqli_query(Conectar::con(),$sql);
			
			if (!$res) {
					//No hay registros
			}else{
				$filas=mysqli_num_rows($res); 
				if ($filas == 0) { 
							//header("Location: incorrecto.php?m=2");
							//exit();
						}else
								{
										 while($reg=mysqli_fetch_assoc($res)) {
											 $this->t[]=$reg;
										}
										return $this->t;
					}
			}
		}



		public function get_resumen_por_cia($desde,$hasta,$cia)
		    {

		    	if ($cia=='Seleccione Cía') {
		    		$cia='';
		    	}

		      	$sql="SELECT * FROM poliza 
		      			INNER JOIN dcia, drecibo, comision WHERE 
		      			poliza.id_cia=dcia.idcia AND
		      			poliza.id_poliza=drecibo.idrecibo AND 
		      			poliza.cod_poliza = comision.num_poliza AND
		      			f_hastapoliza >= '$desde' AND
		      			f_hastapoliza <= '$hasta' AND
		      			nomcia LIKE '%$cia%' ";
				$res=mysqli_query(Conectar::con(),$sql);
				
				if (!$res) {
				    //No hay registros
				}else{
					$filas=mysqli_num_rows($res); 
					if ($filas == 0) { 
				      	//header("Location: incorrecto.php?m=2");
				      	//exit();
			      	}else
		            	{
		               		while($reg=mysqli_fetch_assoc($res)) {
		               			$this->t[]=$reg;
		              		}
	              			return $this->t;
						}
				}
			}
			
			public function get_resumen_por_cia_de_poliza($desde,$hasta,$cia)
		    {
		      	$sql="SELECT * FROM poliza 
		      			INNER JOIN dcia, drecibo WHERE 
		      			poliza.id_cia=dcia.idcia AND
		      			poliza.id_poliza=drecibo.idrecibo AND 
		      			f_hastapoliza >= '$desde' AND
		      			f_hastapoliza <= '$hasta' AND
		      			id_cia = '$cia' ";
				$res=mysqli_query(Conectar::con(),$sql);
				
				if (!$res) {
				    //No hay registros
				}else{
					$filas=mysqli_num_rows($res); 
					if ($filas == 0) { 
				      	//header("Location: incorrecto.php?m=2");
				      	//exit();
			      	}else
		            	{
		               		while($reg=mysqli_fetch_assoc($res)) {
		               			$this->t[]=$reg;
		              		}
	              			return $this->t;
						}
				}
			}
			
			public function get_resumen_de_cia_por_ramo($desde,$hasta,$cia,$ramo)
		    {

		    	if ($cia=='Seleccione Cía') {
		    		$cia='';
		    	}

		      	$sql="SELECT * FROM poliza 
		      			INNER JOIN dcia, drecibo, dramo WHERE 
		      			poliza.id_cia=dcia.idcia AND
		      			poliza.id_poliza=drecibo.idrecibo AND 
								poliza.id_cod_ramo = dramo.cod_ramo AND
		      			f_hastapoliza >= '$desde' AND
		      			f_hastapoliza <= '$hasta' AND
								nomcia = '$cia' AND
								nramo = '$ramo'";
				$res=mysqli_query(Conectar::con(),$sql);
				
				if (!$res) {
				    //No hay registros
				}else{
					$filas=mysqli_num_rows($res); 
					if ($filas == 0) { 
				      	//header("Location: incorrecto.php?m=2");
				      	//exit();
			      	}else
		            	{
		               		while($reg=mysqli_fetch_assoc($res)) {
		               			$this->t[]=$reg;
		              		}
	              			return $this->t;
						}
				}
		  }



	
//--------------------FIN GRÁFICO Resumen RAMO-------------------		       




//-------------------GRÁFICO 2 PRIMA SUSCRITA --------------------------------
	public function get_poliza_grafp_2($ramo,$desde,$hasta,$cia)
		    {
		    	
		    	if ($cia=='Seleccione Cía') {
		    		$cia='';
		    	}
		    	if ($ramo=='Seleccione Ramo') {
		    		$ramo='';
		    	}

		      	$sql="SELECT * FROM poliza, drecibo, dcia, dramo WHERE 
		      			poliza.id_poliza = drecibo.idrecibo AND 
						poliza.id_cod_ramo=dramo.cod_ramo AND 
						poliza.id_cia=dcia.idcia AND 
		      			f_desderecibo >= '$desde' AND
		      			f_desderecibo <= '$hasta' AND
		      			nomcia LIKE '%$cia%' AND
		      			nramo LIKE '%$ramo%' ";
				$res=mysqli_query(Conectar::con(),$sql);
				
				if (!$res) {
				    //No hay registros
				}else{
					$filas=mysqli_num_rows($res); 
					if ($filas == 0) { 
				      	//header("Location: incorrecto.php?m=2");
				      	exit();
			      	}else
		            	{
		               		while($reg=mysqli_fetch_assoc($res)) {
		               			$this->t[]=$reg;
		              		}
	              			return $this->t;
						}
				}

		       }
//-----------------FIN GRÁFICO 2 PRIMA SISCRITA --------------------------------


//--------------------GRÁFICO 6 PRIMA EJECUTIVO-------------------


	public function get_distinct_element_ejecutivo($desde,$hasta,$cia,$ramo)
		    {


		    	if ($ramo=='Seleccione Ramo') {
		    		$ramo='';
		    	}
		    	if ($cia=='Seleccione Cía') {
		    		$cia='';
		    	}

		      	$sql="SELECT DISTINCT cod_vend FROM comision, poliza, drecibo, dcia, dramo WHERE 
		      			poliza.id_poliza = drecibo.idrecibo AND
		      			poliza.id_cia=dcia.idcia AND
		      			poliza.id_poliza=comision.id_poliza AND 
                		poliza.id_cod_ramo=dramo.cod_ramo AND
		      			f_hastapoliza >= '$desde' AND
		      			f_hastapoliza <= '$hasta' AND
		      			nramo LIKE '%$ramo%' AND
		      			nomcia LIKE '%$cia%'";
				$res=mysqli_query(Conectar::con(),$sql);
				
				if (!$res) {
				    //No hay registros
				}else{
					$filas=mysqli_num_rows($res); 
					if ($filas == 0) { 
				      	header("Location: busqueda_ejecutivo.php?m=2#nombre");
				      	exit();
			      	}else
		            	{
		               		while($reg=mysqli_fetch_assoc($res)) {
		               			$this->t[]=$reg;
		              		}
	              			return $this->t;
						}
				}

				
		       }




	public function get_poliza_graf_prima_6($codvend,$ramo,$desde,$hasta,$cia)
		    {
		    	if ($ramo=='Seleccione Ramo') {
		    		$ramo='';
		    	}
		    	if ($cia=='Seleccione Cía') {
		    		$cia='';
		    	}
		      	$sql="SELECT * FROM comision, poliza, drecibo, dcia, dramo, ena, rep_com WHERE 
		      			poliza.id_poliza = drecibo.idrecibo AND 
						poliza.id_cod_ramo=dramo.cod_ramo AND 
						rep_com.id_cia=dcia.idcia AND 
						poliza.id_poliza=comision.id_poliza AND 
		      			comision.cod_vend = ena.cod AND
								comision.id_rep_com = rep_com.id_rep_com AND
		      			f_hastapoliza >= '$desde' AND
		      			f_hastapoliza <= '$hasta' AND
		      			nramo LIKE '%$ramo%' AND
		      			nomcia LIKE '%$cia%' AND
		      			cod_vend = '$codvend' ";
				$res=mysqli_query(Conectar::con(),$sql);
				
				if (!$res) {
				    //No hay registros
				}else{
					$filas=mysqli_num_rows($res); 
					if ($filas == 0) { 
				      	//header("Location: incorrecto.php?m=2");
				      	//exit();
			      	}else
		            	{
		               		while($reg=mysqli_fetch_assoc($res)) {
		               			$this->t[]=$reg;
		              		}
	              			return $this->t;
						}
				}
		    }

	public function get_poliza_graf_prima_6_p($codvend,$ramo,$desde,$hasta,$cia)
		    {
		    	if ($ramo=='Seleccione Ramo') {
		    		$ramo='';
		    	}
		    	if ($cia=='Seleccione Cía') {
		    		$cia='';
		    	}
		      	$sql="SELECT * FROM comision, poliza, drecibo, dcia, dramo, enp, rep_com WHERE 
		      			poliza.id_poliza = drecibo.idrecibo AND 
						poliza.id_cod_ramo=dramo.cod_ramo AND 
						rep_com.id_cia=dcia.idcia AND 
						poliza.id_poliza=comision.id_poliza AND 
		      			comision.cod_vend = enp.cod AND
								comision.id_rep_com = rep_com.id_rep_com AND
		      			f_hastapoliza >= '$desde' AND
		      			f_hastapoliza <= '$hasta' AND
		      			nramo LIKE '%$ramo%' AND
		      			nomcia LIKE '%$cia%' AND
		      			codvend = '$codvend' ";
				$res=mysqli_query(Conectar::con(),$sql);
				
				if (!$res) {
				    //No hay registros
				}else{
					$filas=mysqli_num_rows($res); 
					if ($filas == 0) { 
				      	//header("Location: incorrecto.php?m=2");
				      	//exit();
			      	}else
		            	{
		               		while($reg=mysqli_fetch_assoc($res)) {
		               			$this->t[]=$reg;
		              		}
	              			return $this->t;
						}
				}
		    }

	public function get_poliza_graf_prima_6_r($codvend,$ramo,$desde,$hasta,$cia)
		    {
		    	if ($ramo=='Seleccione Ramo') {
		    		$ramo='';
		    	}
		    	if ($cia=='Seleccione Cía') {
		    		$cia='';
		    	}
		      	$sql="SELECT * FROM comision, poliza, drecibo, dcia, dramo, enr, rep_com WHERE 
		      			poliza.id_poliza = drecibo.idrecibo AND 
						poliza.id_cod_ramo=dramo.cod_ramo AND 
						rep_com.id_cia=dcia.idcia AND 
						poliza.id_poliza=comision.id_poliza AND 
		      			comision.cod_vend = enr.cod AND
								comision.id_rep_com = rep_com.id_rep_com AND
		      			f_hastapoliza >= '$desde' AND
		      			f_hastapoliza <= '$hasta' AND
		      			nramo LIKE '%$ramo%' AND
		      			nomcia LIKE '%$cia%' AND
		      			codvend = '$codvend' ";
				$res=mysqli_query(Conectar::con(),$sql);
				
				if (!$res) {
				    //No hay registros
				}else{
					$filas=mysqli_num_rows($res); 
					if ($filas == 0) { 
				      	//header("Location: incorrecto.php?m=2");
				      	//exit();
			      	}else
		            	{
		               		while($reg=mysqli_fetch_assoc($res)) {
		               			$this->t[]=$reg;
		              		}
	              			return $this->t;
						}
				}
				}
				

//--------------------FIN GRÁFICO 6 PRIMA EJECUTIVO-------------------	






	public function get_poliza($ramo)
		    {
		      	$sql="SELECT * FROM dpoliza WHERE cod_ramo = '$ramo'";
				$res=mysqli_query(Conectar::con(),$sql);
				
				if (!$res) {
				    //No hay registros
				}else{
					$filas=mysqli_num_rows($res); 
					if ($filas == 0) { 
				      	//header("Location: incorrecto.php?m=2");
				      	exit();
			      	}else
		            	{
		               		while($reg=mysqli_fetch_assoc($res)) {
		               			$this->t[]=$reg;
		              		}
	              			return $this->t;
						}
				}

		       }

	public function get_poliza_cia($cia)
		    {
		      	$sql="SELECT * FROM dpoliza WHERE nomcia = '$cia'";
				$res=mysqli_query(Conectar::con(),$sql);
				
				if (!$res) {
				    //No hay registros
				}else{
					$filas=mysqli_num_rows($res); 
					if ($filas == 0) { 
				      	//header("Location: incorrecto.php?m=2");
				      	exit();
			      	}else
		            	{
		               		while($reg=mysqli_fetch_assoc($res)) {
		               			$this->t[]=$reg;
		              		}
	              			return $this->t;
						}
				}

		       }


	public function get_poliza_tpoliza($tpoliza)
		    {
		      	$sql="SELECT * FROM dpoliza WHERE tpoliza = '$tpoliza'";
				$res=mysqli_query(Conectar::con(),$sql);
				
				if (!$res) {
				    //No hay registros
				}else{
					$filas=mysqli_num_rows($res); 
					if ($filas == 0) { 
				      	//header("Location: incorrecto.php?m=2");
				      	exit();
			      	}else
		            	{
		               		while($reg=mysqli_fetch_assoc($res)) {
		               			$this->t[]=$reg;
		              		}
	              			return $this->t;
						}
				}

		       }




	public function get_fecha_min($campo, $tabla)
    {
      $sql="SELECT MIN($campo) FROM $tabla ";
		$res=mysqli_query(Conectar::con(),$sql);
		
		$filas=mysqli_num_rows($res); 
		if ($filas == 0) { 
      	//header("Location: incorrecto.php?m=2");
      	exit();
       } 
         else
             {
               while($reg=mysqli_fetch_assoc($res)) {
               	$this->t[]=$reg;
              		}
          		return $this->t;
				}
    }

    public function get_fecha_max($campo, $tabla)
    {
      $sql="SELECT MAX($campo) FROM $tabla ";
		$res=mysqli_query(Conectar::con(),$sql);
		
		$filas=mysqli_num_rows($res); 
		if ($filas == 0) { 
      	//header("Location: incorrecto.php?m=2");
      	exit();
       } 
         else
             {
               while($reg=mysqli_fetch_assoc($res)) {
               	$this->t[]=$reg;
              		}
          		return $this->t;
				}
       }


    public function get_mes_prima($cond1, $cond2, $cia, $ramo)
    {


    	if ($cia=='Seleccione Cía') {
    		$cia='';
    	}
    	if ($ramo=='Seleccione Ramo') {
    		$ramo='';
    	}

		    	
      $sql="SELECT DISTINCT Month(f_desderecibo) FROM poliza,drecibo,dcia,dramo
		      WHERE 
		      poliza.id_poliza = drecibo.idrecibo AND
		      poliza.id_cod_ramo=dramo.cod_ramo AND
		      poliza.id_cia=dcia.idcia AND
		      f_desderecibo >= '$cond1' AND
		      f_desderecibo <= '$cond2' AND
			  nomcia LIKE '%$cia%' AND
			  nramo LIKE '%$ramo%'
		      ORDER BY Month(f_desderecibo) ASC ";
		$res=mysqli_query(Conectar::con(),$sql);
		
		$filas=mysqli_num_rows($res); 
		if ($filas == 0) { 
      	//header("Location: incorrecto.php?m=2");
      	exit();
       } 
         else
             {
               while($reg=mysqli_fetch_assoc($res)) {
               	$this->t[]=$reg;
              		}
          		return $this->t;
				}
       }



    public function get_dia_mes_prima($cond1, $cond2, $cia, $ramo)
    {

  
    	if ($cia=='Seleccione Cía') {
    		$cia='';
    	}
    	if ($ramo=='Seleccione Ramo') {
    		$ramo='';
    	}

		    	
      $sql="SELECT DISTINCT f_desderecibo FROM poliza,drecibo, dcia, dramo
		      WHERE 
		      poliza.id_poliza = drecibo.idrecibo AND
              poliza.id_cod_ramo=dramo.cod_ramo AND
              poliza.id_cia=dcia.idcia AND
		      f_desderecibo >= '$cond1' AND
		      f_desderecibo <= '$cond2' AND
			  nomcia LIKE '%$cia%' AND
			  nramo LIKE '%$ramo%'
		      ORDER BY f_desderecibo ASC";
		$res=mysqli_query(Conectar::con(),$sql);
		
		$filas=mysqli_num_rows($res); 
		if (!$res) {
				    //No hay registros
				}else{
					$filas=mysqli_num_rows($res); 
					if ($filas == 0) { 
						echo "No hay registros";
				      	header("Location: busqueda_prima_semana.php?m=2");
				      	exit();
			      	}else
		            	{
		               		while($reg=mysqli_fetch_assoc($res)) {
		               			$this->t[]=$reg;
		              		}
	              			return $this->t;
						}
				}

		       }


    public function get_poliza_graf_p3($ramo,$dia,$cia)
		    {
	
		    	if ($cia=='Seleccione Cía') {
		    		$cia='';
		    	}
		    	if ($ramo=='Seleccione Ramo') {
		    		$ramo='';
		    	}

		      	$sql="SELECT * FROM poliza,drecibo, dcia, dramo WHERE 
		      			poliza.id_poliza = drecibo.idrecibo AND
              			poliza.id_cod_ramo=dramo.cod_ramo AND
              			poliza.id_cia=dcia.idcia AND
		      			f_desderecibo = '$dia' AND
		      			nomcia LIKE '%$cia%' AND
		      			nramo LIKE '%$ramo%' ";
				$res=mysqli_query(Conectar::con(),$sql);
				
				if (!$res) {
				    //No hay registros
				}else{
					$filas=mysqli_num_rows($res); 
					if ($filas == 0) { 
				      	//header("Location: incorrecto.php?m=2");
				      	exit();
			      	}else
		            	{
		               		while($reg=mysqli_fetch_assoc($res)) {
		               			$this->t[]=$reg;
		              		}
	              			return $this->t;
						}
				}

					 }
					 







	public function get_resumen_por_asesor_en_poliza($desde,$hasta,$cod_asesor)
		    {
		      	$sql="SELECT prima FROM drecibo 
							INNER JOIN dcia, poliza WHERE 
							poliza.id_cia=dcia.idcia AND
							poliza.id_poliza=drecibo.idrecibo AND 
							f_hastapoliza >= '$desde' AND
							f_hastapoliza <= '$hasta' AND
							codvend = '$cod_asesor' ";
				$res=mysqli_query(Conectar::con(),$sql);
				if (!$res) {
				    //No hay registros
				}else{
					$filas=mysqli_num_rows($res); 
					if ($filas == 0) { 
				      	//header("Location: incorrecto.php?m=2");
				      	//exit();
			      	}else
		            	{
		               		while($reg=mysqli_fetch_assoc($res)) {
		               			$this->t[]=$reg;
		              		}
	              			return $this->t;
						}
				}
			}




	public function get_resumen_por_asesor($desde,$hasta,$cod_asesor)
		    {
		      	$sql="SELECT * FROM comision 
							INNER JOIN dcia, drecibo, poliza, rep_com WHERE 
							rep_com.id_cia=dcia.idcia AND
							poliza.id_poliza=drecibo.idrecibo AND 
							comision.id_poliza=poliza.id_poliza AND
							rep_com.id_rep_com = comision.id_rep_com AND
							f_hastapoliza >= '$desde' AND
							f_hastapoliza <= '$hasta' AND
							comision.cod_vend = '$cod_asesor' ";
				$res=mysqli_query(Conectar::con(),$sql);
				if (!$res) {
				    //No hay registros
				}else{
					$filas=mysqli_num_rows($res); 
					if ($filas == 0) { 
				      	//header("Location: incorrecto.php?m=2");
				      	//exit();
			      	}else
		            	{
		               		while($reg=mysqli_fetch_assoc($res)) {
		               			$this->t[]=$reg;
		              		}
	              			return $this->t;
						}
				}
			}

	public function get_gc_comision($num_poliza)
			{
					$sql="SELECT per_gc FROM poliza WHERE 
							
							cod_poliza = '$num_poliza' ";
			$res=mysqli_query(Conectar::con(),$sql);
			if (!$res) {
					//No hay registros
			}else{
				$filas=mysqli_num_rows($res); 
				if ($filas == 0) { 
							//header("Location: incorrecto.php?m=2");
							//exit();
						}else
								{
										 while($reg=mysqli_fetch_assoc($res)) {
											 $this->t[]=$reg;
										}
										return $this->t;
					}
			}
		}


	public function get_resumen_por_asesor_de_poliza($desde,$hasta,$cod_asesor)
			{
					$sql="SELECT * FROM poliza 
							INNER JOIN dcia, drecibo WHERE 
							poliza.id_cia=dcia.idcia AND
							poliza.id_poliza=drecibo.idrecibo AND 
							f_hastapoliza >= '$desde' AND
							f_hastapoliza <= '$hasta' AND
							codvend = '$cod_asesor' ";
			$res=mysqli_query(Conectar::con(),$sql);
			
			if (!$res) {
					//No hay registros
			}else{
				$filas=mysqli_num_rows($res); 
				if ($filas == 0) { 
							//header("Location: incorrecto.php?m=2");
							//exit();
						}else
								{
										 while($reg=mysqli_fetch_assoc($res)) {
											 $this->t[]=$reg;
										}
										return $this->t;
					}
			}
		}



















//------------------------------AGREGAR-------------------------------------

	public function agregarAsesor($datos){


			$sql="INSERT into ena (idnom,cod,id,banco,tipo_cuenta,
									num_cuenta,email,cel,obs,pre1,gc_viajes)
									values ('$datos[0]',
											'$datos[1]',
											'$datos[2]',
											'$datos[3]',
											'$datos[4]',
											'$datos[5]',
											'$datos[6]',
											'$datos[7]',
											'$datos[8]',
											'$datos[9]',
											'$datos[10]')";
			return mysqli_query(Conectar::con(),$sql);
		}


	public function agregarCliente($datos){
			if ($datos[0]=="") {
				exit;
			}
			if ($datos[10]=="") {
				exit;
			}
			
			$f_nac=$datos[9];
    	$f_nac = date("Y-m-d", strtotime($f_nac));

			$sql="INSERT into titular (r_social,ci,nombre_t, apellido_t, cell,
										telf, telf1, id_sexo, id_ecivil, f_nac, direcc,
										direcc1, email, email1, ocupacion, ingreso)
									values ('$datos[0]',
											'$datos[1]',
											'$datos[2]',
											'$datos[3]',
											'$datos[4]',
											'$datos[5]',
											'$datos[6]',
											'$datos[7]',
											'$datos[8]',
											'$f_nac',
											'$datos[10]',
											'$datos[11]',
											'$datos[12]',
											'$datos[13]',
											'$datos[14]',
											'$datos[15]')";
			return mysqli_query(Conectar::con(),$sql);
		}


	public function agregarPoliza($cod_poliza,$f_poliza,$f_emi,$tcobertura,$f_desdepoliza,
									$f_hastapoliza,$currency,$id_tpoliza,$sumaasegurada,$id_zproduccion,
									$codvend,$id_cod_ramo,$id_cia,$id_titular,$id_tomador,$asesor_ind,$t_cuenta){


			$sql="INSERT into poliza (cod_poliza,f_poliza, f_emi, tcobertura, f_desdepoliza,
										f_hastapoliza, currency, id_tpoliza, sumaasegurada, id_zproduccion, codvend,
										id_cod_ramo, id_cia, id_titular, id_tomador, per_gc, t_cuenta)
									values ('$cod_poliza',
											'$f_poliza',
											'$f_emi',
											'$tcobertura',
											'$f_desdepoliza',
											'$f_hastapoliza',
											'$currency',
											'$id_tpoliza',
											'$sumaasegurada',
											'$id_zproduccion',
											'$codvend',
											'$id_cod_ramo',
											'$id_cia',
											'$id_titular',
											'$id_tomador',
											'$asesor_ind',
											'$t_cuenta')";
			return mysqli_query(Conectar::con(),$sql);
		}

	public function agregarRecibo($cod_recibo,$f_desderecibo,$f_hastarecibo,$prima,$fpago,
									$ncuotas,$montocuotas,$idtom,$idtitu,
									$cod_poliza){


			$sql="INSERT into drecibo (cod_recibo,f_desderecibo, f_hastarecibo, prima, fpago,
										ncuotas, montocuotas, idtom, idtitu, cod_poliza)
									values ('$cod_recibo',
											'$f_desderecibo',
											'$f_hastarecibo',
											'$prima',
											'$fpago',
											'$ncuotas',
											'$montocuotas',
											'$idtom',
											'$idtitu',
											'$cod_poliza')";
			return mysqli_query(Conectar::con(),$sql);
		}


	public function agregarProyecto($datos){


			$sql="INSERT into lider_enp (cod_proyecto,lider,pago,ref_cuenta)
									values ('$datos[0]',
											'$datos[1]',
											'$datos[2]',
											'$datos[3]')";
			return mysqli_query(Conectar::con(),$sql);
		}

	public function agregarAsesorProyecto($datos){


			$sql="INSERT into enp (id_proyecto,cod,nombre,num_cuenta,banco,
									tipo_cuenta,email,id,cel,obs,currency,monto)
									values ('$datos[0]',
											'$datos[1]',
											'$datos[2]',
											'$datos[3]',
											'$datos[4]',
											'$datos[5]',
											'$datos[6]',
											'$datos[7]',
											'$datos[8]',
											'$datos[9]',
											'$datos[10]',
											'$datos[11]')";
			return mysqli_query(Conectar::con(),$sql);
		}

	public function agregarReferidor($datos){


			$sql="INSERT into enr (cod,nombre,num_cuenta,banco,
									tipo_cuenta,email,id,cel,obs,pago,ref_cuenta,currency,monto)
									values ('$datos[0]',
											'$datos[1]',
											'$datos[2]',
											'$datos[3]',
											'$datos[4]',
											'$datos[5]',
											'$datos[6]',
											'$datos[7]',
											'$datos[8]',
											'$datos[9]',
											'$datos[10]',
											'$datos[11]',
											'$datos[12]')";
			return mysqli_query(Conectar::con(),$sql);
		}



	public function agregarRepCom($f_hasta_rep,$f_pago_gc,$id_cia,$prima_comt,$comt){


			$sql="INSERT into rep_com (f_hasta_rep,f_pago_gc,id_cia,primat_com,comt)
									values ('$f_hasta_rep',
											'$f_pago_gc',
											'$id_cia',
											'$prima_comt',
											'$comt')";
			return mysqli_query(Conectar::con(),$sql);
		}


	public function agregarCom($id_rep_com,$num_poliza,$cod_vend,$f_pago_prima,
									$prima_com,$comision,$id_poliza){


			$sql="INSERT into comision (id_rep_com,num_poliza,cod_vend,f_pago_prima,
									prima_com,comision,id_poliza)
									values ('$id_rep_com',
											'$num_poliza',
											'$cod_vend',
											'$f_pago_prima',
											'$prima_com',
											'$comision',
											'$id_poliza')";
			return mysqli_query(Conectar::con(),$sql);

		}
		
		
	public function agregarVehiculo($placa,$tveh,$marca,$mveh,
											$f_veh,$serial,$cveh,$catveh,$cod_recibo){


								$sql="INSERT into dveh (placa,tveh,marca,mveh,
									f_veh,serial,cveh,catveh,cod_recibo)
									values ('$placa',
											'$tveh',
											'$marca',
											'$mveh',
											'$f_veh',
											'$serial',
											'$cveh',
											'$catveh',
											'$cod_recibo')";
								return mysqli_query(Conectar::con(),$sql);

	}

	public function agregarPrePoliza($datos){

		$sql="INSERT into poliza (cod_poliza,f_poliza, f_emi, tcobertura, f_desdepoliza,
										f_hastapoliza, currency, id_tpoliza, sumaasegurada, id_zproduccion, codvend,
										id_cod_ramo, id_cia, id_titular, id_tomador, per_gc, t_cuenta)
									values ('$datos[0]',
											'$datos[2]',
											'2017-01-01',
											'N/A',
											'2017-01-01',
											'2017-01-01',
											'1',
											'1',
											'0',
											'$datos[3]',
											'AP-1',
											'0',
											'$datos[1]',
											'0',
											'0',
											'50',
											'1')";
		return mysqli_query(Conectar::con(),$sql);
		
	}

	public function agregarAsegurado($asegurado,$id_poliza){

			$sql="INSERT into titular_pre_poliza (asegurado,id_poliza)
				values ('$asegurado',
						'$id_poliza')";
			return mysqli_query(Conectar::con(),$sql);

	}


//-------------------------------------------------------------------


//------------------------------OBTENER DATOS-------------------------------------
	public function obtenDatos($id){

			$sql="SELECT idena,
							idnom,
							cod,
							id,
							refcuenta
					from ena
					where idena='$id'";
			$result=mysqli_query(Conectar::con(),$sql);
			$ver=mysqli_fetch_row($result);

			$datos=array(
				'idena' => $ver[0],
				'idnom' => $ver[1],
				'cod' => $ver[2],
				'id' => $ver[3],
				'refcuenta' => $ver[4]
				);
			return $datos;
		}



	public function obtenTitular($id){

			$sql="SELECT nombre_t, apellido_t, ci FROM titular WHERE ci = '$id'";
			$result=mysqli_query(Conectar::con(),$sql);
			$ver=mysqli_fetch_row($result);

			$datos=array(
				'ci' => $ver[2],
				'apellido_t' => $ver[1],
				'nombre_t' => $ver[0]
				);
			return $datos;
		}


	public function obtenPoliza($id){

			$sql="SELECT f_emi, f_desdepoliza, f_hastapoliza, id_cod_ramo, id_cia, tcobertura,
							poliza.id_titular, id_tomador, f_desderecibo, f_hastarecibo, codvend, 
							ci, currency, idnom, nombre_t, apellido_t, placa, tveh, marca, mveh, f_veh, serial, cveh, catveh, id_poliza, t_cuenta  FROM 
                    poliza
                  	INNER JOIN drecibo, titular, tipo_poliza, dramo, dcia, ena, dveh
                  	WHERE 
                  	poliza.id_poliza = drecibo.idrecibo AND
                  	poliza.id_titular = titular.id_titular AND 
                  	poliza.id_tpoliza = tipo_poliza.id_t_poliza AND
                  	poliza.id_cod_ramo = dramo.cod_ramo AND
                    poliza.id_cia = dcia.idcia AND
                    poliza.codvend = ena.cod AND
					poliza.id_poliza = dveh.idveh AND
                  	poliza.cod_poliza = $id
                    ORDER BY poliza.f_poliza DESC";
			$result=mysqli_query(Conectar::con(),$sql);
			if (!$result) {
				    //echo "nada";
				}else{
					$filas=mysqli_num_rows($result); 
					if ($filas == 0) { 
						
						$sql1="SELECT f_emi, f_desdepoliza, f_hastapoliza, id_cod_ramo, id_cia, tcobertura,
							poliza.id_titular, id_tomador, f_desderecibo, f_hastarecibo, codvend, 
							ci, poliza.currency, nombre AS idnom, nombre_t, apellido_t, placa, tveh, marca, mveh, f_veh, serial, cveh, catveh, id_poliza, t_cuenta  FROM 
		                    poliza
		                  	INNER JOIN drecibo, titular, tipo_poliza, dramo, dcia, enp, dveh
		                  	WHERE 
		                  	poliza.id_poliza = drecibo.idrecibo AND
		                  	poliza.id_titular = titular.id_titular AND 
		                  	poliza.id_tpoliza = tipo_poliza.id_t_poliza AND
		                  	poliza.id_cod_ramo = dramo.cod_ramo AND
		                    poliza.id_cia = dcia.idcia AND
		                    poliza.codvend = enp.cod AND
							poliza.id_poliza = dveh.idveh AND
		                  	poliza.cod_poliza = $id
		                    ORDER BY poliza.id_poliza ASC";
						$result1=mysqli_query(Conectar::con(),$sql1);

						if (!$result1) {
						    //echo "nada";
						}else{
							$filas1=mysqli_num_rows($result1); 
							if ($filas1 == 0) { 
								
								$sql2="SELECT  f_emi, f_desdepoliza, f_hastapoliza, id_cod_ramo, id_cia, tcobertura,
									poliza.id_titular, id_tomador, f_desderecibo, f_hastarecibo, codvend, 
									ci, poliza.currency, nombre AS idnom, nombre_t, apellido_t, placa, tveh, marca, mveh, f_veh, serial, cveh, catveh, id_poliza, t_cuenta  FROM 
				                    poliza
				                  	INNER JOIN drecibo, titular, tipo_poliza, dramo, dcia, enr, dveh
				                  	WHERE 
				                  	poliza.id_poliza = drecibo.idrecibo AND
				                  	poliza.id_titular = titular.id_titular AND 
				                  	poliza.id_tpoliza = tipo_poliza.id_t_poliza AND
				                  	poliza.id_cod_ramo = dramo.cod_ramo AND
				                    poliza.id_cia = dcia.idcia AND
				                    poliza.codvend = enr.cod AND
									poliza.id_poliza = dveh.idveh AND
				                  	poliza.cod_poliza = $id
				                    ORDER BY poliza.id_poliza ASC";
								$result2=mysqli_query(Conectar::con(),$sql2);

								$ver2=mysqli_fetch_row($result2);
								$datos2=array(
									'f_emi' => $ver2[0],
									'f_desdepoliza' => $ver2[1],
									'f_hastapoliza' => $ver2[2],
									'id_cod_ramo' => $ver2[3],
									'id_cia' => $ver2[4],
									'tcobertura' => $ver2[5],
									'id_titular' => $ver2[6],
									'id_tomador' => $ver2[7],
									'f_desderecibo' => $ver2[8],
									'f_hastarecibo' => $ver2[9],
									'codvend' => $ver2[10],
									'ci' => $ver2[11],
									'currency' => $ver2[12],
									'idnom' => $ver2[13],
									'nombre_t' => $ver2[14],
									'apellido_t' => $ver2[15],
									'placa' => $ver2[16],
									'tveh' => $ver2[17],
									'marca' => $ver2[18],
									'mveh' => $ver2[19],
									'f_veh' => $ver2[20],
									'serial' => $ver2[21],
									'cveh' => $ver2[22],
									'catveh' => $ver2[23],
									'id_poliza' => $ver2[24],
									't_cuenta' => $ver2[25]
									);
								return $datos2;
					      	}else{
				               		$ver1=mysqli_fetch_row($result1);
									$datos1=array(
										'f_emi' => $ver1[0],
										'f_desdepoliza' => $ver1[1],
										'f_hastapoliza' => $ver1[2],
										'id_cod_ramo' => $ver1[3],
										'id_cia' => $ver1[4],
										'tcobertura' => $ver1[5],
										'id_titular' => $ver1[6],
										'id_tomador' => $ver1[7],
										'f_desderecibo' => $ver1[8],
										'f_hastarecibo' => $ver1[9],
										'codvend' => $ver1[10],
										'ci' => $ver1[11],
										'currency' => $ver1[12],
										'idnom' => $ver1[13],
										'nombre_t' => $ver1[14],
										'apellido_t' => $ver1[15],
										'placa' => $ver1[16],
										'tveh' => $ver1[17],
										'marca' => $ver1[18],
										'mveh' => $ver1[19],
										'f_veh' => $ver1[20],
										'serial' => $ver1[21],
										'cveh' => $ver1[22],
										'catveh' => $ver1[23],
										'id_poliza' => $ver1[24],
										't_cuenta' => $ver1[25]
										);
									return $datos1;
								}	
						}
			      	}else{
		               		$ver=mysqli_fetch_row($result);
							$datos=array(
								'f_emi' => $ver[0],
								'f_desdepoliza' => $ver[1],
								'f_hastapoliza' => $ver[2],
								'id_cod_ramo' => $ver[3],
								'id_cia' => $ver[4],
								'tcobertura' => $ver[5],
								'id_titular' => $ver[6],
								'id_tomador' => $ver[7],
								'f_desderecibo' => $ver[8],
								'f_hastarecibo' => $ver[9],
								'codvend' => $ver[10],
								'ci' => $ver[11],
								'currency' => $ver[12],
								'idnom' => $ver[13],
								'nombre_t' => $ver[14],
								'apellido_t' => $ver[15],
								'placa' => $ver[16],
								'tveh' => $ver[17],
								'marca' => $ver[18],
								'mveh' => $ver[19],
								'f_veh' => $ver[20],
								'serial' => $ver[21],
								'cveh' => $ver[22],
								'catveh' => $ver[23],
								'id_poliza' => $ver[24],
								't_cuenta' => $ver[25]
								);
							return $datos;
						}
			}		
		}




	public function obtenReporte($f_hasta,$idcia){

			$sql="SELECT * FROM rep_com 
					WHERE 
					f_hasta_rep = '$f_hasta' AND
						id_cia= '$idcia'";

			$result=mysqli_query(Conectar::con(),$sql);
			$ver=mysqli_fetch_row($result);

			$datos=array(
				'id_rep_com' => $ver[0],
				'f_hasta_rep' => $ver[1],
				'f_pago_gc' => $ver[2],
				'id_cia' => $ver[3],
				'primat_com' => $ver[4],
				'comt' => $ver[5]
				);
			return $datos;



			
		}



//-------------------------------------------------------------------

//------------------------------EDITAR-------------------------------------


	public function actualizarAsesor($datos){


			$sql="UPDATE ena set 	cod='$datos[2]',
									idnom='$datos[1]',
									id='$datos[3]',
									refcuenta='$datos[4]'
						where idena= $datos[0]";
			return mysqli_query(Conectar::con(),$sql);
	}


//-------------------------------------------------------------------	

//------------------------------ELIMINAR-------------------------------------

	public function eliminarAsesor($id){

			$sql="DELETE from ena where idena='$id'";
			return mysqli_query(Conectar::con(),$sql);
		}

		public function eliminarPoliza($id){

			$sql1="DELETE from drecibo where idrecibo='$id'";
			mysqli_query(Conectar::con(),$sql1);

			$sql2="DELETE from dveh where idveh='$id'";
			mysqli_query(Conectar::con(),$sql2);

			$sql="DELETE from poliza where id_poliza='$id'";
			return mysqli_query(Conectar::con(),$sql);
		}
	
		
	
	function destruir(){

		mysql_close($this->con);
	}	
	
}
?>