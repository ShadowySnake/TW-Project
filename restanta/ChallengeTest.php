<?php
    include './languages/lang_cfg.php';
?>

<html>

<head>
    <meta charset="UTF-8">
    <title>Challenge</title>
    <link rel="stylesheet" href="./css/Challenge.css">
    <link rel="stylesheet" href="./css/mainStyle.css">

</head>
<body>
    <div class="container">
        <div id="quiz" class="justify-center flex-column">
            <div id="hud">
                <div class="hud-item">
                    <p id="question" class="hud-prefix">
                    </p>
                </div>
                <div class="hud-item">
                    <p class = "hud-prefix">
                        <?php echo $lang['score'] ?>
                    </p>
                    <h1 class="hud-text" id="score">
                         0
                    </h1>
                </div>
            </div>
            <h1 id="question">Was is das</h1>
            <div class="choice-container">
                <p class="choice-prefix">A.</p>
                <p class="choice-text" data-number=1>Choice</p>
            </div>
            <div class="choice-container">
                <p class="choice-prefix">B.</p>
                <p class="choice-text" data-number=2>Choice</p>
            </div>
            <div class="choice-container">
                <p class="choice-prefix">C.</p>
                <p class="choice-text" data-number=3>Choice</p>
            </div>
            <div class="choice-container">
                <p class="choice-prefix">D.</p>
                <p class="choice-text" data-number=4>Choice</p>
            </div>  
        </div>
    </div>
</body>
<script src="Challenge.js"></script>
</html>