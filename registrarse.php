<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Usuario</title>
    <style>
        #titulo {
            background-color: gray;
            color: white;
            margin: 0px;
            padding: 0px;
            text-align:center;
        }

        #div1 {
            background-color: white;
            width: 350px;
            padding-left: 50px;
            padding-right: 70px;
            padding-top: 8px;
            padding-bottom: 8px;
            margin: 50px auto;
            margin-top: 22px;
            border-radius: 8px;
        }

        #div2 {
            text-align: center;
        }

        h1 {
            margin: 0;
            padding: 10px;
            text-align: center;
        }

        label {
            display: block;
            margin: 10px 0 5px;
        }

        #nombre_usuario {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
        }

        #nombre {width: 100%;
            padding: 8px;
            margin-bottom: 10px;}

        #apellidos {width: 100%;
            padding: 8px;
            margin-bottom: 10px;}

        #dni {width: 100%;
            padding: 8px;
            margin-bottom: 10px;}

        #saldo {width: 100%;
            padding: 8px;
            margin-bottom: 10px;}

        #pass {width: 100%;
            padding: 8px;
            margin-bottom: 10px;}

        #pass_repeat {width: 100%;
            padding: 8px;
            margin-bottom: 10px;}

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
        }

        body {
            margin: 0;
            font-family: Arial;
            background-image: url("./concesionario.jpg");
            background-size: cover;
            background-position: center;
            height: 800px;
        }

        #responseMessage {
            text-align: center;
            margin-top: 20px;
            font-size: 18px;
        }

        .success {
            color: white;
        }

        .error {
            color: white;
        }
    </style>
</head>
<body>
    <div id="titulo">
        <h1>CONCESIONARIO</h1>
    </div>
    <div id="div1">
        <h2>Registrar Usuario</h2>
        <form action="registrarse.php" method="POST">
            <label for="nombre_usuario">Nombre de Usuario</label>
            <input type="text" id="nombre_usuario" name="nombre_usuario" required>

            <label for="nombre">Nombre</label>
            <input type="text" id="nombre" name="nombre" required>

            <label for="apellidos">Apellidos</label>
            <input type="text" id="apellidos" name="apellidos" required>

            <label for="dni">DNI</label>
            <input type="text" id="dni" name="dni" required>

            <label for="saldo">Saldo</label>
            <input type="number" step="0.01" id="saldo" name="saldo" required>

            <label for="pass">Contraseña</label>
            <input type="password" id="pass" name="pass" required>

            <label for="pass_repeat">Repetir contraseña</label>
            <input type="password" id="pass_repeat" name="pass_repeat" required><br>

            <label for="tipo_cliente">Tipo de Cliente:</label>
            <input type="radio" id="vendedor" name="tipo" value="Vendedor">Vendedor<br>
            <input type="radio" id="comprador" name="tipo" value="Comprador">Comprador<br>
            <div id="div2">
                <button type="submit">Registrar</button><br>
                <p> Una vez registrado, ya podras <a href='./inicio_sesion.php'><b>iniciar sesión</b></a></p>
            </div>
        </form>
    </div>

    <div id="responseMessage">
    <?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $servername = "localhost";
    $username = "root";
    $password = "rootroot";
    $dbname = "concesionario";

    // Conectar a la base de datos
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if (!$conn) {
        die("Conexión fallida: " . mysqli_connect_error());
    }

    // Recoger los datos del formulario
    $nombre_usuario = mysqli_real_escape_string($conn, $_POST['nombre_usuario']);
    $nombre = mysqli_real_escape_string($conn, $_POST['nombre']);
    $apellidos = mysqli_real_escape_string($conn, $_POST['apellidos']);
    $dni = mysqli_real_escape_string($conn, $_POST['dni']);
    $saldo = (float)$_POST['saldo'];
    $password = $_POST['pass'];
    $password_repeat = $_POST['pass_repeat'];  
    $tipo_cliente = $_POST['tipo'];

    // Verificar si el nombre de usuario ya existe
    $check_user_sql = "SELECT * FROM usuarios WHERE nombre_usuario = '$nombre_usuario'";
    $result = mysqli_query($conn, $check_user_sql);

    if (mysqli_num_rows($result) > 0) {
        echo "<p class='error'>El nombre de usuario ya está registrado. Elige otro.</p>";
    } else {
        // Verificar si las contraseñas coinciden
        if ($password === $password_repeat) {
            // **Cifrar la contraseña**
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Insertar en la base de datos
            $sql = "INSERT INTO usuarios (nombre_usuario, nombre, apellidos, dni, saldo, password, tipo) 
                    VALUES ('$nombre_usuario', '$nombre', '$apellidos', '$dni', $saldo, '$hashed_password', '$tipo_cliente')";

            if (mysqli_query($conn, $sql)) {
                echo "<p class='success'>¡Usuario registrado correctamente!</p>";
            } else {
                echo "<p class='error'>Error al registrar el usuario: " . mysqli_error($conn) . "</p>";
            }
        } else {
            echo "<p class='error'>Las contraseñas no coinciden.</p>";
        }
    }

    mysqli_close($conn);
}
?>

    </div>
</body>
</html>
