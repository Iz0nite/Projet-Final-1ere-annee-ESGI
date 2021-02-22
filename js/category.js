const main = document.getElementsByClassName('left_div')[0];
const select = document.getElementById('category');

function category(){

let result;
let posts = document.getElementsByName('post');
let post_length = posts.length;
let category = select.getElementsByTagName('option');
let cat= select.value;
let cat_name;
for (var i = 0; i < select.length; i++) {

  if(select[i].value === cat){

    cat_name = select[i].innerHTML;
  }
}
if (cat_name ==='Catégorie'){
  cat = 'all';
}
let request= new XMLHttpRequest();
request.open('GET',"../category.php?category="+cat);

request.onreadystatechange = function () {
  if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
    let res=request.responseText;
    result=JSON.parse(res);
    console.log(res);
    for (var i = 0; i < post_length; i++) {
      posts[0].remove();
    }

    for (var i = 0; i < result.length; i++) {
      let div = document.createElement('div');
      div.setAttribute("name","post");
      console.log('AH');
      let img_div = document.createElement('div');
      let img = document.createElement('img');
      img.classList.add("img_post");
      img.src=result[i]['path'];

      img_div.appendChild(img);

      let center_div =  document.createElement('div');
      let title = document.createElement('h1');

      title.innerHTML=result[i]['title'];
      let p1 = document.createElement('p');
      p1.innerHTML="Description : "+result[i]['description'];

      let p2 = document.createElement('p');
      p2.innerHTML="Créer par : ";

      let strong =  document.createElement('strong');


      let a = document.createElement('a');
      a.innerHTML=result[i]['nickname'];
      a.href="profil.php?user="+result[i]['nickname'];
      strong.appendChild(a);
      p2.appendChild(strong);


      let ul = document.createElement('ul');
      ul.classList.add("cat_list");

      let li = document.createElement('li');
      if(cat==='all'){
        li.innerHTML=result[i]['name'];

      }
      else{
      li.innerHTML=cat_name;


    }
      ul.appendChild(li);

      center_div.appendChild(title);
      center_div.appendChild(p1);
      center_div.appendChild(p2);
      center_div.appendChild(ul);

      div.appendChild(img_div);
      div.appendChild(center_div);

      let right_div = document.createElement('div');
      let view = document.createElement('p');
      view.innerHTML="Vues : "+result[i]['view'];
      view.setAttribute("style","align-self:flex-end");

      let  right_post = document.createElement('div');
      right_post.classList.add("right_post");

      let ul_right = document.createElement('ul');
      ul_right.classList.add("star_list");

      for (let y = 0; y < result[i]['difficulty']; y++) {
        let img=document.createElement('img');
        img.classList.add('mini-star');
        img.src='Images/icons8-étoile-64.png';
        ul_right.appendChild(img);
      }

      let link =document.createElement('a');
      link.href="page.php?title="+result[i]['title'];
      link.innerHTML="C'est tipar !";

      right_post.appendChild(ul_right);
      right_post.appendChild(link);

      right_div.appendChild(view);
      right_div.appendChild(right_post);

      div.appendChild(right_div);

      main.appendChild(div);



    }

  }
};

console.log(cat);
request.send();
}
