<!DOCTYPE html>
<?php
  session_start();
  $id=$_SESSION['id_usuario'];
 ?>
<html lang="en">
<head>
  <title>C.D. Bajamar</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="../bootstrap/css/estilos.css">
  <link rel="stylesheet" href="../bootstrap/css/formulario.css">
  <script src="../bootstrap/js/jquery.min.js"></script>
  <script src="../bootstrap/js/bootstrap.min.js"></script>
  <style></style>
</head>
<body>

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
      <a class="navbar-brand" rel="home" href="../users/index_usuario.php" title="Bajamar">
        <img style="max-width:100px; margin-top: -15px;"
             src="../Imagenes/logo2.jpg"></a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li><a href="../users/index_usuario.php">Inicio</a></li>
        <li><a href="../users/users_cursos.php">Cursos</a></li>
        <li class="active"><a href="../users/users_salidas.php">Salidas</a></li>
        <li><a href="../users/users_contacto.php">Contacto</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <?php
        if(isset($_SESSION['user'])){
        ?>
        <li><a href="../users/users_panel.php"><span class="glyphicon glyphicon-user"></span> Panel de <?php echo $_SESSION['user']; ?></a></li>
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
      <h1>Registro de salidas</h1>
      <hr>
      <p align="justify">En este apartado podrás <b>registrar tus salidas</b> en piragua al rio, la playa u otros lugares que elijas para que quede constancia de tus salidas con <b>invitados</b> ajenos al club y sea <b>efectiva para trámites del seguro.</b>
      <br><br>

      <?php

      if (isset($_POST['enviar'])) {

        //CREATING THE CONNECTION
        $connection = new mysqli("localhost", "id1003383_root", "123456", "id1003383_bajamar");
        $connection->set_charset("utf8");

        //TESTING IF THE CONNECTION WAS RIGHT
        if ($connection->connect_errno) {
            printf("Connection failed: %s\n", $connection->connect_error);
            exit();
        }

        //variables
        $fecha=$_POST['fecha'];
        $hora=$_POST['hora'];
        $invitados=$_POST['invitados'];

        //consulta
        $consulta="INSERT INTO registro_actividades VALUES (NULL,'$fecha','$hora','$invitados',$id);";


        var_dump($consulta);
        if ($result = $connection->query($consulta))
        {
          header ("Location: ../users/users_salidas_ok.php");

        } else {

              echo "Error: " . $result . "<br>" . mysqli_error($connection);
        }
      }

      ?>

            <?php

              echo "<form method='post' id='formulario'>";
              echo "<span><b>Fecha:</b></span> <input type='date' name='fecha' value=''\><br><br>";
              echo "<span><b>Hora:</b></span> <input type='time' name='hora' value=''\><br><br>";
              echo "<span><b>Invitados:</b></span> <input type='text' name='invitados' value=''\><br><br>";

              echo "<button type=\"submit\"name='enviar'>Enviar</button>";
              echo "</from>";

            ?>
    </div>

    <div class="col-sm-6 text-left">
      <br><br>
      <img class="img-responsive img-rounded" style="margin: 0 auto;" src="../Imagenes/salidas2.jpg" alt="cursos" width="500" height="200">
    </div>

  </div>

  </div>

  <div class="row">
    <?php include ("../includes/footer.php"); ?>
  </div>

</div>


</body>
</html>
