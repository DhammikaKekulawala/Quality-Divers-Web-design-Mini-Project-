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
	$reg_id = '';
	$ship_name = '';
	$image = '';
	$country = '';
	$type = '';
	$job_description = '';
	$other = '';
	
	if(isset($_GET['registration_id'])){
		//getting the user information
		$registration_id = mysqli_real_escape_string($connection,$_GET['registration_id'] );
		
		$query="SELECT * FROM project WHERE registration_id ={$registration_id} LIMIT 1";
		
		$result_set = mysqli_query($connection, $query);
		
		if($result_set){
			if(mysqli_num_rows($result_set) == 1){
				//user found
				$result = mysqli_fetch_assoc($result_set);
				$ship_name = $result['ship_name'];
				$registration_id = $result['registration_id'];
				$image = "<img src='images/".$result['image']. "'>";
				$country = $result['country'];
				$type = $result['type'];
				$job_description = $result['job_description'];
				$other = $result['other'];
			}else{
				//user not found
				header('Location:project.php? project_not_found');
				
			}
		}else{
			// query unsuccessful
			header('Location:project.php? err=query_failed');
		}
	}
	
	
	
	
	
	if(isset($_POST['submit'])){
		//checking required field
		//trim space aen karanna
		        //data form akata genima sadaha
				//submit karala ganna
		  $reg_id = $_POST['reg_id'];
	      $ship_name = $_POST['ship_name'];
	      $country = $_POST['country'];
	      $type = $_POST['type'];
	      $job_description = $_POST['job_description'];
	      $other = $_POST['other'];
		
		if(empty(trim($_POST['reg_id']))){ 
		 $errors[]='registration id is required';
		}
		if(empty(trim($_POST['ship_name']))){ 
		 $errors[]='ship name is required';
		}
		if(empty(trim($_POST['country']))){ 
		 $errors[]='country is required';
		}
		if(empty(trim($_POST['type']))){ 
		 $errors[]='type is required';
		}
		if(empty(trim($_POST['job_description']))){ 
		 $errors[]='job_description is required';
		}
		if(empty(trim($_POST['other']))){ 
		 $errors[]='other is required';
		}
		
		//checking max length
		$max_len_fields = array('ship_name' => 50, 'country' =>25, 'type' => 25, 'job_description' => 500, 'other' => 500);
		//as akata passe key word akak gahanawa
		foreach($max_len_fields as $field => $max_len){
			if(strlen(trim($_POST[$field])) > $max_len){
				
				$errors[] = $field . 'must be less than '. $max_len . ' characters';
			}
		}
		
		
		
		
		if(empty($errors)){
			//no errors found... adding new record
			
			$ship_name = mysqli_real_escape_string($connection, $_POST['ship_name']);
			$country = mysqli_real_escape_string($connection, $_POST['country']);
			$type = mysqli_real_escape_string($connection, $_POST['type']);
			$job_description = mysqli_real_escape_string($connection, $_POST['job_description']);
			$other= mysqli_real_escape_string($connection, $_POST['other']);
		   
		   if(isset($_FILES['image']))
			{
                $file_name = $_FILES['image']['name'];
               $temp_name = $_FILES['image']['tmp_name'];
                //photo direction
		       $upload_to = 'images/';
                $file_uploaded = move_uploaded_file($temp_name, $upload_to . $file_name);
                $target = "images/".basename($file_name);
             }
			else
			{
				$file_name = '';
			}
			
			
			
			$query = " UPDATE project SET";
			$query .=" ship_name='{$ship_name}',country='{$country}',type='{$type}', job_description='{$job_description}',other='{$other}'";
			if(!empty($file_name)) $query .= ",image='{$file_name}'";
			$query .="WHERE registration_id = {$reg_id} LIMIT 1";
			
			
			
			$result = mysqli_query($connection,$query);
			
			if($result){
				//query sucessful... redirecting to users page
				header('Location: project.php?project_modified=true');
				
			}else{
				$errors[] ='Failed to add the modify record';
			}
			
		}
		
	}

?>

<!DOCTYPE html>
<html>
<head>
<title>Modify project</title>
<link rel="stylesheet" href="css/main.css">
<style>
 img{
	 width:300px;
	 height:200px;
 }

</style>
</head>
<body>
  <header>
    <div class="appname"><a href="admin.php">Admin Panel </a></div>
    <div class="loggedin"> Welcome <?php echo $_SESSION['first_name']; ?> 
	<a href="logout.php"> Log Out </a></div> 
  </header>
  <main>
 <h1>Update Info</h1>
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
 
 <form action="modify-project.php"  method="post" class="userform" enctype="multipart/form-data">
 	<input type ="hidden" name="reg_id" value="<?php echo $registration_id?>">
   <p>
   <lable for= "ship_name">Ship Name &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp :</lable>
   <input type="text" name="ship_name"<?php echo 'value="' . $ship_name . '"';  //data form akata genima sadaha?>>
   </p>
    <p>
   <lable for="">New Photo &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp :</lable>
   <input type="file" name="image">
   </p>
   <p>
   <lable for="">Previous Photo &nbsp &nbsp &nbsp  : </lable>
   <?php echo " $image ";  //data form akata genima sadaha?>
   </p>
   <p>
   <lable for="">Country &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp : </lable>
   <input type="text" name="country"<?php echo 'value="' . $country . '"';  //data form akata genima sadaha?>>
   </p>
   <p>
   <lable for="">Ship Type &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp: </lable>
   <input type="text" name="type" <?php echo 'value="' . $type . '"';  //data form akata genima sadaha?>>
   </p>
   <p>
   <lable for="">Job Description &nbsp &nbsp &nbsp :</lable>
   <input type="text" name="job_description" <?php echo 'value="' . $job_description . '"';  //data form akata genima sadaha?>>
   </p>
    <p>
   <lable for="">Other &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp : </lable>
   <input type="text" name="other" <?php echo 'value="' . $other . '"';  //data form akata genima sadaha?>>
   </p>
    <p>
   <lable for="">&nbsp</lable>
   <button type="submit" name="submit">Save</button>
   </p>
   <br>
   <div class="backto"><span><a href="project.php"> Back </a></span></div>
   <br>
   
 
 </form>
 </main>
</body>

</html>