const first = document.querySelector('.first');
const iframe = document.querySelector('iframe');

first.addEventListener('keyup', function(){
    var html = first.textContent
    iframe.src = "data:text/html;charset=utf-8," + encodeURI(html);
})

first.addEventListener('paste', function(e){
    e.preventDefault()

    var text = e.clipboardData.getData("text/plain")
    document.execCommand("insertText", false, text)
})
