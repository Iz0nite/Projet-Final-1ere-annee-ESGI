const id = document.getElementById('id_user_mess').innerHTML;

function new_convo(){

  let req = new XMLHttpRequest();
  req.open("POST", '../create_convo.php',true);
  req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

  req.onreadystatechange = function() {
  if (req.readyState === XMLHttpRequest.DONE && req.status === 200) {
    //console.log(req.responseText);
    document.location.href = 'message.php?convo='+req.responseText;

    }
  }
  console.log(id);
  req.send("id_user="+id);


  }
