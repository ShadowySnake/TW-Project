<?php
      session_start();
      if(isset($_SESSION['message'])) $message = $_SESSION['message'];
      else $message = "";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../css/Signup.css">
</head>
<body>
    <div class="formular">
      <form class="cont" action="../utils/formGet.php" method="get">
        <div class="container">
          <div class ="text">Login</div>
          <hr>
          <label for="email"><b>Username</b></label>
          <input type="text" placeholder="Enter Username" name="username" required>
    
          <label for="password"><b>Password</b></label>
          <input type="password" placeholder="Enter Password" name="password" required>
          <?php
              if($message != "") {
                unset($_SESSION['message']);
                echo '<div>' . $message . '</div>';
              } 
          ?>
          <div class="buttons">
              <a href="../WelcomingPage.php">
                <button type="button" class="cancelbuttton">Cancel</button>
              </a>
            <button type="submit" name="submit">Login</button>
            <a href="https://github.com/login/oauth/authorize?client_id=76145ce672ea3feedf50">
            <button type="button">Log in with github!</button>
            </a>
          </div>
        </div>
      </form>
    </div>
</body>
</html>