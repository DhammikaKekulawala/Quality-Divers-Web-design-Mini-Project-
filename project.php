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
	$query = "SELECT * FROM project  WHERE ( ship_name LIKE '%{$search}%' OR registration_id LIKE '%{$search}%' OR country LIKE '%{$search}%' ) AND is_delete=0 ORDER BY ship_name";
}else{
	//getting the list of users
	$query = "SELECT * FROM project  WHERE is_delete=0  ORDER BY ship_name";
}


$users= mysqli_query($connection, $query);

verify_query($users);

	while($user = mysqli_fetch_assoc($users)){
		$user_list .= "<tr>";
		$user_list .= "<td>{$user['ship_name']}</td>";
		$user_list .= "<td>{$user['registration_id']}</td>";
		$user_list .= "<td><img src='images/".$user['image']." ' class='image'> </td>";
		$user_list .= "<td>{$user['country']}</td>";
		$user_list .= "<td>{$user['type']}</td>"; 
		$user_list .= "<td>{$user['job_description']}</td>";
		$user_list .= "<td>{$user['other']}</td>";
		$user_list .= "<td><a href=\"modify-project.php?registration_id={$user['registration_id']}\" class='edit'>Edit</a></td>";
		$user_list .= "<td><a href=\"project_delete.php?registration_id={$user['registration_id']}\" onclick =\"return confirm('are you sure?');\" class='delete'>Delete</a></td>";
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
    <div class="appname"><a href="admin.php">Admin Panel </a></div>
    <div class="loggedin"> Welcome <?php echo $_SESSION['first_name']; ?> !
	<a href="logout.php"> Log Out </a></div> 
  </header>
  <main>
 <h1>Projects Details</h1><br>
 <br>
<div class="search">
<form action="project.php" method="get">
<p>
     <input type ="text" name="search"  id="" placeholder="Type Ship Name,Registration id or country and press Enter"value="<?php echo $search; ?>" required autofocus>
     <h3><span><a href="project_add.php" class="add"> + Add New Project</a> <a href="project.php" class="add">Refresh</a></span></h3>
 
</p>
</form>
</div>

 
 
 <table class="masterlist" border="2">
  <tr>
      <th>Ship Name</th>
	  <th>Registration</th>
	  <th>Photo</th>
	  <th>Country</th>
	  <th>Ship Type</th>
      <th>Job Description</th>
      <th>Other</th>
	  <th>Edit</th>
	  <th>Delete</th>
  </tr>
  <?php echo $user_list; ?>
 </main>
</body>

</html>