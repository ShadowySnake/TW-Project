const first = document.getElementById('first');
//const iframe = document.getElementById('second');
const checker = document.getElementById('checker');
const returner = document.getElementById('returner');

first.addEventListener('keyup', function(){
    var html = first.textContent
    //iframe.src = "data:text/html;charset=utf-8," + encodeURI(html);
})

//first.addEventListener('paste', function(e){
//    e.preventDefault()
//
//    var text = e.clipboardData.getData("text/plain")
//    document.execCommand("insertText", false, text)
//})

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
            const xhr = new XMLHttpRequest();

            xhr.open('POST', './api/progress/create.php');
            xhr.setRequestHeader("Content-type", "application/json");
            xhr.send(JSON.stringify(name));

            sessionStorage.setItem('questionsAnswered', 0);

            } else {
                let number = parseInt(jsonResp2[0].answernumber) + 1;
                if(number >= 2) alert("You have finished, congratz");
                else{
                let URL3 = "http://localhost/TW-Project/api/answers/read.php?id=" + number;
                fetch(URL3, {
                    method : 'GET',
                    headers : new Headers({
                        "Accept": "application/json"
                    }),
                }).then(resp3 => {
                    return resp3.json();
                }).then(jsonResp3 => {
                    if(jsonResp3[0].answer == first.textContent) {
                        sessionStorage.setItem('questionsAnswered', number);
                        location.reload();
                    } else alert("Try again");
                })}
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
                let number = parseInt(gitJsonResp[0].answernumber) + 1;
                if(number >= 2) alert("You have finished, congratz");
                else{
                let URL3 = "http://localhost/TW-Project/api/answers/read.php?id=" + number;
                fetch(URL3, {
                    method : 'GET',
                    headers : new Headers({
                        "Accept": "application/json"
                    }),
                }).then(resp3 => {
                    return resp3.json();
                }).then(jsonResp3 => {
                    if(jsonResp3[0].answer == first.textContent) {
                        sessionStorage.setItem('questionsAnswered', number);
                        location.reload();
                    } else alert("Try again");
                })}
            }
        })
    }
    // just a test for now
})

returner.addEventListener('click', function(){
    // some code to save progress
    let array = {
        'name' : sessionStorage.getItem('name'),
        'answernumber' : sessionStorage.getItem('questionsAnswered')
    };
    const xhr = new XMLHttpRequest();

    xhr.open('PUT', './api/progress/update.php');
    xhr.setRequestHeader("Content-type", "application/json");
    xhr.send(JSON.stringify(array));

    sessionStorage.clear();
    
    window.location.replace("./WelcomingPage.php");
    // just a test for now
})
