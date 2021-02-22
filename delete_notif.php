<?php
    require('config.php');

    $q='DELETE FROM notif WHERE id_user=?';
    $req= $bdd->prepare($q);
    $req->execute([$_POST['user_id']]);
 ?>
