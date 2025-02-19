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
            $conexion = mysqli_connect ("localhost", "root", "rootroot")
            or die ("No se puede conectar con el servidor");

            mysqli_select_db ($conexion,"concesionario")
            or die ("No se puede seleccionar la base de datos");

            $instruccion = "select * from usuarios";
            $consulta = mysqli_query ($conexion,$instruccion)
            or die ("Fallo en la consulta");

            $nfilas = mysqli_num_rows ($consulta);
            if ($nfilas > 0){
               print ("<TABLE border=1 align=center>\n");
               print ("<TR>\n");
               print ("<TH height=50px width=200px>ID</TH>\n");
               print ("<TH height=50px width=200px>Contraseña</TH>\n");
               print ("<TH height=50px width=200px>Nombre</TH>\n");
               print ("<TH height=50px width=200px>Apellido</TH>\n");
               print ("<TH height=50px width=200px>DNI</TH>\n");
               print ("<TH height=50px width=200px>Saldo</TH>\n");
               print ("<TH height=50px width=200px>Tipo</TH>\n");
               print ("</TR>\n");
               for ($i=0; $i<$nfilas; $i++){
                  $resultado = mysqli_fetch_array ($consulta);
                  print ("<TR>\n");
                  print ("<TD>" . $resultado['id_usuario'] . "</TD>\n");
                  print ("<TD>" . $resultado['password'] . "</TD>\n");
                  print ("<TD>" . $resultado['nombre'] . "</TD>\n");
                  print ("<TD>" . $resultado['apellidos'] . "</TD>\n");
                  print ("<TD>" . $resultado['dni'] . "</TD>\n");
                  print ("<TD>" . $resultado['saldo'] . "</TD>\n");
                  print ("<TD>" . $resultado['tipo_usuario'] . "</TD>\n");      
                  print ("</TR>\n");
               }
               print ("</TABLE>\n");
            }
            else{
               print ("No hay usuarios disponibles");
            }
            mysqli_close ($conexion);
         ?>
        </main>
        <footer class="footer">
            <p> © 2024. All rights reserved. No part of this publication can be reproduced, stored in a retrieval system or transmitted in any form or by any means,
                electronic, mechanical or photocopying, recording, or otherwise without the prior permission of the publisher.</p>
        </footer>
	</body>
</html>