function supp_event(elem){

  let id = elem.name;
  console.log(id);
  console.log('envoi');
  let req = new XMLHttpRequest();
  req.open('POST','../process/delete_event.php',true);
  req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  req.onreadystatechange = function() {
  if (req.readyState === XMLHttpRequest.DONE && req.status === 200) {
    elem.parentNode.remove();
    if (req.responseText==='ok'){


    }

    }
}

  req.send("id="+id);

}
