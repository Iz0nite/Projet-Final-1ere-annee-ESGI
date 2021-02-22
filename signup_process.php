<?php
	require("config.php");
	session_start();
	$q = 'SELECT id FROM user WHERE email = ? ';
	$response = $bdd->prepare($q);
	$response->execute([$_POST['email']]);
	$result = $response->fetchAll();

	if (count($result) >= 1){
		header('location: signup.php?Erreur=Email existante');
		exit();
	}

	$q = 'SELECT id FROM user WHERE nickname = ? ';
	$response = $bdd->prepare($q);
	$response->execute([$_POST['pseudo']]);
	$result = $response->fetchAll();

	if (count($result) >= 1){
		header('location: signup.php?Erreur=Pseudo existant');
		exit();
	}

if (strlen($_POST['password']) <5 || strlen($_POST['password'])>35){

	header('location:signup.php?Erreur=Mot de Passe invalide');
	exit();
}

if ($_POST['password'] != $_POST['passwordConfirmation']){

	header('location:signup.php?Erreur=Mot de Passe différent');
	exit();
}

if (strlen($_POST['name']) <5 || strlen($_POST['name'])>35){

	header('location: signup.php?Erreur=Nom Invalide');
	exit();
}
if (!isset($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    header('location: signup.php?Erreur=Email invalide');
	exit();
}

function genererChaineAleatoire($longueur = 10)
{
 $caracteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
 $longueurMax = strlen($caracteres);
 $chaineAleatoire = '';
 for ($i = 0; $i < $longueur; $i++)
 {
 $chaineAleatoire .= $caracteres[rand(0, $longueurMax - 1)];
 }
 return $chaineAleatoire;
}

$mail_id = genererChaineAleatoire(20);

$req = $bdd->prepare('INSERT INTO user(nickname,email,password,name,second_name,country,birth,email_cert,email_id,type) VALUES(?,?,?,?,?,?,?,?,?,?)');

$req->execute(array(
	htmlspecialchars($_POST['pseudo']),
	htmlspecialchars($_POST['email']),
	hash($hash, $_POST['password']),
	htmlspecialchars($_POST['name']),
	htmlspecialchars($_POST['secondName']),
	htmlspecialchars($_POST['location']),
	htmlspecialchars($_POST['birth']),
	'1',
	$mail_id,
	'user'
));
$_SESSION['id'] = $bdd->lastInsertId();
//SEND A MAIL TO CONFIRM
use PHPMailer\PHPMailer\PHPMailer;

require 'Import/PHPMailer/PHPMailer.php';
require 'Import/PHPMailer/Exception.php';

$mail = new PHPMailer;
$mail->isSendmail();
$mail->setFrom('noreply@lafabriqueatout.ovh', 'DIY forum');
$mail->addAddress($_POST['email'], $_POST['name'].' '.$_POST['secondName']);
$mail->Subject = 'Confirmer inscription';
$mail->isHTML(true);
$mail->Body = '<h1>Veuillez confirmer</h1><br/>
<p>
Merci pour votre inscription sur notre forum '.$_POST['name'].'
Pour finaliser votre inscription veuillez cliquer sur le lien ci-dessous.
</p>
<a href="https://webcode.jeedomlorin.ovh/verif.php?id='.$mail_id.'" >Lien du site</a>';
//Attach an image file
//$mail->addAttachment('images/phpmailer_mini.png');

//send the message, check for errors
if (!$mail->send()) {
		echo 'Mailer Error: '. $mail->ErrorInfo;
} else {
		echo 'Message sent damn!';
}


header('Location:index.php?msg=Vous êtes bien inscrit');
exit();

?>
