<?php session_start(); ?>
<?php require_once('inc/connection.php');?>
<?php require_once('inc/function.php');?>
<?php
    //checking if a user is logged in
	if(!isset($_SESSION['user_id'])){
	header('Location: index.php');
}?>
<?php
        $errors = array();
	    $Registration_Id = '';
	    $UserID = '';
        $UserName = '';
        $UserEmail ='';
        $PhoneNumber = '';
        $Country ='';
        $ShipName = '';
        $ShipRegistrationCountry = '';
        $Type = '';
        $Height = '';
        $Width = '';
        $Length = '';
        $Others = '';
		$ShipImage1='';
		

	
	
	if(isset($_GET['Registration_Id'])){
		//getting the user information
		$Registration_Id = $_GET['Registration_Id'];
		
		
		$query="SELECT * FROM records WHERE Registration_Id='".$Registration_Id."'";
		
		$result_set = mysqli_query($connection, $query);
		
		if($result_set){
			if(mysqli_num_rows($result_set) == 1){
				//user found
				$result = mysqli_fetch_assoc($result_set);
				$UserID = $result['User_ID'];
                $UserName =  $result['User_Name'];
				$UserEmail =  $result['User_Email'];
				$PhoneNumber =  $result['Phone_Number'];
				$Country =  $result['Country'];
				$ShipName =  $result['Ship_Name'];
				$ShipRegistrationCountry =  $result['Ship_Registration_Country'];
				$Registration_Id =  $result['Registration_Id'];
				$Type =  $result['Type'];
				$Height = $result['Height'];
				$Width = $result['Width'];
				$Length =  $result['Length'];
				$Others =  $result['Others'];
				$ShipImage =  $result['Ship_Image'];
				$ShipImage1 = "<img src='shipimages/".$ShipImage." '>";
				
			
			}else{
				//user not found
				header('Location:ship-view.php? user_not_found');
				
			}
		}else{
			// query unsuccessful
			header('Location:ship-view.php? err=query_failed');
		}
	}
	
	
	
	
	
	if(isset($_POST['submit'])){
		
		  $UserID = $_POST['UserID'];
	      $UserName = $_POST['UserName'];
	      $UserEmail = $_POST['UserEmail'];
	      $PhoneNumber = $_POST['PhoneNumber'];
	      $Country = $_POST['Country'];
		  $ShipName = $_POST['ShipName'];
		  $ShipRegistrationCountry  = $_POST['ShipRegistrationCountry'];
		  $Registration_Id = $_POST['Registration_Id'];
		  $Type = $_POST['Type'];
		  $Height = $_POST['Height'];
		  $Width = $_POST['Width'];
		  $Length = $_POST['Length'];
		  $Others = $_POST['Others'];
	      
		
		if(empty(trim($_POST['UserID']))){ 
		 $errors[]='UserID is required';
		}
		if(empty(trim($_POST['UserName']))){ 
		 $errors[]='UserName is required';
		}
		if(empty(trim($_POST['UserEmail']))){ 
		 $errors[]='speed is required';
		}
		if(empty(trim($_POST['PhoneNumber']))){ 
		 $errors[]='UserEmail is required';
		}
		if(empty(trim($_POST['Country']))){ 
		 $errors[]='Country is required';
		}
		if(empty(trim($_POST['ShipName']))){ 
		 $errors[]='ShipName is required';
		}
		if(empty(trim($_POST['ShipRegistrationCountry']))){ 
		 $errors[]='ShipRegistrationCountry is required';
		}
		if(empty(trim($_POST['Type']))){ 
		 $errors[]='Type is required';
		}
		if(empty(trim($_POST['Height']))){ 
		 $errors[]='Height is required';
		}
		if(empty(trim($_POST['Width']))){ 
		 $errors[]='Width is required';
		}
		if(empty(trim($_POST['Length']))){ 
		 $errors[]='Length is required';
		}
		if(empty(trim($_POST['Others']))){ 
		 $errors[]='Others is required';
		}
		
		
		
		
		
		
		if(empty($errors)){
			//no errors found... adding new record
			$UserID = mysqli_real_escape_string($connection, $_POST['UserID']);
			$UserName = mysqli_real_escape_string($connection, $_POST['UserName']);
			$UserEmail = mysqli_real_escape_string($connection, $_POST['UserEmail']);
			$PhoneNumber = mysqli_real_escape_string($connection, $_POST['PhoneNumber']);
			$Country = mysqli_real_escape_string($connection, $_POST['Country']);
			$ShipName = mysqli_real_escape_string($connection, $_POST['ShipName']);
			$ShipRegistrationCountry = mysqli_real_escape_string($connection, $_POST['ShipRegistrationCountry']);
			$Registration_Id = mysqli_real_escape_string($connection, $_POST['Registration_Id']);
			$Type = mysqli_real_escape_string($connection, $_POST['Type']);
			$Height = mysqli_real_escape_string($connection, $_POST['Height']);
			$Width = mysqli_real_escape_string($connection, $_POST['Width']);
			$Length = mysqli_real_escape_string($connection, $_POST['Length']);
			$Others = mysqli_real_escape_string($connection, $_POST['Others']);
			
		   if(isset($_FILES['image']))
			{
                $upload_to = 'shipimages/';
		              $file_name = $_FILES['image']['name'];
			    	   $temp_name = $_FILES['image']['tmp_name'];
                         $file_uploaded = move_uploaded_file($temp_name, $upload_to . $file_name);
			    }
			else
			{
				$file_name = '';
			}
			
			
			
	    $query = " UPDATE records SET User_ID='{$UserID}',User_Name ='{$UserName}',User_Email='{$UserEmail}',Phone_Number ='{$PhoneNumber}',Country ='{$Country}',Ship_Name ='{$ShipName}',Ship_Registration_Country ='{$ShipRegistrationCountry}',Type='{$Type}',Height='{$Height}',Width='{$Width}',Length='{$Length}',Others ='{$Others}'"; 
		if(!empty($file_name)) $query .= ",Ship_Image ='{$file_name}'";
		$query .="WHERE  Registration_Id ='{$Registration_Id}'";
		$result = mysqli_query($connection,$query);
			
			
			$result = mysqli_query($connection,$query);
			
			if($result){
				//query sucessful... redirecting to users page
				header('Location: ship-view.php?user_id='.$UserID );
				
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
 <h1>Update Ship Info </h1>
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
 
 <form action="ship-edit.php"  method="post" class="userform" enctype="multipart/form-data">
 	<input type ="hidden" name="UserID" value="<?php echo $UserID?>"><br>
   <p>
   <lable for="">User Name &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp : </lable>
   <input type="text" name="UserName"<?php echo 'value="' . $UserName . '"';?>>
   </p>
    <p>
	<lable for="">Email &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp: </lable>
   <input type="text" name="UserEmail"<?php echo 'value="' . $UserEmail . '"';?>>
   </p>
   <p>
	<lable for="">Contact No. &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp: </lable>
   <input type="text" name="PhoneNumber"<?php echo 'value="' . $PhoneNumber . '"';?>>
   </p>
    <p>
   <lable for="">Country &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp  &nbsp &nbsp: </lable>
   <input type="text" name="Country"<?php echo 'value="' . $Country . '"';  ?>>
   </p>
   
   <p>
   <lable for="">Ship Name &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp: </lable>
   <input type="text" name="ShipName" <?php echo 'value="' . $ShipName . '"'; ?>>
   </p>
   <p>
   <lable for="">Ship Registered Country : </lable>
   <input type="text" name="ShipRegistrationCountry" <?php echo 'value="' . $ShipRegistrationCountry . '"';?>>
   </p>
    <p>
   <lable for="">Registered Id &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp  :</lable>
   <input type="text" name="Registration_Id" <?php echo 'value="' . $Registration_Id . '"'; ?>>
   </p>
   <p>
   <lable for="">Type&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp :</lable>
   <input type="text" name="Type" <?php echo 'value="' . $Type . '"'; ?>>
   </p>
    <p>
	<p>
   <lable for="">Length &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp  : </lable>
   <input type="text" name="Length" <?php echo 'value="' . $Length . '"'; ?>>
   </p>
     <p>
   <lable for="">Width &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp  : </lable>
   <input type="text" name="Width" <?php echo 'value="' . $Width . '"'; ?>>
   </p>
   <p>
   <lable for="">Height &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp  : </lable>
   <input type="text" name="Height" <?php echo 'value="' . $Height . '"'; ?>>
   </p>
    <p>
   <lable for="">Other Details &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp: </lable>
   <input type="text" name="Others" <?php echo 'value="' . $Others . '"'; ?>>
   </p>
   <p>
   <lable for="">Previous Photo &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp: </lable>
   <?php echo " $ShipImage1 ";  //data form akata genima sadaha?>
   </p>
    <p>
   <lable for="">New Photo &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp : </lable>
   <input type="file" name="image">
   </p>
   
   <lable for="">&nbsp</lable>
   <button type="submit" name="submit">Save</button>
   </p>
   <br>
   <a href="ship-view.php?user_id=<?php echo$UserID; ?>" class="add"> Back </a>
   <br>
 </form>
 </main>
</body>

</html>