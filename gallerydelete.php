<?php

$servername="localhost";
$username="root";
$password="";
$database="diver";
  
$connection=mysqli_connect($servername,$username,$password,$database);

if(!$connection){
	die("Connection Failed: ".mysqli_connect_error());
}
else {
	echo "Connection Successfull";
}

	if(isset($_GET['Id'])){
		//getting the user information
		$ID = mysqli_real_escape_string($connection,$_GET['Id'] );
			
		$query = "UPDATE gal SET Is_Delete = 1 WHERE Id = '{$ID}'";
		
		$result = mysqli_query($connection , $query);
		
		if($result){
			//user deleted
			header('Location:gallery.php?msg=user-deleted');
			
		}else{
			header('Location:gallery.php?err=delete_failed');
		}
				
	}else{
		header('Location:gallery.php');
	}

?>	
	
	
	
	