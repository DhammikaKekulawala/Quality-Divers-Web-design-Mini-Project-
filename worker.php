<?php session_start(); ?>
<?php require_once('inc/connection.php');?>
<?php require_once('inc/function.php');?>
<?php
//checking if a user is logged in 
if(!isset($_SESSION['user_id'])){
	header('Location: index.php');
	$image = '';
	$user_id = '';
	
}
$user_id=$_SESSION['user_id'];
$query = "SELECT * FROM user  WHERE is_delete=0 AND id=$user_id ORDER BY first_name";
 



$users= mysqli_query($connection, $query);

verify_query($users);

	$user = mysqli_fetch_assoc($users);
	$image = "<img src='profile/".$user['profile']. "'>";
?>
<?php
if(isset($_POST['submit'])){
	$user_id = $_POST['user_id'];
	
	$file_name = $_FILES['image']['name'];
           $temp_name = $_FILES['image']['tmp_name'];
            //photo direction
		   $upload_to = 'profile/';
            $file_uploaded = move_uploaded_file($temp_name, $upload_to . $file_name);
            $target = "profile/".basename($file_name);
	
	       $query = "UPDATE user SET";
			$query .=" profile='{$file_name}'";
			$query .="WHERE id ={$user_id} LIMIT 1";
			
			
			
			$result = mysqli_query($connection,$query);
			
			if($result){
				//query sucessful... redirecting to users page
				header('Location: worker.php?user_modified=true');
				
			}else{
				$errors[] ='Failed to add the modify record';
			}
}

?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
<title>worker</title>
<link rel="stylesheet" href="css/main.css">
<style>
img{
	float: left;
	width:300px;
	height:300px;
}
.workerprofile{
	margin-left:0px;
	font-size:24px;
}
main{
	width:1000px;
	padding-left:10px;
	margin-left:24%;
}
.sidenavmin { 
	  display: none;
}
.workerprofilemin { 
	  display: none;
	  width:500px;
	  margin-left:25%;
	  background-color:white;
	  padding:10px;
}
.warker_p{
	margin-left:20%;
}
.workerprofilemin img{
	margin:20%;
	margin-top:10%;
	margin-bottom:10%;
}
.menu { padding: 0px; background: #ddd; width: 100%; }
     .sidenavmin ul li { width: 90%; display: block; }
     .sidenavmin ul li a { width: 90%; padding: 20px; border-bottom: 1px solid #ddd; }
	 
@media screen and (max-width: 1500px) {
       .side { display: none }
}	
	 
@media screen and (max-width: 1150px) {
	  .sidenavmin { width: 100%; }
	 .sidenavmin { display: block }
	  .sidenav{ display: none }
	  .workerprofile{ display: none }
	  main{ display: none}
	  .workerprofilemin { display: block }
	  
}
@media screen and (max-width: 700px){
	.workerprofilemin { width:100%; margin:0px;}
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

</style>
</head>
<body>
<header>
    <div class="appname">Worker Panel</div>
    <div class="loggedin"> Welcome <?php echo $_SESSION['first_name']; ?> !
	<a href="logout.php"> Log Out </a></div> 
  </header>
  
  <div class="sidenav">
  <br>
  <h2> Menu</h2>
   <br>
   <br>
  <a href="display-users.php">Users Details</a>
  <br>
  <a href="vessels_work.php">Vessels</a>
  <br>
  <a href="product-worker.php">Product</a>
  <br>
  <a href="project_work.php">Project</a>
  <br>
  <a href="worker-comment.php">Comment</a>
  <br>
  <a href="worker-contact.php">Contact us</a>
 </div> 
<div class="sidenavmin">
		<br>
		 <a href="#" class="menu" onclick="myFunction()"> ☰  Menu</a>
		<br>
		<div id="myLinks">
		    <ul>
					<li><a href="display-users.php" class="menu1">Users Details</a></li>
					<li><a href="vessels_work.php" class="menu1">Vessels</a></li>
					<li><a href="product-worker.php" class="menu1">Product</a></li>
					<li><a href="project_work.php" class="menu1">Project</a></li>
					<li><a href="worker-comment.php" class="menu1">Comment</a></li>
					<li><a href="worker-contact.php" class="menu1">Contact us</a></li>
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
  <h2>Login time</h2>
   <br>
  <p><?php echo $user['last_login']; ?></p>
</div>
<main>
<div class="workerprofile">
<p><?php echo " $image ";  //data form akata genima sadaha?>
<br>

&nbsp &nbsp &nbsp <b><big> <?php echo $user['first_name']; ?>&nbsp &nbsp &nbsp <?php echo $user['last_name']; ?></b></big><br><br>
&nbsp &nbsp Email &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp  :&nbsp <?php echo $user['email']; ?><br><br>
&nbsp &nbsp Contact No. &nbsp &nbsp  : &nbsp <?php echo $user['phone_number']; ?><br><br>
&nbsp &nbsp Address &nbsp &nbsp &nbsp &nbsp &nbsp   : &nbsp <?php echo $user['address']; ?><br><br>
&nbsp &nbsp New Photo Add: </p>
 <form action="worker.php"  method="post" class="userform" enctype="multipart/form-data">
    <input type ="hidden" name="user_id" value="<?php echo $user_id?>">
    <p> <lable for="">&nbsp &nbsp </lable> 
	<input type="file" name="image"> <br>
   <lable for="">&nbsp </lable>
    &nbsp &nbsp <button type="submit" name="submit">Save</button></p>
  
   </form>
</div>
  
</main>

   <div class="workerprofilemin">
     
<p><?php echo " $image ";  //data form akata genima sadaha?>
<br>
<br>
<div class="warker_p">
  <b><big> <?php echo $user['first_name']; ?>&nbsp &nbsp &nbsp <?php echo $user['last_name']; ?></b></big><br><br>
 Email &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp : <?php echo $user['email']; ?><br><br>
 Contact No. &nbsp &nbsp : <?php echo $user['phone_number']; ?><br><br>
 Address &nbsp &nbsp &nbsp &nbsp &nbsp : <?php echo $user['address']; ?><br><br>
 New Photo Add: </p>
 <form action="worker.php"  method="post" class="userform" enctype="multipart/form-data">
    <input type ="hidden" name="user_id" value="<?php echo $user_id?>">
    <p>  
	<input type="file" name="image"> <br>
   <lable for="">&nbsp </lable>
    &nbsp &nbsp <button type="submit" name="submit">Save</button></p>
  </div>
   </form>
  
</div>
   
   
</body>

</html>