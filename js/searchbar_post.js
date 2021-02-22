
const inputdiv = document.getElementById('searchbar');
inputdiv.addEventListener("keyup",function(event){
  if (event.keyCode ===13){
    event.preventDefault();


    if (typeof enterdefault !== 'undefined'){
      enterdefault.getElementsByTagName('a')[0].click();
    }

  }
});
let enterdefault ;




inputdiv.addEventListener("focus",search);

let pathSearch = window.location.pathname;
let pageSearch = pathSearch.split("/").pop();

if (pageSearch === 'user_list.php'){

  window.addEventListener('load', function(event) {
    user_more(inputdiv.value);
  });

}

let result;

function search(){
  console.log('AH');
  const div = document.getElementById('list_result');
  let request = new XMLHttpRequest();
  let searchbar = document.getElementById('searchbar').value;
  const results = div.getElementsByTagName('li');
  const results_length=results.length;
  const type = document.getElementById('type').innerHTML;


  if (searchbar.length >= 2){



  request.open("GET", '../search.php?search='+searchbar+"&type="+type);
  //console.log(searchbar);

  request.onreadystatechange=function(){
    if (request.readyState === 4 && request.status === 200){
      //Traitement
      //Le status 200 sert à savoir si la requete est réussite
      let response = request.responseText;

      let result = JSON.parse(response);

      for (let i = 0; i < results_length; i++) {
        results[0].remove();

      }

      if(result.length>0){



        for (let i = 0; i < result.length; i++) {

          if(type === 'post'){

            console.log(result[i]['title']);//Pseudo attribuer
            let li = document.createElement('li');

            let p = document.createElement('a');
            p.href="page.php?title="+result[i]['title'];

            p.innerHTML = result[i]['title'];
            li.appendChild(p);
            div.appendChild(li);

          }
          else if (type === 'user'){


            //console.log(result[i]['nickname']);//Pseudo attribuer
            let li = document.createElement('li');
            //li.innerHTML = result[i]['nickname']

            let p = document.createElement('a');




            p.innerHTML = result[i]['nickname']+' '+result[i]['email'];
            p.addEventListener("click", function(){
              let div = this.innerHTML;
              param = div.split(' ');
              inputdiv.value = result[i]['nickname'];
                user_more(param[0]);
              }
            );
            li.appendChild(p);
             div.appendChild(li);

          }

        }
        //
        let tmp = document.getElementById('list_result');
        enterdefault = tmp.getElementsByTagName('li')[0];
        console.log(enterdefault);

        }
        else{
          let li = document.createElement('li');
          let p = document.createElement('a');


          p.innerHTML = 'Pas de résultat...';
          li.appendChild(p);
          div.appendChild(li);
        }







    }
  };
  request.send();//On lance la requête
  }
  else{
    for (let i = 0; i < results_length; i++) {
      results[0].remove();
    }

  }
}
function user_more(param){

  const result_div = document.getElementById('list_result');
  const results = result_div.getElementsByTagName('li');
  const results_length=results.length;

  for (let i = 0; i < results_length; i++) {
    results[0].remove();

  }



  const division = document.getElementById('division');
  const p_division = division.getElementsByTagName('div');

  if (typeof(p_division[0]) !== 'undefined'){
    p_division[0].remove()
  }


  searchbar = param;
  //console.log(searchbar);
  let type = 'more';

  let request = new XMLHttpRequest();

  request.open("GET", '../search.php?search='+searchbar+"&type="+type);
  request.onreadystatechange=function(){
    if (request.readyState === 4 && request.status === 200){

      let response = request.responseText;

       result = JSON.parse(response);





      if(result.length>0){


        let user_nickname = document.createElement('p');
        user_nickname.innerHTML = result[0]['nickname'];
        user_nickname.classList.add('nickname');

        let user_name = document.createElement('p');
        user_name.innerHTML = "Identité : "+result[0]['name']+' '+result[0]['second_name'];

        let user_email = document.createElement('p');
        user_email.innerHTML = "Email : "+result[0]['email'];

        let user_country = document.createElement('p');
        user_country.innerHTML = "Pays : "+result[0]['country'];

        let user_birth = document.createElement('p');
        user_birth.innerHTML = "Date de naissance : "+result[0]['birth'];

        let user_signinDate = document.createElement('p');
        user_signinDate.innerHTML = "Inscrit le : "+result[0]['signinDate'];

        let user_adress_ip = document.createElement('p');
        user_adress_ip.innerHTML = "Adresse Ip lors de l'inscription : "+result[0]['adress_ip'];

        let user_email_cert = document.createElement('p');
        user_email_cert.innerHTML = result[0]['email_cert'];

        let user_type = document.createElement('p');
        user_type.innerHTML = "Cete personne est : "+result[0]['type'];

        let user_visited = document.createElement('p');
        user_visited.innerHTML = "Nombre de pasges visitées :"+result[0]['visited'];

        let ban_button = document.createElement('button');

        if(result[0]['ban']==='1'){

          ban_button.onclick=unban;
          ban_button.innerHTML="Débannir l'utilisateur";
          ban_button.classList.add('unban_button');
        }



        else{
        ban_button.onclick=ban;
        ban_button.innerHTML="Bannir l'utilisateur";
        ban_button.classList.add('ban_button');
        }


        let signal_button = document.createElement('button');
        signal_button.onclick=avert;
        signal_button.innerHTML="Envoyer un avertisement à l'utilisateur";


        let left_div = document.createElement('div');
        left_div.classList.add('left_row');

        let right_div = document.createElement('div');
        right_div.classList.add('right_row');

        let div_profile = document.createElement('div');
        div_profile.classList.add('profile_user');

        let div_all = document.createElement('div');
        div_all.classList.add('div_all');

        let img = document.createElement('img');
        img.src = result[0]['path'];
        img.style.height ="200px";
        img.style.width ="200px";

        let div_button = document.createElement('div');
        div_button.classList.add('button_div');



        div_profile.appendChild(user_nickname);

        div_button.appendChild(signal_button);
        div_button.appendChild(ban_button);


        left_div.appendChild(user_name);
        left_div.appendChild(user_email);
        left_div.appendChild(user_country);
        left_div.appendChild(img);
        right_div.appendChild(user_birth);
        right_div.appendChild(user_signinDate);
        right_div.appendChild(user_adress_ip);
        right_div.appendChild(user_email_cert);
        right_div.appendChild(div_button);


        div_all.appendChild(left_div);
        div_all.appendChild(right_div);

        div_profile.appendChild(div_all);

        division.appendChild(div_profile);

      }

    }
  }
  request.send();



}

function ban() {

  let req = new XMLHttpRequest();
  req.open("POST", '../ban.php',true);

  req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  req.onreadystatechange = function() {
  if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {

    user_more(inputdiv.value);
    // const div=document.getElementsByClassName('profile_user');
    // console.log(div[0]);
    // div[0].remove();

    }
}

  req.send("id="+result[0]['id']);
  console.log(result[0]['id']);
}

function unban() {

  let req = new XMLHttpRequest();
  req.open("POST", '../unban.php',true);

  req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  req.onreadystatechange = function() {
  if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {

    user_more(inputdiv.value);
    // const div=document.getElementsByClassName('profile_user');
    // console.log(div[0]);
    // div[0].remove();

    }
}

  req.send("id="+result[0]['id']);
  console.log(result[0]['id']);

}
