<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Coche</title>
    <style>
        body {
            background-color: gray;
            font-family: Arial, sans-serif;
            margin: 0;
            background-image: url("./concesionario.jpg");
            background-size: cover;
            background-position: center;
            height: 800px;
        }

        #titulo {
            background-color: gray;
            color: white;
            padding: 0;  /* Eliminar padding */
            margin: 0;   /* Eliminar margen */
            text-align: center;
        }

        h1 {
            margin: 0; /* Eliminar el margen predeterminado */
            padding: 10px 0; /* Establecer padding adecuado */
        }

        table {
            background-color: white;
            margin: 20px auto;
            border-collapse: collapse;
            width: 80%;
        }

        th, td {
            border: 1px solid black;
            padding: 10px;
            text-align: center;
        }

        input {
            width: 90%;
            padding: 5px;
        }

        button {
            background-color: black;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }

        .message {
            text-align: center;
            color: white;
            font-size: 18px;
            margin-top: 20px;
        }

        /* Estilos del menú */
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

        .menu {
            display: flex;
            justify-content: center;
            background: #f1f1f1;
            border: 1px solid #ccc;
            margin: 0;
            padding: 0;
        }
    </style>
</head>
<body>

<div id="titulo">
    <h1>COCHES</h1>
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

<h1 style="text-align: center; color: white;">Modificar coches</h1>

<?php
$servername = "localhost";
$username = "root";
$password = "rootroot";
$dbname = "concesionario";

$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("Error de conexión: " . mysqli_connect_error());
}

$mensaje = ''; // Variable para almacenar el mensaje de éxito o error

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recorrer todos los coches y actualizar sus datos
    foreach ($_POST['id_coche'] as $index => $id_coche) {
        $modelo = $_POST['modelo'][$index];
        $marca = $_POST['marca'][$index];
        $color = $_POST['color'][$index];
        $precio = $_POST['precio'][$index];
        $alquilado = isset($_POST['alquilado'][$index]) ? 1 : 0; // Si está marcado, será 1 (alquilado), de lo contrario 0

        // Consulta SQL para actualizar el coche
        $sql = "UPDATE Coches SET modelo='$modelo', marca='$marca', color='$color', precio='$precio', alquilado='$alquilado' WHERE id_coche='$id_coche'";

        // Ejecutar la consulta y verificar si se realizó correctamente
        if (!mysqli_query($conn, $sql)) {
            $mensaje = "<p class='message' style='color:white;'>No se ha podido actualizar el coche con ID $id_coche: " . mysqli_error($conn) . "</p>";
            break;
        }
    }

    // Si no hubo errores, se muestra el mensaje de éxito
    if (empty($mensaje)) {
        $mensaje = "<p class='message'>Todos los coches han sido actualizados con éxito.</p>";
    }
}

$sql = "SELECT * FROM Coches";
$result = mysqli_query($conn, $sql);

echo "<form method='post'>";  // Abrir un solo formulario para todos los coches
echo "<table>";
echo "<tr><th>ID</th><th>Modelo</th><th>Marca</th><th>Color</th><th>Precio</th><th>Alquilado</th></tr>";

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>
                <td><input type='text' name='id_coche[]' value='" . $row['id_coche'] . "' readonly></td>
                <td><input type='text' name='modelo[]' value='" . $row['modelo'] . "'></td>
                <td><input type='text' name='marca[]' value='" . $row['marca'] . "'></td>
                <td><input type='text' name='color[]' value='" . $row['color'] . "'></td>
                <td><input type='text' name='precio[]' value='" . $row['precio'] . "'></td>
                <td><input type='checkbox' name='alquilado[]' value='1' " . ($row['alquilado'] ? "checked" : "") . "></td>
              </tr>";
    }
    echo "</table>";

    // Botón para actualizar todos los coches
    echo "<div style='text-align: center;'><button type='submit'>Actualizar y Guardar</button></div>";
} else {
    echo "<p class='message'>No hay coches disponibles.</p>";
}

echo "</form>";  // Cerrar el formulario

// Mostrar el mensaje después de la tabla
echo $mensaje;

mysqli_close($conn);
?>

</body>
</html>
