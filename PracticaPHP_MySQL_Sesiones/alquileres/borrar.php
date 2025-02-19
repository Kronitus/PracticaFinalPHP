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
        <h2>ALQUILERES</h2>
        <?PHP
            $conn = mysqli_connect ("localhost", "root", "rootroot", "concesionario");
            if (!$conn){
                die ("conexion fallida: ". mysqli_connect_error());
            }

            $sql = "select * from alquileres";
            $result = mysqli_query ($conn,$sql);
            if (mysqli_num_rows($result)>0){
                echo "<form action='borrar2.php' method='post'>";
                echo "<TABLE border=1 align=center>";
                echo "<tr><th height=50px width=200px>Seleccionar</th><th height=50px width=200px>ID</th><th height=50px width=200px>ID_Usuario</th><th height=50px width=200px>ID_Coche</th>
                <th height=50px width=200px>Prestado</th><th height=50px width=200px>Devuelto</th></tr>";
                while ($row = mysqli_fetch_assoc($result)){
                    echo "<TR>";
                    echo "<TD><input type='checkbox' name='delete_ids[]' value='". $row['id_alquiler'] ."'></TD>";
                    echo "<TD>" . htmlspecialchars($row['id_alquiler']) . "</TD>";
                    echo "<TD>" . htmlspecialchars($row['id_usuario']) . "</TD>";
                    echo "<TD>" . htmlspecialchars($row['id_coche']) . "</TD>";
                    echo "<TD>" . htmlspecialchars($row['prestado']) . "</TD>";
                    echo "<TD>" . htmlspecialchars($row['devuelto']) . "</TD>";
                    print "</TR>";
                }
                echo "</TABLE>";
                echo "<br>";
                echo "<button type='submit'>Eliminar seleccionados</button>";
                echo "</form>";
            }
            else{
                echo "<h1>No hay alquileres disponibles</h1>";
            }
            mysqli_close ($conn);
        ?>
        </main>
        <footer class="footer">
            <p> © 2024. All rights reserved. No part of this publication can be reproduced, stored in a retrieval system or transmitted in any form or by any means,
                electronic, mechanical or photocopying, recording, or otherwise without the prior permission of the publisher.</p>
        </footer>
	</body>
</html>