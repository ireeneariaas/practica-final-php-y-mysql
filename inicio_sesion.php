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
        <form id="loginForm" action="" method="post" onsubmit="return validateForm()">
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

    <!-- Div para el mensaje de error -->
    <div class="message" id="message"></div>

    <script>
        // Función para validar los campos del formulario
        function validateForm() {
            var usuario = document.getElementById('usuario').value;
            var contrasena = document.getElementById('contraseña').value; // Cambié aquí para que coincida con el nombre del campo
            var message = document.getElementById('message');

            // Verificar si los campos están vacíos
            if (usuario.trim() === "" || contrasena.trim() === "") {
                message.innerHTML = "<p style='color: red;'>Por favor, completa ambos campos.</p>";
                return false; // Impide que el formulario se envíe
            }

            // Si los campos son válidos
            message.innerHTML = "";
            return true; // Permite que el formulario se envíe
        }
    </script>
<?php
session_start();
ob_start(); // Previene errores de salida antes de header()

// Verificar si la sesión está funcionando correctamente
var_dump($_SESSION); // Muestra los datos almacenados en la sesión
echo "<br>";

if (empty(session_save_path())) {
    echo "<p style='color: red;'>Error: session.save_path no está configurado correctamente.</p>";
} else {
    echo "<p>Ruta de sesión: " . session_save_path() . "</p>";
}

// Datos de conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "rootroot";
$dbname = "concesionario";

// Crear la conexión
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Verificar la conexión
if (!$conn) {
    die("<p style='text-align: center; color: white;'>Conexión fallida: " . mysqli_connect_error() . "</p>");
}


// Verificar si el formulario fue enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_POST['usuario'];  // Nombre de usuario del formulario
    $contrasena = $_POST['contraseña'];  // Contraseña del formulario

    // Consulta para verificar si el usuario existe en la base de datos
    $sql = "SELECT * FROM usuarios WHERE nombre_usuario = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $usuario);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    // Verificar si el usuario existe
    if ($row = mysqli_fetch_assoc($result)) {
        if ($row['tipo'] == 'Administrador') {
            if ($contrasena == $row['password']) {
                $_SESSION['id_usuario'] = $row['id_usuario'];
                $_SESSION['usuario'] = $usuario;
                $_SESSION['tipo_usuario'] = $row['tipo'];

                // Verificar si la sesión está correctamente almacenada antes de redirigir
                if (!isset($_SESSION['id_usuario'])) {
                    echo "<p style='color: red;'>Error: No se guardó el ID de usuario en la sesión.</p>";
                    exit();
                }

                header("Location: admin-inicio.php");
                exit();
            } else {
                echo "<p style='text-align: center; color: white;'>Contraseña incorrecta para Administrador.</p>";
            }
        } else {
            if (password_verify($contrasena, $row['password'])) {
                $_SESSION['id_usuario'] = $row['id_usuario'];
                $_SESSION['usuario'] = $usuario;
                $_SESSION['tipo_usuario'] = $row['tipo'];

                // Verificar si la sesión está correctamente almacenada antes de redirigir
                if (!isset($_SESSION['id_usuario'])) {
                    echo "<p style='color: red;'>Error: No se guardó el ID de usuario en la sesión.</p>";
                    exit();
                }

                switch ($row['tipo']) {
                    case 'Vendedor':
                        header("Location: ven-vendedor.php");
                        exit();
                    case 'Comprador':
                        header("Location: comp-comprador.php");
                        exit();
                    default:
                        echo "<p style='text-align: center; color: white;'>Tipo de usuario desconocido.</p>";
                        break;
                }
            } else {
                echo "<p style='text-align: center; color: white;'>Contraseña incorrecta.</p>";
            }
        }
    } else {
        echo "<p style='text-align: center; color: white;'>Este usuario no está registrado en la base de datos del concesionario.</p>";
    }

    mysqli_stmt_close($stmt);
}

mysqli_close($conn);
?>


</body>
</html>
