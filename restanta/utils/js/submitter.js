let username = document.getElementById("username");
let password = document.getElementById("password");

async function submitData(){
    console.log("Preparing statements...");
    //console.log("Username: " + username.innerText);
    //console.log("Password: " + password.innerText);

    var person = {
        name : username.innerText,
        password : password.innerText
    }

    var stringifiedPeer = JSON.stringify(person);

    console.log(stringifiedPeer);

    const xhr = new XMLHttpRequest();

    xhr.open('POST', '../api/users/createuser');
    xhr.setRequestHeader("Content-type", "application/json");
    xhr.send(stringifiedPeer);

    console.log(xhr.response);

    window.location.replace("../auth/Login.php");
}