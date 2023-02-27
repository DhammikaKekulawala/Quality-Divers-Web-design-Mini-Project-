<?php session_start(); ?>
<?php require_once('inc/connection.php');?>
<?php require_once('inc/function.php');?>
<?php
//checking if a user is logged in 
if(!isset($_SESSION['user_id'])){
	header('Location: index.php');
}
$user_list ='';




	$query = "SELECT * FROM product  WHERE is_deleted=0  ORDER BY product_name";



$users= mysqli_query($connection, $query);

verify_query($users);

	while($user = mysqli_fetch_assoc($users)){
		$user_list .= "<tr>";
		$user_list .= "<td>{$user['product_name']}</td>";
		$user_list .= "<td>{$user['product_prices']}</td>";
		$user_list .= "<td>{$user['product_brand']}</td>";
		$user_list .= "<td>{$user['description']}</td>";
		$user_list .= "<td>{$user['store']}</td>"; 
		$user_list .= "<td>{$user['made_in']}</td>";
		$user_list .= "<td>{$user['manufactured_by']}</td>";
		$user_list .= "<td><img src='product/".$user['image']." ' class='image'> </td>";
		$user_list .= "</tr>";
	}

?>
<!DOCTYPE html>
<html>
<head>
<title>Project Details</title>
<link rel="stylesheet" href="css/main.css">
</head>
<body>
  <header>
    <div class="appname"><a href="worker.php">Worker Panel </a></div>
    <div class="loggedin"> Welcome <?php echo $_SESSION['first_name']; ?> !
	<a href="logout.php"> Log Out </a></div> 
  </header>
  <main>
 <h1>Product Details<span></h1><br>
 <br>
 <table class="masterlist" border="2">
  <tr>
      <th>Product Name</th>
	  <th>Product Prices</th>
	  <th>Product Brand</th>
	  <th>Description</th>
	  <th>Store</th>
      <th>Made In</th>
      <th>Manufactured By</th>
	  <th>Photo</th>
  </tr>
  <?php echo $user_list; ?>
 </main>
</body>

</html>