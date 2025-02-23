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
            align-items: center;
        }

        table {
            background-color: white;
            width: 60%;
            text-align: center;
            align-items: center;
            border-collapse: collapse;
            margin: 0 auto; /* Esto centra la tabla */
        }

        h1 {
            color: white;
        }

        #titulo {
            background-color: gray;
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

        td {
            color: #2f2f2f;
        }
        
        .logout-button {
    position: absolute;
    top: 10px;
    right: 10px;
    background-color: black; /* Color negro */
    color: white; /* Texto en blanco */
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

        .logout-button:hover {
            background-color: #333; /* Color más oscuro al pasar el ratón */
        }

        #div3 {
            background-color: white;
            margin: 100px;
            padding: 20px;
            margin-left: auto;
            margin-right: auto;
            width: 700px;
            border-radius: 8px;
            text-align: center;
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
    <?php
        session_start(); // Iniciar la sesión

        $nombre_usuario = $_SESSION['usuario']; // Obtener el nombre de usuario
    echo "<div id='div3'><h2>¡Bienvenido a nuestro concesionario, $nombre_usuario!</h2><br><br>Ya puedes ver las nuevas novedades en coches. ¡Corre no te lo pierdas!</div>";
    ?>
</body>
</html>