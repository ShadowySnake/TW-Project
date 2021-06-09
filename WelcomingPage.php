<?php
    session_start();
    if(isset($_SESSION['my-access-token'])) $access_token = $_SESSION['my-access-token'];
    else $access_token = "";
    if(isset($_SESSION['id'])) $id = $_SESSION['id'];
    else $id = "";
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Learn HTML & CSS
  </title>
  <link rel="stylesheet" href="./css/WelcomePageStyle.css">
</head>

<body>
  <div class="div--header" id="header">
    <a href="#" class="header--logo"><img src ="./css/logo.jpg">
    </a>
    <div>
        <a href="https://developer.mozilla.org/ru/?" class ="button">Documentation
        </a>
    </div>
    <div>
      <a href="Leaderboard.php" class ="button"> Leaderboard </a>
    </div>

    <?php
      if($access_token == "" && $id=="") echo '<div class="header--question">What would you like to do ?</div>
                                          <a href = "auth/Login.php">
                                            <button class="login">Login</button>
                                          </a>
                                        <a href = "auth/Signup.php">
                                        <button class="login">Signup</button>
                                        </a>';
      else if($access_token !="") {
        include_once './utils/gitNameGetter.php';
        $namer = new GitName();
        echo '<a href = "utils/logout.php"> <button class="login"> Logout </button></a>';
        echo '<div class="header--question">' . $namer->getName($access_token) . '</div>';
      } else {
        $function_used = 'namer(' . $id . ')';
        echo '<script src="utils/js/singleUser.js" onload=' . $function_used . '></script>';
        echo '<a href = "utils/logout.php"> <button class="login"> Logout </button></a>';
      }
    ?>
  </div>
  <main>
    <div id="main--to--HTML">
      <button class="HTML--buttons"> Beginner Levels </button> 
      <button class="HTML--buttons"> Amateur Levels </button>
      <button class="HTML--buttons"> Experienced Levels </button>
    </div>
    <div id="main--to--CSS">
      <button class="CSS--buttons"> Beginner Levels </button> 
      <button class="CSS--buttons"> Amateur Levels </button>
      <button class="CSS--buttons"> Experienced Levels </button>
    </div>

    </main>
</body>

</html>