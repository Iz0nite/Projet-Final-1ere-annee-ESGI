<?php
    //use PHPMailer\PHPMailer\PHPMailer;
        $name = "Antoine";
        $email = "Antoine.lorin2@gmail.com";
        $subject = "Sujet";
        $body = "Message";

        require_once "Import/PHPMailer/PHPMailer.php";
        require_once "Import/PHPMailer/SMTP.php";
        require_once "Import/PHPMailer/Exception.php";

        $mail = new PHPMailer(true);

        //SMTP Settings
        $mail->isSMTP();
        $mail->Host = "smtp.gmail.com";
        $mail->SMTPAuth = true;
        $mail->Username = "antoine.lorin.1s1@gmail.com";
        $mail->Password = '4SicnJPe24JP';
        $mail->Port = 465; //587
        $mail->SMTPSecure = "ssl"; //tls

        //Email Settings
        $mail->isHTML(true);
        $mail->setFrom($email, $name);
        $mail->addAddress(address: "antoine.lorin.1s1@gmail.com");
        $mail->Subject = $subject;
        $mail->Body = $body;

        if ($mail->send()) {
            $status = "success";
            $response = "Email is sent!";
        } else {
            $status = "failed";
            $response = "Something is wrong: <br><br>" . $mail->ErrorInfo;
        }


?>
