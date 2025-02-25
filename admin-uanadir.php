<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
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

    table {
        background-color: white;
        width: 60%;
        text-align: center;
        align-items: center;
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

    #div3 {
        background-color: white;
        padding: 25px;
        padding-left: 40px;
        padding-right: 40px;
        margin-left: auto;
        margin-right: auto;
        width: 400px;
        border-radius: 8px;
    }

    form {
        margin: 0;
        padding: 0;
    }

    .ns {
        margin: 2px 0;
        padding: 5px;
        width: 380px;
    }

    input[type="submit"] {
        background-color: black;
        color: white;
        border: none;
        padding: 10px 20px;
        cursor: pointer;
        font-size: 16px;
        border-radius: 5px;
    }

    input[type="submit"]:hover {
        background-color: #333;
    }

    #boton {text-align: center;}

    .error {
        color: white;
        text-align: center;
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
        } #titulo {
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
            
            text-align:center;
        }

        .error {
            color: white;
        }
</style>
<div id="titulo">
    <h1>ADMINISTRADOR</h1>
    <form action="cerrar_sesion.php" method="post">
        <button type="submit" class="logout-button">Cerrar sesión</button>
    </form>
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

<h1>Añadir usuarios</h1>
<div id="div1">
        <form action="" method="POST">
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
                <button type="submit">Añadir</button><br>
            </div>
        </form>
    </div>
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

    // Verificar si el tipo de cliente es válido
    if (!isset($tipo_cliente) || !in_array($tipo_cliente, ['Vendedor', 'Comprador'])) {
        echo "<p class='error'>Por favor, selecciona un tipo de usuario válido.</p>";
        exit;
    }

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
</body>
</html>
