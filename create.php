<?php session_start(); ?>
<?php require_once('inc/connection.php');?>
<?php require_once('inc/function.php');?>
<?php
    //checking if a user is logged in
	if(!isset($_SESSION['user_id'])){
	header('Location: index.php');
}
	$errors = array();
	
	if(isset($_POST['submit'])){
		//checking required field
		//trim space aen karanna
		if(empty(trim($_POST['first_name']))){ 
		 $errors[]='first name is required';
		}
		if(empty(trim($_POST['last_name']))){ 
		 $errors[]='last name is required';
		}
		if(empty(trim($_POST['email']))){ 
		 $errors[]='email is required';
		}
		if(empty(trim($_POST['phone_number']))){ 
		 $errors[]='Phone number is required';
		}
		if(empty(trim($_POST['password']))){ 
		 $errors[]='password is required';
		}
		//checking max length
		$max_len_fields = array('first_name' => 50, 'last_name' =>100, 'email' => 100, 'phone_number' => 15,'password' => 40 );
		//as akata passe key word akak gahanawa
		foreach($max_len_fields as $field => $max_len){
			if(strlen(trim($_POST[$field])) > $max_len){
				
				$errors[] = $field . 'must be less than '. $max_len . ' characters';
			}
		}
		//checking email address
		
		
		//checking if email address already exists
		$email = mysqli_real_escape_string($connection, $_POST['email']);
		$query ="SELECT * FROM user WHERE email ='{$email}' LIMIT 1";
		
		$result_set = mysqli_query($connection, $query);
		
		if($result_set){
			if(mysqli_num_rows($result_set) == 1) {
				$errors[] = 'Email address already exists';
			}
		}
		if(empty($errors)){
			//no errors found... adding new record
			$first_name = mysqli_real_escape_string($connection, $_POST['first_name']);
			$last_name = mysqli_real_escape_string($connection, $_POST['last_name']);
			$phone_number = mysqli_real_escape_string($connection, $_POST['phone_number']);
			$password = mysqli_real_escape_string($connection, $_POST['password']);
			//email address is already sanitized
			$hashed_password = sha1($password);
			
			$query = "INSERT INTO user (";
			$query .=" first_name, last_name,email,phone_number,password,type, is_delete";
			$query .=") VALUES(";
			$query .="'{$first_name}','{$last_name}','{$email}','{$phone_number}','{$hashed_password}',2, 0";
			$query .=")";
			
			
			$result = mysqli_query($connection,$query);
			
			if($result){
				//query sucessful... redirecting to users page
				header('Location: users_details.php?user_addded=true');
				
			}else{
				$errors[] ='Failed to add the new record';
			}
			
		}
		
	}

?>

<!DOCTYPE html>
<html>
<head>
<title>Add users</title>
<link rel="stylesheet" href="css/main.css">
</head>
<body>
  <header>
    <div class="appname">Admin panel </div>
    <div class="loggedin"> Welcome <?php echo $_SESSION['first_name']; ?> 
	<a href="logout.php"> Log Out </a></div> 
  </header>
  <main>
 <h1>user<span><a href="users_details.php">  Back to ser List</a></span></h1>
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
 
 <form action="add-user.php"  method="post" class="userform">
    
   <p>
   <lable for="">First name</lable>
   <input type="text" name="first_name">
   </p>
    <p>
   <lable for="">Last name</lable>
   <input type="text" name="last_name" >
   </p>
    <p>
   <lable for="">Email Address:</lable>
   <input type="email" name="email">
   </p>
    <p>
   <lable for="">Phone number:</lable>
   <input type="text" name="phone_number">
   </p>
   <p>
   <lable for="">Password:</lable>
   <input type="password" name="password">
   </p>
    <p>
   <lable for="">&nbsp</lable>
   <button type="submit" name="submit">save</button>
   </p>
   
 
 </form>
 </main>
</body>

</html>