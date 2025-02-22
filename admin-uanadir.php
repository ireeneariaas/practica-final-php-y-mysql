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
        background-size: cover; /* La imagen cubre toda la pantalla */
        background-position: center; /* Centra la imagen de fondo */
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
        margin: 0; /* Elimina el margen superior */
        padding: 0; /* Elimina el padding */
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

    /* Estilo para el botón */
    input[type="submit"] {
        background-color: black; /* Fondo negro */
        color: white; /* Texto blanco */
        border: none; /* Sin borde */
        padding: 10px 20px; /* Ajusta el tamaño al texto */
        cursor: pointer; /* Cambia el cursor a pointer */
        font-size: 16px; /* Asegura que el texto sea legible */
        border-radius: 5px; /* Bordes redondeados */
    }

    input[type="submit"]:hover {
        background-color: #333; /* Fondo gris oscuro al pasar el mouse */
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
    background-color: black; /* Color negro */
    color: white; /* Texto en blanco */
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}


</style>
<div id="titulo">
    <h1>USUARIOS</h1>
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
<div id="div3">
    <form action="" method="POST">
        Nombre:<br>
        <input type="text" name="nombre" class="ns"  required><br><br>
        Apellidos:<br>
        <input type="text" name="apellidos" class="ns"  required><br><br>
        DNI:<br>
        <input type="text" name="dni" class="ns" required><br><br>
        Saldo:<br>
        <input type="text" name="saldo" class="ns"  required><br><br>
        Contraseña:<br>
        <input type="password" name="password" class="ns" required><br><br>
        Repetir contraseña:<br>
        <input type="password" name="password_repeat" class="ns" required><br><br>
        <div id="boton">
            <input type="submit" value="Añadir">
        </div>
    </form>
</div>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Conexión con la base de datos
    $conexion = mysqli_connect("localhost", "root", "rootroot", "concesionario")
        or die("No se pudo conectar al servidor");

    // Recopilación de datos
    $password = $_POST['password'];
    $password_repeat = $_POST['password_repeat']; // Cambiado para tomar la repetición de la contraseña
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $dni = $_POST['dni'];
    $saldo = $_POST['saldo'];

    // Verificar si las contraseñas coinciden
    if ($password !== $password_repeat) {
        echo "<p class='error'>Las contraseñas no coinciden. Intenta de nuevo.</p>";
    } else {
        // Consulta preparada para evitar inyección SQL
        $stmt = $conexion->prepare("INSERT INTO usuarios (password, nombre, apellidos, dni, saldo) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssd", $password, $nombre, $apellidos, $dni, $saldo);

        if ($stmt->execute()) {
            echo "<p style='text-align: center; color: white;'>Usuario añadido correctamente.</p>";
        }

        // Cerrar la sentencia y conexión
        $stmt->close();
        mysqli_close($conexion);
    }
}
?>
</body>
</html>
