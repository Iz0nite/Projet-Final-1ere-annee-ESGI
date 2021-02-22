const crea = document.getElementById('crea');
const crea_child = crea.children;
const title = document.getElementById('title');
let formData = new FormData();
let image=0;
const description=document.getElementById('description');
let str;
let difficulty;
const category_div=document.getElementById('category');

function star(elem){
  difficulty=elem.name;

  let stars = document.getElementsByClassName('star')
  for (var i = 0; i < 5; i++) {
    if (i < elem.name){
      stars[i].classList.remove("unactive");
    }
    else{
      stars[i].classList.add("unactive");
    }
  }
}



function create_div(){
    let textarea = document.createElement('textarea');
    textarea.setAttribute("name", "content");
    textarea.setAttribute("rows", "20");
    textarea.setAttribute("cols", "80");
    crea.appendChild(textarea);
}

function create_img(){
  let img = document.createElement('input');
  img.setAttribute("type", "file");
  img.setAttribute("name", "image-"+image);
  image++;
  crea.appendChild(img);

}

function create_str(){
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
  console.log(str);
  //console.log(formData);
  bdd();
}




function bdd_img(){
  let req = new XMLHttpRequest();

  req.open("POST",'insert_img.php',true);


 req.onreadystatechange = function(){
   if (this.readyState === XMLHttpRequest.DONE && this.status ===200){

      window.location =  "https://webcode.jeedomlorin.ovh/page.php?title="+title.value;
   }
 }


  req.send(formData);
}

function bdd(){
  let req = new XMLHttpRequest();

  let description_value = description.value;
  let title_value = title.value;
  let category = category_div.value;
  req.open("POST",'insert_post.php',true);

  req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

  req.onreadystatechange = function(){
    if (this.readyState === XMLHttpRequest.DONE && this.status ===200){
      let result = this.responseText;
      console.log(result);
      formData.append("id",result);
      bdd_img();
    }
  }
  console.log(title_value+' '+str);
  req.send("title="+title_value+"&str="+str+"&difficulty="+difficulty+"&description="+description_value+"&category="+category);
}
