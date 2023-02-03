<?php
include("./inc/function.php");
include("./inc/connection.php");
$connex = connect();
$group = selectGroup($connex);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Tournoi</title>
    <link rel="stylesheet" href="./assets/css/_style_tournoi.css" />

    <link rel="stylesheet" href="./assets/css/_style_header.css" />
    <link rel="stylesheet" href="./assets/css/_style_index.css" />
    <link
      rel="shortcut icon"
      href="./assets/img/qatar-2022-logo.jpg"
      type="image/x-icon"
    />
    <title>WorldCup</title>
  </head>
  <body>
    <div class="container">
      <header>
        <div class="logo">WorldCup</div>
        <nav>
          <ul>
            <a href="./index.php">
              <li>Equipes</li>
              <span></span>
            </a>
            <a href="./match.php">
              <li>Match</li>
              <span></span>
            </a>
            <a href="./classement.php">
              <li>Classement</li>
              <span></span>
            </a>
          </ul>
          <div class="icon-bars">
            <span></span>
          </div>
          <div class="background"></div>
        </nav>
      </header>

      <a href="./traitement/traitement_final.php?a=0">Reset winner</a>
      <main>
        <?php
          $finaliste = selectNFinal(8, $connex);
        ?>
        <div class="sisiny">
          <div class="huit">
            <?php for($i = 1; $i < count($finaliste)/2; $i++) {
              ?>
              <div class="groupe"><?php echo getNomPays($finaliste[$i][3], $connex)." - ".$finaliste[$i][5]; ?></div>
              <div class="groupe"><?php echo getNomPays($finaliste[$i][4], $connex)." - ".$finaliste[$i][6]; ?></div>
            <?php } ?>
          </div>
          <div class="quart">
            <div class="groupe">.</div>
            <div class="groupe">.</div>
            <div class="groupe">.</div>
            <div class="groupe">.</div>
          </div>
          <div class="demi">
            <div class="groupe">.</div>
            <div class="groupe">.</div>
          </div>
        </div>

        <div class="apvony">
          <div class="final">
            <div class="groupe">.</div>
            <div class="groupe">.</div>
          </div>
        </div>

        <div class="sisiny">
          <div class="demi">
            <div class="groupe">.</div>
            <div class="groupe">.</div>
          </div>
          <div class="quart">
            <div class="groupe">.</div>
            <div class="groupe">.</div>
            <div class="groupe">.</div>
            <div class="groupe">.</div>
          </div>
          <div class="huit">
            <?php for($i = (int) (count($finaliste)/2)+1; $i < count($finaliste); $i++) {
              ?>
              <div class="groupe"><?php echo getNomPays($finaliste[$i][3], $connex)." - ".$finaliste[$i][5]; ?></div>
              <div class="groupe"><?php echo getNomPays($finaliste[$i][4], $connex)." - ".$finaliste[$i][6]; ?></div>
            <?php } ?>
          </div>
        </div>
      </main>
    </div>
  </body>
</html>
