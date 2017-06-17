<!DOCTYPE html>
<?php
  session_start();
  $color = 'estilos.css';
  if(isset($_SESSION['tema'])){
    /* Abrir conexión con la base de datos */
    $connection = new mysqli("localhost", "root", "madeinsp1", "bajamar");
    $connection->set_charset("utf8");
    /* Realizar una consulta para extraer el color del usuario actual */
    $consulta="SELECT color from usuarios WHERE id_usuario = '".$_SESSION['id_usuario']."'LIMIT 1;";
    if ($result = $connection->query($consulta)){
      $fila = $result->fetch_assoc();
      $color = $fila['color'];
    }
    $_SESSION['tema'] = $color;
  }?>
<html lang="">
  <head>
    <title>C.D. Bajamar</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="../bootstrap/css/estilos.css">
    <link rel="stylesheet" href="../bootstrap/css/formulario.css">
    <script src="../bootstrap/js/jquery.min.js"></script>
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <style></style>
    </head>
    <body class=" <?php  print_r($color); ?>">


      <div class="container-fluid text-center">
        <nav class="navbar navbar-inverse">
          <div class="container-fluid">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" rel="home" href="index_admin.php" title="C.D. Bajamar">
                <img style="max-width:100px; margin-top: -15px;"
                     src="../Imagenes/logo2.jpg"></a>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
              <ul class="nav navbar-nav">
                <li><a href="index_admin.php">Inicio</a></li>
                <li><a href="admin_cursos.php">Cursos</a></li>
                <li><a href="admin_material.php">Material</a></li>
                <li class="active"><a href="admin_usuarios.php">Usuarios</a></li>
                <li><a href="admin_salidas.php">Salidas</a></li>
                <li><a href="admin_panel.php">Panel</a></li>
              </ul>
              <ul class="nav navbar-nav navbar-right">
                <?php
                if(isset($_SESSION['user'])){
                ?>
                <li><a href="index_admin.php"><span class="glyphicon glyphicon-user"></span> Bienvenido, <?php echo $_SESSION['user']; ?></a></li>
                <li><a href="../login/logout.php"><span class="glyphicon glyphicon-log-out"></span> Salir</a></li>
                <?php
                }else{
                ?>
                <li><a href="../login/login.php"><span class="glyphicon glyphicon-log-in"></span> Iniciar sesión</a></li>
                <?php
                }
                ?>
              </ul>
            </div>
          </div>
        </nav>

        <div class="container-fluid text-center">

          <div class="row content">

            <div class="col-sm-6 text-left">
              <h2>Añadir socios</h2>
              <hr>

              <?php

              if (isset($_POST['enviar'])) {

                //CREATING THE CONNECTION
                $connection = new mysqli("localhost", "root", "madeinsp1", "bajamar");
                $connection->set_charset("utf8");

                //TESTING IF THE CONNECTION WAS RIGHT
                if ($connection->connect_errno) {
                    printf("Connection failed: %s\n", $connection->connect_error);
                    exit();
                }

                //variables
                $dni=$_POST['dni'];
                $nombre=$_POST['nombre'];
                $fecha_naci=$_POST['fecha_naci'];
                $direccion=$_POST['direccion'];
                $ciudad=$_POST['ciudad'];
                $provincia=$_POST['provincia'];
                $codigo_postal=$_POST['codigo_postal'];
                $telefono=$_POST['telefono'];
                $email=$_POST['email'];
                $pass=$_POST['pass'];
                $tipo=$_POST['tipo'];

                //consulta
                $consulta="INSERT INTO usuarios VALUES (NULL,'$dni','$nombre','$fecha_naci','$direccion','$ciudad','$provincia','$codigo_postal','$telefono','$email','".md5($pass)."','$tipo');";

                var_dump($consulta);
                if ($result = $connection->query($consulta))
                {
                  //echo "HOLA";
                  header ("Location: admin_usuarios.php");

                } else {

                      echo "Error: " . $result . "<br>" . mysqli_error($connection);
                }
              }
              unset($connection);
              ?>

              <!DOCTYPE html>
              <html lang="">
                <head>
                  <meta charset="utf-8">
                  <meta name="viewport" content="width=device-width, initial-scale=1.0">
                  <title></title>
                  <link rel="stylesheet" type="text/css" href=" ">
                  </head>
                  <body class=" <?php  print_r($color); ?>">


                    <?php

                      echo "<form method='post' id='formulario'>";
                      echo "<span><b>DNI:</b></span> <input type='text' name='dni' value='$obj->dni'\><br><br>";
                      echo "<span><b>Nombre:</b></span> <input type='text' name='nombre' value='$obj->nombre'\><br><br>";
                      echo "<span><b>F. Nacimiento:</b></span> <input type='date' name='fecha_naci' value='$obj->fecha_naci'\><br><br>";
                      echo "<span><b>Direccion:</b></span> <input type='text' name='direccion' value='$obj->direccion'\><br><br>";
                      echo "<span><b>Ciudad:</b></span> <input type='text' name='ciudad' value='$obj->ciudad'\><br><br>";
                      echo "<span><b>Provincia:</b></span> <input type='text' name='provincia' value='$obj->provincia'\><br><br>";
                      echo "<span><b>C. Postal:</b></span> <input type='text' name='codigo_postal' value='$obj->codigo_postal'\><br><br>";
                      echo "<span><b>Teléfono:</b></span> <input type='text' name='telefono' value='$obj->telefono'\><br><br>";
                      echo "<span><b>Email:</b></span> <input type='text' name='email' value='$obj->email'\><br><br>";
                      echo "<span><b>Tipo usuario:</b></span> <input type='text' name='tipo' value='$obj->tipo'\><br><br>";
                      echo "<span><b>Contraseña:</b></span> <input type='text' name='tipo' value='$obj->pass'\><br><br>";

                      echo "<button type=\"submit\"name='enviar'>Enviar</button>";
                      echo "</from>";


                    ?>
                    <br><br>
                  </div>

                  <br><br><br><br>

                  <div class="col-sm-6 text-left">
                    <br>
                    <img class="img-responsive img-rounded" style="margin: 0 auto;" src="../Imagenes/socios.jpg" alt="cursos" width="550" height="300">
                    <br><br><br>
                  </div>

                  <div class="row">
                    <?php include ("../includes/footer.php"); ?>
              </div>
          </div>
    </body>
</html>
