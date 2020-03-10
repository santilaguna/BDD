<?php include('../templates/header.html');   ?>

<body>
<?php
  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../config/conexion.php");



  #Se construye la consulta como un string
  $query = "select distinct región from no_dictaminados;";

  #Se prepara y ejecuta la consulta. Se obtienen TODOS los resultados
	$result = $db -> prepare($query);
	$result -> execute();
	$mov = $result -> fetchAll();
  ?>

  <table>
    <tr>
      <th>region</th>
    </tr>
  
      <?php
        foreach ($mov as $p) {
          echo "<tr><td>$p[0]</td></tr>";
      }
      ?>
      
  </table>

<?php include('../templates/footer.html'); ?>