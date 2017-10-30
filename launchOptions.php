<?php  ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Options</title>
  </head>
  <body>
    <form action="./src/saveOptions.php" method="get">
      <label>Nom de la partie:</label>
      <input required type="text" name="gameName">
      <label>Axe X:</label>
      <input required type="number" name="x" min="10" max="30">
      <label>Axe Y:</label>
      <input required type="number" name="y" min="10" max="30">
      <input type="submit" value="Launch">
    </form>
  </body>
</html>
