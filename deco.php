<?php
session_start();
session_destroy();
setcookie("auth", null, time()+(3600*7*24),null,null,false,true);
header("location: index.php?msg=Vous êtes bien déconnecté");


 ?>
