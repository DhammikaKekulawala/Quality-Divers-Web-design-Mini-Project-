<?php session_start(); ?>
<?php require_once('inc/connection.php');?>
<?php require_once('inc/function.php');?>

  
<?php
require_once('mail.php');

$mail_send = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   $email = $_POST['email'];
   
   $existingUser = mysqli_query($connection, "SELECT * FROM user where email = '".$email."'");
   
   if(mysqli_num_rows($existingUser) == 1){
	  $user = mysqli_fetch_assoc($existingUser);
	  sendMail($user['email'],$user['first_name'],$user['id']);
	  $mail_send = true;
	  
   }
   
}




?>
 
   
  
<!DOCTYPE html>
<html> 
<head>
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
<title>Log In -User Management System</title>
<link rel="stylesheet" href="css/main.css">
</head>
<body style="background-image: url('IMG_7343-1024x760.png'); background-size:cover;background-attachment: fixed;">
<div class="reset">
    <form  method="post">
	<h1 class="h1">Resert password</h1>
	<br><br>
	<?php if($mail_send){?>
	<strong style='color:red';>Please check your inbox<strong>
	<?php } ?>
	
   
	    <h3>Enter your email.<br> We received mail and link</h3><br>
    	<p><input type="text" name="email"  class="inre" placeholder="Enter your e-mail address..."></p>
		<p>
        <lable for="">&nbsp</lable>
    	<button type="submit" class="submit">Receive new password by email</button></p>
		<br>


    </form>
       <?php
         if(isset($_GET["reset"])){
         	if($_GET["reset"] == "success"){
         		echo'<p clas="signpsuccess">Check your e-mail</p>';
         	}
         }

       ?>
</div>
</body>

</html>
<?php mysqli_close($connection); ?>