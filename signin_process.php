<?php

require('config.php');




$pseudo = isset($_POST['pseudo'])? $_POST['pseudo'] : '';
$password = isset($_POST['password'])? hash($hash,$_POST['password']) : '';





$q= 'SELECT id,nickname,password,ban FROM user WHERE nickname = ? AND password= ?';
$req= $bdd->prepare($q);
$req->execute([$pseudo,$password]);
$results= $req->fetchAll();


if ($results[0]['ban']==1) {
  header('location: banned.php');
  exit;
}

if (count($results) ==0){
  header('location: signin.php?msg=Identifiants incorrects');
  exit;
}
else {


  if ($_POST['sess']=='on'){
      $valeur_cookie = $results[0]['id'].':'.$results[0]['nickname'].':'.$results[0]['password'];
      setcookie("auth", $valeur_cookie, time()+(3600*7*24),null,null,false,true);

  }
  session_start();
  $_SESSION['id'] =$results[0]['id'];
  header('location: index.php?msg=Vous êtes bien Connecté');
}







 ?>
