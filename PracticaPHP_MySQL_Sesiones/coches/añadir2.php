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
            $servername="localhost";$username="root";$password="rootroot";$dbname="Concesionario";
            
            $conn = mysqli_connect ($servername,$username,$password,$dbname);
            
            if (!$conn){
                die ("conexion fallida: ". mysqli_connect_error());
            }
            
            $modelo=$_REQUEST['modelo'];
            $marca=$_REQUEST['marca'];
            $color=$_REQUEST['color'];
            $precio=$_REQUEST['precio'];
            $id_vendedor=$_SESSION['id_usuario'];
            
            $target_dir = "./img/";
            $file = $_FILES['imagen'];
            $target_file = $target_dir . basename($file["name"]);
            $image_name = basename($file["name"]);

            if (move_uploaded_file($file["tmp_name"], $target_file)) {
                echo "La imagen " . htmlspecialchars($image_name) . " se ha subido correctamente.<br>";
            } else {
                die ("Hubo un error al subir el archivo.");
            }
            
            $sql = "insert into coches (modelo, marca, color, precio, alquilado, foto, id_vendedor) values ('$modelo','$marca','$color','$precio',0,'$image_name','$id_vendedor')";
            
            if (mysqli_query($conn,$sql)){
                echo "Coche insertado con éxito.";
            }
            else{
                echo "Error al insertar el coche: ". mysqli_error($conn);
            }
            
            mysqli_close($conn);
            echo "<br><a href='añadir.php' class='plis'>Volver para añadir</a>";
        ?>
        </main>
        <footer class="footer">
            <p> © 2024. All rights reserved. No part of this publication can be reproduced, stored in a retrieval system or transmitted in any form or by any means,
                electronic, mechanical or photocopying, recording, or otherwise without the prior permission of the publisher.</p>
        </footer>
	</body>
</html>