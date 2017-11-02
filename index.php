<?php

require_once('controller/AdminController.php');
require_once('controller/JuradoController.php');
require_once('controller/LoginController.php');
require_once('controller/VisitanteController.php');
require_once('model/AdminModel.php');
require_once('model/JuradoModel.php');
require_once('view/Login.php');
require_once('view/TwigView.php');
if (!isset($_SESSION)){
	session_start();
}


if(isset($_GET["action"]) ){
	switch ($_GET["action"]) {
		case 'login':
			$mensaje = "ingrese sus credenciales";
			LoginController::getInstance()->viewLogin($mensaje);
			break;
		case 'loginVerify':
			//chequeo que el usuario y contraseña que llegó del formulario login no esten vacios
			if( (isset($_POST['username']) && ($_POST['username'] != "")) && (isset($_POST['passw']) && ($_POST['passw'] != ""))  ){
				//sanitizo los datos para evitar sql injection 
				$user = htmlentities($_POST['username']);
				$passw = htmlentities($_POST['passw']);
				LoginController::getInstance()->loginVerify($user, $passw);
			}
			else{
				LoginController::getInstance()->viewLogin("Valores incorrectos");
			}
			break;
		case 'cerrarVotaciones':
			// SOLO EL ADMINISTRADOR PUEDE CERRRAR LAS VOTACIONES
			if (isset($_SESSION['username'])){
				if($_SESSION['isAdmin'][0] == 1){
				AdminController::getInstance()->cerrarVotaciones();
				}else{
					JuradoController::getInstance()->juradoView($_SESSION['username'].": No tienes permiso para esta accion ");
				}
			}else{
				VisitanteController::getInstance()->viewVisitante();
			}
			break;
		case 'abrirVotaciones':
			// SOLO EL ADMINISTRADOR PUEDE CERRRAR LAS VOTACIONES
			if (isset($_SESSION['username'])){
				if($_SESSION['isAdmin'][0] == 1){
					AdminController::getInstance()->abrirVotaciones();
				}else{
					$datos = array();
					$datos['nombre'] = $_SESSION['username'];
					$datos['permiso'] = "no tienes permiso para esta acción";
					JuradoController::getInstance()->juradoView($datos);
				}
			}else{
				VisitanteController::getInstance()->viewVisitante();
			}
			break;
		case 'listarProyectos':
			//SOLO EL JURADO PUEDE VER PROYECTOS
			if (isset($_SESSION['username'])){
				if($_SESSION['isAdmin'][0] == 0){
					JuradoController::getInstance()->proyectosView($_SESSION['username']);					
				}
				else{
				$datos = array();
				$datos['mensaje'] = $_SESSION['username'];
				$datos['permiso'] = "no tienes permiso para esta acción";	
				AdminController::getInstance()->adminView($datos);
				}
			}else{
				VisitanteController::getInstance()->viewVisitante();

			}
		case 'votar':
			if(isset($_SESSION)){
				if($_SESSION['isAdmin'][0] == 0 ){
					if(isset($_POST['submit'])){
						$dato = array();
						$dato['voto'] = $_POST['voto'];
						JuradoController::getInstance()->votar($dato);	
					}
				}
			}
			break;
		default:
			break;
	}
}
else{
	VisitanteController::getInstance()->viewVisitante();
}

?>