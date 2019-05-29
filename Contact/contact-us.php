<?php

$result = "";
require 'class.mail.php';
$mail_db = new Mail();


if(isset($_POST['submit'])){
    /**require 'PHPMailer/PHPMailerAutoload.php';
    $mail = new PHPMailer;
    $mail->isSMTP();
    $mail->Host='smtp.gmail.com';
    $mail->Port=587;
    $mail->SMTPAuth=true;
    $mail->SMTPSecure='tls';
    $mail->Username='parkme.kavindaperera@gmail.com';
    $mail->Password='Parkme@2019';

    $mail->setFrom($_POST['mail'],$_POST['name']);
    $mail->addAddress('parkme.kavindaperera@gmail.com');
    $mail->addReplyTo($_POST['mail'],$_POST['name']);

    $mail->isHTML(true);
    $mail->Subject='Form Submission: '.$_POST['subject'];
    $mail->Body='<h1 align=center>Name'.$_POST['name'].'<br>Email: '.$_POST['mail'].'<br>Message: '.$_POST['message'].'</h1>';
    */

    $save = $mail_db->save_mail($_POST['name'],$_POST['mail'],$_POST['phone'],$_POST['message']);
    if ($save) {
			// Registration Success
		//	echo 'Registration successful <a href="login.php">Click here</a> to login';
				header("location:../index.php");;
			} else {
			// Registration Failed
			echo 'Something went wrong';
			}
    /*
    if(!$mail->send()){
        $result="Something went wrong";
    }else{
        $result="Thank you ".$_POST['name']." for contacting us.We'll get back to you soon!";   
    }*/
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Contact Form</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="../assets/css/contact-style.css">
	
	<link rel='stylesheet' href='http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>
	<link rel="icon" href="../assets/graphics/app-icon-transparent.png">
</head>
<div class="container">  
  <form id="contact" action="contact-us.php" method="post">
    <h3>Contact Form</h3>
    <h4><?= $result; ?></h4>
    <fieldset>
      <input name="name" placeholder="Your name" type="text" tabindex="1" required autofocus>
    </fieldset>
    <fieldset>
      <input name="mail" placeholder="Your Email Address" type="email" tabindex="2" required>
    </fieldset>
    <fieldset>
      <input name="phone" placeholder="Your Phone Number (optional) format: 012-345-6789" type="tel" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" required>
    </fieldset>
    <fieldset>
      <input name="subject" placeholder="Subject" type="text" tabindex="4" required>
    </fieldset>
    <fieldset>
      <textarea name="message" placeholder="Type your message here...." type="message" tabindex="5" required></textarea>
    </fieldset>
    <fieldset>
      <button name="submit" type="submit" id="contact-submit" data-submit="...Sending">Submit</button>
      <label for="#contact-submit"></label>
    </fieldset>
    <fieldset>
    <a href="../Interface/home_afterlogin.php">Back</a>
    </fieldset>
    
  </form>
</div>