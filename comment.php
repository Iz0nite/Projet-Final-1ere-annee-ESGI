<?php
require('config.php');
session_start();





$q= 'INSERT INTO comment(content,post_id,user_id) VALUES(?,?,?)';
$req= $bdd->prepare($q);
$req->execute([
  htmlspecialchars($_POST['content']),
  $_POST['post_id'],
  $_SESSION['id']

]);



 ?>
