async function namer(id) {
    let URL = "http://localhost/TW-Project/api/users/getuser/" + id;
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
        let item = document.getElementById("langQ");
        item.innerText += jsonResp[0].name;
        sessionStorage.setItem('name', jsonResp[0].name);
    })
}