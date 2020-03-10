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
<?php
  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../config/conexion.php");

  // #Se obtiene el valor del input del usuario
  $socio = $_SESSION["usuario"];  
  $socio = strval($socio);
  $proyecto = $_GET["pname"];
  $proyecto = strval($proyecto);
  $query = "INSERT INTO SociosProyectos VALUES ('$socio', '$proyecto');";
	$result = $db2 -> prepare($query);
	$result -> execute();
  #Se construye la consulta como un string
  #Se prepara y ejecuta la consulta. Se obtienen TODOS los resultados
	?>

  