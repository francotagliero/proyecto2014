<?php 

class PDOConnection{

	public function getConnection(){
		$user = "root";
		$pass = "";
		$host = "localhost";		
		$db = "parcial2014";
		$mbd = new PDO("mysql:host=127.0.0.1;dbname=parcial2014;charset=utf8", $user, $pass);
		return $mbd;
	}
}


 ?>