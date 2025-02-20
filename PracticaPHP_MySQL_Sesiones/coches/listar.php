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
        <h2>COCHES</h2>
         <?PHP
            $instruccion = "select * from coches";
            $consulta = mysqli_query ($conn,$instruccion)
            or die ("Fallo en la consulta");

            $nfilas = mysqli_num_rows ($consulta);
            if ($nfilas > 0){
               print ("<TABLE border=1 align=center>\n");
               print ("<TR>\n");
               print ("<TH height=50px width=200px>Marca</TH>\n");
               print ("<TH height=50px width=200px>Modelo</TH>\n");
               print ("<TH height=50px width=200px>Color</TH>\n");
               print ("<TH height=50px width=200px>Precio</TH>\n");
               print ("<TH height=50px width=200px>Alquilado</TH>\n");
               print ("<TH height=50px width=200px>Foto</TH>\n");
                if ($_SESSION['tipo']=='comprador'){
               print ("<TH height=50px width=200px>Alquilar</TH>\n");
                }
               print ("</TR>\n");
               for ($i=0; $i<$nfilas; $i++){
                  $resultado = mysqli_fetch_array ($consulta);
                  if ($resultado['alquilado']==1){
                     $alquilado="Si";
                  }
                  else{
                     $alquilado="No";
                  }
                  print ("<TR>\n");
                  print ("<TD>" . $resultado['marca'] . "</TD>\n");
                  print ("<TD>" . $resultado['modelo'] . "</TD>\n");
                  print ("<TD>" . $resultado['color'] . "</TD>\n");
                  print ("<TD>" . $resultado['precio'] . "</TD>\n");
                  print ("<TD>" . $alquilado . "</TD>\n");   
                  print ("<TD><img src='./img/" . htmlspecialchars($resultado['foto']) . "' width=200 height=100 align=center></TD>\n");
                  if ($_SESSION['tipo']=='comprador'){
                    if ($resultado['alquilado']==0){
                        print ("<TD>
                                    <form action='alquilar.php' method='post'>
                                        <input type='hidden' name='id_coche' value=" . $resultado['id_coche'] .">
                                        <button type='submit' class='plis'>Alquilar</button>
                                    </form>
                                </TD>\n");
                    }
                    else{
                        print ("<TD>Ya está reservado</TD>\n");
                    }
                  }
                  print ("</TR>\n");
               }
               print ("</TABLE>\n");
            }
            else{
               print ("No hay coches disponibles");
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