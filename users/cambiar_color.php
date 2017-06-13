<?php

session_start();
if (isset($_POST['action']) && $_POST['action']=='cambiar_color') {

  //CREATING THE CONNECTION
  $connection = new mysqli("localhost", "root", "madeinsp1", "bajamar");
  $connection->set_charset("utf8");

  //TESTING IF THE CONNECTION WAS RIGHT
  if ($connection->connect_errno) {
      printf("Connection failed: %s\n", $connection->connect_error);
      exit();
  }

  //variables
  $color=$_POST['color'];

  //consulta


  switch($color){
    case '1':
      $color = 'estilo1';
      break;
    case '2':
      $color = 'estilo2';
      break;
    case '3':
      $color = 'estilo3';
      break;
    case '4':
      $color = 'estilo4';
      break;
  }


  $consulta="UPDATE usuarios SET color = '".$color."' WHERE id_usuario = '".$_SESSION['id_usuario']."';";

  $_SESSION['tema'] = $color;

  var_dump($consulta);
  if ($result = $connection->query($consulta))
  {
    header ("Location: ../users/users_panel.php");

  } else {

        echo "Error: " . $result . "<br>" . mysqli_error($connection);
  }
}
unset($connection);
?>
