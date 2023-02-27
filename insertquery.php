<?php require_once('inc/connection.php');?>
<?php
$first_name   = 'sandeepa';
$last_name    = 'madubashana';
$email        = 'kv.sandeepamadubashna@gmail.com';
$address      = '11/3,Sri gnanendra Road,Rathmalana';
$phone_number = '94712991405';
$type         = 0;
$password     = 'sandeepa12';
$is_delete    = 0;

$hashed_password = sha1($password);

$query = "INSERT INTO user (first_name, last_name, email, address, phone_number, type, password, is_delete) VALUES('{$first_name}', '{$last_name}', '{$email}','{$address}','{$phone_number}','{$type}', '{$hashed_password}', {$is_delete})";

$result = mysqli_query($connection, $query);

if($result){
	echo "1 Record added";
}else{
	echo"Database query failed.";
}

?>
<!DOCTYPE html>
<html>
<head>
<title>Insert Query</title>
</head>
<body>



</body>

</html>
<?php mysqli_close($connection); ?>