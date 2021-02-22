<?php
	require("config.php");


//Verification de la disponibilité du Titre

  $q = 'SELECT id FROM post WHERE title = ? ';
	$response = $bdd->prepare($q);
	$response->execute([$_POST['title']]);
	$result = $response->fetchAll();

	if (count($result) >= 1){
		header('location: new_post.php?Erreur=Titre déja pris');
		exit();
	}



//Modification des valeurs de l'image
	$file_dst = 'Images_user/';
	$img_name = $_FILES['img']['name'];
	$img_name_tmp = $_FILES['img']['tmp_name'];
	$img_size = $_FILES['img']['size'];
	$img_type =  $_FILES['img']['type'];



	// if (!is_uploaded_file($img_name_tmp)) {
	// 	header('location: new_post.php?Erreur=Image introuvable');
	// 	exit();
	// }


//Vérification de la taille de l'image

	// if ($img_size>250000) {
	// 	header('location: new_post.php?Erreur=Fichier trop volumineux');
	// 	exit();
	// }

	$acceptable = [
		'image/jpeg',
		'image/jpg',
		'image/png',
		'image/gif'
	];


	// if(!in_array($img_type,$acceptable)){
	// 	header('location:new_post.php?Erreur=CE fichier n\' est pas une image');
	// 	exit;
	// }


	 move_uploaded_file($img_name_tmp ,$file_dst.$img_name);






if (!isset($_POST['description'])){
	$description = 'Description Nulle';
}



//MISE EN BASE DE DONNéES LE POST / EVENT
	$req = $bdd->prepare('INSERT INTO post(title,content,user_id,description,view,type,category_id,difficulty) VALUES(?,?,?,?,?,?,?,?)');

	$req->execute(array(
		htmlspecialchars($_POST['title']),
		htmlspecialchars($_POST['content']),
		htmlspecialchars($_POST['id']),
		htmlspecialchars($description),
		'0',
		'Poste',
		'12',
		'4'

	));
	echo 'AH';
	echo $_POST['title'];
	echo $file_dst.$img_name;

	$id_img = $bdd->lastInsertId();

	$req = $bdd->prepare('INSERT INTO file(path,title,post_id,type) VALUES(?,?,?,?)');
	 $req->execute(array(
		 htmlspecialchars($file_dst.$img_name),
		 htmlspecialchars($_POST['title']),
		 $id_img,
		 'post'

 ));

  header('Location:index.php');
  exit();

  ?>
