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
        <h2>ALQUILERES</h2>
         <?PHP
            $tipo=$_SESSION['tipo'];
            $id_usuario=$_SESSION['id_usuario'];

            if ($tipo=='administrador'){
                $sql = "select concat(v.nombre,' ',v.apellidos) as vendedor, concat(u.nombre,' ',u.apellidos) as usuario, concat(marca,' ',modelo) as coche, foto, prestado, devuelto
                from alquileres a join usuarios u on a.id_usuario=u.id_usuario join coches c on a.id_coche=c.id_coche join usuarios v on c.id_vendedor=v.id_usuario";
            }
            elseif ($tipo=='comprador'){
                $sql = "select concat(v.nombre,' ',v.apellidos) as vendedor, concat(u.nombre,' ',u.apellidos) as usuario, concat(marca,' ',modelo) as coche, foto, prestado, devuelto
                from alquileres a join usuarios u on a.id_usuario=u.id_usuario join coches c on a.id_coche=c.id_coche join usuarios v on c.id_vendedor=v.id_usuario where a.id_usuario='$id_usuario'";
            }
            elseif ($tipo=='vendedor'){
                $sql = "select concat(v.nombre,' ',v.apellidos) as vendedor, concat(u.nombre,' ',u.apellidos) as usuario, concat(marca,' ',modelo) as coche, foto, prestado, devuelto
                from alquileres a join usuarios u on a.id_usuario=u.id_usuario join coches c on a.id_coche=c.id_coche join usuarios v on c.id_vendedor=v.id_usuario where c.id_vendedor='$id_usuario'";
            }
            
            $consulta = mysqli_query ($conn,$sql)
            or die ("Fallo en la consulta");

            $nfilas = mysqli_num_rows ($consulta);
            if ($nfilas > 0){
               print ("<TABLE border=1 align=center>\n");
               print ("<TR>\n");
               print ("<TH height=50px width=200px>Vendedor</TH>\n");
               print ("<TH height=50px width=200px>Alquilado por</TH>\n");
               print ("<TH height=50px width=200px>Coche</TH>\n");
               print ("<TH height=50px width=200px>Foto</TH>\n");
               print ("<TH height=50px width=200px>Prestado</TH>\n");
               print ("<TH height=50px width=200px>Devuelto</TH>\n");
               print ("</TR>\n");
               for ($i=0; $i<$nfilas; $i++){
                  $resultado = mysqli_fetch_array ($consulta);
                  print ("<TR>\n");
                  print ("<TD>" . $resultado['vendedor'] . "</TD>\n");
                  print ("<TD>" . $resultado['usuario'] . "</TD>\n");
                  print ("<TD>" . $resultado['coche'] . "</TD>\n");
                  print ("<TD><img src='../coches/img/" . htmlspecialchars($resultado['foto']) . "' width=200 height=100 align=center></TD>\n");
                  print ("<TD>" . $resultado['prestado'] . "</TD>\n");
                  print ("<TD>" . $resultado['devuelto'] . "</TD>\n");      
                  print ("</TR>\n");
               }
               print ("</TABLE>\n");
            }
            else{
               print ("No hay alquileres disponibles");
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