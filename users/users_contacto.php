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
  <link rel="stylesheet" href="../bootstrap/css/estilos.css">
  <script src="../bootstrap/js/jquery.min.js"></script>
  <script src="../bootstrap/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
  <script src="../bootstrap/js/graficas.js"></script>

</head>
<body class=" <?php  print_r($color); ?>">

<input id="valor1" hidden value="30">

<div class="container-fluid text-center">

  <nav class="navbar navbar-inverse">
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" rel="home" href="../users/index_usuario.php" title="Contacto">
          <img style="max-width:100px; margin-top: -15px;"
               src="../Imagenes/logo2.jpg"></a>
      </div>
      <div class="collapse navbar-collapse" id="myNavbar">
        <ul class="nav navbar-nav">
          <li><a href="../users/index_usuario.php">Inicio</a></li>
          <li><a href="../users/users_cursos.php">Cursos</a></li>
          <li><a href="../users/users_salidas.php">Salidas</a></li>
          <li class="active"><a href="../users/users_contacto.php">Contacto</a></li>
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
<div id="myfirstchart" style="height: 250px;"></div>

<div class="container-fluid text-center">
  <div class="row content">

    <div class="col-sm-12 text-left">

      <div class="container">

        <div class="row">
                <div class="col-md-12">
                    <div class="well well-sm">
                        <form class="form-horizontal" method="post">
                            <fieldset>
                                <legend class="text-center header">Contacta con nosotros</legend>

                                <div class="form-group">
                                    <span class="col-md-1 col-md-offset-1 text-center"><i class="fa fa-user bigicon"></i></span>
                                    <div class="col-md-8">
                                        <input id="name" name="name" type="text" placeholder="Nombre y Apellidos" class="form-control">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <span class="col-md-1 col-md-offset-1 text-center"><i class="fa fa-envelope-o bigicon"></i></span>
                                    <div class="col-md-8">
                                        <input id="email" name="email" type="text" placeholder="Email" class="form-control">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <span class="col-md-1 col-md-offset-1 text-center"><i class="fa fa-phone-square bigicon"></i></span>
                                    <div class="col-md-8">
                                        <input id="telefono" name="telefono" type="text" placeholder="Teléfono" class="form-control">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <span class="col-md-1 col-md-offset-1 text-center"><i class="fa fa-pencil-square-o bigicon"></i></span>
                                    <div class="col-md-8">
                                        <textarea class="form-control" id="message" name="message" placeholder="Escribe tu consulta." rows="7"></textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-12 text-center">
                                        <button type="submit" class="btn btn-primary btn-lg">Enviar</button>
                                    </div>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
      <div class="row">
        <?php include ("../includes/footer.php"); ?>
      </div>
  </div>
</div>

</body>
</html>
