<!DOCTYPE html>
<?php
  session_start();
  $color = 'estilos.css';
  if(isset($_SESSION['id_usuario'])){
    /* Abrir conexión con la base de datos */
    $conn = new mysqli("localhost", "root", "madeinsp1", "bajamar");
    $conn->set_charset("utf8");
    /* Realizar una consulta para extraer el color del usuario actual */
    $consulta="SELECT color from usuarios WHERE id_usuario = '".$_SESSION['id_usuario']."'LIMIT 1;";
    if ($res = $conn->query($consulta)){
      $fila = $res->fetch_assoc();
      $color = $fila['color'];
    }
    $_SESSION['tema'] = $color;
  }?>
<?php
  session_start();
  $id=$_SESSION['id_usuario'];
  //var_dump($_SESSION);
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
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
  <style>${demo.css}</style>
  <script type="text/javascript">
$(function () {
  $('#container').highcharts({
      chart: {
          plotBackgroundColor: null,
          plotBorderWidth: null,
          plotShadow: false
      },
      title: {
          text: 'Porcentaje del precio de cursos'
      },
      tooltip: {
          pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
      },
      plotOptions: {
          pie: {
              allowPointSelect: true,
              cursor: 'pointer',
              dataLabels: {
                  enabled: true,
                  format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                  style: {
                      color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                  }
              }
          }
      },
      series: [{
          type: 'pie',
          name: 'Deudores',
          data: [

    <?php
    $sql=$conn->query("select * from curso");
    while($res=$sql->fetch_assoc()){
    ?>

              ['<?php echo $res['nombre']; ?>', <?php echo $res['precio']; ?>],

    <?php
    }
    ?>

          ]
      }]
  });
});


</script>
</head>
<body class=" <?php  print_r($color); ?>">
  <script src="../Highcharts-4.1.5/js/highcharts.js"></script>
  <script src="../Highcharts-4.1.5/js/modules/exporting.js"></script>


  <!--<input id="valor1" hidden value="30">-->

<div class="container-fluid text-center">
  <nav class="navbar navbar-inverse <?php print_r($color); ?>">
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" rel="home" href="index_usuario.php" title="Bajamar">
          <img style="max-width:100px; margin-top: -15px;"
               src="../Imagenes/logo2.jpg"></a>
      </div>
      <div class="collapse navbar-collapse" id="myNavbar">
        <ul class="nav navbar-nav">
          <li><a href="../users/index_usuario.php">Inicio</a></li>
          <li><a href="../users/users_cursos.php">Cursos</a></li>
          <li><a href="../users/users_salidas.php">Salidas</a></li>
          <li><a href="../users/users_contacto.php">Contacto</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
          <?php
          if(isset($_SESSION['user'])){
          ?>
          <li class="active"><a href="../users/users_panel.php"><span class="glyphicon glyphicon-user"></span> Panel de <?php echo $_SESSION['user']; ?></a></li>
          <li><a href="../login/logout.php"><span class="glyphicon glyphicon-log-out"></span> Salir</a></li>
          <?php
          }else{
          ?>
          <li><a href="../users/users_panel.php"><span class="glyphicon glyphicon-log-in"></span> Iniciar sesión</a></li>
          <?php
          }
          ?>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container-fluid text-center">
    <div class="row content">

    <div class="col-xs-12">
      <img src="../Imagenes/foto_panel2.jpg" class="img-responsive" style="margin: 0 auto;" alt="OK">
      <p>Este es tu <b>panel de usuario</b> en el que encontrarás tus cursos inscritos y los registros
        de tus salidas, además como novedad encontrarás algunos gráficos para comprender mejor datos de
        nuestra web. Si necesitas modificar algun registro comunicate con nosotros a través del
        formulario de contacto.</p>
      <hr size="10" />
    </div>



    <div class="col-xs-12">
      <form action="cambiar_color.php" method="post">
        <h2>Cambia tu estilo visual</h2>
        <div class="row">
          <div class="col-md-2 col-md-offset-5">
            <div class="form-group">
              <select class="form-control" name="color">
                <?php var_dump($_SESSION);?>
                <option value="1" <?php if(isset($_SESSION['tema']) && $_SESSION['tema']=="estilo1"){print_r("selected");}?>>Rojo</option>
                <option value="2" <?php if(isset($_SESSION['tema']) && $_SESSION['tema']=="estilo2"){print_r("selected");}?>>Azul</option>
                <option value="3" <?php if(isset($_SESSION['tema']) && $_SESSION['tema']=="estilo3"){print_r("selected");}?>>Amarillo</option>
                <option value="4" <?php if(isset($_SESSION['tema']) && $_SESSION['tema']=="estilo4"){print_r("selected");}?>>Verde</option>
              </select>
            </div>
            <div class="form-group">
                <button type="submit" name="action" value="cambiar_color" class="btn btn-success col-xs-12">Cambiar</button>
            </div>
          </div>
        </div>


      </form>
      <hr size="10" />
    </div>


    <hr size="10" />

    <div class="col-sm-12 text-left">
      <?php
        //CREATING THE CONNECTION
        $connection = new mysqli("localhost", "root", "madeinsp1", "bajamar");
        $connection->set_charset("utf8");

        //TESTING IF THE CONNECTION WAS RIGHT
        if ($connection->connect_errno) {
            printf("Connection failed: %s\n", $connection->connect_error);
            exit();
        }
        //MAKING A SELECT QUERY
        /* Consultas de selección que devuelven un conjunto de resultados */
        if ($result = $connection->query("select * from curso c inner join suscribe s on c.id_curso=s.id_curso where id_usuario=$id;")) {
        ?>
            <!-- PRINT THE TABLE AND THE HEADER -->
            <div class="container">
              <h2>Mis cursos:</h2>
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>Nombre</th>
                      <th>Precio</th>
                      <th>Fecha</th>
                    </tr>
                  </thead>
                <?php
                    //FETCHING OBJECTS FROM THE RESULT SET
                    //THE LOOP CONTINUES WHILE WE HAVE ANY OBJECT (Query Row) LEFT
                    while($obj = $result->fetch_object()) {
                        //PRINTING EACH ROW
                        echo "<tr>";
                        echo "<td>".$obj->nombre."</td>";
                        echo "<td>".$obj->precio."€</td>";
                        echo "<td>".$obj->fecha."</td>";
                        echo "</tr>";
                    }
                    //Free the result. Avoid High Memory Usages
                    $result->close();
                    unset($obj);
                    unset($connection);
                } //END OF THE IF CHECKING IF THE QUERY WAS RIGHT
              ?>
              </table>
            </div>
    </div>

    <div class="col-sm-12 text-left">
      <?php
        //CREATING THE CONNECTION
        $connection = new mysqli("localhost", "root", "madeinsp1", "bajamar");
        $connection->set_charset("utf8");

        //TESTING IF THE CONNECTION WAS RIGHT
        if ($connection->connect_errno) {
            printf("Connection failed: %s\n", $connection->connect_error);
            exit();
        }
        //MAKING A SELECT QUERY
        /* Consultas de selección que devuelven un conjunto de resultados */
        if ($result = $connection->query("select * from registro_actividades where id_usuario=$id;")) {
        ?>
            <!-- PRINT THE TABLE AND THE HEADER -->
            <div class="container">
              <h2>Mis salidas registradas:</h2>
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>Fecha</th>
                      <th>Hora</th>
                      <th>Invitados</th>
                    </tr>
                  </thead>
                <?php
                    //FETCHING OBJECTS FROM THE RESULT SET
                    //THE LOOP CONTINUES WHILE WE HAVE ANY OBJECT (Query Row) LEFT
                    while($obj = $result->fetch_object()) {
                        //PRINTING EACH ROW
                        echo "<tr>";
                        echo "<td>".$obj->fecha."</td>";
                        echo "<td>".$obj->hora."</td>";
                        echo "<td>".$obj->invitados."</td>";
                        echo "</tr>";
                    }
                    //Free the result. Avoid High Memory Usages
                    $result->close();
                    unset($obj);
                    unset($connection);
                } //END OF THE IF CHECKING IF THE QUERY WAS RIGHT
              ?>
              </table>
            </div>
    </div>

    <div class="col-xs-12">
        <hr size="10" />
      <div id="container" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>
        <hr size="10" />
    </div>



      <div class="row">
        <?php include ("../includes/footer.php"); ?>
      </div>
  </div>
</div>



</body>
</html>
