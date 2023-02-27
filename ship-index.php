<?php session_start(); ?>
<?php require_once('inc/connection.php');?>
<?php if(!isset($_SESSION['user_id'])){
	header('Location: index.php');
}?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>Registration Form</title>
<style types="text/css">

*{
  margin:10;
  padding:0;
  }
 body{
   font-family:sans-serif;
   font-size:24px;
    }
	input{
		 font-size:24px;
	}
	.form-control mb-2{
		
		 width:100%;
	}
	.form-control mb-1{
		 width:40px;
	 }
button{
	margin-left:30%;
	font-size:24px;
    background-color:brown;
    display:block;
    border-radius:4px;
    border:2px solid #366473;
    padding:10px 100px;
    outline:none;
    color:white;
    cursor:pointer;
    transition:0.25px;
} 

   button:hover{
                background-color:red;
      }  
	 .card-body{
		 background-color:blue;
		 color:white;
		 width:1400px;
		 padding:20px;
		 padding-left:50px;
		margin-left:10%;
		margin-top:100px;
		opacity:0.8;
	 }
	 td{
		 text-align:left;
	 }
	 a{
		 color:red;
	 }
	 .back{
  background-color:#0000a3;
  color: white;
  padding: 12px 20px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
}
.min{
	display:none;
}	
@media screen and (max-width: 1700px) {
	.card-body{ margin-left:0px; }
	
	
}

@media screen and (max-width: 1300px) {
	.container {display: none;  }
	.min{ display: block }
	
}
@media screen and (max-width: 800px) {
	.container {display: none;  }
	.min{ display: block }
	lable{display: none;}
	button{margin-left:0px; padding:10px 50px;}
	
}

</style>
</head>
<body class="bg-dark" style="background-image: url('Layer-9-1024x760.png'); background-size:cover;background-attachment: fixed; ">
<text align ="center">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 m-auto">
                    <div class="card mt-5">
                    
                        <div class="card-body">
						   <h2 class="bg-success text-white text-center py-3"> Registration Form &nbsp <span><a href="user.php" class="back">Back</a></span></h2>
           
                            <form action="ship-insert.php" method="post" class="userform" enctype="multipart/form-data"> 
							<table>
							<tr>
							<td><lable for="">UserName</lable></td>
							<td><input type="text" class="form-control mb-2" placeholder=" User Name " name="name" size=80px></td></tr>
							<tr></tr>
							<tr><td><lable for="">User Email</lable></td>
                            <td><input type="email" class="form-control mb-2" placeholder=" User Email " name="email" size=80px></td></tr>
							<tr></tr>
							<tr><td><lable for=""> Phone Number</lable></td>
		                   <td><input type="text" class="form-control mb-2" placeholder=" Phone Number " name="number" size=80px></td></tr>
						   <tr></tr>
		                    <tr> <td><lable for="">Country</lable></td>
		                   <td><input type="text" class="form-control mb-2" placeholder=" Country " name="country" size=80px></td></tr>
						   <tr></tr>
						   <tr><td><lable for="">Ship Name</lable></td>
                           <td><input type="text" class="form-control mb-2" placeholder=" Ship Name " name="shipname" size=80px></td></tr>
						   <tr></tr>
						   <tr><td><lable for="">Registrated Country &nbsp &nbsp &nbsp &nbsp</lable></td>
                           <td><input type="text" class="form-control mb-2" placeholder=" Registrated Country " name="country" size=80px></td></tr>
						   <tr></tr>
						   <tr><td><lable for="">Registration Id</lable></td>
                           <td><input type="text" class="form-control mb-2" placeholder=" Registration Id " name="id" size=80px></td></tr>
						   <tr></tr>
						   <tr><td><lable for=""> Type</lable></td>
                           <td><input type="text" class="form-control mb-2" placeholder=" Type " name="type" size=80px list="type">
						   <datalist id="type">
										<option value="Container Ships"></option>
										<option value="Bulk Carrier"></option>
										<option value="Tanker Ships"></option>
										<option value="Passenger Ships"></option>
										<option value="Naval Ships"></option>
										<option value="Offshore Ships"></option>
										<option value="Special Purpose Ships"></option>
							</datalist>
						   </td></tr>
						   <tr></tr>
						   <tr><td><lable for="">Height</lable></td>
                           <td><input type="text" class="form-control mb-1" placeholder=" Height " name="height" size=20px></td></tr>
						   <tr></tr>
						   <tr><td><lable for="">Width</lable></td>
                           <td><input type="text" class="form-control mb-1" placeholder=" Width " name="width" size=20px></td></tr>
						   <tr></tr>
                           <tr><td><lable for=""> Length</lable></td>								
		                   <td><input type="text" class="form-control mb-1" placeholder=" Length " name="length" size=20px></td></tr>
						   <tr></tr>
						   <tr><td><lable for="">Other Details</lable></td>
                           <td><textarea class="form-control mb-2" placeholder=" Other Details " name="others"  rows="3" cols="50" style= "font-size:24px; font-family:sans-serif;"></textarea></td></tr>
						   <tr></tr>
						   <tr><td><lable for="">Ship Image</lable></td>
                           <td><input type="file" class="form-control mb-2" placeholder=" Ship Image " name="image" id="" size=80px></td></tr>
						   <tr><td><br></td></tr>
						   <tr><td><lable for="">&nbsp</lable></td>
                           <td><button class="btn btn-primary" name="submit">Submit</button></td></tr>
						   </table>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
		
		<div class="min">
		  <div class="card-body-min">
						   <h2 class="bg-success text-white text-center py-3"> Registration Form &nbsp </span></h2>
						   
           
                            <form action="ship-insert.php" method="post" class="userform" enctype="multipart/form-data"> 
							<table>
							<tr>
							<td><lable for="">UserName</lable></td>
							<td><input type="text" class="form-control mb-2" placeholder=" User Name " name="name" size=40px></td></tr>
							<tr></tr>
							<tr><td><lable for="">User Email</lable></td>
                            <td><input type="email" class="form-control mb-2" placeholder=" User Email " name="email" size=40px></td></tr>
							<tr></tr>
							<tr><td><lable for=""> Phone Number</lable></td>
		                   <td><input type="text" class="form-control mb-2" placeholder=" Phone Number " name="number" size=40px></td></tr>
						   <tr></tr>
		                    <tr> <td><lable for="">Country</lable></td>
		                   <td><input type="text" class="form-control mb-2" placeholder=" Country " name="country" size=40px></td></tr>
						   <tr></tr>
						   <tr><td><lable for="">Ship Name</lable></td>
                           <td><input type="text" class="form-control mb-2" placeholder=" Ship Name " name="name" size=40px></td></tr>
						   <tr></tr>
						   <tr><td><lable for="">Registrated Country &nbsp &nbsp &nbsp &nbsp</lable></td>
                           <td><input type="text" class="form-control mb-2" placeholder=" Registrated Country " name="country" size=40px></td></tr>
						   <tr></tr>
						   <tr><td><lable for="">Registration Id</lable></td>
                           <td><input type="text" class="form-control mb-2" placeholder=" Registration Id " name="id" size=40px></td></tr>
						   <tr></tr>
						   <tr><td><lable for=""> Type</lable></td>
                           <td><input type="text" class="form-control mb-2" placeholder=" Type " name="type" size=40px list="type">
						   <datalist id="type">
										<option value="Container Ships"></option>
										<option value="Bulk Carrier"></option>
										<option value="Tanker Ships"></option>
										<option value="Passenger Ships"></option>
										<option value="Naval Ships"></option>
										<option value="Offshore Ships"></option>
										<option value="Special Purpose Ships"></option>
							</datalist>
						   </td></tr>
						   <tr></tr>
						   <tr><td><lable for="">Height</lable></td>
                           <td><input type="text" class="form-control mb-1" placeholder=" Height " name="height" size=20px></td></tr>
						   <tr></tr>
						   <tr><td><lable for="">Width</lable></td>
                           <td><input type="text" class="form-control mb-1" placeholder=" Width " name="width" size=20px></td></tr>
						   <tr></tr>
                           <tr><td><lable for=""> Length</lable></td>								
		                   <td><input type="text" class="form-control mb-1" placeholder=" Length " name="length" size=20px></td></tr>
						   <tr></tr>
						   <tr><td><lable for="">Other Details</lable></td>
                           <td><textarea class="form-control mb-2" placeholder=" Other Details " name="others"  rows="3" cols="40" style= "font-size:24px; font-family:sans-serif;"></textarea></td></tr>
						   <tr></tr>
						   <tr><td><lable for="">Ship Image</lable></td>
                           <td><input type="file" class="form-control mb-2" placeholder=" Ship Image " name="image" id="" size=30px></td></tr>
						   <tr><td><br></td></tr>
						   <tr><td><lable for="">&nbsp</lable></td>
                           <td><button class="btn btn-primary" name="submit">Submit</button> </td></tr>
						   </table>
						   <h4><span><a href="user.php" class="back">Back</a></h4>
                            </form>

                        </div>
             </div>
    
</body>
</html>