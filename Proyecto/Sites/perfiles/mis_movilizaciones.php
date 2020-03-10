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
  
  $query = "SELECT m.mid
  FROM movilizaciones as m
  WHERE m.mid in (SELECT org.mid FROM organizan AS org WHERE org.nombre_ong = '$nombre');";

  
  #Se construye la consulta como un string
  #Se prepara y ejecuta la consulta. Se obtienen TODOS los resultados
	$result = $db -> prepare($query);
	$result -> execute();
	$movilizaciones = $result -> fetchAll();
    
    ?>
<h3 align="center"> Tus movilizaciones</h3>
<table align="center">
    <tr>
      <th>mid</th>
    </tr>
  <?php
	foreach ($movilizaciones as $m) {
    $str = "<tr>";
    $str = $str . "<td><a href='../consultas/movilizaciones.php?id=" . urlencode($m[0]) ."'>" . $m[0] ."</a></td>";
    echo $str . "</tr>";
	}
  ?>  
	</table>


  <br><br>
<form action="perfil_ong.php" method="get">
    <input type="submit" value="Volver">
</form>
</body>

</html>
