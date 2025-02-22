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

        #precio {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
        }

        #color{
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
        }

        #modelo{
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
        }

        #marca{
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
            background-image: url("./concesionario.jpg");
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

        a:hover {
            background: #ddd;
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

        .menu > li {
            flex: none;
        }

        #div2{text-align: center;}

        .logout-button {
            position: absolute;
            top: 10px;
            right: 10px;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }


    </style>
</head>
<body>
    <div id="titulo">
        <h1>COCHES</h1>
        <form action="cerrar_sesion.php" method="post">
	<button type="submit" class="logout-button">Cerrar sesión</button>
</form>
    </div>
    <div>
        <ul class="menu">
            <li><a href="">Coches</a>
                <ul>
                    <li><a href="admin-clistar.php">Listar</a></li>
                    <li><a href="admin-canadir.php">Añadir</a></li>
                    <li><a href="admin-cbuscar.php">Buscar</a></li>
                    <li><a href="admin-cmodificar.php">Modificar</a></li>
                    <li><a href="admin-cborrar.php">Borrar</a></li>
                </ul>
            </li>
            <li><a href="">Usuarios</a>
                <ul>
                    <li><a href="admin-ulistar.php">Listar</a></li>
                    <li><a href="admin-uanadir.php">Añadir</a></li>
                    <li><a href="admin-ubuscar.php">Buscar</a></li>
                    <li><a href="admin-umodificar.php">Modificar</a></li>
                    <li><a href="admin-uborrar.php">Borrar</a></li>
                </ul>
            </li>
            <li><a href="">Alquileres</a>
                <ul>
                    <li><a href="admin-alistar.php">Listar</a></li>
                    <li><a href="admin-aborrar.php">Borrar</a></li>
                </ul>
            </li>
        </ul>
    </div>
    <div id="div1">
        <h2>Añadir Coche</h2>
        <form action="" method="post">
            <label for="modelo">Modelo</label>
            <input type="text" id="modelo" name="modelo">
            <label for="marca">Marca</label>
            <input type="text" id="marca" name="marca">
            <label for="color">Color</label>
            <input type="text" id="color" name="color">
            <label for="precio">Precio</label>
            <input type="number" id="precio" name="precio"><br><br>
            <input type="checkbox" id="alquilado" name="alquilado" value="1">Alquilado
            <div id="div2">
                <br><button type="submit">Añadir</button>
            </div>
        </form>
    </div>

    <div class="message">
        <?php
        // Verificar si el formulario ha sido enviado
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // Datos de conexión a la base de datos
            $servername = "localhost";  // Cambia esto si el servidor es diferente
            $username = "root";         // Usuario de MySQL
            $password = "rootroot";             // Contraseña de MySQL
            $dbname = "concesionario";  // Nombre de la base de datos existente

            // Crear la conexión
            $conn = mysqli_connect($servername, $username, $password, $dbname);

            // Verificar la conexión
            if (!$conn) {
                die("Conexión fallida: " . mysqli_connect_error());
            }

            // Recibir los datos del formulario
            $modelo = $_POST['modelo'];
            $marca = $_POST['marca'];
            $color = $_POST['color'];
            $precio = $_POST['precio'];
            $alquilado = isset($_POST['alquilado']) ? 1 : 0;

            // Construir la consulta SQL directamente
            $sql = "INSERT INTO Coches (modelo, marca, color, precio, alquilado) 
                    VALUES ('$modelo', '$marca', '$color', $precio, $alquilado)";

            // Ejecutar la consulta
            if (mysqli_query($conn, $sql)) {
                echo "<p style='text-align: center; color: white;'>Coche añadido correctamente.</p>";
            } else {
                echo "<p>Error: " . mysqli_error($conn) . "</p>";
            }

            // Cerrar la conexión
            mysqli_close($conn);
        }
        ?>
    </div>

</body>
</html>
