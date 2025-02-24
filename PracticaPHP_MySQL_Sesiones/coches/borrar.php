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
            $usuario=$_SESSION['id_usuario'];
            if ($_SESSION['tipo']=='vendedor'){
                $sql="select * from coches where id_vendedor='$usuario'";
            } else {
                $sql="select * from coches";
            }

            $result = mysqli_query ($conn,$sql);
            if (mysqli_num_rows($result)>0){
                echo "<form action='borrar2.php' method='post'>";
                echo "<TABLE border=1 align=center>";
                echo "<tr><th height=50px width=200px>Seleccionar</th><th height=50px width=200px>Marca</th><th height=50px width=200px>
                Modelo</th><th height=50px width=200px>Color</th><th height=50px width=200px>Precio</th><th height=50px width=200px>Alquilado</th><th height=50px width=200px>Foto</th></tr>";
                while ($row = mysqli_fetch_assoc($result)){
                    if (htmlspecialchars($row['alquilado'])==1){
                        $alquilado="Si";
                     }
                     else{
                        $alquilado="No";
                     }
                    echo "<TR>";
                    echo "<TD><input type='checkbox' name='delete_ids[]' value='". $row['id_coche'] ."'></TD>";
                    echo "<TD>" . htmlspecialchars($row['marca']) . "</TD>";
                    echo "<TD>" . htmlspecialchars($row['modelo']) . "</TD>";
                    echo "<TD>" . htmlspecialchars($row['color']) . "</TD>";
                    echo "<TD>" . htmlspecialchars($row['precio']) . "</TD>";
                    echo "<TD>" . $alquilado . "</TD>";
                    echo "<TD><img src='./img/" . htmlspecialchars($row['foto']) . "' width=200 height=100 align=center></TD>\n";
                    print "</TR>";
                }
                echo "</TABLE>";
                echo "<br>";
                echo "<button type='submit'>Eliminar seleccionados</button>";
                echo "</form>";
            }
            else{
                echo "<h1>No hay coches disponibles</h1>";
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