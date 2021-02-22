<?php
require('config.php');

$q='INSERT INTO subscribe(subscribed,subscriber) VALUES (?,?)';
$req= $bdd->prepare($q);
$req->execute([$_POST['subscribed_id'],$_POST['user_id']]);

$q='SELECT nickname FROM user WHERE id=?';
$req= $bdd->prepare($q);
$req->execute([$_POST['user_id']]);
$nickname= $req->fetchAll(PDO::FETCH_ASSOC);


$title="Nouvelle abonné";
$content=$nickname[0]['nickname']." s'est abonné !";
$type="new_subscriber";

$q='INSERT INTO notif(title,content,type,id_user) VALUES (?,?,?,?)';
$req= $bdd->prepare($q);
$req->execute([$title,$content,$type,$_POST['subscribed_id']]);

 ?>
