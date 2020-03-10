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
  
  $lat_min = -90;
  $lat_max = 90;
  $lon_min = -180;
  $lon_max = 180;
  $nombre_proyecto = $_POST["nombre"];
  $tipo = $_POST["tipo_proyecto"];
  $region = $_POST["region"];
  $comuna = $_POST["comuna"];
  $latitud = $_POST["latitud"];
  $longitud = $_POST["longitud"];
  $operative = $_POST["operativo"];
  $fecha_apertura = $_POST["fecha_apertura"];

  if(empty($nombre_proyecto))
    {
      echo "<li>Estimado usuario olvidaste ingresar el nombre del proyecto!</li>";
    }
	elseif(empty($comuna))
	{
	  echo "<li>Estimado usuario olvidaste ingresar la comuna del proyecto!</li>";
	}
	elseif(empty($latitud))
	{
    echo "<li>Estimado usuario olvidaste latitud del proyecto!</li>";
  }
  elseif(empty($longitud))
  {
    echo "<li>Estimado usuario olvidaste longitud del proyecto!</li>";
  }
  elseif(!is_float($latitud) and !is_int($latitud))
	{
    echo "<li>Estimado usuario asegurate de poner una latitud válida!</li>";
  }
  elseif(($latitud < $lat_min) or ($latitud > $lat_max))
	{
    echo "<li>Estimado usuario asegurate de poner una latitud válida!</li>";
  }
  elseif(!is_float($longitud) and !is_int($longitud))
	{
    echo "<li>Estimado usuario asegurate de poner una longitud válida!</li>";
  }
  elseif(($longitud < $lon_min) or ($longitud > $lon_max))
	{
    echo "<li>Estimado usuario asegurate de poner una longitud válida!</li>";
  }
  
  

