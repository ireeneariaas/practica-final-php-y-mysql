<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Coches</title>
    <style>
        body{background-color:gray;
            align: center;
            background-image: url("./concesionario.jpg");
            background-size: cover; 
            background-position: center; 
            height: 800px;
            margin: 0;
            font-family: Arial;
            align-items: center
        }

        table{background-color:white;
            width: 60%;
            text-align: center;
            align-items: center;
            border-collapse: collapse;
            margin: 0 auto; /* Esto centra la tabla */
        }

            
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

        td {color: #2f2f2f;}

        .logout-button {
    position: absolute;
    top: 10px;
    right: 10px;
    background-color: black; /* Color negro */
    color: white; /* Texto en blanco */
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}


    </style>
</head>
<body>
    <div id="titulo">
        <h1>COMPRADOR</h1>
        <form action="cerrar_sesion.php" method="post">
            <button type="submit" class="logout-button">Cerrar sesión</button>
        </form>
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
    <h1>Listado de Coches</h1>
    <table border=1>
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

    // Crear la conexión
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    // Verificar la conexión
    if (!$conn) {
        die("Conexión fallida: " . mysqli_connect_error());
    }

    // Consulta mejorada
    $sql = "SELECT c.id_coche, c.modelo, c.marca, c.color, c.precio, a.id_usuario 
            FROM coches c
            INNER JOIN alquileres a ON c.id_coche = a.id_coche
            INNER JOIN usuarios u ON a.id_usuario = u.id_usuario
            WHERE u.tipo = 'comprador'";

    $result = mysqli_query($conn, $sql);

    // Mostrar resultados
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row["id_coche"] . "</td>";
            echo "<td>" . $row["modelo"] . "</td>";
            echo "<td>" . $row["marca"] . "</td>";
            echo "<td>" . $row["color"] . "</td>";
            echo "<td>" . $row["precio"] . "</td>";
            echo "<td>Sí</td>"; // Alquilado siempre será "Sí" porque viene de la tabla alquileres
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='6'>No hay coches alquilados por compradores.</td></tr>";
    }

    // Cerrar la conexión
    mysqli_close($conn);
?>

    </table>

</body>
</html>
