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
		<?php
			$conn = mysqli_connect ("localhost", "root", "rootroot", "concesionario");
			if (!$conn){
				die ("conexion fallida: ". mysqli_connect_error());
			}
		?>
		<header class="header">
            <h1>Autos Octagram</h1>
        </header>
		<h1 class="loguearse">Regístrate</h1>
		<form action="registro2.php" method="post" class="formulariopro">	
			<input type="text" name="nombre" placeholder="Introduce tu nombre" required>			
			<input type="text" name="apellido" placeholder="Introduce tu apellido" required>
			<input type="text" name="dni" min=9 max=9 placeholder="Introduce tu dni" required>
			<input type="password" name="password" placeholder="Introduce tu contraseña" required>
			<input type="number" name="saldo" placeholder="Introduce tu saldo" required>
            <select name="tipo">
                <option value="comprador">Comprador</option>
                <option value="vendedor">Vendedor</option>
            </select>
			<input type="submit" value="Crear una cuenta">
		</form>
		<hr width=50%>
		<section class="centro">
			<h3>Login</h3>
			<p><a href="login.php" class="plis">Si tienes cuenta, inicia sesión</a></p>
			<hr width=50%>
			<p><a href="./logout.php" class="plis">Entrar sin registrarse</a></p>
		</section>
		<footer class="footer">
			<p> © 2024. All rights reserved. No part of this publication can be reproduced, stored in a retrieval system or transmitted in any form or by any means,
					electronic, mechanical or photocopying, recording, or otherwise without the prior permission of the publisher.</p>
		</footer>
	</body>
</html>