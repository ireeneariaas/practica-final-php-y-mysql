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
        // Iniciar la sesión para obtener el id_usuario del usuario logueado
        session_start();
        var_dump($_SESSION); // Verifica el contenido de la sesión
        

        // Obtener el id_usuario del usuario logueado
        $id_usuario = $_SESSION['id_usuario'];

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

        // Consulta para obtener los alquileres realizados por el usuario logueado
        $sql = "SELECT * FROM alquileres WHERE id_usuario = '$id_usuario'";

        // Ejecutar la consulta
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
            echo "<tr><td colspan='5'>No tienes alquileres en este momento.</td></tr>";
        }

        // Cerrar la conexión
        mysqli_close($conn);
        ?>
    </table>

</body>
</html>
