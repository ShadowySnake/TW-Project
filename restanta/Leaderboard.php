<?php
include './languages/lang_cfg.php';
include 'lbConfig.php';
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
    <div id="chosenLevel">
        <?php echo $_SESSION['level'] ?>
    </div>
    <div id="difficulty">
        <?php echo $_SESSION['difficulty'] ?>
    </div>
    <div id="language">
        <?php echo $_SESSION['lang'] ?> </div>
    <div class="container">
        <div class="header">
            <a href="./WelcomingPage.php">&#127968;
            </a>
            <div class="dropdown">
                <button class="dropbtn"> <?php echo $lang['leaderboard'] ?>
                    <div class="drowopt">
                        <a href="Leaderboard.php?level=1">Level 1</a>
                        <a href="Leaderboard.php?level=2">Level 2</a>
                        <a href="Leaderboard.php?level=3">Level 3</a>
                        <a href="Leaderboard.php?level=4">Level 4</a>
                        <a href="Leaderboard.php?level=5">Level 5</a>
                        <a href="Leaderboard.php?level=6">Level 6</a>
                        <a href="Leaderboard.php?level=7">Level 7</a>
                        <a href="Leaderboard.php?level=8">Level 8</a>
                    </div>
                </button>
            </div>
            <div class="dropdown">
                <button class="dropbtn"> <?php echo $lang['difficulty'] ?>
                    <div class="drowopt">
                        <a href="Leaderboard.php?difficulty=easy"><?php echo $lang['easy'] ?></a>
                        <a href="Leaderboard.php?difficulty=hard"><?php echo $lang['hard'] ?></a>
                    </div>
                </button>
            </div>
        </div>
        <div class="tablecontainer">
            <table class="tbl" id="table">
                <thead>
                    <tr>
                        <td><?php echo $lang['name'] ?></td>
                        <td><?php echo $lang['time'] ?></td>
                        <td><?php echo $lang['level'] ?></td>
                        <td><?php echo $lang['difficulty'] ?></td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    echo '<script src="./utils/js/boardGet.js"></script>'
                    ?>
                </tbody>
            </table>
        </div>
        <div class="fttr">
            <a href="Leaderboard.php?lang=en"> <?php echo $lang['langen'] ?> </a>|
            <a href="Leaderboard.php?lang=ru"> <?php echo $lang['langru'] ?> </a>|
            <a href="Leaderboard.php?lang=ro"> <?php echo $lang['langro'] ?> </a>
        </div>
    </div>
</body>

</html>