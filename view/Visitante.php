<?php 
require_once('TwigView.php');

class Visitante extends TwigView{

	public function show($datos){
		echo self::getTwig()->render('visitante_twig.html', $datos);
	}
}

 ?>