<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<style>
        body{background-color:gray;
            align: center;
            background-image: url("../concesionario.jpg");
            background-size: cover; /* La imagen cubre toda la pantalla */
            background-position: center; /* Centra la imagen de fondo */
            height: 800px;
            margin: 0;
            font-family: Arial;}

        table{background-color:white;
            width: 60%;
            text-align: center;
            align-items: center;}
            
        h1{color:white;}
       
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
        #div3 {
    background-color: white;
    padding: 10px;
    margin-left: auto;
    margin-right: auto;
    width: 400px;
    border-radius: 8px;
}

form {
    margin: 0;
    padding: 0;
}

form input {
    margin: 2px 0; 
    padding: 5px;
    width:380px; 
}
    </style>
<div id="titulo">
        <h1>COCHES</h1>
    </div>
    <div>
        <ul class="menu">
        <li><a href="inicio.html">Inicio</a></li>
            <li><a href="">Coches</a>
                <ul>
                    <li><a href="clistar.php">Listar</a></li>
                    <li><a href="canadir.php">Añadir</a></li>
                    <li><a href="cbuscar.php">Buscar</a></li>
                    <li><a href="cmodificar.php">Modificar</a></li>
                    <li><a href="cborrar.php">Borrar</a></li>
                </ul>
            </li>
            <li><a href="">Usuarios</a>
                <ul>
                    <li><a href="ulistar.php">Listar</a></li>
                    <li><a href="uanadir.php">Añadir</a></li>
                    <li><a href="ubuscar.php">Buscar</a></li>
                    <li><a href="umodificar.php">Modificar</a></li>
                    <li><a href="uborrar.php">Borrar</a></li>
                </ul>
            </li>
            <li><a href="">Alquileres</a>
                <ul>
                    <li><a href="alistar.php">Listar</a></li>
                    <li><a href="aborrar.php">Borrar</a></li>
                </ul>
            </li>
        </ul>
    </div>
    <h1>Modificar usuarios</h1>
    <div id="div3">
    <form action="" method="post">
        Id del usuario:<input type="text" name="id_usuario"><br>
        <input type="submit" value="Actualizar">
    </form>
    </div>
    <?php
        // Configuración de la base de datos
        $servername = "localhost";
        $username = "root";
        $password = "rootroot";
        $dbname = "concesionario";

        // Crear conexión
        $conn = mysqli_connect($servername, $username, $password, $dbname);

        // Verificar la conexión
        if (!$conn) {
            die("Conexión fallida: " . mysqli_connect_error());
        }
        // Recuperar datos del formulario
        $id_usuario=$_POST['id_usuario'];
        $password =  $_POST['contraseña'];
        $nombre =  $_POST['nombre'];
        $apellidos = $_POST['apellidos'];
        $dni = $_POST['dni'];
        $saldo = $_POST['saldo'];


        // Preparar y ejecutar la consulta de inserción
        $sql = "UPDATE usuarios SET password='$password', nombre='$nombre', apellidos='$apellidos', dni='$dni', saldo='$saldo' WHERE id_usuario='$id_usuario'";


        if (mysqli_query($conn, $sql)) {
            echo "<p style='text-align: center; color: white;'>usuario actualizado con éxito.</p>";
        } else {
            echo "Error al actualizar: " . mysqli_error($conn);
        }

        // Cerrar la conexión
        mysqli_close($conn);
?>
</body>
</html>