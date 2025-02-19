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
            
            $opcion=$_REQUEST['opcion'];
            $valor=$_REQUEST['valor'];
            
            if ($opcion=="alquilado" && $valor=="Si"){
                $valor=1;
            }
            else if ($opcion=="alquilado" && $valor=="No"){
                $valor=0;
            }

            $sql = "select * from coches where $opcion = '$valor'";
            $result= mysqli_query($conn,$sql);

            if (mysqli_num_rows($result)>0){
                while($row=mysqli_fetch_assoc($result)){
        ?>
            <form action="modificar3.php" method="post">
                <input type="text" readonly name="id" value="<?php echo $row['id_coche']; ?>"><br><br>
                <label for="modelo">Modelo:</label>
                <input type="text" name="modelo" value="<?php echo $row['modelo']; ?>" required><br>
                <label for="marca">Marca:</label>
                <input type="text" name="marca" value="<?php echo $row['marca']; ?>" required><br>
                <label for="color">Color:</label>
                <input type="text" name="color" value="<?php echo $row['color']; ?>" required><br>
                <label for="precio">Precio:</label>
                <input type="number" name="precio" value="<?php echo $row['precio']; ?>" required><br>
                <label for="alquilado">Alquilado:</label>
                <select name="alquilado">
                <option value="1" <?php if ($row['alquilado'] == '1') echo 'selected'; ?> >Si está alquilado</option>
                <option value="0" <?php if ($row['alquilado'] == '0') echo 'selected'; ?> >No está alquilado</option>
                </select><br>
                <label for="foto">Foto:</label>
                <input type="text" name="foto" value="<?php echo $row['foto']; ?>" required><br>
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