<?php session_start(); ?>
<?php require_once('inc/connection.php');?>
<?php require_once('inc/function.php');?>
<?php

$user_list='';


$query = "SELECT * FROM vessels WHERE is_deleted=0 ORDER BY vessels_name";

$users= mysqli_query($connection, $query);

verify_query($users);

	while($user = mysqli_fetch_assoc($users)){
	   $user_list .="<tr>";
	   $user_list .="<td rowspan='5'><img src='vesselsimages/".$user['image']." ' class='image'> </td>";
	   $user_list .="<td>Name </td>";
	   $user_list .="<td>{$user['vessels_name']}</td>";
	   $user_list .="</tr>";
	   $user_list .="<tr>";
	   $user_list .="<td>Length overall:</td>";
	   $user_list .="<td>{$user['length_overall']}</td>";
	   $user_list .="</tr>";
	   $user_list .="<tr>";
	   $user_list .="<td>Breadth:</td>";
	   $user_list .="<td>{$user['breadth']}</td>";
	   $user_list .="</tr>";
	   $user_list .="<tr>";
	   $user_list .="<td>Speed:</td>";
	   $user_list .="<td>{$user['speed']}</td>";
	   $user_list .="</tr>";
	   $user_list .="<tr>";
	   $user_list .="<td>Bollard pull:</td>";
	   $user_list .="<td>{$user['bollard_pall']}</td>";
	   $user_list .="</tr>";
	   $user_list .="<tr>";
	   $user_list .="</tr>";
	   $user_list .="<tr>";
	   $user_list .="</tr>";
	   
	
	}
?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
<title>Our Vessels</title>
<link rel="stylesheet" href="css/main1.css">
<style>
.vessels1 { 
	  display: none;
	  margin-left:25%;  
}
@media screen and (max-width: 1100px) {
	.vessels { display: none }
	.vessels1 { display: block }
	.vessels1 img { width:500px; height:400px; }
}
@media screen and (max-width: 800px) {
	.vessels { display: none }
	.vessels1 { display: block; width:100%; padding-left:0px; margin-left:10%; }
	
}
@media screen and (max-width: 600px) {
	.vessels { display: none }
	.vessels1 { display: block }
	.vessels1 {  width:100%; margin-left:0px; padding-left:0px; }
	.vessels1 .image { width: 100%; height:250px }
	
}	
</style>
</head>
<body>
<?php 
 require_once('header.php');?>
 <div class="cont">
 
 <div class="vessels">
 <table class="" >
  <tr>
      <th colspan="3">Our Vessels</th>
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
  </div>
 </div>
 
 <?php

$user_l='';

$query = "SELECT * FROM vessels WHERE is_deleted=0 ORDER BY vessels_name";

$users= mysqli_query($connection, $query);

verify_query($users);

	while($user = mysqli_fetch_assoc($users)){
	   $user_l .="<tr>";
	   $user_l .="<td colspan='2'><img src='vesselsimages/".$user['image']." ' class='image'> </td>";
	   $user_l .="</tr>";
	   $user_l .="<tr>";
	   $user_l .="<td>Name </td>";
	   $user_l .="<td>{$user['vessels_name']}</td>";
	   $user_l .="</tr>";
	   $user_l .="<tr>";
	   $user_l .="<td>Length overall:</td>";
	   $user_l .="<td>{$user['length_overall']}</td>";
	   $user_l .="</tr>";
	   $user_l .="<tr>";
	   $user_l .="<td>Breadth:</td>";
	   $user_l .="<td>{$user['breadth']}</td>";
	   $user_l .="</tr>";
	   $user_l .="<tr>";
	   $user_l .="<td>Speed:</td>";
	   $user_l .="<td>{$user['speed']}</td>";
	   $user_l .="</tr>";
	   $user_l .="<tr>";
	   $user_l .="<td>Bollard pull:</td>";
	   $user_l .="<td>{$user['bollard_pall']}</td>";
	   $user_l .="</tr>";
	   $user_l .="<tr>";
	   $user_l .="</tr>";
	   $user_l .="<tr>";
	   $user_l .= "<td><br></td>";
	   $user_l .="</tr>";
	   $user_l .="<tr>";
	   $user_l .="</tr>";
	   
	
}
	?>
	 <div class="cont">
 
 <div class="vessels1">
 <table class="" >
  <tr>
      <th colspan="3">Our Vessels</th>
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
  
  <?php echo $user_l; ?>
  </table>
  </div>
 </div>

<?php 
 require_once('footer.php');?>
</body>

</html>