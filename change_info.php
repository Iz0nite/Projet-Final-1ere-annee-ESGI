<?php
require('config.php');

$q = 'SELECT id FROM user WHERE nickname = ? ';
$response = $bdd->prepare($q);
$response->execute([$_POST['content']]);
$result = $response->fetchAll();

if (count($result) >= 1){
  echo 'nope';

}else{

$q='UPDATE user SET nickname=? WHERE id=?';
$req= $bdd->prepare($q);
$req->execute([htmlspecialchars($_POST['content']),$_POST['user_id']]);
}
 ?>
