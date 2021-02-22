<?php
require('config.php');
session_start();
// WARNING: IL FAUT METTRE EN COMMUN LE POST ET GET


  if($_SESSION['user']=='admin'){

    if($_GET['action']=='delete-signals'){
      $q = "DELETE FROM signals WHERE id = ?";
      $req = $bdd->prepare($q);
      $response = $req->execute([$_GET['id']]);


    }
    else if ($_GET['action']=='delete-post'){

      $q = "UPDATE FROM post SET type = 'DELETED-POST' WHERE id = ? ";
      $req = $bdd->prepare($q);
      $response = $req->execute([$_GET['id']]);

    }
    header('Location: signals.php');
  }
  if (!isset($_POST['post_id'])) {
    $q ='INSERT INTO signals(reason,reason_dev,user_id) VALUES (?,?,?)';

    $req = $bdd->prepare($q);
    $req->execute([
      htmlspecialchars($_POST['reason']),
      htmlspecialchars($_POST['dev']),
      $_SESSION['id']
    ]);
  }else{
    if($_POST['action']=='create'){
      $q ='INSERT INTO signals(reason,reason_dev,user_id,post_id) VALUES (?,?,?,?)';
      $req = $bdd->prepare($q);
      echo 'osecour2';
      $req->execute([
        htmlspecialchars($_POST['reason']),
        htmlspecialchars($_POST['dev']),
        htmlspecialchars($_POST['user_id']),
        htmlspecialchars($_POST['post_id'])
      ]);
  }
}

 ?>
