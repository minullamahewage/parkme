<?php

if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $mailFrom = $_POST['mail'];
    $phone = $_POST['phone'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    $mailTo = "170446L@uom.lk";

    $headers = "From: ".$mailFrom;
    $txt = "You have recieved an emil from ".$name.".\n\n".$message;

    mail($mailTo, $subject, $txt, $headers);
    header("Location: contact-us.php?mailsend".$mailTo);

}

?>