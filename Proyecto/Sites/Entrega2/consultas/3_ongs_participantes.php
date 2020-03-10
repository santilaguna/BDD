<?php include('../templates/header.html');   ?>

<body>
<?php
  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../config/conexion.php");

  #Se obtiene el valor del input del usuario
  $proyecto = $_POST["proyecto"];
  $proyecto = strval($proyecto);

  #Se construye la consulta como un string
 	$query = "SELECT distinct nombre_ong FROM generan  
   WHERE  rid in (select rid  from se_opone where nombre_proyecto ilike '%$proyecto%');";
  #Se prepara y ejecuta la consulta. Se obtienen TODOS los resultados
	$result = $db -> prepare($query);
	$result -> execute();
	$pokemones = $result -> fetchAll();
  ?>

  <table>
    <tr>
      <th>Nombre ONG</th>
    </tr>
  
      <?php
        foreach ($pokemones as $p) {
          echo "<tr><td>$p[0]</td></tr>";
      }
      ?>
      
  </table>

<?php include('../templates/footer.html'); ?>