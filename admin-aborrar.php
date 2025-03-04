<!DOCTYPE html>
<html>
<head>
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

        /* Estilo para centrar los elementos */
        .center {
            text-align: center;
            margin-top: 20px;
            color: white;
        }

        /* Estilos de la tabla */
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
            background-color: #b0b0b0; /* Gris un poco más oscuro al pasar el mouse */
        }

        #div1 {
            background-color: white;
            width: 800px;
            padding: 20px;
            margin: 0px auto;
            border-radius: 8px;
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

    <h1>Borrar alquileres</h1>
    
    <?php
        // Datos de conexión a la base de datos
        $servername = "localhost";  // Cambia esto si el servidor es diferente
        $username = "root";         // Usuario de MySQL
        $password = "rootroot";     // Contraseña de MySQL
        $dbname = "concesionario";  // Nombre de la base de datos existente

        $conn = mysqli_connect($servername, $username, $password, $dbname);
        
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $sql = "SELECT id_alquiler, id_usuario, id_coche, prestado, devuelto FROM alquileres";
        $result = mysqli_query($conn, $sql);

        $delete_success = false; // Variable para verificar si la eliminación fue exitosa

        if (isset($_POST['delete_ids'])) {
            $delete_ids = $_POST['delete_ids'];
            foreach ($delete_ids as $id_alquiler) {
                $delete_sql = "DELETE FROM alquileres WHERE id_alquiler = $id_alquiler";
                if (mysqli_query($conn, $delete_sql)) {
                    $delete_success = true; // Marca como exitoso si la eliminación se realiza
                } else {
                    echo "Error al eliminar el alquiler con ID $id_alquiler: " . mysqli_error($conn);
                }
            }
        }

        echo "<div id='div1'>";
        if (mysqli_num_rows($result) > 0) {
            echo "<form action='' method='post'>";
            echo "<table border=1>";
            echo "<tr>
                    <th>Seleccionar</th>
                    <th>ID Usuario</th>
                    <th>ID Coche</th>
                    <th>Fecha de Prestado</th>
                    <th>Fecha de Devuelto</th>
                </tr>";

            // Mostrar cada alquiler con su checkbox
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td><input type='checkbox' name='delete_ids[]' value='" . $row['id_alquiler'] . "'></td>";
                echo "<td>" . htmlspecialchars($row['id_usuario']) . "</td>";
                echo "<td>" . htmlspecialchars($row['id_coche']) . "</td>";
                echo "<td>" . htmlspecialchars($row['prestado']) . "</td>";
                echo "<td>" . htmlspecialchars($row['devuelto']) . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        echo "<div class='center'><button type='submit'>Borrar</button></div>";
        echo "</form>";
        echo "</div>";
        } else {
            echo "<div class='center'><h2>No hay alquileres disponibles</h2></div>";
        }

        // Cerrar conexión
        mysqli_close($conn);

        // Mostrar mensaje de éxito después de la operación de eliminación
        if ($delete_success) {
            echo "<div class='center' style='color: white; padding: 10px; margin-top: 20px;'>El alquiler se borró correctamente</div>";
        }
    ?>

</body>
</html>