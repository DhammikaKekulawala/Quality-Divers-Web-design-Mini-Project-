<?php

if(isset($_POST[reset-request-submit])){
    
    $selector = bin2hex(random_bytes(8));
    $token = random_bytes(32);


    $url = "www.drive.net/forgottenpswd/create-new-password.php?selector=" . $selector . "&validator=" .bin2hex($token);
    $expires=date("U") + 1800;

    require 'connection.php';

    $userEmail = $_POST["email"];

    $sql ="DELETE FROM pwdReset WHERE pwdResertEmail=?";
    $stmt = mysqli_stmt_init($connection);
    if(!mysqli_stmt_prepare($stmt, $sql)){
       echo"There was an error!";
       exit();
    }else{
    	mysqli_stmt_bind_param($stmt, "s", $userEmail);
    	mysqli_stmt_execute($stmt);
    }


   $sql ="INSERT INTO pwdReset (pwdResertEmail, pwdResetSelector, pwdResetToken, pwdResetExpires ) VALUES (?,?,?,?);";

    $stmt = mysqli_stmt_init($connection);
    if(!mysqli_stmt_prepare($stmt, $sql)){
       echo"There was an error!";
       exit();
    }else{
    	$hashedToken = password_hash($token, PASSWORD_DEFAULT);
    	mysqli_stmt_bind_param($stmt, "ssss", $userEmail, $selector,$hashedToken,  $expires);
    	mysqli_stmt_execute($stmt);
    }

    mysqli_stmt_close($stmt);
    mysqli_close();

    $to = $userEmail;

    $subject = 'Reset your password for mmtuts';

    $message = '<p> we receieved a</p>';
    $message .= '<p> Here is your password reset link:</br>';
    $message .= '<a href="' . $url.'">'.$url.'</a></p>';


    $headers ="From: mmtuts <usemmtuts@gmail.com\r\n";
    $headers .= "Reply-to:usemmtuts@gmail.com\r\n";
    $headers .= "Content-type: text/html\r\n";

    mail($to, $subject, $message, $headers);

    header("Location: ../reset-password.php?reset=success");

}else{
	header("Location:../index.php");
}

?>