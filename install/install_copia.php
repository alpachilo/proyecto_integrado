<!DOCTYPE html>
<html>
<head>
  <title>C.D. Bajamar</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="../bootstrap/css/estilos.css">
  <script src="../bootstrap/js/jquery.min.js"></script>
  <script src="../bootstrap/js/bootstrap.min.js"></script>
  <style></style>
</head>
<body>

<?php
	session_start();
	$connection;
  start();





  //FUNCIONES
  function connecBD($HostBD, $UsuarioBD, $PassBD, $NombreBD){
      global $connection;
      error_reporting(E_ALL ^ E_WARNING);
      $connection = new mysqli($HostBD, $UsuarioBD, $PassBD, $NombreBD);
      $connection->set_charset("utf8");
      if ($connection->connect_errno) {

          crearBBDD($_POST['hostbd'], $_POST['usuariobd'], $_POST['passbd'], $_POST['nombrebd']);

          echo "Connection failed with database";

          // exit();
          return "false";
      }else
          return "true";
  }
  //start();
  function start(){

    // if(file_exists("database.php"))
    //     header('Location: ../index.php');

    if (isset($_POST["instalar"])) {
        $NombreBD = $_POST['nombrebd'];
        $UsuarioBD = $_POST['usuariobd'];
        $PassBD = $_POST['passbd'];
        $HostBD= $_POST['hostbd'];
        $DatosDB = (isset($_POST['insertardatos'])) ? "true" : "false";
        $connect = connecBD($HostBD, $UsuarioBD, $PassBD, $NombreBD);


        $Archivo = "<?php\n\$connection = new mysqli('$HostBD', '$UsuarioBD', '$PassBD', '$NombreBD');\n?>";
        $file = fopen("conection.php", "w");
        fwrite($file, $Archivo);
        Fclose($file);



        if($connect == "true"){
          $connection = new mysqli($HostBD, $UsuarioBD, $PassBD, $NombreBD);
          $connection->set_charset("utf8");
            crearTablaCurso($connection);
            insertarTablaCurso($connection);
            crearTablaMaterial($connection);
            crearTablaRegistro_actividades($connection);
            crearTablaSuscribe($connection);
            crearTablaUsuarios($connection);
            die("SII");
            // creamos un archivo con la conexion y las variables de la db

            echo "<div>";
            echo "<h1>Instalacion completada</h1>";
            echo '<META HTTP-EQUIV="Refresh" CONTENT="10; URL=../index.php">';
            echo "</div>";
        }
        die();
    }
    if (isset($_POST["botonFinalizar"])) {
        if(file_exists("database.php"))
            header('Location: index.php');
        else
            echo "<h1>Para usar Airline, se necesita completar la instalación.</h1>";
    }
  }
  function crearBBDD($servername, $username, $password, $nombreDB){
    $conn = new mysqli($servername, $username, $password);
    $sql = "CREATE DATABASE ".$nombreDB;
    if ($conn->query($sql) === TRUE) {
        echo "Database created successfully";
        start();
    } else {
        echo "Error creating database: " . $conn->error;
    }
  }
  function crearTablaCurso($connection){
      $curso = "CREATE TABLE `curso` (
                `id_curso` int(5) NOT NULL,
                `nombre` varchar(255) NOT NULL,
                `precio` int(11) NOT NULL,
                `fecha` date NOT NULL
              ) ENGINE=InnoDB DEFAULT CHARSET=latin1;";

      if($result = $connection->query($curso)) {
          if ($result)
              echo "<h1>Tabla curso creada correctamente.</h1></br>";
      }else
          echo "Error al crear la tabla curso.";
  }
  function insertarTablaCurso($connection){
      $curso = "INSERT INTO `curso` (`id_curso`, `nombre`, `precio`, `fecha`) VALUES
                (5, 'Remo en el rio', 32, '2017-02-08'),
                (7, 'Iniciacion Seniors', 40, '2016-12-01'),
                (9, 'Iniciacion senior', 22, '2017-02-02'),
                (11, 'Cursos aguas bravas', 90, '2017-03-31'),
                (13, 'Perfeccionamiento', 80, '2017-03-08');";

      if($result = $connection->query($curso)) {
          if ($result)
              echo "<h1>Tabla curso creada correctamente.</h1></br>";
      }else
          echo "Error al crear la tabla curso.";
  }
  function crearTablaMaterial($connection){
      $material = "CREATE TABLE `material` (
                `id_material` int(5) NOT NULL,
                `nombre` varchar(255) NOT NULL,
                `fecha_compra` date NOT NULL,
                `estado` varchar(255) NOT NULL
                ) ENGINE=InnoDB DEFAULT CHARSET=latin1;";

      if($result = $connection->query($material)) {
          if ($result)
              echo "<h1>Tabla curso creada correctamente.</h1></br>";
      }else
          echo "Error al crear la tabla curso.";
  }

  function crearTablaRegistro_actividades($connection){
      $registro_actividades = "CREATE TABLE `registro_actividades` (
                `id_registro` int(5) NOT NULL,
                `fecha` date NOT NULL,
                `hora` time NOT NULL,
                `invitados` varchar(255) NOT NULL,
                `id_usuario` int(8) DEFAULT NULL
                ) ENGINE=InnoDB DEFAULT CHARSET=latin1;";

      if($result = $connection->query($registro_actividades)) {
          if ($result)
              echo "<h1>Tabla curso creada correctamente.</h1></br>";
      }else
          echo "Error al crear la tabla curso.";
  }
  function crearTablaSuscribe($connection){
      $suscribe = "CREATE TABLE `suscribe` (
                  `id_curso` int(5) NOT NULL,
                  `id_usuario` int(5) NOT NULL
                  ) ENGINE=InnoDB DEFAULT CHARSET=latin1;";

      if($result = $connection->query($suscribe)) {
          if ($result)
              echo "<h1>Tabla curso creada correctamente.</h1></br>";
      }else
          echo "Error al crear la tabla curso.";
  }

  function crearTablaUsuarios($connection){
      $usuarios = "CREATE TABLE `usuarios` (
                  `id_usuario` int(5) NOT NULL,
                  `dni` varchar(9) CHARACTER SET latin1 NOT NULL,
                  `nombre` varchar(255) CHARACTER SET latin1 NOT NULL,
                  `fecha_naci` date NOT NULL,
                  `direccion` varchar(255) CHARACTER SET latin1 NOT NULL,
                  `ciudad` varchar(255) CHARACTER SET latin1 NOT NULL,
                  `provincia` varchar(255) CHARACTER SET latin1 NOT NULL,
                  `codigo_postal` varchar(8) CHARACTER SET latin1 NOT NULL,
                  `telefono` varchar(12) CHARACTER SET latin1 NOT NULL,
                  `email` varchar(255) CHARACTER SET latin1 NOT NULL,
                  `pass` varchar(255) CHARACTER SET latin1 NOT NULL,
                  `tipo` varchar(20) CHARACTER SET latin1 NOT NULL,
                  `color` varchar(15) COLLATE utf8_unicode_ci NOT NULL
                  ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;";

      if($result = $connection->query($usuarios)) {
          if ($result)
              echo "<h1>Tabla curso creada correctamente.</h1></br>";
      }else
          echo "Error al crear la tabla curso.";
  }



    ?>


    <div class="container-fluid recuadro2 margin1">
        <form class='instalar colorwhite' method="post">
            </br>
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4 instalacion">
                  <label>Nombre de la Base de Datos</label>
                  <input class="form-control" name="nombrebd" type="text" value="" placeholder="--Nombre--" required>

                  <label>Usuario de la Base de Datos</label>
                  <input class="form-control" name="usuariobd" type="text" value="" placeholder="--Usuario--" required>

                  <label>Contraseña de la Base de Datos</label>
                  <input class="form-control" name="passbd" type="password" value="madeinsp1" required>

                  <label>Host</label>
                  <input class="form-control" name="hostbd" type="text" value="" placeholder="--UsuLocalhostario--" required>

                  <!-- <label>Email del Usuario Administrador</label>
                  <input class="form-control" name="admin" type="mail" value="" placeholder="--UsuarioAdministrador--" required>

                  <label>Contraseña del Usuario Administrador</label>
                  <input class="form-control" name="passadmin" type="password" value="" required> -->

                  <label>Insertar datos</label>
                  <input type="checkbox" name="insertardatos" checked>

                  <input class="form-control btn btn-danger" type="submit" value="Instalar" name="instalar">

                  <input class="form-control btn btn-warning" type="submit" value="Finalizar" name="botonFinalizar">
                </div>
                <div class="col-md-4"></div>
            </div>
            </br>
        </form>
    </div>
        </div>
    </div>
</body>
</html>
