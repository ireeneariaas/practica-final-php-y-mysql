<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menú Horizontal</title>
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
    </style>
</head>
<body>
    <div id="titulo">
        <h1>CONCESIONARIO</h1>
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
</body>
</html>
