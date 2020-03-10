<?php include('../templates/header.html');   ?>

<body>
  <h1 align="center">Log-In </h1>
  <p style="text-align:center;">Ingresa tu nombre completo y clave: </p>

  <br>
 
  <h2 align="center"> </h2>

  <form align="center" action="check_socio.php" method="post">
    Nombre:
    <input type="text" name="nombre">
    <br/><br/>
    Apellido:
    <input type="text" name="apellido">
    <br/><br/>
    Clave:
    <input type="text" name="clave">
    <br/><br/>
    <input type="submit" value="Ingresar">
  </form>
  <br>
  <br>
 
</body>
</html>
<?php include('../templates/footer.html'); ?> 
