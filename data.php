<?php session_start(); ?>
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
if(!isset($_SESSION['user_id'])){
  header('Location: index.php');
}

 $user_id=$_SESSION['user_id'];

$firstname = mysqli_real_escape_string($conn, $_POST['first_name']);
$lastname = mysqli_real_escape_string($conn, $_POST['last_name']);
$company = mysqli_real_escape_string($conn, $_POST['company']);
$shipname = mysqli_real_escape_string($conn, $_POST['ship_name']);
$shipid = mysqli_real_escape_string($conn, $_POST['ship_id']);
$length = mysqli_real_escape_string($conn, $_POST['length']);
$width = mysqli_real_escape_string($conn, $_POST['width']);
$height = mysqli_real_escape_string($conn, $_POST['height']);
$country = mysqli_real_escape_string($conn, $_POST['country']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$areacode = mysqli_real_escape_string($conn, $_POST['area_code']);
$phone = mysqli_real_escape_string($conn, $_POST['phone']);

/*Adding check box values to the database*/


$a = isset($_POST['Under_Water'])? implode(',',$_POST['Under_Water']) : '';
$b = isset($_POST['Above_Water'])? implode(',',$_POST['Above_Water']): '';

$other = mysqli_real_escape_string($conn, $_POST['other']);


$sql = "INSERT INTO `service`(`user_id`,`First_Name`, `Last_Name`, `Company`, `Ship_Name`, `Ship_ID`, `Length`, `Width`, `Height`, `Country`, `E-mail`, `Area_Code`, `Phone`, `Under_Water`, `Above_Water`, `Other`, `Is_Delete`) VALUES ('$user_id','$firstname','$lastname','$company','$shipname','$shipid','$length','$width','$height','$country','$email','$areacode','$phone','$a','$b','$other','0')";


if (mysqli_query($conn, $sql) === TRUE){
	echo "<script>alert('Details Added');window.location.href='user.php';</script>";
}else{
	echo "Error: " .$sql ."<br>". mysqli_error($conn);
} 






mysqli_close($conn);

?>