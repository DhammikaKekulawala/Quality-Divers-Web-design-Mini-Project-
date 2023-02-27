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



	$query = "SELECT * FROM comment ";


$users= mysqli_query($connection, $query);

verify_query($users);

	while($user = mysqli_fetch_assoc($users)){
		$user_list .= "<tr>";
		$user_list .= "<td>{$user['name']}</td>";
		$user_list .= "<td>{$user['product_name']}</td>";
		$user_list .= "<td>{$user['comment']}</td>";
		$user_list .= "<td style = 'text-align: center'><a href=\"comment-delete.php?id={$user['id']}\" onclick =\"return confirm('are you sure?');\" class='delete'>Delete</a></td>";
		$user_list .= "</tr>";
	}

?>
<!DOCTYPE html>
<html>
<head>
<title>Comment Details</title>
<link rel="stylesheet" href="css/main.css">
</head>
<body>
  <header>
    <div class="appname"><a href="admin.php">Admin Panel </a></div>
    <div class="loggedin"> Welcome <?php echo $_SESSION['first_name']; ?> !
	<a href="logout.php"> Log Out </a></div> 
  </header>
  <main>
 <h1>Comment Details</h1><br>
 <br>
 <br>
</form>
</div>

 
 
 <table class="masterlist" border="2">
  <tr>
      <th> Name</th>
	  <th>Product Name</th>
	  <th>Comment</th>
	  <th>Delete</th>
  </tr>
  <?php echo $user_list; ?>
 </main>
</body>

</html>