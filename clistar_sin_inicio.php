<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Coches</title>
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
        <h1>COCHES</h1>
</div>
        
<form action="inicio_sesion.php" method="post">
	<button type="submit" class="logout-button">Iniciar sesión</button>
</form>
    <h1>Listado de Coches</h1>
    <table border=1>
        <tr>
            <th>Modelo</th>
            <th>Marca</th>
            <th>Color</th>
            <th>Precio</th>
            <th>Alquilado</th>
        </tr>
        <?php
        // Datos de conexión a la base de datos
        $servername = "localhost";  // Cambia esto si el servidor es diferente
        $username = "root";         // Usuario de MySQL
        $password = "rootroot";        // Contraseña de MySQL (cambia esto si es diferente)
        $dbname = "concesionario";  // Nombre de la base de datos existente

        // Crear la conexión
        $conn = mysqli_connect($servername, $username, $password, $dbname);

        // Verificar la conexión
        if (!$conn) {
            die("Conexión fallida: " . mysqli_connect_error());
        }

        // Consulta para obtener todos los coches
        $sql = "SELECT * FROM coches";
        $result = mysqli_query($conn, $sql);

        // Verificar si hay resultados
        if (mysqli_num_rows($result) > 0) {
            // Mostrar cada fila de datos en la tabla
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row["id_coche"] . "</td>"; // Mostrar ID
                echo "<td>" . $row["modelo"] . "</td>"; // Mostrar Modelo
                echo "<td>" . $row["marca"] . "</td>"; // Mostrar Marca
                echo "<td>" . $row["color"] . "</td>"; // Mostrar Color
                echo "<td>" . $row["precio"] . "</td>"; // Mostrar Precio
                echo "<td>" . ($row["alquilado"] == "No alquilado" ? "No alquilado" : "Alquilado") . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No se encontraron coches en la base de datos.</td></tr>";
        }

        // Cerrar la conexión
        mysqli_close($conn);
    ?>
    </table>

</body>
</html>
