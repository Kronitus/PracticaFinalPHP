<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<link rel="icon" type="image/png" href="./octagram.png" sizes="32x32">
		<link rel="stylesheet" href="index.css">
		<title>AutosOctagram</title>
	</head>
	<body>
		<header class="header">
            <h1>Autos Octagram</h1>
        </header>
		<div >
            <?php
                $conn = mysqli_connect ("localhost", "root", "rootroot", "concesionario");
                if (!$conn){
                    die ("conexion fallida: ". mysqli_connect_error());
                }

                $dni=$_POST['dni'];
                $password=$_POST['password'];

                $sql="select * from usuarios where dni='$dni' and password='$password'";
                $result= mysqli_query($conn,$sql);

                $row = mysqli_fetch_assoc($result);
                $hash = $row['password'];


                if ($password==$hash) {
                    $_SESSION['loggedin'] = true;
                    $_SESSION['id_usuario'] = $row['id_usuario'];
                    $_SESSION['nombre'] = $row['nombre'];
                    $_SESSION['apellidos'] = $row['apellidos'];
                    $_SESSION['tipo'] = $row['tipo_usuario'];
                    $_SESSION['start'] = time();
                    $_SESSION['expire'] = $_SESSION['start'] + (1 * 60);
                    mysqli_close($conn);
                    header("Location: index.php");
                    exit;

                } else {
                    mysqli_close($conn);
                    echo "<div >DNI o Contraseña incorrectos!
                    <p><a href='login.html' class='plis'><strong>¡Intentalo de nuevo!</strong></a></p></div>";
                }
            ?>
        </div>
	</body>
</html>