<?php session_start(); ?>
<?php require_once('inc/connection.php');?>
<?php require_once('inc/function.php');?>
<?php 


$id=$_GET['i'];
$use ="SELECT * FROM user where id = $id";
$user_query = mysqli_query($connection, $use);

$user = mysqli_fetch_assoc($user_query);
$valid_request = false;
if($user && md5($user['email']) == $_GET['code'])
{
	$user_id = $user['id'];
	$valid_request = true;

	//header('Location:new_update_password.php?id='.$user_id);
}
if(isset($_POST['submit'])){
	 
	  $errors = array();
	 if($_POST['password']!== $_POST['conform_password']){
		 $errors[]='pasword and conform_password is not same';
	 }
	 if(empty(trim($_POST['password']))){ 
		 $errors[]='Password is required';
		}	 
	 if(empty($errors)){
		 $password = mysqli_real_escape_string($connection, $_POST['password']);
         $hashed_password = sha1($password);
			
			
			
			
			$query = "UPDATE user SET ";
			$query .="password ='{$hashed_password}' ";
			$query .="WHERE id = '$id'";
			
			
			
			$result = mysqli_query($connection,$query);
			
			if($result){
				//query sucessful... redirecting to users page
				header('Location:index.php?updatepassworad=true');
				
			}else{
				$errors[] = 'Failed to update password';
			} 
		 
		 
		 
	 }
 
}

?>

<!DOCTYPE html>
	<html>
	<head>
	 <title>update password</title>
	 <link rel="stylesheet" href="css/user.css">
	</head>
	
	<body>
	<main>
	<div class="update">
	<?php if($valid_request){?>
	<form method="post" class="form-container">
	<p>
	<h2>Reset password</h2>
	</p>
	<br>
	<?php
	    if(isset($errors) &&  !empty($errors)){
			echo'<p class="error">invalid user name or password</p>';
		}

	 ?>
	   <p>
       <lable for="">New Password:</lable>
       <input type="password" name="password">
       </p>
	   <p>
       <lable for="">Conform Password:</lable>
       <input type="password" name="conform_password">
       </p>
       <p>
       <lable for="">&nbsp</lable>
       <button type="submit" name="submit"class="submit" >save</button>
       </p>
	
	
	</form>
	<?php } else {?>
		<strong>Invalid URL. Please check again.</strong>
		
	<?php }  ?>
	</div>
	</main>
	</body>
	
	</html>