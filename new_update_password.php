<?php session_start(); ?>
<?php require_once('inc/connection.php');?>
<?php require_once('inc/function.php');?>
<?php 


$id = mysqli_real_escape_string($connection,$_GET['id'] );
echo "$id";
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
	 <link rel="stylesheet" href="css/main.css">
	</head>
	
	<body>
	<form method="post">
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
       <button type="submit" name="submit" >save</button>
       </p>
	
	
	</form>
	
	
	</body>
	
	</html>
	