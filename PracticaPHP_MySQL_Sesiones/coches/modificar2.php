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
            $id_coche = $_POST['id_coche'];

            $sql = "select * from coches where id_coche = $id_coche";

            $result= mysqli_query($conn,$sql);
            
            if (mysqli_num_rows($result)>0){
                while($row=mysqli_fetch_assoc($result)){
        ?>
            <form action="modificar3.php" method="post">
                <input type="text" readonly name="id" value="<?php echo $row['id_coche']; ?>"><br><br>
                <label for="marca">Marca:</label>
                <input type="text" name="marca" value="<?php echo $row['marca']; ?>" required><br>
                <label for="modelo">Modelo:</label>
                <input type="text" name="modelo" value="<?php echo $row['modelo']; ?>" required><br>
                <label for="color">Color:</label>
                <input type="text" name="color" value="<?php echo $row['color']; ?>" required><br>
                <label for="precio">Precio:</label>
                <input type="number" name="precio" value="<?php echo $row['precio']; ?>" required><br>
                <label for="foto">Foto:</label>
                <input type="file" name="foto" accept="image/*" value="<?php echo $row['foto']; ?>" required><br>
                <input type="submit" value="Actualizar">
            </form>
            <?php
            }
            ?>
        </main>
        <footer class="footer">
            <p> © 2024. All rights reserved. No part of this publication can be reproduced, stored in a retrieval system or transmitted in any form or by any means,
                electronic, mechanical or photocopying, recording, or otherwise without the prior permission of the publisher.</p>
        </footer>
	</body>
</html>
<?php
}
else{
    echo "No se encontró ningún coche con ese valor.";
}
mysqli_close($conn);
?>