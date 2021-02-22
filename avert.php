<?php
require('config.php');
session_start();
echo 'OK LOAD';

  if($_SESSION['user']=='admin'){


    $q = 'INSERT INTO notif(title,content,type,readed,id_user) VALUES(?,?,?,?,?)';
    $req = $bdd->prepare($q);
    $req->execute([
      'Avertissement',
      'Vôtre action est signalé',
      'avert',
      0,
      $_POST['id']
    ]);


    echo 'Damn';
  }
  else{
    echo 'Pas autorisé';
  }
  ?>
