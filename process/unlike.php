<?php
require('../config.php');
include('../Include/maintain_session.php');

$q="DELETE FROM like_assos WHERE user_id = ? AND post_id = ?";
$req=$bdd->prepare($q);
$req->execute([$_SESSION['id'],$_POST['id_post']]);

echo 'ok';

 ?>
