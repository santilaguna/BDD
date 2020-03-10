<?php include('../templates/header.html');   ?>

<body>
<?php
  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../config/conexion.php");

  #Se construye la consulta como un string
    $query = "select o.nombre_ong, o.mid, m.presupuesto, m. fecha  
    from organizan as o natural join  movilizaciones as m  
    order by presupuesto DESC;";

  #Se prepara y ejecuta la consulta. Se obtienen TODOS los resultados
	$result = $db -> prepare($query);
	$result -> execute();
	$mov = $result -> fetchAll();
  ?>

  <table>
    <tr>
      <th>nombre ong</th>
      <th>mid</th>
      <th>presupuesto</th>
      <th>fecha</th>

    </tr>
  
      <?php
        foreach ($mov as $p) {
          echo "<tr><td>$p[0]</td><td>$p[1]</td><td>$p[2]</td><td>$p[3]</td></tr>";
      }
      ?>
      
  </table>

<?php include('../templates/footer.html'); ?>