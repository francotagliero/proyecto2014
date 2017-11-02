<?php 

class VisitanteModel{

	private static $instance;

	public static function getInstance(){
		if(!isset(self::$instance)){
			self::$instance = new self();
		}
		return self::$instance;
	}

	private function __construct(){

	}

	function getEstadoVotaciones(){
		$model = new PDOConnection();
		$connection = $model->getConnection();
		$query = "SELECT votacionActivada FROM configuracion ";
		$stmt = $connection->prepare($query);
		$stmt->execute();
		return ($stmt->fetch()[0]);
	}

	function getProyectosGanadores(){
		$model = new PDOConnection();
		$connection = $model->getConnection();
		$query = "SELECT * FROM proyecto GROUP BY idProyecto,title,author,thematic,votos ORDER BY votos DESC LIMIT 3;";
		$stmt = $connection->prepare($query);
		$stmt->execute();
		return ($stmt->fetchAll());
	}

}

?>