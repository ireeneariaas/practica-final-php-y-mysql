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
</head>
<body>
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
    <h1>Buscar usuario</h1>
    <div id="div3">
    <form action="" method="POST">
        Contraseña:<br>
        <input type="password" name="password" required><br><br>
        Nombre:<br>
        <input type="text" name="nombre" required><br><br>
        Apellidos:<br>
        <input type="text" name="apellidos" required><br><br>
        DNI:<br>
        <input type="text" name="dni" required><br><br>
        Saldo:<br>
        <input type="text" name="saldo" required><br><br>
        <input type="submit" value="Buscar usuario">
    </form>
</div><br><br>
    <?php
    
       // Conectar con el servidor de base de datos
        $conexion = mysqli_connect ("localhost", "root", "rootroot","concesionario")
             or die ("No se puede conectar con el servidor");
            
       $password = $_REQUEST['password'];
       $nombre = $_REQUEST['nombre'];
       $apellidos = $_REQUEST['apellidos'];
       $dni = $_REQUEST['dni'];
       $saldo = $_REQUEST['saldo'];
    
       // Enviar consulta
          $instruccion = "select * from Usuarios where password='$password' or nombre='$nombre' or apellidos='$apellidos' or dni='$dni' or saldo='$saldo'";
          $consulta = mysqli_query ($conexion,$instruccion)
             or die ("Fallo en la consulta");
          
          $nfilas = mysqli_num_rows ($consulta);
          if ($nfilas > 0)
          {
             print ("<TABLE border=1>\n");
             print ("<TR>\n");
             print ("<TH>password</TH>\n");
             print ("<TH>nombre</TH>\n");
             print ("<TH>apellidos</TH>\n");
             print ("<TH>dni</TH>\n");
             print ("<TH>saldo</TH>\n");
             print ("</TR>\n");
    
             for ($i=0; $i<$nfilas; $i++)
             {
                $resultado = mysqli_fetch_array ($consulta);
                print ("<TR>\n");
                print ("<TD>" . $resultado['password'] . "</TD>\n");
                print ("<TD>" . $resultado['nombre'] . "</TD>\n");
                print ("<TD>" . $resultado['apellidos'] . "</TD>\n");
                print ("<TD>" . $resultado['dni'] . "</TD>\n");
                print ("<TD>" . $resultado['saldo'] . "</TD>\n");
    
                
                print ("</TR>\n");
             }
    
             print ("</TABLE>\n");
          }
          else {
             print ("No hay noticias que coincidan");
          }
          
    
    // Cerrar 
    mysqli_close ($conexion);
    
    ?>
</div>
</body>
</html>