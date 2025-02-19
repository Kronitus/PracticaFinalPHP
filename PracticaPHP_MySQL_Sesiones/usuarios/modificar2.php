<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<link rel="icon" type="image/png" href="../octagram.png" sizes="32x32">
		<link rel="stylesheet" href="../index.css">
		<title>AutosOctagram</title>
	</head>
	<body>
		<header class="header">
            <h1>Autos Octagram</h1>
        </header>
        <nav class="navega">
            <ul>
                <li>
                    <a href="../coches/coches.html">Coches</a>
                    <ul>
                        <li><a href="../index.php">Inicio</a></li>
                        <li><a href="../coches/añadir.html">Añadir</a></li>
                        <li><a href="../coches/listar.php">Listar</a></li>
                        <li><a href="../coches/buscar.html">Buscar</a></li>
                        <li><a href="../coches/modificar.html">Modificar</a></li>
                        <li><a href="../coches/borrar.php">Borrar</a></li>
                    </ul>
                </li>
                <li>
                    <a href="../usuarios/usuarios.html">Usuarios</a>
                    <ul>
                        <li><a href="../index.php">Inicio</a></li>
                        <li><a href="../usuarios/añadir.html">Añadir</a></li>
                        <li><a href="../usuarios/listar.php">Listar</a></li>
                        <li><a href="../usuarios/buscar.html">Buscar</a></li>
                        <li><a href="../usuarios/modificar.html">Modificar</a></li>
                        <li><a href="../usuarios/borrar.php">Borrar</a></li>
                    </ul>
                </li>
                <li>
                    <a href="../alquileres/alquileres.html">Alquileres</a>
                    <ul>
                        <li><a href="../index.php">Inicio</a></li>
                        <li><a href="../alquileres/listar.php">Listar</a></li>
                        <li><a href="../alquileres/borrar.php">Borrar</a></li>
                    </ul>
                </li>
                <li>
                    <a href="../registro.html"><img src="../icono.png" width="20"></a>
                    <ul>
                        <li><a href="../index.php">Inicio</a></li>
                        <li><a href="../login.html">Login</a></li>
                        <li><a href="../registro.html">Registrarse</a></li>
                        <li><a href="../logout.php">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <main class="contenido">
        <h2>USUARIOS</h2>
        <?PHP
            $servername="localhost";$username="root";$password="rootroot";$dbname="concesionario";
            
            $conn = mysqli_connect ($servername,$username,$password,$dbname);
            
            if (!$conn){
                die ("conexion fallida: ". mysqli_connect_error());
            }
            
            $opcion=$_REQUEST['opcion'];
            $valor=$_REQUEST['valor'];

            
            $sql = "select * from usuarios where $opcion = '$valor'";
            $result= mysqli_query($conn,$sql);
            
            if (mysqli_num_rows($result)>0){
                while($row=mysqli_fetch_assoc($result)){
        ?>
            <form action="modificar3.php" method="post">
                <input type="text" readonly name="id" value="<?php echo $row['id_usuario']; ?>"><br><br>
                <label for="password">Contraseña:</label>
                <input type="password" name="password" value="<?php echo $row['password']; ?>" required><br>
                <label for="nombre">Nombre:</label>
                <input type="text" name="nombre" value="<?php echo $row['nombre']; ?>" required><br>
                <label for="apellidos">Apellido:</label>
                <input type="text" name="apellidos" value="<?php echo $row['apellidos']; ?>" required><br>
                <label for="dni">DNI:</label>
                <input type="text" name="dni" value="<?php echo $row['dni']; ?>" required><br>
                <label for="saldo">Saldo:</label>
                <input type="number" name="saldo" value="<?php echo $row['saldo']; ?>" required><br>
                <label for="tipo">Tipo de usuario:</label>
                <select name="tipo">
                <option value="comprador" <?php if ($row['tipo_usuario'] == 'comprador') echo 'selected'; ?> >Comprador</option>
                <option value="vendedor" <?php if ($row['tipo_usuario'] == 'vendedor') echo 'selected'; ?> >Vendedor</option>
                <option value="administrador" <?php if ($row['tipo_usuario'] == 'administrador') echo 'selected'; ?> >Administrador</option>
                </select><br>
                <input type="submit" value="Actualizar">
            </form>
            <?php
            }
            ?>
        </main>
        <footer class="footer">
            <p> © 2024. All rights reserved. No part of this publication can be reproduced, stored in a retrieval system or transmitted in any form or by any means,
                electronic, mechanical or photocopying, recording, or otherwise without the prior permission of the publisher.</p>
        </footer>
	</body>
</html>
<?php
    }
    else{
        echo "No se encontró ningún usuario con ese valor.";
    }
    mysqli_close($conn);
?>