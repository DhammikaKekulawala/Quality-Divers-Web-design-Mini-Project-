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
	$address = '';
	$phone_number = '';
	$password = '';
	$image = '';
	
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
				$address = $result['address'];
				$phone_number = $result['phone_number'];
				$profile = $result['profile'];
				$image = "<img src='profile/".$result['profile']. "'>";
			}else{
				//user not found
				header('Location:admin.php? user_not_found');
				
			}
		}else{
			// query unsuccessful
			header('Location:admin.php? err=query_failed');
		}
	}
	
	
	
	
	
	if(isset($_POST['submit'])){
		//checking required field
		//trim space aen karanna
		        //data form akata genima sadaha
				//submit karala ganna
				$user_id = $_POST['user_id'];
		    	$first_name = $_POST['first_name'];
				$last_name = $_POST['last_name'];
				$email = $_POST['email'];
				$address = $_POST['address'];
				$phone_number = $_POST['phone_number'];
		
		
		
		
		if(empty(trim($_POST['user_id']))){ 
		 $errors[]='user id is required';
		}
		
		if(empty(trim($_POST['first_name']))){ 
		 $errors[]='first name is required';
		}
		if(empty(trim($_POST['last_name']))){ 
		 $errors[]='last name is required';
		}
		if(empty(trim($_POST['email']))){ 
		 $errors[]='email is required';
		}
		if(empty(trim($_POST['address']))){ 
		 $errors[]='address is required';
		}
		if(empty(trim($_POST['phone_number']))){ 
		 $errors[]='phone_number is required';
		}
		
		//checking max length
		$max_len_fields = array('first_name' => 50, 'last_name' =>100, 'email' => 100, 'address' => 100, 'phone_number' => 15);
		//as akata passe key word akak gahanawa
		foreach($max_len_fields as $field => $max_len){
			if(strlen(trim($_POST[$field])) > $max_len){
				
				$errors[] = $field . 'must be less than '. $max_len . ' characters';
			}
		}
		//checking email address
		
		
		//checking if email address already exists
		$email = mysqli_real_escape_string($connection, $_POST['email']);
		$query ="SELECT * FROM user WHERE email ='{$email}' AND id !={$user_id}  LIMIT 1";
		                                             //me mail aka wena kena kuta thiyenawada kiyala balana aka  AND id !={$user_id}
		
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
			$address = mysqli_real_escape_string($connection, $_POST['address']);
			$phone_number = mysqli_real_escape_string($connection, $_POST['phone_number']);
			
			if(isset($_FILES['image']))
			{
				$file_name = $_FILES['image']['name'];
			   $temp_name = $_FILES['image']['tmp_name'];
				//photo direction
			   $upload_to = 'profile/';
				$file_uploaded = move_uploaded_file($temp_name, $upload_to . $file_name);
				$target = "profile/".basename($file_name);
			}
			else
			{
				$file_name = '';
			}
			
			
			$query = "UPDATE user SET";
			$query .=" first_name='{$first_name}', last_name ='{$last_name}',email ='{$email}', address='{$address}', phone_number='{$phone_number}'";
			if(!empty($file_name)) $query .= ",profile='{$file_name}'";
			$query .="WHERE id ={$user_id} LIMIT 1";
			
			
			
			$result = mysqli_query($connection,$query);
			
			if($result){
				//query sucessful... redirecting to users page
				header('Location: admin.php?user_modified=true');
				
			}else{
				$errors[] ='Failed to add the modify record';
			}
			
		}
		
	}

?>

<!DOCTYPE html>
<html>
<head>
<title>Modify Admin</title>
<link rel="stylesheet" href="css/main.css">
<style>
  img{
	  width:250px;
	  height:250px;
  }
</style>
</head>
<body>
  <header>
    <div class="appname"><a href="admin.php">Admin panal</a></div>
    <div class="loggedin"> Welcome <?php echo $_SESSION['first_name']; ?> 
	<a href="logout.php"> Log Out </a></div> 
  </header>
  <main><br>
 <h1> Profile  </h1>
 <br>
 <br>
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
 
 <form action="modify-admin.php"  method="post" class="userform" enctype="multipart/form-data">
    <input type ="hidden" name="user_id" value="<?php echo $user_id?>">
   <p>
   <lable for="">Existing Photo &nbsp &nbsp &nbsp &nbsp: </lable>
   <?php echo " $image ";  //data form akata genima sadaha?>
   </p>
    <p>
   <lable for="image">New Profile Photo &nbsp &nbsp: </lable>
   <input type="file" name="image"  <?php echo 'value="' .$image . '"';  //data form akata genima sadaha?>>
   </p>
   <p>
   <lable for="">First Name &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp :</lable>
   <input type="text" name="first_name"<?php echo 'value="' . $first_name . '"';  //data form akata genima sadaha?>>
   </p>
    <p>
   <lable for="">Last Name &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp: </lable>
   <input type="text" name="last_name"<?php echo 'value="' . $last_name . '"'; //data form akata genima sadaha ?> >
   </p>
    <p>
   <lable for="">Email Address &nbsp &nbsp &nbsp &nbsp  &nbsp: </lable>
   <input type="email" name="email"<?php echo 'value="' . $email . '"';  //data form akata genima sadaha?>>
   </p>
   <p>
   <lable for="">Address &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp: </lable>
   <input type="text" name="address"<?php echo 'value="' . $address . '"';  //data form akata genima sadaha?>>
   </p>
   <p>
   <lable for="">Contact No &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp : </lable>
   <input type="tel" name="phone_number" placeholder="" <?php echo 'value="' . $phone_number . '"';  //data form akata genima sadaha?>>
   </p>
    <p>
   <lable for="">Password &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp : </lable>
   <a href="admin-change-password.php?user_id=<?php echo$user_id; ?>" class="password"> Change Password </a>
   </p>
    <p>
   <lable for="">&nbsp</lable>
   <button type="submit" name="submit" class="but">Save</button>
   </p>
   
 
 </form>
 </main>
</body>

</html>