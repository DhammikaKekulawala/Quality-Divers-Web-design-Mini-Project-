<?php session_start(); ?>
<?php require_once('inc/connection.php');?>
<?php require_once('inc/function.php');?>
<?php
//checking if a user is logged in 
if(!isset($_SESSION['user_id'])){
	header('Location: index.php');
}
$user_list ='';
if(isset($_GET['user_id'])){
		//getting the user information
		$user_id = mysqli_real_escape_string($connection,$_GET['user_id'] );


	$query = "SELECT * FROM payment  WHERE is_delete=0 AND user_id= '$user_id' ORDER BY name";



$users= mysqli_query($connection, $query);

verify_query($users);

	while($user = mysqli_fetch_assoc($users)){
		$user_list .= "<tr>";
		$user_list .= "<td>{$user['name']}</td>";
		$user_list .= "<td>{$user['last_name']}</td>";
		$user_list .= "<td>{$user['email']}</td>";
		$user_list .= "<td>{$user['pay']}</td>";
		$user_list .= "<td>{$user['number']}</td>"; 
		$user_list .= "<td>{$user['cvv']}</td>";
		$user_list .= "<td>{$user['month']}</td>";
		$user_list .= "<td>{$user['Year']}</td>";
		$user_list .= "<td>{$user['payments']}</td>";
		$user_list .= "<td><a href=\"payment-delete.php?id={$user['id']}\" onclick =\"return confirm('are you sure?');\" class='delete'>Delete</a></td>";
		$user_list .= "</tr>";
	}
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Payments Details</title>
<link rel="stylesheet" href="css/main.css">
</head>
<body>
  <header>
    <div class="appname"><a href="admin.php">Admin Panel</a></div>
    <div class="loggedin"> Welcome <?php echo $_SESSION['first_name']; ?> !
	<a href="logout.php"> Log Out </a></div> 
  </header>
  <main>
  <br>
 <h1>Payments Details</h1><br>
 <br>
 
 <?php
 if(isset($_GET['user_id'])){
		//getting the user information
		$user_id = mysqli_real_escape_string($connection,$_GET['user_id'] );


	$query = "SELECT * FROM payment  WHERE is_delete=0 AND user_id= '$user_id' ORDER BY name";



$users= mysqli_query($connection, $query);

 $user = mysqli_fetch_assoc($users);
 
 if(!empty($user['id'])){
 echo"<table class='masterlist' border='2'>
  <tr>
      <th>First Name</th>
	  <th>Last Name</th>
	  <th>Email</th>
	  <th>Card Type</th>
	  <th>Card Number</th>
      <th>CVV</th>
      <th>Expered Month</th>
	  <th>Expered Year</th>
	  <th>Payments</th>
	  <th>Delete</th>
 </tr>";
 }else{
	 echo"<h1>Data not Entered</h1>";
 }
 }
  ?>
  <?php echo $user_list; ?>
  </table>
  <br>
  <?php echo"<div class='backto'><a href='users_details.php'> Back </a></div>"; ?>
  <br>
 </main>
</body>

</html>