<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leaderboard</title>
    <link rel="stylesheet" href="./css/Leaderboard.css">
</head>
<body>
    <table class="tbl" id="table">
        <thead>
    <tr>
        <td>Name</td>
        <td>Ellapsed Time</td>
    </tr>
        </thead>
    <?php
      echo '<script src="./utils/js/boardGet.js"></script>'
    ?>
    </table>
    <a href="./WelcomingPage.php">
                <button type="button" class="homeButton">Home</button>
    </a>
</body>
</html>