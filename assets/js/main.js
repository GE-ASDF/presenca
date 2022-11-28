const $ = (selector)=>document.querySelector(selector);
const diasSemana = ["Domingo", "Segunda-feira", "Terça-feira", "Quarta-feira", "Quinta-feira", "Sexta-feira", "Sábado"];
const button = $("button");
const allowedKeys = ['0',"1", "2","3","4","5","6","7","8","9", "a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","u","v","w","y","z","@","!",".","-","_","(",")","^","`","é","á","ú","í","ó","´","~","â","ê","ô", "à", "ã", "õ"];
const DataPresenca = $("[name='DataPresenca']")
const CodigoContrato = $("[name='CodigoContrato']")
const DiaSemana = $("[name='DiaSemana']")

let objectDate = new Date();

CodigoContrato.addEventListener("keydown", (ev)=>{
    ev.preventDefault();
    let keyDown = ev.key.toLowerCase();
    if(allowedKeys.includes(keyDown)){
        CodigoContrato.value += keyDown;
    }
    if(keyDown ==='f5'){
        window.location.href = "/presenca";
    }
    if(keyDown === 'backspace'){
        CodigoContrato.value = CodigoContrato.value.slice(0,-1);
    }
    if(keyDown === 'enter'){
        button.click();
    }
   
})
function createDate(){
    let day = objectDate.getDate();
    let month = objectDate.getMonth() + 1;
    let fullYear = objectDate.getFullYear();
    return `${day}/${month}/${fullYear}`;
}


function getWeekDayName(){
    let dayWeekNumber = objectDate.getDay();
    return diasSemana[dayWeekNumber];
}

function toString(){
    DataPresenca.value = createDate();
    DiaSemana.value = getWeekDayName();
}

toString();