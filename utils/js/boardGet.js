createTable();

function createTable(){
    console.log("Starting to fetch data from API...")
    fetch("http://localhost/TW-Project/api/leaderboard/read.php", {
        method : 'GET',
        headers : new Headers({
            "Accept": "application/json"
        }),
    }).then(resp => {
        console.log("The response has arrived!")
        return resp.json();
    }).then(jsonResp => {
        console.log("Starting to put elements in table...");
        for (let i = 0; i < jsonResp.length; i++) {
           let row = document.createElement("tr");
           let col1 = document.createElement("td");
           col1.innerText = jsonResp[i].name;
           row.appendChild(col1);

           let col2 = document.createElement("td");
           col2.innerText = jsonResp[i].time
           row.appendChild(col2);

           document.getElementById("table").appendChild(row);
        }
    })
}