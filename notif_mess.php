<?php
require('config.php');

$q ='SELECT COUNT(*) FROM notif WHERE user_id = ?';
$req = $bdd->prepare($q);
$req->execute([$_SESSION['id']])
$result = $req->fetchAll(PDO::FETCH_ASSOC);

echo $result;

 ?>
