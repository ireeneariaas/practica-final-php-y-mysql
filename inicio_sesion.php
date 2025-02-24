<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <style>
        #div1 {
            background-color: white;
            width: 350px;
            padding-left: 50px;
            padding-right: 70px;
            padding-top: 10px;
            padding-bottom: 10px;
            margin: 50px auto;
            border-radius: 8px;
        }

        label {
            display: block;
            margin: 10px 0 5px;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
        }

        button {
            background-color: black;
            color: white;
            padding: 10px 20px;
            border: none;
        }

        button:hover {
            background-color: #45a049;
        }

        .message {
            margin-top: 10px;
            text-align: center;
            color: white;
        }

        body {
            margin: 0;
            font-family: Arial;
            background-image: url("./concesionario.jpg");
            background-size: cover;
            background-position: center;
            height: 800px;
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

        #div2 {
            text-align: center;
        }

        h2 {padding-bottom: 11px;}
    </style>
</head>
<body>
    <div id="titulo">
        <h1>CONCESIONARIO</h1>
    </div>

    <div id="div1">
        <h2>Iniciar Sesión</h2>
        <form id="loginForm" action="" method="post">
            <label for="usuario">Usuario</label>
            <input type="text" id="usuario" name="usuario" required>

            <label for="contraseña">Contraseña</label>
            <input type="password" id="contraseña" name="contraseña" required><br><br>
            <div id="div2">
                <button type="submit">Iniciar Sesión</button><br><br>
                <p> Si aún <b>no estás registrado</b> en nuestro concesionario, <a href='./registrarse.php'>hazlo ahora</a></p>
            </div>
        </form>
    </div>

    <div class="message" id="message"></div>
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

$error_message = "";

// Procesar el formulario de inicio de sesión
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['usuario']) && isset($_POST['contraseña'])) {
    $nombre_usuario = mysqli_real_escape_string($conn, $_POST['usuario']);
    $contraseña = mysqli_real_escape_string($conn, $_POST['contraseña']);

    // Consulta para verificar las credenciales
    $sql = "SELECT id_usuario, nombre, tipo, saldo FROM usuarios WHERE nombre_usuario = '$nombre_usuario' AND password = '$contraseña'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        // Crear la sesión
        $_SESSION['id_usuario'] = $row['id_usuario']; // Almacenar el ID del usuario
        $_SESSION['nombre_usuario'] = $nombre_usuario; // Almacenar el nombre de usuario
        $_SESSION['nombre'] = $row['nombre']; // Almacenar el nombre real del usuario
        $_SESSION['tipo'] = $row['tipo']; // Almacenar el tipo de usuario
        $_SESSION['saldo'] = $row['saldo']; // Almacenar el saldo del usuario

        // Redirigir según el tipo de usuario
        if ($row['tipo'] == 'Vendedor') {
            header("Location: ven-vendedor.php");
            exit();
        } elseif ($row['tipo'] == 'Comprador') {
            header("Location: comp-comprador.php");
            exit();
        } elseif ($row['tipo'] == 'Administrador') {
            header("Location: admin-inicio.php");
            exit();
        }
    } else {
        // Credenciales incorrectas
        $error_message = "Usuario o contraseña incorrectos";
    }

    mysqli_free_result($result);
}

mysqli_close($conn);
?>
</body>
</html>