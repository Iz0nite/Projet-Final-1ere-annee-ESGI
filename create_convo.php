<?php
require('config.php');
include('Include/maintain_session.php');

$q = "SELECT id_convo,user.id FROM convo_assoc INNER JOIN user ON user.id=convo_assoc.id_user WHERE
id_convo IN (SELECT id_convo FROM convo_assoc WHERE id_user = ?) AND id_user = ?";
$req = $bdd->prepare($q);
$req->execute([
  $_POST['id_user'],
  $_SESSION['id'],
]);


$result = $req->fetchAll(PDO::FETCH_ASSOC);

if (count($result)>0){
  echo $result[0]['id_convo'];
  exit();
}
else{

$q = 'INSERT INTO convo VALUES ()';
$bdd->query($q);

$convo_id=$bdd->lastInsertId();



$q = 'INSERT INTO convo_assoc(id_convo,id_user) VALUES (?,?)';
$req = $bdd->prepare($q);
$req->execute([
  $convo_id,
  $_SESSION['id']
]);

$q = 'INSERT INTO convo_assoc(id_convo,id_user) VALUES (?,?)';
$req = $bdd->prepare($q);
$req->execute([
  $convo_id,
  $_POST['id_user']
]);



echo $convo_id;


}

 ?>
