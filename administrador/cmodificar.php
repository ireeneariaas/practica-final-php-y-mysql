<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Añadir Coche</title>
    <style>
        body {
            background-color: gray;
            font-family: Arial, sans-serif;
        }

        #div1 {
            background-color: white;
            width: 300px;
            padding: 20px;
            padding-right: 40px;
            margin: 50px auto;
            border-radius: 8px;
        }

        label {
            display: block;
            margin: 10px 0 5px;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
        }

        button {
            background-color: black;
            color: white;
            padding: 10px 20px;
            border: none;}

        button:hover {
            background-color: #45a049;
        }

        .message {
            margin-top: 10px;
            text-align: center;
        }
        body {
            margin: 0; /* Elimina margen global del cuerpo */
            font-family: Arial;
            background-image: url("../concesionario.jpg");
            background-size: cover; /* La imagen cubre toda la pantalla */
            background-position: center; /* Centra la imagen de fondo */
            height: 800px;
        }

        #titulo {
            background-color: gray;
            color: white;
            margin: 0;
            padding: 0;
        }

        h1 {
            margin: 0;
            padding: 10px;
            text-align: center;
            color: white;
        }

        /* Estilos generales para el menú */
        ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        li {
            position: relative;
        }

        ul ul {
            display: none;
            position: absolute;
            left: 0;
            background: #f9f9f9;
            padding: 0;
            border: 1px solid #ccc;
        }

        li:hover > ul {
            display: block;
        }

        a {
            text-decoration: none;
            padding: 10px 15px;
            display: block;
            color: #333;
            white-space: nowrap;
        }

        /* Menú principal en horizontal */
        .menu {
            display: flex;
            justify-content: center; /* Centra el menú horizontalmente */
            background: #f1f1f1;
            border: 1px solid #ccc;
            margin: 0;
            padding: 0;
        }
        #div3 {
            background-color: white;
            padding: 10px;
            margin-left: auto;
            margin-right: auto;
            width: 400px;
            border-radius: 8px;
        }

        form {
            margin: 0;
            padding: 0;
        }

        form input {
            margin: 2px 0; 
            padding: 5px;
            width:380px; 
        }
    </style>
</head>
<body>
    <div id="titulo">
        <h1>COCHES</h1>
    </div>
    <div>
        <ul class="menu">
        <li><a href="inicio.html">Inicio</a></li>
            <li><a href="">Coches</a>
                <ul>
                    <li><a href="clistar.php">Listar</a></li>
                    <li><a href="canadir.php">Añadir</a></li>
                    <li><a href="cbuscar.php">Buscar</a></li>
                    <li><a href="cmodificar.php">Modificar</a></li>
                    <li><a href="cborrar.php">Borrar</a></li>
                </ul>
            </li>
            <li><a href="">Usuarios</a>
                <ul>
                    <li><a href="ulistar.php">Listar</a></li>
                    <li><a href="uanadir.php">Añadir</a></li>
                    <li><a href="ubuscar.php">Buscar</a></li>
                    <li><a href="umodificar.php">Modificar</a></li>
                    <li><a href="uborrar.php">Borrar</a></li>
                </ul>
            </li>
            <li><a href="">Alquileres</a>
                <ul>
                    <li><a href="alistar.php">Listar</a></li>
                    <li><a href="aborrar.php">Borrar</a></li>
                </ul>
            </li>
        </ul>
    </div>
    <h1>Actualizar coche por ID</h1>
    <div id="div3">
        <form action="" method="post">
        Id del coche<input type="text" name="id_coche" id="id_coche" size="5"><br>
        <input type="submit" value="Actualizar">
    </form>
    </div>
    <?php
        // Datos de conexión a la base de datos
        $servername = "localhost";  // Cambia esto si el servidor es diferente
        $username = "root";         // Usuario de MySQL
        $password = "irene";             // Contraseña de MySQL
        $dbname = "concesionario";  // Nombre de la base de datos existente

        $conn = mysqli_connect($servername, $username, $password, $dbname);
    
        $id_coche=$_POST['id_coche'];
        $modelo = $_POST['modelo'];
        $marca = $_POST['marca'];
        $color = $_POST['color'];
        $precio = $_POST['precio'];
        $alquilado = isset($_POST['alquilado']) ? 1 : 0;

        // Preparar y ejecutar la consulta de inserción
        $sql = "UPDATE Coches SET modelo='$modelo', marca='$marca', color='$color', precio='$precio', alquilado='$alquilado' WHERE id_coche='$id_coche'";

        if (mysqli_query($conn, $sql)) {
            echo "<p style='text-align: center; color: white;'>coche actualizado con éxito.</p>";
        } else {
            echo "Error al actualizar: " . mysqli_error($conn);
        }

        // Cerrar la conexión
        mysqli_close($conn);
?>
</body>
</html>
