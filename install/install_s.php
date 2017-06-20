<?php

//
// $conn = new mysqli("localhost", "root", "madeinsp1", "bajamar_test");
// $conn->set_charset("utf8");
// /* Realizar una consulta para extraer el color del usuario actual */
//
// $consulta = "CREATE DATABASE bajamar_test;";
// $consulta="CREATE TABLE `curso` (
//   `id_curso` int(5) NOT NULL,
//   `nombre` varchar(255) NOT NULL,
//   `precio` int(11) NOT NULL,
//   `fecha` date NOT NULL
// ) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
//
//
// if (!$res = $conn->query($consulta)){
// return "algo falla";
//
// }


 ?>



 <head>
   <title>C.D. Bajamar</title>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" href="../bootstrap/css/bootstrap.css">
   <link rel="stylesheet" href="../bootstrap/css/<?php echo $_color; ?>">
   <link rel="stylesheet" href="../bootstrap/css/estilos.css">
   <script src="../bootstrap/js/jquery.min.js"></script>
   <script src="../bootstrap/js/bootstrap.min.js"></script>
   <style></style>
 </head>
 <body>

<form class="formulariohost" action="crearbbdd.php" >

<input type="text" id="host" value="host"/>
<input type="text" id="usuario" value="usuario"/>
<input type="text" id="contraseña" value="contraseña"/>

</form>

 </body>
