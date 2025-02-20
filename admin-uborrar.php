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
    </style>
    <div id="titulo">
        <h1>USUARIOS</h1>
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
    <h1>Borrar usuarios</h1>
    <?php
    // Datos de conexión a la base de datos
    $servername = "localhost";  // Cambia esto si el servidor es diferente
    $username = "root";         // Usuario de MySQL
    $password = "rootroot";             // Contraseña de MySQL
    $dbname = "concesionario";  // Nombre de la base de datos existente

    $conn = mysqli_connect($servername, $username, $password, $dbname);
    
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    $sql = "SELECT id_usuario, password, nombre, apellidos, dni, saldo FROM usuarios";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        echo "<form action='uborrar2.php' method='post'>";
        echo "<table border='1'>";
        echo "<tr><th>Seleccionar</th><th>Password</th><th>Nombre</th><th>Apellidosr</th><th>Dni</th><th>Saldo</th></tr>";
        // Mostrar cada piso con su checkbox
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td><input type='checkbox' name='delete_ids[]' value='" . $row['id_usuario'] . "'></td>";
            echo "<td>" . htmlspecialchars($row['password']) . "</td>";
            echo "<td>" . htmlspecialchars($row['nombre']) . "</td>";
            echo "<td>" . htmlspecialchars($row['apellidos']) . "</td>";
            echo "<td>" . htmlspecialchars($row['dni']) . "</td>";
            echo "<td>" . htmlspecialchars($row['saldo']) . "</td>";
            echo "</tr>";
        }
        echo "</table>";
        echo "<br>";
        echo "<button type='submit'>Eliminar seleccionados</button>";
        echo "</form>";
    } else {
        echo "<h1>No hay usuarios disponibles</h1>";
    }
    
    // Cerrar conexión
    mysqli_close($conn);
?>
</body>
</html>