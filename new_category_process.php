<?php
require('config.php');
session_start();


$q = 'SELECT id FROM category WHERE name = ? ';
$response = $bdd->prepare($q);
$response->execute([$_POST['title']]);
$result = $response->fetchAll();

if (count($result) >= 1){
  header('location: Backoffice.php?Erreur=Nom de catégorie déjà pris');
  exit();
}

echo  $_FILES["img"]["tmp_name"];
if ( is_uploaded_file( $_FILES["img"]["tmp_name"] )){

  $file_dst = 'Images_user/';
  $img_name = $_FILES['img']['name'];
  $img_name_tmp = $_FILES['img']['tmp_name'];
  $img_size = $_FILES['img']['size'];
  $img_type =  $_FILES['img']['type'];

  $acceptable = [
    'image/jpeg',
    'image/jpg',
    'image/png',
    'image/gif'
  ];

  	 move_uploaded_file($img_name_tmp ,$file_dst.$img_name);

     $req = $bdd->prepare('INSERT INTO file(path,title,type) VALUES(?,?,?)');
      $response = $req->execute(array(
        htmlspecialchars($file_dst.$img_name),
        htmlspecialchars($img_name),
        'category',

    ));

    $id_img = $bdd->lastInsertId();








  $req = $bdd->prepare('INSERT INTO category(name,description,img_id) VALUES(?,?,?)');



	$req->execute(array(
		htmlspecialchars($_POST['title']),
		htmlspecialchars($_POST['description']),
    $id_img


	));
}

  header('Location: Backoffice.php');

 ?>
