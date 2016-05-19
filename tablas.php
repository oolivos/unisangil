<?php
echo gethostbyname(gethostname()); 
include 'conexion.php';
$con = new Conexion;
$conexion = $con->conectar();
$ciudades = $conexion->query("SELECT * FROM ciudades");
$usuarios = $conexion->query("SELECT 
								usuarios.id,usuarios.nombre, usuarios.apellidos, ciudades.nombre as ciudad 
								FROM usuarios INNER JOIN ciudades 
								ON usuarios.id_ciudad = ciudades.id");


 ?>
<!doctype HTML>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta name="description" content="Ejemplo  Javascript JQuery"/>
	<meta name="keywords" content="html5, css,javascript,unisangil"/>
	<meta name="author" content="Oscar Olivos"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="css/estilos.css">
	<title>Ejemplo JQuery Tablas</title>
	<script type="text/javascript" src="js/jquery-2.2.2.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){

			$("#formulario").submit(function(e){
				e.preventDefault();
				//alert("funcionando!!");
				if($("#nombre").val() != "" && $("#apellido").val() != "" && $("#ciudad").val() != ""){
					var nombre = $("#nombre").val();
					var apellido = $("#apellido").val();
					var ciudad = $("#ciudad option:selected").html();

					$.ajax({
						url: 'guardar.php',
						data: $(this).serialize(),
						method: "POST",
						dataType: "JSON",
						success:function(data){
							if(data.estado == 1){
								var fila='<tr value="'+data.id+'">';
								fila+='<td>'+nombre+'</td>';
								fila+='<td>'+apellido+'</td>';
								fila+='<td>'+ciudad+'</td>';
								fila+='<td>';
								fila+='<img class="eliminar" src="images/delete.png" title="Eliminar"></img>';
								fila+='</td>';
								fila+='</tr>';

								$("#tabla").append(fila);
								$("#nombre").val("").focus();
								$("#apellido").val("");
								$("#ciudad").val("");
								alert(data.mensaje);
							}else{
								alert(data.mensaje);
							}

						},
						error: function(error){

						}

						});

					

				}else{
					alert("Todos los campos son necesarios!!");
				}
				

			});
			/*
			$(".eliminar").click(function(){

				//alert("funcionando!!");
				$(this).parent().parent().remove();
			});*/

			$("#tabla").on('click','.eliminar',function(){

				var id = $(this).parent().parent().attr("value");
				trEliminar = $(this).parent().parent(); 
					$.ajax({
						url : "eliminar.php",
						data : "id="+id,
						method : "POST",
						dataType : "JSON",
						success: function(data){
							if(data.estado == 1){
								trEliminar.remove();
								alert(data.mensaje);
							}else{
								alert(data.mensaje);
							}
							
						}
					});

				
			});

		})

	</script>
</head>
<body>
	<section>
		<form id="formulario">
			<input id="nombre" name="nombre" type="text" placeholder="Nombre"></input>
			<input id="apellido" name="apellido" type="text" placeholder="Apellido"></input>
			<select id="ciudad" name="ciudad">
				<option value="">Seleccione Ciudad...</option>
				<?php while ($ciudad = $ciudades->fetch_array()) { ?>
					<option value="<?php echo $ciudad['id'] ?>"><?php echo $ciudad["nombre"] ?></option>
				 <?php } ?>
			</select>
			<button id="agregar" type="submit">Agregar</button>
		</form>

	</section>
	<section>
		<table id="tabla" >
			<tr>
				<th>Nombre</th>
				<th>Apellido</th>
				<th>Ciudad</th>
				<th>Opciones</th>
			</tr>
			<?php while ($usuario = $usuarios->fetch_array()) { ?>
			<tr value="<?php echo $usuario["id"]; ?>">
				<td><?php echo $usuario["nombre"]; ?></td>
				<td><?php echo $usuario["apellidos"] ?></td>
				<td><?php echo $usuario["ciudad"] ?></td>
				<td>
					<img class="eliminar" src="images/delete.png" title="Eliminar"></img>
				</td>
			</tr>
			<?php } ?>
		</table>
	</section>

</body>
</html>