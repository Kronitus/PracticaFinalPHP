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
            if ($_SESSION['tipo']=='administrador') {
                $id_usuario = $_POST['id_usuario'];
            }
            else{
                $id_usuario = $_SESSION['id_usuario'];
            }

            $sql = "select * from usuarios where id_usuario = $id_usuario";

            $result= mysqli_query($conn,$sql);
            
            if (mysqli_num_rows($result)>0){
                while($row=mysqli_fetch_assoc($result)){
        ?>
            <form action="modificar3.php" method="post">
                <input type="text" readonly name="id" value="<?php echo $row['id_usuario']; ?>"><br><br>
                <label for="password">Contraseña:</label>
                <input type="password" name="password" value="<?php echo $row['password']; ?>" required><br>
                <label for="nombre">Nombre:</label>
                <input type="text" name="nombre" value="<?php echo $row['nombre']; ?>" required><br>
                <label for="apellidos">Apellido:</label>
                <input type="text" name="apellidos" value="<?php echo $row['apellidos']; ?>" required><br>
                <label for="dni">DNI:</label>
                <input type="text" name="dni" value="<?php echo $row['dni']; ?>" required><br>
                <label for="saldo">Saldo:</label>
                <input type="number" name="saldo" value="<?php echo $row['saldo']; ?>" required><br>
                <?php
                    if ($_SESSION['tipo']=='administrador'){ ?>
                    <label for="tipo">Tipo de usuario:</label>
                    <select name="tipo">
                        <option value="comprador" <?php if ($row['tipo_usuario'] == 'comprador') echo 'selected'; ?> >Comprador</option>
                        <option value="vendedor" <?php if ($row['tipo_usuario'] == 'vendedor') echo 'selected'; ?> >Vendedor</option>
                        <option value="administrador" <?php if ($row['tipo_usuario'] == 'administrador') echo 'selected'; ?> >Administrador</option>
                    </select><br>
                    <?php } ?>
                <input type="submit" value="Actualizar">
            </form>
            <?php
            }}
            ?>
        </main>
        <footer class="footer">
            <p> © 2024. All rights reserved. No part of this publication can be reproduced, stored in a retrieval system or transmitted in any form or by any means,
                electronic, mechanical or photocopying, recording, or otherwise without the prior permission of the publisher.</p>
        </footer>
	</body>
</html>