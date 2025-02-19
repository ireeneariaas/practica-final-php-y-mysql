<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Usuario</title>
    <style>
        body {
            background-color: gray;
            font-family: Arial, sans-serif;
        }

        #div1 {
            background-color: white;
            width: 300px;
            padding: 20px;
            padding-right: 40px;
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
        }

        body {
            margin: 0;
            font-family: Arial;
            background-image: url("./img/concesionario.jpg");
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
            color: red;
        }
    </style>
</head>
<body>
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

            <label for="password">Contraseña</label>
            <input type="password" id="password" name="password" required><br>

            <label for="tipo_cliente">Tipo de Cliente:</label><br>
            Vendedor<input type="radio" id="vendedor" name="tipo" value="Vendedor" required>
            Comprador<input type="radio" id="comprador" name="tipo" value="Comprador" required>
            Administrador<input type="radio" id="administrador" name="tipo" value="Administrador" required>
        
            <button type="submit">Registrar</button>
            <p> Una vez registrado, ya podrás <a href='./incio_sesion.php'><b>iniciar sesión</b></a></p>
        </form>
    </div>

    <div id="responseMessage">
        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $servername = "localhost";
            $username = "root";
            $password = "irene";
            $dbname = "concesionario";

            // Conectar a la base de datos
            $conn = mysqli_connect($servername, $username, $password, $dbname);

            if (!$conn) {
                die("Conexión fallida: " . mysqli_connect_error());
            }

            $nombre_usuario = $_POST['nombre_usuario'];
            $nombre = $_POST['nombre'];
            $apellidos = $_POST['apellidos'];
            $dni = $_POST['dni'];
            $saldo = $_POST['saldo'];
            $password = $_POST['password'];
            $tipo_cliente = $_POST['tipo'];

            // Verificar si el nombre de usuario ya existe
            $check_user_sql = "SELECT * FROM usuarios WHERE nombre_usuario = '$nombre_usuario'";
            $result = mysqli_query($conn, $check_user_sql);

            if (mysqli_num_rows($result) > 0) {
                // Si el nombre de usuario ya existe, mostrar un mensaje de error
                echo "<p class='error'>El nombre de usuario ya está registrado. Por favor, elige otro.</p>";
            } else {
                // Si el nombre de usuario no existe, insertar el nuevo usuario
                $sql = "INSERT INTO usuarios (nombre_usuario, nombre, apellidos, dni, saldo, password, tipo) 
                        VALUES ('$nombre_usuario', '$nombre', '$apellidos', '$dni', $saldo, '$password', '$tipo_cliente')";

                if (mysqli_query($conn, $sql)) {
                    // Si la inserción es exitosa, mostrar mensaje de éxito
                    echo "<p class='success'>¡Usuario registrado correctamente!</p>";
                } else {
                    // Si hay un error al insertar el usuario, mostrar el error de MySQL
                    echo "<p class='error'>Hubo un error al registrar el usuario: " . mysqli_error($conn) . "</p>";
                }
            }

            // Cerrar la conexión
            mysqli_close($conn);
        }
        ?>
    </div>
</body>
</html>
