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
  $especificacion = $_POST["especificacion"];
  $nombre_proyecto = $_POST["nombre_proyecto"];
  $nombre_proyecto = strval($nombre_proyecto);
  $tipo = $_POST["tipo_proyecto"];
  $region = $_POST["region"];
  $region = strval($region);
  $comuna = $_POST["comuna"];
  $comuna = strval($comuna);
  $latitud = $_POST["latitud"];
  $longitud = $_POST["longitud"];
  $operative = $_POST["operativo"];
  $fecha_apertura = $_POST["fecha_apertura"];
  if ($fecha_apertura != NULL) {
    $fecha_apertura = date("Y-m-d", strtotime($fecha_apertura));
  }

  if(empty($nombre_proyecto))
    {
      echo "<li>Estimado usuario olvidaste ingresar el nombre del proyecto!</li>";
    }
  else {
      $proyecto_viejo = FALSE;
      $query_0 = "SELECT nombre_proyecto FROM proyectos WHERE nombre_proyecto = '$nombre_proyecto';";
      $result_0 = $db -> prepare($query_0);
      $result_0 -> execute();
      $hay_proyectos = $result_0 -> fetchAll();
      foreach ($hay_proyectos as $a) {
        $proyecto_viejo = TRUE;          
      }
    if(empty($comuna))
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
    elseif(!ctype_digit($latitud))
    {
      echo "<li>Estimado usuario asegurate de poner una latitud válida!</li>";
    }
    elseif(($latitud < $lat_min) or ($latitud > $lat_max))
    {
      echo "<li>Estimado usuario asegurate de poner una latitud válida!</li>";
    }
    elseif(!ctype_digit($longitud))
    {
      echo "<li>Estimado usuario asegurate de poner una longitud válida!</li>";
    }
    elseif(empty($especificacion) and $tipo != 3)
    {
      echo "<li>Estimado usuario asegurate de poner especificaciones obligatorias de tu proyecto!</li>";
    }
    elseif(($longitud < $lon_min) or ($longitud > $lon_max))
    {
      echo "<li>Estimado usuario asegurate de poner una longitud válida!</li>";
    }
    elseif(empty($fecha_apertura))
    {
      echo "<li>Estimado usuario asegurate de poner una fecha de apertura válida!</li>";
    }
    elseif($proyecto_viejo) {
      echo "<li>Estimado usuario el nombre del proyecto ya existe, escoge otro nombre!</li>";
    }
    else {
      echo "<li>Proyecto creado de forma exitosa!</li>";

      $query_1_db = "INSERT INTO Proyectos VALUES (:tipo, :nombre_proyecto, :lat, :lon, 
      :region, :comuna, :fecha_apertura, :operativo);";
      $query_2_db = "INSERT INTO SociosProyectos VALUES (:socio, :nombre_proyecto);";
      $request1_db = $db2 -> prepare($query_1_db);
      $request1_db = $request1_db -> execute( array(':tipo'=>$tipo, ':nombre_proyecto'=> $nombre_proyecto,
      ':lat'=> $latitud, ':lon'=> $longitud, ':region'=>$region, ':comuna'=>$comuna, ':fecha_apertura'=> $fecha_apertura,
      ':operativo'=>$operative));
      $request2_db = $db2 -> prepare($query_2_db);
      $request2_db = $request2_db -> execute( array(':socio'=> $socio, ':nombre_proyecto'=> $nombre_proyecto));
    
      $query_1_db2 = "INSERT INTO Proyectos VALUES ( :nombre_proyecto, :operativo, :fecha_apertura, :comuna, :lon, :lat, 
      :region);";
      $query_2_db2 = "INSERT INTO Asociados VALUES (:nombre_proyecto, :socio);";
      $request1_db2 = $db -> prepare($query_1_db2);
      $request1_db2 = $request1_db2 -> execute( array(':nombre_proyecto'=> $nombre_proyecto, ':operativo' => $operative, 'fecha_apertura' => $fecha_apertura,
      ':comuna'=>$comuna, ':lon' => $longitud, ':lat' => $latitud, ':region' => $region));
      $request2_db2 = $db -> prepare($query_2_db2);
      $request2_db2 = $request2_db2 -> execute( array(':nombre_proyecto'=> $nombre_proyecto, ':socio'=> $socio));

      if($tipo == 1){
        $quer = "INSERT INTO Mineras Values(:nombre_proyecto, :especificacion);";
        $req = $db2 -> prepare($quer);
        $req = $req -> execute( array(':nombre_proyecto' => $nombre_proyecto,
        ':especificacion' => $especificacion));
    
        $querr = "INSERT INTO Minas Values(:nombre_proyecto, :especificacion);";
        $reqq = $db -> prepare($querr);
        $reqq = $reqq -> execute( array(':nombre_proyecto' => $nombre_proyecto,
        ':especificacion' => $especificacion)); 
      } 
      elseif($tipo == 2){
        $quer2 = "INSERT INTO generadoras_electricas Values(:nombre_proyecto, :especificacion);";
        $req2 = $db2 -> prepare($quer2);
        $req2 = $req2 -> execute( array(':nombre_proyecto' => $nombre_proyecto,
        ':especificacion' => $especificacion));
    
        $querr2 = "INSERT INTO Centrales Values(:nombre_proyecto, :especificacion);";
        $reqq2 = $db -> prepare($querr2);
        $reqq2 = $reqq2 -> execute( array(':nombre_proyecto' => $nombre_proyecto,
          ':especificacion' => $especificacion)); 
      } 
      elseif($tipo == 3){
        $querr2 = "INSERT INTO vertederos Values(:nombre_proyecto);";
        $reqq2 = $db -> prepare($querr2);
        $reqq2 = $reqq2 -> execute( array(':nombre_proyecto' => $nombre_proyecto)); 
      }

    }
  }
?>
  
  <br><br>
<form action="crear_proyecto.php" method="get">
    <input type="submit" value="Volver">
</form>
</body>

</html>
