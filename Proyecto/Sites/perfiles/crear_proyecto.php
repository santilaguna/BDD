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

<h3 align="center"> Rellena la información del proyecto que estás por crear </h3>

  <body>

  <form action="backend_crear_proyecto.php"  method="post">
    Nombre del proyecto:
    <input type="text" name="nombre_proyecto" />
    <br/><br/>
    tipo de proyecto:
    <select name = "tipo_proyecto">
    <option value=1>Mina</option>
    <option value=2>Central</option>
    <option value=3>Vertedero</option>
  </select>
    <br/><br/>
    Mineral o Tipo de Generación (vacío para vertederos):
    <input type="text" name = "especificacion"/>
    <br/><br/>
    latitud:
    <input type="text" name="latitud" />
    <br/><br/>
    longitud:
    <input type="text" name="longitud" />
    <br/><br/>
    región:
    <select name = "region">
    <option value="I de Tarapacá">I de Tarapacá</option>
    <option value="II de Antofafasta">II de Antofafasta</option>
    <option value="III de Atacama">III de Atacama</option>
    <option value="IV de Coquimbo">IV de Coquimbo</option>
    <option value="V de Valparaíso">V de Valparaíso</option>
    <option value="VI del Libertador Bernardo O'higgins">VI de O'higgins</option>
    <option value="VII del Maule">VII del Maule</option>
    <option value="VIII del Bío-Bío">VIII del Bío-Bío</option>
    <option value="IX de la Araucanía">IX de la Araucanía</option>
    <option value="X de Los Lagos">X de Los Lagos</option>
    <option value="XI de Aysén del General Carlos Ibañez del Campo">XI de Aysén</option>
    <option value="XII de Magallanes y de la Antártica Chilena">XII de Magallanes</option>
    <option value="Metropolitana de Santiago">RM</option>
    <option value="XIV de Los Ríos">XIV de Los Ríos</option>
    <option value="XV de Arica y Parinacota">XV de Arica y Parinacota</option>
    </select> 
    <br/><br/>
    comuna:
    <input type="text" name="comuna" />
    <br/><br/>
    fecha de apertura:
    <input type="date" name="fecha_apertura" />
    <br/><br/>
    operativo: 
    <select name = "operativo">
    <option value="True">sí</option>
    <option value="False">No</option>
    </select> 
    <br/><br/>
    <input type="submit" value="Crear" />
</form>

    <br><br>
<form action="perfil_socio.php" method="get">
    <input type="submit" value="Volver">
</form>
</body>

</html>