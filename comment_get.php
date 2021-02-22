<?php
require('config.php');


$q = 'SELECT content,date_of_comment,user.nickname FROM comment INNER JOIN user ON comment.user_id=user.id WHERE post_id = ?';
$req= $bdd->prepare($q);
$req->execute([$_GET['post_id']]);
$resultComment= $req->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($resultComment);
 ?>
