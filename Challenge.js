const first = document.getElementById('first');
const iframe = document.getElementById('second');
const checker = document.getElementById('checker');
const returner = document.getElementById('returner');

first.addEventListener('keyup', function(){
    var html = first.textContent
    iframe.src = "data:text/html;charset=utf-8," + encodeURI(html);
})

//first.addEventListener('paste', function(e){
//    e.preventDefault()
//
//    var text = e.clipboardData.getData("text/plain")
//    document.execCommand("insertText", false, text)
//})

checker.addEventListener('click', function(){
    // some code for cheking answers
    alert(first.textContent);
    // just a test for now
})

returner.addEventListener('click', function(){
    // some code to save progress
    window.location.replace("./WelcomingPage.php");
    // just a test for now
})
