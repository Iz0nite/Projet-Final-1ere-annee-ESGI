function avert(signal) {

  let req = new XMLHttpRequest();
  req.open("POST", '../avert.php',true);

  req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  req.onreadystatechange = function() {
  if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {

    // let deleteDiv = document.getElementById("delete");
    //
    // window.location.href = deleteDiv.href;
    //user_more(inputdiv.value);
    // const div=document.getElementsByClassName('profile_user');
    // console.log(div[0]);
    // div[0].remove();

    document.location.href = "https://webcode.jeedomlorin.ovh/signals_process.php?action=delete-signals&id="+signal;

    }
}
let value;

  if(typeof result==='undefined'){
    const div = document.getElementById("info").innerHTML;
    value = div;
  }
  else{
    value = result[0]['id'];
  }



  req.send("id="+value);
  console.log(value);

}
