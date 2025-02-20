<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
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
            background-image: url("./img/concesionario.jpg");
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
    </style>
</head>
<body>
    <div id="titulo">
        <h1>CONCESIONARIO</h1>
    </div>

    <div id="div1">
        <h2>Iniciar Sesión</h2>
        <form id="loginForm" action="login.php" method="post" onsubmit="return validateForm()">
            <label for="usuario">Usuario</label>
            <input type="text" id="usuario" name="usuario" required>

            <label for="contraseña">Contraseña</label>
            <input type="password" id="contraseña" name="contraseña" required><br>

            <button type="submit">Iniciar Sesión</button>
            <p> Si aún <b>no estás registrado</b> en nuestro concesionario, <a href='./registrarse.php'>hazlo ahora</a></p>
        </form>
    </div>

    <!-- Div para el mensaje de error -->
    <div class="message" id="message"></div>

    <script>
        // Función para validar los campos del formulario
        function validateForm() {
            var usuario = document.getElementById('usuario').value;
            var contraseña = document.getElementById('contraseña').value;
            var message = document.getElementById('message');

            // Verificar si los campos están vacíos
            if (usuario.trim() === "" || contraseña.trim() === "") {
                message.innerHTML = "<p style='color: red;'>Por favor, completa ambos campos.</p>";
                return false; // Impide que el formulario se envíe
            }

            // Si los campos son válidos
            message.innerHTML = "";
            return true; // Permite que el formulario se envíe
        }
    </script>

    <div class="message">
    <?php
    // Verificar si el formulario ha sido enviado
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Datos de conexión a la base de datos
        $servername = "localhost";
        $username = "root";
        $password = "irene";
        $dbname = "concesionario";

        // Crear la conexión
        $conn = mysqli_connect($servername, $username, $password, $dbname);

        // Verificar la conexión
        if (!$conn) {
            die("Conexión fallida: " . mysqli_connect_error());
        }

        // Recibir los datos del formulario
        $usuario = $_POST['usuario'];
        $contraseña = $_POST['contraseña'];

        // Consulta para verificar si el usuario existe
        $sql = "SELECT * FROM usuarios WHERE nombre_usuario = '$usuario'";
        $result = mysqli_query($conn, $sql);

        // Verificar si el usuario existe
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);

            // Verificar si la contraseña es correcta usando password_verify()
            if (password_verify($contraseña, $row['contraseña'])) {
                // Iniciar la sesión del usuario
                session_start();
                $_SESSION['usuario'] = $usuario;

                // Obtener el tipo de usuario
                $tipo_usuario = $row['tipo'];

                // Redirigir dependiendo del tipo de usuario
                if ($tipo_usuario == 'Comprador') {
                    echo "<script>window.location.href = './comprador/comprador.php';</script>";
                } else {
                    echo "<script>window.location.href = 'panel_usuario.php';</script>";
                }

            } else {
                echo "<p style='text-align: center; color: white;'>Contraseña incorrecta.</p>";
            }
        } else {
            // Si el usuario no es encontrado
            echo "<p style='text-align: center; color: white;'>Este usuario no está registrado en la base de datos del concesionario.</p>";
        }

        // Cerrar la conexión
        mysqli_close($conn);
    }
    ?>

    </div>

</body>
</html>
