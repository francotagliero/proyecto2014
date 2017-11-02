<?php 
require_once('TwigView.php');

class Login extends TwigView{

	public function show($msj){
		echo self::getTwig()->render('login_twig.html', array('mensaje' => $msj ));
	}
}

 ?>