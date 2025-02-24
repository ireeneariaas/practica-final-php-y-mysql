<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Alquileres</title>
    <style>
        body {
            background-color: gray;
            align: center;
            background-image: url("./concesionario.jpg");
            background-size: cover;
            background-position: center;
            height: 800px;
            margin: 0;
            font-family: Arial;
            align-items: center;
        }

        table {
            background-color: white;
            width: 60%;
            text-align: center;
            align-items: center;
            margin: 0 auto; /* Esto centra la tabla */
        }

        h1 {
            color: white;
        }

        #titulo {
            background-color: gray;
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

        td {
            color: #2f2f2f;
        }
        
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

        .logout-button:hover {
            background-color: #333; /* Color más oscuro al pasar el ratón */
        }
    </style>
</head>
<body>
    <div id="titulo">
        <h1>VENDEDOR</h1>
        <form action="cerrar_sesion.php" method="post">
            <button type="submit" class="logout-button">Cerrar sesión</button>
        </form>
    </div>
    <div>
        <ul class="menu">
            <li><a href="">Alquileres</a>
                <ul>
                    <li><a href="ven-alistar.php">Listar</a></li>
                    <li><a href="ven-aalquilar.php">Alquilar</a></li>
                </ul>
            </li>
        </ul>
    </div>
    <h1>Listado de tus coches en alquiler</h1>
    <table border="1">
        <tr>
            <th>ID alquiler</th>
            <th>ID coche</th>
            <th>prestado</th>
            <th>Devuelto</th>
        </tr>
        <?php
        session_start(); // Iniciar la sesión

        // Conexión a la base de datos
        $servername = "localhost";
        $username = "root";
        $password = "rootroot";
        $dbname = "concesionario";

        $conn = mysqli_connect($servername, $username, $password, $dbname);

        if (!$conn) {
            die("Conexión fallida: " . mysqli_connect_error());
        }

        // Obtener el ID del usuario desde la sesión
        $id_usuario = $_SESSION['id_usuario'];

        // Consulta para obtener los alquileres del usuario y los detalles de los coches
        $sql = "
            SELECT 
                alquileres.id_alquiler,coches.id_coche, coches.modelo, coches.marca, coches.color, coches.precio, alquileres.prestado, alquileres.devuelto
            FROM 
                alquileres
            JOIN 
                coches on alquileres.id_coche = coches.id_coche
            WHERE 
                alquileres.id_usuario = $id_usuario
        ";

        $result = mysqli_query($conn, $sql);

        if (!$result) {
            die("Error en la consulta: " . mysqli_error($conn));
        }

        // Mostrar los resultados de la consulta
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row["id_alquiler"] . "</td>";
                echo "<td>" . $row['id_coche'] . "</td>";
                echo "<td>" . $row['prestado'] . "</td>";
                // Aquí siempre se mostrará "No devuelto"
                echo "<td>No devuelto</td>";  
                echo "</tr>";
            }
        } else {
            // Mostrar mensaje en una fila que ocupe todas las columnas
            echo "<tr><td colspan='7'>No has realizado ningún alquiler.</td></tr>";
        }

        // Cerrar la conexión
        mysqli_close($conn);
        ?>
    </table>
</body>
</html>
