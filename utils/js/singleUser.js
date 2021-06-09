async function namer(id) {
    let URL = "http://localhost/TW-Project/api/users/read.php?id=" + id;
    sessionStorage.setItem('id', id);

    fetch(URL, {
        method : 'GET',
        headers : new Headers({
            "Accept": "application/json"
        }),
    }).then(resp => {
        console.log("The response has arrived!")
        return resp.json();
    }).then(jsonResp => {
        let item = document.createElement("div");
        item.className = "header--question";
        item.innerText = "Welcome, " + jsonResp[0].name;
        sessionStorage.setItem('name', jsonResp[0].name);
        document.getElementById("header").appendChild(item);
    })
}