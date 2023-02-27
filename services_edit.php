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
	$id = '';
	$first_name = '';
	$last_name = '';
	$company = '';
	$ship_name = '';
	$ship_id = '';
	$length = '';
	$width = '';
	$height = '';
	$country = '';
	$email = '';
	$area_code = '';
	$phone = '';
	$uws ='';
	$aws ='';
	
	
	
	
	if(isset($_GET['id'])){
		//getting the user information
		$id = mysqli_real_escape_string($connection,$_GET['id'] );
		
		$query="SELECT * FROM service WHERE id ={$id} LIMIT 1";
		
		$result_set = mysqli_query($connection, $query);
		
		if($result_set){
			if(mysqli_num_rows($result_set) == 1){
				//user found
				$result = mysqli_fetch_assoc($result_set);
				$first_name = $result['First_Name'];
				$id  = $result['id'];
				$user_Id  = $result['user_id'];
				$last_name = $result['Last_Name'];
				$company = $result['Company'];
				$ship_name = $result['Ship_Name'];
				$ship_id = $result['Ship_ID'];
				$length = $result['Length'];
				$width = $result['Width'];
				$height = $result['Height'];
				$country = $result['Country'];
				$email = $result['E-mail'];
				$area_code = $result['Area_Code'];
				$phone = $result['Phone'];
				
				
			}else{
				//user not found
				header('Location:viewservices.php? _not_found');
				
			}
		}else{
			// query unsuccessful
			header('Location:viewservices.php.php? err=query_failed');
		}
	}
	
	
	
	
	
	if(isset($_POST['submit'])){
		
		  $id = $_POST['id'];
	      $first_name = $_POST['first_name'];
	      $last_name = $_POST['last_name'];
	      $company = $_POST['company'];
	      $ship_name = $_POST['ship_name'];
		  $ship_id = $_POST['ship_id'];
		  $length = $_POST['length'];
		  $width = $_POST['width'];
		  $height = $_POST['height'];
		  $country = $_POST['country'];
		  $email = $_POST['email'];
		  $area_code = $_POST['area_code'];
		  $phone = $_POST['phone'];
		  
	      
		
		if(empty(trim($_POST['id']))){ 
		 $errors[]=' id is required';
		}
		if(empty(trim($_POST['first_name']))){ 
		 $errors[]='FIRST name is required';
		}
		if(empty(trim($_POST['last_name']))){ 
		 $errors[]='last_name is required';
		}
		if(empty(trim($_POST['company']))){ 
		 $errors[]='bollard pall is required';
		}
		if(empty(trim($_POST['ship_name']))){ 
		 $errors[]='ship_name is required';
		}
		if(empty(trim($_POST['ship_id']))){ 
		 $errors[]='ship_id is required';
		}
		if(empty(trim($_POST['length']))){ 
		 $errors[]='length is required';
		}
		if(empty(trim($_POST['width']))){ 
		 $errors[]='width is required';
		}
		if(empty(trim($_POST['height']))){ 
		 $errors[]='height is required';
		}
		if(empty(trim($_POST['country']))){ 
		 $errors[]='country is required';
		}
		if(empty(trim($_POST['email']))){ 
		 $errors[]='email is required';
		}
		if(empty(trim($_POST['area_code']))){ 
		 $errors[]='area_code is required';
		}
		if(empty(trim($_POST['phone']))){ 
		 $errors[]='phone is required';
		}
		
		
		
		
		
		if(empty($errors)){
			//no errors found... adding new record
			$id = mysqli_real_escape_string($connection, $_POST['id']);
			$user_Id = mysqli_real_escape_string($connection, $_POST['user_Id']);
			$first_name = mysqli_real_escape_string($connection, $_POST['first_name']);
			$last_name = mysqli_real_escape_string($connection, $_POST['last_name']);
			$company = mysqli_real_escape_string($connection, $_POST['company']);
			$ship_name = mysqli_real_escape_string($connection, $_POST['ship_name']);
			$ship_id = mysqli_real_escape_string($connection, $_POST['ship_id']);
			$length = mysqli_real_escape_string($connection, $_POST['length']);
			$width = mysqli_real_escape_string($connection, $_POST['width']);
			$height = mysqli_real_escape_string($connection, $_POST['height']);
			$country = mysqli_real_escape_string($connection, $_POST['country']);
			$email = mysqli_real_escape_string($connection, $_POST['email']);
			$area_code = mysqli_real_escape_string($connection, $_POST['area_code']);
			$phone = mysqli_real_escape_string($connection, $_POST['phone']);
			
			
           $a = isset($_POST['Under_Water'])? implode(',',$_POST['Under_Water']) : '';
           $b = isset($_POST['Above_Water'])? implode(',',$_POST['Above_Water']): '';

			
			
			
			$query = " UPDATE service SET";
			$query .= " First_Name='{$first_name}',Last_Name='{$last_name}',Company='{$company}',Ship_Name='{$ship_name}',Ship_ID='{$ship_id}',Length='{$length}',Width='{$width}',Height='{$height}',Country='{$country}',Area_Code='{$area_code}',Phone='{$phone}',Under_Water='{$a}',Above_Water='{$b}'";
			$query .= "WHERE id ={$id} LIMIT 1";
			
			
			
			$result = mysqli_query($connection,$query);
			
			if($result){
				//query sucessful... redirecting to users page
				header('Location:viewservices.php?user_id='.$user_Id);
				
			}else{
				$errors[] ='Failed to add the modify record';
			}
			
		}
		
	}

?>

<!DOCTYPE html>
<html>
<head>
<title>Modify Services</title>
<link rel="stylesheet" href="form.css">
</head>
<body>
  <header>
    <div class="appname"><a href="admin.php">Admin Panel </a></div>
    <div class="loggedin"> Welcome <?php echo $_SESSION['first_name']; ?> 
	<a href="logout.php"> Log Out </a></div> 
	<style>
	body{
		animation: myanimation 3600s infinite;
	}

	@keyframes myanimation {
		0% {background-color: Seashell;}
		10%{background-color: Pearl;}
		20%{background-color: Pink Bubble Gum;}
		30%{background-color: Parchment;}
		40% {background-color: Lemon Chiffon;}
		50% {background-color: light Jade;}
		60%{background-color: Light Slate;}
		70%{background-color: Azure;}
		80%{background-color: Alice Blue;}
		90%{background-color: Light Cyan;}
		100% {background-color: seashell;}
	}

	
	main{
		width:800px;
		margin:auto;
		
	}
	body{
		color:black;
	}
	.name{
		color:black;
		width:150px;
	}
	.se1{
		padding-left:300px;
		background:white;
	}
	button{
		margin-left:250px;
	}
	form{
		background:white;
	}
	.backto{
    margin-left:10px;
    }
  .backto a{
    background: blue;
    color: white;
    padding: 12px 20px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size:16px;
  }
  .add{
  background-color:#0000a3;
  color: white;
  padding: 12px 20px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
}
	
	</style>
  </header>
  <main>
  <br>
  <div class="se">
 <h1 class="se1"><br>Update Services Info<br><br></h1>
 
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
 
 <form action = "services_edit.php" method="POST">
 
                  <input type ="hidden" name="id" value="<?php echo $id?>">
                  <input type ="hidden" name="user_Id" value="<?php echo $user_Id?>">
                <h2 class = "name">Name </h2>
					<input class = "firstname" type = "text" name = "first_name" placeholder = "First Name" <?php echo 'value="' . $first_name . '"'; ?>>
					<input class = "lastname" type = "text" name = "last_name" placeholder = "Last Name" <?php echo 'value="' . $last_name . '"'; ?>>
			
				<h2 class = "name">Company Name </h2>
					<input class = "company" type = "text" name = "company" placeholder = "Company Name" <?php echo 'value="' . $company . '"'; ?>>
				
				<h2 class = "name">Ship Name </h2>
					<input class = "ship-name" type = "text" name = "ship_name" placeholder = "Ship Name" <?php echo 'value="' . $ship_name . '"'; ?>>
				
				<h2 class = "name">Ship ID </h2>
					<input class = "ship-id" type = "text" name = "ship_id" placeholder = "Ship ID"<?php echo 'value="' . $ship_id . '"'; ?>>
				
				<h2 class = "name">Ship Dimensions</h2>
					<input class = "length" type = "text" name = "length" placeholder = "Length in meters" <?php echo 'value="' . $length . '"'; ?>>
					<input class = "width" type = "text" name = "width" placeholder = "Width in meters" <?php echo 'value="' . $width . '"'; ?>>
					<input class = "height" type = "text" name = "height" placeholder = "Height in meters" <?php echo 'value="' . $height . '"'; ?>>
				
				<h2 class = "name">Country </h2>
					<input class = "country" type = "text" name = "country" placeholder = "Country" <?php echo 'value="' . $country . '"'; ?>>
				
				<h2 class = "name">E-mail</h2>
					<input class = "email" type = "email" name = "email" placeholder = "E-mail"  <?php echo 'value="' . $email . '"'; ?>>
				
				<h2 class = "name">Phone</h2>
					<input class = "Code" type = "text" name = "area_code" placeholder = "Area-Code" <?php echo 'value="' . $area_code . '"'; ?>>
					
					<input class = "number" type = "text" name = "phone" placeholder = "Phone No." <?php echo 'value="' . $phone . '"'; ?>>
					
				<h2 style="text-align:center">Services</h2><br>

					<h2 style="margin-left:100px">Under Water Services</h2><br>

						<div class = "group">
							<input type = "checkbox" id = "s1" name="Under_Water[]" value = "Salvage & Towage of Ships">
							<label for = "s1">Salvage & Towage of Ships</label>
						</div>

						<div class = "group">
							<input type = "checkbox" id = "s2" name="Under_Water[]" value = "Ultrasonic gauging of plate thickness">
							<label for = "s2">Ultrasonic gauging of plate thickness</label>
						</div>

						<div class = "group">
							<input type = "checkbox" id = "s3" name="Under_Water[]" value = "Deep diving work for Hydro Power Dams">
							<label for = "s3">Deep diving work for Hydro Power Dams</label>
						</div>

						<div class = "group">
							<input type = "checkbox" id = "s4" name="Under_Water[]" value = "Rock Blasting">
							<label for = "s4">Rock Blasting</label>
						</div>

						<div class = "group">
							<input type = "checkbox" id = "s5" name="Under_Water[]" value = "Propeller Polishing">
							<label for = "s5">Propeller Polishing</label>
						</div>

						<div class = "group">
							<input type = "checkbox" id = "s6" name="Under_Water[]" value = "Laying and Recovery of Oceanographic Instruments">
							<label for = "s6">Laying and Recovery of Oceanographic Instruments</label>
						</div>

						<div class = "group">
							<input type = "checkbox" id = "s7" name="Under_Water[]" value = "Cable Laying">
							<label for = "s7">Cable Laying</label>
						</div>

						<div class = "group">
							<input type = "checkbox" id = "s8" name="Under_Water[]" value = "Pipe lining & Inspection">
							<label for = "s8">Pipe lining & Inspection</label>
						</div>

						<div class = "group">
							<input type = "checkbox" id = "s9" name="Under_Water[]" value = "Underwater Video Filming & Monitoring">
							<label for = "s9">Underwater Video Filming & Monitoring</label>
						</div>

						<div class = "group">
							<input type = "checkbox" id = "s10" name="Under_Water[]" value = "In Water Surveys of Ships">
							<label for = "s10">In Water Surveys of Ships</label>
						</div>

						<div class = "group">
							<input type = "checkbox" id = "s11" name="Under_Water[]" value = "Underwater Welding & Cutting">
							<label for = "s11">Underwater Welding & Cutting</label>
						</div>

						<div class = "group">
							<input type = "checkbox" id = "s12" name="Under_Water[]" value = "Hull cleaning Services">
							<label for = "s12">Hull cleaning Services</label>
						</div><br><br>

					<h2 style="margin-left:100px">Above Water Services</h2><br>

						<div class = "group">
							<input type = "checkbox" id = "s13" name="Above_Water[]" value = "Supply of fresh water to ships in & outside the harbor">
							<label for = "s13">Supply of fresh water to ships in & outside the harbor</label>
						</div>
						
						<div class = "group">
							<input type = "checkbox" id = "s14" name="Above_Water[]" value = "Providing Supply Boats">
							<label for = "s14">Providing Supply Boats</label>
						</div>

						<div class = "group">
							<input type = "checkbox" id = "s15" name="Above_Water[]" value = "Ship to shore transport for crew">
							<label for = "s15">Ship to shore transport for crew</label>
						</div>

						<div class = "group">
							<input type = "checkbox" id = "s16" name="Above_Water[]" value = "Construction & Maintenance of Marine Structures">
							<label for = "s16">Construction & Maintenance of Marine Structures</label>
						</div>

						<div class = "group">
							<input type = "checkbox" id = "s17" name="Above_Water[]" value = "Hull & Machinery repairs. (Floating Workshop)">
							<label for = "s17">Hull & Machinery repairs. (Floating Workshop)</label>
						</div>

						<div class = "group">
							<input type = "checkbox" id = "s18" name="Above_Water[]" value = "Transportation of material and equipment outside">
							<label for = "s18">Transportation of material and equipment outside</label>
						</div>

						<div class = "group">
							<input type = "checkbox" id = "s19" name="Above_Water[]" value = "Ship Repairs">
							<label for = "s19">Ship Repairs</label>
						</div><br>
		
				<button type= "submit" name="submit"><b>Submit</b></button>
				<br>
				<br>
		<a href="viewservices.php?user_id=<?php echo$user_Id; ?>"  class="add"> Back </a>
		<br>
        </form>
		
 </div>
 <br>
 
 </br>
 </main>
</body>

</html>