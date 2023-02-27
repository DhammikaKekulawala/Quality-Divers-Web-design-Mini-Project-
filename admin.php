<?php session_start(); ?>
<?php require_once('inc/connection.php');?>
<?php require_once('inc/function.php');?>
<?php
//checking if a user is logged in 
if(!isset($_SESSION['user_id'])){
	header('Location: index.php');
	$image = '';
}
$user_id=$_SESSION['user_id'];
$query = "SELECT * FROM user  WHERE is_delete=0 AND id=$user_id ORDER BY first_name";
 



$users= mysqli_query($connection, $query);

verify_query($users);

	$user = mysqli_fetch_assoc($users);
	$image = "<img src='profile/".$user['profile']. "'>";
	
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
<title>Admin</title>

<link rel="stylesheet" href="css/main.css">
<style>
      h1{
      	font-size:40px;
      }
      h2{
      	font-size:35px;
      }
      img {
        float: left;
        width:300px;
        height:300px;
        margin: 0px 0px 15px 20px;
      }
      p{
      	font-size:24px;
      }
      main{
      	width:1000px;
      	margin-left:24%;
      	
      }
	  .sidenavmin { 
	  display: none;
	  }
	  .menupro { 
	  display: none;
	  }
	 .menu { padding: 0px; background: #ddd; width: 100%; }
     .sidenavmin ul li { width: 90%; display: block; }
     .sidenavmin ul li a { width: 90%; padding: 20px; border-bottom: 1px solid #ddd; }
	  
	 @media screen and (max-width: 1500px) {
       .side { display: none }
     }		 
	  
	@media screen and (max-width: 1250px) {
	.sidenavmin { width: 100%; }
	.sidenavmin { display: block }
	.menupro { display: block }
	 .sidenav { display: none }
	 .side { display: none }
	 .p1 { display: none }
	 main{ display:none}
    }
	
	.sidenavmin #myLinks {
       display: none;
     }
	 .menu{
        
         text-align: left;
         text-decoration: none;
         display: inline-block;
		 padding:20px;
	 }
	 .menu1{
		 
		 background-color:#ddd;
		 margin-left:0px;
         border-style:groove;
		 border-color: white;
         text-align: center;
         text-decoration: none;
         display: inline-block;
	 }
	 .menupro{
		 background-color:white;
	 }
	 
</style>
</head>
<body style="background-color:#e6ffe6;">
  <header>
    <div class="appname">Admin panel</div>
    <div class="loggedin"> Welcome <?php echo $_SESSION['first_name']; ?> !
	<a href="logout.php"> Log Out </a></div> 
  </header>
  <br>
 <div class="all"> 
	<div class="sidenav">
			<br>
			<h2>Menu</h2>
			<br>
			<br>
			<a href="worker_details.php">Employee Details</a>
			<br>
			<a href="users_details.php">User Details</a>
			<br>
			<a href="vessels.php">Vessels</a>
			<br>
			<a href="product.php">Products</a>
			<br>
			<a href="project.php">Projects</a>
			<br>
			<a href="product-comment.php">Comments</a>
			<br>
			<a href="viewcontact.php">Contact us</a>
			<br>
			<a href="gallery.php">Gallery</a>
      </div>
        <div class="sidenavmin">
		<br>
		 <a href="#" class="menu" onclick="myFunction()"> ☰  Menu</a>
		<br>
		<div id="myLinks">
		    <ul>
					<li><a href="worker_details.php" class="menu1">Employee Details</a></li>
					<li><a href="users_details.php" class="menu1">User Details</a></li>
					<li><a href="vessels.php" class="menu1">Vessels</a></li>
					<li><a href="product.php" class="menu1">Products</a></li>
					<li><a href="project.php" class="menu1">Projects</a></li>
					<li><a href="product-comment.php" class="menu1">Comments</a></li>
					<li><a href="viewcontact.php" class="menu1">Contact Us</a></li>
					<li><a href="gallery.php" class="menu1">Gallery</a></li>
				</ul>
				</div>
			<br>
      </div>
	  <script>
		function myFunction() {
		var x = document.getElementById("myLinks");
		if (x.style.display === "block") {
			x.style.display = "none";
		} else {
			x.style.display = "block";
		}
		}
		</script>
		<div class="side">
		  <br>
		  <h2> Last Login</h2>
		   <br>
		  <p><?php echo $user['last_login']; ?></p>
		  
     </div>
     <main>
		<div class="p1">
		      <br>
		      <h1>My Profile</h1>
		      <br>
		      
		      <p><?php echo " $image ";  //data form akata genima sadaha?>
		      <br>
		      &nbsp &nbsp <b><big> <?php echo $user['first_name']; ?>&nbsp &nbsp <?php echo $user['last_name']; ?></b></big><br><br>
		      &nbsp &nbsp Email &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp: <?php echo $user['email']; ?><br><br>
		      &nbsp &nbsp Contact No. &nbsp &nbsp &nbsp: <?php echo $user['phone_number']; ?><br><br>
		      &nbsp &nbsp Address &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp: <?php echo $user['address']; ?><br><br>
		      &nbsp &nbsp <a href="modify-admin.php?user_id=<?php echo$user['id']; ?>" class="password"> Change Profile </a></p>
			  
		      </main>
			  
		</div>
		<div class="menupro">
		
		   <p><?php echo " $image"; ?>
		   <br>
		   &nbsp &nbsp <b><big> <?php echo $user['first_name']; ?>&nbsp &nbsp <?php echo $user['last_name']; ?></b></big><br><br>
		      Email &nbsp &nbsp &nbsp &nbsp &nbsp  : <?php echo $user['email']; ?><br><br>
		      Contact No. : <?php echo $user['phone_number']; ?><br><br>
		      Address &nbsp &nbsp &nbsp : <?php echo $user['address']; ?><br><br>
		      &nbsp &nbsp <a href="modify-admin.php?user_id=<?php echo$user['id']; ?>"> Change Profile </a>
			  <br><br></p>
		   
		 
		</div>
 </div>
</body>

</html>