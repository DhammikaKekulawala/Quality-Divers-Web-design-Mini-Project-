<?php session_start(); ?>
<?php require_once('inc/connection.php');?>
<?php require_once('inc/function.php');?>
<?php
//checking if a user is logged in 
if(!isset($_SESSION['user_id'])){
	header('Location: index.php');
}
?>
<?php
$user_list ='';


$query = "SELECT * FROM product  WHERE is_deleted=0  ORDER BY product_name";

$users= mysqli_query($connection, $query);

verify_query($users);

if($users);
	
			if(mysqli_num_rows($users) == 1){
				//user found
				$result = mysqli_fetch_assoc($users);
				$product_name = $result['product_name'];
				$product_id = $result['product_id'];
				$product_prices = $result['product_prices'];
			 }

	while($user = mysqli_fetch_assoc($users)){
		$user_list .= "<tr>";
		$user_list .= "<td rowspan='7'><img src='product/".$user['image']. "' class='image'> </td>";
		$user_list .= "<td>Prodect name</td>";
		$user_list .= "<td>{$user['product_name']}</td>";
		$user_list .= "<td></td>";
		$user_list .= "<td><form action='product-modify.php'  method='post'></td>";
		$user_list .= "</tr>";
		$user_list .= "<tr>";
		$user_list .= "<td>Prodect prices</td>";
		$user_list .= "<td>{$user['product_prices']}</td>";
		$user_list .= "<td></td>";
		$user_list .= "<td><input type ='hidden' name='product_id' value='{$user['product_id']}'></td>";
		$user_list .= "</tr>";
        $user_list .= "<tr>";
        $user_list .= "<td>Prodect brand</td>";
		$user_list .= "<td>{$user['product_brand']}</td>";
		$user_list .= "<td></td>";
		$user_list .= "<td><input type ='hidden' name='product_name' value=' {$user['product_name']}'></td>";
		$user_list .= "</tr>";
        $user_list .= "<tr>";
        $user_list .= "<td>Description</td>";
		$user_list .= "<td>{$user['description']}</td>";
		$user_list .= "<td></td>";
		$user_list .= "<td><input type ='hidden' name='order'></td>";
		$user_list .= "</tr>";
        $user_list .= "<tr>";
        $user_list .= "<td>Store</td>";
		$user_list .= "<td>{$user['store']}</td>";
		$user_list .= "<td></td>";
		$user_list .= "<td><input type ='hidden' name='product_prices' value='{$user['product_prices']}'></td>";
		$user_list .= "</tr>";
        $user_list .= "<tr>";
        $user_list .= "<td>Made in</td>";
		$user_list .= "<td>{$user['made_in']}</td>";
		$user_list .= "<td></td>";
		$user_list .= "<td rowspan='2'><a href='product-order.php' class='link'>Buy Now</a></td>";
		$user_list .= "</tr>";
		 $user_list .= "<tr>";
        $user_list .= "<td>Manufactured by</td>";
		$user_list .= "<td>{$user['manufactured_by']}</td>";
		$user_list .= "<td></td>";
		$user_list .= "</tr>";
		$user_list .= "<tr>";
        $user_list .= "<td><br><hr></td>";
		$user_list .= "<td><br><hr></td>";
		$user_list .= "<td><br><hr></td>";
		$user_list .= "<td><br><hr></td>";
		$user_list .= "<td><br><hr></td>";
		$user_list .= "</tr>";
		
	}

?>
<!DOCTYPE html>
<html>
<head>
<title>Products Details</title>
<link rel="stylesheet" href="css/main1.css">
<style>
*{
	 background:#8080ff ; 
}
.link{
  background-color: #f44336;
  color: white;
  padding: 15px 25px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
}

 .link {
  background-color: red;
}
header{
	background-color: yellow;
	overflow: auto;
	padding: 10px;
	color:black;
	
}
 header .appname{
	 float: left;
	 background-color: yellow;
}
header .loggedin{
	float: right;
	 background-color: yellow;

}
.log{
	 background-color: yellow;
}
.comment{
  background-color: #f44336;
  color: white;
  padding: 15px 25px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  background-color: red;
  width:500px;
  margin-left:500px;
  
}
.productusemin { 
	  display: none;
        
}
@media screen and (max-width: 1200px) {
	.productuse { display: none }
	.productusemin	{ display: block; margin-left:20%; }
	.comment {margin-left:0px; width:250px;}
}	
@media screen and (max-width: 600px) {
	.productuse { display: none }
	.productusemin	{ display: block }
	.productusemin	{ margin-left:0px }
	 .productusemin .image {width:100%;}
}	

</style>
</head>
<body>
<header>
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <div ><a href="user.php" class="appname">User Panel</a></div>
    <div class="loggedin"> Welcome <?php echo $_SESSION['first_name']; ?> !
	<a href="logout.php" class="log"> Log Out </a></div> 
  </header>
  
 <div class="productuse">
 <br>
 <form method="post">
 <table class="masterlist" >
  <tr>
      <th colspan="3">Our products</th>
  </tr>
  <tr>
  </tr>
  <tr>
  </tr>
  <tr>
  </tr>
  <tr>
  </tr>
  <tr>
  </tr>
  <?php echo $user_list; ?>
 </table>
 <a href="comment.php"  class="comment" width="400px;">Comment page</a>
 </form>
</div>
<?php
$user_list1 ='';


$query = "SELECT * FROM product  WHERE is_deleted=0  ORDER BY product_name";

$users= mysqli_query($connection, $query);

verify_query($users);

if($users);
	
			if(mysqli_num_rows($users) == 1){
				//user found
				$result = mysqli_fetch_assoc($users);
				$product_name = $result['product_name'];
				$product_id = $result['product_id'];
				$product_prices = $result['product_prices'];
			 }

	while($user = mysqli_fetch_assoc($users)){
		$user_list1 .= "<tr>";
		$user_list1 .= "<td colspan='2'><img src='product/".$user['image']. "' class='image'> </td>";
		$user_list1 .= "</tr>";
		$user_list1 .= "<tr>";
		$user_list1 .= "<td>Prodect name</td>";
		$user_list1 .= "<td>{$user['product_name']}</td>";
		$user_list1 .= "<td></td>";
		$user_list1 .= "<td><form action='product-modify.php'  method='post'></td>";
		$user_list1 .= "</tr>";
		$user_list1 .= "<tr>";
		$user_list1 .= "<td>Prodect prices</td>";
		$user_list1 .= "<td>{$user['product_prices']}</td>";
		$user_list1 .= "<td></td>";
		$user_list1 .= "<td><input type ='hidden' name='product_id' value='{$user['product_id']}'></td>";
		$user_list1 .= "</tr>";
        $user_list1 .= "<tr>";
        $user_list1 .= "<td>Prodect brand</td>";
		$user_list1 .= "<td>{$user['product_brand']}</td>";
		$user_list1 .= "<td></td>";
		$user_list1 .= "<td><input type ='hidden' name='product_name' value=' {$user['product_name']}'></td>";
		$user_list1 .= "</tr>";
        $user_list1 .= "<tr>";
        $user_list1 .= "<td>Description</td>";
		$user_list1 .= "<td>{$user['description']}</td>";
		$user_list1 .= "<td></td>";
		$user_list1 .= "<td><input type ='hidden' name='order'></td>";
		$user_list1 .= "</tr>";
        $user_list1 .= "<tr>";
        $user_list1 .= "<td>Store</td>";
		$user_list1 .= "<td>{$user['store']}</td>";
		$user_list1 .= "<td></td>";
		$user_list1 .= "<td><input type ='hidden' name='product_prices' value='{$user['product_prices']}'></td>";
		$user_list1 .= "</tr>";
        $user_list1 .= "<tr>";
        $user_list1 .= "<td>Made in</td>";
		$user_list1 .= "<td>{$user['made_in']}</td>";
		$user_list1 .= "<td></td>";
		$user_list1 .= "</tr>";
		$user_list1 .= "<tr>";
        $user_list1 .= "<td>Manufactured by</td>";
		$user_list1 .= "<td>{$user['manufactured_by']}</td>";
		$user_list1 .= "<td></td>";
		$user_list1 .= "</tr>";
		$user_list1 .= "<tr>";
		$user_list1 .= "<td colspan='2'><a href='product-order.php' class='link'>Buy Now</a></td>";
		$user_list1 .= "<tr>";
        $user_list1 .= "<td><br><hr></td>";
		$user_list1 .= "<td><br><hr></td>";
		$user_list1 .= "<td><br><hr></td>";
		$user_list1 .= "<td><br><hr></td>";
		$user_list1 .= "<td><br><hr></td>";
		$user_list1 .= "</tr>";
		
	}

?>
<div class="productusemin">
 <br>
 <form method="post">
 <table class="masterlist" >
  <tr>
      <th colspan="3">Our products</th>
  </tr>
  <tr>
  </tr>
  <tr>
  <td><br></td>
  </tr>
  <tr>
  </tr>
  <tr>
  </tr>
  <tr>
  </tr>
  <?php echo $user_list1; ?>
 </table>
 <a href="comment.php"  class="comment" width="400px;">Comment page</a>
 </form>
</div>
</body>

</html>