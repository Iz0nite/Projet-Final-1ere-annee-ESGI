<?php
	require('config.php');
	include('Include/maintain_session.php');


if (isset($_GET['date'])){
	$q = "SELECT content,user,time FROM message WHERE convo = ?  AND time < ? ORDER BY time DESC LIMIT 10";
  $req = $bdd->prepare($q);
  $req->execute([$_GET['convo'],$_GET['date']]);
  $result = $req->fetchAll(PDO::FETCH_ASSOC);

	$q ="UPDATE message SET readed = '0' WHERE convo = ? AND time < ? AND user <> ? ORDER BY TIME DESC LIMIT 10";
	$req = $bdd->prepare($q);
  $req->execute([
		$_GET['convo'],
		$_GET['date'],
		$_SESSION['id']
]);
}


else{

	$q = "SELECT content,user,time FROM message WHERE convo = ? ORDER BY time DESC LIMIT 10";
	$req = $bdd->prepare($q);
	$req->execute([$_GET['convo']]);
	$result = $req->fetchAll(PDO::FETCH_ASSOC);

	$q ="UPDATE message SET readed = '0' WHERE convo = ? AND user <> ? ORDER BY TIME DESC LIMIT 10";
	$req = $bdd->prepare($q);
	$req->execute([
		$_GET['convo'],
		$_SESSION['id']
]);

}



  echo json_encode($result);
  ?>
