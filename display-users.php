<?php session_start(); ?>
<?php require_once('inc/connection.php');?>
<?php require_once('inc/function.php');?>
<?php
//checking if a user is logged in 
if(!isset($_SESSION['user_id'])){
	header('Location: index.php');
}
$user_list ='';
$search ='';


if(isset($_GET['search'])){

   //searching bar	
	$search= mysqli_real_escape_string($connection, $_GET['search']);
	$query = "SELECT * FROM user  WHERE first_name LIKE '%{$search}%' OR last_name LIKE '%{$search}%' OR email LIKE '%{$search}%' AND is_delete=0 ORDER BY first_name";
}else{
	//getting the list of users
	$query = "SELECT * FROM user  WHERE is_delete=0 AND type=2 ORDER BY first_name";
}

$users= mysqli_query($connection, $query);

verify_query($users);

	while($user = mysqli_fetch_assoc($users)){
		$user_list .= "<tr>";
		$user_list .= "<td>{$user['first_name']}</td>";
		$user_list .= "<td>{$user['last_name']}</td>";
		$user_list .= "<td>{$user['email']}</td>";
		$user_list .= "<td>{$user['last_login']}</td>";
		$user_list .= "<td style = 'text-align: center'><a href=\"ship-worker.php?user_id={$user['id']}\" class='edituser'>Registration Ship </a></td>";
		$user_list .= "<td style = 'text-align: center'><a href=\"services_worker.php?user_id={$user['id']}\" class='edituser'>Services </a></td>";
        $user_list .= "<td style = 'text-align: center'><a href=\"worker_order.php?user_id={$user['id']}\" class='edituser'>product Order </a></td>";
		$user_list .= "<td style = 'text-align: center'><a href=\"payment_worker.php?user_id={$user['id']}\" class='edituser'>Payment Details</a></td>";
		$user_list .= "</tr>";
	}

?>
<!DOCTYPE html>
<html>
<head>
<title>users</title>
<link rel="stylesheet" href="css/main.css">
</head>
<body>
  <header>
    <div class="appname"><a href ="worker.php">Worker Panel</a></div>
    <div class="loggedin"> Welcome <?php echo $_SESSION['first_name']; ?> !
	<a href="logout.php"> Log Out </a></div> 
  </header>
  <main><br>
 <h1>User Details</h1>
 <br>
<div class="search">
<br>
<form action="display-users.php" method="get">
<p>
     <input type ="text" name="search"  id="" placeholder="Type First Name, Last Name or Email Address and press Enter"value="<?php echo $search; ?>" required autofocus>
</form>
<h3><a href="display-users.php" class="add">Refresh</a></h3>
<br>
</div>

 
 <table class="masterlist" border="2">
  <tr>
      <th>First Name</th>
	  <th>Last Name</th>
	  <th>Email</th>
	  <th>Last Login</th>
	  <th>Ship Details</th>
	  <th>Services</th>
	  <th>Order Details</th>
	  <th>Payment Details</th>
	 
	
  </tr>
  <?php echo $user_list; ?>
 </main>
</body>

</html>