<?php include('../templates/header.html');   ?>

<body>
<?php
  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../config/conexion.php");

  #Se obtiene el valor del input del usuario
  $year = $_POST["ano"];
  $year = intval($year);

  #Se construye la consulta como un string
     $query = "select * from movilizaciones 
     where EXTRACT(year FROM fecha) = $year;";

  #Se prepara y ejecuta la consulta. Se obtienen TODOS los resultados
	$result = $db -> prepare($query);
	$result -> execute();
	$mov = $result -> fetchAll();
  ?>

  <table>
    <tr>
      <th>mid</th>
      <th>presupuesto</th>
      <th>fecha</th>

    </tr>
  
      <?php
        foreach ($mov as $p) {
          echo "<tr><td>$p[0]</td><td>$p[1]</td><td>$p[2]</td></tr>";
      }
      ?>
      
  </table>

<?php include('../templates/footer.html'); ?>