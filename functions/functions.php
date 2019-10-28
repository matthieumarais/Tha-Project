<?php
function sendMail($from, $to, $content, $subject)
{
    if (!empty($to)) {
        // MAIL
        require_once __DIR__ . '/../mail/PHPMailerAutoload.php';

    $mail = new PHPMailer;
        $mail->isSMTP();
        $mail->CharSet = 'UTF-8';
        $mail->SMTPDebug = 0;
        $mail->Debugoutput = 'html';
        $mail->Host = '****';
        $mail->Port = 587;
        $mail->SMTPSecure = 'tls';
        $mail->SMTPAuth = true;
        $mail->Username = '****';
	    $mail->Password = '****';
        $mail->addReplyTo($from, 'Wisdom V Academy');
        $mail->setFrom($from, 'Wisdom V Academy');
        $mail->addAddress($to, 'Wisdom V Academy');

        $mail->Subject = $subject;
        $mail->msgHTML($content);
        $mail->AltBody = $content;

        if (!$mail->send()) {
            //echo "Mailer Error: " . $mail->ErrorInfo;
            $return = "Une erreur s'est produite pendant l'envoi du mail";
        } else {
            $return = "Votre message a bien été envoyé";
        }
    } else {
        $return = "to empty";
    }

    return $return;
}

function makeGet($value)
{

    $return = array();

    $gets = explode('?', $value);
    if (!empty($gets[1])) {
        $gets = $gets[1];
        $gets = explode('&', $gets);

        foreach ($gets as $get) {
            $get = explode('=', $get);

            $return[$get[0]] = $get[1];
            $_GET[$get[0]] = urldecode($get[1]);
        }
    }

    return $return;

}

