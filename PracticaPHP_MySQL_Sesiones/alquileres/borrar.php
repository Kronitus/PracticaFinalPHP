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
                $sql = "select a.id_alquiler, c.id_coche, concat(v.nombre,' ',v.apellidos) as vendedor, concat(u.nombre,' ',u.apellidos) as usuario, concat(marca,' ',modelo) as coche, foto, prestado, devuelto
                from alquileres a join usuarios u on a.id_usuario=u.id_usuario join coches c on a.id_coche=c.id_coche join usuarios v on c.id_vendedor=v.id_usuario";
            }
            elseif ($tipo=='comprador'){
                $sql = "select a.id_alquiler, c.id_coche, concat(v.nombre,' ',v.apellidos) as vendedor, concat(u.nombre,' ',u.apellidos) as usuario, concat(marca,' ',modelo) as coche, foto, prestado, devuelto
                from alquileres a join usuarios u on a.id_usuario=u.id_usuario join coches c on a.id_coche=c.id_coche join usuarios v on c.id_vendedor=v.id_usuario where a.id_usuario='$id_usuario' and a.devuelto is null";
            }

            $result = mysqli_query ($conn,$sql);
            if (mysqli_num_rows($result)>0){
                echo "<form action='borrar2.php' method='post'>";
                echo "<TABLE border=1 align=center>";
                echo "<tr><th height=50px width=200px>Seleccionar</th><th height=50px width=200px>Vendedor</th><th height=50px width=200px>Alquilado por</th>
                <th height=50px width=200px>Coche</th><th height=50px width=200px>Foto</th><th height=50px width=200px>Prestado</th><th height=50px width=200px>Devuelto</th></tr>";
                while ($row = mysqli_fetch_assoc($result)){
                    echo "<TR>";
                    echo "<TD><input type='checkbox' name='delete_ids[]' value='". $row['id_alquiler'] ."'></TD>";
                    echo "<input type='hidden' name='id_coche[" . $row['id_alquiler'] . "]' value='" . $row['id_coche'] ."'>";
                    echo "<TD>" . htmlspecialchars($row['vendedor']) . "</TD>";
                    echo "<TD>" . htmlspecialchars($row['usuario']) . "</TD>";
                    echo "<TD>" . htmlspecialchars($row['coche']) . "</TD>";
                    echo "<TD><img src='../coches/img/" . htmlspecialchars($row['foto']) . "' width=200 height=100 align=center></TD>";
                    echo "<TD>" . htmlspecialchars($row['prestado']) . "</TD>";
                    echo "<TD>" . htmlspecialchars($row['devuelto']) . "</TD>";
                    print "</TR>";
                }
                echo "</TABLE>";
                echo "<br>";
                if ($tipo=='comprador'){
                    echo "<input type='hidden' name='id_coche[]' value='" . $row['id_coche'] ."'>";
                    echo "<button type='submit'>Devolver alquiler seleccionados</button>";
                }
                if ($tipo=='administrador'){
                    echo "<button type='submit'>Eliminar seleccionados</button>";
                }
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