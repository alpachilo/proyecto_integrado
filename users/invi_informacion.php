<!DOCTYPE html>
<?php
  session_start();
 ?>
<html lang="en">
<head>
  <title>C.D. Bajamar</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="../bootstrap/css/estilos.css">
  <script src="../bootstrap/js/jquery.min.js"></script>
  <script src="../bootstrap/js/bootstrap.min.js"></script>
  <style>
  </style>
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
        </button>
        <a class="navbar-brand" rel="home" href="../index.php" title="Bajamar">
          <img style="max-width:100px; margin-top: -15px;"
               src="../Imagenes/logo2.jpg"></a>
      </div>
      <div class="collapse navbar-collapse" id="myNavbar">
        <ul class="nav navbar-nav">
          <li><a href="../index.php">Inicio</a></li>
          <li class="active"><a href="../users/invi_informacion.php">Información</a></li>
          <li><a href="../users/invi_contacto.php">Contacto</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
          <?php
          if(isset($_SESSION['user'])){
          ?>
          <li><a href="../login/login.php"><span class="glyphicon glyphicon-user"></span> Bienvenido, <?php echo $_SESSION['user']; ?></a></li>
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

      <div>
        <br>
        <img class="img-responsive img-rounded" style="margin: 0 auto;" width="500" height="300" src="../Imagenes/bajamar.jpg" alt="bajamar">
      <div>

    <div class="col-sm-12 text-left">
      <br><br>
      <p align="justify"><b>El Club Deportivo Bajamar</b> lleva funcionando desde el año 2003, desde <b>nuestro proyecto</b> hemos pretendido en todo momento el <b>fomento del deporte y disfrutar de nuestro entorno natural</b>. Realizamos distintos tipos de actividades y cursos desde nuestro club, además trabajamos conjuntamente con el Patronato Municipal de Ayamonte con el que realizamos y servimos de apoyo para diferentes actividades.</p>
      <p align="justify"><b>C.D. Bajamar</b> cuenta con experiencia en organización de actividades deportivas al aire libre por su personal cualificado y los medios técnicos de que dispone, actividades que permiten mejorar la calidad de vida a través de la promoción y adquisición de hábitos saludables.</p>
      <p><b>Nuestras distintas actividades se centran en:</b>
        <ol>
          <li>Cursos de iniciación y perfecionamiento para niñ@s y adultos</li>
          <li>Escuela de Piragüismo</li>
          <li>Rustas turísticas</li>
        </ol>
      </p>
      <br>
      <p align="justify">Si quieres <b>formar parte de nuestro club</b>, solo tienes que mandarnos un correo electrónico o comunicarte con nostros a través de nuestro formulario de contacto y te indicaremos las instrucciones para inscribirte en nuestro club.</p>
      <br>
    </div>

  </div>

</div>
  <div class="row">
    <?php include ("../includes/footer.php"); ?>
  </div>
</div>

</body>
</html>
