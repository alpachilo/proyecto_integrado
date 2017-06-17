<!DOCTYPE html>
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
            <li class="active"><a href="admin_material.php">Material</a></li>
            <li><a href="admin_usuarios.php">Usuarios</a></li>
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
          <h2>Editar material</h2>
          <hr>

      <?php
      $id = $_GET['id'];
      //CREATING THE CONNECTION
      $connection = new mysqli("localhost", "root", "madeinsp1", "bajamar");
      $connection->set_charset("utf8");

      //TESTING IF THE CONNECTION WAS RIGHT
      if ($connection->connect_errno) {
          printf("Connection failed: %s\n", $connection->connect_error);
          exit();
      }

      if ($result = $connection->query("SELECT * from material
        where id_material = '$id';")) {

        $obj = $result->fetch_object();

        echo "<form method='post' id='formulario'>";
        echo "<span><b>Nombre:</b></span> <input type='text' name='nombre' value='$obj->nombre'\><br><br>";
        echo "<span><b>Fecha compra:</b></span> <input type='date' name='fecha_compra' value='$obj->fecha_compra'\><br><br>";
        echo "<span><b>Estado:</b></span> <input type='text' name='estado' value='$obj->estado'\><br><br>";

        echo "<button type=\"submit\"name='edit'>EDITAR</button>";
        echo "</from>";
      } else {

            echo "Error: " . $result . "<br>" . mysqli_error($connection);
      }

      unset($obj);

      if (isset($_POST['edit'])) {

        //variables
        $nombre=$_POST['nombre'];
        $fecha_compra=$_POST['fecha_compra'];
        $estado=$_POST['estado'];

        //consulta
        $consulta="UPDATE  `material` SET
        `nombre` =  '$nombre',
        `fecha_compra` =  '$fecha_compra',
        `estado` =  '$estado'
        WHERE  `id_material` =$id;";

        var_dump($consulta);
        if ($result = $connection->query($consulta))

           {
          header ("Location: admin_material.php");
        } else {

              echo "Error: " . $result . "<br>" . mysqli_error($connection);
        }
      }
      unset($connection);
      ?>

          </div>

          <br>
          <br>
          <br>

          <div class="col-sm-6 text-left">
            <img class="img-responsive img-rounded" style="margin: 0 auto;" src="../Imagenes/material.png" alt="cursos" width="500" height="200">
            <img class="img-responsive img-rounded" style="margin: 0 auto;" src="../Imagenes/add_cursos2.jpg" alt="cursos" width="500" height="200">
            <br><br>
          </div>


          <div class="row">
            <?php include ("../includes/footer.php"); ?>
          </div>

      </div>

      </body>
      </html>
