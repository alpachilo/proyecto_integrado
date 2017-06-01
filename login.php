<?php
  session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Login Bajamar</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="../bootstrap/css/estilos.css">
    <link rel="stylesheet" href="../bootstrap/css/login.css">
    <script src="../bootstrap/js/jquery.min.js"></script>
    <script src="../bootstrap/js/bootstrap.min.js"></script>
  </head>
  <body background="../Imagenes/fondo_login2.jpg">

    <?php
      if(isset($_POST['conectar'])){
        //FORM SUBMITTED
        if (isset($_POST["user"])) {

          //CREATING THE CONNECTION
          $connection = new mysqli("localhost", "id1003383_root", "123456", "id1003383_bajamar");

          //TESTING IF THE CONNECTION WAS RIGHT
          if ($connection->connect_errno) {
              printf("Connection failed: %s\n", $connection->connect_error);
              exit();
          }

          //MAKING A SELECT QUERY
          //Password coded with md5 at the database. Look for better options
          $consulta="select * from usuarios where
          email='".$_POST["user"]."' and pass=md5('".$_POST["password"]."');";

          //Test if the query was correct
          if ($result = $connection->query($consulta)) {

              //No rows returned
              if ($result->num_rows===0) {
                echo"<script type=\"text/javascript\">alert('Usuario o contraseña incorrectos'); window.location='../login/login.php';</script>";

              } else {
                //VALID LOGIN. SETTING SESSION VARS
                $fila = $result->fetch_assoc();
                $_SESSION["user"]=$fila['nombre'];
                $_SESSION["language"]="es";
                $_SESSION['tipo'] = $fila['tipo'];
                $_SESSION['id_usuario'] = $fila['id_usuario'];

                if ($fila['tipo']=='usuario') {
                  header("Location: ../users/index_usuario.php");

                } else {
                  header("Location: ../admin/index_admin.php");
                }

              }

          } else {
            echo "Wrong Query";
          }
        }
      }

    ?>


    <div class="col-sm-6-center">
      <img class="img-responsive img-rounded" style="margin: 0 auto; margin-top: 20 !important;" src="../Imagenes/logo_transpa2.png" alt="logo" width="200" height="50">
    </div>

    <div class="container">

      <form class="form-signin" action="login.php" method="post">
        <input name="user" class="form-control" placeholder="Email" required="" autofocus="">
        <input name="password" type="password" class="form-control" placeholder="Contraseña" required="">
        <button class="btn btn-lg btn-primary btn-block width-form" type="submit" name="conectar">
          Conectar
        </button>
      </form>

  </body>
</html>
