<?php
require('config.php');
session_start();
  if($_SESSION['user']=='admin'){
      echo $_POST['id'];
       $req = $bdd->prepare('UPDATE user SET ban = 1 WHERE id = ?');
       $req->execute([$_POST['id']]);

       $req = $bdd->prepare('UPDATE post SET type = "ban" WHERE user_id = ?');
       $req->execute([$_POST['id']]);
 }

 ?>
