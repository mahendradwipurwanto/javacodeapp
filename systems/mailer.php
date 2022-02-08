<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function mailer($data)
{

//Create an instance; passing `true` enables exceptions
  $mail = new PHPMailer(true);

  try {

    // SMTP configuration
    $mail->isSMTP();

    $mail->SMTPOptions = array(
      'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
      )
    );
    
    // $mail->SMTPDebug      = 1;
    $mail->SMTPAuth = true;
    $mail->SMTPKeepAlive = true;
    $mail->SMTPSecure = "ssl";
    $mail->Port = 465;
    $mail->Host = "smtp.gmail.com";
    $mail->Username = "cs.terrafl@gmail.com";
    $mail->Password = "terrafl2021";

    $mail->setFrom("javacodeapp@gmail.com", "javacodeapp - Support");
    $mail->addReplyTo("javacodeapp@gmail.com", "javacodeapp - Support");

    // Add a recipient
    $mail->addAddress($data['to']);

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = $data['subject'];
    $mail->Body = $data['message'];

    $mail->send();
    return 'Message has been sent';
  } catch (Exception $e) {
    return "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
  }
}

?>