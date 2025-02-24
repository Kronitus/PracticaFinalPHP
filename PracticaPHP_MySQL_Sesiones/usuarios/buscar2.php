<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<link rel="icon" type="image/png" href="../octagram.png" sizes="32x32">
		<link rel="stylesheet" href="../index.css">
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
        <nav class="navega">
            <ul>
                <li>
                    <a href="../coches/coches.php">Coches</a>
                    <ul>
                        <li><a href="../index.php">Inicio</a></li>
                        <?php if ($_SESSION['tipo']=='vendedor' || $_SESSION['tipo']=='administrador'){
                            echo "<li><a href='../coches/añadir.php'>Añadir</a></li>";
                        }?>
                        <li><a href="../coches/listar.php">Listar</a></li>
                        <li><a href="../coches/buscar.php">Buscar</a></li>
                        <?php if ($_SESSION['tipo']=='vendedor' || $_SESSION['tipo']=='administrador'){
                            echo "<li><a href='../coches/modificar.php'>Modificar</a></li>";
                        }?>
                        <?php if ($_SESSION['tipo']=='vendedor' || $_SESSION['tipo']=='administrador'){
                            echo "<li><a href='../coches/borrar.php'>Borrar</a></li>";
                        }?>
                    </ul>
                </li>
                <?php if ($_SESSION['tipo']=='vendedor' || $_SESSION['tipo']=='administrador' || $_SESSION['tipo']=='comprador'){ ?>
                <li>
                    <a href="../usuarios/usuarios.php">Usuarios</a>
                    <ul>
                        <li><a href="../index.php">Inicio</a></li>
                        <?php if ($_SESSION['tipo']=='administrador'){
                            echo "<li><a href='../usuarios/añadir.php'>Añadir</a></li>";
                        }?>
                        <?php if ($_SESSION['tipo']=='vendedor' || $_SESSION['tipo']=='administrador'){
                            echo "<li><a href='../usuarios/listar.php'>Listar</a></li>";
                        }?>
                        <?php if ($_SESSION['tipo']=='vendedor' || $_SESSION['tipo']=='administrador'){
                            echo "<li><a href='../usuarios/buscar.php'>Buscar</a></li>";
                        }?>
                        <?php if ($_SESSION['tipo']=='vendedor' || $_SESSION['tipo']=='administrador' || $_SESSION['tipo']=='comprador'){
                            echo "<li><a href='../usuarios/modificar.php'>Modificar</a></li>";
                        }?>
                        <?php if ($_SESSION['tipo']=='administrador'){
                            echo "<li><a href='../usuarios/borrar.php'>Borrar</a></li>";
                        }?>
                    </ul>
                </li>
                <?php } ?>
                <?php if ($_SESSION['tipo']=='vendedor' || $_SESSION['tipo']=='administrador' || $_SESSION['tipo']=='comprador'){ ?>
                    <li>
                        <a href="../alquileres/alquileres.php">Alquileres</a>
                        <ul>
                            <li><a href="../index.php">Inicio</a></li>
                            <?php if ($_SESSION['tipo']=='vendedor' || $_SESSION['tipo']=='administrador' || $_SESSION['tipo']=='comprador'){
                                echo "<li><a href='../alquileres/listar.php'>Listar</a></li>";
                            }?>
                            <?php if ($_SESSION['tipo']=='comprador' || $_SESSION['tipo']=='administrador'){
                                echo "<li><a href='../alquileres/borrar.php'>Borrar</a></li>";
                            }?>
                        </ul>
                    </li>
                <?php } ?>
                <li>
                    <a href="../registro.php"><img src="../icono.png" width="20"></a>
                    <ul>
                        <li><a href="../index.php">Inicio</a></li>
                        <li><a href="../login.php">Login</a></li>
                        <li><a href="../registro.php">Registrarse</a></li>
                        <li><a href="../logout.php">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <main class="contenido">
        <h2>USUARIOS</h2>
        <?PHP
            if (!$conn){
                die ("conexion fallida: ". mysqli_connect_error());
            }
            
            $nombre=$_REQUEST['nombre'];
            $apellidos=$_REQUEST['apellidos'];
            $tipo=$_SESSION['tipo'];

            if ($tipo=='administrador'){
                $sql = "select * from usuarios where nombre like '$nombre' or apellidos like '$apellidos'";
            }
            elseif ($tipo=='vendedor'){
                $sql = "select * from usuarios where tipo_usuario='comprador' and (nombre like '$nombre' or apellidos like '$apellidos')";
            }
            
            if (mysqli_query($conn,$sql)){
                $consulta = mysqli_query($conn,$sql);
                $nfilas = mysqli_num_rows ($consulta);
                if ($nfilas > 0){
                    print ("<TABLE border=1 align=center>\n");
                    print ("<TR>\n");
                    print ("<TH height=50px width=200px>Nombre</TH>\n");
                    print ("<TH height=50px width=200px>Apellido</TH>\n");
                    print ("<TH height=50px width=200px>DNI</TH>\n");
                    print ("<TH height=50px width=200px>Saldo</TH>\n");
                    if ($tipo=="administrador"){
                        print ("<TH height=50px width=200px>Contraseña</TH>\n");
                        print ("<TH height=50px width=200px>Tipo</TH>\n");
                    }
                    print ("</TR>\n");
                    for ($i=0; $i<$nfilas; $i++){
                        $resultado = mysqli_fetch_array ($consulta);
                        print ("<TR>\n");
                        print ("<TD>" . $resultado['nombre'] . "</TD>\n");
                        print ("<TD>" . $resultado['apellidos'] . "</TD>\n");
                        print ("<TD>" . $resultado['dni'] . "</TD>\n");
                        print ("<TD>" . $resultado['saldo'] . "</TD>\n");
                        if ($tipo=='administrador'){
                            $pass=password_hash($resultado['password'], PASSWORD_DEFAULT);
                            print ("<TD>" . $pass . "</TD>\n");
                            print ("<TD>" . $resultado['tipo_usuario'] . "</TD>\n");
                        }
                        print ("</TR>\n");
                    }
                    print ("</TABLE>\n");
                }
                else{
                    print "No hay ningún usuario con nombre $nombre ni apellido $apellidos.";
                }
            }
            else{
                echo "Error al buscar usuario: ". mysqli_error($conn);
            }
            
            mysqli_close($conn);
            echo "<a href='buscar.php' class='plis'>Volver al listado</a>";
        ?>
        </main>
        <footer class="footer">
            <p> © 2024. All rights reserved. No part of this publication can be reproduced, stored in a retrieval system or transmitted in any form or by any means,
                electronic, mechanical or photocopying, recording, or otherwise without the prior permission of the publisher.</p>
        </footer>
	</body>
</html>