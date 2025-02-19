<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<link rel="icon" type="image/png" href="./octagram.png" sizes="32x32">
		<link rel="stylesheet" href="index.css">
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
                    <a href="./coches/coches.html">Coches</a>
                    <ul>
                        <li><a href="./index.php">Inicio</a></li>
                        <?php if ($_SESSION['tipo']=='vendedor' || $_SESSION['tipo']=='administrador'){
                            echo "<li><a href='./coches/añadir.html'>Añadir</a></li>";
                        }?>
                        <li><a href="./coches/listar.php">Listar</a></li>
                        <li><a href="./coches/buscar.html">Buscar</a></li>
                        <?php if ($_SESSION['tipo']=='vendedor' || $_SESSION['tipo']=='administrador'){
                            echo "<li><a href='./coches/modificar.html'>Modificar</a></li>";
                        }?>
                        <?php if ($_SESSION['tipo']=='vendedor' || $_SESSION['tipo']=='administrador'){
                            echo "<li><a href='./coches/borrar.php'>Borrar</a></li>";
                        }?>
                    </ul>
                </li>
                <?php if ($_SESSION['tipo']=='vendedor' || $_SESSION['tipo']=='administrador' || $_SESSION['tipo']=='comprador'){ ?>
                <li>
                    <a href="./usuarios/usuarios.html">Usuarios</a>
                    <ul>
                        <li><a href="./index.php">Inicio</a></li>
                        <?php if ($_SESSION['tipo']=='administrador'){
                            echo "<li><a href='./usuarios/añadir.html'>Añadir</a></li>";
                        }?>
                        <?php if ($_SESSION['tipo']=='vendedor' || $_SESSION['tipo']=='administrador'){
                            echo "<li><a href='./usuarios/listar.php'>Listar</a></li>";
                        }?>
                        <?php if ($_SESSION['tipo']=='vendedor' || $_SESSION['tipo']=='administrador'){
                            echo "<li><a href='./usuarios/buscar.html'>Buscar</a></li>";
                        }?>
                        <?php if ($_SESSION['tipo']=='vendedor' || $_SESSION['tipo']=='administrador' || $_SESSION['tipo']=='comprador'){
                            echo "<li><a href='./usuarios/modificar.html'>Modificar</a></li>";
                        }?>
                        <?php if ($_SESSION['tipo']=='administrador'){
                            echo "<li><a href='./usuarios/borrar.php'>Borrar</a></li>";
                        }?>
                    </ul>
                </li>
                <?php } ?>
                <?php if ($_SESSION['tipo']=='vendedor' || $_SESSION['tipo']=='administrador' || $_SESSION['tipo']=='comprador'){ ?>
                    <li>
                        <a href="./alquileres/alquileres.html">Alquileres</a>
                        <ul>
                            <li><a href="./index.php">Inicio</a></li>
                            <?php if ($_SESSION['tipo']=='vendedor' || $_SESSION['tipo']=='administrador' || $_SESSION['tipo']=='comprador'){
                                echo "<li><a href='./alquileres/listar.php'>Listar</a></li>";
                            }?>
                            <?php if ($_SESSION['tipo']=='comprador' || $_SESSION['tipo']=='administrador'){
                                echo "<li><a href='./alquileres/borrar.php'>Borrar</a></li>";
                            }?>
                        </ul>
                    </li>
                <?php } ?>
                <li>
                    <a href="./registro.html"><img src="./icono.png" width="20"></a>
                    <ul>
                        <li><a href="./index.php">Inicio</a></li>
                        <li><a href="./login.html">Login</a></li>
                        <li><a href="./registro.html">Registrarse</a></li>
                        <li><a href="./logout.php">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <main class="contenido">
            <h2>Bienvenido a Autos Octagram<?php if (isset($_SESSION['loggedin'])){echo ", ". $_SESSION['nombre'];} ?></h2>
            <p>Controla nuestra base de datos sobre autos, incluye, lista, busca, modifica y borra los que quieras.</p><br><br>
            <section class="galeria">
                <div class="galeriaimagenes">
                    <img src="kia.jpg" width="500" height="400">
                    <img src="suv.jpg" width="500" height="400">
                    <img src="laren.jpg" width="500" height="400">
                </div>
            </section>
        </main>
        <footer class="footer">
            <p> © 2024. All rights reserved. No part of this publication can be reproduced, stored in a retrieval system or transmitted in any form or by any means,
                electronic, mechanical or photocopying, recording, or otherwise without the prior permission of the publisher.</p>
        </footer>
	</body>
</html>