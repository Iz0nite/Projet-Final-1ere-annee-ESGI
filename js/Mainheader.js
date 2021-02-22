let path = window.location.pathname;
let page = path.split("/").pop();

if (page === ''){
  page = 'index.php';
}

console.log(page);

let nav = document.getElementById('nav').getElementsByTagName('a');
console.log(nav);

for (var i = 0; i < nav.length; i++) {

  let nav_element = nav[i];
  console.log(nav_element);
  if (nav_element.getAttribute("href") === page){
     nav_element.classList.add("select");
    }

}
