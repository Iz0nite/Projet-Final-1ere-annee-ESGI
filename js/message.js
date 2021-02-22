const mes_div = document.getElementById('convo');
const pseudo = document.getElementById('pseudo');
const textarea = document.getElementById('message_txt');
const get = document.getElementById('get');
let convo;
let lastdate;

window.onload = function(){
  console.log(get.innerHTML);
  convo = get.innerHTML;
};


mes_div.onscroll = function(){
  //console.log(mes_div.scrollTop);
if (mes_div.scrollTop < 100){
    let req = new XMLHttpRequest();
    req.open("GET", '../message_get.php?convo='+convo+"&date="+lastdate);

    req.onreadystatechange=function(){
      if (req.readyState === 4 && req.status === 200){
        let result = JSON.parse(req.responseText);
        if (result.length==0){
          console.log('pas de mess');
        }
        else{

          for (let i = 0; i < result.length; i++) {
            let div = document.createElement('div');


            let message = document.createElement('p');
            message.innerHTML=result[i]['content'];

            let time = document.createElement('small');
            time.innerHTML = result[i]['time']

            if(result[i]['user']==pseudo.innerHTML){
                div.classList.add('my_mess');
            }
            else{
              div.classList.add('other_mess');
            }


            div.appendChild(message);
            div.appendChild(time);

            mes_div.appendChild(div);
            lastdate = result[i]['time'];

          }

        }
      }
    };
    req.send();

  }
}



setInterval(message_load, 1000);
function bottom(){
  //console.log('bottom');
  mes_div.scrollTo(0,mes_div.scrollHeight);
}
function message_prepare(elem){
      //console.log(elem.id);
      convo = elem.id;
      let pseudo = elem.getElementsByTagName('h1')[0];
      pseudo.classList.remove('unread');

      let inner_div=mes_div.getElementsByTagName('div');
      let inner_div_length=inner_div.length;
      //console.log(inner_div_length);


      for (let i = 0; i < inner_div_length; i++) {
        inner_div[0].remove();
        //console.log('remove');
      }

      message_load();


}




function message_load(){
    //console.log(convo);
    let inner_div=mes_div.getElementsByTagName('div');
    let inner_div_length=inner_div.length;
    //console.log(inner_div_length);


    let req = new XMLHttpRequest();
    req.open("GET", '../message_get.php?convo='+convo);

    req.onreadystatechange=function(){
      if (req.readyState === 4 && req.status === 200){
        let result = JSON.parse(req.responseText);




        if (result.length==0){
          //console.log('pas de mess');
        }
        else{
          //console.log(typeof inner_div[0]);
          if (typeof inner_div[0]==='undefined'){
            for (var i = 0; i < result.length; i++) {
              let div = document.createElement('div');


              let message = document.createElement('p');
              message.innerHTML=result[i]['content'];

              let time = document.createElement('small');
              time.innerHTML = result[i]['time'];

              if(result[i]['user']==pseudo.innerHTML){
                  div.classList.add('my_mess');
              }
              else{
                div.classList.add('other_mess');
              }


              div.appendChild(message);
              div.appendChild(time);

              mes_div.appendChild(div);
              lastdate = result[i]['time'];

            }

          }
          else {
              if(result[0]['time']!==inner_div[0].getElementsByTagName('small')[0].innerHTML){
            for (let i = 0; i < inner_div_length; i++) {
              inner_div[0].remove();
              console.log('remove');
            }

            for (var i = 0; i < result.length; i++) {
              let div = document.createElement('div');


              let message = document.createElement('p');
              message.innerHTML=result[i]['content'];

              let time = document.createElement('small');
              time.innerHTML = result[i]['time'];

              if(result[i]['user']==pseudo.innerHTML){
                  div.classList.add('my_mess');
              }
              else{
                div.classList.add('other_mess');
              }


              div.appendChild(message);
              div.appendChild(time);

              mes_div.appendChild(div);
              lastdate = result[i]['time'];

            }
            setTimeout(bottom(),200);
            }


        }
        }
      }
    };
    req.send();

    //console.log(lastdate);
}

function send(){
  let message = textarea.value;
  textarea.value= ' ';
  console.log(message);
  let req = new XMLHttpRequest();
  req.open("POST", '../message_post.php',true);
  req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  req.onreadystatechange = function() {
  if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {

    console.log(req.responseText);
    message_load();


    setTimeout(bottom(),200);

    }
}

  req.send("id_convo="+convo+"&content="+message);

}
