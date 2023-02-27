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
	 $user_list .= "<td><a href=\"modify-vessels.php?vessels_id={$user['vessels_id']}\"class='edit'>Edit</a></td>";
	$user_list .= "<td><a href=\"vessels_delete.php?vessels_id={$user['vessels_id']}\" onclick =\"return confirm('are you sure?');\" class='delete'>Delete</a></td>";
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
    <div class="appname"><a href="admin.php">Admin Panel </a></div>
    <div class="loggedin"> Welcome <?php echo $_SESSION['first_name']; ?> !
	<a href="logout.php"> Log Out </a></div> 
  </header>
  <main><br>
 <h1>Vessels Details</h1><br>
 <br>
 <h3> <a href="vessels_add.php" class="add">Add Vessels</a></h3>
 <br>
 <br>
<div class="search">
<form action="vessels.php" method="get">

</form>
</div>

 
 
 <table class="masterlist" border="2">
  <tr>
      <th>Vessels Name</th>
	  <th>Length Overall</th>
	  <th>Photo</th>
	  <th>speed</th>
	  <th>Bollard Pall</th>
      <th>Breadth</th>
	  <th>Edit</th>
	  <th>Delete</th>
  </tr>
  <?php echo $user_list; ?>
 </main>
</body>

</html>