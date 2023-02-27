<?php

$servername="localhost";
$username="root";
$password="";
$database="diver";
  

$conn=mysqli_connect($servername,$username,$password,$database);

if(!$conn){
	die("Connection Failed: ".mysqli_connect_error());
}
else {
	echo "Connection Successfull";
}


$email = mysqli_real_escape_string($conn, $_POST['email']);
$msg = mysqli_real_escape_string($conn, $_POST['msg']);

$is_insert = "INSERT INTO `contact`(`E-mail`, `Message`, `Is_Delete`) VALUES ('$email','$msg','0')";

if (mysqli_query($conn, $is_insert)== TRUE){
	echo "<script>alert('Details Added');window.location.href='contactus.php';</script>";
}else{
	echo "Error: " .$is_insert ."<br>". mysqli_error($conn);
} 

mysqli_close($conn);

?>

