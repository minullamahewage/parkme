<!DOCTYPE html>
<html lang="en">
<head>
	<title>Contact Form</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="assets/css/contact-style.css">
	
	<link rel='stylesheet' href='http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>
	<link rel="icon" href="assets/img/app-icon-transparent.png">
</head>
<div class="container">  
  <form id="contact" action="contactform.php" method="post">
    <h3>Contact Form</h3>
    <h4></h4>
    <fieldset>
      <input name="name" placeholder="Your name" type="text" tabindex="1" required autofocus>
    </fieldset>
    <fieldset>
      <input name="mail" placeholder="Your Email Address" type="email" tabindex="2" required>
    </fieldset>
    <fieldset>
      <input name="phone" placeholder="Your Phone Number (optional)" type="tel" tabindex="3" required>
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
    <a href="home_afterlogin.php">Back</a>
    </fieldset>
    
  </form>
</div>