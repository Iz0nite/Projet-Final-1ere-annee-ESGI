<?php
require('config.php');
session_start();



$q ='SELECT COUNT(*) FROM notif WHERE id_user = ?';
$req = $bdd->prepare($q);

$req->execute([
  $_SESSION['id']
]);

$result = $req->fetch(PDO::FETCH_ASSOC);


$q ='SELECT SUM(readed) FROM message WHERE receive_user = ? ';
$req = $bdd->prepare($q);

$req->execute([


  $_SESSION['id']
]);

$result2 = $req->fetch(PDO::FETCH_ASSOC);

$result = array_merge($result,$result2);

echo json_encode($result);
//SELECT SUM(readed),message.id FROM message INNER JOIN convo ON convo.id = message.convo INNER JOIN convo_assoc ON convo.id=convo_assoc.id_convo WHERE convo.last_mess = time AND id_user IN (SELECT id_user FROM convo_assoc WHERE id_user <> 24)
 ?>
