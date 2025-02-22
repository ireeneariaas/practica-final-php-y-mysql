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

        .azul {
            text-decoration: none;
            color: blue;
        }

        a:hover {
            background: #ddd;
        }

        #div3 {
            background-color: white;
            margin: 100px;
            padding:20px;
            margin-left: auto;
            margin-right: auto;
            width: 700px;
            border-radius: 8px;
            text-align: center
        }
    </style>
</head>
<body>
    <div id="titulo">
        <h1>CONCESIONARIO</h1>
    </div>
    <div id=div3>
        <h3>¡Bienvenido al Concesionario!</h3><br>
        <p>Si aun no eres cliente nuestro, <a href="./registrarse.php" class="azul">¡hazte ya!</a>. Pero si ya formas parte del concesionario, <a href="./inicio_sesion.php" class="azul">inicia sesion</a> para poder alquilar coches y ver las nuevas novedades.</p><br>
        <a href="./clistar_sin_inicio.php" class="azul">Continuar sin iniciar sesion</a>
    </div>
</body>
</html>
