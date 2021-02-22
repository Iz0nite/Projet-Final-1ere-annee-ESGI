const url = window.location.href;
console.log(url);
const help_window = document.getElementById("help");

function help(){

  const body = document.getElementsByTagName('body')[0];
  console.log(body);

  help_window.classList.add("help");
  help_window.classList.remove("hide");


}


function close_help(){
  help_window.classList.add("hide");
  help_window.classList.remove("help");
}

function send_help(){
  let help1=document.getElementById('help1').value;
  let help2=document.getElementById('help2').value;
  help1=help1.trim();
  help2=help2.trim();

  let req = new XMLHttpRequest();
  req.open("POST", '../signals_process.php',true);
  req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

  req.onreadystatechange = function() {
  if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
      let div_help=document.getElementById('div_help');
      let help1=document.getElementById('help1');
      let help2=document.getElementById('help2');
      let help_button=document.getElementById('help_button');

      help1.remove();
      help2.remove();
      help_button.remove();

      let confirm_send=document.createElement('p');

      confirm_send.innerHTML='Votre message à bien été envoyé';
      div_help.appendChild(confirm_send);
    }
}

  req.send("action=create&reason="+help1+"&dev="+help2);
}
