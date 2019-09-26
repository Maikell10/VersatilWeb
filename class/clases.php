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
		$hostname="209.208.111.101";
        $username="versatils";
        $password="AB2016vER2s85";
		$dbname="versatil_sdb";
		

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
			
		public function get_element_desc($tabla,$campo)
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

	public function update_poliza_pdf($id_poliza)
		{
			$sql="UPDATE poliza SET pdf = 1 WHERE id_poliza = $id_poliza;";
			return mysqli_query(Conectar::con(),$sql);
		}

			   




		public function get_asesor_por_cod($cod)
			{

				if (is_array($cod)) {
					// create sql part for IN condition by imploding comma after each id
					$asesorIn = "('" . implode("','", $cod) ."')";

					$sql="SELECT ena.cod AS cod, ena.idnom as nombre FROM ena WHERE cod IN $asesorIn
						UNION
						SELECT enp.cod as cod, enp.nombre as nombre FROM enp WHERE cod IN $asesorIn
						UNION
						SELECT enr.cod as cod, enr.nombre as nombre FROM enr WHERE cod IN $asesorIn";
					$res=mysqli_query(Conectar::con(),$sql);
				}else {
					$sql="SELECT ena.cod AS cod, ena.idnom as nombre FROM ena WHERE cod='$cod'
					UNION
					SELECT enp.cod as cod, enp.nombre as nombre FROM enp WHERE cod='$cod'
					UNION
					SELECT enr.cod as cod, enr.nombre as nombre FROM enr WHERE cod='$cod'";
					$res=mysqli_query(Conectar::con(),$sql);
				}
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
//-------------------------------PRODUCCION--------------------

		public function get_poliza_total()
		    {
		      	$sql="SELECT *  FROM 
                    poliza
                  	INNER JOIN drecibo, titular, dcia
                  	WHERE 
                  	poliza.id_poliza = drecibo.idrecibo AND
                  	poliza.id_titular = titular.id_titular AND
                  	poliza.id_cia = dcia.idcia
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

		public function get_poliza_total_by_asesor_ena()
		    {
		      	$sql="SELECT *  FROM 
                    poliza
                  	INNER JOIN drecibo, titular, dcia, ena
                  	WHERE 
                  	poliza.id_poliza = drecibo.idrecibo AND
                  	poliza.id_titular = titular.id_titular AND
                  	poliza.id_cia = dcia.idcia AND
					poliza.codvend = ena.cod 
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

		public function get_poliza_total_by_asesor_ena_user($cod_asesor_user)
		    {
		      	$sql="SELECT *  FROM 
                    poliza
                  	INNER JOIN drecibo, titular, dcia, ena
                  	WHERE 
                  	poliza.id_poliza = drecibo.idrecibo AND
                  	poliza.id_titular = titular.id_titular AND
                  	poliza.id_cia = dcia.idcia AND
					poliza.codvend = ena.cod AND
					poliza.codvend = '$cod_asesor_user'
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


		public function get_poliza_total_by_asesor_enp()
		    {
		      	$sql="SELECT *  FROM 
                    poliza
                  	INNER JOIN drecibo, titular, dcia, enp
                  	WHERE 
                  	poliza.id_poliza = drecibo.idrecibo AND
                  	poliza.id_titular = titular.id_titular AND
                  	poliza.id_cia = dcia.idcia AND
					poliza.codvend = enp.cod 
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

		public function get_poliza_total_by_asesor_enp_user($cod_asesor_user)
		    {
		      	$sql="SELECT *  FROM 
                    poliza
                  	INNER JOIN drecibo, titular, dcia, enp
                  	WHERE 
                  	poliza.id_poliza = drecibo.idrecibo AND
                  	poliza.id_titular = titular.id_titular AND
                  	poliza.id_cia = dcia.idcia AND
					poliza.codvend = enp.cod AND
					poliza.codvend = '$cod_asesor_user'
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

		public function get_poliza_total_by_asesor_enr()
		    {
		      	$sql="SELECT *  FROM 
                    poliza
                  	INNER JOIN drecibo, titular, dcia, enr
                  	WHERE 
                  	poliza.id_poliza = drecibo.idrecibo AND
                  	poliza.id_titular = titular.id_titular AND
                  	poliza.id_cia = dcia.idcia AND
					poliza.codvend = enr.cod 
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

		public function get_poliza_total_by_asesor_enr_user($cod_asesor_user)
		    {
		      	$sql="SELECT *  FROM 
                    poliza
                  	INNER JOIN drecibo, titular, dcia, enr
                  	WHERE 
                  	poliza.id_poliza = drecibo.idrecibo AND
                  	poliza.id_titular = titular.id_titular AND
                  	poliza.id_cia = dcia.idcia AND
					poliza.codvend = enr.cod AND
					poliza.codvend = '$cod_asesor_user'
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



		public function get_poliza_pre_carga($id_poliza)
		    {
		      	$sql="SELECT *  FROM 
				  	poliza
					INNER JOIN drecibo, titular, dveh
					WHERE 
					poliza.id_poliza = drecibo.idrecibo AND
					poliza.id_titular = titular.id_titular AND
					poliza.id_poliza = dveh.idveh AND
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



		public function get_prima_cobrada_asesor($codvend)
		    {
		      	$sql="SELECT SUM(prima_com)  FROM comision
						WHERE 
						cod_vend = '$codvend'";
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

		public function get_prima_cobrada_poliza($id_poliza)
		    {
		      	$sql="SELECT SUM(prima_com)  FROM comision
						WHERE 
						id_poliza = '$id_poliza'";
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





	public function get_poliza_total_by_filtro($mes,$anio,$cia,$asesor)
			{

			if ($anio=='') {
				$anio="('" . date("Y") ."')";
			}else {
				// create sql part for IN condition by imploding comma after each id
				$anio = "('" . implode("','", $anio) ."')";
			}
			

			if ($cia!='' && $asesor!='' && $mes!='') {
				// create sql part for IN condition by imploding comma after each id
				$ciaIn = "('" . implode("','", $cia) ."')";

				// create sql part for IN condition by imploding comma after each id
				$asesorIn = "('" . implode("','", $asesor) ."')";

				// create sql part for IN condition by imploding comma after each id
				$mesIn = "('" . implode("','", $mes) ."')";

				$sql="SELECT *  FROM 
						poliza
						INNER JOIN drecibo, titular, tipo_poliza, dcia, ena
						WHERE 
						poliza.id_poliza = drecibo.idrecibo AND
						poliza.id_tpoliza = tipo_poliza.id_t_poliza AND
						poliza.id_titular = titular.id_titular AND
						poliza.id_cia = dcia.idcia AND
						poliza.codvend = ena.cod AND
						YEAR(poliza.f_desdepoliza) IN $anio AND
						MONTH(poliza.f_desdepoliza) IN $mesIn AND
						dcia.nomcia IN ".$ciaIn." AND
						codvend  IN ".$asesorIn."  ";
			}//1
			if ($cia=='' && $asesor=='' && $mes=='') {
				$sql="SELECT *  FROM 
						poliza
						INNER JOIN drecibo, titular, tipo_poliza, dcia, ena
						WHERE 
						poliza.id_poliza = drecibo.idrecibo AND
						poliza.id_tpoliza = tipo_poliza.id_t_poliza AND
						poliza.id_titular = titular.id_titular AND
						poliza.id_cia = dcia.idcia AND
						poliza.codvend = ena.cod AND
						YEAR(poliza.f_desdepoliza) IN $anio  ";
			}//2
			if ($cia!='' && $asesor=='' && $mes=='') {

				// create sql part for IN condition by imploding comma after each id
				$ciaIn = "('" . implode("','", $cia) ."')";

				$sql="SELECT *  FROM 
						poliza
						INNER JOIN drecibo, titular, tipo_poliza, dcia, ena
						WHERE 
						poliza.id_poliza = drecibo.idrecibo AND
						poliza.id_tpoliza = tipo_poliza.id_t_poliza AND
						poliza.id_titular = titular.id_titular AND
						poliza.id_cia = dcia.idcia AND
						poliza.codvend = ena.cod AND
						YEAR(poliza.f_desdepoliza) IN $anio AND
						nomcia IN ".$ciaIn." ";
			}//3
			if ($cia=='' && $asesor!='' && $mes=='') {

				// create sql part for IN condition by imploding comma after each id
				$asesorIn = "('" . implode("','", $asesor) ."')";

				$sql="SELECT *  FROM 
						poliza
						INNER JOIN drecibo, titular, tipo_poliza, dcia, ena
						WHERE 
						poliza.id_poliza = drecibo.idrecibo AND
						poliza.id_tpoliza = tipo_poliza.id_t_poliza AND
						poliza.id_titular = titular.id_titular AND
						poliza.id_cia = dcia.idcia AND
						poliza.codvend = ena.cod AND
						YEAR(poliza.f_desdepoliza) IN $anio AND
						codvend  IN ".$asesorIn." ";
			}//4
			if ($cia=='' && $asesor=='' && $mes!='') {
				
				// create sql part for IN condition by imploding comma after each id
				$mesIn = "('" . implode("','", $mes) ."')";
				
				$sql="SELECT *  FROM 
						poliza
						INNER JOIN drecibo, titular, tipo_poliza, dcia, ena
						WHERE 
						poliza.id_poliza = drecibo.idrecibo AND
						poliza.id_tpoliza = tipo_poliza.id_t_poliza AND
						poliza.id_titular = titular.id_titular AND
						poliza.id_cia = dcia.idcia AND
						poliza.codvend = ena.cod AND
						YEAR(poliza.f_desdepoliza) IN $anio AND
						MONTH(poliza.f_desdepoliza) IN $mesIn  ";
			}//5
			if ($cia!='' && $asesor!='' && $mes=='') {
				// create sql part for IN condition by imploding comma after each id
				$ciaIn = "('" . implode("','", $cia) ."')";

				// create sql part for IN condition by imploding comma after each id
				$asesorIn = "('" . implode("','", $asesor) ."')";

				$sql="SELECT *  FROM 
							poliza
							INNER JOIN drecibo, titular, tipo_poliza, dcia, ena
							WHERE 
							poliza.id_poliza = drecibo.idrecibo AND
							poliza.id_tpoliza = tipo_poliza.id_t_poliza AND
							poliza.id_titular = titular.id_titular AND
							poliza.id_cia = dcia.idcia AND
							poliza.codvend = ena.cod AND
							YEAR(poliza.f_desdepoliza) IN $anio AND
							nomcia IN ".$ciaIn." AND
							codvend  IN ".$asesorIn." ";
			}//6
			if ($cia=='' && $asesor!='' && $mes!='') {
				// create sql part for IN condition by imploding comma after each id
				$asesorIn = "('" . implode("','", $asesor) ."')";

				// create sql part for IN condition by imploding comma after each id
				$mesIn = "('" . implode("','", $mes) ."')";

				$sql="SELECT *  FROM 
							poliza
							INNER JOIN drecibo, titular, tipo_poliza, dcia, ena
							WHERE 
							poliza.id_poliza = drecibo.idrecibo AND
							poliza.id_tpoliza = tipo_poliza.id_t_poliza AND
							poliza.id_titular = titular.id_titular AND
							poliza.id_cia = dcia.idcia AND
							poliza.codvend = ena.cod AND
							YEAR(poliza.f_desdepoliza) IN $anio AND
							MONTH(poliza.f_desdepoliza) IN $mesIn AND
							codvend  IN ".$asesorIn." ";
			}//7
			if ($cia!='' && $asesor=='' && $mes!='') {
				// create sql part for IN condition by imploding comma after each id
				$ciaIn = "('" . implode("','", $cia) ."')";

				// create sql part for IN condition by imploding comma after each id
				$mesIn = "('" . implode("','", $mes) ."')";

				$sql="SELECT *  FROM 
							poliza
							INNER JOIN drecibo, titular, tipo_poliza, dcia, ena
							WHERE 
							poliza.id_poliza = drecibo.idrecibo AND
							poliza.id_tpoliza = tipo_poliza.id_t_poliza AND
							poliza.id_titular = titular.id_titular AND
							poliza.id_cia = dcia.idcia AND
							poliza.codvend = ena.cod AND
							YEAR(poliza.f_desdepoliza) IN $anio AND
							MONTH(poliza.f_desdepoliza) IN $mesIn AND
							nomcia IN ".$ciaIn." ";
			}//8

			$res=mysqli_query(Conectar::con(),$sql);
			
			$filas=mysqli_num_rows($res); 
			if (!$res) {
				    //No hay registros
				}else{
					$filas=mysqli_num_rows($res); 
					if ($filas == 0) { 
						//echo "No hay registros";
				      	//header("Location: b_poliza.php?m=2");
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

		public function get_poliza_total_by_filtro_enr($mes,$anio,$cia,$asesor)
			{

			if ($anio=='') {
				$anio="('" . date("Y") ."')";
			}else {
				// create sql part for IN condition by imploding comma after each id
				$anio = "('" . implode("','", $anio) ."')";
			}
			

			if ($cia!='' && $asesor!='' && $mes!='') {
				// create sql part for IN condition by imploding comma after each id
				$ciaIn = "('" . implode("','", $cia) ."')";

				// create sql part for IN condition by imploding comma after each id
				$asesorIn = "('" . implode("','", $asesor) ."')";

				// create sql part for IN condition by imploding comma after each id
				$mesIn = "('" . implode("','", $mes) ."')";

				$sql="SELECT *  FROM 
						poliza
						INNER JOIN drecibo, titular, tipo_poliza, dcia, enr
						WHERE 
						poliza.id_poliza = drecibo.idrecibo AND
						poliza.id_tpoliza = tipo_poliza.id_t_poliza AND
						poliza.id_titular = titular.id_titular AND
						poliza.id_cia = dcia.idcia AND
						poliza.codvend = enr.cod AND
						YEAR(poliza.f_desdepoliza) IN $anio AND
						MONTH(poliza.f_desdepoliza) IN $mesIn AND
						dcia.nomcia IN ".$ciaIn." AND
						codvend  IN ".$asesorIn."  ";
			}//1
			if ($cia=='' && $asesor=='' && $mes=='') {
				$sql="SELECT *  FROM 
						poliza
						INNER JOIN drecibo, titular, tipo_poliza, dcia, enr
						WHERE 
						poliza.id_poliza = drecibo.idrecibo AND
						poliza.id_tpoliza = tipo_poliza.id_t_poliza AND
						poliza.id_titular = titular.id_titular AND
						poliza.id_cia = dcia.idcia AND
						poliza.codvend = enr.cod AND
						YEAR(poliza.f_desdepoliza) IN $anio  ";
			}//2
			if ($cia!='' && $asesor=='' && $mes=='') {

				// create sql part for IN condition by imploding comma after each id
				$ciaIn = "('" . implode("','", $cia) ."')";

				$sql="SELECT *  FROM 
						poliza
						INNER JOIN drecibo, titular, tipo_poliza, dcia, enr
						WHERE 
						poliza.id_poliza = drecibo.idrecibo AND
						poliza.id_tpoliza = tipo_poliza.id_t_poliza AND
						poliza.id_titular = titular.id_titular AND
						poliza.id_cia = dcia.idcia AND
						poliza.codvend = enr.cod AND
						YEAR(poliza.f_desdepoliza) IN $anio AND
						nomcia IN ".$ciaIn." ";
			}//3
			if ($cia=='' && $asesor!='' && $mes=='') {

				// create sql part for IN condition by imploding comma after each id
				$asesorIn = "('" . implode("','", $asesor) ."')";

				$sql="SELECT *  FROM 
						poliza
						INNER JOIN drecibo, titular, tipo_poliza, dcia, enr
						WHERE 
						poliza.id_poliza = drecibo.idrecibo AND
						poliza.id_tpoliza = tipo_poliza.id_t_poliza AND
						poliza.id_titular = titular.id_titular AND
						poliza.id_cia = dcia.idcia AND
						poliza.codvend = enr.cod AND
						YEAR(poliza.f_desdepoliza) IN $anio AND
						codvend  IN ".$asesorIn." ";
			}//4
			if ($cia=='' && $asesor=='' && $mes!='') {
				
				// create sql part for IN condition by imploding comma after each id
				$mesIn = "('" . implode("','", $mes) ."')";
				
				$sql="SELECT *  FROM 
						poliza
						INNER JOIN drecibo, titular, tipo_poliza, dcia, enr
						WHERE 
						poliza.id_poliza = drecibo.idrecibo AND
						poliza.id_tpoliza = tipo_poliza.id_t_poliza AND
						poliza.id_titular = titular.id_titular AND
						poliza.id_cia = dcia.idcia AND
						poliza.codvend = enr.cod AND
						YEAR(poliza.f_desdepoliza) IN $anio AND
						MONTH(poliza.f_desdepoliza) IN $mesIn  ";
			}//5
			if ($cia!='' && $asesor!='' && $mes=='') {
				// create sql part for IN condition by imploding comma after each id
				$ciaIn = "('" . implode("','", $cia) ."')";

				// create sql part for IN condition by imploding comma after each id
				$asesorIn = "('" . implode("','", $asesor) ."')";

				$sql="SELECT *  FROM 
							poliza
							INNER JOIN drecibo, titular, tipo_poliza, dcia, enr
							WHERE 
							poliza.id_poliza = drecibo.idrecibo AND
							poliza.id_tpoliza = tipo_poliza.id_t_poliza AND
							poliza.id_titular = titular.id_titular AND
							poliza.id_cia = dcia.idcia AND
							poliza.codvend = enr.cod AND
							YEAR(poliza.f_desdepoliza) IN $anio AND
							nomcia IN ".$ciaIn." AND
							codvend  IN ".$asesorIn." ";
			}//6
			if ($cia=='' && $asesor!='' && $mes!='') {
				// create sql part for IN condition by imploding comma after each id
				$asesorIn = "('" . implode("','", $asesor) ."')";

				// create sql part for IN condition by imploding comma after each id
				$mesIn = "('" . implode("','", $mes) ."')";

				$sql="SELECT *  FROM 
							poliza
							INNER JOIN drecibo, titular, tipo_poliza, dcia, enr
							WHERE 
							poliza.id_poliza = drecibo.idrecibo AND
							poliza.id_tpoliza = tipo_poliza.id_t_poliza AND
							poliza.id_titular = titular.id_titular AND
							poliza.id_cia = dcia.idcia AND
							poliza.codvend = enr.cod AND
							YEAR(poliza.f_desdepoliza) IN $anio AND
							MONTH(poliza.f_desdepoliza) IN $mesIn AND
							codvend  IN ".$asesorIn." ";
			}//7
			if ($cia!='' && $asesor=='' && $mes!='') {
				// create sql part for IN condition by imploding comma after each id
				$ciaIn = "('" . implode("','", $cia) ."')";

				// create sql part for IN condition by imploding comma after each id
				$mesIn = "('" . implode("','", $mes) ."')";

				$sql="SELECT *  FROM 
							poliza
							INNER JOIN drecibo, titular, tipo_poliza, dcia, enr
							WHERE 
							poliza.id_poliza = drecibo.idrecibo AND
							poliza.id_tpoliza = tipo_poliza.id_t_poliza AND
							poliza.id_titular = titular.id_titular AND
							poliza.id_cia = dcia.idcia AND
							poliza.codvend = enr.cod AND
							YEAR(poliza.f_desdepoliza) IN $anio AND
							MONTH(poliza.f_desdepoliza) IN $mesIn AND
							nomcia IN ".$ciaIn." ";
			}//8
			$res=mysqli_query(Conectar::con(),$sql);
			
			$filas=mysqli_num_rows($res); 
			if (!$res) {
					//No hay registros
				}else{
					$filas=mysqli_num_rows($res); 
					if ($filas == 0) { 
						//echo "No hay registros";
						//header("Location: b_poliza.php?m=2");
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

		public function get_poliza_total_by_filtro_enp($mes,$anio,$cia,$asesor)
			{

			if ($anio=='') {
				$anio="('" . date("Y") ."')";
			}else {
				// create sql part for IN condition by imploding comma after each id
				$anio = "('" . implode("','", $anio) ."')";
			}
			

			if ($cia!='' && $asesor!='' && $mes!='') {
				// create sql part for IN condition by imploding comma after each id
				$ciaIn = "('" . implode("','", $cia) ."')";

				// create sql part for IN condition by imploding comma after each id
				$asesorIn = "('" . implode("','", $asesor) ."')";

				// create sql part for IN condition by imploding comma after each id
				$mesIn = "('" . implode("','", $mes) ."')";

				$sql="SELECT *  FROM 
						poliza
						INNER JOIN drecibo, titular, tipo_poliza, dcia, enp
						WHERE 
						poliza.id_poliza = drecibo.idrecibo AND
						poliza.id_tpoliza = tipo_poliza.id_t_poliza AND
						poliza.id_titular = titular.id_titular AND
						poliza.id_cia = dcia.idcia AND
						poliza.codvend = enp.cod AND
						YEAR(poliza.f_desdepoliza) IN $anio AND
						MONTH(poliza.f_desdepoliza) IN $mesIn AND
						dcia.nomcia IN ".$ciaIn." AND
						codvend  IN ".$asesorIn."  ";
			}//1
			if ($cia=='' && $asesor=='' && $mes=='') {
				$sql="SELECT *  FROM 
						poliza
						INNER JOIN drecibo, titular, tipo_poliza, dcia, enp
						WHERE 
						poliza.id_poliza = drecibo.idrecibo AND
						poliza.id_tpoliza = tipo_poliza.id_t_poliza AND
						poliza.id_titular = titular.id_titular AND
						poliza.id_cia = dcia.idcia AND
						poliza.codvend = enp.cod AND
						YEAR(poliza.f_desdepoliza) IN $anio  ";
			}//2
			if ($cia!='' && $asesor=='' && $mes=='') {

				// create sql part for IN condition by imploding comma after each id
				$ciaIn = "('" . implode("','", $cia) ."')";

				$sql="SELECT *  FROM 
						poliza
						INNER JOIN drecibo, titular, tipo_poliza, dcia, enp
						WHERE 
						poliza.id_poliza = drecibo.idrecibo AND
						poliza.id_tpoliza = tipo_poliza.id_t_poliza AND
						poliza.id_titular = titular.id_titular AND
						poliza.id_cia = dcia.idcia AND
						poliza.codvend = enp.cod AND
						YEAR(poliza.f_desdepoliza) IN $anio AND
						nomcia IN ".$ciaIn." ";
			}//3
			if ($cia=='' && $asesor!='' && $mes=='') {

				// create sql part for IN condition by imploding comma after each id
				$asesorIn = "('" . implode("','", $asesor) ."')";

				$sql="SELECT *  FROM 
						poliza
						INNER JOIN drecibo, titular, tipo_poliza, dcia, enp
						WHERE 
						poliza.id_poliza = drecibo.idrecibo AND
						poliza.id_tpoliza = tipo_poliza.id_t_poliza AND
						poliza.id_titular = titular.id_titular AND
						poliza.id_cia = dcia.idcia AND
						poliza.codvend = enp.cod AND
						YEAR(poliza.f_desdepoliza) IN $anio AND
						codvend  IN ".$asesorIn." ";
			}//4
			if ($cia=='' && $asesor=='' && $mes!='') {
				
				// create sql part for IN condition by imploding comma after each id
				$mesIn = "('" . implode("','", $mes) ."')";
				
				$sql="SELECT *  FROM 
						poliza
						INNER JOIN drecibo, titular, tipo_poliza, dcia, enp
						WHERE 
						poliza.id_poliza = drecibo.idrecibo AND
						poliza.id_tpoliza = tipo_poliza.id_t_poliza AND
						poliza.id_titular = titular.id_titular AND
						poliza.id_cia = dcia.idcia AND
						poliza.codvend = enp.cod AND
						YEAR(poliza.f_desdepoliza) IN $anio AND
						MONTH(poliza.f_desdepoliza) IN $mesIn  ";
			}//5
			if ($cia!='' && $asesor!='' && $mes=='') {
				// create sql part for IN condition by imploding comma after each id
				$ciaIn = "('" . implode("','", $cia) ."')";

				// create sql part for IN condition by imploding comma after each id
				$asesorIn = "('" . implode("','", $asesor) ."')";

				$sql="SELECT *  FROM 
							poliza
							INNER JOIN drecibo, titular, tipo_poliza, dcia, enp
							WHERE 
							poliza.id_poliza = drecibo.idrecibo AND
							poliza.id_tpoliza = tipo_poliza.id_t_poliza AND
							poliza.id_titular = titular.id_titular AND
							poliza.id_cia = dcia.idcia AND
							poliza.codvend = enp.cod AND
							YEAR(poliza.f_desdepoliza) IN $anio AND
							nomcia IN ".$ciaIn." AND
							codvend  IN ".$asesorIn." ";
			}//6
			if ($cia=='' && $asesor!='' && $mes!='') {
				// create sql part for IN condition by imploding comma after each id
				$asesorIn = "('" . implode("','", $asesor) ."')";

				// create sql part for IN condition by imploding comma after each id
				$mesIn = "('" . implode("','", $mes) ."')";

				$sql="SELECT *  FROM 
							poliza
							INNER JOIN drecibo, titular, tipo_poliza, dcia, enp
							WHERE 
							poliza.id_poliza = drecibo.idrecibo AND
							poliza.id_tpoliza = tipo_poliza.id_t_poliza AND
							poliza.id_titular = titular.id_titular AND
							poliza.id_cia = dcia.idcia AND
							poliza.codvend = enp.cod AND
							YEAR(poliza.f_desdepoliza) IN $anio AND
							MONTH(poliza.f_desdepoliza) IN $mesIn AND
							codvend  IN ".$asesorIn." ";
			}//7
			if ($cia!='' && $asesor=='' && $mes!='') {
				// create sql part for IN condition by imploding comma after each id
				$ciaIn = "('" . implode("','", $cia) ."')";

				// create sql part for IN condition by imploding comma after each id
				$mesIn = "('" . implode("','", $mes) ."')";

				$sql="SELECT *  FROM 
							poliza
							INNER JOIN drecibo, titular, tipo_poliza, dcia, enp
							WHERE 
							poliza.id_poliza = drecibo.idrecibo AND
							poliza.id_tpoliza = tipo_poliza.id_t_poliza AND
							poliza.id_titular = titular.id_titular AND
							poliza.id_cia = dcia.idcia AND
							poliza.codvend = enp.cod AND
							YEAR(poliza.f_desdepoliza) IN $anio AND
							MONTH(poliza.f_desdepoliza) IN $mesIn AND
							nomcia IN ".$ciaIn." ";
			}//8
			$res=mysqli_query(Conectar::con(),$sql);
			
			$filas=mysqli_num_rows($res); 
			if (!$res) {
					//No hay registros
				}else{
					$filas=mysqli_num_rows($res); 
					if ($filas == 0) { 
						//echo "No hay registros";
						//header("Location: b_poliza.php?m=2");
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

	public function get_poliza_total_by_filtro_f_product($f_desde,$f_hasta)
		{
				$sql="SELECT *  FROM 
								poliza
								INNER JOIN drecibo, titular, tipo_poliza, dcia
								WHERE 
								poliza.id_poliza = drecibo.idrecibo AND
								poliza.id_tpoliza = tipo_poliza.id_t_poliza AND
								drecibo.idtitu = titular.id_titular AND
								poliza.f_poliza >= '$f_desde' AND
								poliza.f_poliza <= '$f_hasta' AND
                    			poliza.id_cia = dcia.idcia
								ORDER BY poliza.id_poliza DESC";
		$res=mysqli_query(Conectar::con(),$sql);
		
		$filas=mysqli_num_rows($res); 
		if (!$res) {
				//No hay registros
			}else{
				$filas=mysqli_num_rows($res); 
				if ($filas == 0) { 
					echo "No hay registros";
					  header("Location: b_f_product.php?m=2");
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

			if ($cia!='') {
				// create sql part for IN condition by imploding comma after each id
				$ciaIn = "('" . implode("','", $cia) ."')";

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
				nomcia IN ".$ciaIn."
				ORDER BY poliza.codvend ASC";
			}
			if ($cia=='') {
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
				poliza.f_hastapoliza <= '$f_hasta'
				ORDER BY poliza.codvend ASC";
			}

			$res=mysqli_query(Conectar::con(),$sql);
			
			$filas=mysqli_num_rows($res); 
			if (!$res) {
				    //No hay registros
				}else{
					$filas=mysqli_num_rows($res); 
					if ($filas == 0) { 
						echo "No hay registros";
				      	header("Location: b_renov_por_asesor.php?m=2#nombre");
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

	public function get_poliza_total_by_filtro_renov_distinct_c($f_desde,$f_hasta, $asesor)
			{
				
				if ($asesor!='') {
					
					// create sql part for IN condition by imploding comma after each id
					$asesorIn = "('" . implode("','", $asesor) ."')";

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
					codvend IN ".$asesorIn."
					ORDER BY nomcia ASC";
				}
				if ($asesor=='') {
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
				}
			$res=mysqli_query(Conectar::con(),$sql);
			
			$filas=mysqli_num_rows($res); 
			if (!$res) {
				    //No hay registros
				}else{
					$filas=mysqli_num_rows($res); 
					if ($filas == 0) { 
						echo "No hay registros";
				      	header("Location: b_renov_por_cia.php?m=2");
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

		if ($cia!='' && $asesor!='') {
			// create sql part for IN condition by imploding comma after each id
			$ciaIn = "('" . implode("','", $cia) ."')";

			// create sql part for IN condition by imploding comma after each id
			$asesorIn = "('" . implode("','", $asesor) ."')";

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
						nomcia IN ".$ciaIn." AND
						codvend  IN ".$asesorIn." 
						ORDER BY nomcia ASC";
		}
		if ($cia=='' && $asesor=='') {
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
		}
		if ($cia=='' && $asesor!='') {

			// create sql part for IN condition by imploding comma after each id
			$asesorIn = "('" . implode("','", $asesor) ."')";

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
						codvend  IN ".$asesorIn." 
						ORDER BY nomcia ASC";
		}
		if ($asesor=='' && $cia!='') {

			// create sql part for IN condition by imploding comma after each id
			$ciaIn = "('" . implode("','", $cia) ."')";

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
						nomcia IN ".$ciaIn." 
						ORDER BY nomcia ASC";
		}

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


	public function get_poliza_total_by_filtro_renov_distinct_ac_correo($f_desde,$f_hasta,$cia,$asesor)
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
			if ($cia!='') {
				// create sql part for IN condition by imploding comma after each id
				$ciaIn = "('" . implode("','", $cia) ."')";

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
				nomcia IN ".$ciaIn."
				ORDER BY poliza.f_hastapoliza ASC";
			}
			if ($cia=='') {
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
				poliza.codvend = '$asesor'
				ORDER BY poliza.f_hastapoliza ASC";
			}
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

		public function get_poliza_total_by_filtro_renov_c($f_desde,$f_hasta,$cia,$asesor)
			{

				if ($asesor!='') {
					// create sql part for IN condition by imploding comma after each id
					$asesorIn = "('" . implode("','", $asesor) ."')";

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
						nomcia LIKE '%$cia%' AND
						codvend IN ".$asesorIn."
						ORDER BY poliza.f_hastapoliza ASC";
				}
				if ($asesor=='') {
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
						nomcia LIKE '%$cia%'
						ORDER BY poliza.f_hastapoliza ASC";
				}
				
			$res=mysqli_query(Conectar::con(),$sql);
			
			$filas=mysqli_num_rows($res); 
			if (!$res) {
				    //No hay registros
				}else{
					$filas=mysqli_num_rows($res); 
					if ($filas == 0) { 
						echo "No hay registros";
				      	header("Location: b_renov_por_cia.php?m=2");
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

		if ($cia!='' && $asesor!='') {
			// create sql part for IN condition by imploding comma after each id
			$ciaIn = "('" . implode("','", $cia) ."')";

			// create sql part for IN condition by imploding comma after each id
			$asesorIn = "('" . implode("','", $asesor) ."')";

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
						nomcia IN ".$ciaIn." AND
						codvend  IN ".$asesorIn." 
						ORDER BY poliza.f_hastapoliza ASC";
		}
		if ($cia=='' && $asesor=='') {
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
						poliza.f_hastapoliza <= '$f_hasta'
						ORDER BY poliza.f_hastapoliza ASC";
		}
		if ($cia=='' && $asesor!='') {

			// create sql part for IN condition by imploding comma after each id
			$asesorIn = "('" . implode("','", $asesor) ."')";

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
						codvend  IN ".$asesorIn." 
						ORDER BY poliza.f_hastapoliza ASC";
		}
		if ($asesor=='' && $cia!='') {

			// create sql part for IN condition by imploding comma after each id
			$ciaIn = "('" . implode("','", $cia) ."')";

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
						nomcia IN ".$ciaIn." 
						ORDER BY poliza.f_hastapoliza ASC";
		}

		$res=mysqli_query(Conectar::con(),$sql);
		
		$filas=mysqli_num_rows($res); 
		if (!$res) {
				//No hay registros
			}else{
				$filas=mysqli_num_rows($res); 
				if ($filas == 0) { 
					  //echo "No hay registros";
					  //header("Location: renov_g.php?m=2");
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



	public function get_poliza_total_by_filtro_renov_ac_correo($f_desde,$f_hasta,$cia,$asesor)
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
					nomcia  = '$cia'
					ORDER BY poliza.f_hastapoliza ASC";

		$res=mysqli_query(Conectar::con(),$sql);
		
		$filas=mysqli_num_rows($res); 
		if (!$res) {
				//No hay registros
			}else{
				$filas=mysqli_num_rows($res); 
				if ($filas == 0) { 
					  //echo "No hay registros";
					  //header("Location: renov_g.php?m=2");
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




	public function get__last_poliza_by_id($cod_poliza)
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
					drecibo.idtitu = titular.id_titular AND
					poliza.id_titular = '0'
				  ORDER BY poliza.id_poliza ASC";
			  $res=mysqli_query(Conectar::con(),$sql);
			  
			  if (!$res) {
				  //No hay registros
			  }else{
				  $filas=mysqli_num_rows($res); 
				  if ($filas == 0) { 
						//header("Location: incorrecto.php?m=2");
						echo "NO HAY PÓLIZAS PENDIENTES";
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
			




	public function get_poliza_total_by_filtro_status_a($fecha)
			{
					$sql="SELECT DISTINCT id_poliza 
					FROM ( 
							SELECT DISTINCT id_poliza 
							FROM poliza 
							WHERE
							poliza.f_hastapoliza >= '$fecha'
							UNION ALL 
							SELECT DISTINCT poliza.id_poliza 
							FROM poliza, comision 
							WHERE 
							poliza.id_poliza = comision.id_poliza AND
							poliza.f_hastapoliza >= '$fecha'
					) t
					GROUP BY id_poliza 
					HAVING COUNT(*) > 1";
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


	public function get_poliza_total_by_filtro_status_i($fecha)
		{
				$sql="SELECT DISTINCT id_poliza 
				FROM ( 
						SELECT DISTINCT id_poliza 
						FROM poliza
						WHERE
						poliza.f_hastapoliza < '$fecha' 
						UNION ALL 
						SELECT DISTINCT poliza.id_poliza 
						FROM poliza, comision 
						WHERE poliza.id_poliza = comision.id_poliza AND
						poliza.f_hastapoliza < '$fecha' 
				) t
				GROUP BY id_poliza 
				HAVING COUNT(*) > 1";
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




	public function get_poliza_rep_com($id_poliza)
	    {
	      	$sql="SELECT f_hasta_rep FROM comision 
					INNER JOIN rep_com
					WHERE 
					comision.id_rep_com = rep_com.id_rep_com AND
					id_poliza = '$id_poliza'";
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











	public function get_poliza_by_busq($busq,$asesor)
		{
			if ($asesor=='') {
				$sql="SELECT * FROM
					poliza, drecibo, titular, dramo, dcia
					WHERE
					poliza.id_poliza = drecibo.idrecibo AND
					poliza.id_titular = titular.id_titular AND 
					poliza.id_cod_ramo = dramo.cod_ramo AND
					poliza.id_cia = dcia.idcia AND
					poliza.cod_poliza LIKE '%$busq%'
					
					UNION ALL
					
					SELECT * FROM
					poliza, drecibo, titular, dramo, dcia
					WHERE
					poliza.id_poliza = drecibo.idrecibo AND
					poliza.id_titular = titular.id_titular AND 
					poliza.id_cod_ramo = dramo.cod_ramo AND
					poliza.id_cia = dcia.idcia AND
					titular.ci LIKE '%$busq%'
					
					UNION ALL
					
					SELECT * FROM
					poliza, drecibo, titular, dramo, dcia
					WHERE
					poliza.id_poliza = drecibo.idrecibo AND
					poliza.id_titular = titular.id_titular AND 
					poliza.id_cod_ramo = dramo.cod_ramo AND
					poliza.id_cia = dcia.idcia AND
					titular.nombre_t LIKE '%$busq%'
					
					UNION ALL
					
					SELECT * FROM
					poliza, drecibo, titular, dramo, dcia
					WHERE
					poliza.id_poliza = drecibo.idrecibo AND
					poliza.id_titular = titular.id_titular AND 
					poliza.id_cod_ramo = dramo.cod_ramo AND
					poliza.id_cia = dcia.idcia AND
					titular.apellido_t LIKE '%$busq%'
					";
			}else {
				$sql="SELECT * FROM
					poliza, drecibo, titular, dramo, dcia
					WHERE
					poliza.id_poliza = drecibo.idrecibo AND
					poliza.id_titular = titular.id_titular AND 
					poliza.id_cod_ramo = dramo.cod_ramo AND
					poliza.id_cia = dcia.idcia AND
					poliza.codvend = '$asesor' AND
					poliza.cod_poliza LIKE '%$busq%'
					
					UNION ALL
					
					SELECT * FROM
					poliza, drecibo, titular, dramo, dcia
					WHERE
					poliza.id_poliza = drecibo.idrecibo AND
					poliza.id_titular = titular.id_titular AND 
					poliza.id_cod_ramo = dramo.cod_ramo AND
					poliza.id_cia = dcia.idcia AND
					poliza.codvend = '$asesor' AND
					titular.ci LIKE '%$busq%'
					
					UNION ALL
					
					SELECT * FROM
					poliza, drecibo, titular, dramo, dcia
					WHERE
					poliza.id_poliza = drecibo.idrecibo AND
					poliza.id_titular = titular.id_titular AND 
					poliza.id_cod_ramo = dramo.cod_ramo AND
					poliza.id_cia = dcia.idcia AND
					poliza.codvend = '$asesor' AND
					titular.nombre_t LIKE '%$busq%'
					
					UNION ALL
					
					SELECT * FROM
					poliza, drecibo, titular, dramo, dcia
					WHERE
					poliza.id_poliza = drecibo.idrecibo AND
					poliza.id_titular = titular.id_titular AND 
					poliza.id_cod_ramo = dramo.cod_ramo AND
					poliza.id_cia = dcia.idcia AND
					poliza.codvend = '$asesor' AND
					titular.apellido_t LIKE '%$busq%'
					";
			}
				
		$res=mysqli_query(Conectar::con(),$sql);
		
		$filas=mysqli_num_rows($res); 
		if (!$res) {
				//No hay registros
			}else{
				$filas=mysqli_num_rows($res); 
				if ($filas == 0) { 
					//echo "No hay registros";
					  //header("Location: b_f_product.php?m=2");
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





	public function get_f_cia_pref($campo,$id_cia)
		{
				$sql="SELECT DISTINCT $campo FROM cia_pref WHERE id_cia=$id_cia ORDER BY $campo DESC";
		$res=mysqli_query(Conectar::con(),$sql);
		
		$filas=mysqli_num_rows($res); 
		if (!$res) {
				//No hay registros
			}else{
				$filas=mysqli_num_rows($res); 
				if ($filas == 0) { 
					//echo "No hay registros";
					  //header("Location: b_f_product.php?m=2");
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




	public function get_gc_by_filtro_distinct_a($f_desde,$f_hasta,$cia,$asesor)
			{
				
				

				if ($cia!='' && $asesor!='') {
					// create sql part for IN condition by imploding comma after each id
					$ciaIn = "('" . implode("','", $cia) ."')";

					// create sql part for IN condition by imploding comma after each id
					$asesorIn = "('" . implode("','", $asesor) ."')";

					$sql="SELECT DISTINCT codvend FROM 
								comision
								INNER JOIN poliza, rep_com, dcia
								WHERE 
								poliza.id_poliza = comision.id_poliza AND
								comision.id_rep_com = rep_com.id_rep_com AND
								poliza.id_cia=dcia.idcia AND
								rep_com.f_pago_gc >= '$f_desde' AND
								rep_com.f_pago_gc <= '$f_hasta' AND
								nomcia IN ".$ciaIn." AND
								codvend  IN ".$asesorIn." AND
                            	not exists (select 1 from gc_h_comision where gc_h_comision.id_comision = comision.id_comision)
								ORDER BY comision.cod_vend ASC";
				}
				if ($cia=='' && $asesor=='') {
					$sql="SELECT DISTINCT codvend FROM 
							comision
							INNER JOIN poliza, rep_com, dcia
							WHERE 
							poliza.id_poliza = comision.id_poliza AND
							comision.id_rep_com = rep_com.id_rep_com AND
							poliza.id_cia=dcia.idcia AND
							rep_com.f_pago_gc >= '$f_desde' AND
							rep_com.f_pago_gc <= '$f_hasta' AND
							nomcia LIKE '%$cia%' AND
							codvend  LIKE '%$asesor%' AND
                            not exists (select 1 from gc_h_comision where gc_h_comision.id_comision = comision.id_comision)
							ORDER BY comision.cod_vend ASC";
				}
				if ($cia=='' && $asesor!='') {

					// create sql part for IN condition by imploding comma after each id
					$asesorIn = "('" . implode("','", $asesor) ."')";

					$sql="SELECT DISTINCT codvend FROM 
							comision
							INNER JOIN poliza, rep_com, dcia
							WHERE 
							poliza.id_poliza = comision.id_poliza AND
							comision.id_rep_com = rep_com.id_rep_com AND
							poliza.id_cia=dcia.idcia AND
							rep_com.f_pago_gc >= '$f_desde' AND
							rep_com.f_pago_gc <= '$f_hasta' AND
							nomcia LIKE '%$cia%' AND
							codvend  IN ".$asesorIn." AND
                            not exists (select 1 from gc_h_comision where gc_h_comision.id_comision = comision.id_comision)
							ORDER BY comision.cod_vend ASC";
				}
				if ($asesor=='' && $cia!='') {

					// create sql part for IN condition by imploding comma after each id
					$ciaIn = "('" . implode("','", $cia) ."')";

					$sql="SELECT DISTINCT codvend FROM 
							comision
							INNER JOIN poliza, rep_com, dcia
							WHERE 
							poliza.id_poliza = comision.id_poliza AND
							comision.id_rep_com = rep_com.id_rep_com AND
							poliza.id_cia=dcia.idcia AND
							rep_com.f_pago_gc >= '$f_desde' AND
							rep_com.f_pago_gc <= '$f_hasta' AND
							codvend LIKE '%$asesor%' AND
							nomcia  IN ".$ciaIn." AND
                            not exists (select 1 from gc_h_comision where gc_h_comision.id_comision = comision.id_comision)
							ORDER BY comision.cod_vend ASC";
				}
				
				
			$res=mysqli_query(Conectar::con(),$sql);
			
			$filas=mysqli_num_rows($res); 
			if (!$res) {
				    //No hay registros
				}else{
					$filas=mysqli_num_rows($res); 
					if ($filas == 0) { 
						echo "No hay registros";
				      	header("Location: ../Admin/gc/b_gc.php?m=2");
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

		public function get_gc_by_filtro_distinct_a_carga($f_desde,$f_hasta,$cia,$asesor)
			{
				
				

				if ($cia!='' && $asesor!='') {
					// create sql part for IN condition by imploding comma after each id
					$ciaIn = "('" . implode("','", $cia) ."')";

					// create sql part for IN condition by imploding comma after each id
					$asesorIn = "('" . implode("','", $asesor) ."')";

					$sql="SELECT DISTINCT codvend FROM 
								comision
								INNER JOIN poliza, rep_com, dcia
								WHERE 
								poliza.id_poliza = comision.id_poliza AND
								comision.id_rep_com = rep_com.id_rep_com AND
								poliza.id_cia=dcia.idcia AND
								rep_com.f_pago_gc >= '$f_desde' AND
								rep_com.f_pago_gc <= '$f_hasta' AND
								nomcia IN ".$ciaIn." AND
								codvend  IN ".$asesorIn." AND
                            	not exists (select 1 from gc_h_comision where gc_h_comision.id_comision = comision.id_comision)
								ORDER BY comision.cod_vend ASC";
				}
				if ($cia=='' && $asesor=='') {
					$sql="SELECT DISTINCT codvend FROM 
							comision
							INNER JOIN poliza, rep_com, dcia
							WHERE 
							poliza.id_poliza = comision.id_poliza AND
							comision.id_rep_com = rep_com.id_rep_com AND
							poliza.id_cia=dcia.idcia AND
							rep_com.f_pago_gc >= '$f_desde' AND
							rep_com.f_pago_gc <= '$f_hasta' AND
							nomcia LIKE '%$cia%' AND
							codvend  LIKE '%$asesor%' AND
                            not exists (select 1 from gc_h_comision where gc_h_comision.id_comision = comision.id_comision)
							ORDER BY comision.cod_vend ASC";
				}
				if ($cia=='' && $asesor!='') {

					// create sql part for IN condition by imploding comma after each id
					$asesorIn = "('" . implode("','", $asesor) ."')";

					$sql="SELECT DISTINCT codvend FROM 
							comision
							INNER JOIN poliza, rep_com, dcia
							WHERE 
							poliza.id_poliza = comision.id_poliza AND
							comision.id_rep_com = rep_com.id_rep_com AND
							poliza.id_cia=dcia.idcia AND
							rep_com.f_pago_gc >= '$f_desde' AND
							rep_com.f_pago_gc <= '$f_hasta' AND
							nomcia LIKE '%$cia%' AND
							codvend  IN ".$asesorIn." AND
                            not exists (select 1 from gc_h_comision where gc_h_comision.id_comision = comision.id_comision)
							ORDER BY comision.cod_vend ASC";
				}
				if ($asesor=='' && $cia!='') {

					// create sql part for IN condition by imploding comma after each id
					$ciaIn = "('" . implode("','", $cia) ."')";

					$sql="SELECT DISTINCT codvend FROM 
							comision
							INNER JOIN poliza, rep_com, dcia
							WHERE 
							poliza.id_poliza = comision.id_poliza AND
							comision.id_rep_com = rep_com.id_rep_com AND
							poliza.id_cia=dcia.idcia AND
							rep_com.f_pago_gc >= '$f_desde' AND
							rep_com.f_pago_gc <= '$f_hasta' AND
							codvend LIKE '%$asesor%' AND
							nomcia  IN ".$ciaIn." AND
                            not exists (select 1 from gc_h_comision where gc_h_comision.id_comision = comision.id_comision)
							ORDER BY comision.cod_vend ASC";
				}
				
				
			$res=mysqli_query(Conectar::con(),$sql);
			
			$filas=mysqli_num_rows($res); 
			if (!$res) {
				    //No hay registros
				}else{
					$filas=mysqli_num_rows($res); 
					if ($filas == 0) { 
						//echo "No hay registros";
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
				if ($cia!='') {
					// create sql part for IN condition by imploding comma after each id
					$ciaIn = "('" . implode("','", $cia) ."')";

					$sql="SELECT poliza.cod_poliza, sumaasegurada, prima, prima_com, comision, per_gc, f_desdepoliza, f_hastapoliza, currency, poliza.id_titular, poliza.id_poliza, nombre_t, apellido_t, nomcia, f_pago_prima, f_hasta_rep, id_comision, nramo FROM comision 
							INNER JOIN drecibo, titular, tipo_poliza, dcia, dramo, poliza, rep_com 
							WHERE poliza.id_poliza = drecibo.idrecibo AND 
							poliza.id_tpoliza = tipo_poliza.id_t_poliza AND 
							poliza.idtitu = titular.id_titular AND
							poliza.id_cia = dcia.idcia AND
							poliza.id_cod_ramo = dramo.cod_ramo AND
							poliza.id_poliza = comision.id_poliza AND
							comision.id_rep_com = rep_com.id_rep_com AND 
							rep_com.f_pago_gc >= '$f_desde' AND
							rep_com.f_pago_gc <= '$f_hasta' AND
							poliza.codvend = '$asesor' AND 
							nomcia IN ".$ciaIn." AND
              not exists (select 1 from gc_h_comision where gc_h_comision.id_comision = comision.id_comision)
							ORDER BY poliza.cod_poliza ASC";
				}

				if ($cia=='') {
					$sql="SELECT poliza.cod_poliza, sumaasegurada, prima, prima_com, comision, per_gc, f_desdepoliza, f_hastapoliza, currency, poliza.id_titular, poliza.id_poliza, nombre_t, apellido_t, nomcia, f_pago_prima, f_hasta_rep, id_comision, nramo
							FROM comision 
							INNER JOIN drecibo, titular, tipo_poliza, dcia, dramo, poliza, rep_com 
							WHERE poliza.id_poliza = drecibo.idrecibo AND 
							poliza.id_tpoliza = tipo_poliza.id_t_poliza AND 
							poliza.idtitu = titular.id_titular AND
							poliza.id_cia = dcia.idcia AND
							poliza.id_cod_ramo = dramo.cod_ramo AND
							poliza.id_poliza = comision.id_poliza AND
							comision.id_rep_com = rep_com.id_rep_com AND 
							rep_com.f_pago_gc >= '$f_desde' AND
							rep_com.f_pago_gc <= '$f_hasta' AND
							poliza.codvend = '$asesor' AND 
              not exists (select 1 from gc_h_comision where gc_h_comision.id_comision = comision.id_comision)
							ORDER BY poliza.cod_poliza ASC";
				}
				
			$res=mysqli_query(Conectar::con(),$sql);
			
			$filas=mysqli_num_rows($res); 
			if (!$res) {
				    //No hay registros
				}else{
					$filas=mysqli_num_rows($res); 
					if ($filas == 0) { 
						//echo "No hay registros";
				      	//header("Location: b_gc.php?m=2");
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



















		public function get_poliza_total_by_filtro_asesor($f_desde,$f_hasta,$asesor)
			{
				

		// create sql part for IN condition by imploding comma after each id
		$asesorIn = "('" . implode("','", $asesor) ."')";
		
		
					$sql="SELECT *  FROM 
									poliza
									INNER JOIN drecibo, titular, tipo_poliza, dcia
									WHERE 
									poliza.id_poliza = drecibo.idrecibo AND
									poliza.id_tpoliza = tipo_poliza.id_t_poliza AND
									drecibo.idtitu = titular.id_titular AND
									poliza.f_hastapoliza >= '$f_desde' AND
									poliza.f_hastapoliza <= '$f_hasta'AND
                  					poliza.id_cia = dcia.idcia AND
									codvend IN " . $asesorIn ."
									ORDER BY poliza.id_poliza ASC";
				
			$res=mysqli_query(Conectar::con(),$sql);
			
			$filas=mysqli_num_rows($res); 
			if (!$res) {
				    //No hay registros
				}else{
					$filas=mysqli_num_rows($res); 
					if ($filas == 0) { 
						echo "No hay registros";
				      	//header("Location: b_poliza.php?m=2");
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


		public function get_per_gc_cia_pref($f_desde,$id_cia,$cod)
			{
					$sql="SELECT *  FROM 
									cia_pref
									WHERE 
									f_hasta_pref >= '$f_desde' AND
									f_desde_pref <= '$f_desde'AND
                  					id_cia = $id_cia AND
									cod_vend = '$cod'
									ORDER BY id_cia_pref DESC";
				$res=mysqli_query(Conectar::con(),$sql);
				
				$filas=mysqli_num_rows($res); 
				if (!$res) {
							//No hay registros
					}else{
						$filas=mysqli_num_rows($res); 
						if ($filas == 0) { 
							//echo "No hay registros";
									//header("Location: b_poliza.php?m=2");
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
	public function get_distinct_element_ramo($desde,$hasta,$cia,$tipo_cuenta)
		  {
		    
				if ($cia!='' && $tipo_cuenta!='') {
					// create sql part for IN condition by imploding comma after each id
					$ciaIn = "('" . implode("','", $cia) ."')";

					// create sql part for IN condition by imploding comma after each id
					$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";

					$sql="SELECT DISTINCT dramo.nramo FROM poliza 
								INNER JOIN dramo, dcia WHERE 
								poliza.id_cod_ramo=dramo.cod_ramo AND
								poliza.id_cia=dcia.idcia AND
								f_hastapoliza >= '$desde' AND
		      					f_hastapoliza <= '$hasta' AND
								nomcia IN ".$ciaIn." AND
								t_cuenta  IN ".$tipo_cuentaIn." 
								ORDER BY dramo.nramo ASC";
				}
				if ($cia=='' && $tipo_cuenta=='') {
					$sql="SELECT DISTINCT dramo.nramo FROM poliza 
							INNER JOIN dramo, dcia WHERE 
							poliza.id_cod_ramo=dramo.cod_ramo AND
							poliza.id_cia=dcia.idcia AND
							f_hastapoliza >= '$desde' AND
							f_hastapoliza <= '$hasta'
							ORDER BY dramo.nramo ASC";
				}
				if ($cia=='' && $tipo_cuenta!='') {

					// create sql part for IN condition by imploding comma after each id
					$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";

					$sql="SELECT DISTINCT dramo.nramo FROM poliza 
							INNER JOIN dramo, dcia WHERE 
							poliza.id_cod_ramo=dramo.cod_ramo AND
							poliza.id_cia=dcia.idcia AND
							f_hastapoliza >= '$desde' AND
							f_hastapoliza <= '$hasta' AND
							t_cuenta  IN ".$tipo_cuentaIn." 
							ORDER BY dramo.nramo ASC";
				}
				if ($tipo_cuenta=='' && $cia!='') {

					// create sql part for IN condition by imploding comma after each id
					$ciaIn = "('" . implode("','", $cia) ."')";

					$sql="SELECT DISTINCT dramo.nramo FROM poliza 
							INNER JOIN dramo, dcia WHERE 
							poliza.id_cod_ramo=dramo.cod_ramo AND
							poliza.id_cia=dcia.idcia AND
							f_hastapoliza >= '$desde' AND
							f_hastapoliza <= '$hasta' AND
							nomcia IN ".$ciaIn."
							ORDER BY dramo.nramo ASC";
				}


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

		public function get_distinct_element_ramo_by_user($desde,$hasta,$cia,$tipo_cuenta,$asesor)
			{
			  
				  if ($cia!='' && $tipo_cuenta!='') {
					  // create sql part for IN condition by imploding comma after each id
					  $ciaIn = "('" . implode("','", $cia) ."')";
  
					  // create sql part for IN condition by imploding comma after each id
					  $tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";
  
					  $sql="SELECT DISTINCT dramo.nramo FROM poliza 
								  INNER JOIN dramo, dcia WHERE 
								  poliza.id_cod_ramo=dramo.cod_ramo AND
								  poliza.id_cia=dcia.idcia AND
								  f_hastapoliza >= '$desde' AND
								  f_hastapoliza <= '$hasta' AND
								  poliza.codvend = '$asesor' AND
								  nomcia IN ".$ciaIn." AND
								  t_cuenta  IN ".$tipo_cuentaIn." 
								  ORDER BY dramo.nramo ASC";
				  }
				  if ($cia=='' && $tipo_cuenta=='') {
					  $sql="SELECT DISTINCT dramo.nramo FROM poliza 
							  INNER JOIN dramo, dcia WHERE 
							  poliza.id_cod_ramo=dramo.cod_ramo AND
							  poliza.id_cia=dcia.idcia AND
							  poliza.codvend = '$asesor' AND
							  f_hastapoliza >= '$desde' AND
							  f_hastapoliza <= '$hasta'
							  ORDER BY dramo.nramo ASC";
				  }
				  if ($cia=='' && $tipo_cuenta!='') {
  
					  // create sql part for IN condition by imploding comma after each id
					  $tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";
  
					  $sql="SELECT DISTINCT dramo.nramo FROM poliza 
							  INNER JOIN dramo, dcia WHERE 
							  poliza.id_cod_ramo=dramo.cod_ramo AND
							  poliza.id_cia=dcia.idcia AND
							  poliza.codvend = '$asesor' AND
							  f_hastapoliza >= '$desde' AND
							  f_hastapoliza <= '$hasta' AND
							  t_cuenta  IN ".$tipo_cuentaIn." 
							  ORDER BY dramo.nramo ASC";
				  }
				  if ($tipo_cuenta=='' && $cia!='') {
  
					  // create sql part for IN condition by imploding comma after each id
					  $ciaIn = "('" . implode("','", $cia) ."')";
  
					  $sql="SELECT DISTINCT dramo.nramo FROM poliza 
							  INNER JOIN dramo, dcia WHERE 
							  poliza.id_cod_ramo=dramo.cod_ramo AND
							  poliza.id_cia=dcia.idcia AND
							  poliza.codvend = '$asesor' AND
							  f_hastapoliza >= '$desde' AND
							  f_hastapoliza <= '$hasta' AND
							  nomcia IN ".$ciaIn."
							  ORDER BY dramo.nramo ASC";
				  }
  
  
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

		
		public function get_distinct_element_ramo_pc($desde,$hasta,$cia,$tipo_cuenta)
		  {
		    
				if ($cia!='' && $tipo_cuenta!='') {
					// create sql part for IN condition by imploding comma after each id
					$ciaIn = "('" . implode("','", $cia) ."')";

					// create sql part for IN condition by imploding comma after each id
					$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";

					$sql="SELECT DISTINCT dramo.nramo FROM poliza 
								INNER JOIN dramo, dcia, comision, rep_com WHERE 
								poliza.id_cod_ramo=dramo.cod_ramo AND
								rep_com.id_cia=dcia.idcia AND
								rep_com.id_rep_com=comision.id_rep_com AND
								poliza.id_poliza=comision.id_poliza AND
								f_hastapoliza >= '$desde' AND
		      					f_hastapoliza <= '$hasta' AND
								poliza.id_poliza=comision.id_poliza AND
								nomcia IN ".$ciaIn." AND
								t_cuenta  IN ".$tipo_cuentaIn." 
								ORDER BY dramo.nramo ASC";
				}
				if ($cia=='' && $tipo_cuenta=='') {
					$sql="SELECT DISTINCT dramo.nramo FROM poliza 
							INNER JOIN dramo, dcia, comision, rep_com WHERE 
							poliza.id_cod_ramo=dramo.cod_ramo AND
							rep_com.id_cia=dcia.idcia AND
							rep_com.id_rep_com=comision.id_rep_com AND
							poliza.id_poliza=comision.id_poliza AND
							f_hastapoliza >= '$desde' AND
							f_hastapoliza <= '$hasta'
							ORDER BY dramo.nramo ASC";
				}
				if ($cia=='' && $tipo_cuenta!='') {

					// create sql part for IN condition by imploding comma after each id
					$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";

					$sql="SELECT DISTINCT dramo.nramo FROM poliza 
							INNER JOIN dramo, dcia, comision, rep_com WHERE 
							poliza.id_cod_ramo=dramo.cod_ramo AND
							rep_com.id_cia=dcia.idcia AND
							rep_com.id_rep_com=comision.id_rep_com AND
							poliza.id_poliza=comision.id_poliza AND
							f_hastapoliza >= '$desde' AND
							f_hastapoliza <= '$hasta' AND
							t_cuenta  IN ".$tipo_cuentaIn." 
							ORDER BY dramo.nramo ASC";
				}
				if ($tipo_cuenta=='' && $cia!='') {

					// create sql part for IN condition by imploding comma after each id
					$ciaIn = "('" . implode("','", $cia) ."')";

					$sql="SELECT DISTINCT dramo.nramo FROM poliza 
							INNER JOIN dramo, dcia, comision, rep_com WHERE 
							poliza.id_cod_ramo=dramo.cod_ramo AND
							rep_com.id_cia=dcia.idcia AND
							rep_com.id_rep_com=comision.id_rep_com AND
							poliza.id_poliza=comision.id_poliza AND
							f_hastapoliza >= '$desde' AND
							f_hastapoliza <= '$hasta' AND
							nomcia IN ".$ciaIn."
							ORDER BY dramo.nramo ASC";
				}


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

	public function get_distinct_element_ramo_pc_by_user($desde,$hasta,$cia,$tipo_cuenta,$asesor)
		  {
		    
				if ($cia!='' && $tipo_cuenta!='') {
					// create sql part for IN condition by imploding comma after each id
					$ciaIn = "('" . implode("','", $cia) ."')";

					// create sql part for IN condition by imploding comma after each id
					$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";

					$sql="SELECT DISTINCT dramo.nramo FROM poliza 
								INNER JOIN dramo, dcia, comision, rep_com WHERE 
								poliza.id_cod_ramo=dramo.cod_ramo AND
								rep_com.id_cia=dcia.idcia AND
								rep_com.id_rep_com=comision.id_rep_com AND
								poliza.id_poliza=comision.id_poliza AND
								comision.cod_vend = '$asesor' AND
								f_hastapoliza >= '$desde' AND
		      					f_hastapoliza <= '$hasta' AND
								poliza.id_poliza=comision.id_poliza AND
								nomcia IN ".$ciaIn." AND
								t_cuenta  IN ".$tipo_cuentaIn." 
								ORDER BY dramo.nramo ASC";
				}
				if ($cia=='' && $tipo_cuenta=='') {
					$sql="SELECT DISTINCT dramo.nramo FROM poliza 
							INNER JOIN dramo, dcia, comision, rep_com WHERE 
							poliza.id_cod_ramo=dramo.cod_ramo AND
							rep_com.id_cia=dcia.idcia AND
							rep_com.id_rep_com=comision.id_rep_com AND
							poliza.id_poliza=comision.id_poliza AND
							comision.cod_vend = '$asesor' AND
							f_hastapoliza >= '$desde' AND
							f_hastapoliza <= '$hasta'
							ORDER BY dramo.nramo ASC";
				}
				if ($cia=='' && $tipo_cuenta!='') {

					// create sql part for IN condition by imploding comma after each id
					$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";

					$sql="SELECT DISTINCT dramo.nramo FROM poliza 
							INNER JOIN dramo, dcia, comision, rep_com WHERE 
							poliza.id_cod_ramo=dramo.cod_ramo AND
							rep_com.id_cia=dcia.idcia AND
							rep_com.id_rep_com=comision.id_rep_com AND
							poliza.id_poliza=comision.id_poliza AND
							comision.cod_vend = '$asesor' AND
							f_hastapoliza >= '$desde' AND
							f_hastapoliza <= '$hasta' AND
							t_cuenta  IN ".$tipo_cuentaIn." 
							ORDER BY dramo.nramo ASC";
				}
				if ($tipo_cuenta=='' && $cia!='') {

					// create sql part for IN condition by imploding comma after each id
					$ciaIn = "('" . implode("','", $cia) ."')";

					$sql="SELECT DISTINCT dramo.nramo FROM poliza 
							INNER JOIN dramo, dcia, comision, rep_com WHERE 
							poliza.id_cod_ramo=dramo.cod_ramo AND
							rep_com.id_cia=dcia.idcia AND
							rep_com.id_rep_com=comision.id_rep_com AND
							poliza.id_poliza=comision.id_poliza AND
							comision.cod_vend = '$asesor' AND
							f_hastapoliza >= '$desde' AND
							f_hastapoliza <= '$hasta' AND
							nomcia IN ".$ciaIn."
							ORDER BY dramo.nramo ASC";
				}


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
					 
	

		public function get_distinct_element_ramo2($desde,$hasta,$cia,$tipo_cuenta)
			{

				if ($cia!='' && $tipo_cuenta!='') {
					// create sql part for IN condition by imploding comma after each id
					$ciaIn = "('" . implode("','", $cia) ."')";

					// create sql part for IN condition by imploding comma after each id
					$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";

					$sql="SELECT DISTINCT dramo.nramo FROM poliza 
								INNER JOIN dramo, dcia WHERE 
								poliza.id_cod_ramo=dramo.cod_ramo AND
								poliza.id_cia=dcia.idcia AND
								f_hastapoliza >= '$desde' AND
								f_hastapoliza <= '$hasta' AND
								nomcia IN ".$ciaIn." AND
								t_cuenta  IN ".$tipo_cuentaIn." 
								ORDER BY dramo.nramo ASC";
				}
				if ($cia=='' && $tipo_cuenta=='') {
					$sql="SELECT DISTINCT dramo.nramo FROM poliza 
							INNER JOIN dramo, dcia WHERE 
							poliza.id_cod_ramo=dramo.cod_ramo AND
							poliza.id_cia=dcia.idcia AND
							f_hastapoliza >= '$desde' AND
							f_hastapoliza <= '$hasta'
							ORDER BY dramo.nramo ASC";
				}
				if ($cia=='' && $tipo_cuenta!='') {

					// create sql part for IN condition by imploding comma after each id
					$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";

					$sql="SELECT DISTINCT dramo.nramo FROM poliza 
							INNER JOIN dramo, dcia WHERE 
							poliza.id_cod_ramo=dramo.cod_ramo AND
							poliza.id_cia=dcia.idcia AND
							f_hastapoliza >= '$desde' AND
							f_hastapoliza <= '$hasta' AND
							t_cuenta  IN ".$tipo_cuentaIn." 
							ORDER BY dramo.nramo ASC";
				}
				if ($tipo_cuenta=='' && $cia!='') {

					// create sql part for IN condition by imploding comma after each id
					$ciaIn = "('" . implode("','", $cia) ."')";

					$sql="SELECT DISTINCT dramo.nramo FROM poliza 
							INNER JOIN dramo, dcia WHERE 
							poliza.id_cod_ramo=dramo.cod_ramo AND
							poliza.id_cia=dcia.idcia AND
							f_hastapoliza >= '$desde' AND
							f_hastapoliza <= '$hasta' AND
							nomcia IN ".$ciaIn."
							ORDER BY dramo.nramo ASC";
				}
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

		public function get_distinct_element_ramo2_by_user($desde,$hasta,$cia,$tipo_cuenta,$asesor)
			{

				if ($cia!='' && $tipo_cuenta!='') {
					// create sql part for IN condition by imploding comma after each id
					$ciaIn = "('" . implode("','", $cia) ."')";

					// create sql part for IN condition by imploding comma after each id
					$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";

					$sql="SELECT DISTINCT dramo.nramo FROM poliza 
								INNER JOIN dramo, dcia WHERE 
								poliza.id_cod_ramo=dramo.cod_ramo AND
								poliza.id_cia=dcia.idcia AND
								f_hastapoliza >= '$desde' AND
								f_hastapoliza <= '$hasta' AND
								poliza.codvend = '$asesor' AND
								nomcia IN ".$ciaIn." AND
								t_cuenta  IN ".$tipo_cuentaIn." 
								ORDER BY dramo.nramo ASC";
				}
				if ($cia=='' && $tipo_cuenta=='') {
					$sql="SELECT DISTINCT dramo.nramo FROM poliza 
							INNER JOIN dramo, dcia WHERE 
							poliza.id_cod_ramo=dramo.cod_ramo AND
							poliza.id_cia=dcia.idcia AND
							poliza.codvend = '$asesor' AND
							f_hastapoliza >= '$desde' AND
							f_hastapoliza <= '$hasta'
							ORDER BY dramo.nramo ASC";
				}
				if ($cia=='' && $tipo_cuenta!='') {

					// create sql part for IN condition by imploding comma after each id
					$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";

					$sql="SELECT DISTINCT dramo.nramo FROM poliza 
							INNER JOIN dramo, dcia WHERE 
							poliza.id_cod_ramo=dramo.cod_ramo AND
							poliza.id_cia=dcia.idcia AND
							f_hastapoliza >= '$desde' AND
							f_hastapoliza <= '$hasta' AND
							poliza.codvend = '$asesor' AND
							t_cuenta  IN ".$tipo_cuentaIn." 
							ORDER BY dramo.nramo ASC";
				}
				if ($tipo_cuenta=='' && $cia!='') {

					// create sql part for IN condition by imploding comma after each id
					$ciaIn = "('" . implode("','", $cia) ."')";

					$sql="SELECT DISTINCT dramo.nramo FROM poliza 
							INNER JOIN dramo, dcia WHERE 
							poliza.id_cod_ramo=dramo.cod_ramo AND
							poliza.id_cia=dcia.idcia AND
							f_hastapoliza >= '$desde' AND
							f_hastapoliza <= '$hasta' AND
							poliza.codvend = '$asesor' AND
							nomcia IN ".$ciaIn."
							ORDER BY dramo.nramo ASC";
				}
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

		
		public function get_distinct_element_ramo3($desde,$hasta,$cia,$tipo_cuenta)
			{
			  
				  if ($tipo_cuenta!='') {
  
					  // create sql part for IN condition by imploding comma after each id
					  $tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";
  
					  $sql="SELECT DISTINCT dramo.nramo FROM poliza 
								  INNER JOIN dramo, dcia WHERE 
								  poliza.id_cod_ramo=dramo.cod_ramo AND
								  poliza.id_cia=dcia.idcia AND
								  f_hastapoliza >= '$desde' AND
								  f_hastapoliza <= '$hasta' AND
								  nomcia = '$cia' AND
								  t_cuenta  IN ".$tipo_cuentaIn." 
								  ORDER BY dramo.nramo ASC";
				  }
				  if ($tipo_cuenta=='') {
  
					  $sql="SELECT DISTINCT dramo.nramo FROM poliza 
							  INNER JOIN dramo, dcia WHERE 
							  poliza.id_cod_ramo=dramo.cod_ramo AND
							  poliza.id_cia=dcia.idcia AND
							  f_hastapoliza >= '$desde' AND
							  f_hastapoliza <= '$hasta' AND
							  nomcia = '$cia'
							  ORDER BY dramo.nramo ASC";
				  }
  
  
				  $res=mysqli_query(Conectar::con(),$sql);
				  if (!$res) {
					  //No hay registros
				  }else{
					  $filas=mysqli_num_rows($res); 
					  if ($filas == 0) { 
							//header("Location: busqueda_resumen_ramo.php?m=2#nombre");
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

		

	
		



	public function get_poliza_graf_1($ramo,$desde,$hasta,$cia,$tipo_cuenta)
		    {

				if ($cia!='' && $tipo_cuenta!='') {
					// create sql part for IN condition by imploding comma after each id
					$ciaIn = "('" . implode("','", $cia) ."')";

					// create sql part for IN condition by imploding comma after each id
					$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";

					$sql="SELECT * FROM poliza, drecibo, dramo, dcia WHERE 
								poliza.id_poliza = drecibo.idrecibo AND
								poliza.id_cod_ramo=dramo.cod_ramo AND
								poliza.id_cia=dcia.idcia AND
								f_hastapoliza >= '$desde' AND
								f_hastapoliza <= '$hasta' AND
								dcia.nomcia IN ".$ciaIn." AND
								t_cuenta  IN ".$tipo_cuentaIn." AND
								dramo.nramo = '$ramo'
								ORDER BY dramo.nramo ASC";
				}
				if ($cia=='' && $tipo_cuenta=='') {
					$sql="SELECT * FROM poliza, drecibo, dramo, dcia WHERE 
								poliza.id_poliza = drecibo.idrecibo AND
								poliza.id_cod_ramo=dramo.cod_ramo AND
								poliza.id_cia=dcia.idcia AND
								f_hastapoliza >= '$desde' AND
								f_hastapoliza <= '$hasta' AND
								dramo.nramo = '$ramo'
								ORDER BY dramo.nramo ASC";
				}
				if ($cia=='' && $tipo_cuenta!='') {

					// create sql part for IN condition by imploding comma after each id
					$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";

					$sql="SELECT * FROM poliza, drecibo, dramo, dcia WHERE 
								poliza.id_poliza = drecibo.idrecibo AND
								poliza.id_cod_ramo=dramo.cod_ramo AND
								poliza.id_cia=dcia.idcia AND
								f_hastapoliza >= '$desde' AND
								f_hastapoliza <= '$hasta' AND
								t_cuenta  IN ".$tipo_cuentaIn." AND
								dramo.nramo = '$ramo'
								ORDER BY dramo.nramo ASC";
				}
				if ($tipo_cuenta=='' && $cia!='') {

					// create sql part for IN condition by imploding comma after each id
					$ciaIn = "('" . implode("','", $cia) ."')";

					$sql="SELECT * FROM poliza, drecibo, dramo, dcia WHERE 
								poliza.id_poliza = drecibo.idrecibo AND
								poliza.id_cod_ramo=dramo.cod_ramo AND
								poliza.id_cia=dcia.idcia AND
								f_hastapoliza >= '$desde' AND
								f_hastapoliza <= '$hasta' AND
								dcia.nomcia IN ".$ciaIn." AND
								dramo.nramo = '$ramo'
								ORDER BY dramo.nramo ASC";
				}
						
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

		public function get_poliza_graf_1_by_user($ramo,$desde,$hasta,$cia,$tipo_cuenta,$asesor)
		    {

				if ($cia!='' && $tipo_cuenta!='') {
					// create sql part for IN condition by imploding comma after each id
					$ciaIn = "('" . implode("','", $cia) ."')";

					// create sql part for IN condition by imploding comma after each id
					$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";

					$sql="SELECT * FROM poliza, drecibo, dramo, dcia WHERE 
								poliza.id_poliza = drecibo.idrecibo AND
								poliza.id_cod_ramo=dramo.cod_ramo AND
								poliza.id_cia=dcia.idcia AND
								poliza.codvend = '$asesor' AND
								f_hastapoliza >= '$desde' AND
								f_hastapoliza <= '$hasta' AND
								dcia.nomcia IN ".$ciaIn." AND
								t_cuenta  IN ".$tipo_cuentaIn." AND
								dramo.nramo = '$ramo'
								ORDER BY dramo.nramo ASC";
				}
				if ($cia=='' && $tipo_cuenta=='') {
					$sql="SELECT * FROM poliza, drecibo, dramo, dcia WHERE 
								poliza.id_poliza = drecibo.idrecibo AND
								poliza.id_cod_ramo=dramo.cod_ramo AND
								poliza.id_cia=dcia.idcia AND
								poliza.codvend = '$asesor' AND
								f_hastapoliza >= '$desde' AND
								f_hastapoliza <= '$hasta' AND
								dramo.nramo = '$ramo'
								ORDER BY dramo.nramo ASC";
				}
				if ($cia=='' && $tipo_cuenta!='') {

					// create sql part for IN condition by imploding comma after each id
					$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";

					$sql="SELECT * FROM poliza, drecibo, dramo, dcia WHERE 
								poliza.id_poliza = drecibo.idrecibo AND
								poliza.id_cod_ramo=dramo.cod_ramo AND
								poliza.id_cia=dcia.idcia AND
								poliza.codvend = '$asesor' AND
								f_hastapoliza >= '$desde' AND
								f_hastapoliza <= '$hasta' AND
								t_cuenta  IN ".$tipo_cuentaIn." AND
								dramo.nramo = '$ramo'
								ORDER BY dramo.nramo ASC";
				}
				if ($tipo_cuenta=='' && $cia!='') {

					// create sql part for IN condition by imploding comma after each id
					$ciaIn = "('" . implode("','", $cia) ."')";

					$sql="SELECT * FROM poliza, drecibo, dramo, dcia WHERE 
								poliza.id_poliza = drecibo.idrecibo AND
								poliza.id_cod_ramo=dramo.cod_ramo AND
								poliza.id_cia=dcia.idcia AND
								poliza.codvend = '$asesor' AND
								f_hastapoliza >= '$desde' AND
								f_hastapoliza <= '$hasta' AND
								dcia.nomcia IN ".$ciaIn." AND
								dramo.nramo = '$ramo'
								ORDER BY dramo.nramo ASC";
				}
						
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
			   


	
		public function get_poliza_graf_1_pc($ramo,$desde,$hasta,$cia,$tipo_cuenta)
			   {
				   if ($cia!='' && $tipo_cuenta!='') {
					   // create sql part for IN condition by imploding comma after each id
					   $ciaIn = "('" . implode("','", $cia) ."')";
   
					   // create sql part for IN condition by imploding comma after each id
					   $tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";
   
					   $sql="SELECT * FROM comision INNER JOIN poliza, drecibo, dramo, dcia, rep_com WHERE 
								   poliza.id_poliza = drecibo.idrecibo AND
								   poliza.id_cod_ramo=dramo.cod_ramo AND
								   rep_com.id_cia=dcia.idcia AND
								   comision.id_poliza=poliza.id_poliza AND
								   rep_com.id_rep_com=comision.id_rep_com AND
								   f_hastapoliza >= '$desde' AND
								   f_hastapoliza <= '$hasta' AND
								   dcia.nomcia IN ".$ciaIn." AND
								   t_cuenta  IN ".$tipo_cuentaIn." AND
								   dramo.nramo = '$ramo'
								   ORDER BY dramo.nramo ASC";
				   }
				   if ($cia=='' && $tipo_cuenta=='') {
					   $sql="SELECT * FROM comision INNER JOIN poliza, drecibo, dramo, dcia, rep_com WHERE 
									poliza.id_poliza = drecibo.idrecibo AND
									poliza.id_cod_ramo=dramo.cod_ramo AND
									rep_com.id_cia=dcia.idcia AND
									comision.id_poliza=poliza.id_poliza AND
									rep_com.id_rep_com=comision.id_rep_com AND
									f_hastapoliza >= '$desde' AND
									f_hastapoliza <= '$hasta' AND
									dramo.nramo = '$ramo'
									ORDER BY dramo.nramo ASC";
				   }
				   if ($cia=='' && $tipo_cuenta!='') {
   
					   // create sql part for IN condition by imploding comma after each id
					   $tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";
   
					   $sql="SELECT * FROM comision INNER JOIN poliza, drecibo, dramo, dcia, rep_com WHERE 
									poliza.id_poliza = drecibo.idrecibo AND
									poliza.id_cod_ramo=dramo.cod_ramo AND
									rep_com.id_cia=dcia.idcia AND
									comision.id_poliza=poliza.id_poliza AND
									rep_com.id_rep_com=comision.id_rep_com AND
									f_hastapoliza >= '$desde' AND
									f_hastapoliza <= '$hasta' AND
									t_cuenta  IN ".$tipo_cuentaIn." AND
									dramo.nramo = '$ramo'
									ORDER BY dramo.nramo ASC";
				   }
				   if ($tipo_cuenta=='' && $cia!='') {
   
					   // create sql part for IN condition by imploding comma after each id
					   $ciaIn = "('" . implode("','", $cia) ."')";
   
					   $sql="SELECT * FROM comision INNER JOIN poliza, drecibo, dramo, dcia, rep_com WHERE 
									poliza.id_poliza = drecibo.idrecibo AND
									poliza.id_cod_ramo=dramo.cod_ramo AND
									rep_com.id_cia=dcia.idcia AND
									comision.id_poliza=poliza.id_poliza AND
									rep_com.id_rep_com=comision.id_rep_com AND
									f_hastapoliza >= '$desde' AND
									f_hastapoliza <= '$hasta' AND
									dcia.nomcia IN ".$ciaIn." AND
									dramo.nramo = '$ramo'
									ORDER BY dramo.nramo ASC";
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

		public function get_poliza_graf_1_pc_by_user($ramo,$desde,$hasta,$cia,$tipo_cuenta,$asesor)
			   {
				   if ($cia!='' && $tipo_cuenta!='') {
					   // create sql part for IN condition by imploding comma after each id
					   $ciaIn = "('" . implode("','", $cia) ."')";
   
					   // create sql part for IN condition by imploding comma after each id
					   $tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";
   
					   $sql="SELECT * FROM comision INNER JOIN poliza, drecibo, dramo, dcia, rep_com WHERE 
								   poliza.id_poliza = drecibo.idrecibo AND
								   poliza.id_cod_ramo=dramo.cod_ramo AND
								   rep_com.id_cia=dcia.idcia AND
								   comision.id_poliza=poliza.id_poliza AND
								   rep_com.id_rep_com=comision.id_rep_com AND
								   comision.cod_vend = '$asesor' AND
								   f_hastapoliza >= '$desde' AND
								   f_hastapoliza <= '$hasta' AND
								   dcia.nomcia IN ".$ciaIn." AND
								   t_cuenta  IN ".$tipo_cuentaIn." AND
								   dramo.nramo = '$ramo'
								   ORDER BY dramo.nramo ASC";
				   }
				   if ($cia=='' && $tipo_cuenta=='') {
					   $sql="SELECT * FROM comision INNER JOIN poliza, drecibo, dramo, dcia, rep_com WHERE 
									poliza.id_poliza = drecibo.idrecibo AND
									poliza.id_cod_ramo=dramo.cod_ramo AND
									rep_com.id_cia=dcia.idcia AND
									comision.id_poliza=poliza.id_poliza AND
									rep_com.id_rep_com=comision.id_rep_com AND
									comision.cod_vend = '$asesor' AND
									f_hastapoliza >= '$desde' AND
									f_hastapoliza <= '$hasta' AND
									dramo.nramo = '$ramo'
									ORDER BY dramo.nramo ASC";
				   }
				   if ($cia=='' && $tipo_cuenta!='') {
   
					   // create sql part for IN condition by imploding comma after each id
					   $tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";
   
					   $sql="SELECT * FROM comision INNER JOIN poliza, drecibo, dramo, dcia, rep_com WHERE 
									poliza.id_poliza = drecibo.idrecibo AND
									poliza.id_cod_ramo=dramo.cod_ramo AND
									rep_com.id_cia=dcia.idcia AND
									comision.id_poliza=poliza.id_poliza AND
									rep_com.id_rep_com=comision.id_rep_com AND
									comision.cod_vend = '$asesor' AND
									f_hastapoliza >= '$desde' AND
									f_hastapoliza <= '$hasta' AND
									t_cuenta  IN ".$tipo_cuentaIn." AND
									dramo.nramo = '$ramo'
									ORDER BY dramo.nramo ASC";
				   }
				   if ($tipo_cuenta=='' && $cia!='') {
   
					   // create sql part for IN condition by imploding comma after each id
					   $ciaIn = "('" . implode("','", $cia) ."')";
   
					   $sql="SELECT * FROM comision INNER JOIN poliza, drecibo, dramo, dcia, rep_com WHERE 
									poliza.id_poliza = drecibo.idrecibo AND
									poliza.id_cod_ramo=dramo.cod_ramo AND
									rep_com.id_cia=dcia.idcia AND
									comision.id_poliza=poliza.id_poliza AND
									rep_com.id_rep_com=comision.id_rep_com AND
									comision.cod_vend = '$asesor' AND
									f_hastapoliza >= '$desde' AND
									f_hastapoliza <= '$hasta' AND
									dcia.nomcia IN ".$ciaIn." AND
									dramo.nramo = '$ramo'
									ORDER BY dramo.nramo ASC";
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


//--------------------FIN GRÁFICO 1 RAMO-------------------

//--------------------GRÁFICO 2 TPOLIZA-------------------


	public function get_distinct_element_tpoliza($desde,$hasta,$cia,$ramo,$tipo_cuenta)
		    {

				if ($cia!='' && $tipo_cuenta!='' && $ramo!='') {
					// create sql part for IN condition by imploding comma after each id
					$ciaIn = "('" . implode("','", $cia) ."')";

					// create sql part for IN condition by imploding comma after each id
					$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";

					// create sql part for IN condition by imploding comma after each id
					$ramoIn = "('" . implode("','", $ramo) ."')";

					$sql="SELECT DISTINCT tipo_poliza FROM poliza, tipo_poliza, dcia, dramo WHERE 
								poliza.id_tpoliza=tipo_poliza.id_t_poliza AND
								poliza.id_cia=dcia.idcia AND
								poliza.id_cod_ramo=dramo.cod_ramo AND
								f_hastapoliza >= '$desde' AND
								f_hastapoliza <= '$hasta' AND
								nomcia IN ".$ciaIn." AND
								nramo IN ".$ramoIn." AND
								t_cuenta  IN ".$tipo_cuentaIn." ";
				}//1
				if ($cia=='' && $tipo_cuenta=='' && $ramo=='') {
					$sql="SELECT DISTINCT tipo_poliza FROM poliza, tipo_poliza, dcia, dramo WHERE 
								poliza.id_tpoliza=tipo_poliza.id_t_poliza AND
								poliza.id_cia=dcia.idcia AND
								poliza.id_cod_ramo=dramo.cod_ramo AND
								f_hastapoliza >= '$desde' AND
								f_hastapoliza <= '$hasta'  ";
				}//2
				if ($cia!='' && $tipo_cuenta=='' && $ramo=='') {

					// create sql part for IN condition by imploding comma after each id
					$ciaIn = "('" . implode("','", $cia) ."')";

					$sql="SELECT DISTINCT tipo_poliza FROM poliza, tipo_poliza, dcia, dramo WHERE 
							poliza.id_tpoliza=tipo_poliza.id_t_poliza AND
							poliza.id_cia=dcia.idcia AND
							poliza.id_cod_ramo=dramo.cod_ramo AND
							f_hastapoliza >= '$desde' AND
							f_hastapoliza <= '$hasta' AND
							nomcia IN ".$ciaIn." ";
				}//3
				if ($cia=='' && $tipo_cuenta!='' && $ramo=='') {

					// create sql part for IN condition by imploding comma after each id
					$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";

					$sql="SELECT DISTINCT tipo_poliza FROM poliza, tipo_poliza, dcia, dramo WHERE 
							poliza.id_tpoliza=tipo_poliza.id_t_poliza AND
							poliza.id_cia=dcia.idcia AND
							poliza.id_cod_ramo=dramo.cod_ramo AND
							f_hastapoliza >= '$desde' AND
							f_hastapoliza <= '$hasta' AND
							t_cuenta  IN ".$tipo_cuentaIn." ";
				}//4
				if ($cia=='' && $tipo_cuenta=='' && $ramo!='') {

					// create sql part for IN condition by imploding comma after each id
					$ramoIn = "('" . implode("','", $ramo) ."')";

					$sql="SELECT DISTINCT tipo_poliza FROM poliza, tipo_poliza, dcia, dramo WHERE 
							poliza.id_tpoliza=tipo_poliza.id_t_poliza AND
							poliza.id_cia=dcia.idcia AND
							poliza.id_cod_ramo=dramo.cod_ramo AND
							f_hastapoliza >= '$desde' AND
							f_hastapoliza <= '$hasta' AND
							nramo IN ".$ramoIn."  ";
				}//5
				if ($cia!='' && $tipo_cuenta!='' && $ramo=='') {
					// create sql part for IN condition by imploding comma after each id
					$ciaIn = "('" . implode("','", $cia) ."')";

					// create sql part for IN condition by imploding comma after each id
					$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";

					$sql="SELECT DISTINCT tipo_poliza FROM poliza, tipo_poliza, dcia, dramo WHERE 
								poliza.id_tpoliza=tipo_poliza.id_t_poliza AND
								poliza.id_cia=dcia.idcia AND
								poliza.id_cod_ramo=dramo.cod_ramo AND
								f_hastapoliza >= '$desde' AND
								f_hastapoliza <= '$hasta' AND
								nomcia IN ".$ciaIn." AND
								t_cuenta  IN ".$tipo_cuentaIn." ";
				}//6
				if ($cia=='' && $tipo_cuenta!='' && $ramo!='') {
					// create sql part for IN condition by imploding comma after each id
					$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";

					// create sql part for IN condition by imploding comma after each id
					$ramoIn = "('" . implode("','", $ramo) ."')";

					$sql="SELECT DISTINCT tipo_poliza FROM poliza, tipo_poliza, dcia, dramo WHERE 
								poliza.id_tpoliza=tipo_poliza.id_t_poliza AND
								poliza.id_cia=dcia.idcia AND
								poliza.id_cod_ramo=dramo.cod_ramo AND
								f_hastapoliza >= '$desde' AND
								f_hastapoliza <= '$hasta' AND
								nramo IN ".$ramoIn." AND
								t_cuenta  IN ".$tipo_cuentaIn." ";
				}//7
				if ($cia!='' && $tipo_cuenta=='' && $ramo!='') {
					// create sql part for IN condition by imploding comma after each id
					$ciaIn = "('" . implode("','", $cia) ."')";

					// create sql part for IN condition by imploding comma after each id
					$ramoIn = "('" . implode("','", $ramo) ."')";

					$sql="SELECT DISTINCT tipo_poliza FROM poliza, tipo_poliza, dcia, dramo WHERE 
								poliza.id_tpoliza=tipo_poliza.id_t_poliza AND
								poliza.id_cia=dcia.idcia AND
								poliza.id_cod_ramo=dramo.cod_ramo AND
								f_hastapoliza >= '$desde' AND
								f_hastapoliza <= '$hasta' AND
								nomcia IN ".$ciaIn." AND
								nramo IN ".$ramoIn."  ";
				}//8

				$res=mysqli_query(Conectar::con(),$sql);

				$filas=mysqli_num_rows($res); 
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

		public function get_distinct_element_tpoliza_by_user($desde,$hasta,$cia,$ramo,$tipo_cuenta,$asesor)
		    {

				if ($cia!='' && $tipo_cuenta!='' && $ramo!='') {
					// create sql part for IN condition by imploding comma after each id
					$ciaIn = "('" . implode("','", $cia) ."')";

					// create sql part for IN condition by imploding comma after each id
					$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";

					// create sql part for IN condition by imploding comma after each id
					$ramoIn = "('" . implode("','", $ramo) ."')";

					$sql="SELECT DISTINCT tipo_poliza FROM poliza, tipo_poliza, dcia, dramo WHERE 
								poliza.id_tpoliza=tipo_poliza.id_t_poliza AND
								poliza.id_cia=dcia.idcia AND
								poliza.id_cod_ramo=dramo.cod_ramo AND
								f_hastapoliza >= '$desde' AND
								f_hastapoliza <= '$hasta' AND
								poliza.codvend = '$asesor' AND
								nomcia IN ".$ciaIn." AND
								nramo IN ".$ramoIn." AND
								t_cuenta  IN ".$tipo_cuentaIn." ";
				}//1
				if ($cia=='' && $tipo_cuenta=='' && $ramo=='') {
					$sql="SELECT DISTINCT tipo_poliza FROM poliza, tipo_poliza, dcia, dramo WHERE 
								poliza.id_tpoliza=tipo_poliza.id_t_poliza AND
								poliza.id_cia=dcia.idcia AND
								poliza.id_cod_ramo=dramo.cod_ramo AND
								poliza.codvend = '$asesor' AND
								f_hastapoliza >= '$desde' AND
								f_hastapoliza <= '$hasta'  ";
				}//2
				if ($cia!='' && $tipo_cuenta=='' && $ramo=='') {

					// create sql part for IN condition by imploding comma after each id
					$ciaIn = "('" . implode("','", $cia) ."')";

					$sql="SELECT DISTINCT tipo_poliza FROM poliza, tipo_poliza, dcia, dramo WHERE 
							poliza.id_tpoliza=tipo_poliza.id_t_poliza AND
							poliza.id_cia=dcia.idcia AND
							poliza.id_cod_ramo=dramo.cod_ramo AND
							f_hastapoliza >= '$desde' AND
							f_hastapoliza <= '$hasta' AND
							poliza.codvend = '$asesor' AND
							nomcia IN ".$ciaIn." ";
				}//3
				if ($cia=='' && $tipo_cuenta!='' && $ramo=='') {

					// create sql part for IN condition by imploding comma after each id
					$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";

					$sql="SELECT DISTINCT tipo_poliza FROM poliza, tipo_poliza, dcia, dramo WHERE 
							poliza.id_tpoliza=tipo_poliza.id_t_poliza AND
							poliza.id_cia=dcia.idcia AND
							poliza.id_cod_ramo=dramo.cod_ramo AND
							f_hastapoliza >= '$desde' AND
							f_hastapoliza <= '$hasta' AND
							poliza.codvend = '$asesor' AND
							t_cuenta  IN ".$tipo_cuentaIn." ";
				}//4
				if ($cia=='' && $tipo_cuenta=='' && $ramo!='') {

					// create sql part for IN condition by imploding comma after each id
					$ramoIn = "('" . implode("','", $ramo) ."')";

					$sql="SELECT DISTINCT tipo_poliza FROM poliza, tipo_poliza, dcia, dramo WHERE 
							poliza.id_tpoliza=tipo_poliza.id_t_poliza AND
							poliza.id_cia=dcia.idcia AND
							poliza.id_cod_ramo=dramo.cod_ramo AND
							f_hastapoliza >= '$desde' AND
							f_hastapoliza <= '$hasta' AND
							poliza.codvend = '$asesor' AND
							nramo IN ".$ramoIn."  ";
				}//5
				if ($cia!='' && $tipo_cuenta!='' && $ramo=='') {
					// create sql part for IN condition by imploding comma after each id
					$ciaIn = "('" . implode("','", $cia) ."')";

					// create sql part for IN condition by imploding comma after each id
					$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";

					$sql="SELECT DISTINCT tipo_poliza FROM poliza, tipo_poliza, dcia, dramo WHERE 
								poliza.id_tpoliza=tipo_poliza.id_t_poliza AND
								poliza.id_cia=dcia.idcia AND
								poliza.id_cod_ramo=dramo.cod_ramo AND
								f_hastapoliza >= '$desde' AND
								f_hastapoliza <= '$hasta' AND
								poliza.codvend = '$asesor' AND
								nomcia IN ".$ciaIn." AND
								t_cuenta  IN ".$tipo_cuentaIn." ";
				}//6
				if ($cia=='' && $tipo_cuenta!='' && $ramo!='') {
					// create sql part for IN condition by imploding comma after each id
					$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";

					// create sql part for IN condition by imploding comma after each id
					$ramoIn = "('" . implode("','", $ramo) ."')";

					$sql="SELECT DISTINCT tipo_poliza FROM poliza, tipo_poliza, dcia, dramo WHERE 
								poliza.id_tpoliza=tipo_poliza.id_t_poliza AND
								poliza.id_cia=dcia.idcia AND
								poliza.id_cod_ramo=dramo.cod_ramo AND
								f_hastapoliza >= '$desde' AND
								f_hastapoliza <= '$hasta' AND
								poliza.codvend = '$asesor' AND
								nramo IN ".$ramoIn." AND
								t_cuenta  IN ".$tipo_cuentaIn." ";
				}//7
				if ($cia!='' && $tipo_cuenta=='' && $ramo!='') {
					// create sql part for IN condition by imploding comma after each id
					$ciaIn = "('" . implode("','", $cia) ."')";

					// create sql part for IN condition by imploding comma after each id
					$ramoIn = "('" . implode("','", $ramo) ."')";

					$sql="SELECT DISTINCT tipo_poliza FROM poliza, tipo_poliza, dcia, dramo WHERE 
								poliza.id_tpoliza=tipo_poliza.id_t_poliza AND
								poliza.id_cia=dcia.idcia AND
								poliza.id_cod_ramo=dramo.cod_ramo AND
								f_hastapoliza >= '$desde' AND
								f_hastapoliza <= '$hasta' AND
								poliza.codvend = '$asesor' AND
								nomcia IN ".$ciaIn." AND
								nramo IN ".$ramoIn."  ";
				}//8

				$res=mysqli_query(Conectar::con(),$sql);

				$filas=mysqli_num_rows($res); 
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
			   


		public function get_distinct_element_tpoliza_pc($desde,$hasta,$cia,$ramo,$tipo_cuenta)
			   {
   
				   if ($cia!='' && $tipo_cuenta!='' && $ramo!='') {
					   // create sql part for IN condition by imploding comma after each id
					   $ciaIn = "('" . implode("','", $cia) ."')";
   
					   // create sql part for IN condition by imploding comma after each id
					   $tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";
   
					   // create sql part for IN condition by imploding comma after each id
					   $ramoIn = "('" . implode("','", $ramo) ."')";
   
					   $sql="SELECT DISTINCT tipo_poliza FROM poliza, tipo_poliza, dcia, dramo, comision, rep_com WHERE 
								   poliza.id_tpoliza=tipo_poliza.id_t_poliza AND
								   rep_com.id_cia=dcia.idcia AND
								   poliza.id_cod_ramo=dramo.cod_ramo AND
								   rep_com.id_rep_com=comision.id_rep_com AND
								   poliza.id_poliza=comision.id_poliza AND
								   f_hastapoliza >= '$desde' AND
								   f_hastapoliza <= '$hasta' AND
								   nomcia IN ".$ciaIn." AND
								   nramo IN ".$ramoIn." AND
								   t_cuenta  IN ".$tipo_cuentaIn." ";
				   }//1
				   if ($cia=='' && $tipo_cuenta=='' && $ramo=='') {
					   $sql="SELECT DISTINCT tipo_poliza FROM poliza, tipo_poliza, dcia, dramo, comision, rep_com WHERE 
									poliza.id_tpoliza=tipo_poliza.id_t_poliza AND
									rep_com.id_cia=dcia.idcia AND
									poliza.id_cod_ramo=dramo.cod_ramo AND
									rep_com.id_rep_com=comision.id_rep_com AND
									poliza.id_poliza=comision.id_poliza AND
									f_hastapoliza >= '$desde' AND
									f_hastapoliza <= '$hasta'  ";
				   }//2
				   if ($cia!='' && $tipo_cuenta=='' && $ramo=='') {
   
					   // create sql part for IN condition by imploding comma after each id
					   $ciaIn = "('" . implode("','", $cia) ."')";
   
					   $sql="SELECT DISTINCT tipo_poliza FROM poliza, tipo_poliza, dcia, dramo, comision, rep_com WHERE 
								poliza.id_tpoliza=tipo_poliza.id_t_poliza AND
								rep_com.id_cia=dcia.idcia AND
								poliza.id_cod_ramo=dramo.cod_ramo AND
								rep_com.id_rep_com=comision.id_rep_com AND
								poliza.id_poliza=comision.id_poliza AND
							   f_hastapoliza >= '$desde' AND
							   f_hastapoliza <= '$hasta' AND
							   nomcia IN ".$ciaIn." ";
				   }//3
				   if ($cia=='' && $tipo_cuenta!='' && $ramo=='') {
   
					   // create sql part for IN condition by imploding comma after each id
					   $tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";
   
					   $sql="SELECT DISTINCT tipo_poliza FROM poliza, tipo_poliza, dcia, dramo, comision, rep_com WHERE 
								poliza.id_tpoliza=tipo_poliza.id_t_poliza AND
								rep_com.id_cia=dcia.idcia AND
								poliza.id_cod_ramo=dramo.cod_ramo AND
								rep_com.id_rep_com=comision.id_rep_com AND
								poliza.id_poliza=comision.id_poliza AND
							   f_hastapoliza >= '$desde' AND
							   f_hastapoliza <= '$hasta' AND
							   t_cuenta  IN ".$tipo_cuentaIn." ";
				   }//4
				   if ($cia=='' && $tipo_cuenta=='' && $ramo!='') {
   
					   // create sql part for IN condition by imploding comma after each id
					   $ramoIn = "('" . implode("','", $ramo) ."')";
   
					   $sql="SELECT DISTINCT tipo_poliza FROM poliza, tipo_poliza, dcia, dramo, comision, rep_com WHERE 
								poliza.id_tpoliza=tipo_poliza.id_t_poliza AND
								rep_com.id_cia=dcia.idcia AND
								poliza.id_cod_ramo=dramo.cod_ramo AND
								rep_com.id_rep_com=comision.id_rep_com AND
								poliza.id_poliza=comision.id_poliza AND
							   f_hastapoliza >= '$desde' AND
							   f_hastapoliza <= '$hasta' AND
							   nramo IN ".$ramoIn."  ";
				   }//5
				   if ($cia!='' && $tipo_cuenta!='' && $ramo=='') {
					   // create sql part for IN condition by imploding comma after each id
					   $ciaIn = "('" . implode("','", $cia) ."')";
   
					   // create sql part for IN condition by imploding comma after each id
					   $tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";
   
					   $sql="SELECT DISTINCT tipo_poliza FROM poliza, tipo_poliza, dcia, dramo, comision, rep_com WHERE 
									poliza.id_tpoliza=tipo_poliza.id_t_poliza AND
									rep_com.id_cia=dcia.idcia AND
									poliza.id_cod_ramo=dramo.cod_ramo AND
									rep_com.id_rep_com=comision.id_rep_com AND
									poliza.id_poliza=comision.id_poliza AND
								   f_hastapoliza >= '$desde' AND
								   f_hastapoliza <= '$hasta' AND
								   nomcia IN ".$ciaIn." AND
								   t_cuenta  IN ".$tipo_cuentaIn." ";
				   }//6
				   if ($cia=='' && $tipo_cuenta!='' && $ramo!='') {
					   // create sql part for IN condition by imploding comma after each id
					   $tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";
   
					   // create sql part for IN condition by imploding comma after each id
					   $ramoIn = "('" . implode("','", $ramo) ."')";
   
					   $sql="SELECT DISTINCT tipo_poliza FROM poliza, tipo_poliza, dcia, dramo, comision, rep_com WHERE 
									poliza.id_tpoliza=tipo_poliza.id_t_poliza AND
									rep_com.id_cia=dcia.idcia AND
									poliza.id_cod_ramo=dramo.cod_ramo AND
									rep_com.id_rep_com=comision.id_rep_com AND
									poliza.id_poliza=comision.id_poliza AND
								   f_hastapoliza >= '$desde' AND
								   f_hastapoliza <= '$hasta' AND
								   nramo IN ".$ramoIn." AND
								   t_cuenta  IN ".$tipo_cuentaIn." ";
				   }//7
				   if ($cia!='' && $tipo_cuenta=='' && $ramo!='') {
					   // create sql part for IN condition by imploding comma after each id
					   $ciaIn = "('" . implode("','", $cia) ."')";
   
					   // create sql part for IN condition by imploding comma after each id
					   $ramoIn = "('" . implode("','", $ramo) ."')";
   
					   $sql="SELECT DISTINCT tipo_poliza FROM poliza, tipo_poliza, dcia, dramo, comision, rep_com WHERE 
									poliza.id_tpoliza=tipo_poliza.id_t_poliza AND
									rep_com.id_cia=dcia.idcia AND
									poliza.id_cod_ramo=dramo.cod_ramo AND
									rep_com.id_rep_com=comision.id_rep_com AND
									poliza.id_poliza=comision.id_poliza AND
								   f_hastapoliza >= '$desde' AND
								   f_hastapoliza <= '$hasta' AND
								   nomcia IN ".$ciaIn." AND
								   nramo IN ".$ramoIn."  ";
				   }//8
   
				   $res=mysqli_query(Conectar::con(),$sql);
   
				   $filas=mysqli_num_rows($res); 
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


			public function get_distinct_element_tpoliza_pc_by_user($desde,$hasta,$cia,$ramo,$tipo_cuenta,$asesor)
			   {
   
				   if ($cia!='' && $tipo_cuenta!='' && $ramo!='') {
					   // create sql part for IN condition by imploding comma after each id
					   $ciaIn = "('" . implode("','", $cia) ."')";
   
					   // create sql part for IN condition by imploding comma after each id
					   $tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";
   
					   // create sql part for IN condition by imploding comma after each id
					   $ramoIn = "('" . implode("','", $ramo) ."')";
   
					   $sql="SELECT DISTINCT tipo_poliza FROM poliza, tipo_poliza, dcia, dramo, comision, rep_com WHERE 
								   poliza.id_tpoliza=tipo_poliza.id_t_poliza AND
								   rep_com.id_cia=dcia.idcia AND
								   poliza.id_cod_ramo=dramo.cod_ramo AND
								   rep_com.id_rep_com=comision.id_rep_com AND
								   poliza.id_poliza=comision.id_poliza AND
								   comision.cod_vend = '$asesor' AND
								   f_hastapoliza >= '$desde' AND
								   f_hastapoliza <= '$hasta' AND
								   nomcia IN ".$ciaIn." AND
								   nramo IN ".$ramoIn." AND
								   t_cuenta  IN ".$tipo_cuentaIn." ";
				   }//1
				   if ($cia=='' && $tipo_cuenta=='' && $ramo=='') {
					   $sql="SELECT DISTINCT tipo_poliza FROM poliza, tipo_poliza, dcia, dramo, comision, rep_com WHERE 
									poliza.id_tpoliza=tipo_poliza.id_t_poliza AND
									rep_com.id_cia=dcia.idcia AND
									poliza.id_cod_ramo=dramo.cod_ramo AND
									rep_com.id_rep_com=comision.id_rep_com AND
									poliza.id_poliza=comision.id_poliza AND
									comision.cod_vend = '$asesor' AND
									f_hastapoliza >= '$desde' AND
									f_hastapoliza <= '$hasta'  ";
				   }//2
				   if ($cia!='' && $tipo_cuenta=='' && $ramo=='') {
   
					   // create sql part for IN condition by imploding comma after each id
					   $ciaIn = "('" . implode("','", $cia) ."')";
   
					   $sql="SELECT DISTINCT tipo_poliza FROM poliza, tipo_poliza, dcia, dramo, comision, rep_com WHERE 
								poliza.id_tpoliza=tipo_poliza.id_t_poliza AND
								rep_com.id_cia=dcia.idcia AND
								poliza.id_cod_ramo=dramo.cod_ramo AND
								rep_com.id_rep_com=comision.id_rep_com AND
								poliza.id_poliza=comision.id_poliza AND
								comision.cod_vend = '$asesor' AND
							   f_hastapoliza >= '$desde' AND
							   f_hastapoliza <= '$hasta' AND
							   nomcia IN ".$ciaIn." ";
				   }//3
				   if ($cia=='' && $tipo_cuenta!='' && $ramo=='') {
   
					   // create sql part for IN condition by imploding comma after each id
					   $tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";
   
					   $sql="SELECT DISTINCT tipo_poliza FROM poliza, tipo_poliza, dcia, dramo, comision, rep_com WHERE 
								poliza.id_tpoliza=tipo_poliza.id_t_poliza AND
								rep_com.id_cia=dcia.idcia AND
								poliza.id_cod_ramo=dramo.cod_ramo AND
								rep_com.id_rep_com=comision.id_rep_com AND
								poliza.id_poliza=comision.id_poliza AND
								comision.cod_vend = '$asesor' AND
							   f_hastapoliza >= '$desde' AND
							   f_hastapoliza <= '$hasta' AND
							   t_cuenta  IN ".$tipo_cuentaIn." ";
				   }//4
				   if ($cia=='' && $tipo_cuenta=='' && $ramo!='') {
   
					   // create sql part for IN condition by imploding comma after each id
					   $ramoIn = "('" . implode("','", $ramo) ."')";
   
					   $sql="SELECT DISTINCT tipo_poliza FROM poliza, tipo_poliza, dcia, dramo, comision, rep_com WHERE 
								poliza.id_tpoliza=tipo_poliza.id_t_poliza AND
								rep_com.id_cia=dcia.idcia AND
								poliza.id_cod_ramo=dramo.cod_ramo AND
								rep_com.id_rep_com=comision.id_rep_com AND
								poliza.id_poliza=comision.id_poliza AND
								comision.cod_vend = '$asesor' AND
							   f_hastapoliza >= '$desde' AND
							   f_hastapoliza <= '$hasta' AND
							   nramo IN ".$ramoIn."  ";
				   }//5
				   if ($cia!='' && $tipo_cuenta!='' && $ramo=='') {
					   // create sql part for IN condition by imploding comma after each id
					   $ciaIn = "('" . implode("','", $cia) ."')";
   
					   // create sql part for IN condition by imploding comma after each id
					   $tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";
   
					   $sql="SELECT DISTINCT tipo_poliza FROM poliza, tipo_poliza, dcia, dramo, comision, rep_com WHERE 
									poliza.id_tpoliza=tipo_poliza.id_t_poliza AND
									rep_com.id_cia=dcia.idcia AND
									poliza.id_cod_ramo=dramo.cod_ramo AND
									rep_com.id_rep_com=comision.id_rep_com AND
									poliza.id_poliza=comision.id_poliza AND
									comision.cod_vend = '$asesor' AND
								   f_hastapoliza >= '$desde' AND
								   f_hastapoliza <= '$hasta' AND
								   nomcia IN ".$ciaIn." AND
								   t_cuenta  IN ".$tipo_cuentaIn." ";
				   }//6
				   if ($cia=='' && $tipo_cuenta!='' && $ramo!='') {
					   // create sql part for IN condition by imploding comma after each id
					   $tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";
   
					   // create sql part for IN condition by imploding comma after each id
					   $ramoIn = "('" . implode("','", $ramo) ."')";
   
					   $sql="SELECT DISTINCT tipo_poliza FROM poliza, tipo_poliza, dcia, dramo, comision, rep_com WHERE 
									poliza.id_tpoliza=tipo_poliza.id_t_poliza AND
									rep_com.id_cia=dcia.idcia AND
									poliza.id_cod_ramo=dramo.cod_ramo AND
									rep_com.id_rep_com=comision.id_rep_com AND
									poliza.id_poliza=comision.id_poliza AND
									comision.cod_vend = '$asesor' AND
								   f_hastapoliza >= '$desde' AND
								   f_hastapoliza <= '$hasta' AND
								   nramo IN ".$ramoIn." AND
								   t_cuenta  IN ".$tipo_cuentaIn." ";
				   }//7
				   if ($cia!='' && $tipo_cuenta=='' && $ramo!='') {
					   // create sql part for IN condition by imploding comma after each id
					   $ciaIn = "('" . implode("','", $cia) ."')";
   
					   // create sql part for IN condition by imploding comma after each id
					   $ramoIn = "('" . implode("','", $ramo) ."')";
   
					   $sql="SELECT DISTINCT tipo_poliza FROM poliza, tipo_poliza, dcia, dramo, comision, rep_com WHERE 
									poliza.id_tpoliza=tipo_poliza.id_t_poliza AND
									rep_com.id_cia=dcia.idcia AND
									poliza.id_cod_ramo=dramo.cod_ramo AND
									rep_com.id_rep_com=comision.id_rep_com AND
									poliza.id_poliza=comision.id_poliza AND
									comision.cod_vend = '$asesor' AND
								   f_hastapoliza >= '$desde' AND
								   f_hastapoliza <= '$hasta' AND
								   nomcia IN ".$ciaIn." AND
								   nramo IN ".$ramoIn."  ";
				   }//8
   
				   $res=mysqli_query(Conectar::con(),$sql);
   
				   $filas=mysqli_num_rows($res); 
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




	public function get_poliza_graf_2($tpoliza,$ramo,$desde,$hasta,$cia,$tipo_cuenta)
		    {
				if ($cia!='' && $tipo_cuenta!='' && $ramo!='') {
					// create sql part for IN condition by imploding comma after each id
					$ciaIn = "('" . implode("','", $cia) ."')";

					// create sql part for IN condition by imploding comma after each id
					$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";

					// create sql part for IN condition by imploding comma after each id
					$ramoIn = "('" . implode("','", $ramo) ."')";

					$sql="SELECT * FROM poliza, drecibo, dramo, dcia, tipo_poliza WHERE 
								poliza.id_poliza = drecibo.idrecibo AND
								poliza.id_cod_ramo=dramo.cod_ramo AND
								poliza.id_cia=dcia.idcia AND
								poliza.id_tpoliza=tipo_poliza.id_t_poliza AND
								f_hastapoliza >= '$desde' AND
								f_hastapoliza <= '$hasta' AND
								nomcia IN ".$ciaIn." AND
								nramo IN ".$ramoIn." AND
								t_cuenta  IN ".$tipo_cuentaIn." AND
								tipo_poliza = '$tpoliza' ";
				}//1
				if ($cia=='' && $tipo_cuenta=='' && $ramo=='') {
					$sql="SELECT * FROM poliza, drecibo, dramo, dcia, tipo_poliza WHERE 
								poliza.id_poliza = drecibo.idrecibo AND
								poliza.id_cod_ramo=dramo.cod_ramo AND
								poliza.id_cia=dcia.idcia AND
								poliza.id_tpoliza=tipo_poliza.id_t_poliza AND
								f_hastapoliza >= '$desde' AND
								f_hastapoliza <= '$hasta' AND
								tipo_poliza = '$tpoliza' ";
				}//2
				if ($cia!='' && $tipo_cuenta=='' && $ramo=='') {

					// create sql part for IN condition by imploding comma after each id
					$ciaIn = "('" . implode("','", $cia) ."')";

					$sql="SELECT * FROM poliza, drecibo, dramo, dcia, tipo_poliza WHERE 
								poliza.id_poliza = drecibo.idrecibo AND
								poliza.id_cod_ramo=dramo.cod_ramo AND
								poliza.id_cia=dcia.idcia AND
								poliza.id_tpoliza=tipo_poliza.id_t_poliza AND
								f_hastapoliza >= '$desde' AND
								f_hastapoliza <= '$hasta' AND
								nomcia IN ".$ciaIn." AND
								tipo_poliza = '$tpoliza' ";
				}//3
				if ($cia=='' && $tipo_cuenta!='' && $ramo=='') {

					// create sql part for IN condition by imploding comma after each id
					$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";

					$sql="SELECT * FROM poliza, drecibo, dramo, dcia, tipo_poliza WHERE 
								poliza.id_poliza = drecibo.idrecibo AND
								poliza.id_cod_ramo=dramo.cod_ramo AND
								poliza.id_cia=dcia.idcia AND
								poliza.id_tpoliza=tipo_poliza.id_t_poliza AND
								f_hastapoliza >= '$desde' AND
								f_hastapoliza <= '$hasta' AND
								t_cuenta  IN ".$tipo_cuentaIn." AND
								tipo_poliza = '$tpoliza' ";
				}//4
				if ($cia=='' && $tipo_cuenta=='' && $ramo!='') {

					// create sql part for IN condition by imploding comma after each id
					$ramoIn = "('" . implode("','", $ramo) ."')";

					$sql="SELECT * FROM poliza, drecibo, dramo, dcia, tipo_poliza WHERE 
								poliza.id_poliza = drecibo.idrecibo AND
								poliza.id_cod_ramo=dramo.cod_ramo AND
								poliza.id_cia=dcia.idcia AND
								poliza.id_tpoliza=tipo_poliza.id_t_poliza AND
								f_hastapoliza >= '$desde' AND
								f_hastapoliza <= '$hasta' AND
								nramo IN ".$ramoIn." AND
								tipo_poliza = '$tpoliza' ";
				}//5
				if ($cia!='' && $tipo_cuenta!='' && $ramo=='') {
					// create sql part for IN condition by imploding comma after each id
					$ciaIn = "('" . implode("','", $cia) ."')";

					// create sql part for IN condition by imploding comma after each id
					$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";

					$sql="SELECT * FROM poliza, drecibo, dramo, dcia, tipo_poliza WHERE 
								poliza.id_poliza = drecibo.idrecibo AND
								poliza.id_cod_ramo=dramo.cod_ramo AND
								poliza.id_cia=dcia.idcia AND
								poliza.id_tpoliza=tipo_poliza.id_t_poliza AND
								f_hastapoliza >= '$desde' AND
								f_hastapoliza <= '$hasta' AND
								nomcia IN ".$ciaIn." AND
								t_cuenta  IN ".$tipo_cuentaIn." AND
								tipo_poliza = '$tpoliza' ";
				}//6
				if ($cia=='' && $tipo_cuenta!='' && $ramo!='') {
					// create sql part for IN condition by imploding comma after each id
					$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";

					// create sql part for IN condition by imploding comma after each id
					$ramoIn = "('" . implode("','", $ramo) ."')";

					$sql="SELECT * FROM poliza, drecibo, dramo, dcia, tipo_poliza WHERE 
								poliza.id_poliza = drecibo.idrecibo AND
								poliza.id_cod_ramo=dramo.cod_ramo AND
								poliza.id_cia=dcia.idcia AND
								poliza.id_tpoliza=tipo_poliza.id_t_poliza AND
								f_hastapoliza >= '$desde' AND
								f_hastapoliza <= '$hasta' AND
								nramo IN ".$ramoIn." AND
								t_cuenta  IN ".$tipo_cuentaIn." AND
								tipo_poliza = '$tpoliza' ";
				}//7
				if ($cia!='' && $tipo_cuenta=='' && $ramo!='') {
					// create sql part for IN condition by imploding comma after each id
					$ciaIn = "('" . implode("','", $cia) ."')";

					// create sql part for IN condition by imploding comma after each id
					$ramoIn = "('" . implode("','", $ramo) ."')";

					$sql="SELECT * FROM poliza, drecibo, dramo, dcia, tipo_poliza WHERE 
							poliza.id_poliza = drecibo.idrecibo AND
							poliza.id_cod_ramo=dramo.cod_ramo AND
							poliza.id_cia=dcia.idcia AND
							poliza.id_tpoliza=tipo_poliza.id_t_poliza AND
							f_hastapoliza >= '$desde' AND
							f_hastapoliza <= '$hasta' AND
							nomcia IN ".$ciaIn." AND
							nramo IN ".$ramoIn." AND
							tipo_poliza = '$tpoliza' ";
				}//8
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

		public function get_poliza_graf_2_by_user($tpoliza,$ramo,$desde,$hasta,$cia,$tipo_cuenta,$asesor)
		    {
				if ($cia!='' && $tipo_cuenta!='' && $ramo!='') {
					// create sql part for IN condition by imploding comma after each id
					$ciaIn = "('" . implode("','", $cia) ."')";

					// create sql part for IN condition by imploding comma after each id
					$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";

					// create sql part for IN condition by imploding comma after each id
					$ramoIn = "('" . implode("','", $ramo) ."')";

					$sql="SELECT * FROM poliza, drecibo, dramo, dcia, tipo_poliza WHERE 
								poliza.id_poliza = drecibo.idrecibo AND
								poliza.id_cod_ramo=dramo.cod_ramo AND
								poliza.id_cia=dcia.idcia AND
								poliza.id_tpoliza=tipo_poliza.id_t_poliza AND
								f_hastapoliza >= '$desde' AND
								f_hastapoliza <= '$hasta' AND
								poliza.codvend = '$asesor' AND
								nomcia IN ".$ciaIn." AND
								nramo IN ".$ramoIn." AND
								t_cuenta  IN ".$tipo_cuentaIn." AND
								tipo_poliza = '$tpoliza' ";
				}//1
				if ($cia=='' && $tipo_cuenta=='' && $ramo=='') {
					$sql="SELECT * FROM poliza, drecibo, dramo, dcia, tipo_poliza WHERE 
								poliza.id_poliza = drecibo.idrecibo AND
								poliza.id_cod_ramo=dramo.cod_ramo AND
								poliza.id_cia=dcia.idcia AND
								poliza.id_tpoliza=tipo_poliza.id_t_poliza AND
								f_hastapoliza >= '$desde' AND
								f_hastapoliza <= '$hasta' AND
								poliza.codvend = '$asesor' AND
								tipo_poliza = '$tpoliza' ";
				}//2
				if ($cia!='' && $tipo_cuenta=='' && $ramo=='') {

					// create sql part for IN condition by imploding comma after each id
					$ciaIn = "('" . implode("','", $cia) ."')";

					$sql="SELECT * FROM poliza, drecibo, dramo, dcia, tipo_poliza WHERE 
								poliza.id_poliza = drecibo.idrecibo AND
								poliza.id_cod_ramo=dramo.cod_ramo AND
								poliza.id_cia=dcia.idcia AND
								poliza.id_tpoliza=tipo_poliza.id_t_poliza AND
								f_hastapoliza >= '$desde' AND
								f_hastapoliza <= '$hasta' AND
								poliza.codvend = '$asesor' AND
								nomcia IN ".$ciaIn." AND
								tipo_poliza = '$tpoliza' ";
				}//3
				if ($cia=='' && $tipo_cuenta!='' && $ramo=='') {

					// create sql part for IN condition by imploding comma after each id
					$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";

					$sql="SELECT * FROM poliza, drecibo, dramo, dcia, tipo_poliza WHERE 
								poliza.id_poliza = drecibo.idrecibo AND
								poliza.id_cod_ramo=dramo.cod_ramo AND
								poliza.id_cia=dcia.idcia AND
								poliza.id_tpoliza=tipo_poliza.id_t_poliza AND
								f_hastapoliza >= '$desde' AND
								f_hastapoliza <= '$hasta' AND
								poliza.codvend = '$asesor' AND
								t_cuenta  IN ".$tipo_cuentaIn." AND
								tipo_poliza = '$tpoliza' ";
				}//4
				if ($cia=='' && $tipo_cuenta=='' && $ramo!='') {

					// create sql part for IN condition by imploding comma after each id
					$ramoIn = "('" . implode("','", $ramo) ."')";

					$sql="SELECT * FROM poliza, drecibo, dramo, dcia, tipo_poliza WHERE 
								poliza.id_poliza = drecibo.idrecibo AND
								poliza.id_cod_ramo=dramo.cod_ramo AND
								poliza.id_cia=dcia.idcia AND
								poliza.id_tpoliza=tipo_poliza.id_t_poliza AND
								f_hastapoliza >= '$desde' AND
								f_hastapoliza <= '$hasta' AND
								poliza.codvend = '$asesor' AND
								nramo IN ".$ramoIn." AND
								tipo_poliza = '$tpoliza' ";
				}//5
				if ($cia!='' && $tipo_cuenta!='' && $ramo=='') {
					// create sql part for IN condition by imploding comma after each id
					$ciaIn = "('" . implode("','", $cia) ."')";

					// create sql part for IN condition by imploding comma after each id
					$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";

					$sql="SELECT * FROM poliza, drecibo, dramo, dcia, tipo_poliza WHERE 
								poliza.id_poliza = drecibo.idrecibo AND
								poliza.id_cod_ramo=dramo.cod_ramo AND
								poliza.id_cia=dcia.idcia AND
								poliza.id_tpoliza=tipo_poliza.id_t_poliza AND
								f_hastapoliza >= '$desde' AND
								f_hastapoliza <= '$hasta' AND
								poliza.codvend = '$asesor' AND
								nomcia IN ".$ciaIn." AND
								t_cuenta  IN ".$tipo_cuentaIn." AND
								tipo_poliza = '$tpoliza' ";
				}//6
				if ($cia=='' && $tipo_cuenta!='' && $ramo!='') {
					// create sql part for IN condition by imploding comma after each id
					$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";

					// create sql part for IN condition by imploding comma after each id
					$ramoIn = "('" . implode("','", $ramo) ."')";

					$sql="SELECT * FROM poliza, drecibo, dramo, dcia, tipo_poliza WHERE 
								poliza.id_poliza = drecibo.idrecibo AND
								poliza.id_cod_ramo=dramo.cod_ramo AND
								poliza.id_cia=dcia.idcia AND
								poliza.id_tpoliza=tipo_poliza.id_t_poliza AND
								f_hastapoliza >= '$desde' AND
								f_hastapoliza <= '$hasta' AND
								poliza.codvend = '$asesor' AND
								nramo IN ".$ramoIn." AND
								t_cuenta  IN ".$tipo_cuentaIn." AND
								tipo_poliza = '$tpoliza' ";
				}//7
				if ($cia!='' && $tipo_cuenta=='' && $ramo!='') {
					// create sql part for IN condition by imploding comma after each id
					$ciaIn = "('" . implode("','", $cia) ."')";

					// create sql part for IN condition by imploding comma after each id
					$ramoIn = "('" . implode("','", $ramo) ."')";

					$sql="SELECT * FROM poliza, drecibo, dramo, dcia, tipo_poliza WHERE 
							poliza.id_poliza = drecibo.idrecibo AND
							poliza.id_cod_ramo=dramo.cod_ramo AND
							poliza.id_cia=dcia.idcia AND
							poliza.id_tpoliza=tipo_poliza.id_t_poliza AND
							f_hastapoliza >= '$desde' AND
							f_hastapoliza <= '$hasta' AND
							poliza.codvend = '$asesor' AND
							nomcia IN ".$ciaIn." AND
							nramo IN ".$ramoIn." AND
							tipo_poliza = '$tpoliza' ";
				}//8
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
			   

		public function get_poliza_graf_2_pc($tpoliza,$ramo,$desde,$hasta,$cia,$tipo_cuenta)
			   {
				   if ($cia!='' && $tipo_cuenta!='' && $ramo!='') {
					   // create sql part for IN condition by imploding comma after each id
					   $ciaIn = "('" . implode("','", $cia) ."')";
   
					   // create sql part for IN condition by imploding comma after each id
					   $tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";
   
					   // create sql part for IN condition by imploding comma after each id
					   $ramoIn = "('" . implode("','", $ramo) ."')";
   
					   $sql="SELECT * FROM comision INNER JOIN poliza, drecibo, dramo, dcia, tipo_poliza, rep_com WHERE 
								   poliza.id_poliza = drecibo.idrecibo AND
								   poliza.id_cod_ramo=dramo.cod_ramo AND
								   rep_com.id_cia=dcia.idcia AND
								   poliza.id_tpoliza=tipo_poliza.id_t_poliza AND
								   comision.id_poliza=poliza.id_poliza AND
								   rep_com.id_rep_com=comision.id_rep_com AND
								   f_hastapoliza >= '$desde' AND
								   f_hastapoliza <= '$hasta' AND
								   nomcia IN ".$ciaIn." AND
								   nramo IN ".$ramoIn." AND
								   t_cuenta  IN ".$tipo_cuentaIn." AND
								   tipo_poliza = '$tpoliza' ";
				   }//1
				   if ($cia=='' && $tipo_cuenta=='' && $ramo=='') {
					   $sql="SELECT * FROM comision INNER JOIN poliza, drecibo, dramo, dcia, tipo_poliza, rep_com WHERE 
									poliza.id_poliza = drecibo.idrecibo AND
									poliza.id_cod_ramo=dramo.cod_ramo AND
									rep_com.id_cia=dcia.idcia AND
									poliza.id_tpoliza=tipo_poliza.id_t_poliza AND
									comision.id_poliza=poliza.id_poliza AND
									rep_com.id_rep_com=comision.id_rep_com AND
								   f_hastapoliza >= '$desde' AND
								   f_hastapoliza <= '$hasta' AND
								   tipo_poliza = '$tpoliza' ";
				   }//2
				   if ($cia!='' && $tipo_cuenta=='' && $ramo=='') {
   
					   // create sql part for IN condition by imploding comma after each id
					   $ciaIn = "('" . implode("','", $cia) ."')";
   
					   $sql="SELECT * FROM comision INNER JOIN poliza, drecibo, dramo, dcia, tipo_poliza, rep_com WHERE 
									poliza.id_poliza = drecibo.idrecibo AND
									poliza.id_cod_ramo=dramo.cod_ramo AND
									rep_com.id_cia=dcia.idcia AND
									poliza.id_tpoliza=tipo_poliza.id_t_poliza AND
									comision.id_poliza=poliza.id_poliza AND
									rep_com.id_rep_com=comision.id_rep_com AND
								   f_hastapoliza >= '$desde' AND
								   f_hastapoliza <= '$hasta' AND
								   nomcia IN ".$ciaIn." AND
								   tipo_poliza = '$tpoliza' ";
				   }//3
				   if ($cia=='' && $tipo_cuenta!='' && $ramo=='') {
   
					   // create sql part for IN condition by imploding comma after each id
					   $tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";
   
						$sql="SELECT * FROM comision INNER JOIN poliza, drecibo, dramo, dcia, tipo_poliza, rep_com WHERE 
									poliza.id_poliza = drecibo.idrecibo AND
									poliza.id_cod_ramo=dramo.cod_ramo AND
									rep_com.id_cia=dcia.idcia AND
									poliza.id_tpoliza=tipo_poliza.id_t_poliza AND
									comision.id_poliza=poliza.id_poliza AND
									rep_com.id_rep_com=comision.id_rep_com AND
								   f_hastapoliza >= '$desde' AND
								   f_hastapoliza <= '$hasta' AND
								   t_cuenta  IN ".$tipo_cuentaIn." AND
								   tipo_poliza = '$tpoliza' ";
				   }//4
				   if ($cia=='' && $tipo_cuenta=='' && $ramo!='') {
   
					   // create sql part for IN condition by imploding comma after each id
					   $ramoIn = "('" . implode("','", $ramo) ."')";
   
					   $sql="SELECT * FROM comision INNER JOIN poliza, drecibo, dramo, dcia, tipo_poliza, rep_com WHERE 
									poliza.id_poliza = drecibo.idrecibo AND
									poliza.id_cod_ramo=dramo.cod_ramo AND
									rep_com.id_cia=dcia.idcia AND
									poliza.id_tpoliza=tipo_poliza.id_t_poliza AND
									comision.id_poliza=poliza.id_poliza AND
									rep_com.id_rep_com=comision.id_rep_com AND
								   f_hastapoliza >= '$desde' AND
								   f_hastapoliza <= '$hasta' AND
								   nramo IN ".$ramoIn." AND
								   tipo_poliza = '$tpoliza' ";
				   }//5
				   if ($cia!='' && $tipo_cuenta!='' && $ramo=='') {
					   // create sql part for IN condition by imploding comma after each id
					   $ciaIn = "('" . implode("','", $cia) ."')";
   
					   // create sql part for IN condition by imploding comma after each id
					   $tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";
   
					   $sql="SELECT * FROM comision INNER JOIN poliza, drecibo, dramo, dcia, tipo_poliza, rep_com WHERE 
									poliza.id_poliza = drecibo.idrecibo AND
									poliza.id_cod_ramo=dramo.cod_ramo AND
									rep_com.id_cia=dcia.idcia AND
									poliza.id_tpoliza=tipo_poliza.id_t_poliza AND
									comision.id_poliza=poliza.id_poliza AND
									rep_com.id_rep_com=comision.id_rep_com AND
								   f_hastapoliza >= '$desde' AND
								   f_hastapoliza <= '$hasta' AND
								   nomcia IN ".$ciaIn." AND
								   t_cuenta  IN ".$tipo_cuentaIn." AND
								   tipo_poliza = '$tpoliza' ";
				   }//6
				   if ($cia=='' && $tipo_cuenta!='' && $ramo!='') {
					   // create sql part for IN condition by imploding comma after each id
					   $tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";
   
					   // create sql part for IN condition by imploding comma after each id
					   $ramoIn = "('" . implode("','", $ramo) ."')";
   
					   $sql="SELECT * FROM comision INNER JOIN poliza, drecibo, dramo, dcia, tipo_poliza, rep_com WHERE 
									poliza.id_poliza = drecibo.idrecibo AND
									poliza.id_cod_ramo=dramo.cod_ramo AND
									rep_com.id_cia=dcia.idcia AND
									poliza.id_tpoliza=tipo_poliza.id_t_poliza AND
									comision.id_poliza=poliza.id_poliza AND
									rep_com.id_rep_com=comision.id_rep_com AND
								   f_hastapoliza >= '$desde' AND
								   f_hastapoliza <= '$hasta' AND
								   nramo IN ".$ramoIn." AND
								   t_cuenta  IN ".$tipo_cuentaIn." AND
								   tipo_poliza = '$tpoliza' ";
				   }//7
				   if ($cia!='' && $tipo_cuenta=='' && $ramo!='') {
					   // create sql part for IN condition by imploding comma after each id
					   $ciaIn = "('" . implode("','", $cia) ."')";
   
					   // create sql part for IN condition by imploding comma after each id
					   $ramoIn = "('" . implode("','", $ramo) ."')";
   
					   $sql="SELECT * FROM comision INNER JOIN poliza, drecibo, dramo, dcia, tipo_poliza, rep_com WHERE 
								poliza.id_poliza = drecibo.idrecibo AND
								poliza.id_cod_ramo=dramo.cod_ramo AND
								rep_com.id_cia=dcia.idcia AND
								poliza.id_tpoliza=tipo_poliza.id_t_poliza AND
								comision.id_poliza=poliza.id_poliza AND
								rep_com.id_rep_com=comision.id_rep_com AND
							   f_hastapoliza >= '$desde' AND
							   f_hastapoliza <= '$hasta' AND
							   nomcia IN ".$ciaIn." AND
							   nramo IN ".$ramoIn." AND
							   tipo_poliza = '$tpoliza' ";
				   }//8
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

		public function get_poliza_graf_2_pc_by_user($tpoliza,$ramo,$desde,$hasta,$cia,$tipo_cuenta,$asesor)
			   {
				   if ($cia!='' && $tipo_cuenta!='' && $ramo!='') {
					   // create sql part for IN condition by imploding comma after each id
					   $ciaIn = "('" . implode("','", $cia) ."')";
   
					   // create sql part for IN condition by imploding comma after each id
					   $tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";
   
					   // create sql part for IN condition by imploding comma after each id
					   $ramoIn = "('" . implode("','", $ramo) ."')";
   
					   $sql="SELECT * FROM comision INNER JOIN poliza, drecibo, dramo, dcia, tipo_poliza, rep_com WHERE 
								   poliza.id_poliza = drecibo.idrecibo AND
								   poliza.id_cod_ramo=dramo.cod_ramo AND
								   rep_com.id_cia=dcia.idcia AND
								   poliza.id_tpoliza=tipo_poliza.id_t_poliza AND
								   comision.id_poliza=poliza.id_poliza AND
								   rep_com.id_rep_com=comision.id_rep_com AND
								   comision.cod_vend = '$asesor' AND
								   f_hastapoliza >= '$desde' AND
								   f_hastapoliza <= '$hasta' AND
								   nomcia IN ".$ciaIn." AND
								   nramo IN ".$ramoIn." AND
								   t_cuenta  IN ".$tipo_cuentaIn." AND
								   tipo_poliza = '$tpoliza' ";
				   }//1
				   if ($cia=='' && $tipo_cuenta=='' && $ramo=='') {
					   $sql="SELECT * FROM comision INNER JOIN poliza, drecibo, dramo, dcia, tipo_poliza, rep_com WHERE 
									poliza.id_poliza = drecibo.idrecibo AND
									poliza.id_cod_ramo=dramo.cod_ramo AND
									rep_com.id_cia=dcia.idcia AND
									poliza.id_tpoliza=tipo_poliza.id_t_poliza AND
									comision.id_poliza=poliza.id_poliza AND
									rep_com.id_rep_com=comision.id_rep_com AND
									comision.cod_vend = '$asesor' AND
								   f_hastapoliza >= '$desde' AND
								   f_hastapoliza <= '$hasta' AND
								   tipo_poliza = '$tpoliza' ";
				   }//2
				   if ($cia!='' && $tipo_cuenta=='' && $ramo=='') {
   
					   // create sql part for IN condition by imploding comma after each id
					   $ciaIn = "('" . implode("','", $cia) ."')";
   
					   $sql="SELECT * FROM comision INNER JOIN poliza, drecibo, dramo, dcia, tipo_poliza, rep_com WHERE 
									poliza.id_poliza = drecibo.idrecibo AND
									poliza.id_cod_ramo=dramo.cod_ramo AND
									rep_com.id_cia=dcia.idcia AND
									poliza.id_tpoliza=tipo_poliza.id_t_poliza AND
									comision.id_poliza=poliza.id_poliza AND
									rep_com.id_rep_com=comision.id_rep_com AND
									comision.cod_vend = '$asesor' AND
								   f_hastapoliza >= '$desde' AND
								   f_hastapoliza <= '$hasta' AND
								   nomcia IN ".$ciaIn." AND
								   tipo_poliza = '$tpoliza' ";
				   }//3
				   if ($cia=='' && $tipo_cuenta!='' && $ramo=='') {
   
					   // create sql part for IN condition by imploding comma after each id
					   $tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";
   
						$sql="SELECT * FROM comision INNER JOIN poliza, drecibo, dramo, dcia, tipo_poliza, rep_com WHERE 
									poliza.id_poliza = drecibo.idrecibo AND
									poliza.id_cod_ramo=dramo.cod_ramo AND
									rep_com.id_cia=dcia.idcia AND
									poliza.id_tpoliza=tipo_poliza.id_t_poliza AND
									comision.id_poliza=poliza.id_poliza AND
									rep_com.id_rep_com=comision.id_rep_com AND
									comision.cod_vend = '$asesor' AND
								   f_hastapoliza >= '$desde' AND
								   f_hastapoliza <= '$hasta' AND
								   t_cuenta  IN ".$tipo_cuentaIn." AND
								   tipo_poliza = '$tpoliza' ";
				   }//4
				   if ($cia=='' && $tipo_cuenta=='' && $ramo!='') {
   
					   // create sql part for IN condition by imploding comma after each id
					   $ramoIn = "('" . implode("','", $ramo) ."')";
   
					   $sql="SELECT * FROM comision INNER JOIN poliza, drecibo, dramo, dcia, tipo_poliza, rep_com WHERE 
									poliza.id_poliza = drecibo.idrecibo AND
									poliza.id_cod_ramo=dramo.cod_ramo AND
									rep_com.id_cia=dcia.idcia AND
									poliza.id_tpoliza=tipo_poliza.id_t_poliza AND
									comision.id_poliza=poliza.id_poliza AND
									rep_com.id_rep_com=comision.id_rep_com AND
									comision.cod_vend = '$asesor' AND
								   f_hastapoliza >= '$desde' AND
								   f_hastapoliza <= '$hasta' AND
								   nramo IN ".$ramoIn." AND
								   tipo_poliza = '$tpoliza' ";
				   }//5
				   if ($cia!='' && $tipo_cuenta!='' && $ramo=='') {
					   // create sql part for IN condition by imploding comma after each id
					   $ciaIn = "('" . implode("','", $cia) ."')";
   
					   // create sql part for IN condition by imploding comma after each id
					   $tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";
   
					   $sql="SELECT * FROM comision INNER JOIN poliza, drecibo, dramo, dcia, tipo_poliza, rep_com WHERE 
									poliza.id_poliza = drecibo.idrecibo AND
									poliza.id_cod_ramo=dramo.cod_ramo AND
									rep_com.id_cia=dcia.idcia AND
									poliza.id_tpoliza=tipo_poliza.id_t_poliza AND
									comision.id_poliza=poliza.id_poliza AND
									rep_com.id_rep_com=comision.id_rep_com AND
									comision.cod_vend = '$asesor' AND
								   f_hastapoliza >= '$desde' AND
								   f_hastapoliza <= '$hasta' AND
								   nomcia IN ".$ciaIn." AND
								   t_cuenta  IN ".$tipo_cuentaIn." AND
								   tipo_poliza = '$tpoliza' ";
				   }//6
				   if ($cia=='' && $tipo_cuenta!='' && $ramo!='') {
					   // create sql part for IN condition by imploding comma after each id
					   $tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";
   
					   // create sql part for IN condition by imploding comma after each id
					   $ramoIn = "('" . implode("','", $ramo) ."')";
   
					   $sql="SELECT * FROM comision INNER JOIN poliza, drecibo, dramo, dcia, tipo_poliza, rep_com WHERE 
									poliza.id_poliza = drecibo.idrecibo AND
									poliza.id_cod_ramo=dramo.cod_ramo AND
									rep_com.id_cia=dcia.idcia AND
									poliza.id_tpoliza=tipo_poliza.id_t_poliza AND
									comision.id_poliza=poliza.id_poliza AND
									rep_com.id_rep_com=comision.id_rep_com AND
									comision.cod_vend = '$asesor' AND
								   f_hastapoliza >= '$desde' AND
								   f_hastapoliza <= '$hasta' AND
								   nramo IN ".$ramoIn." AND
								   t_cuenta  IN ".$tipo_cuentaIn." AND
								   tipo_poliza = '$tpoliza' ";
				   }//7
				   if ($cia!='' && $tipo_cuenta=='' && $ramo!='') {
					   // create sql part for IN condition by imploding comma after each id
					   $ciaIn = "('" . implode("','", $cia) ."')";
   
					   // create sql part for IN condition by imploding comma after each id
					   $ramoIn = "('" . implode("','", $ramo) ."')";
   
					   $sql="SELECT * FROM comision INNER JOIN poliza, drecibo, dramo, dcia, tipo_poliza, rep_com WHERE 
								poliza.id_poliza = drecibo.idrecibo AND
								poliza.id_cod_ramo=dramo.cod_ramo AND
								rep_com.id_cia=dcia.idcia AND
								poliza.id_tpoliza=tipo_poliza.id_t_poliza AND
								comision.id_poliza=poliza.id_poliza AND
								rep_com.id_rep_com=comision.id_rep_com AND
								comision.cod_vend = '$asesor' AND
							   f_hastapoliza >= '$desde' AND
							   f_hastapoliza <= '$hasta' AND
							   nomcia IN ".$ciaIn." AND
							   nramo IN ".$ramoIn." AND
							   tipo_poliza = '$tpoliza' ";
				   }//8
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


	public function get_distinct_element_cia($desde,$hasta,$ramo,$tipo_cuenta)
		    {		  
				if ($ramo!='' && $tipo_cuenta!='') {
					// create sql part for IN condition by imploding comma after each id
					$ramoIn = "('" . implode("','", $ramo) ."')";

					// create sql part for IN condition by imploding comma after each id
					$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";

					$sql="SELECT DISTINCT nomcia FROM poliza, dcia, dramo WHERE 
								poliza.id_cia=dcia.idcia AND
								poliza.id_cod_ramo=dramo.cod_ramo AND
								f_hastapoliza >= '$desde' AND
								f_hastapoliza <= '$hasta' AND
								nramo IN ".$ramoIn." AND
								t_cuenta  IN ".$tipo_cuentaIn." ";
				}
				if ($ramo=='' && $tipo_cuenta=='') {
					$sql="SELECT DISTINCT nomcia FROM poliza, dcia, dramo WHERE 
								poliza.id_cia=dcia.idcia AND
								poliza.id_cod_ramo=dramo.cod_ramo AND
								f_hastapoliza >= '$desde' AND
								f_hastapoliza <= '$hasta' ";
				}
				if ($ramo=='' && $tipo_cuenta!='') {

					// create sql part for IN condition by imploding comma after each id
					$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";

					$sql="SELECT DISTINCT nomcia FROM poliza, dcia, dramo WHERE 
								poliza.id_cia=dcia.idcia AND
								poliza.id_cod_ramo=dramo.cod_ramo AND
								f_hastapoliza >= '$desde' AND
								f_hastapoliza <= '$hasta' AND
								t_cuenta  IN ".$tipo_cuentaIn." ";
				}
				if ($tipo_cuenta=='' && $ramo!='') {

					// create sql part for IN condition by imploding comma after each id
					$ramoIn = "('" . implode("','", $ramo) ."')";

					$sql="SELECT DISTINCT nomcia FROM poliza, dcia, dramo WHERE 
								poliza.id_cia=dcia.idcia AND
								poliza.id_cod_ramo=dramo.cod_ramo AND
								f_hastapoliza >= '$desde' AND
								f_hastapoliza <= '$hasta' AND
								nramo IN ".$ramoIn."  ";
				}
				$res=mysqli_query(Conectar::con(),$sql);
				
				if (!$res) {
				    //No hay registros
				}else{
					$filas=mysqli_num_rows($res); 
					if ($filas == 0) { 
						header("Location: busqueda_cia.php?m=2#nombre");
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
		
		public function get_distinct_element_cia_by_user($desde,$hasta,$ramo,$tipo_cuenta,$asesor)
		    {		   
				if ($ramo!='' && $tipo_cuenta!='') {
					// create sql part for IN condition by imploding comma after each id
					$ramoIn = "('" . implode("','", $ramo) ."')";

					// create sql part for IN condition by imploding comma after each id
					$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";

					$sql="SELECT DISTINCT nomcia FROM poliza, dcia, dramo WHERE 
								poliza.id_cia=dcia.idcia AND
								poliza.id_cod_ramo=dramo.cod_ramo AND
								f_hastapoliza >= '$desde' AND
								f_hastapoliza <= '$hasta' AND
								poliza.codvend = '$asesor' AND
								nramo IN ".$ramoIn." AND
								t_cuenta  IN ".$tipo_cuentaIn." ";
				}
				if ($ramo=='' && $tipo_cuenta=='') {
					$sql="SELECT DISTINCT nomcia FROM poliza, dcia, dramo WHERE 
								poliza.id_cia=dcia.idcia AND
								poliza.id_cod_ramo=dramo.cod_ramo AND
								poliza.codvend = '$asesor' AND
								f_hastapoliza >= '$desde' AND
								f_hastapoliza <= '$hasta' ";
				}
				if ($ramo=='' && $tipo_cuenta!='') {

					// create sql part for IN condition by imploding comma after each id
					$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";

					$sql="SELECT DISTINCT nomcia FROM poliza, dcia, dramo WHERE 
								poliza.id_cia=dcia.idcia AND
								poliza.id_cod_ramo=dramo.cod_ramo AND
								f_hastapoliza >= '$desde' AND
								f_hastapoliza <= '$hasta' AND
								poliza.codvend = '$asesor' AND
								t_cuenta  IN ".$tipo_cuentaIn." ";
				}
				if ($tipo_cuenta=='' && $ramo!='') {

					// create sql part for IN condition by imploding comma after each id
					$ramoIn = "('" . implode("','", $ramo) ."')";

					$sql="SELECT DISTINCT nomcia FROM poliza, dcia, dramo WHERE 
								poliza.id_cia=dcia.idcia AND
								poliza.id_cod_ramo=dramo.cod_ramo AND
								f_hastapoliza >= '$desde' AND
								f_hastapoliza <= '$hasta' AND
								poliza.codvend = '$asesor' AND
								nramo IN ".$ramoIn."  ";
				}
				$res=mysqli_query(Conectar::con(),$sql);
				
				if (!$res) {
				    //No hay registros
				}else{
					$filas=mysqli_num_rows($res); 
					if ($filas == 0) { 
						header("Location: busqueda_cia.php?m=2#nombre");
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
			   

		public function get_distinct_element_cia_pc($desde,$hasta,$ramo,$tipo_cuenta)
			   {		  
				   if ($ramo!='' && $tipo_cuenta!='') {
					   // create sql part for IN condition by imploding comma after each id
					   $ramoIn = "('" . implode("','", $ramo) ."')";
   
					   // create sql part for IN condition by imploding comma after each id
					   $tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";
   
					   $sql="SELECT DISTINCT nomcia FROM poliza, dcia, dramo, comision, rep_com WHERE 
								   rep_com.id_cia=dcia.idcia AND
								   rep_com.id_rep_com=comision.id_rep_com AND
								   poliza.id_cod_ramo=dramo.cod_ramo AND
								   poliza.id_poliza=comision.id_poliza AND 
								   f_hastapoliza >= '$desde' AND
								   f_hastapoliza <= '$hasta' AND
								   nramo IN ".$ramoIn." AND
								   t_cuenta  IN ".$tipo_cuentaIn." ";
				   }
				   if ($ramo=='' && $tipo_cuenta=='') {
					   $sql="SELECT DISTINCT nomcia FROM poliza, dcia, dramo, comision, rep_com WHERE 
								   rep_com.id_cia=dcia.idcia AND
								   rep_com.id_rep_com=comision.id_rep_com AND
								   poliza.id_cod_ramo=dramo.cod_ramo AND
								   poliza.id_poliza=comision.id_poliza AND 
								   f_hastapoliza >= '$desde' AND
								   f_hastapoliza <= '$hasta' ";
				   }
				   if ($ramo=='' && $tipo_cuenta!='') {
   
					   // create sql part for IN condition by imploding comma after each id
					   $tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";
   
					   $sql="SELECT DISTINCT nomcia FROM poliza, dcia, dramo, comision, rep_com WHERE 
								   rep_com.id_cia=dcia.idcia AND
								   rep_com.id_rep_com=comision.id_rep_com AND
								   poliza.id_cod_ramo=dramo.cod_ramo AND
								   poliza.id_poliza=comision.id_poliza AND 
								   f_hastapoliza >= '$desde' AND
								   f_hastapoliza <= '$hasta' AND
								   t_cuenta  IN ".$tipo_cuentaIn." ";
				   }
				   if ($tipo_cuenta=='' && $ramo!='') {
   
					   // create sql part for IN condition by imploding comma after each id
					   $ramoIn = "('" . implode("','", $ramo) ."')";
   
					   $sql="SELECT DISTINCT nomcia FROM poliza, dcia, dramo, comision, rep_com WHERE 
								   rep_com.id_cia=dcia.idcia AND
								   rep_com.id_rep_com=comision.id_rep_com AND
								   poliza.id_cod_ramo=dramo.cod_ramo AND
								   poliza.id_poliza=comision.id_poliza AND 
								   f_hastapoliza >= '$desde' AND
								   f_hastapoliza <= '$hasta' AND
								   nramo IN ".$ramoIn."  ";
				   }
				   $res=mysqli_query(Conectar::con(),$sql);
				   
				   if (!$res) {
					   //No hay registros
				   }else{
					   $filas=mysqli_num_rows($res); 
					   if ($filas == 0) { 
						   header("Location: busqueda_cia.php?m=2#nombre");
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

			public function get_distinct_element_cia_pc_by_user($desde,$hasta,$ramo,$tipo_cuenta,$asesor)
			   {		  
				   if ($ramo!='' && $tipo_cuenta!='') {
					   // create sql part for IN condition by imploding comma after each id
					   $ramoIn = "('" . implode("','", $ramo) ."')";
   
					   // create sql part for IN condition by imploding comma after each id
					   $tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";
   
					   $sql="SELECT DISTINCT nomcia FROM poliza, dcia, dramo, comision, rep_com WHERE 
								   rep_com.id_cia=dcia.idcia AND
								   rep_com.id_rep_com=comision.id_rep_com AND
								   poliza.id_cod_ramo=dramo.cod_ramo AND
								   poliza.id_poliza=comision.id_poliza AND 
								   comision.cod_vend = '$asesor' AND
								   f_hastapoliza >= '$desde' AND
								   f_hastapoliza <= '$hasta' AND
								   nramo IN ".$ramoIn." AND
								   t_cuenta  IN ".$tipo_cuentaIn." ";
				   }
				   if ($ramo=='' && $tipo_cuenta=='') {
					   $sql="SELECT DISTINCT nomcia FROM poliza, dcia, dramo, comision, rep_com WHERE 
								   rep_com.id_cia=dcia.idcia AND
								   rep_com.id_rep_com=comision.id_rep_com AND
								   poliza.id_cod_ramo=dramo.cod_ramo AND
								   poliza.id_poliza=comision.id_poliza AND 
								   comision.cod_vend = '$asesor' AND
								   f_hastapoliza >= '$desde' AND
								   f_hastapoliza <= '$hasta' ";
				   }
				   if ($ramo=='' && $tipo_cuenta!='') {
   
					   // create sql part for IN condition by imploding comma after each id
					   $tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";
   
					   $sql="SELECT DISTINCT nomcia FROM poliza, dcia, dramo, comision, rep_com WHERE 
								   rep_com.id_cia=dcia.idcia AND
								   rep_com.id_rep_com=comision.id_rep_com AND
								   poliza.id_cod_ramo=dramo.cod_ramo AND
								   poliza.id_poliza=comision.id_poliza AND 
								   comision.cod_vend = '$asesor' AND
								   f_hastapoliza >= '$desde' AND
								   f_hastapoliza <= '$hasta' AND
								   t_cuenta  IN ".$tipo_cuentaIn." ";
				   }
				   if ($tipo_cuenta=='' && $ramo!='') {
   
					   // create sql part for IN condition by imploding comma after each id
					   $ramoIn = "('" . implode("','", $ramo) ."')";
   
					   $sql="SELECT DISTINCT nomcia FROM poliza, dcia, dramo, comision, rep_com WHERE 
								   rep_com.id_cia=dcia.idcia AND
								   rep_com.id_rep_com=comision.id_rep_com AND
								   poliza.id_cod_ramo=dramo.cod_ramo AND
								   poliza.id_poliza=comision.id_poliza AND 
								   comision.cod_vend = '$asesor' AND
								   f_hastapoliza >= '$desde' AND
								   f_hastapoliza <= '$hasta' AND
								   nramo IN ".$ramoIn."  ";
				   }
				   $res=mysqli_query(Conectar::con(),$sql);
				   
				   if (!$res) {
					   //No hay registros
				   }else{
					   $filas=mysqli_num_rows($res); 
					   if ($filas == 0) { 
						   header("Location: busqueda_cia.php?m=2#nombre");
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




	public function get_poliza_graf_3($cia,$ramo,$desde,$hasta,$tipo_cuenta)
		    {
						  
				if ($ramo!='' && $tipo_cuenta!='') {
					// create sql part for IN condition by imploding comma after each id
					$ramoIn = "('" . implode("','", $ramo) ."')";

					// create sql part for IN condition by imploding comma after each id
					$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";

					$sql="SELECT * FROM poliza, drecibo, dramo, dcia WHERE 
								poliza.id_poliza = drecibo.idrecibo AND
								poliza.id_cod_ramo=dramo.cod_ramo AND
								poliza.id_cia=dcia.idcia AND
								f_hastapoliza >= '$desde' AND
								f_hastapoliza <= '$hasta' AND
								nramo IN ".$ramoIn." AND
								t_cuenta  IN ".$tipo_cuentaIn." AND
								nomcia = '$cia'";
				}
				if ($ramo=='' && $tipo_cuenta=='') {
					$sql="SELECT * FROM poliza, drecibo, dramo, dcia WHERE 
								poliza.id_poliza = drecibo.idrecibo AND
								poliza.id_cod_ramo=dramo.cod_ramo AND
								poliza.id_cia=dcia.idcia AND
								f_hastapoliza >= '$desde' AND
								f_hastapoliza <= '$hasta' AND
								nomcia = '$cia'";
				}
				if ($ramo=='' && $tipo_cuenta!='') {

					// create sql part for IN condition by imploding comma after each id
					$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";

					$sql="SELECT * FROM poliza, drecibo, dramo, dcia WHERE 
								poliza.id_poliza = drecibo.idrecibo AND
								poliza.id_cod_ramo=dramo.cod_ramo AND
								poliza.id_cia=dcia.idcia AND
								f_hastapoliza >= '$desde' AND
								f_hastapoliza <= '$hasta' AND
								t_cuenta  IN ".$tipo_cuentaIn." AND
								nomcia = '$cia'";
				}
				if ($tipo_cuenta=='' && $ramo!='') {

					// create sql part for IN condition by imploding comma after each id
					$ramoIn = "('" . implode("','", $ramo) ."')";

					$sql="SELECT * FROM poliza, drecibo, dramo, dcia WHERE 
								poliza.id_poliza = drecibo.idrecibo AND
								poliza.id_cod_ramo=dramo.cod_ramo AND
								poliza.id_cia=dcia.idcia AND
								f_hastapoliza >= '$desde' AND
								f_hastapoliza <= '$hasta' AND
								nramo IN ".$ramoIn." AND
								nomcia = '$cia'";
				}
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

		public function get_poliza_graf_3_by_user($cia,$ramo,$desde,$hasta,$tipo_cuenta,$asesor)
		    {		  
				if ($ramo!='' && $tipo_cuenta!='') {
					// create sql part for IN condition by imploding comma after each id
					$ramoIn = "('" . implode("','", $ramo) ."')";

					// create sql part for IN condition by imploding comma after each id
					$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";

					$sql="SELECT * FROM poliza, drecibo, dramo, dcia WHERE 
								poliza.id_poliza = drecibo.idrecibo AND
								poliza.id_cod_ramo=dramo.cod_ramo AND
								poliza.id_cia=dcia.idcia AND
								f_hastapoliza >= '$desde' AND
								f_hastapoliza <= '$hasta' AND
								poliza.codvend = '$asesor' AND
								nramo IN ".$ramoIn." AND
								t_cuenta  IN ".$tipo_cuentaIn." AND
								nomcia = '$cia'";
				}
				if ($ramo=='' && $tipo_cuenta=='') {
					$sql="SELECT * FROM poliza, drecibo, dramo, dcia WHERE 
								poliza.id_poliza = drecibo.idrecibo AND
								poliza.id_cod_ramo=dramo.cod_ramo AND
								poliza.id_cia=dcia.idcia AND
								poliza.codvend = '$asesor' AND
								f_hastapoliza >= '$desde' AND
								f_hastapoliza <= '$hasta' AND
								nomcia = '$cia'";
				}
				if ($ramo=='' && $tipo_cuenta!='') {

					// create sql part for IN condition by imploding comma after each id
					$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";

					$sql="SELECT * FROM poliza, drecibo, dramo, dcia WHERE 
								poliza.id_poliza = drecibo.idrecibo AND
								poliza.id_cod_ramo=dramo.cod_ramo AND
								poliza.id_cia=dcia.idcia AND
								f_hastapoliza >= '$desde' AND
								f_hastapoliza <= '$hasta' AND
								poliza.codvend = '$asesor' AND
								t_cuenta  IN ".$tipo_cuentaIn." AND
								nomcia = '$cia'";
				}
				if ($tipo_cuenta=='' && $ramo!='') {

					// create sql part for IN condition by imploding comma after each id
					$ramoIn = "('" . implode("','", $ramo) ."')";

					$sql="SELECT * FROM poliza, drecibo, dramo, dcia WHERE 
								poliza.id_poliza = drecibo.idrecibo AND
								poliza.id_cod_ramo=dramo.cod_ramo AND
								poliza.id_cia=dcia.idcia AND
								f_hastapoliza >= '$desde' AND
								f_hastapoliza <= '$hasta' AND
								poliza.codvend = '$asesor' AND
								nramo IN ".$ramoIn." AND
								nomcia = '$cia'";
				}
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
			   

		public function get_poliza_graf_3_pc($cia,$ramo,$desde,$hasta,$tipo_cuenta)
			   {
							 
				   if ($ramo!='' && $tipo_cuenta!='') {
					   // create sql part for IN condition by imploding comma after each id
					   $ramoIn = "('" . implode("','", $ramo) ."')";
   
					   // create sql part for IN condition by imploding comma after each id
					   $tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";
   
					   $sql="SELECT * FROM comision INNER JOIN poliza, drecibo, dramo, dcia, rep_com WHERE 
									poliza.id_poliza = drecibo.idrecibo AND
									poliza.id_cod_ramo=dramo.cod_ramo AND
									rep_com.id_cia=dcia.idcia AND
									comision.id_poliza=poliza.id_poliza AND
									rep_com.id_rep_com=comision.id_rep_com AND
									f_hastapoliza >= '$desde' AND
									f_hastapoliza <= '$hasta' AND
									nramo IN ".$ramoIn." AND
									t_cuenta  IN ".$tipo_cuentaIn." AND
									nomcia = '$cia'";
				   }
				   if ($ramo=='' && $tipo_cuenta=='') {
					   $sql="SELECT * FROM comision INNER JOIN poliza, drecibo, dramo, dcia, rep_com WHERE 
									poliza.id_poliza = drecibo.idrecibo AND
									poliza.id_cod_ramo=dramo.cod_ramo AND
									rep_com.id_cia=dcia.idcia AND
									comision.id_poliza=poliza.id_poliza AND
									rep_com.id_rep_com=comision.id_rep_com AND
									f_hastapoliza >= '$desde' AND
									f_hastapoliza <= '$hasta' AND
									nomcia = '$cia'";
				   }
				   if ($ramo=='' && $tipo_cuenta!='') {
   
					   // create sql part for IN condition by imploding comma after each id
					   $tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";
   
					   $sql="SELECT * FROM comision INNER JOIN poliza, drecibo, dramo, dcia, rep_com WHERE 
									poliza.id_poliza = drecibo.idrecibo AND
									poliza.id_cod_ramo=dramo.cod_ramo AND
									rep_com.id_cia=dcia.idcia AND
									comision.id_poliza=poliza.id_poliza AND
									rep_com.id_rep_com=comision.id_rep_com AND
									f_hastapoliza >= '$desde' AND
									f_hastapoliza <= '$hasta' AND
									t_cuenta  IN ".$tipo_cuentaIn." AND
									nomcia = '$cia'";
				   }
				   if ($tipo_cuenta=='' && $ramo!='') {
   
					   // create sql part for IN condition by imploding comma after each id
					   $ramoIn = "('" . implode("','", $ramo) ."')";
   
					   $sql="SELECT * FROM comision INNER JOIN poliza, drecibo, dramo, dcia, rep_com WHERE 
									poliza.id_poliza = drecibo.idrecibo AND
									poliza.id_cod_ramo=dramo.cod_ramo AND
									rep_com.id_cia=dcia.idcia AND
									comision.id_poliza=poliza.id_poliza AND
									rep_com.id_rep_com=comision.id_rep_com AND
									f_hastapoliza >= '$desde' AND
									f_hastapoliza <= '$hasta' AND
									nramo IN ".$ramoIn." AND
									nomcia = '$cia'";
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

			public function get_poliza_graf_3_pc_by_user($cia,$ramo,$desde,$hasta,$tipo_cuenta,$asesor)
			   {
							 
				   if ($ramo!='' && $tipo_cuenta!='') {
					   // create sql part for IN condition by imploding comma after each id
					   $ramoIn = "('" . implode("','", $ramo) ."')";
   
					   // create sql part for IN condition by imploding comma after each id
					   $tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";
   
					   $sql="SELECT * FROM comision INNER JOIN poliza, drecibo, dramo, dcia, rep_com WHERE 
									poliza.id_poliza = drecibo.idrecibo AND
									poliza.id_cod_ramo=dramo.cod_ramo AND
									rep_com.id_cia=dcia.idcia AND
									comision.id_poliza=poliza.id_poliza AND
									rep_com.id_rep_com=comision.id_rep_com AND
									comision.cod_vend = '$asesor' AND
									f_hastapoliza >= '$desde' AND
									f_hastapoliza <= '$hasta' AND
									nramo IN ".$ramoIn." AND
									t_cuenta  IN ".$tipo_cuentaIn." AND
									nomcia = '$cia'";
				   }
				   if ($ramo=='' && $tipo_cuenta=='') {
					   $sql="SELECT * FROM comision INNER JOIN poliza, drecibo, dramo, dcia, rep_com WHERE 
									poliza.id_poliza = drecibo.idrecibo AND
									poliza.id_cod_ramo=dramo.cod_ramo AND
									rep_com.id_cia=dcia.idcia AND
									comision.id_poliza=poliza.id_poliza AND
									rep_com.id_rep_com=comision.id_rep_com AND
									comision.cod_vend = '$asesor' AND
									f_hastapoliza >= '$desde' AND
									f_hastapoliza <= '$hasta' AND
									nomcia = '$cia'";
				   }
				   if ($ramo=='' && $tipo_cuenta!='') {
   
					   // create sql part for IN condition by imploding comma after each id
					   $tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";
   
					   $sql="SELECT * FROM comision INNER JOIN poliza, drecibo, dramo, dcia, rep_com WHERE 
									poliza.id_poliza = drecibo.idrecibo AND
									poliza.id_cod_ramo=dramo.cod_ramo AND
									rep_com.id_cia=dcia.idcia AND
									comision.id_poliza=poliza.id_poliza AND
									rep_com.id_rep_com=comision.id_rep_com AND
									comision.cod_vend = '$asesor' AND
									f_hastapoliza >= '$desde' AND
									f_hastapoliza <= '$hasta' AND
									t_cuenta  IN ".$tipo_cuentaIn." AND
									nomcia = '$cia'";
				   }
				   if ($tipo_cuenta=='' && $ramo!='') {
   
					   // create sql part for IN condition by imploding comma after each id
					   $ramoIn = "('" . implode("','", $ramo) ."')";
   
					   $sql="SELECT * FROM comision INNER JOIN poliza, drecibo, dramo, dcia, rep_com WHERE 
									poliza.id_poliza = drecibo.idrecibo AND
									poliza.id_cod_ramo=dramo.cod_ramo AND
									rep_com.id_cia=dcia.idcia AND
									comision.id_poliza=poliza.id_poliza AND
									rep_com.id_rep_com=comision.id_rep_com AND
									comision.cod_vend = '$asesor' AND
									f_hastapoliza >= '$desde' AND
									f_hastapoliza <= '$hasta' AND
									nramo IN ".$ramoIn." AND
									nomcia = '$cia'";
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


//--------------------FIN GRÁFICO 3 CIA-------------------		   

//--------------------GRÁFICO 4 FPAGO-------------------


	public function get_distinct_element_fpago($desde,$hasta,$cia,$ramo,$tipo_cuenta)
		    {

				if ($cia!='' && $tipo_cuenta!='' && $ramo!='') {
					// create sql part for IN condition by imploding comma after each id
					$ciaIn = "('" . implode("','", $cia) ."')";

					// create sql part for IN condition by imploding comma after each id
					$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";

					// create sql part for IN condition by imploding comma after each id
					$ramoIn = "('" . implode("','", $ramo) ."')";

					$sql="SELECT DISTINCT fpago FROM poliza, drecibo, dcia, dramo WHERE 
								poliza.id_poliza = drecibo.idrecibo AND
								poliza.id_cia=dcia.idcia AND
								poliza.id_cod_ramo=dramo.cod_ramo AND
								f_hastapoliza >= '$desde' AND
								f_hastapoliza <= '$hasta' AND
								nomcia IN ".$ciaIn." AND
								nramo IN ".$ramoIn." AND
								t_cuenta  IN ".$tipo_cuentaIn."
								ORDER BY fpago ASC ";
				}//1
				if ($cia=='' && $tipo_cuenta=='' && $ramo=='') {
					$sql="SELECT DISTINCT fpago FROM poliza, drecibo, dcia, dramo WHERE 
								poliza.id_poliza = drecibo.idrecibo AND
								poliza.id_cia=dcia.idcia AND
								poliza.id_cod_ramo=dramo.cod_ramo AND
								f_hastapoliza >= '$desde' AND
								f_hastapoliza <= '$hasta'
								ORDER BY fpago ASC ";
				}//2
				if ($cia!='' && $tipo_cuenta=='' && $ramo=='') {

					// create sql part for IN condition by imploding comma after each id
					$ciaIn = "('" . implode("','", $cia) ."')";

					$sql="SELECT DISTINCT fpago FROM poliza, drecibo, dcia, dramo WHERE 
								poliza.id_poliza = drecibo.idrecibo AND
								poliza.id_cia=dcia.idcia AND
								poliza.id_cod_ramo=dramo.cod_ramo AND
								f_hastapoliza >= '$desde' AND
								f_hastapoliza <= '$hasta' AND
								nomcia IN ".$ciaIn."
								ORDER BY fpago ASC ";
				}//3
				if ($cia=='' && $tipo_cuenta!='' && $ramo=='') {

					// create sql part for IN condition by imploding comma after each id
					$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";

					$sql="SELECT DISTINCT fpago FROM poliza, drecibo, dcia, dramo WHERE 
								poliza.id_poliza = drecibo.idrecibo AND
								poliza.id_cia=dcia.idcia AND
								poliza.id_cod_ramo=dramo.cod_ramo AND
								f_hastapoliza >= '$desde' AND
								f_hastapoliza <= '$hasta' AND
								t_cuenta  IN ".$tipo_cuentaIn."
								ORDER BY fpago ASC ";
				}//4
				if ($cia=='' && $tipo_cuenta=='' && $ramo!='') {

					// create sql part for IN condition by imploding comma after each id
					$ramoIn = "('" . implode("','", $ramo) ."')";

					$sql="SELECT DISTINCT fpago FROM poliza, drecibo, dcia, dramo WHERE 
								poliza.id_poliza = drecibo.idrecibo AND
								poliza.id_cia=dcia.idcia AND
								poliza.id_cod_ramo=dramo.cod_ramo AND
								f_hastapoliza >= '$desde' AND
								f_hastapoliza <= '$hasta' AND
								nramo IN ".$ramoIn." 
								ORDER BY fpago ASC ";
				}//5
				if ($cia!='' && $tipo_cuenta!='' && $ramo=='') {
					// create sql part for IN condition by imploding comma after each id
					$ciaIn = "('" . implode("','", $cia) ."')";

					// create sql part for IN condition by imploding comma after each id
					$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";

					$sql="SELECT DISTINCT fpago FROM poliza, drecibo, dcia, dramo WHERE 
								poliza.id_poliza = drecibo.idrecibo AND
								poliza.id_cia=dcia.idcia AND
								poliza.id_cod_ramo=dramo.cod_ramo AND
								f_hastapoliza >= '$desde' AND
								f_hastapoliza <= '$hasta' AND
								nomcia IN ".$ciaIn." AND
								t_cuenta  IN ".$tipo_cuentaIn."
								ORDER BY fpago ASC ";
				}//6
				if ($cia=='' && $tipo_cuenta!='' && $ramo!='') {
					// create sql part for IN condition by imploding comma after each id
					$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";

					// create sql part for IN condition by imploding comma after each id
					$ramoIn = "('" . implode("','", $ramo) ."')";

					$sql="SELECT DISTINCT fpago FROM poliza, drecibo, dcia, dramo WHERE 
								poliza.id_poliza = drecibo.idrecibo AND
								poliza.id_cia=dcia.idcia AND
								poliza.id_cod_ramo=dramo.cod_ramo AND
								f_hastapoliza >= '$desde' AND
								f_hastapoliza <= '$hasta' AND
								nramo IN ".$ramoIn." AND
								t_cuenta  IN ".$tipo_cuentaIn."
								ORDER BY fpago ASC ";
				}//7
				if ($cia!='' && $tipo_cuenta=='' && $ramo!='') {
					// create sql part for IN condition by imploding comma after each id
					$ciaIn = "('" . implode("','", $cia) ."')";

					// create sql part for IN condition by imploding comma after each id
					$ramoIn = "('" . implode("','", $ramo) ."')";

					$sql="SELECT DISTINCT fpago FROM poliza, drecibo, dcia, dramo WHERE 
								poliza.id_poliza = drecibo.idrecibo AND
								poliza.id_cia=dcia.idcia AND
								poliza.id_cod_ramo=dramo.cod_ramo AND
								f_hastapoliza >= '$desde' AND
								f_hastapoliza <= '$hasta' AND
								nomcia IN ".$ciaIn." AND
								nramo IN ".$ramoIn."
								ORDER BY fpago ASC  ";
				}//8
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
			   
	
		public function get_distinct_element_fpago_pc($desde,$hasta,$cia,$ramo,$tipo_cuenta)
			   {
   
				   if ($cia!='' && $tipo_cuenta!='' && $ramo!='') {
					   // create sql part for IN condition by imploding comma after each id
					   $ciaIn = "('" . implode("','", $cia) ."')";
   
					   // create sql part for IN condition by imploding comma after each id
					   $tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";
   
					   // create sql part for IN condition by imploding comma after each id
					   $ramoIn = "('" . implode("','", $ramo) ."')";
   
					   $sql="SELECT DISTINCT fpago FROM poliza, drecibo, dcia, dramo, comision, rep_com WHERE 
								   poliza.id_poliza = drecibo.idrecibo AND
								   rep_com.id_cia=dcia.idcia AND
								   poliza.id_cod_ramo=dramo.cod_ramo AND
								   rep_com.id_rep_com=comision.id_rep_com AND
								   poliza.id_poliza=comision.id_poliza AND
								   f_hastapoliza >= '$desde' AND
								   f_hastapoliza <= '$hasta' AND
								   nomcia IN ".$ciaIn." AND
								   nramo IN ".$ramoIn." AND
								   t_cuenta  IN ".$tipo_cuentaIn."
								   ORDER BY fpago ASC ";
				   }//1
				   if ($cia=='' && $tipo_cuenta=='' && $ramo=='') {
					   $sql="SELECT DISTINCT fpago FROM poliza, drecibo, dcia, dramo, comision, rep_com WHERE 
									poliza.id_poliza = drecibo.idrecibo AND
									rep_com.id_cia=dcia.idcia AND
									poliza.id_cod_ramo=dramo.cod_ramo AND
									rep_com.id_rep_com=comision.id_rep_com AND
									poliza.id_poliza=comision.id_poliza AND
								   f_hastapoliza >= '$desde' AND
								   f_hastapoliza <= '$hasta'
								   ORDER BY fpago ASC ";
				   }//2
				   if ($cia!='' && $tipo_cuenta=='' && $ramo=='') {
   
					   // create sql part for IN condition by imploding comma after each id
					   $ciaIn = "('" . implode("','", $cia) ."')";
   
					   $sql="SELECT DISTINCT fpago FROM poliza, drecibo, dcia, dramo, comision, rep_com WHERE 
									poliza.id_poliza = drecibo.idrecibo AND
									rep_com.id_cia=dcia.idcia AND
									poliza.id_cod_ramo=dramo.cod_ramo AND
									rep_com.id_rep_com=comision.id_rep_com AND
									poliza.id_poliza=comision.id_poliza AND
								   f_hastapoliza >= '$desde' AND
								   f_hastapoliza <= '$hasta' AND
								   nomcia IN ".$ciaIn."
								   ORDER BY fpago ASC ";
				   }//3
				   if ($cia=='' && $tipo_cuenta!='' && $ramo=='') {
   
					   // create sql part for IN condition by imploding comma after each id
					   $tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";
   
					   $sql="SELECT DISTINCT fpago FROM poliza, drecibo, dcia, dramo, comision, rep_com WHERE 
									poliza.id_poliza = drecibo.idrecibo AND
									rep_com.id_cia=dcia.idcia AND
									poliza.id_cod_ramo=dramo.cod_ramo AND
									rep_com.id_rep_com=comision.id_rep_com AND
									poliza.id_poliza=comision.id_poliza AND
								   f_hastapoliza >= '$desde' AND
								   f_hastapoliza <= '$hasta' AND
								   t_cuenta  IN ".$tipo_cuentaIn."
								   ORDER BY fpago ASC ";
				   }//4
				   if ($cia=='' && $tipo_cuenta=='' && $ramo!='') {
   
					   // create sql part for IN condition by imploding comma after each id
					   $ramoIn = "('" . implode("','", $ramo) ."')";
   
					   $sql="SELECT DISTINCT fpago FROM poliza, drecibo, dcia, dramo, comision, rep_com WHERE 
									poliza.id_poliza = drecibo.idrecibo AND
									rep_com.id_cia=dcia.idcia AND
									poliza.id_cod_ramo=dramo.cod_ramo AND
									rep_com.id_rep_com=comision.id_rep_com AND
									poliza.id_poliza=comision.id_poliza AND
								   f_hastapoliza >= '$desde' AND
								   f_hastapoliza <= '$hasta' AND
								   nramo IN ".$ramoIn." 
								   ORDER BY fpago ASC ";
				   }//5
				   if ($cia!='' && $tipo_cuenta!='' && $ramo=='') {
					   // create sql part for IN condition by imploding comma after each id
					   $ciaIn = "('" . implode("','", $cia) ."')";
   
					   // create sql part for IN condition by imploding comma after each id
					   $tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";
   
					   $sql="SELECT DISTINCT fpago FROM poliza, drecibo, dcia, dramo, comision, rep_com WHERE 
									poliza.id_poliza = drecibo.idrecibo AND
									rep_com.id_cia=dcia.idcia AND
									poliza.id_cod_ramo=dramo.cod_ramo AND
									rep_com.id_rep_com=comision.id_rep_com AND
									poliza.id_poliza=comision.id_poliza AND
								   f_hastapoliza >= '$desde' AND
								   f_hastapoliza <= '$hasta' AND
								   nomcia IN ".$ciaIn." AND
								   t_cuenta  IN ".$tipo_cuentaIn."
								   ORDER BY fpago ASC ";
				   }//6
				   if ($cia=='' && $tipo_cuenta!='' && $ramo!='') {
					   // create sql part for IN condition by imploding comma after each id
					   $tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";
   
					   // create sql part for IN condition by imploding comma after each id
					   $ramoIn = "('" . implode("','", $ramo) ."')";
   
					   $sql="SELECT DISTINCT fpago FROM poliza, drecibo, dcia, dramo, comision, rep_com WHERE 
									poliza.id_poliza = drecibo.idrecibo AND
									rep_com.id_cia=dcia.idcia AND
									poliza.id_cod_ramo=dramo.cod_ramo AND
									rep_com.id_rep_com=comision.id_rep_com AND
									poliza.id_poliza=comision.id_poliza AND
								   f_hastapoliza >= '$desde' AND
								   f_hastapoliza <= '$hasta' AND
								   nramo IN ".$ramoIn." AND
								   t_cuenta  IN ".$tipo_cuentaIn."
								   ORDER BY fpago ASC ";
				   }//7
				   if ($cia!='' && $tipo_cuenta=='' && $ramo!='') {
					   // create sql part for IN condition by imploding comma after each id
					   $ciaIn = "('" . implode("','", $cia) ."')";
   
					   // create sql part for IN condition by imploding comma after each id
					   $ramoIn = "('" . implode("','", $ramo) ."')";
   
					   $sql="SELECT DISTINCT fpago FROM poliza, drecibo, dcia, dramo, comision, rep_com WHERE 
									poliza.id_poliza = drecibo.idrecibo AND
									rep_com.id_cia=dcia.idcia AND
									poliza.id_cod_ramo=dramo.cod_ramo AND
									rep_com.id_rep_com=comision.id_rep_com AND
									poliza.id_poliza=comision.id_poliza AND
								   f_hastapoliza >= '$desde' AND
								   f_hastapoliza <= '$hasta' AND
								   nomcia IN ".$ciaIn." AND
								   nramo IN ".$ramoIn."
								   ORDER BY fpago ASC  ";
				   }//8
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

			public function get_distinct_element_fpago_pc_by_user($desde,$hasta,$cia,$ramo,$tipo_cuenta,$asesor)
			   {
   
				   if ($cia!='' && $tipo_cuenta!='' && $ramo!='') {
					   // create sql part for IN condition by imploding comma after each id
					   $ciaIn = "('" . implode("','", $cia) ."')";
   
					   // create sql part for IN condition by imploding comma after each id
					   $tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";
   
					   // create sql part for IN condition by imploding comma after each id
					   $ramoIn = "('" . implode("','", $ramo) ."')";
   
					   $sql="SELECT DISTINCT fpago FROM poliza, drecibo, dcia, dramo, comision, rep_com WHERE 
								   poliza.id_poliza = drecibo.idrecibo AND
								   rep_com.id_cia=dcia.idcia AND
								   poliza.id_cod_ramo=dramo.cod_ramo AND
								   rep_com.id_rep_com=comision.id_rep_com AND
								   poliza.id_poliza=comision.id_poliza AND
								   comision.cod_vend = '$asesor' AND
								   f_hastapoliza >= '$desde' AND
								   f_hastapoliza <= '$hasta' AND
								   nomcia IN ".$ciaIn." AND
								   nramo IN ".$ramoIn." AND
								   t_cuenta  IN ".$tipo_cuentaIn."
								   ORDER BY fpago ASC ";
				   }//1
				   if ($cia=='' && $tipo_cuenta=='' && $ramo=='') {
					   $sql="SELECT DISTINCT fpago FROM poliza, drecibo, dcia, dramo, comision, rep_com WHERE 
									poliza.id_poliza = drecibo.idrecibo AND
									rep_com.id_cia=dcia.idcia AND
									poliza.id_cod_ramo=dramo.cod_ramo AND
									rep_com.id_rep_com=comision.id_rep_com AND
									poliza.id_poliza=comision.id_poliza AND
									comision.cod_vend = '$asesor' AND
								   f_hastapoliza >= '$desde' AND
								   f_hastapoliza <= '$hasta'
								   ORDER BY fpago ASC ";
				   }//2
				   if ($cia!='' && $tipo_cuenta=='' && $ramo=='') {
   
					   // create sql part for IN condition by imploding comma after each id
					   $ciaIn = "('" . implode("','", $cia) ."')";
   
					   $sql="SELECT DISTINCT fpago FROM poliza, drecibo, dcia, dramo, comision, rep_com WHERE 
									poliza.id_poliza = drecibo.idrecibo AND
									rep_com.id_cia=dcia.idcia AND
									poliza.id_cod_ramo=dramo.cod_ramo AND
									rep_com.id_rep_com=comision.id_rep_com AND
									poliza.id_poliza=comision.id_poliza AND
									comision.cod_vend = '$asesor' AND
								   f_hastapoliza >= '$desde' AND
								   f_hastapoliza <= '$hasta' AND
								   nomcia IN ".$ciaIn."
								   ORDER BY fpago ASC ";
				   }//3
				   if ($cia=='' && $tipo_cuenta!='' && $ramo=='') {
   
					   // create sql part for IN condition by imploding comma after each id
					   $tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";
   
					   $sql="SELECT DISTINCT fpago FROM poliza, drecibo, dcia, dramo, comision, rep_com WHERE 
									poliza.id_poliza = drecibo.idrecibo AND
									rep_com.id_cia=dcia.idcia AND
									poliza.id_cod_ramo=dramo.cod_ramo AND
									rep_com.id_rep_com=comision.id_rep_com AND
									poliza.id_poliza=comision.id_poliza AND
									comision.cod_vend = '$asesor' AND
								   f_hastapoliza >= '$desde' AND
								   f_hastapoliza <= '$hasta' AND
								   t_cuenta  IN ".$tipo_cuentaIn."
								   ORDER BY fpago ASC ";
				   }//4
				   if ($cia=='' && $tipo_cuenta=='' && $ramo!='') {
   
					   // create sql part for IN condition by imploding comma after each id
					   $ramoIn = "('" . implode("','", $ramo) ."')";
   
					   $sql="SELECT DISTINCT fpago FROM poliza, drecibo, dcia, dramo, comision, rep_com WHERE 
									poliza.id_poliza = drecibo.idrecibo AND
									rep_com.id_cia=dcia.idcia AND
									poliza.id_cod_ramo=dramo.cod_ramo AND
									rep_com.id_rep_com=comision.id_rep_com AND
									poliza.id_poliza=comision.id_poliza AND
									comision.cod_vend = '$asesor' AND
								   f_hastapoliza >= '$desde' AND
								   f_hastapoliza <= '$hasta' AND
								   nramo IN ".$ramoIn." 
								   ORDER BY fpago ASC ";
				   }//5
				   if ($cia!='' && $tipo_cuenta!='' && $ramo=='') {
					   // create sql part for IN condition by imploding comma after each id
					   $ciaIn = "('" . implode("','", $cia) ."')";
   
					   // create sql part for IN condition by imploding comma after each id
					   $tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";
   
					   $sql="SELECT DISTINCT fpago FROM poliza, drecibo, dcia, dramo, comision, rep_com WHERE 
									poliza.id_poliza = drecibo.idrecibo AND
									rep_com.id_cia=dcia.idcia AND
									poliza.id_cod_ramo=dramo.cod_ramo AND
									rep_com.id_rep_com=comision.id_rep_com AND
									poliza.id_poliza=comision.id_poliza AND
									comision.cod_vend = '$asesor' AND
								   f_hastapoliza >= '$desde' AND
								   f_hastapoliza <= '$hasta' AND
								   nomcia IN ".$ciaIn." AND
								   t_cuenta  IN ".$tipo_cuentaIn."
								   ORDER BY fpago ASC ";
				   }//6
				   if ($cia=='' && $tipo_cuenta!='' && $ramo!='') {
					   // create sql part for IN condition by imploding comma after each id
					   $tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";
   
					   // create sql part for IN condition by imploding comma after each id
					   $ramoIn = "('" . implode("','", $ramo) ."')";
   
					   $sql="SELECT DISTINCT fpago FROM poliza, drecibo, dcia, dramo, comision, rep_com WHERE 
									poliza.id_poliza = drecibo.idrecibo AND
									rep_com.id_cia=dcia.idcia AND
									poliza.id_cod_ramo=dramo.cod_ramo AND
									rep_com.id_rep_com=comision.id_rep_com AND
									poliza.id_poliza=comision.id_poliza AND
									comision.cod_vend = '$asesor' AND
								   f_hastapoliza >= '$desde' AND
								   f_hastapoliza <= '$hasta' AND
								   nramo IN ".$ramoIn." AND
								   t_cuenta  IN ".$tipo_cuentaIn."
								   ORDER BY fpago ASC ";
				   }//7
				   if ($cia!='' && $tipo_cuenta=='' && $ramo!='') {
					   // create sql part for IN condition by imploding comma after each id
					   $ciaIn = "('" . implode("','", $cia) ."')";
   
					   // create sql part for IN condition by imploding comma after each id
					   $ramoIn = "('" . implode("','", $ramo) ."')";
   
					   $sql="SELECT DISTINCT fpago FROM poliza, drecibo, dcia, dramo, comision, rep_com WHERE 
									poliza.id_poliza = drecibo.idrecibo AND
									rep_com.id_cia=dcia.idcia AND
									poliza.id_cod_ramo=dramo.cod_ramo AND
									rep_com.id_rep_com=comision.id_rep_com AND
									poliza.id_poliza=comision.id_poliza AND
									comision.cod_vend = '$asesor' AND
								   f_hastapoliza >= '$desde' AND
								   f_hastapoliza <= '$hasta' AND
								   nomcia IN ".$ciaIn." AND
								   nramo IN ".$ramoIn."
								   ORDER BY fpago ASC  ";
				   }//8
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




	public function get_poliza_graf_4($fpago,$ramo,$desde,$hasta,$cia,$tipo_cuenta)
		    {
				if ($cia!='' && $tipo_cuenta!='' && $ramo!='') {
					// create sql part for IN condition by imploding comma after each id
					$ciaIn = "('" . implode("','", $cia) ."')";

					// create sql part for IN condition by imploding comma after each id
					$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";

					// create sql part for IN condition by imploding comma after each id
					$ramoIn = "('" . implode("','", $ramo) ."')";

					$sql="SELECT * FROM poliza, drecibo, dramo, dcia WHERE 
								poliza.id_poliza = drecibo.idrecibo AND
								poliza.id_cod_ramo=dramo.cod_ramo AND
								poliza.id_cia=dcia.idcia AND
								f_hastapoliza >= '$desde' AND
								f_hastapoliza <= '$hasta' AND
								nomcia IN ".$ciaIn." AND
								nramo IN ".$ramoIn." AND
								t_cuenta  IN ".$tipo_cuentaIn." AND
								fpago = '$fpago'";
				}//1
				if ($cia=='' && $tipo_cuenta=='' && $ramo=='') {
					$sql="SELECT * FROM poliza, drecibo, dramo, dcia WHERE 
								poliza.id_poliza = drecibo.idrecibo AND
								poliza.id_cod_ramo=dramo.cod_ramo AND
								poliza.id_cia=dcia.idcia AND
								f_hastapoliza >= '$desde' AND
								f_hastapoliza <= '$hasta' AND
								fpago = '$fpago'";
				}//2
				if ($cia!='' && $tipo_cuenta=='' && $ramo=='') {

					// create sql part for IN condition by imploding comma after each id
					$ciaIn = "('" . implode("','", $cia) ."')";

					$sql="SELECT * FROM poliza, drecibo, dramo, dcia WHERE 
								poliza.id_poliza = drecibo.idrecibo AND
								poliza.id_cod_ramo=dramo.cod_ramo AND
								poliza.id_cia=dcia.idcia AND
								f_hastapoliza >= '$desde' AND
								f_hastapoliza <= '$hasta' AND
								nomcia IN ".$ciaIn." AND
								fpago = '$fpago' ";
				}//3
				if ($cia=='' && $tipo_cuenta!='' && $ramo=='') {

					// create sql part for IN condition by imploding comma after each id
					$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";

					$sql="SELECT * FROM poliza, drecibo, dramo, dcia WHERE 
								poliza.id_poliza = drecibo.idrecibo AND
								poliza.id_cod_ramo=dramo.cod_ramo AND
								poliza.id_cia=dcia.idcia AND
								f_hastapoliza >= '$desde' AND
								f_hastapoliza <= '$hasta' AND
								t_cuenta  IN ".$tipo_cuentaIn." AND
								fpago = '$fpago' ";
				}//4
				if ($cia=='' && $tipo_cuenta=='' && $ramo!='') {

					// create sql part for IN condition by imploding comma after each id
					$ramoIn = "('" . implode("','", $ramo) ."')";

					$sql="SELECT * FROM poliza, drecibo, dramo, dcia WHERE 
								poliza.id_poliza = drecibo.idrecibo AND
								poliza.id_cod_ramo=dramo.cod_ramo AND
								poliza.id_cia=dcia.idcia AND
								f_hastapoliza >= '$desde' AND
								f_hastapoliza <= '$hasta' AND
								nramo IN ".$ramoIn." AND
								fpago = '$fpago' ";
				}//5
				if ($cia!='' && $tipo_cuenta!='' && $ramo=='') {
					// create sql part for IN condition by imploding comma after each id
					$ciaIn = "('" . implode("','", $cia) ."')";

					// create sql part for IN condition by imploding comma after each id
					$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";

					$sql="SELECT * FROM poliza, drecibo, dramo, dcia WHERE 
								poliza.id_poliza = drecibo.idrecibo AND
								poliza.id_cod_ramo=dramo.cod_ramo AND
								poliza.id_cia=dcia.idcia AND
								f_hastapoliza >= '$desde' AND
								f_hastapoliza <= '$hasta' AND
								nomcia IN ".$ciaIn." AND
								t_cuenta  IN ".$tipo_cuentaIn." AND
								fpago = '$fpago' ";
				}//6
				if ($cia=='' && $tipo_cuenta!='' && $ramo!='') {
					// create sql part for IN condition by imploding comma after each id
					$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";

					// create sql part for IN condition by imploding comma after each id
					$ramoIn = "('" . implode("','", $ramo) ."')";

					$sql="SELECT * FROM poliza, drecibo, dramo, dcia WHERE 
								poliza.id_poliza = drecibo.idrecibo AND
								poliza.id_cod_ramo=dramo.cod_ramo AND
								poliza.id_cia=dcia.idcia AND
								f_hastapoliza >= '$desde' AND
								f_hastapoliza <= '$hasta' AND
								nramo IN ".$ramoIn." AND
								t_cuenta  IN ".$tipo_cuentaIn." AND
								fpago = '$fpago' ";
				}//7
				if ($cia!='' && $tipo_cuenta=='' && $ramo!='') {
					// create sql part for IN condition by imploding comma after each id
					$ciaIn = "('" . implode("','", $cia) ."')";

					// create sql part for IN condition by imploding comma after each id
					$ramoIn = "('" . implode("','", $ramo) ."')";

					$sql="SELECT * FROM poliza, drecibo, dramo, dcia WHERE 
								poliza.id_poliza = drecibo.idrecibo AND
								poliza.id_cod_ramo=dramo.cod_ramo AND
								poliza.id_cia=dcia.idcia AND
								f_hastapoliza >= '$desde' AND
								f_hastapoliza <= '$hasta' AND
								nomcia IN ".$ciaIn." AND
								nramo IN ".$ramoIn." AND
								fpago = '$fpago' ";
				}//8
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

			public function get_poliza_graf_4_by_user($fpago,$ramo,$desde,$hasta,$cia,$tipo_cuenta,$asesor)
			   {
				   if ($cia!='' && $tipo_cuenta!='' && $ramo!='') {
					   // create sql part for IN condition by imploding comma after each id
					   $ciaIn = "('" . implode("','", $cia) ."')";
   
					   // create sql part for IN condition by imploding comma after each id
					   $tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";
   
					   // create sql part for IN condition by imploding comma after each id
					   $ramoIn = "('" . implode("','", $ramo) ."')";
   
					   $sql="SELECT * FROM poliza, drecibo, dramo, dcia WHERE 
								   poliza.id_poliza = drecibo.idrecibo AND
								   poliza.id_cod_ramo=dramo.cod_ramo AND
								   poliza.id_cia=dcia.idcia AND
								   f_hastapoliza >= '$desde' AND
								   f_hastapoliza <= '$hasta' AND
								   poliza.codvend = '$asesor' AND
								   nomcia IN ".$ciaIn." AND
								   nramo IN ".$ramoIn." AND
								   t_cuenta  IN ".$tipo_cuentaIn." AND
								   fpago = '$fpago'";
				   }//1
				   if ($cia=='' && $tipo_cuenta=='' && $ramo=='') {
					   $sql="SELECT * FROM poliza, drecibo, dramo, dcia WHERE 
								   poliza.id_poliza = drecibo.idrecibo AND
								   poliza.id_cod_ramo=dramo.cod_ramo AND
								   poliza.id_cia=dcia.idcia AND
								   f_hastapoliza >= '$desde' AND
								   f_hastapoliza <= '$hasta' AND
								   poliza.codvend = '$asesor' AND
								   fpago = '$fpago'";
				   }//2
				   if ($cia!='' && $tipo_cuenta=='' && $ramo=='') {
   
					   // create sql part for IN condition by imploding comma after each id
					   $ciaIn = "('" . implode("','", $cia) ."')";
   
					   $sql="SELECT * FROM poliza, drecibo, dramo, dcia WHERE 
								   poliza.id_poliza = drecibo.idrecibo AND
								   poliza.id_cod_ramo=dramo.cod_ramo AND
								   poliza.id_cia=dcia.idcia AND
								   f_hastapoliza >= '$desde' AND
								   f_hastapoliza <= '$hasta' AND
								   poliza.codvend = '$asesor' AND
								   nomcia IN ".$ciaIn." AND
								   fpago = '$fpago' ";
				   }//3
				   if ($cia=='' && $tipo_cuenta!='' && $ramo=='') {
   
					   // create sql part for IN condition by imploding comma after each id
					   $tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";
   
					   $sql="SELECT * FROM poliza, drecibo, dramo, dcia WHERE 
								   poliza.id_poliza = drecibo.idrecibo AND
								   poliza.id_cod_ramo=dramo.cod_ramo AND
								   poliza.id_cia=dcia.idcia AND
								   f_hastapoliza >= '$desde' AND
								   f_hastapoliza <= '$hasta' AND
								   poliza.codvend = '$asesor' AND
								   t_cuenta  IN ".$tipo_cuentaIn." AND
								   fpago = '$fpago' ";
				   }//4
				   if ($cia=='' && $tipo_cuenta=='' && $ramo!='') {
   
					   // create sql part for IN condition by imploding comma after each id
					   $ramoIn = "('" . implode("','", $ramo) ."')";
   
					   $sql="SELECT * FROM poliza, drecibo, dramo, dcia WHERE 
								   poliza.id_poliza = drecibo.idrecibo AND
								   poliza.id_cod_ramo=dramo.cod_ramo AND
								   poliza.id_cia=dcia.idcia AND
								   f_hastapoliza >= '$desde' AND
								   f_hastapoliza <= '$hasta' AND
								   poliza.codvend = '$asesor' AND
								   nramo IN ".$ramoIn." AND
								   fpago = '$fpago' ";
				   }//5
				   if ($cia!='' && $tipo_cuenta!='' && $ramo=='') {
					   // create sql part for IN condition by imploding comma after each id
					   $ciaIn = "('" . implode("','", $cia) ."')";
   
					   // create sql part for IN condition by imploding comma after each id
					   $tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";
   
					   $sql="SELECT * FROM poliza, drecibo, dramo, dcia WHERE 
								   poliza.id_poliza = drecibo.idrecibo AND
								   poliza.id_cod_ramo=dramo.cod_ramo AND
								   poliza.id_cia=dcia.idcia AND
								   f_hastapoliza >= '$desde' AND
								   f_hastapoliza <= '$hasta' AND
								   poliza.codvend = '$asesor' AND
								   nomcia IN ".$ciaIn." AND
								   t_cuenta  IN ".$tipo_cuentaIn." AND
								   fpago = '$fpago' ";
				   }//6
				   if ($cia=='' && $tipo_cuenta!='' && $ramo!='') {
					   // create sql part for IN condition by imploding comma after each id
					   $tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";
   
					   // create sql part for IN condition by imploding comma after each id
					   $ramoIn = "('" . implode("','", $ramo) ."')";
   
					   $sql="SELECT * FROM poliza, drecibo, dramo, dcia WHERE 
								   poliza.id_poliza = drecibo.idrecibo AND
								   poliza.id_cod_ramo=dramo.cod_ramo AND
								   poliza.id_cia=dcia.idcia AND
								   f_hastapoliza >= '$desde' AND
								   f_hastapoliza <= '$hasta' AND
								   poliza.codvend = '$asesor' AND
								   nramo IN ".$ramoIn." AND
								   t_cuenta  IN ".$tipo_cuentaIn." AND
								   fpago = '$fpago' ";
				   }//7
				   if ($cia!='' && $tipo_cuenta=='' && $ramo!='') {
					   // create sql part for IN condition by imploding comma after each id
					   $ciaIn = "('" . implode("','", $cia) ."')";
   
					   // create sql part for IN condition by imploding comma after each id
					   $ramoIn = "('" . implode("','", $ramo) ."')";
   
					   $sql="SELECT * FROM poliza, drecibo, dramo, dcia WHERE 
								   poliza.id_poliza = drecibo.idrecibo AND
								   poliza.id_cod_ramo=dramo.cod_ramo AND
								   poliza.id_cia=dcia.idcia AND
								   f_hastapoliza >= '$desde' AND
								   f_hastapoliza <= '$hasta' AND
								   poliza.codvend = '$asesor' AND
								   nomcia IN ".$ciaIn." AND
								   nramo IN ".$ramoIn." AND
								   fpago = '$fpago' ";
				   }//8
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
			   

		public function get_poliza_graf_4_pc($fpago,$ramo,$desde,$hasta,$cia,$tipo_cuenta)
			   {
				   if ($cia!='' && $tipo_cuenta!='' && $ramo!='') {
					   // create sql part for IN condition by imploding comma after each id
					   $ciaIn = "('" . implode("','", $cia) ."')";
   
					   // create sql part for IN condition by imploding comma after each id
					   $tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";
   
					   // create sql part for IN condition by imploding comma after each id
					   $ramoIn = "('" . implode("','", $ramo) ."')";
   
					   $sql="SELECT * FROM comision INNER JOIN poliza, drecibo, dramo, dcia, rep_com WHERE 
								   poliza.id_poliza = drecibo.idrecibo AND
								   poliza.id_cod_ramo=dramo.cod_ramo AND
								   rep_com.id_cia=dcia.idcia AND
								   comision.id_poliza=poliza.id_poliza AND
								   rep_com.id_rep_com=comision.id_rep_com AND
								   f_hastapoliza >= '$desde' AND
								   f_hastapoliza <= '$hasta' AND
								   nomcia IN ".$ciaIn." AND
								   nramo IN ".$ramoIn." AND
								   t_cuenta  IN ".$tipo_cuentaIn." AND
								   fpago = '$fpago'";
				   }//1
				   if ($cia=='' && $tipo_cuenta=='' && $ramo=='') {
					   $sql="SELECT * FROM comision INNER JOIN poliza, drecibo, dramo, dcia, rep_com WHERE 
								   poliza.id_poliza = drecibo.idrecibo AND
								   poliza.id_cod_ramo=dramo.cod_ramo AND
								   rep_com.id_cia=dcia.idcia AND
								   comision.id_poliza=poliza.id_poliza AND
								   rep_com.id_rep_com=comision.id_rep_com AND
								   f_hastapoliza >= '$desde' AND
								   f_hastapoliza <= '$hasta' AND
								   fpago = '$fpago'";
				   }//2
				   if ($cia!='' && $tipo_cuenta=='' && $ramo=='') {
   
					   // create sql part for IN condition by imploding comma after each id
					   $ciaIn = "('" . implode("','", $cia) ."')";
   
					   $sql="SELECT * FROM comision INNER JOIN poliza, drecibo, dramo, dcia, rep_com WHERE 
								   poliza.id_poliza = drecibo.idrecibo AND
								   poliza.id_cod_ramo=dramo.cod_ramo AND
								   rep_com.id_cia=dcia.idcia AND
								   comision.id_poliza=poliza.id_poliza AND
								   rep_com.id_rep_com=comision.id_rep_com AND
								   f_hastapoliza >= '$desde' AND
								   f_hastapoliza <= '$hasta' AND
								   nomcia IN ".$ciaIn." AND
								   fpago = '$fpago' ";
				   }//3
				   if ($cia=='' && $tipo_cuenta!='' && $ramo=='') {
   
					   // create sql part for IN condition by imploding comma after each id
					   $tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";
   
					   $sql="SELECT * FROM comision INNER JOIN poliza, drecibo, dramo, dcia, rep_com WHERE 
								   poliza.id_poliza = drecibo.idrecibo AND
								   poliza.id_cod_ramo=dramo.cod_ramo AND
								   rep_com.id_cia=dcia.idcia AND
								   comision.id_poliza=poliza.id_poliza AND
								   rep_com.id_rep_com=comision.id_rep_com AND
								   f_hastapoliza >= '$desde' AND
								   f_hastapoliza <= '$hasta' AND
								   t_cuenta  IN ".$tipo_cuentaIn." AND
								   fpago = '$fpago' ";
				   }//4
				   if ($cia=='' && $tipo_cuenta=='' && $ramo!='') {
   
					   // create sql part for IN condition by imploding comma after each id
					   $ramoIn = "('" . implode("','", $ramo) ."')";
   
					   $sql="SELECT * FROM comision INNER JOIN poliza, drecibo, dramo, dcia, rep_com WHERE 
								   poliza.id_poliza = drecibo.idrecibo AND
								   poliza.id_cod_ramo=dramo.cod_ramo AND
								   rep_com.id_cia=dcia.idcia AND
								   comision.id_poliza=poliza.id_poliza AND
								   rep_com.id_rep_com=comision.id_rep_com AND
								   f_hastapoliza >= '$desde' AND
								   f_hastapoliza <= '$hasta' AND
								   nramo IN ".$ramoIn." AND
								   fpago = '$fpago' ";
				   }//5
				   if ($cia!='' && $tipo_cuenta!='' && $ramo=='') {
					   // create sql part for IN condition by imploding comma after each id
					   $ciaIn = "('" . implode("','", $cia) ."')";
   
					   // create sql part for IN condition by imploding comma after each id
					   $tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";
   
					   $sql="SELECT * FROM comision INNER JOIN poliza, drecibo, dramo, dcia, rep_com WHERE 
								   poliza.id_poliza = drecibo.idrecibo AND
								   poliza.id_cod_ramo=dramo.cod_ramo AND
								   rep_com.id_cia=dcia.idcia AND
								   comision.id_poliza=poliza.id_poliza AND
								   rep_com.id_rep_com=comision.id_rep_com AND
								   f_hastapoliza >= '$desde' AND
								   f_hastapoliza <= '$hasta' AND
								   nomcia IN ".$ciaIn." AND
								   t_cuenta  IN ".$tipo_cuentaIn." AND
								   fpago = '$fpago' ";
				   }//6
				   if ($cia=='' && $tipo_cuenta!='' && $ramo!='') {
					   // create sql part for IN condition by imploding comma after each id
					   $tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";
   
					   // create sql part for IN condition by imploding comma after each id
					   $ramoIn = "('" . implode("','", $ramo) ."')";
   
					   $sql="SELECT * FROM comision INNER JOIN poliza, drecibo, dramo, dcia, rep_com WHERE 
								   poliza.id_poliza = drecibo.idrecibo AND
								   poliza.id_cod_ramo=dramo.cod_ramo AND
								   rep_com.id_cia=dcia.idcia AND
								   comision.id_poliza=poliza.id_poliza AND
								   rep_com.id_rep_com=comision.id_rep_com AND
								   f_hastapoliza >= '$desde' AND
								   f_hastapoliza <= '$hasta' AND
								   nramo IN ".$ramoIn." AND
								   t_cuenta  IN ".$tipo_cuentaIn." AND
								   fpago = '$fpago' ";
				   }//7
				   if ($cia!='' && $tipo_cuenta=='' && $ramo!='') {
					   // create sql part for IN condition by imploding comma after each id
					   $ciaIn = "('" . implode("','", $cia) ."')";
   
					   // create sql part for IN condition by imploding comma after each id
					   $ramoIn = "('" . implode("','", $ramo) ."')";
   
					   $sql="SELECT * FROM comision INNER JOIN poliza, drecibo, dramo, dcia, rep_com WHERE 
								   poliza.id_poliza = drecibo.idrecibo AND
								   poliza.id_cod_ramo=dramo.cod_ramo AND
								   rep_com.id_cia=dcia.idcia AND
								   comision.id_poliza=poliza.id_poliza AND
								   rep_com.id_rep_com=comision.id_rep_com AND
								   f_hastapoliza >= '$desde' AND
								   f_hastapoliza <= '$hasta' AND
								   nomcia IN ".$ciaIn." AND
								   nramo IN ".$ramoIn." AND
								   fpago = '$fpago' ";
				   }//8
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

		public function get_poliza_graf_4_pc_by_user($fpago,$ramo,$desde,$hasta,$cia,$tipo_cuenta,$asesor)
			   {
				   if ($cia!='' && $tipo_cuenta!='' && $ramo!='') {
					   // create sql part for IN condition by imploding comma after each id
					   $ciaIn = "('" . implode("','", $cia) ."')";
   
					   // create sql part for IN condition by imploding comma after each id
					   $tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";
   
					   // create sql part for IN condition by imploding comma after each id
					   $ramoIn = "('" . implode("','", $ramo) ."')";
   
					   $sql="SELECT * FROM comision INNER JOIN poliza, drecibo, dramo, dcia, rep_com WHERE 
								   poliza.id_poliza = drecibo.idrecibo AND
								   poliza.id_cod_ramo=dramo.cod_ramo AND
								   rep_com.id_cia=dcia.idcia AND
								   comision.id_poliza=poliza.id_poliza AND
								   rep_com.id_rep_com=comision.id_rep_com AND
								   comision.cod_vend = '$asesor' AND
								   f_hastapoliza >= '$desde' AND
								   f_hastapoliza <= '$hasta' AND
								   nomcia IN ".$ciaIn." AND
								   nramo IN ".$ramoIn." AND
								   t_cuenta  IN ".$tipo_cuentaIn." AND
								   fpago = '$fpago'";
				   }//1
				   if ($cia=='' && $tipo_cuenta=='' && $ramo=='') {
					   $sql="SELECT * FROM comision INNER JOIN poliza, drecibo, dramo, dcia, rep_com WHERE 
								   poliza.id_poliza = drecibo.idrecibo AND
								   poliza.id_cod_ramo=dramo.cod_ramo AND
								   rep_com.id_cia=dcia.idcia AND
								   comision.id_poliza=poliza.id_poliza AND
								   rep_com.id_rep_com=comision.id_rep_com AND
								   comision.cod_vend = '$asesor' AND
								   f_hastapoliza >= '$desde' AND
								   f_hastapoliza <= '$hasta' AND
								   fpago = '$fpago'";
				   }//2
				   if ($cia!='' && $tipo_cuenta=='' && $ramo=='') {
   
					   // create sql part for IN condition by imploding comma after each id
					   $ciaIn = "('" . implode("','", $cia) ."')";
   
					   $sql="SELECT * FROM comision INNER JOIN poliza, drecibo, dramo, dcia, rep_com WHERE 
								   poliza.id_poliza = drecibo.idrecibo AND
								   poliza.id_cod_ramo=dramo.cod_ramo AND
								   rep_com.id_cia=dcia.idcia AND
								   comision.id_poliza=poliza.id_poliza AND
								   rep_com.id_rep_com=comision.id_rep_com AND
								   comision.cod_vend = '$asesor' AND
								   f_hastapoliza >= '$desde' AND
								   f_hastapoliza <= '$hasta' AND
								   nomcia IN ".$ciaIn." AND
								   fpago = '$fpago' ";
				   }//3
				   if ($cia=='' && $tipo_cuenta!='' && $ramo=='') {
   
					   // create sql part for IN condition by imploding comma after each id
					   $tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";
   
					   $sql="SELECT * FROM comision INNER JOIN poliza, drecibo, dramo, dcia, rep_com WHERE 
								   poliza.id_poliza = drecibo.idrecibo AND
								   poliza.id_cod_ramo=dramo.cod_ramo AND
								   rep_com.id_cia=dcia.idcia AND
								   comision.id_poliza=poliza.id_poliza AND
								   rep_com.id_rep_com=comision.id_rep_com AND
								   comision.cod_vend = '$asesor' AND
								   f_hastapoliza >= '$desde' AND
								   f_hastapoliza <= '$hasta' AND
								   t_cuenta  IN ".$tipo_cuentaIn." AND
								   fpago = '$fpago' ";
				   }//4
				   if ($cia=='' && $tipo_cuenta=='' && $ramo!='') {
   
					   // create sql part for IN condition by imploding comma after each id
					   $ramoIn = "('" . implode("','", $ramo) ."')";
   
					   $sql="SELECT * FROM comision INNER JOIN poliza, drecibo, dramo, dcia, rep_com WHERE 
								   poliza.id_poliza = drecibo.idrecibo AND
								   poliza.id_cod_ramo=dramo.cod_ramo AND
								   rep_com.id_cia=dcia.idcia AND
								   comision.id_poliza=poliza.id_poliza AND
								   rep_com.id_rep_com=comision.id_rep_com AND
								   comision.cod_vend = '$asesor' AND
								   f_hastapoliza >= '$desde' AND
								   f_hastapoliza <= '$hasta' AND
								   nramo IN ".$ramoIn." AND
								   fpago = '$fpago' ";
				   }//5
				   if ($cia!='' && $tipo_cuenta!='' && $ramo=='') {
					   // create sql part for IN condition by imploding comma after each id
					   $ciaIn = "('" . implode("','", $cia) ."')";
   
					   // create sql part for IN condition by imploding comma after each id
					   $tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";
   
					   $sql="SELECT * FROM comision INNER JOIN poliza, drecibo, dramo, dcia, rep_com WHERE 
								   poliza.id_poliza = drecibo.idrecibo AND
								   poliza.id_cod_ramo=dramo.cod_ramo AND
								   rep_com.id_cia=dcia.idcia AND
								   comision.id_poliza=poliza.id_poliza AND
								   rep_com.id_rep_com=comision.id_rep_com AND
								   comision.cod_vend = '$asesor' AND
								   f_hastapoliza >= '$desde' AND
								   f_hastapoliza <= '$hasta' AND
								   nomcia IN ".$ciaIn." AND
								   t_cuenta  IN ".$tipo_cuentaIn." AND
								   fpago = '$fpago' ";
				   }//6
				   if ($cia=='' && $tipo_cuenta!='' && $ramo!='') {
					   // create sql part for IN condition by imploding comma after each id
					   $tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";
   
					   // create sql part for IN condition by imploding comma after each id
					   $ramoIn = "('" . implode("','", $ramo) ."')";
   
					   $sql="SELECT * FROM comision INNER JOIN poliza, drecibo, dramo, dcia, rep_com WHERE 
								   poliza.id_poliza = drecibo.idrecibo AND
								   poliza.id_cod_ramo=dramo.cod_ramo AND
								   rep_com.id_cia=dcia.idcia AND
								   comision.id_poliza=poliza.id_poliza AND
								   rep_com.id_rep_com=comision.id_rep_com AND
								   comision.cod_vend = '$asesor' AND
								   f_hastapoliza >= '$desde' AND
								   f_hastapoliza <= '$hasta' AND
								   nramo IN ".$ramoIn." AND
								   t_cuenta  IN ".$tipo_cuentaIn." AND
								   fpago = '$fpago' ";
				   }//7
				   if ($cia!='' && $tipo_cuenta=='' && $ramo!='') {
					   // create sql part for IN condition by imploding comma after each id
					   $ciaIn = "('" . implode("','", $cia) ."')";
   
					   // create sql part for IN condition by imploding comma after each id
					   $ramoIn = "('" . implode("','", $ramo) ."')";
   
					   $sql="SELECT * FROM comision INNER JOIN poliza, drecibo, dramo, dcia, rep_com WHERE 
								   poliza.id_poliza = drecibo.idrecibo AND
								   poliza.id_cod_ramo=dramo.cod_ramo AND
								   rep_com.id_cia=dcia.idcia AND
								   comision.id_poliza=poliza.id_poliza AND
								   rep_com.id_rep_com=comision.id_rep_com AND
								   comision.cod_vend = '$asesor' AND
								   f_hastapoliza >= '$desde' AND
								   f_hastapoliza <= '$hasta' AND
								   nomcia IN ".$ciaIn." AND
								   nramo IN ".$ramoIn." AND
								   fpago = '$fpago' ";
				   }//8
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

	public function get_distinct_cia_comision($desde,$hasta,$tipo_cuenta)
		    {
				if ($tipo_cuenta!='') {
					// create sql part for IN condition by imploding comma after each id
					$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";

					$sql="SELECT DISTINCT rep_com.id_cia, nomcia FROM comision 
		      			INNER JOIN dcia, poliza, rep_com WHERE 
		      			rep_com.id_cia=dcia.idcia AND
		      			poliza.id_poliza = comision.id_poliza AND
						comision.id_rep_com = rep_com.id_rep_com AND
		      			f_hastapoliza >= '$desde' AND
		      			f_hastapoliza <= '$hasta' AND
						t_cuenta  IN ".$tipo_cuentaIn." 
						ORDER BY nomcia ASC ";
				}
				if ($tipo_cuenta=='') {
					$sql="SELECT DISTINCT rep_com.id_cia, nomcia FROM comision 
		      			INNER JOIN dcia, poliza, rep_com WHERE 
		      			rep_com.id_cia=dcia.idcia AND
		      			poliza.id_poliza = comision.id_poliza AND
						comision.id_rep_com = rep_com.id_rep_com AND
		      			f_hastapoliza >= '$desde' AND
		      			f_hastapoliza <= '$hasta'
						ORDER BY nomcia ASC ";
				}
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
		
	public function get_distinct_cia_comision2($desde,$hasta,$tipo_cuenta)
		    {
				if ($tipo_cuenta!='') {
					// create sql part for IN condition by imploding comma after each id
					$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";

					$sql="SELECT DISTINCT rep_com.id_cia, nomcia FROM comision 
		      			INNER JOIN dcia, poliza, rep_com WHERE 
		      			rep_com.id_cia=dcia.idcia AND
		      			poliza.id_poliza = comision.id_poliza AND
						comision.id_rep_com = rep_com.id_rep_com AND
		      			f_hastapoliza >= '$desde' AND
		      			f_hastapoliza <= '$hasta' AND
						t_cuenta  IN ".$tipo_cuentaIn." 
						ORDER BY nomcia ASC ";
				}
				if ($tipo_cuenta=='') {
					$sql="SELECT DISTINCT rep_com.id_cia, nomcia FROM comision 
		      			INNER JOIN dcia, poliza, rep_com WHERE 
		      			rep_com.id_cia=dcia.idcia AND
		      			poliza.id_poliza = comision.id_poliza AND
						comision.id_rep_com = rep_com.id_rep_com AND
		      			f_hastapoliza >= '$desde' AND
		      			f_hastapoliza <= '$hasta'
						ORDER BY nomcia ASC ";
				}

		      	
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


	public function get_resumen_por_ramo($desde,$hasta,$cia,$ramo)
		    {

		    	if ($cia=='Seleccione Cía') {
		    		$cia='';
					}
					if ($ramo=='') {
		    		$ramo='';
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
		      			nomcia LIKE '%$cia%' AND
		      			nramo LIKE '%$ramo%' ";
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
				
			

		public function get_resumen_comision($desde,$hasta,$cia,$tipo_cuenta)
			{
					

			if ($tipo_cuenta!='') {
				// create sql part for IN condition by imploding comma after each id
				$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";

				$sql="SELECT * FROM comision 
							INNER JOIN dcia, drecibo, poliza, rep_com WHERE 
							rep_com.id_cia=dcia.idcia AND
							poliza.id_poliza=drecibo.idrecibo AND 
							poliza.id_poliza = comision.id_poliza AND
							comision.id_rep_com=rep_com.id_rep_com AND
							f_hastapoliza >= '$desde' AND
							f_hastapoliza <= '$hasta' AND
							rep_com.id_cia = '$cia' AND
							t_cuenta  IN ".$tipo_cuentaIn." ";
			}
			if ($tipo_cuenta=='') {
				$sql="SELECT * FROM comision 
							INNER JOIN dcia, drecibo, poliza, rep_com WHERE 
							rep_com.id_cia=dcia.idcia AND
							poliza.id_poliza=drecibo.idrecibo AND 
							poliza.id_poliza = comision.id_poliza AND
							comision.id_rep_com=rep_com.id_rep_com AND
							f_hastapoliza >= '$desde' AND
							f_hastapoliza <= '$hasta' AND
							rep_com.id_cia = '$cia'";
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
			
			public function get_resumen_por_cia_de_poliza($desde,$hasta,$cia,$tipo_cuenta)
		    {
				if ($tipo_cuenta!='') {
					// create sql part for IN condition by imploding comma after each id
					$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";

					$sql="SELECT * FROM poliza 
		      			INNER JOIN dcia, drecibo WHERE 
		      			poliza.id_cia=dcia.idcia AND
		      			poliza.id_poliza=drecibo.idrecibo AND 
		      			f_hastapoliza >= '$desde' AND
		      			f_hastapoliza <= '$hasta' AND
						t_cuenta  IN ".$tipo_cuentaIn." AND
						id_cia = '$cia' ";
				}
				if ($tipo_cuenta=='') {
					$sql="SELECT * FROM poliza 
		      			INNER JOIN dcia, drecibo WHERE 
		      			poliza.id_cia=dcia.idcia AND
		      			poliza.id_poliza=drecibo.idrecibo AND 
		      			f_hastapoliza >= '$desde' AND
		      			f_hastapoliza <= '$hasta' AND
						id_cia = '$cia' ";
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
	public function get_poliza_grafp_2($ramo,$desde,$hasta,$cia,$tipo_cuenta)
		    {

				if ($cia!='' && $tipo_cuenta!='' && $ramo!='') {
					// create sql part for IN condition by imploding comma after each id
					$ciaIn = "('" . implode("','", $cia) ."')";

					// create sql part for IN condition by imploding comma after each id
					$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";

					// create sql part for IN condition by imploding comma after each id
					$ramoIn = "('" . implode("','", $ramo) ."')";

					$sql="SELECT * FROM poliza, drecibo, dcia, dramo, tipo_poliza WHERE 
								poliza.id_poliza = drecibo.idrecibo AND 
								poliza.id_cod_ramo=dramo.cod_ramo AND 
								poliza.id_cia=dcia.idcia AND 
								poliza.id_tpoliza=tipo_poliza.id_t_poliza AND
								f_desdepoliza >= '$desde' AND
								f_desdepoliza <= '$hasta' AND
								nomcia IN ".$ciaIn." AND
								nramo IN ".$ramoIn." AND
								t_cuenta  IN ".$tipo_cuentaIn." ";
				}//1
				if ($cia=='' && $tipo_cuenta=='' && $ramo=='') {
					$sql="SELECT * FROM poliza, drecibo, dcia, dramo, tipo_poliza WHERE 
								poliza.id_poliza = drecibo.idrecibo AND 
								poliza.id_cod_ramo=dramo.cod_ramo AND 
								poliza.id_cia=dcia.idcia AND 
								poliza.id_tpoliza=tipo_poliza.id_t_poliza AND
								f_desdepoliza >= '$desde' AND
								f_desdepoliza <= '$hasta' ";
				}//2
				if ($cia!='' && $tipo_cuenta=='' && $ramo=='') {

					// create sql part for IN condition by imploding comma after each id
					$ciaIn = "('" . implode("','", $cia) ."')";

					$sql="SELECT * FROM poliza, drecibo, dcia, dramo, tipo_poliza WHERE 
							poliza.id_poliza = drecibo.idrecibo AND 
							poliza.id_cod_ramo=dramo.cod_ramo AND 
							poliza.id_cia=dcia.idcia AND 
							poliza.id_tpoliza=tipo_poliza.id_t_poliza AND
							f_desdepoliza >= '$desde' AND
							f_desdepoliza <= '$hasta' AND
							nomcia IN ".$ciaIn." ";
				}//3
				if ($cia=='' && $tipo_cuenta!='' && $ramo=='') {

					// create sql part for IN condition by imploding comma after each id
					$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";

					$sql="SELECT * FROM poliza, drecibo, dcia, dramo, tipo_poliza WHERE 
							poliza.id_poliza = drecibo.idrecibo AND 
							poliza.id_cod_ramo=dramo.cod_ramo AND 
							poliza.id_cia=dcia.idcia AND 
							poliza.id_tpoliza=tipo_poliza.id_t_poliza AND
							f_desdepoliza >= '$desde' AND
							f_desdepoliza <= '$hasta' AND
							t_cuenta  IN ".$tipo_cuentaIn." ";
				}//4
				if ($cia=='' && $tipo_cuenta=='' && $ramo!='') {

					// create sql part for IN condition by imploding comma after each id
					$ramoIn = "('" . implode("','", $ramo) ."')";

					$sql="SELECT * FROM poliza, drecibo, dcia, dramo, tipo_poliza WHERE 
							poliza.id_poliza = drecibo.idrecibo AND 
							poliza.id_cod_ramo=dramo.cod_ramo AND 
							poliza.id_cia=dcia.idcia AND 
							poliza.id_tpoliza=tipo_poliza.id_t_poliza AND
							f_desdepoliza >= '$desde' AND
							f_desdepoliza <= '$hasta' AND
							nramo IN ".$ramoIn."  ";
				}//5
				if ($cia!='' && $tipo_cuenta!='' && $ramo=='') {
					// create sql part for IN condition by imploding comma after each id
					$ciaIn = "('" . implode("','", $cia) ."')";

					// create sql part for IN condition by imploding comma after each id
					$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";

					$sql="SELECT * FROM poliza, drecibo, dcia, dramo, tipo_poliza WHERE 
								poliza.id_poliza = drecibo.idrecibo AND 
								poliza.id_cod_ramo=dramo.cod_ramo AND 
								poliza.id_cia=dcia.idcia AND 
								poliza.id_tpoliza=tipo_poliza.id_t_poliza AND
								f_desdepoliza >= '$desde' AND
								f_desdepoliza <= '$hasta' AND
								nomcia IN ".$ciaIn." AND
								t_cuenta  IN ".$tipo_cuentaIn." ";
				}//6
				if ($cia=='' && $tipo_cuenta!='' && $ramo!='') {
					// create sql part for IN condition by imploding comma after each id
					$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";

					// create sql part for IN condition by imploding comma after each id
					$ramoIn = "('" . implode("','", $ramo) ."')";

					$sql="SELECT * FROM poliza, drecibo, dcia, dramo, tipo_poliza WHERE 
								poliza.id_poliza = drecibo.idrecibo AND 
								poliza.id_cod_ramo=dramo.cod_ramo AND 
								poliza.id_cia=dcia.idcia AND 
								poliza.id_tpoliza=tipo_poliza.id_t_poliza AND
								f_desdepoliza >= '$desde' AND
								f_desdepoliza <= '$hasta' AND
								nramo IN ".$ramoIn." AND
								t_cuenta  IN ".$tipo_cuentaIn." ";
				}//7
				if ($cia!='' && $tipo_cuenta=='' && $ramo!='') {
					// create sql part for IN condition by imploding comma after each id
					$ciaIn = "('" . implode("','", $cia) ."')";

					// create sql part for IN condition by imploding comma after each id
					$ramoIn = "('" . implode("','", $ramo) ."')";

					$sql="SELECT * FROM poliza, drecibo, dcia, dramo, tipo_poliza WHERE 
								poliza.id_poliza = drecibo.idrecibo AND 
								poliza.id_cod_ramo=dramo.cod_ramo AND 
								poliza.id_cia=dcia.idcia AND 
								poliza.id_tpoliza=tipo_poliza.id_t_poliza AND
								f_desdepoliza >= '$desde' AND
								f_desdepoliza <= '$hasta' AND
								nomcia IN ".$ciaIn." AND
								nramo IN ".$ramoIn."  ";
				}//8

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

		public function get_poliza_grafp_2_by_user($ramo,$desde,$hasta,$cia,$tipo_cuenta,$asesor)
		    {

				if ($cia!='' && $tipo_cuenta!='' && $ramo!='') {
					// create sql part for IN condition by imploding comma after each id
					$ciaIn = "('" . implode("','", $cia) ."')";

					// create sql part for IN condition by imploding comma after each id
					$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";

					// create sql part for IN condition by imploding comma after each id
					$ramoIn = "('" . implode("','", $ramo) ."')";

					$sql="SELECT * FROM poliza, drecibo, dcia, dramo, tipo_poliza WHERE 
								poliza.id_poliza = drecibo.idrecibo AND 
								poliza.id_cod_ramo=dramo.cod_ramo AND 
								poliza.id_cia=dcia.idcia AND 
								poliza.id_tpoliza=tipo_poliza.id_t_poliza AND
								f_desdepoliza >= '$desde' AND
								f_desdepoliza <= '$hasta' AND
								poliza.codvend = '$asesor' AND
								nomcia IN ".$ciaIn." AND
								nramo IN ".$ramoIn." AND
								t_cuenta  IN ".$tipo_cuentaIn." ";
				}//1
				if ($cia=='' && $tipo_cuenta=='' && $ramo=='') {
					$sql="SELECT * FROM poliza, drecibo, dcia, dramo, tipo_poliza WHERE 
								poliza.id_poliza = drecibo.idrecibo AND 
								poliza.id_cod_ramo=dramo.cod_ramo AND 
								poliza.id_cia=dcia.idcia AND 
								poliza.id_tpoliza=tipo_poliza.id_t_poliza AND
								poliza.codvend = '$asesor' AND
								f_desdepoliza >= '$desde' AND
								f_desdepoliza <= '$hasta' ";
				}//2
				if ($cia!='' && $tipo_cuenta=='' && $ramo=='') {

					// create sql part for IN condition by imploding comma after each id
					$ciaIn = "('" . implode("','", $cia) ."')";

					$sql="SELECT * FROM poliza, drecibo, dcia, dramo, tipo_poliza WHERE 
							poliza.id_poliza = drecibo.idrecibo AND 
							poliza.id_cod_ramo=dramo.cod_ramo AND 
							poliza.id_cia=dcia.idcia AND 
							poliza.id_tpoliza=tipo_poliza.id_t_poliza AND
							poliza.codvend = '$asesor' AND
							f_desdepoliza >= '$desde' AND
							f_desdepoliza <= '$hasta' AND
							nomcia IN ".$ciaIn." ";
				}//3
				if ($cia=='' && $tipo_cuenta!='' && $ramo=='') {

					// create sql part for IN condition by imploding comma after each id
					$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";

					$sql="SELECT * FROM poliza, drecibo, dcia, dramo, tipo_poliza WHERE 
							poliza.id_poliza = drecibo.idrecibo AND 
							poliza.id_cod_ramo=dramo.cod_ramo AND 
							poliza.id_cia=dcia.idcia AND 
							poliza.id_tpoliza=tipo_poliza.id_t_poliza AND
							poliza.codvend = '$asesor' AND
							f_desdepoliza >= '$desde' AND
							f_desdepoliza <= '$hasta' AND
							t_cuenta  IN ".$tipo_cuentaIn." ";
				}//4
				if ($cia=='' && $tipo_cuenta=='' && $ramo!='') {

					// create sql part for IN condition by imploding comma after each id
					$ramoIn = "('" . implode("','", $ramo) ."')";

					$sql="SELECT * FROM poliza, drecibo, dcia, dramo, tipo_poliza WHERE 
							poliza.id_poliza = drecibo.idrecibo AND 
							poliza.id_cod_ramo=dramo.cod_ramo AND 
							poliza.id_cia=dcia.idcia AND 
							poliza.id_tpoliza=tipo_poliza.id_t_poliza AND
							poliza.codvend = '$asesor' AND
							f_desdepoliza >= '$desde' AND
							f_desdepoliza <= '$hasta' AND
							nramo IN ".$ramoIn."  ";
				}//5
				if ($cia!='' && $tipo_cuenta!='' && $ramo=='') {
					// create sql part for IN condition by imploding comma after each id
					$ciaIn = "('" . implode("','", $cia) ."')";

					// create sql part for IN condition by imploding comma after each id
					$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";

					$sql="SELECT * FROM poliza, drecibo, dcia, dramo, tipo_poliza WHERE 
								poliza.id_poliza = drecibo.idrecibo AND 
								poliza.id_cod_ramo=dramo.cod_ramo AND 
								poliza.id_cia=dcia.idcia AND 
								poliza.id_tpoliza=tipo_poliza.id_t_poliza AND
								poliza.codvend = '$asesor' AND
								f_desdepoliza >= '$desde' AND
								f_desdepoliza <= '$hasta' AND
								nomcia IN ".$ciaIn." AND
								t_cuenta  IN ".$tipo_cuentaIn." ";
				}//6
				if ($cia=='' && $tipo_cuenta!='' && $ramo!='') {
					// create sql part for IN condition by imploding comma after each id
					$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";

					// create sql part for IN condition by imploding comma after each id
					$ramoIn = "('" . implode("','", $ramo) ."')";

					$sql="SELECT * FROM poliza, drecibo, dcia, dramo, tipo_poliza WHERE 
								poliza.id_poliza = drecibo.idrecibo AND 
								poliza.id_cod_ramo=dramo.cod_ramo AND 
								poliza.id_cia=dcia.idcia AND 
								poliza.id_tpoliza=tipo_poliza.id_t_poliza AND
								poliza.codvend = '$asesor' AND
								f_desdepoliza >= '$desde' AND
								f_desdepoliza <= '$hasta' AND
								nramo IN ".$ramoIn." AND
								t_cuenta  IN ".$tipo_cuentaIn." ";
				}//7
				if ($cia!='' && $tipo_cuenta=='' && $ramo!='') {
					// create sql part for IN condition by imploding comma after each id
					$ciaIn = "('" . implode("','", $cia) ."')";

					// create sql part for IN condition by imploding comma after each id
					$ramoIn = "('" . implode("','", $ramo) ."')";

					$sql="SELECT * FROM poliza, drecibo, dcia, dramo, tipo_poliza WHERE 
								poliza.id_poliza = drecibo.idrecibo AND 
								poliza.id_cod_ramo=dramo.cod_ramo AND 
								poliza.id_cia=dcia.idcia AND 
								poliza.id_tpoliza=tipo_poliza.id_t_poliza AND
								poliza.codvend = '$asesor' AND
								f_desdepoliza >= '$desde' AND
								f_desdepoliza <= '$hasta' AND
								nomcia IN ".$ciaIn." AND
								nramo IN ".$ramoIn."  ";
				}//8

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
			   
	
	public function get_poliza_grafp_2_pc($ramo,$desde,$hasta,$cia,$tipo_cuenta)
			   {
   
				   if ($cia!='' && $tipo_cuenta!='' && $ramo!='') {
					   // create sql part for IN condition by imploding comma after each id
					   $ciaIn = "('" . implode("','", $cia) ."')";
   
					   // create sql part for IN condition by imploding comma after each id
					   $tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";
   
					   // create sql part for IN condition by imploding comma after each id
					   $ramoIn = "('" . implode("','", $ramo) ."')";
   
					   $sql="SELECT * FROM comision INNER JOIN poliza, drecibo, dcia, dramo, rep_com WHERE 
								   poliza.id_poliza = drecibo.idrecibo AND 
								   poliza.id_cod_ramo=dramo.cod_ramo AND 
								   rep_com.id_cia=dcia.idcia AND 
								   comision.id_poliza=poliza.id_poliza AND
								   rep_com.id_rep_com=comision.id_rep_com AND
								   f_hastapoliza >= '$desde' AND
								   f_hastapoliza <= '$hasta' AND
								   nomcia IN ".$ciaIn." AND
								   nramo IN ".$ramoIn." AND
								   t_cuenta  IN ".$tipo_cuentaIn." ";
				   }//1
				   if ($cia=='' && $tipo_cuenta=='' && $ramo=='') {
					   $sql="SELECT * FROM comision INNER JOIN poliza, drecibo, dcia, dramo, rep_com WHERE 
								   poliza.id_poliza = drecibo.idrecibo AND 
								   poliza.id_cod_ramo=dramo.cod_ramo AND 
								   rep_com.id_cia=dcia.idcia AND 
								   comision.id_poliza=poliza.id_poliza AND
								   rep_com.id_rep_com=comision.id_rep_com AND
								   f_hastapoliza >= '$desde' AND
								   f_hastapoliza <= '$hasta' ";
				   }//2
				   if ($cia!='' && $tipo_cuenta=='' && $ramo=='') {
   
					   // create sql part for IN condition by imploding comma after each id
					   $ciaIn = "('" . implode("','", $cia) ."')";
   
					   $sql="SELECT * FROM comision INNER JOIN poliza, drecibo, dcia, dramo, rep_com WHERE 
								   poliza.id_poliza = drecibo.idrecibo AND 
								   poliza.id_cod_ramo=dramo.cod_ramo AND 
								   rep_com.id_cia=dcia.idcia AND 
								   comision.id_poliza=poliza.id_poliza AND
								   rep_com.id_rep_com=comision.id_rep_com AND
								f_hastapoliza >= '$desde' AND
								f_hastapoliza <= '$hasta' AND
								nomcia IN ".$ciaIn." ";
				   }//3
				   if ($cia=='' && $tipo_cuenta!='' && $ramo=='') {
   
					   // create sql part for IN condition by imploding comma after each id
					   $tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";
   
					   $sql="SELECT * FROM comision INNER JOIN poliza, drecibo, dcia, dramo, rep_com WHERE 
								   poliza.id_poliza = drecibo.idrecibo AND 
								   poliza.id_cod_ramo=dramo.cod_ramo AND 
								   rep_com.id_cia=dcia.idcia AND 
								   comision.id_poliza=poliza.id_poliza AND
								   rep_com.id_rep_com=comision.id_rep_com AND
								f_hastapoliza >= '$desde' AND
								f_hastapoliza <= '$hasta' AND
								t_cuenta  IN ".$tipo_cuentaIn." ";
				   }//4
				   if ($cia=='' && $tipo_cuenta=='' && $ramo!='') {
   
					   // create sql part for IN condition by imploding comma after each id
					   $ramoIn = "('" . implode("','", $ramo) ."')";
   
					   $sql="SELECT * FROM comision INNER JOIN poliza, drecibo, dcia, dramo, rep_com WHERE 
								   poliza.id_poliza = drecibo.idrecibo AND 
								   poliza.id_cod_ramo=dramo.cod_ramo AND 
								   rep_com.id_cia=dcia.idcia AND 
								   comision.id_poliza=poliza.id_poliza AND
								   rep_com.id_rep_com=comision.id_rep_com AND
							   f_hastapoliza >= '$desde' AND
							   f_hastapoliza <= '$hasta' AND
							   nramo IN ".$ramoIn."  ";
				   }//5
				   if ($cia!='' && $tipo_cuenta!='' && $ramo=='') {
					   // create sql part for IN condition by imploding comma after each id
					   $ciaIn = "('" . implode("','", $cia) ."')";
   
					   // create sql part for IN condition by imploding comma after each id
					   $tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";
   
					   $sql="SELECT * FROM comision INNER JOIN poliza, drecibo, dcia, dramo, rep_com WHERE 
								   poliza.id_poliza = drecibo.idrecibo AND 
								   poliza.id_cod_ramo=dramo.cod_ramo AND 
								   rep_com.id_cia=dcia.idcia AND 
								   comision.id_poliza=poliza.id_poliza AND
								   rep_com.id_rep_com=comision.id_rep_com AND
								   f_hastapoliza >= '$desde' AND
								   f_hastapoliza <= '$hasta' AND
								   nomcia IN ".$ciaIn." AND
								   t_cuenta  IN ".$tipo_cuentaIn." ";
				   }//6
				   if ($cia=='' && $tipo_cuenta!='' && $ramo!='') {
					   // create sql part for IN condition by imploding comma after each id
					   $tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";
   
					   // create sql part for IN condition by imploding comma after each id
					   $ramoIn = "('" . implode("','", $ramo) ."')";
   
					   $sql="SELECT * FROM comision INNER JOIN poliza, drecibo, dcia, dramo, rep_com WHERE 
								   poliza.id_poliza = drecibo.idrecibo AND 
								   poliza.id_cod_ramo=dramo.cod_ramo AND 
								   rep_com.id_cia=dcia.idcia AND 
								   comision.id_poliza=poliza.id_poliza AND
								   rep_com.id_rep_com=comision.id_rep_com AND
								   f_hastapoliza >= '$desde' AND
								   f_hastapoliza <= '$hasta' AND
								   nramo IN ".$ramoIn." AND
								   t_cuenta  IN ".$tipo_cuentaIn." ";
				   }//7
				   if ($cia!='' && $tipo_cuenta=='' && $ramo!='') {
					   // create sql part for IN condition by imploding comma after each id
					   $ciaIn = "('" . implode("','", $cia) ."')";
   
					   // create sql part for IN condition by imploding comma after each id
					   $ramoIn = "('" . implode("','", $ramo) ."')";
   
					   $sql="SELECT * FROM comision INNER JOIN poliza, drecibo, dcia, dramo, rep_com WHERE 
								   poliza.id_poliza = drecibo.idrecibo AND 
								   poliza.id_cod_ramo=dramo.cod_ramo AND 
								   rep_com.id_cia=dcia.idcia AND 
								   comision.id_poliza=poliza.id_poliza AND
								   rep_com.id_rep_com=comision.id_rep_com AND
								   f_hastapoliza >= '$desde' AND
								   f_hastapoliza <= '$hasta' AND
								   nomcia IN ".$ciaIn." AND
								   nramo IN ".$ramoIn."  ";
				   }//8
   
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

			public function get_poliza_grafp_2_pc_by_user($ramo,$desde,$hasta,$cia,$tipo_cuenta,$asesor)
			   {
   
				   if ($cia!='' && $tipo_cuenta!='' && $ramo!='') {
					   // create sql part for IN condition by imploding comma after each id
					   $ciaIn = "('" . implode("','", $cia) ."')";
   
					   // create sql part for IN condition by imploding comma after each id
					   $tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";
   
					   // create sql part for IN condition by imploding comma after each id
					   $ramoIn = "('" . implode("','", $ramo) ."')";
   
					   $sql="SELECT * FROM comision INNER JOIN poliza, drecibo, dcia, dramo, rep_com WHERE 
								   poliza.id_poliza = drecibo.idrecibo AND 
								   poliza.id_cod_ramo=dramo.cod_ramo AND 
								   rep_com.id_cia=dcia.idcia AND 
								   comision.id_poliza=poliza.id_poliza AND
								   rep_com.id_rep_com=comision.id_rep_com AND
								   comision.cod_vend = '$asesor' AND
								   f_hastapoliza >= '$desde' AND
								   f_hastapoliza <= '$hasta' AND
								   nomcia IN ".$ciaIn." AND
								   nramo IN ".$ramoIn." AND
								   t_cuenta  IN ".$tipo_cuentaIn." ";
				   }//1
				   if ($cia=='' && $tipo_cuenta=='' && $ramo=='') {
					   $sql="SELECT * FROM comision INNER JOIN poliza, drecibo, dcia, dramo, rep_com WHERE 
								   poliza.id_poliza = drecibo.idrecibo AND 
								   poliza.id_cod_ramo=dramo.cod_ramo AND 
								   rep_com.id_cia=dcia.idcia AND 
								   comision.id_poliza=poliza.id_poliza AND
								   rep_com.id_rep_com=comision.id_rep_com AND
								   comision.cod_vend = '$asesor' AND
								   f_hastapoliza >= '$desde' AND
								   f_hastapoliza <= '$hasta' ";
				   }//2
				   if ($cia!='' && $tipo_cuenta=='' && $ramo=='') {
   
					   // create sql part for IN condition by imploding comma after each id
					   $ciaIn = "('" . implode("','", $cia) ."')";
   
					   $sql="SELECT * FROM comision INNER JOIN poliza, drecibo, dcia, dramo, rep_com WHERE 
								   poliza.id_poliza = drecibo.idrecibo AND 
								   poliza.id_cod_ramo=dramo.cod_ramo AND 
								   rep_com.id_cia=dcia.idcia AND 
								   comision.id_poliza=poliza.id_poliza AND
								   rep_com.id_rep_com=comision.id_rep_com AND
								   comision.cod_vend = '$asesor' AND
								f_hastapoliza >= '$desde' AND
								f_hastapoliza <= '$hasta' AND
								nomcia IN ".$ciaIn." ";
				   }//3
				   if ($cia=='' && $tipo_cuenta!='' && $ramo=='') {
   
					   // create sql part for IN condition by imploding comma after each id
					   $tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";
   
					   $sql="SELECT * FROM comision INNER JOIN poliza, drecibo, dcia, dramo, rep_com WHERE 
								   poliza.id_poliza = drecibo.idrecibo AND 
								   poliza.id_cod_ramo=dramo.cod_ramo AND 
								   rep_com.id_cia=dcia.idcia AND 
								   comision.id_poliza=poliza.id_poliza AND
								   rep_com.id_rep_com=comision.id_rep_com AND
								   comision.cod_vend = '$asesor' AND
								f_hastapoliza >= '$desde' AND
								f_hastapoliza <= '$hasta' AND
								t_cuenta  IN ".$tipo_cuentaIn." ";
				   }//4
				   if ($cia=='' && $tipo_cuenta=='' && $ramo!='') {
   
					   // create sql part for IN condition by imploding comma after each id
					   $ramoIn = "('" . implode("','", $ramo) ."')";
   
					   $sql="SELECT * FROM comision INNER JOIN poliza, drecibo, dcia, dramo, rep_com WHERE 
								   poliza.id_poliza = drecibo.idrecibo AND 
								   poliza.id_cod_ramo=dramo.cod_ramo AND 
								   rep_com.id_cia=dcia.idcia AND 
								   comision.id_poliza=poliza.id_poliza AND
								   rep_com.id_rep_com=comision.id_rep_com AND
								   comision.cod_vend = '$asesor' AND
							   f_hastapoliza >= '$desde' AND
							   f_hastapoliza <= '$hasta' AND
							   nramo IN ".$ramoIn."  ";
				   }//5
				   if ($cia!='' && $tipo_cuenta!='' && $ramo=='') {
					   // create sql part for IN condition by imploding comma after each id
					   $ciaIn = "('" . implode("','", $cia) ."')";
   
					   // create sql part for IN condition by imploding comma after each id
					   $tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";
   
					   $sql="SELECT * FROM comision INNER JOIN poliza, drecibo, dcia, dramo, rep_com WHERE 
								   poliza.id_poliza = drecibo.idrecibo AND 
								   poliza.id_cod_ramo=dramo.cod_ramo AND 
								   rep_com.id_cia=dcia.idcia AND 
								   comision.id_poliza=poliza.id_poliza AND
								   rep_com.id_rep_com=comision.id_rep_com AND
								   comision.cod_vend = '$asesor' AND
								   f_hastapoliza >= '$desde' AND
								   f_hastapoliza <= '$hasta' AND
								   nomcia IN ".$ciaIn." AND
								   t_cuenta  IN ".$tipo_cuentaIn." ";
				   }//6
				   if ($cia=='' && $tipo_cuenta!='' && $ramo!='') {
					   // create sql part for IN condition by imploding comma after each id
					   $tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";
   
					   // create sql part for IN condition by imploding comma after each id
					   $ramoIn = "('" . implode("','", $ramo) ."')";
   
					   $sql="SELECT * FROM comision INNER JOIN poliza, drecibo, dcia, dramo, rep_com WHERE 
								   poliza.id_poliza = drecibo.idrecibo AND 
								   poliza.id_cod_ramo=dramo.cod_ramo AND 
								   rep_com.id_cia=dcia.idcia AND 
								   comision.id_poliza=poliza.id_poliza AND
								   rep_com.id_rep_com=comision.id_rep_com AND
								   comision.cod_vend = '$asesor' AND
								   f_hastapoliza >= '$desde' AND
								   f_hastapoliza <= '$hasta' AND
								   nramo IN ".$ramoIn." AND
								   t_cuenta  IN ".$tipo_cuentaIn." ";
				   }//7
				   if ($cia!='' && $tipo_cuenta=='' && $ramo!='') {
					   // create sql part for IN condition by imploding comma after each id
					   $ciaIn = "('" . implode("','", $cia) ."')";
   
					   // create sql part for IN condition by imploding comma after each id
					   $ramoIn = "('" . implode("','", $ramo) ."')";
   
					   $sql="SELECT * FROM comision INNER JOIN poliza, drecibo, dcia, dramo, rep_com WHERE 
								   poliza.id_poliza = drecibo.idrecibo AND 
								   poliza.id_cod_ramo=dramo.cod_ramo AND 
								   rep_com.id_cia=dcia.idcia AND 
								   comision.id_poliza=poliza.id_poliza AND
								   rep_com.id_rep_com=comision.id_rep_com AND
								   comision.cod_vend = '$asesor' AND
								   f_hastapoliza >= '$desde' AND
								   f_hastapoliza <= '$hasta' AND
								   nomcia IN ".$ciaIn." AND
								   nramo IN ".$ramoIn."  ";
				   }//8
   
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


	public function get_distinct_element_ejecutivo_ps($desde,$hasta,$cia,$ramo,$tipo_cuenta)
		    {
				if ($cia!='' && $tipo_cuenta!='' && $ramo!='') {
					// create sql part for IN condition by imploding comma after each id
					$ciaIn = "('" . implode("','", $cia) ."')";

					// create sql part for IN condition by imploding comma after each id
					$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";

					// create sql part for IN condition by imploding comma after each id
					$ramoIn = "('" . implode("','", $ramo) ."')";

					$sql="SELECT DISTINCT poliza.codvend FROM poliza, drecibo, dcia, dramo WHERE 
								poliza.id_poliza = drecibo.idrecibo AND
								poliza.id_cia=dcia.idcia AND
								poliza.id_cod_ramo=dramo.cod_ramo AND
								f_hastapoliza >= '$desde' AND
								f_hastapoliza <= '$hasta' AND
								nomcia IN ".$ciaIn." AND
								nramo IN ".$ramoIn." AND
								t_cuenta  IN ".$tipo_cuentaIn." ";
				}//1
				if ($cia=='' && $tipo_cuenta=='' && $ramo=='') {
					$sql="SELECT DISTINCT poliza.codvend FROM poliza, drecibo, dcia, dramo WHERE 
								poliza.id_poliza = drecibo.idrecibo AND
								poliza.id_cia=dcia.idcia AND
								poliza.id_cod_ramo=dramo.cod_ramo AND
								f_hastapoliza >= '$desde' AND
								f_hastapoliza <= '$hasta'  ";
				}//2
				if ($cia!='' && $tipo_cuenta=='' && $ramo=='') {

					// create sql part for IN condition by imploding comma after each id
					$ciaIn = "('" . implode("','", $cia) ."')";

					$sql="SELECT DISTINCT poliza.codvend FROM poliza, drecibo, dcia, dramo WHERE 
							poliza.id_poliza = drecibo.idrecibo AND
							poliza.id_cia=dcia.idcia AND
							poliza.id_cod_ramo=dramo.cod_ramo AND
							f_hastapoliza >= '$desde' AND
							f_hastapoliza <= '$hasta' AND
							nomcia IN ".$ciaIn." ";
				}//3
				if ($cia=='' && $tipo_cuenta!='' && $ramo=='') {

					// create sql part for IN condition by imploding comma after each id
					$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";

					$sql="SELECT DISTINCT poliza.codvend FROM poliza, drecibo, dcia, dramo WHERE 
							poliza.id_poliza = drecibo.idrecibo AND
							poliza.id_cia=dcia.idcia AND
							poliza.id_cod_ramo=dramo.cod_ramo AND
							f_hastapoliza >= '$desde' AND
							f_hastapoliza <= '$hasta' AND
							t_cuenta  IN ".$tipo_cuentaIn." ";
				}//4
				if ($cia=='' && $tipo_cuenta=='' && $ramo!='') {

					// create sql part for IN condition by imploding comma after each id
					$ramoIn = "('" . implode("','", $ramo) ."')";

					$sql="SELECT DISTINCT poliza.codvend FROM poliza, drecibo, dcia, dramo WHERE 
							poliza.id_poliza = drecibo.idrecibo AND
							poliza.id_cia=dcia.idcia AND
							poliza.id_cod_ramo=dramo.cod_ramo AND
							f_hastapoliza >= '$desde' AND
							f_hastapoliza <= '$hasta' AND
							nramo IN ".$ramoIn."  ";
				}//5
				if ($cia!='' && $tipo_cuenta!='' && $ramo=='') {
					// create sql part for IN condition by imploding comma after each id
					$ciaIn = "('" . implode("','", $cia) ."')";

					// create sql part for IN condition by imploding comma after each id
					$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";

					$sql="SELECT DISTINCT poliza.codvend FROM poliza, drecibo, dcia, dramo WHERE 
								poliza.id_poliza = drecibo.idrecibo AND
								poliza.id_cia=dcia.idcia AND
								poliza.id_cod_ramo=dramo.cod_ramo AND
								f_hastapoliza >= '$desde' AND
								f_hastapoliza <= '$hasta' AND
								nomcia IN ".$ciaIn." AND
								t_cuenta  IN ".$tipo_cuentaIn." ";
				}//6
				if ($cia=='' && $tipo_cuenta!='' && $ramo!='') {
					// create sql part for IN condition by imploding comma after each id
					$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";

					// create sql part for IN condition by imploding comma after each id
					$ramoIn = "('" . implode("','", $ramo) ."')";

					$sql="SELECT DISTINCT poliza.codvend FROM poliza, drecibo, dcia, dramo WHERE 
								poliza.id_poliza = drecibo.idrecibo AND
								poliza.id_cia=dcia.idcia AND
								poliza.id_cod_ramo=dramo.cod_ramo AND
								f_hastapoliza >= '$desde' AND
								f_hastapoliza <= '$hasta' AND
								nramo IN ".$ramoIn." AND
								t_cuenta  IN ".$tipo_cuentaIn." ";
				}//7
				if ($cia!='' && $tipo_cuenta=='' && $ramo!='') {
					// create sql part for IN condition by imploding comma after each id
					$ciaIn = "('" . implode("','", $cia) ."')";

					// create sql part for IN condition by imploding comma after each id
					$ramoIn = "('" . implode("','", $ramo) ."')";

					$sql="SELECT DISTINCT poliza.codvend FROM poliza, drecibo, dcia, dramo WHERE 
								poliza.id_poliza = drecibo.idrecibo AND
								poliza.id_cia=dcia.idcia AND
								poliza.id_cod_ramo=dramo.cod_ramo AND
								f_hastapoliza >= '$desde' AND
								f_hastapoliza <= '$hasta' AND
								nomcia IN ".$ciaIn." AND
								nramo IN ".$ramoIn."  ";
				}//8
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
			   
		public function get_distinct_element_ejecutivo($desde,$hasta,$cia,$ramo,$tipo_cuenta)
			{

				if ($cia!='' && $tipo_cuenta!='' && $ramo!='') {
					// create sql part for IN condition by imploding comma after each id
					$ciaIn = "('" . implode("','", $cia) ."')";

					// create sql part for IN condition by imploding comma after each id
					$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";

					// create sql part for IN condition by imploding comma after each id
					$ramoIn = "('" . implode("','", $ramo) ."')";

					$sql="SELECT DISTINCT cod_vend FROM comision, poliza, drecibo, dcia, dramo WHERE 
								poliza.id_poliza = drecibo.idrecibo AND
								poliza.id_cia=dcia.idcia AND
								poliza.id_poliza=comision.id_poliza AND 
								poliza.id_cod_ramo=dramo.cod_ramo AND
								f_hastapoliza >= '$desde' AND
								f_hastapoliza <= '$hasta' AND
								nomcia IN ".$ciaIn." AND
								nramo IN ".$ramoIn." AND
								t_cuenta  IN ".$tipo_cuentaIn." 
								ORDER BY comision.cod_vend ASC";
				}//1
				if ($cia=='' && $tipo_cuenta=='' && $ramo=='') {
					$sql="SELECT DISTINCT cod_vend FROM comision, poliza, drecibo, dcia, dramo WHERE 
							poliza.id_poliza = drecibo.idrecibo AND
							poliza.id_cia=dcia.idcia AND
							poliza.id_poliza=comision.id_poliza AND 
							poliza.id_cod_ramo=dramo.cod_ramo AND
							f_hastapoliza >= '$desde' AND
							f_hastapoliza <= '$hasta'  
							ORDER BY comision.cod_vend ASC";
				}//2
				if ($cia!='' && $tipo_cuenta=='' && $ramo=='') {

					// create sql part for IN condition by imploding comma after each id
					$ciaIn = "('" . implode("','", $cia) ."')";

					$sql="SELECT DISTINCT cod_vend FROM comision, poliza, drecibo, dcia, dramo WHERE 
							poliza.id_poliza = drecibo.idrecibo AND
							poliza.id_cia=dcia.idcia AND
							poliza.id_poliza=comision.id_poliza AND 
							poliza.id_cod_ramo=dramo.cod_ramo AND
							f_hastapoliza >= '$desde' AND
							f_hastapoliza <= '$hasta' AND
							nomcia IN ".$ciaIn." 
							ORDER BY comision.cod_vend ASC";
				}//3
				if ($cia=='' && $tipo_cuenta!='' && $ramo=='') {

					// create sql part for IN condition by imploding comma after each id
					$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";

					$sql="SELECT DISTINCT cod_vend FROM comision, poliza, drecibo, dcia, dramo WHERE 
							poliza.id_poliza = drecibo.idrecibo AND
							poliza.id_cia=dcia.idcia AND
							poliza.id_poliza=comision.id_poliza AND 
							poliza.id_cod_ramo=dramo.cod_ramo AND
							f_hastapoliza >= '$desde' AND
							f_hastapoliza <= '$hasta' AND
							t_cuenta  IN ".$tipo_cuentaIn." 
							ORDER BY comision.cod_vend ASC";
				}//4
				if ($cia=='' && $tipo_cuenta=='' && $ramo!='') {

					// create sql part for IN condition by imploding comma after each id
					$ramoIn = "('" . implode("','", $ramo) ."')";

					$sql="SELECT DISTINCT cod_vend FROM comision INNER JOIN poliza, dramo WHERE 
							poliza.id_poliza=comision.id_poliza AND 
							poliza.id_cod_ramo=dramo.cod_ramo AND
							f_hastapoliza >= '$desde' AND
							f_hastapoliza <= '$hasta' AND
							nramo IN ".$ramoIn."  
							ORDER BY comision.cod_vend ASC";
				}//5
				if ($cia!='' && $tipo_cuenta!='' && $ramo=='') {
					// create sql part for IN condition by imploding comma after each id
					$ciaIn = "('" . implode("','", $cia) ."')";

					// create sql part for IN condition by imploding comma after each id
					$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";

					$sql="SELECT DISTINCT cod_vend FROM comision, poliza, drecibo, dcia, dramo WHERE 
								poliza.id_poliza = drecibo.idrecibo AND
								poliza.id_cia=dcia.idcia AND
								poliza.id_poliza=comision.id_poliza AND 
								poliza.id_cod_ramo=dramo.cod_ramo AND
								f_hastapoliza >= '$desde' AND
								f_hastapoliza <= '$hasta' AND
								nomcia IN ".$ciaIn." AND
								t_cuenta  IN ".$tipo_cuentaIn." 
								ORDER BY comision.cod_vend ASC";
				}//6
				if ($cia=='' && $tipo_cuenta!='' && $ramo!='') {
					// create sql part for IN condition by imploding comma after each id
					$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";

					// create sql part for IN condition by imploding comma after each id
					$ramoIn = "('" . implode("','", $ramo) ."')";

					$sql="SELECT DISTINCT cod_vend FROM comision, poliza, drecibo, dcia, dramo WHERE 
								poliza.id_poliza = drecibo.idrecibo AND
								poliza.id_cia=dcia.idcia AND
								poliza.id_poliza=comision.id_poliza AND 
								poliza.id_cod_ramo=dramo.cod_ramo AND
								f_hastapoliza >= '$desde' AND
								f_hastapoliza <= '$hasta' AND
								nramo IN ".$ramoIn." AND
								t_cuenta  IN ".$tipo_cuentaIn." 
								ORDER BY comision.cod_vend ASC";
				}//7
				if ($cia!='' && $tipo_cuenta=='' && $ramo!='') {
					// create sql part for IN condition by imploding comma after each id
					$ciaIn = "('" . implode("','", $cia) ."')";

					// create sql part for IN condition by imploding comma after each id
					$ramoIn = "('" . implode("','", $ramo) ."')";

					$sql="SELECT DISTINCT cod_vend FROM comision, poliza, drecibo, dcia, dramo WHERE 
								poliza.id_poliza = drecibo.idrecibo AND
								poliza.id_cia=dcia.idcia AND
								poliza.id_poliza=comision.id_poliza AND 
								poliza.id_cod_ramo=dramo.cod_ramo AND
								f_hastapoliza >= '$desde' AND
								f_hastapoliza <= '$hasta' AND
								nomcia IN ".$ciaIn." AND
								nramo IN ".$ramoIn."  
								ORDER BY comision.cod_vend ASC";
				}//8

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




	public function get_poliza_graf_prima_6($codvend,$ramo,$desde,$hasta,$cia,$tipo_cuenta)
		    {
						  
				if ($cia!='' && $tipo_cuenta!='' && $ramo!='') {
					// create sql part for IN condition by imploding comma after each id
					$ciaIn = "('" . implode("','", $cia) ."')";

					// create sql part for IN condition by imploding comma after each id
					$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";

					// create sql part for IN condition by imploding comma after each id
					$ramoIn = "('" . implode("','", $ramo) ."')";

					$sql="SELECT * FROM comision, poliza, drecibo, dcia, dramo, ena, rep_com WHERE 
								poliza.id_poliza = drecibo.idrecibo AND 
								poliza.id_cod_ramo=dramo.cod_ramo AND 
								rep_com.id_cia=dcia.idcia AND 
								poliza.id_poliza=comision.id_poliza AND 
								comision.cod_vend = ena.cod AND
								comision.id_rep_com = rep_com.id_rep_com AND
								f_hastapoliza >= '$desde' AND
								f_hastapoliza <= '$hasta' AND
								cod_vend = '$codvend' AND
								nomcia IN ".$ciaIn." AND
								nramo IN ".$ramoIn." AND
								t_cuenta  IN ".$tipo_cuentaIn." ";
				}//1
				if ($cia=='' && $tipo_cuenta=='' && $ramo=='') {
					$sql="SELECT * FROM comision, poliza, drecibo, dcia, dramo, ena, rep_com WHERE 
							poliza.id_poliza = drecibo.idrecibo AND 
							poliza.id_cod_ramo=dramo.cod_ramo AND 
							rep_com.id_cia=dcia.idcia AND 
							poliza.id_poliza=comision.id_poliza AND 
							comision.cod_vend = ena.cod AND
							comision.id_rep_com = rep_com.id_rep_com AND
							f_hastapoliza >= '$desde' AND
							f_hastapoliza <= '$hasta' AND
							cod_vend = '$codvend' ";
				}//2
				if ($cia!='' && $tipo_cuenta=='' && $ramo=='') {

					// create sql part for IN condition by imploding comma after each id
					$ciaIn = "('" . implode("','", $cia) ."')";

					$sql="SELECT * FROM comision, poliza, drecibo, dcia, dramo, ena, rep_com WHERE 
							poliza.id_poliza = drecibo.idrecibo AND 
							poliza.id_cod_ramo=dramo.cod_ramo AND 
							rep_com.id_cia=dcia.idcia AND 
							poliza.id_poliza=comision.id_poliza AND 
							comision.cod_vend = ena.cod AND
							comision.id_rep_com = rep_com.id_rep_com AND
							f_hastapoliza >= '$desde' AND
							f_hastapoliza <= '$hasta' AND
							cod_vend = '$codvend' AND
							nomcia IN ".$ciaIn." ";
				}//3
				if ($cia=='' && $tipo_cuenta!='' && $ramo=='') {

					// create sql part for IN condition by imploding comma after each id
					$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";

					$sql="SELECT * FROM comision, poliza, drecibo, dcia, dramo, ena, rep_com WHERE 
							poliza.id_poliza = drecibo.idrecibo AND 
							poliza.id_cod_ramo=dramo.cod_ramo AND 
							rep_com.id_cia=dcia.idcia AND 
							poliza.id_poliza=comision.id_poliza AND 
							comision.cod_vend = ena.cod AND
							comision.id_rep_com = rep_com.id_rep_com AND
							f_hastapoliza >= '$desde' AND
							f_hastapoliza <= '$hasta' AND
							cod_vend = '$codvend' AND
							t_cuenta  IN ".$tipo_cuentaIn." ";
				}//4
				if ($cia=='' && $tipo_cuenta=='' && $ramo!='') {

					// create sql part for IN condition by imploding comma after each id
					$ramoIn = "('" . implode("','", $ramo) ."')";

					$sql="SELECT * FROM comision, poliza, drecibo, dcia, dramo, ena, rep_com WHERE 
							poliza.id_poliza = drecibo.idrecibo AND 
							poliza.id_cod_ramo=dramo.cod_ramo AND 
							rep_com.id_cia=dcia.idcia AND 
							poliza.id_poliza=comision.id_poliza AND 
							comision.cod_vend = ena.cod AND
							comision.id_rep_com = rep_com.id_rep_com AND
							f_hastapoliza >= '$desde' AND
							f_hastapoliza <= '$hasta' AND
							cod_vend = '$codvend' AND
							nramo IN ".$ramoIn."  ";
				}//5
				if ($cia!='' && $tipo_cuenta!='' && $ramo=='') {
					// create sql part for IN condition by imploding comma after each id
					$ciaIn = "('" . implode("','", $cia) ."')";

					// create sql part for IN condition by imploding comma after each id
					$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";

					$sql="SELECT * FROM comision, poliza, drecibo, dcia, dramo, ena, rep_com WHERE 
								poliza.id_poliza = drecibo.idrecibo AND 
								poliza.id_cod_ramo=dramo.cod_ramo AND 
								rep_com.id_cia=dcia.idcia AND 
								poliza.id_poliza=comision.id_poliza AND 
								comision.cod_vend = ena.cod AND
								comision.id_rep_com = rep_com.id_rep_com AND
								f_hastapoliza >= '$desde' AND
								f_hastapoliza <= '$hasta' AND
								cod_vend = '$codvend' AND
								nomcia IN ".$ciaIn." AND
								t_cuenta  IN ".$tipo_cuentaIn." ";
				}//6
				if ($cia=='' && $tipo_cuenta!='' && $ramo!='') {
					// create sql part for IN condition by imploding comma after each id
					$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";

					// create sql part for IN condition by imploding comma after each id
					$ramoIn = "('" . implode("','", $ramo) ."')";

					$sql="SELECT * FROM comision, poliza, drecibo, dcia, dramo, ena, rep_com WHERE 
								poliza.id_poliza = drecibo.idrecibo AND 
								poliza.id_cod_ramo=dramo.cod_ramo AND 
								rep_com.id_cia=dcia.idcia AND 
								poliza.id_poliza=comision.id_poliza AND 
								comision.cod_vend = ena.cod AND
								comision.id_rep_com = rep_com.id_rep_com AND
								f_hastapoliza >= '$desde' AND
								f_hastapoliza <= '$hasta' AND
								cod_vend = '$codvend' AND
								nramo IN ".$ramoIn." AND
								t_cuenta  IN ".$tipo_cuentaIn." ";
				}//7
				if ($cia!='' && $tipo_cuenta=='' && $ramo!='') {
					// create sql part for IN condition by imploding comma after each id
					$ciaIn = "('" . implode("','", $cia) ."')";

					// create sql part for IN condition by imploding comma after each id
					$ramoIn = "('" . implode("','", $ramo) ."')";

					$sql="SELECT * FROM comision, poliza, drecibo, dcia, dramo, ena, rep_com WHERE 
								poliza.id_poliza = drecibo.idrecibo AND 
								poliza.id_cod_ramo=dramo.cod_ramo AND 
								rep_com.id_cia=dcia.idcia AND 
								poliza.id_poliza=comision.id_poliza AND 
								comision.cod_vend = ena.cod AND
								comision.id_rep_com = rep_com.id_rep_com AND
								f_hastapoliza >= '$desde' AND
								f_hastapoliza <= '$hasta' AND
								cod_vend = '$codvend' AND
								nomcia IN ".$ciaIn." AND
								nramo IN ".$ramoIn."  ";
				}//8
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

	public function get_poliza_graf_prima_6_p($codvend,$ramo,$desde,$hasta,$cia,$tipo_cuenta)
		    {
		   
						  
				if ($cia!='' && $tipo_cuenta!='' && $ramo!='') {
					// create sql part for IN condition by imploding comma after each id
					$ciaIn = "('" . implode("','", $cia) ."')";

					// create sql part for IN condition by imploding comma after each id
					$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";

					// create sql part for IN condition by imploding comma after each id
					$ramoIn = "('" . implode("','", $ramo) ."')";

					$sql="SELECT * FROM comision, poliza, drecibo, dcia, dramo, enp, rep_com WHERE 
								poliza.id_poliza = drecibo.idrecibo AND 
								poliza.id_cod_ramo=dramo.cod_ramo AND 
								rep_com.id_cia=dcia.idcia AND 
								poliza.id_poliza=comision.id_poliza AND 
								comision.cod_vend = enp.cod AND
								comision.id_rep_com = rep_com.id_rep_com AND
								f_hastapoliza >= '$desde' AND
								f_hastapoliza <= '$hasta' AND
								cod_vend = '$codvend' AND
								nomcia IN ".$ciaIn." AND
								nramo IN ".$ramoIn." AND
								t_cuenta  IN ".$tipo_cuentaIn." ";
				}//1
				if ($cia=='' && $tipo_cuenta=='' && $ramo=='') {
					$sql="SELECT * FROM comision, poliza, drecibo, dcia, dramo, enp, rep_com WHERE 
							poliza.id_poliza = drecibo.idrecibo AND 
							poliza.id_cod_ramo=dramo.cod_ramo AND 
							rep_com.id_cia=dcia.idcia AND 
							poliza.id_poliza=comision.id_poliza AND 
							comision.cod_vend = enp.cod AND
							comision.id_rep_com = rep_com.id_rep_com AND
							f_hastapoliza >= '$desde' AND
							f_hastapoliza <= '$hasta' AND
							cod_vend = '$codvend' ";
				}//2
				if ($cia!='' && $tipo_cuenta=='' && $ramo=='') {

					// create sql part for IN condition by imploding comma after each id
					$ciaIn = "('" . implode("','", $cia) ."')";

					$sql="SELECT * FROM comision, poliza, drecibo, dcia, dramo, enp, rep_com WHERE 
							poliza.id_poliza = drecibo.idrecibo AND 
							poliza.id_cod_ramo=dramo.cod_ramo AND 
							rep_com.id_cia=dcia.idcia AND 
							poliza.id_poliza=comision.id_poliza AND 
							comision.cod_vend = enp.cod AND
							comision.id_rep_com = rep_com.id_rep_com AND
							f_hastapoliza >= '$desde' AND
							f_hastapoliza <= '$hasta' AND
							cod_vend = '$codvend' AND
							nomcia IN ".$ciaIn." ";
				}//3
				if ($cia=='' && $tipo_cuenta!='' && $ramo=='') {

					// create sql part for IN condition by imploding comma after each id
					$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";

					$sql="SELECT * FROM comision, poliza, drecibo, dcia, dramo, enp, rep_com WHERE 
							poliza.id_poliza = drecibo.idrecibo AND 
							poliza.id_cod_ramo=dramo.cod_ramo AND 
							rep_com.id_cia=dcia.idcia AND 
							poliza.id_poliza=comision.id_poliza AND 
							comision.cod_vend = enp.cod AND
							comision.id_rep_com = rep_com.id_rep_com AND
							f_hastapoliza >= '$desde' AND
							f_hastapoliza <= '$hasta' AND
							cod_vend = '$codvend' AND
							t_cuenta  IN ".$tipo_cuentaIn." ";
				}//4
				if ($cia=='' && $tipo_cuenta=='' && $ramo!='') {

					// create sql part for IN condition by imploding comma after each id
					$ramoIn = "('" . implode("','", $ramo) ."')";

					$sql="SELECT * FROM comision, poliza, drecibo, dcia, dramo, enp, rep_com WHERE 
							poliza.id_poliza = drecibo.idrecibo AND 
							poliza.id_cod_ramo=dramo.cod_ramo AND 
							rep_com.id_cia=dcia.idcia AND 
							poliza.id_poliza=comision.id_poliza AND 
							comision.cod_vend = enp.cod AND
							comision.id_rep_com = rep_com.id_rep_com AND
							f_hastapoliza >= '$desde' AND
							f_hastapoliza <= '$hasta' AND
							cod_vend = '$codvend' AND
							nramo IN ".$ramoIn."  ";
				}//5
				if ($cia!='' && $tipo_cuenta!='' && $ramo=='') {
					// create sql part for IN condition by imploding comma after each id
					$ciaIn = "('" . implode("','", $cia) ."')";

					// create sql part for IN condition by imploding comma after each id
					$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";

					$sql="SELECT * FROM comision, poliza, drecibo, dcia, dramo, enp, rep_com WHERE 
								poliza.id_poliza = drecibo.idrecibo AND 
								poliza.id_cod_ramo=dramo.cod_ramo AND 
								rep_com.id_cia=dcia.idcia AND 
								poliza.id_poliza=comision.id_poliza AND 
								comision.cod_vend = enp.cod AND
								comision.id_rep_com = rep_com.id_rep_com AND
								f_hastapoliza >= '$desde' AND
								f_hastapoliza <= '$hasta' AND
								cod_vend = '$codvend' AND
								nomcia IN ".$ciaIn." AND
								t_cuenta  IN ".$tipo_cuentaIn." ";
				}//6
				if ($cia=='' && $tipo_cuenta!='' && $ramo!='') {
					// create sql part for IN condition by imploding comma after each id
					$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";

					// create sql part for IN condition by imploding comma after each id
					$ramoIn = "('" . implode("','", $ramo) ."')";

					$sql="SELECT * FROM comision, poliza, drecibo, dcia, dramo, enp, rep_com WHERE 
								poliza.id_poliza = drecibo.idrecibo AND 
								poliza.id_cod_ramo=dramo.cod_ramo AND 
								rep_com.id_cia=dcia.idcia AND 
								poliza.id_poliza=comision.id_poliza AND 
								comision.cod_vend = enp.cod AND
								comision.id_rep_com = rep_com.id_rep_com AND
								f_hastapoliza >= '$desde' AND
								f_hastapoliza <= '$hasta' AND
								cod_vend = '$codvend' AND
								nramo IN ".$ramoIn." AND
								t_cuenta  IN ".$tipo_cuentaIn." ";
				}//7
				if ($cia!='' && $tipo_cuenta=='' && $ramo!='') {
					// create sql part for IN condition by imploding comma after each id
					$ciaIn = "('" . implode("','", $cia) ."')";

					// create sql part for IN condition by imploding comma after each id
					$ramoIn = "('" . implode("','", $ramo) ."')";

					$sql="SELECT * FROM comision, poliza, drecibo, dcia, dramo, enp, rep_com WHERE 
								poliza.id_poliza = drecibo.idrecibo AND 
								poliza.id_cod_ramo=dramo.cod_ramo AND 
								rep_com.id_cia=dcia.idcia AND 
								poliza.id_poliza=comision.id_poliza AND 
								comision.cod_vend = enp.cod AND
								comision.id_rep_com = rep_com.id_rep_com AND
								f_hastapoliza >= '$desde' AND
								f_hastapoliza <= '$hasta' AND
								cod_vend = '$codvend' AND
								nomcia IN ".$ciaIn." AND
								nramo IN ".$ramoIn."  ";
				}//8

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

	public function get_poliza_graf_prima_6_r($codvend,$ramo,$desde,$hasta,$cia,$tipo_cuenta)
		    {
						  
				if ($cia!='' && $tipo_cuenta!='' && $ramo!='') {
					// create sql part for IN condition by imploding comma after each id
					$ciaIn = "('" . implode("','", $cia) ."')";

					// create sql part for IN condition by imploding comma after each id
					$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";

					// create sql part for IN condition by imploding comma after each id
					$ramoIn = "('" . implode("','", $ramo) ."')";

					$sql="SELECT * FROM comision, poliza, drecibo, dcia, dramo, enr, rep_com WHERE 
								poliza.id_poliza = drecibo.idrecibo AND 
								poliza.id_cod_ramo=dramo.cod_ramo AND 
								rep_com.id_cia=dcia.idcia AND 
								poliza.id_poliza=comision.id_poliza AND 
								comision.cod_vend = enr.cod AND
								comision.id_rep_com = rep_com.id_rep_com AND
								f_hastapoliza >= '$desde' AND
								f_hastapoliza <= '$hasta' AND
								cod_vend = '$codvend' AND
								nomcia IN ".$ciaIn." AND
								nramo IN ".$ramoIn." AND
								t_cuenta  IN ".$tipo_cuentaIn." ";
				}//1
				if ($cia=='' && $tipo_cuenta=='' && $ramo=='') {
					$sql="SELECT * FROM comision, poliza, drecibo, dcia, dramo, enr, rep_com WHERE 
							poliza.id_poliza = drecibo.idrecibo AND 
							poliza.id_cod_ramo=dramo.cod_ramo AND 
							rep_com.id_cia=dcia.idcia AND 
							poliza.id_poliza=comision.id_poliza AND 
							comision.cod_vend = enr.cod AND
							comision.id_rep_com = rep_com.id_rep_com AND
							f_hastapoliza >= '$desde' AND
							f_hastapoliza <= '$hasta' AND
							cod_vend = '$codvend'  ";
				}//2
				if ($cia!='' && $tipo_cuenta=='' && $ramo=='') {

					// create sql part for IN condition by imploding comma after each id
					$ciaIn = "('" . implode("','", $cia) ."')";

					$sql="SELECT * FROM comision, poliza, drecibo, dcia, dramo, enr, rep_com WHERE 
							poliza.id_poliza = drecibo.idrecibo AND 
							poliza.id_cod_ramo=dramo.cod_ramo AND 
							rep_com.id_cia=dcia.idcia AND 
							poliza.id_poliza=comision.id_poliza AND 
							comision.cod_vend = enr.cod AND
							comision.id_rep_com = rep_com.id_rep_com AND
							f_hastapoliza >= '$desde' AND
							f_hastapoliza <= '$hasta' AND
							cod_vend = '$codvend' AND
							nomcia IN ".$ciaIn." ";
				}//3
				if ($cia=='' && $tipo_cuenta!='' && $ramo=='') {

					// create sql part for IN condition by imploding comma after each id
					$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";

					$sql="SELECT * FROM comision, poliza, drecibo, dcia, dramo, enr, rep_com WHERE 
							poliza.id_poliza = drecibo.idrecibo AND 
							poliza.id_cod_ramo=dramo.cod_ramo AND 
							rep_com.id_cia=dcia.idcia AND 
							poliza.id_poliza=comision.id_poliza AND 
							comision.cod_vend = enr.cod AND
							comision.id_rep_com = rep_com.id_rep_com AND
							f_hastapoliza >= '$desde' AND
							f_hastapoliza <= '$hasta' AND
							cod_vend = '$codvend' AND
							t_cuenta  IN ".$tipo_cuentaIn." ";
				}//4
				if ($cia=='' && $tipo_cuenta=='' && $ramo!='') {

					// create sql part for IN condition by imploding comma after each id
					$ramoIn = "('" . implode("','", $ramo) ."')";

					$sql="SELECT * FROM comision, poliza, drecibo, dcia, dramo, enr, rep_com WHERE 
							poliza.id_poliza = drecibo.idrecibo AND 
							poliza.id_cod_ramo=dramo.cod_ramo AND 
							rep_com.id_cia=dcia.idcia AND 
							poliza.id_poliza=comision.id_poliza AND 
							comision.cod_vend = enr.cod AND
							comision.id_rep_com = rep_com.id_rep_com AND
							f_hastapoliza >= '$desde' AND
							f_hastapoliza <= '$hasta' AND
							cod_vend = '$codvend' AND
							nramo IN ".$ramoIn."  ";
				}//5
				if ($cia!='' && $tipo_cuenta!='' && $ramo=='') {
					// create sql part for IN condition by imploding comma after each id
					$ciaIn = "('" . implode("','", $cia) ."')";

					// create sql part for IN condition by imploding comma after each id
					$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";

					$sql="SELECT * FROM comision, poliza, drecibo, dcia, dramo, enr, rep_com WHERE 
								poliza.id_poliza = drecibo.idrecibo AND 
								poliza.id_cod_ramo=dramo.cod_ramo AND 
								rep_com.id_cia=dcia.idcia AND 
								poliza.id_poliza=comision.id_poliza AND 
								comision.cod_vend = enr.cod AND
								comision.id_rep_com = rep_com.id_rep_com AND
								f_hastapoliza >= '$desde' AND
								f_hastapoliza <= '$hasta' AND
								cod_vend = '$codvend' AND
								nomcia IN ".$ciaIn." AND
								t_cuenta  IN ".$tipo_cuentaIn." ";
				}//6
				if ($cia=='' && $tipo_cuenta!='' && $ramo!='') {
					// create sql part for IN condition by imploding comma after each id
					$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";

					// create sql part for IN condition by imploding comma after each id
					$ramoIn = "('" . implode("','", $ramo) ."')";

					$sql="SELECT * FROM comision, poliza, drecibo, dcia, dramo, enr, rep_com WHERE 
								poliza.id_poliza = drecibo.idrecibo AND 
								poliza.id_cod_ramo=dramo.cod_ramo AND 
								rep_com.id_cia=dcia.idcia AND 
								poliza.id_poliza=comision.id_poliza AND 
								comision.cod_vend = enr.cod AND
								comision.id_rep_com = rep_com.id_rep_com AND
								f_hastapoliza >= '$desde' AND
								f_hastapoliza <= '$hasta' AND
								cod_vend = '$codvend' AND
								nramo IN ".$ramoIn." AND
								t_cuenta  IN ".$tipo_cuentaIn." ";
				}//7
				if ($cia!='' && $tipo_cuenta=='' && $ramo!='') {
					// create sql part for IN condition by imploding comma after each id
					$ciaIn = "('" . implode("','", $cia) ."')";

					// create sql part for IN condition by imploding comma after each id
					$ramoIn = "('" . implode("','", $ramo) ."')";

					$sql="SELECT * FROM comision, poliza, drecibo, dcia, dramo, enr, rep_com WHERE 
								poliza.id_poliza = drecibo.idrecibo AND 
								poliza.id_cod_ramo=dramo.cod_ramo AND 
								rep_com.id_cia=dcia.idcia AND 
								poliza.id_poliza=comision.id_poliza AND 
								comision.cod_vend = enr.cod AND
								comision.id_rep_com = rep_com.id_rep_com AND
								f_hastapoliza >= '$desde' AND
								f_hastapoliza <= '$hasta' AND
								cod_vend = '$codvend' AND
								nomcia IN ".$ciaIn." AND
								nramo IN ".$ramoIn."  ";
				}//8

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


		public function get_poliza_graf_prima_c_6($codvend,$ramo,$desde,$hasta,$cia,$tipo_cuenta)
				{
					if ($cia!='' && $tipo_cuenta!='' && $ramo!='') {
						// create sql part for IN condition by imploding comma after each id
						$ciaIn = "('" . implode("','", $cia) ."')";

						// create sql part for IN condition by imploding comma after each id
						$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";

						// create sql part for IN condition by imploding comma after each id
						$ramoIn = "('" . implode("','", $ramo) ."')";

						$sql="SELECT * FROM poliza, drecibo, dcia, dramo, ena WHERE 
									poliza.id_poliza = drecibo.idrecibo AND 
									poliza.id_cod_ramo=dramo.cod_ramo AND 
									poliza.id_cia=dcia.idcia AND
									poliza.codvend=ena.cod AND
									f_hastapoliza >= '$desde' AND
									f_hastapoliza <= '$hasta' AND
									nomcia IN ".$ciaIn." AND
									nramo IN ".$ramoIn." AND
									t_cuenta  IN ".$tipo_cuentaIn." AND
									poliza.codvend = '$codvend' ";
					}//1
					if ($cia=='' && $tipo_cuenta=='' && $ramo=='') {
						$sql="SELECT * FROM poliza, drecibo, dcia, dramo, ena WHERE 
									poliza.id_poliza = drecibo.idrecibo AND 
									poliza.id_cod_ramo=dramo.cod_ramo AND 
									poliza.id_cia=dcia.idcia AND
									poliza.codvend=ena.cod AND
									f_hastapoliza >= '$desde' AND
									f_hastapoliza <= '$hasta' AND  
									poliza.codvend = '$codvend' ";
					}//2
					if ($cia!='' && $tipo_cuenta=='' && $ramo=='') {

						// create sql part for IN condition by imploding comma after each id
						$ciaIn = "('" . implode("','", $cia) ."')";

						$sql="SELECT * FROM poliza, drecibo, dcia, dramo, ena WHERE 
								poliza.id_poliza = drecibo.idrecibo AND 
								poliza.id_cod_ramo=dramo.cod_ramo AND 
								poliza.id_cia=dcia.idcia AND
								poliza.codvend=ena.cod AND
								f_hastapoliza >= '$desde' AND
								f_hastapoliza <= '$hasta' AND  
								nomcia IN ".$ciaIn." AND  
								poliza.codvend = '$codvend'";
					}//3
					if ($cia=='' && $tipo_cuenta!='' && $ramo=='') {

						// create sql part for IN condition by imploding comma after each id
						$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";

						$sql="SELECT * FROM poliza, drecibo, dcia, dramo, ena WHERE 
								poliza.id_poliza = drecibo.idrecibo AND 
								poliza.id_cod_ramo=dramo.cod_ramo AND 
								poliza.id_cia=dcia.idcia AND
								poliza.codvend=ena.cod AND
								f_hastapoliza >= '$desde' AND
								f_hastapoliza <= '$hasta' AND  
								t_cuenta  IN ".$tipo_cuentaIn." AND  
								poliza.codvend = '$codvend'";
					}//4
					if ($cia=='' && $tipo_cuenta=='' && $ramo!='') {

						// create sql part for IN condition by imploding comma after each id
						$ramoIn = "('" . implode("','", $ramo) ."')";

						$sql="SELECT * FROM poliza, drecibo, dcia, dramo, ena WHERE 
								poliza.id_poliza = drecibo.idrecibo AND 
								poliza.id_cod_ramo=dramo.cod_ramo AND 
								poliza.id_cia=dcia.idcia AND
								poliza.codvend=ena.cod AND
								f_hastapoliza >= '$desde' AND
								f_hastapoliza <= '$hasta' AND 
								nramo IN ".$ramoIn."  AND  
								poliza.codvend = '$codvend'";
					}//5
					if ($cia!='' && $tipo_cuenta!='' && $ramo=='') {
						// create sql part for IN condition by imploding comma after each id
						$ciaIn = "('" . implode("','", $cia) ."')";

						// create sql part for IN condition by imploding comma after each id
						$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";

						$sql="SELECT * FROM poliza, drecibo, dcia, dramo, ena WHERE 
									poliza.id_poliza = drecibo.idrecibo AND 
									poliza.id_cod_ramo=dramo.cod_ramo AND 
									poliza.id_cia=dcia.idcia AND
									poliza.codvend=ena.cod AND
									f_hastapoliza >= '$desde' AND
									f_hastapoliza <= '$hasta' AND 
									nomcia IN ".$ciaIn." AND
									t_cuenta  IN ".$tipo_cuentaIn." AND  
									poliza.codvend = '$codvend'";
					}//6
					if ($cia=='' && $tipo_cuenta!='' && $ramo!='') {
						// create sql part for IN condition by imploding comma after each id
						$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";

						// create sql part for IN condition by imploding comma after each id
						$ramoIn = "('" . implode("','", $ramo) ."')";

						$sql="SELECT * FROM poliza, drecibo, dcia, dramo, ena WHERE 
									poliza.id_poliza = drecibo.idrecibo AND 
									poliza.id_cod_ramo=dramo.cod_ramo AND 
									poliza.id_cia=dcia.idcia AND
									poliza.codvend=ena.cod AND
									f_hastapoliza >= '$desde' AND
									f_hastapoliza <= '$hasta' AND 
									nramo IN ".$ramoIn." AND
									t_cuenta  IN ".$tipo_cuentaIn." AND  
									poliza.codvend = '$codvend' ";
					}//7
					if ($cia!='' && $tipo_cuenta=='' && $ramo!='') {
						// create sql part for IN condition by imploding comma after each id
						$ciaIn = "('" . implode("','", $cia) ."')";

						// create sql part for IN condition by imploding comma after each id
						$ramoIn = "('" . implode("','", $ramo) ."')";

						$sql="SELECT * FROM poliza, drecibo, dcia, dramo, ena WHERE 
									poliza.id_poliza = drecibo.idrecibo AND 
									poliza.id_cod_ramo=dramo.cod_ramo AND 
									poliza.id_cia=dcia.idcia AND
									poliza.codvend=ena.cod AND
									f_hastapoliza >= '$desde' AND
									f_hastapoliza <= '$hasta' AND 
									nomcia IN ".$ciaIn." AND
									nramo IN ".$ramoIn."  AND  
									poliza.codvend = '$codvend' ";
					}//8
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
	
		public function get_poliza_graf_prima_c_6_p($codvend,$ramo,$desde,$hasta,$cia)
				{
					if ($ramo=='Seleccione Ramo') {
						$ramo='';
					}
					if ($cia=='Seleccione Cía') {
						$cia='';
					}
					
					  $sql="SELECT * FROM poliza, drecibo, dcia, dramo, enp WHERE 
							  poliza.id_poliza = drecibo.idrecibo AND 
							  poliza.id_cod_ramo=dramo.cod_ramo AND 
							  poliza.id_cia=dcia.idcia AND
							  poliza.codvend=enp.cod AND
							  f_hastapoliza >= '$desde' AND
							  f_hastapoliza <= '$hasta' AND
							  nramo LIKE '%$ramo%' AND
							  nomcia LIKE '%$cia%' AND
							  poliza.codvend = '$codvend' ";
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
	
		public function get_poliza_graf_prima_c_6_r($codvend,$ramo,$desde,$hasta,$cia,$tipo_cuenta)
				{
					if ($cia!='' && $tipo_cuenta!='' && $ramo!='') {
						// create sql part for IN condition by imploding comma after each id
						$ciaIn = "('" . implode("','", $cia) ."')";

						// create sql part for IN condition by imploding comma after each id
						$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";

						// create sql part for IN condition by imploding comma after each id
						$ramoIn = "('" . implode("','", $ramo) ."')";

						$sql="SELECT * FROM poliza, drecibo, dcia, dramo, enr WHERE 
									poliza.id_poliza = drecibo.idrecibo AND 
									poliza.id_cod_ramo=dramo.cod_ramo AND 
									poliza.id_cia=dcia.idcia AND
									poliza.codvend=enr.cod AND
									f_hastapoliza >= '$desde' AND
									f_hastapoliza <= '$hasta' AND
									nomcia IN ".$ciaIn." AND
									nramo IN ".$ramoIn." AND
									t_cuenta  IN ".$tipo_cuentaIn." AND
									poliza.codvend = '$codvend' ";
					}//1
					if ($cia=='' && $tipo_cuenta=='' && $ramo=='') {
						$sql="SELECT * FROM poliza, drecibo, dcia, dramo, enr WHERE 
									poliza.id_poliza = drecibo.idrecibo AND 
									poliza.id_cod_ramo=dramo.cod_ramo AND 
									poliza.id_cia=dcia.idcia AND
									poliza.codvend=enr.cod AND
									f_hastapoliza >= '$desde' AND
									f_hastapoliza <= '$hasta' AND
									poliza.codvend = '$codvend' ";
					}//2
					if ($cia!='' && $tipo_cuenta=='' && $ramo=='') {

						// create sql part for IN condition by imploding comma after each id
						$ciaIn = "('" . implode("','", $cia) ."')";

						$sql="SELECT * FROM poliza, drecibo, dcia, dramo, enr WHERE 
								poliza.id_poliza = drecibo.idrecibo AND 
								poliza.id_cod_ramo=dramo.cod_ramo AND 
								poliza.id_cia=dcia.idcia AND
								poliza.codvend=enr.cod AND
								f_hastapoliza >= '$desde' AND
								f_hastapoliza <= '$hasta' AND
								nomcia IN ".$ciaIn." AND
								poliza.codvend = '$codvend'  ";
					}//3
					if ($cia=='' && $tipo_cuenta!='' && $ramo=='') {

						// create sql part for IN condition by imploding comma after each id
						$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";

						$sql="SELECT * FROM poliza, drecibo, dcia, dramo, enr WHERE 
								poliza.id_poliza = drecibo.idrecibo AND 
								poliza.id_cod_ramo=dramo.cod_ramo AND 
								poliza.id_cia=dcia.idcia AND
								poliza.codvend=enr.cod AND
								f_hastapoliza >= '$desde' AND
								f_hastapoliza <= '$hasta' AND
								t_cuenta  IN ".$tipo_cuentaIn." AND
								poliza.codvend = '$codvend' ";
					}//4
					if ($cia=='' && $tipo_cuenta=='' && $ramo!='') {

						// create sql part for IN condition by imploding comma after each id
						$ramoIn = "('" . implode("','", $ramo) ."')";

						$sql="SELECT * FROM poliza, drecibo, dcia, dramo, enr WHERE 
								poliza.id_poliza = drecibo.idrecibo AND 
								poliza.id_cod_ramo=dramo.cod_ramo AND 
								poliza.id_cia=dcia.idcia AND
								poliza.codvend=enr.cod AND
								f_hastapoliza >= '$desde' AND
								f_hastapoliza <= '$hasta' AND
								nramo IN ".$ramoIn."  AND
								poliza.codvend = '$codvend'";
					}//5
					if ($cia!='' && $tipo_cuenta!='' && $ramo=='') {
						// create sql part for IN condition by imploding comma after each id
						$ciaIn = "('" . implode("','", $cia) ."')";

						// create sql part for IN condition by imploding comma after each id
						$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";

						$sql="SELECT * FROM poliza, drecibo, dcia, dramo, enr WHERE 
									poliza.id_poliza = drecibo.idrecibo AND 
									poliza.id_cod_ramo=dramo.cod_ramo AND 
									poliza.id_cia=dcia.idcia AND
									poliza.codvend=enr.cod AND
									f_hastapoliza >= '$desde' AND
									f_hastapoliza <= '$hasta' AND
									nomcia IN ".$ciaIn." AND
									t_cuenta  IN ".$tipo_cuentaIn." AND
									poliza.codvend = '$codvend'";
					}//6
					if ($cia=='' && $tipo_cuenta!='' && $ramo!='') {
						// create sql part for IN condition by imploding comma after each id
						$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";

						// create sql part for IN condition by imploding comma after each id
						$ramoIn = "('" . implode("','", $ramo) ."')";

						$sql="SELECT * FROM poliza, drecibo, dcia, dramo, enr WHERE 
									poliza.id_poliza = drecibo.idrecibo AND 
									poliza.id_cod_ramo=dramo.cod_ramo AND 
									poliza.id_cia=dcia.idcia AND
									poliza.codvend=enr.cod AND
									f_hastapoliza >= '$desde' AND
									f_hastapoliza <= '$hasta' AND
									nramo IN ".$ramoIn." AND
									t_cuenta  IN ".$tipo_cuentaIn." AND
									poliza.codvend = '$codvend'";
					}//7
					if ($cia!='' && $tipo_cuenta=='' && $ramo!='') {
						// create sql part for IN condition by imploding comma after each id
						$ciaIn = "('" . implode("','", $cia) ."')";

						// create sql part for IN condition by imploding comma after each id
						$ramoIn = "('" . implode("','", $ramo) ."')";

						$sql="SELECT * FROM poliza, drecibo, dcia, dramo, enr WHERE 
									poliza.id_poliza = drecibo.idrecibo AND 
									poliza.id_cod_ramo=dramo.cod_ramo AND 
									poliza.id_cia=dcia.idcia AND
									poliza.codvend=enr.cod AND
									f_hastapoliza >= '$desde' AND
									f_hastapoliza <= '$hasta' AND
									nomcia IN ".$ciaIn." AND
									nramo IN ".$ramoIn."  AND
									poliza.codvend = '$codvend'";
					}//8
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


    public function get_mes_prima($cond1, $cond2, $cia, $ramo, $tipo_cuenta, $m)
    {
			  
		if ($cia!='' && $tipo_cuenta!='' && $ramo!='') {
			// create sql part for IN condition by imploding comma after each id
			$ciaIn = "('" . implode("','", $cia) ."')";

			// create sql part for IN condition by imploding comma after each id
			$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";

			// create sql part for IN condition by imploding comma after each id
			$ramoIn = "('" . implode("','", $ramo) ."')";

			$sql="SELECT DISTINCT Month(f_desdepoliza) FROM poliza,drecibo,dcia,dramo
						WHERE 
						poliza.id_poliza = drecibo.idrecibo AND
						poliza.id_cod_ramo=dramo.cod_ramo AND
						poliza.id_cia=dcia.idcia AND
						f_desdepoliza >= '$cond1' AND
						f_desdepoliza <= '$cond2' AND
						nomcia IN ".$ciaIn." AND
						nramo IN ".$ramoIn." AND
						t_cuenta  IN ".$tipo_cuentaIn."
						ORDER BY Month(f_desdepoliza) ASC ";
		}//1
		if ($cia=='' && $tipo_cuenta=='' && $ramo=='') {
			$sql="SELECT DISTINCT Month(f_desdepoliza) FROM poliza,drecibo,dcia,dramo
						WHERE 
						poliza.id_poliza = drecibo.idrecibo AND
						poliza.id_cod_ramo=dramo.cod_ramo AND
						poliza.id_cia=dcia.idcia AND
						f_desdepoliza >= '$cond1' AND
						f_desdepoliza <= '$cond2' 
						ORDER BY Month(f_desdepoliza) ASC";
		}//2
		if ($cia!='' && $tipo_cuenta=='' && $ramo=='') {

			// create sql part for IN condition by imploding comma after each id
			$ciaIn = "('" . implode("','", $cia) ."')";

			$sql="SELECT DISTINCT Month(f_desdepoliza) FROM poliza,drecibo,dcia,dramo
						WHERE 
						poliza.id_poliza = drecibo.idrecibo AND
						poliza.id_cod_ramo=dramo.cod_ramo AND
						poliza.id_cia=dcia.idcia AND
						f_desdepoliza >= '$cond1' AND
						f_desdepoliza <= '$cond2' AND
						nomcia IN ".$ciaIn." 
						ORDER BY Month(f_desdepoliza) ASC";
		}//3
		if ($cia=='' && $tipo_cuenta!='' && $ramo=='') {

			// create sql part for IN condition by imploding comma after each id
			$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";

			$sql="SELECT DISTINCT Month(f_desdepoliza) FROM poliza,drecibo,dcia,dramo
						WHERE 
						poliza.id_poliza = drecibo.idrecibo AND
						poliza.id_cod_ramo=dramo.cod_ramo AND
						poliza.id_cia=dcia.idcia AND
						f_desdepoliza >= '$cond1' AND
						f_desdepoliza <= '$cond2' AND
						t_cuenta  IN ".$tipo_cuentaIn." 
						ORDER BY Month(f_desdepoliza) ASC";
		}//4
		if ($cia=='' && $tipo_cuenta=='' && $ramo!='') {

			// create sql part for IN condition by imploding comma after each id
			$ramoIn = "('" . implode("','", $ramo) ."')";

			$sql="SELECT DISTINCT Month(f_desdepoliza) FROM poliza,drecibo,dcia,dramo
						WHERE 
						poliza.id_poliza = drecibo.idrecibo AND
						poliza.id_cod_ramo=dramo.cod_ramo AND
						poliza.id_cia=dcia.idcia AND
						f_desdepoliza >= '$cond1' AND
						f_desdepoliza <= '$cond2' AND
						nramo IN ".$ramoIn."  
						ORDER BY Month(f_desdepoliza) ASC";
		}//5
		if ($cia!='' && $tipo_cuenta!='' && $ramo=='') {
			// create sql part for IN condition by imploding comma after each id
			$ciaIn = "('" . implode("','", $cia) ."')";

			// create sql part for IN condition by imploding comma after each id
			$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";

			$sql="SELECT DISTINCT Month(f_desdepoliza) FROM poliza,drecibo,dcia,dramo
						WHERE 
						poliza.id_poliza = drecibo.idrecibo AND
						poliza.id_cod_ramo=dramo.cod_ramo AND
						poliza.id_cia=dcia.idcia AND
						f_desdepoliza >= '$cond1' AND
						f_desdepoliza <= '$cond2' AND
						nomcia IN ".$ciaIn." AND
						t_cuenta  IN ".$tipo_cuentaIn." 
						ORDER BY Month(f_desdepoliza) ASC";
		}//6
		if ($cia=='' && $tipo_cuenta!='' && $ramo!='') {
			// create sql part for IN condition by imploding comma after each id
			$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";

			// create sql part for IN condition by imploding comma after each id
			$ramoIn = "('" . implode("','", $ramo) ."')";

			$sql="SELECT DISTINCT Month(f_desdepoliza) FROM poliza,drecibo,dcia,dramo
						WHERE 
						poliza.id_poliza = drecibo.idrecibo AND
						poliza.id_cod_ramo=dramo.cod_ramo AND
						poliza.id_cia=dcia.idcia AND
						f_desdepoliza >= '$cond1' AND
						f_desdepoliza <= '$cond2' AND
						nramo IN ".$ramoIn." AND
						t_cuenta  IN ".$tipo_cuentaIn." 
						ORDER BY Month(f_desdepoliza) ASC";
		}//7
		if ($cia!='' && $tipo_cuenta=='' && $ramo!='') {
			// create sql part for IN condition by imploding comma after each id
			$ciaIn = "('" . implode("','", $cia) ."')";

			// create sql part for IN condition by imploding comma after each id
			$ramoIn = "('" . implode("','", $ramo) ."')";

			$sql="SELECT DISTINCT Month(f_desdepoliza) FROM poliza,drecibo,dcia,dramo
						WHERE 
						poliza.id_poliza = drecibo.idrecibo AND
						poliza.id_cod_ramo=dramo.cod_ramo AND
						poliza.id_cia=dcia.idcia AND
						f_desdepoliza >= '$cond1' AND
						f_desdepoliza <= '$cond2' AND
						nomcia IN ".$ciaIn." AND
						nramo IN ".$ramoIn."  
						ORDER BY Month(f_desdepoliza) ASC";
		}//8
		$res=mysqli_query(Conectar::con(),$sql);
		
		$filas=mysqli_num_rows($res); 
		if (!$res) {
				    //No hay registros
			}else{
				$filas=mysqli_num_rows($res); 
				if ($filas == 0) { 
					//echo "No hay registros";
					if ($m==1) {
						header("Location: busqueda_prima_mes.php?m=2#nombre");
					}
					//header("Location: busqueda_prima_semana.php?m=2");
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

	
	public function get_mes_prima_pc($cond1, $cond2, $cia, $ramo, $tipo_cuenta, $m)
			{
					  
				if ($cia!='' && $tipo_cuenta!='' && $ramo!='') {
					// create sql part for IN condition by imploding comma after each id
					$ciaIn = "('" . implode("','", $cia) ."')";
		
					// create sql part for IN condition by imploding comma after each id
					$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";
		
					// create sql part for IN condition by imploding comma after each id
					$ramoIn = "('" . implode("','", $ramo) ."')";
		
					$sql="SELECT DISTINCT Month(f_hastapoliza) FROM poliza,drecibo,dcia,dramo,comision,rep_com
								WHERE 
								poliza.id_poliza = drecibo.idrecibo AND
								poliza.id_cod_ramo=dramo.cod_ramo AND
								rep_com.id_cia=dcia.idcia AND
								rep_com.id_rep_com=comision.id_rep_com AND
								poliza.id_poliza=comision.id_poliza AND
								f_hastapoliza >= '$cond1' AND
								f_hastapoliza <= '$cond2' AND
								nomcia IN ".$ciaIn." AND
								nramo IN ".$ramoIn." AND
								t_cuenta  IN ".$tipo_cuentaIn."
								ORDER BY Month(f_hastapoliza) ASC ";
				}//1
				if ($cia=='' && $tipo_cuenta=='' && $ramo=='') {
					$sql="SELECT DISTINCT Month(f_hastapoliza) FROM poliza,drecibo,dcia,dramo,comision,rep_com
								WHERE 
								poliza.id_poliza = drecibo.idrecibo AND
								poliza.id_cod_ramo=dramo.cod_ramo AND
								rep_com.id_cia=dcia.idcia AND
								rep_com.id_rep_com=comision.id_rep_com AND
								poliza.id_poliza=comision.id_poliza AND
								f_hastapoliza >= '$cond1' AND
								f_hastapoliza <= '$cond2' 
								ORDER BY Month(f_hastapoliza) ASC";
				}//2
				if ($cia!='' && $tipo_cuenta=='' && $ramo=='') {
		
					// create sql part for IN condition by imploding comma after each id
					$ciaIn = "('" . implode("','", $cia) ."')";
		
					$sql="SELECT DISTINCT Month(f_hastapoliza) FROM poliza,drecibo,dcia,dramo,comision,rep_com
								WHERE 
								poliza.id_poliza = drecibo.idrecibo AND
								poliza.id_cod_ramo=dramo.cod_ramo AND
								rep_com.id_cia=dcia.idcia AND
								rep_com.id_rep_com=comision.id_rep_com AND
								poliza.id_poliza=comision.id_poliza AND
								f_hastapoliza >= '$cond1' AND
								f_hastapoliza <= '$cond2' AND
								nomcia IN ".$ciaIn." 
								ORDER BY Month(f_hastapoliza) ASC";
				}//3
				if ($cia=='' && $tipo_cuenta!='' && $ramo=='') {
		
					// create sql part for IN condition by imploding comma after each id
					$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";
		
					$sql="SELECT DISTINCT Month(f_hastapoliza) FROM poliza,drecibo,dcia,dramo,comision,rep_com
								WHERE 
								poliza.id_poliza = drecibo.idrecibo AND
								poliza.id_cod_ramo=dramo.cod_ramo AND
								rep_com.id_cia=dcia.idcia AND
								rep_com.id_rep_com=comision.id_rep_com AND
								poliza.id_poliza=comision.id_poliza AND
								f_hastapoliza >= '$cond1' AND
								f_hastapoliza <= '$cond2' AND
								t_cuenta  IN ".$tipo_cuentaIn." 
								ORDER BY Month(f_hastapoliza) ASC";
				}//4
				if ($cia=='' && $tipo_cuenta=='' && $ramo!='') {
		
					// create sql part for IN condition by imploding comma after each id
					$ramoIn = "('" . implode("','", $ramo) ."')";
		
					$sql="SELECT DISTINCT Month(f_hastapoliza) FROM poliza,drecibo,dcia,dramo,comision,rep_com
								WHERE 
								poliza.id_poliza = drecibo.idrecibo AND
								poliza.id_cod_ramo=dramo.cod_ramo AND
								rep_com.id_cia=dcia.idcia AND
								rep_com.id_rep_com=comision.id_rep_com AND
								poliza.id_poliza=comision.id_poliza AND
								f_hastapoliza >= '$cond1' AND
								f_hastapoliza <= '$cond2' AND
								nramo IN ".$ramoIn."  
								ORDER BY Month(f_hastapoliza) ASC";
				}//5
				if ($cia!='' && $tipo_cuenta!='' && $ramo=='') {
					// create sql part for IN condition by imploding comma after each id
					$ciaIn = "('" . implode("','", $cia) ."')";
		
					// create sql part for IN condition by imploding comma after each id
					$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";
		
					$sql="SELECT DISTINCT Month(f_hastapoliza) FROM poliza,drecibo,dcia,dramo,comision,rep_com
								WHERE 
								poliza.id_poliza = drecibo.idrecibo AND
								poliza.id_cod_ramo=dramo.cod_ramo AND
								rep_com.id_cia=dcia.idcia AND
								rep_com.id_rep_com=comision.id_rep_com AND
								poliza.id_poliza=comision.id_poliza AND
								f_hastapoliza >= '$cond1' AND
								f_hastapoliza <= '$cond2' AND
								nomcia IN ".$ciaIn." AND
								t_cuenta  IN ".$tipo_cuentaIn." 
								ORDER BY Month(f_hastapoliza) ASC";
				}//6
				if ($cia=='' && $tipo_cuenta!='' && $ramo!='') {
					// create sql part for IN condition by imploding comma after each id
					$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";
		
					// create sql part for IN condition by imploding comma after each id
					$ramoIn = "('" . implode("','", $ramo) ."')";
		
					$sql="SELECT DISTINCT Month(f_hastapoliza) FROM poliza,drecibo,dcia,dramo,comision,rep_com
								WHERE 
								poliza.id_poliza = drecibo.idrecibo AND
								poliza.id_cod_ramo=dramo.cod_ramo AND
								rep_com.id_cia=dcia.idcia AND
								rep_com.id_rep_com=comision.id_rep_com AND
								poliza.id_poliza=comision.id_poliza AND
								f_hastapoliza >= '$cond1' AND
								f_hastapoliza <= '$cond2' AND
								nramo IN ".$ramoIn." AND
								t_cuenta  IN ".$tipo_cuentaIn." 
								ORDER BY Month(f_hastapoliza) ASC";
				}//7
				if ($cia!='' && $tipo_cuenta=='' && $ramo!='') {
					// create sql part for IN condition by imploding comma after each id
					$ciaIn = "('" . implode("','", $cia) ."')";
		
					// create sql part for IN condition by imploding comma after each id
					$ramoIn = "('" . implode("','", $ramo) ."')";
		
					$sql="SELECT DISTINCT Month(f_hastapoliza) FROM poliza,drecibo,dcia,dramo,comision,rep_com
								WHERE 
								poliza.id_poliza = drecibo.idrecibo AND
								poliza.id_cod_ramo=dramo.cod_ramo AND
								rep_com.id_cia=dcia.idcia AND
								rep_com.id_rep_com=comision.id_rep_com AND
								poliza.id_poliza=comision.id_poliza AND
								f_hastapoliza >= '$cond1' AND
								f_hastapoliza <= '$cond2' AND
								nomcia IN ".$ciaIn." AND
								nramo IN ".$ramoIn."  
								ORDER BY Month(f_hastapoliza) ASC";
				}//8
				$res=mysqli_query(Conectar::con(),$sql);
				
				$filas=mysqli_num_rows($res); 
				if (!$res) {
							//No hay registros
					}else{
						$filas=mysqli_num_rows($res); 
						if ($filas == 0) { 
							//echo "No hay registros";
							if ($m==1) {
								header("Location: busqueda_prima_mes.php?m=2#nombre");
							}
							//header("Location: busqueda_prima_semana.php?m=2");
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



    public function get_dia_mes_prima($cond1, $cond2, $cia, $ramo, $tipo_cuenta)
    {	
		if ($cia!='' && $tipo_cuenta!='' && $ramo!='') {
			// create sql part for IN condition by imploding comma after each id
			$ciaIn = "('" . implode("','", $cia) ."')";

			// create sql part for IN condition by imploding comma after each id
			$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";

			// create sql part for IN condition by imploding comma after each id
			$ramoIn = "('" . implode("','", $ramo) ."')";

			$sql="SELECT DISTINCT f_desdepoliza FROM poliza,drecibo, dcia, dramo
						WHERE 
						poliza.id_poliza = drecibo.idrecibo AND
						poliza.id_cod_ramo=dramo.cod_ramo AND
						poliza.id_cia=dcia.idcia AND
						f_desdepoliza >= '$cond1' AND
						f_desdepoliza <= '$cond2' AND
						nomcia IN ".$ciaIn." AND
						nramo IN ".$ramoIn." AND
						t_cuenta  IN ".$tipo_cuentaIn." 
						ORDER BY f_desdepoliza ASC";
		}//1
		if ($cia=='' && $tipo_cuenta=='' && $ramo=='') {
			$sql="SELECT DISTINCT f_desdepoliza FROM poliza,drecibo, dcia, dramo
					WHERE 
					poliza.id_poliza = drecibo.idrecibo AND
					poliza.id_cod_ramo=dramo.cod_ramo AND
					poliza.id_cia=dcia.idcia AND
					f_desdepoliza >= '$cond1' AND
					f_desdepoliza <= '$cond2' 
					ORDER BY f_desdepoliza ASC";
		}//2
		if ($cia!='' && $tipo_cuenta=='' && $ramo=='') {

			// create sql part for IN condition by imploding comma after each id
			$ciaIn = "('" . implode("','", $cia) ."')";

			$sql="SELECT DISTINCT f_desdepoliza FROM poliza,drecibo, dcia, dramo
					WHERE 
					poliza.id_poliza = drecibo.idrecibo AND
					poliza.id_cod_ramo=dramo.cod_ramo AND
					poliza.id_cia=dcia.idcia AND
					f_desdepoliza >= '$cond1' AND
					f_desdepoliza <= '$cond2' AND
					nomcia IN ".$ciaIn." 
					ORDER BY f_desdepoliza ASC";
		}//3
		if ($cia=='' && $tipo_cuenta!='' && $ramo=='') {

			// create sql part for IN condition by imploding comma after each id
			$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";

			$sql="SELECT DISTINCT f_desdepoliza FROM poliza,drecibo, dcia, dramo
					WHERE 
					poliza.id_poliza = drecibo.idrecibo AND
					poliza.id_cod_ramo=dramo.cod_ramo AND
					poliza.id_cia=dcia.idcia AND
					f_desdepoliza >= '$cond1' AND
					f_desdepoliza <= '$cond2' AND
					t_cuenta  IN ".$tipo_cuentaIn." 
					ORDER BY f_desdepoliza ASC";
		}//4
		if ($cia=='' && $tipo_cuenta=='' && $ramo!='') {

			// create sql part for IN condition by imploding comma after each id
			$ramoIn = "('" . implode("','", $ramo) ."')";

			$sql="SELECT DISTINCT f_desdepoliza FROM poliza,drecibo, dcia, dramo
					WHERE 
					poliza.id_poliza = drecibo.idrecibo AND
					poliza.id_cod_ramo=dramo.cod_ramo AND
					poliza.id_cia=dcia.idcia AND
					f_desdepoliza >= '$cond1' AND
					f_desdepoliza <= '$cond2' AND
					nramo IN ".$ramoIn."  
					ORDER BY f_desdepoliza ASC";
		}//5
		if ($cia!='' && $tipo_cuenta!='' && $ramo=='') {
			// create sql part for IN condition by imploding comma after each id
			$ciaIn = "('" . implode("','", $cia) ."')";

			// create sql part for IN condition by imploding comma after each id
			$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";

			$sql="SELECT DISTINCT f_desdepoliza FROM poliza,drecibo, dcia, dramo
						WHERE 
						poliza.id_poliza = drecibo.idrecibo AND
						poliza.id_cod_ramo=dramo.cod_ramo AND
						poliza.id_cia=dcia.idcia AND
						f_desdepoliza >= '$cond1' AND
						f_desdepoliza <= '$cond2' AND
						nomcia IN ".$ciaIn." AND
						t_cuenta  IN ".$tipo_cuentaIn." 
						ORDER BY f_desdepoliza ASC";
		}//6
		if ($cia=='' && $tipo_cuenta!='' && $ramo!='') {
			// create sql part for IN condition by imploding comma after each id
			$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";

			// create sql part for IN condition by imploding comma after each id
			$ramoIn = "('" . implode("','", $ramo) ."')";

			$sql="SELECT DISTINCT f_desdepoliza FROM poliza,drecibo, dcia, dramo
						WHERE 
						poliza.id_poliza = drecibo.idrecibo AND
						poliza.id_cod_ramo=dramo.cod_ramo AND
						poliza.id_cia=dcia.idcia AND
						f_desdepoliza >= '$cond1' AND
						f_desdepoliza <= '$cond2' AND
						nramo IN ".$ramoIn." AND
						t_cuenta  IN ".$tipo_cuentaIn." 
						ORDER BY f_desdepoliza ASC";
		}//7
		if ($cia!='' && $tipo_cuenta=='' && $ramo!='') {
			// create sql part for IN condition by imploding comma after each id
			$ciaIn = "('" . implode("','", $cia) ."')";

			// create sql part for IN condition by imploding comma after each id
			$ramoIn = "('" . implode("','", $ramo) ."')";

			$sql="SELECT DISTINCT f_desdepoliza FROM poliza,drecibo, dcia, dramo
						WHERE 
						poliza.id_poliza = drecibo.idrecibo AND
						poliza.id_cod_ramo=dramo.cod_ramo AND
						poliza.id_cia=dcia.idcia AND
						f_desdepoliza >= '$cond1' AND
						f_desdepoliza <= '$cond2' AND
						nomcia IN ".$ciaIn." AND
						nramo IN ".$ramoIn."  
						ORDER BY f_desdepoliza ASC";
		}//8

		$res=mysqli_query(Conectar::con(),$sql);
		
		$filas=mysqli_num_rows($res); 
		if (!$res) {
				    //No hay registros
				}else{
					$filas=mysqli_num_rows($res); 
					if ($filas == 0) { 
						//echo "No hay registros";
						header("Location: busqueda_prima_semana.php?m=2#nombre");
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

	public function get_dia_mes_prima_by_user($cond1, $cond2, $cia, $ramo, $tipo_cuenta,$asesor)
		{	
			if ($cia!='' && $tipo_cuenta!='' && $ramo!='') {
				// create sql part for IN condition by imploding comma after each id
				$ciaIn = "('" . implode("','", $cia) ."')";
	
				// create sql part for IN condition by imploding comma after each id
				$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";
	
				// create sql part for IN condition by imploding comma after each id
				$ramoIn = "('" . implode("','", $ramo) ."')";
	
				$sql="SELECT DISTINCT f_desdepoliza FROM poliza,drecibo, dcia, dramo
							WHERE 
							poliza.id_poliza = drecibo.idrecibo AND
							poliza.id_cod_ramo=dramo.cod_ramo AND
							poliza.id_cia=dcia.idcia AND
							f_desdepoliza >= '$cond1' AND
							f_desdepoliza <= '$cond2' AND
							poliza.codvend = '$asesor' AND
							nomcia IN ".$ciaIn." AND
							nramo IN ".$ramoIn." AND
							t_cuenta  IN ".$tipo_cuentaIn." 
							ORDER BY f_desdepoliza ASC";
			}//1
			if ($cia=='' && $tipo_cuenta=='' && $ramo=='') {
				$sql="SELECT DISTINCT f_desdepoliza FROM poliza,drecibo, dcia, dramo
						WHERE 
						poliza.id_poliza = drecibo.idrecibo AND
						poliza.id_cod_ramo=dramo.cod_ramo AND
						poliza.id_cia=dcia.idcia AND
						poliza.codvend = '$asesor' AND
						f_desdepoliza >= '$cond1' AND
						f_desdepoliza <= '$cond2' 
						ORDER BY f_desdepoliza ASC";
			}//2
			if ($cia!='' && $tipo_cuenta=='' && $ramo=='') {
	
				// create sql part for IN condition by imploding comma after each id
				$ciaIn = "('" . implode("','", $cia) ."')";
	
				$sql="SELECT DISTINCT f_desdepoliza FROM poliza,drecibo, dcia, dramo
						WHERE 
						poliza.id_poliza = drecibo.idrecibo AND
						poliza.id_cod_ramo=dramo.cod_ramo AND
						poliza.id_cia=dcia.idcia AND
						poliza.codvend = '$asesor' AND
						f_desdepoliza >= '$cond1' AND
						f_desdepoliza <= '$cond2' AND
						nomcia IN ".$ciaIn." 
						ORDER BY f_desdepoliza ASC";
			}//3
			if ($cia=='' && $tipo_cuenta!='' && $ramo=='') {
	
				// create sql part for IN condition by imploding comma after each id
				$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";
	
				$sql="SELECT DISTINCT f_desdepoliza FROM poliza,drecibo, dcia, dramo
						WHERE 
						poliza.id_poliza = drecibo.idrecibo AND
						poliza.id_cod_ramo=dramo.cod_ramo AND
						poliza.id_cia=dcia.idcia AND
						poliza.codvend = '$asesor' AND
						f_desdepoliza >= '$cond1' AND
						f_desdepoliza <= '$cond2' AND
						t_cuenta  IN ".$tipo_cuentaIn." 
						ORDER BY f_desdepoliza ASC";
			}//4
			if ($cia=='' && $tipo_cuenta=='' && $ramo!='') {
	
				// create sql part for IN condition by imploding comma after each id
				$ramoIn = "('" . implode("','", $ramo) ."')";
	
				$sql="SELECT DISTINCT f_desdepoliza FROM poliza,drecibo, dcia, dramo
						WHERE 
						poliza.id_poliza = drecibo.idrecibo AND
						poliza.id_cod_ramo=dramo.cod_ramo AND
						poliza.id_cia=dcia.idcia AND
						poliza.codvend = '$asesor' AND
						f_desdepoliza >= '$cond1' AND
						f_desdepoliza <= '$cond2' AND
						nramo IN ".$ramoIn."  
						ORDER BY f_desdepoliza ASC";
			}//5
			if ($cia!='' && $tipo_cuenta!='' && $ramo=='') {
				// create sql part for IN condition by imploding comma after each id
				$ciaIn = "('" . implode("','", $cia) ."')";
	
				// create sql part for IN condition by imploding comma after each id
				$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";
	
				$sql="SELECT DISTINCT f_desdepoliza FROM poliza,drecibo, dcia, dramo
							WHERE 
							poliza.id_poliza = drecibo.idrecibo AND
							poliza.id_cod_ramo=dramo.cod_ramo AND
							poliza.id_cia=dcia.idcia AND
							poliza.codvend = '$asesor' AND
							f_desdepoliza >= '$cond1' AND
							f_desdepoliza <= '$cond2' AND
							nomcia IN ".$ciaIn." AND
							t_cuenta  IN ".$tipo_cuentaIn." 
							ORDER BY f_desdepoliza ASC";
			}//6
			if ($cia=='' && $tipo_cuenta!='' && $ramo!='') {
				// create sql part for IN condition by imploding comma after each id
				$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";
	
				// create sql part for IN condition by imploding comma after each id
				$ramoIn = "('" . implode("','", $ramo) ."')";
	
				$sql="SELECT DISTINCT f_desdepoliza FROM poliza,drecibo, dcia, dramo
							WHERE 
							poliza.id_poliza = drecibo.idrecibo AND
							poliza.id_cod_ramo=dramo.cod_ramo AND
							poliza.id_cia=dcia.idcia AND
							poliza.codvend = '$asesor' AND
							f_desdepoliza >= '$cond1' AND
							f_desdepoliza <= '$cond2' AND
							nramo IN ".$ramoIn." AND
							t_cuenta  IN ".$tipo_cuentaIn." 
							ORDER BY f_desdepoliza ASC";
			}//7
			if ($cia!='' && $tipo_cuenta=='' && $ramo!='') {
				// create sql part for IN condition by imploding comma after each id
				$ciaIn = "('" . implode("','", $cia) ."')";
	
				// create sql part for IN condition by imploding comma after each id
				$ramoIn = "('" . implode("','", $ramo) ."')";
	
				$sql="SELECT DISTINCT f_desdepoliza FROM poliza,drecibo, dcia, dramo
							WHERE 
							poliza.id_poliza = drecibo.idrecibo AND
							poliza.id_cod_ramo=dramo.cod_ramo AND
							poliza.id_cia=dcia.idcia AND
							poliza.codvend = '$asesor' AND
							f_desdepoliza >= '$cond1' AND
							f_desdepoliza <= '$cond2' AND
							nomcia IN ".$ciaIn." AND
							nramo IN ".$ramoIn."  
							ORDER BY f_desdepoliza ASC";
			}//8
	
			$res=mysqli_query(Conectar::con(),$sql);
			
			$filas=mysqli_num_rows($res); 
			if (!$res) {
						//No hay registros
					}else{
						$filas=mysqli_num_rows($res); 
						if ($filas == 0) { 
							//echo "No hay registros";
							header("Location: busqueda_prima_semana.php?m=2#nombre");
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


    public function get_poliza_graf_p3($ramo,$dia,$cia,$tipo_cuenta)
		    {
				if ($cia!='' && $tipo_cuenta!='' && $ramo!='') {
					// create sql part for IN condition by imploding comma after each id
					$ciaIn = "('" . implode("','", $cia) ."')";

					// create sql part for IN condition by imploding comma after each id
					$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";

					// create sql part for IN condition by imploding comma after each id
					$ramoIn = "('" . implode("','", $ramo) ."')";

					$sql="SELECT * FROM poliza,drecibo, dcia, dramo WHERE 
								poliza.id_poliza = drecibo.idrecibo AND
								poliza.id_cod_ramo=dramo.cod_ramo AND
								poliza.id_cia=dcia.idcia AND
								f_desdepoliza = '$dia' AND
								nomcia IN ".$ciaIn." AND
								nramo IN ".$ramoIn." AND
								t_cuenta  IN ".$tipo_cuentaIn." ";
				}//1
				if ($cia=='' && $tipo_cuenta=='' && $ramo=='') {
					$sql="SELECT * FROM poliza,drecibo, dcia, dramo WHERE 
							poliza.id_poliza = drecibo.idrecibo AND
							poliza.id_cod_ramo=dramo.cod_ramo AND
							poliza.id_cia=dcia.idcia AND
							f_desdepoliza = '$dia' ";
				}//2
				if ($cia!='' && $tipo_cuenta=='' && $ramo=='') {

					// create sql part for IN condition by imploding comma after each id
					$ciaIn = "('" . implode("','", $cia) ."')";

					$sql="SELECT * FROM poliza,drecibo, dcia, dramo WHERE 
							poliza.id_poliza = drecibo.idrecibo AND
							poliza.id_cod_ramo=dramo.cod_ramo AND
							poliza.id_cia=dcia.idcia AND
							f_desdepoliza = '$dia' AND
							nomcia IN ".$ciaIn." ";
				}//3
				if ($cia=='' && $tipo_cuenta!='' && $ramo=='') {

					// create sql part for IN condition by imploding comma after each id
					$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";

					$sql="SELECT * FROM poliza,drecibo, dcia, dramo WHERE 
							poliza.id_poliza = drecibo.idrecibo AND
							poliza.id_cod_ramo=dramo.cod_ramo AND
							poliza.id_cia=dcia.idcia AND
							f_desdepoliza = '$dia' AND
							t_cuenta  IN ".$tipo_cuentaIn." ";
				}//4
				if ($cia=='' && $tipo_cuenta=='' && $ramo!='') {

					// create sql part for IN condition by imploding comma after each id
					$ramoIn = "('" . implode("','", $ramo) ."')";

					$sql="SELECT * FROM poliza,drecibo, dcia, dramo WHERE 
							poliza.id_poliza = drecibo.idrecibo AND
							poliza.id_cod_ramo=dramo.cod_ramo AND
							poliza.id_cia=dcia.idcia AND
							f_desdepoliza = '$dia' AND
							nramo IN ".$ramoIn."  ";
				}//5
				if ($cia!='' && $tipo_cuenta!='' && $ramo=='') {
					// create sql part for IN condition by imploding comma after each id
					$ciaIn = "('" . implode("','", $cia) ."')";

					// create sql part for IN condition by imploding comma after each id
					$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";

					$sql="SELECT * FROM poliza,drecibo, dcia, dramo WHERE 
								poliza.id_poliza = drecibo.idrecibo AND
								poliza.id_cod_ramo=dramo.cod_ramo AND
								poliza.id_cia=dcia.idcia AND
								f_desdepoliza = '$dia' AND
								nomcia IN ".$ciaIn." AND
								t_cuenta  IN ".$tipo_cuentaIn." ";
				}//6
				if ($cia=='' && $tipo_cuenta!='' && $ramo!='') {
					// create sql part for IN condition by imploding comma after each id
					$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";

					// create sql part for IN condition by imploding comma after each id
					$ramoIn = "('" . implode("','", $ramo) ."')";

					$sql="SELECT * FROM poliza,drecibo, dcia, dramo WHERE 
								poliza.id_poliza = drecibo.idrecibo AND
								poliza.id_cod_ramo=dramo.cod_ramo AND
								poliza.id_cia=dcia.idcia AND
								f_desdepoliza = '$dia' AND
								nramo IN ".$ramoIn." AND
								t_cuenta  IN ".$tipo_cuentaIn." ";
				}//7
				if ($cia!='' && $tipo_cuenta=='' && $ramo!='') {
					// create sql part for IN condition by imploding comma after each id
					$ciaIn = "('" . implode("','", $cia) ."')";

					// create sql part for IN condition by imploding comma after each id
					$ramoIn = "('" . implode("','", $ramo) ."')";

					$sql="SELECT * FROM poliza,drecibo, dcia, dramo WHERE 
								poliza.id_poliza = drecibo.idrecibo AND
								poliza.id_cod_ramo=dramo.cod_ramo AND
								poliza.id_cia=dcia.idcia AND
								f_desdepoliza = '$dia' AND
								nomcia IN ".$ciaIn." AND
								nramo IN ".$ramoIn."  ";
				}//8

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


	 public function get_poliza_graf_p3_by_user($ramo,$dia,$cia,$tipo_cuenta,$asesor)
		    {
				if ($cia!='' && $tipo_cuenta!='' && $ramo!='') {
					// create sql part for IN condition by imploding comma after each id
					$ciaIn = "('" . implode("','", $cia) ."')";

					// create sql part for IN condition by imploding comma after each id
					$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";

					// create sql part for IN condition by imploding comma after each id
					$ramoIn = "('" . implode("','", $ramo) ."')";

					$sql="SELECT * FROM poliza,drecibo, dcia, dramo WHERE 
								poliza.id_poliza = drecibo.idrecibo AND
								poliza.id_cod_ramo=dramo.cod_ramo AND
								poliza.id_cia=dcia.idcia AND
								poliza.codvend = '$asesor' AND
								f_desdepoliza = '$dia' AND
								nomcia IN ".$ciaIn." AND
								nramo IN ".$ramoIn." AND
								t_cuenta  IN ".$tipo_cuentaIn." ";
				}//1
				if ($cia=='' && $tipo_cuenta=='' && $ramo=='') {
					$sql="SELECT * FROM poliza,drecibo, dcia, dramo WHERE 
							poliza.id_poliza = drecibo.idrecibo AND
							poliza.id_cod_ramo=dramo.cod_ramo AND
							poliza.id_cia=dcia.idcia AND
							poliza.codvend = '$asesor' AND
							f_desdepoliza = '$dia' ";
				}//2
				if ($cia!='' && $tipo_cuenta=='' && $ramo=='') {

					// create sql part for IN condition by imploding comma after each id
					$ciaIn = "('" . implode("','", $cia) ."')";

					$sql="SELECT * FROM poliza,drecibo, dcia, dramo WHERE 
							poliza.id_poliza = drecibo.idrecibo AND
							poliza.id_cod_ramo=dramo.cod_ramo AND
							poliza.id_cia=dcia.idcia AND
							poliza.codvend = '$asesor' AND
							f_desdepoliza = '$dia' AND
							nomcia IN ".$ciaIn." ";
				}//3
				if ($cia=='' && $tipo_cuenta!='' && $ramo=='') {

					// create sql part for IN condition by imploding comma after each id
					$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";

					$sql="SELECT * FROM poliza,drecibo, dcia, dramo WHERE 
							poliza.id_poliza = drecibo.idrecibo AND
							poliza.id_cod_ramo=dramo.cod_ramo AND
							poliza.id_cia=dcia.idcia AND
							poliza.codvend = '$asesor' AND
							f_desdepoliza = '$dia' AND
							t_cuenta  IN ".$tipo_cuentaIn." ";
				}//4
				if ($cia=='' && $tipo_cuenta=='' && $ramo!='') {

					// create sql part for IN condition by imploding comma after each id
					$ramoIn = "('" . implode("','", $ramo) ."')";

					$sql="SELECT * FROM poliza,drecibo, dcia, dramo WHERE 
							poliza.id_poliza = drecibo.idrecibo AND
							poliza.id_cod_ramo=dramo.cod_ramo AND
							poliza.id_cia=dcia.idcia AND
							poliza.codvend = '$asesor' AND
							f_desdepoliza = '$dia' AND
							nramo IN ".$ramoIn."  ";
				}//5
				if ($cia!='' && $tipo_cuenta!='' && $ramo=='') {
					// create sql part for IN condition by imploding comma after each id
					$ciaIn = "('" . implode("','", $cia) ."')";

					// create sql part for IN condition by imploding comma after each id
					$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";

					$sql="SELECT * FROM poliza,drecibo, dcia, dramo WHERE 
								poliza.id_poliza = drecibo.idrecibo AND
								poliza.id_cod_ramo=dramo.cod_ramo AND
								poliza.id_cia=dcia.idcia AND
								poliza.codvend = '$asesor' AND
								f_desdepoliza = '$dia' AND
								nomcia IN ".$ciaIn." AND
								t_cuenta  IN ".$tipo_cuentaIn." ";
				}//6
				if ($cia=='' && $tipo_cuenta!='' && $ramo!='') {
					// create sql part for IN condition by imploding comma after each id
					$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";

					// create sql part for IN condition by imploding comma after each id
					$ramoIn = "('" . implode("','", $ramo) ."')";

					$sql="SELECT * FROM poliza,drecibo, dcia, dramo WHERE 
								poliza.id_poliza = drecibo.idrecibo AND
								poliza.id_cod_ramo=dramo.cod_ramo AND
								poliza.id_cia=dcia.idcia AND
								poliza.codvend = '$asesor' AND
								f_desdepoliza = '$dia' AND
								nramo IN ".$ramoIn." AND
								t_cuenta  IN ".$tipo_cuentaIn." ";
				}//7
				if ($cia!='' && $tipo_cuenta=='' && $ramo!='') {
					// create sql part for IN condition by imploding comma after each id
					$ciaIn = "('" . implode("','", $cia) ."')";

					// create sql part for IN condition by imploding comma after each id
					$ramoIn = "('" . implode("','", $ramo) ."')";

					$sql="SELECT * FROM poliza,drecibo, dcia, dramo WHERE 
								poliza.id_poliza = drecibo.idrecibo AND
								poliza.id_cod_ramo=dramo.cod_ramo AND
								poliza.id_cia=dcia.idcia AND
								poliza.codvend = '$asesor' AND
								f_desdepoliza = '$dia' AND
								nomcia IN ".$ciaIn." AND
								nramo IN ".$ramoIn."  ";
				}//8

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
					 







	public function get_resumen_por_asesor_en_poliza($desde,$hasta,$cod_asesor,$cia,$ramo,$tipo_cuenta)
		    {

				if ($cia!='' && $tipo_cuenta!='' && $ramo!='') {
					// create sql part for IN condition by imploding comma after each id
					$ciaIn = "('" . implode("','", $cia) ."')";

					// create sql part for IN condition by imploding comma after each id
					$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";

					// create sql part for IN condition by imploding comma after each id
					$ramoIn = "('" . implode("','", $ramo) ."')";

					$sql="SELECT prima FROM drecibo 
								INNER JOIN dcia, poliza, dramo WHERE 
								poliza.id_cia=dcia.idcia AND
								poliza.id_poliza=drecibo.idrecibo AND 
								poliza.id_cod_ramo=dramo.cod_ramo AND
								f_hastapoliza >= '$desde' AND
								f_hastapoliza <= '$hasta' AND
								codvend = '$cod_asesor' AND
								nomcia IN ".$ciaIn." AND
								nramo IN ".$ramoIn." AND
								t_cuenta  IN ".$tipo_cuentaIn." ";
				}//1
				if ($cia=='' && $tipo_cuenta=='' && $ramo=='') {
					$sql="SELECT prima FROM drecibo 
							INNER JOIN dcia, poliza, dramo WHERE 
							poliza.id_cia=dcia.idcia AND
							poliza.id_poliza=drecibo.idrecibo AND 
							poliza.id_cod_ramo=dramo.cod_ramo AND
							f_hastapoliza >= '$desde' AND
							f_hastapoliza <= '$hasta' AND
							codvend = '$cod_asesor' ";
				}//2
				if ($cia!='' && $tipo_cuenta=='' && $ramo=='') {

					// create sql part for IN condition by imploding comma after each id
					$ciaIn = "('" . implode("','", $cia) ."')";

					$sql="SELECT prima FROM drecibo 
							INNER JOIN dcia, poliza, dramo WHERE 
							poliza.id_cia=dcia.idcia AND
							poliza.id_poliza=drecibo.idrecibo AND 
							poliza.id_cod_ramo=dramo.cod_ramo AND
							f_hastapoliza >= '$desde' AND
							f_hastapoliza <= '$hasta' AND
							codvend = '$cod_asesor' AND
							nomcia IN ".$ciaIn." ";
				}//3
				if ($cia=='' && $tipo_cuenta!='' && $ramo=='') {

					// create sql part for IN condition by imploding comma after each id
					$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";

					$sql="SELECT prima FROM drecibo 
							INNER JOIN dcia, poliza, dramo WHERE 
							poliza.id_cia=dcia.idcia AND
							poliza.id_poliza=drecibo.idrecibo AND 
							poliza.id_cod_ramo=dramo.cod_ramo AND
							f_hastapoliza >= '$desde' AND
							f_hastapoliza <= '$hasta' AND
							codvend = '$cod_asesor' AND
							t_cuenta  IN ".$tipo_cuentaIn." ";
				}//4
				if ($cia=='' && $tipo_cuenta=='' && $ramo!='') {

					// create sql part for IN condition by imploding comma after each id
					$ramoIn = "('" . implode("','", $ramo) ."')";

					$sql="SELECT prima FROM drecibo 
							INNER JOIN dcia, poliza, dramo WHERE 
							poliza.id_cia=dcia.idcia AND
							poliza.id_poliza=drecibo.idrecibo AND 
							poliza.id_cod_ramo=dramo.cod_ramo AND
							f_hastapoliza >= '$desde' AND
							f_hastapoliza <= '$hasta' AND
							codvend = '$cod_asesor' AND
							nramo IN ".$ramoIn."  ";
				}//5
				if ($cia!='' && $tipo_cuenta!='' && $ramo=='') {
					// create sql part for IN condition by imploding comma after each id
					$ciaIn = "('" . implode("','", $cia) ."')";

					// create sql part for IN condition by imploding comma after each id
					$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";

					$sql="SELECT prima FROM drecibo 
								INNER JOIN dcia, poliza, dramo WHERE 
								poliza.id_cia=dcia.idcia AND
								poliza.id_poliza=drecibo.idrecibo AND 
								poliza.id_cod_ramo=dramo.cod_ramo AND
								f_hastapoliza >= '$desde' AND
								f_hastapoliza <= '$hasta' AND
								codvend = '$cod_asesor' AND
								nomcia IN ".$ciaIn." AND
								t_cuenta  IN ".$tipo_cuentaIn." ";
				}//6
				if ($cia=='' && $tipo_cuenta!='' && $ramo!='') {
					// create sql part for IN condition by imploding comma after each id
					$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";

					// create sql part for IN condition by imploding comma after each id
					$ramoIn = "('" . implode("','", $ramo) ."')";

					$sql="SELECT prima FROM drecibo 
								INNER JOIN dcia, poliza, dramo WHERE 
								poliza.id_cia=dcia.idcia AND
								poliza.id_poliza=drecibo.idrecibo AND 
								poliza.id_cod_ramo=dramo.cod_ramo AND
								f_hastapoliza >= '$desde' AND
								f_hastapoliza <= '$hasta' AND
								codvend = '$cod_asesor' AND
								nramo IN ".$ramoIn." AND
								t_cuenta  IN ".$tipo_cuentaIn." ";
				}//7
				if ($cia!='' && $tipo_cuenta=='' && $ramo!='') {
					// create sql part for IN condition by imploding comma after each id
					$ciaIn = "('" . implode("','", $cia) ."')";

					// create sql part for IN condition by imploding comma after each id
					$ramoIn = "('" . implode("','", $ramo) ."')";

					$sql="SELECT prima FROM drecibo 
								INNER JOIN dcia, poliza, dramo WHERE 
								poliza.id_cia=dcia.idcia AND
								poliza.id_poliza=drecibo.idrecibo AND 
								poliza.id_cod_ramo=dramo.cod_ramo AND
								f_hastapoliza >= '$desde' AND
								f_hastapoliza <= '$hasta' AND
								codvend = '$cod_asesor' AND
								nomcia IN ".$ciaIn." AND
								nramo IN ".$ramoIn."  ";
				}//8
				
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

		public function get_resumen_por_ramo_en_poliza($desde,$hasta,$ramo)
		    {
				
					$sql="SELECT prima FROM poliza 
							INNER JOIN drecibo, dramo WHERE 
							poliza.id_poliza=drecibo.idrecibo AND 
							poliza.id_cod_ramo=dramo.cod_ramo AND
							dramo.nramo = '$ramo' AND
							f_hastapoliza >= '$desde' AND
							f_hastapoliza <= '$hasta' ";
				
				
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

		public function get_resumen_por_ramo_en_poliza_by_user($desde,$hasta,$ramo,$asesor)
		    {
				
					$sql="SELECT prima FROM poliza 
							INNER JOIN drecibo, dramo WHERE 
							poliza.id_poliza=drecibo.idrecibo AND 
							poliza.id_cod_ramo=dramo.cod_ramo AND
							dramo.nramo = '$ramo' AND
							poliza.codvend = '$asesor' AND
							f_hastapoliza >= '$desde' AND
							f_hastapoliza <= '$hasta' ";
				
				
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

		public function get_resumen_por_tpoliza_en_poliza($desde,$hasta,$tpoliza)
		    {
				
					$sql="SELECT prima FROM poliza 
							INNER JOIN drecibo, tipo_poliza WHERE 
							poliza.id_poliza=drecibo.idrecibo AND 
							poliza.id_tpoliza=tipo_poliza.id_t_poliza AND
							tipo_poliza.tipo_poliza = '$tpoliza' AND
							f_hastapoliza >= '$desde' AND
							f_hastapoliza <= '$hasta' ";
				
				
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

			public function get_resumen_por_tpoliza_en_poliza_by_user($desde,$hasta,$tpoliza,$asesor)
		    {
				
					$sql="SELECT prima FROM poliza 
							INNER JOIN drecibo, tipo_poliza WHERE 
							poliza.id_poliza=drecibo.idrecibo AND 
							poliza.id_tpoliza=tipo_poliza.id_t_poliza AND
							tipo_poliza.tipo_poliza = '$tpoliza' AND
							poliza.codvend = '$asesor' AND
							f_hastapoliza >= '$desde' AND
							f_hastapoliza <= '$hasta' ";
				
				
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

		public function get_resumen_por_fpago_en_poliza($desde,$hasta,$fpago)
		    {
				
					$sql="SELECT prima FROM poliza 
							INNER JOIN drecibo WHERE 
							poliza.id_poliza=drecibo.idrecibo AND 
							drecibo.fpago = '$fpago' AND
							f_hastapoliza >= '$desde' AND
							f_hastapoliza <= '$hasta' ";
				
				
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

		public function get_resumen_por_fpago_en_poliza_by_user($desde,$hasta,$fpago,$asesor)
		    {
				
					$sql="SELECT prima FROM poliza 
							INNER JOIN drecibo WHERE 
							poliza.id_poliza=drecibo.idrecibo AND 
							poliza.codvend = '$asesor' AND
							drecibo.fpago = '$fpago' AND
							f_hastapoliza >= '$desde' AND
							f_hastapoliza <= '$hasta' ";
				
				
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

		public function get_resumen_por_mes_en_poliza($desde,$hasta,$mes)
		    {
				
					$sql="SELECT prima FROM poliza 
							INNER JOIN drecibo WHERE 
							poliza.id_poliza=drecibo.idrecibo AND 
							Month(f_hastapoliza) = $mes AND
							f_hastapoliza >= '$desde' AND
							f_hastapoliza <= '$hasta' ";
				
				
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

		public function get_resumen_por_mes_en_poliza_by_user($desde,$hasta,$mes,$asesor)
		    {
				
					$sql="SELECT prima FROM poliza 
							INNER JOIN drecibo WHERE 
							poliza.id_poliza=drecibo.idrecibo AND 
							poliza.codvend = '$asesor' AND
							Month(f_hastapoliza) = $mes AND
							f_hastapoliza >= '$desde' AND
							f_hastapoliza <= '$hasta' ";
				
				
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

		public function get_resumen_por_cia_en_poliza($desde,$hasta,$cia)
		    {
				
					$sql="SELECT prima FROM poliza 
							INNER JOIN drecibo, dcia WHERE 
							poliza.id_poliza=drecibo.idrecibo AND 
							poliza.id_cia=dcia.idcia AND
							dcia.nomcia = '$cia' AND
							f_hastapoliza >= '$desde' AND
							f_hastapoliza <= '$hasta' ";
				
				
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

		public function get_resumen_por_cia_en_poliza_by_user($desde,$hasta,$cia,$asesor)
		    {
				
					$sql="SELECT prima FROM poliza 
							INNER JOIN drecibo, dcia WHERE 
							poliza.id_poliza=drecibo.idrecibo AND 
							poliza.id_cia=dcia.idcia AND
							poliza.codvend = '$asesor' AND
							dcia.nomcia = '$cia' AND
							f_hastapoliza >= '$desde' AND
							f_hastapoliza <= '$hasta' ";
				
				
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




	public function get_resumen_por_asesor($desde,$hasta,$cod_asesor,$cia,$ramo,$tipo_cuenta)
		    {

				if ($cia!='' && $tipo_cuenta!='' && $ramo!='') {
					// create sql part for IN condition by imploding comma after each id
					$ciaIn = "('" . implode("','", $cia) ."')";

					// create sql part for IN condition by imploding comma after each id
					$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";

					// create sql part for IN condition by imploding comma after each id
					$ramoIn = "('" . implode("','", $ramo) ."')";

					$sql="SELECT * FROM comision 
								INNER JOIN dcia, drecibo, poliza, rep_com, dramo WHERE 
								rep_com.id_cia=dcia.idcia AND
								poliza.id_poliza=drecibo.idrecibo AND 
								comision.id_poliza=poliza.id_poliza AND
								rep_com.id_rep_com = comision.id_rep_com AND
								poliza.id_cod_ramo=dramo.cod_ramo AND
								f_hastapoliza >= '$desde' AND
								f_hastapoliza <= '$hasta' AND
								comision.cod_vend = '$cod_asesor' AND
								nomcia IN ".$ciaIn." AND
								nramo IN ".$ramoIn." AND
								t_cuenta  IN ".$tipo_cuentaIn." ";
				}//1
				if ($cia=='' && $tipo_cuenta=='' && $ramo=='') {
					$sql="SELECT * FROM comision 
							INNER JOIN dcia, drecibo, poliza, rep_com, dramo WHERE 
							rep_com.id_cia=dcia.idcia AND
							poliza.id_poliza=drecibo.idrecibo AND 
							comision.id_poliza=poliza.id_poliza AND
							rep_com.id_rep_com = comision.id_rep_com AND
							poliza.id_cod_ramo=dramo.cod_ramo AND
							f_hastapoliza >= '$desde' AND
							f_hastapoliza <= '$hasta' AND
							comision.cod_vend = '$cod_asesor'";
				}//2
				if ($cia!='' && $tipo_cuenta=='' && $ramo=='') {

					// create sql part for IN condition by imploding comma after each id
					$ciaIn = "('" . implode("','", $cia) ."')";

					$sql="SELECT * FROM comision 
							INNER JOIN dcia, drecibo, poliza, rep_com, dramo WHERE 
							rep_com.id_cia=dcia.idcia AND
							poliza.id_poliza=drecibo.idrecibo AND 
							comision.id_poliza=poliza.id_poliza AND
							rep_com.id_rep_com = comision.id_rep_com AND
							poliza.id_cod_ramo=dramo.cod_ramo AND
							f_hastapoliza >= '$desde' AND
							f_hastapoliza <= '$hasta' AND
							comision.cod_vend = '$cod_asesor' AND
							nomcia IN ".$ciaIn." ";
				}//3
				if ($cia=='' && $tipo_cuenta!='' && $ramo=='') {

					// create sql part for IN condition by imploding comma after each id
					$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";

					$sql="SELECT * FROM comision 
							INNER JOIN dcia, drecibo, poliza, rep_com, dramo WHERE 
							rep_com.id_cia=dcia.idcia AND
							poliza.id_poliza=drecibo.idrecibo AND 
							comision.id_poliza=poliza.id_poliza AND
							rep_com.id_rep_com = comision.id_rep_com AND
							poliza.id_cod_ramo=dramo.cod_ramo AND
							f_hastapoliza >= '$desde' AND
							f_hastapoliza <= '$hasta' AND
							comision.cod_vend = '$cod_asesor' AND
							t_cuenta  IN ".$tipo_cuentaIn." ";
				}//4
				if ($cia=='' && $tipo_cuenta=='' && $ramo!='') {

					// create sql part for IN condition by imploding comma after each id
					$ramoIn = "('" . implode("','", $ramo) ."')";

					$sql="SELECT * FROM comision 
							INNER JOIN dcia, drecibo, poliza, rep_com, dramo WHERE 
							rep_com.id_cia=dcia.idcia AND
							poliza.id_poliza=drecibo.idrecibo AND 
							comision.id_poliza=poliza.id_poliza AND
							rep_com.id_rep_com = comision.id_rep_com AND
							poliza.id_cod_ramo=dramo.cod_ramo AND
							f_hastapoliza >= '$desde' AND
							f_hastapoliza <= '$hasta' AND
							comision.cod_vend = '$cod_asesor' AND
							nramo IN ".$ramoIn."  ";
				}//5
				if ($cia!='' && $tipo_cuenta!='' && $ramo=='') {
					// create sql part for IN condition by imploding comma after each id
					$ciaIn = "('" . implode("','", $cia) ."')";

					// create sql part for IN condition by imploding comma after each id
					$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";

					$sql="SELECT * FROM comision 
								INNER JOIN dcia, drecibo, poliza, rep_com, dramo WHERE 
								rep_com.id_cia=dcia.idcia AND
								poliza.id_poliza=drecibo.idrecibo AND 
								comision.id_poliza=poliza.id_poliza AND
								rep_com.id_rep_com = comision.id_rep_com AND
								poliza.id_cod_ramo=dramo.cod_ramo AND
								f_hastapoliza >= '$desde' AND
								f_hastapoliza <= '$hasta' AND
								comision.cod_vend = '$cod_asesor' AND
								nomcia IN ".$ciaIn." AND
								t_cuenta  IN ".$tipo_cuentaIn." ";
				}//6
				if ($cia=='' && $tipo_cuenta!='' && $ramo!='') {
					// create sql part for IN condition by imploding comma after each id
					$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";

					// create sql part for IN condition by imploding comma after each id
					$ramoIn = "('" . implode("','", $ramo) ."')";

					$sql="SELECT * FROM comision 
								INNER JOIN dcia, drecibo, poliza, rep_com, dramo WHERE 
								rep_com.id_cia=dcia.idcia AND
								poliza.id_poliza=drecibo.idrecibo AND 
								comision.id_poliza=poliza.id_poliza AND
								rep_com.id_rep_com = comision.id_rep_com AND
								poliza.id_cod_ramo=dramo.cod_ramo AND
								f_hastapoliza >= '$desde' AND
								f_hastapoliza <= '$hasta' AND
								comision.cod_vend = '$cod_asesor' AND
								nramo IN ".$ramoIn." AND
								t_cuenta  IN ".$tipo_cuentaIn." ";
				}//7
				if ($cia!='' && $tipo_cuenta=='' && $ramo!='') {
					// create sql part for IN condition by imploding comma after each id
					$ciaIn = "('" . implode("','", $cia) ."')";

					// create sql part for IN condition by imploding comma after each id
					$ramoIn = "('" . implode("','", $ramo) ."')";

					$sql="SELECT * FROM comision 
								INNER JOIN dcia, drecibo, poliza, rep_com, dramo WHERE 
								rep_com.id_cia=dcia.idcia AND
								poliza.id_poliza=drecibo.idrecibo AND 
								comision.id_poliza=poliza.id_poliza AND
								rep_com.id_rep_com = comision.id_rep_com AND
								poliza.id_cod_ramo=dramo.cod_ramo AND
								f_hastapoliza >= '$desde' AND
								f_hastapoliza <= '$hasta' AND
								comision.cod_vend = '$cod_asesor' AND
								nomcia IN ".$ciaIn." AND
								nramo IN ".$ramoIn."  ";
				}//8

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



	public function get_poliza_comision_by_id($id_poliza)
		{
				$sql="SELECT * FROM poliza 
				INNER JOIN dcia, drecibo, rep_com, comision, titular
										WHERE 
										rep_com.id_cia=dcia.idcia AND
										poliza.id_poliza=drecibo.idrecibo AND 
										poliza.id_poliza = comision.id_poliza AND
										rep_com.id_rep_com = comision.id_rep_com AND
										poliza.id_titular = titular.id_titular AND
										comision.id_poliza = '$id_poliza' 
										ORDER by f_pago_prima DESC";
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


	public function get_mes_prima_BN()
    {
		    	
      $sql="SELECT DISTINCT Month(f_desdepoliza) FROM poliza,drecibo,dcia,dramo
		      WHERE 
		      poliza.id_poliza = drecibo.idrecibo AND
		      poliza.id_cod_ramo=dramo.cod_ramo AND
		      poliza.id_cia=dcia.idcia 
		      ORDER BY Month(f_desdepoliza) ASC ";
		$res=mysqli_query(Conectar::con(),$sql);
		
		$filas=mysqli_num_rows($res); 
		if ($filas == 0) { 
      	//header("Location: incorrecto.php?m=2");
      	//exit();
       } 
         else
             {
               while($reg=mysqli_fetch_assoc($res)) {
               	$this->t[]=$reg;
              		}
          		return $this->t;
				}
       }


	public function get_poliza_c_cobrada_bn($ramo,$desde,$hasta,$cia,$mes,$tipo_cuenta)
		    {
				if ($cia!='' && $tipo_cuenta!='' && $ramo!='') {
					// create sql part for IN condition by imploding comma after each id
					$ciaIn = "('" . implode("','", $cia) ."')";

					// create sql part for IN condition by imploding comma after each id
					$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";

					// create sql part for IN condition by imploding comma after each id
					$ramoIn = "('" . implode("','", $ramo) ."')";

					$sql="SELECT * FROM poliza 
								INNER JOIN dcia, drecibo, dramo, comision WHERE 
								poliza.id_cia=dcia.idcia AND
								poliza.id_poliza=drecibo.idrecibo AND 
								poliza.id_cod_ramo=dramo.cod_ramo AND
								poliza.id_poliza = comision.id_poliza AND 
								MONTH(f_desdepoliza)=$mes AND
								nomcia IN ".$ciaIn." AND
								nramo IN ".$ramoIn." AND
								t_cuenta  IN ".$tipo_cuentaIn." ";
				}//1
				if ($cia=='' && $tipo_cuenta=='' && $ramo=='') {
					$sql="SELECT * FROM poliza 
								INNER JOIN dcia, drecibo, dramo, comision WHERE 
								poliza.id_cia=dcia.idcia AND
								poliza.id_poliza=drecibo.idrecibo AND 
								poliza.id_cod_ramo=dramo.cod_ramo AND
								poliza.id_poliza = comision.id_poliza AND 
								MONTH(f_desdepoliza)=$mes";
				}//2
				if ($cia!='' && $tipo_cuenta=='' && $ramo=='') {

					// create sql part for IN condition by imploding comma after each id
					$ciaIn = "('" . implode("','", $cia) ."')";

					$sql="SELECT * FROM poliza 
							INNER JOIN dcia, drecibo, dramo, comision WHERE 
							poliza.id_cia=dcia.idcia AND
							poliza.id_poliza=drecibo.idrecibo AND 
							poliza.id_cod_ramo=dramo.cod_ramo AND
							poliza.id_poliza = comision.id_poliza AND 
							MONTH(f_desdepoliza)=$mes AND
							nomcia IN ".$ciaIn." ";
				}//3
				if ($cia=='' && $tipo_cuenta!='' && $ramo=='') {

					// create sql part for IN condition by imploding comma after each id
					$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";

					$sql="SELECT * FROM poliza 
							INNER JOIN dcia, drecibo, dramo, comision WHERE 
							poliza.id_cia=dcia.idcia AND
							poliza.id_poliza=drecibo.idrecibo AND 
							poliza.id_cod_ramo=dramo.cod_ramo AND
							poliza.id_poliza = comision.id_poliza AND 
							MONTH(f_desdepoliza)=$mes AND
							t_cuenta  IN ".$tipo_cuentaIn." ";
				}//4
				if ($cia=='' && $tipo_cuenta=='' && $ramo!='') {

					// create sql part for IN condition by imploding comma after each id
					$ramoIn = "('" . implode("','", $ramo) ."')";

					$sql="SELECT * FROM poliza 
							INNER JOIN dcia, drecibo, dramo, comision WHERE 
							poliza.id_cia=dcia.idcia AND
							poliza.id_poliza=drecibo.idrecibo AND 
							poliza.id_cod_ramo=dramo.cod_ramo AND
							poliza.id_poliza = comision.id_poliza AND 
							MONTH(f_desdepoliza)=$mes AND
							nramo IN ".$ramoIn."  ";
				}//5
				if ($cia!='' && $tipo_cuenta!='' && $ramo=='') {
					// create sql part for IN condition by imploding comma after each id
					$ciaIn = "('" . implode("','", $cia) ."')";

					// create sql part for IN condition by imploding comma after each id
					$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";

					$sql="SELECT * FROM poliza 
								INNER JOIN dcia, drecibo, dramo, comision WHERE 
								poliza.id_cia=dcia.idcia AND
								poliza.id_poliza=drecibo.idrecibo AND 
								poliza.id_cod_ramo=dramo.cod_ramo AND
								poliza.id_poliza = comision.id_poliza AND 
								MONTH(f_desdepoliza)=$mes AND
								nomcia IN ".$ciaIn." AND
								t_cuenta  IN ".$tipo_cuentaIn." ";
				}//6
				if ($cia=='' && $tipo_cuenta!='' && $ramo!='') {
					// create sql part for IN condition by imploding comma after each id
					$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";

					// create sql part for IN condition by imploding comma after each id
					$ramoIn = "('" . implode("','", $ramo) ."')";

					$sql="SELECT * FROM poliza 
								INNER JOIN dcia, drecibo, dramo, comision WHERE 
								poliza.id_cia=dcia.idcia AND
								poliza.id_poliza=drecibo.idrecibo AND 
								poliza.id_cod_ramo=dramo.cod_ramo AND
								poliza.id_poliza = comision.id_poliza AND 
								MONTH(f_desdepoliza)=$mes AND
								nramo IN ".$ramoIn." AND
								t_cuenta  IN ".$tipo_cuentaIn." ";
				}//7
				if ($cia!='' && $tipo_cuenta=='' && $ramo!='') {
					// create sql part for IN condition by imploding comma after each id
					$ciaIn = "('" . implode("','", $cia) ."')";

					// create sql part for IN condition by imploding comma after each id
					$ramoIn = "('" . implode("','", $ramo) ."')";

					$sql="SELECT * FROM poliza 
								INNER JOIN dcia, drecibo, dramo, comision WHERE 
								poliza.id_cia=dcia.idcia AND
								poliza.id_poliza=drecibo.idrecibo AND 
								poliza.id_cod_ramo=dramo.cod_ramo AND
								poliza.id_poliza = comision.id_poliza AND 
								MONTH(f_desdepoliza)=$mes AND
								nomcia IN ".$ciaIn." AND
								nramo IN ".$ramoIn."  ";
				}//8
				$res=mysqli_query(Conectar::con(),$sql);
				
				if (!$res) {
				    //No hay registros
				}else{
					$filas=mysqli_num_rows($res); 
					if ($filas == 0) { 
						//header("Location: busqueda_prima_mes.php?m=2#nombre");
						echo "No hay Registros. Realizar otra Búsqueda";
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

			   public function get_poliza_c_cobrada_bn_by_user($ramo,$desde,$hasta,$cia,$mes,$tipo_cuenta,$asesor)
			   {
				   if ($cia!='' && $tipo_cuenta!='' && $ramo!='') {
					   // create sql part for IN condition by imploding comma after each id
					   $ciaIn = "('" . implode("','", $cia) ."')";
   
					   // create sql part for IN condition by imploding comma after each id
					   $tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";
   
					   // create sql part for IN condition by imploding comma after each id
					   $ramoIn = "('" . implode("','", $ramo) ."')";
   
					   $sql="SELECT * FROM poliza 
								   INNER JOIN dcia, drecibo, dramo, comision WHERE 
								   poliza.id_cia=dcia.idcia AND
								   poliza.id_poliza=drecibo.idrecibo AND 
								   poliza.id_cod_ramo=dramo.cod_ramo AND
								   poliza.id_poliza = comision.id_poliza AND 
								   poliza.codvend = '$asesor' AND
								   MONTH(f_desdepoliza)=$mes AND
								   nomcia IN ".$ciaIn." AND
								   nramo IN ".$ramoIn." AND
								   t_cuenta  IN ".$tipo_cuentaIn." ";
				   }//1
				   if ($cia=='' && $tipo_cuenta=='' && $ramo=='') {
					   $sql="SELECT * FROM poliza 
								   INNER JOIN dcia, drecibo, dramo, comision WHERE 
								   poliza.id_cia=dcia.idcia AND
								   poliza.id_poliza=drecibo.idrecibo AND 
								   poliza.id_cod_ramo=dramo.cod_ramo AND
								   poliza.id_poliza = comision.id_poliza AND 
								   poliza.codvend = '$asesor' AND
								   MONTH(f_desdepoliza)=$mes";
				   }//2
				   if ($cia!='' && $tipo_cuenta=='' && $ramo=='') {
   
					   // create sql part for IN condition by imploding comma after each id
					   $ciaIn = "('" . implode("','", $cia) ."')";
   
					   $sql="SELECT * FROM poliza 
							   INNER JOIN dcia, drecibo, dramo, comision WHERE 
							   poliza.id_cia=dcia.idcia AND
							   poliza.id_poliza=drecibo.idrecibo AND 
							   poliza.id_cod_ramo=dramo.cod_ramo AND
							   poliza.id_poliza = comision.id_poliza AND 
							   poliza.codvend = '$asesor' AND
							   MONTH(f_desdepoliza)=$mes AND
							   nomcia IN ".$ciaIn." ";
				   }//3
				   if ($cia=='' && $tipo_cuenta!='' && $ramo=='') {
   
					   // create sql part for IN condition by imploding comma after each id
					   $tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";
   
					   $sql="SELECT * FROM poliza 
							   INNER JOIN dcia, drecibo, dramo, comision WHERE 
							   poliza.id_cia=dcia.idcia AND
							   poliza.id_poliza=drecibo.idrecibo AND 
							   poliza.id_cod_ramo=dramo.cod_ramo AND
							   poliza.id_poliza = comision.id_poliza AND 
							   poliza.codvend = '$asesor' AND
							   MONTH(f_desdepoliza)=$mes AND
							   t_cuenta  IN ".$tipo_cuentaIn." ";
				   }//4
				   if ($cia=='' && $tipo_cuenta=='' && $ramo!='') {
   
					   // create sql part for IN condition by imploding comma after each id
					   $ramoIn = "('" . implode("','", $ramo) ."')";
   
					   $sql="SELECT * FROM poliza 
							   INNER JOIN dcia, drecibo, dramo, comision WHERE 
							   poliza.id_cia=dcia.idcia AND
							   poliza.id_poliza=drecibo.idrecibo AND 
							   poliza.id_cod_ramo=dramo.cod_ramo AND
							   poliza.id_poliza = comision.id_poliza AND 
							   poliza.codvend = '$asesor' AND
							   MONTH(f_desdepoliza)=$mes AND
							   nramo IN ".$ramoIn."  ";
				   }//5
				   if ($cia!='' && $tipo_cuenta!='' && $ramo=='') {
					   // create sql part for IN condition by imploding comma after each id
					   $ciaIn = "('" . implode("','", $cia) ."')";
   
					   // create sql part for IN condition by imploding comma after each id
					   $tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";
   
					   $sql="SELECT * FROM poliza 
								   INNER JOIN dcia, drecibo, dramo, comision WHERE 
								   poliza.id_cia=dcia.idcia AND
								   poliza.id_poliza=drecibo.idrecibo AND 
								   poliza.id_cod_ramo=dramo.cod_ramo AND
								   poliza.id_poliza = comision.id_poliza AND 
								   poliza.codvend = '$asesor' AND
								   MONTH(f_desdepoliza)=$mes AND
								   nomcia IN ".$ciaIn." AND
								   t_cuenta  IN ".$tipo_cuentaIn." ";
				   }//6
				   if ($cia=='' && $tipo_cuenta!='' && $ramo!='') {
					   // create sql part for IN condition by imploding comma after each id
					   $tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";
   
					   // create sql part for IN condition by imploding comma after each id
					   $ramoIn = "('" . implode("','", $ramo) ."')";
   
					   $sql="SELECT * FROM poliza 
								   INNER JOIN dcia, drecibo, dramo, comision WHERE 
								   poliza.id_cia=dcia.idcia AND
								   poliza.id_poliza=drecibo.idrecibo AND 
								   poliza.id_cod_ramo=dramo.cod_ramo AND
								   poliza.id_poliza = comision.id_poliza AND 
								   poliza.codvend = '$asesor' AND
								   MONTH(f_desdepoliza)=$mes AND
								   nramo IN ".$ramoIn." AND
								   t_cuenta  IN ".$tipo_cuentaIn." ";
				   }//7
				   if ($cia!='' && $tipo_cuenta=='' && $ramo!='') {
					   // create sql part for IN condition by imploding comma after each id
					   $ciaIn = "('" . implode("','", $cia) ."')";
   
					   // create sql part for IN condition by imploding comma after each id
					   $ramoIn = "('" . implode("','", $ramo) ."')";
   
					   $sql="SELECT * FROM poliza 
								   INNER JOIN dcia, drecibo, dramo, comision WHERE 
								   poliza.id_cia=dcia.idcia AND
								   poliza.id_poliza=drecibo.idrecibo AND 
								   poliza.id_cod_ramo=dramo.cod_ramo AND
								   poliza.id_poliza = comision.id_poliza AND 
								   poliza.codvend = '$asesor' AND
								   MONTH(f_desdepoliza)=$mes AND
								   nomcia IN ".$ciaIn." AND
								   nramo IN ".$ramoIn."  ";
				   }//8
				   $res=mysqli_query(Conectar::con(),$sql);
				   
				   if (!$res) {
					   //No hay registros
				   }else{
					   $filas=mysqli_num_rows($res); 
					   if ($filas == 0) { 
						   //header("Location: busqueda_prima_mes.php?m=2#nombre");
						   //echo "No hay Registros. Realizar otra Búsqueda";
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
			   
		public function get_distinct_poliza_c_cobrada_bn($ramo,$desde,$hasta,$cia,$tipo_cuenta)
			   {
					if ($cia!='' && $tipo_cuenta!='' && $ramo!='') {
						// create sql part for IN condition by imploding comma after each id
						$ciaIn = "('" . implode("','", $cia) ."')";

						// create sql part for IN condition by imploding comma after each id
						$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";

						// create sql part for IN condition by imploding comma after each id
						$ramoIn = "('" . implode("','", $ramo) ."')";

						$sql="SELECT DISTINCT comision.id_poliza FROM poliza 
									INNER JOIN dcia, drecibo, dramo, comision WHERE 
									poliza.id_cia=dcia.idcia AND
									poliza.id_poliza=drecibo.idrecibo AND 
									poliza.id_cod_ramo=dramo.cod_ramo AND
									poliza.id_poliza = comision.id_poliza AND 
									f_pago_prima >= '$desde' AND
									f_pago_prima <= '$hasta' AND
									nomcia IN ".$ciaIn." AND
									nramo IN ".$ramoIn." AND
									t_cuenta  IN ".$tipo_cuentaIn." ";
					}//1
					if ($cia=='' && $tipo_cuenta=='' && $ramo=='') {
						$sql="SELECT DISTINCT comision.id_poliza FROM poliza 
									INNER JOIN dcia, drecibo, dramo, comision WHERE 
									poliza.id_cia=dcia.idcia AND
									poliza.id_poliza=drecibo.idrecibo AND 
									poliza.id_cod_ramo=dramo.cod_ramo AND
									poliza.id_poliza = comision.id_poliza AND 
									f_pago_prima >= '$desde' AND
									f_pago_prima <= '$hasta'  ";
					}//2
					if ($cia!='' && $tipo_cuenta=='' && $ramo=='') {

						// create sql part for IN condition by imploding comma after each id
						$ciaIn = "('" . implode("','", $cia) ."')";

						$sql="SELECT DISTINCT comision.id_poliza FROM poliza 
								INNER JOIN dcia, drecibo, dramo, comision WHERE 
								poliza.id_cia=dcia.idcia AND
								poliza.id_poliza=drecibo.idrecibo AND 
								poliza.id_cod_ramo=dramo.cod_ramo AND
								poliza.id_poliza = comision.id_poliza AND 
								f_pago_prima >= '$desde' AND
								f_pago_prima <= '$hasta' AND
								nomcia IN ".$ciaIn." ";
					}//3
					if ($cia=='' && $tipo_cuenta!='' && $ramo=='') {

						// create sql part for IN condition by imploding comma after each id
						$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";

						$sql="SELECT DISTINCT comision.id_poliza FROM poliza 
								INNER JOIN dcia, drecibo, dramo, comision WHERE 
								poliza.id_cia=dcia.idcia AND
								poliza.id_poliza=drecibo.idrecibo AND 
								poliza.id_cod_ramo=dramo.cod_ramo AND
								poliza.id_poliza = comision.id_poliza AND 
								f_pago_prima >= '$desde' AND
								f_pago_prima <= '$hasta' AND
								t_cuenta  IN ".$tipo_cuentaIn." ";
					}//4
					if ($cia=='' && $tipo_cuenta=='' && $ramo!='') {

						// create sql part for IN condition by imploding comma after each id
						$ramoIn = "('" . implode("','", $ramo) ."')";

						$sql="SELECT DISTINCT comision.id_poliza FROM poliza 
								INNER JOIN dcia, drecibo, dramo, comision WHERE 
								poliza.id_cia=dcia.idcia AND
								poliza.id_poliza=drecibo.idrecibo AND 
								poliza.id_cod_ramo=dramo.cod_ramo AND
								poliza.id_poliza = comision.id_poliza AND 
								f_pago_prima >= '$desde' AND
								f_pago_prima <= '$hasta' AND
								nramo IN ".$ramoIn."  ";
					}//5
					if ($cia!='' && $tipo_cuenta!='' && $ramo=='') {
						// create sql part for IN condition by imploding comma after each id
						$ciaIn = "('" . implode("','", $cia) ."')";

						// create sql part for IN condition by imploding comma after each id
						$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";

						$sql="SELECT DISTINCT comision.id_poliza FROM poliza 
									INNER JOIN dcia, drecibo, dramo, comision WHERE 
									poliza.id_cia=dcia.idcia AND
									poliza.id_poliza=drecibo.idrecibo AND 
									poliza.id_cod_ramo=dramo.cod_ramo AND
									poliza.id_poliza = comision.id_poliza AND 
									f_pago_prima >= '$desde' AND
									f_pago_prima <= '$hasta' AND
									nomcia IN ".$ciaIn." AND
									t_cuenta  IN ".$tipo_cuentaIn." ";
					}//6
					if ($cia=='' && $tipo_cuenta!='' && $ramo!='') {
						// create sql part for IN condition by imploding comma after each id
						$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";

						// create sql part for IN condition by imploding comma after each id
						$ramoIn = "('" . implode("','", $ramo) ."')";

						$sql="SELECT DISTINCT comision.id_poliza FROM poliza 
									INNER JOIN dcia, drecibo, dramo, comision WHERE 
									poliza.id_cia=dcia.idcia AND
									poliza.id_poliza=drecibo.idrecibo AND 
									poliza.id_cod_ramo=dramo.cod_ramo AND
									poliza.id_poliza = comision.id_poliza AND 
									f_pago_prima >= '$desde' AND
									f_pago_prima <= '$hasta' AND
									nramo IN ".$ramoIn." AND
									t_cuenta  IN ".$tipo_cuentaIn." ";
					}//7
					if ($cia!='' && $tipo_cuenta=='' && $ramo!='') {
						// create sql part for IN condition by imploding comma after each id
						$ciaIn = "('" . implode("','", $cia) ."')";

						// create sql part for IN condition by imploding comma after each id
						$ramoIn = "('" . implode("','", $ramo) ."')";

						$sql="SELECT DISTINCT comision.id_poliza FROM poliza 
									INNER JOIN dcia, drecibo, dramo, comision WHERE 
									poliza.id_cia=dcia.idcia AND
									poliza.id_poliza=drecibo.idrecibo AND 
									poliza.id_cod_ramo=dramo.cod_ramo AND
									poliza.id_poliza = comision.id_poliza AND 
									f_pago_prima >= '$desde' AND
									f_pago_prima <= '$hasta' AND
									nomcia IN ".$ciaIn." AND
									nramo IN ".$ramoIn."  ";
					}//8
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
			   
			public function get_distinct_poliza_c_cobrada_bn_by_user($ramo,$desde,$hasta,$cia,$tipo_cuenta,$asesor)
			   {
					if ($cia!='' && $tipo_cuenta!='' && $ramo!='') {
						// create sql part for IN condition by imploding comma after each id
						$ciaIn = "('" . implode("','", $cia) ."')";

						// create sql part for IN condition by imploding comma after each id
						$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";

						// create sql part for IN condition by imploding comma after each id
						$ramoIn = "('" . implode("','", $ramo) ."')";

						$sql="SELECT DISTINCT comision.id_poliza FROM poliza 
									INNER JOIN dcia, drecibo, dramo, comision WHERE 
									poliza.id_cia=dcia.idcia AND
									poliza.id_poliza=drecibo.idrecibo AND 
									poliza.id_cod_ramo=dramo.cod_ramo AND
									poliza.id_poliza = comision.id_poliza AND 
									poliza.codvend = '$asesor' AND
									f_pago_prima >= '$desde' AND
									f_pago_prima <= '$hasta' AND
									nomcia IN ".$ciaIn." AND
									nramo IN ".$ramoIn." AND
									t_cuenta  IN ".$tipo_cuentaIn." ";
					}//1
					if ($cia=='' && $tipo_cuenta=='' && $ramo=='') {
						$sql="SELECT DISTINCT comision.id_poliza FROM poliza 
									INNER JOIN dcia, drecibo, dramo, comision WHERE 
									poliza.id_cia=dcia.idcia AND
									poliza.id_poliza=drecibo.idrecibo AND 
									poliza.id_cod_ramo=dramo.cod_ramo AND
									poliza.id_poliza = comision.id_poliza AND 
									poliza.codvend = '$asesor' AND
									f_pago_prima >= '$desde' AND
									f_pago_prima <= '$hasta'  ";
					}//2
					if ($cia!='' && $tipo_cuenta=='' && $ramo=='') {

						// create sql part for IN condition by imploding comma after each id
						$ciaIn = "('" . implode("','", $cia) ."')";

						$sql="SELECT DISTINCT comision.id_poliza FROM poliza 
								INNER JOIN dcia, drecibo, dramo, comision WHERE 
								poliza.id_cia=dcia.idcia AND
								poliza.id_poliza=drecibo.idrecibo AND 
								poliza.id_cod_ramo=dramo.cod_ramo AND
								poliza.id_poliza = comision.id_poliza AND 
								poliza.codvend = '$asesor' AND
								f_pago_prima >= '$desde' AND
								f_pago_prima <= '$hasta' AND
								nomcia IN ".$ciaIn." ";
					}//3
					if ($cia=='' && $tipo_cuenta!='' && $ramo=='') {

						// create sql part for IN condition by imploding comma after each id
						$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";

						$sql="SELECT DISTINCT comision.id_poliza FROM poliza 
								INNER JOIN dcia, drecibo, dramo, comision WHERE 
								poliza.id_cia=dcia.idcia AND
								poliza.id_poliza=drecibo.idrecibo AND 
								poliza.id_cod_ramo=dramo.cod_ramo AND
								poliza.id_poliza = comision.id_poliza AND 
								poliza.codvend = '$asesor' AND
								f_pago_prima >= '$desde' AND
								f_pago_prima <= '$hasta' AND
								t_cuenta  IN ".$tipo_cuentaIn." ";
					}//4
					if ($cia=='' && $tipo_cuenta=='' && $ramo!='') {

						// create sql part for IN condition by imploding comma after each id
						$ramoIn = "('" . implode("','", $ramo) ."')";

						$sql="SELECT DISTINCT comision.id_poliza FROM poliza 
								INNER JOIN dcia, drecibo, dramo, comision WHERE 
								poliza.id_cia=dcia.idcia AND
								poliza.id_poliza=drecibo.idrecibo AND 
								poliza.id_cod_ramo=dramo.cod_ramo AND
								poliza.id_poliza = comision.id_poliza AND 
								poliza.codvend = '$asesor' AND
								f_pago_prima >= '$desde' AND
								f_pago_prima <= '$hasta' AND
								nramo IN ".$ramoIn."  ";
					}//5
					if ($cia!='' && $tipo_cuenta!='' && $ramo=='') {
						// create sql part for IN condition by imploding comma after each id
						$ciaIn = "('" . implode("','", $cia) ."')";

						// create sql part for IN condition by imploding comma after each id
						$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";

						$sql="SELECT DISTINCT comision.id_poliza FROM poliza 
									INNER JOIN dcia, drecibo, dramo, comision WHERE 
									poliza.id_cia=dcia.idcia AND
									poliza.id_poliza=drecibo.idrecibo AND 
									poliza.id_cod_ramo=dramo.cod_ramo AND
									poliza.id_poliza = comision.id_poliza AND 
									poliza.codvend = '$asesor' AND
									f_pago_prima >= '$desde' AND
									f_pago_prima <= '$hasta' AND
									nomcia IN ".$ciaIn." AND
									t_cuenta  IN ".$tipo_cuentaIn." ";
					}//6
					if ($cia=='' && $tipo_cuenta!='' && $ramo!='') {
						// create sql part for IN condition by imploding comma after each id
						$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";

						// create sql part for IN condition by imploding comma after each id
						$ramoIn = "('" . implode("','", $ramo) ."')";

						$sql="SELECT DISTINCT comision.id_poliza FROM poliza 
									INNER JOIN dcia, drecibo, dramo, comision WHERE 
									poliza.id_cia=dcia.idcia AND
									poliza.id_poliza=drecibo.idrecibo AND 
									poliza.id_cod_ramo=dramo.cod_ramo AND
									poliza.id_poliza = comision.id_poliza AND 
									poliza.codvend = '$asesor' AND
									f_pago_prima >= '$desde' AND
									f_pago_prima <= '$hasta' AND
									nramo IN ".$ramoIn." AND
									t_cuenta  IN ".$tipo_cuentaIn." ";
					}//7
					if ($cia!='' && $tipo_cuenta=='' && $ramo!='') {
						// create sql part for IN condition by imploding comma after each id
						$ciaIn = "('" . implode("','", $cia) ."')";

						// create sql part for IN condition by imploding comma after each id
						$ramoIn = "('" . implode("','", $ramo) ."')";

						$sql="SELECT DISTINCT comision.id_poliza FROM poliza 
									INNER JOIN dcia, drecibo, dramo, comision WHERE 
									poliza.id_cia=dcia.idcia AND
									poliza.id_poliza=drecibo.idrecibo AND 
									poliza.id_cod_ramo=dramo.cod_ramo AND
									poliza.id_poliza = comision.id_poliza AND 
									poliza.codvend = '$asesor' AND
									f_pago_prima >= '$desde' AND
									f_pago_prima <= '$hasta' AND
									nomcia IN ".$ciaIn." AND
									nramo IN ".$ramoIn."  ";
					}//8
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


		public function get_distinct_ramo_prima_c($anio,$cia,$tipo_cuenta)
			{
				if ($cia!='' && $tipo_cuenta!='') {
					// create sql part for IN condition by imploding comma after each id
					$ciaIn = "('" . implode("','", $cia) ."')";

					// create sql part for IN condition by imploding comma after each id
					$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";

					$sql="SELECT DISTINCT nramo FROM poliza 
							INNER JOIN dcia, dramo, comision WHERE 
							poliza.id_cia=dcia.idcia AND
							poliza.id_cod_ramo=dramo.cod_ramo AND
							poliza.id_poliza = comision.id_poliza AND 
							nomcia IN ".$ciaIn." AND
							t_cuenta  IN ".$tipo_cuentaIn." AND
							YEAR(f_pago_prima)=$anio
							ORDER BY dramo.nramo ASC ";
				}
				if ($cia=='' && $tipo_cuenta=='') {
					$sql="SELECT DISTINCT nramo FROM poliza 
							INNER JOIN dcia, dramo, comision WHERE 
							poliza.id_cia=dcia.idcia AND
							poliza.id_cod_ramo=dramo.cod_ramo AND
							poliza.id_poliza = comision.id_poliza AND 
							YEAR(f_pago_prima)=$anio
							ORDER BY dramo.nramo ASC";
				}
				if ($cia=='' && $tipo_cuenta!='') {

					// create sql part for IN condition by imploding comma after each id
					$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";

					$sql="SELECT DISTINCT nramo FROM poliza 
							INNER JOIN dcia, dramo, comision WHERE 
							poliza.id_cia=dcia.idcia AND
							poliza.id_cod_ramo=dramo.cod_ramo AND
							poliza.id_poliza = comision.id_poliza AND 
							t_cuenta  IN ".$tipo_cuentaIn." AND 
							YEAR(f_pago_prima)=$anio
							ORDER BY dramo.nramo ASC";
				}
				if ($tipo_cuenta=='' && $cia!='') {

					// create sql part for IN condition by imploding comma after each id
					$ciaIn = "('" . implode("','", $cia) ."')";

					$sql="SELECT DISTINCT nramo FROM poliza 
							INNER JOIN dcia, dramo, comision WHERE 
							poliza.id_cia=dcia.idcia AND
							poliza.id_cod_ramo=dramo.cod_ramo AND
							poliza.id_poliza = comision.id_poliza AND 
							nomcia IN ".$ciaIn."AND 
							YEAR(f_pago_prima)=$anio
							ORDER BY dramo.nramo ASC";
				}

				$res=mysqli_query(Conectar::con(),$sql);
					  
				if (!$res) {
					//No hay registros
				}else{
					$filas=mysqli_num_rows($res); 
					if ($filas == 0) { 
						header("Location: busqueda_ramo.php?m=2#nombre");
						//exit();
					}else{
						while($reg=mysqli_fetch_assoc($res)) {
							 $this->t[]=$reg;
						}
						return $this->t;
						}
					}
			}

			public function get_distinct_ramo_prima_c_by_user($anio,$cia,$tipo_cuenta,$asesor)
			{
				if ($cia!='' && $tipo_cuenta!='') {
					// create sql part for IN condition by imploding comma after each id
					$ciaIn = "('" . implode("','", $cia) ."')";

					// create sql part for IN condition by imploding comma after each id
					$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";

					$sql="SELECT DISTINCT nramo FROM poliza 
							INNER JOIN dcia, dramo, comision WHERE 
							poliza.id_cia=dcia.idcia AND
							poliza.id_cod_ramo=dramo.cod_ramo AND
							poliza.id_poliza = comision.id_poliza AND 
							poliza.codvend = '$asesor' AND
							nomcia IN ".$ciaIn." AND
							t_cuenta  IN ".$tipo_cuentaIn." AND
							YEAR(f_pago_prima)=$anio
							ORDER BY dramo.nramo ASC ";
				}
				if ($cia=='' && $tipo_cuenta=='') {
					$sql="SELECT DISTINCT nramo FROM poliza 
							INNER JOIN dcia, dramo, comision WHERE 
							poliza.id_cia=dcia.idcia AND
							poliza.id_cod_ramo=dramo.cod_ramo AND
							poliza.id_poliza = comision.id_poliza AND 
							poliza.codvend = '$asesor' AND
							YEAR(f_pago_prima)=$anio
							ORDER BY dramo.nramo ASC";
				}
				if ($cia=='' && $tipo_cuenta!='') {

					// create sql part for IN condition by imploding comma after each id
					$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";

					$sql="SELECT DISTINCT nramo FROM poliza 
							INNER JOIN dcia, dramo, comision WHERE 
							poliza.id_cia=dcia.idcia AND
							poliza.id_cod_ramo=dramo.cod_ramo AND
							poliza.id_poliza = comision.id_poliza AND 
							poliza.codvend = '$asesor' AND
							t_cuenta  IN ".$tipo_cuentaIn." AND 
							YEAR(f_pago_prima)=$anio
							ORDER BY dramo.nramo ASC";
				}
				if ($tipo_cuenta=='' && $cia!='') {

					// create sql part for IN condition by imploding comma after each id
					$ciaIn = "('" . implode("','", $cia) ."')";

					$sql="SELECT DISTINCT nramo FROM poliza 
							INNER JOIN dcia, dramo, comision WHERE 
							poliza.id_cia=dcia.idcia AND
							poliza.id_cod_ramo=dramo.cod_ramo AND
							poliza.id_poliza = comision.id_poliza AND 
							poliza.codvend = '$asesor' AND
							nomcia IN ".$ciaIn."AND 
							YEAR(f_pago_prima)=$anio
							ORDER BY dramo.nramo ASC";
				}

				$res=mysqli_query(Conectar::con(),$sql);
					  
				if (!$res) {
					//No hay registros
				}else{
					$filas=mysqli_num_rows($res); 
					if ($filas == 0) { 
						header("Location: busqueda_ramo.php?m=2#nombre");
						//exit();
					}else{
						while($reg=mysqli_fetch_assoc($res)) {
							 $this->t[]=$reg;
						}
						return $this->t;
						}
					}
			}
		
		public function get_distinct_cia_prima_c($anio,$ramo,$tipo_cuenta)
			{
				if ($ramo!='' && $tipo_cuenta!='') {
					// create sql part for IN condition by imploding comma after each id
					$ramoIn = "('" . implode("','", $ramo) ."')";

					// create sql part for IN condition by imploding comma after each id
					$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";

					$sql="SELECT DISTINCT nomcia FROM poliza 
								INNER JOIN dcia, dramo, comision WHERE 
								poliza.id_cia=dcia.idcia AND
								poliza.id_cod_ramo=dramo.cod_ramo AND
								poliza.id_poliza = comision.id_poliza AND 
								YEAR(f_pago_prima)=$anio AND
								nramo IN ".$ramoIn." AND
								t_cuenta  IN ".$tipo_cuentaIn." 
								ORDER BY dcia.nomcia ASC";
				}
				if ($ramo=='' && $tipo_cuenta=='') {
					$sql="SELECT DISTINCT nomcia FROM poliza 
							INNER JOIN dcia, dramo, comision WHERE 
							poliza.id_cia=dcia.idcia AND
							poliza.id_cod_ramo=dramo.cod_ramo AND
							poliza.id_poliza = comision.id_poliza AND 
							YEAR(f_pago_prima)=$anio 
							ORDER BY dcia.nomcia ASC";
				}
				if ($ramo=='' && $tipo_cuenta!='') {

					// create sql part for IN condition by imploding comma after each id
					$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";

					$sql="SELECT DISTINCT nomcia FROM poliza 
							INNER JOIN dcia, dramo, comision WHERE 
							poliza.id_cia=dcia.idcia AND
							poliza.id_cod_ramo=dramo.cod_ramo AND
							poliza.id_poliza = comision.id_poliza AND 
							YEAR(f_pago_prima)=$anio AND
							t_cuenta  IN ".$tipo_cuentaIn." 
							ORDER BY dcia.nomcia ASC";
				}
				if ($tipo_cuenta=='' && $ramo!='') {

					// create sql part for IN condition by imploding comma after each id
					$ramoIn = "('" . implode("','", $ramo) ."')";

					$sql="SELECT DISTINCT nomcia FROM poliza 
							INNER JOIN dcia, dramo, comision WHERE 
							poliza.id_cia=dcia.idcia AND
							poliza.id_cod_ramo=dramo.cod_ramo AND
							poliza.id_poliza = comision.id_poliza AND 
							YEAR(f_pago_prima)=$anio AND
							nramo IN ".$ramoIn."
							ORDER BY dcia.nomcia ASC";
				}

				$res=mysqli_query(Conectar::con(),$sql);
					  
				if (!$res) {
					//No hay registros
				}else{
					$filas=mysqli_num_rows($res); 
					if ($filas == 0) { 
						header("Location: busqueda_cia.php?m=2#nombre");
						//exit();
					}else{
						while($reg=mysqli_fetch_assoc($res)) {
							 $this->t[]=$reg;
						}
						return $this->t;
						}
					}
			}

		public function get_distinct_cia_prima_c_by_user($anio,$ramo,$tipo_cuenta,$asesor)
			{
				if ($ramo!='' && $tipo_cuenta!='') {
					// create sql part for IN condition by imploding comma after each id
					$ramoIn = "('" . implode("','", $ramo) ."')";

					// create sql part for IN condition by imploding comma after each id
					$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";

					$sql="SELECT DISTINCT nomcia FROM poliza 
								INNER JOIN dcia, dramo, comision WHERE 
								poliza.id_cia=dcia.idcia AND
								poliza.id_cod_ramo=dramo.cod_ramo AND
								poliza.id_poliza = comision.id_poliza AND 
								poliza.codvend = '$asesor' AND
								YEAR(f_pago_prima)=$anio AND
								nramo IN ".$ramoIn." AND
								t_cuenta  IN ".$tipo_cuentaIn." 
								ORDER BY dcia.nomcia ASC";
				}
				if ($ramo=='' && $tipo_cuenta=='') {
					$sql="SELECT DISTINCT nomcia FROM poliza 
							INNER JOIN dcia, dramo, comision WHERE 
							poliza.id_cia=dcia.idcia AND
							poliza.id_cod_ramo=dramo.cod_ramo AND
							poliza.id_poliza = comision.id_poliza AND 
							poliza.codvend = '$asesor' AND
							YEAR(f_pago_prima)=$anio 
							ORDER BY dcia.nomcia ASC";
				}
				if ($ramo=='' && $tipo_cuenta!='') {

					// create sql part for IN condition by imploding comma after each id
					$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";

					$sql="SELECT DISTINCT nomcia FROM poliza 
							INNER JOIN dcia, dramo, comision WHERE 
							poliza.id_cia=dcia.idcia AND
							poliza.id_cod_ramo=dramo.cod_ramo AND
							poliza.id_poliza = comision.id_poliza AND 
							poliza.codvend = '$asesor' AND
							YEAR(f_pago_prima)=$anio AND
							t_cuenta  IN ".$tipo_cuentaIn." 
							ORDER BY dcia.nomcia ASC";
				}
				if ($tipo_cuenta=='' && $ramo!='') {

					// create sql part for IN condition by imploding comma after each id
					$ramoIn = "('" . implode("','", $ramo) ."')";

					$sql="SELECT DISTINCT nomcia FROM poliza 
							INNER JOIN dcia, dramo, comision WHERE 
							poliza.id_cia=dcia.idcia AND
							poliza.id_cod_ramo=dramo.cod_ramo AND
							poliza.id_poliza = comision.id_poliza AND 
							poliza.codvend = '$asesor' AND
							YEAR(f_pago_prima)=$anio AND
							nramo IN ".$ramoIn."
							ORDER BY dcia.nomcia ASC";
				}

				$res=mysqli_query(Conectar::con(),$sql);
					  
				if (!$res) {
					//No hay registros
				}else{
					$filas=mysqli_num_rows($res); 
					if ($filas == 0) { 
						header("Location: busqueda_cia.php?m=2#nombre");
						//exit();
					}else{
						while($reg=mysqli_fetch_assoc($res)) {
							 $this->t[]=$reg;
						}
						return $this->t;
						}
					}
			}

		
		public function get_distinct_tipo_poliza_prima_c($anio,$ramo,$cia,$tipo_cuenta)
			{
				if ($cia!='' && $tipo_cuenta!='' && $ramo!='') {
					// create sql part for IN condition by imploding comma after each id
					$ciaIn = "('" . implode("','", $cia) ."')";

					// create sql part for IN condition by imploding comma after each id
					$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";

					// create sql part for IN condition by imploding comma after each id
					$ramoIn = "('" . implode("','", $ramo) ."')";

					$sql="SELECT DISTINCT tipo_poliza FROM poliza 
								INNER JOIN dcia, dramo, comision, tipo_poliza WHERE 
								poliza.id_cia=dcia.idcia AND
								poliza.id_cod_ramo=dramo.cod_ramo AND
								poliza.id_poliza = comision.id_poliza AND 
								poliza.id_tpoliza = tipo_poliza.id_t_poliza AND
								YEAR(f_pago_prima)=$anio AND
								nomcia IN ".$ciaIn." AND
								nramo IN ".$ramoIn." AND
								t_cuenta  IN ".$tipo_cuentaIn." 
								ORDER BY tipo_poliza ASC";
				}//1
				if ($cia=='' && $tipo_cuenta=='' && $ramo=='') {
					$sql="SELECT DISTINCT tipo_poliza FROM poliza 
							INNER JOIN dcia, dramo, comision, tipo_poliza WHERE 
							poliza.id_cia=dcia.idcia AND
							poliza.id_cod_ramo=dramo.cod_ramo AND
							poliza.id_poliza = comision.id_poliza AND 
							poliza.id_tpoliza = tipo_poliza.id_t_poliza AND
							YEAR(f_pago_prima)=$anio 
							ORDER BY tipo_poliza ASC";
				}//2
				if ($cia!='' && $tipo_cuenta=='' && $ramo=='') {

					// create sql part for IN condition by imploding comma after each id
					$ciaIn = "('" . implode("','", $cia) ."')";

					$sql="SELECT DISTINCT tipo_poliza FROM poliza 
							INNER JOIN dcia, dramo, comision, tipo_poliza WHERE 
							poliza.id_cia=dcia.idcia AND
							poliza.id_cod_ramo=dramo.cod_ramo AND
							poliza.id_poliza = comision.id_poliza AND 
							poliza.id_tpoliza = tipo_poliza.id_t_poliza AND
							YEAR(f_pago_prima)=$anio AND
							nomcia IN ".$ciaIn." 
							ORDER BY tipo_poliza ASC";
				}//3
				if ($cia=='' && $tipo_cuenta!='' && $ramo=='') {

					// create sql part for IN condition by imploding comma after each id
					$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";

					$sql="SELECT DISTINCT tipo_poliza FROM poliza 
							INNER JOIN dcia, dramo, comision, tipo_poliza WHERE 
							poliza.id_cia=dcia.idcia AND
							poliza.id_cod_ramo=dramo.cod_ramo AND
							poliza.id_poliza = comision.id_poliza AND 
							poliza.id_tpoliza = tipo_poliza.id_t_poliza AND
							YEAR(f_pago_prima)=$anio AND
							t_cuenta  IN ".$tipo_cuentaIn." 
							ORDER BY tipo_poliza ASC";
				}//4
				if ($cia=='' && $tipo_cuenta=='' && $ramo!='') {

					// create sql part for IN condition by imploding comma after each id
					$ramoIn = "('" . implode("','", $ramo) ."')";

					$sql="SELECT DISTINCT tipo_poliza FROM poliza 
							INNER JOIN dcia, dramo, comision, tipo_poliza WHERE 
							poliza.id_cia=dcia.idcia AND
							poliza.id_cod_ramo=dramo.cod_ramo AND
							poliza.id_poliza = comision.id_poliza AND 
							poliza.id_tpoliza = tipo_poliza.id_t_poliza AND
							YEAR(f_pago_prima)=$anio AND
							nramo IN ".$ramoIn."  
							ORDER BY tipo_poliza ASC";
				}//5
				if ($cia!='' && $tipo_cuenta!='' && $ramo=='') {
					// create sql part for IN condition by imploding comma after each id
					$ciaIn = "('" . implode("','", $cia) ."')";

					// create sql part for IN condition by imploding comma after each id
					$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";

					$sql="SELECT DISTINCT tipo_poliza FROM poliza 
								INNER JOIN dcia, dramo, comision, tipo_poliza WHERE 
								poliza.id_cia=dcia.idcia AND
								poliza.id_cod_ramo=dramo.cod_ramo AND
								poliza.id_poliza = comision.id_poliza AND 
								poliza.id_tpoliza = tipo_poliza.id_t_poliza AND
								YEAR(f_pago_prima)=$anio AND
								nomcia IN ".$ciaIn." AND
								t_cuenta  IN ".$tipo_cuentaIn." 
								ORDER BY tipo_poliza ASC";
				}//6
				if ($cia=='' && $tipo_cuenta!='' && $ramo!='') {
					// create sql part for IN condition by imploding comma after each id
					$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";

					// create sql part for IN condition by imploding comma after each id
					$ramoIn = "('" . implode("','", $ramo) ."')";

					$sql="SELECT DISTINCT tipo_poliza FROM poliza 
								INNER JOIN dcia, dramo, comision, tipo_poliza WHERE 
								poliza.id_cia=dcia.idcia AND
								poliza.id_cod_ramo=dramo.cod_ramo AND
								poliza.id_poliza = comision.id_poliza AND 
								poliza.id_tpoliza = tipo_poliza.id_t_poliza AND
								YEAR(f_pago_prima)=$anio AND
								nramo IN ".$ramoIn." AND
								t_cuenta  IN ".$tipo_cuentaIn." 
								ORDER BY tipo_poliza ASC";
				}//7
				if ($cia!='' && $tipo_cuenta=='' && $ramo!='') {
					// create sql part for IN condition by imploding comma after each id
					$ciaIn = "('" . implode("','", $cia) ."')";

					// create sql part for IN condition by imploding comma after each id
					$ramoIn = "('" . implode("','", $ramo) ."')";

					$sql="SELECT DISTINCT tipo_poliza FROM poliza 
								INNER JOIN dcia, dramo, comision, tipo_poliza WHERE 
								poliza.id_cia=dcia.idcia AND
								poliza.id_cod_ramo=dramo.cod_ramo AND
								poliza.id_poliza = comision.id_poliza AND 
								poliza.id_tpoliza = tipo_poliza.id_t_poliza AND
								YEAR(f_pago_prima)=$anio AND
								nomcia IN ".$ciaIn." AND
								nramo IN ".$ramoIn."  
								ORDER BY tipo_poliza ASC";
				}//8

				$res=mysqli_query(Conectar::con(),$sql);
					  
				if (!$res) {
					//No hay registros
				}else{
					$filas=mysqli_num_rows($res); 
					if ($filas == 0) { 
						header("Location: busqueda_tipo_poliza.php?m=2#nombre");
						//exit();
					}else{
						while($reg=mysqli_fetch_assoc($res)) {
							 $this->t[]=$reg;
						}
						return $this->t;
						}
					}
			}

		public function get_distinct_tipo_poliza_prima_c_by_user($anio,$ramo,$cia,$tipo_cuenta,$asesor)
			{
				if ($cia!='' && $tipo_cuenta!='' && $ramo!='') {
					// create sql part for IN condition by imploding comma after each id
					$ciaIn = "('" . implode("','", $cia) ."')";

					// create sql part for IN condition by imploding comma after each id
					$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";

					// create sql part for IN condition by imploding comma after each id
					$ramoIn = "('" . implode("','", $ramo) ."')";

					$sql="SELECT DISTINCT tipo_poliza FROM poliza 
								INNER JOIN dcia, dramo, comision, tipo_poliza WHERE 
								poliza.id_cia=dcia.idcia AND
								poliza.id_cod_ramo=dramo.cod_ramo AND
								poliza.id_poliza = comision.id_poliza AND 
								poliza.id_tpoliza = tipo_poliza.id_t_poliza AND
								poliza.codvend = '$asesor' AND
								YEAR(f_pago_prima)=$anio AND
								nomcia IN ".$ciaIn." AND
								nramo IN ".$ramoIn." AND
								t_cuenta  IN ".$tipo_cuentaIn." 
								ORDER BY tipo_poliza ASC";
				}//1
				if ($cia=='' && $tipo_cuenta=='' && $ramo=='') {
					$sql="SELECT DISTINCT tipo_poliza FROM poliza 
							INNER JOIN dcia, dramo, comision, tipo_poliza WHERE 
							poliza.id_cia=dcia.idcia AND
							poliza.id_cod_ramo=dramo.cod_ramo AND
							poliza.id_poliza = comision.id_poliza AND 
							poliza.id_tpoliza = tipo_poliza.id_t_poliza AND
							poliza.codvend = '$asesor' AND
							YEAR(f_pago_prima)=$anio 
							ORDER BY tipo_poliza ASC";
				}//2
				if ($cia!='' && $tipo_cuenta=='' && $ramo=='') {

					// create sql part for IN condition by imploding comma after each id
					$ciaIn = "('" . implode("','", $cia) ."')";

					$sql="SELECT DISTINCT tipo_poliza FROM poliza 
							INNER JOIN dcia, dramo, comision, tipo_poliza WHERE 
							poliza.id_cia=dcia.idcia AND
							poliza.id_cod_ramo=dramo.cod_ramo AND
							poliza.id_poliza = comision.id_poliza AND 
							poliza.id_tpoliza = tipo_poliza.id_t_poliza AND
							poliza.codvend = '$asesor' AND
							YEAR(f_pago_prima)=$anio AND
							nomcia IN ".$ciaIn." 
							ORDER BY tipo_poliza ASC";
				}//3
				if ($cia=='' && $tipo_cuenta!='' && $ramo=='') {

					// create sql part for IN condition by imploding comma after each id
					$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";

					$sql="SELECT DISTINCT tipo_poliza FROM poliza 
							INNER JOIN dcia, dramo, comision, tipo_poliza WHERE 
							poliza.id_cia=dcia.idcia AND
							poliza.id_cod_ramo=dramo.cod_ramo AND
							poliza.id_poliza = comision.id_poliza AND 
							poliza.id_tpoliza = tipo_poliza.id_t_poliza AND
							poliza.codvend = '$asesor' AND
							YEAR(f_pago_prima)=$anio AND
							t_cuenta  IN ".$tipo_cuentaIn." 
							ORDER BY tipo_poliza ASC";
				}//4
				if ($cia=='' && $tipo_cuenta=='' && $ramo!='') {

					// create sql part for IN condition by imploding comma after each id
					$ramoIn = "('" . implode("','", $ramo) ."')";

					$sql="SELECT DISTINCT tipo_poliza FROM poliza 
							INNER JOIN dcia, dramo, comision, tipo_poliza WHERE 
							poliza.id_cia=dcia.idcia AND
							poliza.id_cod_ramo=dramo.cod_ramo AND
							poliza.id_poliza = comision.id_poliza AND 
							poliza.id_tpoliza = tipo_poliza.id_t_poliza AND
							poliza.codvend = '$asesor' AND
							YEAR(f_pago_prima)=$anio AND
							nramo IN ".$ramoIn."  
							ORDER BY tipo_poliza ASC";
				}//5
				if ($cia!='' && $tipo_cuenta!='' && $ramo=='') {
					// create sql part for IN condition by imploding comma after each id
					$ciaIn = "('" . implode("','", $cia) ."')";

					// create sql part for IN condition by imploding comma after each id
					$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";

					$sql="SELECT DISTINCT tipo_poliza FROM poliza 
								INNER JOIN dcia, dramo, comision, tipo_poliza WHERE 
								poliza.id_cia=dcia.idcia AND
								poliza.id_cod_ramo=dramo.cod_ramo AND
								poliza.id_poliza = comision.id_poliza AND 
								poliza.id_tpoliza = tipo_poliza.id_t_poliza AND
								poliza.codvend = '$asesor' AND
								YEAR(f_pago_prima)=$anio AND
								nomcia IN ".$ciaIn." AND
								t_cuenta  IN ".$tipo_cuentaIn." 
								ORDER BY tipo_poliza ASC";
				}//6
				if ($cia=='' && $tipo_cuenta!='' && $ramo!='') {
					// create sql part for IN condition by imploding comma after each id
					$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";

					// create sql part for IN condition by imploding comma after each id
					$ramoIn = "('" . implode("','", $ramo) ."')";

					$sql="SELECT DISTINCT tipo_poliza FROM poliza 
								INNER JOIN dcia, dramo, comision, tipo_poliza WHERE 
								poliza.id_cia=dcia.idcia AND
								poliza.id_cod_ramo=dramo.cod_ramo AND
								poliza.id_poliza = comision.id_poliza AND 
								poliza.id_tpoliza = tipo_poliza.id_t_poliza AND
								poliza.codvend = '$asesor' AND
								YEAR(f_pago_prima)=$anio AND
								nramo IN ".$ramoIn." AND
								t_cuenta  IN ".$tipo_cuentaIn." 
								ORDER BY tipo_poliza ASC";
				}//7
				if ($cia!='' && $tipo_cuenta=='' && $ramo!='') {
					// create sql part for IN condition by imploding comma after each id
					$ciaIn = "('" . implode("','", $cia) ."')";

					// create sql part for IN condition by imploding comma after each id
					$ramoIn = "('" . implode("','", $ramo) ."')";

					$sql="SELECT DISTINCT tipo_poliza FROM poliza 
								INNER JOIN dcia, dramo, comision, tipo_poliza WHERE 
								poliza.id_cia=dcia.idcia AND
								poliza.id_cod_ramo=dramo.cod_ramo AND
								poliza.id_poliza = comision.id_poliza AND 
								poliza.id_tpoliza = tipo_poliza.id_t_poliza AND
								poliza.codvend = '$asesor' AND
								YEAR(f_pago_prima)=$anio AND
								nomcia IN ".$ciaIn." AND
								nramo IN ".$ramoIn."  
								ORDER BY tipo_poliza ASC";
				}//8

				$res=mysqli_query(Conectar::con(),$sql);
					  
				if (!$res) {
					//No hay registros
				}else{
					$filas=mysqli_num_rows($res); 
					if ($filas == 0) { 
						header("Location: busqueda_tipo_poliza.php?m=2#nombre");
						//exit();
					}else{
						while($reg=mysqli_fetch_assoc($res)) {
							 $this->t[]=$reg;
						}
						return $this->t;
						}
					}
			}

		
		public function get_distinct_f_pago_prima_c($anio,$ramo,$cia,$tipo_cuenta)
			{
				if ($cia!='' && $tipo_cuenta!='' && $ramo!='') {
					// create sql part for IN condition by imploding comma after each id
					$ciaIn = "('" . implode("','", $cia) ."')";

					// create sql part for IN condition by imploding comma after each id
					$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";

					// create sql part for IN condition by imploding comma after each id
					$ramoIn = "('" . implode("','", $ramo) ."')";

					$sql="SELECT DISTINCT fpago FROM poliza 
								INNER JOIN dcia, dramo, comision, drecibo WHERE 
								poliza.id_cia=dcia.idcia AND
								poliza.id_cod_ramo=dramo.cod_ramo AND
								poliza.id_poliza = comision.id_poliza AND 
								poliza.id_poliza = drecibo.idrecibo AND
								YEAR(f_pago_prima)=$anio AND
								nomcia IN ".$ciaIn." AND
								nramo IN ".$ramoIn." AND
								t_cuenta  IN ".$tipo_cuentaIn." 
								ORDER BY fpago ASC";
				}//1
				if ($cia=='' && $tipo_cuenta=='' && $ramo=='') {
					$sql="SELECT DISTINCT fpago FROM poliza 
							INNER JOIN dcia, dramo, comision, drecibo WHERE 
							poliza.id_cia=dcia.idcia AND
							poliza.id_cod_ramo=dramo.cod_ramo AND
							poliza.id_poliza = comision.id_poliza AND 
							poliza.id_poliza = drecibo.idrecibo AND
							YEAR(f_pago_prima)=$anio 
							ORDER BY fpago ASC";
				}//2
				if ($cia!='' && $tipo_cuenta=='' && $ramo=='') {

					// create sql part for IN condition by imploding comma after each id
					$ciaIn = "('" . implode("','", $cia) ."')";

					$sql="SELECT DISTINCT fpago FROM poliza 
							INNER JOIN dcia, dramo, comision, drecibo WHERE 
							poliza.id_cia=dcia.idcia AND
							poliza.id_cod_ramo=dramo.cod_ramo AND
							poliza.id_poliza = comision.id_poliza AND 
							poliza.id_poliza = drecibo.idrecibo AND
							YEAR(f_pago_prima)=$anio AND
							nomcia IN ".$ciaIn." 
							ORDER BY fpago ASC";
				}//3
				if ($cia=='' && $tipo_cuenta!='' && $ramo=='') {

					// create sql part for IN condition by imploding comma after each id
					$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";

					$sql="SELECT DISTINCT fpago FROM poliza 
							INNER JOIN dcia, dramo, comision, drecibo WHERE 
							poliza.id_cia=dcia.idcia AND
							poliza.id_cod_ramo=dramo.cod_ramo AND
							poliza.id_poliza = comision.id_poliza AND 
							poliza.id_poliza = drecibo.idrecibo AND
							YEAR(f_pago_prima)=$anio AND
							t_cuenta  IN ".$tipo_cuentaIn." 
							ORDER BY fpago ASC";
				}//4
				if ($cia=='' && $tipo_cuenta=='' && $ramo!='') {

					// create sql part for IN condition by imploding comma after each id
					$ramoIn = "('" . implode("','", $ramo) ."')";

					$sql="SELECT DISTINCT fpago FROM poliza 
							INNER JOIN dcia, dramo, comision, drecibo WHERE 
							poliza.id_cia=dcia.idcia AND
							poliza.id_cod_ramo=dramo.cod_ramo AND
							poliza.id_poliza = comision.id_poliza AND 
							poliza.id_poliza = drecibo.idrecibo AND
							YEAR(f_pago_prima)=$anio AND
							nramo IN ".$ramoIn."  
							ORDER BY fpago ASC";
				}//5
				if ($cia!='' && $tipo_cuenta!='' && $ramo=='') {
					// create sql part for IN condition by imploding comma after each id
					$ciaIn = "('" . implode("','", $cia) ."')";

					// create sql part for IN condition by imploding comma after each id
					$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";

					$sql="SELECT DISTINCT fpago FROM poliza 
								INNER JOIN dcia, dramo, comision, drecibo WHERE 
								poliza.id_cia=dcia.idcia AND
								poliza.id_cod_ramo=dramo.cod_ramo AND
								poliza.id_poliza = comision.id_poliza AND 
								poliza.id_poliza = drecibo.idrecibo AND
								YEAR(f_pago_prima)=$anio AND
								nomcia IN ".$ciaIn." AND
								t_cuenta  IN ".$tipo_cuentaIn." 
								ORDER BY fpago ASC";
				}//6
				if ($cia=='' && $tipo_cuenta!='' && $ramo!='') {
					// create sql part for IN condition by imploding comma after each id
					$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";

					// create sql part for IN condition by imploding comma after each id
					$ramoIn = "('" . implode("','", $ramo) ."')";

					$sql="SELECT DISTINCT fpago FROM poliza 
								INNER JOIN dcia, dramo, comision, drecibo WHERE 
								poliza.id_cia=dcia.idcia AND
								poliza.id_cod_ramo=dramo.cod_ramo AND
								poliza.id_poliza = comision.id_poliza AND 
								poliza.id_poliza = drecibo.idrecibo AND
								YEAR(f_pago_prima)=$anio AND
								nramo IN ".$ramoIn." AND
								t_cuenta  IN ".$tipo_cuentaIn."
								ORDER BY fpago ASC";
				}//7
				if ($cia!='' && $tipo_cuenta=='' && $ramo!='') {
					// create sql part for IN condition by imploding comma after each id
					$ciaIn = "('" . implode("','", $cia) ."')";

					// create sql part for IN condition by imploding comma after each id
					$ramoIn = "('" . implode("','", $ramo) ."')";

					$sql="SELECT DISTINCT fpago FROM poliza 
								INNER JOIN dcia, dramo, comision, drecibo WHERE 
								poliza.id_cia=dcia.idcia AND
								poliza.id_cod_ramo=dramo.cod_ramo AND
								poliza.id_poliza = comision.id_poliza AND 
								poliza.id_poliza = drecibo.idrecibo AND
								YEAR(f_pago_prima)=$anio AND
								nomcia IN ".$ciaIn." AND
								nramo IN ".$ramoIn."  
								ORDER BY fpago ASC";
				}//8

				$res=mysqli_query(Conectar::con(),$sql);
					  
				if (!$res) {
					//No hay registros
				}else{
					$filas=mysqli_num_rows($res); 
					if ($filas == 0) { 
						header("Location: busqueda_fpago.php?m=2#nombre");
						//exit();
					}else{
						while($reg=mysqli_fetch_assoc($res)) {
							 $this->t[]=$reg;
						}
						return $this->t;
						}
					}
			}

		public function get_distinct_f_pago_prima_c_by_user($anio,$ramo,$cia,$tipo_cuenta,$asesor)
			{
				if ($cia!='' && $tipo_cuenta!='' && $ramo!='') {
					// create sql part for IN condition by imploding comma after each id
					$ciaIn = "('" . implode("','", $cia) ."')";

					// create sql part for IN condition by imploding comma after each id
					$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";

					// create sql part for IN condition by imploding comma after each id
					$ramoIn = "('" . implode("','", $ramo) ."')";

					$sql="SELECT DISTINCT fpago FROM poliza 
								INNER JOIN dcia, dramo, comision, drecibo WHERE 
								poliza.id_cia=dcia.idcia AND
								poliza.id_cod_ramo=dramo.cod_ramo AND
								poliza.id_poliza = comision.id_poliza AND 
								poliza.id_poliza = drecibo.idrecibo AND
								poliza.codvend = '$asesor' AND
								YEAR(f_pago_prima)=$anio AND
								nomcia IN ".$ciaIn." AND
								nramo IN ".$ramoIn." AND
								t_cuenta  IN ".$tipo_cuentaIn." 
								ORDER BY fpago ASC";
				}//1
				if ($cia=='' && $tipo_cuenta=='' && $ramo=='') {
					$sql="SELECT DISTINCT fpago FROM poliza 
							INNER JOIN dcia, dramo, comision, drecibo WHERE 
							poliza.id_cia=dcia.idcia AND
							poliza.id_cod_ramo=dramo.cod_ramo AND
							poliza.id_poliza = comision.id_poliza AND 
							poliza.id_poliza = drecibo.idrecibo AND
							poliza.codvend = '$asesor' AND
							YEAR(f_pago_prima)=$anio 
							ORDER BY fpago ASC";
				}//2
				if ($cia!='' && $tipo_cuenta=='' && $ramo=='') {

					// create sql part for IN condition by imploding comma after each id
					$ciaIn = "('" . implode("','", $cia) ."')";

					$sql="SELECT DISTINCT fpago FROM poliza 
							INNER JOIN dcia, dramo, comision, drecibo WHERE 
							poliza.id_cia=dcia.idcia AND
							poliza.id_cod_ramo=dramo.cod_ramo AND
							poliza.id_poliza = comision.id_poliza AND 
							poliza.id_poliza = drecibo.idrecibo AND
							poliza.codvend = '$asesor' AND
							YEAR(f_pago_prima)=$anio AND
							nomcia IN ".$ciaIn." 
							ORDER BY fpago ASC";
				}//3
				if ($cia=='' && $tipo_cuenta!='' && $ramo=='') {

					// create sql part for IN condition by imploding comma after each id
					$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";

					$sql="SELECT DISTINCT fpago FROM poliza 
							INNER JOIN dcia, dramo, comision, drecibo WHERE 
							poliza.id_cia=dcia.idcia AND
							poliza.id_cod_ramo=dramo.cod_ramo AND
							poliza.id_poliza = comision.id_poliza AND 
							poliza.id_poliza = drecibo.idrecibo AND
							poliza.codvend = '$asesor' AND
							YEAR(f_pago_prima)=$anio AND
							t_cuenta  IN ".$tipo_cuentaIn." 
							ORDER BY fpago ASC";
				}//4
				if ($cia=='' && $tipo_cuenta=='' && $ramo!='') {

					// create sql part for IN condition by imploding comma after each id
					$ramoIn = "('" . implode("','", $ramo) ."')";

					$sql="SELECT DISTINCT fpago FROM poliza 
							INNER JOIN dcia, dramo, comision, drecibo WHERE 
							poliza.id_cia=dcia.idcia AND
							poliza.id_cod_ramo=dramo.cod_ramo AND
							poliza.id_poliza = comision.id_poliza AND 
							poliza.id_poliza = drecibo.idrecibo AND
							poliza.codvend = '$asesor' AND
							YEAR(f_pago_prima)=$anio AND
							nramo IN ".$ramoIn."  
							ORDER BY fpago ASC";
				}//5
				if ($cia!='' && $tipo_cuenta!='' && $ramo=='') {
					// create sql part for IN condition by imploding comma after each id
					$ciaIn = "('" . implode("','", $cia) ."')";

					// create sql part for IN condition by imploding comma after each id
					$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";

					$sql="SELECT DISTINCT fpago FROM poliza 
								INNER JOIN dcia, dramo, comision, drecibo WHERE 
								poliza.id_cia=dcia.idcia AND
								poliza.id_cod_ramo=dramo.cod_ramo AND
								poliza.id_poliza = comision.id_poliza AND 
								poliza.id_poliza = drecibo.idrecibo AND
								poliza.codvend = '$asesor' AND
								YEAR(f_pago_prima)=$anio AND
								nomcia IN ".$ciaIn." AND
								t_cuenta  IN ".$tipo_cuentaIn." 
								ORDER BY fpago ASC";
				}//6
				if ($cia=='' && $tipo_cuenta!='' && $ramo!='') {
					// create sql part for IN condition by imploding comma after each id
					$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";

					// create sql part for IN condition by imploding comma after each id
					$ramoIn = "('" . implode("','", $ramo) ."')";

					$sql="SELECT DISTINCT fpago FROM poliza 
								INNER JOIN dcia, dramo, comision, drecibo WHERE 
								poliza.id_cia=dcia.idcia AND
								poliza.id_cod_ramo=dramo.cod_ramo AND
								poliza.id_poliza = comision.id_poliza AND 
								poliza.id_poliza = drecibo.idrecibo AND
								poliza.codvend = '$asesor' AND
								YEAR(f_pago_prima)=$anio AND
								nramo IN ".$ramoIn." AND
								t_cuenta  IN ".$tipo_cuentaIn."
								ORDER BY fpago ASC";
				}//7
				if ($cia!='' && $tipo_cuenta=='' && $ramo!='') {
					// create sql part for IN condition by imploding comma after each id
					$ciaIn = "('" . implode("','", $cia) ."')";

					// create sql part for IN condition by imploding comma after each id
					$ramoIn = "('" . implode("','", $ramo) ."')";

					$sql="SELECT DISTINCT fpago FROM poliza 
								INNER JOIN dcia, dramo, comision, drecibo WHERE 
								poliza.id_cia=dcia.idcia AND
								poliza.id_cod_ramo=dramo.cod_ramo AND
								poliza.id_poliza = comision.id_poliza AND 
								poliza.id_poliza = drecibo.idrecibo AND
								poliza.codvend = '$asesor' AND
								YEAR(f_pago_prima)=$anio AND
								nomcia IN ".$ciaIn." AND
								nramo IN ".$ramoIn."  
								ORDER BY fpago ASC";
				}//8

				$res=mysqli_query(Conectar::con(),$sql);
					  
				if (!$res) {
					//No hay registros
				}else{
					$filas=mysqli_num_rows($res); 
					if ($filas == 0) { 
						header("Location: busqueda_fpago.php?m=2#nombre");
						//exit();
					}else{
						while($reg=mysqli_fetch_assoc($res)) {
							 $this->t[]=$reg;
						}
						return $this->t;
						}
					}
			}

		public function get_distinct_ejecutivo_prima_c($anio,$ramo,$cia,$tipo_cuenta)
			{
				
				if ($cia!='' && $tipo_cuenta!='' && $ramo!='') {
					// create sql part for IN condition by imploding comma after each id
					$ciaIn = "('" . implode("','", $cia) ."')";

					// create sql part for IN condition by imploding comma after each id
					$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";

					// create sql part for IN condition by imploding comma after each id
					$ramoIn = "('" . implode("','", $ramo) ."')";

					$sql="SELECT DISTINCT comision.cod_vend FROM poliza 
								INNER JOIN dcia, dramo, comision, drecibo WHERE 
								poliza.id_cia=dcia.idcia AND
								poliza.id_cod_ramo=dramo.cod_ramo AND
								poliza.id_poliza = comision.id_poliza AND 
								poliza.id_poliza = drecibo.idrecibo AND
								YEAR(f_pago_prima)=$anio AND
								nomcia IN ".$ciaIn." AND
								nramo IN ".$ramoIn." AND
								t_cuenta  IN ".$tipo_cuentaIn." 
								ORDER BY comision.cod_vend ASC";
				}//1
				if ($cia=='' && $tipo_cuenta=='' && $ramo=='') {
					$sql="SELECT DISTINCT comision.cod_vend FROM poliza 
							INNER JOIN dcia, dramo, comision, drecibo WHERE 
							poliza.id_cia=dcia.idcia AND
							poliza.id_cod_ramo=dramo.cod_ramo AND
							poliza.id_poliza = comision.id_poliza AND 
							poliza.id_poliza = drecibo.idrecibo AND
							YEAR(f_pago_prima)=$anio  
							ORDER BY comision.cod_vend ASC";
				}//2
				if ($cia!='' && $tipo_cuenta=='' && $ramo=='') {

					// create sql part for IN condition by imploding comma after each id
					$ciaIn = "('" . implode("','", $cia) ."')";

					$sql="SELECT DISTINCT comision.cod_vend FROM poliza 
							INNER JOIN dcia, dramo, comision, drecibo WHERE 
							poliza.id_cia=dcia.idcia AND
							poliza.id_cod_ramo=dramo.cod_ramo AND
							poliza.id_poliza = comision.id_poliza AND 
							poliza.id_poliza = drecibo.idrecibo AND
							YEAR(f_pago_prima)=$anio AND
							nomcia IN ".$ciaIn." 
							ORDER BY comision.cod_vend ASC";
				}//3
				if ($cia=='' && $tipo_cuenta!='' && $ramo=='') {

					// create sql part for IN condition by imploding comma after each id
					$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";

					$sql="SELECT DISTINCT comision.cod_vend FROM poliza 
							INNER JOIN dcia, dramo, comision, drecibo WHERE 
							poliza.id_cia=dcia.idcia AND
							poliza.id_cod_ramo=dramo.cod_ramo AND
							poliza.id_poliza = comision.id_poliza AND 
							poliza.id_poliza = drecibo.idrecibo AND
							YEAR(f_pago_prima)=$anio AND
							t_cuenta  IN ".$tipo_cuentaIn."
							ORDER BY comision.cod_vend ASC ";
				}//4
				if ($cia=='' && $tipo_cuenta=='' && $ramo!='') {

					// create sql part for IN condition by imploding comma after each id
					$ramoIn = "('" . implode("','", $ramo) ."')";

					$sql="SELECT DISTINCT comision.cod_vend FROM poliza 
							INNER JOIN dcia, dramo, comision, drecibo WHERE 
							poliza.id_cia=dcia.idcia AND
							poliza.id_cod_ramo=dramo.cod_ramo AND
							poliza.id_poliza = comision.id_poliza AND 
							poliza.id_poliza = drecibo.idrecibo AND
							YEAR(f_pago_prima)=$anio AND
							nramo IN ".$ramoIn." 
							ORDER BY comision.cod_vend ASC ";
				}//5
				if ($cia!='' && $tipo_cuenta!='' && $ramo=='') {
					// create sql part for IN condition by imploding comma after each id
					$ciaIn = "('" . implode("','", $cia) ."')";

					// create sql part for IN condition by imploding comma after each id
					$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";

					$sql="SELECT DISTINCT comision.cod_vend FROM poliza 
								INNER JOIN dcia, dramo, comision, drecibo WHERE 
								poliza.id_cia=dcia.idcia AND
								poliza.id_cod_ramo=dramo.cod_ramo AND
								poliza.id_poliza = comision.id_poliza AND 
								poliza.id_poliza = drecibo.idrecibo AND
								YEAR(f_pago_prima)=$anio AND
								nomcia IN ".$ciaIn." AND
								t_cuenta  IN ".$tipo_cuentaIn."
								ORDER BY comision.cod_vend ASC ";
				}//6
				if ($cia=='' && $tipo_cuenta!='' && $ramo!='') {
					// create sql part for IN condition by imploding comma after each id
					$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";

					// create sql part for IN condition by imploding comma after each id
					$ramoIn = "('" . implode("','", $ramo) ."')";

					$sql="SELECT DISTINCT comision.cod_vend FROM poliza 
								INNER JOIN dcia, dramo, comision, drecibo WHERE 
								poliza.id_cia=dcia.idcia AND
								poliza.id_cod_ramo=dramo.cod_ramo AND
								poliza.id_poliza = comision.id_poliza AND 
								poliza.id_poliza = drecibo.idrecibo AND
								YEAR(f_pago_prima)=$anio AND
								nramo IN ".$ramoIn." AND
								t_cuenta  IN ".$tipo_cuentaIn."
								ORDER BY comision.cod_vend ASC ";
				}//7
				if ($cia!='' && $tipo_cuenta=='' && $ramo!='') {
					// create sql part for IN condition by imploding comma after each id
					$ciaIn = "('" . implode("','", $cia) ."')";

					// create sql part for IN condition by imploding comma after each id
					$ramoIn = "('" . implode("','", $ramo) ."')";

					$sql="SELECT DISTINCT comision.cod_vend FROM poliza 
								INNER JOIN dcia, dramo, comision, drecibo WHERE 
								poliza.id_cia=dcia.idcia AND
								poliza.id_cod_ramo=dramo.cod_ramo AND
								poliza.id_poliza = comision.id_poliza AND 
								poliza.id_poliza = drecibo.idrecibo AND
								YEAR(f_pago_prima)=$anio AND
								nomcia IN ".$ciaIn." AND
								nramo IN ".$ramoIn."  
								ORDER BY comision.cod_vend ASC";
				}//8

				$res=mysqli_query(Conectar::con(),$sql);
					  
				if (!$res) {
					//No hay registros
				}else{
					$filas=mysqli_num_rows($res); 
					if ($filas == 0) { 
						header("Location: busqueda_ejecutivo.php?m=2#nombre");
						//exit();
					}else{
						while($reg=mysqli_fetch_assoc($res)) {
							 $this->t[]=$reg;
						}
						return $this->t;
						}
					}
			}


		public function get_count_poliza_c_cobrada_ramo($ramo,$cia,$anio,$tipo_cuenta)
			{
			if ($cia!='' && $tipo_cuenta!='') {
				// create sql part for IN condition by imploding comma after each id
				$ciaIn = "('" . implode("','", $cia) ."')";

				// create sql part for IN condition by imploding comma after each id
				$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";

				$sql="SELECT count(DISTINCT comision.id_poliza) FROM poliza 
						INNER JOIN dcia, drecibo, dramo, comision WHERE 
						poliza.id_cia=dcia.idcia AND
						poliza.id_poliza=drecibo.idrecibo AND 
						poliza.id_cod_ramo=dramo.cod_ramo AND
						poliza.id_poliza = comision.id_poliza AND 
						YEAR(f_pago_prima)=$anio AND
						nomcia IN ".$ciaIn." AND
						t_cuenta  IN ".$tipo_cuentaIn." AND
						nramo = '$ramo'";
			}
			if ($cia=='' && $tipo_cuenta=='') {
				$sql="SELECT count(DISTINCT comision.id_poliza) FROM poliza 
						INNER JOIN dcia, drecibo, dramo, comision WHERE 
						poliza.id_cia=dcia.idcia AND
						poliza.id_poliza=drecibo.idrecibo AND 
						poliza.id_cod_ramo=dramo.cod_ramo AND
						poliza.id_poliza = comision.id_poliza AND 
						YEAR(f_pago_prima)=$anio AND
						nramo = '$ramo'";
			}
			if ($cia=='' && $tipo_cuenta!='') {

				// create sql part for IN condition by imploding comma after each id
				$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";

				$sql="SELECT count(DISTINCT comision.id_poliza) FROM poliza 
						INNER JOIN dcia, drecibo, dramo, comision WHERE 
						poliza.id_cia=dcia.idcia AND
						poliza.id_poliza=drecibo.idrecibo AND 
						poliza.id_cod_ramo=dramo.cod_ramo AND
						poliza.id_poliza = comision.id_poliza AND 
						YEAR(f_pago_prima)=$anio AND
						t_cuenta  IN ".$tipo_cuentaIn." AND
						nramo = '$ramo'";
			}
			if ($tipo_cuenta=='' && $cia!='') {

				// create sql part for IN condition by imploding comma after each id
				$ciaIn = "('" . implode("','", $cia) ."')";

				$sql="SELECT count(DISTINCT comision.id_poliza) FROM poliza 
						INNER JOIN dcia, drecibo, dramo, comision WHERE 
						poliza.id_cia=dcia.idcia AND
						poliza.id_poliza=drecibo.idrecibo AND 
						poliza.id_cod_ramo=dramo.cod_ramo AND
						poliza.id_poliza = comision.id_poliza AND 
						YEAR(f_pago_prima)=$anio AND
						nomcia IN ".$ciaIn." AND
						nramo = '$ramo'";
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

		public function get_count_poliza_c_cobrada_ramo_by_user($ramo,$cia,$anio,$tipo_cuenta,$asesor)
			{
			if ($cia!='' && $tipo_cuenta!='') {
				// create sql part for IN condition by imploding comma after each id
				$ciaIn = "('" . implode("','", $cia) ."')";

				// create sql part for IN condition by imploding comma after each id
				$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";

				$sql="SELECT count(DISTINCT comision.id_poliza) FROM poliza 
						INNER JOIN dcia, drecibo, dramo, comision WHERE 
						poliza.id_cia=dcia.idcia AND
						poliza.id_poliza=drecibo.idrecibo AND 
						poliza.id_cod_ramo=dramo.cod_ramo AND
						poliza.id_poliza = comision.id_poliza AND 
						poliza.codvend = '$asesor' AND
						YEAR(f_pago_prima)=$anio AND
						nomcia IN ".$ciaIn." AND
						t_cuenta  IN ".$tipo_cuentaIn." AND
						nramo = '$ramo'";
			}
			if ($cia=='' && $tipo_cuenta=='') {
				$sql="SELECT count(DISTINCT comision.id_poliza) FROM poliza 
						INNER JOIN dcia, drecibo, dramo, comision WHERE 
						poliza.id_cia=dcia.idcia AND
						poliza.id_poliza=drecibo.idrecibo AND 
						poliza.id_cod_ramo=dramo.cod_ramo AND
						poliza.id_poliza = comision.id_poliza AND 
						poliza.codvend = '$asesor' AND
						YEAR(f_pago_prima)=$anio AND
						nramo = '$ramo'";
			}
			if ($cia=='' && $tipo_cuenta!='') {

				// create sql part for IN condition by imploding comma after each id
				$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";

				$sql="SELECT count(DISTINCT comision.id_poliza) FROM poliza 
						INNER JOIN dcia, drecibo, dramo, comision WHERE 
						poliza.id_cia=dcia.idcia AND
						poliza.id_poliza=drecibo.idrecibo AND 
						poliza.id_cod_ramo=dramo.cod_ramo AND
						poliza.id_poliza = comision.id_poliza AND 
						poliza.codvend = '$asesor' AND
						YEAR(f_pago_prima)=$anio AND
						t_cuenta  IN ".$tipo_cuentaIn." AND
						nramo = '$ramo'";
			}
			if ($tipo_cuenta=='' && $cia!='') {

				// create sql part for IN condition by imploding comma after each id
				$ciaIn = "('" . implode("','", $cia) ."')";

				$sql="SELECT count(DISTINCT comision.id_poliza) FROM poliza 
						INNER JOIN dcia, drecibo, dramo, comision WHERE 
						poliza.id_cia=dcia.idcia AND
						poliza.id_poliza=drecibo.idrecibo AND 
						poliza.id_cod_ramo=dramo.cod_ramo AND
						poliza.id_poliza = comision.id_poliza AND 
						poliza.codvend = '$asesor' AND
						YEAR(f_pago_prima)=$anio AND
						nomcia IN ".$ciaIn." AND
						nramo = '$ramo'";
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

		public function get_count_poliza_c_cobrada_cia($ramo,$cia,$anio,$tipo_cuenta)
			{
			if ($ramo!='' && $tipo_cuenta!='') {
				// create sql part for IN condition by imploding comma after each id
				$ramoIn = "('" . implode("','", $ramo) ."')";

				// create sql part for IN condition by imploding comma after each id
				$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";

				$sql="SELECT count(DISTINCT comision.id_poliza) FROM poliza 
						INNER JOIN dcia, drecibo, dramo, comision WHERE 
						poliza.id_cia=dcia.idcia AND
						poliza.id_poliza=drecibo.idrecibo AND 
						poliza.id_cod_ramo=dramo.cod_ramo AND
						poliza.id_poliza = comision.id_poliza AND 
						YEAR(f_pago_prima)=$anio AND
						nramo IN ".$ramoIn." AND
						t_cuenta  IN ".$tipo_cuentaIn." AND
						nomcia = '$cia'";
			}
			if ($ramo=='' && $tipo_cuenta=='') {
				$sql="SELECT count(DISTINCT comision.id_poliza) FROM poliza 
						INNER JOIN dcia, drecibo, dramo, comision WHERE 
						poliza.id_cia=dcia.idcia AND
						poliza.id_poliza=drecibo.idrecibo AND 
						poliza.id_cod_ramo=dramo.cod_ramo AND
						poliza.id_poliza = comision.id_poliza AND 
						YEAR(f_pago_prima)=$anio AND
						nomcia = '$cia'";
			}
			if ($ramo=='' && $tipo_cuenta!='') {

				// create sql part for IN condition by imploding comma after each id
				$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";

				$sql="SELECT count(DISTINCT comision.id_poliza) FROM poliza 
						INNER JOIN dcia, drecibo, dramo, comision WHERE 
						poliza.id_cia=dcia.idcia AND
						poliza.id_poliza=drecibo.idrecibo AND 
						poliza.id_cod_ramo=dramo.cod_ramo AND
						poliza.id_poliza = comision.id_poliza AND 
						YEAR(f_pago_prima)=$anio AND
						t_cuenta  IN ".$tipo_cuentaIn." AND
						nomcia = '$cia'";
			}
			if ($tipo_cuenta=='' && $ramo!='') {

				// create sql part for IN condition by imploding comma after each id
				$ramoIn = "('" . implode("','", $ramo) ."')";

				$sql="SELECT count(DISTINCT comision.id_poliza) FROM poliza 
						INNER JOIN dcia, drecibo, dramo, comision WHERE 
						poliza.id_cia=dcia.idcia AND
						poliza.id_poliza=drecibo.idrecibo AND 
						poliza.id_cod_ramo=dramo.cod_ramo AND
						poliza.id_poliza = comision.id_poliza AND 
						YEAR(f_pago_prima)=$anio AND
						nramo IN ".$ramoIn." AND
						nomcia = '$cia'";
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

		public function get_count_poliza_c_cobrada_cia_by_user($ramo,$cia,$anio,$tipo_cuenta,$asesor)
			{
			if ($ramo!='' && $tipo_cuenta!='') {
				// create sql part for IN condition by imploding comma after each id
				$ramoIn = "('" . implode("','", $ramo) ."')";

				// create sql part for IN condition by imploding comma after each id
				$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";

				$sql="SELECT count(DISTINCT comision.id_poliza) FROM poliza 
						INNER JOIN dcia, drecibo, dramo, comision WHERE 
						poliza.id_cia=dcia.idcia AND
						poliza.id_poliza=drecibo.idrecibo AND 
						poliza.id_cod_ramo=dramo.cod_ramo AND
						poliza.id_poliza = comision.id_poliza AND 
						poliza.codvend = '$asesor' AND
						YEAR(f_pago_prima)=$anio AND
						nramo IN ".$ramoIn." AND
						t_cuenta  IN ".$tipo_cuentaIn." AND
						nomcia = '$cia'";
			}
			if ($ramo=='' && $tipo_cuenta=='') {
				$sql="SELECT count(DISTINCT comision.id_poliza) FROM poliza 
						INNER JOIN dcia, drecibo, dramo, comision WHERE 
						poliza.id_cia=dcia.idcia AND
						poliza.id_poliza=drecibo.idrecibo AND 
						poliza.id_cod_ramo=dramo.cod_ramo AND
						poliza.id_poliza = comision.id_poliza AND 
						poliza.codvend = '$asesor' AND
						YEAR(f_pago_prima)=$anio AND
						nomcia = '$cia'";
			}
			if ($ramo=='' && $tipo_cuenta!='') {

				// create sql part for IN condition by imploding comma after each id
				$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";

				$sql="SELECT count(DISTINCT comision.id_poliza) FROM poliza 
						INNER JOIN dcia, drecibo, dramo, comision WHERE 
						poliza.id_cia=dcia.idcia AND
						poliza.id_poliza=drecibo.idrecibo AND 
						poliza.id_cod_ramo=dramo.cod_ramo AND
						poliza.id_poliza = comision.id_poliza AND 
						poliza.codvend = '$asesor' AND
						YEAR(f_pago_prima)=$anio AND
						t_cuenta  IN ".$tipo_cuentaIn." AND
						nomcia = '$cia'";
			}
			if ($tipo_cuenta=='' && $ramo!='') {

				// create sql part for IN condition by imploding comma after each id
				$ramoIn = "('" . implode("','", $ramo) ."')";

				$sql="SELECT count(DISTINCT comision.id_poliza) FROM poliza 
						INNER JOIN dcia, drecibo, dramo, comision WHERE 
						poliza.id_cia=dcia.idcia AND
						poliza.id_poliza=drecibo.idrecibo AND 
						poliza.id_cod_ramo=dramo.cod_ramo AND
						poliza.id_poliza = comision.id_poliza AND 
						poliza.codvend = '$asesor' AND
						YEAR(f_pago_prima)=$anio AND
						nramo IN ".$ramoIn." AND
						nomcia = '$cia'";
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


		public function get_count_poliza_c_cobrada_tpoliza($ramo,$cia,$anio,$tipo_cuenta,$t_poliza)
			{
			
			if ($cia!='' && $tipo_cuenta!='' && $ramo!='') {
				// create sql part for IN condition by imploding comma after each id
				$ciaIn = "('" . implode("','", $cia) ."')";
	
				// create sql part for IN condition by imploding comma after each id
				$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";
	
				// create sql part for IN condition by imploding comma after each id
				$ramoIn = "('" . implode("','", $ramo) ."')";
	
				$sql="SELECT count(DISTINCT comision.id_poliza) FROM poliza 
						INNER JOIN dcia, drecibo, dramo, comision, tipo_poliza WHERE 
						poliza.id_cia=dcia.idcia AND
						poliza.id_poliza=drecibo.idrecibo AND 
						poliza.id_cod_ramo=dramo.cod_ramo AND
						poliza.id_poliza = comision.id_poliza AND 
						poliza.id_tpoliza = tipo_poliza.id_t_poliza AND
						YEAR(f_pago_prima)=$anio AND
						tipo_poliza.tipo_poliza='$t_poliza' AND
						nramo IN ".$ramoIn." AND
						t_cuenta  IN ".$tipo_cuentaIn." AND
						nomcia IN ".$ciaIn." ";
			}//1
			if ($cia=='' && $tipo_cuenta=='' && $ramo=='') {
				$sql="SELECT count(DISTINCT comision.id_poliza) FROM poliza 
						INNER JOIN dcia, drecibo, dramo, comision, tipo_poliza WHERE 
						poliza.id_cia=dcia.idcia AND
						poliza.id_poliza=drecibo.idrecibo AND 
						poliza.id_cod_ramo=dramo.cod_ramo AND
						poliza.id_poliza = comision.id_poliza AND 
						poliza.id_tpoliza = tipo_poliza.id_t_poliza AND
						YEAR(f_pago_prima)=$anio AND
						tipo_poliza.tipo_poliza='$t_poliza' ";
			}//2
			if ($cia!='' && $tipo_cuenta=='' && $ramo=='') {
	
				// create sql part for IN condition by imploding comma after each id
				$ciaIn = "('" . implode("','", $cia) ."')";
	
				$sql="SELECT count(DISTINCT comision.id_poliza) FROM poliza 
						INNER JOIN dcia, drecibo, dramo, comision, tipo_poliza WHERE 
						poliza.id_cia=dcia.idcia AND
						poliza.id_poliza=drecibo.idrecibo AND 
						poliza.id_cod_ramo=dramo.cod_ramo AND
						poliza.id_poliza = comision.id_poliza AND 
						poliza.id_tpoliza = tipo_poliza.id_t_poliza AND
						YEAR(f_pago_prima)=$anio AND
						tipo_poliza.tipo_poliza='$t_poliza' AND
						nomcia IN ".$ciaIn."";
			}//3
			if ($cia=='' && $tipo_cuenta!='' && $ramo=='') {
	
				// create sql part for IN condition by imploding comma after each id
				$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";
	
				$sql="SELECT count(DISTINCT comision.id_poliza) FROM poliza 
						INNER JOIN dcia, drecibo, dramo, comision, tipo_poliza WHERE 
						poliza.id_cia=dcia.idcia AND
						poliza.id_poliza=drecibo.idrecibo AND 
						poliza.id_cod_ramo=dramo.cod_ramo AND
						poliza.id_poliza = comision.id_poliza AND 
						poliza.id_tpoliza = tipo_poliza.id_t_poliza AND
						YEAR(f_pago_prima)=$anio AND
						tipo_poliza.tipo_poliza='$t_poliza' AND
						t_cuenta  IN ".$tipo_cuentaIn."  ";
			}//4
			if ($cia=='' && $tipo_cuenta=='' && $ramo!='') {
	
				// create sql part for IN condition by imploding comma after each id
				$ramoIn = "('" . implode("','", $ramo) ."')";
	
				$sql="SELECT count(DISTINCT comision.id_poliza) FROM poliza 
						INNER JOIN dcia, drecibo, dramo, comision, tipo_poliza WHERE 
						poliza.id_cia=dcia.idcia AND
						poliza.id_poliza=drecibo.idrecibo AND 
						poliza.id_cod_ramo=dramo.cod_ramo AND
						poliza.id_poliza = comision.id_poliza AND 
						poliza.id_tpoliza = tipo_poliza.id_t_poliza AND
						YEAR(f_pago_prima)=$anio AND
						tipo_poliza.tipo_poliza='$t_poliza' AND
						nramo IN ".$ramoIn." ";
			}//5
			if ($cia!='' && $tipo_cuenta!='' && $ramo=='') {
				// create sql part for IN condition by imploding comma after each id
				$ciaIn = "('" . implode("','", $cia) ."')";
	
				// create sql part for IN condition by imploding comma after each id
				$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";
	
				$sql="SELECT count(DISTINCT comision.id_poliza) FROM poliza 
						INNER JOIN dcia, drecibo, dramo, comision, tipo_poliza WHERE 
						poliza.id_cia=dcia.idcia AND
						poliza.id_poliza=drecibo.idrecibo AND 
						poliza.id_cod_ramo=dramo.cod_ramo AND
						poliza.id_poliza = comision.id_poliza AND 
						poliza.id_tpoliza = tipo_poliza.id_t_poliza AND
						YEAR(f_pago_prima)=$anio AND
						tipo_poliza.tipo_poliza='$t_poliza' AND
						t_cuenta  IN ".$tipo_cuentaIn." AND
						nomcia IN ".$ciaIn." ";
			}//6
			if ($cia=='' && $tipo_cuenta!='' && $ramo!='') {
				// create sql part for IN condition by imploding comma after each id
				$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";
	
				// create sql part for IN condition by imploding comma after each id
				$ramoIn = "('" . implode("','", $ramo) ."')";
	
				$sql="SELECT count(DISTINCT comision.id_poliza) FROM poliza 
						INNER JOIN dcia, drecibo, dramo, comision, tipo_poliza WHERE 
						poliza.id_cia=dcia.idcia AND
						poliza.id_poliza=drecibo.idrecibo AND 
						poliza.id_cod_ramo=dramo.cod_ramo AND
						poliza.id_poliza = comision.id_poliza AND 
						poliza.id_tpoliza = tipo_poliza.id_t_poliza AND
						YEAR(f_pago_prima)=$anio AND
						tipo_poliza.tipo_poliza='$t_poliza' AND
						nramo IN ".$ramoIn." AND
						t_cuenta  IN ".$tipo_cuentaIn." ";
			}//7
			if ($cia!='' && $tipo_cuenta=='' && $ramo!='') {
				// create sql part for IN condition by imploding comma after each id
				$ciaIn = "('" . implode("','", $cia) ."')";
	
				// create sql part for IN condition by imploding comma after each id
				$ramoIn = "('" . implode("','", $ramo) ."')";
	
				$sql="SELECT count(DISTINCT comision.id_poliza) FROM poliza 
						INNER JOIN dcia, drecibo, dramo, comision, tipo_poliza WHERE 
						poliza.id_cia=dcia.idcia AND
						poliza.id_poliza=drecibo.idrecibo AND 
						poliza.id_cod_ramo=dramo.cod_ramo AND
						poliza.id_poliza = comision.id_poliza AND 
						poliza.id_tpoliza = tipo_poliza.id_t_poliza AND
						YEAR(f_pago_prima)=$anio AND
						tipo_poliza.tipo_poliza='$t_poliza' AND
						nramo IN ".$ramoIn." AND
						nomcia IN ".$ciaIn." ";
			}//8
			
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

		public function get_count_poliza_c_cobrada_tpoliza_by_user($ramo,$cia,$anio,$tipo_cuenta,$t_poliza,$asesor)
			{
			
			if ($cia!='' && $tipo_cuenta!='' && $ramo!='') {
				// create sql part for IN condition by imploding comma after each id
				$ciaIn = "('" . implode("','", $cia) ."')";
	
				// create sql part for IN condition by imploding comma after each id
				$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";
	
				// create sql part for IN condition by imploding comma after each id
				$ramoIn = "('" . implode("','", $ramo) ."')";
	
				$sql="SELECT count(DISTINCT comision.id_poliza) FROM poliza 
						INNER JOIN dcia, drecibo, dramo, comision, tipo_poliza WHERE 
						poliza.id_cia=dcia.idcia AND
						poliza.id_poliza=drecibo.idrecibo AND 
						poliza.id_cod_ramo=dramo.cod_ramo AND
						poliza.id_poliza = comision.id_poliza AND 
						poliza.id_tpoliza = tipo_poliza.id_t_poliza AND
						poliza.codvend = '$asesor' AND
						YEAR(f_pago_prima)=$anio AND
						tipo_poliza.tipo_poliza='$t_poliza' AND
						nramo IN ".$ramoIn." AND
						t_cuenta  IN ".$tipo_cuentaIn." AND
						nomcia IN ".$ciaIn." ";
			}//1
			if ($cia=='' && $tipo_cuenta=='' && $ramo=='') {
				$sql="SELECT count(DISTINCT comision.id_poliza) FROM poliza 
						INNER JOIN dcia, drecibo, dramo, comision, tipo_poliza WHERE 
						poliza.id_cia=dcia.idcia AND
						poliza.id_poliza=drecibo.idrecibo AND 
						poliza.id_cod_ramo=dramo.cod_ramo AND
						poliza.id_poliza = comision.id_poliza AND 
						poliza.id_tpoliza = tipo_poliza.id_t_poliza AND
						poliza.codvend = '$asesor' AND
						YEAR(f_pago_prima)=$anio AND
						tipo_poliza.tipo_poliza='$t_poliza' ";
			}//2
			if ($cia!='' && $tipo_cuenta=='' && $ramo=='') {
	
				// create sql part for IN condition by imploding comma after each id
				$ciaIn = "('" . implode("','", $cia) ."')";
	
				$sql="SELECT count(DISTINCT comision.id_poliza) FROM poliza 
						INNER JOIN dcia, drecibo, dramo, comision, tipo_poliza WHERE 
						poliza.id_cia=dcia.idcia AND
						poliza.id_poliza=drecibo.idrecibo AND 
						poliza.id_cod_ramo=dramo.cod_ramo AND
						poliza.id_poliza = comision.id_poliza AND 
						poliza.id_tpoliza = tipo_poliza.id_t_poliza AND
						poliza.codvend = '$asesor' AND
						YEAR(f_pago_prima)=$anio AND
						tipo_poliza.tipo_poliza='$t_poliza' AND
						nomcia IN ".$ciaIn."";
			}//3
			if ($cia=='' && $tipo_cuenta!='' && $ramo=='') {
	
				// create sql part for IN condition by imploding comma after each id
				$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";
	
				$sql="SELECT count(DISTINCT comision.id_poliza) FROM poliza 
						INNER JOIN dcia, drecibo, dramo, comision, tipo_poliza WHERE 
						poliza.id_cia=dcia.idcia AND
						poliza.id_poliza=drecibo.idrecibo AND 
						poliza.id_cod_ramo=dramo.cod_ramo AND
						poliza.id_poliza = comision.id_poliza AND 
						poliza.id_tpoliza = tipo_poliza.id_t_poliza AND
						poliza.codvend = '$asesor' AND
						YEAR(f_pago_prima)=$anio AND
						tipo_poliza.tipo_poliza='$t_poliza' AND
						t_cuenta  IN ".$tipo_cuentaIn."  ";
			}//4
			if ($cia=='' && $tipo_cuenta=='' && $ramo!='') {
	
				// create sql part for IN condition by imploding comma after each id
				$ramoIn = "('" . implode("','", $ramo) ."')";
	
				$sql="SELECT count(DISTINCT comision.id_poliza) FROM poliza 
						INNER JOIN dcia, drecibo, dramo, comision, tipo_poliza WHERE 
						poliza.id_cia=dcia.idcia AND
						poliza.id_poliza=drecibo.idrecibo AND 
						poliza.id_cod_ramo=dramo.cod_ramo AND
						poliza.id_poliza = comision.id_poliza AND 
						poliza.id_tpoliza = tipo_poliza.id_t_poliza AND
						poliza.codvend = '$asesor' AND
						YEAR(f_pago_prima)=$anio AND
						tipo_poliza.tipo_poliza='$t_poliza' AND
						nramo IN ".$ramoIn." ";
			}//5
			if ($cia!='' && $tipo_cuenta!='' && $ramo=='') {
				// create sql part for IN condition by imploding comma after each id
				$ciaIn = "('" . implode("','", $cia) ."')";
	
				// create sql part for IN condition by imploding comma after each id
				$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";
	
				$sql="SELECT count(DISTINCT comision.id_poliza) FROM poliza 
						INNER JOIN dcia, drecibo, dramo, comision, tipo_poliza WHERE 
						poliza.id_cia=dcia.idcia AND
						poliza.id_poliza=drecibo.idrecibo AND 
						poliza.id_cod_ramo=dramo.cod_ramo AND
						poliza.id_poliza = comision.id_poliza AND 
						poliza.id_tpoliza = tipo_poliza.id_t_poliza AND
						poliza.codvend = '$asesor' AND
						YEAR(f_pago_prima)=$anio AND
						tipo_poliza.tipo_poliza='$t_poliza' AND
						t_cuenta  IN ".$tipo_cuentaIn." AND
						nomcia IN ".$ciaIn." ";
			}//6
			if ($cia=='' && $tipo_cuenta!='' && $ramo!='') {
				// create sql part for IN condition by imploding comma after each id
				$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";
	
				// create sql part for IN condition by imploding comma after each id
				$ramoIn = "('" . implode("','", $ramo) ."')";
	
				$sql="SELECT count(DISTINCT comision.id_poliza) FROM poliza 
						INNER JOIN dcia, drecibo, dramo, comision, tipo_poliza WHERE 
						poliza.id_cia=dcia.idcia AND
						poliza.id_poliza=drecibo.idrecibo AND 
						poliza.id_cod_ramo=dramo.cod_ramo AND
						poliza.id_poliza = comision.id_poliza AND 
						poliza.id_tpoliza = tipo_poliza.id_t_poliza AND
						poliza.codvend = '$asesor' AND
						YEAR(f_pago_prima)=$anio AND
						tipo_poliza.tipo_poliza='$t_poliza' AND
						nramo IN ".$ramoIn." AND
						t_cuenta  IN ".$tipo_cuentaIn." ";
			}//7
			if ($cia!='' && $tipo_cuenta=='' && $ramo!='') {
				// create sql part for IN condition by imploding comma after each id
				$ciaIn = "('" . implode("','", $cia) ."')";
	
				// create sql part for IN condition by imploding comma after each id
				$ramoIn = "('" . implode("','", $ramo) ."')";
	
				$sql="SELECT count(DISTINCT comision.id_poliza) FROM poliza 
						INNER JOIN dcia, drecibo, dramo, comision, tipo_poliza WHERE 
						poliza.id_cia=dcia.idcia AND
						poliza.id_poliza=drecibo.idrecibo AND 
						poliza.id_cod_ramo=dramo.cod_ramo AND
						poliza.id_poliza = comision.id_poliza AND 
						poliza.id_tpoliza = tipo_poliza.id_t_poliza AND
						poliza.codvend = '$asesor' AND
						YEAR(f_pago_prima)=$anio AND
						tipo_poliza.tipo_poliza='$t_poliza' AND
						nramo IN ".$ramoIn." AND
						nomcia IN ".$ciaIn." ";
			}//8
			
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

		public function get_count_poliza_c_cobrada_ejecutivo($ramo,$cia,$anio,$tipo_cuenta,$ejecutivo)
			{
			
			if ($cia!='' && $tipo_cuenta!='' && $ramo!='') {
				// create sql part for IN condition by imploding comma after each id
				$ciaIn = "('" . implode("','", $cia) ."')";
	
				// create sql part for IN condition by imploding comma after each id
				$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";
	
				// create sql part for IN condition by imploding comma after each id
				$ramoIn = "('" . implode("','", $ramo) ."')";
	
				$sql="SELECT count(DISTINCT comision.id_poliza) FROM poliza 
						INNER JOIN dcia, drecibo, dramo, comision WHERE 
						poliza.id_cia=dcia.idcia AND
						poliza.id_poliza=drecibo.idrecibo AND 
						poliza.id_cod_ramo=dramo.cod_ramo AND
						poliza.id_poliza = comision.id_poliza AND 
						YEAR(f_pago_prima)=$anio AND
						comision.cod_vend='$ejecutivo' AND
						nramo IN ".$ramoIn." AND
						t_cuenta  IN ".$tipo_cuentaIn." AND
						nomcia IN ".$ciaIn." ";
			}//1
			if ($cia=='' && $tipo_cuenta=='' && $ramo=='') {
				$sql="SELECT count(DISTINCT comision.id_poliza) FROM poliza 
						INNER JOIN dcia, drecibo, dramo, comision WHERE 
						poliza.id_cia=dcia.idcia AND
						poliza.id_poliza=drecibo.idrecibo AND 
						poliza.id_cod_ramo=dramo.cod_ramo AND
						poliza.id_poliza = comision.id_poliza AND 
						YEAR(f_pago_prima)=$anio AND
						comision.cod_vend='$ejecutivo' ";
			}//2
			if ($cia!='' && $tipo_cuenta=='' && $ramo=='') {
	
				// create sql part for IN condition by imploding comma after each id
				$ciaIn = "('" . implode("','", $cia) ."')";
	
				$sql="SELECT count(DISTINCT comision.id_poliza) FROM poliza 
						INNER JOIN dcia, drecibo, dramo, comision WHERE 
						poliza.id_cia=dcia.idcia AND
						poliza.id_poliza=drecibo.idrecibo AND 
						poliza.id_cod_ramo=dramo.cod_ramo AND
						poliza.id_poliza = comision.id_poliza AND 
						YEAR(f_pago_prima)=$anio AND
						comision.cod_vend='$ejecutivo' AND
						nomcia IN ".$ciaIn."";
			}//3
			if ($cia=='' && $tipo_cuenta!='' && $ramo=='') {
	
				// create sql part for IN condition by imploding comma after each id
				$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";
	
				$sql="SELECT count(DISTINCT comision.id_poliza) FROM poliza 
						INNER JOIN dcia, drecibo, dramo, comision WHERE 
						poliza.id_cia=dcia.idcia AND
						poliza.id_poliza=drecibo.idrecibo AND 
						poliza.id_cod_ramo=dramo.cod_ramo AND
						poliza.id_poliza = comision.id_poliza AND 
						YEAR(f_pago_prima)=$anio AND
						comision.cod_vend='$ejecutivo' AND
						t_cuenta  IN ".$tipo_cuentaIn."  ";
			}//4
			if ($cia=='' && $tipo_cuenta=='' && $ramo!='') {
	
				// create sql part for IN condition by imploding comma after each id
				$ramoIn = "('" . implode("','", $ramo) ."')";
	
				$sql="SELECT count(DISTINCT comision.id_poliza) FROM poliza 
						INNER JOIN dcia, drecibo, dramo, comision WHERE 
						poliza.id_cia=dcia.idcia AND
						poliza.id_poliza=drecibo.idrecibo AND 
						poliza.id_cod_ramo=dramo.cod_ramo AND
						poliza.id_poliza = comision.id_poliza AND 
						YEAR(f_pago_prima)=$anio AND
						comision.cod_vend='$ejecutivo' AND
						nramo IN ".$ramoIn." ";
			}//5
			if ($cia!='' && $tipo_cuenta!='' && $ramo=='') {
				// create sql part for IN condition by imploding comma after each id
				$ciaIn = "('" . implode("','", $cia) ."')";
	
				// create sql part for IN condition by imploding comma after each id
				$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";
	
				$sql="SELECT count(DISTINCT comision.id_poliza) FROM poliza 
						INNER JOIN dcia, drecibo, dramo, comision WHERE 
						poliza.id_cia=dcia.idcia AND
						poliza.id_poliza=drecibo.idrecibo AND 
						poliza.id_cod_ramo=dramo.cod_ramo AND
						poliza.id_poliza = comision.id_poliza AND 
						YEAR(f_pago_prima)=$anio AND
						comision.cod_vend='$ejecutivo' AND
						t_cuenta  IN ".$tipo_cuentaIn." AND
						nomcia IN ".$ciaIn." ";
			}//6
			if ($cia=='' && $tipo_cuenta!='' && $ramo!='') {
				// create sql part for IN condition by imploding comma after each id
				$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";
	
				// create sql part for IN condition by imploding comma after each id
				$ramoIn = "('" . implode("','", $ramo) ."')";
	
				$sql="SELECT count(DISTINCT comision.id_poliza) FROM poliza 
						INNER JOIN dcia, drecibo, dramo, comision WHERE 
						poliza.id_cia=dcia.idcia AND
						poliza.id_poliza=drecibo.idrecibo AND 
						poliza.id_cod_ramo=dramo.cod_ramo AND
						poliza.id_poliza = comision.id_poliza AND 
						YEAR(f_pago_prima)=$anio AND
						comision.cod_vend='$ejecutivo' AND
						nramo IN ".$ramoIn." AND
						t_cuenta  IN ".$tipo_cuentaIn." ";
			}//7
			if ($cia!='' && $tipo_cuenta=='' && $ramo!='') {
				// create sql part for IN condition by imploding comma after each id
				$ciaIn = "('" . implode("','", $cia) ."')";
	
				// create sql part for IN condition by imploding comma after each id
				$ramoIn = "('" . implode("','", $ramo) ."')";
	
				$sql="SELECT count(DISTINCT comision.id_poliza) FROM poliza 
						INNER JOIN dcia, drecibo, dramo, comision WHERE 
						poliza.id_cia=dcia.idcia AND
						poliza.id_poliza=drecibo.idrecibo AND 
						poliza.id_cod_ramo=dramo.cod_ramo AND
						poliza.id_poliza = comision.id_poliza AND 
						YEAR(f_pago_prima)=$anio AND
						comision.cod_vend='$ejecutivo' AND
						nramo IN ".$ramoIn." AND
						nomcia IN ".$ciaIn." ";
			}//8
			
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

		public function get_count_poliza_c_cobrada_fpago($ramo,$cia,$anio,$tipo_cuenta,$fpago)
			{
			
			if ($cia!='' && $tipo_cuenta!='' && $ramo!='') {
				// create sql part for IN condition by imploding comma after each id
				$ciaIn = "('" . implode("','", $cia) ."')";
	
				// create sql part for IN condition by imploding comma after each id
				$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";
	
				// create sql part for IN condition by imploding comma after each id
				$ramoIn = "('" . implode("','", $ramo) ."')";
	
				$sql="SELECT count(DISTINCT comision.id_poliza) FROM poliza 
						INNER JOIN dcia, drecibo, dramo, comision WHERE 
						poliza.id_cia=dcia.idcia AND
						poliza.id_poliza=drecibo.idrecibo AND 
						poliza.id_cod_ramo=dramo.cod_ramo AND
						poliza.id_poliza = comision.id_poliza AND 
						YEAR(f_pago_prima)=$anio AND
						drecibo.fpago='$fpago' AND
						nramo IN ".$ramoIn." AND
						t_cuenta  IN ".$tipo_cuentaIn." AND
						nomcia IN ".$ciaIn." ";
			}//1
			if ($cia=='' && $tipo_cuenta=='' && $ramo=='') {
				$sql="SELECT count(DISTINCT comision.id_poliza) FROM poliza 
						INNER JOIN dcia, drecibo, dramo, comision WHERE 
						poliza.id_cia=dcia.idcia AND
						poliza.id_poliza=drecibo.idrecibo AND 
						poliza.id_cod_ramo=dramo.cod_ramo AND
						poliza.id_poliza = comision.id_poliza AND 
						YEAR(f_pago_prima)=$anio AND
						drecibo.fpago='$fpago' ";
			}//2
			if ($cia!='' && $tipo_cuenta=='' && $ramo=='') {
	
				// create sql part for IN condition by imploding comma after each id
				$ciaIn = "('" . implode("','", $cia) ."')";
	
				$sql="SELECT count(DISTINCT comision.id_poliza) FROM poliza 
						INNER JOIN dcia, drecibo, dramo, comision WHERE 
						poliza.id_cia=dcia.idcia AND
						poliza.id_poliza=drecibo.idrecibo AND 
						poliza.id_cod_ramo=dramo.cod_ramo AND
						poliza.id_poliza = comision.id_poliza AND 
						YEAR(f_pago_prima)=$anio AND
						drecibo.fpago='$fpago' AND
						nomcia IN ".$ciaIn."";
			}//3
			if ($cia=='' && $tipo_cuenta!='' && $ramo=='') {
	
				// create sql part for IN condition by imploding comma after each id
				$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";
	
				$sql="SELECT count(DISTINCT comision.id_poliza) FROM poliza 
						INNER JOIN dcia, drecibo, dramo, comision WHERE 
						poliza.id_cia=dcia.idcia AND
						poliza.id_poliza=drecibo.idrecibo AND 
						poliza.id_cod_ramo=dramo.cod_ramo AND
						poliza.id_poliza = comision.id_poliza AND 
						YEAR(f_pago_prima)=$anio AND
						drecibo.fpago='$fpago' AND
						t_cuenta  IN ".$tipo_cuentaIn."  ";
			}//4
			if ($cia=='' && $tipo_cuenta=='' && $ramo!='') {
	
				// create sql part for IN condition by imploding comma after each id
				$ramoIn = "('" . implode("','", $ramo) ."')";
	
				$sql="SELECT count(DISTINCT comision.id_poliza) FROM poliza 
						INNER JOIN dcia, drecibo, dramo, comision WHERE 
						poliza.id_cia=dcia.idcia AND
						poliza.id_poliza=drecibo.idrecibo AND 
						poliza.id_cod_ramo=dramo.cod_ramo AND
						poliza.id_poliza = comision.id_poliza AND 
						YEAR(f_pago_prima)=$anio AND
						drecibo.fpago='$fpago' AND
						nramo IN ".$ramoIn." ";
			}//5
			if ($cia!='' && $tipo_cuenta!='' && $ramo=='') {
				// create sql part for IN condition by imploding comma after each id
				$ciaIn = "('" . implode("','", $cia) ."')";
	
				// create sql part for IN condition by imploding comma after each id
				$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";
	
				$sql="SELECT count(DISTINCT comision.id_poliza) FROM poliza 
						INNER JOIN dcia, drecibo, dramo, comision WHERE 
						poliza.id_cia=dcia.idcia AND
						poliza.id_poliza=drecibo.idrecibo AND 
						poliza.id_cod_ramo=dramo.cod_ramo AND
						poliza.id_poliza = comision.id_poliza AND 
						YEAR(f_pago_prima)=$anio AND
						drecibo.fpago='$fpago' AND
						t_cuenta  IN ".$tipo_cuentaIn." AND
						nomcia IN ".$ciaIn." ";
			}//6
			if ($cia=='' && $tipo_cuenta!='' && $ramo!='') {
				// create sql part for IN condition by imploding comma after each id
				$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";
	
				// create sql part for IN condition by imploding comma after each id
				$ramoIn = "('" . implode("','", $ramo) ."')";
	
				$sql="SELECT count(DISTINCT comision.id_poliza) FROM poliza 
						INNER JOIN dcia, drecibo, dramo, comision WHERE 
						poliza.id_cia=dcia.idcia AND
						poliza.id_poliza=drecibo.idrecibo AND 
						poliza.id_cod_ramo=dramo.cod_ramo AND
						poliza.id_poliza = comision.id_poliza AND 
						YEAR(f_pago_prima)=$anio AND
						drecibo.fpago='$fpago' AND
						nramo IN ".$ramoIn." AND
						t_cuenta  IN ".$tipo_cuentaIn." ";
			}//7
			if ($cia!='' && $tipo_cuenta=='' && $ramo!='') {
				// create sql part for IN condition by imploding comma after each id
				$ciaIn = "('" . implode("','", $cia) ."')";
	
				// create sql part for IN condition by imploding comma after each id
				$ramoIn = "('" . implode("','", $ramo) ."')";
	
				$sql="SELECT count(DISTINCT comision.id_poliza) FROM poliza 
						INNER JOIN dcia, drecibo, dramo, comision WHERE 
						poliza.id_cia=dcia.idcia AND
						poliza.id_poliza=drecibo.idrecibo AND 
						poliza.id_cod_ramo=dramo.cod_ramo AND
						poliza.id_poliza = comision.id_poliza AND 
						YEAR(f_pago_prima)=$anio AND
						drecibo.fpago='$fpago' AND
						nramo IN ".$ramoIn." AND
						nomcia IN ".$ciaIn." ";
			}//8
			
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

		public function get_count_poliza_c_cobrada_fpago_by_user($ramo,$cia,$anio,$tipo_cuenta,$fpago,$asesor)
			{
			
			if ($cia!='' && $tipo_cuenta!='' && $ramo!='') {
				// create sql part for IN condition by imploding comma after each id
				$ciaIn = "('" . implode("','", $cia) ."')";
	
				// create sql part for IN condition by imploding comma after each id
				$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";
	
				// create sql part for IN condition by imploding comma after each id
				$ramoIn = "('" . implode("','", $ramo) ."')";
	
				$sql="SELECT count(DISTINCT comision.id_poliza) FROM poliza 
						INNER JOIN dcia, drecibo, dramo, comision WHERE 
						poliza.id_cia=dcia.idcia AND
						poliza.id_poliza=drecibo.idrecibo AND 
						poliza.id_cod_ramo=dramo.cod_ramo AND
						poliza.id_poliza = comision.id_poliza AND 
						poliza.codvend = '$asesor' AND
						YEAR(f_pago_prima)=$anio AND
						drecibo.fpago='$fpago' AND
						nramo IN ".$ramoIn." AND
						t_cuenta  IN ".$tipo_cuentaIn." AND
						nomcia IN ".$ciaIn." ";
			}//1
			if ($cia=='' && $tipo_cuenta=='' && $ramo=='') {
				$sql="SELECT count(DISTINCT comision.id_poliza) FROM poliza 
						INNER JOIN dcia, drecibo, dramo, comision WHERE 
						poliza.id_cia=dcia.idcia AND
						poliza.id_poliza=drecibo.idrecibo AND 
						poliza.id_cod_ramo=dramo.cod_ramo AND
						poliza.id_poliza = comision.id_poliza AND 
						poliza.codvend = '$asesor' AND
						YEAR(f_pago_prima)=$anio AND
						drecibo.fpago='$fpago' ";
			}//2
			if ($cia!='' && $tipo_cuenta=='' && $ramo=='') {
	
				// create sql part for IN condition by imploding comma after each id
				$ciaIn = "('" . implode("','", $cia) ."')";
	
				$sql="SELECT count(DISTINCT comision.id_poliza) FROM poliza 
						INNER JOIN dcia, drecibo, dramo, comision WHERE 
						poliza.id_cia=dcia.idcia AND
						poliza.id_poliza=drecibo.idrecibo AND 
						poliza.id_cod_ramo=dramo.cod_ramo AND
						poliza.id_poliza = comision.id_poliza AND 
						poliza.codvend = '$asesor' AND
						YEAR(f_pago_prima)=$anio AND
						drecibo.fpago='$fpago' AND
						nomcia IN ".$ciaIn."";
			}//3
			if ($cia=='' && $tipo_cuenta!='' && $ramo=='') {
	
				// create sql part for IN condition by imploding comma after each id
				$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";
	
				$sql="SELECT count(DISTINCT comision.id_poliza) FROM poliza 
						INNER JOIN dcia, drecibo, dramo, comision WHERE 
						poliza.id_cia=dcia.idcia AND
						poliza.id_poliza=drecibo.idrecibo AND 
						poliza.id_cod_ramo=dramo.cod_ramo AND
						poliza.id_poliza = comision.id_poliza AND 
						poliza.codvend = '$asesor' AND
						YEAR(f_pago_prima)=$anio AND
						drecibo.fpago='$fpago' AND
						t_cuenta  IN ".$tipo_cuentaIn."  ";
			}//4
			if ($cia=='' && $tipo_cuenta=='' && $ramo!='') {
	
				// create sql part for IN condition by imploding comma after each id
				$ramoIn = "('" . implode("','", $ramo) ."')";
	
				$sql="SELECT count(DISTINCT comision.id_poliza) FROM poliza 
						INNER JOIN dcia, drecibo, dramo, comision WHERE 
						poliza.id_cia=dcia.idcia AND
						poliza.id_poliza=drecibo.idrecibo AND 
						poliza.id_cod_ramo=dramo.cod_ramo AND
						poliza.id_poliza = comision.id_poliza AND 
						poliza.codvend = '$asesor' AND
						YEAR(f_pago_prima)=$anio AND
						drecibo.fpago='$fpago' AND
						nramo IN ".$ramoIn." ";
			}//5
			if ($cia!='' && $tipo_cuenta!='' && $ramo=='') {
				// create sql part for IN condition by imploding comma after each id
				$ciaIn = "('" . implode("','", $cia) ."')";
	
				// create sql part for IN condition by imploding comma after each id
				$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";
	
				$sql="SELECT count(DISTINCT comision.id_poliza) FROM poliza 
						INNER JOIN dcia, drecibo, dramo, comision WHERE 
						poliza.id_cia=dcia.idcia AND
						poliza.id_poliza=drecibo.idrecibo AND 
						poliza.id_cod_ramo=dramo.cod_ramo AND
						poliza.id_poliza = comision.id_poliza AND 
						poliza.codvend = '$asesor' AND
						YEAR(f_pago_prima)=$anio AND
						drecibo.fpago='$fpago' AND
						t_cuenta  IN ".$tipo_cuentaIn." AND
						nomcia IN ".$ciaIn." ";
			}//6
			if ($cia=='' && $tipo_cuenta!='' && $ramo!='') {
				// create sql part for IN condition by imploding comma after each id
				$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";
	
				// create sql part for IN condition by imploding comma after each id
				$ramoIn = "('" . implode("','", $ramo) ."')";
	
				$sql="SELECT count(DISTINCT comision.id_poliza) FROM poliza 
						INNER JOIN dcia, drecibo, dramo, comision WHERE 
						poliza.id_cia=dcia.idcia AND
						poliza.id_poliza=drecibo.idrecibo AND 
						poliza.id_cod_ramo=dramo.cod_ramo AND
						poliza.id_poliza = comision.id_poliza AND 
						poliza.codvend = '$asesor' AND
						YEAR(f_pago_prima)=$anio AND
						drecibo.fpago='$fpago' AND
						nramo IN ".$ramoIn." AND
						t_cuenta  IN ".$tipo_cuentaIn." ";
			}//7
			if ($cia!='' && $tipo_cuenta=='' && $ramo!='') {
				// create sql part for IN condition by imploding comma after each id
				$ciaIn = "('" . implode("','", $cia) ."')";
	
				// create sql part for IN condition by imploding comma after each id
				$ramoIn = "('" . implode("','", $ramo) ."')";
	
				$sql="SELECT count(DISTINCT comision.id_poliza) FROM poliza 
						INNER JOIN dcia, drecibo, dramo, comision WHERE 
						poliza.id_cia=dcia.idcia AND
						poliza.id_poliza=drecibo.idrecibo AND 
						poliza.id_cod_ramo=dramo.cod_ramo AND
						poliza.id_poliza = comision.id_poliza AND 
						poliza.codvend = '$asesor' AND
						YEAR(f_pago_prima)=$anio AND
						drecibo.fpago='$fpago' AND
						nramo IN ".$ramoIn." AND
						nomcia IN ".$ciaIn." ";
			}//8
			
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


	public function get_poliza_c_cobrada_ramo($ramo,$cia,$anio,$tipo_cuenta)
		{
		if ($cia!='' && $tipo_cuenta!='') {
			// create sql part for IN condition by imploding comma after each id
			$ciaIn = "('" . implode("','", $cia) ."')";

			// create sql part for IN condition by imploding comma after each id
			$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";

			$sql="SELECT * FROM poliza 
					INNER JOIN dcia, drecibo, dramo, comision WHERE 
					poliza.id_cia=dcia.idcia AND
					poliza.id_poliza=drecibo.idrecibo AND 
					poliza.id_cod_ramo=dramo.cod_ramo AND
					poliza.id_poliza = comision.id_poliza AND 
					YEAR(f_pago_prima)=$anio AND
					nomcia IN ".$ciaIn." AND
					t_cuenta  IN ".$tipo_cuentaIn." AND
					nramo = '$ramo'";
		}
		if ($cia=='' && $tipo_cuenta=='') {
			$sql="SELECT * FROM poliza 
					INNER JOIN dcia, drecibo, dramo, comision WHERE 
					poliza.id_cia=dcia.idcia AND
					poliza.id_poliza=drecibo.idrecibo AND 
					poliza.id_cod_ramo=dramo.cod_ramo AND
					poliza.id_poliza = comision.id_poliza AND 
					YEAR(f_pago_prima)=$anio AND
					nramo = '$ramo'";
		}
		if ($cia=='' && $tipo_cuenta!='') {

			// create sql part for IN condition by imploding comma after each id
			$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";

			$sql="SELECT * FROM poliza 
					INNER JOIN dcia, drecibo, dramo, comision WHERE 
					poliza.id_cia=dcia.idcia AND
					poliza.id_poliza=drecibo.idrecibo AND 
					poliza.id_cod_ramo=dramo.cod_ramo AND
					poliza.id_poliza = comision.id_poliza AND 
					YEAR(f_pago_prima)=$anio AND
					t_cuenta  IN ".$tipo_cuentaIn." AND
					nramo = '$ramo'";
		}
		if ($tipo_cuenta=='' && $cia!='') {

			// create sql part for IN condition by imploding comma after each id
			$ciaIn = "('" . implode("','", $cia) ."')";

			$sql="SELECT * FROM poliza 
					INNER JOIN dcia, drecibo, dramo, comision WHERE 
					poliza.id_cia=dcia.idcia AND
					poliza.id_poliza=drecibo.idrecibo AND 
					poliza.id_cod_ramo=dramo.cod_ramo AND
					poliza.id_poliza = comision.id_poliza AND 
					YEAR(f_pago_prima)=$anio AND
					nomcia IN ".$ciaIn." AND
					nramo = '$ramo'";
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

	public function get_poliza_c_cobrada_ramo_by_user($ramo,$cia,$anio,$tipo_cuenta,$asesor)
		{
		if ($cia!='' && $tipo_cuenta!='') {
			// create sql part for IN condition by imploding comma after each id
			$ciaIn = "('" . implode("','", $cia) ."')";

			// create sql part for IN condition by imploding comma after each id
			$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";

			$sql="SELECT * FROM poliza 
					INNER JOIN dcia, drecibo, dramo, comision WHERE 
					poliza.id_cia=dcia.idcia AND
					poliza.id_poliza=drecibo.idrecibo AND 
					poliza.id_cod_ramo=dramo.cod_ramo AND
					poliza.id_poliza = comision.id_poliza AND 
					poliza.codvend = '$asesor' AND
					YEAR(f_pago_prima)=$anio AND
					nomcia IN ".$ciaIn." AND
					t_cuenta  IN ".$tipo_cuentaIn." AND
					nramo = '$ramo'";
		}
		if ($cia=='' && $tipo_cuenta=='') {
			$sql="SELECT * FROM poliza 
					INNER JOIN dcia, drecibo, dramo, comision WHERE 
					poliza.id_cia=dcia.idcia AND
					poliza.id_poliza=drecibo.idrecibo AND 
					poliza.id_cod_ramo=dramo.cod_ramo AND
					poliza.id_poliza = comision.id_poliza AND 
					poliza.codvend = '$asesor' AND
					YEAR(f_pago_prima)=$anio AND
					nramo = '$ramo'";
		}
		if ($cia=='' && $tipo_cuenta!='') {

			// create sql part for IN condition by imploding comma after each id
			$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";

			$sql="SELECT * FROM poliza 
					INNER JOIN dcia, drecibo, dramo, comision WHERE 
					poliza.id_cia=dcia.idcia AND
					poliza.id_poliza=drecibo.idrecibo AND 
					poliza.id_cod_ramo=dramo.cod_ramo AND
					poliza.id_poliza = comision.id_poliza AND 
					poliza.codvend = '$asesor' AND
					YEAR(f_pago_prima)=$anio AND
					t_cuenta  IN ".$tipo_cuentaIn." AND
					nramo = '$ramo'";
		}
		if ($tipo_cuenta=='' && $cia!='') {

			// create sql part for IN condition by imploding comma after each id
			$ciaIn = "('" . implode("','", $cia) ."')";

			$sql="SELECT * FROM poliza 
					INNER JOIN dcia, drecibo, dramo, comision WHERE 
					poliza.id_cia=dcia.idcia AND
					poliza.id_poliza=drecibo.idrecibo AND 
					poliza.id_cod_ramo=dramo.cod_ramo AND
					poliza.id_poliza = comision.id_poliza AND 
					poliza.codvend = '$asesor' AND
					YEAR(f_pago_prima)=$anio AND
					nomcia IN ".$ciaIn." AND
					nramo = '$ramo'";
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

	public function get_poliza_c_cobrada_cia($cia,$ramo,$anio,$tipo_cuenta)
		{
		if ($ramo!='' && $tipo_cuenta!='') {
			// create sql part for IN condition by imploding comma after each id
			$ramoIn = "('" . implode("','", $ramo) ."')";

			// create sql part for IN condition by imploding comma after each id
			$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";

			$sql="SELECT * FROM poliza 
						INNER JOIN dcia, drecibo, dramo, comision WHERE 
						poliza.id_cia=dcia.idcia AND
						poliza.id_poliza=drecibo.idrecibo AND 
						poliza.id_cod_ramo=dramo.cod_ramo AND
						poliza.id_poliza = comision.id_poliza AND 
						nomcia = '$cia' AND
						YEAR(f_pago_prima)=$anio AND
						nramo IN ".$ramoIn." AND
						t_cuenta  IN ".$tipo_cuentaIn." ";
		}
		if ($ramo=='' && $tipo_cuenta=='') {
			$sql="SELECT * FROM poliza 
						INNER JOIN dcia, drecibo, dramo, comision WHERE 
						poliza.id_cia=dcia.idcia AND
						poliza.id_poliza=drecibo.idrecibo AND 
						poliza.id_cod_ramo=dramo.cod_ramo AND
						poliza.id_poliza = comision.id_poliza AND 
						nomcia = '$cia' AND
						YEAR(f_pago_prima)=$anio";
		}
		if ($ramo=='' && $tipo_cuenta!='') {

			// create sql part for IN condition by imploding comma after each id
			$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";

			$sql="SELECT * FROM poliza 
					INNER JOIN dcia, drecibo, dramo, comision WHERE 
					poliza.id_cia=dcia.idcia AND
					poliza.id_poliza=drecibo.idrecibo AND 
					poliza.id_cod_ramo=dramo.cod_ramo AND
					poliza.id_poliza = comision.id_poliza AND 
					nomcia = '$cia' AND
					YEAR(f_pago_prima)=$anio AND
					t_cuenta  IN ".$tipo_cuentaIn." ";
		}
		if ($tipo_cuenta=='' && $ramo!='') {

			// create sql part for IN condition by imploding comma after each id
			$ramoIn = "('" . implode("','", $ramo) ."')";

			$sql="SELECT * FROM poliza 
					INNER JOIN dcia, drecibo, dramo, comision WHERE 
					poliza.id_cia=dcia.idcia AND
					poliza.id_poliza=drecibo.idrecibo AND 
					poliza.id_cod_ramo=dramo.cod_ramo AND
					poliza.id_poliza = comision.id_poliza AND 
					nomcia = '$cia' AND
					YEAR(f_pago_prima)=$anio AND
					nramo IN ".$ramoIn." ";
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

	public function get_poliza_c_cobrada_cia_by_user($cia,$ramo,$anio,$tipo_cuenta,$asesor)
		{
		if ($ramo!='' && $tipo_cuenta!='') {
			// create sql part for IN condition by imploding comma after each id
			$ramoIn = "('" . implode("','", $ramo) ."')";

			// create sql part for IN condition by imploding comma after each id
			$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";

			$sql="SELECT * FROM poliza 
						INNER JOIN dcia, drecibo, dramo, comision WHERE 
						poliza.id_cia=dcia.idcia AND
						poliza.id_poliza=drecibo.idrecibo AND 
						poliza.id_cod_ramo=dramo.cod_ramo AND
						poliza.id_poliza = comision.id_poliza AND 
						poliza.codvend = '$asesor' AND
						nomcia = '$cia' AND
						YEAR(f_pago_prima)=$anio AND
						nramo IN ".$ramoIn." AND
						t_cuenta  IN ".$tipo_cuentaIn." ";
		}
		if ($ramo=='' && $tipo_cuenta=='') {
			$sql="SELECT * FROM poliza 
						INNER JOIN dcia, drecibo, dramo, comision WHERE 
						poliza.id_cia=dcia.idcia AND
						poliza.id_poliza=drecibo.idrecibo AND 
						poliza.id_cod_ramo=dramo.cod_ramo AND
						poliza.id_poliza = comision.id_poliza AND 
						poliza.codvend = '$asesor' AND
						nomcia = '$cia' AND
						YEAR(f_pago_prima)=$anio";
		}
		if ($ramo=='' && $tipo_cuenta!='') {

			// create sql part for IN condition by imploding comma after each id
			$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";

			$sql="SELECT * FROM poliza 
					INNER JOIN dcia, drecibo, dramo, comision WHERE 
					poliza.id_cia=dcia.idcia AND
					poliza.id_poliza=drecibo.idrecibo AND 
					poliza.id_cod_ramo=dramo.cod_ramo AND
					poliza.id_poliza = comision.id_poliza AND 
					poliza.codvend = '$asesor' AND
					nomcia = '$cia' AND
					YEAR(f_pago_prima)=$anio AND
					t_cuenta  IN ".$tipo_cuentaIn." ";
		}
		if ($tipo_cuenta=='' && $ramo!='') {

			// create sql part for IN condition by imploding comma after each id
			$ramoIn = "('" . implode("','", $ramo) ."')";

			$sql="SELECT * FROM poliza 
					INNER JOIN dcia, drecibo, dramo, comision WHERE 
					poliza.id_cia=dcia.idcia AND
					poliza.id_poliza=drecibo.idrecibo AND 
					poliza.id_cod_ramo=dramo.cod_ramo AND
					poliza.id_poliza = comision.id_poliza AND 
					poliza.codvend = '$asesor' AND
					nomcia = '$cia' AND
					YEAR(f_pago_prima)=$anio AND
					nramo IN ".$ramoIn." ";
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


	public function get_poliza_c_cobrada_tipo_poliza($tipo_poliza,$cia,$ramo,$anio,$tipo_cuenta)
		{

		if ($cia!='' && $tipo_cuenta!='' && $ramo!='') {
			// create sql part for IN condition by imploding comma after each id
			$ciaIn = "('" . implode("','", $cia) ."')";

			// create sql part for IN condition by imploding comma after each id
			$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";

			// create sql part for IN condition by imploding comma after each id
			$ramoIn = "('" . implode("','", $ramo) ."')";

			$sql="SELECT * FROM poliza 
						INNER JOIN dcia, drecibo, dramo, comision, tipo_poliza WHERE 
						poliza.id_cia=dcia.idcia AND
						poliza.id_poliza=drecibo.idrecibo AND 
						poliza.id_cod_ramo=dramo.cod_ramo AND
						poliza.id_poliza = comision.id_poliza AND 
						poliza.id_tpoliza = tipo_poliza.id_t_poliza AND
						tipo_poliza.tipo_poliza = '$tipo_poliza' AND
						YEAR(f_pago_prima)=$anio AND
						nomcia IN ".$ciaIn." AND
						nramo IN ".$ramoIn." AND
						t_cuenta  IN ".$tipo_cuentaIn." ";
		}//1
		if ($cia=='' && $tipo_cuenta=='' && $ramo=='') {
			$sql="SELECT * FROM poliza 
						INNER JOIN dcia, drecibo, dramo, comision, tipo_poliza WHERE 
						poliza.id_cia=dcia.idcia AND
						poliza.id_poliza=drecibo.idrecibo AND 
						poliza.id_cod_ramo=dramo.cod_ramo AND
						poliza.id_poliza = comision.id_poliza AND 
						poliza.id_tpoliza = tipo_poliza.id_t_poliza AND
						tipo_poliza.tipo_poliza = '$tipo_poliza' AND
						YEAR(f_pago_prima)=$anio  ";
		}//2
		if ($cia!='' && $tipo_cuenta=='' && $ramo=='') {

			// create sql part for IN condition by imploding comma after each id
			$ciaIn = "('" . implode("','", $cia) ."')";

			$sql="SELECT * FROM poliza 
					INNER JOIN dcia, drecibo, dramo, comision, tipo_poliza WHERE 
					poliza.id_cia=dcia.idcia AND
					poliza.id_poliza=drecibo.idrecibo AND 
					poliza.id_cod_ramo=dramo.cod_ramo AND
					poliza.id_poliza = comision.id_poliza AND 
					poliza.id_tpoliza = tipo_poliza.id_t_poliza AND
					tipo_poliza.tipo_poliza = '$tipo_poliza' AND
					YEAR(f_pago_prima)=$anio AND
					nomcia IN ".$ciaIn." ";
		}//3
		if ($cia=='' && $tipo_cuenta!='' && $ramo=='') {

			// create sql part for IN condition by imploding comma after each id
			$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";

			$sql="SELECT * FROM poliza 
					INNER JOIN dcia, drecibo, dramo, comision, tipo_poliza WHERE 
					poliza.id_cia=dcia.idcia AND
					poliza.id_poliza=drecibo.idrecibo AND 
					poliza.id_cod_ramo=dramo.cod_ramo AND
					poliza.id_poliza = comision.id_poliza AND 
					poliza.id_tpoliza = tipo_poliza.id_t_poliza AND
					tipo_poliza.tipo_poliza = '$tipo_poliza' AND
					YEAR(f_pago_prima)=$anio AND
					t_cuenta  IN ".$tipo_cuentaIn." ";
		}//4
		if ($cia=='' && $tipo_cuenta=='' && $ramo!='') {

			// create sql part for IN condition by imploding comma after each id
			$ramoIn = "('" . implode("','", $ramo) ."')";

			$sql="SELECT * FROM poliza 
					INNER JOIN dcia, drecibo, dramo, comision, tipo_poliza WHERE 
					poliza.id_cia=dcia.idcia AND
					poliza.id_poliza=drecibo.idrecibo AND 
					poliza.id_cod_ramo=dramo.cod_ramo AND
					poliza.id_poliza = comision.id_poliza AND 
					poliza.id_tpoliza = tipo_poliza.id_t_poliza AND
					tipo_poliza.tipo_poliza = '$tipo_poliza' AND
					YEAR(f_pago_prima)=$anio AND
					nramo IN ".$ramoIn."  ";
		}//5
		if ($cia!='' && $tipo_cuenta!='' && $ramo=='') {
			// create sql part for IN condition by imploding comma after each id
			$ciaIn = "('" . implode("','", $cia) ."')";

			// create sql part for IN condition by imploding comma after each id
			$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";

			$sql="SELECT * FROM poliza 
						INNER JOIN dcia, drecibo, dramo, comision, tipo_poliza WHERE 
						poliza.id_cia=dcia.idcia AND
						poliza.id_poliza=drecibo.idrecibo AND 
						poliza.id_cod_ramo=dramo.cod_ramo AND
						poliza.id_poliza = comision.id_poliza AND 
						poliza.id_tpoliza = tipo_poliza.id_t_poliza AND
						tipo_poliza.tipo_poliza = '$tipo_poliza' AND
						YEAR(f_pago_prima)=$anio AND
						nomcia IN ".$ciaIn." AND
						t_cuenta  IN ".$tipo_cuentaIn." ";
		}//6
		if ($cia=='' && $tipo_cuenta!='' && $ramo!='') {
			// create sql part for IN condition by imploding comma after each id
			$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";

			// create sql part for IN condition by imploding comma after each id
			$ramoIn = "('" . implode("','", $ramo) ."')";

			$sql="SELECT * FROM poliza 
						INNER JOIN dcia, drecibo, dramo, comision, tipo_poliza WHERE 
						poliza.id_cia=dcia.idcia AND
						poliza.id_poliza=drecibo.idrecibo AND 
						poliza.id_cod_ramo=dramo.cod_ramo AND
						poliza.id_poliza = comision.id_poliza AND 
						poliza.id_tpoliza = tipo_poliza.id_t_poliza AND
						tipo_poliza.tipo_poliza = '$tipo_poliza' AND
						YEAR(f_pago_prima)=$anio AND
						nramo IN ".$ramoIn." AND
						t_cuenta  IN ".$tipo_cuentaIn." ";
		}//7
		if ($cia!='' && $tipo_cuenta=='' && $ramo!='') {
			// create sql part for IN condition by imploding comma after each id
			$ciaIn = "('" . implode("','", $cia) ."')";

			// create sql part for IN condition by imploding comma after each id
			$ramoIn = "('" . implode("','", $ramo) ."')";

			$sql="SELECT * FROM poliza 
						INNER JOIN dcia, drecibo, dramo, comision, tipo_poliza WHERE 
						poliza.id_cia=dcia.idcia AND
						poliza.id_poliza=drecibo.idrecibo AND 
						poliza.id_cod_ramo=dramo.cod_ramo AND
						poliza.id_poliza = comision.id_poliza AND 
						poliza.id_tpoliza = tipo_poliza.id_t_poliza AND
						tipo_poliza.tipo_poliza = '$tipo_poliza' AND
						YEAR(f_pago_prima)=$anio AND
						nomcia IN ".$ciaIn." AND
						nramo IN ".$ramoIn."  ";
		}//8
		
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

	public function get_poliza_c_cobrada_tipo_poliza_by_user($tipo_poliza,$cia,$ramo,$anio,$tipo_cuenta,$asesor)
		{

		if ($cia!='' && $tipo_cuenta!='' && $ramo!='') {
			// create sql part for IN condition by imploding comma after each id
			$ciaIn = "('" . implode("','", $cia) ."')";

			// create sql part for IN condition by imploding comma after each id
			$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";

			// create sql part for IN condition by imploding comma after each id
			$ramoIn = "('" . implode("','", $ramo) ."')";

			$sql="SELECT * FROM poliza 
						INNER JOIN dcia, drecibo, dramo, comision, tipo_poliza WHERE 
						poliza.id_cia=dcia.idcia AND
						poliza.id_poliza=drecibo.idrecibo AND 
						poliza.id_cod_ramo=dramo.cod_ramo AND
						poliza.id_poliza = comision.id_poliza AND 
						poliza.id_tpoliza = tipo_poliza.id_t_poliza AND
						tipo_poliza.tipo_poliza = '$tipo_poliza' AND
						poliza.codvend = '$asesor' AND
						YEAR(f_pago_prima)=$anio AND
						nomcia IN ".$ciaIn." AND
						nramo IN ".$ramoIn." AND
						t_cuenta  IN ".$tipo_cuentaIn." ";
		}//1
		if ($cia=='' && $tipo_cuenta=='' && $ramo=='') {
			$sql="SELECT * FROM poliza 
						INNER JOIN dcia, drecibo, dramo, comision, tipo_poliza WHERE 
						poliza.id_cia=dcia.idcia AND
						poliza.id_poliza=drecibo.idrecibo AND 
						poliza.id_cod_ramo=dramo.cod_ramo AND
						poliza.id_poliza = comision.id_poliza AND 
						poliza.id_tpoliza = tipo_poliza.id_t_poliza AND
						poliza.codvend = '$asesor' AND
						tipo_poliza.tipo_poliza = '$tipo_poliza' AND
						YEAR(f_pago_prima)=$anio  ";
		}//2
		if ($cia!='' && $tipo_cuenta=='' && $ramo=='') {

			// create sql part for IN condition by imploding comma after each id
			$ciaIn = "('" . implode("','", $cia) ."')";

			$sql="SELECT * FROM poliza 
					INNER JOIN dcia, drecibo, dramo, comision, tipo_poliza WHERE 
					poliza.id_cia=dcia.idcia AND
					poliza.id_poliza=drecibo.idrecibo AND 
					poliza.id_cod_ramo=dramo.cod_ramo AND
					poliza.id_poliza = comision.id_poliza AND 
					poliza.id_tpoliza = tipo_poliza.id_t_poliza AND
					tipo_poliza.tipo_poliza = '$tipo_poliza' AND
					poliza.codvend = '$asesor' AND
					YEAR(f_pago_prima)=$anio AND
					nomcia IN ".$ciaIn." ";
		}//3
		if ($cia=='' && $tipo_cuenta!='' && $ramo=='') {

			// create sql part for IN condition by imploding comma after each id
			$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";

			$sql="SELECT * FROM poliza 
					INNER JOIN dcia, drecibo, dramo, comision, tipo_poliza WHERE 
					poliza.id_cia=dcia.idcia AND
					poliza.id_poliza=drecibo.idrecibo AND 
					poliza.id_cod_ramo=dramo.cod_ramo AND
					poliza.id_poliza = comision.id_poliza AND 
					poliza.id_tpoliza = tipo_poliza.id_t_poliza AND
					tipo_poliza.tipo_poliza = '$tipo_poliza' AND
					poliza.codvend = '$asesor' AND
					YEAR(f_pago_prima)=$anio AND
					t_cuenta  IN ".$tipo_cuentaIn." ";
		}//4
		if ($cia=='' && $tipo_cuenta=='' && $ramo!='') {

			// create sql part for IN condition by imploding comma after each id
			$ramoIn = "('" . implode("','", $ramo) ."')";

			$sql="SELECT * FROM poliza 
					INNER JOIN dcia, drecibo, dramo, comision, tipo_poliza WHERE 
					poliza.id_cia=dcia.idcia AND
					poliza.id_poliza=drecibo.idrecibo AND 
					poliza.id_cod_ramo=dramo.cod_ramo AND
					poliza.id_poliza = comision.id_poliza AND 
					poliza.id_tpoliza = tipo_poliza.id_t_poliza AND
					tipo_poliza.tipo_poliza = '$tipo_poliza' AND
					poliza.codvend = '$asesor' AND
					YEAR(f_pago_prima)=$anio AND
					nramo IN ".$ramoIn."  ";
		}//5
		if ($cia!='' && $tipo_cuenta!='' && $ramo=='') {
			// create sql part for IN condition by imploding comma after each id
			$ciaIn = "('" . implode("','", $cia) ."')";

			// create sql part for IN condition by imploding comma after each id
			$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";

			$sql="SELECT * FROM poliza 
						INNER JOIN dcia, drecibo, dramo, comision, tipo_poliza WHERE 
						poliza.id_cia=dcia.idcia AND
						poliza.id_poliza=drecibo.idrecibo AND 
						poliza.id_cod_ramo=dramo.cod_ramo AND
						poliza.id_poliza = comision.id_poliza AND 
						poliza.id_tpoliza = tipo_poliza.id_t_poliza AND
						tipo_poliza.tipo_poliza = '$tipo_poliza' AND
						poliza.codvend = '$asesor' AND
						YEAR(f_pago_prima)=$anio AND
						nomcia IN ".$ciaIn." AND
						t_cuenta  IN ".$tipo_cuentaIn." ";
		}//6
		if ($cia=='' && $tipo_cuenta!='' && $ramo!='') {
			// create sql part for IN condition by imploding comma after each id
			$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";

			// create sql part for IN condition by imploding comma after each id
			$ramoIn = "('" . implode("','", $ramo) ."')";

			$sql="SELECT * FROM poliza 
						INNER JOIN dcia, drecibo, dramo, comision, tipo_poliza WHERE 
						poliza.id_cia=dcia.idcia AND
						poliza.id_poliza=drecibo.idrecibo AND 
						poliza.id_cod_ramo=dramo.cod_ramo AND
						poliza.id_poliza = comision.id_poliza AND 
						poliza.id_tpoliza = tipo_poliza.id_t_poliza AND
						tipo_poliza.tipo_poliza = '$tipo_poliza' AND
						poliza.codvend = '$asesor' AND
						YEAR(f_pago_prima)=$anio AND
						nramo IN ".$ramoIn." AND
						t_cuenta  IN ".$tipo_cuentaIn." ";
		}//7
		if ($cia!='' && $tipo_cuenta=='' && $ramo!='') {
			// create sql part for IN condition by imploding comma after each id
			$ciaIn = "('" . implode("','", $cia) ."')";

			// create sql part for IN condition by imploding comma after each id
			$ramoIn = "('" . implode("','", $ramo) ."')";

			$sql="SELECT * FROM poliza 
						INNER JOIN dcia, drecibo, dramo, comision, tipo_poliza WHERE 
						poliza.id_cia=dcia.idcia AND
						poliza.id_poliza=drecibo.idrecibo AND 
						poliza.id_cod_ramo=dramo.cod_ramo AND
						poliza.id_poliza = comision.id_poliza AND 
						poliza.id_tpoliza = tipo_poliza.id_t_poliza AND
						tipo_poliza.tipo_poliza = '$tipo_poliza' AND
						poliza.codvend = '$asesor' AND
						YEAR(f_pago_prima)=$anio AND
						nomcia IN ".$ciaIn." AND
						nramo IN ".$ramoIn."  ";
		}//8
		
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


	public function get_poliza_c_cobrada_f_pago($f_pago,$cia,$ramo,$anio,$tipo_cuenta)
		{

		if ($cia!='' && $tipo_cuenta!='' && $ramo!='') {
			// create sql part for IN condition by imploding comma after each id
			$ciaIn = "('" . implode("','", $cia) ."')";

			// create sql part for IN condition by imploding comma after each id
			$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";

			// create sql part for IN condition by imploding comma after each id
			$ramoIn = "('" . implode("','", $ramo) ."')";

			$sql="SELECT * FROM poliza 
						INNER JOIN dcia, drecibo, dramo, comision WHERE 
						poliza.id_cia=dcia.idcia AND
						poliza.id_poliza=drecibo.idrecibo AND 
						poliza.id_cod_ramo=dramo.cod_ramo AND
						poliza.id_poliza = comision.id_poliza AND 
						drecibo.fpago = '$f_pago' AND
						YEAR(f_pago_prima)=$anio AND
						nomcia IN ".$ciaIn." AND
						nramo IN ".$ramoIn." AND
						t_cuenta  IN ".$tipo_cuentaIn." ";
		}//1
		if ($cia=='' && $tipo_cuenta=='' && $ramo=='') {
			$sql="SELECT * FROM poliza 
					INNER JOIN dcia, drecibo, dramo, comision WHERE 
					poliza.id_cia=dcia.idcia AND
					poliza.id_poliza=drecibo.idrecibo AND 
					poliza.id_cod_ramo=dramo.cod_ramo AND
					poliza.id_poliza = comision.id_poliza AND 
					drecibo.fpago = '$f_pago' AND
					YEAR(f_pago_prima)=$anio   ";
		}//2
		if ($cia!='' && $tipo_cuenta=='' && $ramo=='') {

			// create sql part for IN condition by imploding comma after each id
			$ciaIn = "('" . implode("','", $cia) ."')";

			$sql="SELECT * FROM poliza 
					INNER JOIN dcia, drecibo, dramo, comision WHERE 
					poliza.id_cia=dcia.idcia AND
					poliza.id_poliza=drecibo.idrecibo AND 
					poliza.id_cod_ramo=dramo.cod_ramo AND
					poliza.id_poliza = comision.id_poliza AND 
					drecibo.fpago = '$f_pago' AND
					YEAR(f_pago_prima)=$anio AND
					nomcia IN ".$ciaIn." ";
		}//3
		if ($cia=='' && $tipo_cuenta!='' && $ramo=='') {

			// create sql part for IN condition by imploding comma after each id
			$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";

			$sql="SELECT * FROM poliza 
					INNER JOIN dcia, drecibo, dramo, comision WHERE 
					poliza.id_cia=dcia.idcia AND
					poliza.id_poliza=drecibo.idrecibo AND 
					poliza.id_cod_ramo=dramo.cod_ramo AND
					poliza.id_poliza = comision.id_poliza AND 
					drecibo.fpago = '$f_pago' AND
					YEAR(f_pago_prima)=$anio AND
					t_cuenta  IN ".$tipo_cuentaIn." ";
		}//4
		if ($cia=='' && $tipo_cuenta=='' && $ramo!='') {

			// create sql part for IN condition by imploding comma after each id
			$ramoIn = "('" . implode("','", $ramo) ."')";

			$sql="SELECT * FROM poliza 
					INNER JOIN dcia, drecibo, dramo, comision WHERE 
					poliza.id_cia=dcia.idcia AND
					poliza.id_poliza=drecibo.idrecibo AND 
					poliza.id_cod_ramo=dramo.cod_ramo AND
					poliza.id_poliza = comision.id_poliza AND 
					drecibo.fpago = '$f_pago' AND
					YEAR(f_pago_prima)=$anio AND
					nramo IN ".$ramoIn."  ";
		}//5
		if ($cia!='' && $tipo_cuenta!='' && $ramo=='') {
			// create sql part for IN condition by imploding comma after each id
			$ciaIn = "('" . implode("','", $cia) ."')";

			// create sql part for IN condition by imploding comma after each id
			$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";

			$sql="SELECT * FROM poliza 
						INNER JOIN dcia, drecibo, dramo, comision WHERE 
						poliza.id_cia=dcia.idcia AND
						poliza.id_poliza=drecibo.idrecibo AND 
						poliza.id_cod_ramo=dramo.cod_ramo AND
						poliza.id_poliza = comision.id_poliza AND 
						drecibo.fpago = '$f_pago' AND
						YEAR(f_pago_prima)=$anio AND
						nomcia IN ".$ciaIn." AND
						t_cuenta  IN ".$tipo_cuentaIn." ";
		}//6
		if ($cia=='' && $tipo_cuenta!='' && $ramo!='') {
			// create sql part for IN condition by imploding comma after each id
			$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";

			// create sql part for IN condition by imploding comma after each id
			$ramoIn = "('" . implode("','", $ramo) ."')";

			$sql="SELECT * FROM poliza 
						INNER JOIN dcia, drecibo, dramo, comision WHERE 
						poliza.id_cia=dcia.idcia AND
						poliza.id_poliza=drecibo.idrecibo AND 
						poliza.id_cod_ramo=dramo.cod_ramo AND
						poliza.id_poliza = comision.id_poliza AND 
						drecibo.fpago = '$f_pago' AND
						YEAR(f_pago_prima)=$anio AND
						nramo IN ".$ramoIn." AND
						t_cuenta  IN ".$tipo_cuentaIn." ";
		}//7
		if ($cia!='' && $tipo_cuenta=='' && $ramo!='') {
			// create sql part for IN condition by imploding comma after each id
			$ciaIn = "('" . implode("','", $cia) ."')";

			// create sql part for IN condition by imploding comma after each id
			$ramoIn = "('" . implode("','", $ramo) ."')";

			$sql="SELECT * FROM poliza 
						INNER JOIN dcia, drecibo, dramo, comision WHERE 
						poliza.id_cia=dcia.idcia AND
						poliza.id_poliza=drecibo.idrecibo AND 
						poliza.id_cod_ramo=dramo.cod_ramo AND
						poliza.id_poliza = comision.id_poliza AND 
						drecibo.fpago = '$f_pago' AND
						YEAR(f_pago_prima)=$anio AND
						nomcia IN ".$ciaIn." AND
						nramo IN ".$ramoIn."  ";
		}//8
		
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

	public function get_poliza_c_cobrada_f_pago_by_user($f_pago,$cia,$ramo,$anio,$tipo_cuenta,$asesor)
		{

		if ($cia!='' && $tipo_cuenta!='' && $ramo!='') {
			// create sql part for IN condition by imploding comma after each id
			$ciaIn = "('" . implode("','", $cia) ."')";

			// create sql part for IN condition by imploding comma after each id
			$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";

			// create sql part for IN condition by imploding comma after each id
			$ramoIn = "('" . implode("','", $ramo) ."')";

			$sql="SELECT * FROM poliza 
						INNER JOIN dcia, drecibo, dramo, comision WHERE 
						poliza.id_cia=dcia.idcia AND
						poliza.id_poliza=drecibo.idrecibo AND 
						poliza.id_cod_ramo=dramo.cod_ramo AND
						poliza.id_poliza = comision.id_poliza AND 
						drecibo.fpago = '$f_pago' AND
						poliza.codvend = '$asesor' AND
						YEAR(f_pago_prima)=$anio AND
						nomcia IN ".$ciaIn." AND
						nramo IN ".$ramoIn." AND
						t_cuenta  IN ".$tipo_cuentaIn." ";
		}//1
		if ($cia=='' && $tipo_cuenta=='' && $ramo=='') {
			$sql="SELECT * FROM poliza 
					INNER JOIN dcia, drecibo, dramo, comision WHERE 
					poliza.id_cia=dcia.idcia AND
					poliza.id_poliza=drecibo.idrecibo AND 
					poliza.id_cod_ramo=dramo.cod_ramo AND
					poliza.id_poliza = comision.id_poliza AND 
					poliza.codvend = '$asesor' AND
					drecibo.fpago = '$f_pago' AND
					YEAR(f_pago_prima)=$anio   ";
		}//2
		if ($cia!='' && $tipo_cuenta=='' && $ramo=='') {

			// create sql part for IN condition by imploding comma after each id
			$ciaIn = "('" . implode("','", $cia) ."')";

			$sql="SELECT * FROM poliza 
					INNER JOIN dcia, drecibo, dramo, comision WHERE 
					poliza.id_cia=dcia.idcia AND
					poliza.id_poliza=drecibo.idrecibo AND 
					poliza.id_cod_ramo=dramo.cod_ramo AND
					poliza.id_poliza = comision.id_poliza AND 
					poliza.codvend = '$asesor' AND
					drecibo.fpago = '$f_pago' AND
					YEAR(f_pago_prima)=$anio AND
					nomcia IN ".$ciaIn." ";
		}//3
		if ($cia=='' && $tipo_cuenta!='' && $ramo=='') {

			// create sql part for IN condition by imploding comma after each id
			$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";

			$sql="SELECT * FROM poliza 
					INNER JOIN dcia, drecibo, dramo, comision WHERE 
					poliza.id_cia=dcia.idcia AND
					poliza.id_poliza=drecibo.idrecibo AND 
					poliza.id_cod_ramo=dramo.cod_ramo AND
					poliza.id_poliza = comision.id_poliza AND 
					poliza.codvend = '$asesor' AND
					drecibo.fpago = '$f_pago' AND
					YEAR(f_pago_prima)=$anio AND
					t_cuenta  IN ".$tipo_cuentaIn." ";
		}//4
		if ($cia=='' && $tipo_cuenta=='' && $ramo!='') {

			// create sql part for IN condition by imploding comma after each id
			$ramoIn = "('" . implode("','", $ramo) ."')";

			$sql="SELECT * FROM poliza 
					INNER JOIN dcia, drecibo, dramo, comision WHERE 
					poliza.id_cia=dcia.idcia AND
					poliza.id_poliza=drecibo.idrecibo AND 
					poliza.id_cod_ramo=dramo.cod_ramo AND
					poliza.id_poliza = comision.id_poliza AND 
					poliza.codvend = '$asesor' AND
					drecibo.fpago = '$f_pago' AND
					YEAR(f_pago_prima)=$anio AND
					nramo IN ".$ramoIn."  ";
		}//5
		if ($cia!='' && $tipo_cuenta!='' && $ramo=='') {
			// create sql part for IN condition by imploding comma after each id
			$ciaIn = "('" . implode("','", $cia) ."')";

			// create sql part for IN condition by imploding comma after each id
			$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";

			$sql="SELECT * FROM poliza 
						INNER JOIN dcia, drecibo, dramo, comision WHERE 
						poliza.id_cia=dcia.idcia AND
						poliza.id_poliza=drecibo.idrecibo AND 
						poliza.id_cod_ramo=dramo.cod_ramo AND
						poliza.id_poliza = comision.id_poliza AND 
						poliza.codvend = '$asesor' AND
						drecibo.fpago = '$f_pago' AND
						YEAR(f_pago_prima)=$anio AND
						nomcia IN ".$ciaIn." AND
						t_cuenta  IN ".$tipo_cuentaIn." ";
		}//6
		if ($cia=='' && $tipo_cuenta!='' && $ramo!='') {
			// create sql part for IN condition by imploding comma after each id
			$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";

			// create sql part for IN condition by imploding comma after each id
			$ramoIn = "('" . implode("','", $ramo) ."')";

			$sql="SELECT * FROM poliza 
						INNER JOIN dcia, drecibo, dramo, comision WHERE 
						poliza.id_cia=dcia.idcia AND
						poliza.id_poliza=drecibo.idrecibo AND 
						poliza.id_cod_ramo=dramo.cod_ramo AND
						poliza.id_poliza = comision.id_poliza AND 
						poliza.codvend = '$asesor' AND
						drecibo.fpago = '$f_pago' AND
						YEAR(f_pago_prima)=$anio AND
						nramo IN ".$ramoIn." AND
						t_cuenta  IN ".$tipo_cuentaIn." ";
		}//7
		if ($cia!='' && $tipo_cuenta=='' && $ramo!='') {
			// create sql part for IN condition by imploding comma after each id
			$ciaIn = "('" . implode("','", $cia) ."')";

			// create sql part for IN condition by imploding comma after each id
			$ramoIn = "('" . implode("','", $ramo) ."')";

			$sql="SELECT * FROM poliza 
						INNER JOIN dcia, drecibo, dramo, comision WHERE 
						poliza.id_cia=dcia.idcia AND
						poliza.id_poliza=drecibo.idrecibo AND 
						poliza.id_cod_ramo=dramo.cod_ramo AND
						poliza.id_poliza = comision.id_poliza AND 
						poliza.codvend = '$asesor' AND
						drecibo.fpago = '$f_pago' AND
						YEAR(f_pago_prima)=$anio AND
						nomcia IN ".$ciaIn." AND
						nramo IN ".$ramoIn."  ";
		}//8
		
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

	public function get_poliza_c_cobrada_ejecutivo($ejecutivo,$cia,$ramo,$anio,$tipo_cuenta)
		{

		if ($cia!='' && $tipo_cuenta!='' && $ramo!='') {
			// create sql part for IN condition by imploding comma after each id
			$ciaIn = "('" . implode("','", $cia) ."')";

			// create sql part for IN condition by imploding comma after each id
			$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";

			// create sql part for IN condition by imploding comma after each id
			$ramoIn = "('" . implode("','", $ramo) ."')";

			$sql="SELECT * FROM poliza 
						INNER JOIN dcia, drecibo, dramo, comision WHERE 
						poliza.id_cia=dcia.idcia AND
						poliza.id_poliza=drecibo.idrecibo AND 
						poliza.id_cod_ramo=dramo.cod_ramo AND
						poliza.id_poliza = comision.id_poliza AND 
						comision.cod_vend = '$ejecutivo' AND
						YEAR(f_pago_prima)=$anio AND
						nomcia IN ".$ciaIn." AND
						nramo IN ".$ramoIn." AND
						t_cuenta  IN ".$tipo_cuentaIn." ";
		}//1
		if ($cia=='' && $tipo_cuenta=='' && $ramo=='') {
			$sql="SELECT * FROM poliza 
					INNER JOIN dcia, drecibo, dramo, comision WHERE 
					poliza.id_cia=dcia.idcia AND
					poliza.id_poliza=drecibo.idrecibo AND 
					poliza.id_cod_ramo=dramo.cod_ramo AND
					poliza.id_poliza = comision.id_poliza AND 
					comision.cod_vend = '$ejecutivo' AND
					YEAR(f_pago_prima)=$anio  ";
		}//2
		if ($cia!='' && $tipo_cuenta=='' && $ramo=='') {

			// create sql part for IN condition by imploding comma after each id
			$ciaIn = "('" . implode("','", $cia) ."')";

			$sql="SELECT * FROM poliza 
					INNER JOIN dcia, drecibo, dramo, comision WHERE 
					poliza.id_cia=dcia.idcia AND
					poliza.id_poliza=drecibo.idrecibo AND 
					poliza.id_cod_ramo=dramo.cod_ramo AND
					poliza.id_poliza = comision.id_poliza AND 
					comision.cod_vend = '$ejecutivo' AND
					YEAR(f_pago_prima)=$anio AND
					nomcia IN ".$ciaIn." ";
		}//3
		if ($cia=='' && $tipo_cuenta!='' && $ramo=='') {

			// create sql part for IN condition by imploding comma after each id
			$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";

			$sql="SELECT * FROM poliza 
					INNER JOIN dcia, drecibo, dramo, comision WHERE 
					poliza.id_cia=dcia.idcia AND
					poliza.id_poliza=drecibo.idrecibo AND 
					poliza.id_cod_ramo=dramo.cod_ramo AND
					poliza.id_poliza = comision.id_poliza AND 
					comision.cod_vend = '$ejecutivo' AND
					YEAR(f_pago_prima)=$anio AND
					t_cuenta  IN ".$tipo_cuentaIn." ";
		}//4
		if ($cia=='' && $tipo_cuenta=='' && $ramo!='') {

			// create sql part for IN condition by imploding comma after each id
			$ramoIn = "('" . implode("','", $ramo) ."')";

			$sql="SELECT * FROM poliza 
					INNER JOIN dcia, drecibo, dramo, comision WHERE 
					poliza.id_cia=dcia.idcia AND
					poliza.id_poliza=drecibo.idrecibo AND 
					poliza.id_cod_ramo=dramo.cod_ramo AND
					poliza.id_poliza = comision.id_poliza AND 
					comision.cod_vend = '$ejecutivo' AND
					YEAR(f_pago_prima)=$anio AND
					nramo IN ".$ramoIn."  ";
		}//5
		if ($cia!='' && $tipo_cuenta!='' && $ramo=='') {
			// create sql part for IN condition by imploding comma after each id
			$ciaIn = "('" . implode("','", $cia) ."')";

			// create sql part for IN condition by imploding comma after each id
			$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";

			$sql="SELECT * FROM poliza 
						INNER JOIN dcia, drecibo, dramo, comision WHERE 
						poliza.id_cia=dcia.idcia AND
						poliza.id_poliza=drecibo.idrecibo AND 
						poliza.id_cod_ramo=dramo.cod_ramo AND
						poliza.id_poliza = comision.id_poliza AND 
						comision.cod_vend = '$ejecutivo' AND
						YEAR(f_pago_prima)=$anio AND
						nomcia IN ".$ciaIn." AND
						t_cuenta  IN ".$tipo_cuentaIn." ";
		}//6
		if ($cia=='' && $tipo_cuenta!='' && $ramo!='') {
			// create sql part for IN condition by imploding comma after each id
			$tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) ."')";

			// create sql part for IN condition by imploding comma after each id
			$ramoIn = "('" . implode("','", $ramo) ."')";

			$sql="SELECT * FROM poliza 
						INNER JOIN dcia, drecibo, dramo, comision WHERE 
						poliza.id_cia=dcia.idcia AND
						poliza.id_poliza=drecibo.idrecibo AND 
						poliza.id_cod_ramo=dramo.cod_ramo AND
						poliza.id_poliza = comision.id_poliza AND 
						comision.cod_vend = '$ejecutivo' AND
						YEAR(f_pago_prima)=$anio AND
						nramo IN ".$ramoIn." AND
						t_cuenta  IN ".$tipo_cuentaIn." ";
		}//7
		if ($cia!='' && $tipo_cuenta=='' && $ramo!='') {
			// create sql part for IN condition by imploding comma after each id
			$ciaIn = "('" . implode("','", $cia) ."')";

			// create sql part for IN condition by imploding comma after each id
			$ramoIn = "('" . implode("','", $ramo) ."')";

			$sql="SELECT * FROM poliza 
						INNER JOIN dcia, drecibo, dramo, comision WHERE 
						poliza.id_cia=dcia.idcia AND
						poliza.id_poliza=drecibo.idrecibo AND 
						poliza.id_cod_ramo=dramo.cod_ramo AND
						poliza.id_poliza = comision.id_poliza AND 
						comision.cod_vend = '$ejecutivo' AND
						YEAR(f_pago_prima)=$anio AND
						nomcia IN ".$ciaIn." AND
						nramo IN ".$ramoIn."  ";
		}//8
		
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






	public function get_reporte_gc_h($id_gc_h,$cod_vend)
		    {
		    	

		      	$sql="SELECT * FROM poliza 
							INNER JOIN dcia, drecibo, dramo, comision, gc_h_comision, gc_h, titular, rep_com WHERE 
							poliza.id_cia=dcia.idcia AND
							poliza.id_poliza=drecibo.idrecibo AND 
							poliza.id_cod_ramo=dramo.cod_ramo AND
							poliza.id_poliza = comision.id_poliza AND 
                            gc_h_comision.id_comision=comision.id_comision AND
                            gc_h_comision.id_gc_h=gc_h.id_gc_h AND
                            poliza.id_titular=titular.id_titular AND
                            rep_com.id_rep_com=comision.id_rep_com AND
							gc_h.id_gc_h = '$id_gc_h' AND
							cod_vend = '$cod_vend' 
							ORDER BY poliza.cod_poliza ASC";
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


	public function get_a_reporte_gc_h($id_gc_h)
		    {
		    	

		      	$sql="SELECT DISTINCT comision.cod_vend FROM poliza 
							INNER JOIN dcia, drecibo, dramo, comision, gc_h_comision, gc_h WHERE 
							poliza.id_cia=dcia.idcia AND
							poliza.id_poliza=drecibo.idrecibo AND 
							poliza.id_cod_ramo=dramo.cod_ramo AND
							poliza.id_poliza = comision.id_poliza AND 
                            gc_h_comision.id_comision=comision.id_comision AND
                            gc_h_comision.id_gc_h=gc_h.id_gc_h AND
							gc_h.id_gc_h = '$id_gc_h' ";
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
									num_cuenta,email,cel,obs,pre1,gc_viajes,nopre1)
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


	public function agregarCliente($datos){
			if ($datos[0]=="") {
				exit;
			}
			if ($datos[10]=="") {
				exit;
			}
			
			
			$f_nac=$datos[9];
			if ($f_nac=="") {
				$f_nac='1900-01-01';
			}else {
				$f_nac = date("Y-m-d", strtotime($f_nac));
			}

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
											'1',
											'1',
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
									$codvend,$id_cod_ramo,$id_cia,$id_titular,$id_tomador,$asesor_ind,$t_cuenta,$id_usuario,$obs){


			$sql="INSERT into poliza (cod_poliza,f_poliza, f_emi, tcobertura, f_desdepoliza,
										f_hastapoliza, currency, id_tpoliza, sumaasegurada, id_zproduccion, codvend,
										id_cod_ramo, id_cia, id_titular, id_tomador, per_gc, t_cuenta, id_usuario, obs_p)
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
											'$t_cuenta',
											'$id_usuario',
											'$obs')";
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
										id_cod_ramo, id_cia, id_titular, id_tomador, per_gc, t_cuenta, id_usuario)
									values ('$datos[0]',
											'$datos[2]',
											'$datos[2]',
											'N/A',
											'$datos[2]',
											'$datos[5]',
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
											'1',
											'$datos[4]')";
		return mysqli_query(Conectar::con(),$sql);
		
	}

	public function agregarPrePolizaE($datos){

		$sql="INSERT into poliza (cod_poliza,f_poliza, f_emi, tcobertura, f_desdepoliza,
										f_hastapoliza, currency, id_tpoliza, sumaasegurada, id_zproduccion, codvend,
										id_cod_ramo, id_cia, id_titular, id_tomador, per_gc, t_cuenta, id_usuario)
									values ('$datos[0]',
											'$datos[2]',
											'$datos[2]',
											'$datos[6]',
											'$datos[14]',
											'$datos[5]',
											'$datos[7]',
											'$datos[8]',
											'$datos[9]',
											'$datos[3]',
											'$datos[10]',
											'$datos[11]',
											'$datos[1]',
											'0',
											'0',
											'$datos[12]',
											'$datos[13]',
											'$datos[4]')";
		return mysqli_query(Conectar::con(),$sql);
		
	}

	public function agregarAsegurado($asegurado,$id_poliza){

			$sql="INSERT into titular_pre_poliza (asegurado,id_poliza)
				values ('$asegurado',
						'$id_poliza')";
			return mysqli_query(Conectar::con(),$sql);

	}

	public function agregarCiaPref($id_cia,$fdesdeP,$fhastaP,$codvend,
											$per_gc){


								$sql="INSERT into cia_pref (id_cia,f_desde_pref,f_hasta_pref,cod_vend,
									per_gc_sum)
									values ('$id_cia',
											'$fdesdeP',
											'$fhastaP',
											'$codvend',
											'$per_gc')";
								return mysqli_query(Conectar::con(),$sql);

	}



	public function agregarGCh($fhoy,$desde,$hasta){


								$sql="INSERT into gc_h (f_hoy_h,f_desde_h,f_hasta_h)
									values ('$fhoy',
											'$desde',
											'$hasta')";
								return mysqli_query(Conectar::con(),$sql);

	}

public function agregarGChComision($id_gc_h,$id_comision){


		$sql="INSERT into gc_h_comision (id_gc_h,id_comision)
			values ('$id_gc_h',
					'$id_comision')";
		return mysqli_query(Conectar::con(),$sql);

}


public function agregarCia($nombre_cia,$rif){


	$sql="INSERT into dcia (nomcia,preferencial,f_desde_pref,f_hasta_pref,rif)
		values ('$nombre_cia',
				'0',
				'0000-00-00',
				'0000-00-00',
				'$rif')";
	return mysqli_query(Conectar::con(),$sql);

}

public function agregarContactoCia($id_cia,$nombre,$cargo,$tel,$cel,$email){


	$sql="INSERT into contacto_cia (id_cia,nombre,cargo,tel,cel,email)
		values ('$id_cia',
				'$nombre',
				'$cargo',
				'$tel',
				'$cel',
				'$email')";
	return mysqli_query(Conectar::con(),$sql);

}


public function agregarUsuario($nombre,$apellido,$ci,$zprod,$seudonimo,$clave,$id_permiso,$asesor){


	$sql="INSERT into usuarios (nombre_usuario,cedula_usuario,clave_usuario,id_permiso,apellido_usuario,seudonimo,z_produccion,cod_vend)
		values ('$nombre',
				'$ci',
				'$clave',
				'$id_permiso',
				'$apellido',
				'$seudonimo',
				'$zprod',
				'$asesor')";
	return mysqli_query(Conectar::con(),$sql);

}

public function agregarEditP($id_poliza,$campos,$usuario){


	$sql="INSERT into poliza_ed (id_poliza,campos_ed,usuario)
		values ('$id_poliza',
				'$campos',
				'$usuario')";
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
							ci, currency, idnom, nombre_t, apellido_t, placa, tveh, marca, mveh, f_veh, serial, cveh, catveh, id_poliza, t_cuenta, poliza.cod_poliza, prima  FROM 
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
							ci, poliza.currency, nombre AS idnom, nombre_t, apellido_t, placa, tveh, marca, mveh, f_veh, serial, cveh, catveh, id_poliza, t_cuenta, poliza.cod_poliza, prima  FROM 
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
		                    ORDER BY poliza.f_poliza DESC";
						$result1=mysqli_query(Conectar::con(),$sql1);

						if (!$result1) {
						    //echo "nada";
						}else{
							$filas1=mysqli_num_rows($result1); 
							if ($filas1 == 0) { 
								
								$sql2="SELECT  f_emi, f_desdepoliza, f_hastapoliza, id_cod_ramo, id_cia, tcobertura,
									poliza.id_titular, id_tomador, f_desderecibo, f_hastarecibo, codvend, 
									ci, poliza.currency, nombre AS idnom, nombre_t, apellido_t, placa, tveh, marca, mveh, f_veh, serial, cveh, catveh, id_poliza, t_cuenta, poliza.cod_poliza, prima  FROM 
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
				                    ORDER BY poliza.f_poliza DESC";
								$result2=mysqli_query(Conectar::con(),$sql2);

								if (!$result2) {
								    //nada
								}else{
									$filas2=mysqli_num_rows($result2); 
									if ($filas2 == 0) { 
										//exit();
									}else{
										while($row2 = mysqli_fetch_assoc($result2)){
											$datos2[] = array_map('utf8_encode', $row2);
										}
										return $datos2;
									}


									

								}

								
					      	}else{

								while($row1 = mysqli_fetch_assoc($result1)){
									$datos1[] = array_map('utf8_encode', $row1);
								}
								return $datos1;

								}	
						}
			      	}else{

						while($row = mysqli_fetch_assoc($result)){
						    $datos[] = array_map('utf8_encode', $row);
						}
						return $datos;

						}
			}		
		}


		public function obtenPolizaE($id){

			$sql="SELECT f_emi, f_desdepoliza, f_hastapoliza, id_cod_ramo, id_cia, tcobertura,
							poliza.id_titular, id_tomador, f_desderecibo, f_hastarecibo, codvend, 
							ci, currency, idnom, nombre_t, apellido_t, placa, tveh, marca, mveh, f_veh, serial, cveh, catveh, id_poliza, t_cuenta, poliza.cod_poliza, prima, dcia.nomcia  FROM 
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
                  	poliza.cod_poliza LIKE '%$id%'
					ORDER BY poliza.f_hastapoliza DESC, nombre_t ASC";
			$result=mysqli_query(Conectar::con(),$sql);
			if (!$result) {
				    //echo "nada";
				}else{
					$filas=mysqli_num_rows($result); 
					if ($filas == 0) { 
						
						$sql1="SELECT f_emi, f_desdepoliza, f_hastapoliza, id_cod_ramo, id_cia, tcobertura,
							poliza.id_titular, id_tomador, f_desderecibo, f_hastarecibo, codvend, 
							ci, poliza.currency, nombre AS idnom, nombre_t, apellido_t, placa, tveh, marca, mveh, f_veh, serial, cveh, catveh, id_poliza, t_cuenta, poliza.cod_poliza, prima  FROM 
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
		                  	poliza.cod_poliza LIKE '%$id%'
		                    ORDER BY poliza.f_poliza DESC";
						$result1=mysqli_query(Conectar::con(),$sql1);

						if (!$result1) {
						    //echo "nada";
						}else{
							$filas1=mysqli_num_rows($result1); 
							if ($filas1 == 0) { 
								
								$sql2="SELECT  f_emi, f_desdepoliza, f_hastapoliza, id_cod_ramo, id_cia, tcobertura,
									poliza.id_titular, id_tomador, f_desderecibo, f_hastarecibo, codvend, 
									ci, poliza.currency, nombre AS idnom, nombre_t, apellido_t, placa, tveh, marca, mveh, f_veh, serial, cveh, catveh, id_poliza, t_cuenta, poliza.cod_poliza, prima  FROM 
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
				                  	poliza.cod_poliza LIKE '%$id%'
				                    ORDER BY poliza.f_poliza DESC";
								$result2=mysqli_query(Conectar::con(),$sql2);

								if (!$result2) {
								    //nada
								}else{
									$filas2=mysqli_num_rows($result2); 
									if ($filas2 == 0) { 
										//exit();
									}else{
										while($row2 = mysqli_fetch_assoc($result2)){
											$datos2[] = array_map('utf8_encode', $row2);
										}
										return $datos2;
									}


									

								}

								
					      	}else{

								while($row1 = mysqli_fetch_assoc($result1)){
									$datos1[] = array_map('utf8_encode', $row1);
								}
								return $datos1;

								}	
						}
			      	}else{

						while($row = mysqli_fetch_assoc($result)){
						    $datos[] = array_map('utf8_encode', $row);
						}
						return $datos;

						}
			}		
		}

	
		public function obtenPoliza_id($id){

			$sql="SELECT f_emi, f_desdepoliza, f_hastapoliza, id_cod_ramo, id_cia, tcobertura,
							poliza.id_titular, id_tomador, f_desderecibo, f_hastarecibo, codvend, 
							ci, currency, idnom, nombre_t, apellido_t, placa, tveh, marca, mveh, f_veh, serial, cveh, catveh, id_poliza, t_cuenta, poliza.cod_poliza  FROM 
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
                  	poliza.id_poliza = $id
                    ORDER BY poliza.f_poliza DESC";
			$result=mysqli_query(Conectar::con(),$sql);
			if (!$result) {
				    //echo "nada";
				}else{
					$filas=mysqli_num_rows($result); 
					if ($filas == 0) { 
						
						$sql1="SELECT f_emi, f_desdepoliza, f_hastapoliza, id_cod_ramo, id_cia, tcobertura,
							poliza.id_titular, id_tomador, f_desderecibo, f_hastarecibo, codvend, 
							ci, poliza.currency, nombre AS idnom, nombre_t, apellido_t, placa, tveh, marca, mveh, f_veh, serial, cveh, catveh, id_poliza, t_cuenta, poliza.cod_poliza  FROM 
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
		                  	poliza.id_poliza = $id
		                    ORDER BY poliza.f_poliza DESC";
						$result1=mysqli_query(Conectar::con(),$sql1);

						if (!$result1) {
						    //echo "nada";
						}else{
							$filas1=mysqli_num_rows($result1); 
							if ($filas1 == 0) { 
								
								$sql2="SELECT  f_emi, f_desdepoliza, f_hastapoliza, id_cod_ramo, id_cia, tcobertura,
									poliza.id_titular, id_tomador, f_desderecibo, f_hastarecibo, codvend, 
									ci, poliza.currency, nombre AS idnom, nombre_t, apellido_t, placa, tveh, marca, mveh, f_veh, serial, cveh, catveh, id_poliza, t_cuenta, poliza.cod_poliza  FROM 
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
				                  	poliza.id_poliza = $id
				                    ORDER BY poliza.f_poliza DESC";
								$result2=mysqli_query(Conectar::con(),$sql2);

								while($row2 = mysqli_fetch_assoc($result2)){
									$datos2[] = array_map('utf8_encode', $row2);
								}
								return $datos2;

								
					      	}else{
								while($row1 = mysqli_fetch_assoc($result1)){
									$datos1[] = array_map('utf8_encode', $row1);
								}
								return $datos1;
				               		
								}	
						}
			      	}else{
						while($row = mysqli_fetch_assoc($result)){
						    $datos[] = array_map('utf8_encode', $row);
						}
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

	
	public function obtenSumaReporte($id_rep_com){

		$sql="SELECT SUM(prima_com), SUM(comt) FROM rep_com, comision
				WHERE 
				rep_com.id_rep_com=comision.id_rep_com AND
				comision.id_rep_com= '$id_rep_com'";

		$result=mysqli_query(Conectar::con(),$sql);
		$ver=mysqli_fetch_row($result);
		
		$datos1=array(
			'SUM(prima_com)' => $ver[0],
			'SUM(comt)' => $ver[1]
			);
		return $datos1;	
	}


	
	public function obetnComisiones($id){

		$sql="SELECT SUM(prima_com), SUM(comision) FROM comision 
			INNER JOIN rep_com, poliza
			WHERE 
			comision.id_rep_com = rep_com.id_rep_com AND
			poliza.id_poliza = comision.id_poliza AND
			comision.id_poliza = $id";
		$result=mysqli_query(Conectar::con(),$sql);

		if (!$result) {
				//echo "nada";
		}else{
			$filas=mysqli_num_rows($result); 
			if ($filas == 0) { 
			//no hay registro
			}else{
				while($row = mysqli_fetch_assoc($result)){
					$datos[] = array_map('utf8_encode', $row);
				}
				return $datos;	
			}
		}		
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

	public function editarPoliza($id_poliza,$n_poliza,$fhoy,$t_cobertura,$fdesdeP,$fhastaP,$currency,$tipo_poliza,$sumaA,$z_produc,$codasesor,$ramo,$cia,$idtitular,$idtomador,$asesor_ind,$t_cuenta,$obs_p){


		$sql="UPDATE poliza set cod_poliza='$n_poliza',
								f_poliza='$fhoy',
								f_emi='$fhoy',
								tcobertura='$t_cobertura',
								f_desdepoliza='$fdesdeP',
								f_hastapoliza='$fhastaP',
								currency='$currency',
								id_tpoliza='$tipo_poliza',
								sumaasegurada='$sumaA',
								id_zproduccion='$z_produc',
								codvend='$codasesor',
								id_cod_ramo='$ramo',
								id_cia='$cia',
								id_titular='$idtitular',
								id_tomador='$idtomador',
								per_gc='$asesor_ind',
								t_cuenta='$t_cuenta',
								obs_p='$obs_p'

					where id_poliza= '$id_poliza'";
		return mysqli_query(Conectar::con(),$sql);
	}


	public function editarRecibo($id_poliza,$n_recibo,$fdesde_recibo,$fhasta_recibo,$prima,$f_pago,$n_cuotas,$monto_cuotas,$idtomador,$idtitular,$n_poliza){


		$sql="UPDATE drecibo set cod_recibo='$n_recibo',
								f_desderecibo='$fdesde_recibo',
								f_hastarecibo='$fhasta_recibo',
								prima='$prima',
								fpago='$f_pago',
								ncuotas='$n_cuotas',
								montocuotas='$monto_cuotas',
								idtom='$idtomador',
								idtitu='$idtitular',
								cod_poliza='$n_poliza'

					where idrecibo= '$id_poliza'";
		return mysqli_query(Conectar::con(),$sql);
	}


	public function editarVehiculo($id_poliza,$placa,$tipo,$marca,$modelo,$anio,$serial,$color,$categoria,$n_recibo){


		$sql="UPDATE dveh set placa='$placa',
								tveh='$tipo',
								marca='$marca',
								mveh='$modelo',
								f_veh='$anio',
								serial='$serial',
								cveh='$color',
								catveh='$categoria',
								cod_recibo='$n_recibo'

					where idveh= '$id_poliza'";
		return mysqli_query(Conectar::con(),$sql);
	}


	public function editarCia($id_cia,$nombre_cia,$rif){


		$sql="UPDATE dcia set nomcia='$nombre_cia',
								rif='$rif'

					where idcia= '$id_cia'";
		return mysqli_query(Conectar::con(),$sql);
	}

	public function editarCiaContacto($id_cia,$nombre_cia,$rif){


		$sql="UPDATE contacto_cia set nomcia='$nombre_cia',
									  rif='$rif'

					where id_cia= '$id_cia'";
		return mysqli_query(Conectar::con(),$sql);
	}

	public function editarCliente($id_titular,$nombre,$apellido,$ci,$f_nac,$cel,$telf,$email,$direcc){


		$sql="UPDATE titular set 	nombre_t='$nombre',
								 	apellido_t='$apellido',
									ci='$ci',
									cell='$cel',
									telf='$telf',
									f_nac='$f_nac',
									direcc='$direcc',
									email='$email'

					where id_titular= '$id_titular'";
		return mysqli_query(Conectar::con(),$sql);
	}


	public function editarRepCom($id_rep_com,$f_rep_1,$f_pago_1,$primat_com,$comt){


		$sql="UPDATE rep_com set 	f_hasta_rep='$f_rep_1',
								 	f_pago_gc='$f_pago_1',
									primat_com='$primat_com',
									comt='$comt'

					where id_rep_com= '$id_rep_com'";
		return mysqli_query(Conectar::con(),$sql);
	}

	public function editarAsesor($id_asesor,$a,$id,$nombre,$cel,$email,$banco,$tipo_cuenta,$num_cuenta,$obs,$act){

		if ($a==1) {
			$sql="UPDATE ena set 	id='$id',
								 	idnom='$nombre',
									cel='$cel',
								 	email='$email',
									banco='$banco',
									tipo_cuenta='$tipo_cuenta',
									num_cuenta='$num_cuenta',
									obs='$obs',
									act='$act'

					where idena= '$id_asesor'";
			return mysqli_query(Conectar::con(),$sql);
		}

		if ($a==2) {
			$sql="UPDATE enp set 	id='$id',
								 	nombre='$nombre',
									cel='$cel',
								 	email='$email',
									banco='$banco',
									tipo_cuenta='$tipo_cuenta',
									num_cuenta='$num_cuenta',
									obs='$obs',
									act='$act'

					where id_enp= '$id_asesor'";
			return mysqli_query(Conectar::con(),$sql);
		}

		if ($a==3) {
			$sql="UPDATE enr set 	id='$id',
								 	nombre='$nombre',
									cel='$cel',
								 	email='$email',
									banco='$banco',
									tipo_cuenta='$tipo_cuenta',
									num_cuenta='$num_cuenta',
									obs='$obs',
									act='$act'

					where id_enr= '$id_asesor'";
			return mysqli_query(Conectar::con(),$sql);
		}

		
	}

	public function editarAsesorA($id_asesor,$id,$nombre,$cel,$email,$banco,$tipo_cuenta,$num_cuenta,$obs,$act,$nopre1,$gc_viajes){

			$sql="UPDATE ena set 	id='$id',
								 	idnom='$nombre',
									cel='$cel',
								 	email='$email',
									banco='$banco',
									tipo_cuenta='$tipo_cuenta',
									num_cuenta='$num_cuenta',
									obs='$obs',
									act='$act',
									nopre1='$nopre1',
									gc_viajes='$gc_viajes'

					where idena= '$id_asesor'";
			return mysqli_query(Conectar::con(),$sql);	
	}


	public function editarUsuario($id_usuario,$nombre,$apellido,$ci,$zprod,$seudonimo,$clave,$id_permiso,$asesor,$activo){


		$sql="UPDATE usuarios set 	nombre_usuario='$nombre',
								 	cedula_usuario='$ci',
									clave_usuario='$clave',
									id_permiso='$id_permiso',
									apellido_usuario='$apellido',
									seudonimo='$seudonimo',
									z_produccion='$zprod',
									cod_vend='$asesor',
									activo='$activo'


					where id_usuario= '$id_usuario'";
		return mysqli_query(Conectar::con(),$sql);
	}

	public function editarAsesorCom($id_poliza,$codasesor){


		$sql="UPDATE comision set 	cod_vend='$codasesor'

					where id_poliza= '$id_poliza'";
		return mysqli_query(Conectar::con(),$sql);
	}



//-------------------------------------------------------------------	

//------------------------------ELIMINAR-------------------------------------

		public function eliminarAsesor($id,$a){
			if ($a==1) {
				$sql="DELETE from ena where idena='$id'";
				return mysqli_query(Conectar::con(),$sql);
			}
			if ($a==2) {
				$sql="DELETE from enp where id_enp='$id'";
				return mysqli_query(Conectar::con(),$sql);
			}
			if ($a==3) {
				$sql="DELETE from enr where id_enr='$id'";
				return mysqli_query(Conectar::con(),$sql);
			}
			
		}

		public function eliminarPoliza($id){

			$sql1="DELETE from drecibo where idrecibo='$id'";
			mysqli_query(Conectar::con(),$sql1);

			$sql2="DELETE from dveh where idveh='$id'";
			mysqli_query(Conectar::con(),$sql2);

			$sql="DELETE from poliza where id_poliza='$id'";
			return mysqli_query(Conectar::con(),$sql);
		}

		public function eliminarCiaContacto($id_cia){

			$sql="DELETE from contacto_cia where id_cia='$id_cia'";
			return mysqli_query(Conectar::con(),$sql);
		}

		public function eliminarUsuario($id){

			$sql="DELETE from usuarios where id_usuario='$id'";
			return mysqli_query(Conectar::con(),$sql);
		}


		public function eliminarRepCom($id){

			$sql2="DELETE from comision where id_rep_com='$id'";
			mysqli_query(Conectar::con(),$sql2);

			$sql="DELETE from rep_com where id_rep_com='$id'";
			return mysqli_query(Conectar::con(),$sql);
		}

		public function eliminarComision($id){

			$sql2="DELETE from comision where id_comision='$id'";
			return mysqli_query(Conectar::con(),$sql2);

		}
	
		
	
	function destruir(){

		mysqli_close(Conectar::con());
	}	


	public function p1()
        {
                $sql="SELECT DISTINCT comision.id_poliza FROM comision, poliza, drecibo WHERE 
                        poliza.id_poliza = drecibo.idrecibo AND
                        poliza.id_poliza=comision.id_poliza
                        ORDER BY id_poliza ASC";
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

    public function p2($id_poliza)
        {
                $sql="SELECT * FROM comision 
                    INNER JOIN drecibo, poliza, ena, titular, dramo
                    WHERE 
                    poliza.id_poliza=drecibo.idrecibo AND
                    poliza.id_poliza = comision.id_poliza AND
                    poliza.codvend = ena.cod AND
                    poliza.id_titular = titular.id_titular AND
                    poliza.id_cod_ramo = dramo.cod_ramo AND
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
	
}
?>