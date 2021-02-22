<?php
require('../config.php');
include('../Include/maintain_session.php');
echo 'ok';
$q = 'UPDATE post SET content = ? WHERE user_id = ? AND id = ?';
$req = $bdd->prepare($q);
;

$req->execute([
    $_POST['str'],
    $_SESSION['id'],
    $_POST['id']
]);



 ?>
