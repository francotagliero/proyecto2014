<?php 

require_once 'PDOConnection.php';


class AdminModel{
	private static $instance;

	public static function getInstance(){
		if(!isset(self::$instance)){
			self::$instance = new self();
		}
		return self::$instance;
	}

	private function __construct(){

	}

	function cerrarVotaciones(){
		$model = new PDOConnection();
		$connection = $model->getConnection();
		$query = "UPDATE configuracion SET votacionActivada = 0 ";
		$stmt = $connection->prepare($query);
		$stmt->execute();
		return ($stmt);
	}

	function abrirVotaciones(){
		$model = new PDOConnection();
		$connection = $model->getConnection();
		$query = "UPDATE configuracion SET votacionActivada = 1 ";
		$stmt = $connection->prepare($query);
		$stmt->execute();
		return ($stmt);
	}

	function getEstadoVotaciones(){
		$model = new PDOConnection();
		$connection = $model->getConnection();
		$query = "SELECT * FROM configuracion";
		$stmt = $connection->prepare($query);
		$stmt->execute();
		return ($stmt->fetch()[0]);

	}

}