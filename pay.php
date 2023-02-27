<?php session_start(); ?>
<?php require_once('inc/connection.php');?>
<?php require_once('inc/function.php');?>
<?php

if(!isset($_SESSION['user_id'])){
  header('Location: index.php');
}

 $user_id=$_SESSION['user_id'];
 ?>
 <?php
   $total=$_GET['total'];
 ?>
 <?php
 if(isset($_POST['submit'])){
	 if(empty(trim($_POST['name']))){ 
		 $errors[]='first name is required';
		}
		if(empty(trim($_POST['last_name']))){ 
		 $errors[]='last name is required';
		}
		if(empty(trim($_POST['email']))){ 
		 $errors[]='email is required';
		}
		if(empty(trim($_POST['pay']))){ 
		 $errors[]='pay is required';
		}
		if(empty(trim($_POST['number']))){ 
		 $errors[]='number is required';
		}
		if(empty(trim($_POST['cvv']))){ 
		 $errors[]='cvv is required';
		}
		if(empty(trim($_POST['month']))){ 
		 $errors[]='month is required';
		}
		if(empty(trim($_POST['year']))){ 
		 $errors[]='year is required';
		}
		if(empty(trim($_POST['total']))){ 
		 $errors[]='total is required';
		}
		
		
		
		if(empty($errors)){
			//no errors found... adding new record
			$first_name = mysqli_real_escape_string($connection, $_POST['name']);
			$last_name = mysqli_real_escape_string($connection, $_POST['last_name']);
			$email = mysqli_real_escape_string($connection, $_POST['email']);
			$pay = mysqli_real_escape_string($connection, $_POST['pay']);
			$number = mysqli_real_escape_string($connection, $_POST['number']);
			$cvv = mysqli_real_escape_string($connection, $_POST['cvv']);
			$month = mysqli_real_escape_string($connection, $_POST['month']);
			$year = mysqli_real_escape_string($connection, $_POST['year']);
			$total = mysqli_real_escape_string($connection, $_POST['total']);
		
			
			$query = "INSERT INTO payment (";
			$query .=" name, last_name,email,pay,number,cvv,month,year,payments,user_id,is_delete";
			$query .=") VALUES(";
			$query .="'{$first_name}','{$last_name}','{$email}','{$pay}','{$number}','{$cvv}','{$month}','{$year}','{$total}','{$user_id}', 0";
			$query .=")";
			
			
			$result = mysqli_query($connection,$query);
			
			if($result){
				//query sucessful... redirecting to users page
				header('Location: user.php?user_addded=true');
				
			}else{
				$errors[] ='Failed to add the new record';
			}
			
		}
	 
	 
 }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
   
    <title>Document</title>
  
</head>
<style>
*{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}
body{
    background-color: #B0E0E6;
    font-family: Arial, Helvetica, sans-serif;
}
.wrapper{
    background-color: #00BFFF;
    width: 500px;
    padding: 25px;
    margin: 25px auto 0;
    box-shadow: 0px 0px 20px rgba(0,0,0,0.5);
}
.wrapper h2{
    background-color: #191970;
    color: #00BFFF;
    font-size: 24px;
    padding: 10px;
    margin-bottom: 20px;
    text-align: center;
    border: 1px dotted #333;
}
h4{
    padding-bottom: 5px;
    color: #000000;
}
.input-group{
    margin-bottom: 8px;
    width: 100%;
    position: relative;
    display: flex;
    flex-direction: row;
    padding: 5px 0;
}
.input-box{
    width: 100%;
    margin-right: 12px;
    position: relative;
}
.input-box:last-child{
    margin-right: 0;
}
.name{
    padding: 14px 10px 14px 50px;
    width: 100%;
    background-color: #fcfcfc;
    border: 1px solid #00000033;
    outline: none;
    letter-spacing: 1px;
    transition: 0.3s;
    border-radius: 3px;
    color: #333;
}
.name:focus, .dob:focus{
    -webkit-box-shadow:0 0 2px 1px #7ed32180;
    -moz-box-shadow:0 0 2px 1px #7ed32180;
    box-shadow: 0 0 2px 1px #7ed32180;
    border: 1px solid #7ed321;
}
.last_name{
    padding: 14px 10px 14px 50px;
    width: 100%;
    background-color: #fcfcfc;
    border: 1px solid #00000033;
    outline: none;
    letter-spacing: 1px;
    transition: 0.3s;
    border-radius: 3px;
    color: #333;
}
.last_name:focus, .dob:focus{
    -webkit-box-shadow:0 0 2px 1px #7ed32180;
    -moz-box-shadow:0 0 2px 1px #7ed32180;
    box-shadow: 0 0 2px 1px #7ed32180;
    border: 1px solid #7ed321;
}
.cvv{
    padding: 14px 10px 14px 50px;
    width: 100%;
    background-color: #fcfcfc;
    border: 1px solid #00000033;
    outline: none;
    letter-spacing: 1px;
    transition: 0.3s;
    border-radius: 3px;
    color: #333;
}
.cvv:focus, .dob:focus{
    -webkit-box-shadow:0 0 2px 1px #7ed32180;
    -moz-box-shadow:0 0 2px 1px #7ed32180;
    box-shadow: 0 0 2px 1px #7ed32180;
    border: 1px solid #7ed321;
}
.number{
    padding: 14px 10px 14px 50px;
    width: 100%;
    background-color: #fcfcfc;
    border: 1px solid #00000033;
    outline: none;
    letter-spacing: 1px;
    transition: 0.3s;
    border-radius: 3px;
    color: #333;
}
.number:focus, .dob:focus{
    -webkit-box-shadow:0 0 2px 1px #7ed32180;
    -moz-box-shadow:0 0 2px 1px #7ed32180;
    box-shadow: 0 0 2px 1px #7ed32180;
    border: 1px solid #7ed321;
}
.email{
    padding: 14px 10px 14px 50px;
    width: 100%;
    background-color: #fcfcfc;
    border: 1px solid #00000033;
    outline: none;
    letter-spacing: 1px;
    transition: 0.3s;
    border-radius: 3px;
    color: #333;
}
.email:focus, .dob:focus{
    -webkit-box-shadow:0 0 2px 1px #7ed32180;
    -moz-box-shadow:0 0 2px 1px #7ed32180;
    box-shadow: 0 0 2px 1px #7ed32180;
    border: 1px solid #7ed321;
}
.input-box .icon{
    width: 48px;
    display: flex;
    justify-content: center;
    align-items: center;
    position: absolute;
    top: 0px;
    left: 0px;
    bottom: 0px;
    color: #333;
    background-color: #f1f1f1;
    border-radius: 2px 0 0 2px;
    transition: 0.3s;
    font-size: 20px;
    pointer-events: none;
    border: 1px solid #00000033;
    border-right: none;
}
.name:focus + .icon{
    background-color: #7ed321;
    color: #fff;
    border-right: 1px solid #7ed321;
    border: none;
    transition: 1s;
}
.email:focus + .icon{
    background-color: #7ed321;
    color: #fff;
    border-right: 1px solid #7ed321;
    border: none;
    transition: 1s;
}
.last_name:focus + .icon{
    background-color: #7ed321;
    color: #fff;
    border-right: 1px solid #7ed321;
    border: none;
    transition: 1s;
}
.number:focus + .icon{
    background-color: #7ed321;
    color: #fff;
    border-right: 1px solid #7ed321;
    border: none;
    transition: 1s;
}
.cvv:focus + .icon{
    background-color: #7ed321;
    color: #fff;
    border-right: 1px solid #7ed321;
    border: none;
    transition: 1s;
}
.dob{
    width: 80%;
    padding: 14px;
    text-align: center;
    background-color: #fcfcfc;
    transition: 0.3s;
    outline: none;
    border: 1px solid #c0bfbf;
    border-radius: 3px;
}
.radio{
    display: none;
}
.input-box label{
    width: 50%;
    padding: 13px;
    background-color: #fcfcfc;
    display: inline-block;
    float: left;
    text-align: center;
    border: 1px solid #c0bfbf;
}
.input-box label:first-of-type{
    border-top-left-radius: 3px;
    border-bottom-left-radius: 3px;
    border-right: none;
}
.input-box label:last-of-type{
    border-top-right-radius: 3px;
    border-bottom-right-radius: 3px;
}
.radio:checked + label{
    background-color: #7ed321;
    color: #fff;
    transition: 0.5s;
}
.input-box select{
    display: inline-block;
    width: 50%;
    padding: 12px;
    background-color: #fcfcfc;
    float: left;
    text-align: center;
    font-size: 16px;
    outline: none;
    border: 1px solid #c0bfbf;
    cursor: pointer;
    transition: all 0.2s ease;
}
.input-box select:focus{
    background-color: #7ed321;
    color: #fff;
    text-align: center;
}
button{
    width: 100%;
    background: transparent;
    border: none;
    background: #7ed321;
    color: #fff;
    padding: 15px;
    border-radius: 4px;
    font-size: 16px;
    transition: all 0.35s ease;
}
button:hover{
    cursor: pointer;
    background: #5eb105;
}
.month{
margin-right:10px;
width:100px;
height:45px;
}
.year{
margin-right:0px;
width:75px;
height:45px;
}

header{
	background-color: yellow;
	overflow: auto;
	padding: 10px;
	color:black;
}
 header .appname{
	 float: left;
}
header .loggedin{
	float: right;
	
}

.wrapper-min{
    background-color: #00BFFF;
    width: 300px;
    padding: 25px;
    margin: 25px auto 0;
    box-shadow: 0px 0px 20px rgba(0,0,0,0.5);
}
.wrapper-min h2{
    background-color: #191970;
    color: #00BFFF;
    font-size: 24px;
    padding: 10px;
    margin-bottom: 20px;
    text-align: center;
    border: 1px dotted #333;
}
.wrapper-min{
	display:none;
}
@media screen and (max-width: 525px) {
	.wrapper {display: none }
	.wrapper-min{ display: block }
	
	.input-box label{ width: 50%}
}
</style>
<body>
<header>
    <div class="appname"><a href="user.php">User Panel </a></div>
    <div class="loggedin"> Welcome <?php echo $_SESSION['first_name']; ?> !
	<a href="logout.php"> Log Out </a></div> 
  </header>
    <div class="wrapper">
	
        <h2>Online Payment Form </h2>
<form method="POST" action="pay.php">
            <h4>
Account Details</h4>
<div class="input-group">
                <div class="input-box">
                    <input type="text" placeholder="First Name" required class="name" name="name">
                    <i class="fa fa-user icon"></i>
                </div>
<div class="input-box">
                    <input type="text" placeholder="Last Name" required class="last_name" name="last_name">
                    <i class="fa fa-user icon"></i>
                </div>
</div>
<div class="input-group">
                <div class="input-box">
                    <input type="email" placeholder="Email Adress" required class="email" name="email">
                    <i class="fa fa-envelope icon"></i>
                </div>
</div>
<div class="input-group">
                <div class="input-box">
                    <h4>Date</h4>
            <p id="demo"></p>

        <script>
      var d = new Date();
       document.getElementById("demo").innerHTML = d;
       </script>
                    
                </div>

</div>
<div>
<h4>Total of payment:($)</h4>
<div class="input-group">
                <div class="input-box">
                    <input type="tel" placeholder="Total of  payment" required class="name" name="total" <?php echo 'value="' . $total . '"';  //data form akata genima sadaha?>>
                    <i class="fa fa-credit-card icon"></i>
                </div>
</div>
</div>

<div class="input-group">
                <div class="input-box">
                     <h4>Payment Details</h4>
                      <input type="radio" name="pay" id="bc1" checked class="radio" value="credit">
                      <label for="bc1"><span><i class="fa fa-cc-visa"></i> Credit Card</span></label>
                      <input type="radio" name="pay" id="bc2" class="radio" value="debit">
                      <label for="bc2"><span><i class="fa fa-cc-debit"></i>Debit Card</span></label>
                      <input type="radio" name="pay" id="bc3" class="radio" value="visa">
                      <label for="bc3"><span><i class="fa fa-cc-visa"></i> Visa</span></label>
                      <input type="radio" name="pay" id="bc4" class="radio" value="paypal">
                      <label for="bc4"><span><i class="fa fa-cc-paypal"></i> Paypal</span></label>
                </div>
</div>

<div class="input-group">
                <div class="input-box">
                    <input type="tel" placeholder="Card Number" required class="number" name="number">
                    <i class="fa fa-credit-card icon"></i>
                </div>
</div>
<div class="input-group">
                <div class="input-box">
                    <input type="tel" placeholder="Card CVV" required class="cvv" name="cvv">
                    <i class="fa fa-user icon"></i>
                </div>
<div class="input-box">
                    <input type="text" id="1" name="month" placeholder="Expered month" class="month" >
                    <input type="text" id="1" name="year" placeholder="year" class="year" >
                </div>
</div>
<div class="input-group">
                <div class="input-box">
                    <button type="submit" name="submit">PAY NOW</button>
                </div>
</div>
</form>
</div>

 <div class="wrapper-min">
	
        <h2>Online Payment Form </h2><br>
<form method="POST" action="pay.php">
            <h3>
Account Details</h3><br>
<div class="input-group">
                <div class="input-box">
                    <input type="text" placeholder="First Name" required class="name" name="name">
                    <i class="fa fa-user icon"></i> <br>
                </div>
                </div>
<div class="input-group">				
             <div class="input-box">
                    <input type="text" placeholder="Last Name" required class="last_name" name="last_name">
                    <i class="fa fa-user icon"></i>
                </div>
</div>
<div class="input-group">
                <div class="input-box">
                    <input type="email" placeholder="Email Adress" required class="email" name="email">
                    <i class="fa fa-envelope icon"></i>
                </div>
</div>
<br>
<div>
<h3>Total of payment:($)</h3>
<div class="input-group">
                <div class="input-box">
                    <input type="tel" placeholder="Total of  payment" required class="name" name="total" <?php echo 'value="' . $total . '"';  //data form akata genima sadaha?>>
                    <i class="fa fa-credit-card icon"></i>
                </div>
</div>
</div>

<div class="input-group">
                <div class="input-box">
                     <h3>Payment Details</h3>
                      <input type="radio" name="pay" id="bc5" checked class="radio" value="credit">
                      <label for="bc5"><span><i class="fa fa-cc-visa"></i> Credit Card</span></label>
                      <input type="radio" name="pay" id="bc6" class="radio" value="debit">
                      <label for="bc6"><span><i class="fa fa-cc-debit"></i>Debit Card</span></label>
                      <input type="radio" name="pay" id="bc7" class="radio" value="visa">
                      <label for="bc7"><span><i class="fa fa-cc-visa"></i> Visa</span></label>
                      <input type="radio" name="pay" id="bc8" class="radio" value="paypal">
                      <label for="bc8"><span><i class="fa fa-cc-paypal"></i> Paypal</span></label>
                </div>
</div>

<div class="input-group">
                <div class="input-box">
                    <input type="tel" placeholder="Card Number" required class="number" name="number">
                    <i class="fa fa-credit-card icon"></i>
                </div>
</div>
<div class="input-group">
                <div class="input-box">
                    <input type="tel" placeholder="Card CVV" required class="cvv" name="cvv">
                    <i class="fa fa-user icon"></i>
                </div>
    </div>
<div class="input-group">				
<div class="input-box">
                    <input type="text" id="1" name="month" placeholder="Expered month" class="month" >
                    <input type="text" id="1" name="year" placeholder="year" class="year" >
                </div>
</div>
<div class="input-group">
                <div class="input-box">
                    <button type="submit" name="submit">PAY NOW</button>
                </div>
</div>
</form>
</div>

</body>
</html>
