<?php
require('config.php');
include('Include/maintain_session.php');
$q="UPDATE post SET type='DELETED-POST' WHERE id= ? and user_id=?";
$req=$bdd->prepare($q);
$response=$req->execute([$_POST['post_id'],$_SESSION['id']]);
header('Location:index.php')
 ?>
