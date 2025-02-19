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
        <h2>COCHES</h2>
        <?PHP
            $servername="localhost";$username="root";$password="rootroot";$dbname="concesionario";
            
            $conn = mysqli_connect ($servername,$username,$password,$dbname);
            
            if (!$conn){
                die ("conexion fallida: ". mysqli_connect_error());
            }
            
            $modelo=$_REQUEST['modelo'];
            $marca=$_REQUEST['marca'];
            
            $sql = "select * from coches where modelo like '$modelo' or marca like '$marca'";
            
            if (mysqli_query($conn,$sql)){
                $consulta = mysqli_query($conn,$sql);
                $nfilas = mysqli_num_rows ($consulta);
                if ($nfilas > 0){
                    print ("<TABLE border=1 align=center>\n");
                    print ("<TR>\n");
                    print ("<TH height=50px width=200px>ID</TH>\n");
                    print ("<TH height=50px width=200px>Modelo</TH>\n");
                    print ("<TH height=50px width=200px>Marca</TH>\n");
                    print ("<TH height=50px width=200px>Color</TH>\n");
                    print ("<TH height=50px width=200px>Precio</TH>\n");
                    print ("<TH height=50px width=200px>Alquilado</TH>\n");
                    print ("<TH height=50px width=200px>Foto</TH>\n");
                    print ("</TR>\n");
                    for ($i=0; $i<$nfilas; $i++){
                        $resultado = mysqli_fetch_array ($consulta);
                        print ("<TR>\n");
                        print ("<TD>" . $resultado['id_coche'] . "</TD>\n");
                        print ("<TD>" . $resultado['modelo'] . "</TD>\n");
                        print ("<TD>" . $resultado['marca'] . "</TD>\n");
                        print ("<TD>" . $resultado['color'] . "</TD>\n");
                        print ("<TD>" . $resultado['precio'] . "</TD>\n");
                        print ("<TD>" . $resultado['alquilado'] . "</TD>\n");   
                        print ("<TD><img src='./img/" . htmlspecialchars($resultado['foto']) . "' width=200 height=100 align=center></TD>\n");  
                        print ("</TR>\n");
                    }
                    print ("</TABLE>\n");
                }
                else{
                    print "No hay ningún coche con modelo $modelo ni marca $marca.";
                }
            }
            else{
                echo "Error al buscar coche: ". mysqli_error($conn);
            }
            
            mysqli_close($conn);
            echo "<a href='buscar.html' class='plis'>Volver al listado</a>";
        ?>
        </main>
        <footer class="footer">
            <p> © 2024. All rights reserved. No part of this publication can be reproduced, stored in a retrieval system or transmitted in any form or by any means,
                electronic, mechanical or photocopying, recording, or otherwise without the prior permission of the publisher.</p>
        </footer>
	</body>
</html>