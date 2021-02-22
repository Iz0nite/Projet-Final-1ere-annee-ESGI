<?php
require('config.php');
session_start();

$q = 'SELECT id FROM post WHERE title = ? ';
$response = $bdd->prepare($q);
$response->execute([$_POST['title']]);
$result = $response->fetchAll();

if (count($result) >= 1){
  header('location: new_post.php?Erreur=Titre déja pris');
  exit();
}

if ($_POST['difficulty']>5){
  $difficulty = 5;
}
else if($_POST['difficulty']<1){
  $difficulty = 1;
}
else{
  $difficulty=$_POST['difficulty'];
}

$q = 'INSERT INTO post(title,content,description,view,type,difficulty,user_id,category_id) VALUES (?,?,?,?,?,?,?,?)';
$req = $bdd->prepare($q);
$req->execute([
  htmlspecialchars($_POST['title']),
  htmlspecialchars($_POST['str']),
  htmlspecialchars($_POST['description']),
  0,
  'poste',
  htmlspecialchars($difficulty),
  $_SESSION['id'],
  htmlspecialchars($_POST['category'])
]);

echo $bdd->lastInsertId();
 ?>
