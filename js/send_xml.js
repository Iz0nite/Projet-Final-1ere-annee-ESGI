function XML_SEND(){
  let email_xml = document.getElementById('mail_xml').value;
  let req = new XMLHttpRequest();
  req.open("POST", '../export_xml.php',true);

  req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  req.onreadystatechange = function() {
  if (req.readyState === XMLHttpRequest.DONE && req.status === 200) {

    console.log(req.responseText);
    if (req.responseText==='ok'){
      let div = document.getElementById('mail_xml').parentNode;
      let child = div.children;
      let div_length = child.length;
      
      for (let i = 0; i < div_length; i++) {

        child[0].remove();
      }
      let ok = document.createElement('h3');
      ok.innerHTML = 'Export Envoyé !';

      div.appendChild(ok);
    }

    }
}

  req.send("mail="+email_xml);

}
