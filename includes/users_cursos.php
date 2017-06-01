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
      <a class="navbar-brand" rel="home" href="index_usuario.php" title="Buy Sell Rent Everyting">
        <img style="max-width:100px; margin-top: -15px;"
             src="../Imagenes/logo2.jpg"></a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li><a href="../users/index_usuario.php">Inicio</a></li>
        <li class="active"><a href="../users/users_cursos.php">Cursos</a></li>
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

<div class="container-fluid text-center">

  <div class="row content">

    <div class="col-sm-12 text-left">
      <br>
      <br>
      <p align="justify">Estos son los <b>cursos disponibles</b> que ofrecemos actualmente, <b>si estas interesado en inscribirte
         pulsa en el "tick verde"</b>, una vez inscrito nos comunicaremos contigo para proporcionarte mas información.</p>
      <br>

      <div>
        <img class="img-responsive img-rounded" style="margin: 0 auto;" width="800" height="500" src="../Imagenes/curso2.jpg" alt="cursos">
      </div>

      <br>
      <br>

      <?php

        //CREATING THE CONNECTION
        $connection = new mysqli("localhost", "id1003383_root", "123456", "id1003383_bajamar");
        $connection->set_charset("utf8");

        //TESTING IF THE CONNECTION WAS RIGHT
        if ($connection->connect_errno) {
            printf("Connection failed: %s\n", $connection->connect_error);
            exit();
        }

        //MAKING A SELECT QUERY
        /* Consultas de selección que devuelven un conjunto de resultados */
        if ($result = $connection->query("select * from curso;")) {

        ?>

            <!-- PRINT THE TABLE AND THE HEADER -->

            <div class="container">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>Nombre</th>
                    <th>Precio</th>
                    <th>Fecha</th>
                    <th>Inscripción</th>
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
                        echo "<td><a href='../users/users_cursos_insc.php?id=$obj->id_curso'><img src='../Imagenes/iconos/Accept-icon16.png' width='10%';/></a></td>";
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

            <br>

    </div>

    <div class="row">
      <?php include ("../includes/footer.php"); ?>
    </div>

</div>

</body>
</html>
