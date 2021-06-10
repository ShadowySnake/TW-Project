const first = document.getElementById('first');
const iframe = document.getElementById('second');
const checker = document.getElementById('checker');
const returner = document.getElementById('returner');

var timer = setInterval( function(){
    if(sessionStorage.getItem('time') == null) sessionStorage.setItem('time', 0);
        else {
            let time = parseInt(sessionStorage.getItem('time'));
            sessionStorage.setItem('time', time + 1);
            //console.log(sessionStorage.getItem('time'));
        }
}, 1000);

questionGetter();

async function questionGetter(){
    let item = document.createElement("div");
    item.className = "text";
    if(sessionStorage.getItem('questionsAnswered') == null) item.innerText = "Press the 'Done' button!";
    else {
            let URL = "http://localhost/TW-Project/api/answers/read.php";
            let number = parseInt(sessionStorage.getItem('questionsAnswered'));
            console.log(number);
            fetch(URL, {
                method : 'GET',
                headers : new Headers({
                    "Accept": "application/json"
                }),
            }).then(resp => {
                console.log("Answer description arrived!")
                return resp.json();
            }).then(jsonResp => {
                console.log(jsonResp);
                if(number >= jsonResp.length) {
                    item.innerText = "Finished!";
                    clearInterval(timer);
                    sessionStorage.setItem('finished', true);
                }
                else item.innerText = jsonResp[number].description;
            })
    }

    document.getElementById("editor").appendChild(item);
}

first.addEventListener('keyup', function(){
    var html = first.textContent
    iframe.src = "data:text/html;charset=utf-8," + encodeURI(html);
})

first.addEventListener('paste', function(e){
   e.preventDefault();
   var text = e.clipboardData.getData("text/plain");
   document.execCommand("insertText", false, text);
})


checker.addEventListener('click', function(){
    // some code for cheking answers
    //alert(first.textContent);
    if(sessionStorage.getItem('id') != 'git') { 
    let URL = "http://localhost/TW-Project/api/users/read.php?id=" + sessionStorage.getItem('id');
    let URL2 = "http://localhost/TW-Project/api/progress/read.php?name=";
    fetch(URL, {
        method : 'GET',
        headers : new Headers({
            "Accept": "application/json"
        }),
    }).then(resp => {
        console.log("The response has arrived!")
        return resp.json();
    }).then(jsonResp => {
        let name = jsonResp[0].name;
        fetch(URL2 + name, {
            method : 'GET',
            headers : new Headers({
                "Accept": "application/json"
            }),
        }).then(resp2 => {
            return resp2.json();
        }).then(jsonResp2 => {
            if(jsonResp2.length == 0){
                let normalJson = {
                    "name" : name
                }
            const xhr = new XMLHttpRequest();

            xhr.open('POST', './api/progress/create.php');
            xhr.setRequestHeader("Content-type", "application/json");
            xhr.send(JSON.stringify(normalJson));

            sessionStorage.setItem('questionsAnswered', 0);

            } else {
                let number = parseInt(jsonResp2[0].answernumber);
                let URL3 = "http://localhost/TW-Project/api/answers/read.php";
                fetch(URL3, {
                    method : 'GET',
                    headers : new Headers({
                        "Accept": "application/json"
                    }),
                }).then(resp3 => {
                    //console.log("Resp3 normal usr");
                    return resp3.json();
                }).then(jsonResp3 => {
                    if(number >= jsonResp3.length) {
                        alert("You have finished, congratz");
                        clearInterval(timer);
                        sessionStorage.setItem('finished', true);
                    }
                    else if(jsonResp3[number].answer == first.textContent) {
                        sessionStorage.setItem('questionsAnswered', number + 1);
                        window.location.reload();
                    } else {
                        
                        alert("Try again");
                        window.location.reload();
                    }
                })
            }
        })
    })} 
    else {
         let anotherURL = "http://localhost/TW-Project/api/progress/read.php?name=" + sessionStorage.getItem('name');
         fetch(anotherURL, {
            method : 'GET',
            headers : new Headers({
                "Accept": "application/json"
            }),
        }).then(gitResp => {
            console.log("Git response");
            return gitResp.json();
        }).then(gitJsonResp => {
            if(gitJsonResp.length == 0){
                let gitJson = {
                    "name" : sessionStorage.getItem('name')
                }
                const xhr = new XMLHttpRequest();
                xhr.open('POST', './api/progress/create.php');
                xhr.setRequestHeader("Content-type", "application/json");
                xhr.send(JSON.stringify(gitJson));

                sessionStorage.setItem('questionsAnswered', 0);
            } else {
                let number = parseInt(gitJsonResp[0].answernumber)
                let URL3 = "http://localhost/TW-Project/api/answers/read.php";
                fetch(URL3, {
                    method : 'GET',
                    headers : new Headers({
                        "Accept": "application/json"
                    }),
                }).then(resp3 => {
                    return resp3.json();
                }).then(jsonResp3 => {
                    if(number >= jsonResp3.length) {
                        alert("You have finished, congratz");
                        clearInterval(timer);
                        sessionStorage.setItem('finished', true);
                    }
                    else if(jsonResp3[number].answer == first.textContent) {
                        sessionStorage.setItem('questionsAnswered', number + 1);
                        window.location.reload();
                    } else {
                        alert("Try again");
                        window.location.reload();
                    }
                })
            }
        })
    }
})

returner.addEventListener('click', function(){
    // some code to save progress
    if(sessionStorage.getItem('questionsAnswered') != 0 && sessionStorage.getItem('questionsAnswered') != null){
    let array = {
        'name' : sessionStorage.getItem('name'),
        'answernumber' : sessionStorage.getItem('questionsAnswered'),
        'time' : sessionStorage.getItem('time')
    };
    const xhr = new XMLHttpRequest();

    xhr.open('PUT', './api/progress/update.php');
    xhr.setRequestHeader("Content-type", "application/json");
    console.log(array);
    xhr.send(JSON.stringify(array));

    
    }

    if(sessionStorage.getItem('finished') != null){
        fetch("http://localhost/TW-Project/api/leaderboard/read.php", {
            method : 'GET',
            headers : new Headers({
                "Accept": "application/json"
            }),
        }).then(resp => {
            return resp.json();
        }).then(jsonResp =>{
            let found = "no";
            for(let i=0; i<jsonResp.length; i++){
                if(jsonResp[i].name == sessionStorage.getItem('name')){
                    found = "yes";
                    break;
                }
            }

            if(found == "no"){
                fetch("http://localhost/TW-Project/api/progress/read.php?name=" + sessionStorage.getItem('name'), {
                     method : 'GET',
                     headers : new Headers({
                    "Accept": "application/json"
                     }),
                }).then(resp2 => {
                     return resp2.json();
                }).then(jsonResp2 => {
                    let array = {
                        'name' : sessionStorage.getItem('name'),
                        'time' : jsonResp2[0].time
                    }
                    const xhr = new XMLHttpRequest();
                    xhr.open('POST', './api/leaderboard/create.php');
                    xhr.setRequestHeader("Content-type", "application/json");
                    console.log(array);
                    xhr.send(JSON.stringify(array));
                })
            }
        })
    }

    sessionStorage.clear();
    
    window.location.replace("./WelcomingPage.php");
})
