<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscar Usuarios</title>
    <style>
         body{background-color:gray;
            align: center;
            background-image: url("./concesionario.jpg");
            background-size: cover; 
            background-position: center; 
            height: 800px;
            margin: 0;
            font-family: Arial;}
        #centrar {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 20px;}
        
        table{background-color:white;
            width: 60%;
            text-align: center}
      
        
        body{background-color:gray;
            align: center;
            background-image: url("./concesionario.jpg");
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
            padding: 20px;
            margin-left: auto;
            margin-right: auto;
            margin-top:20px;
            width: 470px;
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
</head>
<body>
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
    <h1>Buscar Usuarios</h1>
    <div id="div3">
    <p color="black" align="justify">Se puede buscar por cualquier rasgo del usuario, como su nombre, apellidos, DNI, saldo, tipo de usuario o nombre de usuario</p>
    <div class="search-box">
        <form action="" method="get">
            <input type="text" name="buscar" placeholder="Buscar usuario ..." required>
            <button type="submit">Buscar</button><br><br>
        </form>
    </div>
    </div>
    <div id="centrar">
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Apellidos</th>
            <th>DNI</th>
            <th>Saldo</th>
            <th>Tipo</th>
            <th>Nombre de Usuario</th>
        </tr>
        
        <?php
            // Conexion a la base de datos
            $servername = "localhost";  
            $username = "root";         
            $password = "rootroot";        
            $dbname = "concesionario";  

            // Crear la conexion
            $conn = mysqli_connect($servername, $username, $password, $dbname);

            // Verificar la conexion
            if (!$conn) {
                die("Conexion fallida: " . mysqli_connect_error());
            }

            // Verificar si se ha enviado el formulario de busqueda
            if (isset($_GET['buscar']) && !empty($_GET['buscar'])) {
                $buscar = mysqli_real_escape_string($conn, $_GET['buscar']);  // Escapar caracteres especiales

                // Consulta para buscar usuarios por nombre, apellidos, dni, saldo, tipo o nombre_usuario
                $sql = "SELECT * FROM usuarios WHERE nombre LIKE '%$buscar%' 
                        OR apellidos LIKE '%$buscar%' 
                        OR dni LIKE '%$buscar%' 
                        OR saldo LIKE '%$buscar%' 
                        OR tipo LIKE '%$buscar%' 
                        OR nombre_usuario LIKE '%$buscar%'";
            } else {
                // Si no hay busqueda, mostrar todos los usuarios
                $sql = "SELECT * FROM usuarios";
            }

            // Ejecutar la consulta
            $result = mysqli_query($conn, $sql);

            // Verificar si hay resultados
            if (mysqli_num_rows($result) > 0) {
                // Mostrar cada fila de datos en la tabla
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row["id_usuario"] . "</td>";
                    echo "<td>" . $row["nombre"] . "</td>";
                    echo "<td>" . $row["apellidos"] . "</td>";
                    echo "<td>" . $row["dni"] . "</td>";
                    echo "<td>" . $row["saldo"] . "</td>";
                    echo "<td>" . $row["tipo"] . "</td>";
                    echo "<td>" . $row["nombre_usuario"] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='7'>No se encontraron usuarios con esa característica.</td></tr>";
            }

            // Cerrar la conexion
            mysqli_close($conn);
        ?>
    </table>
    </div>

</body>
</html>
