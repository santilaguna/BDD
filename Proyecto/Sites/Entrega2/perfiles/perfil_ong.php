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
  <h3 align="center"> Administra tus movilizaciones</h3>
  <br/><br/>
  <body>
<form action="mis_movilizaciones.php"  method="post">
  <input type="submit" value="Mis movilizaciones" />
</form>
<br/><br/>
<h3 align="center"> Selecciona una comuna a movilizar y un presupuesto:</h3>
<form action="mis_movilizaciones.php"  method="post">
<p> comuna: </p>   
<input type="text" name="comuna" />
<p> presupuesto: </p>   
<input type="text" name="comuna" />
<br/><br/>
<input type="submit" value="Crear movilización" />
</form>
<form action="../index.php"  method="post">
  <input type="submit" value="cerrar sesion" />
  <?php $_SESSION['loggedin'] = FALSE;?>
</form>
