<?php 
    session_start();
?>
<html>
<head>
    <title>Challenge</title>
    <link rel="stylesheet" href="./css/Challenget.css">

</head>

<body>
    <div class="main-editor" id="editor">
        <div class="first" id="first" contenteditable>
        </div>
        <div>
        <button class="buttons" id="checker"> Done! </button>
        <button class="buttons" id="returner"> Home! </button>
        </div>
        <!-- <div class="text">Challenge: Create a red square 
            placed in the middle of the screen.</div> -->
        <div>
            <button class="buttons" onclick="Hint()"> Easy </button>
            <button class="buttons" onclick="ShowHide()"> Hard </button>
        </div>
        <!-- <div class="text" id="hint">
            Hint: Try creating a div with border.
        </div> -->
    </div>
</body>
<script src="test.js"></script>
</html>