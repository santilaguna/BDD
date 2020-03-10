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

  // #Se obtiene el valor del input del usuario
  $nombre  = $_SESSION["usuario"];
  
  $query = "SELECT m.*
  FROM Movilizaciones as m
  WHERE m.mid in (SELECT org.mid FROM Organizan AS org WHERE org.nombre_ong = '$nombre');";

  
  #Se construye la consulta como un string
  #Se prepara y ejecuta la consulta. Se obtienen TODOS los resultados
	$result = $db -> prepare($query);
	$result -> execute();
	$pokemones = $result -> fetchAll();
    
    ?>

<table>
    <tr>
      <th>ID</th>
      <th>Presupuesto</th>
      <th>Fecha</th>
    </tr>
  <?php
	foreach ($pokemones as $m) {
  		echo "<tr><td>$m[0]</td><td>$m[1]</td><td>$m[2]</td></tr>";
	}
  ?>  
	</table>

<?php include('../templates/footer.html'); ?>