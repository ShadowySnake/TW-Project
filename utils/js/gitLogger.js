

async function setGit(receivedName){
    sessionStorage.setItem('id', 'git');
    sessionStorage.setItem('name', receivedName);
    console.log(receivedName);
}