<?php 
  if ((function_exists('session_status') 
    && session_status() !== PHP_SESSION_ACTIVE) || !session_id()) {
  session_start();
  }
  include('../templates/header.html'); 
?>

<body>

<?php
  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../config/conexion.php");

	$name = $_POST["nombre"];
	$name= strval($name);
	$lname = $_POST["apellido"];
	$lname = strval($lname);
	$passw = $_POST["clave"];
	$passw = strval($passw);


	if(empty($name))
    {
      echo "<li>Estimado usuario olvidaste ingresar tu nombre!</li>";
    }
	elseif(empty($lname))
	{
	  echo "<li>Estimado usuario olvidaste ingresar tu apellido!</li>";
	}
	elseif(empty($passw))
	{
	  echo "<li>Estimado usuario olvidaste ingresar tu clave!</li>";
	}
	else
	{	
	  $query = "SELECT * FROM Socios WHERE snombre = '$name $lname' AND claves = '$passw';";
	  $result = $db2 -> prepare($query);
	  $result -> execute();
	  $result = $result -> fetchAll();
	
	
	  if(count($result) != 1) {
	    echo "<li>combinación de usuario clave errónea!</li>";
	  }
	
	  else {
		# almacenar nombre
		$_SESSION['loggedin'] = 'socio'; // store session data
		$_SESSION['usuario'] = $name.' '. $lname;
		echo "<script>location.href='../perfiles/perfil_socio.php';</script>";
	  }
	  
	}
		?>

<br><br>
<form action="log_in_socio.php" method="get">
    <input type="submit" value="Volver">
</form>
</body>

</html>
