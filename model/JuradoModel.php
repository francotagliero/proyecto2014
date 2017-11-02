<?php 

require_once("./model/PDOConnection.php");

class JuradoModel{

	private static $instance;

	public static function getInstance(){
		if(!isset(self::$instance)){
			self::$instance = new self();
		}
		return self::$instance;
	}

	private function __construct(){
	}

	function userVerify($user,$password){
		$model = new PDOConnection();
		$connection = $model->getConnection();
		$query = "SELECT * FROM usuario u WHERE u.username = '$user' AND u.password = '$password' ";
		$stmt = $connection->prepare($query);
		$stmt->execute();
		return ( $stmt->rowCount() != 0 );

	}

	function isAdmin($user){
		$model = new PDOConnection();
		$connection = $model->getConnection();
		$query = " SELECT isAdmin FROM usuario u WHERE u.username = '$user'";
		$stmt = $connection->prepare($query);
		$stmt->execute();
		return ($stmt->fetch() );
	}

	public function getProyectos()
	{
		$model = new PDOConnection();
		$connection = $model->getConnection();
		$query = "SELECT * FROM proyecto ";	
		$stmt = $connection->prepare($query);
		$stmt->execute();
		return ($stmt->fetchAll());
	}

	public function getEstadoVoto($user){
		$model = new PDOConnection();
		$connection = $model->getConnection();
		$query = "SELECT voto FROM usuario WHERE usuario.username = '$user' ";
		$stmt = $connection->prepare($query);
		$stmt->execute();
		return ($stmt->fetchAll()[0]);
	}

	public function yaVoto($user){
		//una ve que vota lo guardo en la bd
		$model = new PDOConnection();
		$connection = $model->getConnection();
		$query = "UPDATE usuario SET voto = 1 WHERE usuario.idUser = '$user' ";
		$stmt = $connection->prepare($query);
		$stmt->execute();
		return ($stmt->fetch());	
	}

	public function sumarVoto($id)
	{  //sumo el voto al proyecto
		$model = new PDOConnection();
		$connection = $model->getConnection();
		$query = "UPDATE proyecto SET votos = proyecto.votos+1 WHERE proyecto.idProyecto = '$id' ";
		$stmt = $connection->prepare($query);
		$stmt->execute();
		return ($stmt->fetch());
	}

	public function getIdUser($user){
		$model = new PDOConnection();
		$connection = $model->getConnection();
		$query = "SELECT idUser FROM usuario WHERE usuario.username = '$user' ";
		$stmt = $connection->prepare($query);
		$stmt->execute();
		return ($stmt->fetch()[0]);	
	}
}

 ?>