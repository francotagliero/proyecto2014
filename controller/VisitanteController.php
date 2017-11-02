<?php

require_once('./view/Visitante.php');
require_once('./model/VisitanteModel.php');

if (!isset($_SESSION)){
	session_start();
}

class VisitanteController{
	private static $instance;

	public static function getInstance(){
		if(!isset(self::$instance)){
			self::$instance = new self();
		}
		return self::$instance;
	}

	private function __construct(){

	}

	public function viewVisitante(){
		$datos = array();
		$estadoVotacion = VisitanteModel::getInstance()->getEstadoVotaciones();
		if ($estadoVotacion == 0 ){
			$proyectos = VisitanteModel::getInstance()->getProyectosGanadores();
			$datos['proyectos'] = $proyectos;
			$datos['estadoVotacion'] = "0";
			$datos['mensaje'] = "La votación ha terminado";
		}
		else{
			$datos['estadoVotacion'] = "1";
		}
		$view = new Visitante();
		$view->show($datos);
	}
}

?>