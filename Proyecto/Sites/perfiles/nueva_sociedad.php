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
  $nombre = $_SESSION["usuario"];
  $query = "SELECT p.pnombre, p.ptipo, p.pregion FROM Proyectos AS p 
  WHERE p.pnombre not in (SELECT sp.pnombre FROM SociosProyectos AS sp WHERE sp.snombre = '$nombre');";

  
  #Se construye la consulta como un string
  #Se prepara y ejecuta la consulta. Se obtienen TODOS los resultados
	$result = $db2 -> prepare($query);
	$result -> execute();
	$pokemones = $result -> fetchAll();
    
    ?>
<div align="center">
  <table>
      <tr>
        <th>Proyectos en los que no participas </th>
        
      </tr>
    <?php
    foreach ($pokemones as $p) {
          echo "<tr><td><a href='agregar_socio_proyecto.php?id=$p[0]'>$p[0]</a></td></tr>";
      }
    
    ?>  
  </table>
</div>

  <br><br>
<form action="perfil_socio.php" method="get">
    <input type="submit" value="Volver">
</form>
</body>

</html> 