let getprogressURL = "http://localhost/TW-Project/api/progress/getprogress"
let getuserURL = "http://localhost/TW-Project/api/users/getuser"

kekw();

async function kekw(){
    if(sessionStorage.getItem('id') != 'git'){
        resp = await fetch(getuserURL + "/" + sessionStorage.getItem('id'));
    }
    let content = await resp.json();
    prg = await fetch(getprogressURL + "/" + content[0].name);
    let userProgress = await prg.json();
    console.log(userProgress[0].answernumber);
}