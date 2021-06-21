<?php
include './languages/lang_cfg.php';
if (isset($_SESSION['my-access-token'])) $access_token = $_SESSION['my-access-token'];
else $access_token = "";
if (isset($_SESSION['id'])) $id = $_SESSION['id'];
else $id = "";
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>LeHS
  </title>
  <link rel="stylesheet" href="./css/WelcomePageStyle.css">
</head>

<body>
  <div class="container">
    <div class="div--header" id="header">
      <a href="https://www.youtube.com/watch?v=dQw4w9WgXcQ">
        &#127968;
      </a>
      <?php
      if ($access_token == "" && $id == "") {
        echo '<div class="header--question">';
        echo $lang['wp-header-q'];
        echo '</div>
                                          <a href = "auth/Login.php">
                                            <button class="buttons">';
        echo $lang['login'];
        echo '</button>
                                          </a>
                                        <a href = "auth/Signup.php">
                                        <button class="buttons">';
        echo $lang['signup'];
        echo '</button>
                                        </a>';
        echo '<script src="./utils/js/sessionEmptier.js"></script>';
      } else if ($access_token != "") {
        include_once './utils/gitNameGetter.php';
        $namer = new GitName();
        $accountName = $namer->getName($access_token);
        $function_used = 'setGit("' . strval($accountName) . '")';
        echo '<script src="utils/js/gitLogger.js" onload=' . $function_used . '></script>';
        echo '<a href = "utils/logout.php"> <button class="buttons">';
        echo $lang['logout'];
        echo '</button></a>';
        echo '<div class="header--question">';
        echo $lang['welcMess'];
        echo '' . $accountName . '</div>';
      } else {
        $function_used = 'namer(' . $id . ')';
        echo '<div class="header--question" id="langQ">';
        echo $lang['welcMess'];
        echo '</div>';
        echo '<script src="utils/js/singleUser.js" onload=' . $function_used . '></script>';
        echo '<a href = "utils/logout.php"> <button class="buttons">';
        echo $lang['logout'];
        echo '</button></a>';
      }
      ?>
    </div>
    <div class="first">
      <div class ="infotext">
        <?php echo $lang['lboardmess'] ?>
      </div>
      <a href="Leaderboard.php"><button class="buttons"><?php echo $lang['leaderboard'] ?> </button> </a>
    </div>
    <div class="second">
      <div class ="infotext">
        <?php echo $lang['gsmess'] ?>
      </div>
      <?php if ($access_token == "" && $id == "") {
        echo '<a href="auth/Login.php" > 
      <button class="buttons">';
        echo $lang['start'];
        echo ' </button>
    </a>';
        echo '<script src="./utils/js/sessionEmptier.js"></script>';
      } else if ($access_token != "" || $id != "") {
        echo '<a href="Challenge.php" > 
      <button class="buttons">';
        echo $lang['start'];
        echo '</button>
    </a>';
      }
      ?>
    </div>
    <div class="third">
      <div class ="infotext">
        <?php echo $lang['docmess'] ?>
      </div>
      <a href="http://localhost/TW-Project/api/documentation/index.php"> <button class="buttons"><?php echo $lang['documentation'] ?>
        </button>
      </a>
    </div>
      <div class="fttr">
        <a href="WelcomingPage.php?lang=en"> <?php echo $lang['langen'] ?> </a>|
        <a href="WelcomingPage.php?lang=ru"> <?php echo $lang['langru'] ?> </a>|
        <a href="WelcomingPage.php?lang=ro"> <?php echo $lang['langro'] ?> </a>
      </div>
  </div>
</body>

</html>