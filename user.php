<?php session_start(); ?>
<?php require_once('inc/connection.php');?>
<?php require_once('inc/function.php');?>
<?php
//checking if a user is logged in 
if(!isset($_SESSION['user_id'])){
	header('Location: index.php');
}
$user_id=$_SESSION['user_id'];
$query = "SELECT * FROM user  WHERE is_delete=0 AND id=$user_id ORDER BY first_name";
 



$users= mysqli_query($connection, $query);

verify_query($users);

	$user = mysqli_fetch_assoc($users)
		
?>
<?php
$errors = array();
	//data form akata genima sadaha
	
	
	
	
	
	if(isset($_POST['submit'])){
		
				//$user_id = $_POST['user_id'];
		    	$password = $_POST['password'];
		
		
		if(!$user_id){ 
		 $errors[]='user id is required';
		}
		
		if(empty(trim($_POST['password']))){ 
		 $errors[]='password is required';
		}
		
		
		//checking max length
		$max_len_fields = array('password' => 40);
		//as akata passe key word akak gahanawa
		foreach($max_len_fields as $field => $max_len){
			if(strlen(trim($_POST[$field])) > $max_len){
				
				$errors[] = $field . 'must be less than '. $max_len . ' characters';
			}
		}
		if($_POST['password'] == $_POST['Confirm_password'] ){
		  }else{
                $errors[] ='Checking your Password and Confirm Password';
         }
		
		if(empty($errors)){
			//no errors found... adding new record
			$password = mysqli_real_escape_string($connection, $_POST['password']);
			$hashed_password = sha1($password);
			
			
			
			
			$query = "UPDATE user SET ";
			$query .="password ='{$hashed_password}' ";
			$query .="WHERE id ={$user_id} LIMIT 1";
			
			
			
			$result = mysqli_query($connection,$query);
			
			
			
			if($result){
				//query sucessful... redirecting to users page
				header('Location:user.php?');
				
			}else{
				$errors[] ='Failed to update password';
			}
			
		}
		
	}


?>

<!DOCTYPE html>
<html>
<head>
<title>User Panel</title>
<link rel="stylesheet" href="css/user.css">
<style>
.miniprofile { 
	  display: none;
	  background-color:white;
	  margin:2%;
	  opacity: 0.8;
	  }
@media screen and (max-width: 900px) {
       .miniprofile{ width: 100%; }
	   .profile{ display:none}
	   .miniprofile  { display: block }
	   .shipde { display: block }
}
     }	
@media screen and (max-width: 600px) {
       .miniprofile{ width: 100%; }
	   .profile{ display:none}
	   .miniprofile  { display: block }
	   .shipde { display: block }
	   .image {width:96%;}
	  
     }		 
	 
.miniprofile #myLinks {
       display: none;
     }
	 .menu{
        background-color:#ddd;
         text-align: left;
         text-decoration: none;
         display: inline-block;
		 padding:20px;
		 font-size:20px; 
		 
	 }
	 .menu1{
		 width:100%;
		 background-color:#ddd;
		 margin-left:0px;
         border-style:groove;
		 border-color: white;
         text-align: center;
         text-decoration: none;
         display: inline-block;
		 padding:5px;
		 font-size:20px; 
	 }
     .errorpassword{
		 color:red;
		 font-size:20px;
	 }	 
</style>
</head>
<body style="background-image: url('IMG_7343-1024x760.png'); background-size:cover;background-attachment: fixed;">
<header>
 <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <div class="appname">User Panel</div>
    <div class="loggedin"> Welcome <?php echo $_SESSION['first_name']; ?> 
	<a href="logout.php"> Log Out </a></div> 
 </header>
 <main>
 <div class="profile">
 <br>
<h1>My Profile</h1>
  <br>
      <div class="bigpro">
        <table border="0">
        <tr><td rowspan="4"><img src="photo.jfif" alt="Avatar" style="width:300px;height:300px;"> &nbsp </td>
		<tr>
        <td> &nbsp &nbsp First Name</td>
        <td> :&nbsp <?php echo $user['first_name']; ?></td>
        </tr>
        <tr>
        <td> &nbsp &nbsp Last Name</td>
        <td> :&nbsp <?php echo $user['last_name']; ?></td>
        </tr>
        <tr>
        <td>&nbsp &nbsp Email</td>
        <td> :&nbsp <?php echo $user['email']; ?></td>
        </tr>
        <tr><td> &nbsp <button class="open-button" onclick="openForm()">changing password</button> </tr>
        
        </table>
    </div>

<div class="form-popup" id="myForm">
  <form  method="post"  class="form-container">
   
    <h1>Change Password</h1>

    
    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="password" required>
	
	<label for="psw"><b>Confirm Password</b></label>
    <input type="password" name="Confirm_password" placeholder="Enter Password"  required>

    <button type="submit" name="submit" class="submit">Submit</button>
    <button type="button" class="submit cancel" onclick="closeForm()">Close</button>
  </form>
</div>
<div class="errorpassword">
<p><?php
      if(!empty($errors)){
		 echo'<div class="errmsg">' ;
		 echo'<b>There were errors on your Password Change</br></b>';
        foreach($errors as $error){
			echo $error. '<br>';
		}
      echo'</div>';		
	  }
	  ?></p>
	  </div>
<script>
function openForm() {
  document.getElementById("myForm").style.display = "block";
}

function closeForm() {
  document.getElementById("myForm").style.display = "none";
}
</script>
<br>
<div class="ship">
<h1>Ship Details</h1>
<?php
$user_list ='';

$qu = "SELECT * FROM records  WHERE  User_ID=$user_id ";

$us= mysqli_query($connection, $qu);

verify_query($us);

	while($use = mysqli_fetch_assoc($us)){
		$user_list .= "<tr>";
		$user_list .= "<td rowspan='3'><img src='shipimages/".$use['Ship_Image']. "' class='image'> </td>";
		$user_list .= "<td>&nbsp&nbspShip Name</td>";
		$user_list .= "<td>:&nbsp&nbsp{$use['Ship_Name']}</td>";
		$user_list .= "</tr>";
		$user_list .= "<tr>";
		$user_list .= "<td>&nbspRegistration Id</td>";
		$user_list .= "<td>:&nbsp&nbsp{$use['Registration_Id']}</td>";
		$user_list .= "</tr>";
        $user_list .= "<tr>";
        $user_list .= "<td>&nbsp Country</td>";
		$user_list .= "<td>:&nbsp&nbsp{$use['Type']}</td>";
		$user_list .= "</tr>";
		$user_list .= "<tr>";
        $user_list .= "<td><br></td>";
		$user_list .= "<td><br></td>";
		$user_list .= "</tr>";
        
	}
		
?>
<br>
<br>
<table border="0">
<tr>
      
  </tr>
  <?php echo $user_list; ?>

</table>
</div>
<div class="details">
<br>



  <div id="mySidebar" class="sidebar">
   <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
   <a href="ship-index.php?$user_id=$_SESSION['user_id'];">Ship Registration</a>
   <a href="services.php">Services</a>
    <a href="product-user.php">Product</a>
   
 
  </div>

 <div id="main" class="button" >
   <button class="openbtn" onclick="openNav()">☰ Open Menu Bar</button><br><br> 
   <a href="ship-index.php"class="link">Ship Registration</a> <br>
   <a href="services.php" class="link">Services</a><br>
    <a href="product-user.php" class="link">Product</a><br>
   
  
 </div>

<script>
function openNav() {
  document.getElementById("mySidebar").style.width = "250px";
  document.getElementById("main").style.marginLeft = "250px";
}

function closeNav() {
  document.getElementById("mySidebar").style.width = "0";
  document.getElementById("main").style.marginLeft= "0";
}
</script>
</div>
</div>
</main> 

 <div class="miniprofile">
           <div class="sidenavmin">
		<br>
		 <a href="#" class="menu" onclick="myFunction()"> ☰ Open Menu Bar</a>
		<br>
		<div id="myLinks">
		     <a href="ship-index.php" class="menu1">Ship Registration</a>
			 <a href="services.php" class="menu1">Services</a>
			 <a href="product-user.php" class="menu1">Product</a>
			
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
 <br>
 <center>
<h1>My Details</h1>
  <br>
  <br>
      <div class="bigpro">
	  <img src="photo.jfif" alt="Avatar" style="width:300px;height:300px;"><br><br>
        <table border="0">
        <td> First Name &nbsp: </td>
        <td> &nbsp <?php echo $user['first_name']; ?></td>
        </tr>
        <tr>
        <td> Last Name &nbsp: </td>
        <td> &nbsp <?php echo $user['last_name']; ?> </td>
        </tr>
        <tr>
        <td> Email &nbsp &nbsp &nbsp &nbsp &nbsp: </td>
        <td> &nbsp <?php echo $user['email']; ?></td>
        </tr>
         
      </table>
	  </div>
	<?php 
	$user_list2 ='';
$qu = "SELECT * FROM records  WHERE  User_ID=$user_id ";

$us= mysqli_query($connection, $qu);
	 while($use = mysqli_fetch_assoc($us)){
		$user_list2 .= "<tr>";
		$user_list2 .= "<td colspan='2'><img src='shipimages/".$use['Ship_Image']. "' class='image'> </td></tr>";
		$user_list2 .= "<td>&nbsp&nbspShip Name</td>";
		$user_list2 .= "<td>:&nbsp&nbsp{$use['Ship_Name']}</td>";
		$user_list2 .= "</tr>";
		$user_list2 .= "<tr>";
		$user_list2 .= "<td>&nbspRegistration Id</td>";
		$user_list2 .= "<td>:&nbsp&nbsp{$use['Registration_Id']}</td>";
		$user_list2 .= "</tr>";
        $user_list2 .= "<tr>";
        $user_list2 .= "<td>&nbsp Country</td>";
		$user_list2 .= "<td>:&nbsp&nbsp{$use['Type']}</td>";
		$user_list2 .= "</tr>";
		$user_list2 .= "<tr>";
        $user_list2 .= "<td><br></td>";
		$user_list2 .= "<td><br></td>";
		$user_list2 .= "</tr>";
        
	}
		
?>
<br>
<br>
<div class="shipde">
<h1>Ship Details </h1><br>
<table border="0">
<tr>
      
  </tr>
  <?php echo $user_list2; ?>

</table>
</div>	
	</center>

  
</div>
</body>

</html>