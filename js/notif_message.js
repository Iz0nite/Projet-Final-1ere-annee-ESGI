window.addEventListener('onload',loadnotif());
setInterval(loadnotif,1000);
const mess = document.getElementById("message");
const notif = document.getElementById("notif");

function loadnotif(){
  //console.log('AH');
  let req = new XMLHttpRequest();
  req.open("GET", '../notif_message.php');
  req.onreadystatechange = function() {
    if (req.readyState === 4 && req.status === 200) {


      //console.log('Ok');
      let result = JSON.parse(req.responseText);
      //console.log(result);


      if(result['COUNT(*)']>0){
        notif.classList.add("new_notif");
      }
      else if (result['COUNT(*)']<=0){
          notif.classList.remove("new_notif");
      }

      if (result['SUM(readed)']>0){
        console.log('AH');
        mess.classList.add("new_notif");
      }
      else if (result['SUM(readed)']<=0){
        mess.classList.remove("new_notif");
      }
  }
}
  req.send();


}



function delete_notif(){
  let id_user=document.getElementById('id_user').innerHTML;
  let req = new XMLHttpRequest();
  req.open("POST", '../delete_notif.php',true);
  req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  req.onreadystatechange = function() {
  if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
    let div_notif=document.getElementById('all_notif');
    let ul_notif=document.getElementById('ul_notif');
    ul_notif.remove();

    let new_ul=document.createElement('ul');
    new_ul.id='ul_notif';
    div_notif.appendChild(new_ul);

    let new_li=document.createElement('li');
    new_li.innerHTML='Aucune notification';
    new_ul.appendChild(new_li);
  }
}
  req.send("user_id="+id_user);
}
