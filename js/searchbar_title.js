function search(){
  const div = document.getElementById('list_result');
  let request = new XMLHttpRequest();
  let searchbar = document.getElementById('searchbar').value;
  const results = div.getElementsByTagName('li');
  const results_length=results.length;


  if (searchbar.length >= 2){



  request.open("GET", '../search.php?search='+searchbar);
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
          console.log(result[i]['title']);//Pseudo attribuer
          let li = document.createElement('li');

          let p = document.createElement('a');
          p.href="page.php?title="+result[i]['title'];

          p.innerHTML = result[i]['title'];
          li.appendChild(p);
          div.appendChild(li);
        }
        //


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
