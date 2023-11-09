<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
//Load Composer's autoloader
require __DIR_ROOT__ . '/public/lib/vendor/autoload.php';
class SendMailModel
{
    function sendMail($usermail, $username, $title, $body)
    {
        $status = false;
        $mail = new PHPMailer(true);
        $mail->Debugoutput = 'error_log';
        $mail->CharSet = 'UTF-8';
        $mail->Encoding = 'base64';
        $mail->setLanguage('vi', __DIR_ROOT__ . '/public/lib/vendor/phpmailer/phpmailer/language/phpmailer.lang-vi.php');
        try {
            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;    
                              //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'camtinlqd123@gmail.com';                     //SMTP username
            $mail->Password   = 'fzefvczieneyoqrg';                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom('camtinlqd123@gmail.com', 'BookShop BMT');
            $mail->addAddress($usermail, $username);     //Add a recipient
            $mail->addReplyTo('camtinlqd123@gmail.com', 'BookShop BMT');

            //Attachments
            // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
            // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = $title;
            $mail->Body    = $body;
            $mail->AltBody = 'Vui lòng liên hệ camtinlqd123@gmail.com';

            $mail->send();
            $status = true;
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
        return $status;
    }
}
?>