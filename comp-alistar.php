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
        margin: 0 auto;
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

    .menu {
    display: flex;
    justify-content: center;
    background: #f1f1f1;
    border: 1px solid #ccc;
    margin: 0;
    padding: 0;
}

.menu > li {
    flex: none;
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

    .logout-button {
        position: absolute;
        top: 10px;
        right: 10px;
        background-color: black;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .devolver-button {
        display: block;
        margin: 20px auto;
        background-color: black;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .devolver-button:hover {
        background-color: darkgray;
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
    <h1>Listado de Alquileres</h1>
    <form method="POST" action="">
        <table border=1>
            <tr>
                <th>Seleccionar</th>
                <th>ID Alquiler</th>
                <th>ID Usuario</th>
                <th>ID Coche</th>
                <th>Fecha Prestado</th>
                <th>Fecha Devuelto</th>
            </tr>
            <?php
            session_start();
            $id_usuario = $_SESSION['id_usuario'];
            $servername = "localhost";
            $username = "root";
            $password = "rootroot";
            $dbname = "concesionario";

            $conn = mysqli_connect($servername, $username, $password, $dbname);

            if (!$conn) {
                die("Conexión fallida: " . mysqli_connect_error());
            }

            // Consulta para obtener los alquileres del usuario
            $sql = "SELECT * FROM alquileres WHERE id_usuario = '$id_usuario' AND devuelto IS NULL";  // Alquileres activos

            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td><input type='checkbox' name='devolver_ids[]' value='" . $row["id_alquiler"] . "'></td>";
                    echo "<td>" . $row["id_alquiler"] . "</td>";
                    echo "<td>" . $row["id_usuario"] . "</td>";
                    echo "<td>" . $row["id_coche"] . "</td>";
                    echo "<td>" . $row["prestado"] . "</td>";
                    echo "<td>" . ($row["devuelto"] ? $row["devuelto"] : 'No devuelto') . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6'>No tienes alquileres en este momento.</td></tr>";
            }

            // Procesar la devolución de coches seleccionados
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['devolver_ids'])) {
    $devolver_ids = $_POST['devolver_ids'];
    $fecha_devuelto = date('Y-m-d H:i:s'); // Fecha y hora actual

    foreach ($devolver_ids as $id_alquiler) {
        // Obtener el id_coche para actualizar su estado
        $sql_coche = "SELECT id_coche FROM alquileres WHERE id_alquiler = '$id_alquiler'";
        $result_coche = mysqli_query($conn, $sql_coche);
        $row_coche = mysqli_fetch_assoc($result_coche);
        $id_coche = $row_coche["id_coche"];

        // Mover el alquiler a la tabla de devoluciones sin eliminar
        $sql_devolucion = "INSERT INTO devoluciones (id_alquiler, id_usuario, id_coche, prestado, devuelto)
                           SELECT id_alquiler, id_usuario, id_coche, prestado, '$fecha_devuelto' FROM alquileres WHERE id_alquiler = '$id_alquiler'";
        mysqli_query($conn, $sql_devolucion);

        // Eliminar el coche de la tabla de alquileres (pero no de devoluciones)
        $sql_update_alquiler = "UPDATE alquileres SET devuelto = '$fecha_devuelto' WHERE id_alquiler = '$id_alquiler'";
        mysqli_query($conn, $sql_update_alquiler);

        // Cambiar el estado del coche a "no alquilado"
        $update_coches_sql = "UPDATE coches SET alquilado = 'no alquilado', id_usuario = NULL WHERE id_coche = '$id_coche'";
        mysqli_query($conn, $update_coches_sql);
    }

    // Recargar la página para reflejar los cambios
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}


            mysqli_close($conn);
            ?>
        </table>

        <!-- Botón para devolver los coches seleccionados -->
        <button type="submit" class="devolver-button">Devolver coches seleccionados</button>
    </form>
</body>
</html>
