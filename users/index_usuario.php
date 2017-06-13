<!DOCTYPE html>
<?php
  session_start();
  $color = 'estilos.css';
  if(isset($_SESSION['id_usuario'])){
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
<html lang="en">
<head>
  <title>C.D. Bajamar</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="../bootstrap/css/<?php echo $_color; ?>">
  <link rel="stylesheet" href="../bootstrap/css/estilos.css">
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
      <a class="navbar-brand" rel="home" href="index_usuario.php" title="Buy Sell Rent Everyting">
        <img style="max-width:100px; margin-top: -15px;"
             src="../Imagenes/logo2.jpg"></a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="active"><a href="../users/index_usuario.php">Inicio</a></li>
        <li><a href="../users/users_cursos.php">Cursos</a></li>
        <li><a href="../users/users_salidas.php">Salidas</a></li>
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


  <?php include ("../includes/carrusel.php"); ?>
  <?php include ("../includes/noticias.php"); ?>

  <div class="row">
    <?php include ("../includes/footer.php"); ?>
  </div>

</div>

</body>
</html>
