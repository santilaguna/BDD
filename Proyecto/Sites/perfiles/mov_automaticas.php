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
  $comuna  = $_POST["comuna"];
  $comuna = strval($comuna);
  $comuna = str_replace('\'', '\'\'', $comuna);
  $presupuesto = $_POST["presupuesto"];
  
  
    if (!empty($comuna) && !empty($presupuesto) && is_numeric($presupuesto)) { 
        $presupuesto = intval($presupuesto);
        $ong = $_SESSION['usuario'];

        $query = "SELECT DISTINCT comuna FROM proyectos WHERE comuna ILIKE '$comuna';";
        $result = $db -> prepare($query);
        $result -> execute();
        $result = $result -> fetchAll();

        $query2 = "SELECT * FROM proyectos_comuna('$comuna');";
        $result2 = $db -> prepare($query2);
        $result2 -> execute();
        $result2 = $result2 -> fetchAll();

        if (count($result) < 1) {
            echo "<li>Estimado usuario, la comuna ingresada no existe</li>";
        }
        elseif (count($result2) < 1) {
            echo "<li>Estimado usuario, la comuna ingresada no tiene proyectos asociados!</li>";
        }
        else {
            $query3 = "select movilizaciones_automaticas('$ong', '$comuna', $presupuesto);";
            $result3 = $db -> prepare($query3);
            $result3 -> execute();
            echo "<li>Movilizaciones agregadas correctamente!</li>"; 
        }
    }
    else {
        echo "<li>Estimado usuario, ha ocurrido un error con su colicitud, 
        revise que el input ingresado sea el correcto!</li>"; 
        if (empty($comuna)) {
            echo "<li>No ingresaste una comuna</li>";
        }
        elseif (empty($presupuesto)) {
            echo "<li>No ingresaste un presupuesto</li>";
        } 
        elseif (!is_numeric($presupuesto)) {
            echo "<li>Presupuesto no es un entero</li>";
        }
    }

  ?>

<br><br>
<form action="perfil_ong.php" method="get">
    <input type="submit" value="Volver">
</form>
</body>

</html> 