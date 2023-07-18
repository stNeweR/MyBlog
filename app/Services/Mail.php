<?php

namespace App\Services;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Mail {
    public static function send_mail(array $settings, string $to, string $subjects, string $body, string $attachments)
    {
        $mail = new PHPMailer(true);

        try {
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;
            $mail->isSMTP();
            $mail->Host = $settings['host'];
            $mail->SMTPAuth = $settings['auth'];
            $mail->Username = $settings['username'];
            $mail->Password = $settings['password'];
            $mail->SMTPSecure = $settings['secure'];
            $mail->Port = $settings['port'];
            $mail->CharSet = $settings['charset'];

            //Recipients
            $mail->setFrom($settings['from_email'], $settings['from_name']);
            $mail->addAddress($to);     //Add a recipient
//            $mail->addAddress('ellen@example.com');               //Name is optional
//            $mail->addReplyTo('info@example.com', 'Information');
//            $mail->addCC('cc@example.com');
//            $mail->addBCC('bcc@example.com');

            //Attachments
//            $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
//            $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

            if ($attachments) {
                $mail->addAttachment($attachments);
            }

            //Content
            $mail->isHTML($settings['is_html']);                                  //Set email format to HTML
            $mail->Subject = $subjects;
            $mail->Body = $body;
//            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            return $mail->send();
//            echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}
