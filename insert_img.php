<?php
require('config.php');
session_start();

echo $_POST['id'];




  $acceptable = [
		'image/jpeg',
		'image/jpg',
		'image/png',
		'image/gif'
	];

foreach ($_FILES['myFiles']['tmp_name'] as $key => $value) {
  echo $_FILES['myFiles']['tmp_name'][$key];

  //Modification des valeurs de l'image
  	$file_dst = 'Images_user/';
  	$img_name = $_FILES['myFiles']['name'][$key];
  	$img_name_tmp = $_FILES['myFiles']['tmp_name'][$key];
  	$img_size = $_FILES['myFiles']['size'][$key];
  	$img_type =  $_FILES['myFiles']['type'][$key];


  move_uploaded_file($img_name_tmp ,$file_dst.$img_name);

  $req = $bdd->prepare('INSERT INTO file(path,title,post_id,type,order_img) VALUES(?,?,?,?,?)');
  $req->execute(array(
    htmlspecialchars($file_dst.$img_name),
    htmlspecialchars($img_name),
    $_POST['id'],
    'post',
    $_POST['myNames'][$key]

));


}
 ?>
