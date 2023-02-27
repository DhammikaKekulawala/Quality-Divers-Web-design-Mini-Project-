<?php session_start(); ?>
<?php require_once('inc/connection.php');?>
<?php require_once('inc/function.php');?>
<?php

if(!isset($_SESSION['user_id'])){
  header('Location: index.php');
}

	$errors = array();
  $mag = array();

   if (isset($_POST['submit'])) {
		// submitt button is clicked
        

        //file kiyana super golable  variable ake thibba awa
		
    
    if (empty($errors)) {
      //file akak  upload karana aka
      //$file_uploaded = move_uploaded_file($temp_name, $file_name);
      $mag[] = 'Seccessful your photo upload.';
    }
  }


	
  
  if(isset($_POST['submit'])){
	    
	  
    //checking required field
    //trim space aen karanna
    $file_name = $_FILES['image']['name'];
    $file_type = $_FILES['image']['type'];
    $file_size = $_FILES['image']['size'];
    $temp_name = $_FILES['image']['tmp_name'];

    $upload_to = 'images/';

    // checking the file type
    if ($file_type != 'image/jpeg') {
      $errors[] = 'Only JPEG files are allowed.';
    }

    // checking file size
    if ($file_size > 500000) {
      $errors[] = 'File size should be less than 500kb.';
    }




   if(empty(trim($_POST['ship_name']))){ 
     $errors[]='Ship name is required';
    }
    if(empty(trim($_POST['registration_id']))){ 
     $errors[]='Registration id is required';
    }
    if(empty(trim($_POST['country']))){ 
     $errors[]='Country is required';
    }
    if(empty(trim($_POST['ship_type']))){ 
     $errors[]='Ship type is required';
    }
    if(empty(trim($_POST['job_description']))){ 
     $errors[]='Job description is required';
    }
    if(empty(trim($_POST['other']))){ 
     $errors[]='Other is required';
    }
    
    //photo direction
    $upload_to = 'images/';
    $file_uploaded = move_uploaded_file($temp_name, $upload_to . $file_name);
    
    if(empty($errors)){
      //no errors found... adding new record
      $ship_name = mysqli_real_escape_string($connection, $_POST['ship_name']);
      $registration_id = mysqli_real_escape_string($connection, $_POST['registration_id']);
      $country = mysqli_real_escape_string($connection, $_POST['country']);
      $ship_type = mysqli_real_escape_string($connection, $_POST['ship_type']);
      $job_description = mysqli_real_escape_string($connection, $_POST['job_description']);
      $other = mysqli_real_escape_string($connection, $_POST['other']);
      $file_name = $_FILES['image']['name'];
      $target = "images/".basename($file_name);

     
      
      $query = "INSERT INTO project (";
      $query .="ship_name,registration_id,image,country,type,job_description,other,is_delete";
      $query .=") VALUES(";
      $query .="'{$ship_name}','{$registration_id}','{$file_name}','{$country}','{$ship_type}','{$job_description}','{$other}',0";
      $query .=")";
      
     
      $result = mysqli_query($connection,$query);
      
      if($result){
        //query sucessful... redirecting to users page
        header('Location: project.php?project_addded correct');
        
      }else{
        $errors[] ='Failed to add the new record';
      }
      
    }
    
  }

?>

<!DOCTYPE html>
<html>
<head>
<title>Add  Project</title>
<link rel="stylesheet" href="css/main.css">
</head>
<body>
  <header>
    <div class="appname"><a href="admin.php">Admin Panel </a></div>
    <div class="loggedin"> Welcome <?php echo $_SESSION['first_name']; ?> !
  <a href="logout.php"> Log Out </a></div> 
  </header>
  
  <main>
 
 <?php
      if(!empty($errors)){
		 echo'<div class="errmsg">' ;
		 echo'<b>There were errors on your form</br></b>';
        foreach($errors as $error){
			echo $error. '<br>';
		}
      echo'</div>';		
	  }
	   
      if(!empty($mag)){
     echo'<div class="errmsg">' ;
        foreach($errors as $error){
      echo $error. '<br>';
    }
      echo'</div>';   
    }
    
 
 ?>
 
 <form action="project_add.php"  method="post" class="userform" enctype="multipart/form-data">
    
      <h1>Add New Project</h1>
    <br>
	<br>
   <p><lable for="">Ship Name &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp: </lable>
   <input type="text" name="ship_name">
   </p>
    <tr>
   <p><lable for="">Registration ID &nbsp &nbsp &nbsp: </lable>
   <input type="text" name="registration_id" >
   </p>
    <p>
   <lable for="">Photo &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp: </lable>
   <input type="file" name="image" id="">
   </p>
	 
   
   <?php 
		 //upload karana file aka gena
			if (isset($file_uploaded)) {
				echo '<p>Uploaded image ';
				echo '<img src="' .  $file_name . '" style="height:200px  </p>">';
			}

		 ?>
  
   <p>
   <lable for="">Country &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp :</lable>
   <input type="text" name="country">
   </p>
    <p>
   <lable for="">Ship Type &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp: </lable>
   <input type="text" name="ship_type">
   </p>
   <p>
   <lable for="">Job Description &nbsp &nbsp :</lable>
   <input type="text" name="job_description">
   </p>
   <p>
   <lable for="">Other &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp : </lable>
   <input type="text" name="other">
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