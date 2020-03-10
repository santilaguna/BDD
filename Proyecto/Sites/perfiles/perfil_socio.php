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

<style>
body{background-image: url("http://www.omnarquitectos.cl/wp-content/uploads/2018/03/OMN-19-EDIFICIO-AULAS-SAN-JOAQUIN-06.jpg");}
h3{color: #FFFFFF}
form{color: #FFFFFF}
</style>

  <!-- <h1 align="center">Entrega 2 IIC2413 </h1> -->

  <img class="imagen" border="0" src="" align = center >

  <!-- <img class="imagen" border="0" src="https://k42.kn3.net/taringa/5/0/6/6/9/7/6/devilmankiller/286.gif" style="position:absolute; left: 60% ; top:2%" > -->
  <h3 align="center"> Crea Proyectos y nuevas sociedades</h3>
  <br/><br/>
  <body>
<form action="crear_proyecto.php"  method="post">
  <input type="submit" value="Crear Proyecto" />
</form>
<br/><br/>
<form action="nueva_sociedad.php"  method="post">
  <input type="submit" value="unirse a proyecto" />
</form>
<br/><br/>
<form action="logout.php"  method="post">
  <input type="submit" value="cerrar sesion" />
</form>
