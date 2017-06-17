<!DOCTYPE html>
<?php
  session_start();

    $conn = new mysqli("localhost", "root", "madeinsp1", "bajamar");
    $conn->set_charset("utf8");

  ?>
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
  $('#container3').highcharts({
      chart: {
          plotBackgroundColor: null,
          plotBorderWidth: null,
          plotShadow: false
      },
      title: {
          text: 'Relación del precio de cursos'
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

$(function () {

    $('#container2').highcharts({
        chart: {
            type: 'pyramid',
            marginRight: 200
        },
        title: {
            text: 'Relación material/año',
            x: -50
        },
        plotOptions: {
            series: {
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b> ({point.y:,.0f})',
                    color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black',
                    softConnector: true
                }
            }
        },
        legend: {
            enabled: false
        },
        series: [{
            name: 'Año material',
            data: [

							<?php
					    $sql=$conn->query("select * from material order by nombre");
					    while($res=$sql->fetch_assoc()){
					    ?>

              ['<?php echo $res['nombre']; ?>', <?php echo $res['fecha_compra']; ?>],

        			<?php
        			}
        			?>

            ]
        }]
    });
});

</script>
</head>
<body>
  <script src="../Highcharts-4.1.5/js/highcharts.js"></script>
  <script src="../Highcharts-4.1.5/js/modules/funnel.js"></script>
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
          <li><a href="index_admin.php">Inicio</a></li>
          <li><a href="admin_cursos.php">Cursos</a></li>
          <li><a href="admin_material.php">Material</a></li>
          <li><a href="admin_usuarios.php">Usuarios</a></li>
          <li><a href="admin_salidas.php">Salidas</a></li>
          <li class="active"><a href="admin_panel.php">Panel</a></li>
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
      <h1>Panel de administrador</h1>
      <img src="../Imagenes/foto_admin.jpg" class="img-responsive" style="margin: 0 auto;" alt="OK">
      <hr size="10" />
    </div>

    <div class="col-xs-12">
      <div id="container3" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>
        <hr size="10" />
    </div>

    <div class="col-xs-12">
      <div id="container2" style="min-width: 410px; max-width: 600px; height: 400px; margin: 0 auto"></div>
        <hr size="10" />
    </div>

    <div class="col-xs-12">
      <div id="container"></div>
    </div>

      <div class="row">
        <?php include ("../includes/footer.php"); ?>
      </div>
  </div>
</div>



</body>
</html>
