<?php 
    include './languages/lang_cfg.php';
?>
<html>
<head>
    <title>Challenge</title>
    <link rel="stylesheet" href="./css/Challenget.css">
    <link rel="stylesheet" href="./css/mainStyle.css">

</head>

<body>
    <div id = "language">
        <?php echo $_SESSION['lang'] ?>
    </div>
    <div class="container" id="editor">
        <div id="timer">
        </div>
        <div class="first" id="first" contenteditable>
        </div>
        <div class = "question">
            <?php echo $lang['question'] ?>
        </div>
        <div class = "question" id ="q">
        </div>
        <div class = "hint" id="h">
        </div>
        <div class = "but">
        <button class="buttons" id="checker"> <?php echo $lang['done'] ?> </button>
        <a href="./WelcomingPage.php">
        <button class="buttons" id="returner"> <?php echo $lang['home'] ?> </button>
        </a>
            <button class="buttons" onclick="showHint()"> <?php echo $lang['hint']?> </button>
        </div>
        <!-- <div class="text" id="hint">
            Hint: Try creating a div with border.
        </div> -->
    </div>
</body>

<script src="test.js"></script>
</html>