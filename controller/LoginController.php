<?php 

if (!isset($_SESSION)){
	session_start();
}

class LoginController{
	private static $instance;

	public static function getInstance(){
		if(!isset(self::$instance)){
			self::$instance = new self();
		}
		return self::$instance;
	}

	private function __construct(){

	}

	public function viewLogin($mensaje){
		$view = new Login();
		$view->show($mensaje);
	}

	public function loginVerify($user, $passw){
		// 
		if(juradoModel::getInstance()->userVerify($user,$passw)){
			$_SESSION['isAdmin'] = juradoModel::getInstance()->isAdmin($user);
			$_SESSION['username'] = $user;
			$_SESSION['password'] = $passw;
			$_SESSION['idUser'] = juradoModel::getInstance()->getIdUser($user);
			$datos = array();
			if ($_SESSION['isAdmin'][0] == 1){
				$datos['mensaje'] = $_SESSION['username'];
				AdminController::getInstance()->adminView($datos);
			}else{
				$datos['mensaje'] = $_SESSION['username'];
				JuradoController::getInstance()->juradoView($datos);
			}
		}
		else{
			// no lleno correctamente los inputs del form login
			$mensaje = "usuario o contraseña incorrecta";
			$this->viewLogin($mensaje);
		}
	}
}


 ?>