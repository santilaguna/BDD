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
	$passw = $_POST["clave"];
	$passw = strval($passw);


	if(empty($name))
    {
      echo "<li>Estimado usuario olvidaste ingresar tu organizacióne !</li>";
    }
	
	elseif(empty($passw))
	{
	  echo "<li>Estimado usuario olvidaste ingresar la clave!</li>";
	}
	else
	{	  
	  $query = "SELECT * FROM ongs WHERE nombre_ong = '$name' AND claves = '$passw';";
	  $result = $db -> prepare($query);
	  $result -> execute();
	  $result = $result -> fetchAll();
	
	
	  if(count($result) != 1) {
	    echo "<li>combinación de usuario clave errónea!</li>";
	  }
	
	  else {
		# almacenar nombre
		$_SESSION['loggedin'] = 'ong'; // store session data
		$_SESSION['usuario'] = $name;
		echo "<script>location.href='../perfiles/perfil_ong.php';</script>";
	  }



	}
		?>
<br><br>
<form action="log_in_ong.php" method="get">
    <input type="submit" value="Volver">
</form>
</body>

</html>
