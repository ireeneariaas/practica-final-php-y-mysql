<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Usuario</title>
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
            width: 95%;
        }

        th, td {
            border: 1px solid black;
            text-align: center;
        }

        input {
            width: 90%;
            padding: 4px;
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

        #div1 {
            background-color: white;
            width: 1100px;
            padding: 10px;
            margin: 0px auto;
            border-radius: 8px;
        }
    </style>
</head>
<body>

<div id="titulo">
    <h1>USUARIOS</h1>
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

<h1 style="text-align: center; color: white;">Modificar usuarios</h1>

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
    // Recorrer todos los usuarios y actualizar sus datos
    foreach ($_POST['id_usuario'] as $index => $id_usuario) {
        $nombre = $_POST['nombre'][$index];
        $apellidos = $_POST['apellidos'][$index];
        $dni = $_POST['dni'][$index];
        $saldo = $_POST['saldo'][$index];
        $tipo = $_POST['tipo'][$index];
        $nombre_usuario = $_POST['nombre_usuario'][$index];

        // Consulta SQL para actualizar el usuario
        $sql = "UPDATE usuarios SET nombre='$nombre', apellidos='$apellidos', dni='$dni', saldo='$saldo', tipo='$tipo', nombre_usuario='$nombre_usuario' WHERE id_usuario='$id_usuario'";

        // Ejecutar la consulta y verificar si se realizó correctamente
        if (!mysqli_query($conn, $sql)) {
            $mensaje = "<p class='message' style='color:white;'>No se ha podido actualizar el usuario con ID $id_usuario: " . mysqli_error($conn) . "</p>";
            break;
        }
    }

    // Si no hubo errores, se muestra el mensaje de éxito
    if (empty($mensaje)) {
        $mensaje = "<p class='message'>Todos los usuarios han sido actualizados con éxito.</p>";
    }
}

$sql = "SELECT * FROM usuarios";
$result = mysqli_query($conn, $sql);

echo "<div id='div1'>"; // El div1 sigue conteniendo la tabla y el formulario
echo "<form method='post'>";  // Abrir un solo formulario para todos los usuarios
echo "<table border=1>";
echo "<tr><th>ID</th><th>Nombre</th><th>Apellidos</th><th>DNI</th><th>Saldo</th><th>Tipo</th><th>Nombre de Usuario</th></tr>";

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>
                <td><input type='text' name='id_usuario[]' value='" . $row['id_usuario'] . "' readonly></td>
                <td><input type='text' name='nombre[]' value='" . $row['nombre'] . "'></td>
                <td><input type='text' name='apellidos[]' value='" . $row['apellidos'] . "'></td>
                <td><input type='text' name='dni[]' value='" . $row['dni'] . "'></td>
                <td><input type='text' name='saldo[]' value='" . $row['saldo'] . "'></td>
                <td><input type='text' name='tipo[]' value='" . $row['tipo'] . "'></td>
                <td><input type='text' name='nombre_usuario[]' value='" . $row['nombre_usuario'] . "'></td>
              </tr>";
    }
    echo "</table>";

    // Botón para actualizar todos los usuarios
    echo "<div style='text-align: center;'><button type='submit'>Modificar y Guardar</button></div>";
} else {
    echo "<p class='message'>No hay usuarios disponibles.</p>";
}

echo "</form>";  // Cerrar el formulario
echo "</div>"; // Cerrar el div1

// Mostrar el mensaje después de la tabla
echo $mensaje;

mysqli_close($conn);
?>

</body>
</html>
