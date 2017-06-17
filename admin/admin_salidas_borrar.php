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
        $a = $_GET['id'];
        $connection = new mysqli("localhost", "root", "madeinsp1", "bajamar");

            if ($result = $connection->query("DELETE FROM registro_actividades
             where id_registro='$a'")) {
              echo "El usuario $a ha sido borrado con éxito.<br>";
              header("Location: admin_salidas.php");
            } else {
                mysqli_error($connection);
                header("Location: index_invi.php");
            }
      ?>

    </body>
</html>
