
function affecterOrdre(ligne) {
  let i = 0
    while (i<3){
      let affecter = false;
      while (affecter == false){
        let ran = Math.random();

        if (ran>0.66 && (ligne[0].style.order != 1 && ligne[1].style.order != 1 && ligne[2].style.order != 1)){

            ligne[i].style.order= 1;
            affecter = true;
        }
        else if (ran>0.33 && ran<0.66 && (ligne[0].style.order != 2 && ligne[1].style.order != 2 && ligne[2].style.order != 2)){

            ligne[i].style.order= 2;
            affecter = true;
        }
        else if (ran<0.33 && (ligne[0].style.order != 3 && ligne[1].style.order != 3 && ligne[2].style.order != 3)){

            ligne[i].style.order= 3;
            affecter = true;
        }
        }
      i++

    }
}

const troisimeLigne = document.getElementsByClassName('Third')[0].getElementsByTagName('div');
const deuxiemeLigne = document.getElementsByClassName('Seconds')[0].getElementsByTagName('div');
const premiereLigne = document.getElementsByClassName('Firsts')[0].getElementsByTagName('div');

const allDiv = [premiereLigne,deuxiemeLigne,troisimeLigne];

affecterOrdre(premiereLigne);
affecterOrdre(deuxiemeLigne);
affecterOrdre(troisimeLigne);


let selected = document.getElementById('firstImg');
let divSelected = premiereLigne;

function divSelect(classe){

  divSelected = document.getElementsByClassName(classe)[0].getElementsByTagName('div');

}
function select(id){
  selected.style.border = 'none';
  const obj = document.getElementById(id)
  selected = obj;
  obj.style.border = '1px solid black';


}




function right(){
  let position = parseInt(selected.style.order);
  if (position<=2){
    for (var i = 0; i < 3; i++) {
      if (divSelected[i].style.order == position +1){
        divSelected[i].style.order = position;

      }
    }
  position +=1;
  }
  selected.style.order = position;

}

function left(){
  let position = parseInt(selected.style.order);
  if (position>1){
    for (var i = 0; i < 3; i++) {
      if (divSelected[i].style.order == position -1){
        divSelected[i].style.order = position;

      }
    }
  position -=1;
  }
  selected.style.order = position;

}

function validationCaptcha(){
  for (var i = 0; i < 3; i++) {
    for (var j = 0; j < 3; j++) {

      if(allDiv[i][j].style.order != j+1){
        return false;
        alert("Veuillez Terminer le captcha");
      }
    }
  }
  return true;

}
