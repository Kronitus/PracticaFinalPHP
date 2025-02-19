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
            $servername="localhost";$username="root";$password="rootroot";$dbname="Concesionario";
            
            $conn = mysqli_connect ($servername,$username,$password,$dbname);
            
            if (!$conn){
                die ("conexion fallida: ". mysqli_connect_error());
            }
            
            $password=$_REQUEST['password'];
            $nombre=$_REQUEST['nombre'];
            $apellidos=$_REQUEST['apellidos'];
            $dni=$_REQUEST['dni'];
            $saldo=$_REQUEST['saldo'];
            $tipo=$_REQUEST['tipo'];
            
            $sql = "insert into usuarios (password, nombre, apellidos, dni, saldo, tipo_usuario) values ('$password','$nombre','$apellidos','$dni','$saldo','$tipo')";
            
            if (mysqli_query($conn,$sql)){
                echo "Usuario insertado con éxito.";
            }
            else{
                echo "Error al insertar el usuario: ". mysqli_error($conn);
            }
            
            mysqli_close($conn);
            echo "<br><a href='añadir.html' class='plis'>Volver para añadir</a>";
        ?>
        </main>
        <footer class="footer">
            <p> © 2024. All rights reserved. No part of this publication can be reproduced, stored in a retrieval system or transmitted in any form or by any means,
                electronic, mechanical or photocopying, recording, or otherwise without the prior permission of the publisher.</p>
        </footer>
	</body>
</html>