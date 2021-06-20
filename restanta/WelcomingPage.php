<?php
    include './languages/lang_cfg.php';
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
    <a href="https://www.youtube.com/watch?v=dQw4w9WgXcQ" class="header--logo"><img src ="./css/logo.jpg">
    </a>
    <div>
        <a href="https://developer.mozilla.org/ru/?" class ="button"> <?php echo $lang['documentation'] ?>
        </a>
    </div>
    <div>
      <a href="Leaderboard.php" class ="button"><?php echo $lang['leaderboard'] ?> </a>
    </div>

    <?php
      if($access_token == "" && $id==""){ echo '<div class="header--question">';  echo $lang['wp-header-q']; echo '</div>
                                          <a href = "auth/Login.php">
                                            <button class="login">'; echo $lang['login']; echo'</button>
                                          </a>
                                        <a href = "auth/Signup.php">
                                        <button class="login">'; echo $lang['signup']; echo'</button>
                                        </a>';
                                        echo '<script src="./utils/js/sessionEmptier.js"></script>';
                                      }
      else if($access_token !="") {
        include_once './utils/gitNameGetter.php';
        $namer = new GitName();
        $accountName = $namer->getName($access_token);
        $function_used = 'setGit("' . strval($accountName) . '")';
        echo '<script src="utils/js/gitLogger.js" onload=' . $function_used . '></script>';
        echo '<a href = "utils/logout.php"> <button class="login">'; echo $lang['logout']; echo'</button></a>';
        echo '<div class="header--question">'; echo $lang['welcMess']; echo ''. $accountName . '</div>';
      } else {
        $function_used = 'namer(' . $id . ')';
        echo'<div class="header--question" id="langQ">'; echo $lang['welcMess']; echo'</div>';
        echo '<script src="utils/js/singleUser.js" onload=' . $function_used . '></script>';
        echo '<a href = "utils/logout.php"> <button class="login">'; echo $lang['logout']; echo '</button></a>';
      }
    ?>
  </div>
  <main>
    <div class="grids">
    <div class="grid--first">
      <p> What HTML is? </p>
     <p>The HyperText Markup Language, or HTML is the 
       standard markup language for documents designed to be displayed 
       in a web browser. It can be assisted by technologies such as
        Cascading Style Sheets (CSS) and scripting languages such as 
        JavaScript.</p>
    </div>
    <?php if($access_token == "" && $id==""){ echo '<div class="grid--second">
      <a href="auth/Login.php" > 
      <button class="goto--challenge">'; echo $lang['start']; echo ' </button>
    </a>
    </div>';
    echo '<script src="./utils/js/sessionEmptier.js"></script>';
    }
    else if($access_token !="" || $id != "") {
      echo '<div class="grid--second">
      <a href="Challenge.php" > 
      <button class="goto--challenge">'; echo $lang['start']; echo'</button>
    </a>
    </div>';
    }
    ?>
    <div class="grid--third">
      <p> What CSS is?</p>
      <p> It is a style sheet language used for describing the presentation of a document 
        written in a markup language such as HTML. CSS is a cornerstone 
        technology of the World Wide Web, alongside HTML and JavaScript.
        </p>
    </div>
    </div>
    
  </main>
  <footer>
  <div class="fttr">
    <a href="WelcomingPage.php?lang=en"> <?php echo $lang['langen'] ?> </a>| 
    <a href="WelcomingPage.php?lang=ru"> <?php echo $lang['langru'] ?> </a>| 
    <a href="WelcomingPage.php?lang=ro"> <?php echo $lang['langro'] ?> </a>
    </div>
  </footer>
</body>

</html>
