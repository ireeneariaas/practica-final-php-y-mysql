<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Concesionario de Autos</title>
</head>
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
    <?php
        $conn = mysqli_connect("localhost", "root", "irene", "concesionario");
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
        // Comprobar si hay IDs para eliminar
        if (isset($_POST['delete_ids']) && is_array($_POST['delete_ids'])) {
            $ids_to_delete = implode(",", array_map('intval', $_POST['delete_ids']));
            /*$ids_to_delete = [];
              foreach ($_POST['delete_ids'] as $id) {
                 $ids_to_delete[] = intval($id);
             }
            $ids_to_delete_string = implode(",", $ids_to_delete);*/
        
            // Eliminar los pisos seleccionados
            $sql = "DELETE FROM usuarios WHERE id_usuario IN ($ids_to_delete)";
            if (mysqli_query($conn, $sql)) {
                echo "<h1>Usuarios eliminados correctamente</h1>";
            } else {
                echo "<h1>Error al eliminar usuarios: " . mysqli_error($conn) . "</h1>";
            }
        } else {
            echo "<h1>No se seleccionaron usuarios para eliminar</h1>";
        }
        // Cerrar conexión
        mysqli_close($conn);
        
        // Volver al listado
        echo "<a href='borrarusuarios.php'>Volver al listado</a>";
    ?>

  

</body>


</html>