<?php session_start(); ?>
<?php require_once('inc/connection.php');?>
<?php require_once('inc/function.php');?>
<?php
	$errors = array();
	
 

	if(isset($_POST['submit'])){
		//checking required field
		//trim space aen karanna
    if($_POST['password'] !=$_POST['confirm_password']){
      $errors[] ='NOT match password and confirm password';
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
		if(empty(trim($_POST['password']))){ 
		 $errors[]='password is required';
		}
		//checking max length
		$max_len_fields = array('first_name' => 50, 'last_name' =>100, 'email' => 100,'password' => 40 );
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
			$password = mysqli_real_escape_string($connection, $_POST['password']);
			//email address is already sanitized
			$hashed_password = sha1($password);
			
			$query = "INSERT INTO user (";
			$query .=" first_name, last_name,email,password,type, is_delete";
			$query .=") VALUES(";
			$query .="'{$first_name}','{$last_name}','{$email}','{$hashed_password}',2, 0";
			$query .=")";
			
			
			$result = mysqli_query($connection,$query);
			
			if($result){
				//query sucessful... redirecting to users page
				header('Location: index.php?user_account _created_successfully ');
				
			}else{
				$errors[] ='Failed to add the new record';
			}
			
		}
		
	}

?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
<title>Add users</title>
<link rel="stylesheet" href="css/main.css">
<style>
input{
	font-size:16px;
}
p{
	font-size:16px;
}
.one{
	color:white;
	margin-top:100px;
	margin-left:500px;
	width:500px;
}
.one{
	 padding:30px;
	  text-align:left;
       width:35%;
   
       margin-left:400px;
       margin-top: 150px;
       background-color:#0080ff;
       opacity:0.8;

}
button{
	background-color:red;
}
h3{
	color:white;
	font-size:24px;
}

@media screen and (max-width:1500px) {
	div.one{ margin-top:10%; margin-left:10%; padding:5%; width:500px; }
	form.userform lable{ width:45%; float:left;}
	form.userform input{width:45%;}
	h1 {font-size: 40px;}
	
}

@media screen and (max-width:700px) {
	div.one{ margin-top:10%; margin-left:5%; padding:5%; width:500px; }
	form.userform lable{ width:45%; float:left;}
	form.userform input{width:45%;}
	h1 {font-size: 40px;}
	
} 
@media screen and (max-width:600px) {
	div.one{ margin-top:10%; margin-left:0px; padding:5%; width:500px; }
	form.userform lable{ width:45%; float:left;}
	form.userform input{width:45%;}
	h1 {font-size: 40px;}
}
@media screen and (max-width:550px) {
	div.one{ margin-top:10%; margin-left:0px; padding:5%; width:100%; }
	form.userform lable{ width:45%; float:left;}
	form.userform input{width:45%;}
	h1 {font-size: 40px;}
}
@media screen and (max-width:500px) {
	div.one{ margin-top:10%; margin-left:0px; padding-left:1%; padding-right:1%; width:100%; }
	
	form.userform input{width:50%;  font-size:16px; }
	form.userform button{ width:50%; background-color:#A9A9A9;}
}
@media screen and (max-width:350px) {
	div.one{ margin-top:10%; margin-left:0px; padding-left:1%; padding-right:1%; width:100%; }
	form.userform lable{ display: none}
	form.userform input{width:100%; padding-left:0px; font-size:20px; }
	form.userform button{ width:50%; background-color:#A9A9A9;}
}
</style>
</head>
<body style="background-image: url('IMG_7343-1024x760.png'); background-size:cover;background-attachment: fixed;">
 
 
 <div class="one">
 <form action="create-account.php"  method="post" class="userform">
   <b> <h1>Create Account</h1></b>
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
	  <br>
   <p>
   <b><lable for="">First Name &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp :</lable>
   <input type="text" name="first_name" placeholder="First name" >
   </p>
   <p>
   <lable for="">Last Name &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp :</lable>
   <input type="text" name="last_name" placeholder="Last name" >
   </p>
    <p>
   <lable for="">Email Address &nbsp &nbsp &nbsp &nbsp:</lable>
   <input type="email" name="email" placeholder="Email address" >
   </p>
    <p>
   <lable for="">Password &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp:</lable>
   <input type="password" name="password" id="password" placeholder="password"  pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" >
   </p>
   <p>
	<b>  <div id="message" class="messagestrong"><br>
  <h3>Password must contain the following:</h3><br>
  <p id="letter" class="invalid">A <b>lowercase</b> letter</p>
  <p id="capital" class="invalid">A <b>capital (uppercase)</b> letter</p>
  <p id="number" class="invalid">A <b>number</b></p>
  <p id="length" class="invalid">Minimum <b>8 characters</b></p>
 </div></b></p>
   <p>
   <lable for="">Conform Password:</lable>
   <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm password" >
   </p></b>
  <p> <lable for="">&nbsp</lable>
   <button type="submit" name="submit">save</button>
   </p>
   <br>
 
 </form>
</div>
 </main>
 
 


 
<script>
var myInput = document.getElementById("password");
var letter = document.getElementById("letter");
var capital = document.getElementById("capital");
var number = document.getElementById("number");
var length = document.getElementById("length");

// When the user clicks on the password field, show the message box
myInput.onfocus = function() {
  document.getElementById("message").style.display = "block";
}

// When the user clicks outside of the password field, hide the message box
myInput.onblur = function() {
  document.getElementById("message").style.display = "none";
}

// When the user starts to type something inside the password field
myInput.onkeyup = function() {
  // Validate lowercase letters
  var lowerCaseLetters = /[a-z]/g;
  if(myInput.value.match(lowerCaseLetters)) {  
    letter.classList.remove("invalid");
    letter.classList.add("valid");
  } else {
    letter.classList.remove("valid");
    letter.classList.add("invalid");
  }
  
  // Validate capital letters
  var upperCaseLetters = /[A-Z]/g;
  if(myInput.value.match(upperCaseLetters)) {  
    capital.classList.remove("invalid");
    capital.classList.add("valid");
  } else {
    capital.classList.remove("valid");
    capital.classList.add("invalid");
  }

  // Validate numbers
  var numbers = /[0-9]/g;
  if(myInput.value.match(numbers)) {  
    number.classList.remove("invalid");
    number.classList.add("valid");
  } else {
    number.classList.remove("valid");
    number.classList.add("invalid");
  }
  
  // Validate length
  if(myInput.value.length >= 8) {
    length.classList.remove("invalid");
    length.classList.add("valid");
  } else {
    length.classList.remove("valid");
    length.classList.add("invalid");
  }
}
</script>
 
 



</body>

</html>