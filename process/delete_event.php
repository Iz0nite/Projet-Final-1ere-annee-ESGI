<?php
require('../config.php');
include('../Include/maintain_session.php');

echo $_POST['id'];

 if ($_SESSION['user'] === 'admin'){

   $q = "UPDATE post SET type = 'DELETED' WHERE id = ? ";
   $req = $bdd->prepare($q);
   $req->execute([
      $_POST['id']
      ]);

 }
else{
   echo 'no access';
 }
 ?>
