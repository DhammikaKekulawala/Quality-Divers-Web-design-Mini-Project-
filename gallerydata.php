<?php

$servername="localhost";
$username="root";
$password="";
$database="diver";
  
$connection=mysqli_connect($servername,$username,$password,$database);

if(!$connection){
	die("Connection Failed: ".mysqli_connect_error());
}
else {
	echo "Connection Successfull";
}

$title = mysqli_real_escape_string($connection, $_POST['title']);
$file_name = $_FILES['image']['name'];
$temp_name = $_FILES['image']['tmp_name'];
$upload_to = 'gallery/';
$file_uploaded = move_uploaded_file($temp_name, $upload_to . $file_name);


$is_insert = "INSERT INTO `gal`(`Title`, `Image`, `Is_Delete`) VALUES ('$title','$file_name',0)";

if (mysqli_query($connection, $is_insert)== TRUE){
	echo "<script>alert('Details Added');window.location.href='gallery.php';</script>";
}else{
	echo "Error: " .$is_insert ."<br>". mysqli_error($connection);
} 

mysqli_close($connection);
?>