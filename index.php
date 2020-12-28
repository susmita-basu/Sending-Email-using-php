<?php
$err_msg = "";
if(isset($_POST['sub']) and $_POST['sub']){

    ///////// validating at server side //////////////
	if(isset($_POST['email']) and $_POST['email']==""){
		$err_msg = $err_msg."Email not Provided<br />";
	}
	if(isset($_POST['subject']) and $_POST['subject']==""){
		$err_msg = $err_msg."Subject not Provided<br />";
	}
	if(isset($_POST['body']) and $_POST['body']==""){
		$err_msg = $err_msg."Body not Provided<br />";
	}

    //////// db connection ///////////////
	if(!$err_msg){
		require_once('db.php');
		$to_email = mysqli_real_escape_string($con,$_POST['email']);
		$subject = mysqli_real_escape_string($con,$_POST['subject']);
		$body = mysqli_real_escape_string($con,$_POST['body']);
        $sql = "INSERT INTO `sendmail`(`id`, `sendto`, `subject`, `body`) VALUES (NULL,'$to_email','$subject','$body')";
		$res = mysqli_query($con,$sql);
		if(mysqli_affected_rows($con)>0){
			echo 'Record Inserted<br>';
		}else{
			echo 'Record Not Inserted<br>';
		}
		
	}

////////////// Sending Email //////////////////////////

    $to_email = $_POST['email'];
    $subject = $_POST['subject'];
    $body = $_POST['body'];
    $headers = "From : susmitabasumallick07@gmail.com";

    if (mail($to_email, $subject, $body, $headers)) {
        echo "Email successfully sent.<br>";
    } else {
        echo "Email not sent.<br>";
    }


    //print_r($_POST);
}






?>










<!DOCTYPE html>
<html>
<head>
<title>Email</title>
</head>
<body>
    <h1>Send Email</h1>
    <form method="post">
        <label for="email">Email</label><br>
        <input type="email" id="email" name="email" value=""><br><br>
        <label for="subject">Subject</label><br>
        <input type="text" id="subject" name="subject" value=""><br><br>
        <label for="body">Body</label><br>
        <textarea id="body" name="body" rows="4" cols="50"></textarea><br><br>
        <input type="submit" name="sub" value="Send Email">
</body>
</html>