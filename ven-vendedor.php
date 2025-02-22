<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VENDEDOR</title>
    <style>
        body {
            margin: 0; /* Elimina margen global del cuerpo */
            font-family: Arial;
            background-image: url("./concesionario.jpg");
            background-size: cover; /* La imagen cubre toda la pantalla */
            background-position: center; /* Centra la imagen de fondo */
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

        /* Estilos generales para el menú */
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

        /* Menú principal en horizontal */
        .menu {
            display: flex;
            justify-content: center; /* Centra el menú horizontalmente */
            background: #f1f1f1;
            border: 1px solid #ccc;
            margin: 0;
            padding: 0;
        }

        .menu > li {
            flex: none;
        }

        .welcome-message {
            text-align: center;
            color: white;
            margin-top: 20px;
            font-size: 1.5em;
        }
    </style>
</head>
<body>
    <div id="titulo">
        <h1>VENDEDOR</h1>
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
    <div id="div1">
        <h1> Bienvenido </h1>
    </div>
    <?php
session_start(); // Iniciar la sesión

// Verifica si el usuario está logueado
if (!isset($_SESSION['id_usuario'])) {
    echo "<p>No estás logueado. Por favor, inicia sesión primero.</p>";
    exit(); // Si no está logueado, detener el proceso
}

// Obtener el ID del vendedor logueado
$id_vendedor = $_SESSION['id_usuario']; // Aquí asumimos que ya se ha logueado correctamente
?>
</body>
</html>
