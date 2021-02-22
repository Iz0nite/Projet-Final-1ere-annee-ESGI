<?php
	require("config.php");
	include('Include/maintain_session.php');


	if (isset($_SESSION['user'])){


	 if ($_SESSION['user'] === 'admin'){

		  $q = 'SELECT id FROM post WHERE title = ? ';
		  $response = $bdd->prepare($q);
		  $response->execute([$_POST['title']]);
		  $result = $response->fetchAll(PDO::FETCH_ASSOC);

		  if (count($result) >= 1){
		    header('location: events.php?Erreur=Titre déja pris');
		    exit();
		  }

		  $req = $bdd->prepare('INSERT INTO post(title,content,description,type) VALUES(?,?,?,?)');

		  $req->execute(array(
		  	htmlspecialchars($_POST['title']),
		  	htmlspecialchars($_POST['content']),
				htmlspecialchars($_POST['link']),
				'event'
		  ));

		header('location: events.php');
		}
}
