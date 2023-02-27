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
		$user_list .= "<td><a href=\"product-modify.php?product_id={$user['product_id']}\" class='edit'>Edit</a></td>";
		$user_list .= "<td><a href=\"product-delete.php?product_id={$user['product_id']}\" onclick =\"return confirm('are you sure?');\" class='delete'>Delete</a></td>";
		$user_list .= "</tr>";
	}

?>
<!DOCTYPE html>
<html>
<head>
<title>Product Details</title>
<link rel="stylesheet" href="css/main.css">
</head>
<body>
  <header>
    <div class="appname"><a href="admin.php">Admin Panel </a></div>
    <div class="loggedin"> Welcome <?php echo $_SESSION['first_name']; ?> !
	<a href="logout.php"> Log Out </a></div> 
  </header>
  <main> <br>
 <h1>Product Details<span></h1><br>
 <br>
 <h3><a href="product-add.php" class="add">Add New Product</a></span></h3>
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
	  <th>Edit</th>
	  <th>Delete</th>
  </tr>
  <?php echo $user_list; ?>
  </table>
  <div class="backto"> </div>
 </main>
</body>

</html>