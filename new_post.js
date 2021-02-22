let tmp=0
let delim='axevtn';
let content='';


function textarea() {
  const form= document.getElementById('form')
  let textarea = document.createElement("textarea");
  form.appendChild(textarea);
  textarea.setAttribute("name", "content");
  textarea.setAttribute("id", "content");
  textarea.setAttribute("rows", "20");
  textarea.setAttribute("cols", "80");
  tmp+=1;


}

function img(){
  const form= document.getElementById('form')
  let img = document.createElement("input");
  form.appendChild(img);
  img.setAttribute("type", "file");
  img.setAttribute("name", "img");
  img.setAttribute("id", "_"+tmp);

}

function verif(){
  const text= document.getElementsByTagName('textarea');
  for (var i = 0; i < text.length; i++) {
    content+= text[i].value+delim;
  }
  const pict=document.getElementsByClassName('className')

console.log(content);
}
