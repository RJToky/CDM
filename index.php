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
  <link rel="stylesheet" href="./assets/css/_style_header.css" />
  <link rel="stylesheet" href="./assets/css/_style_index.css" />
  <link rel="shortcut icon" href="./assets/img/qatar-2022-logo.jpg" type="image/x-icon">
  <title>WorldCup</title>
</head>

<body>
  <div class="container">
    <header>
      <div class="logo">WorldCup</div>
      <nav>
        <ul>
          <a href="./index.php" class="active">
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
    <main>
      <?php
      for ($i = 0; $i < count($group); $i++) {
        $pays = selectPays($group[$i], $connex);
      ?>
        <div class="box">
          <h1>Group <?php echo $group[$i]; ?></h1>
          <?php for ($j = 1; $j < count($pays); $j++) { ?>
            <div>
              <div><?php echo $pays[$j][1]; ?></div>
            </div>
          <?php } ?>
        </div>
      <?php } ?>
    </main>
  </div>
  <script src="./assets/js/script.js"></script>
</body>

</html>