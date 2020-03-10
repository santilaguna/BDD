<?php 
  if ((function_exists('session_status') 
    && session_status() !== PHP_SESSION_ACTIVE) || !session_id()) {
    session_start();
  }
  if ((!isset($_SESSION['loggedin'])) || (($_SESSION['loggedin'] != 'socio') && ($_SESSION['loggedin'] != 'ong'))) {
    include('../templates/header.html');   
  }
  elseif ($_SESSION['loggedin'] == 'socio') {
    include('../templates/header_socio.html'); 
  }
  else {  # $_SESSION['loggedin'] == 'ong'
    include('../templates/header_ong.html'); 
  }
?>

<body>

<?php
  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../config/conexion.php");

  $proy = $_GET['id'];
  
 	$query = "SELECT p.*
      FROM Proyectos as p
      WHERE p.pnombre = '$proy';";
	$result = $db2 -> prepare($query);
	$result -> execute();
    $proyectos = $result -> fetchAll();
  ?>
  <h3 align="center"> Haz Click en el nombre del proyecto para confirmar:</h3>
	<table>
    <tr>
      <th>Nombre</th>
      <th>Tipo</th>
      <th>Latitud</th>
      <th>Longitud</th>
      <th>Región</th>
      <th>Comuna</th>
      <th>Fecha Apertura</th>
      <th>Activo</th>
    </tr>
  <?php
    
    foreach ($proyectos as $p) {
  		echo "<tr><td><a href='backend_nvo_socio.php?pname=$p[1]'>$p[1]</td><td>$p[0]</td><td>$p[2]</td><td>$p[3]</td><td>$p[4]</td><td>$p[5]</td><td>$p[6]</td><td>$p[7]</td></tr>";
  }
  ?>
<?php include('../templates/footer.html'); ?>
