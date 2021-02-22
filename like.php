<?php
require('config.php');
include('Include/maintain_session.php');




$q = 'SELECT user_id FROM like_assos WHERE user_id = ? AND post_id = ?';
$req = $bdd->prepare($q);
$req->execute([$_SESSION['id'],$_POST['id_post']]);
$result = $req->fetchAll(PDO::FETCH_ASSOC);


if(count($result)==0){

  $q = 'INSERT INTO like_assos(user_id,post_id) VALUES (?,?)';
  $req = $bdd->prepare($q);
  $req->execute([$_SESSION['id'],$_POST['id_post']]);
  echo 'ok';
  exit();
}
else{
  echo 'no';
}



 ?>
