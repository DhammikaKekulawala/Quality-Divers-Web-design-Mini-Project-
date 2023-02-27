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


if(isset($_GET['user_id'])){
		
		$user_id = mysqli_real_escape_string($connection,$_GET['user_id']) ;
	
	$query = "SELECT * FROM orders WHERE user_id = {$user_id} AND is_deleted = 0 ";



$users= mysqli_query($connection, $query);

verify_query($users);

	while($user = mysqli_fetch_assoc($users)){
		$user_list .= "<tr>";
		$user_list .= "<td>{$user['boat_towed_meta']}</td>";
		$user_list .= "<td>{$user['accessories']}</td>";
		$user_list .= "<td>{$user['brush_kart']}</td>";
		$user_list .= "<td>{$user['hand_held_metal']}</td>";
		$user_list .= "<td>{$user['hydraulic_power']}</td>";
		$user_list .= "<td>{$user['mini_brush_kart']}</td>";
		$user_list .= "<td>{$user['pali_bilgesafe']}</td>";
		$user_list .= "<td>{$user['pingers_and_pin']}</td>";
		$user_list .= "<td>{$user['protable_cabin']}</td>"; 
		$user_list .= "<td>{$user['remote_operated']}</td>";
		$user_list .= "<td>{$user['sonar_systems']}</td>";
		$user_list .= "<td>{$user['underwate_came']}</td>";
		$user_list .= "<td>{$user['total_prices']}</td>";
		$user_list .= "</tr>";
	}
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Product Order Details</title>
<link rel="stylesheet" href="css/main.css">
</head>
<body>
  <header>
    <div class="appname"><a href="worker.php">Worker Panel </a></div>
    <div class="loggedin"> Welcome <?php echo $_SESSION['first_name']; ?> !
	<a href="logout.php"> Log Out </a></div> 
  </header>
  <main>
 <h1>Product Order</h1><br>
 <br>

 <?php
 if(isset($_GET['user_id'])){
		
		$user_id = mysqli_real_escape_string($connection,$_GET['user_id']) ;
	
	$query = "SELECT * FROM orders WHERE user_id = {$user_id} AND is_deleted = 0 ";



$users= mysqli_query($connection, $query);
 
 $user = mysqli_fetch_assoc($users);
  
  if(!empty($user['id'])){
echo "<table class='masterlist' border='2'>
  <tr>
      <th>Boat Towed Meta</th>
	  <th>Accessories</th>
	  <th>Brush Kart</th>
	  <th>Hand Held Metal</th>
	  <th>Hydraulic Power</th>
      <th>Mini Brush Kart</th>
      <th>Pali BilgeSafe</th>
	  <th>Pingers And Pin</th>
	  <th>Portable Cabin</th>
	  <th>Remote Operated</th>
	  <th>Sonar Systems</th>
	  <th>Underwater Came</th>
	  <th>Total(Rs.)</th>
  </tr>";
  }else{
	  echo"<h1>Data not Entered</h1>";
  }
 }
  ?>
  <?php echo $user_list; ?>
  </table>
  <br>
  <div class="backto"><a href="display-users.php">Back </a></div>
  <br>
 </main>
</body>

</html>