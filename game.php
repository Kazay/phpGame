<?php
session_start();
function displayCase($x, $y)
{
  return "<div style='border:2px solid black; width:56px; height:56px; background-color: black;'><span style='font-size:6px;'>" . $y . " " . $x . "</span></div>";
}

function displayObject($image)
{
  return "<div style='border:2px solid black; width:56px; height:56px; background-color: black;'><img style='width:100%;' src='" . $image . "'></div>";
}
//var_dump($_SESSION["phpGame"]);die;``
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title><?php echo $_SESSION['phpGame']['gameName'] ?></title>
  </head>

  <!-- Defini la largeur en fonction du nombre de lignes sur l'axe X et de la taille de chaque element (ici, 16px + 4px de border)-->
  <body style="display:flex;width:<?php echo ($_SESSION['phpGame']['axes']['x'] * 60) ?>px;flex-wrap:wrap;">
    <?php
      // For qui itere sur chaque element de l'axe Y
      for ($y=1; $y <= $_SESSION['phpGame']['axes']['y'] ; $y++) {
        // For qui itere sur chaque element de l'axe X
        for ($x=1; $x <= $_SESSION['phpGame']['axes']['x']; $x++) {
          // If qui verifie que que le joueur n'a pas été placé
          if(!isset($_SESSION['posPlayer'])) {
            // If qui verifie que l'on se trouve sur la position par defaut (ici, Y=1 et X=1)
            if($y == 1 && $x == 1) {
              // Defini la position X et Y du joueur par defaut
              $_SESSION['posPlayer'] = array(
                "x" => $x,
                "y" => $y,
              );
              // Cree une case avec le joueur positionne au sein de cette case, correspondant à sa position par defaut
              echo displayObject("./src/corgi.gif");
            }
            // Si l'on ne se trouve pas sur la position du joueur par defaut, cree une case vide
            else {
              echo displayCase($x, $y);
            }
          }
          // Si le joueur est deja en place, verifie s'il se trouve sur la case actuelle
          else if($y == $_SESSION['posPlayer']['y'] && $x == $_SESSION['posPlayer']['x']) {
            // S'il est en place sur la case actuelle, cree une case avec le joueur positionne au sein de cette case
            echo displayObject("./src/corgi.gif");
          } else {
            if(($x == $_SESSION['phpGame']['victory']['x']) && ($y == $_SESSION['phpGame']['victory']['y'])) {
              echo "<div style='border:2px solid black; width:56px; height:56px; background-color: black;'><img style='width:100%;' src='./src/cake.gif'></div>";
            }
          else if(($x == $_SESSION['phpGame']['defeat']['x']) && ($y == $_SESSION['phpGame']['defeat']['y'])) {
            echo "<div style='border:2px solid black; width:56px; height:56px; background-color: black;'><img style='width:100%;' src='./src/bear.gif'></div>";
          }
          // S'il n'est pas en place sur la case actuelle
          else {
            // Cree une case vide
            echo displayCase($x, $y);
          }
        }
      }
    }

    ?>
    <form action="./src/reset.php">
      <input type="hidden" value="on">
      <input type="submit" value="reset">
    </form>
    <form action="./src/move.php" method="POST"><input type="hidden" name="direction" value="UP"><input type="submit" value="&#8593;"></form>
    <form action="./src/move.php" method="POST"><input type="hidden" name="direction" value="DOWN"><input type="submit" value="&#8595;"></form>
    <form action="./src/move.php" method="POST"><input type="hidden" name="direction" value="LEFT"><input type="submit" value="&#8592;"></form>
    <form action="./src/move.php" method="POST"><input type="hidden" name="direction" value="RIGHT"><input type="submit" value="&#8594;"></form>
    <?php
        if(($_SESSION['phpGame']['victory']['x'] == $_SESSION['posPlayer']['x']) && ($_SESSION['phpGame']['victory']['y'] == $_SESSION['posPlayer']['y'])) {
            echo displayObject("./src/victory.gif");

        }
        if(($_SESSION['phpGame']['defeat']['x'] == $_SESSION['posPlayer']['x']) && ($_SESSION['phpGame']['defeat']['y'] == $_SESSION['posPlayer']['y'])) {
            echo displayObject("./src/bear.gif");
        }
     ?>
  </body>
</html>
