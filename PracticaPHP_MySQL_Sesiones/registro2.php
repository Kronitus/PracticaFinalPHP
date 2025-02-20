<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<link rel="icon" type="image/png" href="./octagram.png" sizes="32x32">
		<link rel="stylesheet" href="index.css">
		<title>AutosOctagram</title>
	</head>
	<body>
		<div class="container">
			<?php
			$conn = mysqli_connect ("localhost", "root", "rootroot", "concesionario");
			if (!$conn){
				die ("conexion fallida: ". mysqli_connect_error());
			}
			
			$nombre=$_REQUEST['nombre'];
			$apellido=$_REQUEST['apellido'];
			$dni=$_REQUEST['dni'];
			$contra=$_REQUEST['password'];
			$saldo=$_REQUEST['saldo'];
			$tipo=$_REQUEST['tipo'];
			
			
			$sql = "insert into usuarios (password, nombre, apellidos, dni, saldo, tipo_usuario) values ('$contra','$nombre','$apellido','$dni','$saldo','$tipo')";

			if (mysqli_query($conn,$sql)){
                echo "Usuario registrado con éxito.";
            }
            else{
                echo "Error al registrarse: ". mysqli_error($conn);
            }
            
            mysqli_close($conn);
            echo "<br><a href='login.php' class='plis'>Volver para añadir</a>";
			?>
		</div>
	</body>
</html>