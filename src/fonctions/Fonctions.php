<?php
    namespace App\fonctions;
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    class Fonctions{
        public function email($objet, $body, $id, $mdp){
        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);
        try {
            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.hostinger.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = $id;                     //SMTP username
            $mail->Password   = $mdp;                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;          //Enable implicit TLS encryption
            $mail->Port       = 465;                                  //port serveur SMTP  
            //Recipients
            //mail d'envoi
            $mail->setFrom('mathieu@adrardev.fr', 'Mailer');
            //mail de reception
            $mail->addAddress('mathieu.mith@laposte.net'); 
            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = $objet;
            $mail->Body    = $body;
            //envoi du mail
            $mail->send();
            echo 'Message has been sent';
            //erreur (Exeption)
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        }
    }
?>