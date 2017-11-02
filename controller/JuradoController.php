<?php 

require_once './view/Jurado.php';
require_once './model/JuradoModel.php';

if (!isset($_SESSION)){
	session_start();
}

class JuradoController{

	private static $instance;

	public static function getInstance(){
		if(!isset(self::$instance)){
			self::$instance = new self();
		}
		return self::$instance;
	}

	private function __construct(){

	}

	public function juradoView($datos){
		$view = new Jurado();
		$view->show($datos);
	}

	public function proyectosView($user)
	{
		$proyectos = JuradoModel::getInstance()->getProyectos();
		$view = new Jurado();
		$estadoVoto = JuradoModel::getInstance()->getEstadoVoto($user);
		$voto = $estadoVoto['voto'];
		$datos = array('usuario' => $user, 'estadoVoto' => $voto, 'proyectos' => $proyectos );
		$view->showProyectos($datos);
	}

	public function votar($datos){
		//   Sumar voto
		JuradoModel::getInstance()->sumarVoto($datos["voto"]);
		JuradoModel::getInstance()->yaVoto($_SESSION['idUser']);
		$datos['mensaje'] = "Gracias por votar!";		
		$this->juradoView($datos);
	}

}
