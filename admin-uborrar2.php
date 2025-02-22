<html>
<head>
</head>
<body>
<style>
        body{background-color:gray;
            align: center;
            background-image: url("./concesionario.jpg");
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
    <h1>Borrar coches</h1>
    <?php
$servername = "localhost";  // Cambia esto si el servidor es diferente
$username = "root";         // Usuario de MySQL
$password = "rootroot";             // Contraseña de MySQL
$dbname = "concesionario";  // Nombre de la base de datos existente

$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
// Comprobar si hay IDs para eliminar
if (isset($_POST['delete_ids']) && is_array($_POST['delete_ids'])) {
    $ids_to_delete = implode(",", array_map('intval', $_POST['delete_ids']));
    
    $sql = "DELETE FROM usuarios WHERE id_usuario IN ($ids_to_delete)";
    if (mysqli_query($conn, $sql)) {
        echo "<h1>Usuarios eliminados correctamente</h1>";
    } else {
        echo "<h1>Error al eliminar coches: " . mysqli_error($conn) . "</h1>";
    }
} else {
    echo "<h1>No se seleccionaron coches para eliminar</h1>";
}
// Cerrar conexión
mysqli_close($conn);

?>
</body>
</body>
</html>