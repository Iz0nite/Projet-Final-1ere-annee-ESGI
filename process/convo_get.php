<?php
require('../config.php');
include('../Include/maintain_session.php');

$q = "SELECT id_convo,user.nickname FROM convo_assoc INNER JOIN user ON user.id=convo_assoc.id_user WHERE id_convo IN (SELECT id_convo FROM convo_assoc WHERE id_user = ?) AND id_user <> ?";
$req = $bdd->prepare($q);
$req->execute([
  $_SESSION['id'],
  $_SESSION['id']
]);
$results_convo = $req->fetchAll(PDO::FETCH_ASSOC);

// $q = "SELECT user.nickname,convo.id,file.path FROM convo INNER JOIN user ON user.id=convo.second_user INNER JOIN file ON file.id=user.profile_picture WHERE  first_user = ?";
// $req = $bdd->prepare($q);
// $req->execute([$_SESSION['id']]);
// $results_convo2 = $req->fetchAll(PDO::FETCH_ASSOC);
//
// if (count($results_convo2)>0){
//      array_push($results_convo,...$results_convo2);
//  }

echo json_encode($results_convo);

?>
