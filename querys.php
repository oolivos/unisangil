<?php 
include 'conexion.php';

$con = new Conexion;
$conexion = $con->conectar();

//insert($conexion);
//delete($conexion);
select($conexion);

function insert($conexion){
	$sql = "INSERT INTO usuarios (nombre, apellidos,id_ciudad) VALUES('Javier','Olivos',2)";
	if($conexion->query($sql)){
		echo "Usuario creado Correctamente!!";
	}else{
		echo "Error al crear usuario ".$conexion->error;
	}

}

function delete($conexion){
	$sql ="DELETE FROM usuarios WHERE id=3";
	if($conexion->query($sql)){
		echo "Usuario eliminado Correctamente";
	}else{
		echo " Error al Eliminar el Usuario ".$conexion->error;
	}

}

function select($conexion){
	$sql = "SELECT usuarios.nombre, usuarios.apellidos, ciudades.nombre as ciudad FROM usuarios INNER JOIN ciudades ON usuarios.id_ciudad = ciudades.id";
	if(!$resultado = $conexion->query($sql)){
		echo "Se presento un error ". $conexion->error;
	}else{
		if($resultado->num_rows > 0){
			
			while($usuario = $resultado->fetch_array()){
				echo $usuario["id"]." ".$usuario["nombre"]." ".$usuario["apellidos"]." ".$usuario["ciudad"];
				echo "<br>";
			}
		}else
		{
			echo "<br>";
			echo " No existe registros para Mostrar!!";
		}
		
	}
}




 ?>