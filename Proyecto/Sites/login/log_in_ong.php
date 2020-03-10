<?php include('../templates/header.html');   ?>

<body>
  <h1 align="center">Log-In </h1>
  <p style="text-align:center;">Ingresa el nombre de la ong y clave: </p>

  <br>
 
  <h2 align="center"> </h2>

  <form align="center" action="check_ong.php" method="post">
    ONG:
    <input type="text" name="nombre">
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