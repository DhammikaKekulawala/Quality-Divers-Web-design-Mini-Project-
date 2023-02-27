<?php session_start(); ?>
<?php require_once('inc/connection.php');?>
<?php require_once('inc/function.php');?>
<?php
$user_list ='';
if(!isset($_SESSION['user_id'])){
  header('Location: index.php');
}
$query = "SELECT * FROM vessels WHERE is_deleted=0 ORDER BY vessels_name";
$users= mysqli_query($connection, $query);
verify_query($users);

	while($user = mysqli_fetch_assoc($users)){
	 $user_list .="<tr>";
	 $user_list .="<td>{$user['vessels_name']}</td>";
	 $user_list .="<td>{$user['length_overall']}</td>";
	 $user_list .="<td><img src='vesselsimages/".$user['image']." ' class='image'> </td>";
	 $user_list .="<td>{$user['speed']}</td>";
	 $user_list .="<td>{$user['bollard_pall']}</td>";
	 $user_list .="<td>{$user['breadth']}</td>";
	 $user_list .="</tr>";
	 
	
	
	}
?>

<!DOCTYPE html>
<html>
<head>
<title>Vessels Details</title>
<link rel="stylesheet" href="css/main.css">
</head>
<body>
  <header>
    <div class="appname"><a href="worker.php">Worker Panel </a></div>
    <div class="loggedin"> Welcome <?php echo $_SESSION['first_name']; ?> !
	<a href="logout.php"> Log Out </a></div> 
  </header>
  <main><br>
 <h1>Vessels Details</h1><br><br>
<div class="search">
<form action="vessels.php" method="get">

</form>
</div>

 
 
 <table class="masterlist" border="2">
  <tr>
      <th>Vessels Name</th>
	  <th>Length Overall</th>
	  <th>Photo</th>
	  <th>Speed</th>
	  <th>Bollard Pall</th>
      <th>Breadth</th>
  </tr>
  <?php echo $user_list; ?>
 </main>
</body>

</html>