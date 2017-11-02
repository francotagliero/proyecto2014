<?php 
require_once('TwigView.php');

class Admin extends TwigView{

	public function show($datos){
		echo self::getTwig()->render('adminView_twig.html', $datos);
	}

}

 ?>