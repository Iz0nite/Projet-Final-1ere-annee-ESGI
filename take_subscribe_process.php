<?php
  require('config.php');


  $q='SELECT subscribed FROM subscribe where subscriber=?';
  $req= $bdd->prepare($q);
  $req->execute([$_POST['user_id']]);
  $results_subscribe= $req->fetchAll(PDO::FETCH_ASSOC);

  echo json_encode($results_subscribe);
 ?>
