<?php
	require('config.php');
	include('Include/maintain_session.php');

$q ='SELECT id_convo FROM convo_assoc WHERE id_user = ? ';
$req = $bdd->prepare($q);
$req->execute([
	$_SESSION['id']
]);
$results = $req->fetchAll(PDO::FETCH_ASSOC);
echo $_POST['id_convo'];
$verif=0;
foreach ($results as $key => $value) {
	if($value['id_convo'] == $_POST['id_convo']){
		$verif = 1;
	}
}


if ($verif==1){


	$q='SELECT id_user from convo_assoc WHERE id_user <> ? AND id_convo = ?';
	$req = $bdd->prepare($q);
	$req->execute([
		$_SESSION['id'],
		$_POST['id_convo']
]);
	$id_receive = $req->fetch(PDO::FETCH_ASSOC);



  $q = "INSERT INTO message(content,user,convo,receive_user) VALUES (?,?,?,?)";
  $req = $bdd->prepare($q);
  $req->execute([
    htmlspecialchars($_POST['content']),
    $_SESSION['id'],
    $_POST['id_convo'],
		$id_receive['id_user']
  ]);

	$q ="UPDATE convo SET last_mess = ? WHERE id = ?";
	$req = $bdd->prepare($q);
	$req->execute([
		date('Y-m-d H:i:s'),
		$_POST['id_convo']
	]);


  echo 'ok';

	}
