//for responsive sandwich menu
function myFunction() {
    var x = document.getElementById("myTopnav");
    if (x.className === "topnav") {
        x.className += " responsive";
    } else {
        x.className = "topnav";
    }
}

function viewFile(){
    var x = document.getElementById("floatFile");
    if(x.style.display === 'none' || x.style.display === ''){
        x.style.display = 'flex';
    }
    else{
        x.style.display = 'none'
    }
}

function addFileDiv(){
    var x = document.getElementById("addFileDiv");
    if(x.style.display === 'none' || x.style.display === ''){
        x.style.display = 'flex';
    }else{
        closeAddFileDiv();
    }
}

function closeAddFileDiv(){
    var x = document.getElementById("addFileDiv");
    x.style.display = 'none';
}