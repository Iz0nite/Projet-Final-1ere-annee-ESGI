function close_account(){
  let close1=document.getElementById('close1');
 close1.remove();

  let div_close=document.getElementById('div_close');
  let choice=document.getElementById('choice');
  let div_cancel=document.getElementById('cancel');
  let form_close=document.getElementById('form_close');

  let alert=document.createElement('p');
  alert.innerHTML='Cloturer le compte ?'
  choice.appendChild(alert);

  let confirm=document.createElement('input');
  confirm.type="submit";
  confirm.name="submit";
  confirm.value="Confirmer";
  form_close.appendChild(confirm);

  let cancel=document.createElement('button');
  cancel.onclick=function(){
    alert.remove();
    cancel.remove();
    confirm.remove();
    let return_close1=document.createElement('button');
    return_close1.id='close1'
    return_close1.class='litle_input';
    return_close1.onclick=close_account;
    return_close1.innerHTML='Cloturer votre compte';
    div_close.appendChild(return_close1);
  }
  cancel.innerHTML='Annuler';
  div_cancel.appendChild(cancel);
}



function modif_profil(){
  elem1=document.getElementById('pseudo1');
  elem2=document.getElementById('pseudo2');
  elem3=document.getElementById('modif1');
  elem4=document.getElementById('pseudo3');
  elem3.remove();

  let text=document.createElement('textarea');
  text.setAttribute("name", "content");
  text.setAttribute("id", "content");
  text.setAttribute("rows", "1");
  text.setAttribute("cols", "38");
  elem4.appendChild(text);

  let confirm=document.createElement('button');
  confirm.id='confirm_pseudo';
  confirm.innerHTML='Valider';
  confirm.onclick=send_modif;
  elem4.appendChild(confirm);

  let cancel=document.createElement('button');
  cancel.id='cancel_pseudo';
  cancel.innerHTML='Annuler';
  cancel.onclick=function(){
    text.remove();
    confirm.remove();
    cancel.remove();

    let return_modif=document.createElement('button');
    return_modif.id=elem3.id;
    return_modif.innerHTML='Changer le pseudo';
    return_modif.onclick=modif_profil;
    elem1.appendChild(return_modif)


  }

  elem4.appendChild(cancel);


}

function send_modif(){
  let result=document.getElementById('pseudo2');
  let id=document.getElementById('id_change_info').innerHTML;
  let confirm=document.getElementById('confirm_pseudo');
  let cancel=document.getElementById('cancel_pseudo')
  let text=document.getElementById('content')
  let content=text.value;
  content.trim();

  let req = new XMLHttpRequest();
  req.open("POST", '../change_info.php',true);

  req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  req.onreadystatechange = function() {
  if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
    let res=req.responseText;
    if (res) {
      result.innerHTML='Pseudo déja pris'
    }else{
      result.innerHTML=content
      text.remove();
      confirm.remove();
      cancel.remove();

      let return_modif=document.createElement('button');
      return_modif.id=elem3.id;
      return_modif.innerHTML='Changer le pseudo';
      return_modif.onclick=modif_profil;
      elem1.appendChild(return_modif)

    }

}
}
req.send("user_id="+id+"&content="+content);
}



let input=document.getElementById('profil_picture');
input.addEventListener('change', update_image);

function update_image(){
  let verif_show_files=document.getElementById('show_files');
  let verif_confirm=document.getElementById('confirm');
  let form=document.getElementById('result_picture')
  let files=input.files;

  if (verif_show_files && verif_confirm) {
    verif_show_files.remove();
    verif_confirm.remove();
  }


  if (files.length==0) {
    let show_files=document.createElement('p');
    show_files.innerHTML='Fichier non séléctionné';
    form.appendChild(show_files);
  }else {
    let show_files=document.createElement('p');
    show_files.id='show_files';
    show_files.innerHTML='Fichier '+files[0].name;
    form.appendChild(show_files);

    let confirm=document.createElement('input');
    confirm.id='confirm';
    confirm.value='Confirmer';
    confirm.type="submit";
    confirm.name="submit";
    form.appendChild(confirm);
  }
}
