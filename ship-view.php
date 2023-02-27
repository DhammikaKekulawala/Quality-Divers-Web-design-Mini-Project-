<?php session_start(); ?>
<?php 

    require_once("inc/connection.php");
	 $id= $_GET['user_id'];
    $query = " select * from records WHERE User_ID = $id";
    $result = mysqli_query($connection,$query);

?>
<?php
    //checking if a user is logged in
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
     h1{
		 text-align: center;
	 }
	 .container{
		 text-align: center;
		 margin-left:100px;
	 }
	 .se{
		 width:2000px;
		 background-color:white;
		 margin-left:50px;
	 }
	 img{
		 with:200px;
		 height:200px;
	 }
	 table{
		background-color:white; 
	 }
	 header{
		 width:2100px;
	 }
	 
</style>
</head>
<body class="bg-dark">
<header>
    <div class="appname"><a href="admin.php">Admin Panel</a></div>
    <div class="loggedin"> Welcome <?php echo $_SESSION['first_name']; ?> 
	<a href="logout.php"> Log Out </a></div> 
  </header>
<br>
<br>

<?php 
 $row=mysqli_fetch_assoc($result);
if(!empty($row['User_ID'])){
echo"
<div class='se'>
   <br>
   <br>
    <h1> Registered Ships</h1>
	<br>
	<br>
        <div class='container'>
            <div class='row'>
                <div class='col m-auto'>
                    <div class='card mt-5'>
                        <table border='2' class='masterlist'>
                            <tr>
                              
                                <th> Owner Name/Company </th>
                                <th> Email </th>
		<th> Contact No. </th>
		<th> Country </th>
                                <th> Ship Name </th>
		<th> Registered Country </th>
		<th> Registered Id </th>
		<th> Type </th>
		<th> Height </th>
		<th> Width </th>
		<th> Length </th>
		<th> Others </th>
		<th> Ship Image</th>
                                <th> Edit  </th>
                                <th> Delete </th>
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
				
				
				echo " <tr>
                                        
                      <td>  $UserName</td>
                      <td> $UserEmail </td>
		        <td>  $PhoneNumber</td>
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
				 
				<td><a href=\"ship-edit.php?Registration_Id={$row['Registration_Id']}\" class='edit'>Edit</a></td>
                <td><a href=\"ship-delete.php?Del={$row['Registration_Id']}\" class='delete'>Delete</a></td>
                                    </tr>";        

} else{
	echo" <div class='se'>
	<h1>Ship Registration</h1><br><h1>Data not Entered</h1>";
	
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
				 
				<td><a href="ship-edit.php?Registration_Id=<?php echo $Registration_Id?>" class="edit">Edit</a></td>
                <td><a href="ship-delete.php?Del=<?php echo $UserID ?>" class="delete">Delete</a></td>
                                    </tr>        
                            <?php 
                                    }  
                            ?>                                                                    
                                   

                        </table>
						<br>
						
						</div>
                    </div>
                </div>
            </div>
			<br>
						<div class='backto'><a href='users_details.php'> Back </a></div>
						<br>
        </div>
    
</body>
</html>