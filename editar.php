<?php 
if(isset($_POST)){
	$id = $_POST["id_usuario"];
	$nombre = $_POST["nombre"];
	$apellido = $_POST["apellido"];
	$ciudad = $_POST["ciudad"];

	include 'conexion.php';
	$con = new Conexion;
	$conexion = $con->conectar();

	$sql = "UPDATE usuarios SET nombre = '$nombre', apellidos = '$apellido', id_ciudad = $ciudad WHERE id = $id";
	if($conexion->query($sql)){
		$rta = array(
			'estado' =>1,
			'mensaje' => "Usuario actualizado Correctamente!!",
			'id'=>$id
			);
		echo json_encode($rta);
	}else{
		$rta = array(
			'estado' => 2,
			'mensaje' => "Error al Actualizar: ".$conexion->error
			);
		echo json_encode($rta);
	}

}








 ?>