<?php
  require('../config.php');
  include('../Include/maintain_session.php');




  $q='SELECT COUNT(*) FROM like_assos where user_id = ? AND post_id = ?';
  $req= $bdd->prepare($q);
  $req->execute([$_SESSION['id'],$_GET['post_id']]);
  $results_like= $req->fetch(PDO::FETCH_ASSOC);

  echo json_encode($results_like);
 ?>
