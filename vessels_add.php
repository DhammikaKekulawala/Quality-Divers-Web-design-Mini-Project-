<?php session_start(); ?>
<?php require_once('inc/connection.php');?>
<?php require_once('inc/function.php');?>
<?php

if(!isset($_SESSION['user_id'])){
  header('Location: index.php');
}

	$errors = array();
  $mag = array();

  
		
  
  if(isset($_POST['submit'])){
    //checking required field
    //trim space aen karanna
    $file_name = $_FILES['image']['name'];
    $file_type = $_FILES['image']['type'];
    $file_size = $_FILES['image']['size'];
    $temp_name = $_FILES['image']['tmp_name'];

    $upload_to = 'vesselsimages/';

    // checking the file type
    if ($file_type != 'image/jpeg') {
      $errors[] = 'Only JPEG files are allowed.';
    }

    // checking file size
    if ($file_size > 500000) {
      $errors[] = 'File size should be less than 500kb.';
    }
	if (empty($errors)) {
      //file akak  upload karana aka
     
      $mag[] = 'Seccessful your photo upload.';
    }
  




   if(empty(trim($_POST['vessels_name']))){ 
     $errors[]='Ship name is required';
    }
    if(empty(trim($_POST['length_overall']))){ 
     $errors[]='Length overall id is required';
    }
    if(empty(trim($_POST['speed']))){ 
     $errors[]='Speed is required';
    }
    if(empty(trim($_POST['bollard_pull']))){ 
     $errors[]='Bollard pull is required';
    }
	if(empty(trim($_POST['breadth']))){ 
     $errors[]='Breadth pull is required';
    }
    
    //checking max length
    $max_len_fields = array('vessels_name' => 50, 'length_overall' =>15,  'speed' => 15,'bollard_pull' =>50, 'breadth' =>15 );
    //as akata passe key word akak gahanawa
    foreach($max_len_fields as $field => $max_len){
      if(strlen(trim($_POST[$field])) > $max_len){
        
        $errors[] = $field . 'must be less than '. $max_len . ' characters';
      }
    }
    //photo direction
    $upload_to = 'vesselsimages/';
    $file_uploaded = move_uploaded_file($temp_name, $upload_to . $file_name);
    
    if(empty($errors)){
      //no errors found... adding new record
      $vessels_name = mysqli_real_escape_string($connection, $_POST['vessels_name']);
      $length_overall = mysqli_real_escape_string($connection, $_POST['length_overall']);
      $speed = mysqli_real_escape_string($connection, $_POST['speed']);
      $bollard_pull = mysqli_real_escape_string($connection, $_POST['bollard_pull']);
      $breadth = mysqli_real_escape_string($connection, $_POST['breadth']);
      $file_name = $_FILES['image']['name'];
      $target = "vesselsimages/".basename($file_name);

     
      
      $query = "INSERT INTO vessels (";
      $query .="vessels_name, length_overall,image,speed,bollard_pall,breadth,is_deleted";
      $query .=") VALUES(";
      $query .="'{$vessels_name}','{$length_overall}','{$file_name}','{$speed}','{$bollard_pull}','{$breadth}',0";
      $query .=")";
      
      
      $result = mysqli_query($connection,$query);
      
      if($result){
        //query sucessful... redirecting to users page
        header('Location: vessels.php?vessels correct');
        
      }else{
        $errors[] ='Failed to add the new record';
      }
      
    }
    
  }

?>

<!DOCTYPE html>
<html>
<head>
<title>Add vessels</title>
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
 
 <form action="vessels_add.php"  method="post" class="userform" enctype="multipart/form-data">
    
      <h1>Add New Vessels</h1>
    <br>
	<br>
   <p><lable for="">Vessels Name &nbsp &nbsp:</lable>
    <input type="text" name="vessels_name">
   </p>
    <p>
   <lable for="">Photo &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp:</lable>
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
   <lable for="">Length Overall &nbsp &nbsp:</lable>
   <input type="text" name="length_overall">
   </p>
   <p>
   <lable for="">Breadth &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp :</lable>
    <input type="text" name="breadth">
   </p>
    <p>
   <lable for="">Speed &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp :</lable>
    <input type="text" name="speed">
   </p>
   <p>
   <lable for="">Bollard Pull &nbsp &nbsp &nbsp &nbsp : </lable>
   <input type="text" name="bollard_pull">
   </p>
   <p>
   <lable for="">&nbsp</lable>
   <button type="submit" name="submit">Save</button>
   </p>
   
 
 </form>
   <?php echo"<div class='backto'><a href='vessels.php'>Back</a></div>"; ?>
 </main>
</body>

</html>