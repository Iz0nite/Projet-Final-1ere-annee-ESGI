

function verif(){
  let password_error=false;
  let nickname_error=false;
  let email_error=false;
  let same_password=false;
  let name_error=false;
  let secondname_password=false;
  let country_error=false;
  let captcha=false;
  let birth_error=false;

  let name = document.getElementById("name").value;
  let email = document.getElementById("email").value;
  let password = document.getElementById("password").value;
  let passwordConfirmation = document.getElementById('passwordConfirmation').value;
  let nickname = document.getElementById("pseudo").value;
  let secondName = document.getElementById("secondName").value;
  let birth = document.getElementById("birth").value;
  let country = document.getElementsByTagName('select')[0].value;


  if (country === "Choisir Pays"){
    country_error = false;
  }
  else{
    country_error=true;
  }
  password_error = is_size_ok(password,5,35);
  same_password = passwordCorrect(password,passwordConfirmation) && is_size_ok(passwordConfirmation,5,35);
  email_error = is_size_ok(email,5,100);
  nickname_error=is_size_ok(nickname,5,50);
  secondname_password=is_size_ok(secondName,2,50);
  name_error=is_size_ok(name,2,50);
  birth_error = is_null(birth);



  if (password_error === true && same_password === true && email_error === true && nickname_error === true && secondname_password === true && name_error === true && birth_error === true && country_error === true && validationCaptcha() === true) {
    return true;
  }
  else {

    if (password_error !== true) {

        document.getElementById("password").style.borderColor="red";
    }
    else{
        document.getElementById("password").style.borderColor="black";
    }
    if (same_password !== true) {
        document.getElementById("passwordConfirmation").style.borderColor="red";
    }
    else{
        document.getElementById("passwordConfirmation").style.borderColor="black";
    }
    if (email_error !== true) {
        document.getElementById("email").style.borderColor="red";
    }
    else{
        document.getElementById("email").style.borderColor="black";
    }
    if (secondname_password !== true) {
        document.getElementById("secondName").style.borderColor="red";
    }
    else{
        document.getElementById("secondName").style.borderColor="black";
    }
    if (nickname_error !== true) {
        document.getElementById("pseudo").style.borderColor="red";
    }
    else{
        document.getElementById("pseudo").style.borderColor="black";
    }
    if (name_error !== true) {
        document.getElementById("name").style.borderColor="red";
    }
    else{
        document.getElementById("name").style.borderColor="black";
    }
    if (birth_error !== true) {
        document.getElementById("birth").style.borderColor="red";
    }
    else{
        document.getElementById("birth").style.borderColor="black";
    }
    if (country_error !== true) {
        document.getElementsByTagName('select')[0].style.borderColor="red";
    }
    else{
        document.getElementsByTagName('select')[0].style.borderColor="black";
    }
    return false;
  }
}
function passwordCorrect(pass,pass2){

 if(pass === pass2){
   return true;
 }
 else{
   return false;
 }
}
function is_null(str){
    if (str.length === 0 || str ===""){
      return -1;
    }
    else{
      return true;
    }
}


function is_size_ok(str,sizeMin,sizeMax){
  if (str.length < sizeMin){
    return -1;
  }
  else if (str.length > sizeMax){
    return -2;
  }
  else return true;
}



// function notNull(id){
//   let elem = document.getElementById(id);
//   let value = elem.value;
//   let form = document.getElementById('form');
//   let span = form.getElementsByTagName('label');
//
//   if (!(value.length>8 && value.length<35)){
//     elem.style.backgroundColor = 'rgba(255,0,0,0.4)';
//     for(let i=0;i<span.length;i++){
//
//         if (span[i].getAttribute('for') === id) {
//           span[i].classList.add('item');
//
//         }
//     }
//   }
//   else{
//     for(let i=0;i<span.length;i++){
//
//         if (span[i].getAttribute('for') === id) {
//           span[i].classList.remove('item');
//
//         }
//     }
//     elem.style.backgroundColor ='white';
//     passwordCorrect();
//   }
// }
//

//
//
//    	function validation() {
// 			let name = document.getElementById("name").value;
// 			let email = document.getElementById("email").value;
//       let password = document.getElementById("password").value;
//       let pseudo = document.getElementById("pseudo").value;
//       let secondName = document.getElementById("secondName").value;
//       let birth = document.getElementById("birth").value;
//
//
// 			if (name.length < 2  || email.length < 8  || password.length < 8  || pseudo.length < 5  || secondName.length < 2 ) {
//         alert('Veuillez remplir tout les champs');
// 				return false;
//
// 			} else {
// 				return true;
// 			}
// 	}
//
// 	   function submit_by_id() {
// 		let name = document.getElementById("name").value;
// 		let email = document.getElementById("email").value;
//     let password = document.getElementById("password").value;
//     let pseudo = document.getElementById("pseudo").value;
//     let secondName = document.getElementById("secondName").value;
//     let birth = document.getElementById("birth").value;
//
//
// 		if (validation()  && validationCaptcha()) // Calling validation function
// 		{
// 		let formulaire = document.getElementById("form_id"); //form submission
//     formulaire.submit();
// 		console.log(formulaire);
//
// 		//window.location = 'signin.php';
// 		}
// 	}
