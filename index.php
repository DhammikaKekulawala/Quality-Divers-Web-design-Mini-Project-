<?php session_start(); ?>
<?php require_once('inc/connection.php');?>
<?php require_once('inc/function.php');?>
<?php 
   //user  submit
  if(isset($_POST['submit'])){
	  
	  $errors = array();
	 
	  //user  username
	  if(!isset($_POST['email']) || strlen(trim($_POST['email'])) < 1){
		  $errors[] = 'username is missing / Invalid';
		  
	  }
	  //user password
	   if(!isset($_POST['password']) || strlen(trim($_POST['password'])) < 1){
		  $errors[] = 'password is missing / Invalid';
		  
	  }
	  //check if there are any errors in  the form
	  if(empty($errors)){
		  $email    = mysqli_real_escape_string($connection,$_POST['email']);
		  $password = mysqli_real_escape_string($connection,$_POST['password']);
		  $hashed_password = sha1($password);
		  
		// prepare databse query
		$query = "SELECT * FROM user
		WHERE email='{$email}'
		AND password='{$hashed_password}'
		LIMIT 1";
				   
				   
		$result_set = mysqli_query($connection, $query);
		
		verify_query($result_set);
			//query sucessful
			if(mysqli_num_rows($result_set) == 1){
				//valid user found
				$user = mysqli_fetch_assoc($result_set);
				$_SESSION['user_id'] = $user['id'];
				$_SESSION['first_name'] = $user['first_name'];
				$_SESSION['type'] = $user['type'];
				
				
				  //updating last login
				  $query = "UPDATE user SET last_login = NOW()";
				  $query .="WHERE id ={$_SESSION['user_id']} LIMIT 1";
				  
				  $result_set = mysqli_query($connection, $query);
				  
				  if(!$result_set){
					 die("Database query failed.") ;
					  
				  }
				   


            //page selection
         
		          switch ($user['type']) {
	         	case 0:
	         		header('location: admin.php');
	         		break;
	         	case 1:
	         		header('location: worker.php');
	         		break;
	         	
	         	default:
	         		header('location: user.php');
	         		break;
                    }
		
	        
	         
	         
				//redirect to user php
				//header('location: users.php');
			}else{
				//user name and password invalid
				$errors[] = 'Invalid Username / password';
			}
		
	  }
	 
	  
 }

?>
<!DOCTYPE html>
<html> 
<head>

<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
<title>Log In -User Management System</title>
<link rel="stylesheet" href="css/main.css">
<style> 
   .login{
	  
   }
</style>
</head>
<body style="background-image: url('IMG_7321-1024x760.png'); background-size:cover;background-attachment: fixed; ">
<div class="login">
  <form action="index.php" method="post">
   <fieldset class="lo">
   <legend><img src="avatar.png" class="avatar"></legend>
   <br>
   <br>
   <br>
     <h2>Log In</h2>
	 <br>
	 <h2>Quality Drivers</h2>
	 <br>
	 <br>
	 <?php
	    if(isset($errors) &&  !empty($errors)){
			echo'<p class="error">invalid user name or password</p>';
		}

	 ?>
	 <?php
	  if(isset($_GET['logout'])){
		  echo '<p class="infor">You have succesffully logged out from the system</p>';
		  
	  }
	 ?>
	 <p>
	    <label for="email">Email</label>
		<input type= "text" name="email" id="" placeholder="Email Address"class="in">
	 </p>
	 <p>
	    <label for="password">Password</label>
		<input type= "password" name="password" id="" placeholder="Password"class="in">
	 </p>
	 <br>
	 <p>
	    <button type="submit" name="submit" class="header">Login</button>
	 </p>
	 <p> 
	 	<a href="reset-password.php"class="link">Forgot Password?</a>
	 </p>
	 <p> 
	 	<a href="create-account.php"class="link">Create Account</a>
	 </p>
   
   </fieldset>

 </form>
</div> <!-- .login -->


</body>

</html>
<?php mysqli_close($connection); ?>