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
	$vessels_id = '';
	$vessels_name = '';
	$image = '';
	$speed = '';
	$bollard_pall = '';
	$breadth = '';
	
	
	if(isset($_GET['vessels_id'])){
		//getting the user information
		$vessels_id = mysqli_real_escape_string($connection,$_GET['vessels_id'] );
		
		$query="SELECT * FROM vessels WHERE vessels_id ={$vessels_id} LIMIT 1";
		
		$result_set = mysqli_query($connection, $query);
		
		if($result_set){
			if(mysqli_num_rows($result_set) == 1){
				//user found
				$result = mysqli_fetch_assoc($result_set);
				$vessels_name = $result['vessels_name'];
				$vessels_id  = $result['vessels_id'];
				$image = "<img src='vesselsimages/".$result['image']. "'>";
				$speed = $result['speed'];
				$bollard_pall = $result['bollard_pall'];
				$breadth = $result['breadth'];
				
			}else{
				//user not found
				header('Location:vessels.php? user_not_found');
				
			}
		}else{
			// query unsuccessful
			header('Location:vessels.php? err=query_failed');
		}
	}
	
	
	
	
	
	if(isset($_POST['submit'])){
		
		  $vessels_id = $_POST['vessels_id'];
	      $vessels_name = $_POST['vessels_name'];
	      $speed = $_POST['speed'];
	      $bollard_pall = $_POST['bollard_pall'];
	      $breadth = $_POST['breadth'];
	      
		
		if(empty(trim($_POST['vessels_id']))){ 
		 $errors[]='vessels id is required';
		}
		if(empty(trim($_POST['vessels_name']))){ 
		 $errors[]='vessels name is required';
		}
		if(empty(trim($_POST['speed']))){ 
		 $errors[]='speed is required';
		}
		if(empty(trim($_POST['bollard_pall']))){ 
		 $errors[]='bollard pall is required';
		}
		if(empty(trim($_POST['breadth']))){ 
		 $errors[]='Breadth is required';
		}
		
		//checking max length
		$max_len_fields = array('vessels_name' => 50, 'speed' =>25, 'bollard_pall' => 25, 'breadth' => 500);
		//as akata passe key word akak gahanawa
		foreach($max_len_fields as $field => $max_len){
			if(strlen(trim($_POST[$field])) > $max_len){
				
				$errors[] = $field . 'must be less than '. $max_len . ' characters';
			}
		}
		
		
		
		
		if(empty($errors)){
			//no errors found... adding new record
			
			$vessels_name = mysqli_real_escape_string($connection, $_POST['vessels_name']);
			$speed = mysqli_real_escape_string($connection, $_POST['speed']);
			$bollard_pall = mysqli_real_escape_string($connection, $_POST['bollard_pall']);
			$breadth = mysqli_real_escape_string($connection, $_POST['breadth']);
		   
		   if(isset($_FILES['image']))
			{
		   
                $file_name = $_FILES['image']['name'];
               $temp_name = $_FILES['image']['tmp_name'];
                //photo direction
		       $upload_to = 'vesselsimages/';
                $file_uploaded = move_uploaded_file($temp_name, $upload_to . $file_name);
                $target = "vesselsimages/".basename($file_name);
            }
			else
			{
				$file_name = '';
			}			
			
			
			$query = " UPDATE vessels SET";
			$query .=" vessels_name='{$vessels_name}',speed='{$speed}',bollard_pall='{$bollard_pall}', breadth='{$breadth}'";
			if(!empty($file_name)) $query .= ",image='{$file_name}'";
			$query .="WHERE vessels_id = {$vessels_id} LIMIT 1";
			
			
			
			$result = mysqli_query($connection,$query);
			
			if($result){
				//query sucessful... redirecting to users page
				header('Location: vessels.php?project_modified=true');
				
			}else{
				$errors[] ='Failed to add the modify record';
			}
			
		}
		
	}

?>

<!DOCTYPE html>
<html>
<head>
<title>Modify Vessels</title>
<link rel="stylesheet" href="css/main.css">
<style>
 img{
	 width:450px;
	 height:400px;
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
 <h1>Update Info </h1>
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
 
 <form action="modify-vessels.php"  method="post" class="userform" enctype="multipart/form-data">
 	<input type ="hidden" name="vessels_id" value="<?php echo $vessels_id?>">
   <p>
   <lable for="">Vessels Name &nbsp &nbsp: </lable>
   <input type="text" name="vessels_name"<?php echo 'value="' . $vessels_name . '"';  //data form akata genima sadaha?>>
   </p>
    <p>
   <lable for="">New Photo &nbsp &nbsp &nbsp &nbsp : </lable>
   <input type="file" name="image">
   </p>
   <p>
   <lable for="">Previous Photo &nbsp : </lable>
   <?php echo " $image ";  //data form akata genima sadaha?>
   </p>
   <p>
   <lable for="">Speed &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp : </lable>
   <input type="text" name="speed"<?php echo 'value="' . $speed . '"';  //data form akata genima sadaha?>>
   </p>
   <p>
   <lable for="">Bollard Pall &nbsp &nbsp &nbsp &nbsp : </lable>
   <input type="text" name="bollard_pall" <?php echo 'value="' . $bollard_pall . '"';  //data form akata genima sadaha?>>
   </p>
   <p>
   <lable for="">Breadth &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp : </lable>
   <input type="text" name="breadth" <?php echo 'value="' . $breadth . '"';  //data form akata genima sadaha?>>
   </p>
    <p>
   <lable for="">&nbsp</lable>
   <button type="submit" name="submit">Save</button>
   </p>
   <br>
   <div class="backto"><span><a href="vessels.php"> Back</a></span></div>
 
 </form>
  
 </main>
</body>

</html>