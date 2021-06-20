let getprogressURL = "http://localhost/TW-Project/api/progress/getprogress"
let getuserURL = "http://localhost/TW-Project/api/users/getuser"
let answersURL = "http://localhost/TW-Project/api/answers/getanswers"
let addprogressURL = "http://localhost/TW-Project/api/progress/addprogress"
let updateprogressURL = "http://localhost/TW-Project/api/progress/updateprogress"
let addleaderboardURL = "http://localhost/TW-Project/api/leaderboard/addleaderboard"
langval = 0
const language = document.getElementById('language').innerText.trim()
const first = document.getElementById('first');
var diff = "hard"
langSet();

millisecond = 0;
second = 0;
let cron;

function startTimer() {
    pause();

    cron = setInterval(() => { timer(); }, 10);
}

function pause() {
    clearInterval(cron);
}

function reset() {
    second = 0;
    document.getElementById("timer") = 0;
}

function timer() {
    if ((millisecond += 10) == 1000) {
        millisecond = 0;
        second++;
    }
    
    document.getElementById('timer').innerText = returnData(second);
}

function returnData(input) {
    return input > 10 ? input : `0${input}`
  }

first.addEventListener('paste', function(e){
    e.preventDefault();
    var text = e.clipboardData.getData("text/plain");
    document.execCommand("insertText", false, text);
 })

async function fetchData(){
    let question = await fetch(answersURL);
    questionData = await question.json();
    if(sessionStorage.getItem('id') != 'git'){
        resp = await fetch(getuserURL + "/" + sessionStorage.getItem('id'));
        content = await resp.json();
        prg = await fetch(getprogressURL + "/" + content[0].name);
        sessionStorage.setItem('name', content[0].name);
    } else{
        prg = await fetch(getprogressURL + "/" + sessionStorage.getItem('name'));
    }
    userProgress = await prg.json();
    if(userProgress.errmsg === "Nothing found"){
        send(sessionStorage.getItem('name'));
        sessionStorage.setItem("storedProgress", 0);
        currentProgress = 0;
        
    }
    else{
    currentProgress = userProgress[0].answernumber;
    sessionStorage.setItem("storedProgress", currentProgress);
    }
}

async function getQuestion(){
    var a = new Number(langval)
    pos = new Number(sessionStorage.getItem('storedProgress')) + a
    prgrs = sessionStorage.getItem('storedProgress')
    console.log(pos)
    console.log(questionData.length)
    console.log(sessionStorage.getItem('time'))
    startTimer();
    if (prgrs <= questionData.length/3){
        document.getElementById("q").innerText = questionData[pos].question;
        document.getElementById("h").innerText = questionData[pos].hint;
        clearInterval(timer);
    } else{
        alert('Congrats');
    }
}

async function send(){
    let username = sessionStorage.getItem('name');
    let newprogressJson = {
        "name" : username,
        "answernumber" : 0
    }
    await fetch(addprogressURL, 
        {method : "POST", body: JSON.stringify(newprogressJson)}).then(
            res => {
                console.log(res);
                console.log(newprogressJson);
            }
        )
}

function showHint(){
    if(diff == "hard"){
        var x = document.getElementById("h");
        x.style.visibility = "visible";
        diff = "easy";
    }
}

async function updateProgress(){
    let username = sessionStorage.getItem('name');
    let progr = sessionStorage.getItem('storedProgress');
    let updatedProgressJson = {
        "name" : username,
        "answernumber" : progr
    }
    await fetch(updateprogressURL,
        {method: "PUT", body: JSON.stringify(updatedProgressJson)}).then(
            res => {
                console.log(res);
            }
        )
}

async function game(){
    await fetchData();
    await getQuestion();
}

game();

checker.addEventListener('click', async function(){
    var a = new Number(langval)
    pos = new Number(sessionStorage.getItem('storedProgress')) + a
    if(questionData[pos].answer == first.textContent){
        let progress = sessionStorage.getItem('storedProgress');
        progress++;
        sessionStorage.setItem("storedProgress", progress);
        updateProgress();
        await getQuestion();
        let lbJSON = {
            "name" : sessionStorage.getItem('name'),
            "time" : second,
            "level" : sessionStorage.getItem('storedProgress'),
            "difficulty" : diff
        }
        await fetch(addleaderboardURL,
            {method: "POST", body: JSON.stringify(lbJSON)}).then(
                res => {
                    console.log(res);
                }
            )
        reset();
        
    } else{
        alert('Wrong answer. Try again.');
    }
});

function langSet(){
    switch(language){
        case "en":
            langval = 0;
            break;
        case "ru":
            langval = 8;
            break;
        case "ro":
            langval = 16;
            break;
    }
    console.log(langval);
}
