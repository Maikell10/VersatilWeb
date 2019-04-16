<?php
class Conectar{

	protected function con() {

		$hostname="127.0.0.1";
		$username="root";
		$password="";
		$dbname="versatil_sdb";
		
		$con=mysqli_connect($hostname,$username, $password, $dbname) or die ("No se Conecta");
		

		//$cadena="host='127.0.0.1' port='3306' dbname='valuation_bac' user='root' password=''";
		//$con= mysql_connect($cadena) or die('Error de conexion. Contacte con su administrador ');
		return $con;
	}
	
}	

class Trabajo extends Conectar{
		
	private $t;
	private $art;
	protected $nom;
	protected $numdesp;
   protected $oficdest;
	protected $oficorig;
	protected $cantenv; 
	protected $pesoenv;
	protected $idlinea;	
	private $dbh;
   private $n;
	
	public function __construct() {
		$this->t= array();
		$this->numdesp;
		$this->oficdest;
		$this->oficorig;
		$this->cantenv;
		$this->pesoenv;
		$this->idlinea;
		
      $this->n=array();
	}

	public function get_usuario($seudonimo)
		    {
		      $sql="select * from usuarios where seudonimo= '$seudonimo'";
				$res=mysqli_query(Conectar::con(),$sql);
				
				$filas=mysqli_num_rows($res); 
				if ($filas == 0) { 
		      	header("Location: incorrecto.php?m=2");
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
	
	
	function destruir(){

		mysql_close($this->con);
	}	
	
}
?>