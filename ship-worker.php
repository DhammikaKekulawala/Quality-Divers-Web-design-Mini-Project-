<?php session_start(); ?>
<?php 

    require_once("inc/connection.php");
	 $id= $_GET['user_id'];
    $query = " select * from records WHERE User_ID = $id";
    $result = mysqli_query($connection,$query);

?>
<?php
	if(!isset($_SESSION['user_id'])){
	header('Location: index.php');
}?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" a href="CSS/main.css">
    <title>View Records</title>
	<style types="text/css">
     h2{
		 text-align: center;
	 }
	 .container{
		 text-align: center;
		 margin-left:80px;
	 }
	
	 img{
		 height:200px;
		 width:400px;
	 }
	 header{
	background-color: yellow;
	overflow: auto;
	padding: 10px;
	
    }
     header .appname{
	 float: left;
     }
      header .loggedin{
	    float: right;
	
     }
	 .back{
		 background:white;
		 margin-left:100px;
		 margin-right:100px;
	 }
	 table{
	width:100%;
	border-collapse: collapse;
 }
 
	 th{
	background:#aaa;
	text-align:left:
   }
   table th, table td {
	padding:10px;
	border_bottom: 1px solid #aaa;
   }
	 
</style>
</head>
<body class="bg-dark">
<header>
    <div class="appname"><a href="worker.php">worker Panel </a></div>
    <div class="loggedin"> Welcome <?php echo $_SESSION['first_name']; ?> !
	<a href="logout.php"> Log Out </a></div> 
  </header>
  <br>
  <br>
  <?php 
 $row=mysqli_fetch_assoc($result);
if(!empty($row['User_ID'])){
echo"
 <div class='back'>
  <center>
  <br>
    <h1>Ship Registration</h1>
	<br>
	
        <div class='container'>
            <div class='row'>
                <div class='col m-auto'>
                    <div class='card mt-5'>
					<br>
                        <table border='2' class='table'>
                            <tr>
                              
                                <th> Owner Name/Company </th>
                                <th> Email </th>
		<th> Phone Number </th>
		<th> Country </th>
                                <th> Ship Name </th>
		<th> Ship Registration Country </th>
		<th> Registration Id </th>
		<th> Type </th>
		<th> Height </th>
		<th> Width </th>
		<th> Length </th>
		<th> Others </th>
		<th> Ship Image</th>
                                
                            </tr>";
		
                                        $UserID = $row['User_ID'];
                                        $UserName = $row['User_Name'];
                                        $UserEmail = $row['User_Email'];
		        $PhoneNumber = $row['Phone_Number'];
		        $Country = $row['Country'];
                                        $ShipName = $row['Ship_Name'];
		        $ShipRegistrationCountry = $row['Ship_Registration_Country'];
		        $Registration_Id = $row['Registration_Id'];
		        $Type = $row['Type'];
		        $Height = $row['Height'];
        		        $Width = $row['Width'];
        		        $Length = $row['Length'];
        		        $Others = $row['Others'];
		        $ShipImage = $row['Ship_Image'];
				// echo $ShipImage;
				$ShipImage1 = "<img src='shipimages/".$ShipImage." '>"; 
                            
                                echo"    <tr>
                                        
                                        <td>  $UserName</td>
                                        <td> $UserEmail</td>
		        <td> $PhoneNumber </td>
		        <td> $Country </td>
                              <td> $ShipName </td>
 		        <td> $ShipRegistrationCountry </td>
		        <td> $Registration_Id </td>
		        <td> $Type </td>
 		        <td> $Height </td>
		        <td> $Width </td>
		        <td> $Length </td>
		        <td> $Others </td>
		        <td> $ShipImage1 </td>
				 
				
                                    </tr> ";     
							
							
} else{
	echo"<div class='back'>
	<h1>Ship Registration</h1><br><h1>Data not Entered</h1>
	";
} ?> 
                            <?php 
                                    
                                    while($row=mysqli_fetch_assoc($result))
                                    {
                                        $UserID = $row['User_ID'];
                                        $UserName = $row['User_Name'];
                                        $UserEmail = $row['User_Email'];
		        $PhoneNumber = $row['Phone_Number'];
		        $Country = $row['Country'];
                                        $ShipName = $row['Ship_Name'];
		        $ShipRegistrationCountry = $row['Ship_Registration_Country'];
		        $Registration_Id = $row['Registration_Id'];
		        $Type = $row['Type'];
		        $Height = $row['Height'];
        		        $Width = $row['Width'];
        		        $Length = $row['Length'];
        		        $Others = $row['Others'];
		        $ShipImage = $row['Ship_Image'];
				// echo $ShipImage;
				$ShipImage1 = "<img src='shipimages/".$ShipImage." '>"; 
                            ?>
                                    <tr>
                                        
                                        <td><?php echo $UserName ?></td>
                                        <td><?php echo $UserEmail ?></td>
		        <td><?php echo $PhoneNumber ?></td>
		        <td><?php echo $Country ?></td>
                                        <td><?php echo $ShipName ?></td>
 		        <td><?php echo $ShipRegistrationCountry ?></td>
		        <td><?php echo $Registration_Id ?></td>
		        <td><?php echo $Type ?></td>
 		        <td><?php echo $Height ?></td>
		        <td><?php echo $Width ?></td>
		        <td><?php echo $Length ?></td>
		        <td><?php echo $Others ?></td>
		        <td><?php echo $ShipImage1 ?></td>
				 
				
                                    </tr>        
                            <?php 
                                    }  
                            ?>                                                                    
                                   

                        </table>
                    </div>
                </div>
            </div>
			
        </div>
		
  </center>  
  <br>
		<div class="backto"><a href="display-users.php">Back </a></div>
  <br>
 </div>
</body>
</html>