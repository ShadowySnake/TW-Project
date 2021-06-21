<?php 
    include './languages/lang_cfg.php';
?>
<html>
<head>
    <title><?php echo $lang['main-title-challenge'] ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/Challenget.css">

</head>

<body>
    <div id = "language">
        <?php echo $_SESSION['lang'] ?>
    </div>
    <div class="container">
        <div class = "header">
        <a href="./WelcomingPage.php">
        &#127968; 
        </a>
        </div>  
        <div class = "question" class = "justify-center flex-column">
                <?php echo $lang['question'] ?>
                <div class = "question" id ="q">
                </div>
            <div>
                <?php echo $lang['time'] ?>
                <div id="timer">
                </div>
            </div>
            <div class = "hint">
            <button class="buttons" onclick="showHint()"> <?php echo $lang['hint']?> </button>
                <div id="h">
                </div>
            </div>
        </div>
       
        <div class="first" id="first" contenteditable>
        </div>
        
        <div>
        <button class="buttons" id="checker"> <?php echo $lang['done'] ?> </button>
        
        </div>
        <!-- <div class="text" id="hint">
            Hint: Try creating a div with border.
        </div> -->
    </div>
</body>

<script src="test.js"></script>
</html>