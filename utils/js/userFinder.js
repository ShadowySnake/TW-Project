let uname = document.getElementById("username");
let password = document.getElementById("password");

apiCaller();

async function apiCaller(){
    console.log("Starting to fetch data from API...")
    fetch("http://localhost/TW-Project/api/users/read.php", {
        method : 'GET',
        headers : new Headers({
            "Accept": "application/json"
        }),
    }).then(resp => {
        console.log("The response has arrived!")
        return resp.json();
    }).then(jsonResp => {
        let id = findUser(jsonResp);
        const xhr = new XMLHttpRequest();

        xhr.open('POST', '../api/sessionStore.php');
        xhr.setRequestHeader("Content-type", "application/json");
        xhr.send(JSON.stringify(id));

        console.log(xhr.response);

        window.location.replace("../WelcomingPage.php");
    })
}

function findUser(usersArray){
    let found = false;
    let id;
        for (let i = 0; i < usersArray.length; i++) {
            if(usersArray[i].name == uname.innerText && usersArray[i].password == password.innerText) {
                found = true;
                id = usersArray[i].id;
                break;
            }
        }
    if(found == true) {
        console.log("The user has the id: " + id);
    }
    else {
        console.log("Could not find user");
    }

    return id;
}