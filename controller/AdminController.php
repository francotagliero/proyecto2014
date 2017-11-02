<?php 

require_once('./view/Admin.php');

if (!isset($_SESSION)){
	session_start();
}

class AdminController{
	private static $instance;

	public static function getInstance(){
		if(!isset(self::$instance)){
			self::$instance = new self();
		}
		return self::$instance;
	}

	private function __construct(){

	}

	function adminView($datos){
		$estadoVotaciones = AdminModel::getInstance()->getEstadoVotaciones();
		$datos['estadoVotaciones'] = $estadoVotaciones;
		$view = new Admin();
		$view->show($datos);
	}

	function cerrarVotaciones(){
		if ( isset($_SESSION['username'])){
		 if ($_SESSION['isAdmin'][0] == 1){
			AdminModel::getInstance()->cerrarVotaciones();
			$datos = array('mensaje' => $_SESSION['username'] );
			$this->adminView($datos);
		}else{
			JuradoController::getInstance()->juradoView($_SESSION['username'].": No tienes permiso para esta accion ");
		}
	}
		else{
			
			}
		}

	function abrirVotaciones(){
		if ( isset($_SESSION['username'])){
		 if ($_SESSION['isAdmin'][0] == 1){
			AdminModel::getInstance()->abrirVotaciones();
			$datos = array();
			$datos['mensaje'] = $_SESSION['username']; 
			$this->adminView($datos);
		}else{
			JuradoController::getInstance()->juradoView($_SESSION['username'].": No tienes permiso para esta accion ");
		}
	}
		else{
			
			}
		}
}