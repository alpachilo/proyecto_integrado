<!DOCTYPE html>
<html lang="">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" type="text/css" href=" ">
    </head>
    <body>


      <?php
        session_start();
        if (empty($_GET))
        die("Tienes que pasar algun parametro por GET.");
        $a = $_GET['id'];
        $connection = new mysqli("localhost", "id1003383_root", "123456", "id1003383_bajamar");

            if ($result = $connection->query("DELETE FROM curso
             where id_curso='$a'")) {
              echo "El usuario $a ha sido borrado con éxito.<br>";
              header("Location: admin_cursos.php");
            } else {
                mysqli_error($connection);
                header("Location: index_admin.php");
            }
      ?>


    </body>
</html>
