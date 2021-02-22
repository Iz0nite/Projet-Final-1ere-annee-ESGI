const conteineur= document.getElementById('comment');
const id_title = document.getElementById('id_title').innerHTML;
const div_like = document.getElementById('like_nbr');
const conteineurSign= document.getElementById('signal_cont');
const post = document.getElementsByClassName('text_page')[0];



function comment(){


  let textarea = document.createElement("textarea");
  let button = document.createElement("button");



  if (document.getElementById('content')===null){



  conteineur.appendChild(textarea);
  textarea.setAttribute("name", "content");
  textarea.setAttribute("id", "content");
  textarea.setAttribute("rows", "20");
  textarea.setAttribute("cols", "80");
  conteineur.appendChild(button);
  button.setAttribute("onclick","comment2()")
  button.innerHTML = "Valider";
  }
}

function comment2() {
  let id=document.getElementById('id_title').innerHTML;
  let content1=document.getElementById('content');
  let content2=content1.value;

  let req = new XMLHttpRequest();
  req.open("POST", '../comment.php',true);
  req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  req.onreadystatechange = function() {
  if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
      const button = conteineur.getElementsByTagName('button')[0];
      button.remove();
      content1.remove();
      actuComm();
    }
}

  req.send("content="+content2+"&post_id="+id);

}

function actuComm(){
    let id=document.getElementById('id_title').innerHTML;
    let li = conteineur.getElementsByTagName('div');
    let li_length = li.length;

    let req = new XMLHttpRequest();
    req.open("GET", '../comment_get.php?post_id='+id);
    req.onreadystatechange = function() {
      if (req.readyState === 4 && req.status === 200){

        let response = req.responseText;
        let result = JSON.parse(response);
        //ON RETIRE LES ANCIENS COMMENTAIRES
        for (let i = 0; i < li_length; i++) {
          li[0].remove();

        }
        console.log(result);
        for (let i = 0; i < result.length; i++) {
            let div = document.createElement('div');
            div.classList.add('comment_page');
            let nickname = document.createElement('p');
            let content = document.createElement('p');
            let date = document.createElement('p');
            nickname.innerHTML = result[i]['nickname'];
            content.innerHTML = result[i]['content'];
            date.innerHTML = result[i]['date_of_comment'];

            div.appendChild(nickname);
            div.appendChild(content);
            div.appendChild(date);
            conteineur.appendChild(div);
        }
      }
    }
    req.send();
}

function signal_btn(){
  let textarea = document.createElement("textarea");
  let dev =  document.createElement("textarea");
  let button = document.createElement("button");

  document.getElementById('signal').remove();

  if (document.getElementById('signal')===null){


  dev.setAttribute("name", "signal");
  dev.setAttribute("placeholder", "Dévellopement");
  dev.setAttribute("id", "deve");
  dev.setAttribute("rows", "20");
  dev.setAttribute("cols", "80");

  textarea.setAttribute("name", "signal");
  textarea.setAttribute("id", "signal");
  textarea.setAttribute("placeholder", "Raison");
  textarea.setAttribute("rows", "2");
  textarea.setAttribute("cols", "80");

  button.setAttribute("onclick","signal()")
  button.innerHTML = "Valider";

  conteineurSign.appendChild(textarea);

  conteineurSign.appendChild(dev);
  conteineurSign.appendChild(button);
  }

}

function signal(){
  let id=document.getElementById('id_title').innerHTML;
  let reason = document.getElementById("signal").value;
  let dev = document.getElementById("deve").value;
  let user_id = document.getElementById('subscribed_id').innerHTML;
  let childrens = conteineurSign.children;
  let child_length = childrens.length;
  console.log(dev);
  console.log(reason);

  let req = new XMLHttpRequest();
  req.open("POST", '../signals_process.php',true);
  req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

  req.onreadystatechange = function() {
  if (req.readyState === XMLHttpRequest.DONE && req.status === 200) {
      for (var i = 0; i < child_length; i++) {
        childrens[0].remove();
      }

      let confirm = document.createElement('p');
      confirm.innerHTML='Le post à bien été signalé';
      console.log(this.responseText);
      conteineurSign.appendChild(confirm);
    }
}

  req.send("action=create&post_id="+id+"&reason="+reason+"&dev="+dev+"&user_id="+user_id);
}

function verif_subscribe(){
  // let subscribed=document.getElementById('subscribed').innerHTML;
  let subscribed_id=document.getElementById('subscribed_id').innerHTML;
  let check_id=document.getElementById('user_id').innerHTML;
  subscribed_id=subscribed_id.trim();
  check_id=check_id.trim();
  let req = new XMLHttpRequest();
  req.open("POST", '../take_subscribe_process.php',true);

  req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  req.onreadystatechange = function() {
    if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
      let res=req.responseText;
      result=JSON.parse(res);
      for (var i = 0; i < result.length; i++) {
        if (result[i]['subscribed']==subscribed_id) {
          let subscribe=document.getElementById('subscribe');
          let subscribe_button=document.getElementById('subscribe_button');
          subscribe_button.remove();

          let unscribe_button=document.createElement('button');
          unscribe_button.id='unscribe_button'
          unscribe_button.innerHTML='Se désabonner'
          unscribe_button.onclick=unscribe;
          subscribe.appendChild(unscribe_button);
        }
      }

    }
  }
req.send("user_id="+check_id);
}

function verif_like(){
  console.log('VERIFICATION');
  let div_like = document.getElementById('like_btn_div');
  let like_btn = document.getElementById('like_btn');
  let req = new XMLHttpRequest();
  req.open("GET", '../process/take_like_process.php?post_id='+id_title);

  req.onreadystatechange = function() {
    if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
      let res=req.responseText;
      result=JSON.parse(res);
      console.log(result);

        if (result['COUNT(*)']>0) {
          like_btn.remove();

          let unlike_button = document.createElement('button');
          unlike_button.innerHTML="Liké";
          unlike_button.onclick=unlike;
          unlike_button.id='like_btn';
          unlike_button.classList.add('liked');
          div_like.appendChild(unlike_button);

        }
        else{

          like_btn.remove();

          let like_button = document.createElement('button');
          like_button.innerHTML="Like";
          like_button.onclick=like;
          like_button.id='like_btn';
          like_button.classList.add('like');
          div_like.appendChild(like_button);


        }
      }
  }
  req.send();
}


function like(){
    const id_post = document.getElementById('id_title').innerHTML;

    let req = new XMLHttpRequest();
    req.open("POST", '../like.php',true);
    req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    req.onreadystatechange = function() {
      if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
        verif_like();
        let nbr = parseInt(like_nbr.innerHTML)+1;
        like_nbr.innerHTML = nbr;
        }
    }
    console.log(id_post);
    req.send('id_post='+id_post);
}

function unlike(){
    const id_post = document.getElementById('id_title').innerHTML;

    let req = new XMLHttpRequest();
    req.open("POST", '../process/unlike.php',true);
    req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    req.onreadystatechange = function() {
      if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
        verif_like();
        let nbr = parseInt(like_nbr.innerHTML)-1;
        like_nbr.innerHTML = nbr;
        }
    }
    console.log(id_post);
    req.send('id_post='+id_post);

}




function subscribe() {
  let user_id=document.getElementById('user_id').innerHTML;
  let subscribed_id=document.getElementById('subscribed_id').innerHTML;
  user_id=user_id.trim();
  subscribed_id=subscribed_id.trim();

  let req = new XMLHttpRequest();
  req.open("POST", '../subscribe_process.php',true);

  req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  req.onreadystatechange = function() {
  if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
    let subscribe_div=document.getElementById('subscribe');
    let subscribe_button=document.getElementById('subscribe_button');
    subscribe_button.remove();

    let unscribe_button=document.createElement('button');
    unscribe_button.id='unscribe_button'
    unscribe_button.innerHTML='Se désabonner'
    unscribe_button.onclick=unscribe;
    subscribe_div.appendChild(unscribe_button);

    }

}
req.send("user_id="+user_id+"&subscribed_id="+subscribed_id);
}


function unscribe() {
  let user_id=document.getElementById('user_id').innerHTML;
  let subscribed_id=document.getElementById('subscribed_id').innerHTML;
  user_id=user_id.trim();
  subscribed_id=subscribed_id.trim();

  let req = new XMLHttpRequest();
  req.open("POST", '../unscribe_process.php',true);

  req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  req.onreadystatechange = function() {
  if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
      let subscribe_div=document.getElementById('subscribe');
      let unscribe_button=document.getElementById('unscribe_button');
      unscribe_button.remove();

      let subscribe_button=document.createElement('button');
      subscribe_button.id='subscribe_button';
      subscribe_button.innerHTML="S'abonner";
      subscribe_button.onclick=subscribe;
      subscribe_div.appendChild(subscribe_button);


    }

}
req.send("user_id="+user_id+"&subscribed_id="+subscribed_id);

}

function patch(){

  let child_post = post.children;
  let child_length = child_post.length;


    for (let i = 0; i < child_length; i++) {
      console.log(child_post[i]);
      if (child_post[i].tagName==='P'){


        let text = child_post[i].innerHTML;
        text = text.split('<br>').join('');
        let modif = document.createElement('textarea');
        modif.value = text;
        modif.onclick=function(){
          taille_auto(this);
        };
        modif.style="order:"+i;
        //child_post[i].remove();
        child_post[i].style="display:none";
        post.appendChild(modif);

      }

      else if (child_post[i].tagName==='IMG'){
        child_post[i].style="order:"+i;

        let supp = document.createElement('button');
        supp.innerHTML='Supprimer';
        supp.style="order:"+i;
        supp.onclick=function(){
          remove(this);
        };

        post.appendChild(supp);




        //child_post[i].remove();
      }



    }
    let validate = document.createElement('button');
    validate.innerHTML='Valider Modifications';
    validate.onclick=function(){
        let page = document.getElementsByClassName('text_page')[0];
        let crea_child = page.children;
        let id = document.getElementById('id_title').innerHTML
        let req = new XMLHttpRequest();
        let str;
          str='';
          for (var i = 0; i < crea_child.length; i++) {

            if(crea_child[i].tagName==='TEXTAREA'){
              str+='[OPENDIV]'+crea_child[i].value+'[CLOSEDIV]';

            }
            else if (crea_child[i].tagName==='INPUT'){
              if((crea_child[i].files).length!==0){
              str+='[IMAGE num='+crea_child[i].name+']';
              let files = crea_child[i].files;
              //console.log(files);
              for(const file of files){
                formData.append("myNames[]",crea_child[i].name);
                formData.append("myFiles[]",file);
              }

            }
            }
          }


          req.open("POST",'process/modify_post.php',true);
          req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

          req.onreadystatechange = function(){
            if (req.readyState === XMLHttpRequest.DONE && req.status ===200){
              console.log(req.responseText);
                document.location.reload(true);
            }
          }

          req.send("str="+str+"&id="+id);






    };

    document.getElementById('like_btn_div').appendChild(validate);

    document.getElementById('modif').remove();
    // for (var i = 0; i < child_length; i++) {
    //
    //
    // }
}

function remove(elem){
  let child_post = post.children;
  let child_length = child_post.length;

    for (var i = 0; i < child_length; i++) {
        console.log(i);

      if (child_post[i].tagName==='IMG'){

        child_post[i].remove();

        elem.remove();
        i-=2;
        child_length-=2;

      }

    }
    let order=0;
    let name=0;
    for (var i = 0; i < child_length; i++) {
      console.log(child_post[i].style["display"]);
      if (child_post[i].style["display"]!=="none"){
        if (child_post[i].tagName==='IMG'){
          child_post[i].name=name;
          name++;
        }
        child_post[i].style="order:"+order;
        order++;
        }
    }

}

function modif_send(){

  let str='';
  let child_post = post.children;
  for (var i = 0; i < child_post.length; i++) {

    if(child_post[i].tagName==='TEXTAREA'){
      str+='[OPENDIV]'+child_post[i].value+'[CLOSEDIV]';

    }
    else if (child_post[i].tagName==='IMG'){

      str+='[IMAGE num='+child_post[i].name+']';
      let files = child_post[i].files;
      //console.log(files);

    }
  }
  console.log(str);
  //console.log(formData);

}


function taille_auto(element) {
    element.style.height = "5px";
    element.style.height = (element.scrollHeight)+"px";
}
