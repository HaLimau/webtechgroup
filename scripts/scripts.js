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

function showSection(sectionId) {
    var sec1 = document.getElementById("borrowedhistorysection");
    var sec2 = document.getElementById("reviewsSection");
    var sec3 = document.getElementById("printOrderSection");

    if(sectionId == "borrowedhistorysection"){
        sec1.style.display = 'block';
        sec2.style.display = 'none';
        sec3.style.display = 'none';
    }else if(sectionId == "reviewsSection"){
        sec1.style.display = 'none';
        sec2.style.display = 'block';
        sec3.style.display = 'none';
    }else if(sectionId == "printordersection"){
        sec1.style.display = 'none'
        sec2.style.display = 'none';
        sec3.style.display = 'block';
    } 
}
   
function toggleDiv(id){
    var div = document.getElementById("borrowDiv");
    if (id.style.display == 'none'){
        id.style.display = 'block';
    }else{
        id.style.display = 'none';
    }
   
}
