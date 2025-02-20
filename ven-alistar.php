<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Alquileres</title>
    <style>
    body {
        background-color: gray;
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
        margin: 0 auto; /* Esto centra la tabla */
    }

    h1 {
        color: white;
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
</style>
</head>
<body>
    <div id="titulo">
        <h1>ALQUILERES</h1>
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
    <h1>Listado de Alquileres</h1>
    <table border=1>
        <tr>
            <th>ID Alquiler</th>
            <th>ID Usuario</th>
            <th>ID Coche</th>
            <th>Fecha Prestado</th>
            <th>Fecha Devuelto</th>
        </tr>
    <?php
        // Datos de conexión a la base de datos
        $servername = "localhost";  // Cambia esto si el servidor es diferente
        $username = "root";         // Usuario de MySQL
        $password = "rootroot";     // Contraseña de MySQL (cambia esto si es diferente)
        $dbname = "concesionario";  // Nombre de la base de datos existente

        // Crear la conexión
        $conn = mysqli_connect($servername, $username, $password, $dbname);

        // Verificar la conexión
        if (!$conn) {
            die("Conexión fallida: " . mysqli_connect_error());
        }

        // Consulta para obtener todos los alquileres
        $sql = "SELECT * FROM alquileres";
        $result = mysqli_query($conn, $sql);

        // Verificar si hay resultados
        if (mysqli_num_rows($result) > 0) {
            // Mostrar cada fila de datos en la tabla
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row["id_alquiler"] . "</td>"; // Mostrar ID Alquiler
                echo "<td>" . $row["id_usuario"] . "</td>"; // Mostrar ID Usuario
                echo "<td>" . $row["id_coche"] . "</td>"; // Mostrar ID Coche
                echo "<td>" . $row["prestado"] . "</td>"; // Mostrar Fecha Prestado
                echo "<td>" . $row["devuelto"] . "</td>"; // Mostrar Fecha Devuelto
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No se encontraron alquileres en la base de datos.</td></tr>";
        }

        // Cerrar la conexión
        mysqli_close($conn);
    ?>
    </table>

</body>
</html>
