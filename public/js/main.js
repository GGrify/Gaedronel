'use strict'

let datePickers = document.getElementsByClassName('datePicker');
for(let i = 0; i < datePickers.length; i++) {
    datePickers[i].min =  new Date().toISOString().split("T")[0];
}
function changeMinDate(){
    datePickers[1].min =  datePickers[0].value;
    datePickers[1].value = datePickers[0].value;
}

let miniFotos = document.getElementsByClassName('miniFoto');
for(let i = 0; i < miniFotos.length; i++) {
    miniFotos[i].onclick = function () {
        this.parentElement.parentElement.previousElementSibling.src = this.src;
    }
}
