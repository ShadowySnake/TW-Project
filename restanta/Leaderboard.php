<?php
    include './languages/lang_cfg.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $lang['leaderboard'] ?></title>
    <link rel="stylesheet" href="./css/Leaderboard.css">
</head>
<body>
    <div id="language">
        <?php echo $_SESSION['lang'] ?> </div>
    <table class="tbl" id="table">
        <thead>
    <tr>
        <td><?php echo $lang['name'] ?></td>
        <td><?php echo $lang['time'] ?></td>
        <td><?php echo $lang['level'] ?></td>
        <td><?php echo $lang['difficulty'] ?></td>
    </tr>
        </thead>
    <?php
      echo '<script src="./utils/js/boardGet.js"></script>'
    ?>
    </table>
    <a href="./WelcomingPage.php">
                <button type="button" class="homeButton">&#127968;</button>
    </a>
    <footer>
  <div class="fttr">
    <a href="Leaderboard.php?lang=en"> <?php echo $lang['langen'] ?> </a>| 
    <a href="Leaderboard.php?lang=ru"> <?php echo $lang['langru'] ?> </a>| 
    <a href="Leaderboard.php?lang=ro"> <?php echo $lang['langro'] ?> </a>
    </div>
  </footer>
</body>

</html>