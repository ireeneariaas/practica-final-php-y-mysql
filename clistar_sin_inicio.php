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
    </style>
</head>
<body>
    <div id="titulo">
        <h1>COCHES</h1>
    </div>
    <h1>Listado de Coches</h1>
    <table border=1 style="margin: auto;">

        <tr>
            <th>ID</th>
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
                echo "<td>" . ($row["alquilado"] ? "Sí" : "No") . "</td>"; // Mostrar si está alquilado
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
