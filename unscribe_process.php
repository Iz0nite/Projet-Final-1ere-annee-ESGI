<?php
require('config.php');

$q='DELETE FROM subscribe WHERE subscribed=? AND subscriber=?';
$req= $bdd->prepare($q);
$req->execute([$_POST['subscribed_id'],$_POST['user_id']]);

 ?>
