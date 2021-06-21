<?php
      include '../languages/lang_cfg.php';
      if(isset($_SESSION['message'])) $message = $_SESSION['message'];
      else $message = "";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $lang['signup'] ?></title>
    <link rel="stylesheet" href="../css/Signup.css">
</head>
<body>
    <div class="formular">
      <form class="cont" action="../utils/formGet.php" method="get">
        <div class="container">
          <div class ="text"><?php echo $lang['signup'] ?></div>
          <hr>
          <label for="email"><b><?php echo $lang['username'] ?></b></label>
          <input type="text" placeholder="<?php echo $lang['enterun'] ?>" name="username" required>
    
          <label for="password"><b><?php echo $lang['password'] ?></b></label>
          <input type="password" placeholder="<?php echo $lang['enterpw'] ?>" name="password" required>
    
          <label for="prepeat"><b><?php echo $lang['reppas'] ?></b></label>
          <input type="password" placeholder="<?php echo $lang['reppas'] ?>" name="prepeat" required>
          <?php
              if($message != "") {
                unset($_SESSION['message']);
                echo '<div>' . $message . '</div>';
              } 
          ?>
          <div class="buttons">
              <a href="../WelcomingPage.php">
                <button type="button" class="cancelbuttton"><?php echo $lang['cancel'] ?></button>
            </a>
            <button type="submit" name="submit"><?php echo $lang['signup'] ?></button>
          </div>
        </div>
      </form>
    </div>
</body>
</html>