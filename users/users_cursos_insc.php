<!DOCTYPE html>
<html lang="">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" type="text/css" href=" ">
    </head>
    <body class=" <?php  print_r($color); ?>">



      <?php
        session_start();
        $id=$_SESSION['id_usuario'];
        if (empty($_GET))
        die("Tienes que pasar algun parametro por GET.");
        $id_curso = $_GET['id'];
        $connection = new mysqli("localhost", "root", "madeinsp1", "bajamar");
            if ($result = $connection->query("INSERT INTO suscribe
             VALUES ('$id_curso','$id');")) {
              header("Location: ../users/users_cursos_inscrip_ok.php");
            } else {
                mysqli_error($connection);
                header("Location: ../index.php");
            }
      ?>



    </body>
</html>
