<?php
  require('config.php');
  include('Include/maintain_session.php');
//echo 'recherche '.$_GET['search'];

// if (isset($_SESSION['id'])){
//   $q = 'SELECT type FROM user WHERE id = ? ';
//   $req = $bdd->prepare($q);
//   $req->execute([$_SESSION['id']]);
//   $result_admin = $req->fetch(PDO::FETCH_ASSOC);
//
// }

$search = '%'.$_GET['search'].'%';
$type = $_GET['type'];


if ($type === 'post'){

 $q = 'SELECT title FROM post WHERE title LIKE ? LIMIT 3';
 $req= $bdd->prepare($q);
 $req->execute([$search]);
 $results2= $req->fetchAll(PDO::FETCH_ASSOC);

}
else if ($type === 'user'){
  $q = 'SELECT email,nickname FROM user WHERE nickname LIKE ? OR email LIKE ? LIMIT 3';
  $req= $bdd->prepare($q);
  $req->execute([$search,$search]);
  $results2= $req->fetchAll(PDO::FETCH_ASSOC);
}

else if ($type === 'more'){
  $q = 'SELECT user.id,user.email,user.nickname,user.id,user.name,user.second_name,user.country,user.birth,user.signinDate,user.adress_ip,user.email_cert,user.type,user.visited,user.profile_picture,file.path,user.ban FROM user INNER JOIN file ON user.profile_picture=file.id WHERE user.nickname = ?';
  $req= $bdd->prepare($q);
  $req->execute([$_GET['search']]);
  $results2= $req->fetchAll(PDO::FETCH_ASSOC);
}

echo json_encode($results2);



 ?>
