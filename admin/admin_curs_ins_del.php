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
        if (empty($_GET))
        die("Tienes que pasar algun parametro por GET.");
        $id_c = $_GET['id_c'];
        $id_u = $_GET['id_u'];
        $connection = new mysqli("localhost", "root", "madeinsp1", "bajamar");

            if ($result = $connection->query("DELETE FROM suscribe
             where id_curso='$id_c' and id_usuario='$id_u'")) {
              echo "El usuario $a ha sido borrado con éxito.<br>";
              header("Location: admin_cursos.php");
            } else {
                mysqli_error($connection);
                header("Location: index_admin.php");
            }
      ?>


    </body>
</html>
