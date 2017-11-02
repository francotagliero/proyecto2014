<?php 
require_once('TwigView.php');

class Jurado extends TwigView{

	public function show($datos){
		echo self::getTwig()->render('juradoView_twig.html', $datos);
	}

	public function showProyectos($datos){
		echo self::getTwig()->render('listarProyectosJurado_twig.html', $datos);
	}

}

 ?>