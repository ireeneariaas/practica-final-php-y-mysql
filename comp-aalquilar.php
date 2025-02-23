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
        }

        h1 {
            color: white;
            text-align: center;
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
            justify-content: center;
            background: #f1f1f1;
            border: 1px solid #ccc;
            margin: 0;
            padding: 0;
        }

        .menu > li {
            flex: none;
        }

        .center {
            text-align: center;
            margin-top: 20px;
            color: white;
        }

        table {
            margin: 0 auto;
            background-color: white;
            width: 95%;
        }

        table th, table td {
            border: 1px solid black;
            text-align: center;
        }

        button {
            background-color: black;
            color: white;
            padding: 10px 20px;
            border: 1px solid #ccc;
            cursor: pointer;
        }

        button:hover {
            background-color: #b0b0b0;
        }

        #div1 {
            background-color: white;
            width:600px;
            padding: 20px;
            margin: 0px auto;
            border-radius: 8px;
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
    <h1>Alquilar un coche</h1>

    <div class="message">
    <?php
session_start();
var_dump($_SESSION); // Verifica el contenido de la sesión

// Obtener el id_usuario del usuario logueado
$id_usuario = $_SESSION['id_usuario'];

// Datos de conexión a la base de datos
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

// Consulta para obtener los coches no alquilados
$sql = "SELECT id_coche, modelo, marca, color, precio, alquilado FROM coches WHERE alquilado='no alquilado'";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_execute($stmt);
$result_coches = mysqli_stmt_get_result($stmt);

if ($result_coches && mysqli_num_rows($result_coches) > 0) {
    echo "<form action='' method='POST'>";
    echo "<table border='1'>
            <tr>
                <th>Seleccionar</th>
                <th>Modelo</th>
                <th>Marca</th>
                <th>Color</th>
                <th>Precio</th>
                <th>Alquilado</th>
            </tr>";

    while ($row = mysqli_fetch_assoc($result_coches)) {
        echo "<tr>";
        echo "<td><input type='checkbox' name='alquilar_ids[]' value='" . $row['id_coche'] . "'></td>";
        echo "<td>" . htmlspecialchars($row['modelo']) . "</td>";
        echo "<td>" . htmlspecialchars($row['marca']) . "</td>";
        echo "<td>" . htmlspecialchars($row['color']) . "</td>";
        echo "<td>" . htmlspecialchars($row['precio']) . "</td>";
        echo "<td>" . htmlspecialchars($row['alquilado']) . "</td>";
        echo "</tr>";
    }

    echo "</table>";
    echo "<div class='center'><button type='submit'>Alquilar</button></div>";
    echo "</form>";
} else {
    echo "<div class='center'><h2>No hay coches disponibles</h2></div>";
}

// Procesar alquiler de coches seleccionados
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['alquilar_ids'])) {
    $alquilar_ids = $_POST['alquilar_ids'];

    foreach ($alquilar_ids as $id_coche) {
        // Insertar en la tabla alquileres con una fecha actual
        $prestado = date('Y-m-d H:i:s');
        $insert_sql = "INSERT INTO alquileres (id_usuario, id_coche, prestado) VALUES (?, ?, ?)";
        $stmt_insert = mysqli_prepare($conn, $insert_sql);
        mysqli_stmt_bind_param($stmt_insert, "iis", $id_usuario, $id_coche, $prestado);

        if (mysqli_stmt_execute($stmt_insert)) {
            // Actualizar el coche como alquilado y asociar el id_usuario en la tabla coches
            $update_sql = "UPDATE coches SET alquilado='alquilado', id_usuario=? WHERE id_coche=?";
            $stmt_update = mysqli_prepare($conn, $update_sql);
            mysqli_stmt_bind_param($stmt_update, "ii", $id_usuario, $id_coche);

            if (mysqli_stmt_execute($stmt_update)) {
                echo "<div class='center'><p>El coche con ID $id_coche ha sido alquilado correctamente.</p></div>";
            } else {
                echo "<div class='center'><p>Error al actualizar el estado del coche con ID $id_coche.</p></div>";
            }
        } else {
            echo "<div class='center'><p>Error al registrar el alquiler del coche con ID $id_coche.</p></div>";
        }
    }
}

// Cerrar conexión
mysqli_close($conn);
?>

    </div>
</body>
</html>
