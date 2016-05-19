<?php 
if (isset($_POST)) {
	include 'conexion.php';
	$con = new Conexion;
	$conexion = $con->conectar();

	$id = $_POST["id"];
	$sql = "DELETE FROM usuarios WHERE id = $id";
	if($conexion->query($sql)){
		$rta = array(
			'estado' => 1,
			'mensaje'=> 'Usuario eliminado Correctamente'
			);
		echo json_encode($rta);

	}else{
		$rta = array(
			'estado' => 2,
			'mensaje'=> 'Error al Eliminar usuario '.$conexion->error
			);
		echo json_encode($rta);

	}

}

 ?>