<?php 
if (isset($_POST)) {
	$nombre = $_POST["nombre"];
	$apellido = $_POST["apellido"];
	$ciudad = $_POST["ciudad"];

	include 'conexion.php';
	$con = new Conexion;
	$conexion = $con->conectar();

	$sql= "INSERT INTO usuarios (nombre, apellidos, id_ciudad) VALUES('$nombre', '$apellido', $ciudad)";
	if ($conexion->query($sql)) {
		
		$id = $conexion->insert_id;
		$rta  = array(
			'estado' => 1 ,
			'mensaje' => "Usuario Creado Correctamente!!",
			'id' => $id
					 );
		echo json_encode($rta);

	}else{
		$rta = array(
			'estado'=> 2,
			'mensaje' => "Error al crear el Usuario ".$conexion->error
			);
		echo json_encode($rta);
	}

}


 ?>