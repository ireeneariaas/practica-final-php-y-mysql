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
    width: 300px;
    padding: 20px;
    padding-right: 40px;
    margin: 50px auto;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Sombra ligera para profundidad */
}

label {
    display: block;
    margin: 10px 0 5px;
    font-weight: bold; /* Resaltar las etiquetas */
}

#modelo, #marca, #color, #precio {
    width: 100%;
    padding: 8px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 4px; /* Bordes redondeados en los campos de entrada */
}

.div2 {
    text-align: center;
    color:white;
}


    </style>
</head>
<body>
<div id="titulo">
        <h1>VENDEDOR</h1>
        <form action="cerrar_sesion.php" method="post">
            <button type="submit" class="logout-button">Cerrar sesión</button>
        </form>
    </div>

    <div>
        <ul class="menu">
            <li><a href="">Alquileres</a>
                <ul>
                    <li><a href="ven-alistar.php">Listar</a></li>
                    <li><a href="ven-aalquilar.php">Alquilar</a></li>
                </ul>
            </li>
        </ul>
    </div>

    <h1>Alquilar tus coches</h1>

    <div id="div1">
        <h2>Crear un alquiler</h2>
        <form action="" method="post">
            <label for="modelo">Modelo</label>
            <input type="text" id="modelo" name="modelo" required>

            <label for="marca">Marca</label>
            <input type="text" id="marca" name="marca" required>

            <label for="color">Color</label>
            <input type="text" id="color" name="color" required>

            <label for="precio">Precio</label>
            <input type="number" id="precio" name="precio" required><br><br>

            <div class="div2">
                <br><button type="submit">Añadir</button>
            </div>
        </form>
    </div>

    <div class="message">
<?php
session_start();

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

// Recoger los datos del formulario
$modelo = mysqli_real_escape_string($conn, $_POST['modelo']);
$marca = mysqli_real_escape_string($conn, $_POST['marca']);
$color = mysqli_real_escape_string($conn, $_POST['color']);
$precio = mysqli_real_escape_string($conn, $_POST['precio']);

// Insertar coche en la tabla coches con el usuario que lo está registrando
$sql_insert = "INSERT INTO coches (modelo, marca, color, precio, alquilado, id_usuario) 
               VALUES ('$modelo', '$marca', '$color', '$precio', 'No alquilado', '$id_usuario')";

if (mysqli_query($conn, $sql_insert)) {
    // Obtener el ID del coche recién insertado
    $id_coche = mysqli_insert_id($conn);

    // Insertar alquiler en la tabla alquileres
    $hora_actual = date('Y-m-d H:i:s');
    $sql_alquiler = "INSERT INTO alquileres (id_coche, id_usuario, prestado) 
                     VALUES ('$id_coche', '$id_usuario', '$hora_actual')";

    echo "<div class='div2'>";
    if (mysqli_query($conn, $sql_alquiler)) {
        echo "<p>Alquiler registrado correctamente.</p>";
    } else {
        echo "<p>Error al registrar el alquiler: " . mysqli_error($conn) . "</p>";
    }
    echo "</div>";
}

// Cerrar conexión
mysqli_close($conn);
?>


    </div>
</body>
</html>
