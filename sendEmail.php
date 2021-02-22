<?php

    use PHPMailer\PHPMailer\PHPMailer;

    require 'Import/PHPMailer/PHPMailer.php';
    require 'Import/PHPMailer/Exception.php';

    $mail = new PHPMailer;
    $mail->isSendmail();
    $mail->setFrom('noreply@Jeedomlorin.ovh', 'DIY forum');
    $mail->addAddress('antoine.lorin.2@gmail.com', 'Antoine Lorin2');
    $mail->Subject = 'Confirmer inscription';
    $mail->Body = 'Veuillez cliquer sur ce lien pour confirmer votre Inscription sur notre site';
    //Attach an image file
    //$mail->addAttachment('images/phpmailer_mini.png');

    //send the message, check for errors
    if (!$mail->send()) {
        echo 'Mailer Error: '. $mail->ErrorInfo;
    } else {
        echo 'Message sent damn!';
    }
?>
