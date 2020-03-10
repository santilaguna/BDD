<?php include('templates/header.html');   ?>

<body>

  
<style>
body{background-image: url("http://www.omnarquitectos.cl/wp-content/uploads/2018/03/OMN-19-EDIFICIO-AULAS-SAN-JOAQUIN-06.jpg");}
h3{color: #FFFFFF}
form{color: #FFFFFF}
</style>

  <h1 align="center">Entrega 1 IIC2413 </h1>
  <div><span style="color:#ff0000;">P</span><span style="color:#ff4000;">á</span><span style="color:#ff7f00;">g</span><span style="color:#ffbf00;">i</span><span style="color:#ffff00;">n</span><span style="color:#80ff00;">a</span><span style="color:#00ff00;"> </span><span style="color:#00ff80;">S</span><span style="color:#00ffff;">o</span><span style="color:#0080ff;">b</span><span style="color:#0000ff;">r</span><span style="color:#8b00ff;">e</span><span style="color:#c50080;">s</span><span style="color:#ff0000;">a</span><span style="color:#ff4000;">l</span><span style="color:#ff7f00;">i</span><span style="color:#ffbf00;">e</span><span style="color:#ffff00;">n</span><span style="color:#80ff00;">t</span><span style="color:#00ff00;">e</span></div>
  <img class="imagen" border="0" src="https://k42.kn3.net/taringa/5/0/6/6/9/7/6/devilmankiller/286.gif" style="position:absolute; left: 60% ; top:2%" >


  <p align="center">
<marquee scrollamount="15">Soy una consulta en wix!</marquee><br>
<marquee scrollamount="20">Soy una consulta con joins</marquee><br>
<marquee scrollamount="25">Soy una consulta con BD no relacionales</marquee><br>
<marquee scrollamount="135">Le pregunté a Rediz</marquee></p>

<h3 align="center"> 1: Todas las marchas planificadas para el año. </h3>


<form align="center" action="consultas/1_consulta_ano_2020.php" method="post">
  Ingrese año:
  <input type="text" name="ano">
  <br/><br/>
  <input type="submit" value="Buscar">
</form>
  <br>
  <br>
  <br>

  <h3 align="center"> 2: Todos los recursos abiertos entre las fechas</h3>

  <form align="center" action="consultas/2_recursos_entre_fechas.php" method="post">
    Despues de:
    <input type="date" name="fecha_a">
    <br/>
    Antes de:
    <input type="date" name="fecha_b">
    <br/><br/>
    <input type="submit" value="Buscar">
  </form>
  
  <br>
  <br>
  <br>

  <h3 align="center"> 3: ONGS que participan en el proyecto </h3>


  <form align="center" action="consultas/3_ongs_participantes.php" method="post">
    Proyecto:
    <input type="text" name="proyecto">
    <br/><br/>
    <input type="submit" value="Buscar">
  </form>
  
  <br>
  <br>
  <br>

  <h3 align="center"> 4: Regiones con recurso vigente </h3>

  <form align="center" action="consultas/4_regiones.php" method="post">

    <input type="submit" value="Mostrar">
  </form>
  <br>
  <br>
  <br>

  <h3 align="center"> 5: Movilizaciones por ONG, ordenadas por presupuesto anual </h3>

  <form align="center" action="consultas/5_mov_por_ong.php" method="post">
    <br/><br/>
    <input type="submit" value="Buscar">
  </form>
  <br>
  <br>
  <br>


  <h3 align="center"> 6: Proyectos con recurso en trámite y todas las movilizaciones vigentes asociadas </h3>

  <form align="center" action="consultas/6_muchas_cosas.php" method="post">
    <br/><br/>
    <input type="submit" value="Buscar">
  </form>
  <br>
  <br>
  <img class="imagen" border="0" src="https://k38.kn3.net/taringa/2/5/2/5/6/1/08/vacumilka/8FA.gif">
  <marquee scrollamount="9" style="font-family: Arial; font-size: 10pt; color: #FF0000; font-weight: bold">BREAKING NEWS:&nbsp; 3 out of 4 people say this is a beautifull website!</marquee>
  <br>


