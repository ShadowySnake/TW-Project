const language = document.getElementById('language').innerText.trim();

createTable();

function createTable(){
    console.log("Starting to fetch data from API...")
    fetch("http://localhost/TW-Project/api/getleaderboard", {
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
           switch(language){
            case "en":
                if(jsonResp[i].difficulty == "easy"){
                    diff = "Easy"
                } else{
                    diff = "Hard"
                }
                break;
               case "ru":
                   if(jsonResp[i].difficulty == "easy"){
                       diff = "Легко"
                   } else{
                       diff = "Сложно"
                   }
                   break;
               case "ro":
                if(jsonResp[i].difficulty == "easy"){
                    diff = "Incepator"
                } else{
                    diff = "Avansat"
                }
                   break;
           }
           let row = document.createElement("tr");
           let col1 = document.createElement("td");
           col1.innerText = jsonResp[i].name;
           row.appendChild(col1);

           let col2 = document.createElement("td");
           col2.innerText = jsonResp[i].time
           row.appendChild(col2);

           let col3 = document.createElement("td");
           col3.innerText = jsonResp[i].level
           row.appendChild(col3);

           let col4 = document.createElement("td");
           col4.innerText = diff
           row.appendChild(col4)

           document.getElementById("table").appendChild(row);
        }
    })
}