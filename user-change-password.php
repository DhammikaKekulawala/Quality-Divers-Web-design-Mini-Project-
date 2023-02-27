<?php session_start(); ?>
<?php require_once('inc/connection.php');?>
<?php require_once('inc/function.php');?>
<?php
    //checking if a user is logged in
	if(!isset($_SESSION['user_id'])){
	header('Location: index.php');
}
	$errors = array();
	//data form akata genima sadaha
	$user_id = '';
	$first_name = '';
	$last_name = '';
	$email = '';
	$password ='';
	
	if(isset($_GET['user_id'])){
		//getting the user information
		$user_id = mysqli_real_escape_string($connection,$_GET['user_id'] );
		
		$query="SELECT * FROM user WHERE id ={$user_id} LIMIT 1";
		
		$result_set = mysqli_query($connection, $query);
		
		if($result_set){
			if(mysqli_num_rows($result_set) == 1){
				//user found
				$result = mysqli_fetch_assoc($result_set);
				$first_name = $result['first_name'];
				$last_name = $result['last_name'];
				$email = $result['email'];
			
			}else{
				//user not found
				header('Location:modify-user.php? user_not_found');
				
			}
		}else{
			// query unsuccessful
			header('Location:modify-user.php? err=query_failed');
		}
	}
	
	
	
	
	
	if(isset($_POST['submit'])){
		//checking required field
		//trim space aen karanna
		        //data form akata genima sadaha
				//submit karala ganna
				$user_id = $_POST['user_id'];
		    	$password = $_POST['password'];
		
		
		if(empty(trim($_POST['user_id']))){ 
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
				header('Location:users_details.php?');
				
			}else{
				$errors[] ='Failed to update password';
			}
			
		}
		
	}

?>

<!DOCTYPE html>
<html>
<head>
<title>Change Password</title>
<link rel="stylesheet" href="css/main.css">
</head>
<body>
  <header>
    <div class="appname"><a herf="admin.php">Admin Panel</a></div>
    <div class="loggedin"> Welcome <?php echo $_SESSION['first_name']; ?> 
	<a href="logout.php"> Log Out </a></div> 
  </header>
  <main>
 <h1>Change User Password </h1>
 <?php
      if(!empty($errors)){
		 echo'<div class="errmsg">' ;
		 echo'<b>There were errors on your form</br></b>';
        foreach($errors as $error){
			echo $error. '<br>';
		}
      echo'</div>';		
	  }
	  
 
 ?>
 <br>
 <br>
 <form action="user-change-password.php"  method="post" class="userform">
    <input type ="hidden" name="user_id" value="<?php echo $user_id?>">
   <p>
   <lable for="">First Name &nbsp &nbsp &nbsp &nbsp: </lable>
   <input type="text" name="first_name"<?php echo 'value="' . $first_name . '"';  //data form akata genima sadaha?> disabled>
   </p>
    <p>
   <lable for="">Last Name &nbsp &nbsp &nbsp &nbsp: </lable>
   <input type="text" name="last_name"<?php echo 'value="' . $last_name . '"'; //data form akata genima sadaha ?> disabled>
   </p>
    <p>
   <lable for="">Email Address &nbsp : </lable>
   <input type="email" name="email"<?php echo 'value="' . $email . '"';  //data form akata genima sadaha?> disabled>
   </p>
    <p>
   <lable for="">New Password &nbsp: </lable>
   <input type="password" name="password" id="password">
   </p>
    <p>
   <lable for="">&nbsp</lable>
   <button type="submit" name="submit">Update Password</button>
   </p>
   <a href="modify-user.php?user_id=<?php echo$user_id; ?>" class="add"> Back </a>
 
 </form>
 </main>
 
</body>

</html>