<?php
if (isset($_COOKIE['theme'])){
  if ($_COOKIE['theme']==0) {
    setcookie("theme", 1, time()+(3600*7*24),null,null,false,true);
  }else{
    setcookie("theme", 0, time()+(3600*7*24),null,null,false,true);
  }
}else {

 setcookie("theme", 1, time()+(3600*7*24),null,null,false,true);
}


  header('location: index.php');


 ?>
