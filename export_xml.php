<?php
require('config.php');
include('Include/maintain_session.php');

$q ='SELECT id,nickname,name,second_name,email,country,birth,type FROM user';
$req = $bdd->query($q);
$result = $req->fetchAll(PDO::FETCH_ASSOC);

//var_dump($result);

$xml = new DomDocument();
  $xml->encoding = 'utf-8';
  $xml->xmlVersion = '1.0';
  $xml->formatOutput = true;


$all = $xml->createElement('users');

foreach ($result as $key => $value) {
  $user = $xml->createElement('user');

  foreach ($value as $key => $innervalue) {

    $att = new DOMAttr($key,$innervalue);
    $user->appendChild($att);
  }

  $all->appendChild($user);
}



$xml->appendChild($all);




//echo "<xmp>".$xml->saveXML()."</xmp>";
if (!is_writable('/var/www/members.xml')){
  //echo 'ANOP';
}

$xml->save("/var/www/members.xml") or die ("Erreur de sauvegarde");

use PHPMailer\PHPMailer\PHPMailer;

require 'Import/PHPMailer/PHPMailer.php';
require 'Import/PHPMailer/Exception.php';

$mail = new PHPMailer;
$mail->isSendmail();
$mail->setFrom('noreply@lafabriqueatout.ovh', 'DIY forum');
$mail->addAddress('antoine.lorin2@gmail.com', 'Admin');
$mail->Subject = 'EXPORT XML';
$mail->isHTML(true);
$mail->Body = "<h1>Voici le fichier xml</h1><br/>
<p>
Voici l'export demandé.
</p>
<h2>L'export est en pièce jointe !</h2>
";
$mail->addAttachment('/var/www/members.xml');

//send the message, check for errors
if (!$mail->send()) {
		//echo 'Mailer Error: '. $mail->ErrorInfo;
} else {
		echo 'ok';
}



exit();

?>
