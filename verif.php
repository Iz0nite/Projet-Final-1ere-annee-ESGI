<?php
require('config.php');


if (isset($_GET['id'])){

  $q= 'SELECT ID FROM user WHERE email_id = ? ';
  $req= $bdd->prepare($q);
  $req->execute([$_GET['id']]);
  $results= $req->fetchAll();


  if (count($results)==1){
    $q= 'UPDATE user SET email_cert = 0 WHERE id = ? ';
    $req= $bdd->prepare($q);
    $req->execute([$results[0][0]]);

    $response = 'Votre compte à bien été confirmé';
  }
  else{
    $response = "Nous n'avons pas pu confirmer votre mail";
  }

}




 ?>

 <!DOCTYPE html>
 <html>
 	<head>
 		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
 		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
 		<meta name="Desciption" content="Ceci est la page d'accueil">
 		<link rel="stylesheet" type="text/css" href="Style/Style1.css">
 		<link rel="stylesheet" type="text/css" href="Style/Style_header.css" />
 		<title>Accueil</title>
 	</head>
 	<body>
    <?php include('Include/header.php');

     ?>

       <div class="centerDiv" >
         <?php echo '<h1>'.$response.'</h1>';?>
       </div>



  </body>
  </html>
