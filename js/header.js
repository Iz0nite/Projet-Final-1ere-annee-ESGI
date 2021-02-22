let path = window.location.pathname;
let page = path.split("/").pop();

console.log(page);

let nav = document.getElementById('Nav').getElementsByTagName('li');
console.log(nav);

  for (var i = 0; i < nav.length; i++) {

       let nav_element = nav[i].getElementsByTagName('a')[0];
       console.log(nav_element);
     if (nav_element.getAttribute("href") === page){
      nav_element.classList.add("select");
      nav[i].classList.add("select_li");
     }
     else{
       nav_element.classList.add("unselect");
     }
  }
