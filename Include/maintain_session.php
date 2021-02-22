<?php
session_start();

if (isset($_COOKIE['auth'])){

  $valeur_cookie = explode(':',$_COOKIE['auth']);
  if(count($valeur_cookie)===3){

    $q = 'SELECT id,nickname,password,ban,type FROM user WHERE id = ?';
    $req = $bdd->prepare($q);
    $req->execute([$valeur_cookie[0]]);
    $result = $req->fetch();

    if ($result['ban']==1) {

      header('location: banned.php');
      session_destroy();
      exit;
    }

    else if ($result && $valeur_cookie[1] === $result['nickname'] && $valeur_cookie[2] === $result['password']){
      session_regenerate_id();
      $_SESSION['id']= $result['id'];
      $_SESSION['user']= $result['type'];

    }


  }
}

if(isset($_SESSION['id'])){
  $q="UPDATE user SET last_pass = ? WHERE id = ?";
  $req=$bdd->prepare($q);
  $req->execute([
    date('Y-m-d H:i:s'),
    $_SESSION['id']
  ]);
}

?>
