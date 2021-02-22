<?php
 require("config.php");
 session_start();


$img_type=$_FILES['profil_picture']['type'];
$acceptable = [
  'image/jpeg',
  'image/jpg',
  'image/png',
  'image/gif'
];

if(!in_array($img_type,$acceptable)){
	header('location:profil.php?Erreur=CE fichier n\' est pas une image');
	exit;
}

$maxsize=1024*1024; // 1mo
if($_FILES['profil_picture']['size']>$maxsize){
	header('location: profil.php?Erreur=trop gros');
	exit;
}

$picture_name=$_FILES['profil_picture']['name'];
$temp=explode('.',$picture_name);
$extension=end($temp);
$picture_name='image-profile-'.$_SESSION['id'].'.'.$extension;
$path ='Images_profil/'.$picture_name;

move_uploaded_file($_FILES['profil_picture']['tmp_name'],$path);


$req = $bdd->prepare("SELECT id FROM file WHERE title = ?");
$req->execute([$picture_name]);
$result = $req->fetchAll(PDO::FETCH_ASSOC);



if (count($result)==0){
    $req = $bdd->prepare("INSERT INTO file(path,title,type) VALUES (?,?,?)");
    $req->execute(array(
     htmlspecialchars($path),
     htmlspecialchars($picture_name),
     'img_profil'
    ));

    $req = $bdd->prepare("SELECT id FROM file WHERE title = ?");
    $req->execute([$picture_name]);
    $result = $req->fetchAll(PDO::FETCH_ASSOC);


    $id_img =  $result[0]["id"];

     $req2 = $bdd->prepare("UPDATE user SET profile_picture = ? WHERE id = ?");
     $req2->execute(array(
       $result[0]["id"],
       $_SESSION['id']
     ));
     echo 'DAMN';

}
else{


  $req = $bdd->prepare("SELECT profile_picture,nickname FROM user WHERE id = ?");
  $req->execute([$_SESSION['id']]);
  $result = $req->fetch();


  $req = $bdd->prepare("UPDATE file SET path = ? where id = ?");

  $req->execute(array(
   htmlspecialchars($path),
   htmlspecialchars($result[0])


  ));

}



header('Location:profil.php?user='.$result['nickname']);


 ?>
