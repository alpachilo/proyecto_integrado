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

      <div class="col-sm-12 text-left">
        <h2>Socios del Club</h2>
        <hr>
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
          if ($result = $connection->query("select * from usuarios;")) {

          ?>

              <!-- PRINT THE TABLE AND THE HEADER -->

              <div class="container">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>DNI</th>
                      <th>Nombre</th>
                      <th>Nacimiento</th>
                      <th>Dirección</th>
                      <th>Ciudad</th>
                      <th>Provincia</th>
                      <th>Postal</th>
                      <th>Teléfono</th>
                      <th>Email</th>
                      <th>Tareas</th>
                    </tr>
                  </thead>
                  <?php

                      //FETCHING OBJECTS FROM THE RESULT SET
                      //THE LOOP CONTINUES WHILE WE HAVE ANY OBJECT (Query Row) LEFT

                      while($obj = $result->fetch_object()) {
                          //PRINTING EACH ROW


                          echo "<tr>";
                          echo "<td>".$obj->dni."</td>";
                          echo "<td>".$obj->nombre."</td>";
                          echo "<td>".$obj->fecha_naci."</td>";
                          echo "<td>".$obj->direccion."</td>";
                          echo "<td>".$obj->ciudad."</td>";
                          echo "<td>".$obj->provincia."</td>";
                          echo "<td>".$obj->codigo_postal."</td>";
                          echo "<td>".$obj->telefono."</td>";
                          echo "<td>".$obj->email."</td>";
                          echo "<td><a href='admin_usuarios_borrar.php?id=$obj->id_usuario'><img src='../Imagenes/iconos/delete_16.png' width='40%';/></a>
                                <a href='admin_usuarios_edit.php?id=$obj->id_usuario'><img src='../Imagenes/iconos/edit_16.png' width='40%';/></a></td>";
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
              <div>
                <p>Para <b>añadir nuevos socios</b>, pulsar en el botón.</p>
                <a href='admin_usuarios_add.php' class="btn btn-info"><img src='../Imagenes/iconos/add1_16.png';/> <font color="black">Añadir socios</font></a>
                <br><br><br>
              </div>
        </div>
          <div class="row">
            <?php include ("../includes/footer.php"); ?>
          </div>
      </div>
    </div>
</body>
</html>
