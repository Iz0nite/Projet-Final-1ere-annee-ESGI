<?php
require('config.php');
session_start();


$q='DELETE FROM signals WHERE user_id = ?';
$req= $bdd->prepare($q);
$req->execute([$_SESSION['id']]);

$q='DELETE FROM subscribe WHERE subscribed= ? OR subscriber= ?';
$req= $bdd->prepare($q);
$req->execute([$_SESSION['id'],$_SESSION['id']]);

$q='DELETE FROM notif WHERE id_user = ?';
$req= $bdd->prepare($q);
$req->execute([$_SESSION['id']]);



$q='DELETE FROM pass WHERE user_id = ?';
$req= $bdd->prepare($q);
$req->execute([$_SESSION['id']]);

$q='DELETE FROM convo_assoc WHERE id_user = ?';
$req= $bdd->prepare($q);
$req->execute([$_SESSION['id']]);

$q='DELETE FROM message WHERE user = ? OR receive_user = ?';
$req= $bdd->prepare($q);
$req->execute([$_SESSION['id'],$_SESSION['id']]);


$q='UPDATE like_assos SET user_id = NULL WHERE user_id = ?';
$req= $bdd->prepare($q);
$req->execute([$_SESSION['id']]);

$q='UPDATE post SET user_id = NULL WHERE user_id = ?';
$req= $bdd->prepare($q);
$req->execute([$_SESSION['id']]);

$q='UPDATE comment SET user_id = NULL WHERE user_id = ?';
$req= $bdd->prepare($q);
$req->execute([$_SESSION['id']]);





$q='DELETE FROM user WHERE id = ?';
$req= $bdd->prepare($q);
$req->execute([$_SESSION['id']]);

session_destroy();
header('location: index.php');

 ?>
