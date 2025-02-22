<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscar Coches</title>
    <style>
         body{background-color:gray;
            align: center;
            background-image: url("./concesionario.jpg");
            background-size: cover; 
            background-position: center; 
            height: 800px;
            margin: 0;
            font-family: Arial;}
        #centrar {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 20px;}
        
        table{background-color:white;
            width: 60%;
            text-align: center}
      
        
        body{background-color:gray;
            align: center;
            background-image: url("./concesionario.jpg");
            margin: 0;
            font-family: Arial;}

        table{background-color:white;
            width: 60%;
            text-align: center;
            align-items: center;}
            
        h1{color:white;}
       
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
        #div3 {
            background-color: white;
            padding: 20px;
            margin-left: auto;
            margin-right: auto;
            margin-top:20px;
            width: 470px;
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
        <h1>COMRPADOR</h1>
    </div>
    <div>
        <ul class="menu">
            <li><a href="">Coches</a>
                <ul>
                    <li><a href="comp-clistar.php">Listar</a></li>
                    <li><a href="comp-cbuscar.php">Buscar</a></li>
                </ul>
            </li>
            <li><a href="">Alquileres</a>
                <ul>
                    <li><a href="comp-alistar.php">Listar</a></li>
                    <li><a href="comp-aalquilar.php">Alquilar</a></li>
                </ul>
            </li>
        </ul>
    </div>
    <h1>Buscar Coches</h1>
    <div id="div3">
    <p color="black" align="justify">Se puede buscar por cualquier rasgo del coche, es decir, por su modelo, marca, color, precio o por si esta alquilado</p>
    <div class="search-box">
        <form action="" method="get">
            <input type="text" name="buscar" placeholder="Buscar coche por modelo, marca, color, precio o alquilado..." value="<?php echo isset($_GET['buscar']) ? $_GET['buscar'] : ''; ?>" required>
            <button type="submit">Buscar</button><br><br>
        </form>
    </div>
    </div>
    <div id="centrar">
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Modelo</th>
            <th>Marca</th>
            <th>Color</th>
            <th>Precio</th>
            <th>Alquilado</th>
        </tr>
        
        <?php
    // Datos de conexión
    $servername = "localhost";
    $username = "root";
    $password = "rootroot";
    $dbname = "concesionario";

    // Iniciar sesión (para obtener el ID del usuario logueado)
    session_start();

    // Crear la conexión
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    // Verificar la conexión
    if (!$conn) {
        die("Conexión fallida: " . mysqli_connect_error());
    }

    // Verificar si hay una búsqueda
    if (isset($_GET['buscar']) && !empty($_GET['buscar'])) {
        $buscar = mysqli_real_escape_string($conn, $_GET['buscar']);
        // Consulta usando JOIN implícito
        $sql = "SELECT coches.* 
                FROM coches, alquileres 
                WHERE coches.id_coche = alquileres.id_coche
                AND alquileres.devuelto IS NULL
                AND (coches.modelo LIKE '%$buscar%'
                OR coches.marca LIKE '%$buscar%'
                OR coches.color LIKE '%$buscar%'
                OR coches.precio LIKE '%$buscar%')";
    } else {
        // Consulta para obtener los coches alquilados por cualquier usuario y que no han sido devueltos
        $sql = "SELECT coches.* 
                FROM coches, alquileres 
                WHERE coches.id_coche = alquileres.id_coche
                AND alquileres.devuelto IS NULL";
    }

    // Ejecutar la consulta
    $result = mysqli_query($conn, $sql);

    // Mostrar los resultados
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row["id_coche"] . "</td>";
            echo "<td>" . $row["modelo"] . "</td>";
            echo "<td>" . $row["marca"] . "</td>";
            echo "<td>" . $row["color"] . "</td>";
            echo "<td>" . $row["precio"] . "</td>";
            echo "<td>Sí</td>";  // Solo mostramos coches alquilados
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='6'>No se encontraron coches alquilados.</td></tr>";
    }

    // Cerrar la conexión
    mysqli_close($conn);
?>

    </table>
    </div>

</body>
</html>
